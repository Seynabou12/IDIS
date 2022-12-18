<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;

class NodeController extends Controller
{
    public function index($customer_id = null)
    {
        
        $accespoints = new \GuzzleHttp\Client(); 
        $customer_id = session("current_customer_id");

        $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
        $response = $accespoints->request('GET', 'https://europe-west2.ironwifi.com/api/'.$customer_id.'/nodes', [
            'headers' => [
                'Authorization' => 'Bearer ' .$token,
                'Content-Type' => 'application/json;charset=utf-8',
            ],
        ]);
        $accespoints = json_decode($response->getBody()->getContents())->_embedded->nodes;
       
        return view('pages.point_acces.index', compact("accespoints"));
    }
}
