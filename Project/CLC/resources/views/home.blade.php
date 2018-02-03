<?php
/*
version 0.2

Connor
CST-256
January 24, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/
?>

<html>
@php include('resources/assets/snippets/html_head.php');
@endphp
<head>
    <link rel="stylesheet" href="public/css/styles.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../resources/assets/css/bootstrap.css">
    <script src="../../resources/assets/js/bootstrap.js"></script>

    <title>Create Account</title>
</head>
<body>
<div class="container">
    <div class="pageTitle">
        <h1>Home</h1>
    </div>
    <div id="welcomeHome">
        <p>Sign-in successful.</p>

        <p>@php echo $email @endphp</p>
    </div>
    <a href="./logout">Sign out</a>
</div>
</body>
</html>