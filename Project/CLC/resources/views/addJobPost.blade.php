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
        @component('components.navItem', ['title' => 'Home', 'uri' => '/CLC/home'])@endcomponent
        @component('components.navItem', ['title' => 'Profile', 'uri' => '/CLC/profile'])@endcomponent
        @component('components.navItem', ['title' => 'Log Out', 'uri' => '/CLC/logout'])@endcomponent
    @endcomponent
@endsection

@section('content')

    @component('components.form',['method' => 'POST', 'action' => '/CLC/addJobPost'])
        @component('components.editTextInput',['label' => 'Title', 'name' => 'title'])@endcomponent
        @if($errors->first('title'))
            <div class="alert alert-warning">
                <p>{{$errors->first('title')}}</p>
            </div>
        @endif

        @component('components.editTextInput',['label' => 'Author', 'name' => 'author'])@endcomponent
        @if($errors->first('author'))
            <div class="alert alert-warning">
                <p>{{$errors->first('author')}}</p>
            </div>
        @endif

        @component('components.editTextInput',['label' => 'Location', 'name' => 'location'])@endcomponent
        @if($errors->first('location'))
            <div class="alert alert-warning">
                <p>{{$errors->first('location')}}</p>
            </div>
        @endif

        @component('components.editTextInput',['label' => 'Description', 'name' => 'description'])@endcomponent
        @if($errors->first('description'))
            <div class="alert alert-warning">
                <p>{{$errors->first('description')}}</p>
            </div>
        @endif

        @component('components.editTextInput',['label' => 'Requirements', 'name' => 'requirements'])@endcomponent
        @if($errors->first('requirements'))
            <div class="alert alert-warning">
                <p>{{$errors->first('requirements')}}</p>
            </div>
        @endif

        @component('components.editNumberText',['label' => 'Salary', 'name' => 'salary'])@endcomponent
        @if($errors->first('salary'))
            <div class="alert alert-warning">
                <p>{{$errors->first('salary')}}</p>
            </div>
        @endif

        @component('components.submitButton')@endcomponent
    @endcomponent


@endsection