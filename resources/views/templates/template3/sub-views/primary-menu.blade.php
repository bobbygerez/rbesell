<div class="menu-primary">
            <div class="container">
                <a href="#categories-menu" class="menu-button categories-menu-button">
                    Categories<span class="flaticon-bars"></span>
                </a>
                <nav class="menu-item has-mega-menu" id="categories-menu">
                    <ul class="menu">
                        <li class="menu-item">
                            <a href="#">Categories</a>
                            <span class="click-categories flaticon-bars"></span>
                            <div class="category-drop-list">
                                <div class="category-drop-list-inner">
                                    <ul class="sub-menu sub-menu-open">
                                        @foreach($mainCategories as $maincategory)
                                            <li class="menu-item has-mega">
                                                <a href="{{ url('browse/'.$maincategory->name, Obfuscate::encode($maincategory->id) ) }}">{{ $maincategory->getOriginal('name') }}</a>
                                                <div class="sub-menu mega-menu">
                                                    <div class="row">
                                                         @foreach($maincategory->merchantCategory as $merchantCategory)
                                                        <div class="col-md-3">
                                                                <div class="mega-content">
                                                                    <p class="mega-item-title"><a href="{{ url('browse/'.$maincategory->name.'/'.$merchantCategory->name,Obfuscate::encode($merchantCategory->id) ) }}"><strong>{{ $merchantCategory->getOriginal('name') }}</strong></a></p>
                                                                    <ul class="menu">
                                                                        @foreach($merchantCategory->merchantSubcategory as $merchantSub)
                                                                            <li class="menu-item"><a href="{{ url('browse/'.$maincategory->name.'/'.$merchantCategory->name.'/'.$merchantSub->name, Obfuscate::encode($merchantSub->id)) }}">{{ $merchantSub->name }}</a></li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                           
                                                        </div>
                                                        @endforeach
                                                        
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <span class="more-categories open-cate">More Categories</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>
                <a href="#primary-navigation" class="menu-button primary-navigation-button">
                    <span class="flaticon-bars"></span>Main Menu
                </a>
                <nav id="primary-navigation" class="site-navigation main-menu">
                    <ul id="primary-menu" class="menu">
                        <li class="menu-item has-childrent active">
                            <a href="">Home</a>
                            <ul class="sub-menu">
                                <li class="menu-item active"><a href="index.html">Home 1</a></li>
                                <li class="menu-item"><a href="home-v2.html">Home 2</a></li>
                                <li class="menu-item"><a href="home-v3.html">Home 3</a></li>
                                <li class="menu-item"><a href="home-v4.html">Home 4</a></li>
                                <li class="menu-item"><a href="home-v5.html">Home 5</a></li>
                                <li class="menu-item"><a href="home-v6.html">Home 6</a></li>
                            </ul>
                        </li>
                        <li class="menu-item"><a href="#">New Arrival</a></li>
                        <li class="menu-item"><a href="#">Deals</a></li>
                        <li class="menu-item has-childrent">
                            <a href="#">Shop</a>
                            <ul class="sub-menu">
                                <li class="menu-item"><a href="categories-grid.html">Categories Grid 1</a></li>
                                <li class="menu-item"><a href="category-grid-right-sidebar.html">Categories Grid 1 Right Sidebar</a></li>
                                <li class="menu-item"><a href="categories-grid2.html">Categories Grid 2</a></li>
                                <li class="menu-item"><a href="categories-grid2-right-sidebar.html">Categories Grid 2 Right Sidebar</a></li>
                                <li class="menu-item"><a href="categories-grid3.html">Categories Grid 3</a></li>
                                <li class="menu-item"><a href="categories-list1.html">Categories List 1</a></li>
                                <li class="menu-item"><a href="categories-list1-right-sidebar.html">Categories List 1 Right Sidebar</a></li>
                                <li class="menu-item"><a href="categories-list2.html">Categories List 2</a></li>
                                <li class="menu-item"><a href="categories-list2-right-sidebar.html">Categories List 2 Right Sidebar</a></li>
                            </ul>
                        </li>


                        <li class="menu-item has-childrent">
                            <a href="#">Pages</a>
                            <ul class="sub-menu">
                                <li class="menu-item"><a href="blogpost.html">Blog Post</a></li>
                                <li class="menu-item"><a href="product-detail.html">Product Detail</a></li>
                                <li class="menu-item"><a href="shopping-carrt.html">Cart</a></li>
                                <li class="menu-item"><a href="checkout.html">Check Out</a></li>
                                <li class="menu-item"><a href="contact.html">Contact Us</a></li>
                                <li class="menu-item"><a href="about.html">About US</a></li>
                            </ul>
                        </li>
                        <li class="menu-item"><a href="blog.html">Blog</a></li>
                    </ul>
                </nav>
            </div>
        </div>