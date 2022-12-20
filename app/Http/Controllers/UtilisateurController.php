<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Utilisateur;
use Illuminate\Http\Request;

class UtilisateurController extends Controller
{
    public function index()
    {

        $guests = new \GuzzleHttp\Client();
        $customer_id = session("current_customer_id");
        $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
        $response = $guests->request('GET', 'https://console.ironwifi.com/api/' . $customer_id . '/users', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json;charset=utf-8',
            ],
        ]);

        $users = json_decode($response->getBody()->getContents())->_embedded->users;
        return view('pages.user.index', compact("users"));
    }

    public function details(string $id)
    {

        try {

            $customer_id = Configuration::all()->first()->current_customer_id;
            $users = new \GuzzleHttp\Client();
            $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';

            $response = $users->request('GET', 'https://europe-west2.ironwifi.com/api' . $customer_id . '/users/' . $id, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json;charset=utf-8',
     
                ],
            ]);

            $user = json_decode($response->getBody()->getContents())->_embedded->users;
            return Redirect('/users/{id}/details')->with("success", "plus d'informations");
        } catch (\Throwable $th) {
            dd('1');
        }
    }


    public function delete(string $id)
    {

        try {

            $users = new \GuzzleHttp\Client();
            $customer_id = Configuration::all()->first()->current_customer_id;
            $token  = 'fc2142095d3ce2a8b15ea2f0c7bdd48be304a52f';
            $response = $users->request('DELETE', 'https://console.ironwifi.com/api/' . $customer_id . '/users/' . $id, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json;charset=utf-8',
                ],
            ]);
            $users = json_decode($response->getBody()->getContents());
            return Redirect('/users')->with("success", "L'utilisateur a été bien supprimer");
        } catch (\Throwable $th) {
            return back()->withErrors("Impossible de supprimer cet utilisateur");
        }
    }
}
