<HTML>
<HEAD>
<META NAME="author" content="Lutz Tautenhahn">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<style type='text/css'>
td { font-size:10pt;font-family:Verdana; }
</style>
<script language="JavaScript">
if (! parent.frames[0]) location.href='http://localhost/basicapp/resources/view/pgnviewer/pgneditor.html';
function GenerateHTML()
{ var ss=0, tt=document.forms[0].PgnMoveText.value, ttt, ff;
  var ii=document.forms[0].CT.selectedIndex, ww=document.forms[0].AT.checked, nn=document.forms[0].NS.checked; 
  while ((ss=tt.indexOf('"',ss))>0) tt=tt.substr(0,ss)+"'"+tt.substr(ss+1); 
  ss=0; ff=String.fromCharCode(13);
  while ((ss=tt.indexOf(ff, ss))>0) tt=tt.substr(0,ss)+" "+tt.substr(ss+1);
  ss=0; ff=String.fromCharCode(10);
  ttt=tt;
  while ((ss=tt.indexOf(ff, ss))>0) tt=tt.substr(0,ss)+"<br />"+tt.substr(ss+1);
  ss=0; 
  while ((ss=ttt.indexOf(ff, ss))>0) ttt=ttt.substr(0,ss)+" "+ttt.substr(ss+1);
  parent.frames[0].Init('');
  parent.frames[0].ApplyPgnMoveText(tt);
  var hh=parent.frames[0].GetHTMLMoveText(0,nn,ii);
  tt=parent.frames[0].Uncomment(ttt);
  with (parent.frames[2].document)
  { open();
    if (ww) writeln("<html><head></head><body><form><textarea rows=40 cols=120 wrap=virtual>");
    writeln("<html><head>");
    writeln("<style type='text/css'>");
    if (!nn)
    { var bb="#E0C8A0", jj, oo, vv="";
      if (parent.frames[0].document.BoardForm)
      { oo=parent.frames[0].document.BoardForm.ImagePath;
        vv=oo.options[oo.options.selectedIndex].value;
        if (vv) vv="&SetImagePath="+vv;
        else vv="";
        oo=parent.frames[0].document.BoardForm.BGColor;
        for (jj=0; jj<oo.length; jj++)
        { if (oo[jj].checked)
          { vv="&SetBGColor="+oo[jj].value+vv;
            bb="#"+oo[jj].value;
          }
        }
        oo=parent.frames[0].document.BoardForm.Border;
        if (oo.options.selectedIndex>0) vv=vv+"&SetBorder=1";
      }
      writeln("body { background-color:"+bb+";color:#000000;font-size:10pt;line-height:12pt;font-family:Verdana; }");
      writeln("div.PgnMoveText {color:#806040}");
      writeln("a {color:#000000; text-decoration: none}");
      writeln("a:hover {color:#FFFFFF; background-color:#806040}");
    }
    else
      writeln("body { background-color:#FFFFFF;color:#000000;font-size:10pt;line-height:12pt;font-family:Verdana; }");
    writeln("</style>");
    if (!nn)
    { writeln("<"+"script language='JavaScript'>");
      writeln("if (! parent.frames[0]) location.href='ltpgnviewer.html?'+location.href+'"+vv+"';");
      writeln("//else setTimeout('OpenGame()',400);");
      writeln("//REMOVE THE '//' FROM THE LEFT SIDE OF THE PREVIOUS LINE IN THE FINAL VERSION!");  
      writeln("function OpenGame()");
      writeln("{ if (parent.frames[0].IsComplete)");
      writeln("  { if (parent.frames[0].IsComplete())");
      writeln("    { parent.frames[0].ApplySAN('"+parent.frames[0].PieceName+"');");
      writeln("      parent.frames[0].Init('"+parent.frames[0].FenString+"');");    
      writeln("      parent.frames[0].ApplyPgnMoveText(\""+tt+"\",\"#CCCCCC\",window.document);");
      if (parent.frames[0].isDragDrop) writeln("      if (parent.frames[0].SetDragDrop) parent.frames[0].SetDragDrop(1);");    
      writeln("      return;");
      writeln("    }");
      writeln("  }");
      writeln("  setTimeout('OpenGame()',400);");
      writeln("}");
      writeln("function SetMove(mm,vv){ if (parent.frames[0].SetMove) parent.frames[0].SetMove(mm,vv); }");
      writeln("</"+"script>");
    }
    writeln("</head><body><hr />");
    if (!nn) writeln("<a href='javascript:OpenGame()'><b>RELOAD GAME</b></a><br />");
    writeln("<div class='PgnMoveText'>");
    writeln(hh);
    writeln("</div><hr /><!--generated with LT-PGN-VIEWER 3.4--></body></html>");
    if (ww) writeln("</textarea></form></body><html>");
    close();
  }
}
function Uncomment()
{ var tt=document.forms[0].PgnMoveText.value;
  if (parent.frames[0].Uncomment) document.forms[0].PgnMoveText.value=parent.frames[0].Uncomment(tt);
}
function RemoveNewline()
{ var ss=0, ff, tt=document.forms[0].PgnMoveText.value;
  ss=0; ff=String.fromCharCode(13);
  while ((ss=tt.indexOf(ff, ss))>0) tt=tt.substr(0,ss)+" "+tt.substr(ss+1);
  ss=0; ff=String.fromCharCode(10);
  while ((ss=tt.indexOf(ff, ss))>0) tt=tt.substr(0,ss)+" "+tt.substr(ss+1);
  document.forms[0].PgnMoveText.value=tt;
}
</script>
</HEAD>
<BODY topmargin=0 leftmargin=0 rightmargin=0 bottommargin=0>
<div align=center>
<form>
<textarea name="PgnMoveText" rows=12 cols=60 wrap=virtual></textarea><br><nobr>
<table border=0 cellpadding=0 cellspacing=0><tr>
<!-- <td><input type="button"  width=195 style="width:195" value="Remove {text} from input" onClick="Uncomment()"></td>
<td><input type="button"  width=195 style="width:195" value="Remove newline from input" onClick="RemoveNewline()"></td> -->
<td><select name="CT" SIZE=1>
<option value=0>{comment}
<option value=1>italic comment
<option value=2>{...}
</select></td>
</tr></table>
<table border=0 cellpadding=0 cellspacing=0><tr>
<td><input type="text" name="FN" value="black_king_walk.html" size=20></td>
<td><input type="button" width=80 style="width:80" value="Load File" onClick="parent.frames[2].location.href=document.forms[0].FN.value"></td>
<td><input type="button" width=115 style="width:115" value="Generate HTML" onClick="GenerateHTML()"></td>
<td nowrap><input type="checkbox" name="AT">as text</td>
<td nowrap><input type="checkbox" name="NS">no script</td>
</tr></table>
</form>
</div>
</BODY>
</HTML>
