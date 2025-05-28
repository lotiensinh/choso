<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuyerProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('buyer.profile', compact('user'));
    }
}
