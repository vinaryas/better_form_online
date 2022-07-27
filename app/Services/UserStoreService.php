<?php

namespace App\Services;

use App\Models\UserStore;
use App\Services\Support\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserStoreService
{
    private $UserStore;

    public function __construct(UserStore $UserStore)
    {
        $this->UserStore = $UserStore;
    }

    public function sync($data)
    {
        return $this->UserStore->updateOrCreate($data);
    }

    public function all()
    {
		return $this->UserStore->query()->with('stores', 'user');
	}

	public function update($data, $userId, $storeId)
    {
		return $this->UserStore->where('user_id', $userId)->where('store_id', $storeId)->update($data);
	}

    public function delete($data)
    {
    	return $this->UserStore->where('id', $data['id'])->delete();
    }

    public function getStoreByUserId($user_id)
    {
        return $this->UserStore->where('user_id', $user_id);
    }

    public function getuserByStoreId($store_id)
    {
        return $this->all()->where('store_id', $store_id);
    }

    public function getById($id)
    {
        return $this->UserStore->where('id', $id);
    }

    public function getStoreNotOwned($storeId)
    {
        return $this->all()->where('store_id', '!=', $storeId);
    }

    public function inerJoinUserStore()
    {
        $data = DB::table('user_store')
        ->join('users', 'users.id', '=', 'user_store.user_id')
        ->join('stores', 'stores.id', '=', 'user_store.store_id')
        ->select(
            'user_store.id',
            'user_store.user_id',
            'user_store.store_id',
            'users.status',
            'users.name as user_name',
            'users.nik as nik',
            'stores.name as store_name',
        );

        return $data;
    }
    public function getUserStoreNotAuthActive($store_id, $user_id)
    {
        return $this->inerJoinUserStore()
        ->where('store_id', $store_id)
        ->where('user_id', '!=', $user_id)
        ->where('users.status', 0);
    }
}
