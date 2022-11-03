<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;

class CaptivePortalsController extends Controller
{
    
    public function index($customer_id = null)

    {
        
        $captifportals = new \GuzzleHttp\Client(); 
        $customer_id = Configuration::all()->first()->current_customer_id;
        $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
        $response = $captifportals->request('GET', 'https://console.ironwifi.com/api/'.$customer_id.'/captive-portals', [
            'headers' => [
                'Authorization' => 'Bearer ' .$token,
                'Content-Type' => 'application/json;charset=utf-8',
            ],
        ]);
        $captifportals = json_decode($response->getBody()->getContents())->_embedded->captive_portals;
        // dd($captifportals);
        return view('pages.captive_portal.index', compact("captifportals"));
    }

    public function create()
    {

    }

}
