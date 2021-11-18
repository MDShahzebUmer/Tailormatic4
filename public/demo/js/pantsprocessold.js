var retfrontsrc=[];var retbacksrc=[];var fcanvas = new fabric.StaticCanvas('frontcanvas');var bcanvas = new fabric.StaticCanvas('backcanvas');

/* Main Preview Section*/
function viewMainBack(str){ document.getElementById("main-front-"+str).style.display="none"; document.getElementById("main-back-"+str).style.display="block";}
function viewMainFront(str){ document.getElementById("main-front-"+str).style.display="block"; document.getElementById("main-back-"+str).style.display="none";}
///* Tab */
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
	
	if(otitle=="etfabric"){$("#menuopttitle-"+otitle).html("Choose Your Fabric : ");} else {if(ttle=="48"){$("#menuopttitle-"+otitle).html("Choose Your Pant Style :");} else if(ttle=="54"){$("#menuopttitle-"+otitle).html("Choose Your Contrast Fabric :");}}
	
	$("div[id^='miniview-']").css("display","none"); $("#miniview-"+otitle+"-"+ttle).css("display","block"); viewMainFront(otitle);
}
///* Page Option Functions */
function getPgOption(str,tabstr,attrid,attrnm){ 
	$(".pt-box-square").removeClass("active"); $("#"+str).addClass("active"); var optstr=str.replace("menu-","menu-opt-"); var ttle=$.trim(attrnm); $("div[id^='menu-opt']").css("display","none"); $("#"+optstr).css("display","block");
	
	if(tabstr=="etfabric"){$("#menuopttitle-"+tabstr).html("Choose Your Fabric : ");} else {if(attrid=="48"){$("#menuopttitle-"+tabstr).html("Choose Your Pant Style :");} else if(attrid=="49"){$("#menuopttitle-"+tabstr).html("Choose Your Pant Pleat Style :");} else if(attrid=="50"){$("#menuopttitle-"+tabstr).html("Choose Your Pant Pocket Style :");} else if(attrid=="51"){$("#menuopttitle-"+tabstr).html("Choose Your Back Pocket Style :");} else if(attrid=="52"){$("#menuopttitle-"+tabstr).html("Choose Your Pant Belt Loop Style :");} else if(attrid=="53"){$("#menuopttitle-"+tabstr).html("Choose Your Pant Cuff Style :");} else if(attrid=="54"){$("#menuopttitle-"+tabstr).html("Choose Your Contrast Fabrics :");} else if(attrid=="55"){$("#menuopttitle-"+tabstr).html("Choose Your Button Color :");}}

	$("div[id^='miniview-']").css("display","none"); $("#miniview-"+tabstr+"-"+attrid).css("display","block");
	
	if(attrid=="51"){viewMainBack(tabstr);} else {viewMainFront(tabstr);}
}

/* ---------------------------------------------------------------------------------------------- */
function backdesignProcess(jArray){
	var backArr = {};var fabimg = jArray['ofabric']+".png";var fabcontrastimg = jArray['ocontrast']+".png";var dbutton = jArray['obutton']+".png";var imgNone="";var mainimg="";var backlftpockts="";var backrtpockts="";var cuffimg="";var cuffbtn="";var beltloops="";var pocktleftbtn="";var pocktrightbtn="";
	/*BOTTOM*/
	if(jArray['ostyle']=="99"){mainimg=url+"/Pants/Style/Style/NormalStraight/Back/"+fabimg;} else if(jArray['ostyle']=="100"){mainimg=url+"/Pants/Style/Style/NarrowSlim/Back/"+fabimg;} else if(jArray['ostyle']=="101"){mainimg=url+"/Pants/Style/Style/BootFlare/Back/"+fabimg;} 
	/*POCKETS*/
	if(jArray['obackpockt']=="114"){
		if(jArray['obackpocktSide']=="left" || jArray['obackpocktSide']=="both"){if(jArray['ocontbackpockets']=="true"){backlftpockts=url+"/Pants/ColorContrast/Mix/BackPockets/BackPockets/SingleOpening/BackLeft/"+fabcontrastimg;} else {backlftpockts=url+"/Pants/Style/BackPockets/SingleOpening/Inner/"+fabimg;}}
		if(jArray['obackpocktSide']=="right" || jArray['obackpocktSide']=="both"){if(jArray['ocontbackpockets']=="true"){backrtpockts=url+"/Pants/ColorContrast/Mix/BackPockets/BackPockets/SingleOpening/Back/"+fabcontrastimg;} else {backrtpockts=url+"/Pants/Style/BackPockets/SingleOpening/Outer/"+fabimg;}}
	} else if(jArray['obackpockt']=="115"){
		if(jArray['obackpocktSide']=="left" || jArray['obackpocktSide']=="both"){if(jArray['ocontbackpockets']=="true"){backlftpockts=url+"/Pants/ColorContrast/Mix/BackPockets/BackPockets/DoubleOpening/BackLeft/"+fabcontrastimg;} else {backlftpockts=url+"/Pants/Style/BackPockets/DoubleOpening/Inner/"+fabimg;}}
		if(jArray['obackpocktSide']=="right" || jArray['obackpocktSide']=="both"){if(jArray['ocontbackpockets']=="true"){backrtpockts=url+"/Pants/ColorContrast/Mix/BackPockets/BackPockets/DoubleOpening/Back/"+fabcontrastimg;} else {backrtpockts=url+"/Pants/Style/BackPockets/DoubleOpening/Outer/"+fabimg;}}
	} else if(jArray['obackpockt']=="116"){
		if(jArray['obackpocktSide']=="left" || jArray['obackpocktSide']=="both"){if(jArray['ocontbackpockets']=="true"){backlftpockts=url+"/Pants/ColorContrast/Mix/BackPockets/BackPockets/ModernFlapWithButton/BackLeft/"+fabcontrastimg;} else {backlftpockts=url+"/Pants/Style/BackPockets/ModernFlapWithButton/Inner/"+fabimg;}pocktleftbtn=url+"/Pants/Style/BackPockets/ModernFlapWithButton/Button/LeftImg/"+dbutton;}
		if(jArray['obackpocktSide']=="right" || jArray['obackpocktSide']=="both"){if(jArray['ocontbackpockets']=="true"){backrtpockts=url+"/Pants/ColorContrast/Mix/BackPockets/BackPockets/ModernFlapWithButton/Back/"+fabcontrastimg;} else {backrtpockts=url+"/Pants/Style/BackPockets/ModernFlapWithButton/Outer/"+fabimg;}pocktrightbtn=url+"/Pants/Style/BackPockets/ModernFlapWithButton/Button/RightImg/"+dbutton;}
	} else if(jArray['obackpockt']=="117"){
		if(jArray['obackpocktSide']=="left" || jArray['obackpocktSide']=="both"){if(jArray['ocontbackpockets']=="true"){backlftpockts=url+"/Pants/ColorContrast/Mix/BackPockets/BackPockets/CurvedFlapWithButton/BackLeft/"+fabcontrastimg;} else {backlftpockts=url+"/Pants/Style/BackPockets/CurvedFlapWithButton/Inner/"+fabimg;}pocktleftbtn=url+"/Pants/Style/BackPockets/ModernFlapWithButton/Button/LeftImg/"+dbutton;}
		if(jArray['obackpocktSide']=="right" || jArray['obackpocktSide']=="both"){if(jArray['ocontbackpockets']=="true"){backrtpockts=url+"/Pants/ColorContrast/Mix/BackPockets/BackPockets/CurvedFlapWithButton/Back/"+fabcontrastimg;} else {backrtpockts=url+"/Pants/Style/BackPockets/CurvedFlapWithButton/Outer/"+fabimg;}pocktrightbtn=url+"/Pants/Style/BackPockets/ModernFlapWithButton/Button/RightImg/"+dbutton;}
	} else if(jArray['obackpockt']=="118"){
		if(jArray['obackpocktSide']=="left" || jArray['obackpocktSide']=="both"){if(jArray['ocontbackpockets']=="true"){backlftpockts=url+"/Pants/ColorContrast/Mix/BackPockets/BackPockets/SquareFlapWithButton/BackLeft/"+fabcontrastimg;} else {backlftpockts=url+"/Pants/Style/BackPockets/SquareFlapWithButton/Inner/"+fabimg;}pocktleftbtn=url+"/Pants/Style/BackPockets/ModernFlapWithButton/Button/LeftImg/"+dbutton;}
		if(jArray['obackpocktSide']=="right" || jArray['obackpocktSide']=="both"){if(jArray['ocontbackpockets']=="true"){backrtpockts=url+"/Pants/ColorContrast/Mix/BackPockets/BackPockets/SquareFlapWithButton/Back/"+fabcontrastimg;} else {backrtpockts=url+"/Pants/Style/BackPockets/SquareFlapWithButton/Outer/"+fabimg;}pocktrightbtn=url+"/Pants/Style/BackPockets/ModernFlapWithButton/Button/RightImg/"+dbutton;}
	}
	/*CUFFS*/
	if(jArray['ocuff']=="126"){cuffimg=url+"/Pants/Style/Cuffs/Cuff/Back/"+fabimg;} else if(jArray['ocuff']=="127"){cuffimg=url+"/Pants/Style/Cuffs/SingleTabs/Back/"+fabimg;} else if(jArray['ocuff']=="128"){cuffimg=url+"/Pants/Style/Cuffs/DoubleTabs/Back/"+fabimg;} else if(jArray['ocuff']=="129"){cuffimg=url+"/Pants/Style/Cuffs/FoldoverTabs/Back/"+fabimg;} 
	/*BELTLOOPS*/
	if(jArray['obeltloop']=="120"){
		if(jArray['ocontbeltloop']=="true"){beltloops=url+"/Pants/ColorContrast/Mix/BeltLoops/BeltLoops/Single/Back/"+fabcontrastimg;} else {beltloops=url+"/Pants/Style/BeltLoops/Single/Back/"+fabimg;}
	}else if(jArray['obeltloop']=="121"){
		if(jArray['ocontbeltloop']=="true"){beltloops=url+"/Pants/ColorContrast/Mix/BeltLoops/BeltLoops/Double/Back/"+fabcontrastimg;} else {beltloops=url+"/Pants/Style/BeltLoops/Double/Back/"+fabimg;}
	}else if(jArray['obeltloop']=="122"){
		if(jArray['ocontbeltloop']=="true"){beltloops=url+"/Pants/ColorContrast/Mix/BeltLoops/BeltLoops/Modern/Back/"+fabcontrastimg;} else {beltloops=url+"/Pants/Style/BeltLoops/Modern/Back/"+fabimg;}
	}
	
	var backArr={beltloops: beltloops,cuffs: cuffimg,bckpocktrbtn: pocktrightbtn,bckpocktlbtn: pocktleftbtn,backrightpockets: backrtpockts,backleftpockets: backlftpockts,main: mainimg,};
	
	$.each(backArr,function(key,value){if(value!=""){retbacksrc.push(backArr[key]);}}); bcanvas.clear(); backProcessing();
}
function backProcessing(){
	var cdata = ""; var _src = retbacksrc.pop();
	fabric.Image.fromURL(_src, function(oImg) {
		bcanvas.add(oImg); cdata=bcanvas.toDataURL();
		$("div [id^='main-back-']").find("div.pt-image-div img").attr("src",cdata);
		$("#miniview-etstyle-51").css("background-image","url("+cdata+")");
		$("#miniview-etcontrast-54").css("background-image","url("+cdata+")");
		if (retbacksrc.length > 0) { setTimeout(backProcessing, 40); }
	});
}
function frontdesignProcess(jArray){
	var frontArr = {};var imgNone = '';var fabimg = jArray['ofabric']+".png";var fabcontrastimg = jArray['ocontrast']+".png";var dbutton = jArray['obutton']+".png";var dthread = jArray['obuttonHole']+".png";var frontmain="";var cuffimg="";var cuffbtn="";var beltloops="";var beltloopbtn="";var pleatimg="";var pockets="";var waistband="";var waistbtn="";
	
	if(jArray['ostyle']=="99"){
		frontmain=url+"/Pants/Style/Style/NormalStraight/Front/"+fabimg; 
		if(jArray['ocuff']=="125"){cuffimg=url+"/Pants/Style/Cuffs/NormalStraight/Regular/Front/"+fabimg;} else if(jArray['ocuff']=="126"){cuffimg=url+"/Pants/Style/Cuffs/NormalStraight/Cuff/Front/"+fabimg;} else if(jArray['ocuff']=="127"){cuffimg=url+"/Pants/Style/Cuffs/NormalStraight/SingleTabs/Front/"+fabimg;cuffbtn=url+"/Pants/Style/Cuffs/SingleTabs/Button/MainImg/"+dbutton;} else if(jArray['ocuff']=="128"){cuffimg=url+"/Pants/Style/Cuffs/NormalStraight/DoubleTabs/Front/"+fabimg;cuffbtn=url+"/Pants/Style/Cuffs/DoubleTabs/Button/MainImg/"+dbutton;} else if(jArray['ocuff']=="129"){cuffimg=url+"/Pants/Style/Cuffs/NormalStraight/FoldoverTabs/Front/"+fabimg;cuffbtn=url+"/Pants/Style/Cuffs/FoldoverTabs/Button/MainImg/"+dbutton;} 
	} else if(jArray['ostyle']=="100"){
		frontmain=url+"/Pants/Style/Style/NarrowSlim/Front/"+fabimg; 
		if(jArray['ocuff']=="125"){cuffimg=url+"/Pants/Style/Cuffs/NarrowSlim/Regular/Front/"+fabimg;} else if(jArray['ocuff']=="126"){cuffimg=url+"/Pants/Style/Cuffs/NarrowSlim/Cuff/Front/"+fabimg;} else if(jArray['ocuff']=="127"){cuffimg=url+"/Pants/Style/Cuffs/NarrowSlim/SingleTabs/Front/"+fabimg;cuffbtn=url+"/Pants/Style/Cuffs/SingleTabs/Button/MainImg/"+dbutton;} else if(jArray['ocuff']=="128"){cuffimg=url+"/Pants/Style/Cuffs/NarrowSlim/DoubleTabs/Front/"+fabimg;cuffbtn=url+"/Pants/Style/Cuffs/DoubleTabs/Button/MainImg/"+dbutton;} else if(jArray['ocuff']=="129"){cuffimg=url+"/Pants/Style/Cuffs/NarrowSlim/FoldoverTabs/Front/"+fabimg;cuffbtn=url+"/Pants/Style/Cuffs/FoldoverTabs/Button/MainImg/"+dbutton;} 
	} else if(jArray['ostyle']=="101"){
		frontmain=url+"/Pants/Style/Style/BootFlare/Front/"+fabimg; 
		if(jArray['ocuff']=="125"){cuffimg=url+"/Pants/Style/Cuffs/BootFlare/Regular/Front/"+fabimg;} else if(jArray['ocuff']=="126"){cuffimg=url+"/Pants/Style/Cuffs/BootFlare/Cuff/Front/"+fabimg;} else if(jArray['ocuff']=="127"){cuffimg=url+"/Pants/Style/Cuffs/BootFlare/SingleTabs/Front/"+fabimg;cuffbtn=url+"/Pants/Style/Cuffs/SingleTabs/Button/MainImg/"+dbutton;} else if(jArray['ocuff']=="128"){cuffimg=url+"/Pants/Style/Cuffs/BootFlare/DoubleTabs/Front/"+fabimg;cuffbtn=url+"/Pants/Style/Cuffs/DoubleTabs/Button/MainImg/"+dbutton;} else if(jArray['ocuff']=="129"){cuffimg=url+"/Pants/Style/Cuffs/BootFlare/FoldoverTabs/Front/"+fabimg;cuffbtn=url+"/Pants/Style/Cuffs/FoldoverTabs/Button/MainImg/"+dbutton;} 
	} 
	/*BELTLOOPS*/
	if(jArray['obeltloop']=="120"){
		if(jArray['ocontbeltloop']=="true"){beltloops=url+"/Pants/ColorContrast/Mix/BeltLoops/BeltLoops/Single/Front/"+fabcontrastimg;} else {beltloops=url+"/Pants/Style/BeltLoops/Single/Front/"+fabimg;}
	}else if(jArray['obeltloop']=="121"){
		if(jArray['ocontbeltloop']=="true"){beltloops=url+"/Pants/ColorContrast/Mix/BeltLoops/BeltLoops/Double/Front/"+fabcontrastimg;} else {beltloops=url+"/Pants/Style/BeltLoops/Double/Front/"+fabimg;}
	}else if(jArray['obeltloop']=="122"){
		if(jArray['ocontbeltloop']=="true"){beltloops=url+"/Pants/ColorContrast/Mix/BeltLoops/BeltLoops/Modern/Front/"+fabcontrastimg;} else {beltloops=url+"/Pants/Style/BeltLoops/Modern/Front/"+fabimg;}
	}else if(jArray['obeltloop']=="123"){
		if(jArray['ocontbeltloop']=="true"){beltloops=url+"/Pants/ColorContrast/Mix/BeltLoops/BeltLoops/ButtonSideAdjusters/Front/"+fabcontrastimg;} else {beltloops=url+"/Pants/Style/BeltLoops/ButtonSideAdjusters/Front/"+fabimg;}
		beltloopbtn=url+"/Pants/Style/BeltLoops/ButtonSideAdjusters/Button/ShowImg/"+dbutton;
	}else if(jArray['obeltloop']=="124"){
		if(jArray['ocontbeltloop']=="true"){beltloops=url+"/Pants/ColorContrast/Mix/BeltLoops/BeltLoops/BuckleSideAdjusters/Front/"+fabcontrastimg;} else {beltloops=url+"/Pants/Style/BeltLoops/BuckleSideAdjusters/Front/"+fabimg;}
	}
	/*PLEATS*/
	if(jArray['opleat']=="103"){pleatimg=url+"/Pants/Style/Pleat/SinglePleat/Front/"+fabimg;} else if(jArray['opleat']=="104"){pleatimg=url+"/Pants/Style/Pleat/DoublePleats/Front/"+fabimg;} else if(jArray['opleat']=="105"){pleatimg=url+"/Pants/Style/Pleat/TriplePleats/Front/"+fabimg;} else if(jArray['opleat']=="106"){pleatimg=url+"/Pants/Style/Pleat/ScissorPleats/Front/"+fabimg;} else if(jArray['opleat']=="107"){pleatimg=url+"/Pants/Style/Pleat/BoxPleats/Front/"+fabimg;}
	/*POCKETS*/
	if(jArray['opacket']=="109"){pockets=url+"/Pants/Style/PantPocket/Slanted/Front/"+fabimg;} else if(jArray['opacket']=="110"){pockets=url+"/Pants/Style/PantPocket/SlantedWelt/Front/"+fabimg;} else if(jArray['opacket']=="111"){pockets=url+"/Pants/Style/PantPocket/StraightWelt/Front/"+fabimg;} else if(jArray['opacket']=="112" && jArray['opleat']=="102"){pockets=url+"/Pants/Style/PantPocket/ModernCurved/Front/"+fabimg;} else if(jArray['opacket']=="113" && jArray['opleat']=="102"){pockets=url+"/Pants/Style/PantPocket/Jeans/Front/"+fabimg;}
	/*WAIST BAND*/
	if(jArray['owaistbandedge']=="normal"){waistband=url+"/Pants/Fabric/Front/"+fabimg;} else if(jArray['owaistbandedge']=="round"){waistband=url+"/Pants/Fabric/Back/"+fabimg;waistbtn=url+"/Pants/Style/BeltLoops/NoBeltLoop/Button/MainImg/"+dbutton;} else if(jArray['owaistbandedge']=="square"){waistband=url+"/Pants/Fabric/InsideView/"+fabimg;waistbtn=url+"/Pants/Style/BeltLoops/NoBeltLoop/Button/MainImg/"+dbutton;}

	var frontsrcs = {beltloopbtn: beltloopbtn,beltloops: beltloops,cuffbuttn: cuffbtn,cuffs: cuffimg,waistbtn: waistbtn,waistband: waistband,pockets: pockets,pleat: pleatimg,front: frontmain, };
	
	$.each(frontsrcs,function(key,value){ if(value!=""){retfrontsrc.push(frontsrcs[key]);} }); fcanvas.clear(); frontProcessing();
}
function frontProcessing(){
	var cdata = ""; var _src = retfrontsrc.pop();
	fabric.Image.fromURL(_src, function(oImg) {
		fcanvas.add(oImg); cdata=fcanvas.toDataURL();
		$("div [id^='main-front-']").find("div.pt-image-div img").attr("src",cdata);
		$("#miniview-etstyle-48").find("figure img").attr("src",cdata);
		$("#miniview-etstyle-49").css("background-image","url("+cdata+")");
		$("#miniview-etstyle-50").css("background-image","url("+cdata+")");
		$("#miniview-etstyle-52").css("background-image","url("+cdata+")");
		$("#miniview-etcontrast-55").css("background-image","url("+cdata+")");
		if (retfrontsrc.length > 0) { setTimeout(frontProcessing, 40); }
	});
}
/* ----------------------------------Option Selection Functions---------------------------------- */
function getfab(id,jArray,otab){	
    var arr=jArray;
    $.ajax({
       type:'POST',
       url:'/designpants',
       data:{fabid : id, carr : arr, typ : 'fabric', t : otab},
	   beforeSend: function() { $(".et-small-loader").show(); },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){		   
		   	$('body').html(data); setTimeout($(".et-small-loader").fadeOut(),1000);
       }
    });
}
function getstyles(id,ctyp,jArray,otab){
    var arr=jArray;
    $.ajax({
       type:'POST',
       url:'/designpants',
       data:{fabid : id, carr : arr, typ : ctyp, t : otab},
	   beforeSend: function() { $(".et-small-loader").show(); },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){
			$('body').html(data); setTimeout($(".et-small-loader").fadeOut(),1000);
	   }
    });
}
function getcontrast(id,jArray,otab){
    var arr=jArray;
    $.ajax({
       type:'POST',
       url:'/designpants',
       data:{fabid : id, carr : arr, typ : '54', t : otab},
	   beforeSend: function() { $(".et-small-loader").show(); },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){		    
		  $('body').html(data); setTimeout($(".et-small-loader").fadeOut(),1000);
       }
    });
}
function getbuttons(id,jArray,otab){
    var arr=jArray;
    $.ajax({
       type:'POST',
       url:'/designpants',
       data:{fabid : id, carr : arr, typ : '55', t : otab},
	   beforeSend: function() { $(".et-small-loader").show(); },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){		    
		   $('body').html(data); setTimeout($(".et-small-loader").fadeOut(),1000);
       }
    });
}
function getthread(id,jArray,otab){
    var arr=jArray;
    $.ajax({
       type:'POST',
       url:'/designpants',
       data:{fabid : id, carr : arr, typ : 'Threads', t : otab},
	   beforeSend: function() { $(".et-small-loader").show();},
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){		    
		   	$('body').html(data); setTimeout($(".et-small-loader").fadeOut(),1000);
       }
    });
}
function getseloptions(id,ctyp,jArray,otab){
    var arr=jArray;
    $.ajax({
       type:'POST',
       url:'/designpants',
       data:{fabid : id, carr : arr, typ : ctyp, t : otab},
	   beforeSend: function() { $(".et-small-loader").show(); },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){		    
		   $('body').html(data); setTimeout($(".et-small-loader").fadeOut(),1000);
       }
    });
}
function showMeasureSect(id){
	$("div[id^='menu-mesure-']").css("display","none"); $("#menu-mesure-"+id).css("display","block");
	
	$("#etmeasurement").find("div.pt-variation div.pt-box-square").removeClass("active");
	if(id=="bodysize" || id=="standardsize"){
		$("#menu-"+id).addClass("active");
		if(id=="bodysize"){ 
			$("input#bsizeWaist").focus(); $("span#fldtitle").html("Waist"); $("span#rngfrom").html("16"); $("span#rngto").html("20");
			$("div.et-measure-image").find("figure img").attr("src",url+"/Measurment/Shirts/pwaist/waist.jpg");
			$("div.et-measure-video").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/pwaist/waist.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/pwaist/waist.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/pwaist/waist.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/pwaist/waist.webm" type="video/webm"></video>');
			
			var fview=$("#main-front-etmeasurement").find("div.pt-image-div img").attr("src");
			var bview=$("#main-back-etmeasurement").find("div.pt-image-div img").attr("src");
			$("input#frntviewfinal").val(fview); $("input#bkviewfinal").val(bview);
		} else if(id=="standardsize"){
			var fview=$("#main-front-etmeasurement").find("div.pt-image-div img").attr("src");
			var bview=$("#main-back-etmeasurement").find("div.pt-image-div img").attr("src");
			$("input#frntviewfinal").val(fview); $("input#bkviewfinal").val(bview);
		}
	}
}

function showRanges(ttl,frange,trange,typ){
	var sizetyp=$("input[id^='bsizetyp']:checked").attr("value");
	if(sizetyp=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
	if(typ=="waist"){
		var msrimg=url+"/Measurment/Shirts/pwaist/"+typ+".jpg";
		$("div.et-measure-image").find("figure img").attr("src",msrimg);
		$("div.et-measure-video").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/pwaist/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/pwaist/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/pwaist/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/pwaist/'+typ+'.webm" type="video/webm"></video>');
	}else if(typ=="hip"){
		var msrimg=url+"/Measurment/Shirts/phip/"+typ+".jpg";
		$("div.et-measure-image").find("figure img").attr("src",msrimg);
		$("div.et-measure-video").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/phip/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/phip/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/phip/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/phip/'+typ+'.webm" type="video/webm"></video>');
	}else if(typ=="length"){
		var msrimg=url+"/Measurment/Shirts/plength/"+typ+".jpg";
		$("div.et-measure-image").find("figure img").attr("src",msrimg);
		$("div.et-measure-video").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/plength/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/plength/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/plength/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/plength/'+typ+'.webm" type="video/webm"></video>');
	} else {
		var msrimg=url+"/Measurment/Shirts/"+typ+"/"+typ+".jpg";
		$("div.et-measure-image").find("figure img").attr("src",msrimg);
		$("div.et-measure-video").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.webm" type="video/webm"></video>');
	}
	$("span#fldtitle").html(ttl); $("span#rngfrom").html(frange); $("span#rngto").html(trange); $("span#mtyp").html(sizetyp);
}

function validateField(fid,frange,trange){
	var sizetyp=$("input[id^='bsizetyp']:checked").attr("value"); var fval=$("#"+fid).val();
	if(sizetyp=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
	
	if(fval==""){ $("#"+fid).css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'}); } else if(fval<frange || fval>trange){ $("#"+fid).css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'}); } else { $("#"+fid).css({'border-color':'#090','box-shadow':'0px 0px 15px #090'}); }
}

function validatebodyform(){
	var typ=$("input[id^='bsizetyp']:checked").attr("value"); var rnge="";
	
	if(document.getElementById('bsizeWaist').value==""){ document.getElementById('bsizeWaist').focus(); return false;
	} else if(document.getElementById('bsizeWaist').value!=""){
		rnge=$("#bsizeWaist").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat(document.getElementById('bsizeWaist').value)==false){
			$("#bsizeWaist").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeWaist').focus(); return false;
		} else if(parseFloat(document.getElementById('bsizeWaist').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeWaist').value) > parseFloat(trange)){
			$("#bsizeWaist").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeWaist').focus(); return false;
		}
	}
	if(document.getElementById('bsizeHip').value==""){ document.getElementById('bsizeHip').focus(); return false;
	} else if(document.getElementById('bsizeHip').value!=""){
		rnge=$("#bsizeHip").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat(document.getElementById('bsizeHip').value)==false){
			$("#bsizeHip").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeHip').focus(); return false;
		} else if(parseFloat(document.getElementById('bsizeHip').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeHip').value) > parseFloat(trange)){
			$("#bsizeHip").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeHip').focus(); return false;
		}
	}
	if(document.getElementById('bsizeCrotch').value==""){ document.getElementById('bsizeCrotch').focus(); return false;
	} else if(document.getElementById('bsizeCrotch').value!=""){
		rnge=$("#bsizeCrotch").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat(document.getElementById('bsizeCrotch').value)==false){
			$("#bsizeCrotch").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeCrotch').focus(); return false;
		} else if(parseFloat(document.getElementById('bsizeCrotch').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeCrotch').value) > parseFloat(trange)){
			$("#bsizeCrotch").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeCrotch').focus(); return false;
		}
	}
	if(document.getElementById('bsizeLength').value==""){ document.getElementById('bsizeLength').focus(); return false;
	} else if(document.getElementById('bsizeLength').value!=""){
		rnge=$("#bsizeLength").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat(document.getElementById('bsizeLength').value)==false){
			$("#bsizeLength").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeLength').focus();
			return false;
		}
	}
	if(document.getElementById('bsizeThigh').value==""){ document.getElementById('bsizeThigh').focus(); return false;
	} else if(document.getElementById('bsizeThigh').value!=""){
		rnge=$("#bsizeThigh").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat(document.getElementById('bsizeThigh').value)==false){
			$("#bsizeThigh").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeThigh').focus(); return false;
		} else if(parseFloat(document.getElementById('bsizeThigh').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeThigh').value) > parseFloat(trange)){
			$("#bsizeThigh").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeThigh').focus(); return false;
		}
	}
	return true;
}
function changeCntrySize(vl){
	$.ajax({
       type:'POST',
       url:'/measurpants',
       data:{sizeid : vl},
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){		
		$("#divsizefit").html(data); changeSizeDetails(); 
       }
    });
}
function changeSizeDetails(){
	var cid=$("#cntrysize").val(); var sid=$("#sizefit").val(); var typ=$("input[id='sizetyp']:checked").val(); var hsfit=$("#sizefit option:selected").text();
	$.ajax({
       type:'POST',
       url:'/measurpantsdtls',
       data:{sizeid : sid, cntryid : cid},
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){
			data=data.split('/');
			if(typ=="inch"){ $("#vwaist").html(data[0]); $("#sizewaist").val(data[0]); $("#vhip").html(data[1]); $("#sizehip").val(data[1]); $("#vcrotch").html(data[2]); $("#sizecrotch").val(data[2]); $("#vthigh").html(data[3]); $("#sizeThigh").val(data[3]); $("#sizelength").val(data[4]);
			} else if(typ=="cm"){ $("#vwaist").html(Math.round(data[0]*2.54,2)); $("#sizewaist").val(Math.round(data[0]*2.54,2)); $("#vhip").html(Math.round(data[1]*2.54,2)); $("#sizehip").val(Math.round(data[1]*2.54,2)); $("#vcrotch").html(Math.round(data[2]*2.54,2)); $("#sizecrotch").val(Math.round(data[2]*2.54,2)); $("#vthigh").html(Math.round(data[3]*2.54,2)); $("#sizeThigh").val(Math.round(data[3]*2.54,2)); $("#sizelength").val(Math.round(data[4]*2.54,2));
			}
			$("#hsizefit").val(hsfit); $("p.et-tsize").text(typ);
       }
    });
}
function IsFloat(str){return /^((\d+(\.\d*)?)|((\d*\.)?\d+))$/.test(str);}