@extends('welcome')

@section('content')

    <div class="container">
        <h1>Please fill the fields! </h1>

        <form action="{{ route('save-values.post') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="text" hidden name="file_id" value="{{$file_id}}" />
            @foreach($fields as $field)
                <div class="form-group">

                @if($field['FieldType'] != 'Button')

                    <!--change label name-->
                        <label class="form-box__label db fs12" for="{{$field['FieldName']}}">{{$field['FieldName']}}</label>
                @endif

                    @switch($field['FieldType'])

                        @case('Text')
                        <input class="form-control"  type="text" name="{{$field['FieldName']}}" id="{{$field['FieldName']}}" placeholder="" />
                        @break

                        @case('Choice')

                        <select id="{{$field['FieldName']}}" name="{{$field['FieldName']}}" class="form-control">
                            @foreach($field["FieldStateOption"] as $option)
                                <option value="{{$option}}">{{__($option)}}</option>
                            @endforeach
                        </select>

                        @break
                    @endswitch
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary">Submit</button>


        </form>
    </div>


@stop

