<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function list($toArray = false)
    {
        $accespoints = new \GuzzleHttp\Client(); 
        $customer_id = session("current_customer_id");

        $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
        $response = $accespoints->request('GET', 'https://console.ironwifi.com/api/'.$customer_id.'/nodes', [
            'headers' => [
                'Authorization' => 'Bearer ' .$token,
                'Content-Type' => 'application/json;charset=utf-8',
            ],
        ]);
        if($toArray) $accespoints = json_decode($response->getBody()->getContents(), true)['_embedded']['nodes'];
        else $accespoints = json_decode($response->getBody()->getContents())->_embedded->nodes;
        return $accespoints;
       
    }

}
