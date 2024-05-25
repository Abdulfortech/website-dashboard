<!DOCTYPE html>
@extends('layout.appLayout')
@section('title', 'Business Register')
@php( $page = 'business')
@section('contents')
<div class="min-height-300 bg-primary position-absolute w-100"></div>
    @include('components.sidebar')
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    @include('components.navbar')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8 mx-auto">
              <div class="card">
                <div class="card-header pb-0">
                  <div class="text-center ">
                    <h4 class="mb-0 fw-bold">Company Profile</h4>
                    <!-- <button class="btn btn-primary btn-sm ms-auto">Company Profile</button> -->
                  </div>
                </div>
                <div class="card-body">
                  <p class="text-uppercase text-sm">Company Information</p>
                  <form action="{{route('business.add')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">Company Name</label>
                          <input class="form-control" type="text" name="name" required>
                          @error('name')
                          <span class="text-danger small">{{ $message}}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">Motto</label>
                          <input class="form-control" type="text" name="motto" required>
                          @error('motto')
                          <span class="text-danger small">{{ $message}}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">Abbreviation</label>
                          <input class="form-control" type="text" name="abbreviation" placeholder="Example ABC" required>
                          @error('abbreviation')
                          <span class="text-danger small">{{ $message}}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">Category</label>
                          <select class="form-control" name="category" required>
                            <option value="">Choose..</option>
                            <option>Service Provider</option>
                            <option>Manufacturer</option>
                            <option>Retailer</option>
                            <option>Wholesaler</option>
                          </select>
                          @error('category')
                          <span class="text-danger small">{{ $message}}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-12">                
                        <hr class="horizontal dark">
                        <p class="text-uppercase text-sm">Contact Information</p>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">Phone Number 1</label>
                          <input class="form-control" type="text" name="phone1" required>
                          @error('phone1')
                          <span class="text-danger small">{{ $message}}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">Phone Number 2</label>
                          <input class="form-control" type="text" name="phone2">
                          @error('phone2')
                          <span class="text-danger small">{{ $message}}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">Email address</label>
                          <input class="form-control" type="email" name="email" required>
                          @error('email')
                          <span class="text-danger small">{{ $message}}</span>
                          @enderror
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">Address</label>
                          <input class="form-control" type="text" name="address" required>
                          @error('address')
                          <span class="text-danger small">{{ $message}}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">State</label>
                          <input class="form-control" type="text" name="state">
                          @error('state')
                          <span class="text-danger small">{{ $message}}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">Lcoal Government</label>
                          <input class="form-control" type="text" name="lga">
                          @error('lga')
                          <span class="text-danger small">{{ $message}}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-12">                
                        <hr class="horizontal dark">
                        <p class="text-uppercase text-sm">Account Information</p>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">Account Name</label>
                          <input class="form-control" type="text" name="accountName" required>
                          @error('accountName')
                          <span class="text-danger small">{{ $message}}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">Account Number</label>
                          <input class="form-control" type="text" name="accountNumber" required>
                          @error('accountNumber')
                          <span class="text-danger small">{{ $message}}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">Bank Name</label>
                          <input class="form-control" type="text" name="accountBank" required>
                          @error('accountBank')
                          <span class="text-danger small">{{ $message}}</span>
                          @enderror
                        </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">                
                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Other Information</p>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Logo</label>
                                <input class="form-control" type="file" name="logo" required>
                                @error('logo')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <center>
                      <button class="btn btn-primary btn-sm ms-auto" type="submit">Submit</button>
                    </center>
                  </form>
                </div>
              </div>
            </div>
        </div>
      <br><br>
  </div>
  @include('components.footer')
    </div>
  </main>