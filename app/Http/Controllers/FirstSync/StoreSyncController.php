<?php

namespace App\Http\Controllers\FirstSync;

use App\Http\Controllers\Controller;
use App\Services\Support\StoreService;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class StoreSyncController extends Controller
{
    public function index(){
        return view('firstTimeSync.storeSync');
    }

    public function sync(){
        $client = new Client();
        $url = 'http://127.0.0.1:8000/api/store';

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
                    'id'=>$array['id'],
                    'name'=> $array['name'],
                    'region_id'=>$array['region_id'],
                    'email'=>$array['email'],
                ];

                $store = StoreService::store($data);
            }

            Alert::success('Berhasil','Store berhasil di download dari server');
            return redirect()->route('regionSync');
        }catch(\Throwable $th){
            dd($th);
            Alert::error('Error !!!');
            return redirect()->route('regionSync');
        }
    }
}
