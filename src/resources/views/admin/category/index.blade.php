@extends('admin::layouts.admin')
@push('page_css')
<link rel="stylesheet" href="{{ asset('assets/plugins/nestable/nestable.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/toastr/build/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-iconpicker/css/fontawesome-iconpicker.min.css') }}">
@endpush
@section('content-header')
<div class="content-header">

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <h1>
                {{ trans('admin::category.index.menu') }} <small>{{ trans('admin::category.index.list') }}</small>
            </h1>
        </div>
    </div>

</div>
@endsection
@section('content')
<div class="col-md-6">
    @if ($menu->isNotEmpty())
    <div class="card">
        <!-- /.card-header -->
        <div class="box">
            <div class="box-header">
                <div class="btn-group">
                    <a class="btn btn-primary btn-sm tree-616ecf2d15e0f-tree-tools" data-action="expand" title="Развернуть">
                        <i class="fa fa-plus-square-o"></i>&nbsp;{{ trans('admin::category.index.expand') }}
                    </a>
                    <a class="btn btn-primary btn-sm tree-616ecf2d15e0f-tree-tools" data-action="collapse" title="Свернуть">
                        <i class="fa fa-minus-square-o"></i>&nbsp;{{ trans('admin::category.index.collapse') }}
                    </a>
                </div>
                @can('category_sorting')
                <div class="btn-group">
                    <a class="btn btn-info btn-sm tree-616ecf2d15e0f-save" title="{{ trans('admin::category.index.save') }}"><i class="fa fa-save"></i><span class="hidden-xs">&nbsp;{{ trans('admin::category.index.save') }}</span></a>
                </div>
                @endcan
                <div class="btn-group">
                    <a class="btn btn-warning btn-sm tree-616ecf2d15e0f-refresh" title="{{ trans('admin::category.index.refresh') }}"><i class="fa fa-refresh"></i><span class="hidden-xs">&nbsp;{{ trans('admin::category.index.refresh') }}</span></a>
                </div>
                <div class="btn-group">
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <div class="dd" id="tree-616ecf2d15e0f">
                    <ol class="dd-list">
                        @include('admin::admin.category.customMenuItems', ['items'=>$menu])
                    </ol>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.card-body -->
    </div>
    @else
    <div class="card card-outline card-warning">
        <div class="card-body">
            <div class="text-center pt-3 pb-3 lead text-muted">{{ trans('admin::category.index.isEmptyCategory') }}</div>
        </div>
        <!-- /.card-body -->
    </div>
    @endif
</div>
@can('category_create')
<div class="col-md-6">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">
                {{ trans('admin::category.create.new') }}
            </h3>
            <div class="box-tools pull-right">
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body" style="display: block;">
            <form class="cmxform" id="create_category_form2">
                <fieldset>
                    <div class="box-body fields-group">
                        <div class="form-group row">
                            <label for="parent_id" class="col-sm-2  control-label d-flex justify-content-center">{{ trans('admin::category.create.form.parent') }}</label>
                            <div class="col-sm-10">
                                <select class="form-control asterisk parent_id select2-hidden-accessible" style="width: 100%;" name="parent_id">
                                    <option value="0" selected="">{{ trans('admin::category.create.form.independent_category') }}</option>
                                    @if ($menu->isNotEmpty())
                                    @include('admin::admin.category.customMenuItemsSelect', ['items'=>$menu])
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 control-label asterisk d-flex justify-content-center" for="cname">{{ trans('admin::category.create.form.name') }}</label>
                            <div class="input-group mb-2 col-sm-10">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-pencil fa-fw"></i></div>
                                </div>
                                <input type="text" id="сname" name="name" class="form-control" placeholder=" {{ trans('admin::category.create.form.placeholder_name') }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="text-primary">{{ trans('admin::category.create.form.additional_seo_fields') }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 control-label d-flex justify-content-center" for="inlineFormInputGroup">{{ trans('admin::category.create.form.title') }}</label>
                            <div class="input-group mb-2 col-sm-10">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-text-width fa-fw"></i></div>
                                </div>
                                <input type="text" id="ctitle" class="form-control" name="title" placeholder=" {{ trans('admin::category.create.form.placeholder_title_page') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 control-label d-flex justify-content-center" for="inlineFormInputGroup">{{ trans('admin::category.create.form.keywords') }}</label>
                            <div class="input-group mb-2 col-sm-10">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-key fa-fw"></i></div>
                                </div>
                                <input type="text" id="ckeywords" class="form-control" name="keywords" placeholder="{{ trans('admin::category.create.form.placeholder_keywords_page') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 control-label d-flex justify-content-center" for="inlineFormInputGroup">{{ trans('admin::category.create.form.description') }}</label>
                            <div class="input-group mb-2 col-sm-10">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-wpforms fa-fw"></i></div>
                                </div>
                                <input type="text" id="description" class="form-control" name="description" placeholder="{{ trans('admin::category.create.form.placeholder_description_page') }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="col-sm-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="visible" id="visible">
                                    <label class="form-check-label font-weight-bold user-select-none" for="visible">{{ trans('admin::category.create.form.visible') }}</label>
                                    @error('visible')
                                    <div id="validationServer03Feedback" class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="col-12">
                            <div>
                                <div class="btn-group pull-left">
                                    <button type="reset" class="btn btn-warning d-flex justify-content-left">{{ trans('admin::category.create.form.reset') }}</button>
                                </div>
                            </div>
                            <div>
                                <div class="btn-group pull-right">
                                    <input type="submit" class="submit btn btn-info d-flex justify-content-right" value="{{ trans('admin::category.create.form.send') }}">
                                    <button type="button" class="btn btn-info pull-right disabled d-none" disabled="disabled">{{ trans('admin::category.create.form.loading') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div><!-- /.box-body -->
    </div>
</div>
@endcan
@endsection
@push('page_scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="{{ asset('assets/plugins/nestable/jquery.nestable.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-pjax/jquery.pjax.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert2/sw2.js') }}"></script>
<script src="{{ asset('assets/plugins/toastr/build/toastr.min.js') }}"></script>
<script src="{{ asset('assets/plugins/fontawesome-iconpicker/js/fontawesome-iconpicker.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-validation/jquery.form.js') }}"></script>
<script>
    /* delete category */
    function delete_category(id) {
        Swal.fire({
            title: "{{ trans('admin::category.index.are_you_sure_to_delete') }}",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "{{ trans('admin::category.index.confirm') }}",
            showLoaderOnConfirm: true,
            cancelButtonText: "{{ trans('admin::category.index.cancel') }}",
            preConfirm: function() {
                return new Promise(function(resolve) {
                    $.ajax({
                        method: 'POST',
                        url: "{{ route('massDestroy') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'accept': 'application/json'
                        },
                        data: {
                            'ids': id,
                        },
                        success: function(data) {
                            if (data == 'sub') {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Категория не может быть удалена.Сначала удалите подкатегорий.'
                                })
                            } else {
                                $('.dd-item[data-id="' + id + '"]').remove();
                                reloadelistSelect();
                                Toast.fire({
                                    icon: 'success',
                                    title: "{{ trans('admin::category.index.success_delete') }}",
                                })
                            }

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
    }

    /* reload view select from form */
    function reloadelistSelect() {
        $.get("{{ route('menu.select') }}", function(data) {
            let cat = "<option value='0' selected=''>{{ trans('admin::category.create.form.independent_category') }}</option>";
            $('#create_category_form2').find('.parent_id').html(cat + data);
        });
    }

    $(function() {
        /*validation form add and edit */
        var validator_create_category = $("#create_category_form2").validate({
            rules: {
                parent_id: {
                    required: true,
                },
                name: {
                    required: true,
                    maxlength: 50,
                    minlength: 4,
                },
                title: {
                    maxlength: 255
                },
                keywords: {
                    maxlength: 255
                },
                description: {
                    maxlength: 255
                }
            },
            messages: {
                name: {
                    required: "{{ trans('admin::category.fields.name_required') }}",
                    maxlength: "{{ trans('admin::category.fields.name_max') }}",
                    minlength: "{{ trans('admin::category.fields.name_min') }}",
                },
                title: {
                    maxlength: "{{ trans('admin::category.fields.title_max') }}"
                },
                keywords: {
                    maxlength: "{{ trans('admin::category.fields.keywords_max') }}"
                },
                description: {
                    maxlength: "{{ trans('admin::category.fields.description_max') }}"
                }
            },
            submitHandler: function(form) {
                addCategory(form);
            }
        });

        /*Add category */
        function addCategory() {
            let serialize = $("#create_category_form2").serializeArray();
            var config = {};
            serialize.map(function(item) {
                if (config[item.name]) {
                    if (typeof(config[item.name]) === "string") {
                        config[item.name] = [config[item.name]];
                    }
                    config[item.name].push(item.value);
                } else {
                    config[item.name] = item.value;
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('menu.store') }}",
                data: {
                    form: config,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'accept': 'application/json',
                },
                success: function(data) {
                    if (data.length === 0) {
                        Toast.fire({
                            icon: 'success',
                            title: "{{ trans('admin::category.create.success_created') }}"
                        });
                        validator_create_category.resetForm();
                        reloadelistMenu();
                        reloadelistSelect();
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: "{{ trans('admin::category.create.error_created') }}"
                        })
                    }
                },
                statusCode: {
                    403: function() {
                        Toast.fire({
                            icon: 'error',
                            title: "{{ trans('admin::category.create.permissions.not_access_create_cateogy') }}"
                        })
                    }
                },
                error: function(error) {
                    Toast.fire({
                        icon: 'error',
                        title: "{{ trans('admin::category.create.error_created') }}"
                    })
                }
            });
        }

        /*reload view menu list */
        function reloadelistMenu() {
            $.get("{{ route('menu.list') }}", function(data) {
                let f = $('#tree-616ecf2d15e0f').find('.dd-list');
                if (f.length == 0) {
                    $.pjax.reload('#pjax-container');
                }
                $('#tree-616ecf2d15e0f').find('.dd-list').html(data);
            });
        }


        $('#tree-616ecf2d15e0f').nestable([]);

        $('.tree-616ecf2d15e0f-save').click(function() {
            var serialize = $('#tree-616ecf2d15e0f').nestable('serialize');
            $.ajax({
                type: "POST",
                url: "{{ route('orderingcategory') }}",
                data: {
                    _order: JSON.stringify(serialize),
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'accept': 'application/json'
                },
                dataType: 'json',
                success: function(html) {
                    //$.pjax.reload('#pjax-container');
                    reloadelistSelect();
                    Toast.fire({
                        icon: 'success',
                        title: "{{ trans('admin::category.index.success_save') }}"
                    })
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
            Toast.fire({
                icon: 'success',
                title: "{{ trans('admin::category.index.success_refrech') }}"
            })
        });

        $('.icon').iconpicker({
            placement: 'bottomLeft',
        });
    });
</script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        showCloseButton: true,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
</script>
@endpush