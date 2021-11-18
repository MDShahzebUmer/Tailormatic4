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
		$("div [id^='main-side-']").find("div.pt-image-div img").attr("src",cdata);
		if (retsidesrc.length > 0) {
		  setTimeout(sideProcessing, 40);
		}
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
		$("div [id^='main-back-']").find("div.pt-image-div img").attr("src",cdata);
		$("#miniview-etstyle-39").find("figure img").attr("src",cdata);
		if (retbacksrc.length > 0) {
		  setTimeout(backProcessing, 40);
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
		$("div [id^='main-front-']").find("div.pt-image-div img").attr("src",cdata);
		$("#miniview-etstyle-36").find("figure img").attr("src",cdata);
		$("#miniview-etcontrast-40").find("figure img").attr("src",cdata);
		$("#miniview-etstyle-35").css("background-image","url("+cdata+")");
		$("#miniview-etstyle-37").css("background-image","url("+cdata+")");
		$("#miniview-etstyle-38").css("background-image","url("+cdata+")");
		$("#miniview-etcontrast-42").css("background-image","url("+cdata+")");
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
       url:'/designvests',
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
       url:'/designvests',
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
       url:'/designvests',
       data:{fabid : id, carr : arr, typ : '40', t : otab},
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
       url:'/designvests',
       data:{fabid : id, carr : arr, typ : '41', t : otab},
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
       url:'/designvests',
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
function getbuttons(id,jArray,otab){
    var arr=jArray;
    $.ajax({
       type:'POST',
       url:'/designvests',
       data:{fabid : id, carr : arr, typ : '42', t : otab},
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
       url:'/designvests',
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
function getseloptions(id,ctyp,jArray,otab){
    var arr=jArray;
    $.ajax({
       type:'POST',
       url:'/designvests',
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
			$("input#bsizeChest").focus(); $("span#fldtitle").html("Chest"); $("span#rngfrom").html("28"); $("span#rngto").html("75");
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
	if(sizetyp=="cm"){frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange;}
	var msrimg=url+"/Measurment/Shirts/"+typ+"/"+typ+".jpg";
	$("div.et-measure-image").find("figure img").attr("src",msrimg);
	$("div.et-measure-video").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.webm" type="video/webm"></video>');
	
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
       success:function(data){		
		$("#divsizefit").html(data);
		changeSizeDetails(); 
       }
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