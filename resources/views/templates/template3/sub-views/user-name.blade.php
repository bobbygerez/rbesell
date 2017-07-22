@if(Auth::check())

	{{ Auth::User()->firstname . ' ' . Auth::User()->lastname }}
@else

	My Account
@endif