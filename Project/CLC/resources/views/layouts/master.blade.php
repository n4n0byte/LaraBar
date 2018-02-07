{{--
version 2.1

Ali, Connor
CST-256
February 4, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment:
    - https://stackoverflow.com/questions/37232235/get-particles-js-on-the-correct-layer
    - /public/css/bootstrap.css line

--}}

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/public/css/particles.css">
    <link rel="stylesheet" href="/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="/public/css/vertical.css">
    <script src="/public/js/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="/public/js/bootstrap.js"></script>
    <script src="/public/js/bootstrap.bundle.js"></script>
    <script src="/public/js/particles.js"></script>
    <script src="/public/js/tether.js"></script>
    <title>@yield('title')</title>
</head>

<body>
<div id="particles"></div>
<div id="overlay">
    @yield('navbar')

    <div class="container" style="margin: 150px auto;">
        @yield('content')
    </div>

</div>


<script type="text/javascript">
    particlesJS.load('particles','/public/particles.json');
</script>
</body>


</html>
