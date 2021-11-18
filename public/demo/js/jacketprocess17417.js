var retfrontsrc=[];
var retbacksrc=[];
var retsidesrc=[];
var fcanvas = new fabric.StaticCanvas('frontcanvas');
var bcanvas = new fabric.StaticCanvas('backcanvas');
var scanvas = new fabric.StaticCanvas('sidecanvas');
//
/* Main Preview Section*/
function viewMainBack(str){if(str=="etcontrast"){document.getElementById("main-front-"+str).style.display="none"; document.getElementById("main-side-"+str).style.display="none"; document.getElementById("main-back-"+str).style.display="block"; } else {document.getElementById("main-front-"+str).style.display="none"; document.getElementById("main-back-"+str).style.display="block";}}
function viewMainFront(str){if(str=="etcontrast"){document.getElementById("main-front-"+str).style.display="block"; document.getElementById("main-side-"+str).style.display="none"; document.getElementById("main-back-"+str).style.display="none"; } else {document.getElementById("main-front-"+str).style.display="block"; document.getElementById("main-back-"+str).style.display="none";}}
function viewMainSide(str){ document.getElementById("main-side-"+str).style.display="block"; document.getElementById("main-front-"+str).style.display="none"; document.getElementById("main-back-"+str).style.display="none";}
/* Main Preview Section Ends*/
///* Tab */
function getTabSect(str){
//	//alert(str);
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
	
	if(otitle=="etfabric"){$("#menuopttitle-"+otitle).html("Choose Your Fabric : ");} else {if(ttle=="19"){$("#menuopttitle-"+otitle).html("Choose Your Buttons :");} else if(ttle=="25"){$("#menuopttitle-"+otitle).html("Choose Your Contrast Fabric :");}}
	
	$("div[id^='miniview-']").css("display","none");
	$("#miniview-"+otitle+"-"+ttle).css("display","block");

	viewMainFront(otitle);
}
///* Page Option Functions */
function getPgOption(str,tabstr,attrid,attrnm){ 
//	//console.log(str);
	$(".pt-box-square").removeClass("active");
	$("#"+str).addClass("active");
	
	var optstr=str.replace("menu-","menu-opt-");
	var ttle=$.trim(attrnm);
	$("div[id^='menu-opt']").css("display","none");
	$("#"+optstr).css("display","block");
	
	if(tabstr=="etfabric"){$("#menuopttitle-"+tabstr).html("Choose Your Fabric : ");} else {if(attrid=="19"){$("#menuopttitle-"+tabstr).html("Choose Your Buttons :");} else if(attrid=="20"){$("#menuopttitle-"+tabstr).html("Choose Your Lapel Style :");} else if(attrid=="21"){$("#menuopttitle-"+tabstr).html("Choose Your Bottom :");} else if(attrid=="22"){$("#menuopttitle-"+tabstr).html("Choose Your Pocket :");} else if(attrid=="23"){$("#menuopttitle-"+tabstr).html("Choose Your Sleeve Button :");} else if(attrid=="24"){$("#menuopttitle-"+tabstr).html("Choose Your Vent :");} else if(attrid=="25"){$("#menuopttitle-"+tabstr).html("Choose Your Contrast Fabric :");} else if(attrid=="26"){$("#menuopttitle-"+tabstr).html("Choose Your Lining Fabrics :");} else if(attrid=="27"){$("#menuopttitle-"+tabstr).html("Choose Your Back Collar Color :");} else if(attrid=="28"){$("#menuopttitle-"+tabstr).html("Choose Your Button Color :");} else if(attrid=="29"){$("#menuopttitle-"+tabstr).html("Enter Desired Monogram/Initials { English Script Only}");}}

	$("div[id^='miniview-']").css("display","none");
	$("#miniview-"+tabstr+"-"+attrid).css("display","block");
	
	if(attrid=="24"){viewMainBack(tabstr);} else if(attrid=="26"){viewMainSide(tabstr);} else {viewMainFront(tabstr);}
}
//
//function changeMview(str){$("div[id^='tble_']").css("display","none");$("div#tble_"+str).css("display","block");}
///* ---------------------------------------------------------------------------------------------- */
function sidedesignProcess(jArray){
	var sideArr = {};var fabimg = jArray['ofabric']+".png";var fabcontrastimg = jArray['ocontrast']+".png";var lining = jArray['olining']+".png";var piping = jArray['opiping']+".png";var imgNone="";var mainimg="";var liningimg="";var pipingimg="";var monogrmtyp="";var monogrmtext="";var monogrmcolor="";var monospecial="";
	
	if(jArray['olapelupper']=="true" || jArray['olapellower']=="true"){mainimg=url+"/Jacket/FabricContrasts/View/"+fabcontrastimg;} else {mainimg=url+"/Jacket/Fabric/InsideView/"+fabimg;}
	liningimg=url+"/Jacket/ColorContrast/Lining/InsideView/"+lining;
	pipingimg=url+"/Jacket/ColorContrast/Piping/"+piping;
	
	/* Monogram*/
	/*if(jArray['omonogram']=="true"){
		monogrmtyp="1";
		monogrmtext=jArray['omonogramText'];
		monogrmcolor=jArray['omonogramtextColor'];
		if(jArray['omonogramSpecial']=="true"){ monospecial="Specially Tailored For";} else {monospecial=imgNone;}
		var ttmono=monogrmtyp+":"+monogrmtext+":"+monogrmcolor+":"+monospecial;
	} else { var ttmono=imgNone;}*/
	
	var sideArr={pipingm: pipingimg,liningm: liningimg,main: mainimg,};
	
	$.each(sideArr,function(key,value){if(value!=""){retsidesrc.push(sideArr[key]);}});
	scanvas.clear();
	sideProcessing();
}
function sideProcessing(){
	var cdata = "";
	var _src = retsidesrc.pop();
	//canvas.clear();
	fabric.Image.fromURL(_src, function(oImg) {
		scanvas.add(oImg);
		cdata=scanvas.toDataURL();
		$("div [id^='main-side-']").find("div.pt-image-div img").attr("src",cdata);
		$("#miniview-etcontrast-29").css("background-image","url("+cdata+")");
		if (retsidesrc.length > 0) {
		  setTimeout(sideProcessing, 40);
		}
	});
}
function backdesignProcess(jArray){
	var backArr = {};var fabimg = jArray['ofabric']+".png";var fabcontrastimg = jArray['ocontrast']+".png";var imgNone="";var vent="";var bkcollar="";var elbowcont=""; 
	if(jArray['ovent']=="82"){ vent=url+"/Jacket/Style/Vent/NoVent/Front/"+fabimg;} else if(jArray['ovent']=="83"){ vent=url+"/Jacket/Style/Vent/CenterVent/Front/"+fabimg;} else if(jArray['ovent']=="84"){vent=url+"/Jacket/Style/Vent/SideVent/Front/"+fabimg;}
	
	if(jArray['olapelupper']=="true"){bkcollar=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/NotchLapel/1Button/Back/"+fabcontrastimg;} else {bkcollar=url+"/Jacket/Style/Lapel/NotchLapel/Back/"+fabimg;}
	
	if(jArray['ocontelbowmix']=="true"){elbowcont=url+"/Jacket/ColorContrast/Mix/ElbowMix/Front/"+fabcontrastimg;} else {elbowcont=imgNone;}
	
	var backArr={elbow: elbowcont,backcollar: bkcollar,main: vent,};
	
	$.each(backArr,function(key,value){if(value!=""){retbacksrc.push(backArr[key]);}});
	bcanvas.clear();
	backProcessing();
}
function backProcessing(){
	var cdata = "";
	var _src = retbacksrc.pop();
	//canvas.clear();
	fabric.Image.fromURL(_src, function(oImg) {
		bcanvas.add(oImg);
		cdata=bcanvas.toDataURL();
		$("div [id^='main-back-']").find("div.pt-image-div img").attr("src",cdata);
		$("#miniview-etstyle-24").css("background-image","url("+cdata+")");
		$("#miniview-etcontrast-27").css("background-image","url("+cdata+")");
		if (retbacksrc.length > 0) {
		  setTimeout(backProcessing, 40);
		}
	});
}
//function monogramProcess(mtotal){
//	var cdata = ""; 
//	mtotal=mtotal.split(':');
//	var mtyp=$.trim(mtotal[0]);
//	var mtext=$.trim(mtotal[1]);
//	var mcolor=$.trim(mtotal[2]);
//	var mspcl=$.trim(mtotal[3]);
//	var text="";
//	if(mtyp!="" && mtext!="" && mspcl!=""){
//		text = new fabric.Text(mtext, { left: 177, top: 230, fontFamily: 'Mtcorsva', fontStyle: 'italic', fontSize: 10, fill: mcolor });
//		scanvas.add(text);
//		cdata=fcanvas.toDataURL();
//		$("div [id^='main-front-']").find("div.pt-image-div img").attr("src",cdata);
//		var tbactive=$(".nav-tabs").find("li.active a").attr("href");
//		var stbactive=$(tbactive).find('div .pt-variation div.active').attr("id");
//		stbactive=stbactive.replace("menu-","");
//		if(stbactive=="Sleeve" || stbactive=="Front") {
//			$("#figureimg-etstyle img").attr("src",cdata);
//		}
//	}
//}
function frontdesignProcess(jArray){
	var frontArr = {};
	var imgNone = '';
	var fabimg = jArray['ofabric']+".png";
	var fabcontrastimg = jArray['ocontrast']+".png";
	var dbutton = jArray['obutton']+".png";
	var dthread = jArray['obuttonHole']+".png";
	var lining = jArray['olining']+".png";
	var frontmain="";var buttons="";var thread="";var pockts="";var slevbtn="";var liningimg="";var lapel="";var lapeltop="";var lapelbtnhole="";var lapeluprcontr="";var lapellowrcontr="";var brestpockt="";
	/* BOTTOM */
	if(jArray['obottom']=="63"){frontmain=url+"/Jacket/Style/Bottom/Straight/Front/"+fabimg;} else if(jArray['obottom']=="64"){frontmain=url+"/Jacket/Style/Bottom/Curved/Front/"+fabimg;} else if(jArray['obottom']=="65"){frontmain=url+"/Jacket/Style/Bottom/SlightlyCurved/Front/"+fabimg;} else if(jArray['obottom']=="130"){frontmain=url+"/Jacket/Style/Bottom/DoubleSlightlyCurved/Front/"+fabimg;}
	
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

	var frontsrcs = {
		btnn: buttons,
		threaad: thread,
		pocket: pockts,
		slvbtn: slevbtn,
		lapelthole: lapelbtnhole,
		llapelcont: lapellowrcontr,
		lapelt: lapeltop,
		ulapelcont: lapeluprcontr,
		blapel: lapel,
		breastpockt: brestpockt,
		liningg: liningimg,
		front: frontmain,
	};
	$.each(frontsrcs,function(key,value){
		if(value!=""){
			retfrontsrc.push(frontsrcs[key]);
		}
	});
	fcanvas.clear();
	frontProcessing();
}
function frontProcessing(){
	var cdata = "";
	var _src = retfrontsrc.pop();
	//canvas.clear();
	fabric.Image.fromURL(_src, function(oImg) {
		fcanvas.add(oImg);
		cdata=fcanvas.toDataURL();
		$("div [id^='main-front-']").find("div.pt-image-div img").attr("src",cdata);
		$("#miniview-etstyle-19").find("figure img").attr("src",cdata);
		$("#miniview-etstyle-20").css("background-image","url("+cdata+")");
		$("#miniview-etstyle-21").css("background-image","url("+cdata+")");
		$("#miniview-etstyle-22").css("background-image","url("+cdata+")");
		$("#miniview-etcontrast-25").find("figure img").attr("src",cdata);
		if (retfrontsrc.length > 0) {
		  setTimeout(frontProcessing, 40);
		}
	});
}
/* ----------------------------------Option Selection Functions---------------------------------- */
function getfab(id,jArray,otab){	
    var arr=jArray;
    $.ajax({
       type:'POST',
       url:'/designjackets',
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
       url:'/designjackets',
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
       url:'/designjackets',
       data:{fabid : id, carr : arr, typ : '25', t : otab},
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
function getlining(id,jArray,otab){
    var arr=jArray;
    $.ajax({
       type:'POST',
       url:'/designjackets',
       data:{fabid : id, carr : arr, typ : '26', t : otab},
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
function getpiping(id,jArray,otab){
    var arr=jArray;
    $.ajax({
       type:'POST',
       url:'/designjackets',
       data:{fabid : id, carr : arr, typ : 'Piping', t : otab},
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
function getbackcollar(id,jArray,otab){
    var arr=jArray;
    $.ajax({
       type:'POST',
       url:'/designjackets',
       data:{fabid : id, carr : arr, typ : '27', t : otab},
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
function getbuttons(id,jArray,otab){
    var arr=jArray;
    $.ajax({
       type:'POST',
       url:'/designjackets',
       data:{fabid : id, carr : arr, typ : '28', t : otab},
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
       url:'/designjackets',
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
function getmonogram(id,jArray,otab){
    var arr=jArray;
    $.ajax({
       type:'POST',
       url:'/designjackets',
       data:{fabid : id, carr : arr, typ : '29', t : otab},
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
       url:'/designjackets',
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
function getmonotext(id,jArray,otab){
    var arr=jArray;
    $.ajax({
       type:'POST',
       url:'/designjackets',
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
function getseloptions(id,ctyp,jArray,otab){
    var arr=jArray;
    $.ajax({
       type:'POST',
       url:'/designjackets',
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
//
function showMeasureSect(id){
	$("div[id^='menu-mesure-']").css("display","none");
	$("#menu-mesure-"+id).css("display","block");
	
	$("#etmeasurement").find("div.pt-variation div.pt-box-square").removeClass("active");
	if(id=="bodysize" || id=="standardsize"){
		$("#menu-"+id).addClass("active");
		if(id=="bodysize"){ 
			$("input#bsizeChest").focus();
			$("span#fldtitle").html("Chest");
			$("span#rngfrom").html("28");
			$("span#rngto").html("75");
			$("div.et-measure-image").find("figure img").attr("src",url+"/Measurment/Shirts/chest/chest.jpg");
			$("div.et-measure-video").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/chest/chest.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/chest/chest.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/chest/chest.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/chest/chest.webm" type="video/webm"></video>');
			
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

function validatebodyform(){
	var typ=$("input[id^='bsizetyp']:checked").attr("value");
	var rnge="";
	
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
function changeCntrySize(vl){
	$.ajax({
       type:'POST',
       url:'/measurjackets',
       data:{sizeid : vl},
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){		
	   	//alert(data);
		$("#divsizefit").html(data);
		changeSizeDetails(); 
       }
    });
}
function changeSizeDetails(){
	var cid=$("#cntrysize").val();
	var sid=$("#sizefit").val();
	var typ=$("input[id='sizetyp']:checked").val();
	var hsfit=$("#sizefit option:selected").text();
	$.ajax({
       type:'POST',
       url:'/measurjacketdtls',
       data:{sizeid : sid, cntryid : cid},
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){
		   	//alert(data)
			data=data.split('/');
			if(typ=="inch"){
				$("#vchest").html(data[0]);
				$("#sizechest").val(data[0]);
				$("#vwaist").html(data[1]);
				$("#sizewaist").val(data[1]);
				$("#vhip").html(data[2]);
				$("#sizehip").val(data[2]);
				$("#vshoulder").html(data[3]);
				$("#sizeshoulder").val(data[3]);
				$("#sizesleeve").val(data[4]);
				$("#sizelength").val(data[5]);
			} else if(typ=="cm"){
				$("#vchest").html(Math.round(data[0]*2.54,2));
				$("#sizechest").val(Math.round(data[0]*2.54,2));
				$("#vwaist").html(Math.round(data[1]*2.54,2));
				$("#sizewaist").val(Math.round(data[1]*2.54,2));
				$("#vhip").html(Math.round(data[2]*2.54,2));
				$("#sizehip").val(Math.round(data[2]*2.54,2));
				$("#vshoulder").html(Math.round(data[3]*2.54,2));
				$("#sizeshoulder").val(Math.round(data[3]*2.54,2));
				$("#sizelength").val(Math.round(data[4]*2.54,2));
				$("#sizelength").val(Math.round(data[5]*2.54,2));
			}
			$("#hsizefit").val(hsfit);
			$("p.et-tsize").text(typ);
       }
    });
}
function IsFloat(str){return /^((\d+(\.\d*)?)|((\d*\.)?\d+))$/.test(str);}