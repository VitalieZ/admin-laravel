<?php

namespace Viropanel\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Viropanel\Admin\Models\Menuadmin;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Viropanel\Admin\Http\Requests\MassDestroyMenuadminRequest;
use Viropanel\Admin\Http\Requests\StoreMenuadminRequest;
use Spatie\Permission\Models\Permission;
use Viropanel\Admin\Http\Requests\UpdateMenuadminRequest;


class MenuadminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('menu_admin_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin::admin.menuadmin.index', [
            'menu' => $this->categories(),
        ]);
    }

    public function show(Menuadmin $menu)
    {
        abort_if(Gate::denies('menu_admin_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $menu_parent = Menuadmin::select('name')->where('id', $menu->parent_id)->first();
        return view('admin::admin.menuadmin.show', [
            'menu' => $menu,
            'menu_parent_name' => $menu_parent,
        ]);
    }

    public function edit(Menuadmin $menu)
    {
        abort_if(Gate::denies('menu_admin_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin::admin.menuadmin.edit', [
            'menu' => $this->categories(),
            'cat' => $menu,
        ]);
    }

    public function update(UpdateMenuadminRequest $request, Menuadmin $menu)
    {
        $cate = $menu->update([
            'parent_id' => $request->parent_id ?? 0,
            'name' => $request->name,
            'icon' => $request->icon,
            'uri' => $request->title,
            'title' => $request->keywords,
            'permision' => $request->description,
            'visible' => isset($request->visible) ? 1 : 0,
        ]);
        if (!$cate) {
            return back()->with('error', trans('admin::category.edit.error_edit'));
        }
        return back()->with('success', trans('admin::category.edit.success_edit'));
    }

    public function categories()
    {
        return Menuadmin::where('parent_id', 0)->orderBy('order', 'asc')->get();
    }

    public function viewManuList(Request $request)
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

    public function store(StoreMenuadminRequest $request)
    {
        $validateData = $request->form;
        $parent_id = $validateData['parent_id'] ?? 0;
        $order = Menuadmin::where('parent_id', $parent_id)->orderBy('id', 'desc')->first();
        $menu = Menuadmin::create([
            'parent_id' => $parent_id,
            'name' => $validateData['name'],
            'icon' => $validateData['icon'],
            'title' => $validateData['title'],
            'keywords' => $validateData['keywords'],
            'description' => $validateData['description'],
            'order' => isset($order) ? $order->order + 1 : 0,
            'visible' => isset($validateData['visible']) ? 1 : 0,
        ]);
        if (!$menu) {
            return 'error_created';
        }
    }

    public function massDestroy(MassDestroyMenuadminRequest $request)
    {
        $issetsubmenu = Menuadmin::where('parent_id', request('ids'))->first();
        if ($issetsubmenu) {
            return 'sub';
        }
        Menuadmin::where('id', request('ids'))->delete();
    }

    public function categoryorderingsave(Request $request)
    {
        $book = json_decode($request->_order, True);
        if (isset($book)) {
            $this->getCat($book);
            foreach ($book as $key => $item) {
                Menuadmin::where('id', $item['id'])
                    ->update(['parent_id' => 0, 'order' => $key]);
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
            Menuadmin::where('id', $item['id'])
                ->update(['parent_id' => $parent_id, 'order' => $key]);
            if (isset($item['children'])) {
                $this->getCat($item['children'], $item['id']);
            }
        }
    }
}
