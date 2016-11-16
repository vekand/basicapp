@extends('main')

@section('title', 'All Tournaments')

@section('content')

<div class="row">
	<div class="col-md-12 turneu">
	<div class="col-md-4">
		<h1>{{ trans('messages.tournamentcreate.all') }}   <a href="#" onmouseover="vezipoza()"  onmouseout="ascundepoza()"><img src="background/foto31.jpg" height="32px"></a></h1> 
	</div>
	<div id="poza" class="col-md-5" style="visibility:hidden;">
		<img src="background/cursuridesah.png" >
	</div>
	
	<div class="col-md-3 text-right">
		@if (Auth::check())
		@if ($user->hasRole('Referee') || $user->hasRole('Author'))
		<a href="{{ route('tournaments.create') }}" class="btn btn-lg btn-blog btn-primary btn-h1-spacing">{{ trans('messages.tournamentcreate.title') }}</a>
		@endif
		@endif  
	</div>
	</div>
	<hr>
	<div class="row ">
		<div class="col-md-12 col-sm-12 col-xs-12 ">
			<table class="table body-table-background table-condensed table-bordered table-responsive">
				<thead style="color:blue;">
					<th>#</th>
					<th>{{ trans('messages.tournamentcreate.description') }}</th>
					<th>{{ trans('messages.tournamentcreate.posted_at') }}</th>
					<th>{{ trans('messages.tournamentcreate.file') }}</th>
					<th>{{ trans('messages.tournamentcreate.period') }}</th>
					{{-- <th>{{ trans('messages.tournamentcreate.slug') }}</th> --}}
					<th>{{ trans('messages.tournamentcreate.city') }}</th>
					<th>{{ trans('messages.tournamentcreate.country') }}</th>
					{{-- <th>{{ trans('messages.tournamentcreate.status') }}</th> --}}
					{{-- <th>{{ trans('messages.tournamentcreate.remarqs') }}</th> --}}
					<th>{{ trans('messages.tournamentcreate.rounds') }}</th>
					<th style="width: 70px;">{{ trans('messages.tournamentcreate.chessresult') }}</th>
					<th> At</th>
				</thead>
				<tbody>
					@foreach($tournaments as $tournament)
					<tr>
						<th>{{ $tournament->id }}</th>
						<td>{{ $tournament->descriere }}</td>
						<td>{{ date('j M Y', strtotime($tournament->posted_at)) }}</td>
						@if ($tournament->prospect)
						<td>
							<a href="{{ route('tournament.image', $tournament->id)  }}" target="_blank"><img src="background/pdf32.png" class="img-responsive" ></a>							
						</td>
						@else
						<td></td>
						@endif
						<td>{{ $tournament->perioada }}</td>
						{{-- <td>{{ $tournament->slug }}</td> --}}
						<td>{{ $tournament->localit }}</td>
						<td>{{ $tournament->tara }}</td>
						{{-- <td>{{ $tournament->stare }}</td> --}}
						{{-- <td>{{ $tournament->obs }}</td> --}}
						<td>{{ $tournament->nrrunde }}</td>

						<td> <a href="{{ route('chessresult', $tournament->id) }}">{{ $tournament->chesssite }}</a></td>
						<td style="white-space: nowrap;">
						
							@if (Auth::check())
							<a href="{{ route('tournaments.show', $tournament->id) }}" class="btn btn-primary btn-sm buton-default">{{ trans('messages.view') }}</a>
							@else
							<a href="{{ route('tournamentview', $tournament->id) }}" class="btn btn-primary btn-sm buton-default">{{ trans('messages.view') }}</a>
							@endif	
							@if (Auth::check()) 
							@if ($user->hasRole('Referee') || $user->hasRole('Author'))
							<a href="{{ route('tournaments.edit', $tournament->id) }}" class="btn btn-warning btn-sm">{{ trans('messages.edit') }}</a>
							@endif
							@endif
							<a href="{{ route('tournamentgetregister', $tournament->id) }}" class="btn btn-primary btn-sm buton-default" title="Register online for this tournament">{{ trans('messages.takepart') }}</a>
						</td>	
					</tr>
					@endforeach
				</tbody>
			</table>
			<div class="text-center">
				{!! $tournaments->links() !!}
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
	function vezipoza() {
		document.getElementById('poza').style.visibility = 'visible';
	}
	function ascundepoza() {
		document.getElementById('poza').style.visibility = 'hidden';
	}
</script>
@endsection