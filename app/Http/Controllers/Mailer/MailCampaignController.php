<?php

namespace App\Http\Controllers\Mailer;
use App\Jobs\SendEmail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mailer\MailCampaign as Obj;
use App\Models\Mailer\MailTemplate;
use App\Models\Mailer\MailLog;
use App\Models\Core\Client;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MailCampaignController extends Controller
{
    public function __construct(){
        // load the app, module and component name to object params
        $this->app      =   'Mailer';
        $this->module   =   'MailCampaign';
        $this->componentName = componentName('agency');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Obj $obj,Request $request)
    {   
        if($request->input('query'))
        {
            // check for search string
            $query = $request->input('query');
            //ddd($query);
            $objs = $obj->where("name", "LIKE", "%".$query."%")->orderBy('name', 'asc')->get(); 
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

        $templates = MailTemplate::all();
        
        return view('apps.'.$this->app.'.'.$this->module.'.createedit')
                ->with('stub','create')
                ->with('obj',$obj)
                ->with('alert',$alert)
                ->with('app',$this)
                ->with('templates',$templates);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Obj $obj,Request $request)
    {       
        
        //ddd($request->all());
        $time = $request->input('timezone');
        $scheduled = Carbon::parse($request->input('scheduled_at'))->addMinutes($time);
        $current = Carbon::now();
        $diff_in_minutes = $current->diffInMinutes($scheduled);
        //ddd($diff_in_minutes);
        
        $request->merge(['agency_id'=>request()->get('agency.id')])->merge(['client_id'=>request()->get('client.id')])->merge(['user_id'=> auth()->user()->id]); 
        
        $obj = $obj->create($request->all());
        $ems = preg_split ("/\,/", $request->emails);
        $template = MailTemplate::where('id',$request->mail_template_id)->first();
        $request->merge(['reference_id'=> $obj->id])->merge(['app'=> $this->app])->merge(['subject'=> $template->subject])->merge(['message'=> $template->message])->merge(['status'=> '0']);
        foreach($ems as $em)
        {
            $request->merge(['email'=> $em]);
            $log = MailLog::create($request->all());
        }
        $records = MailLog::where('reference_id',$obj->id)->get();
        foreach($records as $record)
        {   
            
            $details = ['email' => $record->email , 'content' => '<h1>Hello</h1>' ];
            $identity = $record->id;
            //SendEmail::dispatch($details,$identity)->delay(Carbon::now()->addMinutes($diff_in_minutes));
            SendEmail::dispatch($details,$identity)->delay(Carbon::now()->addMinutes(0));
        }
        $alert = 'A new ('.$this->app.'/'.$this->module.') item is created!';
        return redirect()->route($this->module.'.index')
                         ->with('alert',$alert);        
        
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Obj $obj)
    {    
        //ddd($id);
        // load the resource
        $obj = $obj->where('id',$id)->first();
        //ddd($obj);
        // authorize the app
        $this->authorize('edit', $obj);
        $templates = MailTemplate::all();
        if($obj)
            return view('apps.'.$this->app.'.'.$this->module.'.createedit')
                ->with('stub','update')
                ->with('obj',$obj)
                ->with('app',$this)
                ->with('templates',$templates);

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
    public function update(Request $request, $id ,Obj $obj)
    {   
        //ddd($id);
        // load the resource
        $obj = $obj->where('id',$id)->first();
        
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
        //ddd($obj);
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

}
