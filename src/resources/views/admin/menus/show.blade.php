@extends('admin::layouts.admin')
@section('content-header')
<div class="content-header">
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <h1>
                {{ trans('admin::global.show') }} <small>{{ trans('admin::cruds.menuAdmin.index.menu') }}</small>
            </h1>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            {{ trans('admin::global.show') }} {{ trans('admin::cruds.menuAdmin.index.menu') }}
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('menus.index') }}">
                        {{ trans('admin::global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('admin::cruds.menuAdmin.form.id') }}
                            </th>
                            <td>
                                {{ $menu->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('admin::cruds.menuAdmin.form.parent') }}
                            </th>
                            <td>
                                @if ($menu->parent_id == 0)
                                <div class="label label-warning">{{ trans('admin::cruds.menuAdmin.form.independent_category') }}</div>
                                @else
                                <div class="label label-success">{{ $menu_parent_name->name }}</div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('admin::cruds.menuAdmin.form.name') }}
                            </th>
                            <td>
                                {{ $menu->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('admin::cruds.menuAdmin.form.icon') }}
                            </th>
                            <td>
                                <i class="{{ $menu->icon }}"></i>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('admin::cruds.menuAdmin.form.route') }}
                            </th>
                            <td>
                                {{ $menu->uri }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('admin::cruds.menuAdmin.form.title') }}
                            </th>
                            <td>
                                {{ $menu->title }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('admin::cruds.menuAdmin.form.permission') }}
                            </th>
                            <td>
                                {{ $menu->permission }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('admin::cruds.menuAdmin.form.visible') }}
                            </th>
                            <td>
                                @if ($menu->visible == 1)
                                <span class="label label-success mr-3">{{ trans('admin::cruds.menuAdmin.menu_items.active') }}</span>
                                @else
                                <span class="label label-warning mr-3">{{ trans('admin::cruds.menuAdmin.menu_items.deleted') }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('menus.index') }}">
                        {{ trans('admin::global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection