<!DOCTYPE html>
@extends('layout.appLayout')
@section('title', 'View History')
@php( $page = 'history')
@section('contents')
<div class="min-height-300 bg-primary position-absolute w-100"></div>
    @include('components.sidebar')
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    @include('components.navbar')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      @include('components.header')
      <div class="row" id="viewproductInfo">
        <div class="col-md-9 mx-auto">
          <div class="card mb-4">
            <div class="card-header text-center pb-0">
                <i class="fa fa-table" style="font-size: 80px"></i>
              <h4 class="text-center">Inventory History</h4>
            </div>
            <div class="card-body pt-0 pb-2">
                <div class="row">
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Type : </b> {{$history->type}}
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Date : </b> {{$history->date}}
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Product : </b> {{$history->product->title}}
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Department : </b> {{$history->department}}
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Quantity : </b> {{$history->quantity}}
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Amount : </b> &#8358; {{number_format($history->amount, 2, '.', ',')}}
                            </li>
                        </ol>
                    </div>
                    
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Status : </b> {{$history->status}}
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Created On : </b> <span id="middleName">{{$history->created_at}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Added By : </b> <span id="middleName">{{isset($history->added_by)?$history->user->username:'unknown'}}</span>
                            </li>
                        </ol>
                    </div>
                    @if($history->status == 'Canceled')
                        <div class="col-md-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <b>Reason For Cancelling : </b> <span id="middleName">{{$history->cancel_reason}}</span>
                                </li>
                            </ol>
                        </div>
                    @endif
                </div>
                <center>
                    <a href="{{route('history.edit',[$history->id])}}" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
                    @if($history->status != 'Canceled')
                        <button type="button" data-bs-toggle="modal" data-bs-target="#cancelModal" class="btn btn-warning"><i class="fa fa-times"></i> Cancel</button>
                    @endif
                    <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                    <a href="{{route('history.print',[$history->id])}}" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
                </center>
            </div>
          </div>
        </div>
      </div>
      @include('components.footer')
    </div>
  </main>

  {{------ Modals ------}}
  {{-- cancel modal --}}
  <div class="modal" id="cancelModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Cancel History</h4>
                <button type="button" class="btn-close text-danger" data-bs-dismiss="modal">
                    <i class="fa fa-times" style="font-size:20px;"></i>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form id="addClientForm" action="{{route('history.cancel', [$history->id])}}" method="POST">
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
  {{-- delete modal --}}
  <div class="modal" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Delete History</h4>
                <button type="button" class="btn-close text-danger" data-bs-dismiss="modal">
                    <i class="fa fa-times" style="font-size:20px;"></i>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form id="addClientForm" action="{{route('history.delete',[$history->id])}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <p>Are you sure you want to delete this record ? </p>
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
            html2canvas(document.getElementById('viewproductInfo'), {
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