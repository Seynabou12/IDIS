<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function index()
    {

        $customers = new \GuzzleHttp\Client();
        // $customer_id = Configuration::all()->first()->current_customer_id;
        $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
        $response = $customers->request('GET', 'https://us-west1.ironwifi.com/api/afridev-group-0503703d/customers', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json;charset=utf-8',
            ],
        ]);

        $customers = json_decode($response->getBody()->getContents())->_embedded->customers;
        // dd($customers);
        return view('pages.customer.index', compact("customers"));
    }

    public function selected($id)

    {
        $configuration = Configuration::all()->first() ?? new Configuration();
        $configuration->current_customer_id = $id;
        $configuration->save();

        return redirect("/");
    }

}
