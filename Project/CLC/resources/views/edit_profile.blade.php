<?php
/*
version 1.0
Ali
CST-256
January 24, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/
$user = $data['user'];
$userProfile = $data['userProfile'];
?>

@extends('layouts.master')

@section('title','Profile')

@section('navbar')
    @component('components.navbar')
        @component('components.navItem', ['title' => 'Home', 'uri' => '/home'])@endcomponent
        @component('components.navItem', ['title' => 'Profile', 'uri' => '/profile'])@endcomponent
        @component('components.navItem', ['title' => 'Log Out', 'uri' => '/logout'])@endcomponent
    @endcomponent
@endsection

@section('content')

        @component('components.form',['method' => 'POST', 'action' => '/register'])
        @component('components.editTextArea',['label' => 'Biography', 'data' => $userProfile->getBio(),
                                                  'name' => 'bio'])@endcomponent
        @component('components.editTextArea',['label' => 'Employment History', 'data' => $userProfile->getEmploymentHistory(),
                                                 'name' => 'employmentHistory'])@endcomponent

        @component('components.editTextArea',['label' => 'Education', 'data' => $userProfile->getEducation(),
                                                 'name' => 'education'])@endcomponent

        @component('components.editTextInput',['label' => 'Location', 'data' => $userProfile->getLocation(),
                                                 'name' => 'location'])@endcomponent

        @component('components.submitButton')@endcomponent
    @endcomponent

@endsection