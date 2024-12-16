<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce - Bill</title>
    <link rel="stylesheet" href="/styles/productdetails.css">

</head>
<style>
    .orderform {
        max-width: 400px;
        margin: 20px auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* background-color: #f9f9f9; */
    }

    .orderform h2 {
        text-align: center;
        color: #333;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .orderform label {
        display: block;
        margin-bottom: 5px;
        color: #555;
        font-weight: bold;
    }

    .orderform input[type="text"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 16px;
    }

    .orderform input[type="text"]:focus {
        border-color: #007bff;
        outline: none;
    }

    .orderform button {
        display: block;
        width: 100%;
        padding: 10px;
        font-size: 16px;
        color: #fff;
        background-color: #007bff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .orderform button:hover {
        background-color: #0056b3;
    }
</style>

<body>
    <section class="HOME">
        <div class="heading">
            <p>Subscribe To Gandu Here</p>
        </div>

        <div class="Navigationbar ">

            <div class="navagtion-conatiner">
                <div class="image-wrapper">
                    <a href="{{url('/')}}"> <img src="/images/logo.png" alt=""></a>
                </div>
                <div class="column-sepreate"></div>
                <nav>
                    <ul>
                        <li><a href="">subscribe</a></li>
                        <li><a href="">Magazine</a></li>
                        <li><a href="">Store locater</a></li>
                    </ul>
                </nav>


                @auth
                <div class="login">
                    <a href="{{route('order')}}">
                        <p style="font-size: 24px;">orders</p>
                    </a>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" onclick="event.preventDefault(); this.closest('form').submit();" class="logoutbutton">
                        {{ __('Log Out') }}
                    </button>
                </form>
                <div class="column-colour"></div>
                <div class="cart-wrapper">
                    <a href="{{url('/carts')}}"> <svg id="cart" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368">
                            <path d="M280-80q-33 0-56.5-23.5T200-160q0-33 23.5-56.5T280-240q33 0 56.5 23.5T360-160q0 33-23.5 56.5T280-80Zm400 0q-33 0-56.5-23.5T600-160q0-33 23.5-56.5T680-240q33 0 56.5 23.5T760-160q0 33-23.5 56.5T680-80ZM246-720l96 200h280l110-200H246Zm-38-80h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68-39.5t-2-78.5l54-98-144-304H40v-80h130l38 80Zm134 280h280-280Z" />
                        </svg>
                    </a>
                    <p id="cart">{{$cartCount}}</p>
                </div>

                @else

                <div class="login">
                    <a href="{{route('login')}}">
                        <p>Log in</p>
                    </a>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368">
                        <path d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm246-164q-59 0-99.5-40.5T340-580q0-59 40.5-99.5T480-720q59 0 99.5 40.5T620-580q0 59-40.5 99.5T480-440Zm0 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q53 0 100-15.5t86-44.5q-39-29-86-44.5T480-280q-53 0-100 15.5T294-220q39 29 86 44.5T480-160Zm0-360q26 0 43-17t17-43q0-26-17-43t-43-17q-26 0-43 17t-17 43q0 26 17 43t43 17Zm0-60Zm0 360Z" />
                    </svg>
                </div>
                <div class="login">
                    <a href="{{route('register')}}">
                        <p>register</p>
                    </a>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368">
                        <path d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm246-164q-59 0-99.5-40.5T340-580q0-59 40.5-99.5T480-720q59 0 99.5 40.5T620-580q0 59-40.5 99.5T480-440Zm0 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q53 0 100-15.5t86-44.5q-39-29-86-44.5T480-280q-53 0-100 15.5T294-220q39 29 86 44.5T480-160Zm0-360q26 0 43-17t17-43q0-26-17-43t-43-17q-26 0-43 17t-17 43q0 26 17 43t43 17Zm0-60Zm0 360Z" />
                    </svg>
                </div>

                @endauth
            </div>
        </div>

        <div class="carts">

              <table class="carttable">
                <tr class="tablehead">

                    <th class="tabletitle">Product Name</th>
                    <th class="tabletitle">Price</th>
                    <th class="tabletitle">Image</th>
                    <th class="tabletitle">Quantity</th>
                </tr>
                <?php
                $value = 0;
                $totalValue = 0;
                ?>
                @foreach ($carts as $cart )

                <tr class="tabledatahead">
                    <td class="tabledata">{{$cart->product->title}}</td>
                    <td class="tabledata">{{$cart->product->price}}</td>
                    <td class="tabledata"><img src="/products/{{$cart->product->image}}" width="150" alt=""></td>
                    <td class="tabledata">{{$cart->quantity}}</td>

                </tr>
                <?php
                $value += $cart->product->price * $cart->quantity;
                $totalValue = $value + 150;
                ?>
                @endforeach
            </table>

            <div class="orderform">
                <h2> your details.</h2>
                <form action="{{ route('confirmorder') }}" method="POST">
                    @csrf
                    <label for="name">Name:</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}" required>

                    <label for="address">Address:</label>
                    <input type="text" name="address" value="{{Auth::user()->address }}" required>

                    <label for="phone">Number:</label>
                    <input type="text" name="phone" value="{{ Auth::user()->phone }}" required>


                    <button type="submit" class="placeorderbtn">Place order</button>
                </form>

            </div>

            <div class="price">
                <h3 class="showprice">Total price of the cart is: Rs {{$value}}. </h3>
                <h4 class="showprice">Delivery charge inside valley: Rs 150.</h4>
                <h4 class="showprice">Total price: {{$totalValue}}
                </h4>
            </div>

        </div>


    </section>
    <section class="footer">
        <div class="footerpart">
            <div class="logo">
                <a href="{{url('/')}}"> <img src="/images/logo.png" alt=""></a>

            </div>
            <div class="links">
                <ul class="navlinks">
                    <li><a href="">Magazine</a></li>
                    <li><a href="">Store Locator</a></li>
                    <li><a href="">Help</a></li>
                </ul>
            </div>

        </div>
        <div class="copyright">
            Ecommerce &copy; Copyright 2024, Made By Biplob.
        </div>
    </section>

</body>

</html>