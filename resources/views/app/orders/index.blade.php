<!DOCTYPE html>
@extends('layout.appLayout')
@section('title', 'Orders')
@php( $page = 'orders')
@section('contents')
<div class="min-height-300 bg-primary position-absolute w-100"></div>
    @include('components.sidebar')
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    @include('components.navbar')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="container text-center"><h2 class="text-white">Orders</h2></div>
      <!-- statistics -->
      <div class="row">
        <!-- stats card -->
        <div class="col-xl-4 col-sm-6  mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Orders</p>
                    <h5 class="font-weight-bolder">
                      {{number_format($allOrders, 0, ',')}}
                    </h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder"></span>
                      All Orders
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="fa fa-shopping-cart text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- stats card -->
        <div class="col-xl-4 col-sm-6  mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Active Orders</p>
                    <h5 class="font-weight-bolder">
                      {{number_format($activeOrders, 0, ',')}}
                    </h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder"></span>
                      Active Orders
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="fa fa-shopping-cart text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- stats card -->
        <div class="col-xl-4 col-sm-6  mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Completed</p>
                    <h5 class="font-weight-bolder">
                      {{number_format($completedOrders, 0, ',')}}
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="fa fa-shopping-cart text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
                <div class="col-12">
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder"></span>
                      Completed Orders
                    </p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6 class="float-start">Orders</h6>
              <div class="float-end">
                <a href="{{route('orders.showProductAdd')}}" class="btn btn-primary btn-sm" > <i class="fa fa-shopping-cart"></i> Product</a>
                <a href="{{route('orders.showServiceAdd')}}" class="btn btn-primary btn-sm" > <i class="fa fa-shopping-cart"></i> Service</a>
                <a href="{{route('orders.printAll')}}" class="btn btn-primary btn-sm mx-2"> <i class="fa fa-print"></i> Print</a>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#orderReportModal"> <i class="fa fa-file"></i> Report </button>
              </div>
            </div>
            <div class="card-body px-2 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0" id="datatable">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary font-weight-bolder">S/N</th>
                      <th class="text-uppercase text-secondary font-weight-bolder">Department</th>
                      <th class="text-uppercase text-secondary font-weight-bolder">Order #ID</th>
                      <th class="text-uppercase text-secondary font-weight-bolder">Type</th>
                      <th class="text-uppercase text-secondary font-weight-bolder">Total</th>
                      <th class="text-uppercase text-secondary font-weight-bolder">Date</th>
                      <th class="text-uppercase text-secondary font-weight-bolder">Payment</th>
                      <th class="text-uppercase text-secondary font-weight-bolder">Status</th>
                      <th class="text-uppercase text-secondary font-weight-bolder">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php($count = 1)
                      @foreach($orders as $Order)
                      <tr>
                          <td>{{$count}}</td>
                          <td>{{$Order->department}}</td>
                          <td>{{$Order->order_code}}</td>
                          <td>{{$Order->order_type}}</td>
                          <td>&#8358; {{number_format($Order->total)}}</td>
                          <td>{{$Order->sell_at}}</td>
                          <td><span class="badge bg-primary p-1">{{$Order->status}}</span></td>
                          <td><span class="badge bg-info p-1">{{$Order->payment_status}}</span></td>
                          <td>
                            <a href="{{route('orders.showView',[$Order->id])}}" class="btn btn-primary btn-sm p-2"><i class="fa fa-eye"></i></a>
                            {{-- <a href="{{route('orders.showEdit',[$Order->id])}}" class="btn btn-info  btn-sm p-2"><i class="fa fa-edit"></i></a> --}}
                            {{-- <a href="{{route('orders.delete',[$Order->id])}}" class="btn btn-danger  btn-sm p-2"><i class="fa fa-trash"></i></a> --}}
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

  {{-- modals --}}

  <div class="modal" id="orderReportModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Generate Order Report</h4>
                <button type="button" class="btn-close text-danger" data-bs-dismiss="modal">
                    <i class="fa fa-times" style="font-size:20px;"></i>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form id="orderReportForm" action="{{route('orders.report')}}" method="GET">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">From</label>
                                <input class="form-control" name="start_date" id="start_date" type="date" required>
                                @error('start_date')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">To</label>
                                <input class="form-control" type="date" name="end_date" id="start_date" required>
                                @error('end_date')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <center>
                        <button type="submit" class="btn btn-primary" id="orderReportButton">Submit</button>
                    </center>
                </form>
            </div>
        </div>
    </div>
  </div>