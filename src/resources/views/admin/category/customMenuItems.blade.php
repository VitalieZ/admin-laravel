@foreach ($items as $item)
<li class="dd-item" data-id="{{ $item->id}}">
    <div class="dd-handle">
        <i class="fa {{ $item->attr('icon')}}"></i>&nbsp;<strong>{{ $item->title }}</strong>&nbsp;&nbsp;&nbsp;<a href="{{ env('APP_URL') }}{{ $item->attr('uri')}}" class="dd-nodrag">
            @if ($item->attr('uri'))
            {{ env('APP_URL') }}{{ $item->attr('uri')}}
            @endif
        </a>
        <span class="pull-right dd-nodrag">
            <a href="{{ route('menuadmin.edit', $item->id) }}"><i class="fa fa-edit"></i></a>
            <a href="javascript:void(0);" data-id="{{ $item->id}}" class="tree_branch_delete"><i class="fa fa-trash"></i></a>
        </span>
    </div>
    @if ($item->hasChildren())
    <ol class="dd-list">
        @include(admin::admin.category.customMenuItems',['items' => $item->children()])
    </ol>
    @endif
</li>
@endforeach