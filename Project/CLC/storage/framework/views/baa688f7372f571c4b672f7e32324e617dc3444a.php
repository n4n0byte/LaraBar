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
<?php include('resources/assets/snippets/html_head.php');
?>
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="resources/assets/css/bootstrap.css">
    <script src="resources/assets/js/bootstrap.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <title>Sign in</title>
</head>
<body>
<div class="container">
    <div class="pageTitle">
        <h1>Sign in</h1>
    </div>
    <div id="loginForm" class="basicForm">
        <div class="messages">
            <?php if(isset($status) && !is_null($status)): ?>
                <p>
                    <?php
                    switch ($status) {
                        case -2:
                            echo "Please fill out all forms.";
                            break;
                        default:
                            echo "Username and password does not match.";
                            break;
                    }
                    ?>
                </p>
            <?php endif; ?>
        </div>
        <form method="POST" action="login">
            <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
            <div class="form-horizontal">
                <h3>Email</h3>
                <input max="200" name="email" title="Email" required>
            </div>
            <div class="form-horizontal">
                <h3>Password</h3>
                <input max="200" name="password" title="Password" type="password" required>
            </div>
            <div class="form-submit">
                <input title="Sign In" type="submit">
            </div>
        </form>
    </div>
    <div class="links">
        <p>New user? <a href="register">Create an account</a>.</p>
    </div>
</div>
</body>
</html>