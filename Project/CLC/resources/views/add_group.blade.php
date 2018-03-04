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
@section('title','Profile')
@component('components.security')@endcomponent
@section('navbar')
    @component('components.navbar')
        @component('components.navItem', ['title' => 'Home', 'uri' => '/CLC/home'])@endcomponent
        @component('components.navItem', ['title' => 'Profile', 'uri' => '/CLC/profile'])@endcomponent
        @component('components.navItem', ['title' => 'Manage Groups', 'uri' => '/CLC/manageGroups'])@endcomponent
        @component('components.navItem', ['title' => 'Log Out', 'uri' => '/CLC/logout'])@endcomponent
    @endcomponent
@endsection

@section('content')

    @component('components.form',['action' => "/CLC/addGroup"])

        @component('components.editTextInput',['label' => "Group Name",
                                                'name' => "name"])
        @endcomponent
        @component('components.editTextInput',['label' => "Owner",
                                         'name' => "owner"])
        @endcomponent
        @component('components.editTextArea',['label' => "Group Description",
                                                'name' => "description"])
        @endcomponent
        @component('components.editTextArea',['label' => "Group Summary",
                                                'name' => "summary"])
        @endcomponent

        @component('components.submitButton')@endcomponent

    @endcomponent

@endsection