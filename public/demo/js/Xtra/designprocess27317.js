/* Main Preview Section*/
function viewMainBack(str){
	document.getElementById("main-front-"+str).style.display="none";
	document.getElementById("main-back-"+str).style.display="block";
}

function viewMainFront(str){
	document.getElementById("main-front-"+str).style.display="block";
	document.getElementById("main-back-"+str).style.display="none";
}
/* Main Preview Section Ends*/
/* Tab */
function getTabSect(str,jarry){
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
	
	if(otitle=="etfabric"){
		$("#menuopttitle-"+otitle).html("Choose Your Fabric : ");
	} else {
		$("#menuopttitle-"+otitle).html("Choose Your "+ ttle.charAt(0).toUpperCase() + ttle.slice(1) +" Style : ");
	}
	
	var itm=$("#"+idopt).find('div .et-item-list li:eq(0)').attr("id");
	//alert(itm);
	itmm=itm.split('-');
	itmm=$.trim(itmm[1]);
	
	showTitle(itmm,otitle);
	showOptionTitle(itmm,otitle,jarry);
	
	$("div[id^='option-']").css("display","none");
	$("#option-"+ otitle +"-"+ttle).css("display","block");
	
	if(ttle=="Contrast"){
		$("figure[id^='figureimg-etcontrast-']").css("display","none");
		$("#figureimg-"+otitle+"-"+ttle).css("display","block");
	} else {
		var dsrc=$("#main-front-"+otitle).find("div.pt-image-div img").attr("src");
		$("#figureimg-"+otitle).html("<img src=\""+dsrc+"\" alt=\"\">");
	}
	
	viewMainFront(otitle);
}
/* Page Option Functions */
function getPgOption(str,tabstr,attrnm,jid,jarry){ 
	//alert(str);
	$(".pt-box-square").removeClass("active");
	$("#"+str).addClass("active");
	
	var optstr=str.replace("menu-","menu-opt-");
	var ttle=$.trim(str.replace("menu-",""));
	$("div[id^='menu-opt']").css("display","none");
	$("#"+optstr).css("display","block");
	
	if(tabstr=="etfabric"){
		$("#menuopttitle-"+tabstr).html("Choose Your Fabric : ");
	} else {
		$("#menuopttitle-"+tabstr).html("Choose Your "+ ttle.charAt(0).toUpperCase() + ttle.slice(1) +" Style : ");
	}
	
	showTitle(attrnm,tabstr);
	showOptionTitle(attrnm,tabstr,jarry);
	
	if(ttle=="Bottom" || ttle=="Collar" || ttle=="Cuffs" || ttle=="Pockets"){
		var fimgval=$("#optionlist-"+ttle+"-"+jid).find(".et-item-img").html();
		$("#figureimg-"+tabstr).html(fimgval);
		
	} else if(ttle=="Contrast" || ttle=="Buttons" || ttle=="Monogram"){
		$("figure[id^='figureimg-etcontrast-']").css("display","none");
		$("#figureimg-"+tabstr+"-"+ttle).css("display","block");
		
	} else {
		if(ttle=="Back"){
			var dsrc=$("#main-back-"+tabstr).find("div.pt-image-div img").attr("src");
			$("#figureimg-"+tabstr).html("<img src=\""+dsrc+"\" alt=\"\">");
		} else {
			var dsrc=$("#main-front-"+tabstr).find("div.pt-image-div img").attr("src");
			$("#figureimg-"+tabstr).html("<img src=\""+dsrc+"\" alt=\"\">");
		}
	}
	
	$("div[id^='option-']").css("display","none");
	$("#option-"+ tabstr +"-"+attrnm).css("display","block");
	
	if(attrnm=="Back"){
		viewMainBack(tabstr);
	} else {
		viewMainFront(tabstr);
	}
}
/* Page Option Functions Ends */

function showTitle(attrnm,tabstr){
	if(attrnm=="Sleeve"){
		$("#submenutitle-"+tabstr).html(attrnm);
	} else if(attrnm=="Front"){
		$("#submenutitle-"+tabstr).html(attrnm+" Style");
	} else if(attrnm=="Back"){
		$("#submenutitle-"+tabstr).html(attrnm+" Style");
	} else if(attrnm=="Bottom"){
		$("#submenutitle-"+tabstr).html(attrnm+" Style");
	} else if(attrnm=="Collar"){
		$("#submenutitle-"+tabstr).html(attrnm+" Style");
	} else if(attrnm=="Cuffs"){
		$("#submenutitle-"+tabstr).html(attrnm+" Style");
	} else if(attrnm=="Pockets"){
		$("#submenutitle-"+tabstr).html(attrnm+" Style");
	} else if(attrnm=="Contrast"){
		$("#submenutitle-"+tabstr).html("Contrast Fabric");
	} else if(attrnm=="Buttons"){
		$("#submenutitle-"+tabstr).html("Contrast & Thread");
	} else if(attrnm=="Monogram"){
		$("#submenutitle-"+tabstr).html("Monogram");
	}
}

function showOptionTitle(attrnm,tabstr,jarry){
	if(attrnm=="Sleeve"){
		$("#optiontitle-"+tabstr).html(jarry);
	} else if(attrnm=="Front"){
		$("#optiontitle-"+tabstr).html(jarry);
	} else if(attrnm=="Back"){
		$("#optiontitle-"+tabstr).html(jarry);
	} else if(attrnm=="Bottom"){
		$("#optiontitle-"+tabstr).html(jarry);
	} else if(attrnm=="Collar"){
		$("#optiontitle-"+tabstr).html(jarry);
	} else if(attrnm=="Cuffs"){
		$("#optiontitle-"+tabstr).html(jarry);
	} else if(attrnm=="Pockets"){
		$("#optiontitle-"+tabstr).html(jarry);
	}
}

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
	var backcollr="";
	/* FRONT Variables */
	
	switch(jArray['obottom']){
		case "11":
			frontmain=url+"/Shirts/Style/Bottom/TriTab/Front/"+fabimg;
			backmain=url+"/Shirts/Style/Bottom/TriTab/Back/"+fabimg;
			if(jArray['ofront']=="5"){ boxplacket=url+"/Shirts/Style/Bottom/TriTab/Inner/"+fabimg; } else { boxplacket=imgNone; }
			if(jArray['oback']=="8"){ boxpleats=url+"/Shirts/Style/Bottom/TriTab/Outer/"+fabimg; } else { boxpleats=imgNone; }
			break;
		case "12":
			frontmain=url+"/Shirts/Style/Bottom/Straight/Front/"+fabimg;
			backmain=url+"/Shirts/Style/Bottom/Straight/Back/"+fabimg;
			if(jArray['ofront']=="5"){ boxplacket=url+"/Shirts/Style/Bottom/Straight/Inner/"+fabimg;	} else { boxplacket=imgNone; }
			if(jArray['oback']=="8"){ boxpleats=url+"/Shirts/Style/Bottom/Straight/Outer/"+fabimg; } else { boxpleats=imgNone; }
			break;
		case "13":
			frontmain=url+"/Shirts/Style/Bottom/StraightVents/Front/"+fabimg;
			backmain=url+"/Shirts/Style/Bottom/StraightVents/Back/"+fabimg;
			if(jArray['ofront']=="5"){ boxplacket=url+"/Shirts/Style/Bottom/StraightVents/Inner/"+fabimg; } else { boxplacket=imgNone; }
			if(jArray['oback']=="8"){ boxpleats=url+"/Shirts/Style/Bottom/StraightVents/Outer/"+fabimg; } else { boxpleats=imgNone; }
			break;
		default:
			frontmain=url+"/Shirts/Style/Bottom/TriTab/Front/"+fabimg;
			backmain=url+"/Shirts/Style/Bottom/TriTab/Back/"+fabimg;
			if(jArray['ofront']=="5"){ boxplacket=url+"/Shirts/Style/Bottom/TriTab/Inner/"+fabimg; } else { boxplacket=imgNone; }
			if(jArray['oback']=="8"){ boxpleats=url+"/Shirts/Style/Bottom/TriTab/Outer/"+fabimg; } else { boxpleats=imgNone; }
			break;
	}
	
	
	if(jArray['oshoulder']=="true"){
		shoulder=url+"/Shirts/Style/Sleeve/Epaulettes/left/"+fabimg;
		shoulderbtn=url+"/Shirts/Style/Sleeve/LongSleeve/Button/EpaulettesButton/"+dbutton;
	} else {
		shoulder=imgNone;
		shoulderbtn=imgNone;
	}
	
	
	if(jArray['oseams']=="true"){
		seams=url+"/Shirts/Style/Front/Seams/left/"+fabimg;
	} else {
		seams=imgNone;
	}
	
	
	switch(jArray['osleeve']){
		case "1":
		sleeves=url+"/Shirts/Style/Sleeve/LongSleeve/Front/"+fabimg;
		backsleev=url+"/Shirts/Style/Sleeve/LongSleeve/Back/"+fabimg;
		break;
		case "2":
		sleeves=url+"/Shirts/Style/Sleeve/LongSleeveRollup/Front/"+fabimg;
		backsleev=url+"/Shirts/Style/Sleeve/LongSleeveRollup/Back/"+fabimg;
		break;
		case "3":
		sleeves=url+"/Shirts/Style/Sleeve/ShortSleeve/Front/"+fabimg;
		backsleev=url+"/Shirts/Style/Sleeve/ShortSleeve/Back/"+fabimg;	
		break;
		default:
		sleeves=url+"/Shirts/Style/Sleeve/LongSleeve/Front/"+fabimg;
		backsleev=url+"/Shirts/Style/Sleeve/LongSleeve/Back/"+fabimg;
		break;
	}
	
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
	
	var frontthread=url+"/Shirts/Style/Front/BoxPlacket/Thread/VFront/"+dthread;
	
	
	switch(jArray['ocollar']){
		case "14":
			frontbutton=url+"/Shirts/Style/Collar/ItalianCollar1Button/Button/ShowImg/"+dbutton;
			collar=url+"/Shirts/Style/Collar/ItalianCollar1Button/Front/"+fabimg;
			break;
		case "15":
			frontbutton=url+"/Shirts/Style/Collar/ItalianCollar2Button/Button/ShowImg/"+dbutton;
			collar=url+"/Shirts/Style/Collar/ItalianCollar2Button/Front/"+fabimg;
			break;
		case "16":
			frontbutton=url+"/Shirts/Style/Collar/FrenchCollar1Button/Button/ShowImg/"+dbutton;
			collar=url+"/Shirts/Style/Collar/FrenchCollar1Button/Front/"+fabimg;
			break;
		case "17":
			frontbutton=url+"/Shirts/Style/Collar/FrenchCollar2Button/Button/ShowImg/"+dbutton;
			collar=url+"/Shirts/Style/Collar/FrenchCollar2Button/Front/"+fabimg;
			break;
		case "18":
			frontbutton=url+"/Shirts/Style/Collar/CutAway1Button/Button/ShowImg/"+dbutton;
			collar=url+"/Shirts/Style/Collar/CutAway1Button/Front/"+fabimg;
			break;
		case "19":
			frontbutton=url+"/Shirts/Style/Collar/CutAway2Button/Button/ShowImg/"+dbutton;
			collar=url+"/Shirts/Style/Collar/CutAway2Button/Front/"+fabimg;
			break;
		case "20":
			frontbutton=url+"/Shirts/Style/Collar/RoundCollar/Button/ShowImg/"+dbutton;
			collar=url+"/Shirts/Style/Collar/RoundCollar/Front/"+fabimg;
			break;
		case "21":
			frontbutton=url+"/Shirts/Style/Collar/ButtonDown/Button/ShowImg/"+dbutton;
			collar=url+"/Shirts/Style/Collar/ButtonDown/Front/"+fabimg;
			break;
		case "22":
			frontbutton=url+"/Shirts/Style/Collar/HiddenButton/Button/ShowImg/"+dbutton;
			collar=url+"/Shirts/Style/Collar/HiddenButton/Front/"+fabimg;
			break;
		case "23":
			frontbutton=url+"/Shirts/Style/Collar/Tab/Button/ShowImg/"+dbutton;
			collar=url+"/Shirts/Style/Collar/Tab/Front/"+fabimg;
			break;
		case "24":
			frontbutton=url+"/Shirts/Style/Collar/BatmanCollar/Button/ShowImg/"+dbutton;
			collar=url+"/Shirts/Style/Collar/BatmanCollar/Front/"+fabimg;
			break;
		case "25":
			frontbutton=url+"/Shirts/Style/Collar/ModernCollar/Button/ShowImg/"+dbutton;
			collar=url+"/Shirts/Style/Collar/ModernCollar/Front/"+fabimg;
			break;
		case "26":
			frontbutton=url+"/Shirts/Style/Collar/Tuxedo/Button/ShowImg/"+dbutton;
			collar=url+"/Shirts/Style/Collar/Tuxedo/Front/"+fabimg;
			break;
		case "27":
			frontbutton=url+"/Shirts/Style/Collar/Band/Button/ShowImg/"+dbutton;
			collar=url+"/Shirts/Style/Collar/Band/Front/"+fabimg;
			break;
	}

	if(jArray['ocollarCuffout']=="true"){ backcollr=url+"/Shirts/FabricContrasts/Mix/RightBackColler/"+fabcontrastimg; } else { backcollr=imgNone;}
		
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
			bkstyle=url+"/Shirts/Style/Back/BoxPleat/Back/"+fabimg;
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
		packet: pockets,
		packetbttn: pocketbtn,
    };
	
	var backsrcs = {
        backm: backmain,
		backcollar: backcollr,
		sleeve: backsleev,
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
	var backcuffout="";
	/* FRONT Variables */
	
	collarleftin=url+"/Shirts/Fabric/CollerBandIn/"+fabimg;
	
	switch(jArray['obottom']){
		case "11":
			frontmain=url+"/Shirts/Style/Bottom/TriTab/Front/"+fabimg;
			backmain=url+"/Shirts/Style/Bottom/TriTab/Back/"+fabimg;
			if(jArray['ofront']=="5"){ boxplacket=url+"/Shirts/Style/Bottom/TriTab/Inner/"+fabimg; } else { boxplacket=imgNone; }
			if(jArray['oback']=="8"){ boxpleats=url+"/Shirts/Style/Bottom/TriTab/Outer/"+fabimg; } else { boxpleats=imgNone; }
			break;
		case "12":
			frontmain=url+"/Shirts/Style/Bottom/Straight/Front/"+fabimg;
			backmain=url+"/Shirts/Style/Bottom/Straight/Back/"+fabimg;
			if(jArray['ofront']=="5"){ boxplacket=url+"/Shirts/Style/Bottom/Straight/Inner/"+fabimg;	} else { boxplacket=imgNone; }
			if(jArray['oback']=="8"){ boxpleats=url+"/Shirts/Style/Bottom/Straight/Outer/"+fabimg; } else { boxpleats=imgNone; }
			break;
		case "13":
			frontmain=url+"/Shirts/Style/Bottom/StraightVents/Front/"+fabimg;
			backmain=url+"/Shirts/Style/Bottom/StraightVents/Back/"+fabimg;
			if(jArray['ofront']=="5"){ boxplacket=url+"/Shirts/Style/Bottom/StraightVents/Inner/"+fabimg; } else { boxplacket=imgNone; }
			if(jArray['oback']=="8"){ boxpleats=url+"/Shirts/Style/Bottom/StraightVents/Outer/"+fabimg; } else { boxpleats=imgNone; }
			break;
		default:
			frontmain=url+"/Shirts/Style/Bottom/TriTab/Front/"+fabimg;
			backmain=url+"/Shirts/Style/Bottom/TriTab/Back/"+fabimg;
			if(jArray['ofront']=="5"){ boxplacket=url+"/Shirts/Style/Bottom/TriTab/Inner/"+fabimg; } else { boxplacket=imgNone; }
			if(jArray['oback']=="8"){ boxpleats=url+"/Shirts/Style/Bottom/TriTab/Outer/"+fabimg; } else { boxpleats=imgNone; }
			break;
	}
	
	
	if(jArray['oshoulder']=="true"){
		shoulder=url+"/Shirts/Style/Sleeve/Epaulettes/left/"+fabimg;
		shoulderbtn=url+"/Shirts/Style/Sleeve/LongSleeve/Button/EpaulettesButton/"+dbutton;
	} else {
		shoulder=imgNone;
		shoulderbtn=imgNone;
	}
	
	
	if(jArray['oseams']=="true"){
		seams=url+"/Shirts/Style/Front/Seams/left/"+fabimg;
	} else {
		seams=imgNone;
	}
	
	
	switch(jArray['osleeve']){
		case "1":
		sleeves=url+"/Shirts/Style/Sleeve/LongSleeve/Front/"+fabimg;
		backsleev=url+"/Shirts/Style/Sleeve/LongSleeve/Back/"+fabimg;
		if(jArray['ocollarCuffout']=="true"){ cuffout=url+"/Shirts/FabricContrasts/Mix/RightOutCuffLongPattern/"+fabcontrastimg; } else { cuffout=imgNone;}
		if(jArray['ocollarCuffIn']=="true"){ cuffin=url+"/Shirts/FabricContrasts/Mix/RightInCuffLongPattern/"+fabcontrastimg; } else { cuffin=imgNone;}
		break;
		case "2":
		sleeves=url+"/Shirts/Style/Sleeve/LongSleeveRollup/Front/"+fabimg;
		backsleev=url+"/Shirts/Style/Sleeve/LongSleeveRollup/Back/"+fabimg;
		if(jArray['ocollarCuffout']=="true"){ cuffout=url+"/Shirts/FabricContrasts/Mix/RightOutCuffRollPattern/"+fabcontrastimg; } else { cuffout=imgNone;}
		if(jArray['ocollarCuffIn']=="true"){ cuffin=url+"/Shirts/FabricContrasts/Mix/RightInCuffRollPattern/"+fabcontrastimg; } else { cuffin=imgNone;}
		break;
		case "3":
		sleeves=url+"/Shirts/Style/Sleeve/ShortSleeve/Front/"+fabimg;
		backsleev=url+"/Shirts/Style/Sleeve/ShortSleeve/Back/"+fabimg;
		cuffout=imgNone;	
		cuffin=imgNone;
		break;
		default:
		sleeves=url+"/Shirts/Style/Sleeve/LongSleeve/Front/"+fabimg;
		backsleev=url+"/Shirts/Style/Sleeve/LongSleeve/Back/"+fabimg;
		if(jArray['ocollarCuffout']=="true"){ cuffout=url+"/Shirts/FabricContrasts/Mix/RightOutCuffLongPattern/"+fabcontrastimg; } else { cuffout=imgNone;}
		if(jArray['ocollarCuffIn']=="true"){ cuffin=url+"/Shirts/FabricContrasts/Mix/RightInCuffLongPattern/"+fabcontrastimg; } else { cuffin=imgNone;}
		break;
	}
	
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
	
	var frontthread=url+"/Shirts/Style/Front/BoxPlacket/Thread/"+jArray['obuttonHoleStyle']+"Front/"+dthread;
	
	
	switch(jArray['ocollar']){
		case "14":
			frontbutton=url+"/Shirts/Style/Collar/ItalianCollar1Button/Button/ShowImg/"+dbutton;
			collar=url+"/Shirts/Style/Collar/ItalianCollar1Button/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/ItalianCollar1Button/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/ItalianCollar1Button/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg;
			break;
		case "15":
			frontbutton=url+"/Shirts/Style/Collar/ItalianCollar2Button/Button/ShowImg/"+dbutton;
			collar=url+"/Shirts/Style/Collar/ItalianCollar2Button/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/ItalianCollar2Button/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/ItalianCollar2Button/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg;
			break;
		case "16":
			frontbutton=url+"/Shirts/Style/Collar/FrenchCollar1Button/Button/ShowImg/"+dbutton;
			collar=url+"/Shirts/Style/Collar/FrenchCollar1Button/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/FrenchCollar1Button/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/FrenchCollar1Button/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg;
			break;
		case "17":
			frontbutton=url+"/Shirts/Style/Collar/FrenchCollar2Button/Button/ShowImg/"+dbutton;
			collar=url+"/Shirts/Style/Collar/FrenchCollar2Button/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/FrenchCollar2Button/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/FrenchCollar2Button/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg;
			break;
		case "18":
			frontbutton=url+"/Shirts/Style/Collar/CutAway1Button/Button/ShowImg/"+dbutton;
			collar=url+"/Shirts/Style/Collar/CutAway1Button/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/CutAway1Button/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/CutAway1Button/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg;
			break;
		case "19":
			frontbutton=url+"/Shirts/Style/Collar/CutAway2Button/Button/ShowImg/"+dbutton;
			collar=url+"/Shirts/Style/Collar/CutAway2Button/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/CutAway2Button/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/CutAway2Button/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg;
			break;
		case "20":
			frontbutton=url+"/Shirts/Style/Collar/RoundCollar/Button/ShowImg/"+dbutton;
			collar=url+"/Shirts/Style/Collar/RoundCollar/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/RoundCollar/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/RoundCollar/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg;
			break;
		case "21":
			frontbutton=url+"/Shirts/Style/Collar/ButtonDown/Button/ShowImg/"+dbutton;
			collar=url+"/Shirts/Style/Collar/ButtonDown/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/ButtonDown/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/ButtonDown/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg;
			break;
		case "22":
			frontbutton=url+"/Shirts/Style/Collar/HiddenButton/Button/ShowImg/"+dbutton;
			collar=url+"/Shirts/Style/Collar/HiddenButton/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/HiddenButton/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/HiddenButton/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg;
			break;
		case "23":
			frontbutton=url+"/Shirts/Style/Collar/Tab/Button/ShowImg/"+dbutton;
			collar=url+"/Shirts/Style/Collar/Tab/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/Tab/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/Tab/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg;
			break;
		case "24":
			frontbutton=url+"/Shirts/Style/Collar/BatmanCollar/Button/ShowImg/"+dbutton;
			collar=url+"/Shirts/Style/Collar/BatmanCollar/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/BatmanCollar/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/BatmanCollar/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg;
			break;
		case "25":
			frontbutton=url+"/Shirts/Style/Collar/ModernCollar/Button/ShowImg/"+dbutton;
			collar=url+"/Shirts/Style/Collar/ModernCollar/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/ModernCollar/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/ModernCollar/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg;
			break;
		case "26":
			frontbutton=url+"/Shirts/Style/Collar/Tuxedo/Button/ShowImg/"+dbutton;
			collar=url+"/Shirts/Style/Collar/Tuxedo/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/Tuxedo/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/Tuxedo/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg;
			break;
		case "27":
			frontbutton=url+"/Shirts/Style/Collar/Band/Button/ShowImg/"+dbutton;
			collar=url+"/Shirts/Style/Collar/Band/Front/"+fabimg;
			if(jArray['ocollarCuffout']=="true"){ collarouter=url+"/Shirts/FabricContrasts/Mix/Collar/Band/mainView/"+fabcontrastimg; } else { collarouter=url+"/Shirts/Style/Collar/Band/Show/"+fabimg; }
			if(jArray['ocollarCuffIn']=="true"){ collarrightin=url+"/Shirts/FabricContrasts/Mix/OpenCollerin/"+fabcontrastimg; } else { collarrightin=url+"/Shirts/Fabric/ImageIn/"+fabimg; }
			collarinner=url+"/Shirts/Fabric/InsideView/"+fabimg;
			break;
	}
	
	if(jArray['ofrontPlacketIn']=="true"){ innerplacket=url+"/Shirts/FabricContrasts/Mix/RightFrontIn/"+fabcontrastimg; } else { innerplacket=imgNone;}
	if(jArray['ofrontPlacketOut']=="true"){ outerplacket=url+"/Shirts/FabricContrasts/Mix/RightFrontOut/"+fabcontrastimg; } else { outerplacket=imgNone;}
	
	if(jArray['ocollarCuffout']=="true"){ backcollr=url+"/Shirts/FabricContrasts/Mix/RightBackColler/"+fabcontrastimg; } else { backcollr=imgNone;}
	
	
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
			bkstyle=url+"/Shirts/Style/Back/BoxPleat/Back/"+fabimg;
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
		packet: pockets,
		packetbttn: pocketbtn,
		collarin: collarinner,
		frontplacketout: outerplacket,
		frontplacketin: innerplacket,
		collarleftin:collarleftin,
		collarout: collarouter,
		collarright: collarrightin,
		cuffoutt: cuffout,
		cuffinn: cuffin
    };
	
	var backsrcs = {
        backm: backmain,
		backcollar: backcollr,
		sleeve: backsleev,
		boxpleat: boxpleats,
		backtyp: bkstyle,
		dart: darts
    };
	
	frontProcessing(frontsrcs);
	backProcessing(backsrcs);
}