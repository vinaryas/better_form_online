<?php

namespace App\Http\Controllers\FirstSync;

use App\Http\Controllers\Controller;
use App\Services\Support\AplikasiService;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AplikasiSyncController extends Controller
{
    public function index(){
        return view('firstTimeSync.adminSync');
    }

    public function sync(){
        $client = new Client();
        $url = 'http://127.0.0.1:8000/api/aplikasi';

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
                    'aplikasi'=> $array['aplikasi'],
                ];

                $store = AplikasiService::store($data);
            }

            Alert::success('Berhasil','Store berhasil di download dari server');
            return redirect()->route('roleSync');
        }catch(\Throwable $th){
            dd($th);
            Alert::error('Error !!!');
            return redirect()->route('roleSync');
        }
    }
}
