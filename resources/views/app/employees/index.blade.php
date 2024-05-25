<!DOCTYPE html>
@extends('layout.appLayout')
@section('title', 'Employees')
@php( $page = 'employees')
@section('contents')
<div class="min-height-300 bg-primary position-absolute w-100"></div>
    @include('components.sidebar')
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    @include('components.navbar')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="container text-center"><h2 class="text-white">Employees</h2></div>
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6 class="float-start">Employees</h6>
              <a href="{{route('employee.showAdd')}}" class="float-end btn btn-primary btn-sm" class="float-end btn btn-primary"><i class="fa fa-plus"></i> Add </a>
              <a href="{{route('employee.printAll')}}" class="float-end btn btn-primary btn-sm mx-2"> <i class="fa fa-print"></i> Print </a>
            </div>
            <div class="card-body px-2 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0" id="datatable">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary font-weight-bolder">S/N</th>
                      <th class="text-uppercase text-secondary font-weight-bolder">#ID</th>
                      <th class="text-uppercase text-secondary font-weight-bolder ">Name</th>
                      <th class="text-uppercase text-secondary font-weight-bolder ">Department</th>
                      <th class="text-uppercase text-secondary font-weight-bolder ">Role</th>
                      <th class="text-uppercase text-secondary font-weight-bolder">Status</th>
                      <th class="text-uppercase text-secondary font-weight-bolder">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php($count = 1)
                      @foreach($employees as $employee)
                      <tr>
                          <td>{{$count}}</td>
                          <td>{{$employee->employeeID}}</td>
                          <td>{{$employee->firstName ." ".$employee->middleName ." ". $employee->lastName}}</td>
                          <td>{{$employee->department}}</td>
                          <td>{{$employee->role}}</td>
                          <td>{{$employee->status}}</td>
                          <td>
                            <a href="{{route('employee.showView',[$employee->id])}}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                            <a href="{{route('employee.showEdit',[$employee->id])}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                            <a href="{{route('employee.delete',[$employee->id])}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
      @include('components.footer')
    </div>
  </main>