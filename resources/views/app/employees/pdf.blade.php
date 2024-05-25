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
        padding-top: 10px;
        text-align: left;
        height: 24px;
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
/* table tr td{
    width: 49%;
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
h5{
    margin-bottom: 8px;
    margin-top: 8px;
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
                <h3>Employee Information</h3>
            </center>
        </div>
        <h5><b>Personal Information</b></h5>
        <table>
            <tbody>
                <tr>
                    <td colspan="3">
                        <div class="data2">
                            <strong>Name : </strong> {{$employee->firstName." ".$employee->middleName." ".$employee->lastName}}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="data">
                            <strong>Date of Birth:</strong> {{$employee->dob}}
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <strong>Gender:</strong> {{$employee->gender}}
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <strong>Martital Status:</strong> {{$employee->maritalStatus}}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <h5><b>Contact Details</b></h5>
        <table>
            <tbody>
                <tr>
                    <td colspan="1.5">
                        <div class="data">
                            <strong>Phone Number 1:</strong> {{$employee->phone1}}
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <strong>Phone Number 2:</strong> {{$employee->phone2}}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="1.5">
                        <div class="data">
                            <strong>State:</strong> {{$employee->state}}
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <strong>Local Goverment:</strong> {{$employee->lga}}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="data2">
                            <strong>Address:</strong> {{$employee->address}}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <h5><b>Identity Details</b></h5>
        <table>
            <tbody>
                <tr>
                    <td colspan="">
                        <div class="data">
                            <strong>Identity Type:</strong> {{$employee->idType}}
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <strong>Identity Number:</strong> {{$employee->idNumber}}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <h5><b>Guarantor Details</b></h5>
        <table>
            <tbody>
                <tr>
                    <td>
                        <div class="data">
                            <strong>Name:</strong> {{$employee->guarantorName}}
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <strong>Relation:</strong> {{$employee->guarantorRelation}}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="1.5">
                        <div class="data">
                            <strong>Phone Number 1:</strong> {{$employee->guarantorPhone1}}
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <strong>Phone Number 2:</strong> {{$employee->guarantorPhone2}}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="data2">
                            <strong>Address:</strong> {{$employee->guarantorAddress}}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <h5><b>Employment Details</b></h5>
        <table>
            <tbody>
                <tr>
                    <td>
                        <div class="data">
                            <strong>Employee #ID:</strong> {{$employee->employeeID}}
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <strong>Employment Date:</strong> {{$employee->employmentDate}}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="1.5">
                        <div class="data">
                            <strong>Department:</strong> {{$employee->department}}
                        </div>
                    </td>
                    <td>
                        <div class="data">
                            <strong>Role:</strong> {{$employee->role}}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
  </div>

</body>
</html>
