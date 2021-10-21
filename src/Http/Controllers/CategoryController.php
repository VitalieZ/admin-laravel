<?php

namespace Viropanel\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Viropanel\Admin\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Viropanel\Admin\Http\Requests\StoreCategoryRequest;
use Viropanel\Admin\Http\Requests\UpdateCategoryRequest;
use Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //abort_if(Gate::denies('category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $category = Category::orderBy('tree_id', 'asc')->orderBy('parent_id', 'asc')->orderBy('ordering', 'asc')->paginate(4);
        $cat = Category::all()->keyBy('id');
        return view('admin::admin.category.index', [
            'category' => $category,
            'cat' => $cat,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //abort_if(Gate::denies('category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $category = Category::orderBy('tree_id', 'asc')->orderBy('parent_id', 'asc')->orderBy('ordering', 'asc')->get();
        return view('admin::admin.category.create', [
            'category' => $category,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        ($request->visible == 'on') ? $request->request->add(['visible' => 1]) : $request->request->add(['visible' => 0]);
        $slug = Str::slug($request->name, '-');
        $unique_slug = Category::where('slug', $slug)->first();
        if ($unique_slug !== null) {
            return redirect()->back()->withErrors(['slug' => 'Измените названия поста'])->withInput();
        }
        $request->request->add(['slug' => $slug]);
        $category = Category::create($request->all());
        if ($request->category == 0) {
            $category->tree_id =  $category->id;
        } else {
            $category->tree_id = $request->category;
        }
        $category->save();
        return redirect()->route('menu.index')->withSuccess('Категория "' . $request->name . '" добавлена.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $menu)
    {
        //abort_if(Gate::denies('category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $category = Category::orderBy('tree_id', 'asc')->orderBy('parent_id', 'asc')->orderBy('ordering', 'asc')->get();
        return view('admin::admin.category.edit', [
            'category' => $category,
            'cat' => $menu,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $slug = Str::slug($request->name, '-');
        $unique_slug = Category::where('slug', $slug)->where('id', '!=', $id)->first();
        if ($unique_slug !== null) {
            return redirect()->back()->withErrors(['slug' => 'Измените названия поста'])->withInput();
        }
        $model = Category::where('id', $id)->first();
        $model->name = $request->name;
        $model->slug = $slug;
        $model->icon = $request->icon;
        $model->content = $request->content;
        $model->title = $request->title;
        $model->keywords = $request->keywords;
        $model->description = $request->description;
        $model->parent_id = $request->parent_id;
        $model->ordering = $request->ordering;
        if ($request->visible == 'on') {
            $model->visible = 1;
        } else {
            $model->visible = 0;
        }
        if ($request->parent_id == 0) {
            $model->tree_id =  $id;
        } else {
            $model->tree_id = $request->parent_id;
        }
        $model->save();
        return redirect()->route('menu.index')->withSuccess('Категория "' . $request->name . '" обнавлена.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $menu)
    {
        //abort_if(Gate::denies('category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // dd($menu);
        // $menu->delete();
        if ($menu->delete()) {
            return redirect()->route('menu.index')->withSuccess('Категория удалена');
        } else {
            return redirect()->route('menu.index')->withSuccess('Категория не может быть удалена, у этои категорий есть постов.');
        }
        // try {
        //     $menu->delete();
        // } catch (\Illuminate\Database\QueryException $e) {
        //     if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
        //         // return error to user here
        //         return redirect()->route('menu.index')->withSuccess('Категория не может быть удалена, у этои категорий есть постов.');
        //     } else {
        //         return redirect()->route('menu.index')->withSuccess('Категория удалена');
        //     }
        // }
    }
}
