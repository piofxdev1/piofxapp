<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Core\Client;
use Illuminate\Support\Facades\Cache;

class Page extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'html',
        'user_id',
        'client_id',
        'status',
    ];


    /**
     * Get the list of records from database
     *
     * @var array
     */
    public function getRecords($item,$limit,$user){

    	if($user->isRole('siteadmin'))
        	return $this->where('name','LIKE',"%{$item}%")
        			->where('client_id',$user->client_id)
                    ->orderBy('created_at','desc')
                    ->paginate($limit);
        else
        	return $this->where('name','LIKE',"%{$item}%")
                    ->orderBy('created_at','desc')
                    ->paginate($limit);

    }

    public function refreshCache(){

        $page = $this;
        // get the domain name
        $domain = $page->client->domain;

        // reload the cache
        Cache::forget('page_'.$domain.'_'.$page->slug);
        Cache::forever('page_'.$domain.'_'.$page->slug,$page);

    }

    /**
	 * Get the user that owns the page.
	 *
	 */
	public function user()
	{
	    return $this->belongsTo(User::class);
	}

	 /**
	 * Get the client that owns the page.
	 *
	 */
	public function client()
	{
	    return $this->belongsTo(Client::class);
	}

}
