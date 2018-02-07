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

@extends('layouts.master')
@section('title', 'Create New Account')

@section('navbar')
    @component('components.navbar')
        @component('components.navItem', ['title' => 'Log In', 'uri' => '/CLC/login'])@endcomponent
    @endcomponent
@endsection

@section('content')

        @if(isset($status) && !is_null($status))
            <p>
                <?php
                switch ($status) {
                    case -1:
                        $status = "Invalid email/password. Must not contain: <pre>\" ' * \ / =</pre>.";
                        break;
                    case -2:
                        $status = "Please fill out all forms.";
                        break;
                    case -11:
                        $status = "Username has already been taken.";
                        break;
                    default:
                        $status = "Error: failed to register. $status";
                        break;
                }
                ?>
            </p>
        @endif

        @component('components.form',['method' => 'POST', 'action' => '/CLC/register', 'status' => isset($status) ? $status : null])


            @component('components.emailTextInput')@endcomponent
            @component('components.editTextInput',['label' => 'First Name', 'name' => 'firstName'])@endcomponent
            @component('components.editTextInput',['label' => 'Last Name', 'name' => 'lastName'])@endcomponent
            @component('components.editPasswordInput',['label' => 'Last Name', 'name' => 'password'])@endcomponent
            @component('components.submitButton',['title' => 'Done'])@endcomponent

        @endcomponent

@endsection