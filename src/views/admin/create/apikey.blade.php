@extends('whoisdoma::layouts.master')

@section('page_title','Whoisdoma Core Admin - Overview')

@section('content')

@if (Auth::check())
<a href="{{ URL::route('logout') }}">Logout</a>
<a href="{{ URL::route('admin_add_server') }}">Add Server</a>
<a href="{{ URL::route('admin_add_apikey') }}">Generate Api Key</a>
@endif

<h2>Create Api Key</h2>

@if(Session::has('key'))
        <p>{{ Session::get('key') }}</p>
@endif

<form method="post">
    <p>To generate a new api key, use this page.</p>
    <input type="submit" value="Generate"/>
</form>

@stop

