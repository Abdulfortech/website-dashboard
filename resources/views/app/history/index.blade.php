<!DOCTYPE html>
@extends('layout.appLayout')
@section('title', 'Inventory History')
@php( $page = 'history')
@section('contents')
<div class="min-height-300 bg-primary position-absolute w-100"></div>
    @include('components.sidebar')
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    @include('components.navbar')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="container text-center"><h2 class="text-white">Inventory History</h2></div>
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6 class="float-start">History</h6>
              <div class="float-end">
                <a href="{{route('history.add')}}" class="float-end btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Add </a>
                <a href="{{route('history.printAll')}}" class="float-end btn btn-primary btn-sm mx-2"> <i class="fa fa-print"></i> Print </a>
                {{-- <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#historyReportModal"> <i class="fa fa-file"></i> Report </button> --}}
              </div>
            </div>
            <div class="card-body px-2 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0" id="datatable">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary font-weight-bolder">S/N</th>
                      <th class="text-uppercase text-secondary font-weight-bolder">Type</th>
                      <th class="text-uppercase text-secondary font-weight-bolder">Department</th>
                      <th class="text-uppercase text-secondary font-weight-bolder">Product</th>
                      <th class="text-uppercase text-secondary font-weight-bolder">Quantity</th>
                      <th class="text-uppercase text-secondary font-weight-bolder">Date</th>
                      <th class="text-uppercase text-secondary font-weight-bolder">Status</th>
                      <th class="text-uppercase text-secondary font-weight-bolder">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php($count = 1)
                      @foreach($histories as $history)
                      <tr>
                          <td>{{$count}}</td>
                          <td>{{$history->type}}</td>
                          <td>{{$history->department}}</td>
                          <td>{{$history->product->title}}</td>
                          <td>{{number_format($history->quantity)}}</td>
                          <td>{{$history->date}}</td>
                          <td>{{$history->status}}</td>
                          <td>
                            <a href="{{route('history.view',[$history->id])}}" class="btn btn-primary p-2"><i class="fa fa-eye"></i></a>
                            <a href="{{route('history.edit',[$history->id])}}" class="btn btn-info p-2"><i class="fa fa-edit"></i></a>
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

  <div class="modal" id="historyReportModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Generate Inventory Report</h4>
                <button type="button" class="btn-close text-danger" data-bs-dismiss="modal">
                    <i class="fa fa-times" style="font-size:20px;"></i>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form id="orderReportForm" action="{{route('history.report')}}" method="GET">
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