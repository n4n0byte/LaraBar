<?php
/*
version 1.0
Ali / Connor
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

    @if(!$inGroup)
        @component('components.buttons.btn',['route' => '/CLC/addUserToGroup/' . $userId . "/" . $groupId ,'class' => 'fa-plus'])
        @endcomponent
    @endif
    @if($inGroup)
        @component('components.buttons.btn',['route' => '/CLC/removeUserFromGroup/' . $userId . "/" . $groupId ,'class' => 'fa-minus'])@endcomponent
    @endif

    {{-- shows list of groups without showingId --}}
    @component('components.generalTable',['names' => \App\Model\UserModel::getFields()])

        @foreach($users as $row)
            @component('components.generalTableContent',['row' => $row->getJobFieldsArr()])
                @slot('btns')
                    @component('components.buttons.btn',['title' => "edit",
                                'route' => '/CLC/viewUsersInGroup/' . $row->getId(),'class' => 'fa fa-edit'])
                    @endcomponent
                @endslot
            @endcomponent
        @endforeach

    @endcomponent

@endsection