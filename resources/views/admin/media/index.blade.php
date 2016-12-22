@extends('layouts.admin')

@section('content')

    <h1> Media </h1>

    @if($photos)

    <table class="table">
        <thead>
          <tr>
              <th>ID</th>
            <th>Name</th>
            <th>Created Date</th>
          </tr>
        </thead>
        <tbody>

        @foreach($photos as $photo)

          <tr>
            <td>{{$photo->id}}</td>
            <td> <img height="50" src="{{$photo->file}}"> </td>
            <td>{{$photo->created_at ? $photo->created_at : 'no date'}}</td>
          </tr>

            @endforeach

        </tbody>
      </table>

    @endif

    @endsection