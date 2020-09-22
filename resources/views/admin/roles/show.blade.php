@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            Role
        </h1>--}}

        {{--@include('admin.roles.version')--}}
    {{-- </section> --}}
    <div class="content">
        <h4>Role</h4>

        <div data-label="Show" class="df-example demo-forms roles-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row" style="padding-left: 20px"> --}}
                        @include('admin.roles.show_fields')
                        <a href="{!! route('admin.roles.index') !!}" class="btn btn-light">Back</a>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
