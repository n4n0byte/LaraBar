<?php
/*
version 0.3

Connor
CST-256
February 3, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/
// header("Content-Type: text/plain; charset=utf-8");

?>

<html>
@php include('resources/assets/snippets/html_head.php');
@endphp
<head>
    <link rel="stylesheet" href="/public/css/styles.css">
    <title>Home</title>
</head>
<body>
<div class="container">
    <div class="pageTitle">
        <h1>Home</h1>
        <h3>Welcome back, @php echo $user->getFirstname() . " " . $user->getLastname() @endphp </h3>
    </div>
    <div id="welcomeHome">
        <p>Sign-in successful.</p>
    </div>
    <a href="./logout">Sign out</a>
</div>
</body>
</html>