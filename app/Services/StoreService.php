<?php

namespace App\Services;

use App\Models\Store;

class StoreService
{
	private $Store;

    public function __construct(Store $Store)
    {
        $this->Store = $Store;
    }

	public function all()
	{
		return $this->Store->query()->with('region');
	}

    public function store($data)
    {
        return $this->Store->create($data);
    }

    public function getById($storeId)
    {
        return $this->all()->where('id', $storeId);
    }

    public function sync($data)
    {
        return $this->Store->updateOrCreate($data);
    }

    public function getStoreNonExclusive()
    {
        return $this->all()->where('exclusive', 0);
    }

}
