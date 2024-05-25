<!DOCTYPE html>
@extends('layout.appLayout')
@section('title', 'Employees')
@php( $page = 'employees')
@section('contents')
<div class="min-height-300 bg-primary position-absolute w-100"></div>
    @include('components.sidebar')
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    @include('components.navbar')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="container text-center"><h2 class="text-white">Employees</h2></div>
      <div class="row">
        <div class="col-md-9 mx-auto">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h4 class="text-center">Edit Employee</h4>
            </div>
            <div class="card-body px-2 pt-0 pb-2">
                <form id="addClientForm" enctype="multipart/form-data" action="{{route('employee.edit', [$employee->id])}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12"><h6 class="text-left">Personal Information</h6></div>
                        <div class="col-md-4">
                            <div class="form-group my-0">
                                <label for="example-text-input" class="form-control-label">First Name</label>
                                <input class="form-control" name="firstName" value="{{$employee->firstName}}" type="text" required>
                                @error('firstName')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group my-0">
                                <label for="example-text-input" class="form-control-label">Middle Name</label>
                                <input class="form-control" type="text" name="middleName" value="{{$employee->middleName}}" required>
                                @error('middleName')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group my-0">
                                <label for="example-text-input" class="form-control-label">Last Name</label>
                                <input class="form-control" type="text" name="lastName" value="{{$employee->lastName}}" required>
                                @error('lastName')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group my-0">
                                <label for="optiona">Date of Birth *</label>
                                <input class="form-control" type="date" value="{{$employee->dob}}" name="dob">
                                @error('dob')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group my-0">
                                <label for="optiona">Gender *</label>
                                <select class="form-control" name="gender"  required>
                                    <option>{{$employee->gender}}</option>
                                    <option>Female</option>
                                    <option>Male</option>
                                </select>
                                @error('gender')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group my-0">
                                <label for="example-text-input" class="form-control-label">Marital Status</label>
                                <select name="maritalStatus" id="maritalStatus"  class="form-control" >
                                    <option>{{$employee->maritalStatus}}</option>
                                    <option>Single</option>
                                    <option>Married</option>
                                    <option>Widowed</option>
                                    <option>Divorced</option>
                                </select>
                                @error('maritalStatus')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group my-0">
                                <label for="example-text-input" class="form-control-label">Picture</label>
                                <input class="form-control" type="file" name="picture" id="addPicture">
                                @error('picture')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12 mt-4"><h6 class="text-left">Contact Information</h6></div>
                        <div class="col-md-6">
                            <div class="form-group my-0">
                                <label for="example-text-input" class="form-control-label">Phone Number 1</label>
                                <input class="form-control" type="text" name="phone1" value="{{$employee->phone1}}" required>
                                @error('phone1')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group  my-0">
                                <label for="example-text-input" class="form-control-label">Phone Number 2</label>
                                <input class="form-control" type="text" name="phone2" value="{{$employee->phone2}}">
                                @error('phone2')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group my-0">
                                <label>State *</label>
                                <select name="state" id="state"  class="form-control" required>
                                    <option>{{$employee->state}}</option>
                                    <option>Kano</option>
                                    {{-- <?php include 'state-list.php';?> --}}
                                </select>
                                @error('state')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group my-0">
                                <label>Local Government *</label>
                                <input class="form-control" type="text" name="lga" value="{{$employee->lga}}" required>
                                @error('lga')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group my-0">
                                <label for="optiona">Address *</label>
                                <input class="form-control" type="text" name="address" value="{{$employee->address}}" required>
                                @error('address')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-12 mt-4"><h6 class="text-left">Identification Information</h6></div>
                        
                        <div class="col-md-6">
                            <div class="form-group my-0">
                                <label for="example-text-input" class="form-control-label">Identification Type</label>
                                <select name="idType" id="idType"  class="form-control" required>
                                    <option>{{$employee->idType}}</option>
                                    <option>International Passport</option>
                                    <option>National ID Card</option>
                                </select>
                                @error('idType')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group my-0">
                                <label for="example-text-input" class="form-control-label">Identification Number</label>
                                <input class="form-control" type="text" name="idNumber" value="{{$employee->idNumber}}" required>
                                @error('idNumber')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group my-0">
                                <label for="example-text-input" class="form-control-label">ID Picture</label>
                                <input class="form-control" type="file" name="idPicture" id="addPicture">
                                @error('idPicture')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12 mt-4"><h6 class="text-left">Guarantor Information</h6></div>
                        <div class="col-md-7">
                            <div class="form-group my-0">
                                <label for="example-text-input" class="form-control-label">Name</label>
                                <input class="form-control" type="text" name="guarantorName" value="{{$employee->guarantorName}}" required>
                                @error('guarantorName')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group my-0">
                                <label for="example-text-input" class="form-control-label">RelationShip</label>
                                <select name="guarantorRelation" id="addguarantorRelation"  class="form-control" required>
                                    <option>{{$employee->guarantorRelation}}</option>
                                    <option>Father</option>
                                    <option>Mother</option>
                                    <option>Grand Father</option>
                                    <option>Grand Mother</option>
                                    <option>Uncle</option>
                                    <option>Aunty</option>
                                    <option>Neice</option>
                                    <option>Cousins</option>
                                    <option>Sibling</option>
                                    <option>Friend</option>
                                    <option>District Head</option>
                                    <option>Community Leader</option>
                                </select>
                                @error('guarantorRelation')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group my-0">
                                <label for="example-text-input" class="form-control-label">Phone Number 1</label>
                                <input class="form-control" type="text" name="guarantorPhone1" value="{{$employee->guarantorPhone1}}" required>
                                @error('guarantorPhone1')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group  my-0">
                                <label for="example-text-input" class="form-control-label">Phone Number 2</label>
                                <input class="form-control" type="text" name="guarantorPhone2" value="{{$employee->guarantorPhone2}}">
                                @error('guarantorPhone2')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group my-0">
                                <label for="optiona">Address *</label>
                                <input class="form-control" type="text" name="guarantorAddress" value="{{$employee->guarantorAddress}}" required>
                                @error('guarantorAddress')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 mt-4"><h6 class="text-left">Employment Information</h6></div>
                        <div class="col-md-6">
                            <div class="form-group my-0">
                                <label for="example-text-input" class="form-control-label">Employment #ID</label>
                                <input class="form-control" type="text" name="employeeID" value="{{$employee->employeeID}}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group my-0">
                                <label for="example-text-input" class="form-control-label">Employment Date</label>
                                <input class="form-control" type="date" name="employmentDate" value="{{$employee->employmentDate}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group my-0">
                                <label for="example-text-input" class="form-control-label">Department</label>
                                <select name="department" id="department"  class="form-control" required>
                                    <option>{{$employee->department}}</option>
                                    @foreach($departments as $department)
                                        <option>{{$department->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group my-0">
                                <label for="example-text-input" class="form-control-label">Role</label>
                                <select name="role" id="role"  class="form-control" required>
                                    <option>{{$employee->role}}</option>
                                    @foreach($roles as $role)
                                        <option>{{$role->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mt-4"><h6 class="text-left">Account Information</h6></div>
                        <div class="col-md-4">
                            <div class="form-group my-0">
                                <label for="example-text-input" class="form-control-label">Account Name</label>
                                <input class="form-control" type="text" name="accountName" value="{{$employee->accountName}}">
                                @error('accountName')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group my-0">
                                <label for="example-text-input" class="form-control-label">Account Number</label>
                                <input class="form-control" type="text" name="accountNumber" value="{{$employee->accountNumber}}">
                                @error('accountNumber')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group my-0">
                                <label for="example-text-input" class="form-control-label">Bank Name</label>
                                <input class="form-control" type="text" name="accountBank" value="{{$employee->accountBank}}">
                                @error('accountBank')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <center>
                        <button type="submit" class="btn btn-primary my-4" id="addAdminButton">Submit</button>
                    </center>
                </form>
            </div>
          </div>
        </div>
      </div>
      
      @include('components.footer')
    </div>
  </main>