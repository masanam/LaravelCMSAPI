@extends('layouts.app')

@section('contents')
    {{-- <div class="content content-components"> --}}
    <div class="content">
        <div class="container">
            @include('flash::message')

            @include('dashforge-templates::common.errors')

            <h4 id="section1" class="mg-b-10">Tenancy</h4>

            <p class="mg-b-30">Please, fill all required fields before click save button.</p>

            <div data-label="Edit" class="df-example demo-forms tenancies-forms">
                {!! Form::model($tenancy, ['route' => ['tenancies.update', $tenancy->id], 'method' => 'patch']) !!}
                    @include('tenancies.fields')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!-- /.content -->
@endsection
