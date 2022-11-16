<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Utilisateur;
use Illuminate\Http\Request;

class ReportingContoller extends Controller
{
    public function reporting()
    {
        $users = new \GuzzleHttp\Client();
        $customer_id = Configuration::all()->first()->current_customer_id;
        $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
        $response = $users->request('GET', 'https://console.ironwifi.com/api/' . $customer_id . '/users', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json;charset=utf-8',
            ],
        ]);

        $users = json_decode($response->getBody()->getContents())->_embedded->users;
       
        return view('pages.reporting', compact('users'));
    }

   

}
