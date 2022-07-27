<?php

namespace App\Services;

use App\Models\FormHead;
use Illuminate\Support\Facades\DB;

class FormHeadService
{
   private $FormHead;

   public function __construct(FormHead $FormHead)
    {
        $this->FormHead = $FormHead;
    }

   public function all()
	{
		return $this->FormHead->query();
	}

    public function store($data)
    {
        return $this->FormHead->create($data);
    }

    public function update($data, $id)
    {
        return $this->FormHead->where('id', $id)->update($data);
    }

    public function countForm($userId)
    {
        return $this->FormHead->where('created_by', $userId);
    }

    public function countAdmin()
    {
        return $this->FormHead->query();
    }

    public function getApprovePembuatanFilter($roleId)
    {
        return $this->FormHead->where('role_next_app', $roleId)->where('type', 'pembuatan');
    }

    public function getApprovePembuatanFilterByStore($roleId, $storeId)
    {
        return $this->FormHead->where('role_next_app', $roleId)->whereIn('store_id', $storeId)->where('type', 'pembuatan');
    }

    public function getApprovePenghapusanFilter($roleId)
    {
        return $this->FormHead->where('role_next_app', $roleId)->where('type', 'pembuatan');
    }

    public function getApprovePenghapusanFilterByStore($roleId, $storeId)
    {
        return $this->FormHead->where('role_next_app', $roleId)->whereIn('store_id', $storeId)->where('type', 'pembuatan');
    }

    public function getById($id)
    {
        return $this->FormHead->where('id', $id);
    }

    public function innerJoinFormPembuatan()
    {
        $data = DB::table('form_head')
        ->join('form_pembuatan', 'form_head.id', '=', 'form_pembuatan.form_head_id')
        ->join('aplikasi', 'form_pembuatan.aplikasi_id', '=', 'aplikasi.id')
        ->select(
            'form_pembuatan.id',
            'form_pembuatan.created_by',
            'form_pembuatan.user_id_aplikasi',
            'form_pembuatan.pass',
            'form_pembuatan.aplikasi_id',
            'form_pembuatan.store_id',
            'form_pembuatan.status',
            'aplikasi.name as nama_aplikasi',
        );

        return $data ;
    }

    public function getByUserIdActive($user_id)
    {
        return $this->innerJoinFormPembuatan()
        ->where('form_pembuatan.created_by', $user_id)
        ->where('form_pembuatan.status', config('setting_app.status_approval.finish'))
        ->where('role_next_app', 0);
    }

    public function permissionCreateForm($user_id, $aplikasi_id, $store_id)
    {
        return $this->innerJoinFormPembuatan()
        ->where('form_pembuatan.created_by', $user_id)
        ->where('form_pembuatan.aplikasi_id', $aplikasi_id)
        ->where('form_pembuatan.store_id', $store_id)
        ->whereNotIn('form_pembuatan.status', [2,3]);
    }

// SELECT COUNT(*)
// FROM `form_head` a
// inner join form_pembuatan b on a.id = b.form_head_id
// where b.status not in(2, 3)
// and b.aplikasi_id = 1
// and a.created_by = 6;
}


