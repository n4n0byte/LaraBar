<?php
/*
version 0.4

Connor/Ali
CST-256
February 3, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/
?>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/resources/assets/css/bootstrap.css">
    <script src="/resources/assets/js/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="/resources/assets/js/bootstrap.bundle.js"></script>
    <script src="/resources/assets/js/particles.js"></script>
    <title>Home</title>
</head>

<body>

<ul class="nav nav-tabs justify-content-end  ">
    <li class="nav-item">
        <a class="nav-link" href="home">Home</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="profile">Profile</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="logout">Log Out</a>
    </li>
    @if(isset($user) && $user->getAdmin())
        <li class="nav-item">
            <a class="nav-link" href="Admin">Administrator</a>
        </li>
    @endif
</ul>


<div class="pageTitle">

    <h1>Home</h1>
    {{--<h3>Welcome back, @php echo $user->getID() . " " .$user->getFirstname() . " " . $user->getLastname() @endphp </h3>--}}
    <?php
    $user = \App\Services\Data\Utilities\DataRetrieval::getModelByUID(3);
    $user->getEmail();
    ?>
</div>
<a href="./logout">Sign out</a>

</body>
</html>