@extends('admin::layouts.admin')
@push('page_css')
<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-iconpicker/css/fontawesome-iconpicker.min.css') }}">
@endpush
@section('content-header')
<div class="content-header">
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <h1>
                {{ trans('admin::category.index.edit') }} <small>{{ trans('admin::category.index.menu') }}</small>
            </h1>
        </div>
    </div>
    @if (session('success'))
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
    </div>
    @endif
</div>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Редактирование</h3>
        </div>
        <div class="d-flex justify-content-center">
            <form method="POST" action="{{ route('menu-admin.update', [$cat->id]) }}" class="col-md-8">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group row">
                        <label for="parent_id" class="col-sm-2  control-label d-flex justify-content-center">{{ trans('admin::category.create.form.parent') }}</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="FormController" name='parent_id' @error('parent_id') is-invalid @enderror">
                                <option value="0">Сомостаятельная категория</option>
                                @if($category->isNotEmpty())
                                @include('admin::admin.menu-admin.customMenuItemsSelectUpdate',['items' => $menu, 'selected' => $cat->parent_id, 'current_category' => $cat->id])
                                @endif
                            </select>
                            @error('parent_id')
                            <div id="validationServer03Feedback" class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label asterisk d-flex justify-content-center" for="cname">{{ trans('admin::category.create.form.name') }}</label>
                        <div class="input-group mb-2 col-sm-10">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-pencil fa-fw"></i></div>
                            </div>
                            <input type="text" name="name" value="{{ old('name', $cat->name) }}" class="form-control @error('name') is-invalid @enderror" placeholder=" {{ trans('admin::category.create.form.placeholder_name') }}">
                            @error('name')
                            <div id="validationServer03Feedback" class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label d-flex justify-content-center" for="сicon">{{ trans('admin::category.create.form.icon') }}</label>
                        <div class="input-group mb-2 col-sm-10">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                </div>
                            </div>
                            <input type="text" class="form-control icon col-sm-12 @error('icon') is-invalid @enderror" name="icon" value="{{ old('icon', $cat->icon) }}" placeholder="{{ trans('admin::category.create.form.placeholder_icon') }}">
                            @error('icon')
                            <div id="validationServer03Feedback" class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-2"></div>
                        <small id="emailHelp" class=" col-sm-10 form-text text-muted"><i class="fa fa-info-circle"></i>&nbsp;{{ trans('admin::category.create.form.for_more_icons') }} <a href="http://fontawesome.io/icons/" target="_blank">http://fontawesome.io/icons/</a></small>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label asterisk d-flex justify-content-center" for="curi">{{ trans('admin::category.create.form.name') }}</label>
                        <div class="input-group mb-2 col-sm-10">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-pencil fa-fw"></i></div>
                            </div>
                            <input type="text" name="uri" value="{{ old('uri', $cat->uri) }}" class="form-control @error('uri') is-invalid @enderror" placeholder=" {{ trans('admin::category.create.form.placeholder_name') }}">
                            @error('uri')
                            <div id="validationServer03Feedback" class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label d-flex justify-content-center" for="inlineFormInputGroup">{{ trans('admin::category.create.form.title') }}</label>
                        <div class="input-group mb-2 col-sm-10">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-text-width fa-fw"></i></div>
                            </div>
                            <input type="text" value="{{ old('title', $cat->title) }}" class="form-control @error('title') is-invalid @enderror" name="title" placeholder=" {{ trans('admin::category.create.form.placeholder_title_page') }}">
                            @error('title')
                            <div id="validationServer03Feedback" class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 control-label d-flex justify-content-center" for="inlineFormInputGroup">{{ trans('admin::category.create.form.title') }}</label>
                        <div class="input-group mb-2 col-sm-10">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-text-width fa-fw"></i></div>
                            </div>
                            <input type="text" value="{{ old('permision', $cat->permision) }}" class="form-control @error('permision') is-invalid @enderror" name="permision" placeholder=" {{ trans('admin::category.create.form.placeholder_title_page') }}">
                            @error('permision')
                            <div id="validationServer03Feedback" class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="col-sm-2">
                            <div class="form-check">
                                @if ($cat->visible == 1)
                                <input type="checkbox" class="form-check-input" id="visible" name="visible" checked>
                                @else
                                <input type="checkbox" class="form-check-input" id="visible" name="visible">
                                @endif
                                <label class="form-check-label font-weight-bold user-select-none" for="visible">{{ trans('admin::category.create.form.visible') }}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-12">
                        <div>
                            <div class="btn-group pull-right">
                                <button type="submit" class="submit btn btn-info d-flex justify-content-right">{{ trans('admin::category.create.form.send') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('page_scripts')
<script src="{{ asset('assets/plugins/fontawesome-iconpicker/js/fontawesome-iconpicker.min.js') }}"></script>
<script>
    $(function() {

        $('.icon').iconpicker({
            placement: 'bottomLeft',
        });
    });
</script>
@endpush