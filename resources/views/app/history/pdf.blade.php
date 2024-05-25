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
    .data2 {
        background-color: #f1f1f1;
        width: 98%;
        padding: 7px;
        padding-top: 10px;
        text-align: left;
        height: 24px;
        margin: 1px;
        border-radius: 10px;
        font-size: 14px
    }
table{
    width: 100%
}
table tr td{
    width: 49%;
    /* background: #007bff; */
    padding: 3px;
}
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
                <h3>Inventory History</h3>
            </center>
        </div>
        <table>
            <tbody>
                <tr>
                    <td>
                        <div class="data">
                            <strong>Type:</strong> {{$history->type}}
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <strong>Date:</strong> {{$history->date}}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <table>
            <tbody>
                <tr>
                    <td>
                        <div class="data2">
                            <strong>Product:</strong> {{$history->product->title}}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <table>
            <tbody>
                <tr>
                    <td>
                        <div class="data2">
                            <strong>Department:</strong> {{$history->department}}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <table>
            <tbody>
                <tr>
                    <td>
                        <div class="data">
                            <strong>Quantity:</strong> {{$history->quantity}}
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <strong>Amount:</strong> {{"N". number_format($history->amount, 2, '.', ',')}}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr>
        <table>
            <tbody>
                <tr>
                    <td>
                        <div class="data">
                            <strong>Status:</strong> {{$history->status}}
                        </div>
                    </td>
                    <td>
                        <div class="data2">
                            <strong>Added On :</strong>  {{$history->created_at}}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <table>
            <tbody>
                <tr>
                    <td>
                        <div class="data">
                            <strong>Added By :</strong> {{isset($history->added_by)?$history->user->username:'unknown'}}
                        </div>
                    </td>
                </tr>
                <tr><hr></tr>
                @if($history->status == 'Canceled')
                <tr>
                    <td>
                        <div class="data1">
                            <strong>Reason for Cancelling :</strong> {{$history->cancel_reason}}
                        </div>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>

    </div>
  </div>

</body>
</html>
