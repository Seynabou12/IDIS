<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{

    public function index()
    {

        $guests = Guest::list();
        return view('pages.guest.index', compact("guests"));
    }

    public function detail()
    {

        $list = Guest::get(request()->input('email'), request()->input('phone'));
        foreach ($list as $value) {
            $firstValue = $value;
            break;
        }
        
        $guests = new \GuzzleHttp\Client();
        $customer_id = session("current_customer_id");
        $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
        $response = $guests->request('GET', 'http://console.ironwifi.com/api/' . $customer_id . '/guests/' . $firstValue->id, [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/hal+json',
                'accept' => 'application/json, text/plain, */*',
            ],
        ]);        
        $guest = json_decode($response->getBody()->getContents());
        return view('pages.guest.detail', compact("list", "guest", "firstValue"));
    }

    public function detaile()
    {

        $guests = Guest::list();
        
        $list = [];
        foreach ($guests as $guest ) {
            if(!key_exists($guest->email, $list)){
                $list["$guest->email"] = $guest;
            }
        }
        return view('pages.guest.connexion', compact('list'));
        
    }
}
