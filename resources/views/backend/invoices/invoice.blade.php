<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>invoice</title>
    
    <style>
     .container{
  width: 750px;
  margin:auto;
  padding:50px;
}
img{
    width: 100%;
}
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

   <div class="container">
     <div class="row border p-2">
       <div class="col-sm-2">
         <img src="{{asset($image->file_name)}}" alt="" >
       </div>
       <div class="col-sm-10">
         <h6>SKU:-{{$orderDetail->product->name}}</h6>
         <!-- <h6>SIze:10-11 Year</h6> -->
          <h6>Quantity:{{$orderDetail->quantity}}</h6>
          <p>order Number:-{{$order->id}}</p>
       </div>
     </div>
     <div class="row p-3">
      <div class="bill col-sm-6">
        @php
            $shipping_address = json_decode($order->shipping_address);
        @endphp
        <p>Bill to:</p>
        <p>{{ $shipping_address->name }}</p>
        <p>{{ $shipping_address->address }}, {{ $shipping_address->city }}, {{ $shipping_address->postal_code }}, {{ $shipping_address->country }}</p>
        <p>{{ translate('Email') }}: {{ $shipping_address->email }}</p>
        <p>{{ translate('phone') }}: {{ $shipping_address->phone }}</p>
      </div>
      <div class="col-sm-6">
        <div class="float-end">
          <h4>TAX INVOICE</h4>
        Original For Recipient
        </div>
      </div>
     </div>
     <div class="row">
       <div class="col-sm-6">
      
       </div>
       <div class="col-sm-3">
        <!-- <p>Invoice Number</p>
        <h6>dg2rj239</h6> -->
       </div>
       <div class="col-sm-3">
        <p>Purchase Order Number</p>
        <h6>{{$order->id}}</h6>
       </div>
     </div>
     <div class="row">
       <div class="col-sm-6">
        <p>SHIP TO</p>
        <p>{{$shipping_address->name}}</p>
        {{$shipping_address->address}}
       </div>
       <div class="col-sm-3">
        <!-- <p> invoice Date:</p>
         <h6>{{$order->created_at}}</h6> -->
       </div>
       <div class="col-sm-3">
         <p>Order Date</p>
         <h6>{{$order->created_at}}</h6>
       </div>
     </div>
     <table class="table">
      <thead>
        <tr>
          <th scope="col">Description</th>
          <th scope="col">HSN</th>
          <th scope="col">Unit price</th>
          <th scope="col">QTY</th>
          <!-- <th scope="col">Discount</th> -->
          <!-- <th scope="col">Product Value</th> -->
          <th scope="col">Taxes</th>
          <th scope="col">Total</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">{{$orderDetail->product->name}}</th>
          @php 
            $hsn = App\Models\Hsn::where('category_id',$orderDetail->product->category_id)->first();
          @endphp
          <td>{{$hsn->name}}</td>
          <td>{{$orderDetail->product->unit_price}}</td>
          <td>{{$orderDetail->quantity}}</td>
          <td>{{ single_price($orderDetail->tax/$orderDetail->quantity) }}</td>
          <td>{{ single_price($orderDetail->price+$orderDetail->tax) }}</td>
        </tr>
        <!-- <tr>
          <th scope="row">2</th>
          <td>Jacob</td>
          <td>Thornton</td>
          <td>@fat</td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td colspan="2">Larry the Bird</td>
          <td>@twitter</td>
        </tr> -->
      </tbody>
    </table>
   </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>