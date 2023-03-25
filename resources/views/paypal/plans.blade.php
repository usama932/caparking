<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
      <title>Contract Kampaner</title>
      <style>
         .header {
         background:#00C9FF;
         }
         .bi {
         color:#00C9FF;
         }
         .price {
         color:white;
         font-size: 150px;
         font-weight: 800;
         padding-top:-80% !important;
         }
         /* The flip card container - set the width and height to whatever you want. We have added the border property to demonstrate that the flip itself goes out of the box on hover (remove perspective if you don't want the 3D effect */
         .flip-card {
         background-color: transparent;
         width: auto;
         height: auto;
         perspective: 1000px; /* Remove this if you don't want the 3D effect */
         }
         /* This container is needed to position the front and back side */
         .flip-card-inner {
         position: relative;
         width: 100%;
         height: 100%;
         text-align: center;
         transition: transform 0.8s;
         transform-style: preserve-3d;
         }
         /* Do an horizontal flip when you move the mouse over the flip box container */
         .flip-card:hover .flip-card-inner {
         transform: rotateY(180deg);
         }
         /* Position the front and back side */
         .flip-card-front, .flip-card-back {
         position: absolute;
         width: 100%;
         height: 100%;
         -webkit-backface-visibility: hidden; /* Safari */
         backface-visibility: hidden;
         }
         /* Style the front side (fallback if image is missing) */
         .flip-card-front {
         background-color: #00C9FF;
         color: white;
         height: auto;
         padding:50px 0px;
         }
         /* Style the back side */
         .flip-card-back {
         background-color: white;
         color: black;
         transform: rotateY(180deg);
         padding:50px 0px;
         }
      </style>
   </head>
   <body>
      <div class="container p-5">
        <h1 class="text-center">Select Your Plan</h1>
        <nav class="navbar navbar-light bg-light justify-content-between">
          <a class="navbar-brand ml-3">Contact Kampaner</a>
        
            <a href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById
               ('logout-form').submit();" class="btn btn-outline-success my-2 my-sm-0">Logout</a>
        
         
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
        </nav>
        <div class="col-md-12 bg-light text-right mt-5">
            
         @if(!empty($plans) )
         <div class="row">
            @if(!empty($plans['0']) )
            <div class="col-lg-4 col-md-12 mb-4">
               
                  <div class="flip-card-inner">
                     <div class="flip-card-front">
                        <span class="price">{{ $plans['0']['price']}}</span><br>/month 
                        <br>
                        <h2 class="card-title">{{ $plans['0']['name']}}</h2>
                        <a href= "{{route('make.payment',$plans['0']['id'])}}">
                        <button class="my-5 btn btn-outline-success btn-lg">Select</button>
                        </a>    
                     </div>
                     <div class="flip-card-back">
                        <ul class="list-group list-group-flush">
                           <li class="list-group-item">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                 <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                              </svg>
                              {{ $plans['0']['price']}}
                           </li>
                           <li class="list-group-item">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                 <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                              </svg>
                              {{ $plans['0']['name']}}
                           </li>
                        </ul>
                        <a href= "{{route('make.payment',$plans['0']['id'])}}">
                        <button class="my-5 btn btn-outline-success btn-lg">Select</button>
                        </a>
                     </div>
                  </div>
               
               @endif
            </div>
            @if(!empty($plans['1']) )
            <div class="col-lg-4 col-md-12 mb-4">
               <div class="h-100 flip-card">
                  <div class="flip-card-inner">
                     <div class="flip-card-front">
                        <span class="price">{{ $plans['1']['price']}}</span><br>/month 
                        <br>
                        <h2 class="card-title">{{ $plans['1']['name']}}</h2>
                        <a href= "{{route('make.payment',$plans['1']['id'])}}">
                        <button class="my-5 btn btn-outline-success btn-lg">Select</button>
                        </a>
                     </div>
                     <div class="flip-card-back">
                        <ul class="list-group list-group-flush">
                           <li class="list-group-item">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                 <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                              </svg>
                              {{ $plans['1']['price']}}
                           </li>
                           <li class="list-group-item">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                 <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                              </svg>
                              {{ $plans['1']['name']}}
                           </li>
                        </ul>
                        <a href= "{{route('make.payment',$plans['1']['id'])}}">
                        <button class="my-5 btn btn-outline-success btn-lg">Select</button>
                        </a>
                     </div>
                  </div>
               </div>
               @endif
            </div>
            @else
            <h1>No Plans Found
            </h1>
            @endif
         </div>
        </div>
      </div>
   </body>
   <!-- Option 1: Bootstrap Bundle with Popper -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
   </body>
</html>