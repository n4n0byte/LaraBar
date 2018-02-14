<?php
/*
version 1.0
Ali
CST-256
January 24, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/
$user = $data["user"];
$userProfile = $data["userProfile"];
?>
@extends('layouts.master')
@section('title','Profile')
@component('components.security')@endcomponent
@section('navbar')
    @component('components.navbar')
        @component('components.navItem', ['title' => 'Home', 'uri' => "/CLC/home"])@endcomponent
        @component('components.navItem', ['title' => 'Edit', 'uri' => '/CLC/edit'])@endcomponent
        @component('components.navItem', ['title' => 'Log Out', 'uri' => '/CLC/logout'])@endcomponent
        @if(session()->get('user')->getAdmin())
            @component('components.navItem', ['title' => 'Administrator', 'uri' => '/CLC/admin'])@endcomponent
        @endif
    @endcomponent
@endsection


@section('content')
    @component('components.personalInfoCard',['firstName' => $user->getFirstName(),
                                              'lastName' => $user->getLastName(),
                                              'email' => $user->getEmail() ])
    @endcomponent

    @component('components.profileCards',['title' => 'Biography','info' => $userProfile->getBio()])
    @endcomponent

    @component('components.profileCards',['title' => 'Education','info' => $userProfile->getEducation()])
    @endcomponent

    @component('components.profileCards',['title' => 'Location','info' => $userProfile->getlocation()])
    @endcomponent

    @component('components.profileCards',['title' => 'Employment History','info' =>
                                            $userProfile->getEmploymentHistory()])
    @endcomponent

@endsection