<!DOCTYPE html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Twitter -->
    <meta name="twitter:site" content="@kino.co.id">
    <meta name="twitter:creator" content="@kino.co.id">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="kino.co.id">
    <meta name="twitter:description" content="kino.co.id platform">
    <meta name="twitter:image" content="https://dummyimage.com/600x100/f5f5f5/999999&text=kino.co.id">

    <!-- Facebook -->
    <meta property="og:url" content="http://localhost/kino.co.id/public">
    <meta property="og:title" content="kino.co.id">
    <meta property="og:description" content="kino.co.id platform">

    <meta property="og:image" content="https://dummyimage.com/600x100/f5f5f5/999999&text=kino.co.id">
    <meta property="og:image:secure_url" content="https://dummyimage.com/600x100/f5f5f5/999999&text=kino.co.id">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="kino.co.id platform">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <title>PT Kino Indonesia</title>

    <!-- vendor css -->
    <link href="{{ asset('vendor/dashforge/lib/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/dashforge/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">

    <link href="{{ asset('vendor/dashforge/lib/datatables.net-dt/css/jquery.dataTables.min.css') }}" rel="stylesheet">

    <!-- include Fancybox -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/fancybox/jquery.fancybox.min.css') }}">

    <!-- Date Time Picker -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/datetimepicker/css/bootstrap-datetimepicker.css') }}">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/select2/select2.min.css') }}">

    <!-- include Multi-select -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/multi-select/css/multi-select.css') }}">

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/dashforge/assets/css/dashforge.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/dashforge/assets/css/dashforge.demo.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/dashforge/assets/css/dashforge.dashboard.css') }}">

    <link rel="stylesheet" href="{{ asset('home/css/clockpicker.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/bootstrap-tagsinput.css') }}">



    <style>
    .dataTables_wrapper th[title="Action"] {
        width: 90px !important;
        min-width: 90px !important;
    }
    table.dataTable thead .column-search th,
    table.dataTable thead .column-search td,
    table.dataTable tfoot th,
    table.dataTable tfoot td {
        border-top: 1px solid rgba(72, 94, 144, 0.16);
    }
    </style>

    @yield('styles')
    @yield('style')
    @yield('css')
  </head>
  <body>
    @include('layouts.dashforge-templates.sidebar')
    <div class="content ht-100v pd-0">
      <div class="content-header">
        <div class="content-search">
          <i data-feather="search"></i>
          <input type="search" class="form-control" placeholder="Search...">
        </div>
        {{-- <nav class="nav">
          <a href="" class="nav-link"><i data-feather="help-circle"></i></a>
          <a href="" class="nav-link"><i data-feather="grid"></i></a>
          <a href="" class="nav-link"><i data-feather="align-left"></i></a>
        </nav> --}}
      </div><!-- content-header -->

      @yield('contents')
    </div>

    <script src="{{ asset('vendor/dashforge/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/dashforge/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


    <script src="{{ asset('vendor/dashforge/lib/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('vendor/dashforge/lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('vendor/dashforge/lib/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/dashforge/lib/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('vendor/dashforge/lib/jquery.flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('vendor/dashforge/lib/jquery.flot/jquery.flot.resize.js') }}"></script>

    <script src="{{ asset('vendor/dashforge/assets/js/dashforge.js') }}"></script>
    <script src="{{ asset('vendor/dashforge/assets/js/dashforge.aside.js') }}"></script>
    <script src="{{ asset('vendor/dashforge/assets/js/dashforge.sampledata.js') }}"></script>

    <!-- Fancybox -->
    <script src="{{ asset('vendor/adminlte/plugins/fancybox/jquery.fancybox.min.js') }}"></script>

    <!-- Date Time Picker -->
    <script src="{{ asset('vendor/adminlte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/plugins/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('vendor/adminlte/plugins/select2/select2.min.js') }}"></script>

    <script src="{{ asset('home/css/select2/js/select2.min.js') }}"></script>

    <!-- Multi-select -->
    <script src="{{ asset('vendor/adminlte/plugins/multi-select/js/jquery.multi-select.js') }}"></script>

    <!-- append theme customizer -->
    <script src="{{ asset('vendor/dashforge/lib/js-cookie/js.cookie.js') }}"></script>

    <script src="{{ asset('home/js//clockpicker.js') }}"></script>
    <script src="{{ asset('home/js//bootstrap-tagsinput.js') }}"></script>

    {{-- <script src="{{ asset('vendor/dashforge/assets/js/dashforge.settings.js') }}"></script> --}}

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            // start summernote
            var snfmContext;

            var fileManager = function(context) {
                snfmContext = context;

                var ui = $.summernote.ui;

                // create button
                var button = ui.button({
                    contents: '<i class="fa fa-photo"/>',
                    tooltip: 'File Manager',
                    click: function() {
                        $('.sn-filemanager').trigger('click');
                    }
                });

                return button.render();
            }

            // $('.rte').summernote({
            //     height: 250,
            //     minHeight: 100,
            //     maxHeight: 300,
            //     toolbar: [
            //         ['style', ['bold', 'italic', 'underline', 'clear']],
            //         ['fontsize', ['fontsize']],
            //         ['color', ['color']],
            //         ['para', ['ul', 'ol', 'paragraph']],
            //         ['table', ['table']],
            //         ['insert', ['link', 'hr']],
            //         ['image', ['fm']],
            //         ['video', ['video']],
            //         ['misc', ['fullscreen', 'codeview']]
            //     ],
            //     buttons: {
            //         fm: fileManager
            //     }
            // });

            $('.sn-filemanager').fancybox({
                type : 'iframe',
                afterClose: function() {
                    var snfmImage = $('#snfmImage-thumb').find('img').attr('src');
                    snfmContext.invoke('editor.insertImage', snfmImage, snfmImage.substr(snfmImage.lastIndexOf('/') + 1));
                }
            });
            // end summernote

            $('#dataTableBuilder').wrap('<div class="table-responsive"></div>');

            $('.filemanager').fancybox({
                type : 'iframe'
            });

            $(".select2").select2();

            $(".multi-select").multiSelect({
                selectableHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='Search...'>",
                selectionHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='Search...'>",
                afterInit: function(ms){
                    var that = this,
                        $selectableSearch = that.$selectableUl.prev(),
                        $selectionSearch = that.$selectionUl.prev(),
                        selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                        selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

                    that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function(e){
                        if (e.which === 40){
                            that.$selectableUl.focus();
                            return false;
                        }
                    });

                    that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function(e){
                        if (e.which == 40){
                            that.$selectionUl.focus();
                            return false;
                        }
                    });
                },
                afterSelect: function(){
                    this.qs1.cache();
                    this.qs2.cache();
                },
                afterDeselect: function(){
                    this.qs1.cache();
                    this.qs2.cache();
                }
            });

            // $(".date").datepicker({
            //     format:	'yyyy-mm-dd'
            // });

            $(".date").datetimepicker({
                format:	'YYYY-MM-DD'
            });

            $(".datetime").datetimepicker({
                // format:	'YYYY-MM-DDTHH:mm:ss.XZ'
                format:	'YYYY-MM-DD HH:mm:ss'
            });

            $(".time").datetimepicker({
                // format:	'HH:mm:ss'
                format:	'HH:mm'
            });

            // $(".currency").inputmask({ alias : "currency", prefix: "", digits: 0 });

            // $('#filer_input').fileuploader({
            //     enableApi: true,
            //     maxSize: 10,
            //     extensions: ["jpg", "png", "jpeg"],
            //     captions: {
            //         feedback: 'Upload foto',
            //         button: '+ Foto Album'
            //     },
            //     showThumbs: true,
            //     addMore: true,
            //     allowDuplicates: false,
            //     onRemove: function (data, el) {
            //         albumDeleted.push(data.data.album);
            //     }
            // });

            $(document).on('click', '.file-item .fa-trash', function() {
                $(this).parents('.file-item').remove();
                $('#album-thumb').append('<input type="hidden" name="deleteFiles[]" value="' + $(this).data('identity') + '" />');
            });

            $(document).on('change', 'input[name="title"]', function() {
                $('input[name="slug"]').val(stringToSlug($(this).val()));
            });

            $('.album-manager').on('click', 'button', function(e) {
                e.preventDefault();

                $('#album-thumb').append('' +
                '<div class="file-item">' +
                '<div class="col-md-3 col-sm-3 col-xs-3"><img src="http://img.youtube.com/vi/' + $('#album').val() + '/mqdefault.jpg" style="width:100%"></div>' +
                '<div class="col-md-8" col-sm-8 col-xs-8" style="overflow-x:auto">' + $('#album').val() + '</div>' +
                '<div class="col-md-1" col-sm-1 col-xs-1"><span class="fa fa-trash" style="cursor:pointer;color:red"></span></div>' +
                '<div class="clearfix"></div>' +
                '<input type="hidden" name="files[]" value="' + $('#album').val() + '" />' +
                '</div>');

                $('#album').val('');
            });

            var stringToSlug = function (str) {
                str = str.replace(/^\s+|\s+$/g, ''); // trim
                str = str.toLowerCase();

                // remove accents, swap ñ for n, etc
                var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
                var to   = "aaaaeeeeiiiioooouuuunc------";

                for(var i=0, l=from.length ; i<l ; i++) {
                    str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
                }

                str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                    .replace(/\s+/g, '-') // collapse whitespace and replace by -
                    .replace(/-+/g, '-'); // collapse dashes

                return str;
            }
        });

        // filemanager auto run when close fancybox, after select file and then insert image thumbnail
        var OnMessage = function(data){
            if(data.appendId == 'album') {
                $('#' + data.appendId + '-thumb').append('' +
                '<div class="file-item">' +
                '<div class="col-md-3 col-sm-3 col-xs-3"><img src="' + data.thumb + '" style="width:100%"></div>' +
                '<div class="col-md-8" col-sm-8 col-xs-8" style="overflow-x:auto">' + data.thumb + '</div>' +
                '<div class="col-md-1" col-sm-1 col-xs-1"><span class="fa fa-trash" style="cursor:pointer;color:red"></span></div>' +
                '<div class="clearfix"></div>' +
                '<input type="hidden" name="files[]" value="' + data.thumb + '" />' +
                '</div>');
            } else {
                $('#' + data.appendId + '-thumb').html('<img src="' + data.thumb + '" style="width:100%">');
            }
            $('input[name="' + data.appendId + '"]').val(data.thumb);
            $.fancybox.close();
        };

        $('#myModalPermissions').on('show.bs.modal', function (e) {
            var content = '';

            $.ajax({
                type: 'get',
                url: '{{ url("api/permissions") }}'
            }).done(function (res) {
                $.each(res.data, function (index, value) {
                    content += '<div class="checkbox col-sm-6"><label><input type="checkbox" name="permission" value="' + value.id + '">' + ' ' + value.display_name + '</label></div>';
                });

                $('#permission-container').html(content);
            });
        });

        $('#myModalRole').on('show.bs.modal', function (e) {
            var content = '';

            $.ajax({
                type: 'get',
                url: '{{ url("api/roles") }}'
            }).done(function (res) {
                $.each(res.data, function (index, value) {
                    content += '<div class="checkbox col-sm-6"><label><input type="radio" name="role" value="' + value.id + '">' + ' ' + value.display_name + '</label></div>';
                });

                $('#role-container').html(content);
            });
        });
    </script>


<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
  <script>
   var route_prefix = "/filemanager";
  </script>

<script>
    {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/stand-alone-button.js')) !!}
  </script>
  
  <script>
    // $('#lfm').filemanager('image', {prefix: route_prefix});
    $('#lfm').filemanager('file', {prefix: route_prefix});
    $('#lfm1').filemanager('file', {prefix: route_prefix});
    $('#lfm2').filemanager('file', {prefix: route_prefix});
    $('#lfm3').filemanager('file', {prefix: route_prefix});

  </script>

  <script>
    var lfm = function(id, type, options) {
      let button = document.getElementById(id);

      button.addEventListener('click', function () {
        var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
        var target_input = document.getElementById(button.getAttribute('data-input'));
        var target_preview = document.getElementById(button.getAttribute('data-preview'));

        window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
        window.SetUrl = function (items) {
          var file_path = items.map(function (item) {
            return item.url;
          }).join(',');

          // set the value of the desired input to image url
          target_input.value = file_path;
          target_input.dispatchEvent(new Event('change'));

          // clear previous preview
          target_preview.innerHtml = '';

          // set or change the preview image src
          items.forEach(function (item) {
            let img = document.createElement('img')
            img.setAttribute('style', 'height: 5rem')
            img.setAttribute('src', item.thumb_url)
            target_preview.appendChild(img);
          });

          // trigger change event
          target_preview.dispatchEvent(new Event('change'));
        };
      });
    };

    lfm('lfm2', 'file', {prefix: route_prefix});
  </script>

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
  var editor_config = {
    height: 300,
		min_height: 300,
    path_absolute : "/",
    selector: "textarea.my-editor",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };

  tinymce.init(editor_config);
</script>

    @yield('scripts')
    @yield('js')
  </body>
</html>
