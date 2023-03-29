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
            <a class="navbar-brand" href="#">Contract Kampaner</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('register')}}">Sign Up</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Banner -->
    <section class="banner mt-5">
        <div class="container">
            <h1>Welcome to Contract Kampaner</h1>
        </div>
    </section>

    <!-- Introduction -->
    <section class="introduction">
        <div class="container">
            <h2>About Us</h2>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam euismod, nulla vel porttitor pretium, nunc ante imperdiet massa, vel efficitur nibh nibh ut est. Nulla lacinia ipsum non euismod pulvinar. Suspendisse potenti. Aenean posuere mi vel odio pharetra, id bibendum mi iaculis. Integer blandit nisl sit amet enim fringilla euismod. Mauris blandit volutpat sapien, at blandit nibh dictum vel.
            </p>
        </div>
    </section>

 <!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

