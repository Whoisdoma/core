@extends('whoisdoma::layouts.master')

@section('page_title','Whoisdoma Core Admin - Overview')

@section('content')

@if (Auth::check())
<a href="{{ URL::route('logout') }}">Logout</a>
<a href="{{ URL::route('admin_add_server') }}">Add Server</a>
<a href="{{ URL::route('admin_add_apikey') }}">Generate Api Key</a>
@endif

@stop
