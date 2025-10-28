<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create() {

        return view ('user.create');
    }

    public function store(Request $request) {

        $data = $request->validate([
            'name' => 'string',
            'email' => 'email',
            'password' => 'string',
        ]);

        User::create($data);

        return redirect()->route('balance.index');
    }
}
