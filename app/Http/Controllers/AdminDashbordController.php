<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Customer;
use Illuminate\Http\Request;

class AdminDashbordController extends Controller
{

    public function welcom()
    {
        $customers = new \GuzzleHttp\Client();
        $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
        $response = $customers->request('GET', 'https://us-west1.ironwifi.com/api/afridev-group-0503703d/customers', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json;charset=utf-8',
            ],
        ]);
        $current = new Customer();
        $customers = json_decode($response->getBody()->getContents())->_embedded->customers;
        foreach ($customers as $customer) {
            if ($customer->id == session("current_customer_id"))
                $current = $customer;
        }
        $customer = $current;
        return view('welcome', compact('customer'));
    }

    public function welcomes()
    {
        $customers = new \GuzzleHttp\Client();
        $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
        $response = $customers->request('GET', 'https://us-west1.ironwifi.com/api/afridev-group-0503703d/customers', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json;charset=utf-8',
            ],
        ]);
        $current = new Customer();
        $customers = json_decode($response->getBody()->getContents())->_embedded->customers;
        foreach ($customers as $customer) {
            if ($customer->id == session("current_customer_id"))
                $current = $customer;
        }
        $customer = $current;
        return view('welcomes', compact('customer'));
    }
}
