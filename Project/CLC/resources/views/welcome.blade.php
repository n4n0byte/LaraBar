<?php
/*
version 0.2

Connor
CST-256
January 19, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/
$title = "Larabar - Welcome";
?>

<html>
@php include('resources/assets/snippets/html_head.php');
@endphp
<meta charset="utf-8">
<body>
<div class="logoPage">
    <div class="buffer">buffer</div>
    <div class="logoHeader">
        <h1 class="title">Lara Bar</h1><br>
        <h3 class="subTitle">A Business Casual Network</h3>
    </div>
    <div class="startActions">
        <a href="./register">create account</a>
        <a href="./login">sign in</a>
    </div>
</div>
</body>
</html>