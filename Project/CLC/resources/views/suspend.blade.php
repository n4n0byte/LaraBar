<?php
/*
version 1.1

Connor, Ali
CST-256
February 4, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/
?>
@extends('layouts.master')
@section('title','Banned')

@section('navbar')
@endsection

@section('body')
    <div class="container">
    <div class="message">
        <h1>You've been banned!</h1>
        <p>Maybe you were <i>too</i> casual. Try better.</p>
        <a href="/logout">Go back.</a>
    </div>
@endsection