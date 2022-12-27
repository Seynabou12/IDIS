<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Guest extends Model
{
    use HasFactory;

    public static function list()
    {

        $guests = new \GuzzleHttp\Client();
        $customer_id = session("current_customer_id");
        $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
        $response = $guests->request('GET', 'https://console.ironwifi.com/api/' . $customer_id . '/users', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json;charset=utf-8',
                'accept' => 'application/json, text/plain, */*',
            ],
        ]);

        $guests = json_decode($response->getBody()->getContents())->_embedded->users;
        return $guests;

    }

    public static function get($email, $phone)
    {

        $list = Self::list();
        $list = array_filter($list, function ($object) use ($email, $phone) {
            return $object->email == $email || $object->phone == $phone;
        });
        return $list;
        
    }

}
