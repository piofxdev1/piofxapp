<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use carbon\Carbon;

class Contact extends Model
{
    use HasFactory,Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'message',
        'category',
        'tags',
        'comment',
        'client_id',
        'agency_id',
        'user_id',
        'valid_email',
        'json',
        'status',
    ];

    public $sortable = ['name',
                        'email',
                        'created_at'];

    /**
     * Get the list of records from database
     *
     * @var array
     */
    public function getRecords($item,$limit,$user,$status){

        $user_id = request()->get('user_id');

        if(is_numeric($item)){
            $field = 'phone';
        }else if (strpos($item, '@') !== false) {
            $field = 'email';
        }else{
            $field = 'name';
        }

         //categories
        $category_array = [];
        if(request()->get('category')){
            $category_array = [request()->get('category')];
        }else{
            $categories =  $this->select(['category'])
                    ->where('client_id',$user->client_id)
                    ->distinct()
                    ->get();
            foreach($categories as $c){
                array_push($category_array,$c->category);
            }
        }  

        //check for tags
        if(request()->get('tag')){
            $field = 'tags';
            $item = request()->get('tag');
        }

        // arrays for status and user_ids
        if($status){
            $status_array = [$status];
        }else if($status==="0"){
            $status_array = [$status];
        }else{
            $status_array = ['0','1','2','3','4','5'];
        }


        //date range
        $settings = json_decode($this->settings);
        if(request()->get('date_filter')){
            $date_filter = request()->get('date_filter');
        }
        else if(isset($settings->date_filter)){
            $date_filter = $settings->date_filter;
        }else{
            $date_filter = 'thisyear';
        }
        $date_range = $this->date_filter($date_filter);


        $user_array = [];
        if($user_id){
            $user_array = [$user_id];
        }else{

            $users = \Auth::user()->whereIn('role',['clientadmin','clientdeveloper','clientmanager','clientmoderator'])->where('client_id',$user->client_id)->get();
            foreach($users as $u){
                if($u)
                array_push($user_array,$u->id);
            }
        }   

        //dates

        if($item){
            // for open leads we do not send and user array, as the users are not assigned
             return $this->sortable()->where($field,'LIKE',"%{$item}%")
                    ->whereIn('status',$status_array)
                    ->whereIn('category',$category_array)
                    ->where('client_id',$user->client_id)
                    ->with('user')
                    ->orderBy('created_at','desc')
                    ->paginate($limit);
        }
        else if($status ==1){
            // for open leads we do not send and user array, as the users are not assigned
             return $this->sortable()->where($field,'LIKE',"%{$item}%")
                    ->whereIn('status',$status_array)
                    ->whereIn('category',$category_array)
                    ->where('client_id',$user->client_id)
                    ->whereBetween('created_at',$date_range)
                    ->with('user')
                    ->orderBy('created_at','desc')
                    ->paginate($limit);
        }else{
            if(!$user_id){
                 return $this->sortable()->where($field,'LIKE',"%{$item}%")
                    ->whereIn('status',$status_array)
                    ->whereIn('category',$category_array)
                    ->where('client_id',$user->client_id)
                    ->whereBetween('created_at',$date_range)
                    ->with('user')
                    ->orderBy('created_at','desc')
                    ->paginate($limit); 
            }
            else{
             return $this->sortable()->where($field,'LIKE',"%{$item}%")
                    ->whereIn('status',$status_array)
                    ->whereIn('category',$category_array)
                    ->where('client_id',$user->client_id)
                    ->whereIn('user_id',$user_array)
                    ->whereBetween('created_at',$date_range)
                    ->with('user')
                    ->orderBy('created_at','desc')
                    ->paginate($limit); 
            }
            
        }
       



        

    }

    /**
     * Get the list of records from database
     *
     * @var array
     */
    public function getData($item,$limit,$user,$status){

        $user_id = request()->get('user_id');
        $client_id = $user->client_id;

        // arrays for status and user_ids
        if($status){
            $status_array = [$status];
        }else if($status==="0"){
            $status_array = [$status];
        }else{
            $status_array = ['0','1','2','3','4','5'];
        }


        $user_array = [];
        if($user_id){
            $user_array = [$user_id];
        }else{
            $users = \Auth::user()->whereIn('role',['clientadmin','clientdeveloper','clientmanager','clientmoderator'])->where('client_id',$user->client_id)->get();
            foreach($users as $u){
                if($u)
                array_push($user_array,$u->id);
            }
        }   

        //categories
        $category_array = [];
        if(request()->get('category')){
            $category_array = [request()->get('category')];
        }else{
            $categories =  $this->select(['category'])
                    ->where('client_id',$user->client_id)
                    ->distinct()
                    ->get();
            foreach($categories as $c){
                array_push($category_array,$c->category);
            }
        }  

        //check for tags
        $field = 'name';
        if(request()->get('tag')){
            $field = 'tags';
            $item = request()->get('tag');
        }

        //date range
        $settings = json_decode($this->settings);
        if(request()->get('date_filter')){
            $date_filter = request()->get('date_filter');
        }
        else if(isset($settings->date_filter)){
            $date_filter = $settings->date_filter;
        }else{
            $date_filter = 'thisyear';
        }
        $date_range = $this->date_filter($date_filter);


        
        if($status ==1){
            // for open leads we do not send and user array, as the users are not assigned
            $records = $this->where($field,'LIKE',"%{$item}%")
                    ->whereIn('status',$status_array)
                    ->whereIn('category',$category_array)
                    ->where('client_id',$user->client_id)
                    ->whereBetween('created_at',$date_range)
                    ->with('user')
                    ->orderBy('created_at','desc')
                   ->get(); 
        }else{
            if(!$user_id){
            $records = $this->where($field,'LIKE',"%{$item}%")
                    ->whereIn('status',$status_array)
                    ->whereIn('category',$category_array)
                    ->where('client_id',$user->client_id)
                    ->whereBetween('created_at',$date_range)
                    ->with('user')
                    ->orderBy('created_at','desc')
                    ->get(); 
            }
            else{
              $records = $this->where($field,'LIKE',"%{$item}%")
                    ->whereIn('status',$status_array)
                    ->whereIn('category',$category_array)
                    ->where('client_id',$user->client_id)
                    ->whereIn('user_id',$user_array)
                    ->whereBetween('created_at',$date_range)
                    ->with('user')
                    ->orderBy('created_at','desc')
                    ->get(); 
            }
            
        }

        
        if(request()->get('export')){
            if(Storage::disk('s3')->exists('settings/contact/'.$client_id.'.json' )){
                $data = json_decode(json_decode(Storage::disk('s3')->get('settings/contact/'.$client_id.'.json' ),true));

                if(request()->get('category'))
                    $category = request()->get('category');
                else
                    $category = 'contact';
                $field_name = $category.'_form';

                if(isset($data->$field_name)){
                    $form = $this->processForm($data->$field_name);
                }
            }

            $columnNames =['sno','timestamp','name','email','phone','status','message','category','comment','valid_email'];
            $jsonNames = [];
            foreach($form as $f){
                array_push($columnNames,str_replace(' ','_',$f['name']));
                array_push($jsonNames,str_replace(' ','_',$f['name']));
            }
            
            $rows=[];
            
            $status =['0'=>'Customer','1'=>'Open Lead','2'=>'Cold Lead','3'=>'Warm Lead','4'=>'Prospect','5'=>'Not Responded'];
            foreach($records as $k=>$r){
                $row=[($k+1),$r->created_at,$r->name,$r->email,$r->phone,$status[$r->status],$r->message,$r->category,$r->comment,$r->valid_email];
                
                $data  =json_decode($r->json);
                
                foreach($jsonNames as $f){
                    if(isset($data->$f)){
                        array_push($row,$data->$f);
                    }else{
                        array_push($row,'-');
                    }
                }
                array_push($rows,$row);
            }

            return $this->getCsv($columnNames, $rows,'data_'.request()->get('client.name').'_'.strtotime("now").'.csv');

            $client_name = request()->get('client.name');
            return Excel::download(new ContactsExport, $client_name.'_contacts.xlsx');
        }

        // $records = $this->select(['status','user_id','category'])->where($field,'LIKE',"%{$item}%")
        //             ->where('client_id',$user->client_id)
        //             ->whereIn('user_id',$user_array)
        //             ->whereIn('status',$status_array)
        //             ->whereIn('category',$category_array)
        //             ->whereBetween('created_at',$date_range)
        //             ->orderBy('created_at','desc')
        //             ->get();

        // if($status ==1){

        //     $records = $this->select(['status','user_id'])->where('name','LIKE',"%{$item}%")
        //             ->where('client_id',$user->client_id)
        //             ->whereIn('status',$status_array)
        //             ->orderBy('created_at','desc')
        //             ->get();
        // }else{
            
        // }

   

        // load tags
        $settings = null;
        if(Storage::disk('s3')->exists('settings/contact/'.$client_id.'.json' ))
            $settings = json_decode(Storage::disk('s3')->get('settings/contact/'.$client_id.'.json' ));

        $data['tags'] = $this->load_tag_data($settings,$user_array,$client_id,$date_range);
        $data['category'] = $records->groupBy('category');
       
        $data['overall'] = $records->groupBy('status');
        $data['users'] = $records->groupBy('user_id');

        
        //load the open lead data that is skipped because of bad logic
        if(!isset($data['overall'][1])&& !$user_id){
            $data['overall'][1] = $this->select(['status','user_id'])->where($field,'LIKE',"%{$item}%")
                    ->where('client_id',$user->client_id)
                    ->whereIn('status',["1"])
                    ->whereBetween('created_at',$date_range)
                    ->orderBy('created_at','desc')
                    ->get();

        }
        
        for($i=0;$i<6;$i++){
            if(!isset($data['overall'][$i]))
                $data['overall'][$i]=[];
        }

        return $data;

    }

    public function date_filter($query){
        $range =[date('2020-04-04'),Carbon::tomorrow()->toDateTimeString()];

        switch ($query) {
            case 'today':
                $range[0] = Carbon::today()->toDateTimeString();
                $range[1] = Carbon::tomorrow()->toDateTimeString();
                break;

            case 'yesterday':
                $range[0] = Carbon::yesterday()->toDateTimeString();
                $range[1] = Carbon::today()->toDateTimeString();
                break;
            case 'lastsevendays':
                $range[0] = Carbon::now()->subDays(7)->toDateTimeString();
                $range[1] = Carbon::tomorrow()->toDateTimeString();
                break;
            case 'lastfifteendays':
                $range[0] = Carbon::now()->subDays(15)->toDateTimeString();
                $range[1] = Carbon::tomorrow()->toDateTimeString();
                break;
            case 'thisweek':
                $range[0] = Carbon::now()->startOfWeek()->toDateTimeString();
                $range[1] = Carbon::tomorrow()->toDateTimeString();
                break;
            case 'lastweek':
                $range[0] = Carbon::now()->startOfWeek()->subDays(7)->toDateTimeString();
                $range[1] = Carbon::now()->startOfWeek()->toDateTimeString();
                break;
            case 'thismonth':
                $range[0] = Carbon::now()->startOfMonth()->toDateTimeString();
                $range[1] = Carbon::tomorrow()->toDateTimeString();
                break;
            case 'lastmonth':
                $range[0] = Carbon::now()->startOfMonth()->subMonth()->toDateTimeString();
                $range[1] = Carbon::now()->startOfMonth()->toDateTimeString();
                break;
            case 'thisyear':
                $range[0] = Carbon::now()->startOfYear()->toDateTimeString();
                $range[1] = Carbon::tomorrow()->toDateTimeString();
                break;
            case 'lastyear':
                $range[0] = Carbon::now()->startOfYear()->subYear()->toDateTimeString();
                $range[1] = Carbon::now()->startOfYear()->toDateTimeString();
                break;
            case 'generic':
                $range[0] = date(request()->get('from'). ' 00:00:00');
                $range[1] = date(request()->get('to').' 00:00:00');
                break;
            default:
                $range[0] = date('2020-04-01');
                $range[1] = Carbon::tomorrow()->toDateTimeString();
                break;
        }
       
        return $range;

    }

    public function load_tag_data($settings,$user_array,$client_id,$date_range){
        $settings = json_decode($settings);

        $data = [];
        if(isset($settings->tags)){
            $tags = explode(',',$settings->tags);
            
            foreach($tags as $t){
                $data[$t] = $this->select(['status','user_id'])->where('tags','LIKE',"%{$t}%")
                    ->where('client_id',$client_id)
                    ->whereBetween('created_at',$date_range)
                    ->whereIn('user_id',$user_array)
                    ->count();
            }
        }

       

        return $data;
    }


     public function getSettings(){
        $client_id = \Auth::user()->client_id;
        $settings = null;
        if(Storage::disk('s3')->exists('settings/contact/'.$client_id.'.json' ))
            $settings = json_decode(Storage::disk('s3')->get('settings/contact/'.$client_id.'.json' ));
        return json_decode($settings);
    }

    public function tags(){
        return explode(',',$this->tags);
    }


    public function processForm($data){
        $d = [];
        $form = explode(',',$data);
        foreach($form as $k=>$f){
            $item = ["name"=>$f,"type"=>"input","values"=>""];
            if(preg_match_all('/<<+(.*?)>>/', $f, $regs))
            {
                foreach ($regs[1] as $reg){
                    $variable = trim($reg);
                    $item['name'] = str_replace($regs[0], '', $f);


                    if(is_numeric($variable)){
                        $item['type'] = 'textarea';
                        $item['values'] = $variable;

                    }else if($variable=='file'){
                        $item['type'] = 'file';
                        $item['values'] = $variable;
                    }else{
                        $options = explode('/',$variable);
                        $item['values'] = $options;
                        $item['type'] = 'checkbox';
                    }
                    
                }
            }

            if(preg_match_all('/{{+(.*?)}}/', $f, $regs))
            {

                foreach ($regs[1] as $reg){
                    $variable = trim($reg);
                    $item['name'] = str_replace($regs[0], '', $f);
                    $options = explode('/',$variable);
                    $item['values'] = $options;
                    $item['type'] = 'radio';
                    
                }
            }

            $d[$k] = $item;

        }

        return $d;
    }


    public function uploadFile($file){

            $client_id = request()->get('client.id');

           
            $fname = str_replace(' ','',$file->getClientOriginalName());
            $extension = strtolower($file->getClientOriginalExtension());

            if(in_array($extension, ['jpg','jpeg','png','gif','svg','webp']))
                $type = 'files';
            else if(in_array($extension, ['pdf','','doc','txt','docx','xls','xlsx']))
                $type = 'files';
            else
                $type = $extension;
                
            $filename = 'file_'.$fname;

            $path = 'https://'.request()->get('domain.name').'/'.Storage::disk('public')->putFileAs('files/'.$client_id, $file,$filename,'public');

            return [$path,$filename];
        
    }

    function debounce_valid_email($email) {
        $api = '6075b8772c316';
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, 'https://api.debounce.io/v1/?api='.$api.'&email='.strtolower($email));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);       

        $data = curl_exec($ch);
        curl_close($ch);

        $json = json_decode($data, true);
     
        $success = $json['success'];
        return $success;
    }

    
    
    public static function getCsv($columnNames, $rows, $fileName = 'file.csv') {
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=" . $fileName,
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];
        $callback = function() use ($columnNames, $rows ) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columnNames);
            foreach ($rows as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }


    public function urlSuffix(){
        $r = request();
        $url ='';
        if($r->get('status')){
            $url = $url.'&status='.$r->get('status');
        }
        if($r->get('user_id')){
            $url = $url.'&user_id='.$r->get('user_id');
        }
        if($r->get('category')){
            $url = $url.'&category='.$r->get('category');
        }
        if($r->get('tag')){
            $url = $url.'&tag='.$r->get('tag');
        }
        if($r->get('date_filter')){
            $url = $url.'&date_filter='.$r->get('date_filter');
        }

        return $url;
    }

    /**
	 * Get the client that owns the page.
	 *
	 */
	public function client()
	{
	    return $this->belongsTo(Client::class);
	}

    /**
     * Get the user that who contacted the person.
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

