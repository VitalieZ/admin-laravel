@foreach ($items as $item)
<option value="{{ $item['id'] }}">
    {!! $child ?? '' !!} ┝&nbsp;&nbsp; {{ $item['name']  }} - {{ $item['id'] }} - {{ $item['parent_id'] }}
</option>
@if ($item['cheaild'])
@include('admin::admin.category.customMenuItemsSelect',['items' => $item['cheaild'], 'child' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'])
@endif
@endforeach