<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    

    .product-container {
      width: 700px;
      margin: auto;
      /* padding: 10px; */
      /* border: 1px solid #ddd; */
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    .product-container .margin{
        padding: 10px;
    }

    .product-image {
      max-width: 100%;
      height: auto;
      margin-bottom: 15px;
    }

    .product-title {
      font-size: 1.5em;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .product-description {
      margin-bottom: 15px;
    }

    .product-price {
      font-size: 1.2em;
      color: #007bff;
      margin-bottom: 10px;
    }
    /* .row {
        margin-top: 10px;
        display: flex;
        justify-content: space-between;
        width: 100%;
        flex-direction: row;
    } */
    .data {
        background-color: #f1f1f1;
        width: 95%;
        padding: 7px;
        text-align: left;
        height: 25px;
        margin: 1px;
        border-radius: 10px;
        font-size: 14px
    }
table{
    width: 100%
}
/* table tr td{
    width: 49%;
    background: #007bff;
    padding: 3px;
} */
    /* .col-6{
        flex: 0 0 48%;
    } */

.header h1{
    margin-bottom: 1px;
    padding-bottom: 0px;
}
.header p{
    margin-top: 0px;
}

/* table.vitalInfo thead{
margin-bottom: 0px;
}

.vitalInfo thead tr td{
    padding:2px;
} */

.vitalInfo tbody tr td span{
    font-size: 13px;
}
h3{
    margin-bottom: 4px;
}
.text-right{
    text-align:right;
    align-content: flex-end;
}

.items{
    width: 100%;
    border-collapse: collapse;
}

.items tr td {
    border: 1px solid #333;
    /* text-align: center; */
    padding: 3px;
}
.border-none{
    border:0px;
    border:none;
}

  </style>
</head>
<body>

  <div class="product-container">
    <div class="margin">
        <div class="header">
            <center>
                <h1>Auco Sewing Machines Nig. LTD</h1>
                <p class="mb-0">
                    <span><i>{{auth()->user()->business->motto}}</i></span><br>
                    <span>Address : {{auth()->user()->business->address}}</span><br>
                    <span>Contact : {{auth()->user()->business->phone1 .", " .auth()->user()->business->phone2}}</span><br>
                </p>
                <hr>
                <h2>Order Receipt</h2>
            </center>
        </div>
        {{-- order information --}}
        <table class="vitalInfo">
            <thead>
                <tr>
                    <td><h3>Customer Information</h3></td>
                    <td class="text-right"><h3>Order Information</h3></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span>Name : {{$order->client_name}}</span></td>
                    <td class="text-right"><span>Order #ID : {{$order->order_code}}</span></td>
                </tr>
                <tr>
                    <td><span>Phone : {{$order->client_phone}}</span></td>
                    <td class="text-right"><span>Order Status : {{$order->status}}</span></td>
                </tr>
                <tr>
                    <td><span>Address : {{$order->client_address}}</span></td>
                    <td class="text-right"><span>Payment Status : {{$order->payment_status}}</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="text-right"><span>Date : {{$order->created_at}}</span></td>
                </tr>
            </tbody>
        </table>
        <br>
        {{-- order cart items --}}
        <table class="items">
            <thead>
                <tr>
                    <td style="border: 0px; width:"><h3>Items Information</h3></td>
                </tr>
            </thead>
            <thead>
                <tr>
                    <td>S/N</td>
                    <td>Item</td>
                    <td>Quantity</td>
                    <td>Price</td>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody>
                @php($count = 1)
                @foreach($items as $item)
                    <tr>
                        <td width="2%">{{$count}}</td>
                        <td width="41%">{{$item->item_name}}</td>
                        <td width="10%">{{$item->quantity}}</td>
                        <td width="15%">N {{number_format($item->price)}}</td>
                        <td width="30%">N {{number_format($item->total)}}</td>
                    </tr>
                    @php($count++)
                @endforeach
                <tr class="text-end fw-bolder" style="border-top: 1px solid #333;">
                    <td colspan="4" class="text-right" style="border:none">Total Quantity :</td>
                    <td class="text-right"><span>{{number_format($order->quantity)}}</span></td>                    
                </tr>
                <tr>
                    <td colspan="4" class="text-right" style="border:none">Sub Total :</td>
                    <td class="text-right">N {{number_format($order->subtotal)}}</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right" style="border:none">Discount :</td>
                    <td class="text-right">N {{number_format($order->discount)}}</td>
                </tr>
                <tr class="text-end fw-bolder">
                    <td colspan="4" class="text-right" style="border:none">Total :</td>
                    <td class="text-right">N {{number_format($order->total)}}</td>
                </tr>
                <tr class="text-end fw-bolder">
                    <td colspan="4" class="text-right" style="border:none">Balance </td>
                    <td class="text-right">N {{number_format($order->balance)}}</td>
                </tr>
            </tbody>
        </table>
        <br>
        <table class="items">
            <thead>
                <tr>
                    <td style="border: 0px"><h3>Payments Information</h3></td>
                </tr>
            </thead>
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
                        <td class="">N {{number_format($transaction->amount)}}</td>
                        <td class="">{{$transaction->method}}</td>
                        <td class="">{{$transaction->status}}</td>
                        <td class="">{{$transaction->created_at}}</td>
                    </tr>
                    @php($count++)
                @endforeach
            </tbody>
        </table>
        {{-- <table>
            <tbody>
                <tr>
                    <td>
                        <div class="data">
                            <strong>Product ID:</strong> {{$product->code}}
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <strong>Brand:</strong> {{$product->brand}}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="data">
                            <strong>Category:</strong> {{$product->category}}
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <strong>Department:</strong> {{$product->department}}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="data">
                            <strong>Stock:</strong> {{$product->quantity}}
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <strong>Cost:</strong> {{"N". number_format($product->cost, 2, '.', ',')}}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="data">
                            <strong>Wholesale Price:</strong> {{"N". number_format($product->wholesalePrice, 2, '.', ',')}}
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <strong>Retail Price:</strong>  {{"N". number_format($product->retailPrice, 2, '.', ',')}}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="data">
                            <strong>Received Date :</strong> {{$product->receivedDate}}
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <strong>Sold Out Date : </strong> {{$product->soldoutDate}}
                        </div>
                    </td>
                </tr>

            </tbody>
        </table> --}}
    </div>
  </div>

</body>
</html>
