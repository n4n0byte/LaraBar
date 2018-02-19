<?php
/*
version 1.2

Connor, Ali
CST-256
February 16, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/

?>
@extends('layouts.master')
@section('title','Admin')
@component('components.security')@endcomponent
@section('navbar')

    {{--inserts navbar component with links--}}
    @component('components.navbar')
        @component('components.navItem', ['title' => 'Home', 'uri' => '/CLC/home'])@endcomponent
        @component('components.navItem', ['title' => 'Profile', 'uri' => '/CLC/profile'])@endcomponent
        @component('components.navItem', ['title' => 'Log Out', 'uri' => '/CLC/logout'])@endcomponent
        @if(isset($user) && $user->getAdmin())
            @component('components.navItem', ['title' => 'Administrator', 'uri' => 'admin'])@endcomponent
        @endif

    @endcomponent

@endsection

{{--inserts admin body--}}
@section('content')

    <div>
        <a href="#" id="toggle"><label><h3>Toggle</h3></label></a>
    </div>

    <div id="adminTableDiv">
        @component('components.adminTable')
            @if(isset($message))
                @component('components.errorMessage',['message' => $message])@endcomponent
            @endif
            <h3 class="label" id="userList">Users List</h3>
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
    </div>

    <div id="jobPosts" style="display: none;">
        <h3 class="label">Job Posts
            <span>
                @component('components.buttons.btn',['route' => '/CLC/admin/addJobPost/','class' => 'fa-plus'])
                @endcomponent
            </span>
        </h3>
        @component('components.generalTable',['names' => \App\Model\JobModel::getFields(), 'links' => true, 'id' => 'jobTable'])

            @foreach($jobData as $job)
                @component('components.generalTableContent',['row' => $job->getJobFieldsArr()])
                    @slot('btns')
                        @component('components.buttons.btn',['route' => '/CLC/admin/deleteJobPost/' . $job->getId(),
                                                             'class' => 'fa-remove'])
                        @endcomponent
                        @component('components.buttons.btn',['route' => '/CLC/admin/updateJobPost/' . $job->getId(),
                                         'class' => 'fa-edit'])
                        @endcomponent
                    @endslot
                @endcomponent
            @endforeach

        @endcomponent
    </div>

    <script type="text/javascript">

        $( document ).ready(function() {
            var showUsers = true;
            var adminList = $("#adminTableDiv");
            var jobList = $("#jobPosts");

            $("#toggle").click(function () {
                adminList.toggle();
                jobList.toggle();
            });

        });

    </script>
    
@endsection