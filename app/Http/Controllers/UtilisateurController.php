<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Utilisateur;
use Illuminate\Http\Request;

class UtilisateurController extends Controller
{
    public function index($customer_id = null)
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
       
        return view('pages.user.index', compact("users"));
    }

    public function details($id )
    {

        $customer_id = Configuration::all()->first()->current_customer_id;
        $users = new \GuzzleHttp\Client();
        $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
        $response = $users->request('GET', 'https://console.ironwifi.com/api/' . $customer_id .'/users/'. $id, [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json;charset=utf-8',
            ],
        ]);

        $users = json_decode($response->getBody()->getContents())->_embedded->users->device_data;
        dd($users);
        
        // return view('pages.user.details', compact('users'));
    }
   
}
