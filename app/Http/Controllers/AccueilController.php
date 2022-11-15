<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class AccueilController extends Controller
{
    public function accueil()
    {
        
        $customers = new \GuzzleHttp\Client();
        
        $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
        $response = $customers->request('GET', 'https://us-west1.ironwifi.com/api/afridev-group-0503703d/customers', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json;charset=utf-8',
            ],
        ]);

        $customers = json_decode($response->getBody()->getContents())->_embedded->customers;
        
        return view('accueil', compact('customers'));
        
    }

    public function create()
    {

        $customers = new \GuzzleHttp\Client();
        $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
        $response = $customers->request('POST', 'https://us-west1.ironwifi.com/api/afridev-group-0503703d/customers', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json;charset=utf-8',
            ],
        ]);
        $customers = json_decode($response->getBody()->getContents())->_embedded->customers;
        return view('accueil', compact("customers"));
        
    }

    
}
