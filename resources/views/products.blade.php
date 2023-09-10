<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Searching For Product</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/64cc13dfa7.js" crossorigin="anonymous"></script>
    <link href="/css/style.css" rel="StyleSheet">
</head>
<body class="dark dark:bg-gray-700 dark:text-white">

    

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


<div class="similar-products">
    <div class="similar-products-title">
      @if($req??null && $req!=null)
      <h3>Searching For : {{$req}}</h3>
      @else
      <h3>Products</h3>
      @endif
    </div>
    <div class="similar-products-cont" style="justify-content:flex-start;">
     
      @if($products->count()>0)
      @foreach($products as $product)
  <!--product-->
  <div class="similar-products-product shadow-lg">
 
    <a href="/products/{{$product->id}}">
    <div class="similar-products-product-img" style="background-image: url('/images/{{$product->image}}');background-position: center; background-repeat: no-repeat; background-size: cover;">
    @if($product->onsale)
    <div class="onsale-badge"><p>On Sale</p></div>
    @endif
    </div>
    </a>
    <div class="similar-products-product-info">
      <h4>{{$product->name}}</h4>
      <p>${{$product->price}}</p>
    </div>
    <div class="addtocart-product flex justify-between">
      <form method="" action="" class="addtocart mx-2">
        <button class="py-2 px-4 bg-gray-900 text-white rounded-lg text-sm hover:bg-gray-700 transition delay-100">Add To Cart</button>
    </form>
    <form method="" action="" class="wishlist mx-2">
        <button class="py-2 px-3 bg-gray-900 text-white rounded-full text-sm hover:bg-gray-700 transition delay-100"><i class="fa-solid fa-heart" style="color: #ffffff;"></i></button>
    </form>
    </div>
  </div>
  <!--product-->
  @endforeach
  {{$products->links()}}
  @else
  <h4>Sorry There Is No Products</h4>
  @endif
 
    </div>
  </div>

</body>
<!-- <script src="https://unpkg.com/tailwindcss-jit-cdn"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
<script src="/script/script.js"></script>
</html>