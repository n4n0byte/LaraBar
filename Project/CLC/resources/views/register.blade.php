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
        @component('components.navItem', ['title' => 'Log In', 'uri' => 'login'])@endcomponent
    @endcomponent
@endsection

@section('content')

    @if(isset($message) && !is_null($message))
        @if(trim($message) != "")
            <div class="badge-warning center-message-small">
                <div class="title">
                    <h5>Registration Failed</h5>
                </div>
                <div class="content">
                    <p>{{$message}}</p>
                </div>
            </div>
        @endif
    @endif

    @component('components.form',['method' => 'POST', 'action' => 'register', 'status' => isset($status) ? $status : null])


        @component('components.emailTextInput', ['data' => isset($user["email"]) ? $user["email"] : '' ])@endcomponent
        @if($errors->first('email'))
            <div class="alert alert-warning">
                <p>{{$errors->first('email')}}</p>
            </div>
        @endif
        @component('components.editTextInput',['label' => 'First Name', 'name' => 'firstName',
        'data' => isset($user["firstName"]) ? $user["firstName"] : '' ])@endcomponent
        @if($errors->first('firstName'))
            <div class="alert alert-warning">
                <p>{{$errors->first('firstName')}}</p>
            </div>
        @endif
        @component('components.editTextInput',['label' => 'Last Name', 'name' => 'lastName',
        'data' => isset($user["lastName"]) ? $user["lastName"] : '' ])@endcomponent
        @if($errors->first('lastName'))
            <div class="alert alert-warning">
                <p>{{$errors->first('lastName')}}</p>
            </div>
        @endif
        @component('components.editPasswordInput',['confirm' => true])@endcomponent
        @if($errors->first('password'))
            <div class="alert alert-warning">
                <p>{{$errors->first('password')}}</p>
            </div>
        @endif
        @component('components.submitButton',['title' => 'Done'])@endcomponent

    @endcomponent

@endsection