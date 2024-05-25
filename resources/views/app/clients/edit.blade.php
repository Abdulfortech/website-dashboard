<!DOCTYPE html>
@extends('layout.appLayout')
@section('title', 'Clients')
@php( $page = 'clients')
@section('contents')
<div class="min-height-300 bg-primary position-absolute w-100"></div>
    @include('components.sidebar')
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    @include('components.navbar')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      @include('components.header')
      <div class="row">
        <div class="col-md-7 mx-auto">
          <div class="card mb-4">
            <div class="card-header text-center pb-0">
                <i class="far fa-user-circle" style="font-size: 80px"></i>
              <h4 class="text-center">Edit Client</h4>
            </div>
            <div class="card-body pt-0 pb-2">
                <form id="addClientForm" action="{{route('client.edit', [$client->id])}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Name</label>
                                <input class="form-control" name="name" value="{{$client->name}}" id="addClientName" type="text" required>
                                @error('name')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Type</label>
                                <select class="form-control" name="category" id="addClientType" required>
                                    <option>{{$client->category}}</option>
                                    <option>Individual</option>
                                    <option>Company</option>
                                    <option>Organization</option>
                                    <option>Goverment</option>
                                </select>
                                @error('category')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Phone Number</label>
                                <input class="form-control" type="text" value="{{$client->phone1}}" name="phone1" id="addClientPhone" required>
                                @error('phone1')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Phone Number 2</label>
                                <input class="form-control" type="text" value="{{$client->phone2}}" name="phone2" id="addClientPhone">
                                @error('phone2')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Address</label>
                                <input class="form-control" type="text" value="{{$client->address}}" name="address" id="addClientAddress">
                                @error('address')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <center>
                        <button type="submit" class="btn btn-primary" id="addClientButton">Submit</button>
                    </center>
                </form>
            </div>
          </div>
        </div>
      </div>
      
      @include('components.footer')
    </div>
  </main>