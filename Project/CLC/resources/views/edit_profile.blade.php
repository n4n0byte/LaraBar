<?php
/*
version 1.0
Ali
CST-256
January 24, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/
$user = $data['user'];
$userProfile = $data['userProfile'];
?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/resources/assets/css/bootstrap.css">
    <script src="/resources/assets/js/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="/resources/assets/js/bootstrap.js"></script>
    <script src="/resources/assets/js/bootstrap.bundle.js"></script>
    <title>Create Account</title>
</head>

<body>

<ul class="nav nav-tabs justify-content-end ">
    <li class="nav-item">
        <a class="nav-link" href="home">Home</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="profile">Profile</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="logout">Log Out</a>
    </li>

</ul>



<div class="container mx-lg-auto mt-5">

    <form method="post" action="edit">
        <input type="hidden" <?=csrf_token()?>>

        <div class="form-group">
            <label class="label">Employment History</label>
            <textarea class="form-control" name="employmentHistory" cols="40" rows="5"></textarea>
        </div>

        <div class="form-group">
            <label class="label">Education</label>
            <textarea class="form-control" name="education" ></textarea>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Location</label>
            <input type="text" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Submit</button>
    </form>

</div>



</body>

</html>
