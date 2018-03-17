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
        @component('components.navItem', ['title' => 'Home', 'uri' => 'home'])@endcomponent
        @component('components.navItem', ['title' => 'Profile', 'uri' => 'profile'])@endcomponent
        @component('components.navItem', ['title' => 'Log Out', 'uri' => 'logout'])@endcomponent
    @endcomponent
@endsection

@section('content')

    @component('components.form', ['action' => 'editGroup'])
        <input type="hidden" value="{{$group->getId()}}" name="id"/>

        @component('components.editTextInput',['name' => 'title',
                    'label' => "Group Name", 'data' => $group->getName() ])@endcomponent
        @component('components.editTextArea',['name' => 'description',
                    'label' => "Group Description", 'data' => $group->getDescription() ])@endcomponent
        @component('components.editTextArea',['name' => 'summary',
                       'label' => "Group Summary", 'data' => $group->getSummary() ])@endcomponent

        @component('components.submitButton')@endcomponent
    @endcomponent


@endsection