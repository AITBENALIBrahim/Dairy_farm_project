<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends BaseController
{
    public function index()
    {
        $userModel = new \App\Models\UserModel();
        $user = $userModel->asObject()
            ->where('username', session()->get('username'))
            ->orWhere('email', session()->get('email'))
            ->first();
        // Get the session instance
        $session = session();

        // Pass session data to the view
        return view('home', [
            'session' => $session,
            'user' => $user,
        ]);
    }
}
