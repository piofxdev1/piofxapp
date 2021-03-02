<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Core\Contact as Obj;
use App\Models\Core\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
     /**
     * Define the app and module object variables and component name 
     *
     */
    public function __construct(){
        // load the app, module and component name to object params
        $this->app      =   'Core';
        $this->module   =   'Contact';
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
        //get the status filter
        $status = $request->status;
        // load alerts if any
        $alert = session()->get('alert');
        //client id
        $client_id = request()->get('client.id');


        // authorize the app
        $this->authorize('viewAny', $obj);
        //load user for personal listing
        $user = Auth::user();
        // retrive the listing
        $objs = $obj->getRecords($item,30,$user,$status);

        $data = $obj->getData($item,30,$user,$status);

        $users = Auth::user()->where('client_id',$client_id)->get();

        return view('apps.'.$this->app.'.'.$this->module.'.index')
                ->with('app',$this)
                ->with('alert',$alert)
                ->with('users',$users)
                ->with('data',$data)
                ->with('objs',$objs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Obj $obj)
    {
        // load alerts if any
        $alert = session()->get('alert');
        $this->componentName = componentName('client');


        $client_id = request()->get('client.id');
        $form = null;
        if(Storage::disk('s3')->exists('settings/contact/'.$client_id.'.json' )){
            $data = json_decode(json_decode(Storage::disk('s3')->get('settings/contact/'.$client_id.'.json' ),true));
            $form = explode(',',$data->form);
            
        }
        else
            $data = '';
        

        return view('apps.'.$this->app.'.'.$this->module.'.createedit')
                ->with('stub','Create')
                ->with('obj',$obj)
                ->with('form',$form)
                ->with('alert',$alert)
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

            $data = '';
            foreach($request->all() as $k=>$v){
                if (strpos($k, 'settings_') !== false){
                    $pieces = explode('settings_',$k);
                    $data = $data.$pieces[1].' : '.$v.'<br>';
                    //$data[$pieces[1]] = $v;
                }
            }
            $request->merge(['message' => $data]);

            $obj = $obj->create($request->all());


            $alert = 'Thank you! Your message has been posted to the Admin team. We will reach out to you soon.';
            return redirect()->back()->with('alert',$alert);
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

        

        if($obj)
            return view('apps.'.$this->app.'.'.$this->module.'.show')
                    ->with('obj',$obj)->with('app',$this)->with('alert',$alert);
        else
            abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function settings()
    {

        $client_id = request()->get('client.id');
         // load alerts if any
        $alert = session()->get('alert');

        $data = null;
        if(request()->get('store')){
            $data = str_replace(array("\n", "\r"), '', request()->get('settings'));
            
            Storage::disk('s3')->put('settings/contact/'.$client_id.'.json' ,json_encode($data,JSON_PRETTY_PRINT),'public');
            $alert = 'Successfully saved the settings file';

        }else{
            if(Storage::disk('s3')->exists('settings/contact/'.$client_id.'.json' ))
            $data = json_decode(Storage::disk('s3')->get('settings/contact/'.$client_id.'.json' ));
            else
                $data = '';
        }

        
        

        if($client_id)
            return view('apps.'.$this->app.'.'.$this->module.'.settings')
                ->with('stub','Update')
                ->with('data',$data)
                ->with('alert',$alert)
                ->with('editor',true)
                ->with('app',$this);
        else
            abort(404);
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
        // load alerts if any
        $alert = session()->get('alert');
        // authorize the app
        $this->authorize('view', $obj);
        

        if($obj)
            return view('apps.'.$this->app.'.'.$this->module.'.createedit')
                ->with('stub','Update')
                ->with('obj',$obj)
                ->with('alert',$alert)
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
