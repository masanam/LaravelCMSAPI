@extends('layouts.app')

@section('contents')
    {{-- <div class="content content-components"> --}}
    <div class="content">
        <div class="container">
            @include('dashforge-templates::common.errors')

            <h4 id="section1" class="mg-b-10">Shareby Ownerships</h4>

            <p class="mg-b-30">Please, fill all required fields before click save button.</p>

            <div data-label="Create" class="df-example demo-forms ownerships-forms">
                {!! Form::open(['route' => 'admin.ownerships.store']) !!}
                    @include('admin.ownerships.fields')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!-- /.content -->
@endsection
