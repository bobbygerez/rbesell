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
              'name' => $merchantCategories->mainCategory->getOriginal('name'), 
              'url' => url('browse/'. $merchantCategories->mainCategory->name, Obfuscate::encode($merchantCategories->mainCategory->id) )
            ],

            [
              'name' => $merchantCategories->getOriginal('name'), 
              'url' => ''
            ]

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
                    <div class="content col-md-9 has-sidebar-left">
                        <div class="banner-categories-grid">
                            <img src="{{ asset('template3/assets/images/bn-blog.jpg') }}" alt="banner" height="175" width="868">
                        </div>
                        <div class="categories-grid">
                            <div class="breadcrumb-sidebar">
                                <div class="breadcrumb-wrap">
                                    <nav class="breadcrumb-trail breadcrumbs">
                                        <ul class="trail-items">
                                            <li class="trail-item trail-begin">
                                                <a href="#"><span>Home</span></a>
                                            </li>
                                            <li class="trail-item trail-end">
                                                <span>Electronic </span> 
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="panel-categories"  >
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="view-categories">
                                            <div class="click-grid color-active">
                                                <i class="flaticon-four-grid-layout-design-interface-symbol"></i>
                                            </div>
                                            <div class="click-list">
                                                <i class="flaticon-squares-gallery-grid-layout-interface-symbol"></i>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                       
                                    </div>
                                    <div class="col-md-3">
                                        
                                        
                                        
                                    </div>
                                </div>
                            </div>
                                
                                <div class="products-categories">
                                    <span v-for="(merchantCat, mk) in merchantCategories">
                                    <h2 style="margin-left: 15px; margin-bottom: 15px;">@{{ merchantCat.name }}</h2>
                                        <span v-for="merchantSub in merchantCat.merchant_subcategory">
                                            <span v-for="(product, k) in merchantSub.products" v-show="k==0" >
                                                <span v-for="photo in product.photos">
                                                        <div class="product-box">
                                                            <div class="product-box-content">
                                                                <figure class="img-product">
                                                                    <img :src="windowLocation + photo.path" alt="product" height="207" width="175" v-if="photo.is_primary === 1" >
                                                                    <a :href="merchantCat.name + '/' + merchantSub.name + '/' + product.name + '/' + product.id" class="flaticon-search"></a>
                                                                </figure>
                                                                <div class="product-box-text" style="text-align:center;">
                                                                    <a href="product_id" class="product-name" ><strong >@{{merchantSub.name }}</strong></a>
                                                                       <a href="#" class="write">Write Your Review</a>
                                                                        <p class="product-cost" style="color: #999;"><a href="#">  @{{ merchantSub.products.length }} items >>></a> </p>
                                                                        <p class="desc-product"> 
                                                                          @{{ merchantSub.desc }}
                                                                        </p>
                                                                            
                                                                </div>

                                                            </div>
                                                        </div>

                                                </span>
                                            </span>
                                        </span>
                                        <div class="clearfix"></div>
                                    </span>

                                </div>

                            
                            <div class="panel-categories">
                                <!--
                                 <div class="row">
                                    <div class="col-md-4">
                                        <div class="view-categories">
                                            <div class="click-grid color-active">
                                                <i class="flaticon-four-grid-layout-design-interface-symbol"></i>
                                            </div>
                                            <div class="click-list">
                                                <i class="flaticon-squares-gallery-grid-layout-interface-symbol"></i>
                                            </div>
                                            &nbsp;
                                            <span>From @{{ products.from }}-@{{ products.to}} of @{{ products.total }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        
                                        <div class="select-categories">
                                            <div class="select-categories-content">
                                                <span>Sort by</span>
                                                <select v-model="query.direction">
                                                    <option  value="asc">Low to High</option>
                                                    <option  value="desc">High to Low</option>
                                                </select>
                                            </div>
                                            <div class="select-categories-content">
                                                <span>Show</span>
                                                <select v-model="query.per_page">
                                                    <option v-for="numProduct in showNumberProducts" :value="numProduct">@{{numProduct}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        
                                        <div class="page-nav">
                                            <div class="page-nav-item" @click="prev()"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
                                             <div class="page-nav-item " v-for="num in products.last_page" :class="{active : products.current_page == num}" @click=changePage(num)>@{{num}}</div>
                                            <div class="page-nav-item" @click="next()"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
                                        </div>
                                    </div>
                                </div>
                                -->
                            </div>
                        </div>
                    </div>
                    <div class="sidebar col-md-3">
                        
                        <div class="sidebar-categories">
                            <div class="shop-sidebar">
                                <div class="sidebar-title">Shop By</div>
                                <div class="shop-sidebar-content">
                                    <div class="categories-sidebar" >
                                        <div class="sidebar-title-section">Locations</div>
                                        <select class="form-control" v-model="province" style="margin-bottom: 5px;">
                                            <option value="">Select Province </option>
                                            <option :value="province.provCode" v-for="province in provinces">@{{ province.provDesc }}</option>
                                        </select>
                                        <select class="form-control" v-model="city" :class="{ hideVisible : cityInvisible }" style="margin-bottom: 5px;">
                                            <option value="">Select Municipality </option>
                                            <option :value="city.citymunCode" v-for="city in cities">@{{ city.citymunDesc }}</option>
                                        </select>
                                        <select class="form-control" v-model="brgy" :class="{ hideVisible : brgyInvisible }">
                                            <option value="">Select Barangay </option>
                                            <option :value="brgy.brgyCode" v-for="brgy in barangays">@{{ brgy.brgyDesc }}</option>
                                        </select>
                                    </div>
                                    <div class="price-sidebar">
                                        <div class="sidebar-title-section">Price</div>
                                        <div class="price-filter">
                                            <div class="slider-range ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                                                <div class="filter-top">
                                                    <span  v-for="range in rangeProduct" :class="range.class">@{{ range.value }}</span>
                                                </div>
                                                <div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 100%;"></div>
                                                <span tabindex="0" class="ui-slider-handle ui-state-default ui-corner-all" style="left: 0%;">
                                            <span class="amount">$1</span>
                                        </span>
                                                <span tabindex="0" class="ui-slider-handle ui-state-default ui-corner-all" style="left: 100%;">
                                        <span class="amount2">$250</span>
                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="manufacture-sidebar">
                                        <div class="sidebar-title-section">Manufacture</div>
                                        <div class="categories-checkbox">
                                            <ul class="brands">
                                                <li><input type="checkbox" value="Ercol"><label>Ercol</label></li>
                                                <li><input type="checkbox" value="Duresta"><label>Duresta</label></li>
                                                <li><input type="checkbox" value="G Plan"><label>G Plan</label><br>
                                                <li><input type="checkbox" value="Parker Knoll"><label>Parker Knoll</label></li>
                                                <li><input type="checkbox" value="Collins & Hayes"><label>Collins & Hayes</label></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="color-sidebar">
                                        <div class="sidebar-title-section">Color</div>
                                        <div class="color-sidebar-content">
                                            <div class="box-color box-color-orange"></div>
                                            <span>(3)</span>
                                        </div>
                                        <div class="color-sidebar-content">
                                            <div class="box-color box-color-brown"></div>
                                            <span>(3)</span>
                                        </div>
                                        <div class="color-sidebar-content">
                                            <div class="box-color box-color-red"></div>
                                            <span>(4)</span>
                                        </div>
                                        <div class="color-sidebar-content">
                                            <div class="box-color box-color-black"></div>
                                            <span>(5)</span>
                                        </div>
                                        <div class="color-sidebar-content">
                                            <div class="box-color box-color-white">CYAL</div>
                                            <span>(2)</span>
                                        </div>
                                        <div class="color-sidebar-content">
                                            <div class="box-color box-color-cyan"></div>
                                            <span>(2)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="compare-sidebar">
                                <div class="sidebar-title">Compare Products</div>
                                <div class="compare-sidebar-content">You Have No Item Compare</div>
                            </div>
                            <div class="bestseller-sidebar">
                                <div class="sidebar-title">Bestseller Products</div>
                                <div class="bestseller-sidebar">
                                    <ul class="bestseller-list">
                                        <li class="bestseller-item">
                                            <a href="#"><img src="{{ asset('template3/assets/images/sb-cat1.jpg') }}" alt="sb" height="130" width="112"></a>
                                            <div class="bestseller-content">
                                                <a href="#" class="bestseller-text">Washing Machine Pro</a>
                                                <span>$1000.00</span>
                                            </div>
                                        </li>
                                        <li class="bestseller-item">
                                            <a href="#"><img src="{{ asset('template3/assets/images/sb-cat2.jpg') }}" alt="sb" height="130" width="112"></a>
                                            <div class="bestseller-content">
                                                <a href="#" class="bestseller-text">Washing Machine Pro</a>
                                                <span>$1000.00</span>
                                            </div>
                                        </li>
                                        <li class="bestseller-item">
                                            <a href="#"><img src="{{ asset('template3/assets/images/sb-cat3.jpg') }}" alt="sb" height="130" width="112"></a>
                                            <div class="bestseller-content">
                                                <a href="#" class="bestseller-text">Washing Machine Pro</a>
                                                <span>$1000.00</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tag-sidebar">
                                <div class="sidebar-title-section">Popular Tags</div>
                                <ul class="tag-list-sidebar">
                                    <li class="tag-sidebar-item"><a href="#">Mobile</a></li>
                                    <li class="tag-sidebar-item"><a href="#">Adss</a></li>
                                    <li class="tag-sidebar-item"><a href="#">Masem</a></li>
                                    <li class="tag-sidebar-item"><a href="#">Mudd</a></li>
                                    <li class="tag-sidebar-item"><a href="#">Atimo</a></li>
                                </ul>
                                <a href="#" class="view-all-tags">View All Tags<i class="fa fa-caret-right" aria-hidden="true"></i></a>
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