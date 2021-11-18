var retfrontsrc=[];var retbacksrc=[]; var fcanvas = new fabric.StaticCanvas('frontcanvas');var bcanvas = new fabric.StaticCanvas('backcanvas');

function designProcessing(jArray){
	frontdesignProcess(jArray);
	backdesignProcess(jArray);
	
}
/* ---------------------------------------------------------------------------------------------- */
function backdesignProcess(jArray){
	var backArr = {};var fabimg = jArray['ofabric']+".png";var fabcontrastimg = jArray['ocontrast']+".png";var imgNone="";var vent="";var bkcollar="";var elbowcont=""; 
	/* VENTS */
	if(jArray['ovent']=="82"){ vent=url+"/Jacket/Style/Vent/NoVent/Front/"+fabimg;} else if(jArray['ovent']=="83"){ vent=url+"/Jacket/Style/Vent/CenterVent/Front/"+fabimg;} else if(jArray['ovent']=="84"){vent=url+"/Jacket/Style/Vent/SideVent/Front/"+fabimg;}
	/* BACKCOLLAR */
	if(jArray['olapelupper']=="true"){bkcollar=url+"/Jacket/ColorContrast/Mix/LapelUpper/Lapel/NotchLapel/1Button/Back/"+fabcontrastimg;} else {bkcollar=url+"/Jacket/Style/Lapel/NotchLapel/Back/"+fabimg;}
	/* ELBOW MIX */
	if(jArray['ocontelbowmix']=="true"){elbowcont=url+"/Jacket/ColorContrast/Mix/ElbowMix/Front/"+fabcontrastimg;} else {elbowcont=imgNone;}
	
	var backArr={elbow: elbowcont,backcollar: bkcollar,main: vent,};
	$.each(backArr,function(key,value){if(value!=""){retbacksrc.push(backArr[key]);}}); bcanvas.clear(); backProcessing();
}
function backProcessing(){
	var cdata = ""; var _src = retbacksrc.pop();
	fabric.Image.fromURL(_src, function(oImg) {
		bcanvas.add(oImg); cdata=bcanvas.toDataURL();
		if (retbacksrc.length > 0) { setTimeout(backProcessing, 40); 
		} else {
			$("div [id^='main-back-']").find("div.pt-image-div img").attr("src",cdata);
			$("#miniview-etstyle-24").css("background-image","url("+cdata+")");
			$("#miniview-etcontrast-27").css("background-image","url("+cdata+")");
		}
	});
}

function frontdesignProcess(jArray){
	var frontArr = {}; var imgNone = '';var fabimg = jArray['ofabric']+".png";var fabcontrastimg = jArray['ocontrast']+".png";var dbutton = jArray['obutton']+".png";var dthread = jArray['obuttonHole']+".png";var lining = jArray['olining']+".png";var frontmain="";var buttons="";var thread="";var pockts="";var slevbtn="";var liningimg="";var lapel="";var lapeltop="";var lapelbtnhole="";var lapeluprcontr="";var lapellowrcontr="";var brestpockt="";
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
	$.each(frontsrcs,function(key,value){if(value!=""){retfrontsrc.push(frontsrcs[key]);}}); fcanvas.clear();frontProcessing();
}
function frontProcessing(){
	var cdata = "";var _src = retfrontsrc.pop();
	fabric.Image.fromURL(_src, function(oImg) {
		fcanvas.add(oImg);cdata=fcanvas.toDataURL();
		if (retfrontsrc.length > 0) {setTimeout(frontProcessing, 40);} else {
		$("div [id^='main-front-']").find("div.pt-image-div img").attr("src",cdata);
		$("#miniview-etstyle-19").find("figure img").attr("src",cdata);$("#miniview-etstyle-20").css("background-image","url("+cdata+")");$("#miniview-etstyle-21").css("background-image","url("+cdata+")");$("#miniview-etstyle-22").css("background-image","url("+cdata+")");$("#miniview-etcontrast-25").find("figure img").attr("src",cdata);
		}
	});
}