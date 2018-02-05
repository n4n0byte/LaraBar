{{--
version 2.1

Ali, Connor
CST-256
February 4, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
--}}
<html lang="{{ app()->getLocale() }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/public/css/bootstrap.css">
    <script src="css/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/particles.js"></script>
    <title>Home</title>
</head>
<body>
<div class="container">
    <nav class="nav-pills">
        <ul class="nav nav-tabs justify-content-end  ">
            <li class="nav-item">
                <a class="nav-link" href="/CLC/home">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/CLC/profile">Profile</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/CLC/logout">Log Out</a>
            </li>
            @if(isset($user) && $user->getAdmin())
                <li class="nav-item">
                    <a class="nav-link" href="/CLC/admin">Administrator</a>
                </li>
            @endif
        </ul>
    </nav>
    <main>
        @yield("content");
    </main>
    <footer>
        <h3>Copyright Larabar 2018.</h3>
    </footer>
</div>
</body>
</html>