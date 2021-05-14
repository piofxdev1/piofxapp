<?php

namespace App\Http\Controllers\Blog;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DB;

use App\Models\Blog\Category as Obj;
use App\Models\Blog\Post;
use App\Models\Blog\Tag;

class CategoryController extends Controller
{
    /**
     * Define the app and module object variables and component name 
     *
     */
    public function __construct(){
      // load the app, module and component name to object params
      $this->app      =   'Blog';
      $this->module   =   'Category';
      $this->componentName = componentName('agency');
    }
  
    public function index(Obj $obj, Request $request)
    {
      // If search query exists
      $query = $request->input('query');

      // Authorize the request
      $this->authorize('view', $obj);
      // Retrieve all records
      $objs = $obj->where('agency_id', request()->get('agency.id'))->where('client_id', request()->get('client.id'))->where("name", "LIKE", "%".$query."%")->orderBy("name", 'asc')->paginate(10);

      return view("apps.".$this->app.".".$this->module.".index")
              ->with("app", $this)
              ->with("objs", $objs);    
    }

    public function show($slug, Obj $obj, Post $post, Tag $tag)
    {    
      // Retrieve specific Record based on slug
      $category = $obj->where('agency_id', request()->get('agency.id'))->where('client_id', request()->get('client.id'))->where("slug", $slug)->first();
      // Get id of the particular record
      $id = $category->id;
      
      // Retrieve records based on category id
      $posts = $post->where("category_id", $id)->paginate(5);

      // Retrieve all categories
      $objs = $obj->where('agency_id', request()->get('agency.id'))->where('client_id', request()->get('client.id'))->paginate('10');
      // Retrieve all tags
      $tags = $tag->where('agency_id', request()->get('agency.id'))->where('client_id', request()->get('client.id'))->orderBy("name", 'asc')->get();
      // Featured Posts
      $featured = $post->where('agency_id', request()->get('agency.id'))->where('client_id', request()->get('client.id'))->where('featured', 'on')->orderBy("id", 'desc')->get();

      // Retrieve Popular Posts
      $popular = $post->where('agency_id', request()->get('agency.id'))->where('client_id', request()->get('client.id'))->orderBy("views", 'desc')->limit(3)->get();

      // change the componentname from admin to client 
      $this->componentName = componentName('client');
              
      return view("apps.".$this->app.".".$this->module.".show")
              ->with("app", $this)
              ->with("objs", $objs)
              ->with("category", $category)
              ->with("posts", $posts)
              ->with("tags", $tags)
              ->with("featured", $featured)
              ->with("popular", $popular);
    }

    public function create(Obj $obj)
    {
      // authorize the app
      $this->authorize('create', $obj);

      return view("apps.".$this->app.".".$this->module.".createEdit")
            ->with('stub', "create")
            ->with("app", $this)
            ->with("obj", $obj);
    }

    public function store(Request $request, Obj $obj)
    {
      // Authorize the request
      $this->authorize('create', $obj);

      // Store the records
      $obj = $obj->create($request->all() + ['client_id' => request()->get('client.id'), 'agency_id' => request()->get('agency.id'), 'user_id' => auth()->user()->id]);

      return redirect()->route($this->module.'.index');
    }

    public function edit($slug, Obj $obj)
    {
      // Retrieve Specific record
      $obj = $obj->where('agency_id', request()->get('agency.id'))->where('client_id', request()->get('client.id'))->where("slug", $slug)->first();
      // Authorize the request
      $this->authorize('edit', $obj);

      return view("apps.".$this->app.".".$this->module.".createEdit")
              ->with("stub", "update")
              ->with("app", $this)
              ->with("obj", $obj);
    }

    public function update($id, Request $request)
    {
        // load the resource
        $obj = Obj::where('id',$id)->first();
        // authorize the app
        $this->authorize('update', $obj);
        //update the resource
        $obj = $obj->update($request->all() + ['client_id' => request()->get('client.id'), 'agency_id' => request()->get('agency.id'), 'user_id' => auth()->user()->id]);
        return redirect()->route($this->module.'.index'); 
    }
    
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

        return redirect()->route($this->module.'.index');

    }

}


