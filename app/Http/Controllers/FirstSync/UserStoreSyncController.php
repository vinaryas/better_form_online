<?php

namespace App\Http\Controllers\FirstSync;

use App\Http\Controllers\Controller;
use App\Services\Support\UserStoreService;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserStoreSyncController extends Controller
{
    public function index(){
        return view('firstTimeSync.userStoreSync');
    }

    public function sync(){
        $client = new Client();
        $url = 'http://127.0.0.1:8000/api/user_store';

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
                    'user_id'=> $array['user_id'],
                    'store_id'=> $array['store_id'],
                ];

                $store = UserStoreService::sync($data);
            }

            Alert::success('Berhasil','berhasil di download dari server');
            return redirect()->route('aplikasiSync');
        }catch(\Throwable $th){
            dd($th);
            Alert::error('Error !!!');
            return redirect()->route('aplikasiSync');
        }
    }
}
