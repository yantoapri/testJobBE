<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Crypt;

class UsersController extends BaseController
{
    public function index(Request $request)
    {
        try {

            if (!Gate::allows('access', 1)) {
                return $this->sendError("You Have No Authority To Access");
            }

            $search = $request->query('search');
            $sort = $request->query('sort') ? $request->query('sort') : 'desc';
            $perPage = $request->query('perPage') ? $request->perPage : 10;

            $userLogin = JWTAuth::user();

            if ($userLogin->role_id == 1 || $userLogin->role_id == 2) {
                $data = User::where('name', 'like', '%' . $search . '%');
            } else {
                $data = User::where('name', 'like', '%' . $search . '%')
                    ->where('role_id', $userLogin->role_id);
            }

            $data = $data->orderBy('name', $sort)->paginate($perPage);
            return $this->sendResponse($data);
        } catch (\Exception $e) {

            return $this->sendError($e->getMessage());
        }
    }

    public function getByID($id)
    {
        try {

            if (!Gate::allows('access', 1)) {
                return $this->sendError('You Have No Authority To Access');
            }

            $userLogin = JWTAuth::user();
            if ($userLogin->role_id == 1 || $userLogin->role_id == 2)
                $data = User::where("id", $id)->first();
            else
                $data = User::where('role_id', $userLogin->role_id)->where("id", $id)->first();

            return $this->sendResponse($data);
        } catch (\Exception $e) {

            return $this->sendError($e->getMessage());
        }
    }

    public function store(Request $request)
    {

        try {

            if (!Gate::allows('create', 1) || !Gate::allows('update', 1)) {
                return $this->sendError('You Have No Authority To Create or Update');
            }

            $userLogin = JWTAuth::user();
            if ($userLogin->role_id == 2 && $request->role_id == 1) {
                return $this->sendError('You Have No Authority To Create or Update Role Superadmin');
            }

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'role_id' => 'required|integer',
            ], [
                'name.required' => "Name is required",
                'name.string' => "Name must be text",
                'name.max'      => "Name max 255 character",
                'email.required' => "Email is required",
                'email.string' => "Email must be text",
                'email.max'      => "Email max length 255",
                'email.unique'      => "Email must be unique",
                'password.required' => "Password is required",
                'password.string' => "Password must be text",
                'password.min' => "Password min 8 character",
                'role_id.required' => "Role ID is required",
                'role_id.integer' => "Role ID must be number",
            ]);

            if ($request->has('id')) {
                $res = User::where('id', $request->id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'role_id' => $request->role_id
                ]);
                $res = User::where('id', $request->id)->get();
            } else {
                $res = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    'role_id' => $request->role_id
                ]);
            }

            return $this->sendResponse($res, "User Saved Succesfully");
        } catch (\Exception $e) {

            return $this->sendError($e->getMessage());
        }
    }

    public function delete(Request $request)
    {

        try {

            if (!Gate::allows('delete', 1) || !Gate::allows('delete', 1)) {
                return $this->sendError('You Have No Authority To Delete');
            }

            $msg = "";

            if ($request->id) {

                $res = User::where('id', $request->id);
                $res->update([
                    'deleted_at'        => date('Y-m-d H:i:s')
                ]);

                if ($res) {
                    $msg = "Delete User Successfully'";
                } else {
                    $msg = "Delete User Failed";
                }
            }

            return $this->sendResponse($res, $msg);
        } catch (\Exception $e) {

            return $this->sendError($e->getMessage());
        }
    }
}
