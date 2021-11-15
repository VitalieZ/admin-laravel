<?php

namespace Viropanel\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Viropanel\Admin\Models\Category;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Viropanel\Admin\Http\Requests\MassDestroyCategoryRequest;
use Viropanel\Admin\Http\Requests\StoreCategoryRequest;
use Spatie\Permission\Models\Permission;
use Viropanel\Admin\Http\Requests\UpdateCategoryRequest;


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

        return view('admin::admin.category.index', [
            'menu' => $this->categories(),
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $menu)
    {
        abort_if(Gate::denies('category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $cat_parent = Category::select('name')->where('id', $menu->parent_id)->first();
        return view('admin::admin.category.show', [
            'category' => $menu,
            'cat_parent_name' => $cat_parent,
        ]);
    }

    public function edit(Category $menu)
    {
        abort_if(Gate::denies('category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin::admin.category.edit', [
            'category' => $this->categories(),
            'cat' => $menu,
        ]);
    }

    public function update(UpdateCategoryRequest $request, Category $menu)
    {
        ($request->visible == 'on') ? $request->request->add(['visible' => 1]) : $request->request->add(['visible' => 0]);
        (!isset($request->name_ru)) ?? $request->request->add(['name_ru' => $request->name_ru]);
        (!isset($request->name_ro)) ?? $request->request->add(['name_ro' => $request->name_ro]);

        $cate = $menu->update($request->all());
        if (!$cate) {
            return back()->with('error', trans('admin::category.edit.error_edit'));
        }
        return back()->with('success', trans('admin::category.edit.success_edit'));
    }

    public function categories()
    {
        return Category::where('parent_id', 0)->with('cheaild')->orderBy('ordering', 'asc')->get();
    }

    public function viewMenuList(Request $request)
    {
        if (!$request->ajax()) {
            return redirect()->back();
        }
        return response()->view('admin::admin.category.customMenuItems', ['items' => $this->categories()]);
    }

    public function viewSelectForm(Request $request)
    {
        if (!$request->ajax()) {
            return redirect()->back();
        }
        return response()->view('admin::admin.category.customMenuItemsSelect', ['items' => $this->categories()]);
    }

    public function store(StoreCategoryRequest $request)
    {
        $validateData = $request->form;
        $parent_id = $validateData['parent_id'] ?? 0;
        $ordering = Category::where('parent_id', $parent_id)->orderBy('id', 'desc')->first();
        $order = isset($ordering) ? $ordering->ordering + 1 : 0;
        $category = Category::create([
            'parent_id' => $parent_id,
            'name' => $validateData['name'],
            'name_ru' => $validateData['name_ru'],
            'name_ro' => $validateData['name_ro'],
            'title' => $validateData['title'],
            'keywords' => $validateData['keywords'],
            'description' => $validateData['description'],
            'ordering' => $order,
            'visible' => isset($validateData['visible']) ? 1 : 0,
        ]);
        if (!$category) {
            return 'error_created';
        }
    }

    public function massDestroy(MassDestroyCategoryRequest $request)
    {
        $issetsubmenu = Category::where('parent_id', request('ids'))->first();
        if ($issetsubmenu) {
            return 'sub';
        }
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
