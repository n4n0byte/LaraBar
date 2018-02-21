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

    @switch($category)
        @case('education')
        @component('components.profile.editEducation', ['institution' => $model->getInstitution(),
                    'level' => $model->getLevel(), 'degree' => $model->getDegree()
                    ,'id' => $model->getId()]) @endcomponent
        @break

        @case('employment')
        @component('components.profile.editEmployment',['employer' => $model->getEmployer(),
                    'level' => $model->getPosition(), 'duration' => $model->getDuration(),
                    'position' => $model->getPosition(),
                    'id' => $model->getId()] ) @endcomponent
        @break

        @case('skills')
        @component('components.profile.editSkills',['title' => $model->getTitle(),
                    'description' => $model->getDescription(),'id' => $model->getId()])
        @endcomponent
        @break

        @case('personal')
        @component('components.profile.editPersonalInfo',['id' => $model->getId()])
        @endcomponent
        @break

        @case('location')
            @component('components.profile.editLocation',['id' => $model->getId(), 'location' => $model->getLocation() ])
        @endcomponent
        @break

        @case('biography')
        @component('components.profile.editBiography',['id' => $model->getId(), 'biography' => $model->getBio() ])
        @endcomponent
        @break

    @endswitch

@endsection