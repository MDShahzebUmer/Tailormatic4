var retfrontsrc=[]; 
var retbacksrc=[]; 
var retsidesrc=[]; 
var fcanvas = new fabric.StaticCanvas('frontcanvas3'); 
var bcanvas = new fabric.StaticCanvas('backcanvas3'); 
var scanvas = new fabric.StaticCanvas('sidecanvas3');
//
/* Main Preview Section*/
function viewMainBack(str){
	$('#prev_img_vest #main-front').css('display','none');
	$('#prev_img_vest #main-side').css('display','none');
	$('#prev_img_vest #main-back').css('display','block');
}
function viewMainFront(str){
	$('#prev_img_vest #main-front').css('display','block');
	$('#prev_img_vest #main-side').css('display','none');
	$('#prev_img_vest #main-back').css('display','none');
}
function viewMainSide(str){ 
	$('#prev_img_vest #main-front').css('display','none');
	$('#prev_img_vest #main-side').css('display','block');
	$('#prev_img_vest #main-back').css('display','none');
}
/* Main Preview Section Ends*/
///* Tab */
function getTabSect(str){
	var tabID = "#"+str; var otitle=$.trim(str); 
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

	$("#container_vests div[id^='menu-opt']").css("display","none"); 
	$("#container_vests #"+idopt).css("display","block");
	
	if(otitle=="etfabric"){
		$("#container_vests #menuopttitle-"+otitle).html("Choose Your Fabric : ");
	} else {
		if(ttle=="35"){
			$("#container_vests #menuopttitle-"+otitle).html("Choose Your Neck Line :");
		} else if(ttle=="40"){
			$("#container_vests #menuopttitle-"+otitle).html("Choose Your Contrast Fabric :");
		}
	}
	
	$("#container_vests div[id^='miniview-']").css("display","none"); 
	$("#container_vests #miniview-"+otitle+"-"+ttle).css("display","block");

	viewMainFront(otitle);
}
///* Page Option Functions */
function getPgOption(str,tabstr,attrid,attrnm){ 
	$("#container_vests .pt-box-square").removeClass("active"); 
	$("#container_vests #"+str).addClass("active");
	
	var optstr=str.replace("menu-","menu-opt-"); 
	var ttle=$.trim(attrnm); 
	$("#container_vests div[id^='menu-opt']").css("display","none"); 
	$("#container_vests #"+optstr).css("display","block");
	
	if(tabstr=="etfabric"){
		$("#container_vests #menuopttitle-"+tabstr).html("Choose Your Fabric : ");
	} else {
		if(attrid=="35"){
			$("#container_vests #menuopttitle-"+tabstr).html("Choose Your Neck Line :");
		} else if(attrid=="36"){
			$("#container_vests #menuopttitle-"+tabstr).html("Choose Your Vest Style :");
		} else if(attrid=="37"){
			$("#container_vests #menuopttitle-"+tabstr).html("Select Pocket Style :");
		} else if(attrid=="38"){
			$("#container_vests #menuopttitle-"+tabstr).html("Choose Your Bottom Style :");
		} else if(attrid=="39"){
			$("#container_vests #menuopttitle-"+tabstr).html("Choose Your Back Style :");
		} else if(attrid=="40"){
			$("#container_vests #menuopttitle-"+tabstr).html("Choose Your Contrast Fabric :");
		} else if(attrid=="41"){
			$("#container_vests #menuopttitle-"+tabstr).html("Choose Your Lining Fabrics :");
		} else if(attrid=="42"){
			$("#container_vests #menuopttitle-"+tabstr).html("Choose Your Button Color :");
		}
	}

	$("#container_vests div[id^='miniview-']").css("display","none");
	$("#container_vests #miniview-"+tabstr+"-"+attrid).css("display","block");
	
	if(attrid=="39"){
		viewMainBack(tabstr);
	} else if(attrid=="41"){
		viewMainSide(tabstr);
	} else {
		viewMainFront(tabstr);
	}
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
		} else { $("#prev_img_vest div[id^='main-side']").find("div.pt-image-div img").attr("src",cdata);}
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
			$("#prev_img_vest div[id^='main-back']").find("div.pt-image-div img").attr("src",cdata);
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
			$("#prev_img_vest div[id^='main-front']").find("div.pt-image-div img").attr("src",cdata);
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
       	// url:'/getfabrics',
		url:'/getfabricsvest',
       	data:{fabid : id, carr : arr, rurl : url, t : otab},
       	async: false,
	   	beforeSend: function() {
		  	// $("#container_vests .et-small-loader").show();
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
			$("#container_vests #fullstyle").html(data[5])
			$("#container_vests li[id^='optionlist-fabric']").find('div.icon-check').remove();
			$("#container_vests #optionlist-fabric"+data[3]+"-"+id).append('<div class="icon-check"></div>')
			getTabSect(data[2]); 
			getPgOption(stid,stab,"fabric"+data[3],'');
			frontdesignProcess(newarr); 
			backdesignProcess(newarr); 
			sidedesignProcess(newarr); 
			changeSizeDetails();
			updatefabprice();
			// setTimeout($("#container_vests .et-small-loader").fadeOut(),50);
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
		  $("#container_vests .et-small-loader").show();
	   },
       headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       success:function(data){
		   	//console.log(data);
			$('#container_vests #miniview-etstyle-'+data[3]).html(data[1]);
			$('#container_vests #miniview-etcontrast-40').html(data[5]);
			var stid="menu-"+data[3];
			var stab=data[2]; 
			var newarr=data[4];
			var uparr=JSON.stringify(data[4]);
			$('#tabActiveId').val(data[2]);
			$('#tabSActiveId').val(data[3]);
			$('#harr').val(uparr);
			$("#container_vests li[id^='optionlist-"+data[3]+"']").find('div.icon-check').remove();
			$("#container_vests #optionlist-"+data[3]+"-"+id).append('<div class="icon-check"></div>')
			getTabSect(data[2]); 
			getPgOption(stid,stab,data[3],'');
			frontdesignProcess(newarr); 
			backdesignProcess(newarr); 
			sidedesignProcess(newarr); 
			setTimeout($("#container_vests .et-small-loader").fadeOut(),50);
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
		  $("#container_vests .et-small-loader").show();
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
			$("#container_vests li[id^='optionlist-"+data[3]+"']").find('div.icon-check').remove();
			$("#container_vests #optionlist-"+data[3]+"-"+id).append('<div class="icon-check"></div>')
			getTabSect(data[2]); 
			getPgOption(stid,stab,data[3],'');
			frontdesignProcess(newarr); 
			backdesignProcess(newarr); 
			sidedesignProcess(newarr); 
			setTimeout($("#container_vests .et-small-loader").fadeOut(),50);
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
		  $("#container_vests .et-small-loader").show();
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
			$("#container_vests li[id^='optionlist-"+data[3]+"']").find('div.icon-check').remove();
			$("#container_vests #optionlist-"+data[3]+"-"+id).append('<div class="icon-check"></div>')
			getTabSect(data[2]); 
			getPgOption(stid,stab,data[3],'');
			frontdesignProcess(newarr); 
			backdesignProcess(newarr); 
			sidedesignProcess(newarr); 
			setTimeout($("#container_vests .et-small-loader").fadeOut(),50);
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
		  $("#container_vests .et-small-loader").show();
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
			$("#container_vests li[id^='optionlist-pip']").find('div.icon-check').remove();
			$("#container_vests #optionlist-pip-"+id).append('<div class="icon-check"></div>')
			getTabSect(data[2]); 
			getPgOption(stid,stab,data[3],'');
			frontdesignProcess(newarr); 
			backdesignProcess(newarr); 
			sidedesignProcess(newarr); 
			setTimeout($("#container_vests .et-small-loader").fadeOut(),50);
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
		  $("#container_vests .et-small-loader").show();
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
			$("#container_vests #fullstyle").html(data[5])
			$("#container_vests li[id^='optionlist-"+data[3]+"']").find('div.icon-check').remove();
			$("#container_vests #optionlist-"+data[3]+"-"+id).append('<div class="icon-check"></div>')
			getTabSect(data[2]); 
			getPgOption(stid,stab,data[3],'');
			frontdesignProcess(newarr); 
			backdesignProcess(newarr); 
			sidedesignProcess(newarr); 
			setTimeout($("#container_vests .et-small-loader").fadeOut(),50);
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
		  $("#container_vests .et-small-loader").show();
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
			$("#container_vests li[id^='optionlist-thrd']").find('div.icon-check').remove();
			$("#container_vests #optionlist-thrd-"+id).append('<div class="icon-check"></div>')
			getTabSect(data[2]); 
			getPgOption(stid,stab,data[3],'');
			frontdesignProcess(newarr); 
			backdesignProcess(newarr); 
			sidedesignProcess(newarr); 
			setTimeout($("#container_vests .et-small-loader").fadeOut(),50);
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
		  $("#container_vests .et-small-loader").show();
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
			setTimeout($("#container_vests .et-small-loader").fadeOut(),50);
       }
    });
}
function showMeasureSect(id){
	$("#container_vests div[id^='menu-mesure-']").css("display","none");
	$("#container_vests #menu-mesure-"+id).css("display","block");
	
	$("#container_vests #etmeasurement").find("div.pt-variation div.pt-box-square").removeClass("active");
	if(id=="bodysize" || id=="standardsize" || id=="outfitsize"){
		$("#container_vests #menu-"+id).addClass("active");
		if(id=="bodysize" || id=="outfitsize"){ 
			$("#container_vests input#bsizeChest").focus(); 
			var tt=$("#container_vests input#bsizeChest").attr("data-title").split('-');
			$("#container_vests span#fldtitle").html("Chest"); 
			$("#container_vests span#rngfrom").html(tt[0]); 
			$("#container_vests span#rngto").html(tt[1]);
			$("#container_vests div.et-measure-image").find("figure img").attr("src",url+"/Measurment/Shirts/chest/chest.jpg");
			$("#container_vests div.et-measure-video").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/chest/chest.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/chest/chest.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/chest/chest.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/chest/chest.webm" type="video/webm"></video>');
			var fview=$("#prev_img_vest #main-front").find("div.pt-image-div img").attr("src"); 
			var bview=$("#prev_img_vest #main-back").find("div.pt-image-div img").attr("src"); 
			$("#container_vests input#frntviewfinal").val(fview); 
			$("#container_vests input#bkviewfinal").val(bview); 
			var arr = document.getElementById("harr").value; 
			$("#container_vests input#setarr").val(arr);
		} else if(id=="standardsize"){
			var fview=$("#prev_img_vest #main-front").find("div.pt-image-div img").attr("src"); 
			var bview=$("#prev_img_vest #main-back").find("div.pt-image-div img").attr("src"); 
			$("#container_vests input#frntviewfinal").val(fview); 
			$("#container_vests input#bkviewfinal").val(bview); 
			var arr = document.getElementById("harr").value; 
			$("#container_vests input#setarr").val(arr);
		}
	}
}
function showRanges(ttl,frange,trange,typ){
	var sizetyp=$("#container_vests input[id^='bsizetyp']:checked").attr("value");
	if(sizetyp=="cm"){frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange;}
	if(typ=="length"){var msrimg=url+"/Measurment/Shirts/vlength/"+typ+".jpg";
	$("#container_vests div.et-measure-image").find("figure img").attr("src",msrimg);
	$("#container_vests div.et-measure-video").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/vlength/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/vlength/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/vlength/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/vlength/'+typ+'.webm" type="video/webm"></video>'); } else {var msrimg=url+"/Measurment/Shirts/"+typ+"/"+typ+".jpg";$("div.et-measure-image").find("figure img").attr("src",msrimg);$("div.et-measure-video").html('<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.ogv" type="video/ogg"><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.mp4" type="video/mp4"><object data="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.swf" type="application/x-shockwave-flash" width="300" height="220"></object><source src="'+url+'/Measurment/Shirts/'+typ+'/'+typ+'.webm" type="video/webm"></video>'); }
	$("#container_vests span#fldtitle").html(ttl); 
	$("#container_vests span#rngfrom").html(frange); 
	$("#container_vests span#rngto").html(trange); 
	$("#container_vests span#mtyp").html(sizetyp);
}
function validateField(fid,frange,trange){
	var sizetyp=$("#container_vests input[id^='bsizetyp']:checked").attr("value");
	var fval=$("#"+fid).val();
	if(sizetyp=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
	
	if(fval==""){$("#container_vests #"+fid).css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
	} else if(fval<frange || fval>trange){ $("#container_vests #"+fid).css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
	} else { $("#container_vests #"+fid).css({'border-color':'#090','box-shadow':'0px 0px 15px #090'}); }
}

function validatebodyform(){
	var typ=$("#container_jackets input[id^='bsizetyp']:checked").attr("value"); var rnge="";
	
	if($('#temp_vest_bsizeChest').val()==""){ $('#temp_vest_bsizeChest').focus(); return false;
	} else if($('#temp_vest_bsizeChest').val()!=""){
		rnge=$("#temp_vest_bsizeChest").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat($('#temp_vest_bsizeChest').val())==false){
			$("#temp_vest_bsizeChest").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			$('#temp_vest_bsizeChest').focus(); return false;
		} else if(parseFloat($('#temp_vest_bsizeChest').val()) < parseFloat(frange) || parseFloat($('#temp_vest_bsizeChest').val()) > parseFloat(trange)){
			$("#temp_vest_bsizeChest").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			$('#temp_vest_bsizeChest').focus(); return false;
		}
	}
	if($('#temp_vest_bsizeWaist').val()==""){ $('#temp_vest_bsizeWaist').focus(); return false;
	} else if($('#temp_vest_bsizeWaist').val()!=""){
		rnge=$("#temp_vest_bsizeWaist").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat($('#temp_vest_bsizeWaist').val())==false){
			$("#temp_vest_bsizeWaist").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			$('#temp_vest_bsizeWaist').focus(); return false;
		} else if(parseFloat($('#temp_vest_bsizeWaist').val()) < parseFloat(frange) || parseFloat($('#temp_vest_bsizeWaist').val()) > parseFloat(trange)){
			$("#temp_vest_bsizeWaist").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			$('#temp_vest_bsizeWaist').focus(); return false;
		}
	}
	if($('#temp_vest_bsizeHip').val()==""){ $('#temp_vest_bsizeHip').focus(); return false;
	} else if($('#temp_vest_bsizeHip').val()!=""){
		rnge=$("#temp_vest_bsizeHip").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat($('#temp_vest_bsizeHip').val())==false){
			$("#temp_vest_bsizeHip").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			$('#temp_vest_bsizeHip').focus(); return false;
		} else if(parseFloat($('#temp_vest_bsizeHip').val()) < parseFloat(frange) || parseFloat($('#temp_vest_bsizeHip').val()) > parseFloat(trange)){
			$("#temp_vest_bsizeHip").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			$('#temp_vest_bsizeHip').focus(); return false;
		}
	}
	if($('#temp_vest_bsizeLength').val()==""){ $('#temp_vest_bsizeLength').focus(); return false;
	} else if($('#temp_vest_bsizeLength').val()!=""){
		rnge=$("#temp_vest_bsizeLength").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat($('#temp_vest_bsizeLength').val())==false){
			$("#temp_vest_bsizeLength").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			$('#temp_vest_bsizeLength').focus(); return false;
		}
	}
	if($('#temp_vest_bsizeShoulder').val()==""){ $('#temp_vest_bsizeShoulder').focus(); return false;
	} else if($('#temp_vest_bsizeShoulder').val()!=""){
		rnge=$("#temp_vest_bsizeShoulder").attr("data-title").split('-'); frange=parseFloat(rnge[0]); trange=parseFloat(rnge[1]);
		if(typ=="cm"){ frange=Math.round(frange*2.54,2); trange=Math.round(trange*2.54,2); } else { frange=frange; trange=trange; }
		
		if(IsFloat($('#temp_vest_bsizeShoulder').val())==false){
			$("#temp_vest_bsizeShoulder").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			$('#temp_vest_bsizeShoulder').focus(); return false;
		} else if(parseFloat($('#temp_vest_bsizeShoulder').val()) < parseFloat(frange) || parseFloat($('#temp_vest_bsizeShoulder').val()) > parseFloat(trange)){
			$("#temp_vest_bsizeShoulder").css({'border-color':'#f00','box-shadow':'0px 0px 15px #f00','-webkit-box-shadow':'0px 0px 15px #f00'});
			$('#temp_vest_bsizeShoulder').focus(); return false;
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
       		$("#container_vests #divsizefit").html(data); changeSizeDetails(); 
       	}
    });
}
function changeSizeDetails(){
	// var cid=$("#container_vests #cntrysize").val(); 
	// var sid=$("#container_vests #sizefit").val(); 
	// var typ=$("#container_vests input[id='sizetyp']:checked").val(); 
	// var hsfit=$("#container_vests #sizefit option:selected").text();

	var cid=$("#container_jackets #cntrysize").val(); 
	var sid=$("#container_jackets #sizefit").val(); 
	var typ=$("#container_jackets input[id='sizetyp']:checked").val(); 
	var hsfit=$("#container_jackets #sizefit option:selected").text();
	$.ajax({
       	type:'POST',
       	url:'/measurvestidthree',
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
       	url:'/measurvestdtls',
       	data:{sizeid : sid, cntryid : cid},
       	headers: {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       	success:function(data){
			data=data.split('/');
			if(typ=="inch"){
				$("#container_vests #vchest").html(data[0]); 
				$("#container_vests #sizechest").val(data[0]); 
				$("#container_vests #vwaist").html(data[1]); 
				$("#container_vests #sizewaist").val(data[1]); 
				$("#container_vests #vhip").html(data[2]); 
				$("#container_vests #sizehip").val(data[2]); 
				$("#container_vests #vshoulder").html(data[3]); 
				$("#container_vests #sizeshoulder").val(data[3]); 
				$("#container_vests #sizelength").val(data[4]);

				$("#vest_s_vchest").html(data[0]); 
				$("#vest_s_sizechest").val(data[0]); 
				$("#vest_s_vwaist").html(data[1]); 
				$("#vest_s_sizewaist").val(data[1]); 
				$("#vest_s_vhip").html(data[2]); 
				$("#vest_s_sizehip").val(data[2]); 
				$("#vest_s_vshoulder").html(data[3]); 
				$("#vest_s_sizeshoulder").val(data[3]); 
				$("#vest_s_sizelength").val(data[4]);

			} else if(typ=="cm"){
				$("#container_vests #vchest").html(Math.round(data[0]*2.54,2)); 
				$("#container_vests #sizechest").val(Math.round(data[0]*2.54,2)); 
				$("#container_vests #vwaist").html(Math.round(data[1]*2.54,2)); 
				$("#container_vests #sizewaist").val(Math.round(data[1]*2.54,2)); 
				$("#container_vests #vhip").html(Math.round(data[2]*2.54,2)); 
				$("#container_vests #sizehip").val(Math.round(data[2]*2.54,2)); 
				$("#container_vests #vshoulder").html(Math.round(data[3]*2.54,2)); 
				$("#container_vests #sizeshoulder").val(Math.round(data[3]*2.54,2)); 
				$("#container_vests #sizelength").val(Math.round(data[4]*2.54,2));

				$("#vest_s_vchest").html(Math.round(data[0]*2.54,2)); 
				$("#vest_s_sizechest").val(Math.round(data[0]*2.54,2)); 
				$("#vest_s_vwaist").html(Math.round(data[1]*2.54,2)); 
				$("#vest_s_sizewaist").val(Math.round(data[1]*2.54,2)); 
				$("#vest_s_vhip").html(Math.round(data[2]*2.54,2)); 
				$("#vest_s_sizehip").val(Math.round(data[2]*2.54,2)); 
				$("#vest_s_vshoulder").html(Math.round(data[3]*2.54,2)); 
				$("#vest_s_sizeshoulder").val(Math.round(data[3]*2.54,2)); 
				$("#vest_s_sizelength").val(Math.round(data[4]*2.54,2));
			}
			$("#container_vests #hsizefit").val(hsfit); 
			$("#container_vests p.et-tsize").text(typ);
       }
    });
}

function navigateback(){
	var main_tab_id = $('.t-p-menu-1 .nav-tabs').find('li.active').attr('id');
	var main_nav_str = main_tab_id.replace('main_menu_','');

	if(main_nav_str=="etfabric"){ 
		// getTabSect('etfabric'); 
		// getPgOption('menu-fabric11','etfabric','fabric11','');
	} else if(main_nav_str=="etstyle"){
		var stab = "";
		var sub_nav_id = $('#style_sub_menu .nav-tabs').find('li.active').attr('id');
		if(sub_nav_id == 'style_sm_pants'){
            var sub_menu_id = $('#etstylepant .pt-variation-main .pt-variation').find('.pt-box-square.active').attr('id');
			stab =  sub_menu_id.replace('menu-','');
        }else if(sub_nav_id == 'style_sm_vests'){
            var sub_menu_id = $('#etstyle .pt-variation-main .pt-variation').find('.pt-box-square.active').attr('id');
			stab =  sub_menu_id.replace('menu-','');
        }else{
            var sub_menu_id = $('#etstylejacket .pt-variation-main .pt-variation').find('.pt-box-square.active').attr('id');
			stab =  sub_menu_id.replace('menu-','');
        }
		switch(stab){
			case "35":
				showStyle('pants');
				openPgContent('menu-53','etstylepant','53','','style');
				break;
			case "36":
				openPgContent('menu-35','etstyle','35','','style');
				break;
			case "37":
				openPgContent('menu-36','etstyle','36','','style');
				break;
			case "38":
				openPgContent('menu-37','etstyle','37','','style');
				break;
			case "39":
				openPgContent('menu-38','etstyle','38','','style'); 
				break;
		}
	} else if(main_nav_str=="etcontrast"){
		var stab = "";
		var sub_menu_id = $('#etcontrastjacket .pt-variation-main .pt-variation').find('.pt-box-square.active').attr('id');
		stab =  sub_menu_id.replace('menu-','');
		switch(stab){
			case "40":
				openPgContent('menu-54','etcontrastpant','54','','contrast');
				break;
		}
	}
}
function navigatenext(){
	var main_tab_id = $('.t-p-menu-1 .nav-tabs').find('li.active').attr('id');
	var main_nav_str = main_tab_id.replace('main_menu_','');

	if(main_nav_str=="etfabric"){
	} else if(main_nav_str=="etstyle"){
		var stab = "";
		var sub_nav_id = $('#style_sub_menu .nav-tabs').find('li.active').attr('id');
		if(sub_nav_id == 'style_sm_pants'){
            var sub_menu_id = $('#etstylepant .pt-variation-main .pt-variation').find('.pt-box-square.active').attr('id');
			stab =  sub_menu_id.replace('menu-','');
        }else if(sub_nav_id == 'style_sm_vests'){
            var sub_menu_id = $('#etstyle .pt-variation-main .pt-variation').find('.pt-box-square.active').attr('id');
			stab =  sub_menu_id.replace('menu-','');
        }else{
            var sub_menu_id = $('#etstylejacket .pt-variation-main .pt-variation').find('.pt-box-square.active').attr('id');
			stab =  sub_menu_id.replace('menu-','');
        }
		switch(stab){
			case "35":
				openPgContent('menu-36','etstyle','36','','style');
				break;
			case "36":
				openPgContent('menu-37','etstyle','37','','style');
				break;
			case "37":
				openPgContent('menu-38','etstyle','38','','style');
				break;
			case "38":
				openPgContent('menu-39','etstyle','39','','style');
				break;
			case "39":
				openNav('etcontrast');
				break;
		}
	} else if(main_nav_str=="etcontrast"){
		var stab = "";
		var sub_menu_id = $('#etcontrastjacket .pt-variation-main .pt-variation').find('.pt-box-square.active').attr('id');
		stab =  sub_menu_id.replace('menu-','');
		switch(stab){
			case "40":
				openPgContent('menu-26','etcontrastjacket','26','','contrast');
				break;
		}
	}	
}

function updatefabprice(){
	var arr = document.getElementById("harr").value; arr=JSON.parse(arr); 
	var fabprice=arr['ofabricPrice'];
	fabprice=parseFloat(fabprice);
	$("#container_vests .pt-dollor").html("$ "+fabprice);
	$("#container_vests .vwprice").html("1 Vest: $ "+fabprice);
}