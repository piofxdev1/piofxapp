<?php

namespace App\Models\Mailer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailCampaign extends Model
{
    use HasFactory;
    protected $fillable = [
        'agency_id',
        'client_id',
        'user_id',
        'mail_template_id',
        'name', 
        'description', 
        'emails',
        'scheduled_at',
        'status', 
        'timezone',
    ];
}
