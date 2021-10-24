@foreach ($items as $item)
<option value="{{ $item->id }}">
    {!! $child !!}┝&nbsp;&nbsp;{{ $item->title }}
</option>
@if ($item->hasChildren())
@include('admin::admin.category.customMenuItemsSelect',['items' => $item->children(), 'child' => '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'])
@endif
@endforeach