@extends('main')

@section('title', 'Diagrams')

@section('stylesheets')
{!! Html::style('css/parsley.css') !!}
{!! Html::style('css/select2.min.css') !!}
{!! Html::style('css/datepicker.css') !!}
{!! Html::style('css/chessboard.css') !!}
{!! Html::style('css/chess.css') !!}
{!! Html::style('css/style2.css') !!}
<style type="text/css">
  .highlight-white {
    -webkit-box-shadow: inset 0 0 3px 3px yellow;
    -moz-box-shadow: inset 0 0 3px 3px yellow;
    box-shadow: inset 0 0 3px 3px yellow;  
  }
  .highlight-black {
    -webkit-box-shadow: inset 0 0 3px 3px blue;
    -moz-box-shadow: inset 0 0 3px 3px blue;
    box-shadow: inset 0 0 3px 3px blue;  
  }
</style>
@endsection

@section('content')
<input type="hidden" id="fensir" value="">
<input type="hidden" id="idtactici" value="">
<input type="hidden" id="vari" value="">
<input type="hidden" id="temeid" value="">
<input type="hidden" id="temefen" value="">
<input type="hidden" id="temeexpl" value="">
<input type="hidden" id="idmutari" value="">
<input type="hidden" id="move_nr" value="">
<input type="hidden" id="atentionare" value="">
<input type="hidden" id="mat" value="">


<input type="hidden" id="alb" value="{{ trans('messages.diagrams.alb') }}">
<input type="hidden" id="negru" value="{{ trans('messages.diagrams.negru') }}">
<input type="hidden" id="egal" value="{{ trans('messages.diagrams.egal') }}">
<input type="hidden" id="albmuta" value="{{ trans('messages.diagrams.albmuta') }}">
<input type="hidden" id="negrumuta" value="{{ trans('messages.diagrams.negrumuta') }}">
<input type="hidden" id="albsah" value="{{ trans('messages.diagrams.albsah') }}">
<input type="hidden" id="negrusah" value="{{ trans('messages.diagrams.negrusah') }}">
<input type="hidden" id="albmat" value="{{ trans('messages.diagrams.albmat') }}">
<input type="hidden" id="negrumat" value="{{ trans('messages.diagrams.negrumat') }}">
<input type="hidden" id="estesah" value="{{ trans('messages.diagrams.estesah') }}">
<input type="hidden" id="estemat" value="{{ trans('messages.diagrams.estemat') }}">
<input type="hidden" id="stopjoc" value="{{ trans('messages.diagrams.stopjoc') }}">
<input type="hidden" id="remiza" value="{{ trans('messages.diagrams.remiza') }}">
<input type="hidden" id="muta" value="{{ trans('messages.diagrams.muta') }}">

<div class="row" >
  <div class="col-md-3" id="totul">
   <h2>{{ $course->tipcurs }} <small>{{ $course->id }}</small></h2>
   <p class="lead">{{ $course->datacurs }}</p>
   <hr>
   <div class="">
     @if (Auth::user()->hasRole('Teacher') || Auth::user()->hasRole('Author') || Auth::user()->hasRole('Admin'))
     <a href="#" onclick="coloreaza(this);  showBoardToNewMiddle(); createBoardToNew(); " id="start">
      <span id="spanid" class="label label-default diagrcurs">{{ trans('messages.diagrams.newposition') }}</span></a>
      @else
      <a href="#" onclick="coloreaza(this);  showBoardToNewMiddle(); createBoardToNew(); " id="start" style="display:none;">
        <span id="spanid" class="label label-default diagrcurs">{{ trans('messages.diagrams.newposition') }}</span style="display:none;"></a>
         @endif 

         <!-- <span id="ascuns" class="label label-default diagrcurs" style="display:none;color:red;">{{ trans('messages.diagrams.newposition') }}</span> -->

       </div>
       <hr> 
       <div class="diagrcurs">
         {{-- <a href="#"> --}}
         <a href="{{ route('courses.homework', ['id' => $course->id] ) }}">
           <span id="hm" class="label label-default diagrcurs"  onclick="togle()" style="color:lightgray;font-size:18px;">{{ trans('messages.diagrams.homework') }} </span></a>
            &nbsp;<a href="{{ route('courses.homeworkall', ['id' => $course->id] ) }}">
           <span id="hmall" class="label label-default diagrcurs"  style="color:lightgray;font-size:18px;">{{ trans('messages.diagrams.allhomework') }} </span></a>
         </div>
         <div id="tablehomework" class="col-md-12 table-responsive" style="height:300px; visibility: visible;">
          <table class="table">
            {{-- <tr><th>Diagrams</th></tr> --}}

<!-- 
      <div id="list_records">
     // it can be empty or you can put a loading gif file
</div>
<button id="demo" onclick="myFunction()">Refresh the list</button>
-->
<div id="mutariascunse" style="display:none;"> </div>
<input type="hidden" id="explic" >
<input type="hidden" id="feninitial" >
<input type="hidden" id="fenfinal" >
<input type="hidden" id="steag" value=1 >
{{-- <input type="hidden" id="user" > --}}
@if ($diagrams->count()>0)
@foreach ($diagrams as $diagram)
<input type="hidden" id="iddiagram" value="{{ $diagram->id }}">
<tr>
  <td>
    @if ($diagram->users()->where('user_id', $user->id)->where('diagram_id', $diagram->id)->get()->count()>0)
    <a href="#" style="color:red;" onclick="coloreazatema(this); ceremoves({{ $diagram->id }});" id="temacasa{{ $diagram->id }}">{{ $diagram->id }}- {{ $diagram->explicatii }}
    </a>
    @else
    <a href="#" style="color:black;" onclick="coloreazatema(this); ceremoves({{ $diagram->id }});" id="temacasa{{ $diagram->id }}">{{ $diagram->id }}- {{ $diagram->explicatii }}
    </a>
    @endif   
  </td>   
</tr>
@endforeach
@endif
</table>
</div>
<hr>
<div class="diagrcurs">
 <a href="{{ route('courses.solveddiagrams', ['id' => $course->id] ) }}">
  <span class="label label-default diagrcurs">{{ trans('messages.diagrams.solved') }}</span></a>
</div>
<hr>
<!-- <div class="diagrcurs">
 <a href="{{ route('gameeditor', ['id' => $course->id] ) }}">
  <span class="label label-default diagrcurs">Play! </span></a> 
</div> -->
<div class="diagrcurs">
 <a href="https://www.chesskid.com/puzzles/server.html">
  <span class="label label-default diagrcurs">Play! </span></a> 
</div>
{{ $course->gameeditor }}
<div class="diagrcurs">
  <!-- <a href="{{ route('gameplay', ['id' => $course->id] ) }}">
    <span class="label label-default diagrcurs">Play vs. computer </span></a><br> -->
     <a href="https://chess.com/play/computer">
    <span class="label label-default diagrcurs">Play vs. computer </span></a><br>
  </div>
  {{ $course->playcomp }}
  <br>
<div class="diagrcurs" style="float:left; display: inline; font-size:14px;">
   @if (Auth::check())
     <a href="{{ route('pgnviewer', ['id' => $course->id] ) }}">
    <span id="vezipgn" class="label label-default diagrcurs" style="float:left; display: inline; font-size:18px;">View PGN</span></a>
      @endif

   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ route('courses.solved', ['id' => $course->id] ) }}">
    <span class="label label-default diagrcurs" style="float:right; display: inline; font-size:18px;">Refresh</span></a>
  </div> 
   <hr>  
</div>  {{-- gata col md-3 --}}

{{-- incepe diagrama centru - - board --}}

<div class="col-md-5 grimijloc text-center" id="mijloc" style="height:790px; background-color: #CFB3B3;">
  <div class = "col-md-12" id="grup" style="display:none;"> 
   <div class="col-md-12 text-center" id="textajut1"> {{ trans('messages.diagrams.textajut1') }}</div>
   <div id="board" style="width:400px; height:450px;" ></div> 
   <div class="row" id="fendiv" style="background-color: #CFB3B3;">  
    <div class = "col-md-12" >
      <button id="startBtn" onclick="coloreaza(this); createBoardToNew(1);" >Start</button>
      <button id="clearBtn" onclick="coloreaza(this); createBoardToNew(2);">Clear</button>
      {{-- <button id="colorBtn" onclick="">Flip</button> --}}
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <button id="fenBtn" style="display:none;"></button>
      <button id="okBtn" onclick="afiseazaboard();" >Continue</button>  
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
      {{--  <form> --}}
      <input type="radio" id="w1" checked="checked" name="group1"  style="height: 20px; width: 20px;"/>{{ trans('messages.diagrams.alb') }} {{ trans('messages.diagrams.muta') }}
      <input type="radio" id="b1" name="group1" style="height: 20px; width: 20px;"/>{{ trans('messages.diagrams.negru') }} {{ trans('messages.diagrams.muta') }}
      {{--     </form> --}}
    </div>
    <div class="col-md-12 text-center">
      <input type="checkbox" id="w000" class="regular-checkbox" checked="checked" name="group2"  style="height: 20px; width: 20px;"/><label for="w000"></label>{{ trans('messages.diagrams.alb') }} O-O-O
      <input type="checkbox" id="b000" class="regular-checkbox" checked="checked" name="group3" style="height: 20px; width: 20px;"/><label for="b000"></label>{{ trans('messages.diagrams.negru') }} O-O-O
    </div>
    <div class="col-md-12 text-center">
      <input type="checkbox" class="regular-checkbox"  id="w00" checked="checked" name="group4"  style="height: 20px; width: 20px;"/><label for="w00"></label>{{ trans('messages.diagrams.alb') }} O-O
      <input type="checkbox" id="b00" class="regular-checkbox" checked="checked" name="group5"  style="height: 20px; width: 20px;"/><label for="b00"></label>{{ trans('messages.diagrams.negru') }} O-O
    </div>
    <div class="col-md-12 text-center">
      <label for="enpas"  >{{ trans('messages.diagrams.enpass') }}</label> &nbsp;
      <input type="text" size="5" id="enpas" name="enpas" /> &nbsp;&nbsp;
      <label for="m50"  >50 {{ trans('messages.diagrams.mutari') }}</label> &nbsp;
      <input type="text" size="5" id="m50" name="m50" /> 
    </div>
    <div id="fe" class="col-md-12 text-center">
     FEN:<input type="text" id="fenset" name="fenset" readonly="readonly" style="resize: none; width: 91%; "/>
     {{--  PGN:<textarea id="pgn" name="pgn" rows="5" cols="30"  style="width: 100%; display: none;"></textarea> --}}
   </div>  
 </div>
</div>
{{-- gata centru --}}

{{-- board nou a doua diagrana centru --}}
<div class="col-md-12 text-center" id="textajut2" style = "display:none;">{{ trans('messages.diagrams.textajut2') }}</div>

<div class="col-md-12 text-center" id="textajut4" style = "display:none;">{{ trans('messages.diagrams.rezolvadiagrama') }}</div>
<div class="col-md-6 text-right" id="imagineok" style = "visibility:hidden;"><img src="http://127.0.0.1/basicapp/public/background/check1.png"></div>
<div class="col-md-6 text-left" id="imaginerea" style = "visibility:hidden;"><img src="http://127.0.0.1/basicapp/public/background/x.png"></div>
<div class = "col-md-12" id="afisare" style="margin-top: 100px; display:none;">  

 <div class = "col-md-12" id="boardnou"  style="width:410px; height:500px;"></div> 
 {{-- <button id="savePGN" onclick="" style="font-size: 14px;" >{{ trans('messages.diagrams.savepgn') }}</button> --}}
 <div id="statusfen" class = "col-md-12 text-center">
 <!-- <label for="commentmove"  >{{ trans('messages.diagrams.commentmove') }}</label> &nbsp;
 <textarea rows="2" cols="80" id="commentmove" name="commentmove" style="width:90%;font-size: 18px;overflow:auto;"></textarea> -->
 <input type="text" id="status" name="status" readonly="readonly" style="width: 100%; text-align: center;"/>
<input type="text" id="fenmuta" name="fenmuta" readonly="readonly" style="width: 100%; "/>

</div>
</div>  
</div>

{{-- dreapta --}}
<div class="col-md-4 text-right sus" id="rightPart" style="display:none;">
  <div id="explicatii">
    <label for="expl"  >{{ trans('messages.diagrams.enunt') }} </label> &nbsp;
    <input type="text" class="form-control" id="expl" name="expl">

    <br>

  </div>
  <div id="mutari">
    <label for="pegene"  >{{ trans('messages.diagrams.mutari') }}</label> &nbsp;
    <textarea rows="12" cols="45" id="pegene" readonly="readonly" name="pegene" style="width:90%; font-size: 18px;overflow:auto;"></textarea>
    <br/><br/>
    <button id="saveBtn" onclick="savecanvas();" style="font-size: 18px;" >{{ trans('messages.diagrams.vezidiagrama') }}</button> 
     <label for="varim"  >{{ trans('messages.diagrams.coment') }}</label> &nbsp;
    <textarea rows="12" cols="45" id="varim" name="varim" style="width:90%; font-size: 18px;overflow:auto;"></textarea>
    {{-- <button id="savePng" onclick="savecanvaspng();" style="font-size: 18px;" >{{ trans('messages.diagrams.vezipng') }}</button>  --}}

  </div>
</div>
</div>

<div class="row jos" id="jepege" style="display:none; height:200px;">
 <div clas="col-md-4" id="sageti1" style="float:left;">
   <button id="btn_drawarialb">{{ trans('messages.diagrams.deseneazarosu') }}</button> 
   <button id="btn_drawarinegru">{{ trans('messages.diagrams.deseneazaalbastru') }}</button>
   <button id="btn_delari">{{ trans('messages.diagrams.stergedesen') }}</button>  &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
 </div>
 <div clas="col-md-4" id="sageti3" style="float:left;">
  <button id="btn_getimgi" title="Save in .PNG file" style="background-color:lightyellow;">{{ trans('messages.diagrams.salveazainitial') }}</button>
  <button id="btn_getimgn" title="Save in .PNG file" style="background-color:lightyellow;">{{ trans('messages.diagrams.salveazafinal') }}</button>
  <button id="btn_getimgm" title="Save in .PNG file" style="background-color:lightyellow;">{{ trans('messages.diagrams.salveazamutari') }}</button>
  &nbsp;&nbsp;&nbsp;<button id="back" onclick="back()" title="back" style="background-color:yellow;">Back</button>
</div>
<div clas="col-md-4" id="sageti2" style="float:right;">
  <button id="btn_drawarnalb">{{ trans('messages.diagrams.deseneazarosu') }}</button>
  <button id="btn_drawarnnegru">{{ trans('messages.diagrams.deseneazaalbastru') }}</button> 
  <button id="btn_delarn">{{ trans('messages.diagrams.stergedesen') }}</button> 
</div>
<hr>

{{-- form pentru salvarea mutarilor din diagrama la definire  --}}

<form id="formu" class="form-horizontal" action = "{{ route('courses.moves', ['id' => $course->id] ) }}" method="POST" style="text-align:center;margin-top:0; display:none;">
<div class="">
<input style="float:left;" type="checkbox" class="regular-checkbox form-control" id="cec" name="cec"/><label for="cec"></label>{{ trans('messages.diagrams.pgn') }}
<input style="float:left;" type="checkbox" checked="checked" class="regular-checkbox form-control" id="ceccasa" name="ceccasa"/><label for="ceccasa"></label>{{ trans('messages.diagrams.homew') }}
  <input type="hidden" id="movuri" name="movuri">
  <input type="hidden" id="comenturi" name="comenturi[]">
  <input type="hidden" id="pgnuri" name="pgnuri">
  <input type="hidden" id="albul" name="albul">
  <input type="hidden" id="clickuri" value="">
  <input type="hidden" id="explicatie" name="explicatie" >
  <input type="hidden" id="varimut" name="varimut" >
  <input type="hidden" id="idcurs" value="{{ $course->id }}" name="idcurs">
  </div>
  <br/>
  <input type="submit" class="btn btn-success" value="{{ trans('messages.diagrams.salveazadiagrama') }}" title="Save in database">
  {{ csrf_field() }}
</form>
</div>
<div id="diagrama1" style="display:none;"></div> 
<div id="diagrama2" style="display:none;"></div> 
<div id="diagrama5" style="display:none;"></div> 
<div id="diagrama6" style="display:none;"></div> 

<div class="col-md-12 text-center" id="textajut3"  style="display:none;">{{ trans('messages.diagrams.textajut3') }}<span style="font-weight:bold;">{{ trans('messages.diagrams.deseneaza') }}</span>{{ trans('messages.diagrams.textajut31') }} <br>
  <span style="font-weight:bold;">{{ trans('messages.diagrams.salveazainitial') }}</span> {{ trans('messages.diagrams.textajut32') }}
  <span style="font-weight:bold;">{{ trans('messages.diagrams.salveazafinal') }}</span> {{ trans('messages.diagrams.textajut33') }}<br>
  <span style="font-weight:bold;">{{ trans('messages.diagrams.salveazamutari') }}</span>{{ trans('messages.diagrams.textajut34') }}

  <span style="font-weight:bold;">{{ trans('messages.diagrams.salveazadiagrama') }}</span>{{ trans('messages.diagrams.textajut35') }}


</div>
<div id="diagrama3" style="display:none;"></div> 
</div>
</div>




@endsection

@section('scripts')
{!! Html::script('js/chess.js') !!}
{!! Html::script('js/chessboard.js') !!}
{!! Html::script('js/html2canvas.js') !!}
{!! Html::script('js/html2canvas.svg.js') !!}
{!! Html::script('js/jquery.plugin.html2canvas.js') !!}
{!! Html::script('js/jquery-uihttp.js') !!}
{!! Html::script('js/arrows.js') !!}
{!! Html::script('js/functii.js') !!}

{{-- {!! Html::script('//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js') !!} --}}

<script type="text/javascript">


  function myFunction() {

    $("#list_records").toggleClass( "csh_12" )
    $('#list_records').load('a-test');
  }
</script>


<script type="text/javascript">
  function togle(){
    if (document.getElementById("hm").style.color == 'lightgray'){
      document.getElementById("tablehomework").style.visibility = 'visible';
      document.getElementById("hm").style.color = 'white';
      //document.getElementById("spanid").style.display = 'none';   
      document.getElementById("mijloc").style.value = "visible";

    }
    else if (document.getElementById("hm").style.color == 'white'){
      document.getElementById("hm").style.color = 'lightgray';
      document.getElementById("tablehomework").style.visibility = 'hidden';
      //document.getElementById("spanid").style.display = 'block';

    }
  }
</script>

<script type="text/javascript">
  //$( document ).ready(function() {
    function ceremoves(id){
      //document.getElementById("spanid").style.display = 'none';
      document.getElementById("statusfen").style.display = 'none';
     
      var id = id;
      var token = '{{ Session::token() }}';
      var urlEdit = '{{ route('hWork') }}';

      $.ajax({
        //url: url+'/'+'hWork',
        method: 'POST',
        url: urlEdit,
        data: {id: id, _token: token}
      })
      .done(function (msg) {
        //console.log(msg);
        //console.log(JSON.stringify(msg));
        var mes = JSON.stringify(msg.mutaritema);
        $('#mutariascunse').text(mes);
        document.getElementById("expl").value = msg.explic;
        document.getElementById("feninitial").value = msg.feninitial;
        document.getElementById("fenfinal").value = msg.fenfinal;
        document.getElementById("varim").value = msg.body;
         //alert( $('#mutariascunse').text());
         afiseazaboardtemedecasa(id);
         
        /*$(msg).text(msg['new-post']);
        $('#edit-modal').modal('hide');*/
      });
    }
    
  </script>
  <script type="text/javascript">
  //$( document ).ready(function() {
    function solveDiagram(iddiagram, clickuri){
     var token = '{{ Session::token() }}';
     var urlSolve = '{{ route('solve') }}';

     $.ajax({
        //url: url+'/'+'hWork',
        method: 'POST',
        url: urlSolve,
        data: {iddiagram: iddiagram, clickuri: clickuri, _token: token}
      })
     .done(function (msg) {
        //console.log(msg);
      });
   }
   
 </script>



 <script>
  $( document ).ready(function() {
    var cnv_id = 'canvasboard';
    var  cnv_idn = 'canvasboardnou';
//var iddiagram = Math.floor((Math.random() * 100) + 1);

var btn_getimgi = document.getElementById('btn_getimgi');
btn_getimgi.addEventListener('click', function() {
//  this.href = document.getElementById(cnv_id).toDataURL();  //set link to canvas data
var iddiagram = document.getElementById('mat').value;
var dia = document.getElementById(cnv_id).toDataURL("image/png", 1.0); 
savepng(dia,'1', iddiagram);
 // this.download ='canvas_'+ cnv_id +'.jpg';  //return for download with an image name
});
var btn_getimgn = document.getElementById('btn_getimgn');
btn_getimgn.addEventListener('click', function() {
 //s this.href = document.getElementById(cnv_idn).toDataURL();  //set link to canvas data
 var iddiagram = document.getElementById('mat').value;
 var dian = document.getElementById(cnv_idn).toDataURL("image/png", 1.0); 
 savepng(dian,'2', iddiagram);
//  this.download ='canvas_'+ cnv_idn +'.jpg';  //return for download with an image name
}); 
var btn_getimgm = document.getElementById('btn_getimgm');
var cnv_idm = 'canvaspegene';
btn_getimgm.addEventListener('click', function() {
 //s this.href = document.getElementById(cnv_idn).toDataURL();  //set link to canvas data
 var iddiagram = document.getElementById('mat').value;
 var diam = document.getElementById(cnv_idm).toDataURL("image/png", 1.0); 
 savepng(diam,'3', iddiagram);
//  this.download ='canvas_'+ cnv_idn +'.jpg';  //return for download with an image name
}); 

function savepng(dia, flag, iddiagram) {
  var token = '{{ Session::token() }}';
     var urlpgn = '{{ route('pgn') }}';
     var curs = '{{ $course->id }}';
     //var iddiagram = document.getElementById('iddiagram').value;

     var url = 'http://localhost/basicapp/public';
     $.ajax({
     url: url+'/'+'pgn',
      method: 'POST',
      data: {dia: dia, flag: flag, curs: curs, iddiagram: iddiagram, _token: token}
    })
     .done(function (msg) {
      alert ("Salvat in C:/png/");
    })

     .fail(function() {
      alert( "Imosibil, nu exista C:/png" );
    });
  //this.download ='canvas_'+ cnv_id +'.jpg';  //return for download with an image name
}


});

  

</script>
@endsection