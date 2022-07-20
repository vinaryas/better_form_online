<?php

namespace App\Http\Controllers\FirstSync;

use App\Http\Controllers\Controller;
use App\Services\Support\roleUserService;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RoleUserSyncController extends Controller
{
    public function index(){
        return view('firstTimeSync.roleUserSync');
    }

    public function sync(){
        $client = new Client();
        $url = 'http://127.0.0.1:8000/api/role_user/1';

        try{
            $response = $client->request('GET', $url, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]);
            $arrays= json_decode($response->getBody(), true);

            foreach($arrays['data'] as $array){
                $data = [
                    'user_id'=>$array['user_id'],
                    'role_id'=> $array['role_id'],
                    'user_type'=>$array['user_type'],
                ];

                $store = roleUserService::sync($data);
            }

            Alert::success('Berhasil','berhasil di download dari server');
            return redirect()->route('permissionSync');
        }catch(\Throwable $th){
            dd($th);
            Alert::error('Error !!!');
            return redirect()->route('permissionSync');
        }
    }
}
