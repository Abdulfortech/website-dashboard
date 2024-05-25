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
      width: 1000px;
      margin: auto;
      /* padding: 10px; */
      border: 1px solid #ddd;
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
    width: 100%;
    border-collapse: collapse;
}
    /* .col-6{
        flex: 0 0 48%;
    } */

th, td {
        border: 1px solid #333;
        text-align: left;
        padding: 8px;
}

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
                <h3>List of Employees({{$allEmployees}})</h3>
            </center>
        </div>
        <table>
            <thead>
                <tr>
                  <th class="">S/N</th>
                  <th class="">Name</th>
                  <th class="">#ID</th>
                  <th class="">Department</th>
                  <th class="">Role</th>
                  <th class="">Phone Number</th>
                  <th class="">Status</th>
                </tr>
              </thead>
            <tbody>
                @php($count = 1)
                @foreach($employees as $employee)
                <tr>
                    <td>{{$count}}</td>
                    <td>{{$employee->firstName ." ".$employee->middleName ." ". $employee->lastName}}</td>
                    <td>{{$employee->employeeID}}</td>
                    <td>{{$employee->department}}</td>
                    <td>{{$employee->role}}</td>
                    <td>{{$employee->phone1}}</td>
                    <td>{{$employee->status}}</td>
                </tr>
                @php($count++)
                @endforeach
            </tbody>
        </table>
    </div>
  </div>

</body>
</html>
