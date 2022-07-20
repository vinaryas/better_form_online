<?php

namespace App\Http\Controllers\FirstSync;

use App\Http\Controllers\Controller;
use App\Services\Support\PermissionService;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class permissionSyncController extends Controller
{
    public function index(){
        return view('firstTimeSync.permissionSync');
    }

    public function sync(){
        $client = new Client();
        $url = 'http://127.0.0.1:8000/api/permission/1';

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
                    'parent_id'=> $array['parent_id'],
                    'name'=>$array['name'],
                    'display_name'=>$array['display_name'],
                    'description'=>$array['description'],
                ];

                $store = PermissionService::sync($data);
            }

            Alert::success('Berhasil','berhasil di download dari server');
            return redirect()->route('permissionRoleSync');
        }catch(\Throwable $th){
            dd($th);
            Alert::error('Error !!!');
            return redirect()->route('permissionRoleSync');
        }
    }
}
