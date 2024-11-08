<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends BaseController
{
    public function index()
    {
        // Get the session instance
        $session = session();

        // Pass session data to the view
        return view('home', [
            'session' => $session,
        ]);
    }
}
