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
@extends('layouts.master')
@section('title','Login')

@section('navbar')

    @component('components.navbar')
        @component('components.navItem', ['title' => 'Register', 'uri' => '/register'])@endcomponent
    @endcomponent
@endsection

    @if(isset($status) && !is_null($status))
        <?php
            switch ($status) {
            case -2:
                $status = "Please fill out all forms.";
                break;
            default:
                $status = "Username and password does not match.";
                break;
         }
        ?>
    @endif
@section('content')
    @component('components.form',['method' => 'POST', 'action' => '/login', 'status' => isset($status) ? $status : null])
            @component('components.emailTextInput')@endcomponent
            @component('components.editPasswordInput')@endcomponent
            @component('components.submitButton', ['title'])@endcomponent
    @endcomponent
@endsection