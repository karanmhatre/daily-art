@extends('admin.layouts.master')

@section('content')

    <div class="header">
        <h1>Invite System</h1>
        <h2>Just click, type and go</h2>
    </div>

    <div class="content">
    	<h3 class="content-subhead">Invite</h3>
    		{{ Form::open(array('route' => 'store.user.invite', 'class' => 'pure-form pure-form-aligned')) }}
			<fieldset>
				<div class="pure-control-group">
					{{ Form::label('Name', null) }}
					{{ Form::text('name', null, array('placeholder' => 'Name')) }}
				</div>
	
				<div class="pure-control-group">
					{{ Form::label('Email', null) }}
					{{ Form::email('email', null, array('placeholder' => 'Email')) }}
				</div>
	
				<button type="submit" class="pure-button pure-button-primary">Send</button>
	
			</fieldset>
	
			{{ Form::close() }}
        <h3 class="content-subhead">Invite Requests</h3>
        <table id="suggestionTable" class="pure-table" width=100%>
            <thead>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
            </thead>
            <tbody>
                @foreach($invites as  $invite)
                <tr>
                    <td>{{ $invite->id }}</td>
                    <td>{{ $invite->name }}</td>
                    <td>{{ $invite->email }}</td>
                    <td>{{ $invite->invited() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    {{useDataTables("suggestionTable")}}
@stop