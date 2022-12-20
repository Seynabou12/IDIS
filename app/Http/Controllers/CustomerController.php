<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Session;

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
                'accept' => 'application/json, text/plain, */*',
            ],
        ]);

        $customers = json_decode($response->getBody()->getContents())->_embedded->customers;
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
                'accept' => 'application/json, text/plain, */*',
            ],
            'body' => json_encode($body)

        ]);

        return Redirect('/customers')->with("success", "L'entreprise a été bien enregistré");
    }

    public function selected($id)
    {

        Session::put("current_customer_id", $id);
        return redirect("/welcom");
        
    }

    public function delete($id)
    {

        $customers = new \GuzzleHttp\Client();
        $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
        $response = $customers->request('DELETE', 'https://us-west1.ironwifi.com/api/afridev-group-0503703d/customers/' . $id, [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json;charset=utf-8',
                'accept' => 'application/json, text/plain, */*',
            ],
        ]);

        $customers = json_decode($response->getBody()->getContents());
        return Redirect('/customers')->with("success", "Le Customer a été bien supprimer");
    }

    public function edit(Request $request, $id)
    {

        $clients = new \GuzzleHttp\Client();
        $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
        $customer = new Customer();
        // $body = $network->nasname = $request->nasname;
        $body = [];
        $body["username"] = $request->username;
        $body["company_name"] = $request->company_name;
        $body["phone"] = $request->phone;
        $body["region"] = "global";
        $body["plan"] = "14_days_trial";
        $body["plan_quantity"] = $request->plan_quantity;

        $customers = $clients->request('PATCH', 'https://us-west1.ironwifi.com/api/afridev-group-0503703d/customers', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json;charset=utf-8',
                'accept' => 'application/json, text/plain, */*',
            ],
            'body' => json_encode($body)
        ]);

        $customer = json_decode($customers->getBody()->getContents());
        return Redirect('/customers')->with("success", "Le Customer a été bien enregistrer");
    }
}
