<!DOCTYPE html>
@extends('layout.appLayout')
@section('title', 'Admins')
@php( $page = 'admins')
@section('contents')
<div class="min-height-300 bg-primary position-absolute w-100"></div>
    @include('components.sidebar')
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    @include('components.navbar')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        @include('components.header')
        <div class="row">
            <div class="col-md-8 mx-auto">
              <div class="card mb-4">
                <div class="card-header text-center pb-0">
                    <i class="far fa-user-circle" style="font-size: 80px"></i>
                  <h4 class="text-center">Add Admin</h4>
                </div>
                <div class="card-body pt-0 pb-2">
                    <form id="addClientForm" action="{{route('admin.add')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">First Name</label>
                                    <input class="form-control" name="firstName" id="addClientName" type="text" required>
                                    @error('firstName')
                                    <span class="text-danger small">{{ $message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Last Name</label>
                                    <input class="form-control" name="lastName" id="addClientName" type="text" required>
                                    @error('lastName')
                                    <span class="text-danger small">{{ $message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Username</label>
                                    <input class="form-control" name="username" id="addClientName" type="text" required>
                                    @error('username')
                                    <span class="text-danger small">{{ $message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">User Type</label>
                                    <select class="form-control" name="userType" id="addClientType" required>
                                        <option selected value="">Choose..</option>
                                        <option>super-admin</option>
                                        <option>admin</option>
                                    </select>
                                    @error('userType')
                                    <span class="text-danger small">{{ $message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Jurisdiction</label>
                                    <select class="form-control" name="jurisdiction" id="addClientType" required>
                                        <option selected value="">Choose..</option>
                                        <option>General</option>
                                        @foreach($departments as $department)
                                            <option>{{$department->title}}</option>
                                        @endforeach
                                    </select>
                                    @error('jurisdiction')
                                    <span class="text-danger small">{{ $message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Email</label>
                                    <input class="form-control" name="email" id="addClientName" type="email">
                                    @error('email')
                                    <span class="text-danger small">{{ $message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Password</label>
                                    <input class="form-control" type="password" name="password" id="addClientPhone" required>
                                    @error('password')
                                        <span class="text-danger small">{{ $message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Confirm Password</label>
                                    <input class="form-control" type="password" name="password_confirmation" id="addClientPhone">
                                    @error('password_confirmation')
                                    <span class="text-danger small">{{ $message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <center>
                            <button type="submit" class="btn btn-primary" id="addClientButton">Submit</button>
                        </center>
                    </form>
                </div>
              </div>
            </div>
        </div>
    </div>
  @include('components.footer')
    </div>
  </main>