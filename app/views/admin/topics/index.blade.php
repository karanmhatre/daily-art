@extends('admin.layouts.master')

@section('content')

    <div class="header">
        <h1>Topics</h1>
        <h2>Just click, type and go</h2>
    </div>

    <div class="content">
    <h3 class="content-subhead">Topic</h3>
    	{{ Form::open(array('route' => 'topics.store', 'class' => 'pure-form pure-form-aligned')) }}
    		<fieldset>
    			<div class="pure-control-group">
    				{{ Form::label('Name', null) }}
    				{{ Form::text('name', null, array('placeholder' => 'Name')) }}
    			</div>
                <div class="pure-control-group">
                    {{ Form::label('Date', null) }}
                    <input type="date" name="date", placeholder="Date">
                </div>

    			<button type="submit" class="pure-button pure-button-primary">Send</button>

    		</fieldset>

    		{{ Form::close() }}
    <h3 class="content-subhead">Topics</h3>
        <table id="topicTable" class="pure-table" width=100%>
            <thead>
                <th>#</th>
                <th>Name</th>
                <th>Date</th>
            </thead>
            <tbody>
                @foreach($topics as  $topic)
                <tr>
                    <td>{{ $topic->id }}</td>
                    <td>{{ $topic->theme }}</td>
                    <td>{{ formatDate($topic->date)}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    {{useDataTables("topicTable")}}
@stop