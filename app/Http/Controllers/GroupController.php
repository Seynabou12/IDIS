<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Group;
use Guzzle\Http\Message\Request as MessageRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GroupController extends Controller
{
    public function index($customer_id = null)
    {

        $groups = new \GuzzleHttp\Client();
        $customer_id = Configuration::all()->first()->current_customer_id;
        $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';

        $response = $groups->request('GET', 'https://console.ironwifi.com/api/' . $customer_id . '/groups', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json;charset=utf-8',
            ],
        ]);
        $groups = json_decode($response->getBody()->getContents())->_embedded->groups;
        // dd($groups);
        return view('pages.group.index', compact("groups"));
    }

    public function create(Request $request)
    {

        $clients = new \GuzzleHttp\Client();
        $customer_id = Configuration::all()->first()->current_customer_id;
        $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
        $group = new Group();
        // $body = $network->nasname = $request->nasname;
        $body = [];
        $body["groupname"] = $request->groupname;
    
        $groups = $clients->request('POST', 'https://console.ironwifi.com/api/' . $customer_id . '/groups', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json;charset=utf-8',
            ],

            'body' => json_encode($body)
            
        ]);
        return view('pages.group.index', compact("groups"))->with("success", "Le Groupe a été bien enregistrer");

    }
    
}
