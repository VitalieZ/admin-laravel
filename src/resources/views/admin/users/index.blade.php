@extends('admin::layouts.admin')
@section('content-header')
<div class="content-header">
    @can('user_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('user.create') }}">
                {{ __('admin::global.add') }} {{ __('admin::cruds.user.title_singular') }}
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
            {{ __('admin::cruds.user.title_singular') }} {{ __('admin::global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ __('admin::cruds.user.fields.id') }}
                            </th>
                            <th>
                                {{ __('admin::cruds.user.fields.name') }}
                            </th>
                            <th>
                                {{ __('admin::cruds.assetsHistory.fields.status') }}
                            </th>
                            <th>
                                {{ __('admin::cruds.user.fields.email') }}
                            </th>
                            <th>
                                {{ __('admin::cruds.user.fields.email_verified_at') }}
                            </th>
                            <th>
                                {{ __('admin::cruds.user.fields.roles') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $key => $user)
                        <tr data-entry-id="{{ $user->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $user->id ?? '' }}
                            </td>
                            <td>
                                {{ $user->name ?? '' }}
                            </td>
                            <td>
                                {!! $user->deleted_at ? '<span class="badge badge-danger">Удален</span>' : '<span class="badge badge-info">Активен</span>' !!}
                            </td>
                            <td>
                                {{ $user->email ?? '' }}
                            </td>
                            <td>
                                {{ $user->email_verified_at ?? '' }}
                            </td>
                            <td>
                                @foreach($user->roles as $key => $item)
                                <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('user_show')
                                <a class="btn btn-xs btn-primary" href="{{ route('user.show', $user->id) }}">
                                    {{ __('admin::global.view') }}
                                </a>
                                @endcan

                                @can('user_edit')
                                <a class="btn btn-xs btn-info" href="{{ route('user.edit', $user->id) }}">
                                    {{ __('admin::global.edit') }}
                                </a>
                                @endcan

                                @can('user_delete')
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ __('admin::global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ __('admin::global.delete') }}">
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
        @can('user_delete')
        let deleteButtonTrans = '{{ __('
        admin::global.datatables.delete ') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('users.massDestroy') }}",
            className: 'btn-danger',
            action: function(e, dt, node, config) {
                var ids = $.map(dt.rows({
                    selected: true
                }).nodes(), function(entry) {
                    return $(entry).data('entry-id')
                });

                if (ids.length === 0) {
                    alert('{{ __('
                        admin::global.datatables.zero_selected ') }}')

                    return
                }

                if (confirm('{{ __('
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
        let table = $('.datatable-User:not(.ajaxTable)').DataTable({
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