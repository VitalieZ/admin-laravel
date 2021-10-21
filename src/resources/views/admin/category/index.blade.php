@extends('admin::layouts.admin')
@section('content-header')
<div class="content-header">

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('menu.create') }}">
                Добавить категорию
            </a>
        </div>
    </div>

</div>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Категорий</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
            </div>
            @endif
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Позиция</th>
                        <th>Родительская категория</th>
                        <th>Иконка</th>
                        <th>Нозвания</th>
                        <th>Слэнг(Url)</th>
                        <th>Контент</th>
                        <th>Видимый</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->ordering }}</td>
                        <td>
                            @if ($item->parent_id == 0)
                            <div class="label label-warning">Родительская категория</div>
                            @else
                            <div class="label label-success">{{ $cat[$item->parent_id]->name }}</div>
                            @endif
                        </td>
                        <td><img src="/media/icons/{{ $item->icon }}" width="28" alt=""></td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->slug }}</td>
                        <td>{{ $item->content }}</td>
                        <td>
                            @if ($item->visible == 1)
                            <span class="label label-success">Активен</span>
                            @else
                            <span class="label label-warning" style="text-align:center;">Не активен</span>
                            @endif
                        </td>
                        <td class="project-actions text-right">

                            <a class="btn btn-primary btn-xs" href="{{ route('menu.show', $item->id) }}">Show</a>


                            <a class="btn btn-info btn-xs" href="{{ route('menu.edit', $item->id) }}">Edit</a>


                            <form action="{{ route('menu.destroy', $item->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->

        <div class="card-footer clearfix">
            {{ $category->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>

@endsection