@php 
if(!empty(Session::get('locale'))) 
    {
        app()->setLocale(Session::get('locale'));
    }
            
    else{
         app()->setLocale('en');
    }
@endphp
@extends('admin.layouts.master')
@section('title','Contract Kampaner')
@section('content')
       <style>
         .card-header .icons .fa-cc-visa{
         color: #FFB85F;
         }
         .card-header .icons .fa-cc-discover{
         color: #027878;
         }
         .card-header .icons .fa-cc-amex{
         color: #EB4960;
         }
         .card-body label{
         font-size: 14px;
         }
      </style>
      <div class="container">
         <h2 class="text-center mt-4 mb-5">Select Payment Option </h2>
        
         <div id="smart-button-container mt-5">
            <div style="text-align: center;">
            <div id="paypal-button-container"></div>
            <input type="hidden" name="amount" id="amount"  value={{$plan->price}} class="form-control border-right-0"  placeholder="amount" readonly>
            <input type="hidden" name="amount" id="plan_name"  value={{$plan->name}} class="form-control border-right-0"  placeholder="amount" readonly>
            </div>
         </div>
  
      </div>
   @endsection
@section('stylesheets')
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
   <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('scripts')
   <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
   <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
   <script  type="text/javascript">
    let amount = $('#amount').val();
      let plan_name = $('#plan_name').val();
    function initPayPalButton() {
      paypal.Buttons({
        style: {
          shape: 'rect',
          color: 'gold',
          layout: 'vertical',
          label: 'paypal',
          
        },
       
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{"amount":{"currency_code":"USD","value":amount}}]
          });
        },

         onApprove: function(data, actions) {
            return actions.order.capture().then(function(orderData) {
                
                $.ajax({
                     url:'{{route("success.payment")}}',
                     type:"POST",
                     data:{
                     "_token": "{{ csrf_token() }}",
                     order:orderData,
                     plan_name:plan_name,
                     amount:amount,
                   
                     },
                     success:function(response){
                     $('#successMsg').show();
                     console.log(response);
                     },
               
                     });
                  
            // Full available details
            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

            // Show a success message within this page, e.g.
            const element = document.getElementById('paypal-button-container');
            element.innerHTML = '';
            element.innerHTML = '<h3>Thank you for your payment!</h3><a class="btn btn-primary" href= "{{route('admin.dashboard')}}">Dashboard</a>';

           
            
            });
        },

        onError: function(err) {
          console.log(err);
        }
      }).render('#paypal-button-container');
    }
    initPayPalButton();
   </script>
@endsection
