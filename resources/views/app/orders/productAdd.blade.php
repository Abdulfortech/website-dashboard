<!DOCTYPE html>
@extends('layout.appLayout')
@section('title', 'Place Order')
@php( $page = 'orders')
<!-- Include Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.1/dist/css/select2.min.css" rel="stylesheet">

@section('contents')
<style>
 

.image-preview {
    width: 150px;
    height: 150px;
    border: 2px solid #ddd;
    background-size: cover;
    background-position: center;
}
#productDropdown {
            height: 100px; /* Adjust the height as needed */
            overflow-y: auto;
            border: 1px solid #ced4da;
            border-radius: 4px;
            padding: 5px;
        }
    #productDropdown option {
            padding: 6px;
            border: 1px solid #f4f4f4;
            cursor: pointer;
            transition: background-color 0.3s;
            border-radius: 5px;
            margin-bottom: 2px;
        }

        #productDropdown option:hover {
            background-color: #e9ecef;
        }
</style>
<div class="min-height-300 bg-primary position-absolute w-100"></div>
    @include('components.sidebar')
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    @include('components.navbar')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="container">
            <h3 class="text-white text-center">Order Checkout</h3>
        </div>
      <div class="row">
        <div class="col-md-8">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h4 class="text-center">New Order #{{$code}}</h4>
            </div>
            <div class="card-body p-2">
                <form id="addOrder" enctype="multipart/form-data" action="{{route('orders.placeOrder')}}" method="POST">
                    @csrf
                    <input type="hidden" name="order_code" id="code" value="{{$code}}" >
                    <input type="hidden" name="order_type" id="order_type" value="Product">
                    <div class="row" id="existingClient">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Client Name</label>
                                <input class="form-control" name="client_name" id="addClientName" type="text" required>
                                @error('client_name')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Client Phone Number</label>
                                <input class="form-control" type="text" name="client_phone" id="addClientPhone" required>
                                @error('client_phone')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Client Address</label>
                                <input class="form-control" type="text" name="client_address" id="addClientAddress" required>
                                @error('client_address')
                                <span class="text-danger small">{{ $message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- department -->
                    <div class="col-md-12">
                        <label for="">Department</label>
                        <select class="form-control" name="department" id="department" required>
                            @if(auth()->user()->jurisdiction == "General")
                                <option value="">Choose Department</option>
                                @foreach($departments as $department)
                                    <option>{{$department->title}}</option>
                                @endforeach
                            @else
                            <option>{{auth()->user()->jurisdiction}}</option>
                            @endif
                        </select>
                        @error('department')
                            <span class="text-danger small">{{ $message}}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-12 mt-4">
                            <h5 class="float-start">Products</h5>
                        </div>
                    </div>
                    <div id="itemRows">
                        <table class="table datatable text-start text-sm" id="cartTable">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="body1">
                            </tbody>
                            <tbody>
                                <tr>
                                    <td colspan="5" class="text-end fw-bold">Quantity</td>
                                    <td class="text-end"><span id="finalquantity">0</span></td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-end fw-bold">Sub Total</td>
                                    <td class="text-end">&#8358; <span id="subtotal">0.00</span></td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-end fw-bold">Discount</td>
                                    <td class="text-end"><input type="number" class="form-control float-end" style="width: 120px" value="0" name="discount" id="discountAmountInput"></td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-end fw-bold">Total</td>
                                    <td class="text-end">&#8358; <span id="finaltotal">0.00</span></td>
                                </tr>
                            </tbody>
                        </table>
                        <input class="form-control" type="hidden" name="finalQuantity" id="quantityInput">
                        <input class="form-control" type="hidden" name="finalSubtotal" id="subtotalInput" >
                        <input class="form-control" type="hidden" name="finalTotal" id="totalInput">
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12 mt-4">
                            <h5 class="float-start">Payment Information</h5>
                        </div>
                        <div class="col-md-4">
                            <label for="">Amount Deposited(&#8358;)</label>
                            <input class="form-control" type="number" name="deposited_amount" id="deposited_amount" required>
                        </div>
                        <div class="col-md-4">
                            <label for="">Payment Balance(&#8358;)</label>
                            <input class="form-control" type="number" name="balance" id="balance" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="">Payment Method</label>
                            <select class="form-control" name="payment_method" id="payment_method"required>
                                <option value="">Choose Payment Method</option>
                                <option>Cash</option>
                                <option>Bank Transfer</option>                         
                                <option>Cash & Transfer</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Payment Status</label>
                            <select class="form-control" name="payment_status" id="payment_status"required>
                                <option value="">Choose Payment Status</option>
                                <option value="Paid">Paid</option>
                                <option value="Paid_portion">Paid Portion</option>
                                <option class="Unpaid">Unpaid</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Date</label>
                            <input class="form-control" type="date" name="sell_at" required>
                            @error('sell_at')
                                <span class="text-danger small">{{ $message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="">Date of Collection</label>
                            <input class="form-control" type="date" name="collected_at">
                        </div>
                    </div>
                    <center>
                        <button type="submit" class="btn btn-primary my-4" id="addProductButton">Submit</button>
                    </center>
                </form>
            </div>
          </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
              <div class="card-header pb-0">
                <h4 class="text-center">Add Product</h4>
              </div>
              <div class="card-body p-3">
                    <form id="addProductForm" >
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="">Product</label>
                                <select class="form-select form-control" id="single-select-field" name="product_id" data-placeholder="Choose Product">
                                    <option></option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="">Price(&#8358;)</label>
                                <input class="form-control" type="number" name="price" id="price" required>
                            </div>
                            <div class="col-md-12">
                                <label for="">Quantity</label>
                                <input class="form-control" type="number" name="quantity" id="quantity" min="1" value="1" placeholder="Quantity" required>
                            </div>
                            <div class="col-md-12">
                                <label for="">Total(&#8358;)</label>
                                <input class="form-control" type="number" name="total" id="total" oninput="formatCurrency(this)" readonly>
                            </div>
                        </div>
                        <input class="form-control" type="hidden" name="code" id="code" value="{{$code}}">
                        <input class="form-control" type="hidden" name="item_name" id="item_name" >
                        <input class="form-control" type="hidden" name="item_type" id="code" value="product">
                        <center>
                            <button type="submit" class="btn btn-primary" id="addProductButton">Add to Cart</button>
                        </center>
                    </form>
              </div>
            </div>
        </div>
      </div>
      @include('components.footer')
    </div>
  </main>
  {{-- modals --}}


  @push('script')
  <script>
        // Function to clients list
        function fetchClients() {
            $.ajax({
                url: '/clients/list',
                method: 'GET',
                success: function (response) {
                    const clientDropdown = $('#client-select');
                    clientDropdown.empty();

                    // Add an empty option
                    clientDropdown.append($('<option>').val('').text('Select a client'));

                    response.clients.forEach(client => {
                        const option = $('<option>').val(client.id).text(client.name +"---"+client.phone1);
                        clientDropdown.append(option);
                    });
                },
                error: function (error) {
                    console.error('Error searching for clients:', error);
                }
            });
        }
        // Function to fetch products list
        function searchProducts() {
            $.ajax({
                url: '/products/list',
                method: 'GET',
                success: function (response) {
                    renderProductList(response.products);
                },
                error: function (error) {
                    console.error('Error searching for products:', error);
                }
            });
        }
        // Function to render the product list
        function renderProductList(products) {
            const productDropdown = $('#single-select-field');
            productDropdown.empty();
            // Add an empty option
            productDropdown.append($('<option>').val('').text('Select a product'));
            products.forEach(product => {
                const option = $('<option>').val(product.id).text(product.title);
                productDropdown.append(option);
            });
            // Move the event listener outside the forEach loop
            productDropdown.change(function () {
                const selectedProductId = $(this).val();
                const selectedProduct = products.find(product => String(product.id) === selectedProductId[0]);
                if (selectedProduct) {
                    // console.log(selectedProduct.retailPrice);
                    var item_name = document.getElementById('item_name');
                    var quantity = document.getElementById('quantity').value;
                    var price = document.getElementById('price');
                    var total = document.getElementById('total');
                    // new price total and item_name
                    item_name.value = selectedProduct.title;
                    price.value = selectedProduct.retailPrice;
                    total.value = quantity * selectedProduct.retailPrice;
                }
            });
        }
        // Function to decrease quantity
        function decreaseQuantity(itemId) {
            $.ajax({
                url: "/orders/cart/decrease/" + itemId,
                method: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (response) {
                    // console.log(response);
                    fetchCartItems()
                    // You can update the UI to reflect the decreased quantity
                },
                error: function (error) {
                    console.error('Error decreasing quantity:', error);
                    // Handle error response here
                }
            });
        }
        // Function to increase quantity
        function increaseQuantity(itemId) {
            $.ajax({
                url: "/orders/cart/increase/" + itemId,
                method: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (response) {
                    // console.log(response);
                    fetchCartItems();
                    // You can update the UI to reflect the increased quantity
                },
                error: function (error) {
                    console.error('Error increasing quantity:', error);
                    // Handle error response here
                }
            });
        }
        // Function to delete item
        function deleteItem(itemId) {
            $.ajax({
                url: "/orders/cart/delete/" + itemId,
                method: 'DELETE',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (response) {
                    // console.log(response);
                    fetchCartItems();
                    // You can update the UI to reflect the item deletion
                },
                error: function (error) {
                    console.error('Error deleting item:', error);
                    // Handle error response here
                }
            });
        }
        // Function to fetch cart items
        function fetchCartItems() {
            const order_code = document.getElementById('code').value;
            console.log(order_code);
            $.ajax({
                url: "{{ route('orders.cartItems') }}", // Replace with your route for fetching cart items
                method: 'GET',
                data: { order_code: order_code }, // Replace 'your_order_code' with the actual order code
                success: function (response) {
                    // console.log(response);
                    // Update the table with the fetched cart items
                    renderCartItems(response);
                },
                error: function (error) {
                    console.error('Error fetching cart items:', error);
                    // Handle error response here
                }
            });
        }
        // Function to calculate subtotal, discount amount, and total
        function calculateTotals(cartItems) {
            var subtotal = cartItems.reduce((total, cartItem) => total + parseFloat(cartItem.total), 0);
            var finalquantity = cartItems.reduce((quantity, cartItem) => quantity + parseFloat(cartItem.quantity), 0);
            var discountAmount = parseInt($('#discountAmountInput').val() || 0);
            var total = subtotal - discountAmount;
            console.log(subtotal);
            // Update subtotal, discount, and total in the table
            $('#subtotal').text(formatNumber(subtotal));
            $('#subtotalInput').val(subtotal.toFixed(2));
            $('#finalquantity').text(formatNumber(finalquantity));
            $('#quantityInput').val(finalquantity);
            // $('#discountAmountInput').value(discountAmount.toFixed(2));
            $('#finaltotal').text(formatNumber(total));
            $('#totalInput').val(total.toFixed(2));
            $('#deposited_amount').val(total.toFixed(2));
            var deposit = parseInt($('#deposited_amount').val() || 0);
            var newBalance = total - deposit;
            $('#balance').val(newBalance.toFixed(2));
        }
        // Function to render cart items in the table
        function renderCartItems(cartItems) {
            // Clear existing table rows
            $('#cartTable #body1').empty();

            // Iterate through each cart item and append to the table
            $.each(cartItems, function (index, cartItem) {
                var row = $('<tr>');
                row.append($('<td>').text(index + 1)); // Counter
                row.append($('<td>').text(cartItem.item_name.substring(0, 20))); // Product Name
                row.append($('<td>').text(cartItem.quantity)); // Quantity
                row.append($('<td>').text(formatNumber(cartItem.price))); // Price
                row.append($('<td>').text(formatNumber(cartItem.total))); // Total
                row.append($('<td>').html(`<button class="btn btn-primary p-1" type="button" onclick="decreaseQuantity(${cartItem.id})"><i class="fa fa-minus"></i></button>
                                            <button class="btn btn-primary p-1" type="button" onclick="increaseQuantity(${cartItem.id})"><i class="fa fa-plus"></i></button>
                                            <button class="btn btn-danger p-1" type="button" onclick="deleteItem(${cartItem.id})"><i class="fa fa-trash"></i></button>`)); // Actions
                $('#cartTable #body1').append(row);
            });

            // Calculate subtotal, discount amount, and total
            calculateTotals(cartItems);
        }
        // calculate discount
        function calculateDiscount(){
            const subtotal = document.getElementById('subtotalInput');
            const discount = document.getElementById('discountAmountInput');
            const total = document.getElementById('totalInput');

            var newTotal = subtotal.value - discount.value;
            $('#finaltotal').text(formatNumber(newTotal));
            total.value = newTotal;
            const deposit = document.getElementById('deposited_amount');
            deposit.value = newTotal;
            var newBalance = total.value - deposit.value;
            document.getElementById('balance').value = newBalance.toFixed(2);
        }
        // calculate balance
        function calculateBalance(){
            const total = document.getElementById('totalInput');
            const deposit = document.getElementById('deposited_amount');
            const balance = document.getElementById('balance');

            var newBalance = total.value - deposit.value;
            $('#balance').val(newBalance.toFixed(2));
        }
        // format currency
        function formatCurrency(input) {
            // Get the input value without commas
            const inputValue = input.value.replace(/,/g, '');

            // Parse the value as a float
            const parsedValue = parseFloat(inputValue);

            // Check if the parsed value is a number
            if (!isNaN(parsedValue)) {
                // Format the value with commas and update the input
                input.value = parsedValue.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
            } else {
                // If the input is not a valid number, clear the input
                input.value = '';
            }
        }
        // format number
        function formatNumber(number) {
            return new Intl.NumberFormat().format(number);
        }

    $(document).ready(function () {
        // fetch clients
        fetchClients();
        // fetch all active products
        searchProducts();
        // Initial fetch of cart items when the page loads
        fetchCartItems();
        // add product to cart
        $('#addProductForm').submit(function (event) {
            // Prevent the form from submitting the traditional way
            event.preventDefault();
            // Serialize the form data
            var formData = $(this).serialize();
            // Perform Ajax request
            $.ajax({
                url: "{{ route('orders.cartAddProduct') }}",
                method: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: formData,
                success: function (response) {
                    // console.log(response);
                    // Handle success response here
                    $('#addProductForm')[0].reset();
                    fetchCartItems();
                    searchProducts();
                },
                error: function (error) {
                    console.error('Error adding product to cart:', error);
                    // Handle error response here
                }
            });
        });
       

        document.getElementById('discountAmountInput').addEventListener('input', () => { 
            calculateDiscount();
        });
        document.getElementById('deposited_amount').addEventListener('input', () => { 
            calculateBalance();
        });

        // change of quantity and price
        const quantity = document.getElementById('quantity');
        const price = document.getElementById('price');
        const total = document.getElementById('total');
        quantity.addEventListener('input', () => {
            total.value = quantity.value * price.value;
        });
        price.addEventListener('input', () => {
            total.value = quantity.value * price.value;
        });

        // Event listener for the product search input
        $('#productSearch').on('input', function () {
            const searchTerm = $(this).val().trim();
            searchProducts(searchTerm);
        });

        
    });
    $( '#single-select-field' ).select2( {
        theme: "bootstrap-5",
        // width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        placeholder: $( this ).data( 'placeholder' ),
    } ); 
    $( '#client-select' ).select2( {
        theme: "bootstrap-5",
        // width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        placeholder: $( this ).data( 'placeholder' ),
    });   
  </script>
  @endpush