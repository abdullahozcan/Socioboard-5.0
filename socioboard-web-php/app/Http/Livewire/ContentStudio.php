<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class ContentStudio extends Component
{
    use WithFileUploads;

    public $postContent = '';
    public $selectedPlatforms = [];
    public $scheduleDateTime = '';
    public $uploadedImage;
    public $posts = [];
    
    public $availablePlatforms = [
        'facebook' => ['name' => 'Facebook', 'icon' => 'fab fa-facebook-f', 'color' => 'facebook'],
        'twitter' => ['name' => 'Twitter', 'icon' => 'fab fa-twitter', 'color' => 'twitter'],
        'instagram' => ['name' => 'Instagram', 'icon' => 'fab fa-instagram', 'color' => 'instagram'],
        'linkedin' => ['name' => 'LinkedIn', 'icon' => 'fab fa-linkedin-in', 'color' => 'linkedin']
    ];

    public function mount()
    {
        $this->loadPosts();
        $this->scheduleDateTime = now()->addHour()->format('Y-m-d\TH:i');
    }

    public function loadPosts()
    {
        // Mock data for posts
        $this->posts = [
            [
                'id' => 1,
                'content' => 'Just launched our new product! Check it out at our website.',
                'platforms' => ['facebook', 'twitter'],
                'status' => 'published',
                'scheduled_at' => '2024-01-15 10:00:00',
                'engagement' => ['likes' => 45, 'shares' => 12, 'comments' => 8],
                'image' => null
            ],
            [
                'id' => 2,
                'content' => 'Behind the scenes of our latest campaign. Stay tuned for more updates!',
                'platforms' => ['instagram', 'facebook'],
                'status' => 'scheduled',
                'scheduled_at' => '2024-01-16 14:30:00',
                'engagement' => ['likes' => 0, 'shares' => 0, 'comments' => 0],
                'image' => 'campaign-behind-scenes.jpg'
            ],
            [
                'id' => 3,
                'content' => 'Thank you to all our customers for the amazing feedback!',
                'platforms' => ['linkedin', 'twitter'],
                'status' => 'draft',
                'scheduled_at' => null,
                'engagement' => ['likes' => 0, 'shares' => 0, 'comments' => 0],
                'image' => null
            ]
        ];
    }

    public function createPost()
    {
        $this->validate([
            'postContent' => 'required|min:1|max:500',
            'selectedPlatforms' => 'required|array|min:1'
        ]);

        // Simulate creating a post
        $newPost = [
            'id' => count($this->posts) + 1,
            'content' => $this->postContent,
            'platforms' => $this->selectedPlatforms,
            'status' => $this->scheduleDateTime > now() ? 'scheduled' : 'published',
            'scheduled_at' => $this->scheduleDateTime,
            'engagement' => ['likes' => 0, 'shares' => 0, 'comments' => 0],
            'image' => $this->uploadedImage ? $this->uploadedImage->getClientOriginalName() : null
        ];

        array_unshift($this->posts, $newPost);

        // Reset form
        $this->reset(['postContent', 'selectedPlatforms', 'uploadedImage']);
        $this->scheduleDateTime = now()->addHour()->format('Y-m-d\TH:i');

        session()->flash('message', 'Post created successfully!');
    }

    public function deletePost($postId)
    {
        $this->posts = array_filter($this->posts, function($post) use ($postId) {
            return $post['id'] !== $postId;
        });
        
        session()->flash('message', 'Post deleted successfully!');
    }

    public function duplicatePost($postId)
    {
        $originalPost = collect($this->posts)->firstWhere('id', $postId);
        
        if ($originalPost) {
            $duplicatedPost = $originalPost;
            $duplicatedPost['id'] = count($this->posts) + 1;
            $duplicatedPost['status'] = 'draft';
            $duplicatedPost['scheduled_at'] = null;
            $duplicatedPost['engagement'] = ['likes' => 0, 'shares' => 0, 'comments' => 0];
            
            array_unshift($this->posts, $duplicatedPost);
            session()->flash('message', 'Post duplicated successfully!');
        }
    }

    public function render()
    {
        return view('livewire.content-studio')
            ->layout('layouts.app', ['title' => 'Content Studio']);
    }
}
