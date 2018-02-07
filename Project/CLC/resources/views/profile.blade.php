<?php
/*
version 1.0
Ali
CST-256
January 24, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/
$user = $data['user'];
$userProfile = $data['userProfile'];
?>

@extends('layouts.master')
@section('title','Profile')

@section('navbar')
<ul class="nav nav-tabs justify-content-end ">
    <li class="nav-item">
        <a class="nav-link" href="home">Home</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="edit">Edit</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="logout">Log Out</a>
    </li>

</ul>
@endsection

@section('body')
<div class="container mx-lg-auto mt-5">

    <div class="card-deck">

        <div class="card">

            <div class="card-header">
                <h3>Personal Details</h3>
            </div>

            <div class="card-body">
                Name: <?=$user->getFirstName() . " ". $user->getLastName()?> <br>
                Email: <?=$user->getEmail()?><br>
                Employment History:<?=$userProfile->getEmploymentHistory()?>

            </div>
        </div>
    </div>

    <div class="card mt-5">

        <div class="card-header">
            <h3 class="p-2">Biography</h3>
        </div>

        <div class="card-body">

            <div class="container">
                <?=$userProfile->getBio();?>
            </div>

        </div>
    </div>

    <div class="card mt-5">

        <div class="card-header">
            <h3 class="p-2">Education</h3>
        </div>
        <div class="card-body">

            <div class="container">
                <p>
                   <?=$userProfile->getEducation()?>
                </p>
            </div>

        </div>
    </div>

    <div class="card mt-5">

        <div class="card-header">
            <h3 class="p-2">Location</h3>
        </div>
        <div class="card-body">

            <div class="container">
                <p>
                    <?=$userProfile->getLocation()?>
                </p>
            </div>

        </div>
    </div>

</div>
@endsection