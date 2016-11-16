@extends('main')

@section('title', 'View Tournament')

@section('content')

<div class="row">
	<div class="col-md-8 jos ">
		<h1>{{ $tournament->descriere }}</h1>
		<p class="lead">{{ $tournament->perioada }}<br />
			({{ $tournament->stare }})<br />
			({{ $tournament->obs }})</p>
			<div class="round singleabout">{{ trans('messages.tournamentcreate.rounds') }}:
				@for ($i=1; $i<=$tournament->nrrunde; $i++)
				<a href="{{ route('tournaments.rounds', ['id' => $tournament->id, 'round' => $i] ) }}" ><span class="label label-default runde" >{{ $i }}</span></a>
				@endfor
			</div>
			<hr>
			@if (Auth::check())
				@if ($user->hasRole('Referee') || $user->hasRole('Author'))
			<div class="round singleabout">{{ trans('messages.tournamentcreate.upload') }}:
				@for ($i=1; $i<=$tournament->nrrunde; $i++)
				<a href="{{ route('tournaments.getrounds', ['id' => $tournament->id, 'round' => $i] ) }}" ><span class="label label-default" >{{ $i }}</span></a>
				@endfor
			</div>
				@endif
			@endif		
			<hr><hr>
			<div class="round singleabout">	
				<a href="{{ route('tournaments.initiallist', ['id' => $tournament->id] ) }}"  >
				<span class="label label-default runde">{{ trans('messages.tournamentcreate.initiallist') }}</span></a>
				@if (Auth::check())
				@if ($user->hasRole('Referee') || $user->hasRole('Author'))
				<a href="{{ route('tournaments.getinitial', ['id' => $tournament->id] ) }}">
				<span class="label label-default">{{ trans('messages.tournamentcreate.uploadinitiallist') }}</span></a>
				@endif
				@endif
				<hr>
				<a href="{{ route('tournaments.finallist', ['id' => $tournament->id] ) }}" >
				<span class="label label-default runde">{{ trans('messages.tournamentcreate.finallist') }}</span></a>
				@if (Auth::check())
				@if ($user->hasRole('Referee') || $user->hasRole('Author'))
				<a href="{{ route('tournaments.getfinal', ['id' => $tournament->id] ) }}">
				<span class="label label-default">{{ trans('messages.tournamentcreate.uploadfinallist') }}</span></a>
				@endif
				@endif
				<hr>
				<a href="{{ route('tournaments.elo', ['id' => $tournament->id] ) }}" >
				<span class="label label-default runde">{{ trans('messages.tournamentcreate.elovariation') }}</span></a>
				@if (Auth::check())
				@if ($user->hasRole('Referee') || $user->hasRole('Author'))
				<a href="{{ route('tournaments.getelo', ['id' => $tournament->id] ) }}" >
				<span class="label label-default">{{ trans('messages.tournamentcreate.uploadelovariation') }}</span>
				@endif
				@endif
			</div>
			<hr>
			<div class="round singleabout">	
				<a href="{{ route('tournamentgetregistered', ['id' => $tournament->id] ) }}" >
				<span class="label label-default runde">{{ trans('messages.tournamentcreate.viewregistered') }}</span></a>
			</div>
			<hr>
			<div class="round singleabout">	
				<a href="{{ route('tournamentimages', ['id' => $tournament->id] ) }}">
				<span class="label label-default runde">{{ trans('messages.tournamentcreate.viewphotos') }}</span></a>
				@if (Auth::check())
				@if ($user->hasRole('Referee') || $user->hasRole('Author'))
				<a href="{{ route('tournaments.getimages', ['id' => $tournament->id] ) }}" >
				<span class="label label-default">{{ trans('messages.tournamentcreate.uploadphotos') }}</span>
				</a>
				@endif
				@endif
			</div>
		</div>
		<hr>
		<div class="col-md-4">
			<div class="well form-spacing-top">
				<dl class="dl-horizontal">
					<label>Url: </label>
					<p><a href="{{ route('chessresult', $tournament->id) }}">{{ url($tournament->chesssite)  }}</a></p>
				</dl>
				<dl class="dl-horizontal">
					<label>{{ trans('messages.tournamentcreate.city') }}</label>
					<p>{{ $tournament->localit }}</p>
				</dl>
				<dl class="dl-horizontal">
					<label>Created at:</label>
					<p>{{ date('M j, Y G:i', strtotime($tournament->created_at)) }}</p>
				</dl>
				<dl class="dl-horizontal">
					<label>Last updated:</label>
					<p>{{ date('M j, Y G:i', strtotime($tournament->updated_at)) }}</p>
				</dl>
				<hr>
				@if (Auth::check())
				<div class="row">
					<div class="col-sm-6">
					@if ($user->hasRole('Referee') || $user->hasRole('Author'))
						{!! Html::linkRoute('tournaments.edit', 'Edit', array($tournament->id), array('class' =>'btn btn-primary btn-block')) !!}
					@endif	
					</div>
					<div class="col-sm-6">
					@if ($user->hasRole('Referee') || $user->hasRole('Author'))
						{!! Form::open(['route' => ['tournaments.destroy', $tournament->id], 'method' => 'DELETE', 'onsubmit' => 'return confirm("Delete ?")']) !!}
						{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}
						{!! Form::close() !!}
					@endif	
					</div>
				</div>
				@endif
				<br>
				<div class="row">
					<div class="col-sm-12">
						@if (Auth::check())
						{!! Html::linkRoute('tournaments.index', trans('messages.tournamentcreate.seeall'), [], array('class' =>'btn btn-blog btn-primary btn-block')) !!}
						@else
						{!! Html::linkRoute('tournamentguest', trans('messages.tournamentcreate.seeall'), [], array('class' =>'btn btn-blog btn-primary btn-block')) !!}
						@endif	
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection