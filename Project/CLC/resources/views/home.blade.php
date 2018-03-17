<?php
/*
version 0.4

Connor/Ali
CST-256
February 3, 2018
This assignment was completed in collaboration with Connor Low, Ali Cooper.
We used source code from the following websites to complete this assignment: N/A
*/
?>
@component('components.security')@endcomponent
@extends('layouts.master')
@section('title','Home')
@section('navbar')

    @component('components.navbar')

        @component('components.navItem', ['title' => 'Home', 'uri' => 'home'])@endcomponent
        @component('components.navItem', ['title' => 'Profile', 'uri' => 'profile'])@endcomponent
        @component('components.navItem', ['title' => 'Groups', 'uri' => 'userGroups'])@endcomponent

        @if(session()->get('user') && session()->get('user')->getAdmin())
            @component('components.navItem', ['title' => 'Manage Groups', 'uri' => 'manageGroups'])@endcomponent
            @component('components.navItem', ['title' => 'Administrator', 'uri' => 'admin'])@endcomponent
        @endif
        @component('components.navItem', ['title' => 'Log Out', 'uri' => 'logout'])@endcomponent

    @endcomponent
@endsection

@section('content')
    <div class="row" id="search-bar">
        {{-- Search bar --}}
        @component('components.form', ['action' => 'search', 'status' => isset($status) ? $status : null])
            @component('components.editTextInput', ['id' => 'search-input',
            'label' => "Search for positions", 'name' => 'criteria', 'placeholder' => "Search for a job..."])
            @endcomponent
            @component('components.submitButton', ['title' => "search"]) @endcomponent
        @endcomponent
    </div>
    @if(!isset($searchResults))
        <div class="row" id="results">
            <h3>Job search</h3>
            <p>Click "search" to search available job postings.</p>
        </div>
    @elseif(count($searchResults) == 0)
        <div class="row" id="results">
            <h3>Sorry friend</h3>
            <p>No results</p>
        </div>
        @component('components.search.suggested') @endcomponent
    @else
        @component("components.search.searchResult") @endcomponent
    @endif
@endsection
