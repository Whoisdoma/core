@extends('whoisdoma::layouts.master')

@section('page_title','Whoisdoma Core Admin - View Users')

@section('menu')

@if (Auth::check())
<ul class="nav navbar-nav">
    <li><a href="{{ URL::route('admin_overview') }}">Overview</a></li>
    <li class="active"><a href="{{ URL::route('admin_view_servers') }}">Servers</a></li>
    <li><a href="{{ URL::route('admin_add_server') }}">Add Server</a></li>
    <li><a href="{{ URL::route('admin_view_apikeys') }}">Api Keys</a></li>
    <li><a href="{{ URL::route('admin_add_apikey') }}">Generate Api Key</a></li>
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
<div class="page-header">
    <h1>View Users</h1>
</div>
<table class="table">
    <thead>
        <tr>
        <th>Username</th>
        <th>Email</th>
        <th>Created At</th>
        <th>Updated At</th>
        </tr>
    </thead>
    <tbody>
        <?php             
            foreach($users as $user)
            {
                echo "<tr>
               <td>". $user->username ."</td>
               <td>". $user->email ."</td>
               <td>". $user->created_at ."</td>
               <td>". $user->updated_at ."</td>
               <td>
               <div class='btn-group'>
               <a class='btn btn-default btn-xs' href='". url('admin/users/edit/'. $user->id) ."'>Edit User</a>
               <a class='btn btn-default btn-xs' href='". url('admin/users/delete/'. $user->id) ."'>Delete User</a>
               </div>
               </td>
               </tr>";
            }
        ?>
    </tbody>
</table>

@stop
