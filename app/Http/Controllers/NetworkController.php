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

        $networks = Network::list();
        return view('pages.netwoks.index', compact("networks"));

    }

    public function store(HttpRequest $request)
    {

        try {

            $clients = new \GuzzleHttp\Client();
            $customer_id = session("current_customer_id");
            $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
            // $body = $network->nasname = $request->nasname;
            $body = [];
            $body["nasname"] = $request->nasname;

            $networks = $clients->request('POST', 'https://console.ironwifi.com/api/' . $customer_id . '/networks', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json;charset=utf-8',
                    
                ],
                'body' => json_encode($body)
            ]);

            $network = json_decode($networks->getBody()->getContents());
            return Redirect('/networks')->with("success", "Le Groupe a été bien enregistrer");
        } catch (\Throwable $th) {
            return back();
        }

    }

    public function delete(string $id)
    {

        try {

            $networks = new \GuzzleHttp\Client();
            $customer_id = Configuration::all()->first()->current_customer_id;
            $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
            $response = $networks->request('DELETE', 'https://console.ironwifi.com/api/'. $customer_id .'/networks/'.$id, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json;charset=utf-8',
                ],
            ]);
            $networks = json_decode($response->getBody()->getContents());
            return Redirect('/networks')->with("success", "Le Network a été bien supprimer");
        } catch (\Throwable $th) {
            return back()->withErrors("Impossible de supprimer ce network");
        }

    }

    
}
