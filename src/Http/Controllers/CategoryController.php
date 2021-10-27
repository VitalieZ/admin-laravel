<?php

namespace Viropanel\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Viropanel\Admin\Models\Category;
use Illuminate\Support\Str;
use Viropanel\Admin\Http\Requests\StoreCategoryRequest;
use Viropanel\Admin\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Viropanel\Admin\Http\Requests\MassDestroyCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menu = Category::where('parent_id', 0)->orderBy('ordering', 'asc')->get();

        return view('admin::admin.category.index', [
            'menu' => $menu,
        ]);
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


    public function massDestroy(MassDestroyCategoryRequest $request)
    {
        Category::where('id', request('ids'))->delete();
    }

    public function categoryorderingsave(Request $request)
    {
        $book = json_decode($request->_order, True);
        if (isset($book)) {
            $this->getCat($book);
            foreach ($book as $key => $item) {
                Category::where('id', $item['id'])
                    ->update(['parent_id' => 0, 'ordering' => $key]);
                if (isset($item['children'])) {
                    $this->getCat($item['children'], $item['id']);
                }
            }
        }
        return true;
    }

    public function getCat($book, $parent_id = 0)
    {
        foreach ($book as $key => $item) {
            Category::where('id', $item['id'])
                ->update(['parent_id' => $parent_id, 'ordering' => $key]);
            if (isset($item['children'])) {
                $this->getCat($item['children'], $item['id']);
            }
        }
    }
}
