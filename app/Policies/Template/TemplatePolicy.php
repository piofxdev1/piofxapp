<?php

namespace App\Policies\Template;

use App\Models\Template\Template;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TemplatePolicy
{
    use HandlesAuthorization;

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
    public function view(User $user, Template $template)
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
    public function create(User $user , Template $template)
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
    public function update(User $user, Template $template)
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
    public function delete(User $user, Template $template)
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
    public function edit(User $user, Template $template)
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
