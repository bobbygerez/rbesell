@extends('templates.template3.layouts.categories-grid')




@section('primaryMenu')

	@include('templates.template3.sub-views.primary-menu', [

            'mainCategories' => $menuCategories
  	])

@endsection


@section('breadCrumbs')

	@include('templates.template3.sub-views.bread-crumbs', [
                                
        'mainCat' => [

            [

            'name' => $product->merchantSubcategory->merchantCategory->mainCategory->getOriginal('name'), 
            'url' => url('browse/'. $product->merchantSubcategory->merchantCategory->mainCategory->name, Obfuscate::encode($product->merchantSubcategory->merchantCategory->mainCategory->id))

            ],

            [

            'name' => $product->merchantSubcategory->merchantCategory->getOriginal('name'), 
            'url' => url('browse/'. $product->merchantSubcategory->merchantCategory->name, Obfuscate::encode($product->merchantSubcategory->merchantCategory->id))

            ],

            [

            'name' => $product->merchantSubcategory->getOriginal('name'), 
            'url' => url('browse/'. $product->merchantSubcategory->name, Obfuscate::encode($product->merchantSubcategory->id))

            ],

            [

            'name' => $product->getOriginal('name'), 
            'url' => ''

            ],

        ]

     ])



@endsection

@section('content')

<!-- End .banner -->
    <div class="main-content categories categories-grid1" style="background-color: #F5F5F5" data-background-color="#F5F5F5" id="app">
        <div class="container">
            <div class="categories-page">
                <div class="row">
					<div class="col-sm-12">
						@yield('breadCrumbs')
					</div>
                    
                </div>

                <div class="product-box product-box-primary">
                <div class="product-box-content">
                    <div class="row">
                        <div class="col-md-5">
                            <figure class="img-product">
                                <img src="{{ asset($product->photos()->isPrimary()) }}" alt="product" height="536" width="467">
                                <div class="img-room"><img src="{{ asset('template3/assets/images/room.jpg') }}" alt="room" height="32" width="32"></div>
                            </figure>
                            <div class="featue-slide supermartket-owl-carousel" data-number="3" data-margin="15" data-navcontrol="yes">

                            	@foreach($product->photos as $photo)
                                <div class="feature-slide-item">
                                    <figure><img src="{{ asset($photo->path) }}" alt="feature" width="126" height="143"></figure>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="single-product-content">
                                <h3 class="product-title" style="text-transform: capitalize;">{{ $product->getOriginal('name') }}</h3>
                                <a href="#" class="write">Write Your Review</a>
                                <p class="product-cost">&#x20B1; {{ $product->prices()->isPrimary() }}</p>
                                <p class="stock">Availability:<span><i class="fa fa-check-square-o" aria-hidden="true"></i>In stock</span></p>
                                <div class="desc-product-title">Quick OverView</div>
                                <div class="desc-product">{{ $product->desc }}
                                </div>
                                
                                <div class="select-detail">
                                    <span>Option1:</span>
                                    <select name="selectdetail1" id="selectdetail1">
                                        <option value="op1">--Please Select--</option>
                                        <option value="op2">Red</option>
                                    </select>
                                </div>
                                <div class="select-detail">
                                    <span>Option2:</span>
                                    <select name="selectdetail2" id="selectdetail2">
                                        <option value="opt1">--Please Select--</option>
                                        <option value="opt2">M</option>
                                    </select>
                                </div>
                                <div class="product-box-bottom">
                                    <div class="quanlity-product">
                                        <span>Qty:</span>
                                        <div class="quantity buttons_added">
                                            <a class="sign minus" href="#"><i class="fa fa-minus" aria-hidden="true"></i></a>
                                            <input type="text" size="1" class="input-text qty text" title="Qty" value="1">
                                            <a class="sign plus" href="#"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    <div class="button-detail">
                                        <a href="#" class="add-to-cart"><i class="flaticon-commerce"></i>Add To Cart</a>
                                        <a href="#" class="wishlist"><i class="flaticon-like"></i></a>
                                        <a href="#" class="refresh-product"><i class="flaticon-arrows"></i></a>
                                    </div>

                                </div>
                                <hr>
                                <div class="product-box-bottom">
                                    <div class="quanlity-product">
                                        <h4>Supplier Information</h4>
                                        <div class="quantity buttons_added">
                                            <a class="sign minus" href="#"><i class="fa fa-minus" aria-hidden="true"></i></a>
                                            <input type="text" size="1" class="input-text qty text" title="Qty" value="1">
                                            <a class="sign plus" href="#"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    <div class="button-detail">
                                        <a href="#" class="add-to-cart"><i class="flaticon-commerce"></i>Add To Cart</a>
                                        <a href="#" class="wishlist"><i class="flaticon-like"></i></a>
                                        <a href="#" class="refresh-product"><i class="flaticon-arrows"></i></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="section-icon-box">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="icon-box style1">
                                <div class="row">
                                    <div class="col-md-4">
                                        <i class="flaticon-umbrella"></i>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="icon-box-content">
                                            <h4>Buyer Protection</h4>
                                            <p>Secure payments
                                                Guaranteed refunds
                                                Escrow protection on every oder</p>
                                            <a href="#">Read More<i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="icon-box style1">
                                <div class="row">
                                    <div class="col-md-4">
                                        <i class="flaticon-return-of-investment"></i>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="icon-box-content">
                                            <h4>RETURN & EXCHANGE</h4>
                                            <p>Wholesale products from certified
                                                Worldwide shipping
                                                Low prices from US $0.1</p>
                                            <a href="#">Read More<i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="icon-box style1">
                                <div class="row">
                                    <div class="col-md-4">
                                        <i class="flaticon-transport"></i>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="icon-box-content">
                                            <h4>FREE DELIVERY</h4>
                                            <p>Wholesale products from certified
                                                Worldwide shipping
                                                Low prices from US $0.1</p>
                                            <a href="#">Read More<i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



@endsection

@section('script')
    <script type='text/javascript' src="{{ asset('template3/assets/js/template3.js') }}"></script>
@endsection