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
        @component('components.navItem', ['title' => 'Home', 'uri' => 'home'])@endcomponent
        @component('components.navItem', ['title' => 'Profile', 'uri' => 'profile'])@endcomponent
        @component('components.navItem', ['title' => 'Log Out', 'uri' => 'logout'])@endcomponent
    @endcomponent
@endsection

@section('content')

    @component('components.form',['method' => 'POST', 'action' => 'updateJobPostData'])
        @component('components.editTextInput',['label' => 'Title', 'data' => $post->getTitle(),
                                                  'name' => 'title'])@endcomponent
        @if($errors->first('title'))
            <div class="alert alert-warning">
                <p>{{$errors->first('title')}}</p>
            </div>
        @endif

        @component('components.editTextInput',['label' => 'Author', 'data' => $post->getAuthor(),
                                                 'name' => 'author'])@endcomponent
        @if($errors->first('author'))
            <div class="alert alert-warning">
                <p>{{$errors->first('author')}}</p>
            </div>
        @endif

        @component('components.editTextInput',['label' => 'Location', 'data' => $post->getLocation(),
                                                 'name' => 'location'])@endcomponent
        @if($errors->first('location'))
            <div class="alert alert-warning">
                <p>{{$errors->first('location')}}</p>
            </div>
        @endif

        @component('components.editTextInput',['label' => 'Description', 'data' => $post->getDescription(),
                                                 'name' => 'description'])@endcomponent
        @if($errors->first('description'))
            <div class="alert alert-warning">
                <p>{{$errors->first('description')}}</p>
            </div>
        @endif

        @component('components.editTextInput',['label' => 'Requirements', 'data' => $post->getRequirements(),
                                                 'name' => 'requirements'])@endcomponent
        @if($errors->first('requirements'))
            <div class="alert alert-warning">
                <p>{{$errors->first('requirements')}}</p>
            </div>
        @endif

        @component('components.editTextInput',['label' => 'Salary', 'data' => $post->getSalary(),
                                                 'name' => 'salary'])@endcomponent
        @if($errors->first('salary'))
            <div class="alert alert-warning">
                <p>{{$errors->first('salary')}}</p>
            </div>
        @endif

        <input type="hidden" name="id" value="{{$post->getId()}}"/>
        @component('components.submitButton')@endcomponent
    @endcomponent

@endsection