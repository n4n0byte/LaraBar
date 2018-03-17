<?php
/*
version 1.0
Ali
CST-256
February 19, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/

?>
@extends('layouts.master')
@section('title','Admin Group View')
@component('components.security')@endcomponent
@section('navbar')
    @component('components.navbar')
        @component('components.navItem', ['title' => 'Home', 'uri' => '/CLC/home'])@endcomponent
        @component('components.navItem', ['title' => 'Profile', 'uri' => '/CLC/profile'])@endcomponent
        @component('components.navItem', ['title' => 'Log Out', 'uri' => '/CLC/logout'])@endcomponent
    @endcomponent
@endsection

@section('content')

    @component('components.buttons.btn',['route' => '/CLC/addGroup/','class' => 'fa-plus'])
    @endcomponent

    @component('components.generalTable',['names' => \App\Model\GroupModel::getFieldNames()])

        @foreach($groups as $row)

            @component('components.generalTableContent',['row' => $row->getFields()])

                @slot('btns')
                    @component('components.buttons.btn',['route' => '/CLC/editGroup/' . $row->getId(),
                                                         'class' => 'fa-edit'])
                    @endcomponent
                    @component('components.buttons.btn',['route' => '/CLC/removeGroup/' . $row->getId(),
                                     'class' => 'fa-minus'])
                    @endcomponent

                @endslot

            @endcomponent
        @endforeach

    @endcomponent

@endsection