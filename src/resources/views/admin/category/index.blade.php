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
            <h1>
                Меню <small>Список</small>
            </h1>
        </div>
    </div>

</div>
@endsection
@section('content')
<div class="col-md-6">
    <div class="card">
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
<div class="col-md-6">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Добавить</h3>
            <div class="box-tools pull-right">
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body" style="display: block;">
            <form id="widget-form-61756d3b29aa4" method="POST" action="http://newbarber.loc/admin/auth/menu" class="form-horizontal" accept-charset="UTF-8" pjax-container="1">
                <div class="box-body fields-group">
                    <div class="form-group row">
                        <label for="parent_id" class="col-sm-2  control-label d-flex justify-content-center">Родитель</label>
                        <div class="col-sm-10">
                            <select class="form-control parent_id select2-hidden-accessible" style="width: 100%;" name="parent_id" data-value="" tabindex="-1" aria-hidden="true">
                                <option value="0" selected="">Сомастаятельная категория</option>
                                @if ($menu)
                                @include('admin::admin.category.customMenuItemsSelect', ['items'=>$menu->roots(), 'child' => ''])
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label d-flex justify-content-center" for="inlineFormInputGroup">Название</label>
                        <div class="input-group mb-2 col-sm-10">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-pencil fa-fw"></i></div>
                            </div>
                            <input type="text" class="form-control" placeholder="Ввод Название">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label d-flex justify-content-center" for="inlineFormInputGroup">Иконка</label>
                        <div class="input-group mb-2 col-sm-10">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-bars fa-fw"></i></div>

                            </div>
                            <input type="text" class="form-control col-sm-12" placeholder="Ввод Название">
                        </div>
                        <div class="col-sm-2"></div>
                        <small id="emailHelp" class=" col-sm-10 form-text text-muted"><i class="fa fa-info-circle"></i>&nbsp;For more icons please see <a href="http://fontawesome.io/icons/" target="_blank">http://fontawesome.io/icons/</a></small>
                    </div>
                    <div class="accordeon">
                        <dl>
                            <dt><a href="javascript:void(0);">Допалнительные поля для SEO</a></dt>
                            <dd>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label d-flex justify-content-center" for="inlineFormInputGroup">Title</label>
                                    <div class="input-group mb-2 col-sm-10">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-text-width fa-fw"></i></div>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ввод Title Страницы">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label d-flex justify-content-center" for="inlineFormInputGroup">Keywords</label>
                                    <div class="input-group mb-2 col-sm-10">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-key fa-fw"></i></div>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ввод Keywords Страницы">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 control-label d-flex justify-content-center" for="inlineFormInputGroup">Description</label>
                                    <div class="input-group mb-2 col-sm-10">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-wpforms fa-fw"></i></div>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Ввод Description Страницы">
                                    </div>
                                </div>
                            </dd>
                        </dl>
                    </div>
                    <div class="col-12">
                        <div class="col-sm-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="visible" id="visible">
                                <label class="form-check-label font-weight-bold user-select-none" for="visible">Видимый</label>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="col-12">
                        <div>
                            <div class="btn-group pull-left">
                                <button type="reset" class="btn btn-warning d-flex justify-content-left">Сбросить</button>
                            </div>
                        </div>
                        <div>
                            <div class=" btn-group pull-right">
                                <button type="submit" class="btn btn-info d-flex justify-content-right">Отправить</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- /.box-body -->
    </div>
</div>

@endsection
@push('page_scripts')
<script src=" https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
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

        $(".accordeon dd").hide().prev().click(function() {
            $(this).parents(".accordeon").find("dd").not(this).slideUp().prev().removeClass("active");
            $(this).next().not(":visible").slideDown().prev().addClass("active");
        });


        // $('.icon').iconpicker({
        //     placement: 'bottomLeft'
        // });
    });
</script>
@endpush