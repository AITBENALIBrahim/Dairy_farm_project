<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends BaseController
{
    public function index()
    {
        // Get the current user from session
        $userModel = new \App\Models\UserModel();
        $assistantModel = new \App\Models\AssistantModel();
        $user = $userModel->asObject()
            ->where('username', session()->get('username'))
            ->orWhere('email', session()->get('email'))
            ->first();
        if (!$user) {
            $user = $assistantModel->asObject()
                ->where('username', session()->get('username'))
                ->orWhere('email', session()->get('email'))
                ->first();
        }
        // Get the session instance
        $session = session();

        // Pass session data to the view
        return view('home', [
            'session' => $session,
            'user' => $user,
        ]);
    }
}
