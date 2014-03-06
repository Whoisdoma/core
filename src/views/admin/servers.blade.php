@extends('whoisdoma::layouts.master')

@section('page_title','Whoisdoma Core Admin - View Servers')

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
    <h1>View Servers</h1>
</div>
<table class="table">
    <thead>
        <tr>
        <th>TLD</th>
        <th>Whois Server</th>
        <th>Created At</th>
        <th>Updated At</th>
        </tr>
    </thead>
    <tbody>
        <?php             
            foreach($servers as $server)
            {
                echo "<tr>
               <td>". $server->tld ."</td>
               <td>". $server->server ."</td>
               <td>". $server->created_at ."</td>
               <td>". $server->updated_at ."</td>
               <td>
               <div class='btn-group'>
               <a class='btn btn-default btn-xs' href='". url('admin/servers/edit/'. $server->id) ."'>Edit Server</a>
               <a class='btn btn-default btn-xs' href='". url('admin/servers/delete/'. $server->id) ."'>Delete Server</a>
               </div>
               </td>
               </tr>";
            }
        ?>
    </tbody>
</table>

@stop
