<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ecommerce - Category </title>
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
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
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
                    <p>Web Developer</p>
                </div>
            </div>

            <ul class="list-unstyled">
                <li class="active"><a href="{{url('/admin/dashboard')}}"> <i class="icon-home"></i>Home </a></li>
                <li><a href="{{url('/categories')}}"> <i class="icon-grid"></i>Category</a></li>
                <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Products </a>
                    <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                        <li><a href="{{url('/viewproduct')}}">View Products</a></li>
                        <li><a href="{{url('/add_product')}}">Add Products</a></li>
                        <li><a href="{{url('/order_list')}}">Orders</a></li>
                    </ul>
                </li>
        </nav>
        <div class="page-content">

            <div class="heading">
                <h1>Add Category</h1>
                <form action="{{url('/categoriessubmit')}}" method="post">
                    @csrf

                    <div class="formpart">
                        <label for="">Category</label>
                        <input type="text" name="category">
                        <br><br>
                        <input class="btn btn-success" type="submit" value="Add category">
                    </div>
                </form>
            </div>
            <div class="tabledenotion">
                <table>
                    <tr>
                        <th>Category Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    @foreach ($categories as $category )

                    <tr>
                        <td>{{$category->category_name}}</td>
                        <td><a href="{{url('/edit_category',$category->id)}}" class="btn btn-success">Edit</a></td>
                        <td><a href="{{url('/delete_category',$category->id)}}" class="btn btn-danger">Delete</a></td>
                    </tr>
                    @endforeach
                </table>
                <div class="pagination">
                    {{ $categories->onEachSide(1)->links() }}
                </div>
            </div>






            <footer class="footer">
                <div class="footer__block block no-margin-bottom">
                    <div class="container-fluid text-center">

                        <p class="no-margin-botto text-white">2024 &copy; shop.co - All rights reserved.</p>
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