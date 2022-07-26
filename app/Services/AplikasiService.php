<?php

namespace App\Services;

use App\Models\Aplikasi;
use App\Services\Support\UserService;
use App\Services\Support\UserStoreService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AplikasiService
{
   private $Aplikasi;

   public function __construct(Aplikasi $Aplikasi)
   {
        $this->Aplikasi = $Aplikasi;
   }

   public function all()
   {
        return $this->Aplikasi->query();
   }

   public function sync($data)
    {
        return $this->Aplikasi->updateOrCreate($data);
    }

    // public function whereNotExist()
    // {
    //     $user_id = Auth::user()->id;
    //     $store_id = UserStoreService::getStoreByUserId($user_id, UserService::authStoreArray())->get();
    //     $data = DB::table('aplikasi')
    //                 ->whereNotExists(function ($query) use($store_id, $user_id)
    //     {
    //         $query->select(DB::raw(1))
    //         ->from('form_pembuatan')
    //         ->whereRaw('form_pembuatan.aplikasi_id = aplikasi.id')
    //         ->whereRaw("form_pembuatan.store_id = '$store_id'")
    //         ->whereRaw("form_pembuatan.created_by = '$user_id'")
    //         ->whereRaw("form_pembuatan.status in (0,1)");
    //     });

    //     return $data;
    // }

}
