<!DOCTYPE html>
@extends('layout.appLayout')
@section('title', 'View Order')
@php( $page = 'orders')
@section('contents')
<div class="min-height-300 bg-primary position-absolute w-100"></div>
    @include('components.sidebar')
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    @include('components.navbar')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="container">
            <h2 class="text-center text-white">Order Information</h2>
        </div>
      <div class="row" id="viewproductInfo">
        <div class="col-md-10 mx-auto">
          <div class="card mb-4">
            <div class="card-header text-center pb-0">
              <h3 class="text-center">Order Information</h3>
            </div>
            <div class="card-body pt-0 pb-2">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <h5 class="">Client Information</h5>
                        <h6>
                            <span class="fw-bold small">Name : {{$order->client_name}},</span><br>
                            <span class="fw-bold small">Phone : {{$order->client_phone}},</span><br>
                            <span class="fw-bold small">Address : {{$order->client_address}}.</span><br>
                            <span class="fw-bold small"> Ordered On : {{$order->sell_at}}</span>
                        </h6>
                    </div>
                    <div class="col-md-6 col-12 text-end">
                        <h5 class="">Order Information</h5>
                        <h6>
                            <span class="fw-bold small">Order #ID : <b>{{$order->order_code}}</b></span><br>
                            <spam class="fw-bold small"> Order Type : {{$order->order_type}}</spam><br>
                            <span class="fw-bold small">Order Status :
                                @if($order->status == 'Active')
                                    <span class="badge bg-primary p-1">Active</span>
                                @elseif($order->status == 'Pending')
                                    <span class="badge bg-secondary p-1">Pending</span>
                                @elseif($order->status == 'Completed')
                                    <span class="badge bg-success p-1">Completed</span>                                
                                @elseif($order->status == 'Canceled')
                                <span class="badge bg-danger p-1">Canceled</span>
                                @else
                                    <span class="badge bg-dark p-1">Unknown</span>
                                @endif    
                            </span><br>
                            <span class="fw-bold small">Payment Status :
                                @if($order->payment_status == 'Paid')
                                    <span class="badge bg-success p-1">{{$order->payment_status}}</span>
                                @elseif($order->payment_status == 'Paid_portion')
                                    <span class="badge bg-info p-1">Paid Portion</span>
                                @else
                                    <span class="badge bg-danger p-1">Unpaid</span>
                                @endif
                            </span>
                        </h6>
                    </div>
                    <div class="col-12 mt-4">
                        <h5 class="">Items</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($count = 1)
                                @foreach($items as $item)
                                    <tr>
                                        <td class="text-end">{{$count}}</td>
                                        <td >{{$item->item_name}}</td>
                                        <td class="text-end">{{$item->quantity}}</td>
                                        <td class="text-end">&#8358; {{number_format($item->price)}}</td>
                                        <td class="text-end">&#8358; {{number_format($item->total)}}</td>
                                    </tr>
                                    @php($count++)
                                @endforeach
                                <tr class="text-end fw-bolder" style="border-top: 2px solid #333;">
                                    <td colspan="2">Total Quantity :</td>
                                    <td class="text-end">{{number_format($order->quantity)}}</td>
                                    <td colspan="">Sub Total :</td>
                                    <td class="text-end">&#8358; {{number_format($order->subtotal)}}</td>
                                </tr>
                                <tr class="text-end fw-bolder">
                                    <td colspan="2">Discount :</td>
                                    <td class="text-end">&#8358; {{number_format($order->discount)}}</td>
                                    <td colspan="">Total :</td>
                                    <td class="text-end">&#8358; {{number_format($order->total)}}</td>
                                </tr>
                                <tr class="text-end fw-bolder">
                                    <td colspan="2">Deposit :</td>
                                    <td class="text-end">&#8358; {{number_format($order->deposit)}}</td>
                                    <td colspan="">Balance :</td>
                                    <td class="text-end">&#8358; {{number_format($order->balance)}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-12 mt-4">
                        <h5 class="">Transactions</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Method</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($count = 1)
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td class="">{{$count}}</td>
                                        <td >{{$transaction->type}}</td>
                                        <td class="">&#8358; {{number_format($transaction->amount)}}</td>
                                        <td class="">{{$transaction->method}}</td>
                                        <td class=""><span class="badge bg-primary">{{$transaction->status}}</span></td>
                                        <td class="">{{$transaction->created_at}}</td>
                                    </tr>
                                    @php($count++)
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <hr>
                <div class="row mb-5">
                    <div class="col-md-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Department : </b> <span id="middleName">{{$order->department}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Created On : </b> <span id="middleName">{{$order->created_at}}</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <b>Added By : </b> <span id="middleName">{{isset($order->added_by)?$order->user->username:'unknown'}}</span>
                            </li>
                        </ol>
                    </div>
                </div>
                <center>
                    @if($order->status != 'Completed')
                        <a href="{{route('orders.completed',[$order->id])}}" class="btn btn-info"> Completed</a>
                    @endif

                    @if($order->status != 'Completed' && $order->status != 'Canceled' && $order->payment_status != 'Paid' || $order->deposit != $order->total)
                        <button type="button" data-bs-toggle="modal" data-bs-target="#transactionModal" class="btn btn-primary"><i class="fa fa-credit-card"></i> Payment</button>
                    @endif
                    @if($order->status != 'Canceled')
                        <button type="button" data-bs-toggle="modal" data-bs-target="#cancelModal" class="btn btn-warning"><i class="fa fa-times"></i> Cancel</button>
                    @endif
                    <a href="{{route('orders.receipt',[$order->id])}}" class="btn btn-info"><i class="fa fa-print"></i> Print</a>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                    {{-- <a href="{{route('products.showEdit',[$product->id])}}" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
                    @if($product->status == 'Active')
                    <a href="{{route('products.deactivate',[$product->id])}}" class="btn btn-warning"><i class="fa fa-arrow-up"></i> Deactivate</a>
                    @else
                    <a href="{{route('products.activate',[$product->id])}}" class="btn btn-success"><i class="fa fa-arrow-down"></i> Activate</a>
                    @endif
                    <button class="btn btn-primary" onclick="printContent('viewproductInfo');">Print</button>
                    <button class="btn btn-primary" id="btnPrint">Save</button> --}}
                </center>
            </div>
          </div>
        </div>
      </div>
      @include('components.footer')
    </div>
  </main>

  <div class="modal" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Delete Order</h4>
                <button type="button" class="btn-close text-danger" data-bs-dismiss="modal">
                    <i class="fa fa-times" style="font-size:20px;"></i>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form id="addClientForm" action="{{route('orders.delete',[$order->id])}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <p>Are you sure you want to delete? if yes, it is going to be deleted together with transaction records.</p>
                        </div>
                    </div>
                    <center>
                        <button type="submit" class="btn btn-primary" id="addClientButton">Delete</button>
                        <button data-bs-dismiss="modal" type="button" class="btn btn-danger" id="addClientButton">Cancel</button>
                    </center>
                </form>
            </div>
        </div>
    </div>
  </div>

  <div class="modal" id="cancelModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Cancel Order</h4>
                <button type="button" class="btn-close text-danger" data-bs-dismiss="modal">
                    <i class="fa fa-times" style="font-size:20px;"></i>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form id="addClientForm" action="{{route('orders.cancel', [$order->id])}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Reason for Canceling</label>
                                <textarea class="form-control" name="reason" id="reason" required></textarea>
                                @error('reason')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <center>
                        <button type="submit" class="btn btn-primary" id="addClientButton">Submit</button>
                        <button data-bs-dismiss="modal" type="button" class="btn btn-danger" id="addClientButton">Cancel</button>
                    </center>
                </form>
            </div>
        </div>
    </div>
  </div>
  {{-- payment modal --}}
  <div class="modal" id="transactionModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Payment</h4>
                <button type="button" class="btn-close text-danger" data-bs-dismiss="modal">
                    <i class="fa fa-times" style="font-size:20px;"></i>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form id="addClientForm" action="{{route('orders.transaction', [$order->id])}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="">Total(&#8358;)</label>
                            <input class="form-control" type="number" name="total" id="total" value="{{$order->total}}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="">Old Balance(&#8358;)</label>
                            <input class="form-control" type="number" name="oldBalance" id="oldBalance" value="{{$order->balance}}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="">Amount To Pay(&#8358;)</label>
                            <input class="form-control" type="number" name="amount" id="amount" value="{{$order->balance}}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="">Status</label>
                            <input class="form-control" type="text" name="status" id="status" value="Paid" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="">Payment Method</label>
                            <select class="form-control" name="method" id="method"required>
                                <option value="">Choose Payment Method</option>
                                <option>Cash</option>
                                <option>Bank Transfer</option>
                            </select>
                        </div>
                    </div>
                    <center>
                        <button type="submit" class="btn btn-primary" id="addClientButton">Submit</button>
                        <button data-bs-dismiss="modal" type="button" class="btn btn-danger" id="addClientButton">Cancel</button>
                    </center>
                </form>
            </div>
        </div>
    </div>
  </div>


  @push('script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
  <script>
    // function printContent(el) {
    //     var restorepage = $('body').html();
    //     var printcontent = $('#' + el).clone();
    //     $('body').empty().html(printcontent);
    //     window.print();
    //     window.location.reload(true);
    // }

    //   document.getElementById('btnPrint').addEventListener('click',Export);

    // function Export() {
    //     html2canvas(document.getElementById('viewproductInfo'), {
    //         onrendered: function(canvas) {
    //             var data = canvas.toDataURL();
    //             var docDefinition = {
    //                 content: [{
    //                     image: data,
    //                     width: 500
    //                 }]
    //             };
    //             pdfMake.createPdf(docDefinition).download("AARasheedData-Funding.pdf");
    //         }
    //     });
    // }
    const amount = document.getElementById('amount');

    // amount.addEventListener('input', () => {
    //     calculateBalance(amount.value);
    // });
    // function calculateBalance (amount)
    // {
    //     // get the inputs
    //     const total = document.getElementById('total');
    //     const deposit = document.getElementById('deposit');
    //     const oldBalance = document.getElementById('oldBalance');
    //     const newBalance = document.getElementById('newBalance');
    //     const status = document.getElementById('status');
    //     // get the values
    //     var totalAmount = total.value;
    //     var depositAmount = total.value;
    //     var oldBalanceAmount = total.value;

    //     var newBalanceAmount = oldBalanceAmount - amount;
        

    // }
    function formatNumber(number) {
            return new Intl.NumberFormat().format(number);
        }

  </script>
@endpush