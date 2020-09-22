@extends('layouts.app')

@section('contents')
    {{-- <div class="content content-components"> --}}
    <div class="content">
        <div class="container">
            @include('dashforge-templates::common.errors')

            <h4 id="section1" class="mg-b-10">Type Sections</h4>

            <p class="mg-b-30">Please, fill all required fields before click save button.</p>

            <div data-label="Edit" class="df-example demo-forms parts-forms">
                {!! Form::model($part, ['route' => ['admin.parts.update', $part->id], 'method' => 'patch']) !!}
                    @include('admin.parts.fields')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!-- /.content -->
@endsection
