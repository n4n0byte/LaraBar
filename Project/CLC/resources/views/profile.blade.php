<?php
/*
version 1.0
Ali
CST-256
January 24, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/
/**
 * @var $user \App\Model\UserModel
 */
?>
@extends('layouts.master')
@section('title','Profile')
@component('components.security')@endcomponent
@section('navbar')
    @component('components.navbar')
        @component('components.navItem', ['title' => 'Home', 'uri' => "/CLC/home"])@endcomponent
        @component('components.navItem', ['title' => 'Edit', 'uri' => '/CLC/profile/edit'])@endcomponent
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

    @component('components.profileCards',['title' => 'Location', 'category' => 'location' ,'info' => $userProfile->getlocation() ,
     'id' => $user->getId()])
    @endcomponent

    @component('components.profileCards',['title' => 'Biography', 'category' => 'biography' ,'info' => $userProfile->getBio() ,
     'id' => $user->getId()])
    @endcomponent

    @component('components.profileCards',['title' => 'Education', 'category' => 'education' ,'info' => $userProfile->getEducation() ,
     'id' => $user->getId()])
    @endcomponent

    @component('components.profileCards',['title' => 'Employment History', 'category' => 'employment' ,
    'info' => $userProfile->getEmploymentHistory() , 'id' => $user->getId()])
    @endcomponent
@endsection