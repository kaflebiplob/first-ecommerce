<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ecommerce - Orders</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <link rel="stylesheet" href="/styles/admin.styles.css">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="/css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="/https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="/css/custom.css">


</head>

<body>
    <header class="header">
        <nav class="navbar navbar-expand-lg">

            <div class="container-fluid d-flex align-items-center justify-content-between">
                <div class="navbar-header">
                <a href="{{url('/admin/dashboard')}}" class="navbar-brand">
                        <div class="brand-text brand-big visible text-uppercase"><strong>Admin</strong></div>
                        <div class="brand-text brand-sm"><strong>A</strong></div>
                    </a>

                    <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>

            </div>
        </nav>
    </header>
    <div class="d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="sidebar-header d-flex align-items-center">
                <div class="avatar"><img src="/images/adminicon.jpg" alt="..." class="img-fluid rounded-circle"></div>
                <div class="title">
                    <h1 class="h5">Biplob kafle</h1>
                    <p>Web Developerr</p>
                </div>
            </div>

            <ul class="list-unstyled">
                <li class="active"><a href="{{url('/admin/dashboard')}}"> <i class="icon-home"></i>Home </a></li>
                <li><a href="{{url('/categories')}}"> <i class="icon-grid"></i>Category </a></li>
                <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Products </a>
                    <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                        <li><a href="{{url('/viewproduct')}}">View Products</a></li>
                        <li><a href="{{url('/add_product')}}">Add Products</a></li>
                        <li><a href="{{url('/order_list')}}">Orders</a></li>
                    </ul>
                </li>
        </nav>
        <div class="page-content">
           
            <div class="orders">
                <div class="orderlist">
                    <table class="ordertable">
                        <tr>
                            <th class="tablehead"> Username</th>
                            <th class="tablehead">Name</th>
                            <th class="tablehead">quantity</th>
                            <th class="tablehead">total Price</th>
                            <th class="tablehead">image</th>
                            <th class="tablehead">status</th>
                            <th class="tablehead">Action</th>

                        </tr>
                        @foreach ($orders as $order )
                        <tr>
                            <td class="tableheaddata">{{$order->name}}</td>
                            <td class="tableheaddata">{{$order->product->title}}</td>
                            <td class="tableheaddata">{{$order->quantity}}</td>
                            <td class="tableheaddata">{{$order->total_value}}</td>
                            <td class="tableheaddata"><img src="/products/{{$order->product->image}}" alt=""></td>
                            <td class="tableheaddata">{{$order->status}}</td>
                            <td class="tableheaddata">
                                <a href="{{url('/ontheway',$order->id)}}" class="btn btn-primary">On the way</a>
                                <a href="{{url('/delivered', $order->id)}}" class="btn btn-success">Delivered</a>
                            </td>

                        </tr>

                        @endforeach
                    </table>

                </div>
            </div>



            <footer class="footer">
                <div class="footer__block block no-margin-bottom">
                    <div class="container-fluid text-center">

                        <p class="no-margin-bottom text-white">2024 &copy; shop.co - All rights reserved.</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- JavaScript files-->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="/vendor/chart.js/Chart.min.js"></script>
    <script src="/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="/js/charts-home.js"></script>
    <script src="/js/front.js"></script>
</body>

</html>