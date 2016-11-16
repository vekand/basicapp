function coloreaza(elm){  // pregateste obiectele
  var board = {};
document.getElementById('board').outerHTML ='<div id="board"></div>';  //reinitializeaza #board
elm.parentNode.style.background="#ccccff";
//console.log(document.getElementById('mutaritema').value);

}

function coloreazatema(elm){  // pregateste obiectele
 var boardnou = {};
document.getElementById('boardnou').outerHTML ='<div id="boardnou"></div>';  //reinitializeaza #board
elm.parentNode.style.background="#ccccff";
//elm.parentNode.style.background="red";
//elm.style.color = green;
/*var explicatii = document.getElementById("explic").value;
alert(explicatii);
document.getElementById("expl").value = explicatii;*/
}
////////////////////////////////////////////////////////////////////
function createBoardToNew(){  //deschide tabla noua 
  var board,
  game = new Chess(),
  statusEl = $('#status'),
  fenEl = $('#fen'),
  pgnEl = $('#pgn');


// do not pick up pieces if the game is over
// only pick up pieces for the side to move
var onDragStart = function(source, piece, position, orientation) {
  if (game.game_over() === true ||
    (game.turn() === 'w' && piece.search(/^b/) !== -1) ||
    (game.turn() === 'b' && piece.search(/^w/) !== -1)) {
    return false;
}
};

var board = new ChessBoard('board', cfg);
document.getElementById("fenset").value = '';

var onDrop = function(source, target) {
  // see if the move is legal
  var move = game.move({
    from: source,
    to: target,
    promotion: 'q'
  });

  // illegal move
  if (move === null) return 'snapback';

  updateStatus();

};

// update the board position after the piece snap 
// for castling, en passant, pawn promotion
var onSnapEnd = function() {
  board.position(game.fen());

};

var updateStatus = function() {
  var status = '';

  var moveColor = document.getElementById('alb').value;
  if (game.turn() === 'b') {
    moveColor = document.getElementById('negru').value;
  }

  // checkmate?
  if (game.in_checkmate() === true) {
    status = document.getElementById('stopjoc').value +', '+ moveColor + 
    document.getElementById('estemat').value;
  }

  // draw?
  else if (game.in_draw() === true) {
    status = document.getElementById('stopjoc').value +', '+
    document.getElementById('remiza').value;
  }

  // game still on
  else {
    status = moveColor +  document.getElementById('muta').value;

    // check?
    if (game.in_check() === true) {
      status += ', ' + moveColor +  document.getElementById('estesah').value;
    }
  }

  statusEl.val(status);
  fenEl.html(game.fen());
  //pgnEl.html(game.pgn());

};

var cfg = {
  //pieceTheme: 'http://www.willangles.com/projects/chessboard/img/chesspieces/wikipedia/{piece}.png',
  //pieceTheme: 'img/chesspieces/wikipedia/{piece}.png',
  snapbackSpeed: 550,
  appearSpeed: 1500,
  draggable: true,
  position: 'start',
  dropOffBoard: 'trash',
  sparePieces: true
};

board = new ChessBoard('board', cfg);
$(window).resize(board.resize);

updateStatus();

$('#startBtn').on('click', board.start);
$('#clearBtn').on('click', board.clear);
$('#colorBtn').on('click', board.flip);
$('#fenBtn').on('click', punefen);

function punefen(){ 
  document.getElementById('fenset').value = board.fen();
 // alert('FEN = '+document.getElementById('fenset').value);

}
} 

/////////////////////////  gata tabla nouaq /////////////////////////////////////////


function showBoardToNewMiddle(){  // afiseaza tabla completa
  document.getElementById("grup").style.display='block';
  //document.getElementById("rightPart").style.display='block';
}


//////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////

function afiseazaboard(){      // afiseaza tabla pentru mutari dupa click pe OK - construieste FEN


  var i=0; 
  var  mutari = [];
  var  comenturi = [];
  if (document.getElementById("w1").checked){
    document.getElementById("albul").value ="1";
  }
  else{
    document.getElementById("albul").value ="0";
  }
//var board = {document.getElementById('board')};
//if (explicatii =='') {return false;}


/*document.getElementById("afisare").outerHTML ='<div id="afisare"></div>';
document.getElementById('boardnou').outerHTML ='<div id="boardnou"></div>';  //reinitializeaza #board
*/

// document.getElementById("vezipgn").style.visibility = 'hidden';
document.getElementById("spanid").style.display = 'none';
//document.getElementById("commentmove").style.display='none';
//document.getElementById("ascuns").style.display='block';
document.getElementById("textajut2").style.display='block';
document.getElementById("rightPart").style.display='block';
document.getElementById('fenBtn').click(); 
var fen =  document.getElementById('fenset').value;
if (document.getElementById('w1').checked == true)
  {fen = fen.concat(' w ');}
else if (document.getElementById('b1').checked == true)
  {fen = fen.concat(' b ');}
if (document.getElementById('w00').checked == true)
  {fen=fen.concat('K');}
if (document.getElementById('w000').checked == true)
  {fen=fen.concat('Q');}
if (document.getElementById('b00').checked == true)
  {fen=fen.concat('k');}
if (document.getElementById('b000').checked == true)
  {fen=fen.concat('q');}
if (document.getElementById('w00').checked == false && document.getElementById('w000').checked == false 
  && document.getElementById('b00').checked == false && document.getElementById('b000').checked == false)
  {fen=fen.concat(' - ');}
var enp = document.getElementById('enpas').value;
if (enp.length > 0)
  {fen=fen.concat(' ');
fen=fen.concat(enp.trim());}
else {fen=fen.concat(' - ');}
var m = document.getElementById('m50').value;
if (m.length > 0)
  {fen=fen.concat(' ');
fen=fen.concat(m.trim());}
else {fen=fen.concat('0');}
fen=fen.concat(' 1');

document.getElementById("fenset").value = fen;

//////////// preluare in canvas diagrama de start initiala
var cfg = {
  position: fen,
  sparePieces: false
};

board = ChessBoard('board', cfg);

html2canvas( document.getElementById('board'), {
  onrendered: function(canvas) {
   canvas.id = "canvasboard";
   document.getElementById('diagrama1').appendChild(canvas);

 },
 width:450,
 height: 450
});
/*if(document.getElementById('canvasboard')){
  var canvas = document.getElementById('canvasboard');
  canvas.style.width='300px';
  canvas.style.height='300px';
}*/

document.getElementById("board").style.display = "none";
document.getElementById("textajut1").style.display = "none";
document.getElementById("fendiv").style.display = "none";
document.getElementById("afisare").style.display = "block";
document.getElementById("mutari").style.display = "block"; 



//document.getElementById("okTactici").style.display = "none"; 
///////////////////////////////////////////////
/////////////////////////////////////  

// do not pick up pieces if the game is over
// only pick up pieces for the side to move
var onDragStart = function(source, piece, position, orientation) {
  if (game.game_over() === true ||
    (game.turn() === 'w' && piece.search(/^b/) !== -1) ||
    (game.turn() === 'b' && piece.search(/^w/) !== -1)) {
    return false;
}
};

var onMoveEnd = function() {
  boardEl.find('.square-' + squareToHighlight)
  .addClass('highlight-' + colorToHighlight);
};


var onDrop = function(source, target, piece, newPos, oldPos, orientation) {

  // see if the move is legal
  var move = game.move({
    from: source,
    to: target,
    promotion: 'q' // NOTE: always promote to a queen for example simplicity
  });

  // illegal move
  if (move === null) return 'snapback';
  updateStatus();

};

// update the board position after the piece snap 
// for castling, en passant, pawn promotion
var onSnapEnd = function() {

  boardnou.position(game.fen());
  //  alert(game.pgn());
};


var onDragMove = function(newLocation, oldLocation, source,
  piece, position, orientation) {
  /*console.log("New location: " + newLocation);
  console.log("Old location: " + oldLocation);
  console.log("Source: " + source);
  console.log("Piece: " + piece);
  console.log("Position: " + ChessBoard.objToFen(position));
  console.log("Orientation: " + orientation);
  console.log("--------------------");*/
};
//////////////
var updateStatus = function() {

  var status = '';
  if (game.turn() === 'b') {
   moveside = 'White';
   moveColor = document.getElementById("negru").value; 
 }
 if (game.turn() === 'w') {
   moveside = 'Black';
   moveColor = document.getElementById("alb").value; 
 }

  // checkmate?
  if (game.in_checkmate() === true) {
   var stopjoc = document.getElementById("stopjoc").value; 
   var estemat = document.getElementById("estemat").value;    
   status = stopjoc+' '+ moveColor +' '+ estemat;
 }

  // draw?
  else if (game.in_draw() === true) {
    var remiza = document.getElementById("remiza").value;   
    status = remiza;
  }

  // game still on
  else {
    var muta = document.getElementById("muta").value;    
    status = moveColor +' '+muta;

    // check?
    if (game.in_check() === true) {
      var estesah = document.getElementById("estesah").value; 
      status += ', ' + moveColor +' '+ estesah;
    }
  }
  var x = game.pgn();
  var x1 = x.replace(/\[.*?\]\s?/g, '');
  statusEl.val(status);
fenEl.val(game.fen()); // textbox
pgnEl.html(x1);  // textarea

/*alert(game.fen());
alert(x1);*/
document.getElementById('fenmuta').value = game.fen();
document.getElementById('fenmuta').setAttribute("title", game.fen());

savemutari(mutari, game.fen(), moveside, x1);

  //i=i+1;
};
//alert(fen);
var cfg = {
  //pieceTheme: 'http://www.willangles.com/projects/chessboard/img/chesspieces/wikipedia/{piece}.png',
  //pieceTheme: 'img/chesspieces/wikipedia/{piece}.png',
  draggable: true,
  position: fen,
  onDragStart: onDragStart,
  onDrop: onDrop,
  onDragMove: onDragMove,
  onSnapEnd: onSnapEnd,
  onMoveEnd: onMoveEnd
};
var boardnou,
game = new Chess(fen),
statusEl = $('#status'),
fenEl = $('#fenmuta'),
pgnEl = $('#pegene'),
squareClass = 'square-55d63',
squareToHighlight,
colorToHighlight;

boardnou = ChessBoard('boardnou', cfg);
$(window).resize(boardnou.resize);

updateStatus();

//savemutari(fenEl.html(), 'nou');

}

///////////////////// gata tabla cu mutari   ////////////////

////////////////////////////// pune in canvas

function savecanvas() {   // pune in canvas cele 2 diagrame plus caseta cu mutarile si le deschide

  var iddiagram = Math.floor((Math.random() * 100) + 1);
  document.getElementById('mat').value = iddiagram;
  var explicatii = document.getElementById("expl").value;
  document.getElementById('explicatie').value = explicatii;
  var varimut = document.getElementById("varim").value;
  document.getElementById('varimut').value = varimut;
  if ( document.getElementById('expl').value ==''){
    alert('Nu ati completat Enuntul ! There is no Definition !');
    return false;
  }
  var explicatii = document.getElementById('expl').value;
  document.getElementById('explicatii').value = explicatii;
  html2canvas(document.getElementById('boardnou'), {
    onrendered: function(canvas) {
      canvas.id = "canvasboardnou";
      document.getElementById('diagrama2').appendChild(canvas);
    },
    //proxy: 'http://localhost/basicapp/public/background/chesspieces/wikipedia/{piece}.png',
    width:450,
    height: 450
  });

  html2canvas( document.getElementById('pegene'), {
    onrendered: function(canvas) {
      canvas.id = "canvaspegene";
      document.getElementById('diagrama3').appendChild(canvas);
      //document.querySelector('#diagrama #pegene').id ='pg';  //schimba id
    }
  });

  document.getElementById("totul").style.display = "none";
  document.getElementById("mijloc").style.display = "none";
  document.getElementById("afisare").style.display = "none";
  document.getElementById("rightPart").style.display = "none";

  document.getElementById("jepege").style.display = "block";
  document.getElementById("diagrama1").style.display = "block"; 
  document.getElementById("diagrama3").style.display = "block";
  document.getElementById("diagrama2").style.display = "block";
  document.getElementById("formu").style.display = "block";

  document.getElementById("textajut3").style.display = "block";
} 
function back() {

  html2canvas(document.getElementById('boardnou'), {
    onrendered: function(canvas) {
      canvas.id = "canvasboardnou";
      document.getElementById('diagrama2').innerHTML = '';
    }
  });

  html2canvas( document.getElementById('pegene'), {
    onrendered: function(canvas) {
      canvas.id = "canvaspegene";
      document.getElementById('diagrama3').innerHTML = '';
      //document.querySelector('#diagrama #pegene').id ='pg';  //schimba id
    }
  }); 

  document.getElementById("totul").style.display = "block";
  document.getElementById("mijloc").style.display = "block";
  document.getElementById("afisare").style.display = "block";
  document.getElementById("rightPart").style.display = "block";

  document.getElementById("jepege").style.display = "none";
  document.getElementById("diagrama1").style.display = "none"; 
  document.getElementById("diagrama3").style.display = "none";
  document.getElementById("diagrama2").style.display = "none";
  document.getElementById("formu").style.display = "none";

  document.getElementById("textajut3").style.display = "none";
}
////////////////////////// salveaza Diagrama si Mutarile in Baza de date
function savecanvaspng() {   // pune in canvas cele 2 diagrame plus caseta cu mutarile si le deschide

  /*var explicatii = document.getElementById("expl").value;
  document.getElementById('explicatie').value = explicatii;

  if ( document.getElementById('expl').value ==''){
    alert('Nu ati completat Enuntul ! There is no Definition !');
    return false;
  }*/
  var explicatii = document.getElementById('expl').value;
  document.getElementById('explicatii').value = explicatii;
  html2canvas(document.getElementById('boardnou'), {
    onrendered: function(canvas) {
      canvas.id = "canvaspnn1";
      document.getElementById('diagrama5').appendChild(canvas);
    },
    width:450,
    height: 450
  });

  html2canvas( document.getElementById('pegene'), {
    onrendered: function(canvas) {
      canvas.id = "canvaspng2";
      document.getElementById('diagrama6').appendChild(canvas);
      //document.querySelector('#diagrama #pegene').id ='pg';  //schimba id
    }
  });

 /* document.getElementById("totul").style.display = "none";
  document.getElementById("mijloc").style.display = "none";
  document.getElementById("afisare").style.display = "none";
  document.getElementById("rightPart").style.display = "none";*/

  //document.getElementById("jepege").style.display = "block";
  document.getElementById("diagrama5").style.display = "block"; 
  document.getElementById("diagrama6").style.display = "block";
  //document.getElementById("formu").style.display = "block";

  //document.getElementById("textajut3").style.display = "block";
} 
/////////////////////////////////////////////////////////////////////////////////////////////////

function savemutari(mutari, fen, moveside, pgnuri) {   // salveaza in tabela mutari fiecare mutare
  mutari.push(moveside+'?_?'+fen );
//document.getElementById('movuri').value = JSON.stringify(mutari);
document.getElementById('movuri').value = mutari;
//document.getElementById('comenturi').value = comenturi;
//document.getElementById('comenturi').value = comenturi;
document.getElementById('pgnuri').value = pgnuri;
//console.log(mutari.length);
//console.log(JSON.stringify(mutari));
/*var explicatii = document.getElementById('expl').value;
document.getElementById('explicatie').value = explicatii;*/
//console.log(document.getElementById('explicatie').value);
//return false;

//var fenmu = document.getElementById('fenmuta').value; // fen dupa fiecare mutare  
var idcurs = document.getElementById('idcurs').value; // idcurs


} 

/////////////////////////////////////////////////









function afiseazaboardtemedecasa(id){      // afiseaza teme de casa


 var mutaritema = $('#mutariascunse').text();
 var jsonData = JSON.parse(mutaritema);
//alert($('#mutariascunse').text());
//console.log($('#mutariascunse').text());

var j=1; 
var  mutari = [];
var  comenturi = [];
document.getElementById("steag").value = 1;

if (document.getElementById("w1").checked){
  document.getElementById("albul").value ="1";
}
else{
  document.getElementById("albul").value ="0";
}
//console.log(key);
document.getElementById("statusfen").style.display = 'block';

//document.getElementById("spanid").style.color='red';
document.getElementById("varim").readOnly = true;
document.getElementById("textajut1").style.display='none';
document.getElementById("textajut2").style.display='none';
document.getElementById("textajut3").style.display='none';
document.getElementById("textajut4").style.display='block';
document.getElementById("saveBtn").style.display='none';
//document.getElementById("ascuns").style.display='block';
document.getElementById("imaginerea").style.display='block';
document.getElementById("rightPart").style.display='block';

document.getElementById("imaginerea").style.visibility = "hidden"; 
document.getElementById("imagineok").style.visibility = "hidden"; 
//document.getElementById("vezipgn").style.visibility = "hidden"; 

document.getElementById("board").style.display = "none";
document.getElementById("fendiv").style.display = "none";
document.getElementById("afisare").style.display = "block";
document.getElementById("mutari").style.display = "block"; 
document.getElementById('fenBtn').click(); 

var fen =  document.getElementById("feninitial").value;
var fenfinal =  document.getElementById("fenfinal").value;
//////////// preluare in canvas diagrama de start initiala

//document.getElementById("okTactici").style.display = "none"; 
///////////////////////////////////////////////
/////////////////////////////////////  

// do not pick up pieces if the game is over
// only pick up pieces for the side to move
var onDragStart = function(source, piece, position, orientation) {
  if (game.game_over() === true ||
    (game.turn() === 'w' && piece.search(/^b/) !== -1) ||
    (game.turn() === 'b' && piece.search(/^w/) !== -1)) {
    return false;
}
};

var onMoveEnd = function() {
  boardEl.find('.square-' + squareToHighlight)
  .addClass('highlight-' + colorToHighlight);
};


var onDrop = function(source, target, piece, newPos, oldPos, orientation) {

  // see if the move is legal
  var move = game.move({
    from: source,
    to: target,
    promotion: 'q' // NOTE: always promote to a queen for example simplicity
  });

  // illegal move
  if (move === null) return 'snapback';
  updateStatus();
  comparafen( j, moveside, game.fen(), id);
  if (moveside == 'Black' || moveside == 'Negru') {j++;}

};

// update the board position after the piece snap 
// for castling, en passant, pawn promotion
var onSnapEnd = function() {

  boardnou.position(game.fen());
  //  alert(game.pgn());
};


var onDragMove = function(newLocation, oldLocation, source,
  piece, position, orientation) {
  /*console.log("New location: " + newLocation);
  console.log("Old location: " + oldLocation);
  console.log("Source: " + source);
  console.log("Piece: " + piece);
  console.log("Position: " + ChessBoard.objToFen(position));
  console.log("Orientation: " + orientation);
  console.log("--------------------");*/
};
//////////////
var updateStatus = function() {

  var status = '';
  if (game.turn() === 'b') {
   moveside = 'White';
   moveColor = document.getElementById("negru").value; 
 }
 if (game.turn() === 'w') {
   moveside = 'Black';
   moveColor = document.getElementById("alb").value; 
 }

  // checkmate?
  if (game.in_checkmate() === true) {
   var stopjoc = document.getElementById("stopjoc").value; 
   var estemat = document.getElementById("estemat").value;    
   status = stopjoc +' '+ moveColor +' '+ estemat; 
 }

  // draw?
  else if (game.in_draw() === true) {
    var remiza = document.getElementById("remiza").value;   
    status = remiza;
  }

  // game still on
  else {
    var muta = document.getElementById("muta").value;    
    status = moveColor +' '+ muta;

    // check?
    if (game.in_check() === true) {
      var estesah = document.getElementById("estesah").value; 
      status += ', ' + moveColor +' '+ estesah;
    }
  }
  var x = game.pgn();
  var x1 = x.replace(/\[.*?\]\s?/g, '');
  statusEl.val(status);
fenEl.val(game.fen()); // textbox
pgnEl.html(x1);  // textarea

/*alert(game.fen());
alert(x1);*/
document.getElementById('fenmuta').value = game.fen();
document.getElementById('fenmuta').setAttribute("title", game.fen());
 //savemutari(mutari, game.fen(), moveside);

  //i=i+1;
};
//alert(fen);
var cfg = {
  //pieceTheme: 'http://www.willangles.com/projects/chessboard/img/chesspieces/wikipedia/{piece}.png',
  //pieceTheme: 'img/chesspieces/wikipedia/{piece}.png',
  draggable: true,
  position: fen,
  onDragStart: onDragStart,
  onDrop: onDrop,
  onDragMove: onDragMove,
  onSnapEnd: onSnapEnd,
  onMoveEnd: onMoveEnd
};
var boardnou,
game = new Chess(fen),
statusEl = $('#status'),
fenEl = $('#fenmuta'),
pgnEl = $('#pegene'),
squareClass = 'square-55d63',
squareToHighlight,
colorToHighlight;

boardnou = ChessBoard('boardnou', cfg);
$(window).resize(boardnou.resize);

updateStatus();

//savemutari(fenEl.html(), 'nou');



///////////////////////////////////////////////////////////////////////////////////
   function puneclickuri(clickuri){
     /*var token = '{{ Session::token() }}';
     var urlClick = '{{ route('solve') }}';*/
    var token = '';
    var urlClick = '';
     $.ajax({
        //url: url+'/'+'hWork',
        method: 'POST',
        url: urlClick,
        data: {clickuri: clickuri, _token: token}
      })
     .done(function (msg) {
        //console.log(msg);
      });
   }
/////////////////////////////////////////////////////////////////

function comparafen(numar, culoare, fen, id){ 
  var fenfinal = document.getElementById("fenfinal").value;
  var clickuri = document.getElementById("clickuri").value;
  clickuri++;
  document.getElementById("clickuri").value = clickuri;
  //puneclickuri(clickuri);
 //console.log(numar);
// console.log(culoare);
 //console.log(fen);

 for (var i = 0; i < jsonData.length; i++) {
  if (jsonData[i].mutare == numar){
    if (culoare=='White' || culoare=='Alb'){
      console.log(jsonData[i].mutarefena);
      console.log(fen);

      if(jsonData[i].mutarefena == fen) {
       // alert('bine');
       document.getElementById("imaginerea").style.visibility = "hidden"; 
       document.getElementById("imagineok").style.visibility = "visible"; 
       if (fen == fenfinal && document.getElementById("steag").value == 1 ){ 
        if (confirm('Rezolvat! Marcati rezolvarea in Baza de date?\nSolved! Do you want to commit in the database?') == true)
        {
          var iddiagrama = id;
              //var user = document.getElementById("user").value;
              solveDiagram(iddiagrama, clickuri);
              return true;
            }
            else {
              return false;
            }
          }
          break;
        }
        else {
        //alert('rau'); 
        document.getElementById("imagineok").style.visibility = "hidden"; 
        document.getElementById("imaginerea").style.visibility = "visible"; 
        document.getElementById("steag").value = 0 ;
        break;
      }
    }
    if (culoare=='Black' || culoare == 'Negru'){
      console.log(jsonData[i].mutarefenn);
      console.log(fen);
      if(jsonData[i].mutarefenn == fen) {
        //alert('bine'); 
        document.getElementById("imaginerea").style.visibility = "hidden"; 
        document.getElementById("imagineok").style.visibility = "visible"; 
        if (fen == fenfinal  && document.getElementById("steag").value == 1 ){ 
          if (confirm('Rezolvat! Marcati rezolvarea in Baza de date?\nSolved! Do you want to commit in the database?') == true)
          {
            var iddiagrama = id;
              //var user = document.getElementById("user").value;
              solveDiagram(iddiagrama, clickuri);
              return true;
            }
            else {
              return false;
            }
          }
          break;
        }
        else {
        //alert('rau'); 
        document.getElementById("imagineok").style.visibility = "hidden"; 
        document.getElementById("imaginerea").style.visibility = "visible";
        document.getElementById("steag").value = 0 ; 
        break;}
      }
    }
  }
}

}
////////////////////////////////////////////////////////////////////////////////////////////////////////////

function temecasa(e){         // afiseaza tabla pentru mutari dupa onclick pe Homework
  document.getElementById("fe").style.display = "none";
  document.getElementById("afisare").style.display = "none";
  document.getElementById("mutari").style.display = "none"; 
  document.getElementById('savePos').style.display="none";
  document.getElementById('rezolvat').style.display="none";
  document.getElementById("okTactici").style.display = "none"; 
  document.getElementById('okPos').style.display="block";
  var e  = e;
  var x = e.split("_?_", 3);
  var homeid = x[0];
  var homefen = x[1];
  var homeexpl = x[2];
//alert(homeid);
document.getElementById('expl').value = homeexpl;
document.getElementById('grup').style.display='block';
document.getElementById('explicatii').style.display='block';
//document.getElementById('afisare').style.display="none";
//document.getElementById('mutari').style.display="none";
board = ChessBoard('board', {
  draggable: true,
  position: homefen,
  dropOffBoard: 'trash',
  sparePieces: true
});
$('#startBtn').on('click', board.start);
$('#clearBtn').on('click', board.clear);
$('#okBtn').on('click', punefenu);

function punefenu(){  
  document.getElementById('fenset').value = board.fen();
  //alert('FEN = '+document.getElementById('fenset').value);
}

var data_json = {
  "homeid" : homeid
};  

my_ajax4Te("verificateme.php", data_json, "post");
function my_ajax4Te(phpfile, data_json, type) {
  $.ajax({
    async : false,
    type : type,
    url : phpfile,
    data : data_json,
    success : function(msg) {
    //alert(msg);
    if (msg != '[]') {
      alert("Already solved!!! Este deja rezolvat!!!".concat("\n").concat("\n").concat(msg));
      document.getElementById('okPos').style.display="none";
    }
    //document.write(msg);
  }
});
}

}

