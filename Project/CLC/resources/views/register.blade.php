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
    <title>Create Account</title>
</head>
<body>
<div class="container">
    <div class="pageTitle">
        <h1>Create New Account</h1>
    </div>
    <div id="registerForm" class="basicForm" >
        <form method="POST" action="create_account">
            <input type="hidden" name="_token" value="@php echo csrf_token() @endphp">
            <div class="form-horizontal">
                <h3>Email</h3>
                <input max="200" name="email" type=email title="Email" required>
            </div>
            <div class="form-horizontal">
                <h3>Password</h3>
                <input max="200" name="password" title="Password" type="password">
            </div>
            <div class="form-submit">
                <input title="Sign In" type="submit">
            </div>
        </form>
    </div>
    <div class="links">
        <p>Already have an account? <a href="login">Sign-in</a>.</p>
    </div>
</div>
</body>
</html>