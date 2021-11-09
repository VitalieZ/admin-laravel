@extends('admin::layouts.admin')
@section('title', trans('admin::global.add').' '.trans('admin::cruds.role.title_singular'))
@section('content-header')
<div class="content-header">
    @can('role_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('roles.create') }}">
                {{ trans('admin::global.add') }} {{ trans('admin::cruds.role.title_singular') }}
            </a>
        </div>
    </div>
    @endcan
</div>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            {{ trans('admin::global.list') }} {{ trans('admin::cruds.role.title_singular') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Role">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('admin::cruds.role.fields.id') }}
                            </th>
                            <th>
                                {{ trans('admin::cruds.role.fields.title') }}
                            </th>
                            <th>
                                {{ trans('admin::cruds.role.fields.permissions') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $key => $role)
                        <tr data-entry-id="{{ $role->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $role->id ?? '' }}
                            </td>
                            <td>
                                {{ $role->name ?? '' }}
                            </td>
                            <td>
                                @foreach($role->permissions as $key => $item)
                                <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('role_show')
                                <a class="btn btn-xs btn-primary" href="{{ route('roles.show', $role->id) }}">
                                    {{ trans('admin::global.view') }}
                                </a>
                                @endcan

                                @can('role_edit')
                                <a class="btn btn-xs btn-info" href="{{ route('roles.edit', $role->id) }}">
                                    {{ trans('admin::global.edit') }}
                                </a>
                                @endcan

                                @can('role_delete')
                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('{{ trans('admin::global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('admin::global.delete') }}">
                                </form>
                                @endcan

                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection
@section('scripts')
@parent
<script>
    $(function() {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        @can('role_delete')
        let deleteButtonTrans = '{{ trans('
        global.datatables.delete ') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('roles.massDestroy') }}",
            className: 'btn-danger',
            action: function(e, dt, node, config) {
                var ids = $.map(dt.rows({
                    selected: true
                }).nodes(), function(entry) {
                    return $(entry).data('entry-id')
                });

                if (ids.length === 0) {
                    alert('{{ trans('
                        global.datatables.zero_selected ') }}')

                    return
                }

                if (confirm('{{ trans('
                        global.areYouSure ') }}')) {
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
        let table = $('.datatable-Role:not(.ajaxTable)').DataTable({
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