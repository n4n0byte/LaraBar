<?php
/*
version 0.4

Connor/Ali
CST-256
February 3, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/
?>
@extends('layouts.master')
@section('title','Home')
@section('navbar')
    @component('components.navbar')
        @component('components.navItem', ['title' => 'Home', 'uri' => '/CLC/home'])@endcomponent
        @component('components.navItem', ['title' => 'Profile', 'uri' => '/CLC/profile'])@endcomponent
        @component('components.navItem', ['title' => 'Log Out', 'uri' => '/CLC/logout'])@endcomponent

        @if(isset($user) && $user->getAdmin())
            @component('components.navItem', ['title' => 'Administrator', 'uri' => '/CLC/admin'])@endcomponent
        @endif
    @endcomponent
@endsection

@section('content')
<div class="pageTitle">

    <h1>Home</h1>

</div>
@endsection