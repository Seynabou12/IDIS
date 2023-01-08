<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Customer;
use App\Models\Guest;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

        $months = [

            1 => "javnier",
            2 => "fevrier",
            3  => "mars",
            4  => "avril",
            5 => "mai",
            6 => "juin",
            7 => "juileet",
            8 => "aout",
            9 => "septembre",
            10 => "octobre",
            11 => "novembre",
            12 => "decembre",

        ];

        $guests = Guest::list();
        $list = [];
        foreach ($guests as $guest) {

            if (!key_exists($guest->email, $list)) {
                $list["$guest->email"] = $guest;
            }
            $size["$guest->email"] = isset($size["$guest->email"]) ? $size["$guest->email"]  + 1 : 1;
        }

        $date1 = Carbon::today();
        $date2 = Carbon::today()->subYear(1);
        $d = Carbon::today()->subYear(1)->addMonth(1);
        while ($d <= $date1) {
            $tab[$months[$d->month]] = 0;
            $d->addMonth(1);
        }

        foreach ($guests as $guest) {
            $date = Carbon::parse(substr($guest->creationdate, 0, 10));
            if ($date >= $date2 && $date <= $date1)
                $tab[$months[$date->month]] += 1;
        }

        $date3 = Carbon::today();
        $date4 = Carbon::today()->subYear(1);
        $f = Carbon::today()->subYear(1)->addMonth(1);
        while ($f <= $date3) {
            $tab1[$months[$f->month]] = 0;
            $f->addMonth(1);
        }

        foreach ($list as $lists) {
            $dates = Carbon::parse(substr($lists->creationdate, 0, 10));
            if ($dates >= $date4 && $dates <= $date3)
                $tab1[$months[$dates->month]] += 1;
        }

        return view('welcome', compact('customer', "list", "tab", "tab1"));

    }
}
