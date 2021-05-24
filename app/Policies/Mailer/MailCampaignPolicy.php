<?php

namespace App\Policies\Mailer;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MailCampaignPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
