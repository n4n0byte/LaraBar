<?php
/*
version 0.2

Ali
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
    <title>Sign in</title>
</head>
<body>
	<h1>Invalid Credentials</h1>
	<h2>@php echo $error @endphp</h2>
	<a href="./login">Retry?</a><br>
	<a href="./register">Register?</a>
	
</body>
</html>