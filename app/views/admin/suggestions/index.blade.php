@extends('admin.layouts.master')

@section('content')

    <div class="header">
        <h1>Suggestions</h1>
        <h2>Delete the ones you don't like</h2>
    </div>

    <div class="content">
    <h3 class="content-subhead">Suggestions</h3>
        <table id="suggestionTable" class="pure-table" width=100%>
            <thead>
                <th>#</th>
                <th>Name</th>
                <th>Date</th>
                <th></th>
            </thead>
            <tbody>
                @foreach($suggestions as  $suggestion)
                <tr>
                    <td>{{ $suggestion->id }}</td>
                    <td>{{ $suggestion->user->name }}</td>
                    <td>{{ $suggestion->topic }}</td>
                    <td>
                        {{ Form::open(array('route' =>['suggestions.delete', $suggestion->id],  'class' => 'pure-form pure-form-aligned')) }}
                                <button type="submit" class="pure-button pure-button-primary">Delete</button>
                        {{ Form::close() }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    {{useDataTables("suggestionTable")}}
@stop