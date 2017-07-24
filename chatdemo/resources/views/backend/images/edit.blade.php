@extends('backend.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Images
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($images, ['route' => ['images.update', $images->id], 'method' => 'patch']) !!}

                        @include('backend.images.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection