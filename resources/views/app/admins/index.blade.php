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
      <div class="container text-center"><h2 class="text-white">Admins</h2></div>
        <div class="row">
          <div class="col-12">
            <div class="card mb-4">
              <div class="card-header pb-0">
                <h6 class="float-start">Admins</h6>
                <a href="{{route('admin.showAdd')}}" class="float-end btn btn-primary btn-sm" class="float-end btn btn-primary"><i class="fa fa-plus"></i> Add </a>
              </div>
              <div class="card-body px-2 pt-0 pb-2">
                <div class="table-responsive p-0">
                  <table class="table align-items-center mb-0" id="datatable">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary font-weight-bolder">S/N</th>
                        <th class="text-uppercase text-secondary font-weight-bolder">Name</th>
                        <th class="text-uppercase text-secondary font-weight-bolder">Username</th>
                        <th class="text-uppercase text-secondary font-weight-bolder">UserType</th>
                        <th class="text-uppercase text-secondary font-weight-bolder">Status</th>
                        <th class="text-uppercase text-secondary font-weight-bolder">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php($count = 1)
                        @foreach($admins as $admin)
                        <tr>
                            <td>{{$count}}</td>
                            <td>{{$admin->firstName ." ". $admin->lastName}}</td>
                            <td>{{$admin->username}}</td>
                            <td>{{$admin->userType}}</td>
                            <td>{{$admin->status}}</td>
                            <td>
                              <a href="{{route('admin.showView',[$admin->id])}}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                              <a href="{{route('admin.showEdit',[$admin->id])}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                              <a href="{{route('admin.delete',[$admin->id])}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @php($count++)
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  @include('components.footer')
    </div>
  </main>