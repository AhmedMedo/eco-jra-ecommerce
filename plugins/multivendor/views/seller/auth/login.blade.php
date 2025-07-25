@php
    $admin_logo = getGeneralSetting('admin_dark_logo');
@endphp
@extends('core::base.auth.auth_layout')
@section('title')
    {{ translate('Login') }}
@endsection
@section('custom_css')
    <style>
        .login-page-layout {
            height: 100vh;
            background-size: cover;
            min-height: 100%;
            background-repeat: no-repeat;
        }

        .card {
            border-radius: 4px !important;
        }

        .logo {
            min-height: 70px;
        }

        .container-fluid.login-page-layout:before {
            content: "";
            background-color: rgb(183 180 180 / 50%);
            top: 0;
            height: 100%;
            left: 0;
            width: 100%;
            position: absolute;
        }

        .text-darkest {
            color: #000
        }

        .bg-image {
            height: 100vh;
            background-image: url('{{ asset('web-assets/backend/img/log-in-bg.jpg') }}');
        }
    </style>
@endsection
@section('main_content')
    <div class="container-fluid login-page-layout position-relative">
        <div class="row">
            <div class="col-lg-8 d-none d-lg-block bg-image">

            </div>
            <div class="align-items-center bg-custom vh-100 col-12 col-lg-4 d-flex p-5 text-white">
                <div class="user-auth-card w-100">
                    <div class="auth-card-header text-center pt-3">
                        <div class="logo">
                            @if ($admin_logo != null)
                                <a href="/" class="default-logo">
                                    <img src="{{ getFilePath($admin_logo, false) }}"
                                        alt="{{ getGeneralSetting('system_name') }}">
                                </a>
                            @else
                                <h3 class="default-logo">{{ getGeneralSetting('system_name') }}</h3>
                            @endif
                        </div>
                        <h3 class="font-20 mb-2">{{ translate('Welcome Back') }}</h3>
                        <p>{{ translate('Login to Seller Dashboard') }}</p>
                        @if ($errors->has('login_error'))
                            <div class="text-danger mt-2 fz-12">{{ $errors->first('login_error') }}</div>
                        @endif
                    </div>
                    <div class="auth-card-body">
                        <form action="{{ route('plugin.multivendor.seller.login.attempt') }}" method="post">
                            @csrf
                            <!-- Form Group -->
                            <div class="form-group mb-20">
                                <label for="email" class="mb-2 font-14 bold black">{{ translate('Email') }}</label>
                                <input type="email" id="email" name="email" class="theme-input-style text-darkest"
                                    placeholder="{{ translate('Email Address') }}" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <div class="text-danger mt-2 fz-12">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                            <!-- End Form Group -->

                            <!-- Form Group -->
                            <div class="form-group mb-20">
                                <label for="password" class="mb-2 font-14 bold black">{{ translate('Password') }}</label>
                                <input type="password" id="password" name="password" class="theme-input-style text-darkest"
                                    placeholder="{{ translate('********') }}">
                                @if ($errors->has('password'))
                                    <div class="text-danger mt-2 fz-12">{{ $errors->first('password') }}</div>
                                @endif
                            </div>
                            <!-- End Form Group -->

                            <div class="d-flex justify-content-between mb-20">
                                <a href="{{ route('plugin.multivendor.seller.password.reset.link.page') }}"
                                    class="font-12 text_color">{{ translate('Forgot Password?') }}</a>
                            </div>

                            <div class="form-row">
                                <button type="submit" class="btn long w-100">{{ translate('Log In') }}</button>
                            </div>
                        </form>
                        @if (env('APP_DEMO') == true)
                            <div class="mt-4">
                                <table class="table table-bordered mb-0">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <p class="mt-2 email-value">saller@test.com</p>
                                            </td>
                                            <td>
                                                <p class="mt-2 password-value">111111</p>
                                            </td>
                                            <td>
                                                <button class="btn btn-info sm auto-fill-btn">
                                                    <i class="icofont-copy-invert"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
@section('custom_scripts')
    <script>
        $(function($) {
            "use strict";
            $('.auto-fill-btn').on('click', function(e) {
                $("#email").val($('.email-value').html());
                $("#password").val($('.password-value').html());
            });
        });
    </script>
@endsection
