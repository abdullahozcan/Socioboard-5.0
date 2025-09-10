<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SocialAccounts extends Component
{
    public $accounts = [];
    public $availablePlatforms = [];
    public $showConnectModal = false;
    public $selectedPlatform = '';

    public function mount()
    {
        $this->loadAccounts();
        $this->loadAvailablePlatforms();
    }

    public function loadAccounts()
    {
        // Mock data for connected accounts
        $this->accounts = [
            [
                'id' => 1,
                'platform' => 'Facebook',
                'name' => 'My Business Page',
                'username' => '@mybusiness',
                'followers' => 5200,
                'status' => 'active',
                'connected_at' => '2024-01-15',
                'icon' => 'fab fa-facebook-f',
                'color' => 'facebook'
            ],
            [
                'id' => 2,
                'platform' => 'Twitter',
                'name' => 'My Business',
                'username' => '@mybusiness',
                'followers' => 3400,
                'status' => 'active',
                'connected_at' => '2024-01-20',
                'icon' => 'fab fa-twitter',
                'color' => 'twitter'
            ],
            [
                'id' => 3,
                'platform' => 'Instagram',
                'name' => 'My Business',
                'username' => '@mybusiness',
                'followers' => 2800,
                'status' => 'error',
                'connected_at' => '2024-01-25',
                'icon' => 'fab fa-instagram',
                'color' => 'instagram'
            ]
        ];
    }

    public function loadAvailablePlatforms()
    {
        $this->availablePlatforms = [
            [
                'name' => 'Facebook',
                'icon' => 'fab fa-facebook-f',
                'color' => 'facebook',
                'description' => 'Connect your Facebook pages and profiles'
            ],
            [
                'name' => 'Twitter',
                'icon' => 'fab fa-twitter',
                'color' => 'twitter',
                'description' => 'Connect your Twitter accounts'
            ],
            [
                'name' => 'Instagram',
                'icon' => 'fab fa-instagram',
                'color' => 'instagram',
                'description' => 'Connect your Instagram business accounts'
            ],
            [
                'name' => 'LinkedIn',
                'icon' => 'fab fa-linkedin-in',
                'color' => 'linkedin',
                'description' => 'Connect your LinkedIn company pages'
            ],
            [
                'name' => 'YouTube',
                'icon' => 'fab fa-youtube',
                'color' => 'youtube',
                'description' => 'Connect your YouTube channels'
            ]
        ];
    }

    public function connectAccount($platform)
    {
        $this->selectedPlatform = $platform;
        $this->showConnectModal = true;
    }

    public function confirmConnect()
    {
        // Here you would implement the actual OAuth connection logic
        // For now, we'll just simulate adding a new account
        
        session()->flash('message', 'Successfully connected to ' . $this->selectedPlatform . '!');
        $this->showConnectModal = false;
        $this->selectedPlatform = '';
        $this->loadAccounts();
    }

    public function disconnectAccount($accountId)
    {
        // Remove account from the list
        $this->accounts = array_filter($this->accounts, function($account) use ($accountId) {
            return $account['id'] !== $accountId;
        });
        
        session()->flash('message', 'Account disconnected successfully!');
    }

    public function refreshAccount($accountId)
    {
        // Simulate refreshing account data
        foreach ($this->accounts as &$account) {
            if ($account['id'] === $accountId) {
                $account['status'] = 'active';
                break;
            }
        }
        
        session()->flash('message', 'Account refreshed successfully!');
    }

    public function render()
    {
        return view('livewire.social-accounts')
            ->layout('layouts.app', ['title' => 'Social Accounts']);
    }
}
