<div class="card-body">
    <div class="table-responsive">
        <div class="summary">Разрешение - <b>{{ count($permissions) }}</b>.</div>
        <table class=" table table-bordered table-striped table-hover datatable datatable-Permission">
            <thead>
                <tr>
                    <th width="10">#</th>
                    <th>
                        {{ trans('cruds.permission.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.permission.fields.name') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                <tr class="filters">
                    <td>&nbsp;</td>
                    <td></td>
                    <td>
                        <input wire:model="searchpermison" placeholder="Поиск разрешение" type="text" class="form-control" name="searchpermison">
                    </td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach($permissions as $key => $permission)
                <tr data-entry-id="{{ $permission->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{ $permission->id ?? '' }}
                    </td>
                    <td>
                        {{ $permission->name ?? '' }}
                    </td>
                    <td>
                        @can('permission_show')
                        <a class="btn btn-xs btn-primary" href="{{ route('permissions.show', $permission->id) }}">
                            {{ trans('global.view') }}
                        </a>
                        @endcan

                        @can('permission_edit')
                        <a class="btn btn-xs btn-info" href="{{ route('permissions.edit', $permission->id) }}">
                            {{ trans('global.edit') }}
                        </a>
                        @endcan

                        @can('permission_delete')
                        <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                        </form>
                        @endcan

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $permissions->links() }}
    </div>
</div>