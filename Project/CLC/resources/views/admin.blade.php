<   ?php
/*
version 1.1

Connor, Ali
CST-256
February 4, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/
use \App\Services\Business\SuspendUserBusinessService;
?>
@extends('layouts.master')
@section('title','Admin')

@section('navbar')

    {{--inserts navbar component with links--}}
    @component('components.navbar')
        @component('components.navItem', ['title' => 'Home', 'uri' => '/home'])@endcomponent
        @component('components.navItem', ['title' => 'Profile', 'uri' => '/profile'])@endcomponent
        @component('components.navItem', ['title' => 'Log Out', 'uri' => '/logout'])@endcomponent
        @component('components.navItem', ['title' => 'Home', 'uri' => '/home'])@endcomponent
        @if(isset($user) && $user->getAdmin())
            @component('components.navItem', ['title' => 'Administrator', 'uri' => '/admin'])@endcomponent
        @endif

    @endcomponent

@endsection

{{--inserts admin body--}}
@section('content')
    @component('components.adminTable')

        @if(isset($userList))
            @foreach ($userList as $user)
                {{--Injects instance of a suspended user service--}}
                @inject('susService','\App\Services\Business\SuspendUserBusinessService')
                @component('components.adminTableRow',['id' => $user->getId(),
                                                        'email' => $user->getEmail(),
                                                        'isAdmin' => $user->getAdmin(),
                                                         'isSuspended' => $susService->suspensionStatus($user)])
                @endcomponent
            @endforeach
        @endif

    @endcomponent
@endsection