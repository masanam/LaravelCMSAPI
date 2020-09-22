@extends('layouts.app')

@section('contents')
    {{-- <div class="content content-components"> --}}
    <div class="content">
        <div class="container">
            @include('dashforge-templates::common.errors')

            <h4 id="section1" class="mg-b-10">Distribution</h4>

            <p class="mg-b-30">Please, fill all required fields before click save button.</p>

            <div data-label="Create" class="df-example demo-forms distributions-forms">
                {!! Form::open(['route' => 'admin.distributions.store']) !!}
                    @include('admin.distributions.fields')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!-- /.content -->
@endsection
