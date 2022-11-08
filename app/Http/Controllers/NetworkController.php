<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Network;
use GuzzleHttp\Psr7\Request;

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

    // public function store()
    // {

    //     $networks = new \GuzzleHttp\Client();
    //     $customer_id = Configuration::all()->first()->current_customer_id;
    //     $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
    //     $response = $networks->request('GET', 'https://console.ironwifi.com/api/' . $customer_id . '/networks', [
    //         'headers' => [
    //             'Authorization' => 'Bearer ' . $token,
    //             'Content-Type' => 'application/json;charset=utf-8',
    //         ],
    //     ]);

    //     foreach ($networks as $post) {
    //         $post = (array)$post;
    //         Network::updateOrCreate([
    //             ['id' => $post['id']],
    //             [
    //                 'id' => $post['id'],
    //                 'nasname' => $post['nasname'],
    //                 'auth_port' => '',
    //                 'acct_port' => '',
    //                 'region' => '',
    //                 'secret' => '',
    //                 'primary_ip' => '',
    //                 'backup_ip' => '',
    //             ]
    //         ]);
    //     }

    //     $networks = json_decode($response->getBody()->getContents())->_embedded->networks;
    //     dd('ajout');
    // }

    public function create()
    {
        return view('pages.netwoks.create');
    }

    public function store()
    {

        $networks = new \GuzzleHttp\Client();
        $customer_id = Configuration::all()->first()->current_customer_id;
        $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
        $body = '{
            "nasname":"",
            "region":""
        }';
        $response = $networks->request('POST', 'https://console.ironwifi.com/api/' . $customer_id . '/networks',  [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json;charset=utf-8',
            ],

        ], $body);
        $networks = json_decode($response->getBody()->getContents())->_embedded->networks;
        // dd($networks);
        return redirect('/networks')->with("success", "Le Network a été bien enregistrer");
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
