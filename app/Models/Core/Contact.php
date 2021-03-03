<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Models\User;

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
        'comment',
        'client_id',
        'agency_id',
        'user_id',
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

        if($status!=null)
        	return $this->sortable()->where('name','LIKE',"%{$item}%")

                    ->where('status',$status)
        			->where('client_id',$user->client_id)
                    ->with('user')
                    ->orderBy('created_at','desc')
                    ->paginate($limit);
        else
            return $this->sortable()->where('name','LIKE',"%{$item}%")
                    ->where('client_id',$user->client_id)
                    ->with('user')
                    ->orderBy('created_at','desc')
                    ->paginate($limit);

    }

    /**
     * Get the list of records from database
     *
     * @var array
     */
    public function getData($item,$limit,$user,$status){

        if($status==null)
        $records = $this->select(['status','user_id'])->where('name','LIKE',"%{$item}%")
                    ->where('client_id',$user->client_id)
                    ->orderBy('created_at','desc')
                    ->get();
        else
        $records = $this->select(['status','user_id'])->where('name','LIKE',"%{$item}%")
                    ->where('client_id',$user->client_id)
                    ->where('status',$status)
                    ->orderBy('created_at','desc')
                    ->get();


        $data['overall'] = $records->groupBy('status');
        $data['users'] = $records->groupBy('user_id');
        
        for($i=0;$i<5;$i++){
            if(!isset($data['overall'][$i]))
                $data['overall'][$i]=[];
        }


        return $data;

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

