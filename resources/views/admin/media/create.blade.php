@extends('layouts.admin')

@section('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css">

    @stop

@section('content')

    <h1> Upload Media </h1>

    {!!Form::open(['method'=>'post', 'action'=>'AdminMediasController@store','class'=>'dropzone']) !!}

    <!-- Dropzone class-t adunk neki, hogy működjön a plugin.. DE EHHEZ az admin layout-ban yield-elni kell a styles, illetve scripts-et !!!!! -->

        {!! Form::close() !!}

@stop

@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"> </script>

    @stop