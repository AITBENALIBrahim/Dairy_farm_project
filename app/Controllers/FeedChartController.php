<?php

namespace App\Controllers;

use App\Models\FeedChartModel;
use App\Models\CowModel;
use App\Models\UserModel;

class FeedChartController extends BaseController
{
    public function feedChart()
    {
        $feedChartModel = new FeedChartModel();
        $feedCharts = $feedChartModel->findAll();
        $userModel = new UserModel();
        $user = $userModel->asObject()
            ->where('username', session()->get('username'))
            ->orWhere('email', session()->get('email'))
            ->first();

        return view('layout', [
            'content' => view('pages/feed_chart', [
                'user' => $user,
                'feedCharts' => $feedCharts
            ])
        ]);
    }

    public function addFeed()
    {
        // Validation rules
        $rules = [
            'cow_id' => 'required',
            'feed_time' => 'required',
            'feed_type' => 'required',
            'quantity' => 'required|numeric',
            'date' => 'required|valid_date'
        ];

        // Fetch the list of available cows
        $cowModel = new CowModel();
        $cows = $cowModel->findAll();

        // Fetch the user data (similar to feedChart() method)
        $userModel = new UserModel();
        $user = $userModel->asObject()
            ->where('username', session()->get('username'))
            ->orWhere('email', session()->get('email'))
            ->first();

        // Check if the validation failed
        if (!$this->validate($rules)) {
            return view('layout', [
                'content' => view('pages/add_feed', [
                    'validation' => $this->validator,
                    'cows' => $cows,
                    'user' => $user
                ])
            ]);
        }

        // Process the form data after validation
        $data = [
            'cow_id' => $this->request->getPost('cow_id'),
            'feed_time' => $this->request->getPost('feed_time'),
            'feed_type' => $this->request->getPost('feed_type'),
            'quantity' => $this->request->getPost('quantity'),
            'date' => $this->request->getPost('date'),
            'created_by' => session()->get('user_id') // Assuming you have user authentication
        ];

        // Insert the new feed record
        $feedChartModel = new FeedChartModel();
        $feedChartModel->insert($data);

        // Redirect with success message
        return redirect()->to('feed-chart')->with('success', 'Feed record added successfully.');
    }

    public function deleteFeed($id)
    {
        // Load the FeedChartModel
        $feedChartModel = new FeedChartModel();

        // Check if the feed record exists
        $feed = $feedChartModel->find($id);
        if ($feed) {
            // Delete the feed record
            $feedChartModel->delete($id);

            // Redirect with a success message
            return redirect()->to('feed-chart')->with('success', 'Feed record deleted successfully.');
        } else {
            // If feed record not found, show an error
            return redirect()->to('feed-chart')->with('error', 'Feed record not found.');
        }
    }
}
