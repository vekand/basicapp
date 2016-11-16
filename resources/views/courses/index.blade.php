@extends('main')

@section('title', 'All Courses')

@section('content')

<div class="row">
	<div class="col-md-9">
		<h1>All Courses</h1>
	</div>
	<div class="col-md-3">
		@if (Auth::check())
		@if (Auth::user()->hasRole('Author') || Auth::user()->hasRole('Admin'))
		<a href="{{ route('courses.create') }}" class="btn btn-lg btn-blog btn-primary btn-h1-spacing">Create New Course</a>
		@endif  
		@endif  
	</div>
	<hr>
	<div class="row">
		<div class="col-md-12 ">
			<table class="table body-table-background table-condensed table-bordered  table-hover table-striped">
				<thead>
					<th>#</th>
					<th>Curs</th>
					<th>Data</th>
					<th>Fisier</th>
					<th>Access</th>
					<th>Tema</th>
					<th> At</th>
				</thead>
				<tbody>
					@foreach($courses as $course)
					<tr>
						<th>{{ $course->id }}</th>
						<td>{{ $course->tipcurs }}</td>
						<td>{{ date('j M Y', strtotime($course->datacurs)) }}</td>
						<td>{{ $course->fiscurs }}</td>
						<td>{{ $course->grupe }}</td>
						<td>{{ $course->starecurs }}</td>
						<td>{{ $course->obscurs }}</td>
						<td><a href="{{ route('courses.show', $course->id) }}" class="btn btn-default btn-sm">View</a> <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-default btn-sm">Edit</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
			<div class="text-center">
				{!! $courses->links() !!}
			</div>
		</div>
	</div>
</div>
@endsection