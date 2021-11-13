@extends('admin::layouts.admin')
@section('title', trans('admin::cruds.permission.title_singular'))
@section('content-header')
<div class="content-header">
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
    @can('permission_create')
    <div class="card">
        <div class="card-header">
            {{ trans('admin::global.create') }} {{ trans('admin::cruds.permission.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("permissions.store") }}">
                @csrf
                <p>{{ trans('admin::cruds.permission.fields.name') }}</p>
                <div class="input-group input-group-sm">
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                    <span class="input-group-append">
                        <button type="submit" class="btn btn-danger btn-flat">{{ trans('admin::global.save') }}</button>
                    </span>
                    @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('admin::cruds.permission.fields.name_helper') }}</span>
                </div>
            </form>
        </div>
    </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('admin::global.list') }} {{ trans('admin::cruds.permission.title') }}
        </div>
        <livewire:admin::search-permisions />
    </div>
</div>

@endsection
@section('scripts')
@parent
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
    $(function() {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        @can('permission_delete')
        let deleteButtonTrans = '{{ trans('
        admin::global.datatables.delete ') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('permissions.massDestroy') }}",
            className: 'btn-danger',
            action: function(e, dt, node, config) {
                var ids = $.map(dt.rows({
                    selected: true
                }).nodes(), function(entry) {
                    return $(entry).data('entry-id')
                });

                if (ids.length === 0) {
                    alert('{{ trans('
                        admin::global.datatables.zero_selected ') }}')

                    return
                }

                if (confirm('{{ trans('
                        admin::global.areYouSure ') }}')) {
                    $.ajax({
                            headers: {
                                'x-csrf-token': _token
                            },
                            method: 'POST',
                            url: config.url,
                            data: {
                                ids: ids,
                                _method: 'DELETE'
                            }
                        })
                        .done(function() {
                            location.reload()
                        })
                }
            }
        }
        dtButtons.push(deleteButton)
        @endcan

        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            order: [
                [1, 'desc']
            ],
            pageLength: 100,
        });
        let table = $('.datatable-Permission:not(.ajaxTable)').DataTable({
            buttons: dtButtons
        })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
        $('div#sidebar').on('transitionend', function(e) {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        })
    })
</script>
@endsection