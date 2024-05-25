<!DOCTYPE html>
@extends('layout.appLayout')
@section('title', 'Add History')
@php( $page = 'history')
@section('contents')
<style>
 

.image-preview {
    width: 150px;
    height: 150px;
    border: 2px solid #ddd;
    background-size: cover;
    background-position: center;
}
</style>
<div class="min-height-300 bg-primary position-absolute w-100"></div>
    @include('components.sidebar')
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    @include('components.navbar')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      @include('components.header')
      <div class="row">
        <div class="col-md-9 mx-auto">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h4 class="text-center">Add History</h4>
            </div>
            <div class="card-body pt-0 pb-2">
                <form id="addProductForm" enctype="multipart/form-data" action="{{route('history.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Type</label>
                                <select class="form-control" name="type" id="addProductCategory" required>
                                    <option selected value="">Choose..</option>
                                    <option>Stock-In</option>
                                    <option>Stock-Out</option>
                                </select>
                                @error('type')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Date</label>
                                <input class="form-control" name="date" id="addProductName" type="date" required>
                                @error('date')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Product</label>
                                <select class="form-control" name="product_id" id="addProductCategory" required>
                                    <option selected value="">Choose..</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->title}}</option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Department</label>
                                <select class="form-control" name="department" id="addProductDepartment" required>
                                    @if(auth()->user()->user_type == "super-adin")
                                        <option value="">Choose Department</option>
                                        @foreach($departments as $department)
                                            <option>{{$department->title}}</option>
                                        @endforeach
                                    @else
                                    <option>{{auth()->user()->jurisdiction}}</option>
                                    @endif
                                </select>
                                @error('department')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Quantity</label>
                                <input class="form-control" type="number" name="quantity" id="addProductStock" required>
                                @error('quantity')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Amount(&#8358;) <small>insert zero for stock-in</small></label>
                                <input class="form-control" type="number" name="amount" id="addProductCost" required>
                                @error('amount')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <center>
                        <button type="submit" class="btn btn-primary" id="addProductButton">Submit</button>
                    </center>
                </form>
            </div>
          </div>
        </div>
      </div>
      
      @include('components.footer')
    </div>
  </main>

  @push('script')
  <script>
    function displayImage(input) {
        const preview = document.getElementById('imagePreview1');
        const file = input.files[0];

        if (file) {
            const reader = new FileReader();

            reader.addEventListener('load', function () {
                preview.style.backgroundImage = `url(${reader.result})`;
            });

            reader.readAsDataURL(file);
        } else {
            preview.style.backgroundImage = 'none';
        }
    }

  </script>
  @endpush