@extends('admin::layouts.admin')
@push('page_css')
<link rel="stylesheet" href="assets/plugins/nestable/nestable.css">
<link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/dist/sweetalert2.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/toastr/build/toastr.min.css') }}">
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
</div>
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Категорий</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
            </div>
            @endif
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Позиция</th>
                        <th>Родительская категория</th>
                        <th>Иконка</th>
                        <th>Нозвания</th>
                        <th>Слэнг(Url)</th>
                        <th>Контент</th>
                        <th>Видимый</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->ordering }}</td>
                        <td>
                            @if ($item->parent_id == 0)
                            <div class="label label-warning">Родительская категория</div>
                            @else
                            <div class="label label-success">{{ $cat[$item->parent_id]->name }}</div>
                            @endif
                        </td>
                        <td><img src="/media/icons/{{ $item->icon }}" width="28" alt=""></td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->slug }}</td>
                        <td>{{ $item->content }}</td>
                        <td>
                            @if ($item->visible == 1)
                            <span class="label label-success">Активен</span>
                            @else
                            <span class="label label-warning" style="text-align:center;">Не активен</span>
                            @endif
                        </td>
                        <td class="project-actions text-right">

                            <a class="btn btn-primary btn-xs" href="{{ route('menu.show', $item->id) }}">Show</a>


                            <a class="btn btn-info btn-xs" href="{{ route('menu.edit', $item->id) }}">Edit</a>


                            <form action="{{ route('menu.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->

        <div class="card-footer clearfix">
            {{ $category->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>

@endsection
@push('page_scripts')
<script src="{{ asset('assets/plugins/nestable/jquery.nestable.js') }}"></script>
<script src="{{ asset('assets/plugins/dist/jquery-pjax/jquery.pjax.js') }}"></script>
<script src="{{ asset('assets/plugins/dist/sweetalert2/dist/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/dist/toastr/build/toastr.min.js') }}"></script>

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