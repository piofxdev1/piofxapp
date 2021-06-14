<?php

namespace App\Http\Controllers\Mailer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mailer\MailSubscriber as Obj;
use App\Models\Core\Client;
use Illuminate\Support\Facades\Auth;

class MailSubscriberController extends Controller
{
    public function __construct(){
        // load the app, module and component name to object params
        $this->app      =   'Mailer';
        $this->module   =   'MailSubscriber';
        $this->componentName = componentName('agency');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Obj $obj,Request $request)
    {   
        

        if($request->input('item'))
        {
            // check for search string
            $query = $request->input('item');
            //ddd($query);
            $objs = $obj->where("email", "LIKE", "%".$query."%")->orderBy('email', 'asc')->get(); 
        }
        else
        {
            $objs = $obj->all();
        }
        // load alerts if any
        $alert = session()->get('alert');

        // authorize the app
        $this->authorize('view', $obj);
        
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

        // load alerts if any
        $alert = session()->get('alert');

        return view('apps.'.$this->app.'.'.$this->module.'.createedit')
                ->with('stub','create')
                ->with('obj',$obj)
                ->with('alert',$alert)
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
        $subscriber = $obj->where('email', '=', $request->email)->first();
        if ($subscriber === null)
        {   
            //ddd($subscriber);
            $validate_email = debounce_valid_email($request->email);
            $request->merge(['agency_id'=>$request->agency_id])->merge(['client_id'=>$request->client_id])->merge(['valid_email'=>$validate_email]);
            $obj = $obj->create($request->all());
            $alert = 'A new ('.$this->app.'/'.$this->module.') item is created!';
            return redirect()->route($this->module.'.index')
                             ->with('alert',$alert);
        }

        else
        {
            $alert = 'Email Already Exists!';
            
            return view('apps.'.$this->app.'.'.$this->module.'.createedit')
                    ->with('stub','create')
                    ->with('obj',$obj)
                    ->with('app',$this)
                    ->with('alert',$alert);
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
        $this->authorize('edit', $obj);

        // load alerts if any
        $alert = session()->get('alert');


        if($obj)
            return view('apps.'.$this->app.'.'.$this->module.'.createedit')
                ->with('stub','update')
                ->with('obj',$obj)
                ->with('app',$this)
                ->with('alert',$alert);

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
        // load the resource
        $obj = Obj::where('id',$id)->first();

        // authorize the app
        $this->authorize('update', $obj);

        //update the resource
        $obj->update($request->all());

        // flash message and redirect to controller index page
        $alert = 'A new ('.$this->app.'/'.$this->module.'/'.$id.') item is updated!';
       
        //ddd($obj->template_category_id);
        return redirect()->route($this->module.'.index')->with('alert',$alert);
    }

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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        // load the resource
        $obj = Obj::where('id',$id)->first();

        // authorize the app
        $this->authorize('delete', $obj);

        // delete the resource
        $obj->delete();

        // flash message and redirect to controller index page
        $alert = '('.$this->app.'/'.$this->module.'/'.$id.') item  Successfully deleted!';
        return redirect()->route($this->module.'.index')->with('alert',$alert);
    }

    public function upload(Obj $obj, Request $request)
    {    
        // authorize the app
        $this->authorize('upload', $obj); 

        if($file = $request->file('file'))
        {
   
            // File Details 
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();

            // Valid File Extensions
            $valid_extension = array("csv");

            // 2MB in Bytes
            $maxFileSize = 2097152; 

            // Check file extension
            if(in_array(strtolower($extension),$valid_extension))
            {

                    // Check file size
                if($fileSize <= $maxFileSize)
                {
                    // File upload location
                    $location = 'uploads';
                    // Upload file
                    $file->move($location,$filename);
                    // Import CSV to Database
                    $filepath = public_path($location."/".$filename);
                    // Reading file
                    $file = fopen($filepath,"r");
                    $importData_arr = array();
                    $i = 0;
                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE)
                    {
                        $num = count($filedata );
                        // Skip first row
                        if($i == 0){
                            $i++;
                            continue; 
                        }
                        for ($c=0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata [$c];
                        }
                        $i++;
                    }
                    fclose($file);
                    //unset($importData_arr[0]);
                    foreach($importData_arr as $importData)
                    {   
                        $subscriber = $obj->where('email', '=', $importData[0])->first();
                        if ($subscriber === null)
                        {
                        $validate_email = debounce_valid_email($importData[0]);
                        $objs = $obj->create(['email' => $importData[0],'info' => $importData[1],'status' => 1 ,'valid_email' => $validate_email,'client_id' => $request->client_id, 'agency_id' => $request->agency_id]);
                        }
                        else
                        {
                            continue;
                        }
                    }
                    $alert = '('.$this->app.'/'.$this->module.') Imported Successfully ';
                }
                else
                {
                $alert = '('.$this->app.'/'.$this->module.') File too large. File must be less than 2MB. ';
                }

            }

        }
        else
        {
            $alert = '('.$this->app.'/'.$this->module.') Select a File ';
        }

        $objs = $obj->all();

        return redirect()->route($this->module.'.index')->with('alert',$alert);

    }
    
    public function createcsv(Obj $obj, Request $request)
    {
        // authorize the app
        $this->authorize('createcsv', $obj);

        $headers = array("email","info");
        $data = array(
            array(
                "email" => "sabiha@gmail.com",
                "info"  => "2587413698,btech,tkr",
            ),
            array(
                "email" => "piofx@gmail.com",
                "info"  => "2587413698,btech,tkr",
            ),
            array(
                "email" => "*************************",
                "info"  => "***********************End Of The File****************************************",
            ),
            array(
                "email" => "*************************",
                "info"  => "***********************Ignore The Below Data**********************************",
            ),

        );
        $new_csv = fopen('report.csv', 'w');
        fputcsv($new_csv, $headers);
        foreach($data as $fields)
        {
            fputcsv($new_csv,$fields);
        }
        fclose($new_csv);

        // output headers so that the file is downloaded rather than displayed
        header("Content-type: text/csv");
        header("Content-disposition: attachment; filename = report.csv");
        header('Pragma: no-cache');
        readfile("report.csv");
    }


}