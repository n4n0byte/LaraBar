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
@section('title','Profile')
@component('components.security')@endcomponent
@section('navbar')
    @component('components.navbar')
        @component('components.navItem', ['title' => 'Home', 'uri' => '/CLC/home'])@endcomponent
        @component('components.navItem', ['title' => 'Profile', 'uri' => '/CLC/profile'])@endcomponent
        @component('components.navItem', ['title' => 'Log Out', 'uri' => '/CLC/logout'])@endcomponent
    @endcomponent
@endsection

@section('content')

    @component('components.form',['method' => 'POST', 'action' => '/CLC/addJobPost'])
        @component('components.editTextInput',['label' => 'Title', 'name' => 'title'])@endcomponent
        @component('components.editTextInput',['label' => 'Author', 'name' => 'author'])@endcomponent
        @component('components.editTextInput',['label' => 'Location', 'name' => 'location'])@endcomponent
        @component('components.editTextInput',['label' => 'Description', 'name' => 'description'])@endcomponent
        @component('components.editTextInput',['label' => 'Requirements', 'name' => 'requirements'])@endcomponent
        @component('components.editNumberText',['label' => 'Salary', 'name' => 'salary'])@endcomponent
        @component('components.submitButton')@endcomponent
    @endcomponent

@endsection