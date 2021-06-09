<?php

namespace App\Policies\Mailer;
use App\Models\Mailer\MailSubscriber;
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

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Template  $template
     * @return mixed
     */
    public function view(User $user, MailSubscriber $mailsubscriber)
    {
        if($user->checkRole(['superadmin']))
            return true;

        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user , MailSubscriber $mailsubscriber)
    {   
        if($user->checkRole(['superadmin']))
            return true;

        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Template  $template
     * @return mixed
     */
    public function update(User $user, MailSubscriber $mailsubscriber)
    {
        if($user->checkRole(['superadmin']))
            return true;

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Template  $template
     * @return mixed
     */
    public function delete(User $user, MailSubscriber $mailsubscriber)
    {
        if($user->checkRole(['superadmin']))
            return true;

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Template  $template
     * @return mixed
     */
    public function edit(User $user, MailSubscriber $mailsubscriber)
    {
        if($user->checkRole(['superadmin']))
            return true;

        return false;
    }

    public function upload(User $user, MailSubscriber $mailsubscriber)
    {
        if($user->checkRole(['superadmin']))
            return true;

        return false;
    }

    public function createcsv(User $user, MailSubscriber $mailsubscriber)
    {
        if($user->checkRole(['superadmin']))
            return true;

        return false;
    }

    public function before(User $user, $ability)
    {
        if($user->isRole('superadmin'))
            return true;
    }

}
