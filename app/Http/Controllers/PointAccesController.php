<?php

namespace App\Http\Controllers;

use App\Models\PointAcces;
use Illuminate\Http\Request;

class PointAccesController extends Controller
{
    public function point(Request $request){
        
        
        $point = new PointAcces(); //GuzzleHttp\Client
        
        $url = "https://console.ironwifi.com/api/networks/";


        $response = $point->request('GET', $url, [
            'verify'  => false,
        ]);

        $responseBody = json_decode($response->getBody());

     
        return view('groups.members', compact('responseBody'),[        
            'responseBody' => $responseBody,
        ]);
    }

}
