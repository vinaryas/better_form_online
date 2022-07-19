<?php

namespace App\Services;

use App\Models\UserStore;

class UserStoreService
{
    private $UserStore;

    public function __construct(UserStore $UserStore)
    {
        $this->UserStore = $UserStore;
    }

    public function store($data)
    {
        return $this->UserStore->create($data);
    }

    public function all()
    {
		return $this->UserStore->query()->with('stores', 'user');
	}

	public function update($data, $id)
    {
		return $this->UserStore->where('id', $id)->update($data);
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
}
