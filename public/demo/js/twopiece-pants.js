var retpantfrontsrc=[];
var retpantbacksrc=[];
var fcanvaspant = new fabric.StaticCanvas('frontcanvas2');
var bcanvaspant = new fabric.StaticCanvas('backcanvas2');

/* Main Preview Section*/
function viewMainBackPant(str){ document.getElementById("main-front-"+str).style.display="none"; document.getElementById("main-back-"+str).style.display="block";}
function viewMainFrontPant(str){ document.getElementById("main-front-"+str).style.display="block"; document.getElementById("main-back-"+str).style.display="none";}
///* Tab */
function getTabPantSect(str){
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

	$("#container_pants div[id^='menu-opt']").css("display","none"); 
	$("#container_pants #"+idopt).css("display","block");
	
	if(otitle=="etfabricpant"){
		$("#container_pants #menuopttitle-"+otitle).html("Choose Your Fabric : ");
	} else {
		if(ttle=="48"){
			$("#container_pants #menuopttitle-"+otitle).html("Choose Your Pant Style :");
		} else if(ttle=="54"){
			$("#container_pants #menuopttitle-"+otitle).html("Choose Your Contrast Fabric :");
		}
	}
	
	$("#container_pants div[id^='miniview-']").css("display","none"); 
	$("#container_pants #miniview-"+otitle+"-"+ttle).css("display","block"); 
	viewMainFrontPant(otitle);
}
///* Page Option Functions */
function getPgPantOption(str,tabstr,attrid,attrnm){ 
	$("#container_pants .pt-box-square").removeClass("active"); 
	$("#container_pants #"+str).addClass("active"); 
	var optstr=str.replace("menu-","menu-opt-"); 
	var ttle=$.trim(attrnm); 
	$("#container_pants div[id^='menu-opt']").css("display","none"); 
	$("#container_pants #"+optstr).css("display","block");
	
	if(tabstr=="etfabricpant"){
		$("#container_pants #menuopttitle-"+tabstr).html("Choose Your Fabric : ");
	} else {
		if(attrid=="48"){
			$("#container_pants #menuopttitle-"+tabstr).html("Choose Your Pant Style :");
		} else if(attrid=="49"){
			$("#container_pants #menuopttitle-"+tabstr).html("Choose Your Pant Pleat Style :");
		} else if(attrid=="50"){
			$("#container_pants #menuopttitle-"+tabstr).html("Choose Your Pant Pocket Style :");
		} else if(attrid=="51"){
			$("#container_pants #menuopttitle-"+tabstr).html("Choose Your Back Pocket Style :");
		} else if(attrid=="52"){
			$("#container_pants #menuopttitle-"+tabstr).html("Choose Your Pant Belt Loop Style :");
		} else if(attrid=="53"){
			$("#container_pants #menuopttitle-"+tabstr).html("Choose Your Pant Cuff Style :");
		} else if(attrid=="54"){
			$("#container_pants #menuopttitle-"+tabstr).html("Choose Your Contrast Fabrics :");
		} else if(attrid=="55"){
			$("#container_pants #menuopttitle-"+tabstr).html("Choose Your Button Color :");
		}
	}

	$("#container_pants div[id^='miniview-']").css("display","none"); 
	$("#container_pants #miniview-"+tabstr+"-"+attrid).css("display","block");
	
	if(attrid=="51"){
		viewMainBackPant(tabstr);
	} else {
		viewMainFrontPant(tabstr);
	}
}

/* ---------------------------------------------------------------------------------------------- */
function backdesignPantProcess(jArray){
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
	
	$.each(backArr,function(key,value){if(value!=""){retpantbacksrc.push(backArr[key]);}}); bcanvaspant.clear(); backPantProcessing();
}
function backPantProcessing(){
	var cdata = ""; var _src = retpantbacksrc.pop();
	fabric.Image.fromURL(_src, function(oImg) {
		bcanvaspant.add(oImg); cdata=bcanvaspant.toDataURL();
		if (retpantbacksrc.length > 0) { setTimeout(backPantProcessing, 40); } else {
		$("div [id^='main-back-']").find("div.pt-pantimage-div img").attr("src",cdata);
		$("#miniview-etstylepant-51").css("background-image","url("+cdata+")");
		$("#miniview-etcontrastpant-54").css("background-image","url("+cdata+")");
		}
	});
}
function frontdesignPantProcess(jArray){
	var frontArr = {};var imgNone = '';var fabimg = jArray['ofabric']+".png";var fabcontrastimg = jArray['ocontrast']+".png";var dbutton = jArray['obutton']+".png";var dthread = jArray['obuttonHole']+".png";var frontmain="";var cuffimg="";var cuffbtn="";var beltloops="";var beltloopbtn="";var pleatimg="";var pockets="";var waistband="";var waistbtn="";
	
	if(jArray['ostyle']=="99"){
		frontmain=url+"/Pants/Style/Style/NormalStraight/Front/"+fabimg; 
		if(jArray['ocuff']=="126"){cuffimg=url+"/Pants/Style/Cuffs/NormalStraight/Cuff/Front/"+fabimg;} else if(jArray['ocuff']=="127"){cuffimg=url+"/Pants/Style/Cuffs/NormalStraight/SingleTabs/Front/"+fabimg;cuffbtn=url+"/Pants/Style/Cuffs/SingleTabs/Button/MainImg/"+dbutton;} else if(jArray['ocuff']=="128"){cuffimg=url+"/Pants/Style/Cuffs/NormalStraight/DoubleTabs/Front/"+fabimg;cuffbtn=url+"/Pants/Style/Cuffs/DoubleTabs/Button/MainImg/"+dbutton;} else if(jArray['ocuff']=="129"){cuffimg=url+"/Pants/Style/Cuffs/NormalStraight/FoldoverTabs/Front/"+fabimg;cuffbtn=url+"/Pants/Style/Cuffs/FoldoverTabs/Button/MainImg/"+dbutton;} 
	} else if(jArray['ostyle']=="100"){
		frontmain=url+"/Pants/Style/Style/NarrowSlim/Front/"+fabimg; 
		if(jArray['ocuff']=="126"){cuffimg=url+"/Pants/Style/Cuffs/NarrowSlim/Cuff/Front/"+fabimg;} else if(jArray['ocuff']=="127"){cuffimg=url+"/Pants/Style/Cuffs/NarrowSlim/SingleTabs/Front/"+fabimg;cuffbtn=url+"/Pants/Style/Cuffs/SingleTabs/Button/MainImg/"+dbutton;} else if(jArray['ocuff']=="128"){cuffimg=url+"/Pants/Style/Cuffs/NarrowSlim/DoubleTabs/Front/"+fabimg;cuffbtn=url+"/Pants/Style/Cuffs/DoubleTabs/Button/MainImg/"+dbutton;} else if(jArray['ocuff']=="129"){cuffimg=url+"/Pants/Style/Cuffs/NarrowSlim/FoldoverTabs/Front/"+fabimg;cuffbtn=url+"/Pants/Style/Cuffs/FoldoverTabs/Button/MainImg/"+dbutton;} 
	} else if(jArray['ostyle']=="101"){
		frontmain=url+"/Pants/Style/Style/BootFlare/Front/"+fabimg; 
		if(jArray['ocuff']=="126"){cuffimg=url+"/Pants/Style/Cuffs/BootFlare/Cuff/Front/"+fabimg;} else if(jArray['ocuff']=="127"){cuffimg=url+"/Pants/Style/Cuffs/BootFlare/SingleTabs/Front/"+fabimg;cuffbtn=url+"/Pants/Style/Cuffs/SingleTabs/Button/MainImg/"+dbutton;} else if(jArray['ocuff']=="128"){cuffimg=url+"/Pants/Style/Cuffs/BootFlare/DoubleTabs/Front/"+fabimg;cuffbtn=url+"/Pants/Style/Cuffs/DoubleTabs/Button/MainImg/"+dbutton;} else if(jArray['ocuff']=="129"){cuffimg=url+"/Pants/Style/Cuffs/BootFlare/FoldoverTabs/Front/"+fabimg;cuffbtn=url+"/Pants/Style/Cuffs/FoldoverTabs/Button/MainImg/"+dbutton;} 
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
	if(jArray['opleat']=="103"){
		pleatimg=url+"/Pants/Style/Pleat/SinglePleat/Front/"+fabimg;
	} else if(jArray['opleat']=="104"){
		pleatimg=url+"/Pants/Style/Pleat/DoublePleats/Front/"+fabimg;
	} else if(jArray['opleat']=="105"){
		pleatimg=url+"/Pants/Style/Pleat/TriplePleats/Front/"+fabimg;
	} else if(jArray['opleat']=="106"){
		pleatimg=url+"/Pants/Style/Pleat/ScissorPleats/Front/"+fabimg;
	} else if(jArray['opleat']=="107"){
		pleatimg=url+"/Pants/Style/Pleat/BoxPleats/Front/"+fabimg;
	}
	/*POCKETS*/
	if(jArray['opacket']=="109"){pockets=url+"/Pants/Style/PantPocket/Slanted/Front/"+fabimg;} else if(jArray['opacket']=="110"){pockets=url+"/Pants/Style/PantPocket/SlantedWelt/Front/"+fabimg;} else if(jArray['opacket']=="111"){pockets=url+"/Pants/Style/PantPocket/StraightWelt/Front/"+fabimg;} else if(jArray['opacket']=="112" && jArray['opleat']=="102"){pockets=url+"/Pants/Style/PantPocket/ModernCurved/Front/"+fabimg;} else if(jArray['opacket']=="113" && jArray['opleat']=="102"){pockets=url+"/Pants/Style/PantPocket/Jeans/Front/"+fabimg;}
	/*WAIST BAND*/
	if(jArray['owaistbandedge']=="normal"){waistband=url+"/Pants/Fabric/Front/"+fabimg;} else if(jArray['owaistbandedge']=="round"){waistband=url+"/Pants/Fabric/Back/"+fabimg;waistbtn=url+"/Pants/Style/BeltLoops/NoBeltLoop/Button/MainImg/"+dbutton;} else if(jArray['owaistbandedge']=="square"){waistband=url+"/Pants/Fabric/InsideView/"+fabimg;waistbtn=url+"/Pants/Style/BeltLoops/NoBeltLoop/Button/MainImg/"+dbutton;}

	var frontsrcs = {
		beltloopbtn: beltloopbtn,
		beltloops: beltloops,
		cuffbuttn: cuffbtn,
		cuffs: cuffimg,
		waistbtn: waistbtn,
		waistband: waistband,
		pockets: pockets,
		pleat: pleatimg,
		front: frontmain, 
	};
	
	$.each(frontsrcs,function(key,value){ if(value!=""){retpantfrontsrc.push(frontsrcs[key]);} }); fcanvaspant.clear(); frontPantProcessing();
}
function frontPantProcessing(){
	var cdata = ""; var _src = retpantfrontsrc.pop();
	fabric.Image.fromURL(_src, function(oImg) {
		fcanvaspant.add(oImg); cdata=fcanvaspant.toDataURL();
		if (retpantfrontsrc.length > 0) { 
			setTimeout(frontPantProcessing, 40); 
		} else {
			$("div [id^='main-front-']").find("div.pt-pantimage-div img").attr("src",cdata);
			$("#miniview-etstylepant-48").find("figure img").attr("src",cdata);
			$("#miniview-etstylepant-49").css("background-image","url("+cdata+")");
			$("#miniview-etstylepant-50").css("background-image","url("+cdata+")");
			$("#miniview-etstylepant-52").css("background-image","url("+cdata+")");
			$("#miniview-etcontrastpant-55").css("background-image","url("+cdata+")");
		}
	});
}
/* ----------------------------------Option Selection Functions---------------------------------- */
function getpantfab(id,otab){	
    var arr = document.getElementById("harrPant").value;
	arr=JSON.parse(arr);
    $.ajax({
       	type:'POST',
       	url:'/getfabricspant2',
       	data:{fabid : id, carr : arr, rurl : url, t : otab},
       	async: false,
	   	beforeSend: function() { 
	   		// $("#container_pants .et-small-loader").show(); 
	   	},
       	headers: {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       	success:function(data){		   
		   	//console.log(data);
		   	$('#preview-etfabricpant').html(data[1]);
			var stid="menu-fabric"+data[3];
			var stab=data[2]; 
			var newarr=data[4];
			var uparr=JSON.stringify(data[4]);
			$('#tabPantActiveId').val(data[2]);
			$('#tabPantSActiveId').val('fabric'+data[3]);
			$('#harrPant').val(uparr);
			$("#container_pants #fullstyle").html(data[5])
			$("#container_pants li[id^='optionlist-fabric']").find('div.icon-check').remove();
			$("#container_pants #optionlist-fabric"+data[3]+"-"+id).append('<div class="icon-check"></div>');
			getTabPantSect(data[2]); 
			getPgPantOption(stid,stab,"fabric"+data[3],'');
			frontdesignPantProcess(newarr); 
			backdesignPantProcess(newarr); 
			changePantSizeDetails();
			updatepantfabprice();
			// setTimeout($("#container_pants .et-small-loader").fadeOut(),50);
       	}
    });
}
function getpantstyles(id,ctyp,otab){
    var arr = document.getElementById("harrPant").value;
	arr=JSON.parse(arr);
    $.ajax({
       	type:'POST',
       	url:'/getstylepant2',
       	data:{fabid : id, carr : arr, typ : ctyp, rurl : url, t : otab},
	   	beforeSend: function() { $("#container_pants .et-small-loader").show(); },
       	headers: {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){
			//console.log(data);
			$('#miniview-etstylepant-'+data[3]).html(data[1]);
			$("#menu-opt-50").html(data[5])
			var stid="menu-"+data[3];
			var stab=data[2]; 
			var newarr=data[4];
			var uparr=JSON.stringify(data[4]);
			$('#tabPantActiveId').val(data[2]);
			$('#tabPantSActiveId').val(data[3]);
			$('#harrPant').val(uparr);
			$("#container_pants li[id^='optionlist-"+data[3]+"']").find('div.icon-check').remove();
			$("#container_pants #optionlist-"+data[3]+"-"+id).append('<div class="icon-check"></div>');
			getTabPantSect(data[2]); 
			getPgPantOption(stid,stab,data[3],'');
			frontdesignPantProcess(newarr); 
			backdesignPantProcess(newarr);
			setTimeout($("#container_pants .et-small-loader").fadeOut(),50);
	   }
    });
}
function getpantcontrast(id,otab){
    var arr = document.getElementById("harrPant").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       url:'/getpantcontrasts',
       data:{fabid : id, carr : arr, typ : '54', rurl : url, t : otab},
	   beforeSend: function() { $("#container_pants .et-small-loader").show(); },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){		    
			var stid="menu-"+data[3];
			var stab=data[2]; 
			var newarr=data[4];
			var uparr=JSON.stringify(data[4]);
			$('#tabPantActiveId').val(data[2]);
			$('#tabPantSActiveId').val(data[3]);
			$('#harrPant').val(uparr);
			$("#container_pants li[id^='optionlist-"+data[3]+"']").find('div.icon-check').remove();
			$("#container_pants #optionlist-"+data[3]+"-"+id).append('<div class="icon-check"></div>');
			getTabPantSect(data[2]); 
			getPgPantOption(stid,stab,data[3],'');
			frontdesignPantProcess(newarr); 
			backdesignPantProcess(newarr); 
			setTimeout($("#container_pants .et-small-loader").fadeOut(),50);
		}
    });
}
function getpantbuttons(id,otab){
    var arr = document.getElementById("harrPant").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       url:'/getpantbutton',
       data:{fabid : id, carr : arr, typ : '55', rurl : url, t : otab},
	   beforeSend: function() { $("#container_pants .et-small-loader").show(); },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){	
	   		$('#miniview-etcontrastpant-'+data[3]).html(data[1]);	    
			var stid="menu-"+data[3];
			var stab=data[2]; 
			var newarr=data[4];
			var uparr=JSON.stringify(data[4]);
			$('#tabPantActiveId').val(data[2]);
			$('#tabPantSActiveId').val(data[3]);
			$('#harrPant').val(uparr);
			$("#container_pants li[id^='optionlist-"+data[3]+"']").find('div.icon-check').remove();
			$("#container_pants #optionlist-"+data[3]+"-"+id).append('<div class="icon-check"></div>');
			getTabPantSect(data[2]); 
			getPgPantOption(stid,stab,data[3],'');
			frontdesignPantProcess(newarr); 
			backdesignPantProcess(newarr); 
			setTimeout($("#container_pants .et-small-loader").fadeOut(),50);
       }
    });
}
function getpantthread(id,otab){
    var arr = document.getElementById("harrPant").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       url:'/getpantthreads',
       data:{fabid : id, carr : arr, typ : '55', rurl : url, t : otab},
	   beforeSend: function() { $("#container_pants .et-small-loader").show();},
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){	
	   		$('#miniview-etcontrastpant-'+data[3]).html(data[1]);	    
		   	var stid="menu-"+data[3];
			var stab=data[2]; 
			var newarr=data[4];
			var uparr=JSON.stringify(data[4]);
			$('#tabPantActiveId').val(data[2]);
			$('#tabPantSActiveId').val(data[3]);
			$('#harrPant').val(uparr);
			$("#container_pants li[id^='optionlist-thrd']").find('div.icon-check').remove();
			$("#container_pants #optionlist-thrd-"+id).append('<div class="icon-check"></div>');
			getTabPantSect(data[2]); 
			getPgPantOption(stid,stab,data[3],'');
			frontdesignPantProcess(newarr); 
			backdesignPantProcess(newarr); 
			setTimeout($("#container_pants .et-small-loader").fadeOut(),50);
       }
    });
}
function getpantseloptions(id,opt,ctyp,otab){
    var arr = document.getElementById("harrPant").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       url:'/getsetoptionspant2',
       data:{fabid : id, carr : arr, opttyp : opt, typ : ctyp, rurl : url, t : otab},
	   beforeSend: function() { $("#container_pants .et-small-loader").show(); },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){		    
		   $('#miniview-'+data[2]+'-'+data[3]).html(data[1]);	    
			var stid="menu-"+data[3];
			var stab=data[2]; 
			var newarr=data[4];
			var uparr=JSON.stringify(data[4]);
			$('#tabPantActiveId').val(data[2]);
			$('#tabPantSActiveId').val(data[3]);
			$('#harrPant').val(uparr);
			getTabPantSect(data[2]); 
			getPgPantOption(stid,stab,data[3],'');
			frontdesignPantProcess(newarr); 
			backdesignPantProcess(newarr); 
			setTimeout($("#container_pants .et-small-loader").fadeOut(),50);
       }
    });
}
function showPantMeasureSect(id){
	$("div[id^='menu-mesure-pant-']").css("display","none"); 
	$("#menu-mesure-pant-"+id).css("display","block");
	$("#etmeasurementpant").find("div.pt-variation div.pt-box-square").removeClass("active");
	if(id=="bodysize" || id=="standardsize"){
		$("#menu-pant-"+id).addClass("active");
		if(id=="bodysize"){ 
			$("#container_pants input#bsizeWaist").focus(); 
			var rrv=$("#container_pants input#bsizeWaist").attr("data-title"); 
			rrv=rrv.split('-'); 
			$("#container_pants span#fldtitle").html("Waist"); 
			$("#container_pants span#rngfrom").html(rrv[0]); 
			$("#container_pants span#rngto").html(rrv[1]);
			$("#container_pants div.et-measure-image").find("figure img").attr("src",url+"/Measurment/Shirts/pwaist/waist.jpg");
			$("#container_pants div.et-measure-video").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/pwaist/waist.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/pwaist/waist.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/pwaist/waist.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/pwaist/waist.webm" type="video/webm"></video>');
			
			var fview=$("#main-front-etmeasurementpant").find("div.pt-pantimage-div img").attr("src");
			var bview=$("#main-back-etmeasurementpant").find("div.pt-pantimage-div img").attr("src"); 
			$("#container_pants input#frntviewfinal").val(fview); 
			$("#container_pants input#bkviewfinal").val(bview); 
			var arr = document.getElementById("harrPant").value; 
			$("#container_pants input#setarr").val(arr);
		} else if(id=="standardsize"){
			var fview=$("#main-front-etmeasurementpant").find("div.pt-pantimage-div img").attr("src"); 
			var bview=$("#main-back-etmeasurementpant").find("div.pt-pantimage-div img").attr("src"); 
			$("#container_pants input#frntviewfinal").val(fview); 
			$("#container_pants input#bkviewfinal").val(bview); 
			var arr = document.getElementById("harrPant").value; 
			$("#container_pants input#setarr").val(arr);
		}
	}
}

function showPantRanges(ttl,frange,trange,typ){
	var sizetyp=$("#container_pants input[id^='bsizetyp']:checked").attr("value");
	if(sizetyp=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
	if(typ=="waist"){
		var msrimg=url+"/Measurment/Shirts/pwaist/"+typ+".jpg";
		$("#container_pants div.et-measure-image").find("figure img").attr("src",msrimg);
		$("#container_pants div.et-measure-video").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/pwaist/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/pwaist/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/pwaist/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/pwaist/'+typ+'.webm" type="video/webm"></video>');
	}else if(typ=="hip"){
		var msrimg=url+"/Measurment/Shirts/phip/"+typ+".jpg";
		$("#container_pants div.et-measure-image").find("figure img").attr("src",msrimg);
		$("#container_pants div.et-measure-video").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/phip/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/phip/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/phip/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/phip/'+typ+'.webm" type="video/webm"></video>');
	}else if(typ=="length"){
		var msrimg=url+"/Measurment/Shirts/plength/"+typ+".jpg";
		$("#container_pants div.et-measure-image").find("figure img").attr("src",msrimg);
		$("#container_pants div.et-measure-video").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/plength/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/plength/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/plength/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/plength/'+typ+'.webm" type="video/webm"></video>');
	} else {
		var msrimg=url+"/Measurment/Shirts/"+typ+"/"+typ+".jpg";
		$("#container_pants div.et-measure-image").find("figure img").attr("src",msrimg);
		$("#container_pants div.et-measure-video").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.webm" type="video/webm"></video>');
	}
	$("#container_pants span#fldtitle").html(ttl); 
	$("#container_pants span#rngfrom").html(frange); 
	$("#container_pants span#rngto").html(trange); 
	$("#container_pants span#mtyp").html(sizetyp);
}

function validatePantField(fid,frange,trange){
	var sizetyp=$("#container_pants input[id^='bsizetyp']:checked").attr("value"); 
	var fval=$("#"+fid).val();
	if(sizetyp=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
	
	if(fval==""){ 
		$("#container_pants #"+fid).css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'}); 
	} else if(fval<frange || fval>trange){ 
		$("#container_pants #"+fid).css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'}); 
	} else { 
		$("#container_pants #"+fid).css({'border-color':'#090','box-shadow':'0px 0px 15px #090'}); 
	}
}

function validatepantbodyform(){
	var typ=$("#container_jackets input[id^='bsizetyp']:checked").attr("value"); 
	var rnge="";
	
	if($('#temp_pant_bsizeWaist').val()==""){ 
		$('#temp_pant_bsizeWaist').focus(); 
		return false;
	} else if($('#temp_pant_bsizeWaist').val()!=""){
		rnge=$('#temp_pant_bsizeWaist').attr("data-title").split('-'); 
		frange=parseFloat(rnge[0]); 
		trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat($('#temp_pant_bsizeWaist').val())==false){
			$('#temp_pant_bsizeWaist').css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			$('#temp_pant_bsizeWaist').focus(); return false;
		} else if(parseFloat($('#temp_pant_bsizeWaist').val()) < parseFloat(frange) 
			|| parseFloat($('#temp_pant_bsizeWaist').val()) > parseFloat(trange)){
			$('#temp_pant_bsizeWaist').css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			$('#temp_pant_bsizeWaist').focus(); return false;
		}
	}
	
	if($('#temp_pant_bsizeHip').val()==""){ 
		$('#temp_pant_bsizeHip').focus(); return false;
	} else if($('#temp_pant_bsizeHip').val()!=""){
		rnge=$('#temp_pant_bsizeHip').attr("data-title").split('-'); 
		frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat($('#temp_pant_bsizeHip').val())==false){
			$('#temp_pant_bsizeHip').css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			$('#temp_pant_bsizeHip').focus(); return false;
		} else if(parseFloat($('#temp_pant_bsizeHip').val()) < parseFloat(frange) || parseFloat($('#temp_pant_bsizeHip').val()) > parseFloat(trange)){
			$('#temp_pant_bsizeHip').css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			$('#temp_pant_bsizeHip').focus(); return false;
		}
	}

	if($('#temp_pant_bsizeCrotch').val()==""){ $('#temp_pant_bsizeCrotch').focus(); return false;
	} else if($('#temp_pant_bsizeCrotch').val()!=""){
		rnge=$('#temp_pant_bsizeCrotch').attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat($('#temp_pant_bsizeCrotch').val())==false){
			$('#temp_pant_bsizeCrotch').css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			$('#temp_pant_bsizeCrotch').focus(); return false;
			$('#temp_pant_bsizeCrotch').css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
		} else if(parseFloat($('#temp_pant_bsizeCrotch').val()) < parseFloat(frange) || parseFloat($('#temp_pant_bsizeCrotch').val()) > parseFloat(trange)){
			$('#temp_pant_bsizeCrotch').focus(); return false;
		}
	}

	if($('#temp_pant_bsizeLength').val()==""){ $('#temp_pant_bsizeLength').focus(); return false;
	} else if($('#temp_pant_bsizeLength').val()!=""){
		rnge=$('#temp_pant_bsizeLength').attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat($('#temp_pant_bsizeLength').val())==false){
			$('#temp_pant_bsizeLength').css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			$('#temp_pant_bsizeLength').focus();
			return false;
		}
	}

	if($('#temp_pant_bsizeThigh').val()==""){ $('#temp_pant_bsizeThigh').focus(); return false;
	} else if($('#temp_pant_bsizeThigh').val()!=""){
		rnge=$('#temp_pant_bsizeThigh').attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat($('#temp_pant_bsizeThigh').val())==false){
			$('#temp_pant_bsizeThigh').css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			$('#temp_pant_bsizeThigh').focus(); return false;
		} else if(parseFloat($('#temp_pant_bsizeThigh').val()) < parseFloat(frange) || parseFloat($('#temp_pant_bsizeThigh').val()) > parseFloat(trange)){
			$('#temp_pant_bsizeThigh').css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			$('#temp_pant_bsizeThigh').focus(); return false;
		}
	}
	return validatebodyform();
	// return true;
}
function changePantCntrySize(vl){
	$.ajax({
       	type:'POST',
       	// url:'/measurpants',
       	url:'/measurpants2',
       	data:{sizeid : vl},
       	headers: {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       	success:function(data){		
			$("#container_pants #divsizefit").html(data); 
			changePantSizeDetails(); 
       	}
    });
}
function changePantSizeDetails(){
	var cid=$("#container_jackets #cntrysize").val(); 
	var sid=$("#container_jackets #sizefit").val(); 
	var typ=$("#container_jackets input[id='sizetyp']:checked").val(); 
	var hsfit=$("#container_jackets #sizefit option:selected").text();
	$.ajax({
       	type:'POST',
       	url:'/measurpantid2',
       	async: false,
       	data:{sizeid : sid, cntryid : cid},
       	headers: {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       	success:function(data){
       		sid = data;
       	}
    });
	$.ajax({
       	type:'POST',
       	url:'/measurpantsdtls2',
       	async: false,
       	data:{sizeid : sid, cntryid : cid},
       	headers: {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       	success:function(data){
			data=data.split('/');
			if(typ=="inch"){ 
				$("#container_pants #vwaist").html(data[0]); 
				$("#container_pants #sizewaist").val(data[0]); 
				$("#container_pants #vhip").html(data[1]); 
				$("#container_pants #sizehip").val(data[1]); 
				$("#container_pants #vcrotch").html(data[2]); 
				$("#container_pants #sizecrotch").val(data[2]); 
				$("#container_pants #vthigh").html(data[3]); 
				$("#container_pants #sizethigh").val(data[3]); 
				$("#container_pants #sizelength").val(data[4]);

				$("#temp_vwaist").html(data[0]); 
				$("#temp_sizewaist").val(data[0]); 
				$("#temp_vhip").html(data[1]); 
				$("#temp_sizehip").val(data[1]); 
				$("#temp_vcrotch").html(data[2]); 
				$("#temp_sizecrotch").val(data[2]); 
				$("#temp_vthigh").html(data[3]); 
				$("#temp_sizethigh").val(data[3]); 
				$("#temp_sizelength").val(data[4]);
			} else if(typ=="cm"){ 
				$("#container_pants #vwaist").html(Math.round(data[0]*2.54,2)); 
				$("#container_pants #sizewaist").val(Math.round(data[0]*2.54,2)); 
				$("#container_pants #vhip").html(Math.round(data[1]*2.54,2)); 
				$("#container_pants #sizehip").val(Math.round(data[1]*2.54,2)); 
				$("#container_pants #vcrotch").html(Math.round(data[2]*2.54,2)); 
				$("#container_pants #sizecrotch").val(Math.round(data[2]*2.54,2)); 
				$("#container_pants #vthigh").html(Math.round(data[3]*2.54,2)); 
				$("#container_pants #sizethigh").val(Math.round(data[3]*2.54,2)); 
				$("#container_pants #sizelength").val(Math.round(data[4]*2.54,2));

				$("#temp_vwaist").html(Math.round(data[0]*2.54,2)); 
				$("#temp_sizewaist").val(Math.round(data[0]*2.54,2)); 
				$("#temp_vhip").html(Math.round(data[1]*2.54,2)); 
				$("#temp_sizehip").val(Math.round(data[1]*2.54,2)); 
				$("#temp_vcrotch").html(Math.round(data[2]*2.54,2)); 
				$("#temp_sizecrotch").val(Math.round(data[2]*2.54,2)); 
				$("#temp_vthigh").html(Math.round(data[3]*2.54,2)); 
				$("#temp_sizethigh").val(Math.round(data[3]*2.54,2)); 
				$("#temp_sizelength").val(Math.round(data[4]*2.54,2));
			}
			$("#container_pants #hsizefit").val(hsfit); 
			$("#container_pants p.et-tsize").text(typ);
       }
    });
}
// function IsFloat(str){return /^((\d+(\.\d*)?)|((\d*\.)?\d+))$/.test(str);}

function navigatepantback(){
	var activesubtab=$(".mcd-sub-menu li a.active");
	var activesubtab_id = activesubtab.attr("id");
	var stab=$.trim(activesubtab_id.replace('sub_menu_',''));

	var main_tab = $(".mcd-menu li a.active");
	var main_tab_id = $(".mcd-menu li a.active").attr("id");
	var main_nav_str = main_tab_id.replace('main_menu_','');

	if(main_nav_str=="etfabric"){
	} else if(main_nav_str=="etstyle"){
		switch(stab){
			case "48":
				showStyleByImg('jacket');
				var next_sub_menu = document.getElementById("sub_menu_24");
				openPgContent(next_sub_menu,'menu-24','etstylejacket','24','','style');
				break;
			case "49":
				var next_sub_menu = document.getElementById("sub_menu_48");
				openPgContent(next_sub_menu,'menu-48','etstylepant','48','','style');
				break;
			case "50":
				var next_sub_menu = document.getElementById("sub_menu_49");
				openPgContent(next_sub_menu,'menu-49','etstylepant','49','','style');
				break;
			case "51":
				var next_sub_menu = document.getElementById("sub_menu_50");
				openPgContent(next_sub_menu,'menu-50','etstylepant','50','','style');
				break;
			case "52":
				var next_sub_menu = document.getElementById("sub_menu_51");
				openPgContent(next_sub_menu,'menu-51','etstylepant','51','','style');
				break;
			case "53":
				var next_sub_menu = document.getElementById("sub_menu_52");
				openPgContent(next_sub_menu,'menu-52','etstylepant','52','','style');  
				break;
		}
	} else if(main_nav_str=="etcontrast"){
		switch(stab){
			case "54":
				var next_sub_menu = document.getElementById("sub_menu_25");
				openPgContent(next_sub_menu,'menu-25','etcontrastjacket','25','','contrast');
				break;
		}
	}
}
function navigatepantnext(){
	var activesubtab=$(".mcd-sub-menu li a.active");
	var activesubtab_id = activesubtab.attr("id");
	var stab=$.trim(activesubtab_id.replace('sub_menu_',''));

	var main_tab = $(".mcd-menu li a.active");
	var main_tab_id = $(".mcd-menu li a.active").attr("id");
	var main_nav_str = main_tab_id.replace('main_menu_','');

	if(main_nav_str=="etfabric"){
		
	} else if(main_nav_str=="etstyle"){
		switch(stab){
			case "48":
				var next_sub_menu = document.getElementById("sub_menu_49");
				openPgContent(next_sub_menu,'menu-49','etstylepant','49','','style'); 
				break;
			case "49":
				var next_sub_menu = document.getElementById("sub_menu_50");
				openPgContent(next_sub_menu,'menu-50','etstylepant','50','','style');  
				break;
			case "50":
				var next_sub_menu = document.getElementById("sub_menu_51");
				openPgContent(next_sub_menu,'menu-51','etstylepant','51','','style'); 
				break;
			case "51":
				var next_sub_menu = document.getElementById("sub_menu_52");
				openPgContent(next_sub_menu,'menu-52','etstylepant','52','','style');  
				break;
			case "52":
				var next_sub_menu = document.getElementById("sub_menu_53");
				openPgContent(next_sub_menu,'menu-53','etstylepant','53','','style'); 
				break;
			case "53":
				var next_main_menu = document.getElementById("main_menu_etcontrast");
				openNav(next_main_menu,'etcontrast');
				break;
		}
	} else if(main_nav_str=="etcontrast"){
		switch(stab){
			case "54":
				// var next_sub_menu = document.getElementById("sub_menu_40");
				// openPgContent(next_sub_menu,'menu-40','etcontrast','40','','contrast');
				var next_sub_menu = document.getElementById("sub_menu_26");
				openPgContent(next_sub_menu,'menu-26','etcontrastjacket','26','','contrast');
				break;
		}
	}	
}

function updatepantfabprice(){
	var arr = document.getElementById("harrPant").value; arr=JSON.parse(arr); var fabprice=arr['ofabricPrice'];
	fabprice=parseFloat(fabprice);
	$("#container_pants .pt-dollor").html("$ "+fabprice);
	$("#container_pants .vwprice").html("1 Pant: $ "+fabprice);
}