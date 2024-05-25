<!DOCTYPE html>
@extends('layout.appLayout')
@section('title', 'Components')
@php( $page = 'components')
@section('contents')
<div class="min-height-300 bg-primary position-absolute w-100"></div>
    @include('components.sidebar')
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    @include('components.navbar')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="container text-center"><h2 class="text-white">Components</h2></div>
        <div class="row">
          <!--card -->
          <div class="col-md-4 mb-4">
            <a class="card" href="{{route('business.profile')}}" style="text-decoration: none;">
              <div class="card-body py-4 p-3 d-flex justify-content-center align-items-center" style="height:150px">
                <div class="col-12 row">
                  <div class="col-4 justify-content-center align-items-center text-center">
                    <i class="fa fa-bank text-primary" aria-hidden="true" style="font-size: 30px;"></i>
                  </div>
                  <div class="col-8">
                    <div class="numbers">
                      <h6 class="font-weight-bolder">
                        Company Profile
                      </h6>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <!--card -->
          <div class="col-md-4 mb-4">
            <a class="card" href="{{route('components.category')}}" style="text-decoration: none;">
              <div class="card-body py-4 p-3 d-flex justify-content-center align-items-center" style="height:150px">
                <div class="col-12 row">
                  <div class="col-4 justify-content-center align-items-center text-center">
                    <i class="fa fa-sitemap text-primary" aria-hidden="true" style="font-size: 30px;"></i>
                  </div>
                  <div class="col-8">
                    <div class="numbers">
                      <h6 class="font-weight-bolder">
                        Categories
                      </h6>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <!--card -->
          <div class="col-md-4 mb-4">
            <a class="card" href="{{route('components.departments')}}" style="text-decoration: none;">
              <div class="card-body py-4 p-3 d-flex justify-content-center align-items-center" style="height:150px">
                <div class="col-12 row">
                  <div class="col-4 justify-content-center align-items-center text-center">
                    <i class="fa fa-bank text-primary" aria-hidden="true" style="font-size: 30px;"></i>
                  </div>
                  <div class="col-8">
                    <div class="numbers">
                      <h6 class="font-weight-bolder">
                        Departments
                      </h6>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <!--card -->
          <div class="col-md-4 mb-4">
            <a class="card" href="{{route('components.roles')}}" style="text-decoration: none;">
              <div class="card-body py-4 p-3 d-flex justify-content-center align-items-center" style="height:150px">
                <div class="col-12 row">
                  <div class="col-4 justify-content-center align-items-center text-center">
                    <i class="fa fa-bank text-primary" aria-hidden="true" style="font-size: 30px;"></i>
                  </div>
                  <div class="col-8">
                    <div class="numbers">
                      <h6 class="font-weight-bolder">
                        Employment Roles
                      </h6>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <!--card -->
          <div class="col-md-4 mb-4">
            <a class="card" href="{{route('employee.printAccounts')}}" style="text-decoration: none;">
              <div class="card-body py-4 p-3 d-flex justify-content-center align-items-center" style="height:150px">
                <div class="col-12 row">
                  <div class="col-4 justify-content-center align-items-center text-center">
                    <i class="fa fa-bank text-primary" aria-hidden="true" style="font-size: 30px;"></i>
                  </div>
                  <div class="col-8">
                    <div class="numbers">
                      <h6 class="font-weight-bolder">
                        Employees Accounts
                      </h6>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <!--card -->
          {{-- <div class="col-md-3 mb-4">
            <a class="card" href="company-logo" style="text-decoration: none;">
              <div class="card-body py-4 p-3 d-flex justify-content-center align-items-center" style="height:150px">
                <div class="col-12 row">
                  <div class="col-4 justify-content-center align-items-center text-center">
                    <i class="fa fa-sitemap text-primary" aria-hidden="true" style="font-size: 30px;"></i>
                  </div>
                  <div class="col-8">
                    <div class="numbers">
                      <h5 class="font-weight-bolder">
                        Company Logo
                      </h5>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div> --}}
        </div>
  </div>
  @include('components.footer')
    </div>
  </main>