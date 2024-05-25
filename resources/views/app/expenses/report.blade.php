<!DOCTYPE html>
@extends('layout.appLayout')
@section('title', 'Expenses Report')
@php( $page = 'expenses')
@section('contents')
<div class="min-height-300 bg-primary position-absolute w-100"></div>
    @include('components.sidebar')
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    @include('components.navbar')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="container text-center"><h2 class="text-white">Expenses Reports</h2></div>
      

      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6 class="float-start">Expenses Report</h6>
              <div class="float-end">
                <form action="{{route('expenses.printReport')}}" method="get" class="form-inline">
                    <input type="hidden" name="start_date" value="{{$startDate}}">
                    <input type="hidden" name="end_date" value="{{$endDate}}">
                    <button type="submit" class="btn btn-primary btn-sm mx-2"> <i class="fa fa-print"></i> Print</button>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#expensesReportModal"> <i class="fa fa-file"></i> Report </button>
            </form>
              </div>
            </div>
            <div class="card-body px-2 pt-0 pb-2">
                <div class="row mb-5">
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>From : </b> <span>{{$startDate}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>To : </b> <span>{{$endDate}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Total Expenses : </b> <span>{{$totalExpenses}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Active Expenses : </b> <span>{{$activeExpenses}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Canceled Expenses : </b> <span>{{$canceledExpenses}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Total Amount : </b> <span class="fw-bolder h6">&#8358; {{number_format($totalAmount, 2, '.', ',')}}</span>
                            </li>
                        </ol>
                    </div>
                </div>
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0" id="datatable">
                  <thead>
                    <tr>
                        <th class="text-uppercase text-secondary font-weight-bolder">S/N</th>
                        <th class="text-uppercase text-secondary font-weight-bolder">Department</th>
                        <th class="text-uppercase text-secondary font-weight-bolder">Title</th>
                        <th class="text-uppercase text-secondary font-weight-bolder">Amount</th>
                        <th class="text-uppercase text-secondary font-weight-bolder">Date</th>
                        <th class="text-uppercase text-secondary font-weight-bolder">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php($count = 1)
                    @foreach($expenses as $expense)
                    <tr>
                        <td>{{$count}}</td>
                        <td>{{$expense->department}}</td>
                        <td>{{$expense->title}}</td>
                        <td>&#8358; {{number_format($expense->amount, 2, '.', ',')}}</td>
                        <td>{{$expense->date}}</td>
                        <td>{{$expense->status}}</td>
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

  <div class="modal" id="expensesReportModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Generate Expenses Report</h4>
                <button type="button" class="btn-close text-danger" data-bs-dismiss="modal">
                    <i class="fa fa-times" style="font-size:20px;"></i>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form id="orderReportForm" action="{{route('expenses.report')}}" method="GET">
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