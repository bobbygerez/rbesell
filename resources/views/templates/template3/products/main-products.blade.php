@extends('templates.template3.layouts.categories-grid')


@section('primaryMenu')

	@include('templates.template3.sub-views.primary-menu', [

            'mainCategories' => $menuCategories
  	])

@endsection


@section('breadCrumbs')

	@include('templates.template3.sub-views.bread-crumbs', [
                                
        'mainCat' => [

            ['name' => $mainCategories->getOriginal('name'), 'url' => '']

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
                            
                                
                                
                        <main-categories-products source="{{ url('api/products') }}">


                        </main-categories-products>


                        </div>
                    </div>
                    <div class="sidebar col-md-3">
                        
                        <sidebar-options >
                            
                        </sidebar-options>
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