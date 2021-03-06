@extends('admin::layouts.admin')
@section('title', trans('admin::global.show').' '.trans('admin::cruds.role.title'))
@section('content-header')
<div class="content-header">

</div>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            {{ trans('admin::global.show') }} {{ trans('admin::cruds.role.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('roles.index') }}">
                        {{ trans('admin::global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('admin::cruds.role.fields.id') }}
                            </th>
                            <td>
                                {{ $role->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('admin::cruds.role.fields.title') }}
                            </th>
                            <td>
                                {{ $role->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('admin::cruds.role.fields.permissions') }}
                            </th>
                            <td>
                                @foreach($role->permissions as $key => $permissions)
                                <span class="badge badge-info">{{ $permissions->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('roles.index') }}">
                        {{ trans('admin::global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection