<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public $connectedAccounts = [];
    public $recentPosts = [];
    public $analytics = [
        'total_posts' => 125,
        'total_engagement' => 2450,
        'total_followers' => 12300,
        'reach' => 45600
    ];

    public function mount()
    {
        $this->loadConnectedAccounts();
        $this->loadRecentPosts();
    }

    public function loadConnectedAccounts()
    {
        // Mock data for connected social accounts
        $this->connectedAccounts = [
            [
                'platform' => 'Facebook',
                'name' => 'My Business Page',
                'followers' => 5200,
                'icon' => 'fab fa-facebook-f',
                'color' => 'facebook'
            ],
            [
                'platform' => 'Twitter',
                'name' => '@mybusiness',
                'followers' => 3400,
                'icon' => 'fab fa-twitter',
                'color' => 'twitter'
            ],
            [
                'platform' => 'Instagram',
                'name' => '@mybusiness',
                'followers' => 2800,
                'icon' => 'fab fa-instagram',
                'color' => 'instagram'
            ],
            [
                'platform' => 'LinkedIn',
                'name' => 'My Business',
                'followers' => 900,
                'icon' => 'fab fa-linkedin-in',
                'color' => 'linkedin'
            ]
        ];
    }

    public function loadRecentPosts()
    {
        // Mock data for recent posts
        $this->recentPosts = [
            [
                'platform' => 'Facebook',
                'content' => 'Just launched our new product! Check it out.',
                'engagement' => 45,
                'time' => '2 hours ago',
                'status' => 'published'
            ],
            [
                'platform' => 'Twitter',
                'content' => 'Excited to announce our partnership with...',
                'engagement' => 23,
                'time' => '4 hours ago',
                'status' => 'published'
            ],
            [
                'platform' => 'Instagram',
                'content' => 'Behind the scenes of our latest campaign',
                'engagement' => 67,
                'time' => '6 hours ago',
                'status' => 'scheduled'
            ]
        ];
    }

    public function refreshData()
    {
        $this->loadConnectedAccounts();
        $this->loadRecentPosts();
        $this->emit('dataRefreshed');
    }

    public function render()
    {
        return view('livewire.dashboard')
            ->layout('layouts.app', ['title' => 'Dashboard']);
    }
}
