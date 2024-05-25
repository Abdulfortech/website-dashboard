<!DOCTYPE html>
@extends('layout.appLayout')
@section('title', 'Analytics')
@php( $page = 'analytics')
@section('contents')
<div class="min-height-300 bg-primary position-absolute w-100"></div>
    @include('components.sidebar')
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    @include('components.navbar')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="container text-center"><h2 class="text-white">Analytics</h2></div>
      <div class="row">
        <div class="col-12">
            <h4>Products</h4>
        </div>
        <!-- stats card -->
        <div class="col-xl-3 col-sm-6  mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">All Products</p>
                    <h5 class="font-weight-bolder">
                      {{number_format($allProducts)}}
                    </h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder">
                        {{number_format($allProducts)}}</span>
                      Total Products
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
        <div class="col-xl-3 col-sm-6  mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Active Products</p>
                    <h5 class="font-weight-bolder">
                      {{number_format($activeProducts)}}
                    </h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder">{{number_format($activeProducts)}}</span>
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
        <div class="col-xl-3 col-sm-6  mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Products</p>
                    <h5 class="font-weight-bolder">
                      {{number_format($inactiveProducts)}}
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
                      <span class="text-success text-sm font-weight-bolder">{{number_format($inactiveProducts)}}</span>
                      Inactive Products
                    </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- stats card -->
        <div class="col-xl-3 col-sm-6  mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Deleted</p>
                    <h5 class="font-weight-bolder">
                      {{number_format($deletedProducts)}}
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
                      <span class="text-success text-sm font-weight-bolder">{{number_format($deletedProducts)}}</span>
                      Deleted Products
                    </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
      <div class="row mt-4">
        <div class="col-12">
            <h4>Products</h4>
        </div>
        <!-- stats card -->
        <div class="col-xl-3 col-sm-6  mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">All Products</p>
                    <h5 class="font-weight-bolder">
                      {{number_format($allProducts)}}
                    </h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder">
                        {{number_format($allProducts)}}</span>
                      Total Products
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
        <div class="col-xl-3 col-sm-6  mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Active Products</p>
                    <h5 class="font-weight-bolder">
                      {{number_format($activeProducts)}}
                    </h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder">{{number_format($activeProducts)}}</span>
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
        <div class="col-xl-3 col-sm-6  mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Products</p>
                    <h5 class="font-weight-bolder">
                      {{number_format($inactiveProducts)}}
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
                      <span class="text-success text-sm font-weight-bolder">{{number_format($inactiveProducts)}}</span>
                      Inactive Products
                    </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- stats card -->
        <div class="col-xl-3 col-sm-6  mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Deleted</p>
                    <h5 class="font-weight-bolder">
                      {{number_format($deletedProducts)}}
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
                      <span class="text-success text-sm font-weight-bolder">{{number_format($deletedProducts)}}</span>
                      Deleted Products
                    </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
  </div>
  @include('components.footer')
    </div>
  </main>