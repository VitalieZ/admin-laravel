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

        $menu = Category::orderBy('ordering', 'asc')->get();

        $mBuilder = \Menu::make('MyNav', function ($m) use ($menu) {
            foreach ($menu as $item) {
                if ($item->parent_id == 0) {
                    $m->add($item->name, env('APP_URL') . '/' . $item->slug)->id($item->id)->attr(['order' => $item->ordering, 'icon' => $item->icon, 'uri' => $item->slug, 'visible' => $item->visible]);
                } else {
                    if ($m->find($item->parent_id)) {
                        $m->find($item->parent_id)->add($item->name, env('APP_URL') . '/' . $item->slug)->id($item->id)->attr(['ordering' => $item->order, 'icon' => $item->icon, 'uri' => $item->slug, 'visible' => $item->visible]);
                    }
                }
            }
        });

        return view('admin::admin.category.index', [
            'menu' => $mBuilder,
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
        $i = 1;
        if (isset($book)) {
            foreach ($book as $key => $item) {
                Category::where('id', $item['id'])
                    ->update(['parent_id' => 0, 'ordering' => $i]);

                if (isset($item['children'])) {
                    $parent_id = $item['id'];
                    foreach ($item['children'] as $key => $item) {
                        Category::where('id', $item['id'])
                            ->update(['parent_id' => $parent_id, 'ordering' => $i++]);
                    }
                }
                $i++;
            }
        }
        return true;
    }
}
