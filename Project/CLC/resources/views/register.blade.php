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

    @if(isset($message) && !is_null($message))
        @if($message == "")
        @else
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

    @component('components.form',['method' => 'POST', 'action' => '/CLC/register', 'status' => isset($status) ? $status : null])


        @component('components.emailTextInput')@endcomponent
        @if($errors->first('email'))
            <div class="alert alert-warning">
                <p>{{$errors->first('email')}}</p>
            </div>
        @endif
        @component('components.editTextInput',['label' => 'First Name', 'name' => 'firstName'])@endcomponent
        @if($errors->first('firstName'))
            <div class="alert alert-warning">
                <p>{{$errors->first('firstName')}}</p>
            </div>
        @endif
        @component('components.editTextInput',['label' => 'Last Name', 'name' => 'lastName'])@endcomponent
        @if($errors->first('lastName'))
            <div class="alert alert-warning">
                <p>{{$errors->first('lastName')}}</p>
            </div>
        @endif
        @component('components.editPasswordInput',['label' => 'Last Name', 'name' => 'password'])@endcomponent
        @if($errors->first('password'))
            <div class="alert alert-warning">
                <p>{{$errors->first('password')}}</p>
            </div>
        @endif
        @component('components.submitButton',['title' => 'Done'])@endcomponent

    @endcomponent

@endsection