@extends('templates.template3.layouts.categories-grid')


@section('primaryMenu')

	@include('templates.template3.sub-views.primary-menu', [

            'mainCategories' => $menuCategories
  	])

@endsection


@section('content')
<br />
<div class="container">
        <div class="row">
			<div class="col-md-6 col-md-offset-3">
				@include('templates.template3.sub-views.alerts.errors')
				@include('templates.template3.sub-views.alerts.success')
				@include('auth.partials.unconfirm')
				<div class="panel panel-login">
					<div class="panel-heading">
						
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">Login</a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link">Register</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body" id="app">
						<div class="row">
							<div class="col-lg-12">
								@include('auth.partials.log')
								@include('auth.partials.reg')
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
	<script src='https://www.google.com/recaptcha/api.js'></script>

@endsection
