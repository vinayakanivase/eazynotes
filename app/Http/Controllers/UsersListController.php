<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersListController extends Controller
{
    public function index()
    {
        $users = User::all()->except(1);
        return view('users.index')->with(compact('users'));
    }
}
