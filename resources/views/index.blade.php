<?php
$setting = \App\Models\Setting::pluck('value','name')->toArray();
$logo = isset($setting['logo']) ? 'uploads/'.$setting['logo'] : 'assets/media/logos/logo-light.png';
$about = isset($setting['about_text']) ? $setting['about_text'] : 'Go to admin setting and write about us information';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contract Kampaner</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        /* Customize your styles here */
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .banner {
            height: 500px;
            background-image: url({{url('assets/media/bg/img--2.png')}});
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            
        }
        .introduction {
            padding: 50px 0;
            background-color: #f7f7f7;
        }
        .introduction h2 {
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top mb-5">
        <div class="container">
            <a href="{{ route('admin.dashboard') }}" class="brand-logo">
            <img alt="Logo" src="{{ asset($logo) }}"   width="200"/>
            {{-- <h3>Pay Subcription</h3> --}}
            </a>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('register')}}">Signup</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Banner -->
    <section class="banner mt-5">
        <div class="container">
            <h1></h1>
        </div>
    </section>

    <!-- Introduction -->
    <section class="introduction">
        <div class="container">
            <h2>About Us</h2>
            <p>
                {{$about}}
            </p>
        </div>
    </section>

 <!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

