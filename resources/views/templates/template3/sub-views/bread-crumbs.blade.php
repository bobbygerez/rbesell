<div class="breadcrumb-sidebar">
	<div class="breadcrumb-wrap">
		<nav class="breadcrumb-trail breadcrumbs">
			<ul class="trail-items">
				<li class="trail-item trail-begin">
					<a href="{{ url('/') }}"><span>home</span></a>
				</li>

				@foreach($mainCat as $main)

					@if($main['url'] == '')

						<li class="trail-item trail-end" style="text-transform: capitalize;">
							<span>{{ $main['name'] }}</span>
						</li>

					@else

						<li class="trail-item trail-end">
							<a href="{{ $main['url'] }}"><span>{{ $main['name'] }}</span></a>
						</li>
					@endif
				
				@endforeach
				
			</ul>
		</nav>
	</div>
</div>