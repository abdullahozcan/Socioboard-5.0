<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FeedsManager extends Component
{
    public $feeds = [];
    public $newFeedUrl = '';
    public $selectedCategory = 'all';
    public $categories = ['all', 'tech', 'marketing', 'business', 'social'];

    public function mount()
    {
        $this->loadFeeds();
    }

    public function loadFeeds()
    {
        // Mock data for RSS feeds
        $this->feeds = [
            [
                'id' => 1,
                'title' => 'TechCrunch',
                'url' => 'https://techcrunch.com/feed',
                'category' => 'tech',
                'status' => 'active',
                'last_updated' => '2024-01-15 10:30:00',
                'post_count' => 156
            ],
            [
                'id' => 2,
                'title' => 'Social Media Today',
                'url' => 'https://socialmediatoday.com/feed',
                'category' => 'marketing',
                'status' => 'active',
                'last_updated' => '2024-01-15 09:15:00',
                'post_count' => 89
            ],
            [
                'id' => 3,
                'title' => 'Harvard Business Review',
                'url' => 'https://hbr.org/feed',
                'category' => 'business',
                'status' => 'error',
                'last_updated' => '2024-01-14 16:45:00',
                'post_count' => 67
            ]
        ];
    }

    public function addFeed()
    {
        $this->validate([
            'newFeedUrl' => 'required|url'
        ]);

        // Simulate adding a new feed
        $newFeed = [
            'id' => count($this->feeds) + 1,
            'title' => 'New Feed',
            'url' => $this->newFeedUrl,
            'category' => 'all',
            'status' => 'active',
            'last_updated' => now()->format('Y-m-d H:i:s'),
            'post_count' => 0
        ];

        array_unshift($this->feeds, $newFeed);
        $this->reset('newFeedUrl');
        session()->flash('message', 'Feed added successfully!');
    }

    public function deleteFeed($feedId)
    {
        $this->feeds = array_filter($this->feeds, function($feed) use ($feedId) {
            return $feed['id'] !== $feedId;
        });
        
        session()->flash('message', 'Feed deleted successfully!');
    }

    public function refreshFeed($feedId)
    {
        foreach ($this->feeds as &$feed) {
            if ($feed['id'] === $feedId) {
                $feed['status'] = 'active';
                $feed['last_updated'] = now()->format('Y-m-d H:i:s');
                break;
            }
        }
        
        session()->flash('message', 'Feed refreshed successfully!');
    }

    public function render()
    {
        return view('livewire.feeds-manager')
            ->layout('layouts.app', ['title' => 'Feeds Manager']);
    }
}
