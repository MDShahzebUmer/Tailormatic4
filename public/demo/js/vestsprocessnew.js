var retfrontsrc=[]; var retbacksrc=[]; var retsidesrc=[]; var fcanvas = new fabric.StaticCanvas('frontcanvas'); var bcanvas = new fabric.StaticCanvas('backcanvas'); var scanvas = new fabric.StaticCanvas('sidecanvas');
//
/* Main Preview Section*/
function viewMainBack(str){if(str=="etcontrast"){document.getElementById("main-front-"+str).style.display="none"; document.getElementById("main-side-"+str).style.display="none"; document.getElementById("main-back-"+str).style.display="block"; } else {document.getElementById("main-front-"+str).style.display="none"; document.getElementById("main-back-"+str).style.display="block";}}
function viewMainFront(str){if(str=="etcontrast"){document.getElementById("main-front-"+str).style.display="block"; document.getElementById("main-side-"+str).style.display="none"; document.getElementById("main-back-"+str).style.display="none"; } else {document.getElementById("main-front-"+str).style.display="block"; document.getElementById("main-back-"+str).style.display="none";}}
function viewMainSide(str){ document.getElementById("main-side-"+str).style.display="block"; document.getElementById("main-front-"+str).style.display="none"; document.getElementById("main-back-"+str).style.display="none";}
/* Main Preview Section Ends*/
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
	
	if(otitle=="etfabric"){$("#menuopttitle-"+otitle).html("Choose Your Fabric : ");} else {if(ttle=="35"){$("#menuopttitle-"+otitle).html("Choose Your Neck Line :");} else if(ttle=="40"){$("#menuopttitle-"+otitle).html("Choose Your Contrast Fabric :");}}
	
	$("div[id^='miniview-']").css("display","none"); $("#miniview-"+otitle+"-"+ttle).css("display","block");

	viewMainFront(otitle);
}
///* Page Option Functions */
function getPgOption(str,tabstr,attrid,attrnm){ 
	$(".pt-box-square").removeClass("active"); $("#"+str).addClass("active");
	
	var optstr=str.replace("menu-","menu-opt-"); var ttle=$.trim(attrnm); $("div[id^='menu-opt']").css("display","none"); $("#"+optstr).css("display","block");
	
	if(tabstr=="etfabric"){$("#menuopttitle-"+tabstr).html("Choose Your Fabric : ");} else {if(attrid=="35"){$("#menuopttitle-"+tabstr).html("Choose Your Neck Line :");} else if(attrid=="36"){$("#menuopttitle-"+tabstr).html("Choose Your Vest Style :");} else if(attrid=="37"){$("#menuopttitle-"+tabstr).html("Select Pocket Style :");} else if(attrid=="38"){$("#menuopttitle-"+tabstr).html("Choose Your Bottom Style :");} else if(attrid=="39"){$("#menuopttitle-"+tabstr).html("Choose Your Back Style :");} else if(attrid=="40"){$("#menuopttitle-"+tabstr).html("Choose Your Contrast Fabric :");} else if(attrid=="41"){$("#menuopttitle-"+tabstr).html("Choose Your Lining Fabrics :");} else if(attrid=="42"){$("#menuopttitle-"+tabstr).html("Choose Your Button Color :");}}

	$("div[id^='miniview-']").css("display","none");
	$("#miniview-"+tabstr+"-"+attrid).css("display","block");
	
	if(attrid=="39"){viewMainBack(tabstr);} else if(attrid=="41"){viewMainSide(tabstr);} else {viewMainFront(tabstr);}
}
/* ---------------------------------------------------------------------------------------------- */
function sidedesignProcess(jArray){
	var sideArr = {};var fabimg = jArray['ofabric']+".png";var fabcontrastimg = jArray['ocontrast']+".png";var lining = jArray['olining']+".png";var piping = jArray['opiping']+".png";var imgNone="";var mainimg="";var liningimg="";var pipingimg="";
	
	mainimg=url+"/Vests/Fabric/InsideView/"+fabimg;
	liningimg=url+"/Vests/ColorContrast/Lining/InsideView/"+lining;
	pipingimg=url+"/Vests/ColorContrast/Piping/"+piping;
	
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
		if (retsidesrc.length > 0) {
		  setTimeout(sideProcessing, 20);
		} else { $("div [id^='main-side-']").find("div.pt-image-div img").attr("src",cdata);}
	});
}
function backdesignProcess(jArray){
	var backArr = {};var fabimg = jArray['ofabric']+".png";var fabcontrastimg = jArray['ocontrast']+".png";var imgNone="";var mainimg="";var bckstyle="";var liningimg="";var lining = jArray['olining']+".png"; 
	
	mainimg=url+"/Vests/Fabric/Back/"+fabimg;
	if(jArray['oback']=="98"){bckstyle=url+"/Vests/Style/Back/Belt/Front/"+fabimg;} else {bckstyle=imgNone;}
	liningimg=url+"/Vests/ColorContrast/Lining/Back/"+lining;
	
	var backArr={backstyle: bckstyle,backlining: liningimg,main: mainimg,};
	
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
		if (retbacksrc.length > 0) {
		  setTimeout(backProcessing, 20);
		} else {
			$("div [id^='main-back-']").find("div.pt-image-div img").attr("src",cdata);
			$("#miniview-etstyle-39").find("figure img").attr("src",cdata);
		}
	});
}
function frontdesignProcess(jArray){
	var frontArr = {};var imgNone = '';var fabimg = jArray['ofabric']+".png";var fabcontrastimg = jArray['ocontrast']+".png";var dbutton = jArray['obutton']+".png";var dthread = jArray['obuttonHole']+".png";var frontmain="";var liningimg="";var lining = jArray['olining']+".png";var pockets="";var buttonhole="";var buttnstyle="";var bottomcut="";var lapel="";
	
	if(jArray['obottom']=="95"){frontmain=url+"/Vests/Style/Bottom/AngleCut/Front/"+fabimg; bottomcut=url+"/Vests/ColorContrast/Lining/Cut/"+lining;} else if(jArray['obottom']=="96"){frontmain=url+"/Vests/Style/Bottom/Straight/Front/"+fabimg; bottomcut=imgNone;}
	
	if(jArray['opacket']=="92"){if(jArray['ocontpockets']=="true"){pockets=url+"/Vests/ColorContrast/Mix/PocketContrast/Pockets/SingleOpening/Front/"+fabcontrastimg;} else {pockets=url+"/Vests/Style/Pockets/SingleOpening/Front/"+fabimg;}} else if(jArray['opacket']=="93"){if(jArray['ocontpockets']=="true"){pockets=url+"/Vests/ColorContrast/Mix/PocketContrast/Pockets/DoubleOpening/Front/"+fabcontrastimg;} else {pockets=url+"/Vests/Style/Pockets/DoubleOpening/Front/"+fabimg;}} else if(jArray['opacket']=="94"){if(jArray['ocontpockets']=="true"){pockets=url+"/Vests/ColorContrast/Mix/PocketContrast/Pockets/FlappedPockets/Front/"+fabcontrastimg;} else {pockets=url+"/Vests/Style/Pockets/FlappedPockets/Front/"+fabimg;}}
	
	if(jArray['obuttonstyle']=="89"){buttonhole=url+"/Vests/Style/Buttons/6Buttons/Thread/ShowImg/"+dthread; buttnstyle=url+"/Vests/Style/Buttons/6Buttons/Button/ShowImg/"+dbutton; liningimg=url+"/Vests/ColorContrast/Lining/6Buttons/"+lining;} else if(jArray['obuttonstyle']=="90"){buttonhole=url+"/Vests/Style/Buttons/5Buttons/Thread/ShowImg/"+dthread; buttnstyle=url+"/Vests/Style/Buttons/5Buttons/Button/ShowImg/"+dbutton; liningimg=url+"/Vests/ColorContrast/Lining/5Buttons/"+lining;} else if(jArray['obuttonstyle']=="91"){buttonhole=url+"/Vests/Style/Buttons/4Buttons/Thread/ShowImg/"+dthread; buttnstyle=url+"/Vests/Style/Buttons/4Buttons/Button/ShowImg/"+dbutton; liningimg=url+"/Vests/ColorContrast/Lining/4Buttons/"+lining;}
	
	if(jArray['ostyle']=="86"){if(jArray['obuttonstyle']=="89"){if(jArray['ocontlapel']=="true"){lapel=url+"/Vests/ColorContrast/Mix/LapelContrast/Buttons/6Buttons/PeakLapel/Front/"+fabcontrastimg;}else {lapel=url+"/Vests/Style/Style/PeakLapel/6Buttons/main/"+fabimg;}}else if(jArray['obuttonstyle']=="90"){if(jArray['ocontlapel']=="true"){lapel=url+"/Vests/ColorContrast/Mix/LapelContrast/Buttons/5Buttons/PeakLapel/Front/"+fabcontrastimg;}else {lapel=url+"/Vests/Style/Style/PeakLapel/5Buttons/main/"+fabimg;}}else if(jArray['obuttonstyle']=="91"){if(jArray['ocontlapel']=="true"){lapel=url+"/Vests/ColorContrast/Mix/LapelContrast/Buttons/4Buttons/PeakLapel/Front/"+fabcontrastimg;}else {lapel=url+"/Vests/Style/Style/PeakLapel/4Buttons/main/"+fabimg;}}} else if(jArray['ostyle']=="87"){if(jArray['obuttonstyle']=="89"){if(jArray['ocontlapel']=="true"){lapel=url+"/Vests/ColorContrast/Mix/LapelContrast/Buttons/6Buttons/NotchLapel/Front/"+fabcontrastimg;}else {lapel=url+"/Vests/Style/Style/NotchLapel/6Buttons/main/"+fabimg;}}else if(jArray['obuttonstyle']=="90"){if(jArray['ocontlapel']=="true"){lapel=url+"/Vests/ColorContrast/Mix/LapelContrast/Buttons/5Buttons/NotchLapel/Front/"+fabcontrastimg;}else {lapel=url+"/Vests/Style/Style/NotchLapel/5Buttons/main/"+fabimg;}}else if(jArray['obuttonstyle']=="91"){if(jArray['ocontlapel']=="true"){lapel=url+"/Vests/ColorContrast/Mix/LapelContrast/Buttons/4Buttons/NotchLapel/Front/"+fabcontrastimg;}else {lapel=url+"/Vests/Style/Style/NotchLapel/4Buttons/main/"+fabimg;}}} else if(jArray['ostyle']=="88"){if(jArray['obuttonstyle']=="89"){if(jArray['ocontlapel']=="true"){lapel=url+"/Vests/ColorContrast/Mix/LapelContrast/Buttons/6Buttons/ShawlLapel/Front/"+fabcontrastimg;}else {lapel=url+"/Vests/Style/Style/ShawlLapel/6Buttons/main/"+fabimg;}}else if(jArray['obuttonstyle']=="90"){if(jArray['ocontlapel']=="true"){lapel=url+"/Vests/ColorContrast/Mix/LapelContrast/Buttons/5Buttons/ShawlLapel/Front/"+fabcontrastimg;}else {lapel=url+"/Vests/Style/Style/ShawlLapel/5Buttons/main/"+fabimg;}}else if(jArray['obuttonstyle']=="91"){if(jArray['ocontlapel']=="true"){lapel=url+"/Vests/ColorContrast/Mix/LapelContrast/Buttons/4Buttons/ShawlLapel/Front/"+fabcontrastimg;}else {lapel=url+"/Vests/Style/Style/ShawlLapel/4Buttons/main/"+fabimg;}}} else {lapel=imgNone;}

	var frontsrcs = { bottomcut: bottomcut, buttons: buttnstyle, buttnhole: buttonhole, lapelstyle: lapel, pocket: pockets, lining: liningimg, front: frontmain,};
	$.each(frontsrcs,function(key,value){ if(value!=""){ retfrontsrc.push(frontsrcs[key]); } });
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
		if (retfrontsrc.length > 0) {
		  setTimeout(frontProcessing, 20);
		} else {
			$("div [id^='main-front-']").find("div.pt-image-div img").attr("src",cdata);
			$("#miniview-etstyle-36").find("figure img").attr("src",cdata);
			$("#miniview-etcontrast-40").find("figure img").attr("src",cdata);
			$("#miniview-etstyle-35").css("background-image","url("+cdata+")");
			$("#miniview-etstyle-37").css("background-image","url("+cdata+")");
			$("#miniview-etstyle-38").css("background-image","url("+cdata+")");
			$("#miniview-etcontrast-42").css("background-image","url("+cdata+")");
		}
	});
}
/* ----------------------------------Option Selection Functions---------------------------------- */
function getfab(id,otab){	
	var arr = document.getElementById("harr").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       url:'/getfabrics',
       data:{fabid : id, carr : arr, rurl : url, t : otab},
	   beforeSend: function() {
		  $(".et-small-loader").show();
	   },
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
			$("#optionlist-fabric"+data[3]+"-"+id).append('<div class="icon-check"></div>')
			getTabSect(data[2]); 
			getPgOption(stid,stab,"fabric"+data[3],'');
			frontdesignProcess(newarr); 
			backdesignProcess(newarr); 
			sidedesignProcess(newarr); 
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
       url:'/getstyle',
       data:{fabid : id, carr : arr, typ : ctyp, rurl : url, t : otab},
	   beforeSend: function() {
		  $(".et-small-loader").show();
	   },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){
		   	//console.log(data);
			$('#miniview-etstyle-'+data[3]).html(data[1]);
			$('#miniview-etcontrast-40').html(data[5]);
			var stid="menu-"+data[3];
			var stab=data[2]; 
			var newarr=data[4];
			var uparr=JSON.stringify(data[4]);
			$('#tabActiveId').val(data[2]);
			$('#tabSActiveId').val(data[3]);
			$('#harr').val(uparr);
			$("li[id^='optionlist-"+data[3]+"']").find('div.icon-check').remove();
			$("#optionlist-"+data[3]+"-"+id).append('<div class="icon-check"></div>')
			getTabSect(data[2]); 
			getPgOption(stid,stab,data[3],'');
			frontdesignProcess(newarr); 
			backdesignProcess(newarr); 
			sidedesignProcess(newarr); 
			setTimeout($(".et-small-loader").fadeOut(),50);
	   }
    });
}
function getcontrast(id,otab){
    var arr = document.getElementById("harr").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       url:'/getcontrasts',
       data:{fabid : id, carr : arr, typ : '40', rurl : url, t : otab},
	   beforeSend: function() {
		  $(".et-small-loader").show();
	   },
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
			$("#optionlist-"+data[3]+"-"+id).append('<div class="icon-check"></div>')
			getTabSect(data[2]); 
			getPgOption(stid,stab,data[3],'');
			frontdesignProcess(newarr); 
			backdesignProcess(newarr); 
			sidedesignProcess(newarr); 
			setTimeout($(".et-small-loader").fadeOut(),50);
       }
    });
}
function getlining(id,otab){
    var arr = document.getElementById("harr").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       url:'/getlinings',
       data:{fabid : id, carr : arr, typ : '41', rurl : url, t : otab},
	   beforeSend: function() {
		  $(".et-small-loader").show();
	   },
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
			$("#optionlist-"+data[3]+"-"+id).append('<div class="icon-check"></div>')
			getTabSect(data[2]); 
			getPgOption(stid,stab,data[3],'');
			frontdesignProcess(newarr); 
			backdesignProcess(newarr); 
			sidedesignProcess(newarr); 
			setTimeout($(".et-small-loader").fadeOut(),50);
       }
    });
}
function getpiping(id,otab){
    var arr = document.getElementById("harr").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       url:'/getpipings',
       data:{fabid : id, carr : arr, typ : '41', rurl : url, t : otab},
	   beforeSend: function() {
		  $(".et-small-loader").show();
	   },
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
			$("li[id^='optionlist-pip']").find('div.icon-check').remove();
			$("#optionlist-pip-"+id).append('<div class="icon-check"></div>')
			getTabSect(data[2]); 
			getPgOption(stid,stab,data[3],'');
			frontdesignProcess(newarr); 
			backdesignProcess(newarr); 
			sidedesignProcess(newarr); 
			setTimeout($(".et-small-loader").fadeOut(),50);
       }
    });
}
function getbuttons(id,otab){
    var arr = document.getElementById("harr").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       url:'/getbutton',
       data:{fabid : id, carr : arr, typ : '42', rurl : url, t : otab},
	   beforeSend: function() {
		  $(".et-small-loader").show();
	   },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){
		   	$("#miniview-etcontrast-42").html(data[1]);		    
			var stid="menu-"+data[3];
			var stab=data[2]; 
			var newarr=data[4];
			var uparr=JSON.stringify(data[4]);
			$('#tabActiveId').val(data[2]);
			$('#tabSActiveId').val(data[3]);
			$('#harr').val(uparr);
			$("#fullstyle").html(data[5])
			$("li[id^='optionlist-"+data[3]+"']").find('div.icon-check').remove();
			$("#optionlist-"+data[3]+"-"+id).append('<div class="icon-check"></div>')
			getTabSect(data[2]); 
			getPgOption(stid,stab,data[3],'');
			frontdesignProcess(newarr); 
			backdesignProcess(newarr); 
			sidedesignProcess(newarr); 
			setTimeout($(".et-small-loader").fadeOut(),50);
       }
    });
}
function getthread(id,otab){
    var arr = document.getElementById("harr").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       url:'/getthreads',
       data:{fabid : id, carr : arr, typ : '42', rurl : url, t : otab},
	   beforeSend: function() {
		  $(".et-small-loader").show();
	   },
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
			$("li[id^='optionlist-thrd']").find('div.icon-check').remove();
			$("#optionlist-thrd-"+id).append('<div class="icon-check"></div>')
			getTabSect(data[2]); 
			getPgOption(stid,stab,data[3],'');
			frontdesignProcess(newarr); 
			backdesignProcess(newarr); 
			sidedesignProcess(newarr); 
			setTimeout($(".et-small-loader").fadeOut(),50);
       }
    });
}
function getseloptions(id,opt,ctyp,otab){
    var arr = document.getElementById("harr").value;
	arr=JSON.parse(arr);
    $.ajax({
       type:'POST',
       url:'/getsetoptions',
       data:{fabid : id, carr : arr, opttyp : opt, typ : ctyp, rurl : url, t : otab},
	   beforeSend: function() {
		  $(".et-small-loader").show();
	   },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){	
	   		$('#miniview-etcontrast-40').html(data[5]);	    
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
			sidedesignProcess(newarr); 
			setTimeout($(".et-small-loader").fadeOut(),50);
       }
    });
}
function showMeasureSect(id){
	$("div[id^='menu-mesure-']").css("display","none");
	$("#menu-mesure-"+id).css("display","block");
	
	$("#etmeasurement").find("div.pt-variation div.pt-box-square").removeClass("active");
	if(id=="bodysize" || id=="standardsize" || id=="outfitsize"){
		$("#menu-"+id).addClass("active");
		if(id=="bodysize"){ 
			$("input#bsizeChest").focus(); var tt=$("input#bsizeChest").attr("data-title").split('-');$("span#fldtitle").html("Chest"); $("span#rngfrom").html(tt[0]); $("span#rngto").html(tt[1]);$("div.et-measure-image").find("figure img").attr("src",url+"/Measurment/Shirts/chest/chest.jpg");
			$("div.et-measure-video").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/chest/chest.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/chest/chest.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/chest/chest.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/chest/chest.webm" type="video/webm"></video>');
			var fview=$("#main-front-etmeasurement").find("div.pt-image-div img").attr("src"); var bview=$("#main-back-etmeasurement").find("div.pt-image-div img").attr("src"); $("input#frntviewfinal").val(fview); $("input#bkviewfinal").val(bview); var arr = document.getElementById("harr").value; $("input#setarr").val(arr);
		} else if(id=="standardsize"){
			var fview=$("#main-front-etmeasurement").find("div.pt-image-div img").attr("src"); var bview=$("#main-back-etmeasurement").find("div.pt-image-div img").attr("src"); $("input#frntviewfinal").val(fview); $("input#bkviewfinal").val(bview); var arr = document.getElementById("harr").value; $("input#setarr").val(arr);
		} else if(id=="outfitsize"){ 
			$("input#bsizeChest2").focus(); 
			var tt=$("input#bsizeChest2").attr("data-title").split('-');
			$("span#fldtitle2").html("Chest"); 
			$("span#rngfrom2").html(tt[0]); 
			$("span#rngto2").html(tt[1]);
			$("div.et-measure-image-2").find("figure img").attr("src",url+"/Measurment/Shirts/chest/chest.jpg");
			$("div.et-measure-video-2").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/chest/chest.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/chest/chest.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/chest/chest.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/chest/chest.webm" type="video/webm"></video>');
			var fview=$("#main-front-etmeasurement").find("div.pt-image-div img").attr("src"); 
			var bview=$("#main-back-etmeasurement").find("div.pt-image-div img").attr("src");
			$("input#frntviewfinal2").val(fview); 
			$("input#bkviewfinal2").val(bview); 
			var arr = document.getElementById("harr").value; 
			$("input#setarr2").val(arr);
		}
	}
}
function showRanges(ttl,frange,trange,typ){
	var sizetyp=$("input[id^='bsizetyp']:checked").attr("value");
	if(sizetyp=="cm"){frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange;}
	if(typ=="length"){var msrimg=url+"/Measurment/Shirts/vlength/"+typ+".jpg";$("div.et-measure-image").find("figure img").attr("src",msrimg);
	$("div.et-measure-video").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/vlength/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/vlength/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/vlength/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/vlength/'+typ+'.webm" type="video/webm"></video>'); } else {var msrimg=url+"/Measurment/Shirts/"+typ+"/"+typ+".jpg";$("div.et-measure-image").find("figure img").attr("src",msrimg);$("div.et-measure-video").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.webm" type="video/webm"></video>'); }
	$("span#fldtitle").html(ttl); $("span#rngfrom").html(frange); $("span#rngto").html(trange); $("span#mtyp").html(sizetyp);
}
function validateField(fid,frange,trange){
	var sizetyp=$("input[id^='bsizetyp']:checked").attr("value");
	var fval=$("#"+fid).val();
	if(sizetyp=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
	
	if(fval==""){$("#"+fid).css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
	} else if(fval<frange || fval>trange){ $("#"+fid).css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
	} else { $("#"+fid).css({'border-color':'#090','box-shadow':'0px 0px 15px #090'}); }
}

function validatebodyform(){
	var typ=$("input[id^='bsizetyp']:checked").attr("value"); var rnge="";
	
	if(document.getElementById('bsizeChest').value==""){ document.getElementById('bsizeChest').focus(); return false;
	} else if(document.getElementById('bsizeChest').value!=""){
		rnge=$("#bsizeChest").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat(document.getElementById('bsizeChest').value)==false){
			$("#bsizeChest").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeChest').focus(); return false;
		} else if(parseFloat(document.getElementById('bsizeChest').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeChest').value) > parseFloat(trange)){
			$("#bsizeChest").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeChest').focus(); return false;
		}
	}
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
	if(document.getElementById('bsizeLength').value==""){ document.getElementById('bsizeLength').focus(); return false;
	} else if(document.getElementById('bsizeLength').value!=""){
		rnge=$("#bsizeLength").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat(document.getElementById('bsizeLength').value)==false){
			$("#bsizeLength").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeLength').focus(); return false;
		}
	}
	if(document.getElementById('bsizeShoulder').value==""){ document.getElementById('bsizeShoulder').focus(); return false;
	} else if(document.getElementById('bsizeShoulder').value!=""){
		rnge=$("#bsizeShoulder").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat(document.getElementById('bsizeShoulder').value)==false){
			$("#bsizeShoulder").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeShoulder').focus(); return false;
		} else if(parseFloat(document.getElementById('bsizeShoulder').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeShoulder').value) > parseFloat(trange)){
			$("#bsizeShoulder").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeShoulder').focus(); return false;
		}
	}
	return true;
}
function changeCntrySize(vl){
	$.ajax({
       type:'POST',
       url:'/measurvests',
       data:{sizeid : vl},
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){$("#divsizefit").html(data); changeSizeDetails(); }
    });
}
function changeSizeDetails(){
	var cid=$("#cntrysize").val(); var sid=$("#sizefit").val(); var typ=$("input[id='sizetyp']:checked").val(); var hsfit=$("#sizefit option:selected").text();
	$.ajax({
       type:'POST',
       url:'/measurvestdtls',
       data:{sizeid : sid, cntryid : cid},
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){
			data=data.split('/');
			if(typ=="inch"){
				$("#vchest").html(data[0]); $("#sizechest").val(data[0]); $("#vwaist").html(data[1]); $("#sizewaist").val(data[1]); $("#vhip").html(data[2]); $("#sizehip").val(data[2]); $("#vshoulder").html(data[3]); $("#sizeshoulder").val(data[3]); $("#sizelength").val(data[4]);
			} else if(typ=="cm"){
				$("#vchest").html(Math.round(data[0]*2.54,2)); $("#sizechest").val(Math.round(data[0]*2.54,2)); $("#vwaist").html(Math.round(data[1]*2.54,2)); $("#sizewaist").val(Math.round(data[1]*2.54,2)); $("#vhip").html(Math.round(data[2]*2.54,2)); $("#sizehip").val(Math.round(data[2]*2.54,2)); $("#vshoulder").html(Math.round(data[3]*2.54,2)); $("#sizeshoulder").val(Math.round(data[3]*2.54,2)); $("#sizelength").val(Math.round(data[4]*2.54,2));
			}
			$("#hsizefit").val(hsfit); $("p.et-tsize").text(typ);
       }
    });
}
function IsFloat(str){return /^((\d+(\.\d*)?)|((\d*\.)?\d+))$/.test(str);}
function navigateback(){
	var activetab=$(".nav-tabs").find("li.active a").attr("href"); var activesubtab=$(activetab).find("div.pt-variation div.active").attr("id"); var tabb=$.trim(activetab.replace('#','')); var stab=$.trim(activesubtab.replace('menu-',''));
	if(tabb=="etfabric"){ getTabSect('etfabric'); getPgOption('menu-fabric11','etfabric','fabric11','');
	} else if(tabb=="etstyle"){
		switch(stab){
			case "35":
			$("#etstyle").removeClass("active"); $(".nav-tabs li").removeClass("active"); $("a[href='#etfabric']").parent("li").addClass("active"); getTabSect('etfabric'); getPgOption('menu-fabric11','etfabric','fabric11',''); break;
			case "36":
			getTabSect('etstyle'); getPgOption('menu-35','etstyle','35',''); break;
			case "37":
			getTabSect('etstyle'); getPgOption('menu-36','etstyle','36',''); break;
			case "38":
			getTabSect('etstyle'); getPgOption('menu-37','etstyle','37',''); break;
			case "39":
			getTabSect('etstyle'); getPgOption('menu-38','etstyle','38',''); break;
		}
	} else if(tabb=="etcontrast"){
		switch(stab){
			case "40":
			$("#etcontrast").removeClass("active"); $(".nav-tabs li").removeClass("active"); $("a[href='#etstyle']").parent("li").addClass("active"); getTabSect('etstyle'); getPgOption('menu-39','etstyle','39',''); break;
			case "41":
			getTabSect('etcontrast'); getPgOption('menu-40','etcontrast','40',''); break;
			case "42":
			getTabSect('etcontrast'); getPgOption('menu-41','etcontrast','41',''); break;
		}
	}
}
function navigatenext(){
	var activetab=$(".nav-tabs").find("li.active a").attr("href"); var activesubtab=$(activetab).find("div.pt-variation div.active").attr("id"); var tabb=$.trim(activetab.replace('#','')); var stab=$.trim(activesubtab.replace('menu-',''));
	if(tabb=="etfabric"){
		$("#etfabric").removeClass("active"); $(".nav-tabs li").removeClass("active"); $("a[href='#etstyle']").parent("li").addClass("active"); getTabSect('etstyle'); getPgOption('menu-35','etstyle','35','');
	} else if(tabb=="etstyle"){
		switch(stab){
			case "35":
			getTabSect('etstyle'); getPgOption('menu-36','etstyle','36',''); break;
			case "36":
			getTabSect('etstyle'); getPgOption('menu-37','etstyle','37',''); break;
			case "37":
			getTabSect('etstyle'); getPgOption('menu-38','etstyle','38',''); break;
			case "38":
			getTabSect('etstyle'); getPgOption('menu-39','etstyle','39',''); break;
			case "39":
			$("#etstyle").removeClass("active"); $(".nav-tabs li").removeClass("active"); $("a[href='#etcontrast']").parent("li").addClass("active"); getTabSect('etcontrast'); getPgOption('menu-40','etcontrast','40',''); break;
		}
	} else if(tabb=="etcontrast"){
		switch(stab){
			case "40":
			getTabSect('etcontrast'); getPgOption('menu-41','etcontrast','41',''); break;
			case "41":
			getTabSect('etcontrast'); getPgOption('menu-42','etcontrast','42',''); break;
			case "42":
			$("#etcontrast").removeClass("active"); $(".nav-tabs li").removeClass("active"); $("a[href='#etmeasurement']").parent("li").addClass("active"); getTabSect('etmeasurement',''); getPgOption('menu-bodysize','etmeasurement','bodysize','',''); break;
		}
	}	
}
function updatefabprice(){
	var arr = document.getElementById("harr").value; arr=JSON.parse(arr); var fabprice=arr['ofabricPrice'];
	fabprice=parseFloat(fabprice);
	$(".pt-dollor").html("$ "+fabprice);
	$(".vwprice").html("1 Vest: $ "+fabprice);
}
/* new added for body type */
function selectBodyType(option, type) {
    $('#body_type_ul_'+1+'_'+option).find('div.icon-check-2').remove();
    $('#body_type_'+1+'_'+option+'_'+type).append('<div class="icon-check-2"></div>');
    $('#body_type_ul_'+2+'_'+option).find('div.icon-check-2').remove();
    $('#body_type_'+2+'_'+option+'_'+type).append('<div class="icon-check-2"></div>');
    $('#body_type_ul_'+3+'_'+option).find('div.icon-check-2').remove();
    $('#body_type_'+3+'_'+option+'_'+type).append('<div class="icon-check-2"></div>');
    var arr = document.getElementById("harr").value;
    arr = JSON.parse(arr);
    arr['body_type_'+option] = type;
    var uparr = JSON.stringify(arr);
    $('#harr').val(uparr);
    $("input#setarr").val(uparr);
    $("input#setarr2").val(uparr);
}
/* ============================ new added for outfit size =============================== */
function showRanges2(ttl,frange,trange,typ){
	var sizetyp=$("input[id^='bsizetyp2']:checked").attr("value");
	if(sizetyp=="cm"){frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange;}
	if(typ=="length"){
		var msrimg=url+"/Measurment/Shirts/vlength/"+typ+".jpg";
		$("div.et-measure-image-2").find("figure img").attr("src",msrimg);
		$("div.et-measure-video-2").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/vlength/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/vlength/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/vlength/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/vlength/'+typ+'.webm" type="video/webm"></video>'); } else {var msrimg=url+"/Measurment/Shirts/"+typ+"/"+typ+".jpg";$("div.et-measure-image").find("figure img").attr("src",msrimg);$("div.et-measure-video").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.webm" type="video/webm"></video>'); 
	}
	$("span#fldtitle2").html(ttl); 
	$("span#rngfrom2").html(frange); 
	$("span#rngto2").html(trange); 
	$("span#mtyp2").html(sizetyp);
}
function validateField2(fid,frange,trange){
	var sizetyp=$("input[id^='bsizetyp2']:checked").attr("value");
	var fval=$("#"+fid).val();
	if(sizetyp=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
	
	if(fval==""){$("#"+fid).css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
	} else if(fval<frange || fval>trange){ $("#"+fid).css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
	} else { $("#"+fid).css({'border-color':'#090','box-shadow':'0px 0px 15px #090'}); }
}

function validatebodyform2(){
	var typ=$("input[id^='bsizetyp2']:checked").attr("value"); var rnge="";
	
	if(document.getElementById('bsizeChest2').value==""){ document.getElementById('bsizeChest2').focus(); return false;
	} else if(document.getElementById('bsizeChest2').value!=""){
		rnge=$("#bsizeChest2").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat(document.getElementById('bsizeChest2').value)==false){
			$("#bsizeChest2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeChest2').focus(); return false;
		} else if(parseFloat(document.getElementById('bsizeChest2').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeChest2').value) > parseFloat(trange)){
			$("#bsizeChest2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeChest2').focus(); return false;
		}
	}
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
	if(document.getElementById('bsizeLength2').value==""){ document.getElementById('bsizeLength2').focus(); return false;
	} else if(document.getElementById('bsizeLength2').value!=""){
		rnge=$("#bsizeLength2").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat(document.getElementById('bsizeLength2').value)==false){
			$("#bsizeLength2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeLength2').focus(); return false;
		}
	}
	if(document.getElementById('bsizeShoulder2').value==""){ document.getElementById('bsizeShoulder2').focus(); return false;
	} else if(document.getElementById('bsizeShoulder2').value!=""){
		rnge=$("#bsizeShoulder2").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat(document.getElementById('bsizeShoulder2').value)==false){
			$("#bsizeShoulder2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeShoulder2').focus(); return false;
		} else if(parseFloat(document.getElementById('bsizeShoulder2').value) < parseFloat(frange) || parseFloat(document.getElementById('bsizeShoulder2').value) > parseFloat(trange)){
			$("#bsizeShoulder2").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			document.getElementById('bsizeShoulder2').focus(); return false;
		}
	}
	return true;
}