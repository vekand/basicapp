@extends('main')

@section('title', 'Pgn')

@section('stylesheets')
{!! Html::style('css/ltpgnviewer.css') !!}
{!! Html::style('css/style2.css') !!}
@endsection

@section('content')
{!! Html::script('js/ltpgnviewer.js') !!}
{!! Html::script('js/ltpgnboard.js') !!}
<div class="row">
	<div class="col-md-12">
	@if ($pegeneu)
		<input type="hidden" id="pg" value="{{ $pegeneu->body }}">
		<input type="hidden" id="fen" value="{{ $pegeneu->feninitial }}">
		<input type="hidden" id="wh" value="{{ $pegeneu->whiteu.' - '.$pegeneu->blacku }}">
		<input type="hidden" id="re" value="{{ $pegeneu->resultu }}">
		<input type="hidden" id="we" value="White Elo: {{ $pegeneu->whiteelo }}  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   Black Elo: {{ $pegeneu->blackelo }}  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  {{ $pegeneu->roundu }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $pegeneu->dateu }} ">
		<input type="hidden" id="da" value="{{ $pegeneu->eventu.' - '.$pegeneu->siteu }}">
	@else	
		<input type="hidden" id="pg" value="">
		<input type="hidden" id="wh" value="">
		<input type="hidden" id="re" value="">
		<input type="hidden" id="we" value="">
		<input type="hidden" id="da" value="">
		<input type="hidden" id="fen" value="">
	@endif
	</div>
</div>
<div class="row">	
<div class="col-md-12 ">
	<script language="JavaScript">
		document.writeln("<table border=0><tr><td><FORM name=BoardForm><table border=0><tr><td>");
		EvalUrlString("SetBGColor");
		if ((BGColor!="")&&(document.getElementsByTagName)) document.getElementsByTagName('BODY')[0].style.backgroundColor=BGColor;
		EvalUrlString("SetImagePath");
		if (ImagePath!="") SetBorder(0);
		EvalUrlString("SetBorder");
		EvalUrlString("SetBorderColor");
		WriteBoard(1);
		WriteButtons();
		WritePosition();
		document.writeln("</td></tr></table></FORM>");
		Init(document.getElementById('fen').value);
		AllowRecording(true);
//EvalUrlString();
//write the following with ASP or PHP depending on your data from a database:
RotateBoard(false);
ApplyPgnMoveText(document.getElementById('pg').value);
AddText("</td><td style='color:blue;'>"+"<H4>"
	+document.getElementById('wh').value+"<br/>"
	+document.getElementById('re').value+"<br/>"
	+document.getElementById('we').value+"<br/>"
	+document.getElementById('da').value+
	"</H4>"+GetHTMLMoveText(0,0,1));
document.writeln("</td></tr></table>");
setTimeout('RefreshBoard(true)',1000);
if (window.event) document.captureEvents(Event.KEYDOWN);
document.onkeydown = KeyDown;
</script>
</div>
<div class="row">	
<div class="col-md-12 ">
@if ($pegeneu)
<textarea id="pgnv" name="pgnv" rows="4"  style="width: 100%;">{{ $pegeneu->comment }}</textarea>
@else
<textarea id="pgnv" name="pgnv" rows="4"  style="width: 100%;"></textarea>
@endif
</div>
</div>
</div>
<div class="row">	
<div class="col-md-12 jos">
	<div class="diagrcurs sus text-right">
	<a href="{{ route('pgnedit', $course->id) }}">
		<span id="hm" class="label label-default diagrcurs"  style="float: left; color:lightgray;">{{ trans('messages.courses.addpgn') }} </span></a>
<a href="{{ route('numaicurs', ['id' => $course->id] ) }}">
   <button id="cecu" style="float: left;">{{ trans('messages.diagrams.cec') }}</button></a> 

		<a href="pgneditor.html">
			<span id="editorpgn" class="label label-default diagrcurs"  style="float: right; color:lightgray;">{{ trans('messages.courses.createpgn') }} </span></a>

	
	</div>


		{!! Form::open(array('route' => ['pgnretrieve', $course->id], 'method' => 'GET')) !!}
		{{-- <input type="checkbox" class="regular-checkbox" id="cec" name="cec"/><label for="cec"></label>{{ trans('messages.diagrams.cec') }} --}}
	<hr>
		{{ Form::label('pegen', 'View PGN:') }}	
		<select class="form-control" name="pegene" style="font-weight:bold; font-family: 'Verdana';">
			@foreach ($pgns as $pgn)
			@if ($pegeneu)
			@if ($pegeneu->id == $pgn->id)
			<option value="{{ $pgn->id }}" selected="selected" style="font-weight:bold; font-family: 'Verdana';">{{ $pgn->whiteu.' - '.$pgn->blacku.' = '.$pgn->resultu.' - '.$pgn->eventu.' - '.$pgn->siteu }}</option> 
			@else
			<option value="{{ $pgn->id }}" style="font-weight:bold; font-family: 'Verdana';">{{ $pgn->whiteu.' - '.$pgn->blacku.' = '.$pgn->resultu.' - '.$pgn->eventu.' - '.$pgn->siteu }}</option> 
			@endif
			@endif
			@endforeach
		</select>
		{{ Form::submit('View PGN', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}

		{!! Form::close() !!}		
		

	</div>

</div>
@endsection

@section('scripts')

<script type="text/javascript">
</script>
<script type="text/javascript">

</script>
@endsection