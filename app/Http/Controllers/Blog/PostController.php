<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Blog\Post as Obj;
use App\Models\Blog\Category;
use App\Models\Blog\Tag;

use App\Models\User;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    /**
     * Define the app and module object variables and component name 
     *
     */
    public function __construct(){
        // load the app, module and component name to object params
        $this->app      =   'Blog';
        $this->module   =   'Post';
        $this->componentName = componentName('agency');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {        
        // objects
        $obj = new Obj();
        $category = new Category();
        $tag = new Tag();
        $user = new User();
        // Retrieve all posts
        $objs = $obj->where('agency_id', request()->get('agency.id'))->where('client_id', request()->get('client.id'))->with("user")->orderBy("id", 'desc')->paginate('5');
        
        // Retrieve Featured Posts
        $featured = $obj->where('agency_id', request()->get('agency.id'))->where('client_id', request()->get('client.id'))->with("user")->where('featured', 'on')->orderBy("id", 'desc')->get();
        
        // Retrieve Popular Posts
        $popular = $obj->where('agency_id', request()->get('agency.id'))->where('client_id', request()->get('client.id'))->orderBy("views", 'desc')->limit(3)->get();
        
        // Retrieve all categories
        $categories = $category->where('agency_id', request()->get('agency.id'))->where('client_id', request()->get('client.id'))->orderBy("name", "asc")->get();
        // Retrieve all tags
        $tags = $tag->where('agency_id', request()->get('agency.id'))->where('client_id', request()->get('client.id'))->orderBy("name", "asc")->get();
        
        // Check if scheduled date is in the past. if true, change status to  1
        foreach($objs as $obj){
            if(!is_null($obj->published_at)){
                $published_at = Carbon::parse($obj->published_at);
                if($published_at->isPast()){
                    $obj->status = 1;
                    $obj->save();
                }
            }
        }
        
        // Get Settings
        $client_id = request()->get('client.id');
        $settingsfilename = 'settings/blog_settings_'.$client_id.'.json';
        if(Storage::disk("s3")->exists($settingsfilename)){
            $settings = json_decode(Storage::disk("s3")->get($settingsfilename));
        }
        else{
            // Default Settings
            $settings = json_encode(array(
                "home_layout" => "default",
                "post_layout" => "right",
                "comments" => false,
            ), JSON_PRETTY_PRINT);
            Storage::disk("s3")->put($settingsfilename, $settings);
            $settings = json_decode($settings);
        }

        // Retrieve Author data
        $author = $user->where("id", $obj->user_id)->first();
        
        // change the componentname from admin to client 
        $this->componentName = componentName('client');

        return view("apps.".$this->app.".".$this->module.".index")
                ->with("app", $this)
                ->with("objs", $objs)
                ->with("categories", $categories)
                ->with("tags", $tags)
                ->with("featured", $featured)
                ->with("popular", $popular)
                ->with("author", $author)
                ->with("settings", $settings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Obj $obj, Category $category, Tag $tag)
    {
        // Authorize the request
        $this->authorize('create', $obj);
        // Retrieve all categories
        $categories = $category->where('agency_id', request()->get('agency.id'))->where('client_id', request()->get('client.id'))->orderBy("name", "asc")->get();
        // Retrieve all tags
        $tags = $tag->where('agency_id', request()->get('agency.id'))->where('client_id', request()->get('client.id'))->orderBy("name", "asc")->get();

        return view("apps.".$this->app.".".$this->module.".createEdit")
                ->with("stub", "create")
                ->with("app", $this)
                ->with("obj", $obj)
                ->with("categories", $categories)
                ->with("tags", $tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Obj $obj, Request $request, Tag $tag)
    {
        // Authorize the request
        $this->authorize('create', $obj);

        // ddd($request->all());

        $validated = $request->validate([
            'title' => 'required|unique:posts',
            'content' => 'required|min:50',
        ]);

        // Check status and change it to boolean
        if($request->input("status")){
            if($request->input("status") == "on"){
                $request->request->add(['status' => 1]);
            }
        }
        else{
            $request->request->add(['status' => 0]);
        }
        
        // Check for when to publish
        if(!empty($request->input('published_at'))){
            $published_at = Carbon::parse($request->input('published_at'));
            if($published_at->isPast()){
                $request->merge(["status" => 1]);
            }
        }
        else{
            if($request->input('publish') == "save_as_draft"){
                $request->merge(["status" => 0]);
            } 
            else if($request->input('publish') == "preview"){
                $request->merge(["status" => 0]);
            }  
        }   

        // Check if visibility is private and that group is not empty
        if($request->visibility == "private"){
            if(empty($request->group)){
                $request->merge(["visibility" => "public"]);
            }
        }

        // Change the images from base 64 to jpg and add to request
        $content = quill_imageupload(auth()->user(), $request->content);
        $request->merge(["content" => $content]);

        // Store the records
        $obj = $obj->create($request->all() + ['client_id' => request()->get('client.id'), 'agency_id' => request()->get('agency.id'), 'user_id' => auth()->user()->id]);
        
        if($request->input('tag_ids')){
            foreach($request->input('tag_ids') as $tag_id){
                if(is_numeric($tag_id)){
                    if(!$obj->tags->contains($tag_id)){
                        $obj->tags()->attach($tag_id);
                    }
                }
                else{
                    $tag_id = $tag->new_tag($tag_id);
                    $obj->tags()->attach($tag_id);
                }
            }
        }

        // Redirect to show if preview is clicked
        if($request->input('publish') == "preview"){
            return redirect()->route($this->module.'.show', ['slug' =>  $request->input('slug')]);
        }
        

        return redirect()->route($this->module.'.list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Obj $obj, $slug, Category $category, Tag $tag, User $user)
    {
        // Retrieve specific Record
        $obj = $obj->where("slug", $slug)->with('category')->with('tags')->first()                  ;
        // change the componentname from admin to client 
        $this->componentName = componentName('client');

        // Retrieve all categories
        $categories = $category->where('agency_id', request()->get('agency.id'))->where('client_id', request()->get('client.id'))->orderBy("name", "asc")->get();
        // Retrieve all tags
        $tags = $tag->where('agency_id', request()->get('agency.id'))->where('client_id', request()->get('client.id'))->orderBy("name", "asc")->get();

        // Retrieve Author data
        $author = $user->where("id", $obj->user_id)->first();

        // Check if scheduled date is in the past. if true, change status to  1
        if(!empty($obj->published_at)){
            $published_at = Carbon::parse($obj->published_at);
            if($published_at->isPast()){
                $obj->status = 1;
                $obj->save();
            }
        }
    
        if($obj->status == 0){
            if(!(auth()->user()) || auth()->user()->role == "user"){
                return redirect()->route($this->module.'.index');
            }
        }

        
        $obj->where("slug", $slug)->update(["views" => $obj->views+1]);
        $obj = $obj->where('agency_id', request()->get('agency.id'))->where('client_id', request()->get('client.id'))->where("slug", $slug)->first();

        // Retrieve Settings
        $client_id = request()->get('client.id');
        $settingsfilename = 'settings/blog_settings_'.$client_id.'.json';
        if(Storage::disk("s3")->exists($settingsfilename)){
            $settings = json_decode(Storage::disk("s3")->get($settingsfilename));
        }
        else{
            // Default Settings
            $settings = json_encode(array(
                "home_layout" => "default",
                "post_layout" => "right",
                "comments" => false,
            ), JSON_PRETTY_PRINT);
            Storage::disk("s3")->put($settingsfilename, $settings);
            $settings = json_decode($settings);
        }

        return view("apps.".$this->app.".".$this->module.".show")
                ->with("app", $this)
                ->with("categories", $categories)
                ->with("tags", $tags)
                ->with("settings", $settings)
                ->with("author", $author)
                ->with("obj", $obj);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($slug, Obj $obj, Category $category, Tag $tag)
    {
        // Retrieve Specific record
        $obj = $obj->where('agency_id', request()->get('agency.id'))->where('client_id', request()->get('client.id'))->where("slug", $slug)->first();
        // Authorize the request
        $this->authorize('edit', $obj);
        // Retrieve all categories
        $categories = $category->where('agency_id', request()->get('agency.id'))->where('client_id', request()->get('client.id'))->get();
        // Retrieve all tags
        $tags = $tag->where('agency_id', request()->get('agency.id'))->where('client_id', request()->get('client.id'))->get();

        return view("apps.".$this->app.".".$this->module.".createEdit")
                ->with("stub", "update")
                ->with("app", $this)
                ->with("obj", $obj)
                ->with("categories", $categories)
                ->with("tags", $tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Obj $obj, $id, Tag $tag)
    {
        // load the resource
        $obj = Obj::where('id',$id)->first();
        // authorize the app
        $this->authorize('update', $obj);

        // Check status and change it to boolean
        if($request->input("status")){
            if($request->input("status") == "on"){
                $request->request->add(['status' => 1]);
            }
        }
        else{
            $request->request->add(['status' => 0]);
        }

        // Check for when to publish
        if(!empty($request->input('published_at'))){
            $published_at = Carbon::parse($request->input('published_at'));
            if($published_at->isPast()){
                $request->merge(["status" => 1]);
            }
        }
        else{
            if($request->input('publish') == "save_as_draft"){
                $request->merge(["status" => 0]);
            } 
            else if($request->input('publish') == "preview"){
                $request->merge(["status" => 0]);
            }  
        }   
        
        // Check if visibility is private and group is not empty
        if($request->visibility == "private"){
            if(empty($request->group)){
                $request->merge(["visibility" => "public"]);
            }
        }

        // Change the images from base 64 to jpg and add to request
        $content = quill_imageupload(auth()->user(), $request->content);
        $request->merge(["content" => $content]);

        // Delete Images from inside of the post if they are not in the update
        $dom1 = new \DomDocument();
        libxml_use_internal_errors(true);
        $dom1->loadHtml(mb_convert_encoding($obj->content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
        $database_images = $dom1->getElementsByTagName('img');

        $dom2 = new \DomDocument();
        libxml_use_internal_errors(true);
        $dom2->loadHtml(mb_convert_encoding($request->content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
        $request_images = $dom2->getElementsByTagName('img');

        $database_srcs = array();
        $request_srcs = array();

        foreach($database_images as $img){
            array_push($database_srcs, $img->getAttribute('src'));           
        }

        foreach($request_images as $img){
            array_push($request_srcs, $img->getAttribute('src'));           
        }

        foreach($database_srcs as $src){
            if(!in_array($src, $request_srcs)){
                $path = parse_url($src, PHP_URL_PATH);
                Storage::disk("s3")->delete($path); 
            }
        }

        // Check and delete featured image from storage if it is changed
        if(!($request->image == $obj->image)){
            Storage::disk("s3")->delete($obj->image); 
        }

        //update the resource
        $obj->update($request->all() + ['client_id' => request()->get('client.id'), 'agency_id' => request()->get('agency.id'), 'user_id' => auth()->user()->id]);

        $obj->tags()->detach();

        if($request->input('tag_ids')){
            foreach($request->input('tag_ids') as $tag_id){
                if(is_numeric($tag_id)){
                    if(!$obj->tags->contains($tag_id)){
                        $obj->tags()->attach($tag_id);
                    }
                }
                else{
                    $tag_id = $tag->new_tag($tag_id);
                    $obj->tags()->attach($tag_id);
                }
            }
        }

        // Redirect to show if preview is clicked
        if($request->input('publish') == "preview"){
            return redirect()->route($this->module.'.show', ['slug' =>  $request->input('slug')]);
        }
        
        return redirect()->route($this->module.'.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        // load the resource
        $obj = Obj::where('id',$id)->first();
        $featured_image = $obj->image;

        // Delete Images from inside of the post
        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
        $dom->loadHtml(mb_convert_encoding($obj->content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
        $images = $dom->getElementsByTagName('img');

        foreach($images as $k => $img){

            $data = $img->getAttribute('src');
            $path = parse_url($data, PHP_URL_PATH);

            $path = explode("/storage/", $path);
            Storage::disk("s3")->delete($path[1]);            
        }
        
        // Check and delete image from storage
        if(!is_null($featured_image)){
            Storage::disk("s3")->delete($featured_image);
        }
        // authorize
        $this->authorize('delete', $obj);
        // delete the resource
        $obj->delete();

        return redirect()->route($this->module.'.list');
    }

    // Search for blog posts
    public function search(Obj $obj, Request $request){
        // Get the search query
        $query = $request->input("query");

        $title_ids = $obj->where('agency_id', request()->get('agency.id'))->where('client_id', request()->get('client.id'))->where("title", "LIKE", "%".$query."%")->get("id")->pluck("id")->toArray();

        $category_ids = Category::where('agency_id', request()->get('agency.id'))->where('client_id', request()->get('client.id'))->where("name", "LIKE", "%".$query."%")->get("id")->pluck("id")->toArray();
        $category_ids = Obj::whereIn("category_id", $category_ids)->get("id")->pluck("id")->toArray();
        
        $tag_ids = Tag::where('agency_id', request()->get('agency.id'))->where('client_id', request()->get('client.id'))->where("name", "LIKE", "%".$query."%")->get("id")->pluck("id")->toArray();
        $tag_ids = Obj::whereIn("category_id", $tag_ids)->get("id")->pluck("id")->toArray();

        $post_ids = array_unique(array_merge($title_ids,$category_ids, $tag_ids), SORT_REGULAR);

        // Retrieve posts which match the given title query
        $objs = $obj->whereIn("id", $post_ids)->where('status', 1)->paginate(6);

        // change the componentname from admin to client 
        $this->componentName = componentName('client');

        return view("apps.".$this->app.".".$this->module.".search")
                ->with("app", $this)
                ->with("objs", $objs);
    }

    // List all Posts
    public function list(Request $request){
        //objects
        $obj = new Obj();
        // If search query exists
        $query = $request->input('query');
        
        // Retrieve all records
        $objs = $obj->where('agency_id', auth()->user()->agency_id)->where('client_id', auth()->user()->client_id)->where("title", "LIKE", "%".$query."%")->with('category')->with('tags')->orderBy("id", 'desc')->paginate(10);
        
        // Check if scheduled date is in the past. if true, change status to  1
        foreach($objs as $obj){
            if(!is_null($obj->published_at)){
                $published_at = Carbon::parse($obj->published_at);
                if($published_at->isPast()){
                    $obj->status = 1;
                    $obj->save();
                }
            }
        }

        return view("apps.".$this->app.".".$this->module.".posts")
                ->with("app", $this)
                ->with("objs", $objs);    
    }

    // List out all posts by a author
    public function author(Obj $obj, $id, User $user){

        // Retrieve all records
        $objs = $obj->where('agency_id', request()->get('agency.id'))->where('client_id', request()->get('client.id'))->where("user_id", $id)->with('category')->with('tags')->orderBy("id", 'desc')->paginate('12');

        $author = $user->where("id", $id)->first();

        // change the componentname from admin to client 
        $this->componentName = componentName('client');

        return view("apps.".$this->app.".".$this->module.".author")
                ->with("app", $this)
                ->with("author", $author)
                ->with("objs", $objs);    
    }


    public function addContent(Obj $obj){
        $objs = $obj->get();
        foreach($objs as $obj){
            $body = $obj->body;
            $test = '<div class=“my-4”>
                <div class="test-container listening-mini-test-1" data-container="listening-mini-test-1" ></div>
              </div>';
            $conclusion = $obj->conclusion;

            $content = $body . " " .$test . " " . $conclusion;

            $obj->update(["content" => $content]);
        }
    }

}

