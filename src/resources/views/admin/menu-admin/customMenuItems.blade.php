@foreach ($items as $item)
<li class="dd-item" data-id="{{ $item->id}}">
    <div class="dd-handle">
        <i class="{{ $item->icon }}"></i>&nbsp;<strong>{{ $item->name }}</strong>&nbsp;&nbsp;&nbsp;<a href="" class="dd-nodrag">

            {{ env('APP_URL') }}/{{ $item->slug}}
        </a>
        <span class="pull-right dd-nodrag">
            @if ($item->visible == 1)
            <span class="label label-success mr-3">{{ trans('admin::category.menu_items.active') }}</span>
            @else
            <span class="label label-warning mr-3">{{ trans('admin::category.menu_items.deleted') }}</span>
            @endif
            <a href="{{ route('menu-admin.show', $item->id) }}"><i class="fas fa-eye"></i></a>
            <a href="{{ route('menu-admin.edit', $item->id) }}" data-id="{{ $item->id}}" class="tree_branch_edit"><i class="fa fa-edit"></i></a>
            <a href="javascript:void(0);" data-id="{{ $item->id}}" onclick="delete_menu_admin('{{ $item->id }}')" class="tree_branch_delete"><i class="fa fa-trash"></i></a>
        </span>
    </div>
    @if (count($item->cheaild))
    <ol class="dd-list">
        @include('admin::admin.menu-admin.customMenuItems',['items' => $item->cheaild])
    </ol>
    @endif
</li>
@endforeach