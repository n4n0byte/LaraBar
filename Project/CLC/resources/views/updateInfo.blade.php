<?php
/*
version 1.0
Ali
CST-256
January 24, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/?>

@extends('layouts.master')
@section('title','Update Job Post')
@component('components.security')@endcomponent
@section('navbar')
    @component('components.navbar')
        @component('components.navItem', ['title' => 'Home', 'uri' => '/CLC/home'])@endcomponent
        @component('components.navItem', ['title' => 'Profile', 'uri' => '/CLC/profile'])@endcomponent
        @component('components.navItem', ['title' => 'Log Out', 'uri' => '/CLC/logout'])@endcomponent
    @endcomponent
@endsection

@section('content')

    @component('components.form',['method' => 'POST', 'action' => '/CLC/updateJobPostData'])
        @component('components.editTextInput',['label' => 'Title', 'data' => $post->getTitle(),
                                                  'name' => 'title'])@endcomponent
        @component('components.editTextInput',['label' => 'Author', 'data' => $post->getAuthor(),
                                                 'name' => 'author'])@endcomponent
        @component('components.editTextInput',['label' => 'Location', 'data' => $post->getLocation(),
                                                 'name' => 'location'])@endcomponent
        @component('components.editTextInput',['label' => 'Description', 'data' => $post->getDescription(),
                                                 'name' => 'description'])@endcomponent
        @component('components.editTextInput',['label' => 'Requirements', 'data' => $post->getRequirements(),
                                                 'name' => 'requirements'])@endcomponent
        @component('components.editTextInput',['label' => 'Salary', 'data' => $post->getSalary(),
                                                 'name' => 'salary'])@endcomponent
        <input type="hidden" name="id" value="{{$post->getId()}}"/>
        @component('components.submitButton')@endcomponent
    @endcomponent

@endsection