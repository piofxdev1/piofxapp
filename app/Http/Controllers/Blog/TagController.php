<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Blog\Tag as Obj;
use App\Models\Blog\Post;
use App\Models\Blog\Category;


class TagController extends Controller
{
    
    /**
     * Define the app and module object variables and component name 
     *
     */
    public function __construct(){
        // load the app, module and component name to object params
        $this->app      =   'Blog';
        $this->module   =   'Tag';
        $this->componentName = componentName('agency');
    }
    
    public function index(Obj $obj)
    {
        // Authorize the request
        $this->authorize('view', $obj);
        // Retrieve all records
        $objs = $obj->getRecords();

        return view("apps.".$this->app.".".$this->module.".index")
                ->with("app", $this)
                ->with("objs", $objs);    
    }

    public function show($slug, Obj $obj, Post $post, Category $category)
    {    
        // Retrieve specific Record based on slug
        $obj = $obj->getRecord($slug);
        // Retrieve that tag name
        $tag = $obj->name;
        // Retrieve records for that particular tag
        $posts = $obj->posts()->simplePaginate(5);

        // Retrieve all tags
        $objs = $obj->getRecords();
        // Retrieve all categories
        $categories = $category->getRecords();
                
        // change the componentname from admin to client 
        $this->componentName = componentName('client');

        return view("apps.".$this->app.".".$this->module.".show")
                ->with("app", $this)
                ->with("objs", $objs)
                ->with("tag", $tag)
                ->with("posts", $posts)
                ->with("categories", $categories);
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
        $obj = $obj->getRecord($slug);

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
        $obj = $obj->update($request->all());

        return redirect()->route($this->module.'.index'); 
    }
    
    public function destroy($id)
    {
        // load the resource
        $obj = Obj::where('id',$id)->first();
        // authorize
        $this->authorize('delete', $obj);
        // delete the resource
        $obj->delete();

        return redirect()->route($this->module.'.index');
    }

}
