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
        @component('components.navItem', ['title' => 'Register', 'uri' => 'register'])@endcomponent
    @endcomponent
@endsection

@section('content')
    @if(isset($message) && !is_null($message))
        @if(trim($message)!= "")
            <div class="badge-warning center-message-small">
                <div class="title">
                    <h5>Login Failed</h5>
                </div>
                <div class="content">
                    <p>{{$message}}</p>
                </div>
            </div>
        @endif
    @endif
    @component('components.form',['method' => 'POST', 'action' => 'login', 'status' => isset($status) ? $status : null])
        @component('components.emailTextInput')@endcomponent
        @if($errors->first('email'))
            <div class="alert alert-warning">
                <p>{{$errors->first('email')}}</p>
            </div>
        @endif
        @component('components.editPasswordInput')@endcomponent
        @if($errors->first('password'))
            <div class="alert alert-warning">
                <p>{{$errors->first('password')}}</p>
            </div>
        @endif
        @component('components.submitButton', ['title'])@endcomponent
    @endcomponent
@endsection