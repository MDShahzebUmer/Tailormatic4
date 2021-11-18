/* Main Design Area File */
function designProcessing(jArray){
	var frontArr = {};
    var backArr = {};
	var cwidth= 340;
    var cheight= 417;
	var imgNone = '';
	var fabimg = jArray['ofabric']+".png";
	var fabcontrastimg = jArray['ocontrast']+".png";
	var dbutton = jArray['obutton']+".png";
	var dthread = jArray['obuttonHole']+".png";
	var dthstyle = jArray['obuttonHoleStyle'];
	var frontmain="";
	var backmain="";
	var sleeves="";
	var sleevebtn="";
	var backsleev="";
	var shoulder="";
	var shoulderbtn="";
	var pockets="";
	var pocketbtn="";
	var packnum=jArray['opacketCount'];
	var seams="";
	var collar="";
	var frontbutton="";
	var bkstyle="";
	var darts="";
	var boxplacket="";
	var boxpleats="";
	var collarinner="";
	var innerplacket="";
	var outerplacket="";
	var backcollr="";
	var cuffout="";
	var cuffin="";
	var cuffbtn="";
	var bottomcut="";
	var backcuffout="";
	var monogrmtext="";
	var monogrmcolor="";
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
			if(jArray['odart']=="true"){
				darts=url+"/Shirts/Style/Back/Drats/left/"+fabimg;
			} else {
				darts=imgNone;
			}
			bkstyle=imgNone;
			break;
		case "8":
			if(jArray['odart']=="true"){
				darts=url+"/Shirts/Style/Back/Drats/left/"+fabimg;
			} else {
				darts=imgNone;
			}
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
		monogrmtext=jArray['omonogramText'];
		monogrmcolor=jArray['omonogramtextColor'];
	} else { monogrmtext=imgNone; monogrmcolor=imgNone; }
	
	var frontsrcs = {
        front: frontmain,
		shoulder: shoulder,
		shoulderbttn : shoulderbtn,
		seams: seams,
		boxplacket: boxplacket,
		fthread: frontthread,
		fbutton: frontbutton,
		collar: collar,
		sleeve: sleeves,
		sleevebtn: sleevebtn,
		packet: pockets,
		packetbttn: pocketbtn,
		collarin: collarinner,
		cuffoutt: cuffout,
		cuffinn: cuffin,
		cuffbtn: cuffbtn,
		bottomcut: bottomcut,
    };
	
	var backsrcs = {
        backm: backmain,
		backcollar: backcollr,
		sleeve: backsleev,
		backcuffout: backcuffout,
		boxpleat: boxpleats,
		backtyp: bkstyle,
		dart: darts
    };
	
	frontProcessing(frontsrcs);
	backProcessing(backsrcs);
}
function frontProcessing(fArray){
	var canvas = new fabric.StaticCanvas('frontcanvas');
	var cdata = "";
	var frontArr=fArray;
	canvas.clear();
	$.each(frontArr,function(key,value){
		if(value!=""){
			cdata = "";
			fabric.Image.fromURL(frontArr[key], function(oImg) {
				canvas.add(oImg);
				cdata=canvas.toDataURL();
				$("div [id^='main-front-']").find("div.pt-image-div img").attr("src",cdata);
			});
		}
	});
}

function backProcessing(bArray){
	var canvas = new fabric.StaticCanvas('backcanvas');
	var cdata = "";
	var BackArr=bArray;
	canvas.clear();
	$.each(BackArr,function(key,value){
		if(value!=""){
			cdata = "";
			fabric.Image.fromURL(BackArr[key], function(oImg) {
				canvas.add(oImg);
				cdata=canvas.toDataURL();
				$("div [id^='main-back-']").find("div.pt-image-div img").attr("src",cdata);
			});
		}
	});
}

function designOpenProcessing(jArray){
	var frontArr = {};
    var backArr = {};
	var cwidth= 340;
    var cheight= 417;
	var imgNone = '';
	var fabimg = jArray['ofabric']+".png";
	var fabcontrastimg = jArray['ocontrast']+".png";
	var dbutton = jArray['obutton']+".png";
	var dthread = jArray['obuttonHole']+".png";
	var dthstyle = jArray['obuttonHoleStyle'];
	var frontmain="";
	var backmain="";
	var sleeves="";
	var sleevebtn="";
	var backsleev="";
	var shoulder="";
	var shoulderbtn="";
	var pockets="";
	var pocketbtn="";
	var packnum=jArray['opacketCount'];
	var seams="";
	var collar="";
	var frontbutton="";
	var bkstyle="";
	var darts="";
	var boxplacket="";
	var boxpleats="";
	var collarouter="";
	var collarinner="";
	var collarrightin="";
	var collarleftin="";
	var innerplacket="";
	var outerplacket="";
	var backcollr="";
	var cuffout="";
	var cuffin="";
	var cuffbtn="";
	var bottomcut="";
	var backcuffout="";

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
			if(jArray['odart']=="true"){
				darts=url+"/Shirts/Style/Back/Drats/left/"+fabimg;
			} else {
				darts=imgNone;
			}
			bkstyle=imgNone;
			break;
		case "8":
			if(jArray['odart']=="true"){
				darts=url+"/Shirts/Style/Back/Drats/left/"+fabimg;
			} else {
				darts=imgNone;
			}
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
	
	var frontsrcs = {
        front: frontmain,
		shoulder: shoulder,
		shoulderbttn : shoulderbtn,
		seams: seams,
		boxplacket: boxplacket,
		fthread: frontthread,
		fbutton: frontbutton,
		collar: collar,
		sleeve: sleeves,
		sleevebtn: sleevebtn,
		packet: pockets,
		packetbttn: pocketbtn,
		collarin: collarinner,
		frontplacketout: outerplacket,
		frontplacketin: innerplacket,
		collarleftin:collarleftin,
		collarout: collarouter,
		collarright: collarrightin,
		cuffoutt: cuffout,
		cuffinn: cuffin,
		cuffbtn: cuffbtn,
		bottomcut: bottomcut
    };
	
	var backsrcs = {
        backm: backmain,
		backcollar: backcollr,
		sleeve: backsleev,
		backcuffout: backcuffout,
		boxpleat: boxpleats,
		backtyp: bkstyle,
		dart: darts
    };
	
	frontProcessing(frontsrcs);
	backProcessing(backsrcs);
}