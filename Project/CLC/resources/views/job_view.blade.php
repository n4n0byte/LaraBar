<?php
/*
version 1.0

Connor/Ali
CST-256
March 16, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/
/* @var $job \App\Model\JobModel */
?>

@component('components.security')@endcomponent
@extends('layouts.master')
@section('title',"Job #" . $job->getId());
@section('navbar')

    @component('components.navbar')

        @component('components.navItem', ['title' => 'Home', 'uri' => 'home'])@endcomponent
        @component('components.navItem', ['title' => 'Profile', 'uri' => 'profile'])@endcomponent
        @component('components.navItem', ['title' => 'Groups', 'uri' => 'userGroups'])@endcomponent

        @if(session()->get('user') && session()->get('user')->getAdmin())
            @component('components.navItem', ['title' => 'Manage Groups', 'uri' => 'manageGroups'])@endcomponent
            @component('components.navItem', ['title' => 'Administrator', 'uri' => 'admin'])@endcomponent
        @endif
        @component('components.navItem', ['title' => 'Log Out', 'uri' => 'logout'])@endcomponent

    @endcomponent
@endsection

@section('content')
    <div class="row">
        <h2>{{$job->getTitle()}}</h2>
        <h4>{{$job->getAuthor()}}</h4>
        <h4>{{$job->getLocation()}}</h4>
        <h4>{{$job->getSalary()}}</h4>
        <p>{{$job->getDescription()}}</p>
        @component('components.form', ['action' => 'search', 'status' => isset($status) ? $status : null])

        @endcomponent
    </div>
@endsection
