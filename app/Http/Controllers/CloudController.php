<?php

namespace App\Http\Controllers;

use App\Models\SearchKey;

class CloudController extends Controller
{
    //
    public function index(){

        $keys = SearchKey::get(['key', 'count']);
        return view('cloud', ['keys' => $keys]);
    }
}
