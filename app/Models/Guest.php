<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Guest extends Model
{
    use HasFactory;

    public static function list($toArray = false)
    {

        $guests = new \GuzzleHttp\Client();
        $customer_id = Configuration::all()->first()->current_customer_id;
        $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
        $response = $guests->request('GET', 'https://console.ironwifi.com/api/' . $customer_id . '/users', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json;charset=utf-8',
            ],
        ]);
        if($toArray) $guests = json_decode($response->getBody()->getContents(), true)['_embedded']['users'];
        else $guests = json_decode($response->getBody()->getContents())->_embedded->users;
        return $guests;
    }

    public static function get($email, $phone)
    {

        $list = Self::list(true);
        $list = Arr::where($list, function ($value, $key) use ($email, $phone) {
            return $value['email'] == $email || $value['phone'] == $phone;
        });
        return $list;
    }

}
