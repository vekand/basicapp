<HTML>
<HEAD>
<script language="JavaScript" src="ltpgnviewer.js"></script>
<script language="JavaScript" src="ltpgnboard.js"></script>
<link rel=stylesheet type="text/css" href="ltpgnviewer.css" />
</HEAD>
<BODY bgcolor="#EEEEEE">
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
Init('');
AllowRecording(true);
//EvalUrlString();
//write the following with ASP or PHP depending on your data from a database:
RotateBoard(true);
ApplyPgnMoveText("1.e4 c5 2.Nf3 d6 3.Bb5+ Bd7 4.Bxd7+ Qxd7 5.c4 Nc6 6.O-O g6 7.Nc3 Bg7 8.d3 Nf6 9.Nd5 Nxd5 10.cxd5 Nd4 11.Nxd4 cxd4 12.Bd2 O-O 13.Rc1 f5 14.Qb3 b6 15.Rc2 Rac8 16.Rfc1 Rxc2 17.Rxc2 f4 18.f3 g5 19.Rc6 g4 20.fxg4 Qxg4 21.Be1 f3 22.Qc2 Be5 23.Rc7 Kf7<Af8g8G> 24.Rxa7 Rg8 25.g3 h5 26.Qc7<Ba7G><Bc7G><Ce7R><Ac7e7G> Qg5 27.Bd2 Qf6 28.Kf2 h4 29.Kf1 Bxg3 30.Qd7 Bxh2 31.Qe6+ Qxe6 32.dxe6+ Kxe6 33.Be1 h3 34.Bh4<Ce7R><Bf5R><Bd5R><Ah4e7ffff80><Aa7e7G><Ae4f5ffff80><Ae4d5ffff80> Rg7 35.Bf2 Bf4 36.Bg1 Be3 37.Bh2 f2 38.Rxe7+ Kxe7 39.Ke2 Rg1 40.Bxg1 fxg1=Q 41.b4 Qf2+ 42.Kd1 Qd2++ 0-1");
AddText("</td><td>"+"<H3>My computer vs. me</H3>"+GetHTMLMoveText(0,0,1));
document.writeln("</td></tr></table>");
setTimeout('RefreshBoard(true)',1000);
if (window.event) document.captureEvents(Event.KEYDOWN);
document.onkeydown = KeyDown;
</script>
</BODY>
</HTML>