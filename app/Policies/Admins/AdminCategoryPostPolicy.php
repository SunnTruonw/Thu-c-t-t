<?php

namespace App\Policies\Admins;

use App\Models\CategoryPost;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminCategoryPostPolicy
{
    use HandlesAuthorization;

    public function list(Admin $user)
    {
        return $user->CheckPermissionAccess(config('permissions.access.category-post-list'));
    }
    public function add(Admin $user)
    {
        return $user->CheckPermissionAccess(config('permissions.access.category-post-add'));
    }
    public function edit(Admin $user)
    {
        return $user->CheckPermissionAccess(config('permissions.access.category-post-edit'));
    }
    public function delete(Admin $user)
    {
        return $user->CheckPermissionAccess(config('permissions.access.category-post-delete'));
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Admin  $user
     * @return mixed
     */
    public function viewAny(Admin $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CategoryPost  $categoryPost
     * @return mixed
     */
    public function view(Admin $user, CategoryPost $categoryPost)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(Admin $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CategoryPost  $categoryPost
     * @return mixed
     */
    public function update(Admin $user, CategoryPost $categoryPost)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CategoryPost  $categoryPost
     * @return mixed
     */
    // public function delete(User $user, CategoryPost $categoryPost)
    // {

    // }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CategoryPost  $categoryPost
     * @return mixed
     */
    public function restore(Admin $user, CategoryPost $categoryPost)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $user
     * @param  \App\Models\CategoryPost  $categoryPost
     * @return mixed
     */
    public function forceDelete(Admin $user, CategoryPost $categoryPost)
    {
        //
    }
}
