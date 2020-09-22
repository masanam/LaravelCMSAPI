@php
$editing = false;
if(isset($user->id)) {
    $editing = true;
}
@endphp

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:', ['class' => 'd-block']) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:', ['class' => 'd-block']) !!}
    {!! Form::text('email', null, ['class' => 'form-control', $editing ? 'disabled' : null]) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:', ['class' => 'd-block']) !!}
    {!! Form::password('password', ['class' => 'form-control', 'autocomplete' => 'new-password']) !!}
</div>

<!-- Is Admin Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_admin', 'Is Admin:', ['class' => 'd-block']) !!}
    {!! Form::select('is_admin', ['No', 'Yes'], null, ['class' => 'form-control select2']) !!}
</div>

<!-- Tenancy Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tenancy_id', 'Tenancy Id:', ['class' => 'd-block']) !!}
    {!! Form::text('tenancy_id', null, ['class' => 'form-control', 'disabled']) !!}
</div>

<div class="clearfix"></div>
<hr>

<!-- Permissions Field -->
<div class="form-group col-sm-6">
    {!! Form::label('permissions[]', 'Permissions:') !!}
    {!! Form::select('permissions[]', $permissions->pluck('name', 'name'), null, ['class' => 'form-control select2', 'multiple', 'placeholder' => null]) !!}
</div>

<!-- Roles Field -->
<div class="form-group col-sm-6">
    {!! Form::label('roles[]', 'Roles:') !!}
    {!! Form::select('roles[]', $roles->pluck('name', 'name'), null, ['class' => 'form-control select2', 'multiple', 'placeholder' => null]) !!}
</div>

<div class="clearfix"></div>
<hr>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-light">Cancel</a>
</div>

@section('scripts')
<!-- Relational Form table -->
<script>
    $('.btn-add-related').on('click', function() {
        var relation = $(this).data('relation');
        var index = $(this).parents('.panel').find('tbody tr').length - 1;

        if($('.empty-data').length) {
            $('.empty-data').hide();
        }

        // TODO: edit these related input fields (input type, option and default value)
        var inputForm = '';
        var fields = $(this).data('fields').split(',');
        // $.each(fields, function(idx, field) {
        //     inputForm += `
        //         <td class="form-group">
        //             {!! Form::select('`+relation+`[`+relation+index+`][`+field+`]', [], null, ['class' => 'form-control select2', 'style' => 'width:100%']) !!}
        //         </td>
        //     `;
        // })
        $.each(fields, function(idx, field) {
            inputForm += `
                <td class="form-group">
                    {!! Form::text('`+relation+`[`+relation+index+`][`+field+`]', null, ['class' => 'form-control', 'style' => 'width:100%']) !!}
                </td>
            `;
        })

        var relatedForm = `
            <tr id="`+relation+index+`">
                `+inputForm+`
                <td class="form-group" style="text-align:right">
                    <button type="button" class="btn-delete btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></button>
                </td>
            </tr>
        `;

        $(this).parents('.panel').find('tbody').append(relatedForm);

        $('#'+relation+index+' .select2').select2();
    });

    $(document).on('click', '.btn-delete', function() {
        var actionDelete = confirm('Are you sure?');
        if(actionDelete) {
            var dom;
            var id = $(this).data('id');
            var relation = $(this).data('relation');

            if(id) {
                dom = `<input class="`+relation+`-delete" type="hidden" name="`+relation+`-delete[]" value="` + id + `">`;
                $(this).parents('.box-body').append(dom);
            }

            $(this).parents('tr').remove();

            if(!$('tbody tr').length) {
                $('.empty-data').show();
            }
        }
    });
</script>
<!-- End Relational Form table -->
@endsection
