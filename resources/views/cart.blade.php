<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/64cc13dfa7.js" crossorigin="anonymous"></script>
    <link href="/css/style.css" rel="StyleSheet">
    <link href="/css/tailwind.css" rel="stylesheet">
</head>
<body class="dark dark:bg-gray-700 dark:text-white bg-gray-100">

    

<nav class="top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3 navbar sm:w-24">
          <div class="flex items-center justify-between ">
            <div class="flex items-center justify-start ">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                       <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                    </svg>
                 </button>
              <a href="/" class="flex ml-2 md:mr-24">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 mr-3" alt="FlowBite Logo" />
                <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">E-Market</span>
              </a>
            </div>
            <div class="flex items-center justify-end" style="width:0%;">
            <form class="sm:pr-5" action="{{route('search')}}" method="get">
                <label for="products-search" class="sr-only">Search</label>
                <div class="hidden md:w-64 md:block mt-1 sm:w-24 xl:w-96 xl:block">
                    <input type="text" name="search" id="products-search" class="text-center h-9 bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-full focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search For Products">
                </div>
           
            </form>
        </div>
        @if(Auth::check())
            <div class="flex items-center">
                <div class="flex items-center ml-3">
                  <div>
                    <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                      <span class="sr-only">Open user menu</span>
                      <img class="w-8 h-8 rounded-full" src="/images/{{Auth::user()->image}}" alt="user photo">
                    </button>
                  </div>
                  <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
                    <div class="px-4 py-3" role="none">
                      <p class="text-sm text-gray-900 dark:text-white" role="none">
                      {{Auth::user()->firstname .' '.Auth::user()->lastname}}
                      </p>
                      <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                      {{Auth::user()->email}}
                      </p>
                    </div>
                    <ul class="py-1" role="none">
                      @if(Auth::user()->role==1)
                      <li>
                        <a href="{{route('admin.dashboard')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Dashboard</a>
                      </li>
                      @endif
                      <li>
                        <a href="{{route('cart.index')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Cart</a>
                      </li>
                      <li>
                        <a href="{{route('user.profile')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Profile</a>
                      </li>
                      <li>
                        <a id="togglemode" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer">Switch Mode</a>
                      </li>
                      <li>
                      <form method="POST" class="text-white" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              @else
              <div class="flex items-center ml-3">
                <a href="/login" class="text-sm font-medium text-gray-900 truncate dark:text-gray-300">Login</a>
              </div>
              @endif
          </div>
        </div>    <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-full h-auto pt-4 transition-transform bg-white border-r border-gray-200  dark:bg-gray-800 dark:border-gray-700 -translate-x-full" aria-label="Sidebar">
        
        <div class="flex items-center justify-center m-4">
        <form class="sm:pr-5" action="{{route('search')}}" method="get">
                <label for="products-search" class="sr-only">Search</label>
                <div class="md:w-64 md:block mt-1 sm:w-24 xl:w-96 xl:block">
                    <input type="text" name="search" id="products-search" class="text-center bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-full focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search For Products">
                </div>
            </form>
        </div>

     </aside>
</nav>


        <section class="h-auto bg-gray-100 py-0 sm:py-16 lg:py-10">
          
<div class="mx-auto px-4 sm:px-6 lg:px-8">
@if($errors->any())
<div class="w-1/4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 my-2 rounded relative" role="alert" style="width:40%;margin:5px auto;">
  <strong class="font-bold">{{$errors->first()}}!</strong>
  <span class="block sm:inline">Something seriously bad happened.</span>
  <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
  </span>
</div>
@endif
<div class="flex items-center justify-center">
  
<h1 class="text-2xl font-semibold text-gray-900">Your Cart</h1>
</div>

<div class="mx-auto mt-8 max-w-2xl md:mt-12">
<div class="bg-white shadow">
<div class="px-4 py-6 sm:px-8 sm:py-10">
<div class="flow-root">
<ul class="-my-8">
@foreach($cart as $cartitem)
<!--Product-->
<li class="flex flex-col space-y-3 py-6 text-left sm:flex-row sm:space-x-5 sm:space-y-0">
    <div class="shrink-0">
      <img class="h-24 w-24 max-w-full rounded-lg object-cover" src="/images/{{$cartitem->product->image}}" alt="">
    </div>

    <div class="relative flex flex-1 flex-col justify-between">
      <div class="sm:col-gap-5 sm:grid sm:grid-cols-2">
        <div class="pr-8 sm:pr-5">
          <p class="text-base font-semibold text-gray-900">{{$cartitem->product->name}}</p>
          <p class="mx-0 mt-1 mb-0 text-sm text-gray-400">{{$cartitem->product->category->name}}</p>
        </div>

        <div class="mt-4 flex items-end justify-between sm:mt-0 sm:items-start sm:justify-end">
          <p class="shrink-0 w-20 text-base font-semibold text-gray-900 sm:order-2 sm:ml-8 sm:text-right">${{$cartitem->product->price}}</p>

          <div class="sm:order-1">
            <div class="mx-auto flex h-8 items-stretch text-gray-600">
            <form method="POST" action="{{route('cart.lessfromcart',$cartitem->product->id)}}">
                @method('PATCH')
                @csrf
                <button class="flex h-full items-center justify-center rounded-l-md bg-gray-200 px-4 transition hover:bg-black hover:text-white">-</button>
              </form>
              
              <div class="flex w-full items-center justify-center bg-gray-100 px-4 text-xs uppercase transition">{{$cartitem->quantity}}</div>
              <form method="POST" action="{{route('cart.addmore',$cartitem->product->id)}}">
                @method('PATCH')
                @csrf
                <button class="flex h-full items-center justify-center rounded-r-md bg-gray-200 px-4 transition hover:bg-black hover:text-white">+</button>
              </form>
              
            </div>
          </div>
        </div>
      </div>

      <div class="absolute top-0 right-0 flex sm:bottom-0 sm:top-auto">
      <form method="POST" action="{{route('cart.destroy',$cartitem->product_id)}}">
        @csrf
        @method('DELETE')
        <button type="submit" class="flex rounded p-2 text-center text-gray-500 transition-all duration-200 ease-in-out focus:shadow hover:text-gray-900">
          <svg class="block h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" class=""></path>
          </svg>
        </button>
      </form>
      </div>
    </div>
  </li>
<!--product-->
@endforeach
</ul>
</div>

<div class="mt-6 border-t border-b py-2">
<div class="flex items-center justify-between">
  <p class="text-sm text-gray-400">Subtotal</p>
  <p class="text-lg font-semibold text-gray-900">$@php $sum=0; foreach($cart as $item){$sum += $item->product->price * $item->quantity;}echo $sum;@endphp</p>
</div>
<div class="flex items-center justify-between">
  <p class="text-sm text-gray-400">Shipping</p>
  <p class="text-lg font-semibold text-gray-900">Free</p>
</div>
</div>
<div class="mt-6 flex items-center justify-between">
<p class="text-sm font-medium text-gray-900">Total</p>
<p class="text-2xl font-semibold text-gray-900"><span class="text-xs font-normal text-gray-400">USD</span> {{$sum}}</p>
</div>

<div class="mt-6 text-center">
  <a href="{{route('user.checkout')}}">
<button type="button" class="group inline-flex w-full items-center justify-center rounded-md bg-gray-900 px-6 py-4 text-lg font-semibold text-white transition-all duration-200 ease-in-out focus:shadow hover:bg-gray-800">
  Proceed To Checkout
  <svg xmlns="http://www.w3.org/2000/svg" class="group-hover:ml-8 ml-4 h-6 w-6 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
  </svg>
</button>
</a>
</div>
</div>
</div>
</div>
</div>
</section>


      


</body>
<!-- <script src="https://unpkg.com/tailwindcss-jit-cdn"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
<script src="/script/script.js"></script>
</html>