@extends('admin::layouts.admin')
@section('content-header')
<div class="content-header">

</div>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            {{ trans('admin::global.create') }} {{ trans('admin::cruds.role.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("roles.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="name">{{ trans('admin::cruds.role.fields.title') }}</label>
                    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                    @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('admin::cruds.role.fields.title_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('admin::cruds.role.fields.permissions') }}</label>
                    <select class="duallistbox" multiple="multiple" name="permissions[]" id="permissions" required>
                        @foreach($permissions as $id => $permissions)
                        <option value="{{ $id }}" {{ in_array($id, old('permissions', [])) ? 'selected' : '' }}>{{ $permissions }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('permissions'))
                    <span class="text-danger">{{ $errors->first('permissions') }}</span>
                    @endif
                    <span class="help-block">{{ trans('admin::cruds.role.fields.permissions_helper') }}</span>
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
@section('script'){
<script>
    $(function() {
        //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox({
            selectorMinimalHeight: '300',
            filterPlaceHolder: 'Фильтр',
            infoTextEmpty: 'Пустой список',
            infoText: 'Показаны все {0}',
        });
    });
</script>
@endsection