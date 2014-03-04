@extends('whoisdoma::layouts.master')

@section('page_title','Whoisdoma Core Admin - Overview')

@section('content')

@if (Auth::check())
<a href="{{ URL::route('logout') }}">Logout</a>
<a href="{{ URL::route('admin_add_server') }}">Add Server</a>
<a href="{{ URL::route('admin_add_apikey') }}">Generate Api Key</a>
@endif

<h2>Create Server</h2>

<form method="post">
    <label for="tld">TLD</label>
    <input type="text" name="tld"/>
    <label for="server">Server</label>
    <input type="text" name="server"/>
    <input type="submit" value="Add Server"/>
</form>

@stop

