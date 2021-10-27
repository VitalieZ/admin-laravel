@foreach ($items as $item)
<li class="dd-item" data-id="{{ $item->id}}">
    <div class="dd-handle">
        <i class="fa {{ $item->icon }}"></i>&nbsp;<strong>{{ $item->name }}</strong>&nbsp;&nbsp;&nbsp;<a href="" class="dd-nodrag">

            {{ env('APP_URL') }}/{{ $item->slug}}
        </a>
        <span class="pull-right dd-nodrag">
            @if ($item->visible == 1)
            <span class="label label-success mr-3">Активен</span>
            @else
            <span class="label label-warning mr-3">Удален</span>
            @endif

            <a href="javascript:void(0);" data-id="{{ $item->id}}" class="tree_branch_edit"><i class="fa fa-edit"></i></a>
            <a href="javascript:void(0);" data-id="{{ $item->id}}" class="tree_branch_delete"><i class="fa fa-trash"></i></a>
        </span>
    </div>
    @if (count($item->cheaild))
    <ol class="dd-list">
        @include('admin::admin.category.customMenuItems',['items' => $item->cheaild])
    </ol>
    @endif
</li>
@endforeach