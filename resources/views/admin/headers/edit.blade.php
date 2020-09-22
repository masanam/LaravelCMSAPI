@extends('layouts.app')

@section('contents')
    {{-- <div class="content content-components"> --}}
    <div class="content">
        <div class="container">
            @include('dashforge-templates::common.errors')

            <h4 id="section1" class="mg-b-10">Header</h4>

            <p class="mg-b-30">Please, fill all required fields before click save button.</p>

            <div data-label="Edit" class="df-example demo-forms headers-forms">
                {!! Form::model($header, ['route' => ['admin.headers.update', $header->id], 'method' => 'patch']) !!}
                    @include('admin.headers.fields')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!-- /.content -->
@endsection
