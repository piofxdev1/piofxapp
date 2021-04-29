<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Core\Client;
use App\Models\Core\Contact;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'client_id',
        'role',
        'status',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



     /**
     * Get the list of records from database
     *
     * @var array
     */
    public function getRecords($item,$limit,$user){

        if(!$user->isRole('superadmin'))
            return $this->where('name','LIKE',"%{$item}%")
                    ->where('client_id',$user->client_id)
                    ->orderBy('id','desc')
                    ->paginate($limit);
        else
            return $this->where('name','LIKE',"%{$item}%")
                    ->orderBy('id','desc')
                    ->paginate($limit);

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
     * Get the contacts of the user
     *
     */
    public function contact()
    {
        return $this->hasMany(Contact::class);
    }

    public function isRole($role){
        if ($this->role == $role)
            return 1;
        else
            return 0;
    }

    public function checkRole($roles){
        $user = $this;
        
        foreach($roles as $r){
            if($r == $user->role){
                return true;
            }
        }
        return false;
    }

    public function isAdmin(){
        if(\Auth::user())
        {
            if(\Auth::user()->role == 'superadmin' )
                return true;
            else if(\Auth::user()->role == 'agencyadmin' )
                return true;
            else if(\Auth::user()->role == 'clientadmin' )
                return true;

            return false;
        }
        
        return false;
    }

    

}
