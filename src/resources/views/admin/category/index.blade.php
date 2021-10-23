@extends('admin::layouts.admin')
@push('page_css')
<link rel="stylesheet" href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/nestable/nestable.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/dist/sweetalert2.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/toastr/build/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/dist/adminlte/AdminLTE.min.css') }}">
@endpush
@section('content-header')
<div class="content-header">

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('menu.create') }}">
                Добавить категорию
            </a>
        </div>
    </div>

</div>
@endsection
@section('content')
<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Категорий</h3>
        </div>
        <!-- /.card-header -->
        <div class="box">

            <div class="box-header">

                <div class="btn-group">
                    <a class="btn btn-primary btn-sm tree-616ecf2d15e0f-tree-tools" data-action="expand" title="Развернуть">
                        <i class="fa fa-plus-square-o"></i>&nbsp;Развернуть
                    </a>
                    <a class="btn btn-primary btn-sm tree-616ecf2d15e0f-tree-tools" data-action="collapse" title="Свернуть">
                        <i class="fa fa-minus-square-o"></i>&nbsp;Свернуть
                    </a>
                </div>

                <div class="btn-group">
                    <a class="btn btn-info btn-sm tree-616ecf2d15e0f-save" title="Сохранить"><i class="fa fa-save"></i><span class="hidden-xs">&nbsp;Сохранить</span></a>
                </div>

                <div class="btn-group">
                    <a class="btn btn-warning btn-sm tree-616ecf2d15e0f-refresh" title="Обновить"><i class="fa fa-refresh"></i><span class="hidden-xs">&nbsp;Обновить</span></a>
                </div>

                <div class="btn-group">

                </div>


            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <div class="dd" id="tree-616ecf2d15e0f">
                    <ol class="dd-list">
                        @if ($menu)

                        @include('admin::admin.category.customMenuItems', ['items'=>$menu->roots()])

                        @endif
                    </ol>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.card-body -->
    </div>
</div>

@endsection
@push('page_scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="{{ asset('assets/plugins/nestable/jquery.nestable.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-pjax/jquery.pjax.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert2/dist/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/toastr/build/toastr.min.js') }}"></script>

<script data-exec-on-popstate>
    $(function() {
        $('#tree-616ecf2d15e0f').nestable([]);
        // $('#tree-616ecf2d15e0f').on('change', function() {
        //     var serialize = $('#tree-616ecf2d15e0f').nestable('serialize');
        //     console.log(serialize);
        // });

        $('.tree_branch_delete').click(function() {
            var id = $(this).data('id');
            swal({
                title: "Вы уверены, что хотите удалить эту запись?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Подтвердить",
                showLoaderOnConfirm: true,
                cancelButtonText: "Отмена",
                preConfirm: function() {
                    return new Promise(function(resolve) {
                        $.ajax({
                            method: 'post',
                            url: 'http://newbarber.loc/admin/auth/menu/' + id,
                            data: {
                                _method: 'delete',
                                _token: LA.token,
                            },
                            success: function(data) {
                                $.pjax.reload('#pjax-container');
                                toastr.success('Успешно удалено!');
                                resolve(data);
                            }
                        });
                    });
                }
            }).then(function(result) {
                var data = result.value;
                if (typeof data === 'object') {
                    if (data.status) {
                        swal(data.message, '', 'success');
                    } else {
                        swal(data.message, '', 'error');
                    }
                }
            });
        });

        $('.tree-616ecf2d15e0f-save').click(function() {
            var serialize = $('#tree-616ecf2d15e0f').nestable('serialize');
            $.ajax({
                type: "POST",
                url: "/menuadminsave",
                data: {
                    _order: JSON.stringify(serialize),
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'accept': 'application/json'
                },
                dataType: 'json',
                success: function(html) {
                    $.pjax.reload('#pjax-container');
                    toastr.success('Успешно сохранено!');
                },
                error: function(error) {


                }
            });
        });


        $('.tree-616ecf2d15e0f-tree-tools').on('click', function(e) {
            var action = $(this).data('action');
            if (action === 'expand') {
                $('.dd').nestable('expandAll');
            }
            if (action === 'collapse') {
                $('.dd').nestable('collapseAll');
            }
        });

        $('.tree-616ecf2d15e0f-refresh').click(function() {
            $.pjax.reload('#pjax-container');
            toastr.success('Успешно обновлено!');
        });


        // $('.icon').iconpicker({
        //     placement: 'bottomLeft'
        // });
    });
</script>
@endpush