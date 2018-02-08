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
        @component('components.navItem',['title' => 'Go Back','uri' => '/CLC/logout'])@endcomponent
    @endcomponent
@endsection

@section('body')
    @component('components.errorMessage',['message','message'])@endcomponent
@endsection