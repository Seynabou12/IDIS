<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function dashbord()
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
        $entreprise = 0;
        foreach ($customers as $customer) {
            $entreprise += $customer->total_aps;
        }
        $users = 0;
        foreach ($customers as $customer) {
            $users += $customer->total_users;
        }
       
        return view('superadmin.dashbord', compact('customers', 'entreprise', 'users'));
    }

    public function customer()
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
}
