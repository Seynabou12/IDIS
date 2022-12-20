<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use App\Models\Node;
use Illuminate\Http\Request;

class NodeController extends Controller
{
    public function index()
    {
        
        $accespoints = Node::list();
        return view('pages.point_acces.index', compact("accespoints"));
    }
}
