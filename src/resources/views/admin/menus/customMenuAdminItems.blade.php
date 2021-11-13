@foreach ($items as $item)
@if($item->visible == True)
<li class="nav-item">
    @if (!empty($item->permission))
    @can($item->permission)
    <a href="
    @if(\Route::has($item->uri))
        {{ route($item->uri) }}
    @else
        {{ route('admin.dashboard') }} 
    @endif
    " class="nav-link">
        <i class="{{ $item->icon ?? 'fas fa-angle-double-right' }}"></i>
        <p>
            {{ $item->__('name') }}
            @if (count($item->cheaild))<i class="fas fa-angle-left right"></i>@endif
        </p>
    </a>
    @endcan
    @endif
    @if (count($item->cheaild))
    <ul class="nav nav-treeview">
        @include('admin::admin.menus.customMenuAdminItems',['items' => $item->cheaild])
    </ul>
    @endif
</li>
@endif
@endforeach