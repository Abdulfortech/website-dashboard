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
                  <h4 class="text-center">View Admin</h4>
                </div>
                <div class="card-body pt-0 pb-2">
                    <div class="row">
                        <div class="col-md-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <b>Name : </b> <span id="firstName">{{$admin->firstName ." ". $admin->lastName}}</span>
                                </li>
                            </ol>
                        </div>
                        <div class="col-md-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <b>Username : </b> <span id="middleName">{{$admin->username}}</span>
                                </li>
                            </ol>
                        </div>
                        <div class="col-md-5">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <b>Type : </b> <span id="middleName">{{$admin->userType}}</span>
                                </li>
                            </ol>
                        </div>
                        <div class="col-md-7">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <b>Jurisdiction : </b> <span id="middleName">{{$admin->jurisdiction}}</span>
                                </li>
                            </ol>
                        </div>
                        <div class="col-md-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <b>Email : </b> <span id="middleName">{{$admin->email}}</span>
                                </li>
                            </ol>
                        </div>
                        <div class="col-md-6">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <b>Status : </b> <span id="middleName">{{$admin->status}}</span>
                                </li>
                            </ol>
                        </div>
                        <div class="col-md-6">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <b>Added On : </b> <span id="middleName">{{$admin->created_at}}</span>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <center>
                        <a href="{{route('admin.showEdit',[$admin->id])}}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                        @if($admin->status == 'Active')
                            <a href="{{route('admin.deactivate',[$admin->id])}}" class="btn btn-warning"><i class="fa fa-trash"></i> Deactivate</a>
                        @else
                            <a href="{{route('admin.activate',[$admin->id])}}" class="btn btn-success"><i class="fa fa-trash"></i> Activate</a>
                        @endif
                        <a href="{{route('admin.delete',[$admin->id])}}" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                    </center>
                </div>
              </div>
            </div>
          </div>
    </div>
  @include('components.footer')
    </div>
  </main>