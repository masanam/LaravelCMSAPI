<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:', ['class' => 'd-block']) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:', ['class' => 'd-block']) !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<!-- Activation Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('activation_code', 'Activation Code:', ['class' => 'd-block']) !!}
    {!! Form::text('activation_code', null, ['class' => 'form-control']) !!}
</div>

<!-- Persist Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('persist_code', 'Persist Code:', ['class' => 'd-block']) !!}
    {!! Form::text('persist_code', null, ['class' => 'form-control']) !!}
</div>

<!-- Reset Password Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reset_password_code', 'Reset Password Code:', ['class' => 'd-block']) !!}
    {!! Form::text('reset_password_code', null, ['class' => 'form-control']) !!}
</div>

<!-- Permissions Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('permissions', 'Permissions:', ['class' => 'd-block']) !!}
    {!! Form::textarea('permissions', null, ['class' => 'form-control']) !!}
</div>

<div class="custom-control custom-checkbox">
  {!! Form::checkbox('is_activated', '1', null, ['class' => 'custom-control-input', 'id' => 'is_activated']) !!}
  <label class="custom-control-label" for="is_activated">{!! 1 !!}</label>
</div>

<!-- Activated At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('activated_at', 'Activated At:') !!}
    {!! Form::date('activated_at', null, ['class' => 'form-control date']) !!}
</div>

<!-- Last Login Field -->
<div class="form-group col-sm-6">
    {!! Form::label('last_login', 'Last Login:') !!}
    {!! Form::date('last_login', null, ['class' => 'form-control date']) !!}
</div>

<!-- Username Field -->
<div class="form-group col-sm-6">
    {!! Form::label('username', 'Username:', ['class' => 'd-block']) !!}
    {!! Form::text('username', null, ['class' => 'form-control']) !!}
</div>

<!-- Surname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('surname', 'Surname:', ['class' => 'd-block']) !!}
    {!! Form::text('surname', null, ['class' => 'form-control']) !!}
</div>

<!-- Last Seen Field -->
<div class="form-group col-sm-6">
    {!! Form::label('last_seen', 'Last Seen:') !!}
    {!! Form::date('last_seen', null, ['class' => 'form-control date']) !!}
</div>

<div class="custom-control custom-checkbox">
  {!! Form::checkbox('is_guest', '1', null, ['class' => 'custom-control-input', 'id' => 'is_guest']) !!}
  <label class="custom-control-label" for="is_guest">{!! 1 !!}</label>
</div>

<div class="custom-control custom-checkbox">
  {!! Form::checkbox('is_superuser', '1', null, ['class' => 'custom-control-input', 'id' => 'is_superuser']) !!}
  <label class="custom-control-label" for="is_superuser">{!! 1 !!}</label>
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', 'Phone:', ['class' => 'd-block']) !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>

<!-- Company Field -->
<div class="form-group col-sm-6">
    {!! Form::label('company', 'Company:', ['class' => 'd-block']) !!}
    {!! Form::text('company', null, ['class' => 'form-control']) !!}
</div>

<!-- Street Addr Field -->
<div class="form-group col-sm-6">
    {!! Form::label('street_addr', 'Street Addr:', ['class' => 'd-block']) !!}
    {!! Form::text('street_addr', null, ['class' => 'form-control']) !!}
</div>

<!-- City Field -->
<div class="form-group col-sm-6">
    {!! Form::label('city', 'City:', ['class' => 'd-block']) !!}
    {!! Form::text('city', null, ['class' => 'form-control']) !!}
</div>

<!-- Zip Field -->
<div class="form-group col-sm-6">
    {!! Form::label('zip', 'Zip:', ['class' => 'd-block']) !!}
    {!! Form::text('zip', null, ['class' => 'form-control']) !!}
</div>

<!-- State Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('state_id', 'State Id:') !!}
    {!! Form::number('state_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Country Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('country_id', 'Country Id:') !!}
    {!! Form::number('country_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Mobile Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mobile', 'Mobile:', ['class' => 'd-block']) !!}
    {!! Form::text('mobile', null, ['class' => 'form-control']) !!}
</div>

<!-- Role Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('role_id', 'Role Id:') !!}
    {!! Form::number('role_id', null, ['class' => 'form-control']) !!}
</div>

<!-- City Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('city_id', 'City Id:') !!}
    {!! Form::number('city_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Area Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('area_id', 'Area Id:') !!}
    {!! Form::number('area_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Manager Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('manager', 'Manager:', ['class' => 'd-block']) !!}
    {!! Form::textarea('manager', null, ['class' => 'form-control']) !!}
</div>

<!-- Places Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('places', 'Places:', ['class' => 'd-block']) !!}
    {!! Form::textarea('places', null, ['class' => 'form-control']) !!}
</div>

<!-- Gender Field -->
<div class="form-group col-sm-6">
    {!! Form::label('gender', 'Gender:', ['class' => 'd-block']) !!}
    {!! Form::text('gender', null, ['class' => 'form-control']) !!}
</div>

<!-- Driver Field -->
<div class="form-group col-sm-6">
    {!! Form::label('driver', 'Driver:', ['class' => 'd-block']) !!}
    {!! Form::text('driver', null, ['class' => 'form-control']) !!}
</div>

<!-- Office Field -->
<div class="form-group col-sm-6">
    {!! Form::label('office', 'Office:', ['class' => 'd-block']) !!}
    {!! Form::text('office', null, ['class' => 'form-control']) !!}
</div>

<!-- Language Field -->
<div class="form-group col-sm-6">
    {!! Form::label('language', 'Language:', ['class' => 'd-block']) !!}
    {!! Form::text('language', null, ['class' => 'form-control']) !!}
</div>

<!-- Devicetoken Field -->
<div class="form-group col-sm-6">
    {!! Form::label('devicetoken', 'Devicetoken:', ['class' => 'd-block']) !!}
    {!! Form::text('devicetoken', null, ['class' => 'form-control']) !!}
</div>

<!-- Vat Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('vat_number', 'Vat Number:', ['class' => 'd-block']) !!}
    {!! Form::text('vat_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Budget Field -->
<div class="form-group col-sm-6">
    {!! Form::label('budget', 'Budget:') !!}
    {!! Form::number('budget', null, ['class' => 'form-control']) !!}
</div>

<!-- Box Field -->
<div class="form-group col-sm-6">
    {!! Form::label('box', 'Box:') !!}
    {!! Form::number('box', null, ['class' => 'form-control']) !!}
</div>

<!-- Lang Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lang_id', 'Lang Id:') !!}
    {!! Form::number('lang_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Custom Clearance Field -->
<div class="form-group col-sm-6">
    {!! Form::label('custom_clearance', 'Custom Clearance:') !!}
    {!! Form::number('custom_clearance', null, ['class' => 'form-control']) !!}
</div>

<!-- Fiscal Representation Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fiscal_representation', 'Fiscal Representation:') !!}
    {!! Form::number('fiscal_representation', null, ['class' => 'form-control']) !!}
</div>

<!-- Payment Term Field -->
<div class="form-group col-sm-6">
    {!! Form::label('payment_term', 'Payment Term:') !!}
    {!! Form::number('payment_term', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Kg Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price_kg', 'Price Kg:') !!}
    {!! Form::number('price_kg', null, ['class' => 'form-control']) !!}
</div>

<div class="custom-control custom-checkbox">
  {!! Form::checkbox('storage_fee', '1', null, ['class' => 'custom-control-input', 'id' => 'storage_fee']) !!}
  <label class="custom-control-label" for="storage_fee">{!! 1 !!}</label>
</div>

<!-- Cost 24 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cost_24', 'Cost 24:') !!}
    {!! Form::number('cost_24', null, ['class' => 'form-control']) !!}
</div>

<!-- Cost 48 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cost_48', 'Cost 48:') !!}
    {!! Form::number('cost_48', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.users.index') !!}" class="btn btn-light">Cancel</a>
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
