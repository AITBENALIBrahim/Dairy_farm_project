<?php

namespace App\Controllers;

class PageController extends BaseController
{
    // Method to check if the user is logged in
    private function checkLogin()
    {
        if (!session()->get('logged_in')) {
            // Redirect to login page if not logged in
            return redirect()->to('/auth/login');
        }
    }

    public function dashboard()
    {
        // Check if the user is logged in
        $redirect = $this->checkLogin();
        if ($redirect) {
            return $redirect;
        }

        $userModel = new \App\Models\UserModel();
        $user = $userModel->asObject()->where('email', session()->get('email'))->first();

        return view('layout', ['content' => view('pages/dashboard'), 'user' => $user]);
    }

    public function profile()
    {
        // Check if the user is logged in
        $redirect = $this->checkLogin();
        if ($redirect) {
            return $redirect;
        }

        $userModel = new \App\Models\UserModel();
        $user = $userModel->asObject()->where('email', session()->get('email'))->first();

        return view('layout', ['content' => view('pages/profile', ['user' => $user, 'validation' => session()->getFlashdata('validation')])]);
    }

    public function settings()
    {
        // Check if the user is logged in
        $redirect = $this->checkLogin();
        if ($redirect) {
            return $redirect;
        }

        $userModel = new \App\Models\UserModel();
        $user = $userModel->asObject()->where('email', session()->get('email'))->first();

        return view('layout', ['content' => view('pages/settings'), 'user' => $user]);
    }
}
