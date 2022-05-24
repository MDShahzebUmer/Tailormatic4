

// for jacket =====================================================================================================
var retjacketfrontsrc=[];
var retjacketbacksrc=[];
var retjacketsidesrc=[];
var fcanvasjacket = new fabric.StaticCanvas('frontcanvas');
var bcanvasjacket = new fabric.StaticCanvas('backcanvas');
var scanvasjacket = new fabric.StaticCanvas('sidecanvas');
//
/* Main Preview Section*/
function viewMainBackJacket(str){
	if(str=="etcontrastjacket"){
		document.getElementById("main-front-"+str).style.display="none"; 
		document.getElementById("main-side-"+str).style.display="none"; 
		document.getElementById("main-back-"+str).style.display="block"; 
	} else {
		document.getElementById("main-front-"+str).style.display="none"; 
		document.getElementById("main-back-"+str).style.display="block";
	}
}
function viewMainFrontJacket(str){
	if(str=="etcontrastjacket"){
		document.getElementById("main-front-"+str).style.display="block"; 
		document.getElementById("main-side-"+str).style.display="none"; 
		document.getElementById("main-back-"+str).style.display="none"; 
	} else {
		document.getElementById("main-front-"+str).style.display="block"; 
		document.getElementById("main-back-"+str).style.display="none";
	}
}
function viewMainSideJacket(str){ 
	document.getElementById("main-side-"+str).style.display="block"; 
	document.getElementById("main-front-"+str).style.display="none"; 
	document.getElementById("main-back-"+str).style.display="none";
}
/* Tab */
function getTabJacketSect(str){
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
	$("#container_jackets div[id^='menu-opt']").css("display","none");
	$("#container_jackets #"+idopt).css("display","block");
	if(otitle=="etfabricjacket"){
		$("#container_jackets #menuopttitle-"+otitle).html("Choose Your Fabric : ");
	} else {
		if(ttle=="19"){
			$("#container_jackets #menuopttitle-"+otitle).html("Choose Your Buttons :");
		} else if(ttle=="25"){
			$("#container_jackets #menuopttitle-"+otitle).html("Choose Your Contrast Fabric :");
		}
	}
	$("#container_jackets div[id^='miniview-']").css("display","none"); 
	$("#container_jackets #miniview-"+otitle+"-"+ttle).css("display","block"); 
	viewMainFrontJacket(otitle);
}
/* Page Option Functions */
function getPgJacketOption(str,tabstr,attrid,attrnm){ 
	$("#container_jackets .pt-box-square").removeClass("active"); 
	$("#container_jackets #"+str).addClass("active"); 
	var optstr=str.replace("menu-","menu-opt-"); 
	var ttle=$.trim(attrnm); 
	$("#container_jackets  div[id^='menu-opt']").css("display","none"); 
	$("#container_jackets  #"+optstr).css("display","block");
	
	if(tabstr=="etfabricjacket"){
		$("#container_jackets #menuopttitle-"+tabstr).html("Choose Your Fabric : ");
	} else {
		if(attrid=="19"){
			$("#container_jackets #menuopttitle-"+tabstr).html("Choose Your Buttons :");
		} else if(attrid=="20"){
			$("#container_jackets #menuopttitle-"+tabstr).html("Choose Your Lapel Style :");
		} else if(attrid=="21"){
			$("#container_jackets #menuopttitle-"+tabstr).html("Choose Your Bottom :");
		} else if(attrid=="22"){
			$("#container_jackets #menuopttitle-"+tabstr).html("Choose Your Pocket :");
		} else if(attrid=="23"){
			$("#container_jackets #menuopttitle-"+tabstr).html("Choose Your Sleeve Button :");
		} else if(attrid=="24"){
			$("#container_jackets #menuopttitle-"+tabstr).html("Choose Your Vent :");
		} else if(attrid=="25"){
			$("#container_jackets #menuopttitle-"+tabstr).html("Choose Your Contrast Fabric :");
		} else if(attrid=="26"){
			$("#container_jackets #menuopttitle-"+tabstr).html("Choose Your Lining Fabrics :");
		} else if(attrid=="27"){
			$("#container_jackets #menuopttitle-"+tabstr).html("Choose Your Back Collar Color :");
		} else if(attrid=="28"){
			$("#container_jackets #menuopttitle-"+tabstr).html("Choose Your Button Color :");
		} else if(attrid=="29"){
			$("#container_jackets #menuopttitle-"+tabstr).html("Enter Desired Monogram/Initials { English Script Only}");
		}
	}

	$("#container_jackets div[id^='miniview-']").css("display","none"); 
	$("#container_jackets #miniview-"+tabstr+"-"+attrid).css("display","block");
	if(attrid=="24"){
		viewMainBackJacket(tabstr);
	} else if(attrid=="26"){
		viewMainSideJacket(tabstr);
	} else {
		viewMainFrontJacket(tabstr);
	}
}
/* ---------------------------------------------------------------------------------------------- */
function sidedesignJacketProcess(jArray){
	var sideArr = {};var fabimg = jArray['ofabric']+".png";var fabcontrastimg = jArray['ocontrast']+".png";var lining = jArray['olining']+".png";var piping = jArray['opiping']+".png";var imgNone="";var mainimg="";var liningimg="";var pipingimg="";var monogrmtyp="";var monogrmtext="";var monogrmcolor="";var monospecial="";
	
	if(jArray['olapelupper']=="true" || jArray['olapellower']=="true"){mainimg=url+"/Jacket/FabricContrasts/View/"+fabcontrastimg;} else {mainimg=url+"/Jacket/Fabric/InsideView/"+fabimg;}
	liningimg=url+"/Jacket/ColorContrast/Lining/InsideView/"+lining;
	pipingimg=url+"/Jacket/ColorContrast/Piping/"+piping;
	
	var sideArr={pipingm: pipingimg,liningm: liningimg,main: mainimg,};
	$.each(sideArr,function(key,value){if(value!=""){retjacketsidesrc.push(sideArr[key]);}}); scanvasjacket.clear(); sideJacketProcessing();
}
function sideJacketProcessing(){
	var cdata = ""; var _src = retjacketsidesrc.pop();
	fabric.Image.fromURL(_src, function(oImg) {
		scanvasjacket.add(oImg); cdata=scanvasjacket.toDataURL();
		if (retjacketsidesrc.length > 0) { setTimeout(sideJacketProcessing, 40); } else{ $("div [id^='main-side-']").find("div.pt-jacketimage-div img").attr("src",cdata);
		$("#miniview-etcontrastjacket-29").css("background-image","url("+cdata+")");}
	});
}
function backdesignJacketProcess(jArray){
	var backArr = {};var fabimg = jArray['ofabric']+".png";var fabcontrastimg = jArray['ocontrast']+".png";var imgNone="";var vent="";var bkcollar="";var elbowcont=""; 
	/* VENTS */
	if(jArray['ovent']=="82"){ vent=url+"/Jacket/Style/Vent/NoVent/Front/"+fabimg;} else if(jArray['ovent']=="83"){ vent=url+"/Jacket/Style/Vent/CenterVent/Front/"+fabimg;} else if(jArray['ovent']=="84"){vent=url+"/Jacket/Style/Vent/SideVent/Front/"+fabimg;}
	/* BACKCOLLAR */
	if(jArray['olapelupper']=="true"){bkcollar=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/NotchLapel/1Button/Back/"+fabcontrastimg;} else {bkcollar=url+"/Jacket/Style/Lapel/NotchLapel/Back/"+fabimg;}
	/* ELBOW MIX */
	if(jArray['ocontelbowmix']=="true"){elbowcont=url+"/Jacket/ColorContrast/Mix/ElbowMix/Front/"+fabcontrastimg;} else {elbowcont=imgNone;}
	
	var backArr={elbow: elbowcont,backcollar: bkcollar,main: vent,};
	$.each(backArr,function(key,value){if(value!=""){retjacketbacksrc.push(backArr[key]);}}); bcanvasjacket.clear(); backJacketProcessing();
}
function backJacketProcessing(){
	var cdata = ""; var _src = retjacketbacksrc.pop();
	fabric.Image.fromURL(_src, function(oImg) {
		bcanvasjacket.add(oImg); cdata=bcanvasjacket.toDataURL();
		if (retjacketbacksrc.length > 0) { setTimeout(backJacketProcessing, 40); 
		} else {
			$("div [id^='main-back-']").find("div.pt-jacketimage-div img").attr("src",cdata);
			$("#miniview-etstylejacket-24").css("background-image","url("+cdata+")");
			$("#miniview-etcontrastjacket-27").css("background-image","url("+cdata+")");
		}
	});
}

function frontdesignJacketProcess(jArray){
	var frontArr = {}; var imgNone = '';
	// var fabimg = jArray['ofabric']+".png";
	var fabimg = jArray['ofabric']+".png";
	var fabcontrastimg = jArray['ocontrast']+".png";
	var dbutton = jArray['obutton']+".png";
	var dthread = jArray['obuttonHole']+".png";
	var lining = jArray['olining']+".png";
	var frontmain="";var buttons="";
	var thread="";var pockts="";
	var slevbtn="";
	var liningimg="";
	var lapel="";
	var lapeltop="";
	var lapelbtnhole="";
	var lapeluprcontr="";
	var lapellowrcontr="";
	var brestpockt="";
	/* BOTTOM */
	if(jArray['obottom']=="63"){frontmain=url+"/Jacket/Style/Bottom/Straight/Front/"+fabimg;} else if(jArray['obottom']=="64"){frontmain=url+"/Jacket/Style/Bottom/Curved/Front/"+fabimg;} else if(jArray['obottom']=="65"){frontmain=url+"/Jacket/Style/Bottom/SlightlyCurved/Front/"+fabimg;} else if(jArray['obottom']=="130"){frontmain=url+"/Jacket/Style/Bottom/DoubleSlightlyCurved/Front/"+fabimg;}
	/* LAPELS */
	if(jArray['ostyle']=="50"){
		if(jArray['olapel']=="59"){
			lapel=url+"/Jacket/Style/Style/1Button/PeakLapel/main/"+fabimg;
			if(jArray['olapelHole']=="true"){lapelbtnhole=url+"/Jacket/Style/Lapel/PeakLapel/Thread/ShowImg/"+dthread;}
			if(jArray['olapelupper']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/PeakLapel/1Button/Join/"+fabcontrastimg;}
			if(jArray['olapellower']=="true"){lapellowrcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/PeakLapel/1Button/Front/"+fabcontrastimg;}
		} else if(jArray['olapel']=="60"){
			lapel=url+"/Jacket/Style/Style/1Button/NotchLapel/main/"+fabimg;
			if(jArray['olapelHole']=="true"){lapelbtnhole=url+"/Jacket/Style/Lapel/NotchLapel/Thread/ShowImg/"+dthread;}
			if(jArray['olapelupper']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/NotchLapel/1Button/Join/"+fabcontrastimg;}
			if(jArray['olapellower']=="true"){lapellowrcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/NotchLapel/1Button/Front/"+fabcontrastimg;}
		} else if(jArray['olapel']=="61"){
			lapel=url+"/Jacket/Style/Style/1Button/RoundNotch/main/"+fabimg;
			if(jArray['olapelHole']=="true"){lapelbtnhole=url+"/Jacket/Style/Lapel/RoundNotch/Thread/ShowImg/"+dthread;}
			if(jArray['olapelupper']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/RoundNotch/1Button/Join/"+fabcontrastimg;}
			if(jArray['olapellower']=="true"){lapellowrcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/RoundNotch/1Button/Front/"+fabcontrastimg;}
		} else if(jArray['olapel']=="62"){
			lapel=url+"/Jacket/Style/Style/1Button/ShawlLapel/main/"+fabimg;
			if(jArray['olapelupper']=="true" || jArray['olapellower']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/ShawlLapel/1Button/Front/"+fabcontrastimg;}
		}
		if(jArray['olapelupper']=="true"){lapeltop=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/PeakLapel/1Button/Front/"+fabcontrastimg;} else { lapeltop=url+"/Jacket/Style/Lapel/PeakLapel/Front/"+fabimg;}
		if(jArray['obreastPacket']=="true"){if(jArray['ocontchestpocket']=="true"){brestpockt=url+"/Jacket/ColorContrast/Mix/ChestPocket/Style/1Button/Front/"+fabcontrastimg;} else { brestpockt=url+"/Jacket/Style/Pocket/NoBreastPocket/right/"+fabimg;}}
		liningimg=url+"/Jacket/ColorContrast/Lining/1Button/"+lining;
		thread=url+"/Jacket/Style/Style/1Button/Thread/ShowImg/"+dthread;
		buttons=url+"/Jacket/Style/Style/1Button/Button/MainImg/"+dbutton;
	} else if(jArray['ostyle']=="51"){
		if(jArray['olapel']=="59"){
			lapel=url+"/Jacket/Style/Style/2Button/PeakLapel/main/"+fabimg;
			if(jArray['olapelHole']=="true"){lapelbtnhole=url+"/Jacket/Style/Lapel/PeakLapel/Thread/ShowImg/"+dthread;}
			if(jArray['olapelupper']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/PeakLapel/2Button/Join/"+fabcontrastimg;}
			if(jArray['olapellower']=="true"){lapellowrcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/PeakLapel/2Button/Front/"+fabcontrastimg;}
		} else if(jArray['olapel']=="60"){
			lapel=url+"/Jacket/Style/Style/2Button/NotchLapel/main/"+fabimg;
			if(jArray['olapelHole']=="true"){lapelbtnhole=url+"/Jacket/Style/Lapel/NotchLapel/Thread/ShowImg/"+dthread;}
			if(jArray['olapelupper']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/NotchLapel/2Button/Join/"+fabcontrastimg;}
			if(jArray['olapellower']=="true"){lapellowrcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/NotchLapel/2Button/Front/"+fabcontrastimg;}
		} else if(jArray['olapel']=="61"){
			lapel=url+"/Jacket/Style/Style/2Button/RoundNotch/main/"+fabimg;
			if(jArray['olapelHole']=="true"){lapelbtnhole=url+"/Jacket/Style/Lapel/RoundNotch/Thread/ShowImg/"+dthread;}
			if(jArray['olapelupper']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/RoundNotch/2Button/Join/"+fabcontrastimg;}
			if(jArray['olapellower']=="true"){lapellowrcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/RoundNotch/2Button/Front/"+fabcontrastimg;}
		} else if(jArray['olapel']=="62"){
			lapel=url+"/Jacket/Style/Style/2Button/ShawlLapel/main/"+fabimg;
			if(jArray['olapelupper']=="true" || jArray['olapellower']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/ShawlLapel/2Button/Front/"+fabcontrastimg;}
		}
		if(jArray['olapelupper']=="true"){lapeltop=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/PeakLapel/2Button/Front/"+fabcontrastimg;} else { lapeltop=url+"/Jacket/Style/Lapel/PeakLapel/Front/"+fabimg;}
		if(jArray['obreastPacket']=="true"){if(jArray['ocontchestpocket']=="true"){brestpockt=url+"/Jacket/ColorContrast/Mix/ChestPocket/Style/2Button/Front/"+fabcontrastimg;} else { brestpockt=url+"/Jacket/Style/Pocket/NoBreastPocket/right/"+fabimg;}}
		liningimg=url+"/Jacket/ColorContrast/Lining/2Button/"+lining;
		thread=url+"/Jacket/Style/Style/2Button/Thread/ShowImg/"+dthread;
		buttons=url+"/Jacket/Style/Style/2Button/Button/MainImg/"+dbutton;
	} else if(jArray['ostyle']=="52"){
		if(jArray['olapel']=="59"){
			lapel=url+"/Jacket/Style/Style/3Button/PeakLapel/main/"+fabimg;
			if(jArray['olapelHole']=="true"){lapelbtnhole=url+"/Jacket/Style/Lapel/PeakLapel/Thread/ShowImg/"+dthread;}
			if(jArray['olapelupper']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/PeakLapel/3Button/Join/"+fabcontrastimg;}
			if(jArray['olapellower']=="true"){lapellowrcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/PeakLapel/3Button/Front/"+fabcontrastimg;}
		} else if(jArray['olapel']=="60"){
			lapel=url+"/Jacket/Style/Style/3Button/NotchLapel/main/"+fabimg;
			if(jArray['olapelHole']=="true"){lapelbtnhole=url+"/Jacket/Style/Lapel/NotchLapel/Thread/ShowImg/"+dthread;}
			if(jArray['olapelupper']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/NotchLapel/3Button/Join/"+fabcontrastimg;}
			if(jArray['olapellower']=="true"){lapellowrcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/NotchLapel/3Button/Front/"+fabcontrastimg;}
		} else if(jArray['olapel']=="61"){
			lapel=url+"/Jacket/Style/Style/3Button/RoundNotch/main/"+fabimg;
			if(jArray['olapelHole']=="true"){lapelbtnhole=url+"/Jacket/Style/Lapel/RoundNotch/Thread/ShowImg/"+dthread;}
			if(jArray['olapelupper']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/RoundNotch/3Button/Join/"+fabcontrastimg;}
			if(jArray['olapellower']=="true"){lapellowrcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/RoundNotch/3Button/Front/"+fabcontrastimg;}
		} else if(jArray['olapel']=="62"){
			lapel=url+"/Jacket/Style/Style/3Button/ShawlLapel/main/"+fabimg;
			if(jArray['olapelupper']=="true" || jArray['olapellower']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/ShawlLapel/3Button/Front/"+fabcontrastimg;}
		}
		if(jArray['olapelupper']=="true"){lapeltop=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/PeakLapel/3Button/Front/"+fabcontrastimg;} else { lapeltop=url+"/Jacket/Style/Lapel/PeakLapel/Front/"+fabimg;}
		if(jArray['obreastPacket']=="true"){if(jArray['ocontchestpocket']=="true"){brestpockt=url+"/Jacket/ColorContrast/Mix/ChestPocket/Style/3Button/Front/"+fabcontrastimg;} else { brestpockt=url+"/Jacket/Style/Pocket/NoBreastPocket/right/"+fabimg;}}
		liningimg=url+"/Jacket/ColorContrast/Lining/3Button/"+lining;
		thread=url+"/Jacket/Style/Style/3Button/Thread/ShowImg/"+dthread;
		buttons=url+"/Jacket/Style/Style/3Button/Button/MainImg/"+dbutton;
	} else if(jArray['ostyle']=="53"){
		if(jArray['olapel']=="59"){
			lapel=url+"/Jacket/Style/Style/4Button/PeakLapel/main/"+fabimg;
			if(jArray['olapelHole']=="true"){lapelbtnhole=url+"/Jacket/Style/Lapel/PeakLapel/Thread/ShowImg/"+dthread;}
			if(jArray['olapelupper']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/PeakLapel/4Button/Join/"+fabcontrastimg;}
			if(jArray['olapellower']=="true"){lapellowrcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/PeakLapel/4Button/Front/"+fabcontrastimg;}
		} else if(jArray['olapel']=="60"){
			lapel=url+"/Jacket/Style/Style/4Button/NotchLapel/main/"+fabimg;
			if(jArray['olapelHole']=="true"){lapelbtnhole=url+"/Jacket/Style/Lapel/NotchLapel/Thread/ShowImg/"+dthread;}
			if(jArray['olapelupper']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/NotchLapel/4Button/Join/"+fabcontrastimg;}
			if(jArray['olapellower']=="true"){lapellowrcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/NotchLapel/4Button/Front/"+fabcontrastimg;}
		} else if(jArray['olapel']=="61"){
			lapel=url+"/Jacket/Style/Style/4Button/RoundNotch/main/"+fabimg;
			if(jArray['olapelHole']=="true"){lapelbtnhole=url+"/Jacket/Style/Lapel/RoundNotch/Thread/ShowImg/"+dthread;}
			if(jArray['olapelupper']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/RoundNotch/4Button/Join/"+fabcontrastimg;}
			if(jArray['olapellower']=="true"){lapellowrcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/RoundNotch/4Button/Front/"+fabcontrastimg;}
		} else if(jArray['olapel']=="62"){
			lapel=url+"/Jacket/Style/Style/4Button/ShawlLapel/main/"+fabimg;
			if(jArray['olapelupper']=="true" || jArray['olapellower']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/ShawlLapel/4Button/Front/"+fabcontrastimg;}
		}
		if(jArray['olapelupper']=="true"){lapeltop=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/PeakLapel/4Button/Front/"+fabcontrastimg;} else { lapeltop=url+"/Jacket/Style/Lapel/PeakLapel/Front/"+fabimg;}
		if(jArray['obreastPacket']=="true"){if(jArray['ocontchestpocket']=="true"){brestpockt=url+"/Jacket/ColorContrast/Mix/ChestPocket/Style/4Button/Front/"+fabcontrastimg;} else { brestpockt=url+"/Jacket/Style/Pocket/NoBreastPocket/right/"+fabimg;}}
		liningimg=url+"/Jacket/ColorContrast/Lining/4Button/"+lining;
		thread=url+"/Jacket/Style/Style/4Button/Thread/ShowImg/"+dthread;
		buttons=url+"/Jacket/Style/Style/4Button/Button/MainImg/"+dbutton;
	} else if(jArray['ostyle']=="54"){
		if(jArray['olapel']=="59"){
			lapel=url+"/Jacket/Style/Style/4ButtonD2/PeakLapel/main/"+fabimg;
			if(jArray['olapelHole']=="true"){lapelbtnhole=url+"/Jacket/Style/Lapel/PeakLapel/Thread/ShowImg/"+dthread;}
			if(jArray['olapelupper']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/PeakLapel/4ButtonD2/Join/"+fabcontrastimg;}
			if(jArray['olapellower']=="true"){lapellowrcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/PeakLapel/4ButtonD2/Front/"+fabcontrastimg;}
		} else if(jArray['olapel']=="60"){
			lapel=url+"/Jacket/Style/Style/4ButtonD2/NotchLapel/main/"+fabimg;
			if(jArray['olapelHole']=="true"){lapelbtnhole=url+"/Jacket/Style/Lapel/NotchLapel/Thread/ShowImg/"+dthread;}
			if(jArray['olapelupper']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/NotchLapel/4ButtonD2/Join/"+fabcontrastimg;}
			if(jArray['olapellower']=="true"){lapellowrcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/NotchLapel/4ButtonD2/Front/"+fabcontrastimg;}
		} else if(jArray['olapel']=="61"){
			lapel=url+"/Jacket/Style/Style/4ButtonD2/RoundNotch/main/"+fabimg;
			if(jArray['olapelHole']=="true"){lapelbtnhole=url+"/Jacket/Style/Lapel/RoundNotch/Thread/ShowImg/"+dthread;}
			if(jArray['olapelupper']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/RoundNotch/4ButtonD2/Join/"+fabcontrastimg;}
			if(jArray['olapellower']=="true"){lapellowrcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/RoundNotch/4ButtonD2/Front/"+fabcontrastimg;}
		} else if(jArray['olapel']=="62"){
			lapel=url+"/Jacket/Style/Style/4ButtonD2/ShawlLapel/main/"+fabimg;
			if(jArray['olapelupper']=="true" || jArray['olapellower']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/ShawlLapel/4ButtonD2/Front/"+fabcontrastimg;}
		}
		if(jArray['olapelupper']=="true"){lapeltop=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/PeakLapel/4ButtonD2/Front/"+fabcontrastimg;} else { lapeltop=url+"/Jacket/Style/Lapel/PeakLapel/Front/"+fabimg;}
		if(jArray['obreastPacket']=="true"){if(jArray['ocontchestpocket']=="true"){brestpockt=url+"/Jacket/ColorContrast/Mix/ChestPocket/Style/4ButtonD2/Front/"+fabcontrastimg;} else { brestpockt=url+"/Jacket/Style/Pocket/NoBreastPocket/right/"+fabimg;}}
		liningimg=url+"/Jacket/ColorContrast/Lining/4ButtonD2/"+lining;
		thread=url+"/Jacket/Style/Style/4ButtonD2/Thread/ShowImg/"+dthread;
		buttons=url+"/Jacket/Style/Style/4ButtonD2/Button/MainImg/"+dbutton;
	} else if(jArray['ostyle']=="55"){
		if(jArray['olapel']=="59"){
			lapel=url+"/Jacket/Style/Style/4ButtonD1/PeakLapel/main/"+fabimg;
			if(jArray['olapelHole']=="true"){lapelbtnhole=url+"/Jacket/Style/Lapel/PeakLapel/Thread/ShowImg/"+dthread;}
			if(jArray['olapelupper']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/PeakLapel/4ButtonD1/Join/"+fabcontrastimg;}
			if(jArray['olapellower']=="true"){lapellowrcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/PeakLapel/4ButtonD1/Front/"+fabcontrastimg;}
		} else if(jArray['olapel']=="60"){
			lapel=url+"/Jacket/Style/Style/4ButtonD1/NotchLapel/main/"+fabimg;
			if(jArray['olapelHole']=="true"){lapelbtnhole=url+"/Jacket/Style/Lapel/NotchLapel/Thread/ShowImg/"+dthread;}
			if(jArray['olapelupper']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/NotchLapel/4ButtonD1/Join/"+fabcontrastimg;}
			if(jArray['olapellower']=="true"){lapellowrcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/NotchLapel/4ButtonD1/Front/"+fabcontrastimg;}
		} else if(jArray['olapel']=="61"){
			lapel=url+"/Jacket/Style/Style/4ButtonD1/RoundNotch/main/"+fabimg;
			if(jArray['olapelHole']=="true"){lapelbtnhole=url+"/Jacket/Style/Lapel/RoundNotch/Thread/ShowImg/"+dthread;}
			if(jArray['olapelupper']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/RoundNotch/4ButtonD1/Join/"+fabcontrastimg;}
			if(jArray['olapellower']=="true"){lapellowrcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/RoundNotch/4ButtonD1/Front/"+fabcontrastimg;}
		} else if(jArray['olapel']=="62"){
			lapel=url+"/Jacket/Style/Style/4ButtonD1/ShawlLapel/main/"+fabimg;
			if(jArray['olapelupper']=="true" || jArray['olapellower']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/ShawlLapel/4ButtonD1/Front/"+fabcontrastimg;}
		}
		if(jArray['olapelupper']=="true"){lapeltop=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/PeakLapel/4ButtonD1/Front/"+fabcontrastimg;} else { lapeltop=url+"/Jacket/Style/Lapel/PeakLapel/Front/"+fabimg;}
		if(jArray['obreastPacket']=="true"){if(jArray['ocontchestpocket']=="true"){brestpockt=url+"/Jacket/ColorContrast/Mix/ChestPocket/Style/4ButtonD1/Front/"+fabcontrastimg;} else { brestpockt=url+"/Jacket/Style/Pocket/NoBreastPocket/right/"+fabimg;}}
		liningimg=url+"/Jacket/ColorContrast/Lining/4ButtonD1/"+lining;
		thread=url+"/Jacket/Style/Style/4ButtonD1/Thread/ShowImg/"+dthread;
		buttons=url+"/Jacket/Style/Style/4ButtonD1/Button/MainImg/"+dbutton;
	} else if(jArray['ostyle']=="56"){
		if(jArray['olapel']=="59"){
			lapel=url+"/Jacket/Style/Style/6ButtonD2/PeakLapel/main/"+fabimg;
			if(jArray['olapelHole']=="true"){lapelbtnhole=url+"/Jacket/Style/Lapel/PeakLapel/Thread/ShowImg/"+dthread;}
			if(jArray['olapelupper']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/PeakLapel/6ButtonD2/Join/"+fabcontrastimg;}
			if(jArray['olapellower']=="true"){lapellowrcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/PeakLapel/6ButtonD2/Front/"+fabcontrastimg;}
		} else if(jArray['olapel']=="60"){
			lapel=url+"/Jacket/Style/Style/6ButtonD2/NotchLapel/main/"+fabimg;
			if(jArray['olapelHole']=="true"){lapelbtnhole=url+"/Jacket/Style/Lapel/NotchLapel/Thread/ShowImg/"+dthread;}
			if(jArray['olapelupper']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/NotchLapel/6ButtonD2/Join/"+fabcontrastimg;}
			if(jArray['olapellower']=="true"){lapellowrcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/NotchLapel/6ButtonD2/Front/"+fabcontrastimg;}
		} else if(jArray['olapel']=="61"){
			lapel=url+"/Jacket/Style/Style/6ButtonD2/RoundNotch/main/"+fabimg;
			if(jArray['olapelHole']=="true"){lapelbtnhole=url+"/Jacket/Style/Lapel/RoundNotch/Thread/ShowImg/"+dthread;}
			if(jArray['olapelupper']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/RoundNotch/6ButtonD2/Join/"+fabcontrastimg;}
			if(jArray['olapellower']=="true"){lapellowrcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/RoundNotch/6ButtonD2/Front/"+fabcontrastimg;}
		} else if(jArray['olapel']=="62"){
			lapel=url+"/Jacket/Style/Style/6ButtonD2/ShawlLapel/main/"+fabimg;
			if(jArray['olapelupper']=="true" || jArray['olapellower']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/ShawlLapel/6ButtonD2/Front/"+fabcontrastimg;}
		}
		if(jArray['olapelupper']=="true"){lapeltop=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/PeakLapel/6ButtonD2/Front/"+fabcontrastimg;} else { lapeltop=url+"/Jacket/Style/Lapel/PeakLapel/Front/"+fabimg;}
		if(jArray['obreastPacket']=="true"){if(jArray['ocontchestpocket']=="true"){brestpockt=url+"/Jacket/ColorContrast/Mix/ChestPocket/Style/6ButtonD2/Front/"+fabcontrastimg;} else { brestpockt=url+"/Jacket/Style/Pocket/NoBreastPocket/right/"+fabimg;}}
		liningimg=url+"/Jacket/ColorContrast/Lining/6ButtonD2/"+lining;
		thread=url+"/Jacket/Style/Style/6ButtonD2/Thread/ShowImg/"+dthread;
		buttons=url+"/Jacket/Style/Style/6ButtonD2/Button/MainImg/"+dbutton;
	} else if(jArray['ostyle']=="57"){
		if(jArray['olapel']=="59"){
			lapel=url+"/Jacket/Style/Style/6ButtonD3/PeakLapel/main/"+fabimg;
			if(jArray['olapelHole']=="true"){lapelbtnhole=url+"/Jacket/Style/Lapel/PeakLapel/Thread/ShowImg/"+dthread;}
			if(jArray['olapelupper']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/PeakLapel/6ButtonD3/Join/"+fabcontrastimg;}
			if(jArray['olapellower']=="true"){lapellowrcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/PeakLapel/6ButtonD3/Front/"+fabcontrastimg;}
		} else if(jArray['olapel']=="60"){
			lapel=url+"/Jacket/Style/Style/6ButtonD3/NotchLapel/main/"+fabimg;
			if(jArray['olapelHole']=="true"){lapelbtnhole=url+"/Jacket/Style/Lapel/NotchLapel/Thread/ShowImg/"+dthread;}
			if(jArray['olapelupper']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/NotchLapel/6ButtonD3/Join/"+fabcontrastimg;}
			if(jArray['olapellower']=="true"){lapellowrcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/NotchLapel/6ButtonD3/Front/"+fabcontrastimg;}
		} else if(jArray['olapel']=="61"){
			lapel=url+"/Jacket/Style/Style/6ButtonD3/RoundNotch/main/"+fabimg;
			if(jArray['olapelHole']=="true"){lapelbtnhole=url+"/Jacket/Style/Lapel/RoundNotch/Thread/ShowImg/"+dthread;}
			if(jArray['olapelupper']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/RoundNotch/6ButtonD3/Join/"+fabcontrastimg;}
			if(jArray['olapellower']=="true"){lapellowrcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/RoundNotch/6ButtonD3/Front/"+fabcontrastimg;}
		} else if(jArray['olapel']=="62"){
			lapel=url+"/Jacket/Style/Style/6ButtonD3/ShawlLapel/main/"+fabimg;
			if(jArray['olapelupper']=="true" || jArray['olapellower']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/ShawlLapel/6ButtonD3/Front/"+fabcontrastimg;}
		}
		if(jArray['olapelupper']=="true"){lapeltop=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/PeakLapel/6ButtonD3/Front/"+fabcontrastimg;} else { lapeltop=url+"/Jacket/Style/Lapel/PeakLapel/Front/"+fabimg;}
		if(jArray['obreastPacket']=="true"){if(jArray['ocontchestpocket']=="true"){brestpockt=url+"/Jacket/ColorContrast/Mix/ChestPocket/Style/6ButtonD3/Front/"+fabcontrastimg;} else { brestpockt=url+"/Jacket/Style/Pocket/NoBreastPocket/right/"+fabimg;}}
		liningimg=url+"/Jacket/ColorContrast/Lining/6ButtonD3/"+lining;
		thread=url+"/Jacket/Style/Style/6ButtonD3/Thread/ShowImg/"+dthread;
		buttons=url+"/Jacket/Style/Style/6ButtonD3/Button/MainImg/"+dbutton;
	} else if(jArray['ostyle']=="58"){
		if(jArray['olapel']=="59"){
			lapel=url+"/Jacket/Style/Style/6ButtonD1/PeakLapel/main/"+fabimg;
			if(jArray['olapelHole']=="true"){lapelbtnhole=url+"/Jacket/Style/Lapel/PeakLapel/Thread/ShowImg/"+dthread;}
			if(jArray['olapelupper']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/PeakLapel/6ButtonD1/Join/"+fabcontrastimg;}
			if(jArray['olapellower']=="true"){lapellowrcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/PeakLapel/6ButtonD1/Front/"+fabcontrastimg;}
		} else if(jArray['olapel']=="60"){
			lapel=url+"/Jacket/Style/Style/6ButtonD1/NotchLapel/main/"+fabimg;
			if(jArray['olapelHole']=="true"){lapelbtnhole=url+"/Jacket/Style/Lapel/NotchLapel/Thread/ShowImg/"+dthread;}
			if(jArray['olapelupper']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/NotchLapel/6ButtonD1/Join/"+fabcontrastimg;}
			if(jArray['olapellower']=="true"){lapellowrcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/NotchLapel/6ButtonD1/Front/"+fabcontrastimg;}
		} else if(jArray['olapel']=="61"){
			lapel=url+"/Jacket/Style/Style/6ButtonD1/RoundNotch/main/"+fabimg;
			if(jArray['olapelHole']=="true"){lapelbtnhole=url+"/Jacket/Style/Lapel/RoundNotch/Thread/ShowImg/"+dthread;}
			if(jArray['olapelupper']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/RoundNotch/6ButtonD1/Join/"+fabcontrastimg;}
			if(jArray['olapellower']=="true"){lapellowrcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/RoundNotch/6ButtonD1/Front/"+fabcontrastimg;}
		} else if(jArray['olapel']=="62"){
			lapel=url+"/Jacket/Style/Style/6ButtonD1/ShawlLapel/main/"+fabimg;
			if(jArray['olapelupper']=="true" || jArray['olapellower']=="true"){lapeluprcontr=url+"/Jacket/ColorContrast/Mix/LapelLower/Lapel/ShawlLapel/6ButtonD1/Front/"+fabcontrastimg;}
		}
		if(jArray['olapelupper']=="true"){lapeltop=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/PeakLapel/6ButtonD1/Front/"+fabcontrastimg;} else { lapeltop=url+"/Jacket/Style/Lapel/PeakLapel/Front/"+fabimg;}
		if(jArray['obreastPacket']=="true"){if(jArray['ocontchestpocket']=="true"){brestpockt=url+"/Jacket/ColorContrast/Mix/ChestPocket/Style/6ButtonD1/Front/"+fabcontrastimg;} else { brestpockt=url+"/Jacket/Style/Pocket/NoBreastPocket/right/"+fabimg;}}
		liningimg=url+"/Jacket/ColorContrast/Lining/6ButtonD1/"+lining;
		thread=url+"/Jacket/Style/Style/6ButtonD1/Thread/ShowImg/"+dthread;
		buttons=url+"/Jacket/Style/Style/6ButtonD1/Button/MainImg/"+dbutton;
	}
	
	/* POCKETS */
	if(jArray['opacket']=="66"){if(jArray['ocontpockets']=="true"){pockts=url+"/Jacket/ColorContrast/Mix/Pockets/Pocket/2StraightPockets/Front/"+fabcontrastimg;} else{pockts=url+"/Jacket/Style/Pocket/JP1/Front/"+fabimg;}} else if(jArray['opacket']=="67"){if(jArray['ocontpockets']=="true"){pockts=url+"/Jacket/ColorContrast/Mix/Pockets/Pocket/2StraightPockets&1TicketPocket/Front/"+fabcontrastimg;} else{pockts=url+"/Jacket/Style/Pocket/JP2/Front/"+fabimg;}} else if(jArray['opacket']=="68"){if(jArray['ocontpockets']=="true"){pockts=url+"/Jacket/ColorContrast/Mix/Pockets/Pocket/2SlantedPockets/Front/"+fabcontrastimg;} else{pockts=url+"/Jacket/Style/Pocket/JP3/Front/"+fabimg;}} else if(jArray['opacket']=="69"){if(jArray['ocontpockets']=="true"){pockts=url+"/Jacket/ColorContrast/Mix/Pockets/Pocket/2SlantedPockets&1TicketPocket/Front/"+fabcontrastimg;} else{pockts=url+"/Jacket/Style/Pocket/JP4/Front/"+fabimg;}} else if(jArray['opacket']=="70"){if(jArray['ocontpockets']=="true"){pockts=url+"/Jacket/ColorContrast/Mix/Pockets/Pocket/2StraightPockets(NoFlaps)/Front/"+fabcontrastimg;} else{pockts=url+"/Jacket/Style/Pocket/JP5/Front/"+fabimg;}} else if(jArray['opacket']=="71"){if(jArray['ocontpockets']=="true"){pockts=url+"/Jacket/ColorContrast/Mix/Pockets/Pocket/2StraightPockets(NoFlaps)&1TicketPocket(NoFlap)/Front/"+fabcontrastimg;} else{pockts=url+"/Jacket/Style/Pocket/JP6/Front/"+fabimg;}} else if(jArray['opacket']=="72"){if(jArray['ocontpockets']=="true"){pockts=url+"/Jacket/ColorContrast/Mix/Pockets/Pocket/2PatchedPockets/Front/"+fabcontrastimg;} else{pockts=url+"/Jacket/Style/Pocket/JP7/Front/"+fabimg;}}
	/* SLEEVE BUTTONS */
	if(jArray['osleeveButn']=="73"){slevbtn=url+"/Jacket/Style/SleeveButton/3StandardButtons/Button/MainImg/"+dbutton;} else if(jArray['osleeveButn']=="74"){slevbtn=url+"/Jacket/Style/SleeveButton/3WorkingButtons/Button/MainImg/"+dbutton;} else if(jArray['osleeveButn']=="75"){slevbtn=url+"/Jacket/Style/SleeveButton/3KissingButtons/Button/MainImg/"+dbutton;} else if(jArray['osleeveButn']=="76"){slevbtn=url+"/Jacket/Style/SleeveButton/4StandardButtons/Button/MainImg/"+dbutton;} else if(jArray['osleeveButn']=="77"){slevbtn=url+"/Jacket/Style/SleeveButton/4WorkingButtons/Button/MainImg/"+dbutton;} else if(jArray['osleeveButn']=="78"){slevbtn=url+"/Jacket/Style/SleeveButton/4KissingButtons/Button/MainImg/"+dbutton;} else if(jArray['osleeveButn']=="79"){slevbtn=url+"/Jacket/Style/SleeveButton/5StandardButtons/Button/MainImg/"+dbutton;} else if(jArray['osleeveButn']=="80"){slevbtn=url+"/Jacket/Style/SleeveButton/5WorkingButtons/Button/MainImg/"+dbutton;} else if(jArray['osleeveButn']=="81"){slevbtn=url+"/Jacket/Style/SleeveButton/5KissingButtons/Button/MainImg/"+dbutton;}

	var frontsrcs = { btnn: buttons,threaad: thread,pocket: pockts,slvbtn: slevbtn,lapelthole: lapelbtnhole,llapelcont: lapellowrcontr,lapelt: lapeltop,	ulapelcont: lapeluprcontr,blapel: lapel,breastpockt: brestpockt,liningg: liningimg,front: frontmain,};
	$.each(frontsrcs,function(key,value){if(value!=""){retjacketfrontsrc.push(frontsrcs[key]);}}); fcanvasjacket.clear();frontJacketProcessing();
}
function frontJacketProcessing(){
	var cdata = "";var _src = retjacketfrontsrc.pop();
	fabric.Image.fromURL(_src, function(oImg) {
		fcanvasjacket.add(oImg);cdata=fcanvasjacket.toDataURL();
		if (retjacketfrontsrc.length > 0) {
			setTimeout(frontJacketProcessing, 40);
		} else {
			$("div [id^='main-front-']").find("div.pt-jacketimage-div img").attr("src",cdata);
			$("#miniview-etstylejacket-19").find("figure img").attr("src",cdata);
			$("#miniview-etstylejacket-20").css("background-image","url("+cdata+")");
			$("#miniview-etstylejacket-21").css("background-image","url("+cdata+")");
			$("#miniview-etstylejacket-22").css("background-image","url("+cdata+")");
			$("#miniview-etcontrastjacket-25").find("figure img").attr("src",cdata);
		}
	});
}
/* ----------------------------------Option Selection Functions---------------------------------- */
function getjacketfab(id,otab){	
    var arr = document.getElementById("harrJacket").value;
    // console.log("getjacketfab",arr);
	arr=JSON.parse(arr);

    $.ajax({
       	type:'POST',
       	// url:'/getjktfabrics',
       	url:'/getfabricsjacket',
       	data:{fabid : id, carr : arr, rurl : url, t : otab},
       	// async: false,
	   	beforeSend: function() {
	   		$("#container_jackets .et-small-loader").show();
	   	},
       	headers: {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       	success:function(data){
			//console.log(data);
		   	$('#preview-etfabricjacket').html(data[1]);
			var stid="menu-fabric"+data[3];
			var stab=data[2]; 
			var newarr=data[4];
			var uparr=JSON.stringify(data[4]);
			$('#tabJacketActiveId').val(data[2]);
			$('#tabJacketSActiveId').val('fabric'+data[3]);
			$('#harrJacket').val(uparr);
			$("#container_jackets #fullstyle").html(data[5]);
			$("#container_jackets #fullcontrast").html(data[6]);
			$("#container_jackets li[id^='optionlist-fabric']").find('div.icon-check').remove();
			$("#container_jackets #optionlist-fabric"+data[3]+"-"+id).append('<div class="icon-check"></div>');
			getTabJacketSect(data[2]); 
			getPgJacketOption(stid,stab,"fabric"+data[3],'');
			frontdesignJacketProcess(newarr); 
			backdesignJacketProcess(newarr); 
			sidedesignJacketProcess(newarr);

			for(var i=0;i<data[7].length;i++){
				if(data[7][i]['cat_id'] == 4){
					getpantfab(data[7][i]['id'],'etfabricpant');
				}
				if(data[7][i]['cat_id'] == 3){
					getfab(data[7][i]['id'],'etfabric');
				}
			}

			changeJacketSizeDetails();
			updatejacketfabprice();
			// setTimeout($("#container_jackets .et-small-loader").fadeOut(),50);
			$("#container_jackets .et-small-loader").hide();

			var total_price = 0;
			var arr = $("#harrJacket").val(); 
			arr=JSON.parse(arr); 
			var fabprice=arr['ofabricPrice'];
			fabprice=parseFloat(fabprice);
			total_price += fabprice;
			// console.log("============ jacket price : ", fabprice);

			arr = $("#harrPant").val(); 
			arr=JSON.parse(arr); 
			fabprice=arr['ofabricPrice'];
			fabprice=parseFloat(fabprice);
			total_price += fabprice;
			// console.log("============ pant price : ", fabprice);

			arr = $("#harr").val(); 
			arr=JSON.parse(arr); 
			fabprice=arr['ofabricPrice'];
			fabprice=parseFloat(fabprice);
			total_price += fabprice;
			// console.log("============ vest price : ", fabprice);

			total_price = parseFloat(total_price);
			$("#container_jackets .pt-dollor").html("$ "+total_price);
			$("#container_jackets .vwprice").html("3Piece Suit ( 1 Jacket, 1 Pant , 1 Vest ) : $ "+total_price);

			$("#threepiece_total").html("$ "+total_price);
		}
    });
}
function getjackstyles(id,ctyp,otab){
    var arr = document.getElementById("harrJacket").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       // url:'/getjktstyle',
       url:'/getstylejacket',
       data:{fabid : id, carr : arr, typ : ctyp, rurl : url, t : otab},
	   beforeSend: function() { $("#container_jackets .et-small-loader").show(); },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){
			//console.log(data);
			$("#container_jackets #fullstyle").html(data[1]);
			$('#miniview-etcontrastjacket-25').html(data[5]);
			$('#miniview-etcontrastjacket-28').html(data[6]);
			var stid="menu-"+data[3];
			var stab=data[2]; 
			var newarr=data[4];
			var uparr=JSON.stringify(data[4]);
			$('#tabJacketActiveId').val(data[2]);
			$('#tabJacketSActiveId').val(data[3]);
			$('#harrJacket').val(uparr);
			$("#container_jackets li[id^='optionlist-"+data[3]+"']").find('div.icon-check').remove();
			$("#container_jackets #optionlist-"+data[3]+"-"+id).append('<div class="icon-check"></div>');
			getTabJacketSect(data[2]); 
			getPgJacketOption(stid,stab,data[3],'');
			frontdesignJacketProcess(newarr); 
			backdesignJacketProcess(newarr); 
			sidedesignJacketProcess(newarr); 
			setTimeout($("#container_jackets .et-small-loader").fadeOut(),50);
		}
    });
}
function getjackcontrast(id,otab){
    var arr = document.getElementById("harrJacket").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       // url:'/getjktcontrasts',
       url:'/getcontrastsjacket',
       data:{fabid : id, carr : arr, typ : '25', rurl : url, t : otab},
	   beforeSend: function() {$("#container_jackets .et-small-loader").show(); },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){
		   	$('#miniview-etcontrastjacket-25').html(data[1]);
			var stid="menu-"+data[3];
			var stab=data[2]; 
			var newarr=data[4];
			var uparr=JSON.stringify(data[4]);
			$('#tabJacketActiveId').val(data[2]);
			$('#tabJacketSActiveId').val(data[3]);
			$('#harrJacket').val(uparr);
			$("#container_jackets li[id^='optionlist-"+data[3]+"']").find('div.icon-check').remove();
			$("#container_jackets #optionlist-"+data[3]+"-"+id).append('<div class="icon-check"></div>');
			getTabJacketSect(data[2]); 
			getPgJacketOption(stid,stab,data[3],'');
			frontdesignJacketProcess(newarr); 
			backdesignJacketProcess(newarr); 
			sidedesignJacketProcess(newarr); 
			setTimeout($("#container_jackets .et-small-loader").fadeOut(),50);
		}
    });
}
function getjacketlining(id,otab){
    var arr = document.getElementById("harrJacket").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       // url:'/getjktlinings',
       url:'/getjktlinings',
       data:{fabid : id, carr : arr, typ : '26', rurl : url, t : otab},
	   beforeSend: function() { $("#container_jackets .et-small-loader").show(); },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){
			var stid="menu-"+data[3];
			var stab=data[2]; 
			var newarr=data[4];
			var uparr=JSON.stringify(data[4]);
			$('#tabJacketActiveId').val(data[2]);
			$('#tabJacketSActiveId').val(data[3]);
			$('#harrJacket').val(uparr);
			$("#container_jackets li[id^='optionlist-"+data[3]+"']").find('div.icon-check').remove();
			$("#container_jackets #optionlist-"+data[3]+"-"+id).append('<div class="icon-check"></div>');
			getTabJacketSect(data[2]); 
			getPgJacketOption(stid,stab,data[3],'');
			frontdesignJacketProcess(newarr); 
			backdesignJacketProcess(newarr); 
			sidedesignJacketProcess(newarr); 
			setTimeout($("#container_jackets .et-small-loader").fadeOut(),50);
		}
    });
}
function getjacketpiping(id,otab){
    var arr = document.getElementById("harrJacket").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       // url:'/getjktpipings',
       url:'/getjktpipings',
       data:{fabid : id, carr : arr, typ : '26', rurl : url, t : otab},
	   beforeSend: function() { $("#container_jackets .et-small-loader").show(); },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){
			var stid="menu-"+data[3];
			var stab=data[2]; 
			var newarr=data[4];
			var uparr=JSON.stringify(data[4]);
			$('#tabJacketActiveId').val(data[2]);
			$('#tabJacketSActiveId').val(data[3]);
			$('#harrJacket').val(uparr);
			$("#container_jackets li[id^='optionlist-pip']").find('div.icon-check').remove();
			$("#container_jackets #optionlist-pip-"+id).append('<div class="icon-check"></div>');
			getTabJacketSect(data[2]); 
			getPgJacketOption(stid,stab,data[3],'');
			frontdesignJacketProcess(newarr); 
			backdesignJacketProcess(newarr); 
			sidedesignJacketProcess(newarr); 
			setTimeout($("#container_jackets .et-small-loader").fadeOut(),50);
		}
    });
}
function getjacketbackcollar(id,otab){
    var arr = document.getElementById("harrJacket").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       // url:'/getjktbckcollar',
       url:'/getjktbckcollarthree',
       data:{fabid : id, carr : arr, typ : '27', rurl : url, t : otab},
	   beforeSend: function() { $("#container_jackets .et-small-loader").show(); },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){
		   	$('#miniview-etcontrastjacket-27').html(data[1]);
		   	var stid="menu-"+data[3];
			var stab=data[2]; 
			var newarr=data[4];
			var uparr=JSON.stringify(data[4]);
			$('#tabJacketActiveId').val(data[2]);
			$('#tabJacketSActiveId').val(data[3]);
			$('#harrJacket').val(uparr);
			$("#container_jackets li[id^='optionlist-"+data[3]+"']").find('div.icon-check').remove();
			$("#container_jackets #optionlist-"+data[3]+"-"+id).append('<div class="icon-check"></div>');
			getTabJacketSect(data[2]); 
			getPgJacketOption(stid,stab,data[3],'');
			frontdesignJacketProcess(newarr); 
			backdesignJacketProcess(newarr); 
			sidedesignJacketProcess(newarr); 
			setTimeout($("#container_jackets .et-small-loader").fadeOut(),50);
		}
    });
}
function getjacketbuttons(id,otab){
    var arr = document.getElementById("harrJacket").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       // url:'/getjktbutton',
       url:'/getbuttonjacket',
       data:{fabid : id, carr : arr, typ : '28', rurl : url, t : otab},
	   beforeSend: function() { $("#container_jackets .et-small-loader").show();},
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){
			$("#miniview-etcontrastjacket-28").html(data[1]);		    
			var stid="menu-"+data[3];
			var stab=data[2]; 
			var newarr=data[4];
			var uparr=JSON.stringify(data[4]);
			$('#tabJacketActiveId').val(data[2]);
			$('#tabJacketSActiveId').val(data[3]);
			$('#harrJacket').val(uparr);
			$("#container_jackets #fullstyle").html(data[5]);
			$("#container_jackets li[id^='optionlist-"+data[3]+"']").find('div.icon-check').remove();
			$("#container_jackets #optionlist-"+data[3]+"-"+id).append('<div class="icon-check"></div>');
			getTabJacketSect(data[2]); 
			getPgJacketOption(stid,stab,data[3],'');
			frontdesignJacketProcess(newarr); 
			backdesignJacketProcess(newarr); 
			sidedesignJacketProcess(newarr); 
			setTimeout($("#container_jackets .et-small-loader").fadeOut(),50);
		}
    });
}
function getjacketthread(id,otab){
    var arr = document.getElementById("harrJacket").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       // url:'/getjktthreads',
       url:'/getthreadsjacket',
       data:{fabid : id, carr : arr, typ : '28', rurl : url, t : otab},
	   beforeSend: function() {$("#container_jackets .et-small-loader").show();},
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){
		   	$("#miniview-etcontrastjacket-28").html(data[1]);	
			var stid="menu-"+data[3];
			var stab=data[2]; 
			var newarr=data[4];
			var uparr=JSON.stringify(data[4]);
			$('#tabJacketActiveId').val(data[2]);
			$('#tabJacketSActiveId').val(data[3]);
			$('#harrJacket').val(uparr);
			$("#container_jackets #fullstyle").html(data[5]);
			$("#container_jackets li[id^='optionlist-thrd']").find('div.icon-check').remove();
			$("#container_jackets #optionlist-thrd-"+id).append('<div class="icon-check"></div>');
			getTabJacketSect(data[2]); 
			getPgJacketOption(stid,stab,data[3],'');
			frontdesignJacketProcess(newarr); 
			backdesignJacketProcess(newarr); 
			sidedesignJacketProcess(newarr); 
			setTimeout($("#container_jackets .et-small-loader").fadeOut(),50);
		}
    });
}
function getjacketmonogram(id,otab){
    var arr = document.getElementById("harrJacket").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       // url:'/getjktmonogrm',
       url:'/getmonogrmjacket',
       data:{fabid : id, carr : arr, typ : '29', rurl : url, t : otab},
	   beforeSend: function() { $("#container_jackets .et-small-loader").show();},
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){
			$("#miniview-etcontrastjacket-29").html(data[1]);	
			var stid="menu-"+data[3];
			var stab=data[2]; 
			var newarr=data[4];
			var uparr=JSON.stringify(data[4]);
			$('#tabJacketActiveId').val(data[2]);
			$('#tabJacketSActiveId').val(data[3]);
			$('#harrJacket').val(uparr);
			$("#container_jackets #menu-opt-29").html(data[5]);
			getTabJacketSect(data[2]); 
			getPgJacketOption(stid,stab,data[3],'');
			frontdesignJacketProcess(newarr); 
			backdesignJacketProcess(newarr); 
			sidedesignJacketProcess(newarr); 
			setTimeout($("#container_jackets .et-small-loader").fadeOut(),50);
		}
    });
}
function getjacketmonotxtcolor(id,otab){
    var arr = document.getElementById("harrJacket").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       url:'/getjktmonocolr',
       data:{fabid : id, carr : arr, typ : '29', rurl : url, t : otab},
	   beforeSend: function() {$("#container_jackets .et-small-loader").show();},
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){
		   	$("#miniview-etcontrastjacket-29").html(data[1]);	
			var stid="menu-"+data[3];
			var stab=data[2]; 
			var newarr=data[4];
			var uparr=JSON.stringify(data[4]);
			$('#tabJacketActiveId').val(data[2]);
			$('#tabJacketSActiveId').val(data[3]);
			$('#harrJacket').val(uparr);
			$("#container_jackets li[id^='optionlist-"+data[3]+"']").find('div.icon-check').remove();
			$("#container_jackets #optionlist-"+data[3]+"-"+id).append('<div class="icon-check"></div>');
			getTabJacketSect(data[2]); 
			getPgJacketOption(stid,stab,data[3],'');
			frontdesignJacketProcess(newarr); 
			backdesignJacketProcess(newarr); 
			sidedesignJacketProcess(newarr); 
			setTimeout($("#container_jackets .et-small-loader").fadeOut(),50);
		}
    });
}
function getjacketmonotext(id,otab){
    var arr = document.getElementById("harrJacket").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       url:'/getjktmonotxt',
       data:{fabid : id, carr : arr, typ : '29', rurl : url, t : otab},
	   beforeSend: function() {$("#container_jackets .et-small-loader").show();},
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){
			$("#miniview-etcontrastjacket-29").html(data[1]);	
			var stid="menu-"+data[3];
			var stab=data[2]; 
			var newarr=data[4];
			var uparr=JSON.stringify(data[4]);
			$('#tabJacketActiveId').val(data[2]);
			$('#tabJacketSActiveId').val(data[3]);
			$('#harrJacket').val(uparr);
			getTabJacketSect(data[2]); 
			getPgJacketOption(stid,stab,data[3],'');
			frontdesignJacketProcess(newarr); 
			backdesignJacketProcess(newarr); 
			sidedesignJacketProcess(newarr); 
			setTimeout($("#container_jackets .et-small-loader").fadeOut(),50);
		}
    });
}
function getjacketseloptions(id,opt,ctyp,otab){
    var arr = document.getElementById("harrJacket").value;
	arr=JSON.parse(arr);

	if(opt == 'LapelUpper'){
		if(arr['olapelupper'] == 'true'){
			arr['olapelupper'] = 'false';
		}else{
			arr['olapelupper'] = 'true';
		}
	} else if(opt == 'LapelLower'){
		if(arr['olapellower'] == 'true'){
			arr['olapellower'] = 'false';
		}else{
			arr['olapellower'] = 'true';
		}
	} else if(opt == 'Pockets'){
		if(arr['ocontpockets'] == 'true'){
			arr['ocontpockets'] = 'false';
		}else{
			arr['ocontpockets'] = 'true';
		}
	} else if(opt == 'ChestPocket'){
		if(arr['ocontchestpocket'] == 'true'){
			arr['ocontchestpocket'] = 'false';
		}else{
			arr['ocontchestpocket'] = 'true';
		}
	} else if(opt == 'ElbowMix'){
		if(arr['ocontelbowmix'] == 'true'){
			arr['ocontelbowmix'] = 'false';
		}else{
			arr['ocontelbowmix'] = 'true';
		}
	} else if(opt == 'Special'){
		if(arr['omonogramSpecial'] == 'true'){
			arr['omonogramSpecial'] = 'false';
		}else{
			arr['omonogramSpecial'] = 'true';
		}
	} else if(opt == 'LapelHole'){
		if(arr['olapelHole'] == 'true'){
			arr['olapelHole'] = 'false';
			arr['olapelHoleName']="No Button Hole";
		}else{
			arr['olapelHole'] = 'true';
			arr['olapelHoleName']="With Lapel Buttonhole";
		}
	}

	var temparr=JSON.stringify(arr);
	$('#harrJacket').val(temparr);

    $.ajax({
       type:'POST',
       	// url:'/getsetjktoptions',
       	url:'/getsetoptionsjacket',
       	data:{fabid : id, carr : arr, opttyp : opt, typ : ctyp, rurl : url, t : otab},
	   	beforeSend: function() { $("#container_jackets .et-small-loader").show(); },
       	headers: {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       	success:function(data){
		   	$("#container_jackets #fullstyle").html(data[1]);
			// $('#miniview-etcontrastjacket-25').html(data[5]);
			$('#miniview-etcontrastjacket-29').html(data[6]);	    
			var stid="menu-"+data[3];
			var stab=data[2]; 
			var newarr=data[4];
			var uparr=JSON.stringify(data[4]);
			$('#tabJacketActiveId').val(data[2]);
			$('#tabJacketSActiveId').val(data[3]);
			// $('#harrJacket').val(uparr);
			getTabJacketSect(data[2]); 
			getPgJacketOption(stid,stab,data[3],'');
			frontdesignJacketProcess(newarr); 
			backdesignJacketProcess(newarr); 
			sidedesignJacketProcess(newarr); 
			setTimeout($("#container_jackets .et-small-loader").fadeOut(),50);
		}
    });
}
//
function showJacketMeasureSect(id){
	$("div[id^='menu-mesure-jacket-']").css("display","none"); 
	$("#menu-mesure-jacket-"+id).css("display","block");
	$("#etmeasurementjacket").find("div.pt-variation div.pt-box-square").removeClass("active");
	if(id=="bodysize" || id=="standardsize" || id=="outfitsize"){
		$("#menu-jacket-"+id).addClass("active");
		if(id=="bodysize"){ 
			$("#container_jackets input#bsizeChest").focus(); 
			$("#container_jackets span#fldtitle").html("Chest"); 
			$("#container_jackets span#rngfrom").html("28"); 
			$("#container_jackets span#rngto").html("75");
			$("#container_jackets div.et-measure-image").find("figure img").attr("src",url+"/Measurment/Shirts/chest/chest.jpg");
			$("#container_jackets div.et-measure-video").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/chest/chest.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/chest/chest.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/chest/chest.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/chest/chest.webm" type="video/webm"></video>');
			var fview=$("#container_jackets #main-front-etmeasurementjacket").find("div.pt-jacketimage-div img").attr("src"); 
			var bview=$("#container_jackets #main-back-etmeasurementjacket").find("div.pt-jacketimage-div img").attr("src");
			$("#container_jackets input#frntviewfinal").val(fview); 
			$("#container_jackets input#bkviewfinal").val(bview); 
			var arr = document.getElementById("harrJacket").value; 
			$("#container_jackets input#setarr").val(arr);
		} else if(id=="standardsize"){
			var fview=$("#main-front-etmeasurementjacket").find("div.pt-jacketimage-div img").attr("src"); 
			var bview=$("#main-back-etmeasurementjacket").find("div.pt-jacketimage-div img").attr("src");
			$("#container_jackets input#frntviewfinal").val(fview); 
			$("#container_jackets input#bkviewfinal").val(bview);
			var arr = document.getElementById("harrJacket").value; 
			$("#container_jackets input#setarr").val(arr);
		} else if(id=="outfitsize"){ 
			$("#container_jackets input#bsizeChest2").focus(); 
			$("#container_jackets span#fldtitle2").html("Chest"); 
			$("#container_jackets span#rngfrom2").html("28"); 
			$("#container_jackets span#rngto2").html("75");
			$("#container_jackets div.et-measure-image-2").find("figure img").attr("src",url+"/Measurment/Shirts/chest/chest.jpg");
			$("#container_jackets div.et-measure-video-2").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/chest/chest.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/chest/chest.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/chest/chest.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/chest/chest.webm" type="video/webm"></video>');
			var fview=$("#container_jackets #main-front-etmeasurementjacket").find("div.pt-jacketimage-div img").attr("src"); 
			var bview=$("#container_jackets #main-back-etmeasurementjacket").find("div.pt-jacketimage-div img").attr("src");
			$("#container_jackets input#frntviewfinal2").val(fview); 
			$("#container_jackets input#bkviewfinal2").val(bview); 
			var arr = document.getElementById("harrJacket").value; 
			$("#container_jackets input#setarr2").val(arr);
		}
	}

	showPantMeasureSect(id);
	showMeasureSect(id);
}
function showJacketRanges(ttl,frange,trange,typ){
	var sizetyp=$("#container_jackets input[id^='bsizetyp']:checked").attr("value");
	if(sizetyp=="cm"){ 
		frange=Math.round(frange*2.54,2); 
		trange=Math.round(trange*2.54,2); 
	} else { 
		frange=frange; 
		trange=trange; 
	}
	var msrimg=url+"/Measurment/Shirts/"+typ+"/"+typ+".jpg"; 
	$("#container_jackets div.et-measure-image").find("figure img").attr("src",msrimg);
	$("#container_jackets div.et-measure-video").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.webm" type="video/webm"></video>');
	$("#container_jackets span#fldtitle").html(ttl); 
	$("#container_jackets span#rngfrom").html(frange); 
	$("#container_jackets span#rngto").html(trange); 
	$("#container_jackets span#mtyp").html(sizetyp);
}

function showPantRangesTemp(ttl,frange,trange,typ){
	var sizetyp=$("#container_jackets input[id^='bsizetyp']:checked").attr("value");
	if(sizetyp=="cm"){ 
		frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); 
	} else { frange=frange; trange=trange; }
	if(typ=="waist"){
		var msrimg=url+"/Measurment/Shirts/pwaist/"+typ+".jpg";
		$("#container_jackets div.et-measure-image").find("figure img").attr("src",msrimg);
		$("#container_jackets div.et-measure-video").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/pwaist/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/pwaist/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/pwaist/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/pwaist/'+typ+'.webm" type="video/webm"></video>');
	}else if(typ=="hip"){
		var msrimg=url+"/Measurment/Shirts/phip/"+typ+".jpg";
		$("#container_jackets div.et-measure-image").find("figure img").attr("src",msrimg);
		$("#container_jackets div.et-measure-video").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/phip/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/phip/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/phip/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/phip/'+typ+'.webm" type="video/webm"></video>');
	}else if(typ=="length"){
		var msrimg=url+"/Measurment/Shirts/plength/"+typ+".jpg";
		$("#container_jackets div.et-measure-image").find("figure img").attr("src",msrimg);
		$("#container_jackets div.et-measure-video").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/plength/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/plength/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/plength/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/plength/'+typ+'.webm" type="video/webm"></video>');
	} else {
		var msrimg=url+"/Measurment/Shirts/"+typ+"/"+typ+".jpg";
		$("#container_jackets div.et-measure-image").find("figure img").attr("src",msrimg);
		$("#container_jackets div.et-measure-video").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.webm" type="video/webm"></video>');
	}
	$("#container_jackets span#pant_fldtitle").html(ttl); 
	$("#container_jackets span#pant_rngfrom").html(frange); 
	$("#container_jackets span#pant_rngto").html(trange); 
	$("#container_jackets span#pant_mtyp").html(sizetyp);
}

function showVestRangesTemp(ttl,frange,trange,typ){
	var sizetyp=$("#container_jackets input[id^='bsizetyp']:checked").attr("value");
	if(sizetyp=="cm"){
		frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); 
	} else { frange=frange; trange=trange;}
	if(typ=="length"){
		var msrimg=url+"/Measurment/Shirts/vlength/"+typ+".jpg";
		$("#container_jackets div.et-measure-image").find("figure img").attr("src",msrimg);
		$("#container_jackets div.et-measure-video").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/vlength/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/vlength/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/vlength/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/vlength/'+typ+'.webm" type="video/webm"></video>'); 
	} else {
		var msrimg=url+"/Measurment/Shirts/"+typ+"/"+typ+".jpg";$("div.et-measure-image").find("figure img").attr("src",msrimg);$("div.et-measure-video").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.webm" type="video/webm"></video>'); 
	}
	$("#container_jackets span#vest_fldtitle").html(ttl); 
	$("#container_jackets span#vest_rngfrom").html(frange); 
	$("#container_jackets span#vest_rngto").html(trange); 
	$("#container_jackets span#vest_mtyp").html(sizetyp);
}

function validateJacketField(fid,frange,trange){
	var sizetyp=$("#container_jackets input[id^='bsizetyp']:checked").attr("value"); 
	var fval=$("#container_jackets #"+fid).val();
	if(sizetyp=="cm"){
		frange=Math.round(frange*2.54,2); 
		trange=Math.round(trange*2.54,2); 
	} else { frange=frange; trange=trange; }
	if(fval==""){ 
		$("#container_jackets #"+fid).css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'}); 
	} else if(fval<frange || fval>trange){ 
		$("#container_jackets #"+fid).css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'}); 
	} else { 
		$("#container_jackets #"+fid).css({'border-color':'#090','box-shadow':'0px 0px 15px #090'}); 
	}
}

function validatePantFieldTemp(fid,frange,trange){
	var sizetyp=$("#container_jackets input[id^='bsizetyp']:checked").attr("value"); 
	var fval=$("#"+fid).val();
	if(sizetyp=="cm"){ 
		frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); 
	} else { frange=frange; trange=trange; }
	
	if(fval==""){ 
		$("#container_jackets #"+fid).css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'}); 
	} else if(fval<frange || fval>trange){ 
		$("#container_jackets #"+fid).css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'}); 
	} else { 
		$("#container_jackets #"+fid).css({'border-color':'#090','box-shadow':'0px 0px 15px #090'}); 
	}
}

function validateVestFieldTemp(fid,frange,trange){
	var sizetyp=$("#container_jackets input[id^='bsizetyp']:checked").attr("value");
	var fval=$("#"+fid).val();
	if(sizetyp=="cm"){ 
		frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); 
	} else { frange=frange; trange=trange; }
	
	if(fval==""){
		$("#container_jackets #"+fid).css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
	} else if(fval<frange || fval>trange){ 
		$("#container_jackets #"+fid).css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
	} else { 
		$("#container_jackets #"+fid).css({'border-color':'#090','box-shadow':'0px 0px 15px #090'}); 
	}
}

function validatejacketbodyform(){
	var typ=$("#container_jackets input[id^='bsizetyp']:checked").attr("value"); 
	var rnge="";
	if(document.getElementById('bsizeChest').value==""){
		document.getElementById('bsizeChest').focus(); 
		return false;
	} else if(
		document.getElementById('bsizeChest').value!=""){
		rnge=$("#container_jackets #bsizeChest").attr("data-title").split('-'); 
		frange=parseFloat(rnge[0]); 
		trange=parseFloat(rnge[1]);
		if(typ=="cm"){
			frange=Math.round(frange*2.54,2); 
			trange=Math.round(trange*2.54,2);
		} else { frange=frange; trange=trange;}
		if(IsFloat(document.getElementById('bsizeChest').value)==false){
			$("#container_jackets #bsizeChest").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeChest').focus(); return false;
		} else if(parseFloat(document.getElementById('bsizeChest').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeChest').value) > parseFloat(trange)){
			$("#container_jackets #bsizeChest").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeChest').focus(); return false;
		}
	}
	if(
		document.getElementById('bsizeWaist').value==""){ 
		document.getElementById('bsizeWaist').focus(); 
		return false;
	} else if(document.getElementById('bsizeWaist').value!=""){
		rnge=$("#container_jackets #bsizeWaist").attr("data-title").split('-'); 
		frange=parseFloat(rnge[0]); 
		trange=parseFloat(rnge[1]);
		if(typ=="cm"){
			frange=Math.round(frange*2.54,2);
			trange=Math.round(trange*2.54,2);
		} else {frange=frange;trange=trange;}
		if(IsFloat(document.getElementById('bsizeWaist').value)==false){
			$("#container_jackets #bsizeWaist").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeWaist').focus(); return false;
		} else if(parseFloat(document.getElementById('bsizeWaist').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeWaist').value) > parseFloat(trange)){
			$("#container_jackets #bsizeWaist").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeWaist').focus(); return false;
		}
	}
	if(document.getElementById('bsizeHip').value==""){ document.getElementById('bsizeHip').focus(); return false;
	} else if(document.getElementById('bsizeHip').value!=""){
		rnge=$("#container_jackets #bsizeHip").attr("data-title").split('-'); 
		frange=parseFloat(rnge[0]); 
		trange=parseFloat(rnge[1]);
		if(typ=="cm"){
			frange=Math.round(frange*2.54,2); 
			trange=Math.round(trange*2.54,2);
		} else {frange=frange; trange=trange;}
		if(IsFloat(document.getElementById('bsizeHip').value)==false){
			$("#container_jackets #bsizeHip").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeHip').focus(); return false;
		} else if(parseFloat(document.getElementById('bsizeHip').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeHip').value) > parseFloat(trange)){
			$("#container_jackets #bsizeHip").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeHip').focus(); return false;
		}
	}
	if(document.getElementById('bsizeLength').value==""){
		document.getElementById('bsizeLength').focus(); return false;
	} else if(document.getElementById('bsizeLength').value!=""){
		rnge=$("#container_jackets #bsizeLength").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){frange=Math.round(frange*2.54,2);trange=Math.round(trange*2.54,2);} else {frange=frange;trange=trange;}
		if(IsFloat(document.getElementById('bsizeLength').value)==false){
			$("#container_jackets #bsizeLength").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeLength').focus(); return false;
		} else if(parseFloat(document.getElementById('bsizeLength').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeLength').value) > parseFloat(trange)){
			$("#container_jackets #bsizeLength").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeLength').focus();return false;
		}
	}
	if(document.getElementById('bsizeShoulder').value==""){ document.getElementById('bsizeShoulder').focus(); return false;
	} else if(document.getElementById('bsizeShoulder').value!=""){
		rnge=$("#container_jackets #bsizeShoulder").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){frange=Math.round(frange*2.54,2);trange=Math.round(trange*2.54,2);} else {frange=frange;trange=trange;}
		if(IsFloat(document.getElementById('bsizeShoulder').value)==false){
			$("#container_jackets #bsizeShoulder").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeShoulder').focus(); return false;
		} else if(parseFloat(document.getElementById('bsizeShoulder').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeShoulder').value) > parseFloat(trange)){
			$("#container_jackets #bsizeShoulder").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeShoulder').focus(); return false;
		}
	}
	if(document.getElementById('bsizeSleeve').value==""){document.getElementById('bsizeSleeve').focus(); return false;
	} else if(document.getElementById('bsizeSleeve').value!=""){
		rnge=$("#container_jackets #bsizeSleeve").attr("data-title").split('-');frange=parseFloat(rnge[0]);trange=parseFloat(rnge[1]);
		if(typ=="cm"){frange=Math.round(frange*2.54,2);trange=Math.round(trange*2.54,2);} else {frange=frange;trange=trange;}
		if(IsFloat(document.getElementById('bsizeSleeve').value)==false){
			$("#container_jackets #bsizeSleeve").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeSleeve').focus(); return false;
		} else if(parseFloat(document.getElementById('bsizeSleeve').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeSleeve').value) > parseFloat(trange)){
			$("#container_jackets #bsizeSleeve").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeSleeve').focus(); return false;
		}
	}
	return validatepantbodyform();
	// return true;
}
function changeJacketCntrySize(vl){
	$.ajax({
       	type:'POST',
       	// url:'/measurjackets',
       	url:'/measurjacketthree',
       	data:{sizeid : vl},
       	headers: {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       	success:function(data){
       		$("#container_jackets #divsizefit").html(data); 
       		changeJacketSizeDetails(); 
       	}
    });
}
function changeJacketSizeDetails(){
	var cid=$("#container_jackets #cntrysize").val(); 
	var sid=$("#container_jackets #sizefit").val(); 
	var typ=$("#container_jackets input[id='sizetyp']:checked").val(); 
	var hsfit=$("#container_jackets #sizefit option:selected").text();
	$.ajax({
       	type:'POST',
       	// url:'/measurjacketdtls',
       	url:'/measurjacketdtlsthree',
       	async: false,
       	data:{sizeid : sid, cntryid : cid},
       	headers: {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){ data=data.split('/');
			if(typ=="inch"){
				$("#container_jackets #vchest").html(data[0]);
				$("#container_jackets #sizechest").val(data[0]);
				$("#container_jackets #vwaist").html(data[1]);
				$("#container_jackets #sizewaist").val(data[1]);
				$("#container_jackets #vhip").html(data[2]);
				$("#container_jackets #sizehip").val(data[2]);
				$("#container_jackets #vshoulder").html(data[3]);
				$("#container_jackets #sizeshoulder").val(data[3]);
				$("#container_jackets #sizesleeve").val(data[4]);
				$("#container_jackets #sizelength").val(data[5]);
			} else if(typ=="cm"){
				$("#container_jackets #vchest").html(Math.round(data[0]*2.54,2));
				$("#container_jackets #sizechest").val(Math.round(data[0]*2.54,2));
				$("#container_jackets #vwaist").html(Math.round(data[1]*2.54,2));
				$("#container_jackets #sizewaist").val(Math.round(data[1]*2.54,2));
				$("#container_jackets #vhip").html(Math.round(data[2]*2.54,2));
				$("#container_jackets #sizehip").val(Math.round(data[2]*2.54,2));
				$("#container_jackets #vshoulder").html(Math.round(data[3]*2.54,2));
				$("#container_jackets #sizeshoulder").val(Math.round(data[3]*2.54,2));
				$("#container_jackets #sizelength").val(Math.round(data[4]*2.54,2));
				$("#container_jackets #sizelength").val(Math.round(data[5]*2.54,2));
			}
			$("#container_jackets #hsizefit").val(hsfit);
			$("#container_jackets p.et-tsize").text(typ);
			changePantSizeDetails();
			changeSizeDetails();
       }
    });
}

function IsFloat(str){return /^((\d+(\.\d*)?)|((\d*\.)?\d+))$/.test(str);}

function navigatejacketback(){
	var activesubtab=$(".mcd-sub-menu li a.active");
	var activesubtab_id = activesubtab.attr("id");
	var stab=$.trim(activesubtab_id.replace('sub_menu_',''));

	var main_tab = $(".mcd-menu li a.active");
	var main_tab_id = $(".mcd-menu li a.active").attr("id");
	var main_nav_str = main_tab_id.replace('main_menu_','');

	if(main_nav_str=="etfabric"){
	} else if(main_nav_str=="etstyle"){
		switch(stab){
			case "19":
				var next_main_menu = document.getElementById("main_menu_etfabric");
				openNav(next_main_menu,'etfabric');
				break;
			case "20":
				var next_sub_menu = document.getElementById("sub_menu_19");
				openPgContent(next_sub_menu,'menu-19','etstylejacket','19','','style');
				break;
			case "21":
				var next_sub_menu = document.getElementById("sub_menu_20");
				openPgContent(next_sub_menu,'menu-20','etstylejacket','20','','style');
				break;
			case "22":
				var next_sub_menu = document.getElementById("sub_menu_21");
				openPgContent(next_sub_menu,'menu-21','etstylejacket','21','','style');
				break;
			case "23":
				var next_sub_menu = document.getElementById("sub_menu_22");
				openPgContent(next_sub_menu,'menu-22','etstylejacket','22','','style');
				break;
			case "24":
				var next_sub_menu = document.getElementById("sub_menu_23");
				openPgContent(next_sub_menu,'menu-23','etstylejacket','23','','style');
				break;
		}
	} else if(main_nav_str=="etcontrast"){
		switch(stab){
			case "25":
				showStyleByImg('vest');
				var next_sub_menu = document.getElementById("sub_menu_39");
				openPgContent(next_sub_menu,'menu-39','etstyle','39','','style');
				break;
			case "26":
				var next_sub_menu = document.getElementById("sub_menu_40");
				openPgContent(next_sub_menu,'menu-40','etcontrast','40','','contrast');
				break;
			case "27":
				var next_sub_menu = document.getElementById("sub_menu_26");
				openPgContent(next_sub_menu,'menu-26','etcontrastjacket','26','','contrast');
				break;
			case "28":
				var next_sub_menu = document.getElementById("sub_menu_27");
				openPgContent(next_sub_menu,'menu-27','etcontrastjacket','27','','contrast');
				break;
			case "29":
				var next_sub_menu = document.getElementById("sub_menu_28");
				openPgContent(next_sub_menu,'menu-28','etcontrastjacket','28','','contrast');
				break;
		}
	}
}

function navigatejacketnext(){
	var activesubtab=$(".mcd-sub-menu li a.active");
	var activesubtab_id = activesubtab.attr("id");
	var stab=$.trim(activesubtab_id.replace('sub_menu_',''));

	var main_tab = $(".mcd-menu li a.active");
	var main_tab_id = $(".mcd-menu li a.active").attr("id");
	var main_nav_str = main_tab_id.replace('main_menu_','');

	if(main_nav_str=="etfabric"){
		var next_main_menu = document.getElementById("main_menu_etstyle");
		openNav(next_main_menu,'etstyle');
	} else if(main_nav_str=="etstyle"){
		switch(stab){
			case "19":
				var next_sub_menu = document.getElementById("sub_menu_20");
				openPgContent(next_sub_menu,'menu-20','etstylejacket','20','','style');
				break;
			case "20":
				var next_sub_menu = document.getElementById("sub_menu_21");
				openPgContent(next_sub_menu,'menu-21','etstylejacket','21','','style');
				break;
			case "21":
				var next_sub_menu = document.getElementById("sub_menu_22");
				openPgContent(next_sub_menu,'menu-22','etstylejacket','22','','style');
				break;
			case "22":
				var next_sub_menu = document.getElementById("sub_menu_23");
				openPgContent(next_sub_menu,'menu-23','etstylejacket','23','','style');
				break;
			case "23":
				var next_sub_menu = document.getElementById("sub_menu_24");
				openPgContent(next_sub_menu,'menu-24','etstylejacket','24','','style');
				break;
			case "24":
				showStyleByImg('pant');
				var next_sub_menu = document.getElementById("sub_menu_48");
				openPgContent(next_sub_menu,'menu-48','etstylepant','48','','style');
				break;
		}
	} else if(main_nav_str=="etcontrast"){
		switch(stab){
			case "25":
				var next_sub_menu = document.getElementById("sub_menu_54");
				openPgContent(next_sub_menu,'menu-54','etcontrastpant','54','','contrast');
				break;
			case "26":
				var next_sub_menu = document.getElementById("sub_menu_27");
				openPgContent(next_sub_menu,'menu-27','etcontrastjacket','27','','contrast');
				break;
			case "27":
				var next_sub_menu = document.getElementById("sub_menu_28");
				openPgContent(next_sub_menu,'menu-28','etcontrastjacket','28','','contrast');
				break;
			case "28":
				var next_sub_menu = document.getElementById("sub_menu_29");
				openPgContent(next_sub_menu,'menu-29','etcontrastjacket','29','','contrast');
				break;
			case "29":
				var next_main_menu = document.getElementById("main_menu_etmeasurement");
				openNav(next_main_menu,'etmeasurement');
				break;
		}
	}	
}

function updatejacketfabprice(){
	// var arr = document.getElementById("harrJacket").value; 
	// arr=JSON.parse(arr); 
	// var fabprice=arr['ofabricPrice'];
	// fabprice=parseFloat(fabprice);
	// $("#container_jackets .pt-dollor").html("$ "+fabprice);
	// $("#container_jackets .vwprice").html("1 Jacket: $ "+fabprice);
}
/* new added for body type */
function selectBodyType(option, type) {
    $('#body_type_ul_'+1+'_'+option).find('div.icon-check-2').remove();
    $('#body_type_'+1+'_'+option+'_'+type).append('<div class="icon-check-2"></div>');
    $('#body_type_ul_'+2+'_'+option).find('div.icon-check-2').remove();
    $('#body_type_'+2+'_'+option+'_'+type).append('<div class="icon-check-2"></div>');
    $('#body_type_ul_'+3+'_'+option).find('div.icon-check-2').remove();
    $('#body_type_'+3+'_'+option+'_'+type).append('<div class="icon-check-2"></div>');
    var arr = document.getElementById("harrJacket").value; 
    arr = JSON.parse(arr);
    arr['body_type_'+option] = type;
    var uparr = JSON.stringify(arr);
    $('#harrJacket').val(uparr);
    $("#container_jackets input#setarr").val(uparr);
    $("#container_jackets input#setarr2").val(uparr);
}
/* ============================ new added for outfit size =============================== */
function showJacketRanges2(ttl,frange,trange,typ){
	var sizetyp=$("#container_jackets input[id^='bsizetyp2']:checked").attr("value");
	if(sizetyp=="cm"){ 
		frange=Math.round(frange*2.54,2); 
		trange=Math.round(trange*2.54,2); 
	} else { 
		frange=frange; 
		trange=trange; 
	}
	var msrimg=url+"/Measurment/Shirts/"+typ+"/"+typ+".jpg"; 
	$("#container_jackets div.et-measure-image-2").find("figure img").attr("src",msrimg);
	$("#container_jackets div.et-measure-video-2").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.webm" type="video/webm"></video>');
	$("#container_jackets span#fldtitle2").html(ttl); 
	$("#container_jackets span#rngfrom2").html(frange); 
	$("#container_jackets span#rngto2").html(trange); 
	$("#container_jackets span#mtyp2").html(sizetyp);
}
function showPantRangesTemp2(ttl,frange,trange,typ){
	var sizetyp=$("#container_jackets input[id^='bsizetyp2']:checked").attr("value");
	if(sizetyp=="cm"){ 
		frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); 
	} else { frange=frange; trange=trange; }
	if(typ=="waist"){
		var msrimg=url+"/Measurment/Shirts/pwaist/"+typ+".jpg";
		$("#container_jackets div.et-measure-image-2").find("figure img").attr("src",msrimg);
		$("#container_jackets div.et-measure-video-2").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/pwaist/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/pwaist/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/pwaist/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/pwaist/'+typ+'.webm" type="video/webm"></video>');
	}else if(typ=="hip"){
		var msrimg=url+"/Measurment/Shirts/phip/"+typ+".jpg";
		$("#container_jackets div.et-measure-image-2").find("figure img").attr("src",msrimg);
		$("#container_jackets div.et-measure-video-2").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/phip/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/phip/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/phip/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/phip/'+typ+'.webm" type="video/webm"></video>');
	}else if(typ=="length"){
		var msrimg=url+"/Measurment/Shirts/plength/"+typ+".jpg";
		$("#container_jackets div.et-measure-image-2").find("figure img").attr("src",msrimg);
		$("#container_jackets div.et-measure-video-2").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/plength/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/plength/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/plength/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/plength/'+typ+'.webm" type="video/webm"></video>');
	} else {
		var msrimg=url+"/Measurment/Shirts/"+typ+"/"+typ+".jpg";
		$("#container_jackets div.et-measure-image-2").find("figure img").attr("src",msrimg);
		$("#container_jackets div.et-measure-video-2").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.webm" type="video/webm"></video>');
	}
	$("#container_jackets span#pant_fldtitle2").html(ttl); 
	$("#container_jackets span#pant_rngfrom2").html(frange); 
	$("#container_jackets span#pant_rngto2").html(trange); 
	$("#container_jackets span#pant_mtyp2").html(sizetyp);
}
function showVestRangesTemp2(ttl,frange,trange,typ){
	var sizetyp=$("#container_jackets input[id^='bsizetyp2']:checked").attr("value");
	if(sizetyp=="cm"){
		frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); 
	} else { frange=frange; trange=trange;}
	if(typ=="length"){
		var msrimg=url+"/Measurment/Shirts/vlength/"+typ+".jpg";
		$("#container_jackets div.et-measure-image-2").find("figure img").attr("src",msrimg);
		$("#container_jackets div.et-measure-video-2").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/vlength/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/vlength/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/vlength/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/vlength/'+typ+'.webm" type="video/webm"></video>'); 
	} else {
		var msrimg=url+"/Measurment/Shirts/"+typ+"/"+typ+".jpg";$("div.et-measure-image").find("figure img").attr("src",msrimg);$("div.et-measure-video").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.webm" type="video/webm"></video>'); 
	}
	$("#container_jackets span#vest_fldtitle2").html(ttl); 
	$("#container_jackets span#vest_rngfrom2").html(frange); 
	$("#container_jackets span#vest_rngto2").html(trange); 
	$("#container_jackets span#vest_mtyp2").html(sizetyp);
}

function validateJacketField2(fid,frange,trange){
	var sizetyp=$("#container_jackets input[id^='bsizetyp2']:checked").attr("value"); 
	var fval=$("#container_jackets #"+fid).val();
	if(sizetyp=="cm"){
		frange=Math.round(frange*2.54,2); 
		trange=Math.round(trange*2.54,2); 
	} else { frange=frange; trange=trange; }
	if(fval==""){ 
		$("#container_jackets #"+fid).css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'}); 
	} else if(fval<frange || fval>trange){ 
		$("#container_jackets #"+fid).css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'}); 
	} else { 
		$("#container_jackets #"+fid).css({'border-color':'#090','box-shadow':'0px 0px 15px #090'}); 
	}
}

function validatePantFieldTemp2(fid,frange,trange){
	var sizetyp=$("#container_jackets input[id^='bsizetyp2']:checked").attr("value"); 
	var fval=$("#"+fid).val();
	if(sizetyp=="cm"){ 
		frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); 
	} else { frange=frange; trange=trange; }
	
	if(fval==""){ 
		$("#container_jackets #"+fid).css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'}); 
	} else if(fval<frange || fval>trange){ 
		$("#container_jackets #"+fid).css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'}); 
	} else { 
		$("#container_jackets #"+fid).css({'border-color':'#090','box-shadow':'0px 0px 15px #090'}); 
	}
}

function validateVestFieldTemp2(fid,frange,trange){
	var sizetyp=$("#container_jackets input[id^='bsizetyp2']:checked").attr("value");
	var fval=$("#"+fid).val();
	if(sizetyp=="cm"){ 
		frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); 
	} else { frange=frange; trange=trange; }
	
	if(fval==""){
		$("#container_jackets #"+fid).css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
	} else if(fval<frange || fval>trange){ 
		$("#container_jackets #"+fid).css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
	} else { 
		$("#container_jackets #"+fid).css({'border-color':'#090','box-shadow':'0px 0px 15px #090'}); 
	}
}
function validatejacketbodyform2(){
	var typ=$("#container_jackets input[id^='bsizetyp2']:checked").attr("value"); 
	var rnge="";
	if(document.getElementById('bsizeChest2').value==""){
		document.getElementById('bsizeChest2').focus(); 
		return false;
	} else if(
		document.getElementById('bsizeChest2').value!=""){
		rnge=$("#container_jackets #bsizeChest2").attr("data-title").split('-'); 
		frange=parseFloat(rnge[0]); 
		trange=parseFloat(rnge[1]);
		if(typ=="cm"){
			frange=Math.round(frange*2.54,2); 
			trange=Math.round(trange*2.54,2);
		} else { frange=frange; trange=trange;}
		if(IsFloat(document.getElementById('bsizeChest2').value)==false){
			$("#container_jackets #bsizeChest2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeChest2').focus(); return false;
		} else if(parseFloat(document.getElementById('bsizeChest2').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeChest2').value) > parseFloat(trange)){
			$("#container_jackets #bsizeChest2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeChest2').focus(); return false;
		}
	}
	if(
		document.getElementById('bsizeWaist2').value==""){ 
		document.getElementById('bsizeWaist2').focus(); 
		return false;
	} else if(document.getElementById('bsizeWaist2').value!=""){
		rnge=$("#container_jackets #bsizeWaist2").attr("data-title").split('-'); 
		frange=parseFloat(rnge[0]); 
		trange=parseFloat(rnge[1]);
		if(typ=="cm"){
			frange=Math.round(frange*2.54,2);
			trange=Math.round(trange*2.54,2);
		} else {frange=frange;trange=trange;}
		if(IsFloat(document.getElementById('bsizeWaist2').value)==false){
			$("#container_jackets #bsizeWaist2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeWaist2').focus(); return false;
		} else if(parseFloat(document.getElementById('bsizeWaist2').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeWaist2').value) > parseFloat(trange)){
			$("#container_jackets #bsizeWaist2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeWaist2').focus(); return false;
		}
	}
	if(document.getElementById('bsizeHip2').value==""){ document.getElementById('bsizeHip2').focus(); return false;
	} else if(document.getElementById('bsizeHip2').value!=""){
		rnge=$("#container_jackets #bsizeHip2").attr("data-title").split('-'); 
		frange=parseFloat(rnge[0]); 
		trange=parseFloat(rnge[1]);
		if(typ=="cm"){
			frange=Math.round(frange*2.54,2); 
			trange=Math.round(trange*2.54,2);
		} else {frange=frange; trange=trange;}
		if(IsFloat(document.getElementById('bsizeHip2').value)==false){
			$("#container_jackets #bsizeHip2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeHip2').focus(); return false;
		} else if(parseFloat(document.getElementById('bsizeHip2').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeHip2').value) > parseFloat(trange)){
			$("#container_jackets #bsizeHip2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeHip2').focus(); return false;
		}
	}
	if(document.getElementById('bsizeLength2').value==""){
		document.getElementById('bsizeLength2').focus(); return false;
	} else if(document.getElementById('bsizeLength2').value!=""){
		rnge=$("#container_jackets #bsizeLength2").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){frange=Math.round(frange*2.54,2);trange=Math.round(trange*2.54,2);} else {frange=frange;trange=trange;}
		if(IsFloat(document.getElementById('bsizeLength2').value)==false){
			$("#container_jackets #bsizeLength2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeLength2').focus(); return false;
		} else if(parseFloat(document.getElementById('bsizeLength2').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeLength2').value) > parseFloat(trange)){
			$("#container_jackets #bsizeLength2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeLength2').focus();return false;
		}
	}
	if(document.getElementById('bsizeShoulder2').value==""){ document.getElementById('bsizeShoulder2').focus(); return false;
	} else if(document.getElementById('bsizeShoulder2').value!=""){
		rnge=$("#container_jackets #bsizeShoulder2").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){frange=Math.round(frange*2.54,2);trange=Math.round(trange*2.54,2);} else {frange=frange;trange=trange;}
		if(IsFloat(document.getElementById('bsizeShoulder2').value)==false){
			$("#container_jackets #bsizeShoulder2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeShoulder2').focus(); return false;
		} else if(parseFloat(document.getElementById('bsizeShoulder2').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeShoulder2').value) > parseFloat(trange)){
			$("#container_jackets #bsizeShoulder2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeShoulder2').focus(); return false;
		}
	}
	if(document.getElementById('bsizeSleeve2').value==""){document.getElementById('bsizeSleeve2').focus(); return false;
	} else if(document.getElementById('bsizeSleeve2').value!=""){
		rnge=$("#container_jackets #bsizeSleeve2").attr("data-title").split('-');frange=parseFloat(rnge[0]);trange=parseFloat(rnge[1]);
		if(typ=="cm"){frange=Math.round(frange*2.54,2);trange=Math.round(trange*2.54,2);} else {frange=frange;trange=trange;}
		if(IsFloat(document.getElementById('bsizeSleeve2').value)==false){
			$("#container_jackets #bsizeSleeve2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeSleeve2').focus(); return false;
		} else if(parseFloat(document.getElementById('bsizeSleeve2').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeSleeve2').value) > parseFloat(trange)){
			$("#container_jackets #bsizeSleeve2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeSleeve2').focus(); return false;
		}
	}

	// pant validate ---------------------------------------------------------------------
	if($('#temp_pant_bsizeWaist2').val()==""){ 
		$('#temp_pant_bsizeWaist2').focus(); 
		return false;
	} else if($('#temp_pant_bsizeWaist2').val()!=""){
		rnge=$('#temp_pant_bsizeWaist2').attr("data-title").split('-'); 
		frange=parseFloat(rnge[0]); 
		trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat($('#temp_pant_bsizeWaist2').val())==false){
			$('#temp_pant_bsizeWaist2').css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			$('#temp_pant_bsizeWaist2').focus(); return false;
		} else if(parseFloat($('#temp_pant_bsizeWaist2').val()) < parseFloat(frange) 
			|| parseFloat($('#temp_pant_bsizeWaist2').val()) > parseFloat(trange)){
			$('#temp_pant_bsizeWaist2').css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			$('#temp_pant_bsizeWaist2').focus(); return false;
		}
	}
	
	if($('#temp_pant_bsizeHip2').val()==""){ 
		$('#temp_pant_bsizeHip2').focus(); return false;
	} else if($('#temp_pant_bsizeHip2').val()!=""){
		rnge=$('#temp_pant_bsizeHip2').attr("data-title").split('-'); 
		frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat($('#temp_pant_bsizeHip2').val())==false){
			$('#temp_pant_bsizeHip2').css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			$('#temp_pant_bsizeHip2').focus(); return false;
		} else if(parseFloat($('#temp_pant_bsizeHip2').val()) < parseFloat(frange) || parseFloat($('#temp_pant_bsizeHip2').val()) > parseFloat(trange)){
			$('#temp_pant_bsizeHip2').css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			$('#temp_pant_bsizeHip2').focus(); return false;
		}
	}

	if($('#temp_pant_bsizeCrotch2').val()==""){ $('#temp_pant_bsizeCrotch2').focus(); return false;
	} else if($('#temp_pant_bsizeCrotch2').val()!=""){
		rnge=$('#temp_pant_bsizeCrotch2').attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat($('#temp_pant_bsizeCrotch2').val())==false){
			$('#temp_pant_bsizeCrotch2').css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			$('#temp_pant_bsizeCrotch2').focus(); return false;
			$('#temp_pant_bsizeCrotch2').css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
		} else if(parseFloat($('#temp_pant_bsizeCrotch2').val()) < parseFloat(frange) || parseFloat($('#temp_pant_bsizeCrotch2').val()) > parseFloat(trange)){
			$('#temp_pant_bsizeCrotch2').focus(); return false;
		}
	}

	if($('#temp_pant_bsizeLength2').val()==""){ $('#temp_pant_bsizeLength2').focus(); return false;
	} else if($('#temp_pant_bsizeLength2').val()!=""){
		rnge=$('#temp_pant_bsizeLength2').attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat($('#temp_pant_bsizeLength2').val())==false){
			$('#temp_pant_bsizeLength2').css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			$('#temp_pant_bsizeLength2').focus();
			return false;
		}
	}

	if($('#temp_pant_bsizeThigh2').val()==""){ $('#temp_pant_bsizeThigh2').focus(); return false;
	} else if($('#temp_pant_bsizeThigh2').val()!=""){
		rnge=$('#temp_pant_bsizeThigh2').attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat($('#temp_pant_bsizeThigh2').val())==false){
			$('#temp_pant_bsizeThigh2').css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			$('#temp_pant_bsizeThigh2').focus(); return false;
		} else if(parseFloat($('#temp_pant_bsizeThigh2').val()) < parseFloat(frange) || parseFloat($('#temp_pant_bsizeThigh2').val()) > parseFloat(trange)){
			$('#temp_pant_bsizeThigh2').css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			$('#temp_pant_bsizeThigh2').focus(); return false;
		}
	}

	// vest validate ---------------------------------------------------------
	if($('#temp_vest_bsizeChest2').val()==""){ $('#temp_vest_bsizeChest2').focus(); return false;
	} else if($('#temp_vest_bsizeChest2').val()!=""){
		rnge=$("#temp_vest_bsizeChest2").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat($('#temp_vest_bsizeChest2').val())==false){
			$("#temp_vest_bsizeChest2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			$('#temp_vest_bsizeChest2').focus(); return false;
		} else if(parseFloat($('#temp_vest_bsizeChest2').val()) < parseFloat(frange) || parseFloat($('#temp_vest_bsizeChest2').val()) > parseFloat(trange)){
			$("#temp_vest_bsizeChest2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			$('#temp_vest_bsizeChest2').focus(); return false;
		}
	}
	if($('#temp_vest_bsizeWaist2').val()==""){ $('#temp_vest_bsizeWaist2').focus(); return false;
	} else if($('#temp_vest_bsizeWaist2').val()!=""){
		rnge=$("#temp_vest_bsizeWaist2").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat($('#temp_vest_bsizeWaist2').val())==false){
			$("#temp_vest_bsizeWaist2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			$('#temp_vest_bsizeWaist2').focus(); return false;
		} else if(parseFloat($('#temp_vest_bsizeWaist2').val()) < parseFloat(frange) || parseFloat($('#temp_vest_bsizeWaist2').val()) > parseFloat(trange)){
			$("#temp_vest_bsizeWaist2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			$('#temp_vest_bsizeWaist2').focus(); return false;
		}
	}
	if($('#temp_vest_bsizeHip2').val()==""){ $('#temp_vest_bsizeHip2').focus(); return false;
	} else if($('#temp_vest_bsizeHip2').val()!=""){
		rnge=$("#temp_vest_bsizeHip2").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat($('#temp_vest_bsizeHip2').val())==false){
			$("#temp_vest_bsizeHip2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			$('#temp_vest_bsizeHip2').focus(); return false;
		} else if(parseFloat($('#temp_vest_bsizeHip2').val()) < parseFloat(frange) || parseFloat($('#temp_vest_bsizeHip2').val()) > parseFloat(trange)){
			$("#temp_vest_bsizeHip2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			$('#temp_vest_bsizeHip2').focus(); return false;
		}
	}
	if($('#temp_vest_bsizeLength2').val()==""){ $('#temp_vest_bsizeLength2').focus(); return false;
	} else if($('#temp_vest_bsizeLength2').val()!=""){
		rnge=$("#temp_vest_bsizeLength2").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat($('#temp_vest_bsizeLength2').val())==false){
			$("#temp_vest_bsizeLength2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			$('#temp_vest_bsizeLength2').focus(); return false;
		}
	}
	if($('#temp_vest_bsizeShoulder2').val()==""){ $('#temp_vest_bsizeShoulder2').focus(); return false;
	} else if($('#temp_vest_bsizeShoulder2').val()!=""){
		rnge=$("#temp_vest_bsizeShoulder2").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat($('#temp_vest_bsizeShoulder2').val())==false){
			$("#temp_vest_bsizeShoulder2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			$('#temp_vest_bsizeShoulder2').focus(); return false;
		} else if(parseFloat($('#temp_vest_bsizeShoulder2').val()) < parseFloat(frange) || parseFloat($('#temp_vest_bsizeShoulder2').val()) > parseFloat(trange)){
			$("#temp_vest_bsizeShoulder2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			$('#temp_vest_bsizeShoulder2').focus(); return false;
		}
	}
	return true;
}
//=========================================================================================================