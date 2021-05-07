<?php

namespace App\Policies\Mailer;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MailSubscriberPolicy
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
