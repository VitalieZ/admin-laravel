@extends('admin::layouts.admin')
@section('content-header')
<div class="content-header">
    @if (session('success'))
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
    </div>
    @endif
</div>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Добавить категорию</h3>
        </div>

        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('menu.store') }}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="FormController">Родительская категория</label>
                    <select class="form-control" id="FormController" name='parent_id'>
                        <option value="0">Сомостаятельная категория</option>
                        @foreach ($category as $item)
                        @if ($item->parent_id == 0)
                        <option value="{{ $item->id }}">{{ $item->name }}({{ $item->ordering }})</option>
                        @else
                        <option value="{{ $item->id }}"> - {{ $item->name }}({{ $item->ordering }})</option>
                        @endif
                        @endforeach
                    </select>
                    @error('category')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="InputOrdering">Позиция в меню</label>
                    <input type="text" class="form-control" name="ordering" placeholder="10" required>
                    <div class="hint-block">Позиция</div>
                    @error('ordering')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="InputName">Названия</label>
                    <input type="text" class="form-control" name="name" placeholder="Софт" required>
                    <div class="hint-block">Названия категории "Софт"</div>
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="InputIcon">Иконка</label>
                    <input type="text" class="form-control" name="icon" placeholder="fire.svg">
                    <div class="hint-block">Иконка для меню "fire.svg"</div>
                    @error('icon')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="InputContent">Контент</label>
                    <input type="text" class="form-control" name="content" placeholder="дебаг/анализ">
                    <div class="hint-block">Контент каторые виден в меню "дебаг/анализ"</div>
                    @error('content')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="InputTitle">Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Title">
                    <div class="hint-block">Таитле страницы</div>
                    @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="InputKeywords">Keywords</label>
                    <input type="text" class="form-control" name="keywords" placeholder="sof,program,windows,file">
                    <div class="hint-block">Keywords страницы</div>
                    @error('keyworks')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="InputDescription">Description</label>
                    <input type="text" class="form-control" name="description" placeholder="Description">
                    <div class="hint-block">Описание страницы</div>
                    @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="visible">
                    <label class="form-check-label" for="Visible">Видимый</label>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </form>
    </div>
</div>
@endsection