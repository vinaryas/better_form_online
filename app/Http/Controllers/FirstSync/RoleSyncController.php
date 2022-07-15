<?php

namespace App\Http\Controllers\FirstSync;

use App\Http\Controllers\Controller;
use App\Services\Support\RoleService;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RoleSyncController extends Controller
{
    public function index(){
        return view('firstTimeSync.roleSync');
    }

    public function sync(){
        $client = new Client();
        $url = 'http://127.0.0.1:8000/api/role/1';

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
                    'name'=>$array['name'],
                    'display_name'=>$array['display_name'],
                    'description'=>$array['description'],
                ];

                $store = RoleService::store($data);
            }

            Alert::success('Berhasil','Store berhasil di download dari server');
            return redirect()->route('roleUserSync');
        }catch(\Throwable $th){
            dd($th);
            Alert::error('Error !!!');
            return redirect()->route('roleUserSync');
        }
    }
}
