@extends('layouts.admin');

@section('content')

    <h1> Create Posts </h1>

    {!!Form::open(['method'=>'post', 'action'=>'PostsController@store']) !!}

    <div class="form-group">
        {!! Form::label('title','Title:') !!}
        {!! Form::text('title',null,['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Create post',['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close !!}

@endsection