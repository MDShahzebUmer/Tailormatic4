var retfrontsrc=[];
var retbacksrc=[];
var fcanvas = new fabric.StaticCanvas('frontcanvas');
var bcanvas = new fabric.StaticCanvas('backcanvas');

/* Main Preview Section*/
function viewMainBack(str){	document.getElementById("main-front-"+str).style.display="none"; document.getElementById("main-back-"+str).style.display="block";}
function viewMainFront(str){ document.getElementById("main-front-"+str).style.display="block"; document.getElementById("main-back-"+str).style.display="none";}
/* Main Preview Section Ends*/
/* Tab */
function getTabSect(str,jarry){
	//alert(str);
	var tabID = "#"+str;
	var otitle=$.trim(str);
	var lis = $(tabID).find('div .pt-variation');//Get collection of li's
	$.each(lis, function(){
		$(this).removeClass('active'); //Remove the active class from each li
		$(tabID).find('div .pt-variation div.pt-box-square').removeClass('active');
	});   
	$(tabID).addClass('active'); 
	$(tabID).find('div .pt-variation div:eq(0)').addClass('active');//Add active class 
	var ID=$(tabID).find('div .pt-variation div:eq(0)').attr("id");
	var idopt=ID.replace("menu-","menu-opt-");
	var ttle=$.trim(ID.replace("menu-",""));
	$("div[id^='menu-opt']").css("display","none");
	$("#"+idopt).css("display","block");
	
	if(otitle=="etfabric"){$("#menuopttitle-"+otitle).html("Choose Your Fabric : ");} else {$("#menuopttitle-"+otitle).html("Choose Your "+ ttle.charAt(0).toUpperCase() + ttle.slice(1) +" Style : ");}
	
	var itm=$("#"+idopt).find('div .et-item-list li:eq(0)').attr("id");
	//alert(itm);
	if(otitle!="etmeasurement"){ itmm=itm.split('-');itmm=$.trim(itmm[1]);showTitle(itmm,otitle);showOptionTitle(itmm,otitle,jarry);}
	
	$("div[id^='option-']").css("display","none");
	$("#option-"+ otitle +"-"+ttle).css("display","block");
	
	if(ttle=="Contrast"){
		$("figure[id^='figureimg-etcontrast-']").css("display","none");
		$("#figureimg-"+otitle+"-"+ttle).css("display","block");
	} else {
		var dsrc=$("#main-front-"+otitle).find("div.pt-image-div img").attr("src");
		$("#figureimg-"+otitle).html("<img src=\""+dsrc+"\" alt=\"\">");
		$("#figureimg-"+otitle).addClass('et-selected-full');
	}
	viewMainFront(otitle);
}
/* Page Option Functions */
function getPgOption(str,tabstr,attrnm,jid,jarry){ 
	//console.log(str);
	$(".pt-box-square").removeClass("active");
	$("#"+str).addClass("active");
	
	var optstr=str.replace("menu-","menu-opt-");
	var ttle=$.trim(str.replace("menu-",""));
	$("div[id^='menu-opt']").css("display","none");
	$("#"+optstr).css("display","block");
	
	if(tabstr=="etfabric"){$("#menuopttitle-"+tabstr).html("Choose Your Fabric : ");} else {$("#menuopttitle-"+tabstr).html("Choose Your "+ ttle.charAt(0).toUpperCase() + ttle.slice(1) +" Style : ");}
	showTitle(attrnm,tabstr);
	showOptionTitle(attrnm,tabstr,jarry);
	
	if(ttle=="Bottom" || ttle=="Collar" || ttle=="Cuffs" || ttle=="Pockets"){
		var fimgval=$("#optionlist-"+ttle+"-"+jid).find(".et-item-img").html();
		$("#figureimg-"+tabstr).html(fimgval);
		$("#figureimg-"+tabstr).removeClass('et-selected-full');
	} else if(ttle=="Contrast" || ttle=="Buttons" || ttle=="Monogram"){
		$("figure[id^='figureimg-etcontrast-']").css("display","none");
		$("#figureimg-"+tabstr+"-"+ttle).css("display","block");
	} else {
		if(ttle=="Back"){var dsrc=$("#main-back-"+tabstr).find("div.pt-image-div img").attr("src");$("#figureimg-"+tabstr).html("<img src=\""+dsrc+"\" alt=\"\">");$("#figureimg-"+tabstr).addClass('et-selected-full');} else {var dsrc=$("#main-front-"+tabstr).find("div.pt-image-div img").attr("src");			$("#figureimg-"+tabstr).html("<img src=\""+dsrc+"\" alt=\"\">");$("#figureimg-"+tabstr).addClass('et-selected-full');}
	}
	
	$("div[id^='option-']").css("display","none");
	$("#option-"+ tabstr +"-"+attrnm).css("display","block");
	
	if(attrnm=="Back"){viewMainBack(tabstr);} else {viewMainFront(tabstr);}
}
/* Page Option Functions Ends */
function showTitle(attrnm,tabstr){if(attrnm=="Sleeve"){$("#submenutitle-"+tabstr).html(attrnm);} else if(attrnm=="Front"){$("#submenutitle-"+tabstr).html(attrnm+" Style");} else if(attrnm=="Back"){$("#submenutitle-"+tabstr).html(attrnm+" Style");} else if(attrnm=="Bottom"){$("#submenutitle-"+tabstr).html(attrnm+" Style");} else if(attrnm=="Collar"){$("#submenutitle-"+tabstr).html(attrnm+" Style");} else if(attrnm=="Cuffs"){$("#submenutitle-"+tabstr).html(attrnm+" Style");} else if(attrnm=="Pockets"){$("#submenutitle-"+tabstr).html(attrnm+" Style");} else if(attrnm=="Contrast"){$("#submenutitle-"+tabstr).html("Contrast Fabric");} else if(attrnm=="Buttons"){$("#submenutitle-"+tabstr).html("Contrast & Thread");} else if(attrnm=="Monogram"){$("#submenutitle-"+tabstr).html("Monogram");}}

function showOptionTitle(attrnm,tabstr,jarry){if(attrnm=="Sleeve"){$("#optiontitle-"+tabstr).html(jarry);} else if(attrnm=="Front"){$("#optiontitle-"+tabstr).html(jarry);} else if(attrnm=="Back"){$("#optiontitle-"+tabstr).html(jarry);} else if(attrnm=="Bottom"){$("#optiontitle-"+tabstr).html(jarry);} else if(attrnm=="Collar"){$("#optiontitle-"+tabstr).html(jarry);} else if(attrnm=="Cuffs"){$("#optiontitle-"+tabstr).html(jarry);} else if(attrnm=="Pockets"){$("#optiontitle-"+tabstr).html(jarry);}}

function changeMview(str){$("div[id^='tble_']").css("display","none");$("div#tble_"+str).css("display","block");}
/* ---------------------------------------------------------------------------------------------- */
function designProcessing(jArray){
	var frontArr = {}; var backArr = {};var cwidth= 340; var cheight= 417;var imgNone = '';var fabimg = jArray['ofabric']+".png";var fabcontrastimg = jArray['ocontrast']+".png";	var dbutton = jArray['obutton']+".png";	var dthread = jArray['obuttonHole']+".png";	var dthstyle = jArray['obuttonHoleStyle']; var frontmain=""; var backmain="";var sleeves="";var sleevebtn="";var backsleev="";var shoulder="";var shoulderbtn="";var pockets="";var pocketbtn="";	var packnum=jArray['opacketCount'];	var seams="";var collar="";var frontbutton="";var bkstyle="";var darts="";var boxplacket="";var boxpleats="";var collarinner="";var innerplacket="";var outerplacket="";var backcollr="";var cuffout="";var cuffin="";var cuffbtn="";var bottomcut="";var backcuffout="";	var monogrmtext="";var monogrmcolor="";
	/* FRONT Variables */
	
	/* Bottoms */
	switch(jArray['obottom']){
		case "11":
			frontmain=url+"/Shirts/Style/Bottom/TriTab/Front/"+fabimg;
			backmain=url+"/Shirts/Style/Bottom/TriTab/Back/"+fabimg;
			if(jArray['ofront']=="5"){
				if(jArray['ofrontBoxOut']=="true"){ boxplacket=url+"/Shirts/FabricContrasts/Mix/FrontTriTabPlacket/"+fabcontrastimg; } else { boxplacket=url+"/Shirts/Style/Bottom/TriTab/Inner/"+fabimg; }
			} else { boxplacket=imgNone; }
			if(jArray['oback']=="8"){ 
				if(jArray['obackBoxOut']=="true"){ boxpleats=url+"/Shirts/FabricContrasts/Mix/BackTriTabPlacket/"+fabcontrastimg; } else { boxpleats=url+"/Shirts/Style/Bottom/TriTab/Outer/"+fabimg; }
			} else { boxpleats=imgNone; }
			if(jArray['oseams']=="true"){ seams=url+"/Shirts/Style/Front/Seams/Tritab/"+fabimg; } else { seams=imgNone; }
			break;
		case "12":
			frontmain=url+"/Shirts/Style/Bottom/Straight/Front/"+fabimg;
			backmain=url+"/Shirts/Style/Bottom/Straight/Back/"+fabimg;
			if(jArray['ofront']=="5"){
				if(jArray['ofrontBoxOut']=="true"){ boxplacket=url+"/Shirts/FabricContrasts/Mix/FrontStraightPlacket/"+fabcontrastimg; } else { boxplacket=url+"/Shirts/Style/Bottom/Straight/Inner/"+fabimg; }
			} else { boxplacket=imgNone; }
			if(jArray['oback']=="8"){ 
				if(jArray['obackBoxOut']=="true"){ boxpleats=url+"/Shirts/FabricContrasts/Mix/BackStraightPlacket/"+fabcontrastimg; } else { boxpleats=url+"/Shirts/Style/Bottom/Straight/Outer/"+fabimg; }
			} else { boxpleats=imgNone; }
			if(jArray['oseams']=="true"){ seams=url+"/Shirts/Style/Front/Seams/Straight/"+fabimg; } else { seams=imgNone; }
			break;
		case "13":
			frontmain=url+"/Shirts/Style/Bottom/StraightVents/Front/"+fabimg;
			backmain=url+"/Shirts/Style/Bottom/StraightVents/Back/"+fabimg;
			if(jArray['ofront']=="5"){
				if(jArray['ofrontBoxOut']=="true"){ boxplacket=url+"/Shirts/FabricContrasts/Mix/FrontStraightPlacket/"+fabcontrastimg; } else { boxplacket=url+"/Shirts/Style/Bottom/StraightVents/Inner/"+fabimg; }
			} else { boxplacket=imgNone; }
			if(jArray['oback']=="8"){ 
				if(jArray['obackBoxOut']=="true"){ boxpleats=url+"/Shirts/FabricContrasts/Mix/BackStraightPlacket/"+fabcontrastimg; } else { boxpleats=url+"/Shirts/Style/Bottom/StraightVents/Outer/"+fabimg; }
			} else { boxpleats=imgNone; }
			if(jArray['oseams']=="true"){ seams=url+"/Shirts/Style/Front/Seams/Straight/"+fabimg; } else { seams=imgNone; }
			break;
		default:
			frontmain=url+"/Shirts/Style/Bottom/TriTab/Front/"+fabimg;
			backmain=url+"/Shirts/Style/Bottom/TriTab/Back/"+fabimg;
			if(jArray['ofront']=="5"){
				if(jArray['ofrontBoxOut']=="true"){ boxplacket=url+"/Shirts/FabricContrasts/Mix/FrontTriTabPlacket/"+fabcontrastimg; } else { boxplacket=url+"/Shirts/Style/Bottom/TriTab/Inner/"+fabimg; }
			} else { boxplacket=imgNone; }
			if(jArray['oback']=="8"){ 
				if(jArray['obackBoxOut']=="true"){ boxpleats=url+"/Shirts/FabricContrasts/Mix/BackTriTabPlacket/"+fabcontrastimg; } else { boxpleats=url+"/Shirts/Style/Bottom/TriTab/Outer/"+fabimg; }
			} else { boxpleats=imgNone; }
			if(jArray['oseams']=="true"){ seams=url+"/Shirts/Style/Front/Seams/Tritab/"+fabimg; } else { seams=imgNone; }
			break;
	}
	
	/* Epaulettes */
	if(jArray['oshoulder']=="true"){
		shoulder=url+"/Shirts/Style/Sleeve/Epaulettes/left/"+fabimg;
		shoulderbtn=url+"/Shirts/Style/Sleeve/LongSleeve/Button/EpaulettesButton/"+dbutton;
	} else {
		shoulder=imgNone;
		shoulderbtn=imgNone;
	}
	
	/* Bottom Cut For Tri-tab */
	if((jArray['ocollarCuffIn']=="true" || jArray['ocollarCuffout']=="true" || jArray['ofrontPlacketIn']=="true" || jArray['ofrontPlacketOut']=="true" || jArray['obackBoxOut']=="true") && jArray['obottom']=="11"){ bottomcut=url+"/Shirts/FabricContrasts/Mix/BottomCut/"+fabcontrastimg; } else { bottomcut=imgNone; }
	
	/* Sleeves */
	switch(jArray['osleeve']){
		case "1":
		sleeves=url+"/Shirts/Style/Sleeve/LongSleeve/Front/"+fabimg;
		sleevebtn=imgNone;
		if(jArray['ocuff']=="34" || jArray['ocuff']=="35" || jArray['ocuff']=="36"){ cuffbtn=url+"/Shirts/Style/Cuffs/FrenchRound/Show/"+dbutton;} else { cuffbtn=imgNone;}
		backsleev=url+"/Shirts/Style/Sleeve/LongSleeve/Back/"+fabimg;
		if(jArray['ocollarCuffout']=="true"){ cuffout=url+"/Shirts/FabricContrasts/Mix/RightOutCuffLongPattern/"+fabcontrastimg; } else { cuffout=imgNone;}
		if(jArray['ocollarCuffIn']=="true"){ cuffin=url+"/Shirts/FabricContrasts/Mix/RightInCuffLongPattern/"+fabcontrastimg; } else { cuffin=url+"/Shirts/Style/Sleeve/LongSleeve/Outer/"+fabimg;}
		if(jArray['ocollarCuffout']=="true"){ backcuffout=url+"/Shirts/FabricContrasts/Mix/BackCuff/"+fabcontrastimg; } else { backcuffout=imgNone; }
		break;
		case "2":
		sleeves=url+"/Shirts/Style/Sleeve/LongSleeveRollup/Front/"+fabimg;
		sleevebtn=url+"/Shirts/Style/Sleeve/LongSleeveRollup/Button/ShowImg/"+dbutton;
		cuffbtn=imgNone;
		backsleev=url+"/Shirts/Style/Sleeve/LongSleeveRollup/Back/"+fabimg;
		if(jArray['ocollarCuffout']=="true"){ cuffout=url+"/Shirts/FabricContrasts/Mix/RightOutCuffRollPattern/"+fabcontrastimg; } else { cuffout=imgNone;}
		if(jArray['ocollarCuffIn']=="true"){ cuffin=url+"/Shirts/FabricContrasts/Mix/RightInCuffRollPattern/"+fabcontrastimg; } else { cuffin=url+"/Shirts/Style/Sleeve/LongSleeveRollup/Outer/"+fabimg;}
		if(jArray['ocollarCuffout']=="true"){ backcuffout=url+"/Shirts/FabricContrasts/Mix/BackCuff/"+fabcontrastimg; } else { backcuffout=imgNone; }
		break;
		case "3":
		sleeves=url+"/Shirts/Style/Sleeve/ShortSleeve/Front/"+fabimg;
		sleevebtn=imgNone;
		cuffbtn=imgNone;
		backsleev=url+"/Shirts/Style/Sleeve/ShortSleeve/Back/"+fabimg;
		cuffout=imgNone;	
		cuffin=imgNone;
		backcuffout=imgNone;
		break;
		default:
		sleeves=url+"/Shirts/Style/Sleeve/LongSleeve/Front/"+fabimg;
		sleevebtn=imgNone;
		if(jArray['ocuff']=="34" || jArray['ocuff']=="35" || jArray['ocuff']=="36"){ cuffbtn=url+"/Shirts/Style/Cuffs/FrenchRound/Show/"+dbutton;} else { cuffbtn=imgNone;}
		backsleev=url+"/Shirts/Style/Sleeve/LongSleeve/Back/"+fabimg;
		if(jArray['ocollarCuffout']=="true"){ cuffout=url+"/Shirts/FabricContrasts/Mix/RightOutCuffLongPattern/"+fabcontrastimg; } else { cuffout=imgNone;}
		if(jArray['ocollarCuffIn']=="true"){ cuffin=url+"/Shirts/FabricContrasts/Mix/RightInCuffLongPattern/"+fabcontrastimg; } else { cuffin=imgNone;}
		if(jArray['ocollarCuffout']=="true"){ backcuffout=url+"/Shirts/FabricContrasts/Mix/BackCuff/"+fabcontrastimg; } else { backcuffout=imgNone; }
		break;
	}
	
	/* Pockets */
	switch(jArray['opacket']){
		case "37":
			pockets=imgNone;
			pocketbtn=imgNone;
			break;
		case "38":
			if(packnum==2){
				pockets=url+"/Shirts/Style/Pockets/ClassicRound/ButtonsImg/"+fabimg;
				pocketbtn=imgNone;
			} else {
				pockets=url+"/Shirts/Style/Pockets/ClassicRound/Show/"+fabimg;
				pocketbtn=imgNone;
			}
			break;
		case "39":
			if(packnum==2){
				pockets=url+"/Shirts/Style/Pockets/ClassicAngle/ButtonsImg/"+fabimg;
				pocketbtn=imgNone;
			} else {
				pockets=url+"/Shirts/Style/Pockets/ClassicAngle/Show/"+fabimg;
				pocketbtn=imgNone;
			}
			break;
		case "40":
			if(packnum==2){
				pockets=url+"/Shirts/Style/Pockets/DiamondStraight/ButtonsImg/"+fabimg;
				pocketbtn=imgNone;
			} else {
				pockets=url+"/Shirts/Style/Pockets/DiamondStraight/Show/"+fabimg;
				pocketbtn=imgNone;
			}
			break;
		case "41":
			if(packnum==2){
				pockets=url+"/Shirts/Style/Pockets/ClassicSquare/ButtonsImg/"+fabimg;
				pocketbtn=imgNone;
			} else {
				pockets=url+"/Shirts/Style/Pockets/ClassicSquare/Show/"+fabimg;
				pocketbtn=imgNone;
			}
			break;
		case "42":
			if(packnum==2){
				pockets=url+"/Shirts/Style/Pockets/RoundFlap/ButtonsImg/"+fabimg;
				pocketbtn=url+"/Shirts/Style/Pockets/RoundFlap/Button/PocketTwoButton/"+dbutton;
			} else {
				pockets=url+"/Shirts/Style/Pockets/RoundFlap/Show/"+fabimg;
				pocketbtn=url+"/Shirts/Style/Pockets/RoundFlap/Button/PocketOneButton/"+dbutton;
			}
			break;
		case "43":
			if(packnum==2){
				pockets=url+"/Shirts/Style/Pockets/AngleFlap/ButtonsImg/"+fabimg;
				pocketbtn=url+"/Shirts/Style/Pockets/AngleFlap/Button/PocketTwoButton/"+dbutton;
			} else {
				pockets=url+"/Shirts/Style/Pockets/AngleFlap/Show/"+fabimg;
				pocketbtn=url+"/Shirts/Style/Pockets/AngleFlap/Button/PocketOneButton/"+dbutton;
			}
			break;
		case "44":
			if(packnum==2){
				pockets=url+"/Shirts/Style/Pockets/DiamondFlap/ButtonsImg/"+fabimg;
				pocketbtn=url+"/Shirts/Style/Pockets/DiamondFlap/Button/PocketTwoButton/"+dbutton;
			} else {
				pockets=url+"/Shirts/Style/Pockets/DiamondFlap/Show/"+fabimg;
				pocketbtn=url+"/Shirts/Style/Pockets/DiamondFlap/Button/PocketOneButton/"+dbutton;
			}
			break;
		case "45":
			if(packnum==2){
				pockets=url+"/Shirts/Style/Pockets/Roundwithglass/ButtonsImg/"+fabimg;
				pocketbtn=imgNone;
			} else {
				pockets=url+"/Shirts/Style/Pockets/Roundwithglass/Show/"+fabimg;
				pocketbtn=imgNone;
			}
			break;
		default:
			pockets=imgNone;
			pocketbtn=imgNone;
			break;
	}
	
	/* Front Threads */
	var frontthread="";
	if(jArray['ofront']!="6"){ frontthread=url+"/Shirts/Style/Front/BoxPlacket/Thread/"+jArray['obuttonHoleStyle']+"Front/"+dthread; } else { frontthread=imgNone;}
	
	/* Collar */
	switch(jArray['ocollar']){
		case "14":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/ItalianCollar1Button/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			if(jArray['ocollarCuffout']=="true"){ collar=url+"/Shirts/FabricContrasts/Mix/Collar/ItalianCollar1Button/mainRound/"+fabcontrastimg; } else { collar=url+"/Shirts/Style/Collar/ItalianCollar1Button/Front/"+fabimg; } 
			if(jArray['ocollarCuffIn']=="true"){ collarinner=url+"/Shirts/FabricContrasts/Mix/RightCollerIn/"+fabcontrastimg; } else { collarinner=imgNone; }
			break;
		case "15":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/ItalianCollar2Button/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			if(jArray['ocollarCuffout']=="true"){ collar=url+"/Shirts/FabricContrasts/Mix/Collar/ItalianCollar2Button/mainRound/"+fabcontrastimg; } else { collar=url+"/Shirts/Style/Collar/ItalianCollar2Button/Front/"+fabimg; } 
			if(jArray['ocollarCuffIn']=="true"){ collarinner=url+"/Shirts/FabricContrasts/Mix/RightCollerIn/"+fabcontrastimg; } else { collarinner=imgNone; }
			break;
		case "16":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/FrenchCollar1Button/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			if(jArray['ocollarCuffout']=="true"){ collar=url+"/Shirts/FabricContrasts/Mix/Collar/FrenchCollar1Button/mainRound/"+fabcontrastimg; } else { collar=url+"/Shirts/Style/Collar/FrenchCollar1Button/Front/"+fabimg; } 
			if(jArray['ocollarCuffIn']=="true"){ collarinner=url+"/Shirts/FabricContrasts/Mix/RightCollerIn/"+fabcontrastimg; } else { collarinner=imgNone; }
			break;
		case "17":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/FrenchCollar2Button/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			if(jArray['ocollarCuffout']=="true"){ collar=url+"/Shirts/FabricContrasts/Mix/Collar/FrenchCollar2Button/mainRound/"+fabcontrastimg; } else { collar=url+"/Shirts/Style/Collar/FrenchCollar2Button/Front/"+fabimg; } 
			if(jArray['ocollarCuffIn']=="true"){ collarinner=url+"/Shirts/FabricContrasts/Mix/RightCollerIn/"+fabcontrastimg; } else { collarinner=imgNone; }
			break;
		case "18":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/CutAway1Button/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			if(jArray['ocollarCuffout']=="true"){ collar=url+"/Shirts/FabricContrasts/Mix/Collar/CutAway1Button/mainRound/"+fabcontrastimg; } else { collar=url+"/Shirts/Style/Collar/CutAway1Button/Front/"+fabimg; } 
			if(jArray['ocollarCuffIn']=="true"){ collarinner=url+"/Shirts/FabricContrasts/Mix/RightCollerIn/"+fabcontrastimg; } else { collarinner=imgNone; }
			break;
		case "19":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/CutAway2Button/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			if(jArray['ocollarCuffout']=="true"){ collar=url+"/Shirts/FabricContrasts/Mix/Collar/CutAway2Button/mainRound/"+fabcontrastimg; } else { collar=url+"/Shirts/Style/Collar/CutAway2Button/Front/"+fabimg; } 
			if(jArray['ocollarCuffIn']=="true"){ collarinner=url+"/Shirts/FabricContrasts/Mix/RightCollerIn/"+fabcontrastimg; } else { collarinner=imgNone; }
			break;
		case "20":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/RoundCollar/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			if(jArray['ocollarCuffout']=="true"){ collar=url+"/Shirts/FabricContrasts/Mix/Collar/RoundCollar/mainRound/"+fabcontrastimg; } else { collar=url+"/Shirts/Style/Collar/RoundCollar/Front/"+fabimg; } 
			if(jArray['ocollarCuffIn']=="true"){ collarinner=url+"/Shirts/FabricContrasts/Mix/RightCollerIn/"+fabcontrastimg; } else { collarinner=imgNone; }
			break;
		case "21":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/ButtonDown/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			if(jArray['ocollarCuffout']=="true"){ collar=url+"/Shirts/FabricContrasts/Mix/Collar/ButtonDown/mainRound/"+fabcontrastimg; } else { collar=url+"/Shirts/Style/Collar/ButtonDown/Front/"+fabimg; } 
			if(jArray['ocollarCuffIn']=="true"){ collarinner=url+"/Shirts/FabricContrasts/Mix/RightCollerIn/"+fabcontrastimg; } else { collarinner=imgNone; }
			break;
		case "22":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/HiddenButton/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			if(jArray['ocollarCuffout']=="true"){ collar=url+"/Shirts/FabricContrasts/Mix/Collar/HiddenButton/mainRound/"+fabcontrastimg; } else { collar=url+"/Shirts/Style/Collar/HiddenButton/Front/"+fabimg; } 
			if(jArray['ocollarCuffIn']=="true"){ collarinner=url+"/Shirts/FabricContrasts/Mix/RightCollerIn/"+fabcontrastimg; } else { collarinner=imgNone; }
			break;
		case "23":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/Tab/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			if(jArray['ocollarCuffout']=="true"){ collar=url+"/Shirts/FabricContrasts/Mix/Collar/Tab/mainRound/"+fabcontrastimg; } else { collar=url+"/Shirts/Style/Collar/Tab/Front/"+fabimg; } 
			if(jArray['ocollarCuffIn']=="true"){ collarinner=url+"/Shirts/FabricContrasts/Mix/RightCollerIn/"+fabcontrastimg; } else { collarinner=imgNone; }
			break;
		case "24":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/BatmanCollar/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			if(jArray['ocollarCuffout']=="true"){ collar=url+"/Shirts/FabricContrasts/Mix/Collar/BatmanCollar/mainRound/"+fabcontrastimg; } else { collar=url+"/Shirts/Style/Collar/BatmanCollar/Front/"+fabimg; } 
			if(jArray['ocollarCuffIn']=="true"){ collarinner=url+"/Shirts/FabricContrasts/Mix/RightCollerIn/"+fabcontrastimg; } else { collarinner=imgNone; }
			break;
		case "25":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/ModernCollar/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			if(jArray['ocollarCuffout']=="true"){ collar=url+"/Shirts/FabricContrasts/Mix/Collar/ModernCollar/mainRound/"+fabcontrastimg; } else { collar=url+"/Shirts/Style/Collar/ModernCollar/Front/"+fabimg; } 
			if(jArray['ocollarCuffIn']=="true"){ collarinner=url+"/Shirts/FabricContrasts/Mix/RightCollerIn/"+fabcontrastimg; } else { collarinner=imgNone; }
			break;
		case "26":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/Tuxedo/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			if(jArray['ocollarCuffout']=="true"){ collar=url+"/Shirts/FabricContrasts/Mix/Collar/Tuxedo/mainRound/"+fabcontrastimg; } else { collar=url+"/Shirts/Style/Collar/Tuxedo/Front/"+fabimg; } 
			if(jArray['ocollarCuffIn']=="true"){ collarinner=url+"/Shirts/FabricContrasts/Mix/RightCollerIn/"+fabcontrastimg; } else { collarinner=imgNone; }
			break;
		case "27":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/Band/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			if(jArray['ocollarCuffout']=="true"){ collar=url+"/Shirts/FabricContrasts/Mix/Collar/Band/mainRound/"+fabcontrastimg; } else { collar=imgNone; } 
			if(jArray['ocollarCuffIn']=="true"){ collarinner=url+"/Shirts/FabricContrasts/Mix/RightCollerIn/"+fabcontrastimg; } else { collarinner=imgNone; }
			break;
	}

	/* Back Collar */
	if(jArray['ocollarCuffout']=="true"){ backcollr=url+"/Shirts/FabricContrasts/Mix/RightBackColler/"+fabcontrastimg; } else { backcollr=imgNone;}
	
	/* Back Darts */
	switch(jArray['oback']){
		case "7":
			if(jArray['odart']=="true"){darts=url+"/Shirts/Style/Back/Drats/left/"+fabimg;} else { darts=imgNone; }
			bkstyle=imgNone;
			break;
		case "8":
			if(jArray['odart']=="true"){ darts=url+"/Shirts/Style/Back/Drats/left/"+fabimg; } else { darts=imgNone;}
			bkstyle=imgNone;
			break;
		case "9":
			darts=imgNone;
			bkstyle=url+"/Shirts/Style/Back/SidePleats/Back/"+fabimg;
			break;
		case "10":
			darts=imgNone;
			bkstyle=url+"/Shirts/Style/Back/CenterPleats/Back/"+fabimg;
			break;
	}
	
	/* Monogram*/
	if(jArray['omonogram']=="46" || jArray['omonogram']=="47" || jArray['omonogram']=="48" || jArray['omonogram']=="49"){
		if(jArray['omonogram']=="49" && jArray['osleeve']!="1"){
			var ttmono=imgNone;
		} else {
			monogrmtyp=jArray['omonogram'];
			monogrmtext=jArray['omonogramText'];
			monogrmcolor=jArray['omonogramtextColor'];
			var ttmono=monogrmtyp+":"+monogrmtext+":"+monogrmcolor
		}
	} else { monogrmtyp=imgNone; monogrmtext=imgNone; monogrmcolor=imgNone; var ttmono=imgNone;}
	
	var frontsrcs = {
		monotxt: ttmono,
		bottomcut: bottomcut,
		cuffbtn: cuffbtn,
		cuffinn: cuffin,
		cuffoutt: cuffout,
		sleevebtn: sleevebtn,
		sleeve: sleeves,
		collarin: collarinner,
		packetbttn: pocketbtn,
		packet: pockets,
		collar: collar,
		fbutton: frontbutton,
		fthread: frontthread,
		boxplacket: boxplacket,
		seams: seams,
		shoulderbttn : shoulderbtn,
		shoulder: shoulder,
		front: frontmain,
	};
	
	var backsrcs = {
		dart: darts,
		backtyp: bkstyle,
		boxpleat: boxpleats,
		backcuffout: backcuffout,
		sleeve: backsleev,
		backcollar: backcollr,
        backm: backmain,
    };
	
	$.each(frontsrcs,function(key,value){
		if(value!=""){
			retfrontsrc.push(frontsrcs[key]);
		}
	});
	fcanvas.clear();
	frontProcessing();
	
	$.each(backsrcs,function(key,value){
		if(value!=""){
			retbacksrc.push(backsrcs[key]);
		}
	});
	bcanvas.clear();
	backProcessing();
	
}

function frontProcessing(){
	var cdata = "";
	var _src = retfrontsrc.pop();
	//canvas.clear();
	if(_src.startsWith('4')==true){
		monogramProcess(_src);
	} else {
		fabric.Image.fromURL(_src, function(oImg) {
			fcanvas.add(oImg);
			cdata=fcanvas.toDataURL();
			$("div [id^='main-front-']").find("div.pt-image-div img").attr("src",cdata);
			var tbactive=$(".nav-tabs").find("li.active a").attr("href");
			var stbactive=$(tbactive).find('div .pt-variation div.active').attr("id");
			stbactive=stbactive.replace("menu-","");
			if(stbactive=="Sleeve" || stbactive=="Front") {
				$("#figureimg-etstyle img").attr("src",cdata);
			}
			if (retfrontsrc.length > 0) {
			  setTimeout(frontProcessing, 40);
			}
		});
	}
}

function backProcessing(){
	var cdata = "";
	var _src = retbacksrc.pop();
	//canvas.clear();
	fabric.Image.fromURL(_src, function(oImg) {
		bcanvas.add(oImg);
		cdata=bcanvas.toDataURL();
		$("div [id^='main-back-']").find("div.pt-image-div img").attr("src",cdata);
		var tbactive=$(".nav-tabs").find("li.active a").attr("href");
		var stbactive=$(tbactive).find('div .pt-variation div.active').attr("id");
		stbactive=stbactive.replace("menu-","");
		if(stbactive=="Back") {
			$("#figureimg-etstyle img").attr("src",cdata);
		}
		
		if (retbacksrc.length > 0) {
		  setTimeout(backProcessing, 40);
		}
	});
}

function monogramProcess(mtotal){
	var cdata = ""; 
	mtotal=mtotal.split(':');
	var mtyp=$.trim(mtotal[0]);
	var mtext=$.trim(mtotal[1]);
	var mcolor=$.trim(mtotal[2]);
	var text="";
	if((mtyp!="" || mtyp!="1") && mtext!=""){
		if(mtyp=="46"){
			text = new fabric.Text(mtext, { left: 177, top: 230, fontFamily: 'Mtcorsva', fontStyle: 'italic', fontSize: 10, fill: mcolor });
		} else if(mtyp=="47"){
			text = new fabric.Text(mtext, { left: 177, top: 130, fontFamily: 'Mtcorsva', fontStyle: 'italic', fontSize: 10, fill: mcolor });
		} else if(mtyp=="48"){
			text = new fabric.Text(mtext, { left: 177, top: 142, fontFamily: 'Mtcorsva', fontStyle: 'italic', fontSize: 10, fill: mcolor });
		} else if(mtyp=="49"){
			text = new fabric.Text(mtext, { left: 192, top: 267, fontFamily: 'Mtcorsva', fontStyle: 'italic', fontSize: 10, fill: mcolor, angle: 65 });
		}
		fcanvas.add(text);
		cdata=fcanvas.toDataURL();
		$("div [id^='main-front-']").find("div.pt-image-div img").attr("src",cdata);
		var tbactive=$(".nav-tabs").find("li.active a").attr("href");
		var stbactive=$(tbactive).find('div .pt-variation div.active').attr("id");
		stbactive=stbactive.replace("menu-","");
		if(stbactive=="Sleeve" || stbactive=="Front") {
			$("#figureimg-etstyle img").attr("src",cdata);
		}
	}
}

function designOpenProcessing(jArray){
	var frontArr = {}; var backArr = {};var cwidth= 340;var cheight= 417;var imgNone = '';var fabimg = jArray['ofabric']+".png";var fabcontrastimg = jArray['ocontrast']+".png";	var dbutton = jArray['obutton']+".png";	var dthread = jArray['obuttonHole']+".png";	var dthstyle = jArray['obuttonHoleStyle'];var frontmain="";var backmain="";var sleeves="";var sleevebtn="";var backsleev="";var shoulder="";var shoulderbtn="";var pockets="";var pocketbtn="";	var packnum=jArray['opacketCount'];var seams="";var collar="";var frontbutton="";var bkstyle="";var darts="";var boxplacket="";var boxpleats="";var collarouter="";var collarinner="";var collarrightin="";var collarleftin="";var innerplacket="";var outerplacket="";var backcollr="";var cuffout="";	var cuffin="";var cuffbtn="";var bottomcut="";var backcuffout="";
	/* Collar Band */
	collarleftin=url+"/Shirts/Fabric/CollerBandIn/"+fabimg;
	
	/* Bottoms */
	switch(jArray['obottom']){
		case "11":
			frontmain=url+"/Shirts/Style/Bottom/TriTab/Front/"+fabimg;
			backmain=url+"/Shirts/Style/Bottom/TriTab/Back/"+fabimg;
			if(jArray['ofront']=="5"){
				if(jArray['ofrontBoxOut']=="true"){ boxplacket=url+"/Shirts/FabricContrasts/Mix/FrontTriTabPlacket/"+fabcontrastimg; } else { boxplacket=url+"/Shirts/Style/Bottom/TriTab/Inner/"+fabimg; }
			} else { boxplacket=imgNone; }
			if(jArray['oback']=="8"){ 
				if(jArray['obackBoxOut']=="true"){ boxpleats=url+"/Shirts/FabricContrasts/Mix/BackTriTabPlacket/"+fabcontrastimg; } else { boxpleats=url+"/Shirts/Style/Bottom/TriTab/Outer/"+fabimg; }
			} else { boxpleats=imgNone; }
			if(jArray['oseams']=="true"){ seams=url+"/Shirts/Style/Front/Seams/Tritab/"+fabimg; } else { seams=imgNone; }
			break;
		case "12":
			frontmain=url+"/Shirts/Style/Bottom/Straight/Front/"+fabimg;
			backmain=url+"/Shirts/Style/Bottom/Straight/Back/"+fabimg;
			if(jArray['ofront']=="5"){
				if(jArray['ofrontBoxOut']=="true"){ boxplacket=url+"/Shirts/FabricContrasts/Mix/FrontStraightPlacket/"+fabcontrastimg; } else { boxplacket=url+"/Shirts/Style/Bottom/Straight/Inner/"+fabimg; }
			} else { boxplacket=imgNone; }
			if(jArray['oback']=="8"){ 
				if(jArray['obackBoxOut']=="true"){ boxpleats=url+"/Shirts/FabricContrasts/Mix/BackStraightPlacket/"+fabcontrastimg; } else { boxpleats=url+"/Shirts/Style/Bottom/Straight/Outer/"+fabimg; }
			} else { boxpleats=imgNone; }
			if(jArray['oseams']=="true"){ seams=url+"/Shirts/Style/Front/Seams/Straight/"+fabimg; } else { seams=imgNone; }
			break;
		case "13":
			frontmain=url+"/Shirts/Style/Bottom/StraightVents/Front/"+fabimg;
			backmain=url+"/Shirts/Style/Bottom/StraightVents/Back/"+fabimg;
			if(jArray['ofront']=="5"){
				if(jArray['ofrontBoxOut']=="true"){ boxplacket=url+"/Shirts/FabricContrasts/Mix/FrontStraightPlacket/"+fabcontrastimg; } else { boxplacket=url+"/Shirts/Style/Bottom/StraightVents/Inner/"+fabimg; }
			} else { boxplacket=imgNone; }
			if(jArray['oback']=="8"){ 
				if(jArray['obackBoxOut']=="true"){ boxpleats=url+"/Shirts/FabricContrasts/Mix/BackStraightPlacket/"+fabcontrastimg; } else { boxpleats=url+"/Shirts/Style/Bottom/StraightVents/Outer/"+fabimg; }
			} else { boxpleats=imgNone; }
			if(jArray['oseams']=="true"){ seams=url+"/Shirts/Style/Front/Seams/Straight/"+fabimg; } else { seams=imgNone; }
			break;
		default:
			frontmain=url+"/Shirts/Style/Bottom/TriTab/Front/"+fabimg;
			backmain=url+"/Shirts/Style/Bottom/TriTab/Back/"+fabimg;
			if(jArray['ofront']=="5"){
				if(jArray['ofrontBoxOut']=="true"){ boxplacket=url+"/Shirts/FabricContrasts/Mix/FrontTriTabPlacket/"+fabcontrastimg; } else { boxplacket=url+"/Shirts/Style/Bottom/TriTab/Inner/"+fabimg; }
			} else { boxplacket=imgNone; }
			if(jArray['oback']=="8"){ 
				if(jArray['obackBoxOut']=="true"){ boxpleats=url+"/Shirts/FabricContrasts/Mix/BackTriTabPlacket/"+fabcontrastimg; } else { boxpleats=url+"/Shirts/Style/Bottom/TriTab/Outer/"+fabimg; }
			} else { boxpleats=imgNone; }
			if(jArray['oseams']=="true"){ seams=url+"/Shirts/Style/Front/Seams/Tritab/"+fabimg; } else { seams=imgNone; }
			break;
	}
	
	/* Epaulettes */
	if(jArray['oshoulder']=="true"){
		shoulder=url+"/Shirts/Style/Sleeve/Epaulettes/left/"+fabimg;
		shoulderbtn=url+"/Shirts/Style/Sleeve/LongSleeve/Button/EpaulettesButton/"+dbutton;
	} else {
		shoulder=imgNone;
		shoulderbtn=imgNone;
	}
	
	/* Bottom Cut For Tri-tab */
	if((jArray['ocollarCuffIn']=="true" || jArray['ocollarCuffout']=="true" || jArray['ofrontPlacketIn']=="true" || jArray['ofrontPlacketOut']=="true" || jArray['obackBoxOut']=="true") && jArray['obottom']=="11"){ bottomcut=url+"/Shirts/FabricContrasts/Mix/BottomCut/"+fabcontrastimg; } else { bottomcut=imgNone; }
	
	/* Sleeves */
	switch(jArray['osleeve']){
		case "1":
		sleeves=url+"/Shirts/Style/Sleeve/LongSleeve/Front/"+fabimg;
		sleevebtn=imgNone;
		if(jArray['ocuff']=="34" || jArray['ocuff']=="35" || jArray['ocuff']=="36"){ cuffbtn=url+"/Shirts/Style/Cuffs/FrenchRound/Show/"+dbutton;} else { cuffbtn=imgNone;}
		backsleev=url+"/Shirts/Style/Sleeve/LongSleeve/Back/"+fabimg;
		if(jArray['ocollarCuffout']=="true"){ cuffout=url+"/Shirts/FabricContrasts/Mix/RightOutCuffLongPattern/"+fabcontrastimg; } else { cuffout=imgNone;}
		if(jArray['ocollarCuffIn']=="true"){ cuffin=url+"/Shirts/FabricContrasts/Mix/RightInCuffLongPattern/"+fabcontrastimg; } else { cuffin=url+"/Shirts/Style/Sleeve/LongSleeve/Outer/"+fabimg;}
		if(jArray['ocollarCuffout']=="true"){ backcuffout=url+"/Shirts/FabricContrasts/Mix/BackCuff/"+fabcontrastimg; } else { backcuffout=imgNone; }
		break;
		case "2":
		sleeves=url+"/Shirts/Style/Sleeve/LongSleeveRollup/Front/"+fabimg;
		sleevebtn=url+"/Shirts/Style/Sleeve/LongSleeveRollup/Button/ShowImg/"+dbutton;
		cuffbtn=imgNone;
		backsleev=url+"/Shirts/Style/Sleeve/LongSleeveRollup/Back/"+fabimg;
		if(jArray['ocollarCuffout']=="true"){ cuffout=url+"/Shirts/FabricContrasts/Mix/RightOutCuffRollPattern/"+fabcontrastimg; } else { cuffout=imgNone;}
		if(jArray['ocollarCuffIn']=="true"){ cuffin=url+"/Shirts/FabricContrasts/Mix/RightInCuffRollPattern/"+fabcontrastimg; } else { cuffin=url+"/Shirts/Style/Sleeve/LongSleeveRollup/Outer/"+fabimg;}
		if(jArray['ocollarCuffout']=="true"){ backcuffout=url+"/Shirts/FabricContrasts/Mix/BackCuff/"+fabcontrastimg; } else { backcuffout=imgNone; }
		break;
		case "3":
		sleeves=url+"/Shirts/Style/Sleeve/ShortSleeve/Front/"+fabimg;
		sleevebtn=imgNone;
		cuffbtn=imgNone;
		backsleev=url+"/Shirts/Style/Sleeve/ShortSleeve/Back/"+fabimg;
		cuffout=imgNone;	
		cuffin=imgNone;
		backcuffout=imgNone;
		break;
		default:
		sleeves=url+"/Shirts/Style/Sleeve/LongSleeve/Front/"+fabimg;
		sleevebtn=imgNone;
		if(jArray['ocuff']=="34" || jArray['ocuff']=="35" || jArray['ocuff']=="36"){ cuffbtn=url+"/Shirts/Style/Cuffs/FrenchRound/Show/"+dbutton;} else { cuffbtn=imgNone;}
		backsleev=url+"/Shirts/Style/Sleeve/LongSleeve/Back/"+fabimg;
		if(jArray['ocollarCuffout']=="true"){ cuffout=url+"/Shirts/FabricContrasts/Mix/RightOutCuffLongPattern/"+fabcontrastimg; } else { cuffout=imgNone;}
		if(jArray['ocollarCuffIn']=="true"){ cuffin=url+"/Shirts/FabricContrasts/Mix/RightInCuffLongPattern/"+fabcontrastimg; } else { cuffin=imgNone;}
		if(jArray['ocollarCuffout']=="true"){ backcuffout=url+"/Shirts/FabricContrasts/Mix/BackCuff/"+fabcontrastimg; } else { backcuffout=imgNone; }
		break;
	}
	
	/* Pockets */
	switch(jArray['opacket']){
		case "37":
			pockets=imgNone;
			pocketbtn=imgNone;
			break;
		case "38":
			if(packnum==2){
				pockets=url+"/Shirts/Style/Pockets/ClassicRound/ButtonsImg/"+fabimg;
				pocketbtn=imgNone;
			} else {
				pockets=url+"/Shirts/Style/Pockets/ClassicRound/Show/"+fabimg;
				pocketbtn=imgNone;
			}
			break;
		case "39":
			if(packnum==2){
				pockets=url+"/Shirts/Style/Pockets/ClassicAngle/ButtonsImg/"+fabimg;
				pocketbtn=imgNone;
			} else {
				pockets=url+"/Shirts/Style/Pockets/ClassicAngle/Show/"+fabimg;
				pocketbtn=imgNone;
			}
			break;
		case "40":
			if(packnum==2){
				pockets=url+"/Shirts/Style/Pockets/DiamondStraight/ButtonsImg/"+fabimg;
				pocketbtn=imgNone;
			} else {
				pockets=url+"/Shirts/Style/Pockets/DiamondStraight/Show/"+fabimg;
				pocketbtn=imgNone;
			}
			break;
		case "41":
			if(packnum==2){
				pockets=url+"/Shirts/Style/Pockets/ClassicSquare/ButtonsImg/"+fabimg;
				pocketbtn=imgNone;
			} else {
				pockets=url+"/Shirts/Style/Pockets/ClassicSquare/Show/"+fabimg;
				pocketbtn=imgNone;
			}
			break;
		case "42":
			if(packnum==2){
				pockets=url+"/Shirts/Style/Pockets/RoundFlap/ButtonsImg/"+fabimg;
				pocketbtn=url+"/Shirts/Style/Pockets/RoundFlap/Button/PocketTwoButton/"+dbutton;
			} else {
				pockets=url+"/Shirts/Style/Pockets/RoundFlap/Show/"+fabimg;
				pocketbtn=url+"/Shirts/Style/Pockets/RoundFlap/Button/PocketOneButton/"+dbutton;
			}
			break;
		case "43":
			if(packnum==2){
				pockets=url+"/Shirts/Style/Pockets/AngleFlap/ButtonsImg/"+fabimg;
				pocketbtn=url+"/Shirts/Style/Pockets/AngleFlap/Button/PocketTwoButton/"+dbutton;
			} else {
				pockets=url+"/Shirts/Style/Pockets/AngleFlap/Show/"+fabimg;
				pocketbtn=url+"/Shirts/Style/Pockets/AngleFlap/Button/PocketOneButton/"+dbutton;
			}
			break;
		case "44":
			if(packnum==2){
				pockets=url+"/Shirts/Style/Pockets/DiamondFlap/ButtonsImg/"+fabimg;
				pocketbtn=url+"/Shirts/Style/Pockets/DiamondFlap/Button/PocketTwoButton/"+dbutton;
			} else {
				pockets=url+"/Shirts/Style/Pockets/DiamondFlap/Show/"+fabimg;
				pocketbtn=url+"/Shirts/Style/Pockets/DiamondFlap/Button/PocketOneButton/"+dbutton;
			}
			break;
		case "45":
			if(packnum==2){
				pockets=url+"/Shirts/Style/Pockets/Roundwithglass/ButtonsImg/"+fabimg;
				pocketbtn=imgNone;
			} else {
				pockets=url+"/Shirts/Style/Pockets/Roundwithglass/Show/"+fabimg;
				pocketbtn=imgNone;
			}
			break;
		default:
			pockets=imgNone;
			pocketbtn=imgNone;
			break;
	}
	
	/* Front Threads */
	var frontthread="";
	if(jArray['ofront']!="6"){ frontthread=url+"/Shirts/Style/Front/BoxPlacket/Thread/"+jArray['obuttonHoleStyle']+"Front/"+dthread; } else { frontthread=imgNone;}
	
	/* Collar */
	switch(jArray['ocollar']){
		case "14":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/ItalianCollar1Button/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			collar=url+"/Shirts/Style/Collar/ItalianCollar1Button/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/ItalianCollar1Button/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/ItalianCollar1Button/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg;
			break;
		case "15":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/ItalianCollar2Button/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			collar=url+"/Shirts/Style/Collar/ItalianCollar2Button/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/ItalianCollar2Button/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/ItalianCollar2Button/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg;
			break;
		case "16":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/FrenchCollar1Button/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			collar=url+"/Shirts/Style/Collar/FrenchCollar1Button/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/FrenchCollar1Button/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/FrenchCollar1Button/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg;
			break;
		case "17":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/FrenchCollar2Button/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			collar=url+"/Shirts/Style/Collar/FrenchCollar2Button/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/FrenchCollar2Button/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/FrenchCollar2Button/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg;
			break;
		case "18":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/CutAway1Button/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			collar=url+"/Shirts/Style/Collar/CutAway1Button/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/CutAway1Button/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/CutAway1Button/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg;
			break;
		case "19":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/CutAway2Button/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			collar=url+"/Shirts/Style/Collar/CutAway2Button/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/CutAway2Button/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/CutAway2Button/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg;
			break;
		case "20":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/RoundCollar/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			collar=url+"/Shirts/Style/Collar/RoundCollar/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/RoundCollar/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/RoundCollar/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg;
			break;
		case "21":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/ButtonDown/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			collar=url+"/Shirts/Style/Collar/ButtonDown/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/ButtonDown/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/ButtonDown/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg;
			break;
		case "22":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/HiddenButton/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			collar=url+"/Shirts/Style/Collar/HiddenButton/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/HiddenButton/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/HiddenButton/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg;
			break;
		case "23":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/Tab/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			collar=url+"/Shirts/Style/Collar/Tab/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/Tab/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/Tab/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg;
			break;
		case "24":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/BatmanCollar/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			collar=url+"/Shirts/Style/Collar/BatmanCollar/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/BatmanCollar/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/BatmanCollar/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg;
			break;
		case "25":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/ModernCollar/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			collar=url+"/Shirts/Style/Collar/ModernCollar/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/ModernCollar/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/ModernCollar/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg;
			break;
		case "26":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/Tuxedo/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			collar=url+"/Shirts/Style/Collar/Tuxedo/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/Tuxedo/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/Tuxedo/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg;
			break;
		case "27":
			if(jArray['ofront']!="6"){ frontbutton=url+"/Shirts/Style/Collar/Band/Button/ShowImg/"+dbutton; } else { frontbutton=imgNone;}
			collar=imgNone;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/Band/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/Band/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg;
			break;
	}
	
	/* Plackets */
	if(jArray['ofrontPlacketIn']=="true"){ innerplacket=url+"/Shirts/FabricContrasts/Mix/RightFrontIn/"+fabcontrastimg; } else { innerplacket=imgNone;}
	if(jArray['ofrontPlacketOut']=="true"){ outerplacket=url+"/Shirts/FabricContrasts/Mix/RightFrontOut/"+fabcontrastimg; } else { outerplacket=imgNone;}
	
	/* Back Collar */
	if(jArray['ocollarCuffout']=="true"){ backcollr=url+"/Shirts/FabricContrasts/Mix/RightBackColler/"+fabcontrastimg; } else { backcollr=imgNone;}
	
	/* Back Darts */
	switch(jArray['oback']){
		case "7":
			if(jArray['odart']=="true"){ darts=url+"/Shirts/Style/Back/Drats/left/"+fabimg;	} else {darts=imgNone;}
			bkstyle=imgNone;
			break;
		case "8":
			if(jArray['odart']=="true"){ darts=url+"/Shirts/Style/Back/Drats/left/"+fabimg;} else { darts=imgNone;}
			bkstyle=imgNone;
			break;
		case "9":
			darts=imgNone;
			bkstyle=url+"/Shirts/Style/Back/SidePleats/Back/"+fabimg;
			break;
		case "10":
			darts=imgNone;
			bkstyle=url+"/Shirts/Style/Back/CenterPleats/Back/"+fabimg;
			break;
	}
	
	/* Monogram*/
	if(jArray['omonogram']=="46" || jArray['omonogram']=="47" || jArray['omonogram']=="48" || jArray['omonogram']=="49"){
		if(jArray['omonogram']=="49" && jArray['osleeve']!="1"){
			var ttmono=imgNone;
		} else {
			monogrmtyp=jArray['omonogram'];
			monogrmtext=jArray['omonogramText'];
			monogrmcolor=jArray['omonogramtextColor'];
			var ttmono=monogrmtyp+":"+monogrmtext+":"+monogrmcolor
		}
	} else { monogrmtyp=imgNone; monogrmtext=imgNone; monogrmcolor=imgNone; var ttmono=imgNone;}
	
	var frontsrcs = {
		monotxt: ttmono,
		bottomcut: bottomcut,
		cuffbtn: cuffbtn,
		cuffinn: cuffin,
		cuffoutt: cuffout,
		sleevebtn: sleevebtn,
		sleeve: sleeves,
		collarright: collarrightin,
		collarout: collarouter,
		collarleftin:collarleftin,
		frontplacketin: innerplacket,
		frontplacketout: outerplacket,
		collarin: collarinner,
		fbutton: frontbutton,
		fthread: frontthread,
		packetbttn: pocketbtn,
		packet: pockets,
		boxplacket: boxplacket,
		seams: seams,
		shoulderbttn : shoulderbtn,
		shoulder: shoulder,
        front: frontmain,
    };
	
	var backsrcs = {
		dart: darts,
		backtyp: bkstyle,
		boxpleat: boxpleats,
		backcuffout: backcuffout,
		sleeve: backsleev,
		backcollar: backcollr,
        backm: backmain,
    };
	
	$.each(frontsrcs,function(key,value){
		if(value!=""){
			retfrontsrc.push(frontsrcs[key]);
		}
	});
	fcanvas.clear();
	frontProcessing();
	
	$.each(backsrcs,function(key,value){
		if(value!=""){
			retbacksrc.push(backsrcs[key]);
		}
	});
	bcanvas.clear();
	backProcessing();
}

/* ----------------------------------Option Selection Functions---------------------------------- */
function getfab(id,jArray,otab){	
    var arr=jArray;
    $.ajax({
       type:'POST',
       url:'/designshirts',
       data:{fabid : id, carr : arr, typ : 'fabric', t : otab},
	   beforeSend: function() {
		  $(".et-small-loader").show();
	   },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){		   
		   	$('body').html(data);
			setTimeout($(".et-small-loader").fadeOut(),1000);
       }
    });
}
function getstyles(id,ctyp,jArray,otab){
    var arr=jArray;
    $.ajax({
       type:'POST',
       url:'/designshirts',
       data:{fabid : id, carr : arr, typ : ctyp, t : otab},
	   beforeSend: function() {
		  $(".et-small-loader").show();
	   },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){
			$('body').html(data);
			setTimeout($(".et-small-loader").fadeOut(),1000);
	   }
    });
}
function getcontrast(id,jArray,otab){
    var arr=jArray;
    $.ajax({
       type:'POST',
       url:'/designshirts',
       data:{fabid : id, carr : arr, typ : 'Contrast', t : otab},
	   beforeSend: function() {
		  $(".et-small-loader").show();
	   },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){		    
		  $('body').html(data);
		  setTimeout($(".et-small-loader").fadeOut(),1000);
       }
    });
}
function getbutton(id,jArray,otab){
    var arr=jArray;
    $.ajax({
       type:'POST',
       url:'/designshirts',
       data:{fabid : id, carr : arr, typ : 'Buttons', t : otab},
	   beforeSend: function() {
		  $(".et-small-loader").show();
	   },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){		    
		   $('body').html(data);
		   setTimeout($(".et-small-loader").fadeOut(),1000);
       }
    });
}
function getthread(id,jArray,otab){
    var arr=jArray;
    $.ajax({
       type:'POST',
       url:'/designshirts',
       data:{fabid : id, carr : arr, typ : 'Threads', t : otab},
	   beforeSend: function() {
		  $(".et-small-loader").show();
	   },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){		    
		   	$('body').html(data);
			setTimeout($(".et-small-loader").fadeOut(),1000);
       }
    });
}
function getthreadhole(id,jArray){
    var arr=jArray;
	var otab="etcontrast";
    $.ajax({
       type:'POST',
       url:'/designshirts',
       data:{fabid : id, carr : arr, typ : 'ThreadStyle', t : otab},
	   beforeSend: function() {
		  $(".et-small-loader").show();
	   },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){		    
		   $('body').html(data);
		   setTimeout($(".et-small-loader").fadeOut(),1000);
       }
    });
}
function getmonogram(id,jArray,otab){
    var arr=jArray;
    $.ajax({
       type:'POST',
       url:'/designshirts',
       data:{fabid : id, carr : arr, typ : 'Monogram', t : otab},
	   beforeSend: function() {
		  $(".et-small-loader").show();
	   },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){		    
		  $('body').html(data);
		  setTimeout($(".et-small-loader").fadeOut(),1000);
       }
    });
}
function getmonotext(id,jArray,otab){
    var arr=jArray;
    $.ajax({
       type:'POST',
       url:'/designshirts',
       data:{fabid : id, carr : arr, typ : 'MonoText', t : otab},
	   beforeSend: function() {
		  $(".et-small-loader").show();
	   },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){		    
		   $('body').html(data);
		   setTimeout($(".et-small-loader").fadeOut(),1000);
       }
    });
}
function getmonotxtcolor(id,jArray,otab){
    var arr=jArray;
    $.ajax({
       type:'POST',
       url:'/designshirts',
       data:{fabid : id, carr : arr, typ : 'MonoColor', t : otab},
	   beforeSend: function() {
		  $(".et-small-loader").show();
	   },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){		    
		   $('body').html(data);
		   setTimeout($(".et-small-loader").fadeOut(),1000);
       }
    });
}
function getseloptions(id,ctyp,jArray,otab){
    var arr=jArray;
    $.ajax({
       type:'POST',
       url:'/designshirts',
       data:{fabid : id, carr : arr, typ : ctyp, t : otab},
	   beforeSend: function() {
		  $(".et-small-loader").show();
	   },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){		    
		   $('body').html(data);
		   setTimeout($(".et-small-loader").fadeOut(),1000);
       }
    });
}

function showMeasureSect(id){
	$("div[id^='menu-mesure-']").css("display","none");
	$("#menu-mesure-"+id).css("display","block");
	
	$("#etmeasurement").find("div.pt-variation div.pt-box-square").removeClass("active");
	if(id=="bodysize" || id=="standardsize"){
		$("#menu-"+id).addClass("active");
		if(id=="bodysize"){ 
			$("input#bsizeNeck").focus();
			$("span#fldtitle").html("Neck");
			$("span#rngfrom").html("9");
			$("span#rngto").html("23");
			$("div.et-measure-image").find("figure img").attr("src",url+"/Measurment/Shirts/neck/neck.jpg");
	$("div.et-measure-video").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/neck/neck.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/neck/neck.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/neck/neck.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/neck/neck.webm" type="video/webm"></video>');
			
			var fview=$("#main-front-etmeasurement").find("div.pt-image-div img").attr("src");
			var bview=$("#main-back-etmeasurement").find("div.pt-image-div img").attr("src");
			$("input#frntviewfinal").val(fview);
			$("input#bkviewfinal").val(bview);
		} else if(id=="standardsize"){
			var fview=$("#main-front-etmeasurement").find("div.pt-image-div img").attr("src");
			var bview=$("#main-back-etmeasurement").find("div.pt-image-div img").attr("src");
			$("input#frntviewfinal").val(fview);
			$("input#bkviewfinal").val(bview);
		}
	}
}

function showRanges(ttl,frange,trange,typ){
	var sizetyp=$("input[id^='bsizetyp']:checked").attr("value");
	if(sizetyp=="cm"){
		frange=Math.round(frange*2.54,2);
		trange=Math.round(trange*2.54,2);
	} else {
		frange=frange;
		trange=trange;
	}
	var msrimg=url+"/Measurment/Shirts/"+typ+"/"+typ+".jpg";
	$("div.et-measure-image").find("figure img").attr("src",msrimg);
	$("div.et-measure-video").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.webm" type="video/webm"></video>');
	$("span#fldtitle").html(ttl);
	$("span#rngfrom").html(frange);
	$("span#rngto").html(trange);
	$("span#mtyp").html(sizetyp);
}

function validateField(fid,frange,trange){
	var sizetyp=$("input[id^='bsizetyp']:checked").attr("value");
	var fval=$("#"+fid).val();
	if(sizetyp=="cm"){
		frange=Math.round(frange*2.54,2);
		trange=Math.round(trange*2.54,2);
	} else {
		frange=frange;
		trange=trange;
	}
	
	if(fval==""){
		$("#"+fid).css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
	} else if(fval<frange || fval>trange){
		$("#"+fid).css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
	} else {
		$("#"+fid).css({'border-color':'#090','box-shadow':'0px 0px 15px #090'});
	}
}

function addMoreSize(){
	var sizedv=$("#dvsizeoption").html();
	var qtydv=$("#dvqtyoption").html();
	var cl=Math.floor(Math.random() * 20);
	$("#stdullst").append('<ul class="add_other_size cl'+cl+'"><li><span class="longarrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span><span></span></li><li><div class="et-btn-group"><div class="et-btn-select">'+ sizedv +'</div></div></li><li><span>Quantity :</span></li><li><div class="et-btn-group"><div class="et-btn-select">'+ qtydv +'</div></div></li><li><a href="#" onClick="javascript:delQty(\'cl'+cl+'\');"><i class="fa fa-minus-circle" aria-hidden="true"></i></a></li></ul>');
}

function delQty(cl){ 
	var clas="."+cl;
	$( "ul" ).remove( clas );
}

function validatebodyform(){
	var typ=$("input[id^='bsizetyp']:checked").attr("value");
	var rnge="";
	if(document.getElementById('bsizeNeck').value==""){
		document.getElementById('bsizeNeck').focus();
		return false;
	} else if(document.getElementById('bsizeNeck').value!=""){
		rnge=$("#bsizeNeck").attr("data-title").split('-');
		frange=parseFloat(rnge[0]);
		trange=parseFloat(rnge[1]);

		if(typ=="cm"){
			frange=Math.round(frange*2.54,2);
			trange=Math.round(trange*2.54,2);
		} else {
			frange=frange;
			trange=trange;
		}
		
		if(IsFloat(document.getElementById('bsizeNeck').value)==false){
			$("#bsizeNeck").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeNeck').focus();
			return false;
		} else if(parseFloat(document.getElementById('bsizeNeck').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeNeck').value) > parseFloat(trange)){
			$("#bsizeNeck").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeNeck').focus();
			return false;
		}
	}
	if(document.getElementById('bsizeChest').value==""){
		document.getElementById('bsizeChest').focus();
		return false;
	} else if(document.getElementById('bsizeChest').value!=""){
		rnge=$("#bsizeChest").attr("data-title").split('-');
		frange=parseFloat(rnge[0]);
		trange=parseFloat(rnge[1]);
		if(typ=="cm"){
			frange=Math.round(frange*2.54,2);
			trange=Math.round(trange*2.54,2);
		} else {
			frange=frange;
			trange=trange;
		}
		
		if(IsFloat(document.getElementById('bsizeChest').value)==false){
			$("#bsizeChest").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeChest').focus();
			return false;
		} else if(parseFloat(document.getElementById('bsizeChest').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeChest').value) > parseFloat(trange)){
			$("#bsizeChest").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeChest').focus();
			return false;
		}
	}
	if(document.getElementById('bsizeWaist').value==""){
		document.getElementById('bsizeWaist').focus();
		return false;
	} else if(document.getElementById('bsizeWaist').value!=""){
		rnge=$("#bsizeWaist").attr("data-title").split('-');
		frange=parseFloat(rnge[0]);
		trange=parseFloat(rnge[1]);
		if(typ=="cm"){
			frange=Math.round(frange*2.54,2);
			trange=Math.round(trange*2.54,2);
		} else {
			frange=frange;
			trange=trange;
		}
		
		if(IsFloat(document.getElementById('bsizeWaist').value)==false){
			$("#bsizeWaist").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeWaist').focus();
			return false;
		} else if(parseFloat(document.getElementById('bsizeWaist').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeWaist').value) > parseFloat(trange)){
			$("#bsizeWaist").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeWaist').focus();
			return false;
		}
	}
	if(document.getElementById('bsizeHip').value==""){
		document.getElementById('bsizeHip').focus();
		return false;
	} else if(document.getElementById('bsizeHip').value!=""){
		rnge=$("#bsizeHip").attr("data-title").split('-');
		frange=parseFloat(rnge[0]);
		trange=parseFloat(rnge[1]);
		if(typ=="cm"){
			frange=Math.round(frange*2.54,2);
			trange=Math.round(trange*2.54,2);
		} else {
			frange=frange;
			trange=trange;
		}
		
		if(IsFloat(document.getElementById('bsizeHip').value)==false){
			$("#bsizeHip").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeHip').focus();
			return false;
		} else if(parseFloat(document.getElementById('bsizeHip').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeHip').value) > parseFloat(trange)){
			$("#bsizeHip").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeHip').focus();
			return false;
		}
	}
	if(document.getElementById('bsizeLength').value==""){
		document.getElementById('bsizeLength').focus();
		return false;
	} else if(document.getElementById('bsizeLength').value!=""){
		rnge=$("#bsizeLength").attr("data-title").split('-');
		frange=parseFloat(rnge[0]);
		trange=parseFloat(rnge[1]);
		if(typ=="cm"){
			frange=Math.round(frange*2.54,2);
			trange=Math.round(trange*2.54,2);
		} else {
			frange=frange;
			trange=trange;
		}
		
		if(IsFloat(document.getElementById('bsizeLength').value)==false){
			$("#bsizeLength").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeLength').focus();
			return false;
		} else if(parseFloat(document.getElementById('bsizeLength').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeLength').value) > parseFloat(trange)){
			$("#bsizeLength").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeLength').focus();
			return false;
		}
	}
	if(document.getElementById('bsizeShoulder').value==""){
		document.getElementById('bsizeShoulder').focus();
		return false;
	} else if(document.getElementById('bsizeShoulder').value!=""){
		rnge=$("#bsizeShoulder").attr("data-title").split('-');
		frange=parseFloat(rnge[0]);
		trange=parseFloat(rnge[1]);
		if(typ=="cm"){
			frange=Math.round(frange*2.54,2);
			trange=Math.round(trange*2.54,2);
		} else {
			frange=frange;
			trange=trange;
		}
		
		if(IsFloat(document.getElementById('bsizeShoulder').value)==false){
			$("#bsizeShoulder").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeShoulder').focus();
			return false;
		} else if(parseFloat(document.getElementById('bsizeShoulder').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeShoulder').value) > parseFloat(trange)){
			$("#bsizeShoulder").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeShoulder').focus();
			return false;
		}
	}
	if(document.getElementById('bsizeSleeve').value==""){
		document.getElementById('bsizeSleeve').focus();
		return false;
	} else if(document.getElementById('bsizeSleeve').value!=""){
		rnge=$("#bsizeSleeve").attr("data-title").split('-');
		frange=parseFloat(rnge[0]);
		trange=parseFloat(rnge[1]);
		if(typ=="cm"){
			frange=Math.round(frange*2.54,2);
			trange=Math.round(trange*2.54,2);
		} else {
			frange=frange;
			trange=trange;
		}
		if(IsFloat(document.getElementById('bsizeSleeve').value)==false){
			$("#bsizeSleeve").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeSleeve').focus();
			return false;
		} else if(parseFloat(document.getElementById('bsizeSleeve').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeSleeve').value) > parseFloat(trange)){
			$("#bsizeSleeve").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeSleeve').focus();
			return false;
		}
	}
	return true;
}

function IsFloat(str){return /^((\d+(\.\d*)?)|((\d*\.)?\d+))$/.test(str);}