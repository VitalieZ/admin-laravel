@extends('admin::layouts.admin')
@push('page_css')
<link rel="stylesheet" href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/dist/adminlte/AdminLTE.min.css') }}">
@endpush
@section('content')
<div class="col-md-12">
    <style>
        .title {
            font-size: 50px;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            display: block;
            text-align: center;
            margin: 20px 0 10px 0px;
        }

        .links {
            text-align: center;
            margin-bottom: 20px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .ext-icon {
            color: rgba(0, 0, 0, 0.5);
            margin-left: 10 px;
        }

        .card-body {
            font-size: 14px;
        }

        .table td,
        .table th {
            padding: 8px;
            border: none;
        }
    </style>

    <div class="title">
        {{ config('admin.name') }}
    </div>
    <div class="links">
        <a href="#" target="_blank">Github</a>
        <a href="#" target="_blank">{{ trans('admin::dashboard.documentation') }}</a>
    </div>
</div>
<div class="col-md-4">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title">{{ trans('admin::dashboard.environment') }}</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-striped">

                <tbody>
                    <tr>
                        <td>{{ trans('admin::dashboard.php_version') }}</td>
                        <td>{{ phpversion() }}</td>
                    </tr>
                    <tr>
                        <td>{{ trans('admin::dashboard.server') }}</td>
                        <td>{{ $_SERVER['SERVER_SOFTWARE'] }}</td>
                    </tr>
                    <tr>
                        <td>{{ trans('admin::dashboard.name_app') }}</td>
                        <td>{{ config('app.name') }}</td>
                    </tr>
                    <tr>
                        <td>{{ trans('admin::dashboard.cache_driver') }}</td>
                        <td>{{ config('cache.default') }}</td>
                    </tr>
                    <tr>
                        <td>{{ trans('admin::dashboard.session_driver') }}</td>
                        <td>{{ config('session.driver') }}</td>
                    </tr>
                    <tr>
                        <td>{{ trans('admin::dashboard.queue_driver') }}</td>
                        <td>{{ config('queue.default') }}</td>
                    </tr>
                    <tr>
                        <td>{{ trans('admin::dashboard.timezone') }}</td>
                        <td>{{ config('app.timezone') }}</td>
                    </tr>
                    <tr>
                        <td>{{ trans('admin::dashboard.locale') }}</td>
                        <td>{{ config('app.locale') }}</td>
                    </tr>
                    <tr>
                        <td>Env</td>
                        <td>{{ config('app.env') }}</td>
                    </tr>
                    <tr>
                        <td>{{ trans('admin::dashboard.url') }}</td>
                        <td>{{ config('app.url') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
@if ($dependencies_app)
<div class="col-md-4">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title">{{ trans('admin::dashboard.dependencies_web') }}</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-striped">
                <tbody>
                    @foreach ($dependencies_app as $key => $value)
                    <tr>
                        <td width="240px">{{ $key }}</td>
                        <td><span class="badge badge-primary">{{ $value }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
@endif
@if ($dependencies_admin_panel)
<div class="col-md-4">
    <div class="card card-outline card-success">
        <div class="card-header">
            <h3 class="card-title">{{ trans('admin::dashboard.dependencies_admin_panel') }}</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-striped">
                <tbody>
                    @foreach ($dependencies_admin_panel as $key => $value)
                    <tr>
                        <td width="240px">{{ $key }}</td>
                        <td><span class="badge badge-primary">{{ $value }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
@endif
@endsection