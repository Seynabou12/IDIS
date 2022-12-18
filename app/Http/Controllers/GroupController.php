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

        $groups = Group::list();
        return view('pages.group.index', compact("groups"));
    }

    public function create(Request $request)
    {

        try {

            $clients = new \GuzzleHttp\Client();
            $customer_id = session("current_customer_id");
            $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
            $group = new Group();
            // $body = $network->nasname = $request->nasname;
            $body = [];
            $body["groupname"] = $request->groupname;

            $groups = $clients->request('POST', 'https://console.ironwifi.com/api/' . $customer_id . '/groups', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json;charset=utf-8',
                    'accept' => 'application/json, text/plain, */*',
                ],

                'body' => json_encode($body)

            ]);
            return Redirect('/groups')->with("success", "Le Groupe a été bien enregistrer");
        } catch (\Throwable $th) {
            return back()->withErrors("success", "Le Groupe a été bien enregistrer");
        }
    }

    public function delete(string $id)
    {

        try {

            $groups = new \GuzzleHttp\Client();
            $customer_id = session("current_customer_id");
            $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
            $response = $groups->request('DELETE', 'https://console.ironwifi.com/api/' . $customer_id . '/groups/' . $id, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json;charset=utf-8',
                ],
            ]);

            $groups = json_decode($response->getBody()->getContents());
            return Redirect('/groups')->with("success", "Le Groupe a été bien Supprimé");
        } catch (\Throwable $th) {
            return back()->withErrors("Le Groupe a été bien supprimé");
        }
    }
}
