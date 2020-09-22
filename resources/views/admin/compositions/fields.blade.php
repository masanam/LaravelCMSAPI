
<ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="id-tab" data-toggle="tab" href="#idtab" role="tab" aria-controls="idtab" aria-selected="true">Indonesia</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="en-tab" data-toggle="tab" href="#entab" role="tab" aria-controls="entab" aria-selected="false">English</a>
  </li>
</ul>

<div class="tab-content bd bd-gray-300 bd-t-0 pd-20" id="myTabContent">
  <div class="tab-pane fade show active" id="idtab" role="tabpanel" aria-labelledby="id-tab">
    <!-- tab1 -->
            <!-- Name Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('name', 'Name:', ['class' => 'd-block']) !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
            </div>
    <div class="tab-pane fade show active" id="entab" role="tabpanel" aria-labelledby="en-tab">
    <!-- tab1 -->
        <!-- Name Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('name_en', 'Name [EN]:', ['class' => 'd-block']) !!}
            {!! Form::text('name_en', null, ['class' => 'form-control']) !!}
        </div>
        </div>
</div>    
<br/>    

<!-- Jumlah Field -->
<div class="form-group col-sm-6">
    {!! Form::label('jumlah', 'Jumlah:', ['class' => 'd-block']) !!}
    {!! Form::text('jumlah', null, ['class' => 'form-control']) !!}
</div>

<!-- Quantity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantity', 'Quantity:', ['class' => 'd-block']) !!}
    {!! Form::text('quantity', null, ['class' => 'form-control']) !!}
</div>

<!-- Persentase Field -->
<div class="form-group col-sm-6">
    {!! Form::label('persentase', 'Persentase:', ['class' => 'd-block']) !!}
    {!! Form::text('persentase', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', $status->pluck('title', 'id'), null, ['class' => 'form-control select2']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.compositions.index') !!}" class="btn btn-light">Cancel</a>
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
