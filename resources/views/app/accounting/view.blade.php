<!DOCTYPE html>
@extends('layout.appLayout')
@section('title', 'Transaction History')
@php( $page = 'accounting')
@section('contents')
<div class="min-height-300 bg-primary position-absolute w-100"></div>
    @include('components.sidebar')
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    @include('components.navbar')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="container text-center"><h2 class="text-white">Accounting</h2></div>
      <div class="row" id="viewWageInfo">
        <div class="col-md-7 mx-auto">
          <div class="card mb-4">
            <div class="card-header text-center pb-0">
                <i class="fa fa-credit-card" style="font-size: 80px"></i>
              <h4 class="text-center">Transaction History</h4>
            </div>
            
            <div class="card-body pt-0 pb-2">
                <div class="row">
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Category : </b> <span id="firstName">
                                    @if($transaction->category == 'Order')
                                        <a href="{{route('orders.showView',[$transaction->order_id])}}" class="text-primary fw-bolder">{{$transaction->category}}</a>
                                    @elseif($transaction->category == 'Expense')
                                        <a href="{{route('expenses.view',[$transaction->expense_id])}}" class="text-primary fw-bolder">{{$transaction->category}}</a>
                                    @elseif($transaction->category == 'Wage')
                                    <a href="{{route('wages.view',[$transaction->wage_id])}}" class="text-primary fw-bolder">{{$transaction->category}}</a>
                                    @endif
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Type : </b> 
                                @if($transaction->type=='Credit')
                                    <span class="text-success  fw-bolder">Credit</span>
                                @else
                                    <span class="text-danger  fw-bolder">Debit</span>
                                @endif
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Amount : </b> <span id="middleName" class="fw-bolder">&#8358; {{number_format($transaction->amount, '2', '.', ',')}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Method : </b> <span id="middleName">{{$transaction->method}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Note : </b> <span id="middleName">{{$transaction->note}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Status : </b> <span id="middleName">{{$transaction->status}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Created On : </b> <span id="middleName">{{$transaction->created_at}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Added By : </b> <span id="middleName">{{$transaction->user->username}}</span>
                            </li>
                        </ol>
                    </div>
                    @if($transaction->status == 'Canceled')
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Canceled Reason : </b> <span id="middleName">{{$transaction->cancel_reason}}</span>
                            </li>
                        </ol>
                    </div>
                    @endif
                </div>
                <center>
                    <a href="{{route('transactions.print',[$transaction->id])}}" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
                </center>
            </div>
          </div>
        </div>
      </div>
      @include('components.footer')
    </div>
  </main>

  
@push('script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
  <script>
  </script>
@endpush