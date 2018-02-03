<?php
/*
 version 0.1
 
 Connor, Ali
 CST-256
 January 19, 2018
 This assignment was completed in collaboration with Connor Low, Ali Cooper.
 We used source code from the following websites to complete this assignment: N/A
 */
?>


<html>
@php include('resources/assets/snippets/html_head.php');
@endphp
<head>
    {{--<link rel="stylesheet" href="public/css/styles.css">--}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="resources/assets/css/bootstrap.css">
    <script src="resources/assets/js/bootstrap.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <title>Sign in</title>

</head>
<body>

<ul class="navbar nav-tabs">
    <li class="active">
        <a href="register">Sign up</a>
    </li>
    <li>
        <a href="register">Sign up</a>
    </li>
</li>

</ul>

<div class="container">

        <div class="form-horizontal">

            <form method="POST" action="login">

                <input type="hidden" name="_token" value="@php echo csrf_token() @endphp">

                <div class="form-row">
                    <div class="col-5"></div>
                    <h2>Sign In</h2>
                </div>

                <div class="form-group">
                    <h3>Email</h3>
                    <input class="form-control" max="200" name="email" title="Email">
                </div>

                <div class="form-group-sm">
                    <h3>Password</h3>
                    <input max="200" class="form-control" name="password" title="Password" type="password">
                </div>

                <input class="btn btn-block btn-outline-primary" title="Sign In" type="submit">
            </form>

        </div>

    </div>


    <div class="links">
        <p>New user? <a href="register">Create an account</a>.</p>
    </div>

<div class="container">

</div>
</body>
</html>