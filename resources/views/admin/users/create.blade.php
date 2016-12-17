@extends('layouts.admin')


@section('content')

<h1> Create Users </h1>

    {!! Form::open(['method'=>'post', 'action'=>'AdminUsersController@store','files'=>true]) !!}

    <div class="form-group">
        {!! Form::label('name','Name:') !!}
        {!! Form::text('name',null,['class'=>'form-control']) !!}
        </div>

    <div class="form-group">
        {!! Form::label('email','Email') !!}
        {!! Form::text('email',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('role_id','Role:') !!}
        {!! Form::select('role_id',[''=>'Choose options'] + $roles ,null,['class'=>'form-control']) !!}
    </div>

<!-- konkatenálhatjuk a selecthez a roles-t pluszba.. ehhez előbb a controllerben létre kellett hozni a $roles sort -->

    <div class="form-group">
        {!! Form::label('is_active','Status') !!}
        {!! Form::select('is_active',array(1=>'Active', 0=>'Not Active'),null,['class'=>'form-control']) !!}
        <!-- 1,0 egy érték... az active not active pedig amit a user lát... key=>value párosítás -->
    </div>

    <div class="form-group">
        {!! Form::label('photo_id','Photo') !!}
        {!! Form::file('photo_id',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password','Password') !!}
        {!! Form::password('password', ['class'=>'form-control']) !!}
    </div>

        <div class="form-group">
            {!! Form::submit('Create User',['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    <!-- DISPLAYING ERRORS -->

    @include('includes.form_error')

   <!--
    beletesszük inkább egy külön file-ba, itt csak include-oljuk !

   if(count($errors) >0 )
        <div class="alert alert-danger">
            <ul>

            foreach($errors->all() as $error)
                    <li> {$error}}  </li>
            endforeach

            </ul>

        </div>

    endif -->

@endsection