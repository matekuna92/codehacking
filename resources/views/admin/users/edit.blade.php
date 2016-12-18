@extends('layouts.admin')


@section('content')

    <h1> Edit Users </h1>

<div class="row"> <!-- Kellett még 1 nagy div az egész köré, az eredeti form-on belül jelentek meg a hibák ! --->
        <div class="col-sm-3">

            <img src="{{$user->photo ? $user->photo->file : 'http://placehold.it/400x400'}}" class="img-responsive img-rounded">

        </div>

        <div class="col-sm-9">

            <!-- Model Binding ... adminuserscontroller-ben meg is írjuk ezután az edit részt... POST módosult patch-re -->
            {!! Form::model($user, ['method'=>'PATCH', 'action'=> ['AdminUsersController@update', $user->id],'files'=>true]) !!}

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
                {!! Form::select('role_id', $roles ,null,['class'=>'form-control']) !!}
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
                {!! Form::submit('Create User',['class'=>'btn btn-primary col-sm-6']) !!}
            </div>

            {!! Form::close() !!}

            {!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy',$user->id]]) !!}
        <!-- Missing required parameters for [Route: admin.users.destroy] [URI: admin/users/{users}]...
        emiatt kellett külön []-be az adminusercontrollert + a userid-t átadni plusz paraméterként !!! -->

            <div class="form-group">
                <div class="form-group">
                    {!! Form::submit('Delete user',['class'=>'btn btn-danger col-sm-6']) !!}
                </div>
                {!! Form::close() !!}
            </div>

        </div>
</div>
    <!-- DISPLAYING ERRORS -->
<div class="row">
    @include('includes.form_error')
</div>
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