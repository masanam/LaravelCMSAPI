<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:', ['class' => 'd-block']) !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

@php
    $disabled = null;
    if(!Auth::user()->is_admin) {
        $disabled = 'disabled';
    }
@endphp
<!-- Url Field -->
<div class="form-group col-sm-6">
    @if(isset($tenancy->url))
    <p>
        <img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl={{$tenancy->url}}" alt="{{$tenancy->url}}">
        <a class="btn btn-sm btn-outline-info" target="_blank" href="https://chart.googleapis.com/chart?chs=500x500&cht=qr&chl={{$tenancy->url}}">Print</a>
    </p>
    @endif
    {!! Form::label('url', 'Url:', ['class' => 'd-block']) !!}
    {!! Form::text('url', null, ['class' => 'form-control', $disabled]) !!}
</div>

<!-- Db Field -->
<div class="form-group col-sm-6">
    {!! Form::label('db', 'Db:', ['class' => 'd-block']) !!}
    {!! Form::text('db', null, ['class' => 'form-control', $disabled]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('tenancies.index') !!}" class="btn btn-light">Cancel</a>
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
