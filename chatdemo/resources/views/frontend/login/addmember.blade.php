@extends('frontend.layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ url('/backend/css/selectize.bootstrap3.css') }}">
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Add Member
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        @include('flash::message')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <form action="{{ route('addmem') }}" method="get">
                        <div class="form-group col-sm-6">	
                            {!! Form::label('member', 'Choose Member') !!}
                            <select name="check_list[]" multiple id="subject" class="form-control">
                                <option value=""></option>
                                @foreach($users as $user)
                                <option name = "user_id" value="{!! $user->id !!}">{!! $user->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-12">
                            <button type="submit" class="btn btn-success my_btn">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ url('/backend/js/displayimages.js')}}"></script>
    <script src="{{ url('/backend/js/selectize.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#subject').selectize({
                maxItems: 5
            });
        });
    </script>
@endsection