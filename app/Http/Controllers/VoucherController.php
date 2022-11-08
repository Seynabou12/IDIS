<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
   

    public function index($customer_id = null)
    {
        $vouchers = new \GuzzleHttp\Client(); 
        $customer_id = Configuration::all()->first()->current_customer_id;
        $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
        $response = $vouchers->request('GET', 'https://console.ironwifi.com/api/'.$customer_id.'/vouchers', [
            'headers' => [
                'Authorization' => 'Bearer ' .$token,
                'Content-Type' => 'application/json;charset=utf-8',
            ],
        ]);
        $vouchers = json_decode($response->getBody()->getContents())->_embedded->vouchers;
        // dd($vouchers);
        return view('pages.voucher.index', compact("vouchers"));
    }
}
