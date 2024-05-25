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
      <div class="container text-center"><h2 class="text-white">Products</h2></div>
      <!-- statistics -->
      <div class="row">
        <!-- stats card -->
        <div class="col-xl-4 col-sm-6  mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Products</p>
                    <h5 class="font-weight-bolder">
                      {{number_format($allProducts, 0, ',')}}
                    </h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder"></span>
                      All Products
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="ni ni-app text-lg opacity-10" aria-hidden="true"></i>
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
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Active Products</p>
                    <h5 class="font-weight-bolder">
                      {{number_format($activeProducts, 0, ',')}}
                    </h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder"></span>
                      Active Products
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="ni ni-app text-lg opacity-10" aria-hidden="true"></i>
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
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Out of Stock</p>
                    <h5 class="font-weight-bolder">
                      {{number_format($outstockProducts, 0, ',')}}
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="ni ni-app text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
                <div class="col-12">
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder"></span>
                      Out of Stock Products
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
              <h6 class="float-start">Products</h6>
              <a href="{{route('products.showAdd')}}" class="float-end btn btn-primary btn-sm"> <i class="fa fa-plus"></i> Add</a>
              <a href="{{route('products.printAll')}}" class="float-end btn btn-primary btn-sm mx-2"> <i class="fa fa-print"></i> Print </a>
            </div>
            <div class="card-body px-2 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0" id="datatable">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary font-weight-bolder">S/N</th>
                      <th class="text-uppercase text-secondary font-weight-bolder">#ID</th>
                      <th class="text-uppercase text-secondary font-weight-bolder">Name</th>
                      <th class="text-uppercase text-secondary font-weight-bolder">Price</th>
                      {{-- <th class="text-uppercase text-secondary font-weight-bolder">Stock</th> --}}
                      <th class="text-uppercase text-secondary font-weight-bolder">Status</th>
                      <th class="text-uppercase text-secondary font-weight-bolder">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php($count = 1)
                      @foreach($products as $product)
                      <tr>
                          <td>{{$count}}</td>
                          <td>{{$product->code}}</td>
                          <td>{{$product->title}}</td>
                          <td>{{number_format($product->retailPrice)}}</td>
                          {{-- <td>{{$product->quantity}}</td> --}}
                          <td>{{$product->status}}</td>
                          <td>
                            <a href="{{route('products.showView',[$product->id])}}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                            <a href="{{route('products.showEdit',[$product->id])}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                            <a href="{{route('products.delete',[$product->id])}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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