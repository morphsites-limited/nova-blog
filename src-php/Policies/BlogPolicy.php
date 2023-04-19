<?php

namespace Dewsign\NovaBlog\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Authenticatable;

class BlogPolicy
{
    use HandlesAuthorization;

    public function viewAny()
    {
        return Gate::any(['viewBlog', 'manageBlog']);
    }

    public function view($model)
    {
        return Gate::any(['viewBlog', 'manageBlog'], $model);
    }

    public function create($user)
    {
        return $user->can('manageBlog');
    }

    public function update($user, $model)
    {
        return $user->can('manageBlog', $model);
    }

    public function delete($user, $model)
    {
        return $user->can('manageBlog', $model);
    }

    public function restore($user, $model)
    {
        return $user->can('manageBlog', $model);
    }

    public function forceDelete($user, $model)
    {
        return $user->can('manageBlog', $model);
    }

    public function viewInactive(?Authenticatable $user, $model)
    {
        if (config('maxfactor-support.canViewInactive')) {
            return true;
        }

        if ($model->active) {
            return true;
        }

        if (Gate::allows('viewNova')) {
            return true;
        }

        return false;
    }
}
