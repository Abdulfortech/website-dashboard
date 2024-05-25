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
                <h3>Product Information</h3>
            </center>
        </div>
        <div class="product-title">{{$product->title}}</div>
        <div class="product-description">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in justo at libero placerat tincidunt.
        </div>
        <table>
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
        </table>
    </div>
  </div>

</body>
</html>
