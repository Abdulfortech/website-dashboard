<!DOCTYPE html>
@extends('layout.appLayout')
@section('title', 'Products')
@php( $page = 'products')
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
            <div class="card-header text-center pb-0">
                @if(isset($product->image1))
                    <img src="{{ asset('storage/' . $product->image1) }}" class="rounded-circle" alt="employee-image" width="100" height="100">
                @else
                    <i class="ni ni-app" style="font-size: 80px"></i>
                @endif
              <h4 class="text-center">Edit Product</h4>
            </div>
            <div class="card-body px-2 pt-0 pb-2">
                <form id="addProductForm" enctype="multipart/form-data" action="{{route('products.edit', [$product->id])}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Name</label>
                                <input class="form-control" name="title" value="{{$product->title}}" type="text" required>
                                @error('title')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Product #ID</label>
                                <input class="form-control" type="text" name="code" value="{{$product->code}}" readonly>
                                @error('code')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Brand</label>
                                <input class="form-control" type="text" name="brand" value="{{$product->brand}}">
                                @error('brand')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Category</label>
                                <select class="form-control" name="category" required>
                                    <option>{{$product->category}}</option>
                                    @foreach($categories as $category)
                                        <option>{{$category->title}}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Department</label>
                                <select class="form-control" name="department" id="addProductDepartment" required>
                                    <option>{{$product->department}}</option>
                                    @foreach($departments as $department)
                                        <option>{{$department->title}}</option>
                                    @endforeach
                                </select>
                                @error('department')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Stock</label>
                                <input class="form-control" type="number" name="quantity" value="{{$product->quantity}}" required>
                                @error('quantity')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Cost(&#8358;)</label>
                                <input class="form-control" type="number" name="cost" value="{{$product->cost}}" required>
                                @error('cost')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Wholesale Price(&#8358;)</label>
                                <input class="form-control" type="number" name="wholesalePrice" value="{{$product->wholesalePrice}}" required>
                                @error('wholesalePrice')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Retail Price(&#8358;)</label>
                                <input class="form-control" type="number" name="retailPrice" value="{{$product->retailPrice}}" required>
                                @error('retailPrice')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Receive Date</label>
                                <input class="form-control" type="date" name="receivedDate" value="{{$product->receivedDate}}" required>
                                @error('receivedDate')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Sold Out Date</label>
                                <input class="form-control" type="date" name="soldoutDate'" value="{{$product->soldoutDate}}">
                                @error('soldoutDate')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Picture</label>
                                <input class="form-control" type="file" name="image1" id="addProductPicture">
                                @error('image1')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div> --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Description</label>
                                <textarea class="form-control" name="description" id="addProductStock">{{$product->description}}</textarea>
                                @error('description')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 offset-md-4">
                            <div class="card p-0">
                                <div class="card-body p-0 text-center align-items-center">
                                    <center>
                                        <label for="image1" class="d-block">
                                            <input type="file" id="image1" name="image1" class="form-control-file d-none" accept="image/*" onchange="displayImage(this)">
                                            <span class="image-label">Upload Picture</span>
                                            <div class="image-preview mt-3" id="imagePreview1"></div>
                                        </label>
                                    </center> 
                                    @error('image1')
                                    <span class="text-danger small">{{ $message}}</span>
                                    @enderror
                                </div>
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