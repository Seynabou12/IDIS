<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Guest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuestController extends Controller
{

    public function chart()
    {

        $guests = Guest::list();
        $tab = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
            6 => 0,
            7 => 0,
            8 => 0,
            9 => 0,
            10 => 0,
            11 => 0,
            12 => 0,
        ];

        // si la date se trouve dans les douzes derniéres mois
        $date1 = Carbon::today();
        $date2 = Carbon::today()->subYear(1);
        $newDateTime = Carbon::now()->subMonth();
        foreach ($guests as $guest) {
            $date = Carbon::parse(substr($guest->creationdate, 0, 10));
            if ($date >= $date2 && $date <= $date1)
                $tab[$date->month] += 1;
        }
        
        return response()->json($tab);
    }

    public function index()
    {

        $guests = Guest::list();
        return view('pages.guest.index', compact("guests"));

    }

    public function detail()
    {

        $device_data = [];
        $visit = [];
        $list = Guest::get(request()->input('email'), request()->input('phone'));
        $guests = new \GuzzleHttp\Client();
        $customer_id = session("current_customer_id");
        $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
        foreach ($list as $value) {
            $firstValue = $value;
            $response = $guests->request('GET', 'http://console.ironwifi.com/api/' . $customer_id . '/guests/' . $value->id, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/hal+json',
                    'accept' => 'application/json, text/plain, */*',
                ],
            ]);

            $guest = json_decode($response->getBody()->getContents());
            $device = null;
            foreach ($guest->device_data as $key) {
                $device = $key;
                $visit[] = $key;
            }

            $guest->device_data = $device;
            $device_data[] = $guest;
        }

        return view('pages.guest.detail', compact("list", "device_data", "firstValue", "guest"));
    }

    public function detaile()
    {

        $guests = Guest::list();
        $list = [];
        $size = [];
        foreach ($guests as $guest) {
            if (!key_exists($guest->email, $list)) {
                $list["$guest->email"] = $guest;
            }
            $size["$guest->email"] = isset($size["$guest->email"]) ? $size["$guest->email"]  + 1 : 1;
        }

        return view('pages.guest.connexion', compact('list', 'size'));
    }

    public function details(string $id)
    {

        $guests = new \GuzzleHttp\Client();
        $customer_id = session("current_customer_id");
        $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
        $response = $guests->request('GET', 'http://console.ironwifi.com/api/' . $customer_id . '/guests/' . $id, [
            'headers' => [

                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/hal+json',
                'accept' => 'application/json, text/plain, */*',

            ],
        ]);

        $guest = json_decode($response->getBody()->getContents());
        return view('pages.guest.details', compact('guest'));

    }
}
