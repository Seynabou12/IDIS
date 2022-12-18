<?php

namespace App\Http\Controllers;

use App\Models\CaptivePortals;
use App\Models\Configuration;
use Illuminate\Http\Request;

class CaptivePortalsController extends Controller
{

    public function index($customer_id = null)
    {

        $captifportals = CaptivePortals::list();
        return view('pages.captive_portal.index', compact("captifportals"));
    }

    public function create(Request $request)
    {

        try {
            $clients = new \GuzzleHttp\Client();
            $networks = new \GuzzleHttp\Client();
            $customer_id = session("current_customer_id");
            $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
            $portails = new CaptivePortals();
            // $body = $network->nasname = $request->nasname;
            $body = [];
            $body["name"] = $request->name;
            $body["network_id"] = $request->network_id;
            $body["vendor"] = "Peplink";

            $portail = $clients->request('POST', 'https://console.ironwifi.com/api/' . $customer_id . '/captive-portals', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json;charset=utf-8',
                ],
                'body' => json_encode($body),

                $response = $networks->request('GET', 'https://console.ironwifi.com/api/' . $customer_id . '/networks', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Content-Type' => 'application/json;charset=utf-8',
                    ],

                ]),

            ]);
            $networks = json_decode($response->getBody()->getContents())->_embedded->networks;
            return view('portail_captifs', compact('networks'))->with("success", "Le Network a été bien enregistrer");
        } catch (\Throwable $th) {
            return back();
        }

        // return Redirect('/portail_captifs', compact('networks'))->with("success", "Le Network a été bien enregistrer");

    }


    public function delete(string $id)
    {

        try {

            $portails = new \GuzzleHttp\Client();
            $customer_id = session("current_customer_id");

            $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
            $response = $portails->request('DELETE', 'https://console.ironwifi.com/api/' . $customer_id . '/captive-portals/' . $id, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json;charset=utf-8',
                ],
            ]);
            $portails = json_decode($response->getBody()->getContents());
            return Redirect('/portail_captifs')->with("success", "Le Portail Captif a été bien supprimer");
        } catch (\Throwable $th) {
            return back()->withErrors("Impossible de supprimer ce Portail Captif");
        }
    }
}
