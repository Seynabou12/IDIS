<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaptivePortals extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    /**
     *  d'appartenance
     *
     * @return Direction
     */
    public function network()
    {
        return $this->belongsTo(Network::class);
    }

    public static function list($toArray = false)
    {

        $captifportals = new \GuzzleHttp\Client();
        $customer_id = session("current_customer_id");
        $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
        $response = $captifportals->request('GET', 'https://console.ironwifi.com/api/' . $customer_id . '/captive-portals', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json;charset=utf-8',
                'accept' => 'application/json, text/plain, */*',


            ],
        ]);
        
        if($toArray) $captifportals = json_decode($response->getBody()->getContents(), true)['_embedded']['captive_portals'];
        else $captifportals = json_decode($response->getBody()->getContents())->_embedded->captive_portals;
        return $captifportals;

    }
}
