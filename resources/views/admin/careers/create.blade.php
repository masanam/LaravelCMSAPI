@extends('layouts.app')

@section('contents')
    {{-- <div class="content content-components"> --}}
    <div class="content">
        <div class="container">
            @include('dashforge-templates::common.errors')

            <h4 id="section1" class="mg-b-10">Career</h4>

            <p class="mg-b-30">Please, fill all required fields before click save button.</p>

            <div data-label="Create" class="df-example demo-forms careers-forms">
                {!! Form::open(['route' => 'admin.careers.store']) !!}
                    @include('admin.careers.fields')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!-- /.content -->
@endsection
