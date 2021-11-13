@extends('admin::layouts.admin')
@push('page_css')
<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-iconpicker/css/fontawesome-iconpicker.min.css') }}">
@endpush
@section('title', trans('admin::category.index.edit').' '.trans('admin::category.index.menu'))
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
            <h3 class="card-title">{{ trans('admin::global.edit') }}</h3>
        </div>
        <div class="d-flex justify-content-center">
            <form method="POST" action="{{ route('menu.update', [$cat->id]) }}" class="col-md-8">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group row">
                        <label for="parent_id" class="col-sm-2  control-label d-flex justify-content-center">{{ trans('admin::category.create.form.parent') }}</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="FormController" name='parent_id' @error('parent_id') is-invalid @enderror">
                                <option value="0">{{ trans('admin::category.create.form.independent_category') }}</option>
                                @if($category->isNotEmpty())
                                @include('admin::admin.category.customMenuItemsSelectUpdate',['items' => $category, 'selected' => $cat->parent_id, 'current_category' => $cat->id])
                                @endif
                            </select>
                            @error('parent_id')
                            <div id="validationServer03Feedback" class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <x-form::input name="name" value="{{ old('name', $cat->name) }}" icon-group-prepend="fa fa-pencil fa-fw" label-text="{{ trans('admin::category.create.form.name') }}" placeholder="{{ trans('admin::category.create.form.placeholder_name') }}" />
                    @if(isset(config('admin.category.lang')[0]) and config('admin.category.localization') == true)
                    @if (in_array('ru', config('admin.category.lang'), true))
                    <x-form::input name="name_ru" id="сname_ru" value="{{ old('name_ru', $cat->name_ru) }}" icon-group-prepend="fa fa-pencil fa-fw" label-text="{{ trans('admin::category.create.form.name_ru') }}" placeholder="{{ trans('admin::category.create.form.placeholder_name_ru') }}" />
                    @endif
                    @if (in_array('ro', config('admin.category.lang'), true))
                    <x-form::input name="name_ro" id="сname_ro" value="{{ old('name_ro', $cat->name_ro) }}" icon-group-prepend="fa fa-pencil fa-fw" label-text="{{ trans('admin::category.create.form.name_ro') }}" placeholder="{{ trans('admin::category.create.form.placeholder_name_ro') }}" />
                    @endif
                    @endif
                    <div class="accordeon">
                        <dl>
                            <dt><a href="javascript:void(0);">{{ trans('admin::category.create.form.additional_seo_fields') }}</a></dt>
                            <dd class="mt-3">
                                <x-form::input name="title" id="ctitle" value="{{ old('title', $cat->title) }}" icon-group-prepend="fa fa-text-width fa-fw" label-text="{{ trans('admin::category.create.form.title') }}" placeholder="{{ trans('admin::category.create.form.placeholder_title_page') }}" />
                                <x-form::input name="keywords" id="ckeywords" value="{{ old('keywords', $cat->keywords) }}" icon-group-prepend="fa fa-key fa-fw" label-text="{{ trans('admin::category.create.form.keywords') }}" placeholder="{{ trans('admin::category.create.form.placeholder_keywords_page') }}" />
                                <x-form::input name="description" id="description" value="{{ old('description', $cat->description) }}" icon-group-prepend="fa fa-wpforms fa-fw" label-text="{{ trans('admin::category.create.form.description') }}" placeholder="{{ trans('admin::category.create.form.placeholder_description_page') }}" />
                            </dd>
                        </dl>
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