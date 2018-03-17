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

    @if(!$inGroup)
        @component('components.buttons.btn',['route' => 'addUserToGroup/' . $userId . "/" . $groupId ,'class' => 'fa-plus'])
        @endcomponent
    @endif
    @if($inGroup)
        @component('components.buttons.btn',['route' => 'removeUserFromGroup/' . $userId . "/" . $groupId ,'class' => 'fa-minus'])@endcomponent
    @endif

    {{-- shows list of groups without showingId --}}
    @component('components.generalTable',['names' => \App\Model\UserModel::getFields()])

        @foreach($users as $row)
            @component('components.generalTableContent',['row' => $row->getJobFieldsArr()])
            @endcomponent
        @endforeach

    @endcomponent

@endsection