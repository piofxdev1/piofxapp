<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Kyslik\ColumnSortable\Sortable;

class Client extends Model
{
    use HasFactory,Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'domain',
        'settings',
        'agency_id',
        'status',
    ];

    public $sortable = ['name',
                        'domain',
                        'created_at'];


    /**
     * Get the list of records from database
     *
     * @var array
     */
    public function getRecords($item,$limit){
        return $this->where('name','LIKE',"%{$item}%")
                    ->sortable()
                    ->orderBy('created_at','desc')
                    
                    ->paginate($limit);
    }


    public function refreshCache(){

        $client = $this;
        // get the domain name
        $domain = $client->domain;

        // reload the cache
        Cache::forget('theme_'.$domain);
        Cache::forget('agency_'.$domain);
        Cache::forget('client_'.$domain);
        Cache::forever('client_'.$domain,$client);


    }
}
