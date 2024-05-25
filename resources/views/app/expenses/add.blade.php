<!DOCTYPE html>
@extends('layout.appLayout')
@section('title', 'Expenses')
@php( $page = 'expenses')
@section('contents')
<div class="min-height-300 bg-primary position-absolute w-100"></div>
    @include('components.sidebar')
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    @include('components.navbar')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="container text-center"><h2 class="text-white">Expenses</h2></div>
      <div class="row">
        <div class="col-md-7 mx-auto">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h4 class="text-center">Add Expense</h4>
            </div>
            <div class="card-body px-2 pt-0 pb-2">
                <form id="addExpenseForm" action="{{route('expenses.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Title</label>
                                <input class="form-control" name="title" id="addExpensetitle" type="text" required>
                                @error('title')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Department</label>
                                <select name="department" id="department"  class="form-control" required>
                                    @if(auth()->user()->user_type == "super-adin")
                                        <option value="">Choose Department</option>
                                        @foreach($departments as $department)
                                            <option>{{$department->title}}</option>
                                        @endforeach
                                    @else
                                    <option>{{auth()->user()->jurisdiction}}</option>
                                    @endif
                                    <option>General</option>
                                </select>
                                @error('department')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Amount</label>
                                <input class="form-control" type="number" name="amount" id="addExpensePhone" required>
                                @error('amount')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Date</label>
                                <input class="form-control" type="date" name="date" id="addExpensePhone" required>
                                @error('date')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Note</label>
                                <textarea class="form-control" name="note" required></textarea>
                                @error('note')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <center>
                        <button type="submit" class="btn btn-primary" id="addExpenseButton">Submit</button>
                    </center>
                </form>
            </div>
          </div>
        </div>
      </div>
      
      @include('components.footer')
    </div>
  </main>