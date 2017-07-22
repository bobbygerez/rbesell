<!DOCTYPE html>
<html lang='en' xmlns='http://www.w3.org/1999/xhtml'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Juan Merkado</title>
    <link rel='stylesheet' href="{{ asset('template3/assets/css/template3.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i;Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
</head>
<body>
    <header class="header header-style2">
        <div class="header-mid">
            <div class="container">
                <div class="header-mid-left">
                    <p class="wellcome-to">Wellcome to Super Market</p>
                    <p class="register-or-login">
                        <a href="{{ url('register') }}" class="register">Register</a>
                        or
                        <a href="{{ url('login') }}" class="login">Login</a>
                    </p>
                </div>
                <div class="header-mid-right">
                    <div class="header-mid-right-content">
                        <a href="#">
                            <i class="flaticon-user-outline"></i>
                            My Account
                        </a>
                    </div>
                    <div class="header-mid-right-content">
                        <a href="#">
                            <i class="flaticon-like"></i>
                            My Wishlist
                        </a>
                    </div>
                    <div class="header-mid-right-content">
                        <a href="#">
                            <i class="flaticon-check-square"></i>
                            Check Out
                        </a>
                    </div>
                    <div class="header-mid-right-content country-select-menu">
                        <div class="country-select">
                            <div class="country select">
                                <img src="{{ asset('template3/assets/images/flag.jpg') }}" alt="flag" width="24" height="17">
                                English
                            </div>
                            <div class="country-dropdown">
                                <div class="country">
                                    <img src="{{ asset('template3/assets/images/flag2.jpg') }}" alt="flag" width="24" height="17">
                                    Hungary
                                </div>
                                <div class="country">
                                    <img src="{{ asset('template3/assets/images/flag3.jpg') }}" alt="flag" width="24" height="17">
                                    German
                                </div>
                                <div class="country">
                                    <img src="{{ asset('template3/assets/images/flag4.jpg')}}" alt="flag" width="24" height="17">
                                    French
                                </div>
                                <div class="country">
                                    <img src="{{ asset('template3/assets/images/flag5.jpg') }} " alt="flag" width="24" height="17">
                                    Canada
                                </div>
                                <div class="country">
                                    <img src="{{ asset('template3/assets/images/flag6.jpg') }}" alt="flag" width="24" height="17">
                                    Australia
                                </div>
                            </div>
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </div>

                    </div>
                    <div class="header-mid-right-content money-select-menu">
                        <div class="money-select">
                            <div class="money select">
                                USD
                            </div>
                            <div class="money-dropdown">
                                <div class="money">
                                    EGP
                                </div>
                                <div class="money">
                                    EURO
                                </div>
                                <div class="money">
                                    USD
                                </div>

                            </div>
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container">
                <div class="header-bottom-left">
                    <h1 class="logo">
                        <a href="index.html">
                            <img src="{{ asset('images/juanmerkado.png') }}" alt="logo" width="245">
                        </a>
                    </h1>
                    <div class="header-search">
                        <form action="form.php" class="form form-search-header">
                            <select name="show-categories" id="show-categories">
                                <option value="products">Products</option>
                                <option value="suppliers">Suppliers</option>
                                <option value="quotes">Quotes</option>
                               
                            </select>
                                <input type="text" placeholder="Search...">
                            <button class="button-search"><i class="flaticon-search"></i></button>
                        </form>
                    </div>
                </div>
                <div class="header-bottom-right">
                    <div class="header-bottom-right-content">
                        <a href="#">
                            <i class="flaticon-like"></i>
                            Favorites
                        </a>
                    </div>
                    <div class="header-bottom-right-content cart-menu-relative">
                        <div class="cart-menu">
                            <a href="#">
                                <i class="flaticon-commerce"></i>
                                Cart
                                <i class="fa fa-caret-down" aria-hidden="true"></i>
                                <p class="cart-amount">6</p>
                            </a>
                        </div>
                        <div class="cart-hover">
                            <div class="cart-hover-title">Your Products <span>Prices</span></div>
                            <ul class="list-hover-cart">
                                <li class="hover-cart-item">
                                    <a href="#" class="img-hover-cart">
                                        <img src="{{ asset('template3/assets/images/img-hover-cart.jpg') }} " alt="img-hover-cart" width="75" height="89">
                                        <span class="delete-product-hover-cart"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                                    </a>
                                    <div class="text-hover-cart">
                                        <a href="#" class="name-hover-cart">Men's Skagen Watch
                                            Vesion 2.0</a>
                                        <div class="quantity">
                                            <p class="quanlity-hover-cart">Quanlity: <span>1</span></p>
                                        </div>
                                    </div>
                                    <div class="price-hover-cart">$150</div>
                                </li>
                            </ul>
                            <div class="subtotal-hover-cart">Subtotal <span>$150</span></div>
                            <div class="button-cart-hover">
                                <a href="#" class="go-to-cart button">Go to cart</a>
                                <a href="#" class="check-out button orange">Check Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       @yield('primaryMenu')

    </header>
        @yield('content')


    <footer class="footer">
        <div class="container">
            <div class="footer-top">
                <div class="row">
                    <div class="col-md-3 col-sm-6 has-logo">
                        <div class="footer-top-logo">
                            <h1 class="logo">
                                <a href="index.html">
                                    <img src="{{ asset('template3/assets/images/logo.png') }}" alt="logo">
                                </a>
                            </h1>
                        </div>
                        <div class="footer-infomation">
                            <p><span>Address:</span>Example Street 68, Mahattan,
                                New York, USA</p>
                            <p><span>Phone:</span>+ 65 123 456 789</p>
                            <p><span>Email:</span><a href="#">Support@SuperMarket.com</a></p>
                        </div>

                    </div>
                    <div class="col-md-2 col-sm-6">
                        <div class="footer-top-title"><h4 class="title-footer">About</h4></div>
                        <ul class="menu-footer">
                            <li class="footer-item"><a href="#">About Us</a></li>
                            <li class="footer-item"><a href="#">Blog</a></li>
                            <li class="footer-item"><a href="#">Terms of Use</a></li>
                            <li class="footer-item"><a href="#">Privacy Policy</a></li>
                            <li class="footer-item"><a href="#">Site Map</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <div class="footer-top-title"><h4 class="title-footer">Customer Service</h4></div>
                        <ul class="menu-footer">
                            <li class="footer-item"><a href="#">Shipping Policy</a></li>
                            <li class="footer-item"><a href="#">Comoensation First</a></li>
                            <li class="footer-item"><a href="#">My Account</a></li>
                            <li class="footer-item"><a href="#">Return Policy</a></li>
                            <li class="footer-item"><a href="#">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <div class="footer-top-title"><h4 class="title-footer">Products</h4></div>
                        <ul class="menu-footer">
                            <li class="footer-item"><a href="#">My Order</a></li>
                            <li class="footer-item"><a href="#">My Wishlist</a></li>
                            <li class="footer-item"><a href="#">My Credit Slip</a></li>
                            <li class="footer-item"><a href="#">My Addresses</a></li>
                            <li class="footer-item"><a href="#">New In</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-sm-6 tags-footer">
                        <div class="footer-top-title"><h4 class="title-footer">Hottags</h4></div>
                        <ul class="tags footer-tags">
                            <li class="tags-item"><a href="#">Kingston</a></li>
                            <li class="tags-item"><a href="#">Android</a></li>
                            <li class="tags-item"><a href="#">Mini book</a></li>
                            <li class="tags-item"><a href="#">Mini USB</a></li>
                            <li class="tags-item"><a href="#">TMD</a></li>
                            <li class="tags-item"><a href="#">IPhone</a></li>
                            <li class="tags-item"><a href="#">PC Black</a></li>
                            <li class="tags-item"><a href="#">Sport</a></li>
                            <li class="tags-item"><a href="#">Flat</a></li>
                            <li class="tags-item"><a href="#">Shirts</a></li>
                            <li class="tags-item"><a href="#">Arrow Shirts</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-mid">
                <div class="footer-mid-text">
                    <figure><img src="{{ asset('template3/assets/images/check.jpg') }}" alt="check" height="30" width="30"></figure>
                    <p>
                        Help improve your experience on SuperMarket,<span> join our Customer Experience Improvement Program now.
                            </span> Plus,<span>
                                tell us what you think of this page</span> !
                    </p>
                </div>
                <!--<figure><img src="assets/images/img-logo-footer.jpg" alt="img-footer" height="60" width="1170"></figure>-->
                <ul>
                    <li><a href="#"><img src="{{ asset('template3/assets/images/d1.jpg') }}" alt="d" width="46" height="41"></a></li>
                    <li><a href="#"><img src="{{ asset('template3/assets/images/d2.jpg') }}" alt="d" width="51" height="41"></a></li>
                    <li><a href="#"><img src="{{ asset('template3/assets/images/d3.jpg') }}" alt="d" width="60" height="41"></a></li>
                    <li><a href="#"><img src="{{ asset('template3/assets/images/d4.jpg') }}" alt="d" width="44" height="41"></a></li>
                    <li><a href="#"><img src="{{ asset('template3/assets/images/d5.jpg') }}" alt="d" width="42" height="41"></a></li>
                    <li><a href="#"><img src="{{ asset('template3/assets/images/d6.jpg') }}" alt="d" width="85" height="41"></a></li>
                    <li><a href="#"><img src="{{ asset('template3/assets/images/d7.jpg') }}" alt="d" width="89" height="41"></a></li>
                    <li><a href="#"><img src="{{ asset('template3/assets/images/d8.jpg') }}" alt="d" width="92" height="41"></a></li>
                    <li><a href="#"><img src="{{ asset('template3/assets/images/d9.jpg') }}" alt="d" width="65" height="41"></a></li>
                    <li><a href="#"><img src="{{ asset('template3/assets/images/d10.jpg') }} " alt="d" width="91" height="41"></a></li>
                    <li><a href="#"><img src="{{ asset('template3/assets/images/d11.jpg') }}" alt="d" width="96" height="41"></a></li>
                    <li><a href="#"><img src="{{ asset('template3/assets/images/d12.jpg') }}" alt="d" width="64" height="41"></a></li>
                    <li><a href="#"><img src="{{ asset('template3/assets/images/d13.jpg') }}" alt="d" width="131" height="41"></a></li>
                    <li><a href="#"><img src="{{ asset('template3/assets/images/d14.jpg') }}" alt="d" width="94" height="41"></a></li>
                </ul>
            </div>
            <div class="footer-bottom">
                <ul class="menu-footer-bottom">
                    <li class="menu-footer-bottom-item"><a href="#">Promotions</a></li>
                    <li class="menu-footer-bottom-item"><a href="#">My Orders</a></li>
                    <li class="menu-footer-bottom-item"><a href="#">Help</a></li>
                    <li class="menu-footer-bottom-item"><a href="#">Site Map</a></li>
                    <li class="menu-footer-bottom-item"><a href="#">Customer Service</a></li>
                    <li class="menu-footer-bottom-item"><a href="#">Most Populars</a></li>
                    <li class="menu-footer-bottom-item"><a href="#">Best Sellers</a></li>
                    <li class="menu-footer-bottom-item"><a href="#">New Arrivals</a></li>
                    <li class="menu-footer-bottom-item"><a href="#">Special Products</a></li>
                    <li class="menu-footer-bottom-item"><a href="#">Manufacturers</a></li>
                    <li class="menu-footer-bottom-item"><a href="#">Our Stores</a></li>
                    <li class="menu-footer-bottom-item"><a href="#">Shipping</a></li>
                    <li class="menu-footer-bottom-item"><a href="#">Blog</a></li>
                    <li class="menu-footer-bottom-item"><a href="#">Payments</a></li>
                    <li class="menu-footer-bottom-item"><a href="#">Payments</a></li>
                    <li class="menu-footer-bottom-item"><a href="#">Refunds Terms & Conditions</a></li>
                    <li class="menu-footer-bottom-item"><a href="#">Policy</a></li>
                    <li class="menu-footer-bottom-item"><a href="#">Policy</a></li>
                    <li class="menu-footer-bottom-item"><a href="#">Shipping</a></li>
                    <li class="menu-footer-bottom-item"><a href="#">Payments</a></li>
                    <li class="menu-footer-bottom-item"><a href="#">Returns</a></li>
                    <li class="menu-footer-bottom-item"><a href="#">Refunds</a></li>
                    <li class="menu-footer-bottom-item"><a href="#">Warrantee</a></li>
                    <li class="menu-footer-bottom-item"><a href="#">FAQ</a></li>
                    <li class="menu-footer-bottom-item"><a href="#">Contact</a></li>
                </ul>
                <div class="copyright">
                    <i class="fa fa-copyright" aria-hidden="true"></i>
                    Copyright 2016 <a href="#">SuperMarket</a> All rights reserved.
                </div>
            </div>
        </div>
        <a href="#" class="backtotop ts-block"><span class="pulser"> Top</span></a>
    </footer>
    <!--end footer-->
   @yield('script')
</body>
</html>
