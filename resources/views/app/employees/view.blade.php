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
      <div class="row" id="viewEmployeeInfo">
        <div class="col-md-9 mx-auto">
          <div class="card mb-4">
            <div class="card-header text-center pb-0">
                @if(isset($employee->picture))
                    <img src="{{ asset('storage/' . $employee->picture) }}" class="rounded-circle" alt="employee-image" width="100" height="100">
                @else
                    <i class="far fa-user-circle" style="font-size: 80px"></i>
                @endif
              <h4 class="text-center">Employee Information</h4>
            </div>
            <div class="card-body pt-0 pb-2">
                <div class="row">
                    <div class="col-md-12"><h6 class="text-left">Personal Information</h6></div>
                    <div class="col-md-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>First Name : </b> <span id="firstName">{{$employee->firstName}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Middle Name : </b> <span id="middleName">{{$employee->middleName}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Last Name : </b> <span id="lastName">{{$employee->lastName}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Date of Birth : </b> <span id="dob">{{$employee->dob}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Marital Status : </b> <span id="dob">{{$employee->maritalStatus}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Gender : </b> <span id="gender">{{$employee->gender}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-12"><h6 class="text-left">Contact Information</h6></div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Phone Number 1 : </b> <span id="phone1">{{$employee->phone1}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Phone Number 2 : </b> <span id="phone2">{{$employee->phone2}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>State : </b> <span id="state">{{$employee->state}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Local Government : </b> <span id="lga">{{$employee->lga}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Address : </b> <span id="address">{{$employee->address}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-12 mt-1"><h6 class="text-left">Identification Information</h6></div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Type : </b> <span id="IDType">{{$employee->idType}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>ID Number : </b> <span id="IDType">{{$employee->idNumber}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-12 mt-1"><h6 class="text-left">Grantor Information</h6></div>
                    <div class="col-md-7">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Name : </b> <span id="gName">{{$employee->guarantorName}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-5">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Relation : </b> <span id="gRelation">{{$employee->guarantorRelation}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Phone Number 1 : </b> <span id="gPhone1">{{$employee->guarantorPhone1}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Phone Number 2 : </b> <span id="gPhone2">{{$employee->guarantorPhone2}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Address : </b> <span id="gAddress">{{$employee->guarantorAddress}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-12 mt-1"><h6 class="text-left">Employment Information</h6></div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Employee #ID : </b> <span id="eID">{{$employee->employeeID}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Employment Date : </b> <span id="eDate">{{$employee->employmentDate}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Department : </b> <span id="department">{{$employee->department}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Role : </b> <span id="role">{{$employee->role}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-12"><h6 class="text-left">Account Information</h6></div>
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Account Name : </b> <span id="accountName">{{$employee->accountName}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Account Number : </b> <span id="accountNumber">{{$employee->accountNumber}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Bank Name : </b> <span id="accountBank">{{$employee->accountBank}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Status : </b> <span id="middleName">{{$employee->status}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Created On : </b> <span id="middleName">{{$employee->created_at}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Added By : </b> <span id="middleName">{{isset($employee->user_id)?$employee->user->username:'unknown'}}</span>
                            </li>
                        </ol>
                    </div>
                </div>
                <center>
                    <a href="{{route('employee.showEdit',[$employee->id])}}" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
                    <a href="{{route('employee.delete',[$employee->id])}}" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                    <a href="{{route('employee.print',[$employee->id])}}" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
                </center>
            </div>
          </div>
        </div>
      </div>
      @include('components.footer')
    </div>
  </main>
  @push('script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
  <script>
      function printContent(el) {
            var restorepage = $('body').html();
            var printcontent = $('#' + el).clone();
            $('body').empty().html(printcontent);
            window.print();
            window.location.reload(true);
      }

      document.getElementById('btnPrint').addEventListener('click',
            Export);

        function Export() {
            html2canvas(document.getElementById('viewEmployeeInfo'), {
                onrendered: function(canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("AARasheedData-Funding.pdf");
                }
            });
        }

  </script>
@endpush