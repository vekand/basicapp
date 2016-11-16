@extends('main')

@section('title', 'Solved Diagrams')

@section('content')
<div class="row">
<div class="col-md-12 curs">
	<div class="col-md-9">
		<h1>{{ trans('messages.diagrams.solved') }}  <small>{{ $course->tipcurs }} ({{ $course->id }})</small></h1>
	</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-12 ">
		<table class="table body-table-background table-condensed table-bordered ">
				<thead>
					<th>#</th>
					<th>{{ trans('messages.diagrams.diagram') }}</th>
					<th>{{ trans('messages.diagrams.createdat') }}</th>
					<th></th>
					<th>{{ trans('messages.diagrams.lastname') }}</th>
					<th>{{ trans('messages.diagrams.firstname') }}</th>
					<th>{{ trans('messages.diagrams.solvedat') }}</th>
					<th>{{ trans('messages.diagrams.clicks') }}</th>
					
				</thead>
				<tbody>
					@foreach($diagrams as $diagram)
					<tr>
						<th>{{ $diagram->diagr_id }}</th>
						<td>{{ $diagram->explicatii }}</td>
						<td>{{ date('j M Y', strtotime($diagram->create_at)) }}</td>
						<td>{{ trans('messages.diagrams.solvedby') }}</td>
						<td>{{ $diagram->last_name }}</td>
						<td>{{ $diagram->first_name }}</td>
						<td>{{ $diagram->created_at }}</td>
						<td>{{ $diagram->clickuri }}</td>
						
					</tr>
					@endforeach
				</tbody>
			</table>
			<div class="text-center">
				{!! $diagrams->links() !!}
			</div>
		</div>
	</div>
</div>
@endsection