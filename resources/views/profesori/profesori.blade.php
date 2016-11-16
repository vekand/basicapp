@extends('main')

@section('title', 'All Posts')

@section('content')

<div class="row">
	<div class="col-md-9">
		<h1>{{ trans('messages.profesori.profes') }}</h1>
	</div>
	<div class="col-md-3">
		<a href="{{ route('profesori.create') }}" class="btn btn-lg btn-blog btn-primary btn-h1-spacing">{{ trans('messages.profesori.newprof') }}</a>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-12 ">
			<table class="table body-table-background">
				<thead>
					<th>#</th>
					<th>{{ trans('messages.profesori.nume') }}</th>
					<th>{{ trans('messages.profesori.prenume') }}</th>
					<th>{{ trans('messages.profesori.nick') }}</th>
					<th>Email</th>
					<th>{{ trans('messages.profesori.adresa') }}</th>
					<th>{{ trans('messages.profesori.oras') }}</th>
					<th>{{ trans('messages.profesori.scoala') }}</th>
					<th title="{{ trans('messages.profesori.havestudent') }}">{{ trans('messages.profesori.activ') }}</th>
					<th title="{{ trans('messages.profesori.publicblog') }}">{{ trans('messages.profesori.blog') }}</th>
					<th>{{ trans('messages.profesori.text') }}</th>
					<th>{{ trans('messages.profesori.created_at') }}</th>
					<th> At</th>
				</thead>
				<tbody>
					@foreach($profs as $prof)
					<tr>
						<th>{{ $prof->id }}</th>
						<td>{{ $prof->last_name }}</td>
						<td>{{ $prof->first_name }}</td>
						<td>{{ $prof->nick_name }}</td>
						<td>{{ $prof->email }}</td>
						<td>{{ $prof->adresa }}</td>
						<td>{{ $prof->oras }}</td>
						<td>{{ $prof->scoala }}</td>
						<td>{{ $prof->activ }}</td>
						<td>{{ $prof->blog }}</td>
						<td>{{ $prof->text }}</td>
						<td>{{ date('j M Y', strtotime($prof->created_at)) }}</td>
						<td><a href="{{ route('profesori.edit', $prof->id) }}" class="btn btn-default btn-sm">Edit</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
			<div class="text-center">
				{!! $profs->links() !!}
			</div>
		</div>
	</div>
</div>
@endsection