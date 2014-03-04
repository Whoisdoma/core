@extends('whoisdoma::layouts.master')

@section('page_title','Whoisdoma Core Admin - Login')

@section('content')
<form method="post">
    <label for="username">Username</label>
    <input type="text" name="username"/>
    <label for="pass">Password</label>
    <input type="password" name="pass"/>
    <input type="submit" value="Login"/>
</form>
@stop

