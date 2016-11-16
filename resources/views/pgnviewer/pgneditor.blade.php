@extends('main')

@section('title', 'Upload PGN')

@section('stylesheets')
{!! Html::style('css/ltpgnviewer.css') !!}
{!! Html::style('css/style2.css') !!}
@endsection

@section('content')
{!! Html::script('js/ltpgnviewer.js') !!}
{!! Html::script('js/ltpgnboard.js') !!}
<div class="row">
<HTML>
<HEAD>
<META NAME="author" content="Lutz Tautenhahn">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<TITLE>LT-PGN-EDITOR</TITLE>
<FRAMESET cols="450,*" border=1 frameborder=1 framespacing=1>
<frame src="pgnboard.html?AllowRecording=true" name="board" scrolling=auto>
<FRAMESET rows="254,*" border=1 frameborder=1 framespacing=1>
<frame src="pgneditor_input.html" name="pgninput" scrolling=auto>
<frame src="pgneditor_help.html" name="htmloutput" scrolling=auto>
</FRAMESET>
<NOFRAMES>
</HEAD>
<BODY>
</BODY>
</NOFRAMES>
</FRAMESET>
</HTML>
</div>
@endsection

@section('scripts')

<script type="text/javascript">

</script>
@endsection
