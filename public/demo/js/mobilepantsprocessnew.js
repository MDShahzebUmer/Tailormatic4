var retfrontsrc=[];var retbacksrc=[];var fcanvas = new fabric.StaticCanvas('frontcanvas');var bcanvas = new fabric.StaticCanvas('backcanvas');

/* Main Preview Section*/
function viewMainBack(str){ 
	document.getElementById("main-front").style.display="none"; 
	document.getElementById("main-back").style.display="block";}
function viewMainFront(str){ 
	document.getElementById("main-front").style.display="block"; 
	document.getElementById("main-back").style.display="none";
}
///* Tab */
function getTabSect(str){
	$('#tab-content').show();
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
		if (retbacksrc.length > 0) { setTimeout(backProcessing, 40); } else {
		$("div [id^='main-back']").find("div.pt-image-div img").attr("src",cdata);
		$("#miniview-etstyle-51").css("background-image","url("+cdata+")");
		$("#miniview-etcontrast-54").css("background-image","url("+cdata+")");
		}
	});
}
function frontdesignProcess(jArray){
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
		if (retfrontsrc.length > 0) { setTimeout(frontProcessing, 40); } else {
		$("div [id^='main-front']").find("div.pt-image-div img").attr("src",cdata);
		$("#miniview-etstyle-48").find("figure img").attr("src",cdata);
		$("#miniview-etstyle-49").css("background-image","url("+cdata+")");
		$("#miniview-etstyle-50").css("background-image","url("+cdata+")");
		$("#miniview-etstyle-52").css("background-image","url("+cdata+")");
		$("#miniview-etcontrast-55").css("background-image","url("+cdata+")");
		}
	});
}
/* ----------------------------------Option Selection Functions---------------------------------- */
function getfab(id,otab){	
    var arr = document.getElementById("harr").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       url:'/getpantfabrics',
       data:{fabid : id, carr : arr, rurl : url, t : otab},
	   beforeSend: function() { $(".et-small-loader").show(); },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){		   
		   	//console.log(data);
		   	$('#preview-etfabric').html(data[1]);
			var stid="menu-fabric"+data[3];
			var stab=data[2]; 
			var newarr=data[4];
			var uparr=JSON.stringify(data[4]);
			$('#tabActiveId').val(data[2]);
			$('#tabSActiveId').val('fabric'+data[3]);
			$('#harr').val(uparr);
			$("#fullstyle").html(data[5])
			$("li[id^='optionlist-fabric']").find('div.icon-check').remove();
			$("#optionlist-fabric"+data[3]+"-"+id).append('<div class="icon-check"></div>');
			getTabSect(data[2]); 
			getPgOption(stid,stab,"fabric"+data[3],'');
			frontdesignProcess(newarr); 
			backdesignProcess(newarr); 
			changeSizeDetails();
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
       url:'/getpantstyle',
       data:{fabid : id, carr : arr, typ : ctyp, rurl : url, t : otab},
	   beforeSend: function() { $(".et-small-loader").show(); },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){
			//console.log(data);
			$('#miniview-etstyle-'+data[3]).html(data[1]);
			$("#menu-opt-50").html(data[5])
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
			frontdesignProcess(newarr); 
			backdesignProcess(newarr);
			setTimeout($(".et-small-loader").fadeOut(),50);
	   }
    });
}
function getcontrast(id,otab){
    var arr = document.getElementById("harr").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       url:'/getpantcontrasts',
       data:{fabid : id, carr : arr, typ : '54', rurl : url, t : otab},
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
			$("li[id^='optionlist-"+data[3]+"']").find('div.icon-check').remove();
			$("#optionlist-"+data[3]+"-"+id).append('<div class="icon-check"></div>');
			getTabSect(data[2]); 
			getPgOption(stid,stab,data[3],'');
			frontdesignProcess(newarr); 
			backdesignProcess(newarr); 
			setTimeout($(".et-small-loader").fadeOut(),50);
		}
    });
}
function getbuttons(id,otab){
    var arr = document.getElementById("harr").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       url:'/getpantbutton',
       data:{fabid : id, carr : arr, typ : '55', rurl : url, t : otab},
	   beforeSend: function() { $(".et-small-loader").show(); },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){	
	   		$('#miniview-etcontrast-'+data[3]).html(data[1]);	    
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
			frontdesignProcess(newarr); 
			backdesignProcess(newarr); 
			setTimeout($(".et-small-loader").fadeOut(),50);
       }
    });
}
function getthread(id,otab){
    var arr = document.getElementById("harr").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       url:'/getpantthreads',
       data:{fabid : id, carr : arr, typ : '55', rurl : url, t : otab},
	   beforeSend: function() { $(".et-small-loader").show();},
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){	
	   		$('#miniview-etcontrast-'+data[3]).html(data[1]);	    
		   	var stid="menu-"+data[3];
			var stab=data[2]; 
			var newarr=data[4];
			var uparr=JSON.stringify(data[4]);
			$('#tabActiveId').val(data[2]);
			$('#tabSActiveId').val(data[3]);
			$('#harr').val(uparr);
			$("li[id^='optionlist-thrd']").find('div.icon-check').remove();
			$("#optionlist-thrd-"+id).append('<div class="icon-check"></div>');
			getTabSect(data[2]); 
			getPgOption(stid,stab,data[3],'');
			frontdesignProcess(newarr); 
			backdesignProcess(newarr); 
			setTimeout($(".et-small-loader").fadeOut(),50);
       }
    });
}
function getseloptions(id,opt,ctyp,otab){
    var arr = document.getElementById("harr").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       url:'/getsetpantoptions',
       data:{fabid : id, carr : arr, opttyp : opt, typ : ctyp, rurl : url, t : otab},
	   beforeSend: function() { $(".et-small-loader").show(); },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){		    
		   $('#miniview-'+data[2]+'-'+data[3]).html(data[1]);	    
			var stid="menu-"+data[3];
			var stab=data[2]; 
			var newarr=data[4];
			var uparr=JSON.stringify(data[4]);
			$('#tabActiveId').val(data[2]);
			$('#tabSActiveId').val(data[3]);
			$('#harr').val(uparr);
			getTabSect(data[2]); 
			getPgOption(stid,stab,data[3],'');
			frontdesignProcess(newarr); 
			backdesignProcess(newarr); 
			setTimeout($(".et-small-loader").fadeOut(),50);
       }
    });
}
function showMeasureSect(id){
	$("div[id^='menu-mesure-']").css("display","none"); $("#menu-mesure-"+id).css("display","block");
	$("#etmeasurement").find("div.pt-variation div.pt-box-square").removeClass("active");
	if(id=="bodysize" || id=="standardsize" || id=="outfitsize"){
		$("#menu-"+id).addClass("active");
		if(id=="bodysize"){ 
			$("input#bsizeWaist").focus(); var rrv=$("input#bsizeWaist").attr("data-title"); rrv=rrv.split('-'); $("span#fldtitle").html("Waist"); $("span#rngfrom").html(rrv[0]); $("span#rngto").html(rrv[1]);
			$("div.et-measure-image").find("figure img").attr("src",url+"/Measurment/Shirts/pwaist/waist.jpg");
			$("div.et-measure-video").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/pwaist/waist.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/pwaist/waist.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/pwaist/waist.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/pwaist/waist.webm" type="video/webm"></video>');
			
			var fview=$("#main-front").find("div.pt-image-div img").attr("src");var bview=$("#main-back").find("div.pt-image-div img").attr("src"); $("input#frntviewfinal").val(fview); $("input#bkviewfinal").val(bview); var arr = document.getElementById("harr").value; $("input#setarr").val(arr);
		} else if(id=="standardsize"){
			var fview=$("#main-front").find("div.pt-image-div img").attr("src"); var bview=$("#main-back").find("div.pt-image-div img").attr("src"); $("input#frntviewfinal").val(fview); $("input#bkviewfinal").val(bview); var arr = document.getElementById("harr").value; $("input#setarr").val(arr);
		} else if(id=="outfitsize") {
			$("input#bsizeWaist2").focus(); 
			var rrv=$("input#bsizeWaist2").attr("data-title"); 
			rrv=rrv.split('-'); 
			$("span#fldtitle2").html("Waist"); 
			$("span#rngfrom2").html(rrv[0]); 
			$("span#rngto2").html(rrv[1]);
			$("div.et-measure-image-2").find("figure img").attr("src",url+"/Measurment/Shirts/pwaist/waist.jpg");
			$("div.et-measure-video-2").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/pwaist/waist.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/pwaist/waist.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/pwaist/waist.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/pwaist/waist.webm" type="video/webm"></video>');
			
			var fview=$("#main-front").find("div.pt-image-div img").attr("src");
			var bview=$("#main-back").find("div.pt-image-div img").attr("src"); 
			$("input#frntviewfinal2").val(fview); 
			$("input#bkviewfinal2").val(bview); 
			var arr = document.getElementById("harr").value; 
			$("input#setarr2").val(arr);
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
			if(typ=="inch"){ $("#vwaist").html(data[0]); $("#sizewaist").val(data[0]); $("#vhip").html(data[1]); $("#sizehip").val(data[1]); $("#vcrotch").html(data[2]); $("#sizecrotch").val(data[2]); $("#vthigh").html(data[3]); $("#sizethigh").val(data[3]); $("#sizelength").val(data[4]);
			} else if(typ=="cm"){ $("#vwaist").html(Math.round(data[0]*2.54,2)); $("#sizewaist").val(Math.round(data[0]*2.54,2)); $("#vhip").html(Math.round(data[1]*2.54,2)); $("#sizehip").val(Math.round(data[1]*2.54,2)); $("#vcrotch").html(Math.round(data[2]*2.54,2)); $("#sizecrotch").val(Math.round(data[2]*2.54,2)); $("#vthigh").html(Math.round(data[3]*2.54,2)); $("#sizethigh").val(Math.round(data[3]*2.54,2)); $("#sizelength").val(Math.round(data[4]*2.54,2));
			}
			$("#hsizefit").val(hsfit); $("p.et-tsize").text(typ);
       }
    });
}
function IsFloat(str){return /^((\d+(\.\d*)?)|((\d*\.)?\d+))$/.test(str);}
function navigateback(){
	var activetab=$(".nav-tabs").find("li.active a").attr("href"); var activesubtab=$(activetab).find("div.pt-variation div.active").attr("id"); var tabb=$.trim(activetab.replace('#','')); var stab=$.trim(activesubtab.replace('menu-',''));

	if(tabb=="etfabric"){
		getTabSect('etfabric'); getPgOption('menu-fabric6','etfabric','fabric15','');
	} else if(tabb=="etstyle"){
		switch(stab){
			case "48":
			$("#etstyle").removeClass("active"); $(".nav-tabs li").removeClass("active"); $("a[href='#etfabric']").parent("li").addClass("active"); getTabSect('etfabric'); getPgOption('menu-fabric15','etfabric','fabric15',''); break;
			case "49":
			getTabSect('etstyle'); getPgOption('menu-48','etstyle','48',''); break;
			case "50":
			getTabSect('etstyle'); getPgOption('menu-49','etstyle','49',''); break;
			case "51":
			getTabSect('etstyle'); getPgOption('menu-50','etstyle','50',''); break;
			case "52":
			getTabSect('etstyle'); getPgOption('menu-51','etstyle','51',''); break;
			case "53":
			getTabSect('etstyle'); getPgOption('menu-52','etstyle','52',''); break;
		}
	} else if(tabb=="etcontrast"){
		switch(stab){
			case "54":
			$("#etcontrast").removeClass("active"); $(".nav-tabs li").removeClass("active"); $("a[href='#etstyle']").parent("li").addClass("active"); getTabSect('etstyle'); getPgOption('menu-53','etstyle','53',''); break;
			case "55":
			getTabSect('etcontrast'); getPgOption('menu-54','etcontrast','54',''); break;
		}
	}
}
function navigatenext(){
	var activetab=$(".nav-tabs").find("li.active a").attr("href"); var activesubtab=$(activetab).find("div.pt-variation div.active").attr("id"); var tabb=$.trim(activetab.replace('#','')); var stab=$.trim(activesubtab.replace('menu-',''));

	if(tabb=="etfabric"){
		$("#etfabric").removeClass("active"); $(".nav-tabs li").removeClass("active"); $("a[href='#etstyle']").parent("li").addClass("active"); getTabSect('etstyle'); getPgOption('menu-48','etstyle','48','');
	} else if(tabb=="etstyle"){
		switch(stab){
			case "48":
			getTabSect('etstyle'); getPgOption('menu-49','etstyle','49',''); break;
			case "49":
			getTabSect('etstyle'); getPgOption('menu-50','etstyle','50',''); break;
			case "50":
			getTabSect('etstyle'); getPgOption('menu-51','etstyle','51',''); break;
			case "51":
			getTabSect('etstyle'); getPgOption('menu-52','etstyle','52',''); break;
			case "52":
			getTabSect('etstyle'); getPgOption('menu-53','etstyle','53',''); break;
			case "53":
			$("#etstyle").removeClass("active"); $(".nav-tabs li").removeClass("active"); $("a[href='#etcontrast']").parent("li").addClass("active"); getTabSect('etcontrast'); getPgOption('menu-54','etcontrast','54',''); break;
		}
	} else if(tabb=="etcontrast"){
		switch(stab){
			case "54":
			getTabSect('etcontrast'); getPgOption('menu-55','etcontrast','55',''); break;
			case "55":
			$("#etcontrast").removeClass("active"); $(".nav-tabs li").removeClass("active"); $("a[href='#etmeasurement']").parent("li").addClass("active"); getTabSect('etmeasurement',''); getPgOption('menu-bodysize','etmeasurement','bodysize','',''); break;
		}
	}	
}
function updatefabprice(){
	var arr = document.getElementById("harr").value; arr=JSON.parse(arr); var fabprice=arr['ofabricPrice'];
	fabprice=parseFloat(fabprice);
	// $(".pt-dollor").html("$ "+fabprice);
	$(".vwprice").html("1 Pant: $ "+fabprice);
	$(".t-s-price").html("$ "+fabprice);
}
/* ============================ new added for outfit size =============================== */
function showRanges2(ttl,frange,trange,typ){
	var sizetyp=$("input[id^='bsizetyp2']:checked").attr("value");
	if(sizetyp=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
	if(typ=="waist"){
		var msrimg=url+"/Measurment/Shirts/pwaist/"+typ+".jpg";
		$("div.et-measure-image-2").find("figure img").attr("src",msrimg);
		$("div.et-measure-video-2").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/pwaist/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/pwaist/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/pwaist/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/pwaist/'+typ+'.webm" type="video/webm"></video>');
	}else if(typ=="hip"){
		var msrimg=url+"/Measurment/Shirts/phip/"+typ+".jpg";
		$("div.et-measure-image-2").find("figure img").attr("src",msrimg);
		$("div.et-measure-video-2").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/phip/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/phip/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/phip/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/phip/'+typ+'.webm" type="video/webm"></video>');
	}else if(typ=="length"){
		var msrimg=url+"/Measurment/Shirts/plength/"+typ+".jpg";
		$("div.et-measure-image-2").find("figure img").attr("src",msrimg);
		$("div.et-measure-video-2").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/plength/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/plength/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/plength/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/plength/'+typ+'.webm" type="video/webm"></video>');
	} else {
		var msrimg=url+"/Measurment/Shirts/"+typ+"/"+typ+".jpg";
		$("div.et-measure-image-2").find("figure img").attr("src",msrimg);
		$("div.et-measure-video-2").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.webm" type="video/webm"></video>');
	}
	$("span#fldtitle2").html(ttl); 
	$("span#rngfrom2").html(frange); 
	$("span#rngto2").html(trange); 
	$("span#mtyp2").html(sizetyp);
}

function validateField2(fid,frange,trange){
	var sizetyp=$("input[id^='bsizetyp2']:checked").attr("value"); var fval=$("#"+fid).val();
	if(sizetyp=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
	
	if(fval==""){ $("#"+fid).css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'}); } else if(fval<frange || fval>trange){ $("#"+fid).css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'}); } else { $("#"+fid).css({'border-color':'#090','box-shadow':'0px 0px 15px #090'}); }
}

function validatebodyform2(){
	var typ=$("input[id^='bsizetyp2']:checked").attr("value"); var rnge="";
	
	if(document.getElementById('bsizeWaist2').value==""){ document.getElementById('bsizeWaist2').focus(); return false;
	} else if(document.getElementById('bsizeWaist2').value!=""){
		rnge=$("#bsizeWaist2").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat(document.getElementById('bsizeWaist2').value)==false){
			$("#bsizeWaist2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeWaist2').focus(); return false;
		} else if(parseFloat(document.getElementById('bsizeWaist2').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeWaist2').value) > parseFloat(trange)){
			$("#bsizeWaist2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeWaist2').focus(); return false;
		}
	}
	if(document.getElementById('bsizeHip2').value==""){ document.getElementById('bsizeHip2').focus(); return false;
	} else if(document.getElementById('bsizeHip2').value!=""){
		rnge=$("#bsizeHip2").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat(document.getElementById('bsizeHip2').value)==false){
			$("#bsizeHip2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeHip2').focus(); return false;
		} else if(parseFloat(document.getElementById('bsizeHip2').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeHip2').value) > parseFloat(trange)){
			$("#bsizeHip2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeHip2').focus(); return false;
		}
	}
	if(document.getElementById('bsizeCrotch2').value==""){ document.getElementById('bsizeCrotch2').focus(); return false;
	} else if(document.getElementById('bsizeCrotch2').value!=""){
		rnge=$("#bsizeCrotch2").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat(document.getElementById('bsizeCrotch2').value)==false){
			$("#bsizeCrotch2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeCrotch2').focus(); return false;
		} else if(parseFloat(document.getElementById('bsizeCrotch2').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeCrotch2').value) > parseFloat(trange)){
			$("#bsizeCrotch2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeCrotch2').focus(); return false;
		}
	}
	if(document.getElementById('bsizeLength2').value==""){ document.getElementById('bsizeLength2').focus(); return false;
	} else if(document.getElementById('bsizeLength2').value!=""){
		rnge=$("#bsizeLength2").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat(document.getElementById('bsizeLength2').value)==false){
			$("#bsizeLength2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeLength2').focus();
			return false;
		}
	}
	if(document.getElementById('bsizeThigh2').value==""){ document.getElementById('bsizeThigh2').focus(); return false;
	} else if(document.getElementById('bsizeThigh2').value!=""){
		rnge=$("#bsizeThigh2").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat(document.getElementById('bsizeThigh2').value)==false){
			$("#bsizeThigh2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeThigh2').focus(); return false;
		} else if(parseFloat(document.getElementById('bsizeThigh2').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeThigh2').value) > parseFloat(trange)){
			$("#bsizeThigh2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeThigh2').focus(); return false;
		}
	}
	return true;
}