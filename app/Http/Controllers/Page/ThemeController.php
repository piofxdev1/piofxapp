<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page\Theme as Obj;
use App\Models\Page\Page;
use App\Models\Page\Module;
use App\Models\Page\Asset;

use App\Models\Core\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use File;
use ZipArchive;
use Illuminate\Support\Facades\Storage;

class ThemeController extends Controller
{
     /**
     * Define the app and module object variables and component name 
     *
     */
    public function __construct(){
        // load the app, module and component name to object params
        $this->id       =   request()->route('theme');
        $this->app      =   'Page';
        $this->module   =   'Theme';
        $this->componentName = componentName('agency');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Obj $obj,Request $request)
    {

        // check for search string
        $item = $request->item;
        // load alerts if any
        $alert = session()->get('alert');


        // authorize the app
        $this->authorize('viewAny', $obj);
        //load user for personal listing
        $user = Auth::user();
        // retrive the listing
        $objs = $obj->getRecords($item,30,$user);

        //current theme
        $this->current_theme_id = $obj->getCurrentThemeID();


        return view('apps.'.$this->app.'.'.$this->module.'.index')
                ->with('app',$this)
                ->with('alert',$alert)
                ->with('objs',$objs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Obj $obj)
    {
    	
        // authorize the app
        $this->authorize('create', $obj);
        // get the clients
        $clients = Client::where('id',request()->get('client.id'))->get();


        return view('apps.'.$this->app.'.'.$this->module.'.createedit')
                ->with('stub','Create')
                ->with('obj',$obj)
                ->with('clients',$clients)
                ->with('editor',true)
                ->with('app',$this);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Obj $obj,Request $request)
    {
        try{
            
            /* create a new entry */
            $obj = $obj->create($request->all());

            /*update current theme */
            $obj->updateCurrentTheme();

            //reload cache and session data
            $obj->refreshCache();

            $alert = 'A new ('.$this->app.'/'.$this->module.') item is created!';
            return redirect()->route($this->module.'.index')->with('alert',$alert);
        }
        catch (QueryException $e){
           $error_code = $e->errorInfo[1];
            if($error_code == 1062){
                $alert = 'Some error in updating the record';
                return redirect()->back()->withInput()->with('alert',$alert);
            }
        }
    }

    /**
     * Download the theme to developer mode
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function devmode($id,Request $r){

        //dump the theme data
        $obj = Obj::where('id',$id)->first();
        $filename = 'theme_'.$obj->slug.'.json';
        Storage::disk('public')->put('devmode/'.$id.'/data/'.$filename, json_encode($obj,JSON_PRETTY_PRINT));
        Storage::disk('public')->put('devmode/'.$id.'/code/settings/'.$filename, json_encode(json_decode($obj->settings),JSON_PRETTY_PRINT));



        //dump the pages
        $pages = Page::where('theme_id',$id)->get();
        foreach($pages as $page){
            if($page->slug=='/'){
                $filename = 'page_root.json';
                $codefilename = 'root.php';
            }
            else{
                $filename = 'page_'.$page->slug.'.json';
                $codefilename = $page->slug.'.php';
            }
            //json data file    
            Storage::disk('public')->put('devmode/'.$id.'/data/'.$filename, json_encode($page,JSON_PRETTY_PRINT)); 
            //html code file
            Storage::disk('public')->put('devmode/'.$id.'/code/pages/'.$codefilename, $page->html); 
            //settings code file
            Storage::disk('public')->put('devmode/'.$id.'/code/settings/'.$filename, json_encode(json_decode($page->settings),JSON_PRETTY_PRINT)); 
        }

        //dump the modules
        $modules = Module::where('theme_id',$id)->get();
        foreach($modules as $module){
            $filename = 'module_'.$module->slug.'.json';
            $codefilename = $module->slug.'.php';
            //json data file    
            Storage::disk('public')->put('devmode/'.$id.'/data/'.$filename, json_encode($module,JSON_PRETTY_PRINT)); 
            //html code file
            Storage::disk('public')->put('devmode/'.$id.'/code/modules/'.$codefilename, $module->html); 
            //settings code file
            Storage::disk('public')->put('devmode/'.$id.'/code/settings/'.$filename, json_encode(json_decode($module->settings),JSON_PRETTY_PRINT)); 
      
        }

        //dump the assets
        $assets = Asset::where('theme_id',$id)->get();
        foreach($assets as $asset){
            $filename = 'asset_'.$asset->slug.'.json';
            Storage::disk('public')->put('devmode/'.$id.'/data/'.$filename, json_encode($asset,JSON_PRETTY_PRINT)); 

            $fname = $asset->slug;
            //filename
            if (strpos($fname, 'file_') !== false) {
            }else
                $fname = 'file_'.$fname;

            //download files also
            if(Storage::disk('s3')->exists('themes/'.$id.'/'.$fname)){
               $f = Storage::disk('s3')->get('themes/'.$id.'/'.$fname);
                Storage::disk('public')->put('devmode/'.$id.'/data/'.$fname, $f);  
                //asset file
                Storage::disk('public')->put('devmode/'.$id.'/code/assets/'.$asset->type.'/'.$fname, $f); 

            }
            
        }

        $alert = 'Theme developer mode activated!';
        return redirect()->route('Theme.show',$id)->with('alert',$alert);
    }

     /**
     * Download the theme to developer mode
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function devmodezip($id,Request $r){

        $alert = 'Request params are required!';
        if($r->get('code')){
            $obj = Obj::where('id',$id)->first();
            //dump the theme data
            $filename = 'theme_'.$obj->slug.'.json';
            $obj->settings = Storage::disk('public')->get('devmode/'.$id.'/code/settings/'.$filename);
            Storage::disk('public')->put('devmode/'.$id.'/data/'.$filename, json_encode($obj,JSON_PRETTY_PRINT));
            $obj->save();
            $alert = 'Theme code pushed to database!';
        }


        //scan the directory, upload to s3 and update db tables
        if($r->get('s3')){
            $path = '../storage/app/public/devmode/'.$id.'/code/assets/';
            $scan = scandir($path);
            foreach($scan as $folder) {
               if (is_dir($path."/$folder") && $folder!='.' && $folder!='..') {
                    $subpath = '../storage/app/public/devmode/'.$id.'/code/assets/'.$folder.'/';
                    $subscan = scandir($subpath);
                    foreach($subscan as $file) {
                        if (!is_dir($path."/$file") && $file!='.' && $file!='..') {
                            //upload to s3
                            $f = Storage::disk('public')->path('devmode/'.$id.'/code/assets/'.$folder.'/'.$file);
                            $p = Storage::disk('s3')->putFileAs('themes/'.$id,$f,$file,'public');

                            $slug = str_replace('file_','',$file);
                            $a = Asset::where('theme_id',$id)->where('slug',$slug)->first();
                            if(!$a){
                                $a->path = $p;
                                $a->type = $folder;
                                $a->user_id = Auth::user()->id;
                                $a->theme_id = $id;
                                $a->client_id = $r->get('client.id');
                                $a->agency_id = $r->get('agency.id');
                                $a->save();

                            }else{
                                $a = new Asset();
                                $a->name = $file;
                                $a->slug = $slug;
                                $a->path = $p;
                                $a->type = $folder;
                                $a->user_id = Auth::user()->id;
                                $a->theme_id = $id;
                                $a->client_id = $r->get('client.id');
                                $a->agency_id = $r->get('agency.id');
                                $a->status = 1;
                                $a->save();
                            }

                            //save the json file
                            $assetfilename = 'asset_'.$a->slug.'.json';
                            Storage::disk('public')->put('devmode/'.$id.'/data/'.$filename, json_encode($a,JSON_PRETTY_PRINT)); 
                            
                        }
                    }
               }
            }

            $alert = 'Assets pushed to s3';
        }

        if($r->get('code')){
            //load the settings json files
            $path = '../storage/app/public/devmode/'.$id.'/code/settings/';
            $settings = [];
            $scan = scandir($path);
            foreach($scan as $file) {
               if (!is_dir($path."/$file") && $file!='.' && $file!='..') {
                $pieces = explode('_',$file);
                $settingfileslug = str_replace('.json','',$pieces[1]);
                if($settingfileslug=='+')
                    $settingfileslug = 'plus';
                $data = file_get_contents(Storage::disk('public')->path('devmode/'.$id.'/code/settings/'.$file));
                $settings[$pieces[0]][$settingfileslug] = json_encode(json_decode($data));  
              
               }
            }

            //scan the directory of modules, update the jsonfiles and update db tables
            $path = '../storage/app/public/devmode/'.$id.'/code/modules/';
            $scan = scandir($path);
            foreach($scan as $file) {
               if (!is_dir($path."/$file") && $file!='.' && $file!='..') {
                    $slug = str_replace('.php','',$file);
                    $data = file_get_contents(Storage::disk('public')->path('devmode/'.$id.'/code/modules/'.$file));
                    $m = Module::where('theme_id',$id)->where('slug',$slug)->first();

                    if($m){
                        $m->html = $data;
                        $m->html_minified = $m->minifyHtml($m->processPageModuleHtmlLocal($id,null,$data,$settings['module'][$slug]));
                        $m->settings = $settings['module'][$slug];
                        $m->admin = 0;
                        $m->user_id = Auth::user()->id;
                        $m->theme_id = $id;
                        $m->client_id = $r->get('client.id');
                        $m->agency_id = $r->get('agency.id');
                        $m->status = 1;
                        $m->save();
                    }else{
                        $m = new Module();
                        $m->name = $slug;
                        $m->slug = $slug;
                        $m->html = $data;
                        $m->html_minified = $m->minifyHtml($m->processPageModuleHtmlLocal($id,null,$data,$settings['module'][$slug]));
                        $m->settings = $settings['module'][$slug];
                        $m->admin = 0;
                        $m->user_id = Auth::user()->id;
                        $m->theme_id = $id;
                        $m->client_id = $r->get('client.id');
                        $m->agency_id = $r->get('agency.id');
                        $m->status = 1;
                        $m->save();
                    }

                    //save the json file
                    $modulefilename = 'module_'.$m->slug.'.json';
                    Storage::disk('public')->put('devmode/'.$id.'/data/'.$filename, json_encode($m,JSON_PRETTY_PRINT)); 
                     
                  
               }
            }


            //scan the directory of pages, update the jsonfiles and update db tables
            $path = '../storage/app/public/devmode/'.$id.'/code/pages/';
            $scan = scandir($path);
            foreach($scan as $file) {
               if (!is_dir($path."/$file") && $file!='.' && $file!='..') {
                    $slug = str_replace('.php','',$file);
                    $slugr = $slug;
                    if($slug=='root'){
                        $slug = '/';
                    }
                    if($slug=='+'){
                        $slugr='plus';
                    }
                    $data = file_get_contents(Storage::disk('public')->path('devmode/'.$id.'/code/pages/'.$file));
                    $p = Page::where('theme_id',$id)->where('slug',$slug)->first();
                    if($p){
                        $p->html = $data;

                        $p->html_minified = $p->minifyHtml($m->processPageModuleHtmlLocal($id,$settings['page'][$slugr],$data,$settings['page'][$slugr]));
                        $p->settings = $settings['page'][$slugr];
                        $p->admin = 0;
                        $p->user_id = Auth::user()->id;
                        $p->theme_id = $id;
                        $p->client_id = $r->get('client.id');
                        $p->agency_id = $r->get('agency.id');
                        $p->status = 1;
                        $p->save();

                    }else{
                        $p = new Page();
                        $p->name = $slug;
                        $p->slug = $slug;
                        $p->html = $data;
                        $p->html_minified = $p->minifyHtml($m->processPageModuleHtmlLocal($id,$settings['page'][$slugr],$data,$settings['page'][$slugr]));
                        $p->settings = $settings['page'][$slugr];
                        $p->admin = 0;
                        $p->user_id = Auth::user()->id;
                        $p->theme_id = $id;
                        $p->client_id = $r->get('client.id');
                        $p->agency_id = $r->get('agency.id');
                        $p->status = 1;
                        $p->save();
                    }

                    //save the json file
                    $pagefilename = 'page_'.$p->slug.'.json';
                    Storage::disk('public')->put('devmode/'.$id.'/data/'.$filename, json_encode($p,JSON_PRETTY_PRINT)); 
               }
            }

        }


        

        //download zip 
        if($r->get('zip')){
            $zip = new ZipArchive;
            $fileName = 'theme_'.$obj->slug.'.zip';
       
            if ($zip->open(storage_path($fileName), ZipArchive::CREATE) === TRUE)
            {
                //add data to zip
                $files = File::files(storage_path('app/public/devmode/'.$id.'/data/'));
                foreach ($files as $key => $value) {
                    $relativeNameInZipFile = basename($value);
                    $zip->addFile($value, $relativeNameInZipFile);
                }
                 
                $zip->close();
            }
            return response()->download(storage_path($fileName));  
        }
       
        
        return redirect()->route('Theme.show',$id)->with('alert',$alert);
    }


    /**
     * Download the theme
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function download($id,Request $r){
        

        //dump the theme data
        $obj = Obj::where('id',$id)->first();
        $filename = 'theme_'.$obj->slug.'.json';
        Storage::disk('private')->put('themes/'.$id.'/'.$filename, json_encode($obj,JSON_PRETTY_PRINT));

        //dump the pages
        $pages = Page::where('theme_id',$id)->get();
        foreach($pages as $page){
            if($page->slug=='/')
                $filename = 'page_root.json';
            else
                $filename = 'page_'.$page->slug.'.json';
            Storage::disk('private')->put('themes/'.$id.'/'.$filename, json_encode($page,JSON_PRETTY_PRINT)); 
        }

        //dump the modules
        $modules = Module::where('theme_id',$id)->get();
        foreach($modules as $module){
            $filename = 'module_'.$module->slug.'.json';
            Storage::disk('private')->put('themes/'.$id.'/'.$filename, json_encode($module,JSON_PRETTY_PRINT)); 
        }

        //dump the assets
        $assets = Asset::where('theme_id',$id)->get();
        foreach($assets as $asset){
            $filename = 'asset_'.$asset->slug.'.json';
            Storage::disk('private')->put('themes/'.$id.'/'.$filename, json_encode($asset,JSON_PRETTY_PRINT)); 

            $fname = $asset->slug;
            //filename
            if (strpos($fname, 'file_') !== false) {
            }else
                $fname = 'file_'.$fname;

            //download files also
            if(Storage::disk('s3')->exists('themes/'.$id.'/'.$fname)){
               $f = Storage::disk('s3')->get('themes/'.$id.'/'.$fname);
                Storage::disk('private')->put('themes/'.$id.'/'.$fname, $f);  
            }
            
        }




        //download assets
        $zip = new ZipArchive;
        
   
        $fileName = 'theme_'.$obj->slug.'.zip';
   
        if ($zip->open(storage_path($fileName), ZipArchive::CREATE) === TRUE)
        {
            //assets
            // $files = File::files(storage_path('app/public/themes/'.$id));
            // foreach ($files as $key => $value) {
            //     $relativeNameInZipFile = basename($value);
            //     $zip->addFile($value, $relativeNameInZipFile);
            // }

            //sql data
            $files = File::files(storage_path('app/private/themes/'.$id));
            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }
             
            $zip->close();
        }
    
        return response()->download(storage_path($fileName));
    }

    /**
     * Upload the theme
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Obj $obj,Request $request){
        $file      = $request->all()['file'];
        $extension = strtolower($file->getClientOriginalExtension());
        $fname = $file->getClientOriginalName();
        $client_id = $request->get('client_id');
        
        //restrict only zip files
        if(!in_array($extension, ['zip']))
        {
            $alert = 'You are allowed to upload only zip file';
            return redirect()->back()->withInput()->with('alert',$alert);

        }

        $filename = 'zip_'.$client_id.'_'.$fname;

        $path = Storage::disk('public')->putFileAs('zips/'.$client_id, $request->file('file'),$filename,'public');
      
        $zip = new ZipArchive; 
  
        // Zip File Name 
        if ($zip->open(storage_path('app/public/'.$path)) === TRUE) { 
          

            // Unzip Path 
            $zip->extractTo(storage_path('app/private/extracts/'.$filename)); 
            $zip->close(); 
            echo 'Unzipped Process Successful!'; 

            $dir = storage_path('app/private/extracts').'/'.$filename;

            $extractToPath = 'extracts/'.$filename;



            // Open a directory, and read its contents
            if (is_dir($dir)){
              if ($dh = opendir($dir)){
                //identify  thee theme
                while (($file = readdir($dh)) !== false){
                    echo $file.' <br>';
                    if($file !='..' && $file !='.' && $file!='__MACOSX'){
                       $filename = $file;
                       $theme = $obj->identifyTheme($obj,$dir,$filename);

                       if($theme)
                        break;
                    } 
                }

                closedir($dh);
              }

              if ($d = opendir($dir)){
                //identify  thee theme
                 while (($f = readdir($d)) !== false){
                    echo $f.' -- <br>';
                    if($f !='..' && $f !='.' && $f!='__MACOSX'){
                        $filename = $f;
                       $obj->processFile($theme,$dir,$filename,$extractToPath);
                    
                    }
                }

                closedir($d);
              }

             //ddd('here');
                
            }
            $theme->processHtml();
            
            // flash message and redirect to controller index page
            $alert = 'Theme ('.$theme->name.') is uploaded';

        } else { 
            // flash message and redirect to controller index page
            $alert = 'Theme upload failed';
        } 


        return redirect()->route($this->module.'.index')->with('alert',$alert);

    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function library(Obj $obj)
    {
        // load the resource
        $objs = Obj::where('admin',1)->paginate(30);

        // load alerts if any
        $alert = session()->get('alert');

         // authorize the app
        $this->authorize('viewAny', $obj);
        

        if($objs)
            return view('apps.'.$this->app.'.'.$this->module.'.library')
                    ->with('objs',$objs)
                    ->with('app',$this)->with('alert',$alert);
        else
            abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // load the resource
        $obj = Obj::where('id',$id)->first();
        // load alerts if any
        $alert = session()->get('alert');
        // authorize the app
        $this->authorize('view', $obj);

        //save settings if any
        $obj->saveSettings();

        //load settings
        $settings = json_decode($obj->settings);
        

        if($obj)
            return view('apps.'.$this->app.'.'.$this->module.'.show')
                    ->with('settings',$settings)->with('obj',$obj)->with('app',$this)->with('alert',$alert);
        else
            abort(404);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function preview($id)
    {
        // load the resource
        $obj = Obj::where('id',$id)->first();
        // authorize the app
        $this->authorize('view', $obj);

        $page = Page::where('theme_id',$obj->id)->where('slug','/')->first();

        if($page)
            return redirect()->route('Page.theme',[$id,$page->id]);
        else{
            $page = Page::where('theme_id',$obj->id)->first();

            if($page)
                return redirect()->route('Page.theme',[$id,$page->id]);
            else
                abort('404','No preview pages found');
        }
        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // load the resource
        $obj = Obj::where('id',$id)->first();
        // authorize the app
        $this->authorize('view', $obj);
        // get the clients
        $clients = Client::where('id',request()->get('client.id'))->get();

        if($obj)
            return view('apps.'.$this->app.'.'.$this->module.'.createedit')
                ->with('stub','Update')
                ->with('obj',$obj)
                ->with('clients',$clients)
                ->with('editor',true)
                ->with('app',$this);
        else
            abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            
            // load the resource
            $obj = Obj::where('id',$id)->first();
            // authorize the app
            $this->authorize('update', $obj);
            //update the resource
            $obj->update($request->all()); 

            /*update current theme */
            $obj->updateCurrentTheme();

            $obj->settings = json_encode(json_decode($obj->settings),JSON_PRETTY_PRINT);
            $obj->save();
            //reload cache and session data
            $obj->refreshCache();


            // flash message and redirect to controller index page
            $alert = 'A new ('.$this->app.'/'.$this->module.'/'.$id.') item is updated!';
            return redirect()->route($this->module.'.show',$id)->with('alert',$alert);
        }
        catch (QueryException $e){
           $error_code = $e->errorInfo[1];
            if($error_code == 1062){
                 $alert = 'Some error in updating the record';
                 return redirect()->back()->withInput()->with('alert',$alert);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // load the resource
        $obj = Obj::where('id',$id)->first();
        // authorize
        $this->authorize('update', $obj);
        // delete the resource
        $obj->delete();

        // flash message and redirect to controller index page
        $alert = '('.$this->app.'/'.$this->module.'/'.$id.') item  Successfully deleted!';
        return redirect()->route($this->module.'.index')->with('alert',$alert);
    }
}
