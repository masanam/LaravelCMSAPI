@extends('layouts.app')

@section('contents')
    {{-- <section class="content-header">
        <h1>
            User
        </h1> --}}

        {{--@include('users.version')--}}
    {{-- </section> --}}
    <div class="content">
        @include('adminlte-templates::common.errors')

        <h4>User</h4>

        <div data-label="Edit" class="df-example demo-forms">
            <div class="box box-primary">
                <div class="box-body">
                    {{-- <div class="row"> --}}
                        {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'patch']) !!}

                                @include('users.fields')

                        {!! Form::close() !!}
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
