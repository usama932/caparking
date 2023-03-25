<!doctype html>
<html lang="en">
   <head>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
   </head>
   <body class="bg-danger pt-5">
      
      <div class="container">
         <h1 class="text-center">Select Payment Option </h1>
         <nav class="navbar navbar-light bg-light justify-content-between mb-5">
            <a class="navbar-brand ml-3">Contact Kampaner</a>
        
            <a href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById
               ('logout-form').submit();" class="btn btn-outline-success my-2 my-sm-0">Logout</a>
        
         
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
               @csrf
            </form>
         </nav>
         <div id="smart-button-container mt-5">
            <div style="text-align: center;">
            <div id="paypal-button-container"></div>
            <input type="hidden" name="amount" id="amount"  value={{$plan->price}} class="form-control border-right-0"  placeholder="amount" readonly>
            </div>
         </div>
  
      </div>
      <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
  <script>

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
            purchase_units: [{"amount":{"currency_code":"USD","value":1}}]
          });
        },

         onApprove: function(data, actions) {
            return actions.order.capture().then(function(orderData) {
            dd(orderData);
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
   </body>
</html>