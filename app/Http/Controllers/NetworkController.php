<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Network;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;

class NetworkController extends Controller
{
    public function index($customer_id = null)
    {

        $networks = new \GuzzleHttp\Client();
        $customer_id = Configuration::all()->first()->current_customer_id;
        $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
        $response = $networks->request('GET', 'https://console.ironwifi.com/api/' . $customer_id . '/networks', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json;charset=utf-8',
            ],
        ]);
        $networks = json_decode($response->getBody()->getContents())->_embedded->networks;

        return view('pages.netwoks.index', compact("networks"));
    }

    public function create()

    {
        return view('pages.netwoks.create');
    }

    public function store(HttpRequest $request) 
    {
        
        $clients = new \GuzzleHttp\Client();
        $customer_id = Configuration::all()->first()->current_customer_id;
        $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
        $network = new Network();
        $network->groupname = $request->nasname;
        $body = '{
            "nasname":"main_network",
            "region":"us"
        }';


        $r = Http::withToken($token)->acceptJson()->withBody(json_encode($network), "application/json")->post('https://console.ironwifi.com/api/' . $customer_id . '/groups',
    );
        dd($r);


        $r = Http::withToken($token)->withBody(json_encode($network), "application/json")->post('https://console.ironwifi.com/api/' . $customer_id . '/networks',
    );
        dd($r);


        $request = $clients->request('POST', 'https://console.ironwifi.com/api/' . $customer_id . '/networks', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json;charset=utf-8',
            ]
        ]);



        dd($request);

        $clients = json_decode($request->getBody()->getContents());
         dd($clients);
        return Redirect('/networks')->with("success", "Le Network a été bien enregistrer");
    }

    public function delete(string $id)
    {
        try {
            $direction =  Network::findById($id);
            $direction->delete();
            return redirect()->route("network.delete")->with("success", "Le Network a été bien supprimer");
        } catch (\Throwable $th) {
            return back()->withErrors("Impossible de supprimer ce network");
        }
    }
}
