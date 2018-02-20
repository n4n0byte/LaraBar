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
 * @var $userProfile \App\Model\UserProfileModel
 * @var $row \App\Model\EducationModel
 */
$user = session('user');
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

    @component('components.profileCards',['title' => 'Education', 'category' => 'education'  ,
     'id' => $user->getId()])

        {{--Adds item--}}
        @slot("btns")
            @component('components.buttons.btn',['route' => '/CLC/addJobPost/','class' => 'fa-plus'])
            @endcomponent
        @endslot

        @component('components.generalTable', ['names' => \App\Model\EducationModel::getFields()])
            @foreach($education as $row)
                @component('components.generalTableContent', ['row' => $row->getEducationFieldsArr()])
                    @slot('btns')
                        @component('components.buttons.btn',['route' => '/CLC/deleteJobPost/' . $row->getId(),
                                                             'class' => 'fa-remove'])
                        @endcomponent
                        @component('components.buttons.btn',['route' => '/CLC/updateJobPost/' . $row->getId(),
                                         'class' => 'fa-edit'])
                        @endcomponent
                    @endslot
                @endcomponent
            @endforeach
        @endcomponent
    @endcomponent

    @component('components.profileCards',['title' => 'Employment History', 'category' => 'employment' ,
     'id' => $user->getId()])

        {{--Adds item--}}
        @slot("btns")
            @component('components.buttons.btn',['route' => '/CLC/addJobPost/','class' => 'fa-plus'])
            @endcomponent
        @endslot

        @component('components.generalTable', ['names' => \App\Model\EmploymentHistoryModel::getFields()])
            @foreach($employment as $row)
                @component('components.generalTableContent', ['row' => $row->getEmploymentFieldsArr()])
                    @slot('btns')
                        @component('components.buttons.btn',['route' => '/CLC/deleteJobPost/' . $row->getId(),
                                                             'class' => 'fa-remove'])
                        @endcomponent
                        @component('components.buttons.btn',['route' => '/CLC/updateJobPost/' . $row->getId(),
                                         'class' => 'fa-edit'])
                        @endcomponent
                    @endslot
                @endcomponent
            @endforeach
        @endcomponent
    @endcomponent

    @component('components.profileCards',['title' => 'Skills', 'category' => 'skills' ,'id' => $user->getId()])

        {{--Adds item--}}
        @slot("btns")
            @component('components.buttons.btn',['route' => '/CLC/addJobPost/','class' => 'fa-plus'])
            @endcomponent
        @endslot

        @component('components.generalTable', ['names' => \App\Model\SkillsModel::getFields()])
            @foreach($skills as $row)
                @component('components.generalTableContent', ['row' => $row->getSkillFieldsArr()])
                    @slot('btns')
                        @component('components.buttons.btn',['route' => '/CLC/deleteJobPost/' . $row->getId(),
                                                             'class' => 'fa-remove'])
                        @endcomponent
                        @component('components.buttons.btn',['route' => '/CLC/updateJobPost/' . $row->getId(),
                                         'class' => 'fa-edit'])
                        @endcomponent
                    @endslot
                @endcomponent
            @endforeach
        @endcomponent
    @endcomponent

@endsection