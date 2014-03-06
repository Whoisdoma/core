@extends('whoisdoma::layouts.master')

@section('page_title','Whoisdoma Core Admin - Overview')

@section('menu')

@if (Auth::check())
<ul class="nav navbar-nav">
    <li class="active"><a href="{{ URL::route('admin_overview') }}">Overview</a></li>
    <li><a href="{{ URL::route('admin_view_servers') }}">Servers</a></li>
    <li><a href="{{ URL::route('admin_add_server') }}">Add Server</a></li>
    <li><a href="{{ URL::route('admin_view_apikeys') }}">Api Keys</a></li>
    <li><a href="{{ URL::route('admin_add_apikey') }}">Generate Api Key</a></li>
    <li><a href="">Users</a></li>
    <li><a href="">Add User</a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> {{ Auth::user()->username }} <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="{{ URL::route('logout') }}">Logout</a></li>
        </ul>
    </li>
</ul>
@endif

@stop

@section('content')
<?php

?>
@stop
