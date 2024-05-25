<!DOCTYPE html>
@extends('layout.authLayout')
@section('title', 'Sign In')
@section('contents')

<main class="main-content  mt-0">
    <section>
        <div class="page-header min-vh-100">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                        <div class="card card-plain">
                            <div class="card-header ps-0 pb-0 text-start">
                                <h1 class="font-weight-bolder">{{env('APP_NAME')}}</h1>
                                <h4 class="font-weight-bolder">Sign In</h4>
                                <p class="mb-0">Enter your username and password</p>
                            </div>
                            <div class="card-body">
                                <div id="message" class="mt-2 alert" style="display: none"></div>
                                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M9.648 11.948l4.5-4.5a.63.63 0 0 0 0-.892l-1.5-1.5a.63.63 0 0 0-.892 0L6.5 9.608 3.744 6.852a.63.63 0 0 0-.892 0l-1.5 1.5a.63.63 0 0 0 0 .892l4.5 4.5a.63.63 0 0 0 .892 0z" />
                                        </symbol>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                        <symbol id="exclamation-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8 1.5a6.5 6.5 0 1 0 0 13 6.5 6.5 0 0 0 0-13zm0 10a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm0-8a.905.905 0 0 1 .9.9v4.2a.9.9 0 1 1-1.8 0V4.4a.905.905 0 0 1 .9-.9z" />
                                        </symbol>
                                    </svg>
                                </div>
                                <form role="form" id="login-form" action="{{ route('signin') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="text" class="form-control form-control-lg" name="username" placeholder="Username/Email" id="email" aria-label="Email" required>
                                        <div id="emailError" class="invalid-feedback"></div>
                                        @error('username')
                                        <span class="text-danger small">{{ $message}}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" class="form-control form-control-lg" name="password" placeholder="Password" id="password" aria-label="Password" required>
                                        <div id="passwordError" class="invalid-feedback"></div>
                                        @error('password')
                                            <span class="text-danger small">{{ $message}}</span>
                                        @enderror
                                    </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="customCheck1">
                                    <label class="form-check-label" for="rememberMe">Remember me</label>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0" id="submitButton">Sign in</button>
                                </div>
                                </form>
                            </div>
                            <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                <p class="mb-4 text-sm mx-auto">
                                {{-- Forgot Password?
                                <a href="forgot-password" class="text-primary text-gradient font-weight-bold">Reset</a> --}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                        <div class="position-relative bg-gradient-success h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg');
                    background-size: cover;">
                        <span class="mask bg-gradient-primary opacity-6"></span>
                        <h4 class="mt-5 text-white font-weight-bolder position-relative">{{env('BUSINESS_NAME')}}</h4>
                        <p class="text-white position-relative">Developed by <a href="{{env('DEVELOPER_LINK')}}" class="fw-bolder">{{env('DEVELOPER_NAME')}}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>