<?php
/*
version 0.3

Connor
CST-256
February 3, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/
?>
<html>
<?php include('resources/assets/snippets/html_head.php');
?>
<head>
    <link rel="stylesheet" href="public/css/styles.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="resources/assets/css/bootstrap.css">
    <script src="resources/assets/js/bootstrap.js"></script>
    <title>Create Account</title>
</head>
<body>
<div class="container">
    <div class="pageTitle">
        <h1>Home</h1>
        <h3>Welcome back, <?php echo $user->getFirstname() . " " . $user->getLastname() ?> </h3>
    </div>
    <a href="./logout">Sign out</a>
</div>
</body>
</html>