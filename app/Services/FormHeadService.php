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

    public function getApproveFilter($roleId)
    {
        return $this->FormHead->where('role_next_app', $roleId);
    }

    public function getApproveFilterByStore($roleId, $storeId)
    {
        return $this->FormHead->where('role_next_app', $roleId)->whereIn('store_id', $storeId);
    }

    public function getById($id)
    {
        return $this->FormHead->where('id', $id);
    }

    public function innerJoinFormPembuatan($aplikasi_id, $user_id)
    {
        $data = DB::table('form_head')
        ->join('form_pembuatan', 'form_head.id', '=', 'form_pembuatan.form_head_id')
        ->select('form_head.status', 'form_pembuatan.aplikasi_id', 'form_pembuatan.created_by',)
        ->whereNotIn('form_head.status', 2)
        ->where('form_pembuatan.aplikasi_id', $aplikasi_id)
        ->where('form_pembuatan.created_by', $user_id);

        return $data ;
    }

//     SELECT COUNT(*)
// FROM `form_head` a
// inner join form_pembuatan b on a.id = b.form_head_id
// where b.status not in(2, 3)
// and b.aplikasi_id = 1
// and a.created_by = 6;
}


