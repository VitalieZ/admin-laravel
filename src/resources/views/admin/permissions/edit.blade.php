@extends('admin::layouts.admin')
@section('title', trans('admin::global.edit').' '.trans('admin::cruds.permission.title_singular'))
@section('content-header')
<div class="content-header">

</div>
@endsection
@section('content')
<div class="col-md-12">

    <div class="card">
        <div class="card-header">
            {{ trans('admin::global.edit') }} {{ trans('admin::cruds.permission.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("permissions.update", [$permission->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('admin::cruds.permission.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $permission->name) }}" required>
                    @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('admin::cruds.permission.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('admin::global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection