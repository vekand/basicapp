@extends('main')

@section('title', 'Registered Players')

@section('content')
<div class="row">
	<div class="col-md-12 turneu">
		<h1>{{ trans('messages.tournamentcreate.registered') }}</h1>
		<h4>{{ $tournament->descriere  }}</h4>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12 ">
			<table class="table body-table-background table-condensed table-bordered table-responsive">
				<thead>
					<th>#</th>
					<th>{{ trans('messages.tournamentcreate.lastname') }}</th>
					<th>{{ trans('messages.tournamentcreate.firstname') }}</th>
					<th>{{ trans('messages.tournamentcreate.category') }}</th>
					<th>{{ trans('messages.tournamentcreate.elo') }}</th>
					<th>{{ trans('messages.tournamentcreate.group') }}</th>
					<th>{{ trans('messages.tournamentcreate.asociation') }}</th>
					<th>{{ trans('messages.tournamentcreate.city') }}</th>
					<th>{{ trans('messages.tournamentcreate.country') }}</th>
					<th>{{ trans('messages.tournamentcreate.email') }}</th>
					<th>{{ trans('messages.tournamentcreate.phone') }}</th>
					<th>{{ trans('messages.tournamentcreate.accomday') }}</th>
					<th>{{ trans('messages.tournamentcreate.accomper') }}</th>
					<th>{{ trans('messages.tournamentcreate.lunch') }}</th>
					<th>{{ trans('messages.tournamentcreate.mess') }}</th>
					<th>At</th>

				</thead>
				<tbody>
					@foreach($players as $player)
					<tr>
						<th>{{ $player->id }}</th>
						<td>{{ $player->last_name }}</td>
						<td>{{ $player->first_name }}</td>
						<td>{{ $player->category }}</td>
						<td>{{ $player->elo }}</td>
						<td>{{ $player->group }}</td>
						<td>{{ $player->asociation }}</td>
						<td>{{ $player->city }}</td>
						<td>{{ $player->country }}</td>
						<td>{{ $player->email }}</td>
						<td>{{ $player->phone }}</td>
						<td>{{ $player->accomday }}</td>
						<td>{{ $player->accomper }}</td>
						<td>{{ $player->lunch }}</td>
						<td>{{ $player->mess }}</td>
						@if (Auth::check())
						<td>
						{!! Form::open(['route' => ['tournaments.deleteplayer', $player->id, $tournament->id], 'method' => 'DELETE', 'onsubmit' => 'return confirm("Delete ?")']) !!}
							{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}
							{!! Form::close() !!}
							@endif	
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			<div class="text-center">
				{!! $players->links() !!}
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')
{!! Html::script('js/parsley.min.js') !!}
{!! Html::script('js/select2.min.js') !!}

<script type="text/javascript">
	$(".select2-multi").select2();  //plugin
</script>
@endsection