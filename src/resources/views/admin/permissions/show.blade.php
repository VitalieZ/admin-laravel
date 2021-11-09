@extends('admin::layouts.admin')
@section('title', trans('admin::global.show').' '.trans('admin::cruds.permission.title'))
@section('content-header')
<div class="content-header">

</div>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            {{ trans('admin::global.show') }} {{ trans('admin::cruds.permission.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('permissions.index') }}">
                        {{ trans('admin::global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('admin::cruds.permission.fields.id') }}
                            </th>
                            <td>
                                {{ $permission->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('admin::cruds.permission.fields.name') }}
                            </th>
                            <td>
                                {{ $permission->name }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('permissions.index') }}">
                        {{ trans('admin::global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection