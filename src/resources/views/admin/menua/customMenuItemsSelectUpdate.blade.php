@foreach ($items as $item)
@if (isset($current_category) and isset($selected) and $item['id'] != $current_category)
@if (isset($selected))
<option value="{{ $item['id'] }}" {{ ($item['id'] == $selected)? 'selected': '' }}>
    {!! $child ?? '' !!} ┝&nbsp;&nbsp; {{ $item['name']  }}
</option>
@else
<option value="{{ $item['id'] }}">
    {!! $child ?? '' !!} ┝&nbsp;&nbsp; {{ $item['name']  }}
</option>
@endif
@if ($item['cheaild'])
@include('admin::admin.menua.customMenuItemsSelectUpdate',['items' => $item['cheaild'], 'child' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'])
@endif
@endif

@endforeach