@extends('install.layouts.master')

@section('template_title')
    Fashly Installer
@endsection

@section('title')
    Fashly Installation
@endsection

@section('container')
    <p class="text-center">
        You will need the following information to complete further steps.
    </p>
    <ul class="list">
        <li class="requirement-list">
            Purchase key
        </li>
        <li class="requirement-list">
            Database Host
        </li>
        <li class="requirement-list">
            Database Name
        </li>
        <li class="requirement-list">
            Database User Name
        </li>
        <li class="requirement-list">
            Database User Password
        </li>
    </ul>
    <p class="text-center">
        <a href="{{ route('install.requirements') }}" class="button">
            Start Installation
        </a>
    </p>
@endsection
