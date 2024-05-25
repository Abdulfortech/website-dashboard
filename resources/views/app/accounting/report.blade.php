<!DOCTYPE html>
@extends('layout.appLayout')
@section('title', 'Transaction Report')
@php( $page = 'accounting')
@section('contents')
<div class="min-height-300 bg-primary position-absolute w-100"></div>
    @include('components.sidebar')
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    @include('components.navbar')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="container text-center"><h2 class="text-white">Transaction Reports</h2></div>
      

      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6 class="float-start">Transaction Report</h6>
              <div class="float-end">
                <form action="{{route('transactions.printReport')}}" method="get" class="form-inline">
                    <input type="hidden" name="start_date" value="{{$startDate}}">
                    <input type="hidden" name="end_date" value="{{$endDate}}">
                    <button type="submit" class="btn btn-primary btn-sm mx-2"> <i class="fa fa-print"></i> Print</button>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#transactionReportModal"> <i class="fa fa-file"></i> Generate Report </button>
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
                                <b>Total Transactions : </b> <span>{{$totalTransactions}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Paid Transactions : </b> <span>{{$paidTransactions}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Canceled Transactions : </b> <span>{{$canceledTransactions}}</span>
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
                        <th class="text-uppercase text-secondary font-weight-bolder">Type</th>
                        <th class="text-uppercase text-secondary font-weight-bolder">Category</th>
                        <th class="text-uppercase text-secondary font-weight-bolder">Method</th>
                        <th class="text-uppercase text-secondary font-weight-bolder">Amount</th>
                        <th class="text-uppercase text-secondary font-weight-bolder">Date</th>
                        <th class="text-uppercase text-secondary font-weight-bolder">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php($count = 1)
                      @foreach($transactions as $transaction)
                      <tr>
                        <td>{{$count}}</td>
                        <td>@if($transaction->type=='Credit')
                              <span class="text-success">Credit</span>
                            @else
                              <span class="text-danger">Debit</span>
                            @endif
                        </td>
                        <td>{{$transaction->category}}</td>
                        <td>{{$transaction->method}}</td>
                        <td>&#8358; {{number_format($transaction->amount, 2, '.', ',')}}</td>
                        <td>{{$transaction->created_at}}</td>
                        <td>{{$transaction->status}}</td>
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

  <div class="modal" id="transactionReportModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Generate Transaction Report</h4>
                <button type="button" class="btn-close text-danger" data-bs-dismiss="modal">
                    <i class="fa fa-times" style="font-size:20px;"></i>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form id="orderReportForm" action="{{route('transactions.report')}}" method="GET">
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