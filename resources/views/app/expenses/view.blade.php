<!DOCTYPE html>
@extends('layout.appLayout')
@section('title', 'Expenses')
@php( $page = 'expenses')
@section('contents')
<div class="min-height-300 bg-primary position-absolute w-100"></div>
    @include('components.sidebar')
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    @include('components.navbar')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="container text-center"><h2 class="text-white">Expenses</h2></div>
      <div class="row" id="viewexpenseInfo">
        <div class="col-md-7 mx-auto">
          <div class="card mb-4">
            <div class="card-header text-center pb-0">
                <i class="ni ni-single-copy-04" style="font-size: 80px"></i>
              <h4 class="text-center">View Expense</h4>
            </div>
            <div class="card-body pt-0 pb-2">
                <div class="row">
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Title : </b> <span id="firstName">{{$expense->title}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Department : </b> <span id="middleName">{{$expense->department}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Amount : </b> <span id="middleName">&#8358; {{number_format($expense->amount, '2', '.', ',')}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Date : </b> <span id="middleName">{{$expense->date}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Note : </b> <span id="middleName">{{$expense->note}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Status : </b> <span id="middleName">{{$expense->status}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Created On : </b> <span id="middleName">{{$expense->created_at}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Added By : </b> <span id="middleName">{{$expense->user->username}}</span>
                            </li>
                        </ol>
                    </div>
                </div>
                <center>
                    <!-- <a href="{{route('expenses.edit',[$expense->id])}}" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a> -->
                    @if($expense->status != 'Canceled')
                        <button type="button" data-bs-toggle="modal" data-bs-target="#cancelModal" class="btn btn-warning"><i class="fa fa-times"></i> Cancel</button>
                    @endif
                    <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                    <a href="{{route('expenses.print',[$expense->id])}}" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
                </center>
            </div>
          </div>
        </div>
      </div>
      @include('components.footer')
    </div>
  </main>

  
  <div class="modal" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Delete Order</h4>
                <button type="button" class="btn-close text-danger" data-bs-dismiss="modal">
                    <i class="fa fa-times" style="font-size:20px;"></i>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form id="addClientForm" action="{{route('expenses.delete',[$expense->id])}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <p>Are you sure you want to delete? if yes, it is going to be deleted together with transaction records.</p>
                        </div>
                    </div>
                    <center>
                        <button type="submit" class="btn btn-primary" id="addClientButton">Delete</button>
                        <button data-bs-dismiss="modal" type="button" class="btn btn-danger" id="addClientButton">Cancel</button>
                    </center>
                </form>
            </div>
        </div>
    </div>
  </div>

  <div class="modal" id="cancelModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Cancel Expense</h4>
                <button type="button" class="btn-close text-danger" data-bs-dismiss="modal">
                    <i class="fa fa-times" style="font-size:20px;"></i>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form id="addClientForm" action="{{route('expenses.cancel', [$expense->id])}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Reason for Canceling</label>
                                <textarea class="form-control" name="reason" id="reason" required></textarea>
                                @error('reason')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <center>
                        <button type="submit" class="btn btn-primary" id="addClientButton">Submit</button>
                        <button data-bs-dismiss="modal" type="button" class="btn btn-danger" id="addClientButton">Cancel</button>
                    </center>
                </form>
            </div>
        </div>
    </div>
  </div>

@push('script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
  <script>
      function printContent(el) {
            var restorepage = $('body').html();
            var printcontent = $('#' + el).clone();
            $('body').empty().html(printcontent);
            window.print();
            window.location.reload(true);
      }

      document.getElementById('btnPrint').addEventListener('click',
            Export);

        function Export() {
            html2canvas(document.getElementById('viewexpenseInfo'), {
                onrendered: function(canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("AARasheedData-Funding.pdf");
                }
            });
        }

  </script>
@endpush