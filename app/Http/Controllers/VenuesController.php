<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;

class VenuesController extends Controller
{
    public function index($customer_id = null)
    {

        $venus = new \GuzzleHttp\Client(); 
        $customer_id = Configuration::all()->first()->current_customer_id;
        $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
        $response = $venus->request('GET', 'https://console.ironwifi.com/api/'.$customer_id.'/venus', [
            'headers' => [
                'Authorization' => 'Bearer ' .$token,
                'Content-Type' => 'application/json;charset=utf-8',
            ],
        ]);

        $venus = json_decode($response->getBody()->getContents())->_embedded->venus;
        // dd($venus);
        return view('pages.venus.index', compact("venus"));

    }
}
