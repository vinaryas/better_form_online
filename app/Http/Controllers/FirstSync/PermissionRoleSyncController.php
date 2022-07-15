<?php

namespace App\Http\Controllers\FirstSync;

use App\Http\Controllers\Controller;
use App\Services\Support\PermissionRoleService;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PermissionRoleSyncController extends Controller
{
    public function index(){
        return view('firstTimeSync.permissionRoleSync');
    }

    public function sync(){
        $client = new Client();
        $url = 'http://127.0.0.1:8000/api/permission_role/1';

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
                    'permission_id'=> $array['permission_id'],
                    'role_id'=>$array['role_id'],
                ];

                $store = PermissionRoleService::store($data);
            }

            Alert::success('Berhasil','Store berhasil di download dari server');
            return redirect()->route('storeSync');
        }catch(\Throwable $th){
            dd($th);
            Alert::error('Error !!!');
            return redirect()->route('storeSync');
        }
    }
}
