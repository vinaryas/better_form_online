<?php

namespace App\Services\Auth;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class userService
{
    public function data($data)
    {
        return [
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
        ];
    }

    public function all()
    {
        return $this->User->query()->with('RoleUser.role', 'stores');
    }

    public function saveData($data)
    {
        return $this->User->create($this->data($data));
    }

    public function updateData($data, $id)
    {
        return $this->User::where('id', '=', $id)->update($this->data($data));
    }

    public function editData($id)
    {
        return redirect()->route('user_store.edit');
    }

    public function deleteData($id)
    {
        $user = User::where('id', '=', $id)->delete();

        return $user;
    }

    public function find($id)
    {
        return User::with('stores', 'RoleUser.role')->find($id);
    }

    public function userAllStoreByRoleId($roleId)
    {
        return $this->all()->whereHas('RoleUser', function($query) use($roleId){
            return $query->where('role_id', $roleId);
        })->where('all_store', 'y');
    }

    public function userStoreByRoleId($roleId, $store)
    {
        return $this->all()->whereHas('RoleUser', function($query) use($roleId){
            return $query->where('role_id', $roleId);
        })->whereHas('stores', function($query) use($store){
            return $query->where('stores.id', $store);
        })->where('all_store', 'n');
    }

    public function authStoreArray()
    {
        $stores = [];
        foreach (Auth::user()->stores as $store) {
            $stores[] = $store->id;
        }

        return $stores;
    }

    public function getById($id)
    {
        return User::all()->where('id', $id);
    }

}
