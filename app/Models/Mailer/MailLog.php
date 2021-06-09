<?php

namespace App\Models\Mailer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'agency_id',
        'client_id',
        'mail_template_id',
        'reference_id',
        'email',
        'scheduled_at',
        'app',
        'subject',
        'message',
        'status', 
    ];
    
}
