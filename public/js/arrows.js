var cnv_id = '';
var cnv_idn = '';
//Draw arrows in the canvas with id from #cnv_id, between two clicks
function drawArrowCnv(cnv_id, cul){
///// // ////////////////////////////////////////////////////// canvas nr 1
 //From: http://coursesweb.net/javascript/
  //style: lw=line-width, lc=line-color, aw=arrow-width, al=arrow-length, ac=arrow-color
  var style = {lw:5, lc:cul, aw:18, al:22, ac:cul};
  var allow_draw =-1;  //if 1 allow to draw the arrow
 /* console.log(cnv_id);
console.log(cul);*/
  var cnv = document.getElementById(cnv_id);  //canvas elm.
  var cnv0 = {};  //cloned canvas to store initial canvas image /content
  var ctx = cnv.getContext('2d');  //canvas context
  var x, y = 0;  // variables that will contain the coordinates
  var clicks =0;  //for pair of clicks on canvas; 0 /1
  var last_clk = [0, 0];  //x,y coords of last click
  var nra =0;  //number of line-markers

  //set value of allow_draw
  this.allowDraw = function(){ allow_draw *=-1; }

  //return value of allow_draw
  this.letDraw = function(){ return allow_draw; }

  //to clone /copy canvas image /content
  function cloneCanvas(cnv){
    cnv.insertAdjacentHTML('afterend', '<canvas id="'+ cnv_id +'0" style="'+ cnv.getAttribute('style') +'" width="'+ cnv.width +'" height="'+ cnv.height +'"></canvas>');
    //create a new canvas
    var cnv0 = document.getElementById(cnv_id +'0');
    var cnt = cnv0.getContext('2d');

    //set dimensions, and hide it
    cnv0.width = cnv.width;
    cnv0.height = cnv.height;
    cnv0.style.display ='none';

    //apply the old canvas to the new one; return the new canvas
    cnt.drawImage(cnv, 0, 0);
    return cnv0;
  }

  //to get the initial canvas
  this.restoreCanvas = function(){
    cnv0.style.display ='block';  //show cloned canvas
    cnv.outerHTML ='';  //delete original canvas
    cnv0.id = cnv_id;  //set original id to cloned canvas
    /*  document.getElementById('btn_drawarialb').style.background = '#dadafb';
    document.getElementById('btn_drawarinegru').style.background = '#dadafb';*/
    drawAr = new drawArrowCnv(cnv_id);  //recreate the object to draw line-marker
    if(drawAr.letDraw() ==-1 && allow_draw ==1) drawAr.allowDraw();  //make allow_draw 1 if initialy is -1 and currently 1

  }

 
  // Get X and Y position of the elm
  function getXYpos(elm){
    x = elm.offsetLeft;  //set x to elm’s offsetLeft
    y = elm.offsetTop;  //set y to elm’s offsetTop

    elm = elm.offsetParent;  // set elm to its offsetParent

    //use while loop to check if elm is null, if not. add current elm’s offset to x/y
    //offsetTop to y and set elm to its offsetParent
    while(elm != null) {
      x = parseInt(x) + parseInt(elm.offsetLeft);
      y = parseInt(y) + parseInt(elm.offsetTop);
      elm = elm.offsetParent;
    }

    // returns an object with 'x' (Left), 'y' (Top) position
    return {'x':x, 'y':y};
  }

  //return array with click coords [x,y] in element $e
  function getCoords(e){
    var xy_pos = getXYpos(e.target);

    // if IE
    if(navigator.appVersion.indexOf('MSIE') !=-1) {
      //in some IE scrolling page affects mouse coordinates into an element
      //This gets the page element that will be used to add scrolling value to correct mouse coords
      var standardBody = (document.compatMode =='CSS1Compat') ? document.documentElement : document.body;

      x = event.clientX + standardBody.scrollLeft;
      y = event.clientY + standardBody.scrollTop;
    }
    else {
      x = e.pageX;
      y = e.pageY;
    }
    return [x - xy_pos['x'], y - xy_pos['y']];
  }

  //class to draw line with arrow head
  function Line(x1,y1,x2,y2){
    this.x1=x1;
    this.y1=y1;
    this.x2=x2;
    this.y2=y2;
  }
  //set arrow and add it with drawArrowhead, to the end of the line (x2/y2)
  Line.prototype.addArrowhead = function(ctx){
    // arbitrary styling
    ctx.strokeStyle = style.lc;
    ctx.fillStyle = style.ac;
    ctx.lineWidth = style.lw;

    // draw the line
    ctx.beginPath();
    ctx.moveTo(this.x1,this.y1);
    ctx.lineTo(this.x2,this.y2);
    ctx.stroke();

    // draw the ending arrowhead
    var endRadians = Math.atan((this.y2-this.y1)/(this.x2-this.x1));
    endRadians += ((this.x2>=this.x1)?90:-90)*Math.PI/180;
    this.drawArrowhead(ctx,this.x2,this.y2,endRadians);
  }
  //draw arrow to $x/$y coords
  Line.prototype.drawArrowhead = function(ctx,x,y,radians){
    ctx.save();
    ctx.beginPath();
    ctx.translate(x,y);
    ctx.rotate(radians);
    ctx.moveTo(0,0);
    ctx.lineTo(style.aw /2,style.al);
    ctx.lineTo(-style.aw /2,style.al);
    ctx.closePath();
    ctx.restore();
    ctx.fill();
  }

  //set object to draw the line-marker
  function drawArrow(e){
    //if $draw is 1, get x,y coords in element $e and draw arrow
    if(allow_draw ==1){
      var coords = getCoords(e);
      nra++;
      if(nra ==1) cnv0 = cloneCanvas(cnv);  //clone canvas when 1st arrow
      //if(nra ==1) cnv0n = cloneCanvas(cnvn);  //clone canvas when 1st arrow
      if (clicks != 1) clicks++;
      else {
        // create a new line object
        var line = new Line(last_clk[0],last_clk[1],coords[0],coords[1]);
        line.addArrowhead(ctx);  // draw the line and arrow

        clicks = 0;  //reset nr. clicks
      }

      last_clk = [coords[0],coords[1]];  //store last click coords
    }
  };

  //register click event to draw line-marker in canvas
  cnv.addEventListener('click', drawArrow, false);
}

function drawArrowCnvn(cnv_idn, cul){
//////    // ////////////////////////////////////////////////////// canvas nr 2
 //From: http://coursesweb.net/javascript/
  var style = {lw:5, lc:cul, aw:18, al:22, ac:cul};
  var allow_draw =-1;  //if 1 allow to draw the arrow
/* console.log(cnv_idn);
console.log(cul);*/
  var cnvn = document.getElementById(cnv_idn);  //canvas elm.
  var cnv0n = {};  //cloned canvas to store initial canvas image /content
  var ctx = cnvn.getContext('2d');  //canvas context
  var x, y = 0;  // variables that will contain the coordinates
  var clicks =0;  //for pair of clicks on canvas; 0 /1
  var last_clk = [0, 0];  //x,y coords of last click
  var nra =0;  //number of line-markers

  //set value of allow_draw
  this.allowDraw = function(){ allow_draw *=-1; }

  //return value of allow_draw
  this.letDraw = function(){ return allow_draw; }

  //to clone /copy canvas image /content
  function cloneCanvasn(cnvn){
    cnvn.insertAdjacentHTML('afterend', '<canvas id="'+ cnv_idn +'0" style="'+ cnvn.getAttribute('style') +'" width="'+ cnvn.width +'" height="'+ cnvn.height +'"></canvas>');
    //create a new canvas
    var cnv0n = document.getElementById(cnv_idn +'0');
    var cnt = cnv0n.getContext('2d');

    //set dimensions, and hide it
    cnv0n.width = cnvn.width;
    cnv0n.height = cnvn.height;
    cnv0n.style.display ='none';

    //apply the old canvas to the new one; return the new canvas
    cnt.drawImage(cnvn, 0, 0);
    return cnv0n;
  }

  //to get the initial canvas
   this.restoreCanvasn = function(){
    cnv0n.style.display ='block';  //show cloned canvas
    cnvn.outerHTML ='';  //delete original canvas
    cnv0n.id = cnv_idn;  //set original id to cloned canvas
    /*  document.getElementById('btn_drawarnalb').style.background = '#dadafb';
    document.getElementById('btn_drawarnnegru').style.background = '#dadafb';*/
    drawArn = new drawArrowCnvn(cnv_idn);  //recreate the object to draw line-marker
    if(drawArn.letDraw() ==-1 && allow_draw ==1) drawArn.allowDraw();  //make allow_draw 1 if initialy is -1 and currently 1
  }


  // Get X and Y position of the elm
  function getXYpos(elm){
    x = elm.offsetLeft;  //set x to elm’s offsetLeft
    y = elm.offsetTop;  //set y to elm’s offsetTop

    elm = elm.offsetParent;  // set elm to its offsetParent

    //use while loop to check if elm is null, if not. add current elm’s offset to x/y
    //offsetTop to y and set elm to its offsetParent
    while(elm != null) {
      x = parseInt(x) + parseInt(elm.offsetLeft);
      y = parseInt(y) + parseInt(elm.offsetTop);
      elm = elm.offsetParent;
    }

    // returns an object with 'x' (Left), 'y' (Top) position
    return {'x':x, 'y':y};
  }

  //return array with click coords [x,y] in element $e
  function getCoords(e){
    var xy_pos = getXYpos(e.target);

    // if IE
    if(navigator.appVersion.indexOf('MSIE') !=-1) {
      //in some IE scrolling page affects mouse coordinates into an element
      //This gets the page element that will be used to add scrolling value to correct mouse coords
      var standardBody = (document.compatMode =='CSS1Compat') ? document.documentElement : document.body;

      x = event.clientX + standardBody.scrollLeft;
      y = event.clientY + standardBody.scrollTop;
    }
    else {
      x = e.pageX;
      y = e.pageY;
    }
    return [x - xy_pos['x'], y - xy_pos['y']];
  }

  //class to draw line with arrow head
  function Line(x1,y1,x2,y2){
    this.x1=x1;
    this.y1=y1;
    this.x2=x2;
    this.y2=y2;
  }
  //set arrow and add it with drawArrowhead, to the end of the line (x2/y2)
  Line.prototype.addArrowhead = function(ctx){
    // arbitrary styling
    ctx.strokeStyle = style.lc;
    ctx.fillStyle = style.ac;
    ctx.lineWidth = style.lw;

    // draw the line
    ctx.beginPath();
    ctx.moveTo(this.x1,this.y1);
    ctx.lineTo(this.x2,this.y2);
    ctx.stroke();

    // draw the ending arrowhead
    var endRadians = Math.atan((this.y2-this.y1)/(this.x2-this.x1));
    endRadians += ((this.x2>=this.x1)?90:-90)*Math.PI/180;
    this.drawArrowhead(ctx,this.x2,this.y2,endRadians);
  }
  //draw arrow to $x/$y coords
  Line.prototype.drawArrowhead = function(ctx,x,y,radians){
    ctx.save();
    ctx.beginPath();
    ctx.translate(x,y);
    ctx.rotate(radians);
    ctx.moveTo(0,0);
    ctx.lineTo(style.aw /2,style.al);
    ctx.lineTo(-style.aw /2,style.al);
    ctx.closePath();
    ctx.restore();
    ctx.fill();
  }

  //set object to draw the line-marker
  function drawArrow(e){
    //if $draw is 1, get x,y coords in element $e and draw arrow
    if(allow_draw ==1){
      var coords = getCoords(e);
      nra++;
      if(nra ==1) cnv0n = cloneCanvasn(cnvn);  //clone canvas when 1st arrow

      if (clicks != 1) clicks++;
      else {
        // create a new line object
        var line = new Line(last_clk[0],last_clk[1],coords[0],coords[1]);
        line.addArrowhead(ctx);  // draw the line and arrow

        clicks = 0;  //reset nr. clicks
      }

      last_clk = [coords[0],coords[1]];  //store last click coords
    }
  };

  //register click event to draw line-marker in canvas
  cnvn.addEventListener('click', drawArrow, false);
}

// set object of drawArrowCnv class
var cul1 = 'red';
var cul2 = 'blue';
var culn1 = 'red';
var culn2 = 'blue';

var drawAr =0;
var drawArn =0;

//register click on #btn_drawar to enable /disable drawing action
var btn_drawarialb = document.getElementById('btn_drawarialb');
if(btn_drawarialb) btn_drawarialb.addEventListener('click', function(e){
  cnv_id = 'canvasboard';
  //if(drawAr ==0 && document.getElementById(cnv_id)) drawAr = new drawArrowCnv(cnv_id, cul1);
  drawAr = new drawArrowCnv(cnv_id, cul1);
  drawAr.allowDraw();
  e.target.style.background = (drawAr.letDraw() ==1) ? cul1 :'#dadafb';
  e.target.innerHTML = (drawAr.letDraw() ==1) ? 'Draw Initial' :'Draw Initial';
  
});
  var btn_drawarinegru = document.getElementById('btn_drawarinegru');
if(btn_drawarinegru) btn_drawarinegru.addEventListener('click', function(e){
  cnv_id = 'canvasboard';
  //if(drawAr ==0 && document.getElementById(cnv_id)) drawAr = new drawArrowCnv(cnv_id, cul2);
  drawAr = new drawArrowCnv(cnv_id, cul2);
  drawAr.allowDraw();
  e.target.style.background = (drawAr.letDraw() ==1) ? cul2 :'#dadafb';
  e.target.innerHTML = (drawAr.letDraw() ==1) ? 'Draw Initial' :'Draw Initial';
  
});
  var btn_drawarnalb = document.getElementById('btn_drawarnalb');
if(btn_drawarnalb) btn_drawarnalb.addEventListener('click', function(e){
  cnv_idn = 'canvasboardnou';
  //if(drawArn ==0 && document.getElementById(cnv_idn)) drawArn = new drawArrowCnvn(cnv_idn, culn1);
  drawArn = new drawArrowCnvn(cnv_idn, culn1);
  drawArn.allowDraw();
 
  e.target.style.background = (drawArn.letDraw() ==1) ? culn1 :'#dadafb';
  e.target.innerHTML = (drawArn.letDraw() ==1) ? 'Draw Final' :'Draw Final';
  
});
var btn_drawarnnegru = document.getElementById('btn_drawarnnegru');
if(btn_drawarnnegru) btn_drawarnnegru.addEventListener('click', function(e){
  cnv_idn = 'canvasboardnou';
  //if(drawArn ==0 && document.getElementById(cnv_idn)) drawArn = new drawArrowCnvn(cnv_idn, culn2);
  drawArn = new drawArrowCnvn(cnv_idn, culn2);
  drawArn.allowDraw();
 
  e.target.style.background = (drawArn.letDraw() ==1) ? culn2 :'#dadafb';
  e.target.innerHTML = (drawArn.letDraw() ==1) ? 'Draw Final' :'Draw Final';
  
});
//register click on #btn_delar to delete arrows
var btn_delari = document.getElementById('btn_delari');
if(btn_delari) btn_delari.addEventListener('click', function(e){
  if (drawAr){
  drawAr.restoreCanvas();
}
});

var btn_delarn = document.getElementById('btn_delarn');
if(btn_delarn) btn_delarn.addEventListener('click', function(e){
 if (drawArn){
  drawArn.restoreCanvasn();
}
});
//register click on #btn_getimgi to get canvas image
/* cnv_id = 'canvasboard';
  cnv_idn = 'canvasboardnou';

var btn_getimgi = document.getElementById('btn_getimgi');
btn_getimgi.addEventListener('click', function() {
//  this.href = document.getElementById(cnv_id).toDataURL();  //set link to canvas data
  var dia = document.getElementById(cnv_id).toDataURL("image/png", 1.0); 
  savepng(dia,'1');
 // this.download ='canvas_'+ cnv_id +'.jpg';  //return for download with an image name
});
var btn_getimgn = document.getElementById('btn_getimgn');
btn_getimgn.addEventListener('click', function() {
 //s this.href = document.getElementById(cnv_idn).toDataURL();  //set link to canvas data
    var dian = document.getElementById(cnv_idn).toDataURL("image/png", 1.0); 
  savepng(dian,'2');
//  this.download ='canvas_'+ cnv_idn +'.jpg';  //return for download with an image name
}); 
var btn_getimgm = document.getElementById('btn_getimgm');
var cnv_idm = 'canvaspegene';
btn_getimgm.addEventListener('click', function() {
 //s this.href = document.getElementById(cnv_idn).toDataURL();  //set link to canvas data
    var diam = document.getElementById(cnv_idm).toDataURL("image/png", 1.0); 
  savepng(diam,'3');
//  this.download ='canvas_'+ cnv_idn +'.jpg';  //return for download with an image name
}); 

function savepng(dia, flag) {
    var token = '{{ Session::token() }}';
     //var urlpgn = '{{ route('pgn') }}';
var url = 'http://localhost/basicapp/public';
 $.ajax({
        url: url+'/'+'pgn',
        method: 'POST',
        data: {dia: dia, flag: flag, _token: token}
      })
 .done(function (msg) {
        console.log(msg);
      });

 this.download ='canvas_'+ cnv_id +'.jpg';  //return for download with an image name
}*/