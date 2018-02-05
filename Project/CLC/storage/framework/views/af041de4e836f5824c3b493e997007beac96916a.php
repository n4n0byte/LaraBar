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
<?php include('resources/assets/snippets/html_head.php');
?>
<head>
    <link rel="stylesheet" href="public/css/styles.css">
    <title>Create Account</title>
</head>
<body>
<div class="container">
    <div class="pageTitle">
        <h1>Create New Account</h1>
    </div>
    <div id="registerForm" class="basicForm">
        <?php if(isset($status) && !is_null($status)): ?>
            <p>
                <?php
                switch ($status) {
                    case -1:
                        echo "Invalid email/password. Must not contain: <pre>\" ' * \ / =</pre>.";
                        break;
                    case -2:
                        echo "Please fill out all forms.";
                        break;
                    case -11:
                        echo "Username has already been taken.";
                        break;
                    default:
                        echo "Error: failed to register. $status";
                        break;
                }
                ?>
            </p>
        <?php endif; ?>
        <form method="POST" action="register">
            <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">

            <div class="form-horizontal">
                <h3>Email</h3>
                <input max="200" name="email" type="email" title="Email" required>
            </div>

            <div class="form-horizontal">
                <h3>First Name</h3>
                <input max="200" name="firstName" type="text" title="First Name" required>
            </div>

            <div class="form-horizontal">
                <h3>Last Name</h3>
                <input max="200" name="lastName" type="text" title="Last Name" required>
            </div>


            <div class="form-horizontal">
                <h3>Password</h3>
                <input max="200" name="password" title="Password" type="password" required>
            </div>
            <div class="form-submit">
                <input title="Sign up" type="submit">
            </div>
        </form>
    </div>
    <div class="links">
        <p>Already have an account? <a href="login">Sign-in</a>.</p>
    </div>
</div>
</body>
</html>