
<div id="container_vests" class="row tab-container" style="display:none;">
    <?php $myArray=$eTailorObj;?>
    <input type="hidden" name="tabActiveId" id="tabActiveId" value="<?php echo $activeTab = isset($mytab) ? $mytab : 'etfabric'; ?>">
    <input type="hidden" name="tabSActiveId" id="tabSActiveId" value="<?php echo $activeSubTab = isset($mysubtab) ? $mysubtab : 'fabric11'; ?>">
    <input type="hidden" name="harr" id="harr" value="<?php echo htmlspecialchars(json_encode($myArray)); ?>">
    <div class="pt-tab">
        <div class="card">
            <ul class="nav nav-tabs" role="tablist" style="display:none;">
                <li role="presentation" class="<?php echo (isset($mytab)&& $mytab == 'etfabric') ? 'active' : '' ?>" ><a href="#etfabric" aria-controls="fabric" role="tab" data-toggle="tab" onClick="javascript:getTabSect('etfabric');">1. FABRIC</a></li>
                <li role="presentation" class="<?php echo (isset($mytab)&& $mytab == 'etstyle') ? 'active' : '' ?>"><a href="#etstyle" aria-controls="style" role="tab" data-toggle="tab" onClick="javascript:getTabSect('etstyle');"> 2. STYLE</a></li>
                <li role="presentation" class="<?php echo (isset($mytab) && $mytab == 'etcontrast') ? 'active' : '' ?>"><a href="#etcontrast" aria-controls="contrast" role="tab" data-toggle="tab" onClick="javascript:getTabSect('etcontrast');">3. COLOR CONTRAST</a></li>
                <li role="presentation" class="<?php echo (isset($mytab) && $mytab == 'etmeasurement') ? 'active' : '' ?>"><a href="#etmeasurement" aria-controls="settings" role="tab" data-toggle="tab" onClick="javascript:getTabSect('etmeasurement');">4. MEASUREMENTS</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
            	<!-- ======= Fabric Start Here ========= -->
                <div role="tabpanel" class="tab-pane" id="etfabric">
                    <div class="pt-variation-main">
                        <div class="pt-variation">
                        	@foreach($group_record as $gr)
                          	<div id="menu-fabric{{$gr->id}}" class="pt-box-square <?php if($gr->id == $eTailorObj['ofabricType']) {?>active<?php } ?>" onClick="javascript:getPgOption(this.id,'etfabric','{{$gr->id}}','menu-fabric');">
                                <p>{{$gr->fbgrp_name}}</p>
                                <?php
                                    $frate = 0;
                                    foreach($fb_group as $row){
                                        if($gr->id == $row->parent_id){
                                            if($row->fabric_offer_price != 0 && $row->fabric_offer_price != '')
                                            {
                                                $frate = $row->fabric_offer_price;
                                            }else{
                                                $frate = $row->fabric_rate;
                                            }
                                            break;
                                        }
                                    }
								?>
                                <p>${{number_format($frate,2)}}</P>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="pt-customize">
                        <div class="pt-men">
                            <!-- Right Option Section -->
                            <div class="pt-choose-right">
                                <div class="pt-thumb-slider">
                                    <div class="pt-pagination">
                                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                        <span id="menuopttitle-etfabric">Choose Your Fabric : </span>
                                    </div>
                                    <!-- Fabric of the Week -->
                                    <div class="carousel-container">
                                        @foreach($group_record as $gr)
                                        <div class="et-carousel" id="menu-opt-fabric{{$gr->id}}" <?php if($gr->id == $eTailorObj['ofabricType']) {?>style="display:block;"<?php } else {?>style="display:none;"<?php } ?> >
                                            <div id="et-carousel-item-fabric{{$gr->id}}" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false">
                                                <div class="carousel-inner" role="listbox">
                                                    <div class="item active">
                                                        <ul class="et-item-list">
                                                        	<?php $ci=1; $fabriclst = App\Etfabric::select('*')->where('fbgrp_id','=',$gr->id)->where('fabric_status','=','1')->whereRaw('fabric_qty > fabric_min_qty')->get();?>
                                        					@foreach($fabriclst as $fablst)
                                                            <?php if($ci==7){?></ul></div><div class="item"><ul class="et-item-list"><?php  $ci=1;}?>
                                                            <li class="et-item" id="optionlist-fabric{{$gr->id}}-{{$fablst->id}}" title="{{ $fablst->fabric_name }}" data-title="{{ $fablst->fabric_name }}" onClick="javascript:getfab({{$fablst->id}},'etfabric');">
                                                                <figure class="et-item-img"><img src="{{asset('/storage/'.$fablst->fabric_img_s)}}" alt="{{$alt_name}}" ></figure>
                                                                @if($fablst->id==$eTailorObj['ofabric'])
                                                                <div class="icon-check"></div>
                                                                @endif
                                                            </li>
                                                            <?php $ci++;?>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                    	</div>
                    </div>
                </div>
                <!-- ======= Fabric End Here ========= -->
                <!-- ======= Style Start Here ========= -->
                <div role="tabpanel" class="tab-pane" id="etstyle">
                    <div class="pt-variation-main">
                        <div class="pt-variation">
                        	<?php $smi=1;?>
                        	@foreach($mainattr_record as $mattr)
                            <div id="menu-{{$mattr->id}}" class="pt-box-square <?php if($mattr->id=='35'){?>active<?php } ?>" onClick="javascript:getPgOption(this.id,'etstyle','{{$mattr->id}}','{{$mattr->attribute_name}}');" >
                                <p>2.{{$smi}}  {{$mattr->attribute_name}}</p>
                            </div>
                            <?php $smi++;?>
                            @endforeach
                        </div>
                    </div>
                	<div class="pt-customize">
                		<div class="pt-men">
                            <!-- Right Option Section -->
                            <div class="pt-choose-right">
                                <div class="pt-thumb-slider">
                                    <div class="pt-pagination">
                                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                        <span id="menuopttitle-etstyle">Choose Your Neck Line : </span>
                                    </div>
                                    <div id="fullstyle">
                                    <!-- Menu Sleeves -->
                                    <div class="carousel-container">
                                        @foreach($mainattr_record as $mattr)
                                        <div class="et-carousel" id="menu-opt-{{$mattr->id}}">
                                            <div id="et-style-item-{{$mattr->id}}" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false">
                                                <div class="carousel-inner" role="listbox">
                                                    <div class="item active">
                                                        <ul class="et-item-list">
                                                        	<?php $stylci=1;
    														$stylelst = App\AttributeStyle::select('*')->where('attri_id','=',$mattr->id)->get();
    														?>
                                        					@foreach($stylelst as $styllst)
                                                            <?php if($stylci==7){?></ul></div><div class="item"><ul class="et-item-list"><?php  $stylci=1;}?>
                                                            <li class="et-item" id="optionlist-{{$mattr->id}}-{{$styllst->id}}" data-title="{{$styllst->style_name}}" title="{{$styllst->style_name}}" onClick="javascript:getstyles({{$styllst->id}},'{{$mattr->id}}','etstyle');">
                                                            	<?php $styleimglst = App\Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $eTailorObj['ofabric'])->get();?>
                                                                    @foreach($styleimglst as $ls)
                                                                    <figure class="et-item-img">
                                                                    <img class="et-main-list-img" src="{{asset('/storage/'.$ls->list_img)}}" alt="{{$alt_name}}" >
                                                                    <?php $buttimglst = App\ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$styllst->id)->where('attri_id' , '=' , $styllst->attri_id)->where('but_id' , '=' , $eTailorObj['obutton'])->get();?>
                                                                    @foreach($buttimglst as $buttls)
                                                                    <img src="{{asset('/storage/'.$buttls->button_list_img)}}" alt="{{$alt_name}}" >
                                                                    @endforeach
                                                                    </figure>
                                                                    @if($mattr->id==35)
                                                                    	@if($styllst->id == $eTailorObj['ostyle'])
                                                                        <div class="icon-check"></div>
                                                                        @endif
                                                                    @elseif($mattr->id==36)
                                                                    	@if($styllst->id == $eTailorObj['obuttonstyle'])
                                                                        <div class="icon-check"></div>
                                                                        @endif
                                                                    @elseif($mattr->id==37)
                                                                    	@if($styllst->id == $eTailorObj['opacket'])
                                                                        <div class="icon-check"></div>
                                                                        @endif
                                                                    @elseif($mattr->id==38)
                                                                    	@if($styllst->id == $eTailorObj['obottom'])
                                                                        <div class="icon-check"></div>
                                                                        @endif
                                                                    @elseif($mattr->id==39)
                                                                    	@if($styllst->id == $eTailorObj['oback'])
                                                                        <div class="icon-check"></div>
                                                                        @endif
                                                                    @endif
                                                                    @endforeach
                                                            </li>
                                                            <?php $stylci++;?>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!--======= Navigation Buttons =========-->
                                                <!--======= Left Button =========-->
                                                <a class="left carousel-control gp_products_carousel_control_left" href="#et-style-item-{{$mattr->id}}" role="button" data-slide="prev"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="{{asset('demo/img/ar-left.png')}}"></span><span class="sr-only">Previous</span></a>
                                                <!--======= Right Button =========-->
                                                <a class="right carousel-control gp_products_carousel_control_right" href="#et-style-item-{{$mattr->id}}" role="button" data-slide="next"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="{{asset('demo/img/ar-right.png')}}"></span><span class="sr-only">Next</span></a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <!--  Mini Preview Section -->
                                    <div class="et-progress-des et-style-bg">
                                        <div class="et-content-fab jacket-lapel-bg" id="miniview-etstyle-35">
                                            <div class="et-style-select"><h2>{{$eTailorObj['ostyleName']}}</h2></div>
                                        </div>
                                        <div class="et-content-fab" id="miniview-etstyle-36" style="display:none;">
                                        	<figure class="et-selected-img et-selected-full"><img src="" alt=""></figure>
                                            <div class="et-style-select"><h2>{{$eTailorObj['obuttonstyleName']}}</h2></div>
                                        </div>
                                        <div class="et-content-fab jacket-bottom-bg" id="miniview-etstyle-37" style="display:none;">
                                            <div class="et-style-select"><h2>{{$eTailorObj['opacketName']}}</h2></div>
                                        </div>
                                        <div class="et-content-fab jacket-bottom-bg" id="miniview-etstyle-38" style="display:none;">
                                            <div class="et-style-select"><h2>{{$eTailorObj['obottomName']}}</h2></div>
                                        </div>
                                        <div class="et-content-fab" id="miniview-etstyle-39" style="display:none;">
                                        	<figure class="et-selected-img et-selected-full"><img src="" alt=""></figure>
                                            <div class="et-style-select"><h2>{{$eTailorObj['obackName']}}</h2></div>
                                        </div>
                                        <div class="et-next-back">
                                            <ul><li class="et-prev"><a href="#" onClick="javascript:navigateback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatenext();">Next</a></li></ul>
                                        </div>
                                    </div>
                                    <!-- End Mini Preview Section -->
                                    </div>
                                </div>
                            </div>
                		</div>
                	</div>
                </div>
                <!-- ======= Style End Here ========= -->
                <!-- ======= Contrast Start Here ========= -->
                <div role="tabpanel" class="tab-pane contrast-content" id="etcontrast">
                	<div class="pt-variation-main">
                		<div class="pt-variation">
                            <?php $cmi=1;?>
                            @foreach($contrast_jacker_record as $contlst)
                                <div id="menu-{{$contlst->id}}" class="pt-box-square"
                                    onClick="openPgContent(this.id,'etcontrastjacket','{{$contlst->id}}','{{$contlst->attribute_name}}','contrast');" >
                                    <p>3.{{$cmi}}  {{$contlst->attribute_name}}</p>
                                </div>
                                <?php
                                    if($cmi == 1){
                                        $cmi++;
                                        ?>
                                        <div id="menu-54" class="pt-box-square" onClick="openPgContent('menu-54','etcontrastpant','54','Pant Contrast','contrast');" >
                                            <p>3.{{$cmi}}  Pant Contrast</p>
                                        </div>
                                        <?php $cmi++; ?>
                                        <div id="menu-40" class="pt-box-square active" onClick="openPgContent('menu-40','etcontrast','40','Vest Contrast','contrast');" >
                                            <p>3.{{$cmi}}  Vest Contrast</p>
                                        </div>
                                        <?php
                                    } $cmi++;?>
                            @endforeach
                		</div>
                	</div>
                	<div class="pt-customize">
                		<div class="pt-men">
                            <!-- Right Option Section -->
                			<div class="pt-choose-right">
                    			<div class="pt-thumb-slider">
                                    <div class="pt-pagination no-pad-left">
                                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                        <span id="menuopttitle-etcontrast">Choose Your Contrast Fabric : </span>
                                    </div>
                                    <!-- Menu Contrast -->
                                    <div class="carousel-container">
                                        @foreach($contrast_record as $contlst)
                                        @if($contlst->id == '40')
                            			<div class="et-sm-carousel" id="menu-opt-{{$contlst->id}}" style="display:none">
                                			<div class="et-contrast-list">
                                                <ul class="et-item-list">
                                                	<?php $contfablst = App\Contrast::select('*')->where('cat_id','=',3)->get(); ?>
    												@foreach($contfablst as $cfablst)
                                                    <li class="et-item" id="optionlist-{{$contlst->id}}-{{$cfablst->id}}" data-title="{{$cfablst->contrsfab_name}}" title="{{$cfablst->contrsfab_name}}" onClick="javascript:getcontrast({{$cfablst->id}},'etcontrast');">
                                                        <figure class="et-item-img"><img src="{{asset('/storage/'.$cfablst->contrsfab_img)}}" alt="{{$alt_name}}" ></figure>
                                                        @if($cfablst->id==$eTailorObj['ocontrast'])
                                                        <div class="icon-check"></div>
                                                        @endif
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        @elseif($contlst->id == '41')
                                        <div class="et-sm-carousel" id="menu-opt-{{$contlst->id}}" style="display:none">
                                			<div class="et-contrast-list">
                                                <ul class="et-item-list">
                                                	<?php $liningfablst = App\JvLiningFabric::select('*')->where('cat_id','=',3)->get(); ?>
    												@foreach($liningfablst as $lngfablst)
                                                    <li class="et-item" id="optionlist-{{$contlst->id}}-{{$lngfablst->id}}" data-title="{{$lngfablst->fabric_name}}" title="{{$lngfablst->fabric_name}}" onClick="javascript:getlining({{$lngfablst->id}},'etcontrast')">
                                                        <figure class="et-item-img"><img src="{{asset('/storage/'.$lngfablst->lining_img)}}" alt="{{$alt_name}}" ></figure>
                                                        @if($lngfablst->id==$eTailorObj['olining'])
                                                        <div class="icon-check"></div>
                                                        @endif
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
    									@elseif($contlst->id == '42')
                                        <div class="et-sm-carousel" id="menu-opt-{{$contlst->id}}" style="display:none">
                                			<div class="et-contrast-list">
                                                <ul class="et-item-list">
                                                	<?php $buttonlst = App\Button::select('*')->where('cat_id','=',3)->get(); ?>
    												@foreach($buttonlst as $bttnlst)
                                                    <li class="et-item" id="optionlist-{{$contlst->id}}-{{$bttnlst->id}}" data-title="{{$bttnlst->button_name}}" title="{{$bttnlst->button_name}}" onClick="javascript:getbuttons({{$bttnlst->id}},'etcontrast')">
                                                        <figure class="et-item-img"><img src="{{asset('/storage/'.$bttnlst->button_img)}}" alt="{{$alt_name}}" ></figure>
                                                        @if($bttnlst->id==$eTailorObj['obutton'])
                                                        <div class="icon-check"></div>
                                                        @endif
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <!-- Threads -->
                                            <div class="pt-pagination no-pad-left">
                                                <span>B. Choose Your Button Hole Thread</span>
                                            </div>
                                            <div class="et-contrast-list">
                                                <ul class="et-item-list">
                                                	<?php $contthrdlst = App\Thread::select('*')->where('cat_id','=',3)->get(); ?>
    												@foreach($contthrdlst as $cthreadlst)
                                                    <li class="et-item" id="optionlist-thrd-{{$cthreadlst->id}}" data-title="{{$cthreadlst->thrd_name}}" title="{{$cthreadlst->thrd_name}}" onClick="javascript:getthread({{$cthreadlst->id}},'etcontrast');">
                                                        <figure class="et-item-img"><img src="{{asset('/storage/'.$cthreadlst->thrd_img)}}" alt="{{$alt_name}}" ></figure>
                                                        @if($cthreadlst->id==$eTailorObj['obuttonHole'])
                                                        <div class="icon-check"></div>
                                                        @endif
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                    <!--  Mini Preview Section -->
                        			<div class="et-progress-des et-style-bg">
                            			<div class="et-content-fab" id="miniview-etcontrast-40" >
                                            <figure class="et-selected-img et-selected-full"><img src="{{asset('demo/img/product/blank.png')}}" alt=""></figure>
                                			<div class="et-style-select">
                                                <h2>Vest Contrast</h2>
                                                <div class="et-check-box">
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="pocktstxt" id="pocktstxt" value="true" <?php if($eTailorObj['ocontpockets']=="true"){?>checked<?php } ?> onClick="javascript:getseloptions({{$eTailorObj['ocontpockets']}},'Pockets','40','etcontrast');"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Pocket Contrast</label>
                                                    </div>
                                                    @if($eTailorObj['ostyle']!="85")
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="lapelcontttxt" id="lapelcontttxt" value="true" <?php if($eTailorObj['ocontlapel']=="true"){?>checked<?php } ?> onClick="javascript:getseloptions({{$eTailorObj['ocontlapel']}},'Lapel','40','etcontrast');"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Lapel Contrast</label>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="et-content-fab" id="miniview-etcontrast-41" >
                                			<div class="et-style-select et-jacket-piping">
                                                <h5>Piping</h5>
                                                <ul class="et-item-list">
                                                    <?php $pipngfablst = App\Piping::select('*')->get(); ?>
                                                    @foreach($pipngfablst as $pipfablst)
                                                    <li class="et-item" id="optionlist-pip-{{$pipfablst->id}}" data-title="{{$pipfablst->name}}" title="{{$pipfablst->name}}" onClick="javascript:getpiping({{$pipfablst->id}},'etcontrast')">
                                                        <figure class="et-item-img"><img src="{{asset('/storage/'.$pipfablst->piping_img)}}" alt="{{$alt_name}}" ></figure>
                                                        @if($pipfablst->id==$eTailorObj['opiping'])
                                                        <div class="icon-check"></div>
                                                        @endif
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="et-content-fab jacket-backcollr-bg" id="miniview-etcontrast-42" style="display:none;" >
                                			<div class="et-style-select">
                                                <h2>Jacket Button</h2>
                                                <p>{{$eTailorObj['obuttonName']}}</p>
                                            </div>
                                        </div>
                                        <div class="et-next-back">
                                            <ul><li class="et-prev"><a href="#" onClick="javascript:navigateback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatenext();">Next</a></li></ul>
                                        </div>
                        			</div>
                                    <!--  End Mini Preview Section -->
                    			</div>
                			</div>
                		</div>
                	</div>
                </div>
                <!-- ======= Contrast End Here ========= -->
                <!-- ======= Measurement Start Here ========= -->
                <div role="tabpanel" class="tab-pane" id="etmeasurement">
                	<div class="pt-variation-main">
                		<div class="pt-variation">
                            <div id="menu-bodysize" class="pt-box-square" onClick="javascript:showMeasureSect('bodysize');">
                                <p>Body Size</p>
                            </div>
                            <div id="menu-standardsize" class="pt-box-square" onClick="javascript:showMeasureSect('standardsize');">
                                <p>Standard Sizes</p>
                            </div>
                		</div>
                	</div>
                	<div class="pt-customize">
                		<div class="pt-men">
                            <!-- Right Option Section -->
                			<div class="pt-choose-right et-measure-right">
                    			<div class="pt-thumb-slider">
                                    <div class="et-des-title">
                                        <h2>Great Choice!  Please Select Your Measurement Option</h2>
                                    </div>
                        			<div class="et-ment-option">
                                        <div class="et-body-size light-bg" onClick="javascript:showMeasureSect('bodysize');">
                                            <h2 class="un-bg">BODY SIZE</h2>
                                            <p>Part of the tailor-made experience is getting yourself measured up. With the assistance of our easy-to-follow video measuring guide, get yourself measured up in no time!</p>
                                            <span><a href="javascript:void(0);" onClick="javascript:showMeasureSect('bodysize');"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></a></span>
                                            <figure class="et-img"><img src="{{asset('demo/img/Measurement.png')}}" alt="">
                                            </figure>
                                        </div>
                                        <div class="et-standard-size light-bg" onClick="javascript:showMeasureSect('standardsize');">
                                            <h2 class="un-bg">Standard SIZES</h2>
                                            <p>Standard sizes provide an equally amazing fit. Select from an array of sizes from our standard size chart. Enjoy your Tailor-made product with the perfect combination of the right size and your creative style choices!</p>
                                            <span><a href="javascript:void(0);" onClick="javascript:showMeasureSect('standardsize');"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></a></span>
                                            <figure class="et-img"><img src="{{asset('demo/img/SML.png')}}" alt="">
                                            </figure>
                                        </div>
                                    </div>
                    			</div>
                			</div>
                            <!-- End Right Option Section -->

                            <!-- STANDARD SIZES -->
                            <div class="pt-choose-right et-main-body-size" id="menu-mesure-standardsize" style="display:none;">
                         		<div class="pt-thumb-slider">
                                	<div class="et-des-title"><h2>STANDARD SIZES</h2></div>
                                    <div class="et-main-measurement">
                                    	<form class="et-shirt-measure" role="form" method="POST" action="{{ url('/designvests/postcart') }}">
                                        	{{ csrf_field() }}
                                    	<div class="et-block et-vests-size">
                                        	<label>Vests Size :</label>
                                            <div class="et-btn-select">
                                                <select class="selectpicker btn-primary" id="cntrysize" name="cntrysize" onChange="javascript:changeCntrySize(this.value);">
                                                    <option value="1" selected>European Size</option>
                                                   <option value="2">American Size</option>
                                                </select>
                                            </div>
                                            <div class="et-btn-select" id="divsizefit">
                                                <select class="selectpicker btn-primary" id="sizefit" name="sizefit" onChange="javascript:changeSizeDetails();">
													<?php $measureeurolst = App\BodyMeasurment::select('*')->where('cat_id','=',3)->where('country_id','=',1)->orderBy('standardsize_id', 'asc')->get();?>
                                                    @foreach($measureeurolst as $eurosizelst)
                                                    <?php $stdeurosizelst = App\StandardSize::select('*')->where('id','=',$eurosizelst->standardsize_id)->get();?>
                                                    @foreach($stdeurosizelst as $stdeurolst)
                                                    <option value="{{$eurosizelst->id}}">{{$stdeurolst->value}}</option>
                                                    @endforeach
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <p class="et-orange">"The Measurements shown is garment size not body size,<br>this is the measurement from the suit itself (it includes ease/addition already)"</p>
                                        <p class="et-yellow">You are able to adjust Sleeve Length , Length and Waist for a Perfect fit!<br>These sizes can be changed below</p>
                                        <div class="et-block">
                                            <div class="et-measure-image">
                                                <figure>
                                                    <img src="{{asset('/storage/Measurment/Shirts/vlength/length.jpg')}}" alt="">
                                                </figure>
                                            </div>
                                            <div class="et-measure-video"><video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="{{asset('/storage/Measurment/Shirts/vlength/length.ogv')}}" type="video/ogg"><source src="{{asset('/storage/Measurment/Shirts/vlength/length.mp4')}}" type="video/mp4"><object data="{{asset('/storage/Measurment/Shirts/vlength/length.swf')}}" type="application/x-shockwave-flash" width="300" height="220"></object><source src="{{asset('/storage/Measurment/Shirts/vlength/length.webm')}}" type="video/webm"></video></div>
                                        </div>
                                        <div class="et-block et-common-lr">
                                        	<label class="pull-left">Vest</label>
                                        	<div class="et-radio-check pull-right">
                                                <div class="radio">
                                                    <label><input type="radio" name="sizetyp" id="sizetyp" value="cm" <?php if($eTailorObj['osizeType']=="cm"){?>checked<?php } ?> onClick="javascript:changeSizeDetails();"><span class="cr"><i class="cr-icon"></i></span>Cm</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="sizetyp" id="sizetyp" value="inch" <?php if($eTailorObj['osizeType']=="inch"){?>checked<?php } ?> onClick="javascript:changeSizeDetails();"><span class="cr"><i class="cr-icon"></i></span>Inch</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="et-common-size et-block">
                                        	<div class="et-type-Input">
                                                <div class="et-input">
                                                    <span>CHEST</span>
                                                    <p class="et-blue" id="vchest"></p>
                                                    <p class="et-tsize">Inch</p>
                                                    <input type="hidden" name="sizeChest" id="sizechest" value="">
                                            	</div>
                                                <div class="et-input">
                                                    <span>WAIST</span>
                                                    <p class="et-blue" id="vwaist"></p>
                                                    <p class="et-tsize">Inch</p>
                                                    <input type="hidden" name="sizeWaist" id="sizewaist" value="">
                                            	</div>
                                                <div class="et-input">
                                                    <span>HIP</span>
                                                    <p class="et-blue" id="vhip"></p>
                                                    <p class="et-tsize">Inch</p>
                                                    <input type="hidden" name="sizeHip" id="sizehip" value="">
                                            	</div>
                                                <div class="et-input">
                                                    <span>SHOULDERS</span>
                                                    <p class="et-blue" id="vshoulder"></p>
                                                    <p class="et-tsize">Inch</p>
                                                    <input type="hidden" name="sizeShoulder" id="sizeshoulder" value="">
                                            	</div>
                                                <div class="et-input">
                                                    <span>LENGTH</span>
                                                    <input type="text" name="sizeLength" id="sizelength" value="">
                                                    <p class="et-tsize">Inch</p>
                                              	</div>
                                            </div>
                                        </div>
                                        <div class="et-block et-form-btn">
                                            <a href="#" onClick="javascript:showMeasureSect('main');" class="et-blk-brn blue">Back To Design</a>
                                            <input type="hidden" name="setarr" id="setarr" value="">
                                            <input type="hidden" name="frntviewfinal" id="frntviewfinal">
                                            <input type="hidden" name="bkviewfinal" id="bkviewfinal">
                                            <input type="hidden" name="mpattern" value="Standard">
                                            <input type="hidden" name="selstdqty" value="1">
                                            <input type="hidden" name="hsizefit" id="hsizefit">
                                            <button type="sumbit" class="et-cart-brn">Add To Cart</button>
                                            <div class="et-btn-group">
                                                <h4 style="color:#f00; font-weight:bold;" class="vwprice">1 Vest: ${{$eTailorObj['ofabricPrice']}} </h4>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                        		</div>
                      		</div>
                            <!-- STANDARD SIZES END -->
                            <!-- BODY SIZES -->
                            <div class="pt-choose-right et-main-body-size" id="menu-mesure-bodysize" style="display:none;">
                         		<div class="pt-thumb-slider">
                                	<div class="et-des-title">
                                    	<h2>YOUR BODY SIZES</h2>
                                    </div>
                                    <div class="et-main-measurement">
                                    	<form class="et-shirt-measure" role="form" method="POST" action="{{ url('/designvests/postcart') }}" onSubmit="javascript:return validatebodyform();">
                                         {{ csrf_field() }}
                                        	<div class="et-block">
                                            	<div class="et-measure-image">
                                                	<figure>
                                                    	<img src="{{asset('/storage/Measurment/Shirts/neck/neck.jpg')}}" alt="">
                                                    </figure>
                                                </div>
                                                <div class="et-measure-video">
                                                	<video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__">
                                                    <source src="{{asset('/storage/Measurment/Shirts/neck/neck.ogv')}}" type="video/ogg">
                                                    <source src="{{asset('/storage/Measurment/Shirts/neck/neck.mp4')}}" type="video/mp4">
                                                    <object data="{{asset('/storage/Measurment/Shirts/neck/neck.swf')}}" type="application/x-shockwave-flash" width="300" height="220"></object>
                                                    <source src="{{asset('/storage/Measurment/Shirts/neck/neck.webm')}}" type="video/webm"></video>
                                                </div>
                                            </div>
                                            <div class="et-block no-pad">
                                            	<div class="et-subhead">
                                                	<span class="longarrow">
                                                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                                    </span>
                                                    <span>Vest <span id="fldtitle">Chest</span> generally range from <b><span id="rngfrom">28</span></b> to <b><span id="rngto">75</span></b> <span id="mtyp">inch</span></span>
                                                </div>
                                            	<div class="et-type-Input">
                                                    <div class="et-input">
                                                    	<span>CHEST</span>
                                                        <?php $measurechestlst = App\MeasurmentVideo::select('*')->where('cat_id','=',3)->where('id','=',15)->get();?>
                                                        @foreach($measurechestlst as $mchestlst)
                                                        <input type="text" data-title="{{$mchestlst->from_range}}-{{$mchestlst->to_range}}" name="bsizeChest" id="bsizeChest" onFocus="javascript:showRanges('{{$mchestlst->bodysize_type}}',{{$mchestlst->from_range}},{{$mchestlst->to_range}},'chest');" onBlur="javascript:validateField(this.id,{{$mchestlst->from_range}},{{$mchestlst->to_range}});" value="<?php echo $eTailorObj['osizeChest'];?>" style="border-color:#f00;">
                                                        @endforeach
                                                   	</div>
                                                    <div class="et-input">
                                                        <span>WAIST</span>
                                                        <?php $measurewaistlst = App\MeasurmentVideo::select('*')->where('cat_id','=',3)->where('id','=',16)->get();?>
                                                        @foreach($measurewaistlst as $mwaistlst)
                                                        <input type="text" data-title="{{$mwaistlst->from_range}}-{{$mwaistlst->to_range}}" name="bsizeWaist" id="bsizeWaist" onFocus="javascript:showRanges('{{$mwaistlst->bodysize_type}}',{{$mwaistlst->from_range}},{{$mwaistlst->to_range}},'waist');" onBlur="javascript:validateField(this.id,{{$mwaistlst->from_range}},{{$mwaistlst->to_range}});" value="<?php echo $eTailorObj['osizeWaist'];?>" >
                                                        @endforeach
                                                    </div>
                                                    <div class="et-input">
                                                        <span>HIP</span>
                                                        <?php $measurehiplst = App\MeasurmentVideo::select('*')->where('cat_id','=',3)->where('id','=',17)->get();?>
                                                        @foreach($measurehiplst as $mhiplst)
                                                        <input type="text" data-title="{{$mhiplst->from_range}}-{{$mhiplst->to_range}}" name="bsizeHip" id="bsizeHip" onFocus="javascript:showRanges('{{$mhiplst->bodysize_type}}',{{$mhiplst->from_range}},{{$mhiplst->to_range}},'hip');" onBlur="javascript:validateField(this.id,{{$mhiplst->from_range}},{{$mhiplst->to_range}});" value="<?php echo $eTailorObj['osizeHip'];?>" >
                                                        @endforeach
                                                    </div>
                                                    <div class="et-input">
                                                        <span>SHOULDER</span>
                                                        <?php $measureshoulderlst = App\MeasurmentVideo::select('*')->where('cat_id','=',3)->where('id','=',18)->get();?>
                                                        @foreach($measureshoulderlst as $mshoulderlst)
                                                        <input type="text" data-title="{{$mshoulderlst->from_range}}-{{$mshoulderlst->to_range}}" name="bsizeShoulder" id="bsizeShoulder" onFocus="javascript:showRanges('{{$mshoulderlst->bodysize_type}}',{{$mshoulderlst->from_range}},{{$mshoulderlst->to_range}},'shoulder');" onBlur="javascript:validateField(this.id,{{$mshoulderlst->from_range}},{{$mshoulderlst->to_range}});" value="<?php echo $eTailorObj['osizeShoulder'];?>" >
                                                        @endforeach
                                                    </div>
                                                    <div class="et-input">
                                                        <span>LENGTH</span>
                                                        <?php $measurelengthlst = App\MeasurmentVideo::select('*')->where('cat_id','=',3)->where('id','=',19)->get();?>
                                                        @foreach($measurelengthlst as $mlengthlst)
                                                        <input type="text" data-title="{{$mlengthlst->from_range}}-{{$mlengthlst->to_range}}" name="bsizeLength" id="bsizeLength" onFocus="javascript:showRanges('{{$mlengthlst->bodysize_type}}',{{$mlengthlst->from_range}},{{$mlengthlst->to_range}},'length');" onBlur="javascript:validateField(this.id,{{$mlengthlst->from_range}},{{$mlengthlst->to_range}});" value="<?php echo $eTailorObj['osizeLength'];?>" >
                                                        @endforeach
                                                    </div>
                									<div class="et-radio-check">
                           								<div class="radio">
                                                      		<label><input type="radio" name="bsizetyp" id="bsizetyp" value="cm" <?php if($eTailorObj['osizeType']=="cm"){?>checked<?php } ?>><span class="cr"><i class="cr-icon"></i></span>Cm</label>
                                                    	</div>
                                                        <div class="radio">
                                                      		<label><input type="radio" name="bsizetyp" id="bsizetyp" value="inch" <?php if($eTailorObj['osizeType']=="inch"){?>checked<?php } ?> ><span class="cr"><i class="cr-icon"></i></span>Inch</label>
                                                    	</div>
                									</div>
                                            	</div>
                                                <div class="et-block">
                                                	<div class="et-setect-fit">
                                                    	<ul>
                                                        	<li>
                                                            	<span class="longarrow">
                                                                	<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                                               	</span>
                                                                <span>Select Your Size :</span>
                                                            </li>
                                                        	<li>
                                                            	<div class="radio">
                                                                    <label><input type="radio" name="fitstyle" id="fitstyle" value="Comfortable" <?php if($eTailorObj['osizeStyle']=="Comfortable"){?> checked<?php }?> ><span class="cr"><i class="cr-icon"></i></span>Signature Standard Fit</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                            	<div class="radio">
                                                                    <label><input type="radio" name="fitstyle" id="fitstyle" value="Slim" <?php if($eTailorObj['osizeStyle']=="Slim"){?> checked<?php }?> ><span class="cr"><i class="cr-icon"></i></span>Euro Slim Fit</label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="et-block et-form-btn">
                                                	<a href="#" onClick="javascript:showMeasureSect('main');" class="et-blk-brn blue">Back To Design</a>
                                                    <input type="hidden" name="setarr" id="setarr" value="">
                                                    <input type="hidden" name="frntviewfinal" id="frntviewfinal">
                                                    <input type="hidden" name="bkviewfinal" id="bkviewfinal">
                                                    <input type="hidden" name="mpattern" value="Body">
                                                    <input type="hidden" name="selbodyqty" value="1">
                                                    <button type="sumbit" class="et-cart-brn">Add To Cart</button>
                                                    <div class="et-btn-group">
                                                    	<h4 style="color:#f00; font-weight:bold;" class="vwprice">1 Vest: ${{$eTailorObj['ofabricPrice']}} </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                        		</div>
                      		</div>
                            <!-- BODY SIZES END -->
                		</div>
                	</div>
                </div>
                <!-- ======= Measurement End Here ========= -->
            </div>
            <!-- Tab panes end -->
        </div>
    </div>
</div>
