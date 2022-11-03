<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

class NetworkController extends Controller
{
    public function index($customer_id = null)
    {
        
        $networks = new \GuzzleHttp\Client(); 
        $customer_id = Configuration::all()->first()->current_customer_id;
        $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
        $response = $networks->request('GET', 'https://console.ironwifi.com/api/'.$customer_id.'/networks', [
            'headers' => [
                'Authorization' => 'Bearer ' .$token,
                'Content-Type' => 'application/json;charset=utf-8',
            ],
        ]);
        $networks = json_decode($response->getBody()->getContents())->_embedded->networks;
        // dd($networks);

        return view('pages.netwoks.index', compact("networks"));
    }

    public function create()

    {
        return view('pages.netwoks.create');
    }
    
}
