<!DOCTYPE html>
@extends('layout.appLayout')
@section('title', 'Roles')
@php( $page = 'components')
@section('contents')
<div class="min-height-300 bg-primary position-absolute w-100"></div>
    @include('components.sidebar')
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    @include('components.navbar')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="container text-center"><h2 class="text-white">Roles</h2></div>
        <div class="row">
            <div class="col-md-11 mx-auto">
                <div class="card">
                  <div class="card-header pb-0">
                    <div class="d-flex align-items-center ">
                      <h4 class="mb-0 fw-bold">Roles</h4>
                      <a data-bs-toggle="modal" data-bs-target="#addRoleModal" class="btn btn-primary btn-sm ms-auto"> <i class="fa fa-plus"></i> Role</a>
                    </div>
                  </div>
                  <div class="card-body">
                      <div class="table-responsive p-0">
                          <table class="table align-items-center mb-0" id="datatable">
                          <thead>
                              <tr>
                                <th class="text-uppercase text-secondary font-weight-bolder">S/N</th>
                                <th class="text-uppercase text-secondary font-weight-bolder">Title</th>
                                <th class="text-uppercase text-secondary font-weight-bolder">Status</th>
                                <th class="text-uppercase text-secondary font-weight-bolder">Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            @php($count = 1)
                            @foreach($roles as $role)
                            <tr>
                                <td>{{$count}}</td>
                                <td>{{$role->title}}</td>
                                <td>{{$role->status}}</td>
                                <td>
                                    <a href="{{route('role.delete',[$role->id])}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
    <div class="modal" id="addRoleModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Role</h4>
                    <button type="button" class="btn-close text-danger" data-bs-dismiss="modal">
                        <i class="fa fa-times" style="font-size:20px;"></i>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form id="addLgaForm" action="{{route('role.add')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Title</label>
                                    <input class="form-control" name="title" id="addTitle" type="text" required>
                                </div>
                            </div>
                        </div>
                        <center>
                            <button type="submit" class="btn btn-primary" id="addRoleButton">Submit</button>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('components.footer')
    </div>
  </main>