@extends('admin::layouts.admin')
@push('page_css')
<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-iconpicker/css/fontawesome-iconpicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.css') }}">
@endpush
@section('title', trans('admin::global.edit').' '.trans('admin::cruds.menuAdmin.index.menu'))
@section('content-header')
<div class="content-header">
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <h1>
                {{ trans('admin::global.edit') }} <small>{{ trans('admin::cruds.menuAdmin.index.menu') }}</small>
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
            <h3 class="card-title">{{ trans('admin::global.edit') }}</h3>
        </div>
        <div class="d-flex justify-content-center">
            <form method="POST" action="{{ route('menus.update', $cat->id) }}" class="col-md-8">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group row">
                        <label for="parent_id" class="col-sm-2  control-label d-flex justify-content-center">{{ trans('admin::cruds.menuAdmin.form.parent') }}</label>
                        <div class="col-sm-10">
                            <select class="form-control @error('parent_id') is-invalid @enderror" id=" FormController" name='parent_id'>
                                <option value="0">{{ trans('admin::cruds.menuAdmin.form.independent_category') }}</option>
                                @if($menu->isNotEmpty())
                                @include('admin::admin.menus.customMenuItemsSelectUpdate',['items' => $menu, 'selected' => $cat->parent_id, 'current_category' => $cat->id])
                                @endif
                            </select>
                            @error('parent_id')
                            <div id="validationServer03Feedback" class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <x-form::input name="name" value="{{ old('name', $cat->name) }}" icon-group-prepend="fa fa-pencil fa-fw" label-text="{{ trans('admin::category.create.form.name') }}" placeholder="{{ trans('admin::category.create.form.placeholder_name') }}" />
                    @if(isset(config('admin.menu_admin.lang')[0]) and config('admin.menu_admin.localization') == true)
                    @if (in_array('ru', config('admin.menu_admin.lang'), true))
                    <x-form::input name="name_ru" id="сname_ru" value="{{ old('name_ru', $cat->name_ru) }}" icon-group-prepend="fa fa-pencil fa-fw" label-text="{{ trans('admin::category.create.form.name_ru') }}" placeholder="{{ trans('admin::category.create.form.placeholder_name_ru') }}" />
                    @endif
                    @if (in_array('ro', config('admin.menu_admin.lang'), true))
                    <x-form::input name="name_ro" id="сname_ro" value="{{ old('name_ro', $cat->name_ro) }}" icon-group-prepend="fa fa-pencil fa-fw" label-text="{{ trans('admin::category.create.form.name_ro') }}" placeholder="{{ trans('admin::category.create.form.placeholder_name_ro') }}" />
                    @endif
                    @endif
                    <div class="form-group row">
                        <label class="col-sm-2 control-label d-flex justify-content-center" for="сicon">{{ trans('admin::cruds.menuAdmin.form.icon') }}</label>
                        <div class="input-group mb-2 col-sm-10">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                </div>
                            </div>
                            <input type="text" class="form-control icon col-sm-12 @error('icon') is-invalid @enderror" name="icon" value="{{ old('icon', $cat->icon) }}" placeholder="{{ trans('admin::cruds.menuAdmin.form.placeholder_icon') }}">
                            @error('icon')
                            <div id="validationServer03Feedback" class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-2"></div>
                        <small id="emailHelp" class=" col-sm-10 form-text text-muted"><i class="fa fa-info-circle"></i>&nbsp;{{ trans('admin::cruds.menuAdmin.form.for_more_icons') }} <a href="http://fontawesome.io/icons/" target="_blank">http://fontawesome.io/icons/</a></small>
                    </div>
                    <x-form::input name="uri" value="{{ old('uri', $cat->uri) }}" icon-group-prepend="fas fa-route fa-fw" label-text="{{ trans('admin::cruds.menuAdmin.form.route') }}" placeholder="{{ trans('admin::cruds.menuAdmin.form.placeholder_route') }}" />
                    <div class="form-group row">
                        <label class="col-sm-2 asterisk control-label d-flex justify-content-center" for="inlineFormInputGroup">{{ trans('admin::cruds.menuAdmin.form.permission') }}</label>
                        <div class="input-group mb-2 col-sm-10">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-universal-access"></i></div>
                            </div>
                            <select class="form-control select2" name="permission">
                                <option>{{ trans('admin::cruds.menuAdmin.form.select_permission') }}</option>
                                @foreach ($permissions as $item)
                                <option value="{{ $item->name }}" @if ($cat->permission == $item->name)
                                    selected
                                    @endif
                                    >
                                    {{ $item->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('permission')
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
                                <label class="form-check-label font-weight-bold user-select-none" for="visible">{{ trans('admin::cruds.menuAdmin.form.visible') }}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="col-12">
                        <div>
                            <div class="btn-group pull-right">
                                <button type="submit" class="submit btn btn-info d-flex justify-content-right">{{ trans('admin::global.send') }}</button>
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
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(function() {

        $('.icon').iconpicker({
            placement: 'bottomLeft',
        });
        $('.select2').select2({
            placeholder: 'Select an option',
            tags: true
        });
    });
</script>
@endpush