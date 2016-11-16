<HTML>
<HEAD>
<META NAME="description" content="LT-PGN-VIEWER 3.4 is a free JavaScript PGN Viewer ">
<META NAME="author" content="Lutz Tautenhahn">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<TITLE>LT-PGN-BOARD</TITLE>
<script language="JavaScript" src="ltpgnviewer.js"></script>
<style type='text/css'>
body {background-color:#EEEEEE;color:#000000 }
a {color:#000000; text-decoration: none}
a:hover {color:#FFFFFF; background-color:#808080}
td {text-align:left; vertical-align:top; font-size:10pt; font-family:Verdana; }
img {position:relative}
</style>
</HEAD>
<BODY leftmargin=10 topmargin=10 rightmargin=0 bottommargin=0>
<table border=0 cellpadding=0 cellspacing=0><tr><td>
<FORM name=BoardForm>

<TABLE border=0 cellpadding=1 cellspacing=0><TR>
<TD>Url:</TD>
<TH><input type=text name="Url" value="" size=30></TH>
<TD><select name="OpenParsePgn">
<option value=0>no parsing
<option value=1>ParsePgn=1
<option value=2>ParsePgn=2
<option value=3>ParsePgn=3
<option value=4>ParsePgn=4
</select></TD>
<TD><input type=button value="Open" onClick="javascript:OpenUrl('')"></TD>
</TR></TABLE>

<table border=0><tr><td>
<script language="JavaScript">
//SetImagePath("alpha30/");//use this function when your images are in another directory
EvalUrlString("SetImagePath");
ImageOffset=document.images.length;
var ii, ll=new Array(
"br","bn","bb","bq","bk","bb","bn","br",
"bp","bp","bp","bp","bp","bp","bp","bp",
"t","t","t","t","t","t","t","t",
"t","t","t","t","t","t","t","t",
"t","t","t","t","t","t","t","t",
"t","t","t","t","t","t","t","t",
"wp","wp","wp","wp","wp","wp","wp","wp",
"wr","wn","wb","wq","wk","wb","wn","wr");
var ImageStyle="";
if (ImagePath!="") SetBorder(0);
EvalUrlString("SetBorder");
if (Border)
{ if (document.layers) ImageStyle="border=1 ";
  else ImageStyle="style='border-width:"+Border+"px; border-style:solid; border-color:#404040;' ";
}
document.writeln("<table border=0 cellpadding=1 cellspacing=0><tr><td bgcolor=#404040>");
if (!document.layers) document.writeln("<div id='Board'>");
document.write("<TABLE border=0 cellpadding=0 cellspacing=0><TR>");
for (ii=0; ii<64; ii++)
{ if ((9*ii-ii%8)%16==0) document.write("<TD background='"+ImagePath+"w.gif'>");
  else document.write("<TD background='"+ImagePath+"b.gif'>");
  document.write("<IMG SRC='"+ImagePath+ll[ii]+".gif' "+ImageStyle+" id='"+ii+"' onMouseDown='BoardClick("+ii+")'></TD>");
  if (ii%8==7)
  { if (ii<63) document.write("</TR><TR>");
    else
    { document.writeln("</TR></TABLE>");
      if (!document.layers) document.writeln("</div><div id='Canvas' style='position:relative;z-index:100'></div>");
    }
  }    
}
document.writeln("</td><th><img name='RightLabels' src='"+ImagePath+"8_1.gif' onMouseDown='RotateBoard(! isRotated)' title='rotate board' alt='rotate board'></th></tr>");
document.writeln("<tr><th><img name='BottomLabels' src='"+ImagePath+"a_h.gif' onMouseDown='SetDragDrop(! isDragDrop)' title='piece animation on/off' alt='piece animation on/off'></th>");
document.writeln("<th><img src='"+ImagePath+"1x1.gif' width=7 height=7 border=1 onMouseDown='SwitchLabels()' title='show/hide labels' alt='show/hide labels'></th></tr></table>");
</script>

<TABLE border=0 cellpadding=1 cellspacing=0><TR>
<TD><input type=button value="I&lt;" width=21 style="width:25" id="btnInit" onClick="javascript:Init('')"></TD>
<TD><input type=button value="&lt;&lt;" width=21 style="width:25" id="btnMB10" onClick="javascript:MoveBack(10)"></TD>
<TD><input type=button value="&lt;" width=21 style="width:25" id="btnMB1" onClick="javascript:MoveBack(1)"></TD>
<TD><input type=button value="&gt;" width=21 style="width:25" id="btnMF1" onClick="javascript:MoveForward(1)"></TD>
<TD><input type=button value="&gt;&gt;" width=21 style="width:25" id="btnMF10" onClick="javascript:MoveForward(10)"></TD>
<TD><input type=button value="&gt;I" width=21 style="width:25" id="btnMF1000" onClick="javascript:MoveForward(1000)"></TD>
<TD><input type=button value="play" width=41 style="width:42" id="btnPlay" name="AutoPlay" onClick="javascript:SwitchAutoPlay()"></TD>
<TD><select name="Delay" onChange="SetDelay(this.options[selectedIndex].value)" SIZE=1>
<option value=1000>fast
<option value=2000>med.
<option value=3000>slow
</select>
</TD></TR></TABLE>
<BR>
<TABLE border=0 cellpadding=1 cellspacing=0><TR>
<TD>Position after:</TD>
<TH><input type=text name="Position" value="" id="inpPos" size=14></TH>
<TD><input type=button value="mate?" width=50 style="width:50" onClick="javascript:alert(IsMate())"></TD>
</TR></TABLE>
<BR>
<TABLE border=0 cellpadding=1 cellspacing=0><TR>
<TD><input type=checkbox name="DragDrop" value=1 onClick="javascript:SetDragDrop(this.checked)">drag&drop</TD>
<TD>&nbsp;</TD>
<TD><input type=button value="draw?" width=50 style="width:50" onClick="javascript:alert(IsDraw())"></TD>
<TD>&nbsp;</TD>
<TD><input type=button value="print" width=50 style="width:50" onClick="javascript:PrintPosition()"></TD>
<TD><input type=checkbox name="Pawns" onClick="RefreshBoard()">pawns</TD>
</TR></TABLE>
<BR>
<TABLE border=0 cellpadding=1 cellspacing=0><TR>
<TD><input type=checkbox name="Rotated" value=1 onClick="javascript:RotateBoard(this.checked)">rotate board</TD>
<TD><input type=checkbox name="Recording" value=1 onClick="javascript:AllowRecording(this.checked)">allow recording</TD>
<TD><input type=button name="Undo" value="undo" title="undo recorded moves" width=38 style="width:39" onClick="javascript:MoveBack(RecordCount)"></TD>
</TR></TABLE>
<BR>
<TABLE border=0 cellpadding=1 cellspacing=0><TR>
<TD><select onClick="javascript:document.BoardForm.CandidateMoveStyle.value=this.options[this.options.selectedIndex].value">
<option value="">candidate move style
<option value="AB">Arrow Blue
<option value="BR">Border Red
<option value="BG">Border Green
<option value="Cffff80">bgColor Yellow
<option value="">disabled
</select></TD>
<TD><input type=text name="CandidateMoveStyle" value="" size=4></TD>
<TD><input type=button value="Apply" onClick="javascript:SetCandidateStyle(document.BoardForm.CandidateMoveStyle.value);"></TD>
</TR></TABLE>
<BR>
<TABLE border=0 cellpadding=1 cellspacing=0><TR>
<TD>SAN:</TD>
<TH><input type=text name="SAN" value="KQRBNP" size=7></TH>
<TD><input type=button value="Apply" onClick="javascript:ApplySAN(document.BoardForm.SAN.value);"></TD>
<TH><input type=text name="NewSAN" value="KQRBNP" size=7></TH>
<TD><input type=button value="Show" onClick="javascript:ShowSAN(document.BoardForm.NewSAN.value);"></TD>
</TR></TABLE>
<BR>
<TABLE border=0 cellpadding=1 cellspacing=0><TR>
<TD><input type=button value="Setup Board" name="SetupBoard" style='width:100px' width=100 onClick="javascript:SwitchSetupBoard()"></TD>
<TD><input type=radio checked value="copy" name="BoardSetupMode" onClick="javascript:SetBoardSetupMode('copy')">copy</TD>
<TD><input type=radio value="move" name="BoardSetupMode" onClick="javascript:SetBoardSetupMode('move')">move</TD>
<TD><input type=radio value="delete" name="BoardSetupMode" onClick="javascript:SetBoardSetupMode('delete')">delete</TD>
</TR></TABLE>
<BR><small><b>Replace "header text" with text of your choice:</b></small><BR>
<textarea name="HeaderText" rows=3 cols=32 wrap=virtual>&lt;div style=\'height:360px;overflow:auto\'&gt;&lt;B&gt;header text&lt;/B&gt;&lt;BR&gt;&lt;BR&gt;</textarea>
</td>
<td valign=top>
<textarea name="PgnMoveText" rows=35 cols=13 wrap=virtual></textarea><br>
<input type=button value="Make Gamelink" style='width:120px' width=120 onClick="javascript:MakeGamelink()"><br>
<input type=button value="Make Puzzlelink" style='width:120px' width=120 onClick="javascript:MakePuzzle()"><br>
<input type="checkbox" name="EmailBlog">for email/blog
</td>
</tr></table>
<TABLE border=0 cellpadding=1 cellspacing=0><TR>
<TD>FEN:</TD>
<TH><input type=text name="FEN" value="rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1" size=34></TH>
<TD><input type=button value="Apply" onClick="javascript:ApplyFEN(document.BoardForm.FEN.value); Init('');"></TD>
<TD><input type=button value="Get" onClick="javascript:GetFEN()"></TD>
<TD><input type=button value="List" onClick="javascript:ShowFENList()"></TD>
</TR></TABLE>
<hr>
additional options for parsed pgn files:<br>
<TABLE border=0 cellpadding=1 cellspacing=1><TR><TD>
<select name=ScoreSheet>
<option value=0>pgn file layout
<option value=1>scoresheet 1 column
<option value=2>scoresheet 2 columns
</select>
</TD><TD>
<select name=ImagePath onChange="this.form.BGColor[this.options.selectedIndex].checked=1">
<option value="">images default
<option value="cases27|">images cases27
<option value="alpha30|">images alpha30
<option value="merida33|">images merida33
<option value="leipzig35|">images leipzig35
</select>
</TD><TD>
<select name=Border>
<option value="0">border=0
<option value="1" selected>border=1
<option value="2">border=2
</select>
</TD></TR></TABLE>
<TABLE border=1 cellpadding=0 cellspacing=0><TR><TD>
<span style='background-color:#E0C8A0'>&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="BGColor" value="E0C8A0" onClick="SetBGColor(this.value)">&nbsp;&nbsp;&nbsp;&nbsp;</span>
</TD><TD>
<span style='background-color:#EEEEEE'>&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="BGColor" value="EEEEEE" onClick="SetBGColor(this.value)">&nbsp;&nbsp;&nbsp;&nbsp;</span>
</TD><TD>
<span style='background-color:#F1E1E8'>&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="BGColor" value="F1E1E8" onClick="SetBGColor(this.value)">&nbsp;&nbsp;&nbsp;&nbsp;</span>
</TD><TD>
<span style='background-color:#E0E0F6'>&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="BGColor" value="E0E0F6" onClick="SetBGColor(this.value)">&nbsp;&nbsp;&nbsp;&nbsp;</span>
</TD><TD>
<span style='background-color:#EFE2D8'>&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="BGColor" value="EFE2D8" onClick="SetBGColor(this.value)">&nbsp;&nbsp;&nbsp;&nbsp;</span>
</TD><TD>
<span style='background-color:#EEEEEE'>&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="BGColor" value="EEEEEE" checked onClick="SetBGColor(this.value)">&nbsp;&nbsp;&nbsp;&nbsp;</span>
</TD></TR></TABLE>

</FORM>
<script language="JavaScript">
Init('');
EvalUrlString();
if ((ImagePath)&&(document.getElementById)) //adjust button size
{ var ii, nn=0, ss=0;
  for (ii=0; ii<ImagePath.length; ii++)
  { if (isNaN(ImagePath.charAt(ii))) nn=0;
    else { nn*=10; nn+=parseInt(ImagePath.charAt(ii)); ss=nn; }
  }
  if (ss>0)
  { if (ss>27) ss-=8;
    else ss=19;   
    document.getElementById("btnInit").style.width=ss+"px";
    document.getElementById("btnMB10").style.width=ss+"px";
    document.getElementById("btnMB1").style.width=ss+"px";
    document.getElementById("btnMF1").style.width=ss+"px";
    document.getElementById("btnMF10").style.width=ss+"px";
    document.getElementById("btnMF1000").style.width=ss+"px";
    document.getElementById("btnPlay").style.width=eval(2*ss-7)+"px";
    document.getElementById("inpPos").style.width=eval(4*ss)+"px";
  }
}
if (document.layers) setTimeout("RefreshBoard(true)",100);//for the old Netscape 4.7
</script>
</td></tr></table>
</BODY>
</HTML>