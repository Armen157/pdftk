@extends('welcome')

@section('content')

    <div class="container">

        <h1>Download your PDF file with filled fields!</h1>
        <button type="submit" class="btn btn-success"><a href="/generating/{{$file_name}}" download="{{$file_name}}">Download PDF</a></button>

    </div>

@stop
