<?php
/*
version 1.0
Ali
CST-256
January 24, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/

?>
@extends('layouts.master')
@section('title','Edit Personal Info')
@component('components.security')@endcomponent
@section('navbar')
@component('components.navbar')
@component('components.navItem', ['title' => 'Home', 'uri' => '/CLC/home'])@endcomponent
@component('components.navItem', ['title' => 'Profile', 'uri' => '/CLC/profile'])@endcomponent
@component('components.navItem', ['title' => 'Log Out', 'uri' => '/CLC/logout'])@endcomponent
@endcomponent
@endsection

@section('content')

    @component('components.form',['route' => '/CLC/updatePersonalInfo'])

        @component('components.editTextInput', ['label' => 'First Name', 'name' => 'firstName'])@endcomponent
        @component('components.editTextInput', ['label' => 'Last Name', 'name' => 'lastName'])@endcomponent
        @component('components.editTextInput', ['label' => 'Email', 'name' => 'email'])@endcomponent
        @component('components.submitButton')@endcomponent

    @endcomponent

@endsection