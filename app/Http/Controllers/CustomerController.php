<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Http\Request as HttpRequest;

class CustomerController extends Controller
{

    public function index()
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
        // dd($customers);
        return view('pages.customer.index', compact("customers"));
    }

    public function create(HttpRequest $request)
    {

        $clients = new \GuzzleHttp\Client();
        $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
        $customer = new Customer();
        // $body = $network->nasname = $request->nasname;
        $body = [];
        $body["username"] = $request->username;
        $body["company_name"] = $request->company_name;
        $body["phone"] = $request->phone;
        $body["region"] = "europe-west2";
        $body["plan"] = "14_days_trial";
        $body["plan_quantity"] = $request->plan_quantity;

        $customers = $clients->request('POST', 'https://us-west1.ironwifi.com/api/afridev-group-0503703d/customers', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json;charset=utf-8',
            ],
            'body' => json_encode($body)

        ]);

        return Redirect('/customers')->with("success", "Le Network a été bien enregistrer");
    }

    public function selected($id)
    {
        $configuration = Configuration::all()->first() ?? new Configuration();
        $configuration->current_customer_id = $id;
        $configuration->save();

        return redirect("/welcom");
    }

    public function delete($id)
    {
        $customers = new \GuzzleHttp\Client();
        $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
        $response = $customers->request('DELETE', 'https://us-west1.ironwifi.com/api/afridev-group-0503703d/customers/'.$id , [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json;charset=utf-8',
            ],
        ]);

        $customers = json_decode($response->getBody()->getContents());
        
        return Redirect('/customers')->with("success", "Le Customer a été bien supprimer");
    }
}
