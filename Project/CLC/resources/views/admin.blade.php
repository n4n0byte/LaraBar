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
        @component('components.navItem', ['title' => 'Home', 'uri' => 'home'])@endcomponent
        @component('components.navItem', ['title' => 'Profile', 'uri' => 'profile'])@endcomponent
        @component('components.navItem', ['title' => 'Log Out', 'uri' => 'logout'])@endcomponent
        @if(isset($user) && $user->getAdmin())
            @component('components.navItem', ['title' => 'Administrator', 'uri' => 'admin'])@endcomponent
        @endif

    @endcomponent

@endsection

{{--inserts admin body--}}
@section('content')
    <div class="container" style="background: #f8f9fa; border-radius: 8px 8px 0 0; margin: 0 auto">
        <h4 align="center">Manager</h4>
        <div class="row" style="margin: 0px auto;">
            <div class="col-md-12">
                <ul class="nav nav-tabs nav-fill">
                    <li class="nav-item">
                        <a href="#" class="nav-link active" id="showUserList">User List</a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link" id="showJobList">Job Posts</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div id="adminTableDiv">
        @component('components.adminTable')
            @if(isset($message))
                @component('components.errorMessage',['message' => $message])@endcomponent
            @endif
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
        <div class="container" style="background: #fff; text-align: right; font-size: 24px ; margin: 0 auto">
            <span id="btn" style="margin-right: 25%">@component('components.buttons.btn',
            ['route' => 'addJobPost/',
            'class' => 'fa-plus'])
                @endcomponent</span>
        </div>
        @component('components.generalTable',['names' => \App\Model\JobModel::getFields(), 'links' => true, 'id' => 'jobTable'])

            @foreach($jobData as $job)
                @component('components.generalTableContent',['row' => $job->getJobFieldsArr()])
                    @slot('btns')
                        @component('components.buttons.btn',['route' => 'deleteJobPost/' . $job->getId(),
                                                             'class' => 'fa-remove'])
                        @endcomponent
                        @component('components.buttons.btn',['route' => 'updateJobPost/' . $job->getId(),
                                         'class' => 'fa-edit'])
                        @endcomponent
                    @endslot
                @endcomponent
            @endforeach

        @endcomponent
    </div>


    <script type="text/javascript">

        $(document).ready(function () {
            var showUsers = true;
            var adminList = $("#adminTableDiv");
            var jobList = $("#jobPosts");
            var user = $("#showUserList");
            var job = $("#showJobList");
            var modal = $("#myModal");
            var btn = $("#btn");

            user.click(function () {
                user.addClass('active');
                job.removeClass('active');
                adminList.show();
                jobList.hide();
            });
            job.click(function () {
                user.removeClass('active');
                job.addClass('active');
                adminList.hide();
                jobList.show();
            });

        });

    </script>

@endsection