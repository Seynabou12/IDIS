<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    /**
     * captive portal qui se trouvent dans cette portail Captif
     *
     * @return Collection
     */
    public function captiveportal()
    {
        return $this->hasMany(CaptivePortals::class);
    }

    public static function list($toArray = false)
    {

        $networks = new \GuzzleHttp\Client();
        $customer_id = session("current_customer_id");
        $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
        $response = $networks->request('GET', 'https://console.ironwifi.com/api/' . $customer_id . '/networks', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json;charset=utf-8',
                'accept' => 'application/json, text/plain, */*',

            ],
        ]);

        if ($toArray) $networks = json_decode($response->getBody()->getContents(), true)['_embedded']['networks'];
        else $networks = json_decode($response->getBody()->getContents())->_embedded->networks;
        return $networks;
    }


}
