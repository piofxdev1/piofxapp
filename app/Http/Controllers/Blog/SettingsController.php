<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class SettingsController extends Controller
{

    /**
     * Define the app and module object variables and component name 
     *
     */
    public function __construct(){
        // load the app, module and component name to object params
        $this->app      =   'Blog';
        $this->module   =   'Settings';
        $this->componentName = componentName('agency');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //client id
        $client_id = request()->get('client.id');
        $settingsfilename = 'settings/blog_settings_'.$client_id.'.json';
        if(Storage::disk("s3")->exists($settingsfilename)){
            $settings = Storage::disk("s3")->get($settingsfilename);
        }
        else{
            // Default Settings
            $settings = json_encode(array(
                "container_layout" => "right",
                "comments" => false,
            ), JSON_PRETTY_PRINT);
            // ddd($settings);
            Storage::disk("s3")->put($settingsfilename, $settings);
        }

        return view("apps.".$this->app.".".$this->module.".index")
                ->with("app", $this)
                ->with("settings", $settings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $settings = Storage::disk("s3")->get("settings/blog_settings.json");

        return view("apps.".$this->app.".".$this->module.".createedit")
                ->with("app", $this)
                ->with("settings", $settings);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $settings = $request->input('settings');
        // ddd($settings);

        Storage::disk("s3")->put("settings/blog_settings.json", $settings);

        return redirect()->route($this->module.'.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
