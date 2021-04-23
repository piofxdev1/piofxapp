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
    public function index(Obj $obj, Category $category, Tag $tag)
    {
        // Retrieve all posts
        $objs = $obj->where('agency_id', request()->get('agency.id'))->where('client_id', request()->get('client.id'))->orderBy("id", 'desc')->paginate('5');
        $featured = $obj->where('agency_id', request()->get('agency.id'))->where('client_id', request()->get('client.id'))->where('featured', 'on')->orderBy("id", 'desc')->get();
        // Retrieve all categories
        $categories = $category->getRecords();
        // Retrieve all tags
        $tags = $tag->getRecords();

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

        // change the componentname from admin to client 
        $this->componentName = componentName('client');

        return view("apps.".$this->app.".".$this->module.".index")
                ->with("app", $this)
                ->with("objs", $objs)
                ->with("categories", $categories)
                ->with("tags", $tags)
                ->with("featured", $featured);
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
        $categories = $category->getRecords();
        // Retrieve all tags
        $tags = $tag->getRecords();

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
        $obj = $obj->getRecord($slug);
        // change the componentname from admin to client 
        $this->componentName = componentName('client');

        // Retrieve all categories
        $categories = $category->getRecords();
        // Retrieve all tags
        $tags = $tag->getRecords();

        // Retrieve User data
        $user = $user->where("id", $obj->id)->first();

        // Check if scheduled date is in the past. if true, change status to  1
        if(!empty($obj->published_at)){
            $published_at = Carbon::parse($obj->published_at);
            if($published_at->isPast()){
                $obj->status = 1;
                $obj->save();
            }
        }
    
        if($obj->status == 0){
            if(auth()->user()->role == "user"){
                return redirect()->route($this->module.'.index');
            }
        }

        // Retrieve Blog Settings
        $settings = json_decode(Storage::disk("public")->get("settings/blog_settings.json"));

        return view("apps.".$this->app.".".$this->module.".show")
                ->with("app", $this)
                ->with("categories", $categories)
                ->with("tags", $tags)
                ->with("settings", $settings)
                ->with("user", $user)
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
        $obj = $obj->getRecord($slug);
        // Authorize the request
        $this->authorize('edit', $obj);
        // Retrieve all categories
        $categories = $category->getRecords();
        // Retrieve all tags
        $tags = $tag->getRecords();

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
        $img = $obj->image;

        // Check and delete image from storage
        if(!is_null($img)){
            Storage::delete($img_name);
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

        // Retrieve posts which match the given title query
        $objs = $obj->where('agency_id', request()->get('agency.id'))->where('client_id', request()->get('client.id'))->where("title", "LIKE", "%".$query."%")->where('status', 1)->simplePaginate(5);

        // change the componentname from admin to client 
        $this->componentName = componentName('client');

        return view("apps.".$this->app.".".$this->module.".search")
                ->with("app", $this)
                ->with("objs", $objs);
    }

    // List all Posts
    public function list(Obj $obj){
        // Retrieve all records
        $objs = $obj->where('agency_id', request()->get('agency.id'))->where('client_id', request()->get('client.id'))->with('category')->with('tags')->orderBy("id", 'desc')->paginate('10');
        
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
    public function author(Obj $obj, $name){

    }
}
