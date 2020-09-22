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
    <!-- Year Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('year', 'Year:', ['class' => 'd-block']) !!}
            {!! Form::text('year', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Slug Field -->
        <!-- <div class="form-group col-sm-6">
            {!! Form::label('slug', 'Slug:', ['class' => 'd-block']) !!}
            {!! Form::text('slug', null, ['class' => 'form-control', 'readonly' => 'true']) !!}
        </div> -->

        <!-- Description Field -->
        <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('description', 'Description:', ['class' => 'd-block']) !!}
            <textarea name="description" class="form-control my-editor">{!! old('description', isset($milestone) ? $milestone->description : '') !!}</textarea>
        </div>
        </div>
    <div class="tab-pane fade show active" id="entab" role="tabpanel" aria-labelledby="en-tab">
    <!-- tab1 -->
        <!-- Title Field -->
        <div class="form-group col-sm-6">
        {!! Form::label('year_en', 'Year [EN]:', ['class' => 'd-block']) !!}
            {!! Form::text('year_en', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Content Field -->
        <div class="form-group col-sm-12 col-lg-12">
            {!! Form::label('description_en', 'Description [EN]:', ['class' => 'd-block']) !!}
            <textarea name="description_en" class="form-control my-editor">{!! old('description_en', isset($milestone) ? $milestone->description_en : '') !!}</textarea>
        </div>
        </div>
</div>    
<br/>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.milestones.index') !!}" class="btn btn-light">Cancel</a>
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
