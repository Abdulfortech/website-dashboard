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
              <h4 class="text-center">Add Employee</h4>
            </div>
            <div class="card-body pt-0 pb-2">
                <form id="addClientForm" enctype="multipart/form-data" action="{{route('employee.add')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12"><h6 class="text-left">Personal Information</h6></div>
                        <div class="col-md-4">
                            <div class="form-group my-0">
                                <label for="example-text-input" class="form-control-label">First Name</label>
                                <input class="form-control" name="firstName" id="addFname" type="text" required>
                                @error('firstName')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group my-0">
                                <label for="example-text-input" class="form-control-label">Middle Name</label>
                                <input class="form-control" type="text" name="middleName" id="addLname" required>
                                @error('middleName')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group my-0">
                                <label for="example-text-input" class="form-control-label">Last Name</label>
                                <input class="form-control" type="text" name="lastName" id="addLname" required>
                                @error('lastName')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group my-0">
                                <label for="optiona">Date of Birth *</label>
                                <input class="form-control" type="date"  name="dob">
                                @error('dob')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group my-0">
                                <label for="optiona">Gender *</label>
                                <select class="form-control" name="gender" required>
                                    <option selected value="">Choose..</option>
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
                                    <option selected value="">Choose..</option>
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
                                <input class="form-control" type="text" name="phone1" id="addPhone" required>
                                @error('phone1')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group  my-0">
                                <label for="example-text-input" class="form-control-label">Phone Number 2</label>
                                <input class="form-control" type="text" name="phone2" id="addPhone">
                                @error('phone2')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group my-0">
                                <label>State *</label>
                                <select name="state" id="state"  class="form-control" required>
                                    <option selected value="">Choose..</option>
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
                                <input class="form-control" type="text" name="lga" required>
                                @error('lga')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group my-0">
                                <label for="optiona">Address *</label>
                                <input class="form-control" type="text" name="address" required>
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
                                    <option selected value="">Choose..</option>
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
                                <input class="form-control" type="text" name="idNumber" id="idNumber" required>
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
                                <input class="form-control" type="text" name="guarantorName" id="addguarantorName">
                                @error('guarantorName')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group my-0">
                                <label for="example-text-input" class="form-control-label">RelationShip</label>
                                <select name="guarantorRelation" id="addguarantorRelation"  class="form-control" required>
                                    <option selected value="">Choose..</option>
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
                                <input class="form-control" type="text" name="guarantorPhone1" id="addPhone" required>
                                @error('guarantorPhone1')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group  my-0">
                                <label for="example-text-input" class="form-control-label">Phone Number 2</label>
                                <input class="form-control" type="text" name="guarantorPhone2" id="addPhone">
                                @error('guarantorPhone2')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group my-0">
                                <label for="optiona">Address *</label>
                                <input class="form-control" type="text" name="guarantorAddress" required>
                                @error('guarantorAddress')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12 mt-4"><h6 class="text-left">Employment Information</h6></div>
                        <div class="col-md-6">
                            <div class="form-group my-0">
                                <label for="example-text-input" class="form-control-label">Employment #ID</label>
                                <input class="form-control" type="text" name="employeeID" value="{{$ID}}" id="addguarantorName" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group my-0">
                                <label for="example-text-input" class="form-control-label">Employment Date</label>
                                <input class="form-control" type="date" name="employmentDate" id="employmentDate">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group my-0">
                                <label for="example-text-input" class="form-control-label">Department</label>
                                <select name="department" id="department"  class="form-control" >
                                    <option selected value="">Choose..</option>
                                    @foreach($departments as $department)
                                        <option>{{$department->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group my-0">
                                <label for="example-text-input" class="form-control-label">Role</label>
                                <select name="role" id="role"  class="form-control" >
                                    <option selected value="">Choose..</option>
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
                                <input class="form-control" type="text" name="accountName" id="accountName">
                                @error('accountName')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group my-0">
                                <label for="example-text-input" class="form-control-label">Account Number</label>
                                <input class="form-control" type="text" name="accountNumber" id="accountNumber">
                                @error('accountNumber')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group my-0">
                                <label for="example-text-input" class="form-control-label">Bank Name</label>
                                <input class="form-control" type="text" name="accountBank" id="accountBank">
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