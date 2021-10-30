<?php

namespace Viropanel\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('access_admin_panels'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dependencies_admin_panel = $this->ComposerJsonRequire(base_path('vendor/viropanel/admin-laravel/composer.json'));

        $dependencies_app = $this->ComposerJsonRequire(base_path('composer.json'));


        return view('admin::admin.dashboard', [
            'dependencies_admin_panel' => $dependencies_admin_panel,
            'dependencies_app' => $dependencies_app,
        ]);
    }

    public function ComposerJsonRequire($path)
    {
        if (file_exists($path)) {
            $content = file_get_contents($path);
            $content = json_decode($content, true);

            return $content['require'];
        }
        return null;
    }
}
