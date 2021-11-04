@foreach ($items as $item)
<option value="{{ $item['id'] }}">
    {!! $child ?? '' !!} ┝&nbsp;&nbsp; {{ $item['name']  }}
</option>
@if ($item['cheaild'])
@include('admin::admin.menua.customMenuItemsSelect',['items' => $item['cheaild'], 'child' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'])
@endif
@endforeach