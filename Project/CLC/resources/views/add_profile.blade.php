<?php
/*
version 1.0
Connor
CST-256
February 19, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/
$user = $data['user'];
/* @var $userProfile \App\Model\UserProfileModel */
$userProfile = $data['userProfile'];
$education = $data['education'];
$employment = $data['employment'];
$category = $data['category'];

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

    @switch($category)
        @case('education')
        @component('components.profile.addEducation', ['institution' => '', 'level' => '', 'degree' => '']) @endcomponent
        @break

        @case('employment')
        @component('components.profile.addEmployment') @endcomponent
        @break

        @case('skills')
        @component('components.profile.addSkills') @endcomponent
        @break

        @default
        @component('components.profile.editProfile', ['bio' => $userProfile->getBio(), 'location' => $userProfile->getLocation()]) @endcomponent
        @break
    @endswitch

@endsection