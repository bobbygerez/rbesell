<form id="register-form"  method="post" role="form" style="display: none;" @submit.prevent="validateBeforeSubmit" url="{{ url('register') }}">

	{{ csrf_field() }}

	<user-register sitekey="{{ env('RE_CAP_SITE') }}"></user-register>

</form>

