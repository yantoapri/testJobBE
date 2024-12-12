<?php

namespace App\Policies;

use App\Models\User;
use App\Models\RoleModuls;
use Tymon\JWTAuth\Facades\JWTAuth;

use Illuminate\Auth\Access\Response;

class ModulPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($access = "", $modul_id): bool
    {
        $user = JWTAuth::user();
        $Roles = new RoleModuls();
        $check = $Roles::where('moduls_id', $modul_id)->where('role_id', $user->role_id)->first();
        if ($check) {
            return $check->access;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($access = "", $modul_id): bool
    {
        $user = JWTAuth::user();
        $Roles = new RoleModuls();
        $check =  $Roles::where('moduls_id', $modul_id)->where('role_id', $user->role_id)->first();
        if ($check) {
            return $check->create;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($access = "", $modul_id): bool
    {
        $user = JWTAuth::user();
        $Roles = new RoleModuls();
        $check = $Roles->where('role_id', $user->role_id)->where('moduls_id', $modul_id)->first();
        if ($check) {
            return $check->update;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($access = "", $modul_id): bool
    {
        $user = JWTAuth::user();
        $Roles = new RoleModuls();
        $check = $Roles->where('role_id', $user->role_id)->where('moduls_id', $modul_id)->first();
        if ($check) {
            return $check->delete;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}
