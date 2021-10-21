<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    @include('admin::auth._inc.styleauth')

</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/home') }}"><b>{{ config('app.name') }}</b></a>
        </div>

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Please confirm your password before continuing.</p>

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" required autocomplete="current-password">
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-lock"></span></div>
                        </div>
                        @if ($errors->has('password'))
                        <span class="error invalid-feedback">{{ $errors->first('password') }}</span>
                        @endif
                    </div>


                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Confirm Password</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mt-3 mb-1">
                    <a href="{{ route('password.request') }}">Forgot Your Password?</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>

    </div>

    @include('admin::auth._inc.jsauth')

</body>

</html>