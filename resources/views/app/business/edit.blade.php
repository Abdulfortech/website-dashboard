<!DOCTYPE html>
@extends('layout.appLayout')
@section('title', 'Business Profile')
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
            <div class="col-md-9 mx-auto">
              <div class="card">
                <div class="card-header pb-0">
                  <div class="text-center ">
                    @if(isset(auth()->user()->business->logo))
                        <img src="{{ asset('storage/' . auth()->user()->business->logo) }}" class="rounded-circle" alt="employee-image" width="100" height="100">
                    @else
                        <i class="far fa-home" style="font-size: 80px"></i>
                    @endif
                    <h4 class="mb-0 fw-bold">Business Profile</h4>
                    <!-- <button class="btn btn-primary btn-sm ms-auto">Company Profile</button> -->
                  </div>
                </div>
                <div class="card-body">
                  <p class="text-uppercase text-sm">Business Information</p>
                  <form action="{{route('business.edit', [auth()->user()->business_id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">Company Name</label>
                          <input class="form-control" type="text" value="{{auth()->user()->business->name}}" name="name" required>
                          @error('name')
                          <span class="text-danger small">{{ $message}}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">Motto</label>
                          <input class="form-control" type="text" value="{{auth()->user()->business->motto}}" name="motto" required>
                          @error('motto')
                          <span class="text-danger small">{{ $message}}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">Abbreviation</label>
                          <input class="form-control" type="text" value="{{auth()->user()->business->abbreviation}}" name="abbreviation" placeholder="Example ABC" required>
                          @error('abbreviation')
                          <span class="text-danger small">{{ $message}}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">Category</label>
                          <select class="form-control" name="category" required>
                            <option>{{auth()->user()->business->category}}</option>
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
                          <input class="form-control" type="text" value="{{auth()->user()->business->phone1}}" name="phone1" required>
                          @error('phone1')
                          <span class="text-danger small">{{ $message}}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">Phone Number 2</label>
                          <input class="form-control" type="text" value="{{auth()->user()->business->phone2}}" name="phone2">
                          @error('phone2')
                          <span class="text-danger small">{{ $message}}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">Email address</label>
                          <input class="form-control" type="email" value="{{auth()->user()->business->email}}" name="email" required>
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
                          <input class="form-control" type="text" value="{{auth()->user()->business->address}}" name="address" required>
                          @error('address')
                          <span class="text-danger small">{{ $message}}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">State</label>
                          <input class="form-control" type="text" value="{{auth()->user()->business->state}}" name="state">
                          @error('state')
                          <span class="text-danger small">{{ $message}}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">Lcoal Government</label>
                          <input class="form-control" type="text" value="{{auth()->user()->business->lga}}" name="lga">
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
                          <input class="form-control" type="text" value="{{auth()->user()->business->accountName}}" name="accountName" required>
                          @error('accountName')
                          <span class="text-danger small">{{ $message}}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">Account Number</label>
                          <input class="form-control" type="text" value="{{auth()->user()->business->accountNumber}}" name="accountNumber" required>
                          @error('accountNumber')
                          <span class="text-danger small">{{ $message}}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="example-text-input" class="form-control-label">Bank Name</label>
                          <input class="form-control" type="text" value="{{auth()->user()->business->accountBank}}" name="accountBank" required>
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
                                <input class="form-control" type="file" name="logo">
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