@if (Session::has('success'))
	<div class="alert alert-success form-spacing-top" role="alert">
		<strong>Success:</strong> {{ Session::get('success') }}
	</div>
@endif

@if (count($errors) > 0)
	<div class="alert alert-danger form-spacing-top" role="alert">
		<strong>Errors:</strong>
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</div>
@endif