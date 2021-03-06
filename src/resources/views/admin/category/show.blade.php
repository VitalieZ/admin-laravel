@extends('admin::layouts.admin')
@section('title', trans('admin::category.show.show').' '.trans('admin::category.show.category'))
@section('content-header')
<div class="content-header">
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <h1>
                {{ trans('admin::category.show.show') }} <small>{{ trans('admin::category.show.category') }}</small>
            </h1>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            {{ trans('admin::category.show.show') }} {{ trans('admin::category.show.category') }}
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('menu.index') }}">
                        {{ trans('admin::category.show.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('admin::category.show.id') }}
                            </th>
                            <td>
                                {{ $category->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('admin::category.show.parent') }}
                            </th>
                            <td>
                                @if ($category->parent_id == 0)
                                <div class="label label-warning">{{ trans('admin::category.create.form.independent_category') }}</div>
                                @else
                                <div class="label label-success">{{ $cat_parent_name->name }}</div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('admin::category.show.name') }}
                            </th>
                            <td>
                                {{ $category->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('admin::category.show.title') }}
                            </th>
                            <td>
                                {{ $category->title }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('admin::category.show.keywords') }}
                            </th>
                            <td>
                                {{ $category->keywords }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('admin::category.show.description') }}
                            </th>
                            <td>
                                {{ $category->description }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('admin::category.show.visible') }}
                            </th>
                            <td>
                                @if ($category->visible == 1)
                                <span class="label label-success mr-3">{{ trans('admin::category.menu_items.active') }}</span>
                                @else
                                <span class="label label-warning mr-3">{{ trans('admin::category.menu_items.deleted') }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('menu.index') }}">
                        {{ trans('admin::category.show.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection