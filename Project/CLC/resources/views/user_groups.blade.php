<?php
/*
version 1.0
Ali
CST-256
February 19, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/
?>
@extends('layouts.master')
@section('title','Affinity Groups')
@component('components.security')@endcomponent

@section('navbar')
    @component('components.navbar')
        @component('components.navItem', ['title' => 'Home', 'uri' => '/CLC/home'])@endcomponent
        @component('components.navItem', ['title' => 'Profile', 'uri' => '/CLC/profile'])@endcomponent
        @component('components.navItem', ['title' => 'Log Out', 'uri' => '/CLC/logout'])@endcomponent
    @endcomponent
@endsection

@section('content')

    {{-- shows list of groups without showingId --}}
    @component('components.generalTable',['names' => array_slice(\App\Model\GroupModel::getFieldNames(), 1, 4)])



    @endcomponent

@endsection