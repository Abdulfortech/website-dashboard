<!DOCTYPE html>
@extends('layout.appLayout')
@section('title', 'Products')
@php( $page = 'products')
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
                @if(isset($product->image1))
                    <img src="{{ asset('storage/' . $product->image1) }}" class="rounded-circle" alt="product-image" width="100" height="100">
                @else
                    <i class="ni ni-app" style="font-size: 80px"></i>
                @endif
              <h4 class="text-center">Product Information</h4>
            </div>
            <div class="card-body pt-0 pb-2">
                <div class="row">
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Title : </b> {{$product->title}}
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Brand : </b> {{$product->brand}}
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>#ID : </b> {{$product->code}}
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Category : </b> {{$product->category}}
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Department : </b> {{$product->department}}
                            </li>
                        </ol>
                    </div>
                    {{-- <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Stock : </b> {{$product->quantity}}
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Cost : </b> &#8358; {{number_format($product->cost, 2, '.', ',')}}
                            </li>
                        </ol>
                    </div> --}}
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Wholesale Price : </b> &#8358; {{number_format($product->wholesalePrice, 2, '.', ',')}}
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Retail Price : </b> &#8358; {{number_format($product->retailPrice, 2, '.', ',')}}
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Received Date : </b> {{$product->receivedDate}}
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Sold Out Date : </b> {{$product->soldoutDate}}
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Description : </b> {{$product->description}}
                            </li>
                        </ol>
                    </div>
                    
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Status : </b> {{$product->status}}
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Created On : </b> <span id="middleName">{{$product->created_at}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Last Update : </b> {{$product->updated_at}}
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Added By : </b> <span id="middleName">{{isset($product->user_id)?$product->user->username:'unknown'}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Updated By : </b> {{isset($product->updated_by)?$product->updatedBy->username: ''}}
                            </li>
                        </ol>
                    </div>
                </div>
                <center>
                    <a href="{{route('products.showEdit',[$product->id])}}" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
                    @if($product->status == 'Active')
                    <a href="{{route('products.deactivate',[$product->id])}}" class="btn btn-warning"><i class="fa fa-arrow-up"></i> Deactivate</a>
                    @else
                    <a href="{{route('products.activate',[$product->id])}}" class="btn btn-success"><i class="fa fa-arrow-down"></i> Activate</a>
                    @endif
                    <a href="{{route('products.delete',[$product->id])}}" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                    <a href="{{route('products.print',[$product->id])}}" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
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