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
         <div class="row">
            <div class="col-md-4 offset-md-4 col-10 offset-1 pl-0 pr-0">
               <div class="card">
                  <div class="card-header">
                     <div class="row">
                        <div class="col-md-5 col-12 pt-2">
                           <h6 class="m-0"><strong>Payment Details</strong></h6>
                        </div>
                        <div class="col-md-7 col-12 icons">
                           <i class="fa fa-cc-visa fa-2x" aria-hidden="true"></i>
                           <i class="fa fa-cc-mastercard fa-2x" aria-hidden="true"></i>
                           <i class="fa fa-cc-discover fa-2x" aria-hidden="true"></i>
                           <i class="fa fa-cc-amex fa-2x" aria-hidden="true"></i>
                        </div>
                     </div>
                  </div>
                  <div class= "card-body">
                     <form action="{{route('success.payment')}}" method="post">
                        @csrf
                        <input name="plan_id" value="{{$plan->plan_id}}" type="hidden">
                        <input name="user_id" value="{{auth()->user()->id}}" type="hidden">
                           <div class="form-group">
                           <label for="validationTooltipCardNumber"><strong>CARD NAME</strong></label>
                           <div class="input-group">
                              <input type="text" class="form-control border-right-0" name="card_name" value="visa" id="" placeholder="Card Name">
                              <div class="input-group-prepend">
                                 <span class="input-group-text rounded-right" id=""><i class="fa fa-credit-name"></i></span>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="validationTooltipCardNumber"><strong>CARD NUMBER</strong></label>
                           <div class="input-group">
                              <input type="text" class="form-control border-right-0"  name="card_number" value="4915805038587737" id="validationTooltipCardNumber" placeholder="Card Number">
                              <div class="input-group-prepend">
                                 <span class="input-group-text rounded-right"  id="validationTooltipCardNumber"><i class="fa fa-credit-card"></i></span>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-4 col-6">
                              <div class="form-group">
                                 <label for="exampleInputExpirationDate"><strong>Ex Month</strong></label>
                                 <input type="text" class="form-control" name="card_month"  id="exampleInputExpirationDate" placeholder="MM">
                              </div>
                           </div>
                            <div class="col-md-4 col-6">
                              <div class="form-group">
                                 <label for="exampleInputExpirationDate"><strong>Ex Year</strong></label>
                                 <input type="text" class="form-control" name="card_year"  id="exampleInputExpirationDate" placeholder="YYYY">
                              </div>
                           </div>
                           <div class="col-md-4 col-12">
                              <div class="form-group">
                                 <label for="exampleInputCvcCode"><strong>CVC CODE</strong></label>
                                 <input type="text" class="form-control" name="card_cvc" id="exampleInputCvcCode" placeholder="CVC">
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="validationTooltipCardNumber"><strong>Total Amount</strong></label>
                           <div class="input-group">
                              <input type="number" name="amount"  value={{$plan->price}} class="form-control border-right-0"  placeholder="amount" readonly>
                              <div class="input-group-prepend">
                                 <span class="input-group-text rounded-right" id="amount"><i class="fa fa amount"></i></span>
                              </div>
                           </div>
                        </div>
                     
                        <button class="btn btn-info w-100 pb-2 pt-2">Start Subscription ${{$plan->price}}</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>