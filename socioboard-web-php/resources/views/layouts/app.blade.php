<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'SocioBoard 5.0') }}</title>
    
    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    
    <!-- Font Awesome - Using a different approach -->
    <style>
        /* FontAwesome alternatives using Unicode */
        .fas.fa-tachometer-alt:before { content: "⚡"; }
        .fas.fa-users:before { content: "👥"; }
        .fas.fa-edit:before { content: "✏️"; }
        .fas.fa-rss:before { content: "📡"; }
        .fas.fa-chart-bar:before { content: "📊"; }
        .fas.fa-user:before { content: "👤"; }
        .fas.fa-heart:before { content: "❤️"; }
        .fas.fa-share:before { content: "🔗"; }
        .fas.fa-comment:before { content: "💬"; }
        .fas.fa-eye:before { content: "👁️"; }
        .fas.fa-sync-alt:before { content: "🔄"; }
        .fas.fa-plus:before { content: "➕"; }
        .fas.fa-plus-circle:before { content: "➕"; }
        .fas.fa-unlink:before { content: "🔗"; }
        .fas.fa-external-link-alt:before { content: "🔗"; }
        .fas.fa-info-circle:before { content: "ℹ️"; }
        .fab.fa-facebook-f:before { content: "📘"; }
        .fab.fa-twitter:before { content: "🐦"; }
        .fab.fa-instagram:before { content: "📷"; }
        .fab.fa-linkedin-in:before { content: "💼"; }
        .fab.fa-youtube:before { content: "📺"; }
        .fas.fa-paper-plane:before { content: "📨"; }
        .fas.fa-undo:before { content: "↶"; }
        .fas.fa-image:before { content: "🖼️"; }
        .fas.fa-clock:before { content: "🕒"; }
        .fas.fa-copy:before { content: "📋"; }
        .fas.fa-trash:before { content: "🗑️"; }
    </style>
    
    <!-- Custom CSS -->
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .navbar-brand {
            font-weight: bold;
            color: #667eea !important;
        }
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border-radius: 0.5rem;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }
        .social-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 10px;
        }
        .facebook { background-color: #3b5998; }
        .twitter { background-color: #1da1f2; }
        .instagram { background-color: #e4405f; }
        .linkedin { background-color: #0077b5; }
        .youtube { background-color: #ff0000; }
    </style>
    
    @livewireStyles
</head>
<body class="bg-light">
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white">SocioBoard 5.0</h4>
                        <p class="text-white-50">Social Media Management</p>
                    </div>
                    
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('livewire.dashboard') }}">
                                <i class="fas fa-tachometer-alt me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white-50" href="{{ route('livewire.social-accounts') }}">
                                <i class="fas fa-users me-2"></i>
                                Social Accounts
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white-50" href="{{ route('livewire.content-studio') }}">
                                <i class="fas fa-edit me-2"></i>
                                Content Studio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white-50" href="{{ route('livewire.feeds') }}">
                                <i class="fas fa-rss me-2"></i>
                                Feeds
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white-50" href="{{ route('livewire.reports') }}">
                                <i class="fas fa-chart-bar me-2"></i>
                                Reports
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <!-- Top navbar -->
                <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom mb-4">
                    <div class="container-fluid">
                        <span class="navbar-brand">{{ $title ?? 'Dashboard' }}</span>
                        
                        <div class="d-flex">
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-user me-2"></i>
                                    User Profile
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Profile</a></li>
                                    <li><a class="dropdown-item" href="#">Settings</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Page content -->
                <div class="container-fluid">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    
    @livewireScripts
    @stack('scripts')
</body>
</html>