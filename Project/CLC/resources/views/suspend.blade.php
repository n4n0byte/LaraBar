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
    @component('components.navbar')
        @component('components.navItem',['title' => 'Go Back','uri' => 'logout'])@endcomponent
    @endcomponent
@endsection

@section('content')
    <p>You have been banned.</p>
@endsection