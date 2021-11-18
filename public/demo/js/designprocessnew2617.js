var retfrontsrc=[];var retbacksrc=[];var fcanvas = new fabric.StaticCanvas('frontcanvas');var bcanvas = new fabric.StaticCanvas('backcanvas');
/* Main Preview Section*/
function viewMainBack(str){	document.getElementById("main-front-"+str).style.display="none"; document.getElementById("main-back-"+str).style.display="block";}
function viewMainFront(str){ document.getElementById("main-front-"+str).style.display="block"; document.getElementById("main-back-"+str).style.display="none";}
/* Tab */
function getTabSect(str){
	var tabID = "#"+str; var otitle=$.trim(str); var lis = $(tabID).find('div .pt-variation');//Get collection of li's
	$.each(lis, function(){
		$(this).removeClass('active'); //Remove the active class from each li
		$(tabID).find('div .pt-variation div.pt-box-square').removeClass('active');
	});   
	$(tabID).addClass('active'); 
	$(tabID).find('div .pt-variation div:eq(0)').addClass('active');//Add active class 
	var ID=$(tabID).find('div .pt-variation div:eq(0)').attr("id"); var idopt=ID.replace("menu-","menu-opt-"); var ttle=$.trim(ID.replace("menu-",""));

	$("div[id^='menu-opt']").css("display","none"); $("#"+idopt).css("display","block");
	
	if(otitle=="etfabric"){$("#menuopttitle-"+otitle).html("Choose Your Fabric : ");} else {if(ttle=="35"){$("#menuopttitle-"+otitle).html("Choose Your Neck Line :");} else if(ttle=="40"){$("#menuopttitle-"+otitle).html("Choose Your Contrast Fabric :");}}
	
	$("div[id^='miniview-']").css("display","none"); $("#miniview-"+otitle+"-"+ttle).css("display","block");

	viewMainFront(otitle);
}
///* Page Option Functions */
function getPgOption(str,tabstr,attrid,attrnm){ 
	$(".pt-box-square").removeClass("active"); $("#"+str).addClass("active");
	
	var optstr=str.replace("menu-","menu-opt-"); var ttle=$.trim(attrnm); $("div[id^='menu-opt']").css("display","none"); $("#"+optstr).css("display","block");
	
	if(tabstr=="etfabric"){$("#menuopttitle-"+tabstr).html("Choose Your Fabric : ");} else {if(attrid=="4"){$("#menuopttitle-"+tabstr).html("Choose Your Sleeve Style :");} else if(attrid=="5"){$("#menuopttitle-"+tabstr).html("Choose Your Front Style :");} else if(attrid=="6"){$("#menuopttitle-"+tabstr).html("Choose Your Back Style :");} else if(attrid=="7"){$("#menuopttitle-"+tabstr).html("Choose Your Bottom Style :");} else if(attrid=="8"){$("#menuopttitle-"+tabstr).html("Choose Your Collar Style :");} else if(attrid=="9"){$("#menuopttitle-"+tabstr).html("Choose Your Cuff Style :");} else if(attrid=="10"){$("#menuopttitle-"+tabstr).html("Choose Your Pocket Style :");} else if(attrid=="11"){$("#menuopttitle-"+tabstr).html("Choose Your Contrast Fabric :");} else if(attrid=="12"){$("#menuopttitle-"+tabstr).html("Choose Your Button Color :");} else if(attrid=="13"){$("#menuopttitle-"+tabstr).html("Choose Your Monogram Position :");}}

	$("div[id^='miniview-']").css("display","none");
	$("#miniview-"+tabstr+"-"+attrid).css("display","block");
	
	if(attrid=="6"){viewMainBack(tabstr);} else {viewMainFront(tabstr);}
}

function changeMview(str){$("div[id^='tble_']").css("display","none");$("div#tble_"+str).css("display","block");}
/* ---------------------------------------------------------------------------------------------- */
function designProcessing(){
	var jArray=document.getElementById("harr").value; jArray=JSON.parse(jArray);
	var frontArr = {}; var backArr = {};var cwidth= 340; var cheight= 417;var imgNone = '';var fabimg = jArray['ofabric']+".png";var fabcontrastimg = jArray['ocontrast']+".png";	var dbutton = jArray['obutton']+".png";	var dthread = jArray['obuttonHole']+".png";	var dthstyle = jArray['obuttonHoleStyle']; var frontmain=""; var backmain="";var sleeves="";var sleevebtn="";var backsleev="";var shoulder="";var shoulderbtn="";var pockets="";var pocketbtn="";	var packnum=jArray['opacketCount'];	var seams="";var collar="";var frontbutton="";var bkstyle="";var darts="";var boxplacket="";var boxpleats="";var collarinner="";var innerplacket="";var outerplacket="";var backcollr="";var cuffout="";var cuffin="";var cuffbtn="";var bottomcut="";var backcuffout="";	var monogrmtext="";var monogrmcolor="";
	$("#sview").val('close');
	/* Bottoms */
	switch(jArray['obottom']){
		case "11":
			frontmain=url+"/Shirts/Style/Bottom/TriTab/Front/"+fabimg; backmain=url+"/Shirts/Style/Bottom/TriTab/Back/"+fabimg;
			if(jArray['ofront']=="5"){if(jArray['ofrontBoxOut']=="true"){ boxplacket=url+"/Shirts/FabricContrasts/Mix/FrontTriTabPlacket/"+fabcontrastimg; } else { boxplacket=url+"/Shirts/Style/Bottom/TriTab/Inner/"+fabimg; }} else { boxplacket=imgNone; }
			if(jArray['oback']=="8"){ if(jArray['obackBoxOut']=="true"){ boxpleats=url+"/Shirts/FabricContrasts/Mix/BackTriTabPlacket/"+fabcontrastimg; } else { boxpleats=url+"/Shirts/Style/Bottom/TriTab/Outer/"+fabimg; }} else { boxpleats=imgNone; }
			if(jArray['oseams']=="true"){ seams=url+"/Shirts/Style/Front/Seams/Tritab/"+fabimg; } else { seams=imgNone; }
			break;
		case "12":
			frontmain=url+"/Shirts/Style/Bottom/Straight/Front/"+fabimg; backmain=url+"/Shirts/Style/Bottom/Straight/Back/"+fabimg;
			if(jArray['ofront']=="5"){ if(jArray['ofrontBoxOut']=="true"){ boxplacket=url+"/Shirts/FabricContrasts/Mix/FrontStraightPlacket/"+fabcontrastimg; } else { boxplacket=url+"/Shirts/Style/Bottom/Straight/Inner/"+fabimg; }} else { boxplacket=imgNone; }
			if(jArray['oback']=="8"){ if(jArray['obackBoxOut']=="true"){ boxpleats=url+"/Shirts/FabricContrasts/Mix/BackStraightPlacket/"+fabcontrastimg; } else { boxpleats=url+"/Shirts/Style/Bottom/Straight/Outer/"+fabimg; } } else { boxpleats=imgNone; }
			if(jArray['oseams']=="true"){ seams=url+"/Shirts/Style/Front/Seams/Straight/"+fabimg; } else { seams=imgNone; }
			break;
		case "13":
			frontmain=url+"/Shirts/Style/Bottom/StraightVents/Front/"+fabimg; backmain=url+"/Shirts/Style/Bottom/StraightVents/Back/"+fabimg;
			if(jArray['ofront']=="5"){ if(jArray['ofrontBoxOut']=="true"){ boxplacket=url+"/Shirts/FabricContrasts/Mix/FrontStraightPlacket/"+fabcontrastimg; } else { boxplacket=url+"/Shirts/Style/Bottom/StraightVents/Inner/"+fabimg; } } else { boxplacket=imgNone; }
			if(jArray['oback']=="8"){ if(jArray['obackBoxOut']=="true"){ boxpleats=url+"/Shirts/FabricContrasts/Mix/BackStraightPlacket/"+fabcontrastimg; } else { boxpleats=url+"/Shirts/Style/Bottom/StraightVents/Outer/"+fabimg; } } else { boxpleats=imgNone; }
			if(jArray['oseams']=="true"){ seams=url+"/Shirts/Style/Front/Seams/Straight/"+fabimg; } else { seams=imgNone; }
			break;
		default:
			frontmain=url+"/Shirts/Style/Bottom/TriTab/Front/"+fabimg; backmain=url+"/Shirts/Style/Bottom/TriTab/Back/"+fabimg;
			if(jArray['ofront']=="5"){ if(jArray['ofrontBoxOut']=="true"){ boxplacket=url+"/Shirts/FabricContrasts/Mix/FrontTriTabPlacket/"+fabcontrastimg; } else { boxplacket=url+"/Shirts/Style/Bottom/TriTab/Inner/"+fabimg; } } else { boxplacket=imgNone; }
			if(jArray['oback']=="8"){ if(jArray['obackBoxOut']=="true"){ boxpleats=url+"/Shirts/FabricContrasts/Mix/BackTriTabPlacket/"+fabcontrastimg; } else { boxpleats=url+"/Shirts/Style/Bottom/TriTab/Outer/"+fabimg; } } else { boxpleats=imgNone; }
			if(jArray['oseams']=="true"){ seams=url+"/Shirts/Style/Front/Seams/Tritab/"+fabimg; } else { seams=imgNone; }
			break;
	}
	/* Epaulettes */
	if(jArray['oshoulder']=="true"){shoulder=url+"/Shirts/Style/Sleeve/Epaulettes/left/"+fabimg; shoulderbtn=url+"/Shirts/Style/Sleeve/LongSleeve/Button/EpaulettesButton/"+dbutton; } else { shoulder=imgNone; shoulderbtn=imgNone; }
	/* Bottom Cut For Tri-tab */
	if((jArray['ocollarCuffIn']=="true" || jArray['ocollarCuffout']=="true" || jArray['ofrontPlacketIn']=="true" || jArray['ofrontPlacketOut']=="true" || jArray['obackBoxOut']=="true") && jArray['obottom']=="11"){ bottomcut=url+"/Shirts/FabricContrasts/Mix/BottomCut/"+fabcontrastimg; } else { bottomcut=imgNone; }
	/* Sleeves */
	switch(jArray['osleeve']){
		case "1":
		sleeves=url+"/Shirts/Style/Sleeve/LongSleeve/Front/"+fabimg; sleevebtn=imgNone;
		if(jArray['ocuff']=="34" || jArray['ocuff']=="35" || jArray['ocuff']=="36"){ cuffbtn=url+"/Shirts/Style/Cuffs/FrenchRound/Show/"+dbutton;} else { cuffbtn=imgNone;} backsleev=url+"/Shirts/Style/Sleeve/LongSleeve/Back/"+fabimg;
		if(jArray['ocollarCuffout']=="true"){ cuffout=url+"/Shirts/FabricContrasts/Mix/RightOutCuffLongPattern/"+fabcontrastimg; } else { cuffout=imgNone;}
		if(jArray['ocollarCuffIn']=="true"){ cuffin=url+"/Shirts/FabricContrasts/Mix/RightInCuffLongPattern/"+fabcontrastimg; } else { cuffin=url+"/Shirts/Style/Sleeve/LongSleeve/Outer/"+fabimg;}
		if(jArray['ocollarCuffout']=="true"){ backcuffout=url+"/Shirts/FabricContrasts/Mix/BackCuff/"+fabcontrastimg; } else { backcuffout=imgNone; }
		break;
		case "2":
		sleeves=url+"/Shirts/Style/Sleeve/LongSleeveRollup/Front/"+fabimg; sleevebtn=url+"/Shirts/Style/Sleeve/LongSleeveRollup/Button/ShowImg/"+dbutton; cuffbtn=imgNone; backsleev=url+"/Shirts/Style/Sleeve/LongSleeveRollup/Back/"+fabimg;
		if(jArray['ocollarCuffout']=="true"){ cuffout=url+"/Shirts/FabricContrasts/Mix/RightOutCuffRollPattern/"+fabcontrastimg; } else { cuffout=imgNone;}
		if(jArray['ocollarCuffIn']=="true"){ cuffin=url+"/Shirts/FabricContrasts/Mix/RightInCuffRollPattern/"+fabcontrastimg; } else { cuffin=url+"/Shirts/Style/Sleeve/LongSleeveRollup/Outer/"+fabimg;}
		if(jArray['ocollarCuffout']=="true"){ backcuffout=url+"/Shirts/FabricContrasts/Mix/BackCuff/"+fabcontrastimg; } else { backcuffout=imgNone; }
		break;
		case "3":
		sleeves=url+"/Shirts/Style/Sleeve/ShortSleeve/Front/"+fabimg; sleevebtn=imgNone; cuffbtn=imgNone; backsleev=url+"/Shirts/Style/Sleeve/ShortSleeve/Back/"+fabimg; cuffout=imgNone; cuffin=imgNone; backcuffout=imgNone;
		break;
		default:
		sleeves=url+"/Shirts/Style/Sleeve/LongSleeve/Front/"+fabimg; sleevebtn=imgNone;
		if(jArray['ocuff']=="34" || jArray['ocuff']=="35" || jArray['ocuff']=="36"){ cuffbtn=url+"/Shirts/Style/Cuffs/FrenchRound/Show/"+dbutton;} else { cuffbtn=imgNone;} backsleev=url+"/Shirts/Style/Sleeve/LongSleeve/Back/"+fabimg;
		if(jArray['ocollarCuffout']=="true"){ cuffout=url+"/Shirts/FabricContrasts/Mix/RightOutCuffLongPattern/"+fabcontrastimg; } else { cuffout=imgNone;}
		if(jArray['ocollarCuffIn']=="true"){ cuffin=url+"/Shirts/FabricContrasts/Mix/RightInCuffLongPattern/"+fabcontrastimg; } else { cuffin=imgNone;}
		if(jArray['ocollarCuffout']=="true"){ backcuffout=url+"/Shirts/FabricContrasts/Mix/BackCuff/"+fabcontrastimg; } else { backcuffout=imgNone; }
		break;
	}
	/* Pockets */
	switch(jArray['opacket']){
		case "37":
			pockets=imgNone; pocketbtn=imgNone; break;
		case "38":
			if(packnum==2){ pockets=url+"/Shirts/Style/Pockets/ClassicRound/ButtonsImg/"+fabimg; pocketbtn=imgNone; } else { pockets=url+"/Shirts/Style/Pockets/ClassicRound/Show/"+fabimg; pocketbtn=imgNone; } break;
		case "39":
			if(packnum==2){ pockets=url+"/Shirts/Style/Pockets/ClassicAngle/ButtonsImg/"+fabimg; pocketbtn=imgNone; } else { pockets=url+"/Shirts/Style/Pockets/ClassicAngle/Show/"+fabimg; pocketbtn=imgNone; } break;
		case "40":
			if(packnum==2){ pockets=url+"/Shirts/Style/Pockets/DiamondStraight/ButtonsImg/"+fabimg; pocketbtn=imgNone; } else { pockets=url+"/Shirts/Style/Pockets/DiamondStraight/Show/"+fabimg; pocketbtn=imgNone; } break;
		case "41":
			if(packnum==2){ pockets=url+"/Shirts/Style/Pockets/ClassicSquare/ButtonsImg/"+fabimg; pocketbtn=imgNone; } else { pockets=url+"/Shirts/Style/Pockets/ClassicSquare/Show/"+fabimg; pocketbtn=imgNone; } break;
		case "42":
			if(packnum==2){ pockets=url+"/Shirts/Style/Pockets/RoundFlap/ButtonsImg/"+fabimg; pocketbtn=url+"/Shirts/Style/Pockets/RoundFlap/Button/PocketTwoButton/"+dbutton; } else { pockets=url+"/Shirts/Style/Pockets/RoundFlap/Show/"+fabimg; pocketbtn=url+"/Shirts/Style/Pockets/RoundFlap/Button/PocketOneButton/"+dbutton; } break;
		case "43":
			if(packnum==2){ pockets=url+"/Shirts/Style/Pockets/AngleFlap/ButtonsImg/"+fabimg; pocketbtn=url+"/Shirts/Style/Pockets/AngleFlap/Button/PocketTwoButton/"+dbutton; } else { pockets=url+"/Shirts/Style/Pockets/AngleFlap/Show/"+fabimg; pocketbtn=url+"/Shirts/Style/Pockets/AngleFlap/Button/PocketOneButton/"+dbutton; } break;
		case "44":
			if(packnum==2){ pockets=url+"/Shirts/Style/Pockets/DiamondFlap/ButtonsImg/"+fabimg; pocketbtn=url+"/Shirts/Style/Pockets/DiamondFlap/Button/PocketTwoButton/"+dbutton; } else { pockets=url+"/Shirts/Style/Pockets/DiamondFlap/Show/"+fabimg; pocketbtn=url+"/Shirts/Style/Pockets/DiamondFlap/Button/PocketOneButton/"+dbutton; } break;
		case "45":
			if(packnum==2){ pockets=url+"/Shirts/Style/Pockets/Roundwithglass/ButtonsImg/"+fabimg; pocketbtn=imgNone; } else { pockets=url+"/Shirts/Style/Pockets/Roundwithglass/Show/"+fabimg; pocketbtn=imgNone; } break;
		default:
			pockets=imgNone; pocketbtn=imgNone; break;
	}
	/* Front Threads */
	var frontthread="";
	if(jArray['ofront']!="6"){ frontthread=url+"/Shirts/Style/Front/BoxPlacket/Thread/"+jArray['obuttonHoleStyle']+"Front/"+dthread; } else { frontthread=imgNone;}
	/* Collar */
	switch(jArray['ocollar']){
		case "14":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/ItalianCollar1Button/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			if(jArray['ocollarCuffout']=="true"){ collar=url+"/Shirts/FabricContrasts/Mix/Collar/ItalianCollar1Button/mainRound/"+fabcontrastimg; } else { collar=url+"/Shirts/Style/Collar/ItalianCollar1Button/Front/"+fabimg; } 
			if(jArray['ocollarCuffIn']=="true"){ collarinner=url+"/Shirts/FabricContrasts/Mix/RightCollerIn/"+fabcontrastimg; } else { collarinner=imgNone; } break;
		case "15":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/ItalianCollar2Button/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			if(jArray['ocollarCuffout']=="true"){ collar=url+"/Shirts/FabricContrasts/Mix/Collar/ItalianCollar2Button/mainRound/"+fabcontrastimg; } else { collar=url+"/Shirts/Style/Collar/ItalianCollar2Button/Front/"+fabimg; } 
			if(jArray['ocollarCuffIn']=="true"){ collarinner=url+"/Shirts/FabricContrasts/Mix/RightCollerIn/"+fabcontrastimg; } else { collarinner=imgNone; } break;
		case "16":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/FrenchCollar1Button/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			if(jArray['ocollarCuffout']=="true"){ collar=url+"/Shirts/FabricContrasts/Mix/Collar/FrenchCollar1Button/mainRound/"+fabcontrastimg; } else { collar=url+"/Shirts/Style/Collar/FrenchCollar1Button/Front/"+fabimg; } 
			if(jArray['ocollarCuffIn']=="true"){ collarinner=url+"/Shirts/FabricContrasts/Mix/RightCollerIn/"+fabcontrastimg; } else { collarinner=imgNone; } break;
		case "17":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/FrenchCollar2Button/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			if(jArray['ocollarCuffout']=="true"){ collar=url+"/Shirts/FabricContrasts/Mix/Collar/FrenchCollar2Button/mainRound/"+fabcontrastimg; } else { collar=url+"/Shirts/Style/Collar/FrenchCollar2Button/Front/"+fabimg; } 
			if(jArray['ocollarCuffIn']=="true"){ collarinner=url+"/Shirts/FabricContrasts/Mix/RightCollerIn/"+fabcontrastimg; } else { collarinner=imgNone; } break;
		case "18":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/CutAway1Button/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			if(jArray['ocollarCuffout']=="true"){ collar=url+"/Shirts/FabricContrasts/Mix/Collar/CutAway1Button/mainRound/"+fabcontrastimg; } else { collar=url+"/Shirts/Style/Collar/CutAway1Button/Front/"+fabimg; } 
			if(jArray['ocollarCuffIn']=="true"){ collarinner=url+"/Shirts/FabricContrasts/Mix/RightCollerIn/"+fabcontrastimg; } else { collarinner=imgNone; } break;
		case "19":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/CutAway2Button/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			if(jArray['ocollarCuffout']=="true"){ collar=url+"/Shirts/FabricContrasts/Mix/Collar/CutAway2Button/mainRound/"+fabcontrastimg; } else { collar=url+"/Shirts/Style/Collar/CutAway2Button/Front/"+fabimg; } 
			if(jArray['ocollarCuffIn']=="true"){ collarinner=url+"/Shirts/FabricContrasts/Mix/RightCollerIn/"+fabcontrastimg; } else { collarinner=imgNone; } break;
		case "20":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/RoundCollar/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			if(jArray['ocollarCuffout']=="true"){ collar=url+"/Shirts/FabricContrasts/Mix/Collar/RoundCollar/mainRound/"+fabcontrastimg; } else { collar=url+"/Shirts/Style/Collar/RoundCollar/Front/"+fabimg; } 
			if(jArray['ocollarCuffIn']=="true"){ collarinner=url+"/Shirts/FabricContrasts/Mix/RightCollerIn/"+fabcontrastimg; } else { collarinner=imgNone; } break;
		case "21":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/ButtonDown/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			if(jArray['ocollarCuffout']=="true"){ collar=url+"/Shirts/FabricContrasts/Mix/Collar/ButtonDown/mainRound/"+fabcontrastimg; } else { collar=url+"/Shirts/Style/Collar/ButtonDown/Front/"+fabimg; } 
			if(jArray['ocollarCuffIn']=="true"){ collarinner=url+"/Shirts/FabricContrasts/Mix/RightCollerIn/"+fabcontrastimg; } else { collarinner=imgNone; } break;
		case "22":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/HiddenButton/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			if(jArray['ocollarCuffout']=="true"){ collar=url+"/Shirts/FabricContrasts/Mix/Collar/HiddenButton/mainRound/"+fabcontrastimg; } else { collar=url+"/Shirts/Style/Collar/HiddenButton/Front/"+fabimg; } 
			if(jArray['ocollarCuffIn']=="true"){ collarinner=url+"/Shirts/FabricContrasts/Mix/RightCollerIn/"+fabcontrastimg; } else { collarinner=imgNone; } break;
		case "23":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/Tab/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			if(jArray['ocollarCuffout']=="true"){ collar=url+"/Shirts/FabricContrasts/Mix/Collar/Tab/mainRound/"+fabcontrastimg; } else { collar=url+"/Shirts/Style/Collar/Tab/Front/"+fabimg; } 
			if(jArray['ocollarCuffIn']=="true"){ collarinner=url+"/Shirts/FabricContrasts/Mix/RightCollerIn/"+fabcontrastimg; } else { collarinner=imgNone; } break;
		case "24":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/BatmanCollar/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			if(jArray['ocollarCuffout']=="true"){ collar=url+"/Shirts/FabricContrasts/Mix/Collar/BatmanCollar/mainRound/"+fabcontrastimg; } else { collar=url+"/Shirts/Style/Collar/BatmanCollar/Front/"+fabimg; } 
			if(jArray['ocollarCuffIn']=="true"){ collarinner=url+"/Shirts/FabricContrasts/Mix/RightCollerIn/"+fabcontrastimg; } else { collarinner=imgNone; } break;
		case "25":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/ModernCollar/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			if(jArray['ocollarCuffout']=="true"){ collar=url+"/Shirts/FabricContrasts/Mix/Collar/ModernCollar/mainRound/"+fabcontrastimg; } else { collar=url+"/Shirts/Style/Collar/ModernCollar/Front/"+fabimg; } 
			if(jArray['ocollarCuffIn']=="true"){ collarinner=url+"/Shirts/FabricContrasts/Mix/RightCollerIn/"+fabcontrastimg; } else { collarinner=imgNone; } break;
		case "26":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/Tuxedo/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			if(jArray['ocollarCuffout']=="true"){ collar=url+"/Shirts/FabricContrasts/Mix/Collar/Tuxedo/mainRound/"+fabcontrastimg; } else { collar=url+"/Shirts/Style/Collar/Tuxedo/Front/"+fabimg; } 
			if(jArray['ocollarCuffIn']=="true"){ collarinner=url+"/Shirts/FabricContrasts/Mix/RightCollerIn/"+fabcontrastimg; } else { collarinner=imgNone; } break;
		case "27":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/Band/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			if(jArray['ocollarCuffout']=="true"){ collar=url+"/Shirts/FabricContrasts/Mix/Collar/Band/mainRound/"+fabcontrastimg; } else { collar=imgNone; } 
			if(jArray['ocollarCuffIn']=="true"){ collarinner=url+"/Shirts/FabricContrasts/Mix/RightCollerIn/"+fabcontrastimg; } else { collarinner=imgNone; } break;
	}
	/* Back Collar */
	if(jArray['ocollarCuffout']=="true"){ backcollr=url+"/Shirts/FabricContrasts/Mix/RightBackColler/"+fabcontrastimg; } else { backcollr=imgNone;}
	/* Back Darts */
	switch(jArray['oback']){
		case "7":
			if(jArray['odart']=="true"){darts=url+"/Shirts/Style/Back/Drats/left/"+fabimg;} else { darts=imgNone; } bkstyle=imgNone; break;
		case "8":
			if(jArray['odart']=="true"){ darts=url+"/Shirts/Style/Back/Drats/left/"+fabimg; } else { darts=imgNone;} bkstyle=imgNone; break;
		case "9":
			darts=imgNone; bkstyle=url+"/Shirts/Style/Back/SidePleats/Back/"+fabimg; break;
		case "10":
			darts=imgNone; bkstyle=url+"/Shirts/Style/Back/CenterPleats/Back/"+fabimg; break;
	}
	/* Monogram*/
	if(jArray['omonogram']=="46" || jArray['omonogram']=="47" || jArray['omonogram']=="48" || jArray['omonogram']=="49"){ if(jArray['omonogram']=="49" && jArray['osleeve']!="1"){ var ttmono=imgNone; } else { monogrmtyp=jArray['omonogram']; monogrmtext=jArray['omonogramText']; monogrmcolor=jArray['omonogramtextColor']; var ttmono=monogrmtyp+":"+monogrmtext+":"+monogrmcolor } } else { monogrmtyp=imgNone; monogrmtext=imgNone; monogrmcolor=imgNone; var ttmono=imgNone;}
	/* FRONT PROCESSING CONTANTS */
	var frontsrcs = { monotxt: ttmono, bottomcut: bottomcut, cuffbtn: cuffbtn, cuffinn: cuffin, cuffoutt: cuffout, sleevebtn: sleevebtn, sleeve: sleeves, collarin: collarinner, packetbttn: pocketbtn, packet: pockets, collar: collar, fbutton: frontbutton, fthread: frontthread, boxplacket: boxplacket, seams: seams, shoulderbttn : shoulderbtn, shoulder: shoulder, front: frontmain, };
	/* BACK PROCESSING CONTANTS */
	var backsrcs = { dart: darts, backtyp: bkstyle, boxpleat: boxpleats, backcuffout: backcuffout, sleeve: backsleev, backcollar: backcollr, backm: backmain, };
	$.each(frontsrcs,function(key,value){ if(value!=""){ retfrontsrc.push(frontsrcs[key]); } }); fcanvas.clear(); frontProcessing();
	$.each(backsrcs,function(key,value){ if(value!=""){ retbacksrc.push(backsrcs[key]); } }); bcanvas.clear(); backProcessing();
}
/* FRONT PROCESSING FUNCTION */
function frontProcessing(){ var cdata = ""; var _src = retfrontsrc.pop();
	if(_src.indexOf('4')==0){ 
		monogramProcess(_src); 
	} else { 
		fabric.Image.fromURL(_src, function(oImg) { 
			fcanvas.add(oImg); 
			cdata=fcanvas.toDataURL(); 
			/*$("div [id^='main-front-']").find("div.pt-image-div img").attr("src",cdata);
			$("#miniview-etstyle-4").find("figure img").attr("src",cdata);
			$("#miniview-etstyle-5").find("figure img").attr("src",cdata);*/ 
			if (retfrontsrc.length > 0) { setTimeout(frontProcessing, 40); } else { 
			$("div [id^='main-front-']").find("div.pt-image-div img").attr("src",cdata);
			$("#miniview-etstyle-4").find("figure img").attr("src",cdata);
			$("#miniview-etstyle-5").find("figure img").attr("src",cdata);}
		}); 
	}
}
/* BACK PROCESSING FUNCTION */
function backProcessing(){ var cdata = ""; var _src = retbacksrc.pop(); 
	fabric.Image.fromURL(_src, function(oImg) { 
		bcanvas.add(oImg); cdata=bcanvas.toDataURL(); 
		$("div [id^='main-back-']").find("div.pt-image-div img").attr("src",cdata); 
		$("#miniview-etstyle-6").find("figure img").attr("src",cdata);
		if (retbacksrc.length > 0) { setTimeout(backProcessing, 40); } 
	});
}
/* MONOGRAM PROCESSING FUNCTION */
function monogramProcess(mtotal){ var cdata = "";  mtotal=mtotal.split(':'); var mtyp=$.trim(mtotal[0]); var mtext=$.trim(mtotal[1]); var mcolor=$.trim(mtotal[2]); var text=""; if((mtyp!="" || mtyp!="1") && mtext!=""){ if(mtyp=="46"){ text = new fabric.Text(mtext, { left: 177, top: 230, fontFamily: 'Mtcorsva', fontStyle: 'italic', fontSize: 10, fill: mcolor }); } else if(mtyp=="47"){ text = new fabric.Text(mtext, { left: 177, top: 130, fontFamily: 'Mtcorsva', fontStyle: 'italic', fontSize: 10, fill: mcolor }); } else if(mtyp=="48"){ text = new fabric.Text(mtext, { left: 177, top: 142, fontFamily: 'Mtcorsva', fontStyle: 'italic', fontSize: 10, fill: mcolor }); } else if(mtyp=="49"){ text = new fabric.Text(mtext, { left: 192, top: 267, fontFamily: 'Mtcorsva', fontStyle: 'italic', fontSize: 10, fill: mcolor, angle: 65 }); } fcanvas.add(text); cdata=fcanvas.toDataURL(); $("div [id^='main-front-']").find("div.pt-image-div img").attr("src",cdata); var tbactive=$(".nav-tabs").find("li.active a").attr("href"); var stbactive=$(tbactive).find('div .pt-variation div.active').attr("id"); stbactive=stbactive.replace("menu-",""); if(stbactive=="Sleeve" || stbactive=="Front") { $("#figureimg-etstyle img").attr("src",cdata); } }
}
/* OPEN DESIGN PROCESSING FUNCTION */
function designOpenProcessing(){
	var jArray=document.getElementById("harr").value; jArray=JSON.parse(jArray);
	var frontArr = {}; var backArr = {};var cwidth= 340;var cheight= 417;var imgNone = '';var fabimg = jArray['ofabric']+".png";var fabcontrastimg = jArray['ocontrast']+".png";	var dbutton = jArray['obutton']+".png";	var dthread = jArray['obuttonHole']+".png";	var dthstyle = jArray['obuttonHoleStyle'];var frontmain="";var backmain="";var sleeves="";var sleevebtn="";var backsleev="";var shoulder="";var shoulderbtn="";var pockets="";var pocketbtn="";	var packnum=jArray['opacketCount'];var seams="";var collar="";var frontbutton="";var bkstyle="";var darts="";var boxplacket="";var boxpleats="";var collarouter="";var collarinner="";var collarrightin="";var collarleftin="";var innerplacket="";var outerplacket="";var backcollr="";var cuffout="";	var cuffin="";var cuffbtn="";var bottomcut="";var backcuffout="";
	$("#sview").val('open');
	/* Collar Band */
	collarleftin=url+"/Shirts/Fabric/CollerBandIn/"+fabimg;
	/* Bottoms */
	switch(jArray['obottom']){
		case "11":
			frontmain=url+"/Shirts/Style/Bottom/TriTab/Front/"+fabimg; backmain=url+"/Shirts/Style/Bottom/TriTab/Back/"+fabimg;
			if(jArray['ofront']=="5"){ if(jArray['ofrontBoxOut']=="true"){ boxplacket=url+"/Shirts/FabricContrasts/Mix/FrontTriTabPlacket/"+fabcontrastimg; } else { boxplacket=url+"/Shirts/Style/Bottom/TriTab/Inner/"+fabimg; } } else { boxplacket=imgNone; }
			if(jArray['oback']=="8"){ if(jArray['obackBoxOut']=="true"){ boxpleats=url+"/Shirts/FabricContrasts/Mix/BackTriTabPlacket/"+fabcontrastimg; } else { boxpleats=url+"/Shirts/Style/Bottom/TriTab/Outer/"+fabimg; } } else { boxpleats=imgNone; }
			if(jArray['oseams']=="true"){ seams=url+"/Shirts/Style/Front/Seams/Tritab/"+fabimg; } else { seams=imgNone; } break;
		case "12":
			frontmain=url+"/Shirts/Style/Bottom/Straight/Front/"+fabimg; backmain=url+"/Shirts/Style/Bottom/Straight/Back/"+fabimg;
			if(jArray['ofront']=="5"){ if(jArray['ofrontBoxOut']=="true"){ boxplacket=url+"/Shirts/FabricContrasts/Mix/FrontStraightPlacket/"+fabcontrastimg; } else { boxplacket=url+"/Shirts/Style/Bottom/Straight/Inner/"+fabimg; } } else { boxplacket=imgNone; }
			if(jArray['oback']=="8"){ if(jArray['obackBoxOut']=="true"){ boxpleats=url+"/Shirts/FabricContrasts/Mix/BackStraightPlacket/"+fabcontrastimg; } else { boxpleats=url+"/Shirts/Style/Bottom/Straight/Outer/"+fabimg; } } else { boxpleats=imgNone; }
			if(jArray['oseams']=="true"){ seams=url+"/Shirts/Style/Front/Seams/Straight/"+fabimg; } else { seams=imgNone; } break;
		case "13":
			frontmain=url+"/Shirts/Style/Bottom/StraightVents/Front/"+fabimg; backmain=url+"/Shirts/Style/Bottom/StraightVents/Back/"+fabimg;
			if(jArray['ofront']=="5"){ if(jArray['ofrontBoxOut']=="true"){ boxplacket=url+"/Shirts/FabricContrasts/Mix/FrontStraightPlacket/"+fabcontrastimg; } else { boxplacket=url+"/Shirts/Style/Bottom/StraightVents/Inner/"+fabimg; } } else { boxplacket=imgNone; }
			if(jArray['oback']=="8"){ if(jArray['obackBoxOut']=="true"){ boxpleats=url+"/Shirts/FabricContrasts/Mix/BackStraightPlacket/"+fabcontrastimg; } else { boxpleats=url+"/Shirts/Style/Bottom/StraightVents/Outer/"+fabimg; } } else { boxpleats=imgNone; }
			if(jArray['oseams']=="true"){ seams=url+"/Shirts/Style/Front/Seams/Straight/"+fabimg; } else { seams=imgNone; } break;
		default:
			frontmain=url+"/Shirts/Style/Bottom/TriTab/Front/"+fabimg; backmain=url+"/Shirts/Style/Bottom/TriTab/Back/"+fabimg;
			if(jArray['ofront']=="5"){ if(jArray['ofrontBoxOut']=="true"){ boxplacket=url+"/Shirts/FabricContrasts/Mix/FrontTriTabPlacket/"+fabcontrastimg; } else { boxplacket=url+"/Shirts/Style/Bottom/TriTab/Inner/"+fabimg; } } else { boxplacket=imgNone; }
			if(jArray['oback']=="8"){ if(jArray['obackBoxOut']=="true"){ boxpleats=url+"/Shirts/FabricContrasts/Mix/BackTriTabPlacket/"+fabcontrastimg; } else { boxpleats=url+"/Shirts/Style/Bottom/TriTab/Outer/"+fabimg; } } else { boxpleats=imgNone; }
			if(jArray['oseams']=="true"){ seams=url+"/Shirts/Style/Front/Seams/Tritab/"+fabimg; } else { seams=imgNone; } break;
	}
	/* Epaulettes */
	if(jArray['oshoulder']=="true"){ shoulder=url+"/Shirts/Style/Sleeve/Epaulettes/left/"+fabimg; shoulderbtn=url+"/Shirts/Style/Sleeve/LongSleeve/Button/EpaulettesButton/"+dbutton; } else { shoulder=imgNone; shoulderbtn=imgNone; }
	/* Bottom Cut For Tri-tab */
	if((jArray['ocollarCuffIn']=="true" || jArray['ocollarCuffout']=="true" || jArray['ofrontPlacketIn']=="true" || jArray['ofrontPlacketOut']=="true" || jArray['obackBoxOut']=="true") && jArray['obottom']=="11"){ bottomcut=url+"/Shirts/FabricContrasts/Mix/BottomCut/"+fabcontrastimg; } else { bottomcut=imgNone; }
	/* Sleeves */
	switch(jArray['osleeve']){
		case "1":
		sleeves=url+"/Shirts/Style/Sleeve/LongSleeve/Front/"+fabimg; sleevebtn=imgNone;
		if(jArray['ocuff']=="34" || jArray['ocuff']=="35" || jArray['ocuff']=="36"){ cuffbtn=url+"/Shirts/Style/Cuffs/FrenchRound/Show/"+dbutton;} else { cuffbtn=imgNone;} backsleev=url+"/Shirts/Style/Sleeve/LongSleeve/Back/"+fabimg;
		if(jArray['ocollarCuffout']=="true"){ cuffout=url+"/Shirts/FabricContrasts/Mix/RightOutCuffLongPattern/"+fabcontrastimg; } else { cuffout=imgNone;}
		if(jArray['ocollarCuffIn']=="true"){ cuffin=url+"/Shirts/FabricContrasts/Mix/RightInCuffLongPattern/"+fabcontrastimg; } else { cuffin=url+"/Shirts/Style/Sleeve/LongSleeve/Outer/"+fabimg;}
		if(jArray['ocollarCuffout']=="true"){ backcuffout=url+"/Shirts/FabricContrasts/Mix/BackCuff/"+fabcontrastimg; } else { backcuffout=imgNone; } break;
		case "2":
		sleeves=url+"/Shirts/Style/Sleeve/LongSleeveRollup/Front/"+fabimg; sleevebtn=url+"/Shirts/Style/Sleeve/LongSleeveRollup/Button/ShowImg/"+dbutton; cuffbtn=imgNone; backsleev=url+"/Shirts/Style/Sleeve/LongSleeveRollup/Back/"+fabimg;
		if(jArray['ocollarCuffout']=="true"){ cuffout=url+"/Shirts/FabricContrasts/Mix/RightOutCuffRollPattern/"+fabcontrastimg; } else { cuffout=imgNone;}
		if(jArray['ocollarCuffIn']=="true"){ cuffin=url+"/Shirts/FabricContrasts/Mix/RightInCuffRollPattern/"+fabcontrastimg; } else { cuffin=url+"/Shirts/Style/Sleeve/LongSleeveRollup/Outer/"+fabimg;}
		if(jArray['ocollarCuffout']=="true"){ backcuffout=url+"/Shirts/FabricContrasts/Mix/BackCuff/"+fabcontrastimg; } else { backcuffout=imgNone; } break;
		case "3":
		sleeves=url+"/Shirts/Style/Sleeve/ShortSleeve/Front/"+fabimg; sleevebtn=imgNone; cuffbtn=imgNone; backsleev=url+"/Shirts/Style/Sleeve/ShortSleeve/Back/"+fabimg; cuffout=imgNone; cuffin=imgNone; backcuffout=imgNone; break;
		default:
		sleeves=url+"/Shirts/Style/Sleeve/LongSleeve/Front/"+fabimg; sleevebtn=imgNone;
		if(jArray['ocuff']=="34" || jArray['ocuff']=="35" || jArray['ocuff']=="36"){ cuffbtn=url+"/Shirts/Style/Cuffs/FrenchRound/Show/"+dbutton;} else { cuffbtn=imgNone;} backsleev=url+"/Shirts/Style/Sleeve/LongSleeve/Back/"+fabimg;
		if(jArray['ocollarCuffout']=="true"){ cuffout=url+"/Shirts/FabricContrasts/Mix/RightOutCuffLongPattern/"+fabcontrastimg; }else { cuffout=imgNone;}
		if(jArray['ocollarCuffIn']=="true"){ cuffin=url+"/Shirts/FabricContrasts/Mix/RightInCuffLongPattern/"+fabcontrastimg; } else { cuffin=imgNone;}
		if(jArray['ocollarCuffout']=="true"){backcuffout=url+"/Shirts/FabricContrasts/Mix/BackCuff/"+fabcontrastimg;}else{ backcuffout=imgNone; } break;
	}
	/* Pockets */
	switch(jArray['opacket']){
		case "37":
			pockets=imgNone; pocketbtn=imgNone; break;
		case "38":
			if(packnum==2){ pockets=url+"/Shirts/Style/Pockets/ClassicRound/ButtonsImg/"+fabimg; pocketbtn=imgNone; } else { pockets=url+"/Shirts/Style/Pockets/ClassicRound/Show/"+fabimg; pocketbtn=imgNone; } break;
		case "39":
			if(packnum==2){ pockets=url+"/Shirts/Style/Pockets/ClassicAngle/ButtonsImg/"+fabimg; pocketbtn=imgNone; } else { pockets=url+"/Shirts/Style/Pockets/ClassicAngle/Show/"+fabimg; pocketbtn=imgNone; } break;
		case "40":
			if(packnum==2){ pockets=url+"/Shirts/Style/Pockets/DiamondStraight/ButtonsImg/"+fabimg; pocketbtn=imgNone; } else { pockets=url+"/Shirts/Style/Pockets/DiamondStraight/Show/"+fabimg; pocketbtn=imgNone; } break;
		case "41":
			if(packnum==2){ pockets=url+"/Shirts/Style/Pockets/ClassicSquare/ButtonsImg/"+fabimg; pocketbtn=imgNone; } else { pockets=url+"/Shirts/Style/Pockets/ClassicSquare/Show/"+fabimg; pocketbtn=imgNone; } break;
		case "42":
			if(packnum==2){ pockets=url+"/Shirts/Style/Pockets/RoundFlap/ButtonsImg/"+fabimg; pocketbtn=url+"/Shirts/Style/Pockets/RoundFlap/Button/PocketTwoButton/"+dbutton; } else { pockets=url+"/Shirts/Style/Pockets/RoundFlap/Show/"+fabimg; pocketbtn=url+"/Shirts/Style/Pockets/RoundFlap/Button/PocketOneButton/"+dbutton; } break;
		case "43":
			if(packnum==2){ pockets=url+"/Shirts/Style/Pockets/AngleFlap/ButtonsImg/"+fabimg; pocketbtn=url+"/Shirts/Style/Pockets/AngleFlap/Button/PocketTwoButton/"+dbutton; } else { pockets=url+"/Shirts/Style/Pockets/AngleFlap/Show/"+fabimg; pocketbtn=url+"/Shirts/Style/Pockets/AngleFlap/Button/PocketOneButton/"+dbutton; } break;
		case "44":
			if(packnum==2){ pockets=url+"/Shirts/Style/Pockets/DiamondFlap/ButtonsImg/"+fabimg; pocketbtn=url+"/Shirts/Style/Pockets/DiamondFlap/Button/PocketTwoButton/"+dbutton; } else { pockets=url+"/Shirts/Style/Pockets/DiamondFlap/Show/"+fabimg; pocketbtn=url+"/Shirts/Style/Pockets/DiamondFlap/Button/PocketOneButton/"+dbutton; } break;
		case "45":
			if(packnum==2){ pockets=url+"/Shirts/Style/Pockets/Roundwithglass/ButtonsImg/"+fabimg; pocketbtn=imgNone; } else { pockets=url+"/Shirts/Style/Pockets/Roundwithglass/Show/"+fabimg; pocketbtn=imgNone; } break;
		default:
			pockets=imgNone; pocketbtn=imgNone; break;
	}
	/* Front Threads */
	var frontthread=""; if(jArray['ofront']!="6"){ frontthread=url+"/Shirts/Style/Front/BoxPlacket/Thread/"+jArray['obuttonHoleStyle']+"Front/"+dthread; } else { frontthread=imgNone;}
	/* Collar */
	switch(jArray['ocollar']){
		case "14":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/ItalianCollar1Button/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			collar=url+"/Shirts/Style/Collar/ItalianCollar1Button/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/ItalianCollar1Button/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/ItalianCollar1Button/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg; break;
		case "15":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/ItalianCollar2Button/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			collar=url+"/Shirts/Style/Collar/ItalianCollar2Button/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/ItalianCollar2Button/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/ItalianCollar2Button/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg; break;
		case "16":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/FrenchCollar1Button/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			collar=url+"/Shirts/Style/Collar/FrenchCollar1Button/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/FrenchCollar1Button/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/FrenchCollar1Button/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg; break;
		case "17":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/FrenchCollar2Button/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			collar=url+"/Shirts/Style/Collar/FrenchCollar2Button/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/FrenchCollar2Button/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/FrenchCollar2Button/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg; break;
		case "18":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/CutAway1Button/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			collar=url+"/Shirts/Style/Collar/CutAway1Button/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/CutAway1Button/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/CutAway1Button/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg; break;
		case "19":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/CutAway2Button/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			collar=url+"/Shirts/Style/Collar/CutAway2Button/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/CutAway2Button/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/CutAway2Button/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg; break;
		case "20":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/RoundCollar/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			collar=url+"/Shirts/Style/Collar/RoundCollar/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/RoundCollar/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/RoundCollar/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg; break;
		case "21":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/ButtonDown/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			collar=url+"/Shirts/Style/Collar/ButtonDown/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/ButtonDown/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/ButtonDown/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg; break;
		case "22":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/HiddenButton/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			collar=url+"/Shirts/Style/Collar/HiddenButton/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/HiddenButton/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/HiddenButton/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg; break;
		case "23":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/Tab/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			collar=url+"/Shirts/Style/Collar/Tab/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/Tab/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/Tab/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg; break;
		case "24":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/BatmanCollar/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			collar=url+"/Shirts/Style/Collar/BatmanCollar/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/BatmanCollar/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/BatmanCollar/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg; break;
		case "25":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/ModernCollar/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			collar=url+"/Shirts/Style/Collar/ModernCollar/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/ModernCollar/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/ModernCollar/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg; break;
		case "26":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/Tuxedo/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			collar=url+"/Shirts/Style/Collar/Tuxedo/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/Tuxedo/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/Tuxedo/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg; break;
		case "27":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/Band/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			collar=imgNone;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/Band/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/Band/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg; break;
	}
	/* Plackets */
	if(jArray['ofrontPlacketIn']=="true"){ innerplacket=url+"/Shirts/FabricContrasts/Mix/RightFrontIn/"+fabcontrastimg; } else { innerplacket=imgNone;}
	if(jArray['ofrontPlacketOut']=="true"){ outerplacket=url+"/Shirts/FabricContrasts/Mix/RightFrontOut/"+fabcontrastimg; } else { outerplacket=imgNone;}
	/* Back Collar */
	if(jArray['ocollarCuffout']=="true"){ backcollr=url+"/Shirts/FabricContrasts/Mix/RightBackColler/"+fabcontrastimg; } else { backcollr=imgNone;}
	/* Back Darts */
	switch(jArray['oback']){
		case "7":
			if(jArray['odart']=="true"){ darts=url+"/Shirts/Style/Back/Drats/left/"+fabimg;	} else {darts=imgNone;} bkstyle=imgNone; break;
		case "8":
			if(jArray['odart']=="true"){ darts=url+"/Shirts/Style/Back/Drats/left/"+fabimg;} else { darts=imgNone;} bkstyle=imgNone; break;
		case "9":
			darts=imgNone; bkstyle=url+"/Shirts/Style/Back/SidePleats/Back/"+fabimg; break;
		case "10":
			darts=imgNone; bkstyle=url+"/Shirts/Style/Back/CenterPleats/Back/"+fabimg; break;
	}
	/* Monogram*/
	if(jArray['omonogram']=="46" || jArray['omonogram']=="47" || jArray['omonogram']=="48" || jArray['omonogram']=="49"){ if(jArray['omonogram']=="49" && jArray['osleeve']!="1"){ var ttmono=imgNone; } else { monogrmtyp=jArray['omonogram']; monogrmtext=jArray['omonogramText']; monogrmcolor=jArray['omonogramtextColor']; var ttmono=monogrmtyp+":"+monogrmtext+":"+monogrmcolor; } } else { monogrmtyp=imgNone; monogrmtext=imgNone; monogrmcolor=imgNone; var ttmono=imgNone;}
	/* FRONT PROCESSING CONSTANTS */
	var frontsrcs = { monotxt: ttmono, bottomcut: bottomcut, cuffbtn: cuffbtn, cuffinn: cuffin, cuffoutt: cuffout, sleevebtn: sleevebtn, sleeve: sleeves, collarright: collarrightin, collarout: collarouter, collarleftin:collarleftin, frontplacketin: innerplacket, frontplacketout: outerplacket, collarin: collarinner, fbutton: frontbutton, fthread: frontthread, packetbttn: pocketbtn, packet: pockets, boxplacket: boxplacket, seams: seams, shoulderbttn : shoulderbtn, shoulder: shoulder, front: frontmain, };
	/* BACK PROCESSING CONSTANTS */
	var backsrcs = { dart: darts, backtyp: bkstyle, boxpleat: boxpleats, backcuffout: backcuffout, sleeve: backsleev, backcollar: backcollr, backm: backmain, };
	/* Array for Front */
	$.each(frontsrcs,function(key,value){ if(value!=""){ retfrontsrc.push(frontsrcs[key]); } }); fcanvas.clear(); frontProcessing();
	/* Array for Back */
	$.each(backsrcs,function(key,value){ if(value!=""){ retbacksrc.push(backsrcs[key]); } }); bcanvas.clear(); backProcessing();
}
/* ----------------------------------Option Selection Functions---------------------------------- */
function getfab(id,otab){	
    var arr = document.getElementById("harr").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       url:'/getshirtfabrics',
       data:{fabid : id, carr : arr, rurl : url, t : otab},
	   beforeSend: function() { $(".et-small-loader").show(); },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){ 
	   		$('#preview-etfabric').html(data[1]);
			var stid="menu-fabric"+data[3];
			var stab=data[2]; 
			var newarr=data[4];
			var uparr=JSON.stringify(data[4]);
			$('#tabActiveId').val(data[2]);
			$('#tabSActiveId').val('fabric'+data[3]);
			$('#harr').val(uparr);
			$("#fullstyle").html(data[5]);
			$(".pt-bottom-thumb").html(data[6]);
			$("#fullcontrast").html(data[7]);
			$("li[id^='optionlist-fabric']").find('div.icon-check').remove();
			$("#optionlist-fabric"+data[3]+"-"+id).append('<div class="icon-check"></div>');
			getTabSect(data[2]); 
			getPgOption(stid,stab,"fabric"+data[3],'');
			var arr2 = document.getElementById("harr").value; arr2=JSON.parse(arr2); var collr=arr2['ocollar'];
			var vw=$("#sview").val();
			if(vw=="open" && (collr!=21 && collr!=22 && collr!=23 && collr!=26 && collr!=27)){ designOpenProcessing(); } else { designProcessing(); }
			updatefabprice();
			setTimeout($(".et-small-loader").fadeOut(),50);
	   }
    });
}
function getstyles(id,ctyp,otab){
    var arr = document.getElementById("harr").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       url:'/getshirtstyle',
       data:{fabid : id, carr : arr, typ : ctyp, rurl : url, t : otab},
	   beforeSend: function() { $(".et-small-loader").show(); },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){ 
	   		//console.log(data);
			$('#miniview-etstyle-'+data[3]).html(data[1]);
			var stid="menu-"+data[3];
			var stab=data[2]; 
			var newarr=data[4];
			var uparr=JSON.stringify(data[4]);
			$('#tabActiveId').val(data[2]);
			$('#tabSActiveId').val(data[3]);
			$('#harr').val(uparr);
			$(".pt-bottom-thumb").html(data[5]);
			$("#fullcontrast").html(data[6]);
			$("#bdymsleeve").html(data[7]);
			$("#stablist").html(data[8]);
			$("li[id^='optionlist-"+data[3]+"']").find('div.icon-check').remove();
			$("#optionlist-"+data[3]+"-"+id).append('<div class="icon-check"></div>');
			getTabSect(data[2]); 
			getPgOption(stid,stab,data[3],'');
			var arr2 = document.getElementById("harr").value; arr2=JSON.parse(arr2); var collr=arr2['ocollar'];
			var vw=$("#sview").val();
			if(vw=="open" && (collr!=21 && collr!=22 && collr!=23 && collr!=26 && collr!=27)){ designOpenProcessing(); } else { designProcessing(); }
			setTimeout($(".et-small-loader").fadeOut(),50);
	   }
    });
}
function getcontrast(id,otab){
    var arr = document.getElementById("harr").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       url:'/getshirtcontrasts',
       data:{fabid : id, carr : arr, typ : '11', rurl : url, t : otab},
	   beforeSend: function() { $(".et-small-loader").show(); },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){ 
	   		$("#miniview-etcontrast-11").html(data[1]);
	   		var stid="menu-"+data[3];
			var stab=data[2]; 
			var newarr=data[4];
			var uparr=JSON.stringify(data[4]);
			$('#tabActiveId').val(data[2]);
			$('#tabSActiveId').val(data[3]);
			$('#harr').val(uparr);
			$("li[id^='optionlist-"+data[3]+"']").find('div.icon-check').remove();
			$("#optionlist-"+data[3]+"-"+id).append('<div class="icon-check"></div>');
			getTabSect(data[2]); 
			getPgOption(stid,stab,data[3],'');
			var arr2 = document.getElementById("harr").value; arr2=JSON.parse(arr2); var collr=arr2['ocollar'];
			var vw=$("#sview").val();
			if(vw=="open" && (collr!=21 && collr!=22 && collr!=23 && collr!=26 && collr!=27)){ designOpenProcessing(); } else { designProcessing(); } 
			setTimeout($(".et-small-loader").fadeOut(),50);
	   }
    });
}
function getbutton(id,otab){
    var arr = document.getElementById("harr").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       url:'/getshirtbutton',
       data:{fabid : id, carr : arr, typ : '12', rurl : url, t : otab},
	   beforeSend: function() { $(".et-small-loader").show(); },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){ 
			var stid="menu-"+data[3];
			var stab=data[2]; 
			var newarr=data[4];
			var uparr=JSON.stringify(data[4]);
			$('#tabActiveId').val(data[2]);
			$('#tabSActiveId').val(data[3]);
			$('#harr').val(uparr);
			$("#fullstyle").html(data[5]);
			$("#fullcontrast").html(data[6]);
			$("li[id^='optionlist-"+data[3]+"']").find('div.icon-check').remove();
			$("#optionlist-"+data[3]+"-"+id).append('<div class="icon-check"></div>');
			getTabSect(data[2]); 
			getPgOption(stid,stab,data[3],'');
			var arr2 = document.getElementById("harr").value; arr2=JSON.parse(arr2); var collr=arr2['ocollar'];
			var vw=$("#sview").val();
			if(vw=="open" && (collr!=21 && collr!=22 && collr!=23 && collr!=26 && collr!=27)){ designOpenProcessing(); } else { designProcessing(); } 
			setTimeout($(".et-small-loader").fadeOut(),50); 
	   }
    });
}
function getthread(id,otab){
    var arr = document.getElementById("harr").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       url:'/getshirtthreads',
       data:{fabid : id, carr : arr, typ : '12', rurl : url, t : otab},
	   beforeSend: function() { $(".et-small-loader").show(); },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){
		   	var stid="menu-"+data[3];
			var stab=data[2]; 
			var newarr=data[4];
			var uparr=JSON.stringify(data[4]);
			$('#tabActiveId').val(data[2]);
			$('#tabSActiveId').val(data[3]);
			$('#harr').val(uparr);
			$("#fullstyle").html(data[5]);
			$("#fullcontrast").html(data[6]);
			$("li[id^='optionlist-thrd-']").find('div.icon-check').remove();
			$("#optionlist-thrd-"+id).append('<div class="icon-check"></div>');
			getTabSect(data[2]); 
			getPgOption(stid,stab,data[3],'');
			var arr2 = document.getElementById("harr").value; arr2=JSON.parse(arr2); var collr=arr2['ocollar'];
			var vw=$("#sview").val();
			if(vw=="open" && (collr!=21 && collr!=22 && collr!=23 && collr!=26 && collr!=27)){ designOpenProcessing(); } else { designProcessing(); }
			setTimeout($(".et-small-loader").fadeOut(),50); 
		}
    });
}
function getthreadhole(id,otab){
    var arr = document.getElementById("harr").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       url:'/getshirtthrdstyle',
       data:{fabid : id, carr : arr, typ : '12', rurl : url, t : otab},
	   beforeSend: function() { $(".et-small-loader").show(); },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){ 
	   		var stid="menu-"+data[3];
			var stab=data[2]; 
			var newarr=data[4];
			var uparr=JSON.stringify(data[4]);
			$('#tabActiveId').val(data[2]);
			$('#tabSActiveId').val(data[3]);
			$('#harr').val(uparr);
			$("#fullstyle").html(data[5]);
			$("#fullcontrast").html(data[6]);
			$("li[id^='optionlist-thrdstyl-']").find('div.icon-check').remove();
			$("#optionlist-thrdstyl-"+id).append('<div class="icon-check"></div>');
			getTabSect(data[2]); 
			getPgOption(stid,stab,data[3],'');
			var arr2 = document.getElementById("harr").value; arr2=JSON.parse(arr2); var collr=arr2['ocollar'];
			var vw=$("#sview").val();
			if(vw=="open" && (collr!=21 && collr!=22 && collr!=23 && collr!=26 && collr!=27)){ designOpenProcessing(); } else { designProcessing(); }
			setTimeout($(".et-small-loader").fadeOut(),50);
	   }
    });
}
function getmonogram(id,otab){
    var arr = document.getElementById("harr").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       url:'/getshirtmonogrm',
       data:{fabid : id, carr : arr, typ : '13', rurl : url, t : otab},
	   beforeSend: function() { $(".et-small-loader").show(); },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){ 
	   		$("#fullcontrast").html(data[1]);
	   		var stid="menu-"+data[3];
			var stab=data[2]; 
			var newarr=data[4];
			var uparr=JSON.stringify(data[4]);
			$('#tabActiveId').val(data[2]);
			$('#tabSActiveId').val(data[3]);
			$('#harr').val(uparr);
			$("li[id^='optionlist-"+data[3]+"']").find('div.icon-check').remove();
			$("#optionlist-"+data[3]+"-"+id).append('<div class="icon-check"></div>');
			getTabSect(data[2]); 
			getPgOption(stid,stab,data[3],'');
			var arr2 = document.getElementById("harr").value; arr2=JSON.parse(arr2); var collr=arr2['ocollar'];
			var vw=$("#sview").val();
			if(vw=="open" && (collr!=21 && collr!=22 && collr!=23 && collr!=26 && collr!=27)){ designOpenProcessing(); } else { designProcessing(); }
			setTimeout($(".et-small-loader").fadeOut(),50);
	   }
    });
}
function getmonotext(id,otab){
    var arr = document.getElementById("harr").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       url:'/getshirtmonotxt',
       data:{fabid : id, carr : arr, typ : '13', rurl : url, t : otab},
	   beforeSend: function() { $(".et-small-loader").show(); },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){ 
	   		$("#miniview-etcontrast-13").html(data[1]);
	   		var stid="menu-"+data[3];
			var stab=data[2]; 
			var newarr=data[4];
			var uparr=JSON.stringify(data[4]);
			$('#tabActiveId').val(data[2]);
			$('#tabSActiveId').val(data[3]);
			$('#harr').val(uparr);
			getTabSect(data[2]); 
			getPgOption(stid,stab,data[3],'');
			var arr2 = document.getElementById("harr").value; arr2=JSON.parse(arr2); var collr=arr2['ocollar'];
			var vw=$("#sview").val();
			if(vw=="open" && (collr!=21 && collr!=22 && collr!=23 && collr!=26 && collr!=27)){ designOpenProcessing(); } else { designProcessing(); }
			setTimeout($(".et-small-loader").fadeOut(),50);
	   }
    });
}
function getmonotxtcolor(id,otab){
    var arr = document.getElementById("harr").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       url:'/getshirtmonocolr',
       data:{fabid : id, carr : arr, typ : '13', rurl : url, t : otab},
	   beforeSend: function() { $(".et-small-loader").show(); },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){
		   	$("#miniview-etcontrast-13").html(data[1]);
	   		var stid="menu-"+data[3];
			var stab=data[2]; 
			var newarr=data[4];
			var uparr=JSON.stringify(data[4]);
			$('#tabActiveId').val(data[2]);
			$('#tabSActiveId').val(data[3]);
			$('#harr').val(uparr);
			$("li[id^='optionlist-thrdcolr-']").find('div.icon-check').remove();
			$("#optionlist-thrdcolr-"+id).append('<div class="icon-check"></div>');
			getTabSect(data[2]); 
			getPgOption(stid,stab,data[3],'');
			var arr2 = document.getElementById("harr").value; arr2=JSON.parse(arr2); var collr=arr2['ocollar'];
			var vw=$("#sview").val();
			if(vw=="open" && (collr!=21 && collr!=22 && collr!=23 && collr!=26 && collr!=27)){ designOpenProcessing(); } else { designProcessing(); } 
			setTimeout($(".et-small-loader").fadeOut(),50);
		}
    });
}
function getseloptions(id,opt,ctyp,otab){
    var arr = document.getElementById("harr").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       url:'/getsetshirtoptions',
       data:{fabid : id, carr : arr, opttyp : opt, typ : ctyp, rurl : url, t : otab},
	   beforeSend: function() { $(".et-small-loader").show(); },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){ 
	   		var stid="menu-"+data[3];
			var stab=data[2]; 
			var newarr=data[4];
			var uparr=JSON.stringify(data[4]);
			$('#tabActiveId').val(data[2]);
			$('#tabSActiveId').val(data[3]);
			$('#harr').val(uparr);
			$("#fullstyle").html(data[5]);
			$("#fullcontrast").html(data[6]);
			$("li[id^='optionlist-thrdstyl-']").find('div.icon-check').remove();
			$("#optionlist-thrdstyl-"+id).append('<div class="icon-check"></div>');
			getTabSect(data[2]); 
			getPgOption(stid,stab,data[3],'');
			var arr2 = document.getElementById("harr").value; arr2=JSON.parse(arr2); var collr=arr2['ocollar'];
			var vw=$("#sview").val();
			if(vw=="open" && (collr!=21 && collr!=22 && collr!=23 && collr!=26 && collr!=27)){ designOpenProcessing(); } else { designProcessing(); } 
			setTimeout($(".et-small-loader").fadeOut(),50);
	   }
    });
}
function showMeasureSect(id){
	$("div[id^='menu-mesure-']").css("display","none"); $("#menu-mesure-"+id).css("display","block"); $("#etmeasurement").find("div.pt-variation div.pt-box-square").removeClass("active");
	if(id=="bodysize" || id=="standardsize"){ $("#menu-"+id).addClass("active");
		if(id=="bodysize"){  $("input#bsizeNeck").focus(); $("span#fldtitle").html("Neck"); $("span#rngfrom").html("9"); $("span#rngto").html("23");
			$("div.et-measure-image").find("figure img").attr("src",url+"/Measurment/Shirts/neck/neck.jpg");
	$("div.et-measure-video").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/neck/neck.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/neck/neck.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/neck/neck.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/neck/neck.webm" type="video/webm"></video>');
			var fview=$("#main-front-etmeasurement").find("div.pt-image-div img").attr("src"); var bview=$("#main-back-etmeasurement").find("div.pt-image-div img").attr("src"); $("input#frntviewfinal").val(fview); $("input#bkviewfinal").val(bview); var arr = document.getElementById("harr").value; $("input#setarr").val(arr);
		} else if(id=="standardsize"){
			var fview=$("#main-front-etmeasurement").find("div.pt-image-div img").attr("src"); var bview=$("#main-back-etmeasurement").find("div.pt-image-div img").attr("src"); $("input#frntviewfinal").val(fview); $("input#bkviewfinal").val(bview); var arr = document.getElementById("harr").value; $("input#setarr").val(arr);
		}
	}
}
function showRanges(ttl,frange,trange,typ){ var sizetyp=$("input[id^='bsizetyp']:checked").attr("value"); if(sizetyp=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
	var msrimg=url+"/Measurment/Shirts/"+typ+"/"+typ+".jpg"; $("div.et-measure-image").find("figure img").attr("src",msrimg);
	$("div.et-measure-video").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.webm" type="video/webm"></video>'); $("span#fldtitle").html(ttl); $("span#rngfrom").html(frange); $("span#rngto").html(trange); $("span#mtyp").html(sizetyp); }
function validateField(fid,frange,trange){ var sizetyp=$("input[id^='bsizetyp']:checked").attr("value"); var fval=$("#"+fid).val();
	if(sizetyp=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
	if(fval==""){ $("#"+fid).css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'}); } else if(fval<frange || fval>trange){ $("#"+fid).css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'}); } else { $("#"+fid).css({'border-color':'#090','box-shadow':'0px 0px 15px #090'}); } }
function addMoreSize(){ var sizedv=$("#dvsizeoption").html(); var qtydv=$("#dvqtyoption").html(); var cl=Math.floor(Math.random() * 20);
	$("#stdullst").append('<ul class="add_other_size cl'+cl+'"><li><span class="longarrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span><span></span></li><li><div class="et-btn-group"><div class="et-btn-select">'+ sizedv +'</div></div></li><li><span>Quantity :</span></li><li><div class="et-btn-group"><div class="et-btn-select">'+ qtydv +'</div></div></li><li><a href="#" onClick="javascript:delQty(\'cl'+cl+'\');"><i class="fa fa-minus-circle" aria-hidden="true"></i></a></li></ul>');}
function delQty(cl){ var clas="."+cl; $( "ul" ).remove( clas ); }
function validatebodyform(){ var typ=$("input[id^='bsizetyp']:checked").attr("value"); var rnge=""; 
	if(document.getElementById('bsizeNeck').value==""){ document.getElementById('bsizeNeck').focus(); return false; } else if(document.getElementById('bsizeNeck').value!=""){ rnge=$("#bsizeNeck").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]); if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		if(IsFloat(document.getElementById('bsizeNeck').value)==false){ $("#bsizeNeck").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'}); document.getElementById('bsizeNeck').focus(); return false; } else if(parseFloat(document.getElementById('bsizeNeck').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeNeck').value) > parseFloat(trange)){ $("#bsizeNeck").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'}); document.getElementById('bsizeNeck').focus(); return false; }
	}
	if(document.getElementById('bsizeChest').value==""){ document.getElementById('bsizeChest').focus(); return false; } else if(document.getElementById('bsizeChest').value!=""){ rnge=$("#bsizeChest").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]); if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		if(IsFloat(document.getElementById('bsizeChest').value)==false){ $("#bsizeChest").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'}); document.getElementById('bsizeChest').focus(); return false; } else if(parseFloat(document.getElementById('bsizeChest').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeChest').value) > parseFloat(trange)){ $("#bsizeChest").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'}); document.getElementById('bsizeChest').focus(); return false; }
	}
	if(document.getElementById('bsizeWaist').value==""){ document.getElementById('bsizeWaist').focus(); return false; } else if(document.getElementById('bsizeWaist').value!=""){ rnge=$("#bsizeWaist").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]); if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		if(IsFloat(document.getElementById('bsizeWaist').value)==false){ $("#bsizeWaist").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'}); document.getElementById('bsizeWaist').focus(); return false; } else if(parseFloat(document.getElementById('bsizeWaist').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeWaist').value) > parseFloat(trange)){ $("#bsizeWaist").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'}); document.getElementById('bsizeWaist').focus(); return false; }
	}
	if(document.getElementById('bsizeHip').value==""){ document.getElementById('bsizeHip').focus(); return false; } else if(document.getElementById('bsizeHip').value!=""){ rnge=$("#bsizeHip").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]); if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		if(IsFloat(document.getElementById('bsizeHip').value)==false){ $("#bsizeHip").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'}); document.getElementById('bsizeHip').focus(); return false; } else if(parseFloat(document.getElementById('bsizeHip').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeHip').value) > parseFloat(trange)){ $("#bsizeHip").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'}); document.getElementById('bsizeHip').focus(); return false; }
	}
	if(document.getElementById('bsizeLength').value==""){ document.getElementById('bsizeLength').focus(); return false; } else if(document.getElementById('bsizeLength').value!=""){ rnge=$("#bsizeLength").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]); if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		if(IsFloat(document.getElementById('bsizeLength').value)==false){ $("#bsizeLength").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'}); document.getElementById('bsizeLength').focus(); return false; } else if(parseFloat(document.getElementById('bsizeLength').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeLength').value) > parseFloat(trange)){ $("#bsizeLength").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'}); document.getElementById('bsizeLength').focus(); return false; }
	}
	if(document.getElementById('bsizeShoulder').value==""){ document.getElementById('bsizeShoulder').focus(); return false; } else if(document.getElementById('bsizeShoulder').value!=""){ rnge=$("#bsizeShoulder").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]); if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		if(IsFloat(document.getElementById('bsizeShoulder').value)==false){ $("#bsizeShoulder").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'}); document.getElementById('bsizeShoulder').focus(); return false; } else if(parseFloat(document.getElementById('bsizeShoulder').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeShoulder').value) > parseFloat(trange)){ $("#bsizeShoulder").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'}); document.getElementById('bsizeShoulder').focus(); return false; }
	}
	if(document.getElementById('bsizeSleeve').value==""){ document.getElementById('bsizeSleeve').focus(); return false; } else if(document.getElementById('bsizeSleeve').value!=""){ rnge=$("#bsizeSleeve").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]); if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		if(IsFloat(document.getElementById('bsizeSleeve').value)==false){ $("#bsizeSleeve").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'}); document.getElementById('bsizeSleeve').focus(); return false; } else if(parseFloat(document.getElementById('bsizeSleeve').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeSleeve').value) > parseFloat(trange)){ $("#bsizeSleeve").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'}); document.getElementById('bsizeSleeve').focus(); return false; }
	}
	return true;
}
function IsFloat(str){return /^((\d+(\.\d*)?)|((\d*\.)?\d+))$/.test(str);}
function navigateback(){
	var activetab=$(".nav-tabs").find("li.active a").attr("href"); var activesubtab=$(activetab).find("div.pt-variation div.active").attr("id"); var tabb=$.trim(activetab.replace('#','')); var stab=$.trim(activesubtab.replace('menu-','')); var arr = document.getElementById("harr").value; arr=JSON.parse(arr); var slvset=arr['osleeve'];

	if(tabb=="etfabric"){
		getTabSect('etfabric','');
		getPgOption('menu-fabric1','etfabric','fabric1','');
	} else if(tabb=="etstyle"){
		switch(stab){
			case "4":
				$("#etstyle").removeClass("active");
				$(".nav-tabs li").removeClass("active");
				$("a[href='#etfabric']").parent("li").addClass("active");
				getTabSect('etfabric');
				getPgOption('menu-fabric1','etfabric','fabric1','');
				break;
			case "5":
				getTabSect('etstyle');
				getPgOption('menu-4','etstyle','4','');
				break;
			case "6":
				getTabSect('etstyle');
				getPgOption('menu-5','etstyle','5','');
				break;
			case "7":
				getTabSect('etstyle');
				getPgOption('menu-6','etstyle','6','');
				break;
			case "8":
				getTabSect('etstyle');
				getPgOption('menu-7','etstyle','7','');
				break;
			case "9":
				getTabSect('etstyle');
				getPgOption('menu-8','etstyle','8','');
				break;
			case "10":
				if(slvset==3){
					getTabSect('etstyle');
					getPgOption('menu-8','etstyle','8','');
				} else {
					getTabSect('etstyle');
					getPgOption('menu-9','etstyle','9','');
				}
				break;
		}
	} else if(tabb=="etcontrast"){
		switch(stab){
			case "11":
				$("#etcontrast").removeClass("active");
				$(".nav-tabs li").removeClass("active");
				$("a[href='#etstyle']").parent("li").addClass("active");
				getTabSect('etstyle');
				getPgOption('menu-10','etstyle','10','');
				break;
			case "12":
				getTabSect('etcontrast');
				getPgOption('menu-11','etcontrast','11','');
				break;
			case "13":
				getTabSect('etcontrast');
				getPgOption('menu-12','etcontrast','12','');
				break;
		}
	}
}
function navigatenext(){
	var activetab=$(".nav-tabs").find("li.active a").attr("href");var activesubtab=$(activetab).find("div.pt-variation div.active").attr("id");var tabb=$.trim(activetab.replace('#',''));var stab=$.trim(activesubtab.replace('menu-','')); var arr = document.getElementById("harr").value; arr=JSON.parse(arr); 	var slvset=arr['osleeve'];
	
	if(tabb=="etfabric"){
		$("#etfabric").removeClass("active");
		$(".nav-tabs li").removeClass("active");
		$("a[href='#etstyle']").parent("li").addClass("active");
		getTabSect('etstyle');
		getPgOption('menu-4','etstyle','4','');
	} else if(tabb=="etstyle"){
		switch(stab){
			case "4":
				getTabSect('etstyle');
				getPgOption('menu-5','etstyle','5','');
				break;
			case "5":
				getTabSect('etstyle');
				getPgOption('menu-6','etstyle','6','');
				break;
			case "6":
				getTabSect('etstyle');
				getPgOption('menu-7','etstyle','7','');
				break;
			case "7":
				getTabSect('etstyle');
				getPgOption('menu-8','etstyle','8','');
				break;
			case "8":
				if(slvset==3){
					getTabSect('etstyle');
					getPgOption('menu-10','etstyle','10','');
				} else {
					getTabSect('etstyle');
					getPgOption('menu-9','etstyle','9','');
				}
				break;
			case "9":
				getTabSect('etstyle');
				getPgOption('menu-10','etstyle','10','');
				break;
			case "10":
				$("#etstyle").removeClass("active");
				$(".nav-tabs li").removeClass("active");
				$("a[href='#etcontrast']").parent("li").addClass("active");
				getTabSect('etcontrast');
				getPgOption('menu-11','etcontrast','11','');
				break;
		}
	} else if(tabb=="etcontrast"){
		switch(stab){
			case "11":
				getTabSect('etcontrast');
				getPgOption('menu-12','etcontrast','12','');
				break;
			case "12":
				getTabSect('etcontrast');
				getPgOption('menu-13','etcontrast','13','');
				break;
			case "13":
				$("#etcontrast").removeClass("active");
				$(".nav-tabs li").removeClass("active");
				$("a[href='#etmeasurement']").parent("li").addClass("active");
				getTabSect('etmeasurement');
				getPgOption('menu-bodysize','etmeasurement','bodysize','');
				break;
		}
	}
}
function updatefabprice(){
	var arr = document.getElementById("harr").value; arr=JSON.parse(arr); var fabprice=arr['ofabricPrice'];
	fabprice=parseFloat(fabprice);
	$(".pt-dollor").html("$"+fabprice);
}