<?php

namespace App\Models\Mailer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'agency_id',
        'client_id',
        'user_id',
        'name', 
        'slug', 
        'subject',
        'message',
        'status', 
    ];

}