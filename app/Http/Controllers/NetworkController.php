<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NetworkController extends Controller
{
    public function index()
    {
        $response = request('GET', 'https://console.ironwifi.com/api/users', [
            $token = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f',
            'headers' => [
                'Authorization' => 'Bearer '.$token,
                'Accept' => 'application/json',
            ],
        ]);

    }

    public function create()
    {
        return view('pages.netwoks.create');
    }
}
