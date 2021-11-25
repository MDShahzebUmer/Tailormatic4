
<div id="container_pants" class="row tab-container" style="display:none;">
    <?php $myArray=$ePantTailorObj;?>
    <input type="hidden" name="tabPantActiveId" id="tabPantActiveId" value="<?php echo $activeTab = isset($mypanttab) ? $mypanttab : 'etfabricpant'; ?>">
    <input type="hidden" name="tabPantSActiveId" id="tabPantSActiveId" value="<?php echo $activeSubTab = isset($mypantsubtab) ? $mypantsubtab : 'fabric15'; ?>">
    <input type="hidden" name="harrPant" id="harrPant" value="<?php echo htmlspecialchars(json_encode($myArray)); ?>">

    <div class="pt-tab">
        <div class="card">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="<?php echo (isset($mypanttab)&& $mypanttab == 'etfabricpant') ? 'active' : '' ?>" ><a href="#etfabricpant" aria-controls="fabric" role="tab" data-toggle="tab" onClick="javascript:getTabPantSect('etfabricpant');">1. FABRIC</a></li>
                <li role="presentation" class="<?php echo (isset($mypanttab)&& $mypanttab == 'etstylepant') ? 'active' : '' ?>"><a href="#etstylepant" aria-controls="style" role="tab" data-toggle="tab" onClick="javascript:getTabPantSect('etstylepant');"> 2. STYLE</a></li>
                <li role="presentation" class="<?php echo (isset($mypanttab) && $mypanttab == 'etcontrastpant') ? 'active' : '' ?>"><a href="#etcontrastpant" aria-controls="contrast" role="tab" data-toggle="tab" onClick="javascript:getTabPantSect('etcontrastpant');">3. COLOR CONTRAST</a></li>
                <li role="presentation" class="<?php echo (isset($mypanttab) && $mypanttab == 'etmeasurementpant') ? 'active' : '' ?>"><a href="#etmeasurementpant" aria-controls="settings" role="tab" data-toggle="tab" onClick="javascript:getTabPantSect('etmeasurementpant');">4. MEASUREMENTS</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
            	<!-- ======= Fabric Start Here ========= -->
                <div role="tabpanel" class="tab-pane" id="etfabricpant">
                    <div class="pt-variation-main">
                        <div class="pt-variation">
                        	@foreach($group_pant_record as $gr)
                          	<div id="menu-fabric{{$gr->id}}" class="pt-box-square <?php if($gr->id == $ePantTailorObj['ofabricType']) {?>active<?php } ?>" onClick="javascript:getPgPantOption(this.id,'etfabricpant','{{$gr->id}}','menu-fabric');">
                                <p>{{$gr->fbgrp_name}}</p>
                               <?php
								if($gr->fabric_offer_price != 0 && $gr->fabric_offer_price != '')
								{
									$frate = $gr->fabric_offer_price;
								}else{
									$frate =    $gr->fabric_rate;
								}
								?>
                                <p>${{number_format($frate,2)}}</P>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="pt-customize">
                        <div class="pt-men">
                        	<!-- Main Preview -->
                            <div class="pt-men-left" id="main-front-etfabricpant"><div class="m-image pt-pantimage-div">@include('pants.process')<img src="{{asset('demo/img/product/blank.png')}}" alt=""/></div><div class="pt-price-shirt"><span class="pt-sht"> Pant {1 Pant} </span><br><span class="pt-dollor">${{$ePantTailorObj['ofabricPrice']}}</span><br><a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainBackPant('etfabricpant');">BACK VIEW</a></div></div>
                            <div class="pt-men-left" id="main-back-etfabricpant" style="display:none;"><div class="m-image pt-pantimage-div">@include('pants.process')<img src="{{asset('demo/img/product/blank.png')}}" alt=""/></div><div class="pt-price-shirt"><span class="pt-sht"> Pant {1 Pant} </span><br><span class="pt-dollor">${{$ePantTailorObj['ofabricPrice']}}</span><br><a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainFrontPant('etfabricpant');">FRONT VIEW</a></div></div>
                            <!-- End Main Preview -->
                            <!-- Right Option Section -->
                            <div class="pt-choose-right">
                                <div class="pt-thumb-slider">
                                    <div class="pt-pagination">
                                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                        <span id="menuopttitle-etfabricpant">Choose Your Fabric : </span>
                                    </div>
                                    <!-- Fabric of the Week -->
                                    <div class="carousel-container">
                                        @foreach($group_pant_record as $gr)
                                        <div class="et-carousel" id="menu-opt-fabric{{$gr->id}}" <?php if($gr->id == $ePantTailorObj['ofabricType']) {?>style="display:block;"<?php } else {?>style="display:none;"<?php } ?> >
                                            <div id="et-carousel-item-fabric{{$gr->id}}" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false">
                                                <div class="carousel-inner" role="listbox">
                                                    <div class="item active">
                                                        <ul class="et-item-list">
                                                        	<?php $ci=1; $fabriclst = App\Etfabric::select('*')->where('fbgrp_id','=',$gr->id)->where('fabric_status','=','1')->whereRaw('fabric_qty > fabric_min_qty')->get();?>
                                        					@foreach($fabriclst as $fablst)
                                                            <?php if($ci==7){?></ul></div><div class="item"><ul class="et-item-list"><?php  $ci=1;}?>
                                                            <li class="et-item" id="optionlist-fabric{{$gr->id}}-{{$fablst->id}}" title="{{ $fablst->fabric_name }}" data-title="{{ $fablst->fabric_name }}" onClick="javascript:getpantfab({{$fablst->id}},'etfabricpant');">
                                                                <figure class="et-item-img"><img src="{{asset('/storage/'.$fablst->fabric_img_s)}}" alt="{{$alt_name}}" ></figure>
                                                                @if($fablst->id==$ePantTailorObj['ofabric'])
                                                                <div class="icon-check"></div>
                                                                @endif
                                                            </li>
                                                            <?php $ci++;?>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!--======= Navigation Buttons =========-->
                                                <!--======= Left Button =========-->
                                                <a class="left carousel-control gp_products_carousel_control_left" href="#et-carousel-item-fabric{{$gr->id}}" role="button" data-slide="prev"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="{{asset('demo/img/ar-left.png')}}" alt=""></span><span class="sr-only">Previous</span></a>
                                                <!--======= Right Button =========-->
                                                <a class="right carousel-control gp_products_carousel_control_right" href="#et-carousel-item-fabric{{$gr->id}}" role="button" data-slide="next"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="{{asset('demo/img/ar-right.png')}}" alt=""></span><span class="sr-only">Next</span></a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <!--  Mini Preview Section -->
                                    <div class="et-progress-des" id="preview-etfabricpant">
                                        <div class="et-content-fab">
                                            <figure class="et-fab-img"><img src="{{asset('/storage/'.$ePantTailorObj["ofabricImage"])}}" alt="{{$alt_name}}" ></figure>
                                            <div class="et-fab-box">
                                            	<h3>{{$ePantTailorObj['ofabricDesc']}}</h3>
                                                <span>{{$ePantTailorObj['ofabricName']}}</span>
                                                <span>Fit-Guaranteed Price<img src="{{asset('demo/img/product/info.png')}}" alt="{{$alt_name}}" ></span>
                                                <h3><a href="#" data-toggle="modal" data-target="#fabric-id">Zoom</a></h3>
                                            </div>
                                        </div>
                                        <div class="et-next-back">
                                            <ul><li class="et-prev"><a href="#" onClick="javascript:navigatepantback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatepantnext();">Next</a></li></ul>
                                        </div>
                                        <!-- --------------------------------------Product Modal Section----------------------------- -->
                                        <div class="modal fade et-fabric-modal" id="fabric-id" tabindex="-1" role="dialog" aria-labelledby="fabric-modal">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <div class="modal-body">
                                                        <figure class="et-fabric-big"><img src="{{asset('/storage/'.$ePantTailorObj['ofabricImage'])}}" alt="{{$alt_name}}" ></figure>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  End Mini Preview Section -->
                                    <!-- Shopping Cart -->
                                    <div class="et-checkout-box">
                                        @include('threepiece.shopping')
                                    </div>
                                    <!-- End Shopping Cart -->
                                </div>
                            </div>
                    	</div>
                    </div>
                </div>
                <!-- ======= Fabric End Here ========= -->
                <!-- ======= Style Start Here ========= -->
                <div role="tabpanel" class="tab-pane" id="etstylepant">
                    <div class="pt-variation-main">
                        <div class="pt-variation">
                        	<?php $smi=1;?>
                        	@foreach($mainattr_pant_record as $mattr)
                            <div id="menu-{{$mattr->id}}" class="pt-box-square <?php if($mattr->id=='48'){?>active<?php } ?>" onClick="javascript:getPgPantOption(this.id,'etstylepant','{{$mattr->id}}','{{$mattr->attribute_name}}');" >
                                <p>2.{{$smi}}  {{$mattr->attribute_name}}</p>
                            </div>
                            <?php $smi++;?>
                            @endforeach
                        </div>
                    </div>
                	<div class="pt-customize">
                		<div class="pt-men">
                        	<!-- Main Preview -->
                			<div class="pt-men-left" id="main-front-etstylepant"><div class="m-image pt-pantimage-div">@include('pants.process')<img src="{{asset('demo/img/product/blank.png')}}" alt=""/></div><div class="pt-price-shirt"><span class="pt-sht"> Pant {1 Pant} </span><br><span class="pt-dollor">${{$ePantTailorObj['ofabricPrice']}}</span><br><a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainBackPant('etstylepant');">BACK VIEW</a></div></div>
                            <div class="pt-men-left" id="main-back-etstylepant" style="display:none;"><div class="m-image pt-pantimage-div">@include('pants.process')<img src="{{asset('demo/img/product/blank.png')}}" alt=""/></div><div class="pt-price-shirt"><span class="pt-sht"> Pant {1 Pant} </span><br><span class="pt-dollor">${{$ePantTailorObj['ofabricPrice']}}</span><br><a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainFrontPant('etstylepant');">FRONT VIEW</a></div></div>
                            <!-- End Main Preview -->
                            <!-- Right Option Section -->
                            <div class="pt-choose-right">
                                <div class="pt-thumb-slider">
                                    <div class="pt-pagination">
                                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                        <span id="menuopttitle-etstylepant">Choose Your Pant Style : </span>
                                    </div>
                                    <div id="fullstyle">
                                    <!-- Menu Sleeves -->
                                    <div class="carousel-container">
                                        @foreach($mainattr_pant_record as $mattr)
                                        <div class="et-carousel" id="menu-opt-{{$mattr->id}}">
                                            <div id="et-style-item-{{$mattr->id}}" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false">
                                                <div class="carousel-inner" role="listbox">
                                                    <div class="item active">
                                                    	<ul class="et-item-list">
                                                        	@if($mattr->id=="50")
                                                            <?php $stylci=1; $stylelst = App\AttributeStyle::select('*')->where('attri_id','=',$mattr->id)->get(); ?>
                                        					@foreach($stylelst as $styllst)
                                                            <?php if($stylci==7){?></ul></div><div class="item"><ul class="et-item-list"><?php  $stylci=1;}?>
                                                            @if(($styllst->id==112 || $styllst->id==113) && $ePantTailorObj['opleat']==102)
                                                            <li class="et-item" id="optionlist-{{$mattr->id}}-{{$styllst->id}}" data-title="{{$styllst->style_name}}" title="{{$styllst->style_name}}" onClick="javascript:getpantstyles({{$styllst->id}},'{{$mattr->id}}','etstylepant');">
                                                            	<?php $styleimglst = App\Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $ePantTailorObj['ofabric'])->get();?>
                                                                    @foreach($styleimglst as $ls)
                                                                    <figure class="et-item-img"><img class="et-main-list-img" src="{{asset('/storage/'.$ls->list_img)}}" alt="{{$alt_name}}" ></figure>
                                                                    @if($mattr->id==50)
                                                                    	@if($styllst->id == $ePantTailorObj['opacket'])
                                                                        <div class="icon-check"></div>
                                                                        @endif
                                                                    @endif
                                                                    @endforeach
                                                            </li>
                                                            @elseif($styllst->id==108 || $styllst->id==109 || $styllst->id==110 || $styllst->id==111)
                                                            <li class="et-item" id="optionlist-{{$mattr->id}}-{{$styllst->id}}" data-title="{{$styllst->style_name}}" title="{{$styllst->style_name}}" onClick="javascript:getpantstyles({{$styllst->id}},'{{$mattr->id}}','etstylepant');">
                                                            	<?php $styleimglst = App\Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $ePantTailorObj['ofabric'])->get();?>
                                                                    @foreach($styleimglst as $ls)
                                                                    <figure class="et-item-img"><img class="et-main-list-img" src="{{asset('/storage/'.$ls->list_img)}}" alt="{{$alt_name}}" ></figure>
                                                                     @if($mattr->id==50)
                                                                    	@if($styllst->id == $ePantTailorObj['opacket'])
                                                                        <div class="icon-check"></div>
                                                                        @endif
                                                                    @endif
                                                                    @endforeach
                                                            </li>
                                                            @endif
                                                            <?php $stylci++;?>
                                                            @endforeach
                                                            @else
                                                            <?php $stylci=1; $stylelst = App\AttributeStyle::select('*')->where('attri_id','=',$mattr->id)->get(); ?>
                                        					@foreach($stylelst as $styllst)
                                                            <?php if($stylci==7){?></ul></div><div class="item"><ul class="et-item-list"><?php  $stylci=1;}?>
                                                            <li class="et-item" id="optionlist-{{$mattr->id}}-{{$styllst->id}}" data-title="{{$styllst->style_name}}" title="{{$styllst->style_name}}" onClick="javascript:getpantstyles({{$styllst->id}},'{{$mattr->id}}','etstylepant');">
                                                            	<?php $styleimglst = App\Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $ePantTailorObj['ofabric'])->get();?>
                                                                    @foreach($styleimglst as $ls)
                                                                    <figure class="et-item-img"><img class="et-main-list-img" src="{{asset('/storage/'.$ls->list_img)}}" alt="{{$alt_name}}" ></figure>
                                                                    @if($mattr->id==48)
                                                                    	@if($styllst->id == $ePantTailorObj['ostyle'])
                                                                        <div class="icon-check"></div>
                                                                        @endif
                                                                    @elseif($mattr->id==49)
                                                                    	@if($styllst->id == $ePantTailorObj['opleat'])
                                                                        <div class="icon-check"></div>
                                                                        @endif
                                                                    @elseif($mattr->id==51)
                                                                    	@if($styllst->id == $ePantTailorObj['obackpockt'])
                                                                        <div class="icon-check"></div>
                                                                        @endif
                                                                    @elseif($mattr->id==52)
                                                                    	@if($styllst->id == $ePantTailorObj['obeltloop'])
                                                                        <div class="icon-check"></div>
                                                                        @endif
                                                                    @elseif($mattr->id==53)
                                                                    	@if($styllst->id == $ePantTailorObj['ocuff'])
                                                                        <div class="icon-check"></div>
                                                                        @endif
                                                                    @endif
                                                                    @endforeach
                                                            </li>
                                                            <?php $stylci++;?>
                                                            @endforeach
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- ======= Navigation Buttons ========= -->
                                                <!-- ======= Left Button ========= -->
                                                <a class="left carousel-control gp_products_carousel_control_left" href="#et-style-item-{{$mattr->id}}" role="button" data-slide="prev"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="{{asset('demo/img/ar-left.png')}}" alt=""></span><span class="sr-only">Previous</span></a>
                                                <!-- ======= Right Button ========= -->
                                                <a class="right carousel-control gp_products_carousel_control_right" href="#et-style-item-{{$mattr->id}}" role="button" data-slide="next"><span class="gp_products_carousel_control_icons" aria-hidden="true"><img src="{{asset('demo/img/ar-right.png')}}" alt=""></span><span class="sr-only">Next</span></a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <!--  Mini Preview Section -->
                                    <div class="et-progress-des et-style-bg">
                                        <div class="et-content-fab " id="miniview-etstylepant-48">
                                            <figure class="et-selected-img et-selected-full"><img src="{{asset('demo/img/product/blank.png')}}" alt=""></figure>
                                            <div class="et-style-select">
                                                <h2>{{$ePantTailorObj['ostyleName']}}</h2><p>Classic,All Time,Business</p>
                                            </div>
                                        </div>
                                        <div class="et-content-fab jacket-lapel-bg" id="miniview-etstylepant-49" style="display:none;background-image: url({{asset('demo/img/product/blank.png')}});">
                                            <div class="et-style-select">
                                                <h2>{{$ePantTailorObj['opleatName']}}</h2><p>Classic,All Time,Business</p>
                                            </div>
                                        </div>
                                        <div class="et-content-fab jacket-lapel-bg" id="miniview-etstylepant-50" style="display:none;background-image: url({{asset('demo/img/product/blank.png')}});">
                                            <div class="et-style-select">
                                                <h2>{{$ePantTailorObj['opacketName']}}</h2><p>Classic,All Time,Business</p>
                                            </div>
                                        </div>
                                        <div class="et-content-fab jacket-pocket-bg jacket-pocket-bg-1" id="miniview-etstylepant-51" style="display:none;background-image: url({{asset('demo/img/product/blank.png')}});">
                                            <div class="et-style-select">
                                                <h2>Back Pockets</h2><p>{{$ePantTailorObj['obackpocktName']}}</p>
                                                <div class="radio">
                                                    <label><input type="radio" name="pocktsidetxt" id="pocktsidetxt1" value="left" <?php if($ePantTailorObj['obackpocktSide']=="left"){?>checked<?php } ?> onClick="javascript:getpantseloptions('left','PocketSide','51','etstylepant');"><span class="cr"><i class="cr-icon"></i></span> Left </label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="pocktsidetxt" id="pocktsidetxt2" value="right" <?php if($ePantTailorObj['obackpocktSide']=="right"){?>checked<?php } ?> onClick="javascript:getpantseloptions('right','PocketSide','51','etstylepant');"> <span class="cr"><i class="cr-icon"></i></span> Right </label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="pocktsidetxt" id="pocktsidetxt3" value="both" <?php if($ePantTailorObj['obackpocktSide']=="both"){?>checked<?php } ?> onClick="javascript:getpantseloptions('both','PocketSide','51','etstylepant');"> <span class="cr"><i class="cr-icon"></i></span> Both</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="et-content-fab jacket-lapel-bg" id="miniview-etstylepant-52" style="display:none; background-image: url({{asset('demo/img/product/blank.png')}});"">
                                            <div class="et-style-select">
                                                <h2>Belt Loop and Waistband</h2>
                                                <p>{{$ePantTailorObj['obeltloopName']}}</p>
                                                <span>Waistband Edge</span>
                                                <div class="radio">
                                                    <label><input type="radio" name="waistbandtxt" id="waistbandtxt1" value="normal" <?php if($ePantTailorObj['owaistbandedge']=="normal"){?>checked<?php } ?> onClick="javascript:getpantseloptions('normal','WaistEdge','52','etstylepant');"> <span class="cr"><i class="cr-icon"></i></span>Normal</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="waistbandtxt" id="waistbandtxt2" value="round" <?php if($ePantTailorObj['owaistbandedge']=="round"){?>checked<?php } ?> onClick="javascript:getpantseloptions('round','WaistEdge','52','etstylepant');"><span class="cr"><i class="cr-icon"></i></span>Round</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="waistbandtxt" id="waistbandtxt3" value="square" <?php if($ePantTailorObj['owaistbandedge']=="square"){?>checked<?php } ?> onClick="javascript:getpantseloptions('square','WaistEdge','52','etstylepant');"><span class="cr"><i class="cr-icon"></i></span>Square</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="et-content-fab pant-style" id="miniview-etstylepant-53" style="display:none;">
                                        	<figure class="et-selected-img et-selected-full">
                                            	@if($ePantTailorObj['ocuff']=="125")
                                                <img src="{{asset('storage/Pants/Style/Cuffs/Regular/Show/'.$ePantTailorObj['ofabric'].'.png')}}" alt="">
                                                @elseif($ePantTailorObj['ocuff']=="126")
                                                <img src="{{asset('storage/Pants/Style/Cuffs/Cuff/Show/'.$ePantTailorObj['ofabric'].'.png')}}" alt="">
                                                @elseif($ePantTailorObj['ocuff']=="127")
                                                <img src="{{asset('storage/Pants/Style/Cuffs/SingleTabs/Show/'.$ePantTailorObj['ofabric'].'.png')}}" alt="">
                                                <img src="{{asset('storage/Pants/Style/Cuffs/SingleTabs/Button/ShowImg/'.$ePantTailorObj['obutton'].'.png')}}" alt="">
                                                @elseif($ePantTailorObj['ocuff']=="128")
                                                <img src="{{asset('storage/Pants/Style/Cuffs/DoubleTabs/Show/'.$ePantTailorObj['ofabric'].'.png')}}" alt="">
                                                <img src="{{asset('storage/Pants/Style/Cuffs/DoubleTabs/Button/ShowImg/'.$ePantTailorObj['obutton'].'.png')}}" alt="">
                                                @elseif($ePantTailorObj['ocuff']=="129")
                                                <img src="{{asset('storage/Pants/Style/Cuffs/FoldoverTabs/Show/'.$ePantTailorObj['ofabric'].'.png')}}" alt="">
                                                <img src="{{asset('storage/Pants/Style/Cuffs/FoldoverTabs/Button/ShowImg/'.$ePantTailorObj['obutton'].'.png')}}" alt="">
                                                @endif
                                            </figure>
                                            <div class="et-style-select">
                                                <h2>{{$ePantTailorObj['ocuffName']}}</h2>
                                                @if($ePantTailorObj['ocuff']!="125")
                                                <p>If you choose Double Cuff style the Pant Length measurement that you measure has to be very accurate as double cuff styles the Length of Pants can not be adjusted,for new customers we suggest regular cuffs as it is very easy to adjust with your tailor locally.</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="et-next-back">
                                            <ul><li class="et-prev"><a href="#" onClick="javascript:navigatepantback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatepantnext();">Next</a></li></ul>
                                        </div>
                                    </div>
                                    <!-- End Mini Preview Section -->
                                    </div>
                                    <!-- Shopping Cart -->
                                    <div class="et-checkout-box">
                                        @include('threepiece.shopping')
                                    </div>
                                    <!-- End Shopping Cart -->
                                </div>
                            </div>
                		</div>
                	</div>
                </div>
                <!-- ======= Style End Here ========= -->
                <!-- ======= Contrast Start Here ========= -->
                <div role="tabpanel" class="tab-pane contrast-content" id="etcontrastpant">
                	<div class="pt-variation-main">
                		<div class="pt-variation">
                        	<?php $cmi=1;?>
                            @foreach($contrast_pant_record as $contlst)
                            <div id="menu-{{$contlst->id}}" class="pt-box-square <?php if($contlst->id=='54'){?>active<?php } ?>" onClick="javascript:getPgPantOption(this.id,'etcontrastpant','{{$contlst->id}}','{{$contlst->attribute_name}}');" >
                            <p>3.{{$cmi}}  {{$contlst->attribute_name}}</p>
                            </div>
                            <?php $cmi++;?>
                            @endforeach
                		</div>
                	</div>
                	<div class="pt-customize">
                		<div class="pt-men">
                        	<!-- Main Preview -->
                            <!-- FRONT VIEW -->
                			<div class="pt-men-left" id="main-front-etcontrastpant" style="display:none;"><div class="m-image pt-pantimage-div">@include('pants.process')<img src="{{asset('demo/img/product/blank.png')}}" alt=""/></div><div class="pt-price-shirt"><span class="pt-sht"> Pant {1 Pant} </span><br><span class="pt-dollor">${{$ePantTailorObj['ofabricPrice']}}</span><br><a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainBackPant('etcontrastpant');">BACK VIEW</a></div></div>
                            <!-- BACK VIEW -->
                            <div class="pt-men-left" id="main-back-etcontrastpant" style="display:none;"><div class="m-image pt-pantimage-div">@include('pants.process')<img src="{{asset('demo/img/product/blank.png')}}" alt=""/></div><div class="pt-price-shirt"><span class="pt-sht"> Pant {1 Pant} </span><br><span class="pt-dollor">${{$ePantTailorObj['ofabricPrice']}}</span><br><a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainFrontPant('etcontrastpant');">FRONT VIEW</a></div></div>
                            <!-- End Main Preview -->
                            <!-- Right Option Section -->
                			<div class="pt-choose-right">
                    			<div class="pt-thumb-slider">
                                    <div class="pt-pagination no-pad-left">
                                        <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                        <span id="menuopttitle-etcontrastpant">Choose Your Contrast Fabric : </span>
                                    </div>
                                    <!-- Menu Contrast -->
                                    <div class="carousel-container">
                                        @foreach($contrast_pant_record as $contlst)
                                        @if($contlst->id == '54')
                            			<div class="et-sm-carousel" id="menu-opt-{{$contlst->id}}" style="display:none">
                                			<div class="et-contrast-list">
                                                <ul class="et-item-list">
                                                	<?php $contfablst = App\Contrast::select('*')->where('cat_id','=',4)->get(); ?>
    												@foreach($contfablst as $cfablst)
                                                    <li class="et-item" id="optionlist-{{$contlst->id}}-{{$cfablst->id}}" data-title="{{$cfablst->contrsfab_name}}" title="{{$cfablst->contrsfab_name}}" onClick="javascript:getpantcontrast({{$cfablst->id}},'etcontrastpant');">
                                                        <figure class="et-item-img"><img src="{{asset('/storage/'.$cfablst->contrsfab_img)}}" alt="{{$alt_name}}" ></figure>
                                                        @if($cfablst->id==$ePantTailorObj['ocontrast'])
                                                        <div class="icon-check"></div>
                                                        @endif
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        @elseif($contlst->id == '55')
                                        <div class="et-sm-carousel" id="menu-opt-{{$contlst->id}}" style="display:none">
                                			<div class="et-contrast-list">
                                                <ul class="et-item-list">
                                                	<?php $buttonlst = App\Button::select('*')->where('cat_id','=',4)->get(); ?>
    												@foreach($buttonlst as $bttnlst)
                                                    <li class="et-item" id="optionlist-{{$contlst->id}}-{{$bttnlst->id}}" data-title="{{$bttnlst->button_name}}" title="{{$bttnlst->button_name}}" onClick="javascript:getpantbuttons({{$bttnlst->id}},'etcontrastpant')">
                                                        <figure class="et-item-img"><img src="{{asset('/storage/'.$bttnlst->button_img)}}" alt="{{$bttnlst->button_name}}"></figure>
                                                        @if($bttnlst->id==$ePantTailorObj['obutton'])
                                                        <div class="icon-check"></div>
                                                        @endif
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <!-- Threads -->
                                            <div class="pt-pagination no-pad-left"><span>B. Choose Your Button Hole Thread</span></div>
                                            <div class="et-contrast-list">
                                                <ul class="et-item-list">
                                                	<?php $contthrdlst = App\Thread::select('*')->where('cat_id','=',4)->get(); ?>
    												@foreach($contthrdlst as $cthreadlst)
                                                    <li class="et-item" id="optionlist-thrd-{{$cthreadlst->id}}" data-title="{{$cthreadlst->thrd_name}}" title="{{$cthreadlst->thrd_name}}" onClick="javascript:getpantthread({{$cthreadlst->id}},'etcontrastpant');">
                                                        <figure class="et-item-img"><img src="{{asset('/storage/'.$cthreadlst->thrd_img)}}" alt="{{$alt_name}}" ></figure>
                                                        @if($cthreadlst->id==$ePantTailorObj['obuttonHole'])
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
                            			<div class="et-content-fab jacket-pocket-bg jacket-pocket-bg-1" id="miniview-etcontrastpant-54" >
                                			<div class="et-style-select">
                                                <h2>Contrast Fabric</h2>
                                                <div class="et-check-box">
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="beltlooptxt" id="beltlooptxt" value="true" <?php if($ePantTailorObj['ocontbeltloop']=="true"){?>checked<?php } ?> onClick="javascript:getpantseloptions({{$ePantTailorObj['ocontbeltloop']}},'BeltLoop','54','etcontrastpant');"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Belt Loops</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="backpocketstxt" id="backpocketstxt" value="true" <?php if($ePantTailorObj['ocontbackpockets']=="true"){?>checked<?php } ?> onClick="javascript:getpantseloptions({{$ePantTailorObj['ocontbackpockets']}},'BackPockets','54','etcontrastpant');"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Back Pockets</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="et-content-fab jacket-lapel-bg" id="miniview-etcontrastpant-55" style="display:none;">
                                			<div class="et-style-select">
                                                <h2>Jacket Button</h2><p>{{$ePantTailorObj['obuttonName']}}</p>
                                            </div>
                                        </div>
                                        <div class="et-next-back">
                                            <ul><li class="et-prev"><a href="#" onClick="javascript:navigatepantback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatepantnext();">Next</a></li></ul>
                                        </div>
                        			</div>
                                    <!--  End Mini Preview Section -->
                                    <!-- Shopping Cart -->
                        			<div class="et-checkout-box">
                                        @include('threepiece.shopping')
                        			</div>
                                    <!-- End Shopping Cart -->
                    			</div>
                			</div>
                		</div>
                	</div>
                </div>
                <!-- ======= Contrast End Here ========= -->
                <!-- ======= Measurement Start Here ========= -->
                <div role="tabpanel" class="tab-pane" id="etmeasurementpant">
                	<div class="pt-variation-main">
                		<div class="pt-variation">
                            <div id="menu-pant-bodysize" class="pt-box-square" onClick="javascript:showPantMeasureSect('bodysize');"><p>Body Size</p></div>
                            <div id="menu-pant-standardsize" class="pt-box-square" onClick="javascript:showPantMeasureSect('standardsize');"><p>Standard Sizes</p></div>
                		</div>
                	</div>
                	<div class="pt-customize">
                		<div class="pt-men">
                        	<!-- Main Preview -->
                            <div id="menu-mesure-pant-main" style="display:block;">
                            <div class="pt-men-left et-measure-left" id="main-front-etmeasurementpant"><div class="m-image pt-pantimage-div"><img src="{{asset('demo/img/product/blank.png')}}" alt=""/></div><div class="pt-price-shirt"><a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainBackPant('etmeasurementpant');" >BACK VIEW</a></div></div>
                            <div class="pt-men-left et-measure-left" id="main-back-etmeasurementpant" style="display:none;"><div class="m-image pt-pantimage-div"><img src="{{asset('demo/img/product/blank.png')}}" alt=""/></div><div class="pt-price-shirt"><a href="javascript:void(0);" class="pt-back-btn" onClick="javascript:viewMainFrontPant('etmeasurementpant');" >FRONT VIEW</a></div></div>
                            <!-- End Main Preview -->
                            <!-- Right Option Section -->
                			<div class="pt-choose-right et-measure-right">
                    			<div class="pt-thumb-slider">
                                    <div class="et-des-title">
                                        <h2>Great Choice!  Please Select Your Measurement Option</h2>
                                    </div>
                        			<div class="et-ment-option">
                                        <div class="et-body-size light-bg" onClick="javascript:showPantMeasureSect('bodysize');">
                                            <h2 class="un-bg">BODY SIZE</h2>
                                            <p>Part of the tailor-made experience is getting yourself measured up. With the assistance of our easy-to-follow video measuring guide, get yourself measured up in no time!</p>
                                            <span><a href="javascript:void(0);" onClick="javascript:showPantMeasureSect('bodysize');"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></a></span>
                                            <figure class="et-img"><img src="{{asset('demo/img/Measurement.png')}}" alt=""></figure>
                                        </div>
                                        <div class="et-standard-size light-bg" onClick="javascript:showPantMeasureSect('standardsize');">
                                            <h2 class="un-bg">Standard SIZES</h2>
                                            <p>Standard sizes provide an equally amazing fit. Select from an array of sizes from our standard size chart. Enjoy your Tailor-made product with the perfect combination of the right size and your creative style choices!</p>
                                            <span><a href="javascript:void(0);" onClick="javascript:showPantMeasureSect('standardsize');"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></a></span>
                                            <figure class="et-img"><img src="{{asset('demo/img/SML.png')}}" alt=""></figure>
                                        </div>
                                    </div>
                        			<div class="et-checkout-box">
                                        @include('threepiece.shopping')
                                    </div>
                    			</div>
                			</div>
                            <!-- End Right Option Section -->
                            </div>
                            <!-- STANDARD SIZES -->
                            <div class="pt-choose-right et-main-body-size" id="menu-mesure-pant-standardsize" style="display:none;">
                         		<div class="pt-thumb-slider">
                                	<div class="et-des-title"><h2>STANDARD SIZES</h2></div>
                                    <div class="et-main-measurement">
                                    	<form class="et-shirt-measure" role="form" method="POST" action="{{ url('/designpants/postcart') }}">
                                        	{{ csrf_field() }}
                                    	<div class="et-block et-vests-size">
                                        	<label>Pants Size :</label>
                                            <div class="et-btn-select">
                                                <select class="selectpicker btn-primary" id="cntrysize" name="cntrysize" onChange="javascript:changePantCntrySize(this.value);"><option value="1" selected>European Size</option><option value="2">UK/American Size</option></select>
                                            </div>
                                            <div class="et-btn-select" id="divsizefit">
                                                <select class="selectpicker btn-primary" id="sizefit" name="sizefit" onChange="javascript:changePantSizeDetails();">
													<?php $measureeurolst = App\BodyMeasurment::select('*')->where('cat_id','=',4)->where('country_id','=',1)->orderBy('standardsize_id', 'asc')->get();?>
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
                                                <figure><img src="{{asset('/storage/Measurment/Shirts/plength/length.jpg')}}" alt=""></figure>
                                            </div>
                                            <div class="et-measure-video"><video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="{{asset('/storage/Measurment/Shirts/plength/length.ogv')}}" type="video/ogg"><source src="{{asset('/storage/Measurment/Shirts/plength/length.mp4')}}" type="video/mp4"><object data="{{asset('/storage/Measurment/Shirts/plength/length.swf')}}" type="application/x-shockwave-flash" width="300" height="220"></object><source src="{{asset('/storage/Measurment/Shirts/plength/length.webm')}}" type="video/webm"></video></div>
                                        </div>
                                        <div class="et-block et-common-lr">
                                        	<label class="pull-left">Pant</label>
                                        	<div class="et-radio-check pull-right">
                                                <div class="radio">
                                                    <label><input type="radio" name="sizetyp" id="sizetyp" value="cm" <?php if($ePantTailorObj['osizeType']=="cm"){?>checked<?php } ?> onClick="javascript:changePantSizeDetails();"><span class="cr"><i class="cr-icon"></i></span> Cm </label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="sizetyp" id="sizetyp" value="inch" <?php if($ePantTailorObj['osizeType']=="inch"){?>checked<?php } ?> onClick="javascript:changePantSizeDetails();"><span class="cr"><i class="cr-icon"></i></span> Inch </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="et-common-size et-block">
                                        	<div class="et-type-Input">
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
                                                    <span>CROTCH</span>
                                                    <p class="et-blue" id="vcrotch"></p>
                                                    <p class="et-tsize">Inch</p>
                                                    <input type="hidden" name="sizeCrotch" id="sizecrotch" value="">
                                            	</div>
                                                <div class="et-input">
                                                    <span>THIGH</span>
                                                    <p class="et-blue" id="vthigh"></p>
                                                    <p class="et-tsize">Inch</p>
                                                    <input type="hidden" name="sizeThigh" id="sizethigh" value="">
                                              	</div>
                                                <div class="et-input">
                                                    <span>LENGTH</span>
                                                    <input type="text" name="sizeLength" id="sizelength" value="">
                                                    <p class="et-tsize">Inch</p>
                                              	</div>
                                            </div>
                                        </div>
                                        <div class="et-block et-form-btn">
                                            <a href="#" onClick="javascript:showPantMeasureSect('main');" class="et-blk-brn blue">Back To Design</a>
                                            <input type="hidden" name="setarr" id="setarr" value="">
                                            <input type="hidden" name="frntviewfinal" id="frntviewfinal">
                                            <input type="hidden" name="bkviewfinal" id="bkviewfinal">
                                            <input type="hidden" name="mpattern" value="Standard">
                                            <input type="hidden" name="selstdqty" value="1">
                                            <input type="hidden" name="hsizefit" id="hsizefit">
                                            <button type="sumbit" class="et-cart-brn">Add To Cart</button>
                                            <div class="et-btn-group">
                                                <h4 style="color:#f00; font-weight:bold;" class="vwprice">1 Pant: ${{$ePantTailorObj['ofabricPrice']}} </h4>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                    <div class="et-checkout-box">
                                    	@include('threepiece.shopping')
                                    </div>
                        		</div>
                      		</div>
                            <!-- STANDARD SIZES END -->
                            <!-- BODY SIZES -->
                            <div class="pt-choose-right et-main-body-size" id="menu-mesure-pant-bodysize" style="display:none;">
                         		<div class="pt-thumb-slider">
                                	<div class="et-des-title"><h2>YOUR BODY SIZES</h2></div>
                                    <div class="et-main-measurement">
                                    	<form class="et-shirt-measure" role="form" method="POST" action="{{ url('/designpants/postcart') }}" onSubmit="javascript:return validatepantbodyform();">
                                         {{ csrf_field() }}
                                        	<div class="et-block">
                                            	<div class="et-measure-image"><figure><img src="{{asset('/storage/Measurment/Shirts/plength/length.jpg')}}" alt=""></figure></div>
                                                <div class="et-measure-video"><video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="{{asset('/storage/Measurment/Shirts/plength/length.ogv')}}" type="video/ogg"><source src="{{asset('/storage/Measurment/Shirts/plength/length.mp4')}}" type="video/mp4"><object data="{{asset('/storage/Measurment/Shirts/plength/length.swf')}}" type="application/x-shockwave-flash" width="300" height="220"></object><source src="{{asset('/storage/Measurment/Shirts/plength/length.webm')}}" type="video/webm"></video></div>
                                            </div>
                                            <div class="et-block no-pad">
                                            	<div class="et-subhead">
                                                	<span class="longarrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>
                                                    <span>Pant <span id="fldtitle">Waist</span> generally range from <b><span id="rngfrom">28</span></b> to <b><span id="rngto">75</span></b> <span id="mtyp">inch</span></span>
                                                </div>
                                            	<div class="et-type-Input">
                                                    <div class="et-input">
                                                        <span>WAIST</span>
                                                        <?php $measurewaistlst = App\MeasurmentVideo::select('*')->where('cat_id','=',4)->where('id','=',20)->get();?>
                                                        @foreach($measurewaistlst as $mwaistlst)
                                                        <input type="text" data-title="{{$mwaistlst->from_range}}-{{$mwaistlst->to_range}}" name="bsizeWaist" id="bsizeWaist" onFocus="javascript:showPantRanges('{{$mwaistlst->bodysize_type}}',{{$mwaistlst->from_range}},{{$mwaistlst->to_range}},'waist');" onBlur="javascript:validatePantField(this.id,{{$mwaistlst->from_range}},{{$mwaistlst->to_range}});" value="<?php echo $ePantTailorObj['osizeWaist'];?>" >
                                                        @endforeach
                                                    </div>
                                                    <div class="et-input">
                                                        <span>HIP</span>
                                                        <?php $measurehiplst = App\MeasurmentVideo::select('*')->where('cat_id','=',4)->where('id','=',21)->get();?>
                                                        @foreach($measurehiplst as $mhiplst)
                                                        <input type="text" data-title="{{$mhiplst->from_range}}-{{$mhiplst->to_range}}" name="bsizeHip" id="bsizeHip" onFocus="javascript:showPantRanges('{{$mhiplst->bodysize_type}}',{{$mhiplst->from_range}},{{$mhiplst->to_range}},'hip');" onBlur="javascript:validatePantField(this.id,{{$mhiplst->from_range}},{{$mhiplst->to_range}});" value="<?php echo $ePantTailorObj['osizeHip'];?>" >
                                                        @endforeach
                                                    </div>
                                                    <div class="et-input">
                                                        <span>CROTCH</span>
                                                        <?php $measurecrotchlst = App\MeasurmentVideo::select('*')->where('cat_id','=',4)->where('id','=',22)->get();?>
                                                        @foreach($measurecrotchlst as $mcrotchlst)
                                                        <input type="text" data-title="{{$mcrotchlst->from_range}}-{{$mcrotchlst->to_range}}" name="bsizeCrotch" id="bsizeCrotch" onFocus="javascript:showPantRanges('{{$mcrotchlst->bodysize_type}}',{{$mcrotchlst->from_range}},{{$mcrotchlst->to_range}},'croch');" onBlur="javascript:validatePantField(this.id,{{$mcrotchlst->from_range}},{{$mcrotchlst->to_range}});" value="<?php echo $ePantTailorObj['osizeCrotch'];?>" >
                                                        @endforeach
                                                    </div>
                                                    <div class="et-input">
                                                        <span>THIGH</span>
                                                        <?php $measurethighlst = App\MeasurmentVideo::select('*')->where('cat_id','=',4)->where('id','=',23)->get();?>
                                                        @foreach($measurethighlst as $mthighlst)
                                                        <input type="text" data-title="{{$mthighlst->from_range}}-{{$mthighlst->to_range}}" name="bsizeThigh" id="bsizeThigh" onFocus="javascript:showPantRanges('{{$mthighlst->bodysize_type}}',{{$mthighlst->from_range}},{{$mthighlst->to_range}},'thigh');" onBlur="javascript:validatePantField(this.id,{{$mthighlst->from_range}},{{$mthighlst->to_range}});" value="<?php echo $ePantTailorObj['osizeThigh'];?>" >
                                                        @endforeach
                                                    </div>
                                                    <div class="et-input">
                                                        <span>LENGTH</span>
                                                        <?php $measurelengthlst = App\MeasurmentVideo::select('*')->where('cat_id','=',4)->where('id','=',24)->get();?>
                                                        @foreach($measurelengthlst as $mlengthlst)
                                                        <input type="text" data-title="{{$mlengthlst->from_range}}-{{$mlengthlst->to_range}}" name="bsizeLength" id="bsizeLength" onFocus="javascript:showPantRanges('{{$mlengthlst->bodysize_type}}',{{$mlengthlst->from_range}},{{$mlengthlst->to_range}},'length');" onBlur="javascript:validatePantField(this.id,{{$mlengthlst->from_range}},{{$mlengthlst->to_range}});" value="<?php echo $ePantTailorObj['osizeLength'];?>" >
                                                        @endforeach
                                                    </div>
                									<div class="et-radio-check">
                           								<div class="radio"><label><input type="radio" name="bsizetyp" id="bsizetyp" value="cm" <?php if($ePantTailorObj['osizeType']=="cm"){?>checked<?php } ?>><span class="cr"><i class="cr-icon"></i></span>Cm</label></div>
                                                        <div class="radio"><label><input type="radio" name="bsizetyp" id="bsizetyp" value="inch" <?php if($ePantTailorObj['osizeType']=="inch"){?>checked<?php } ?> ><span class="cr"><i class="cr-icon"></i></span>Inch</label></div>
                									</div>
                                            	</div>
                                                <div class="et-block">
                                                	<div class="et-setect-fit">
                                                    	<ul>
                                                        	<li><span class="longarrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span><span>Select Your Size :</span></li>
                                                        	<li><div class="radio"><label><input type="radio" name="fitstyle" id="fitstyle" value="Comfortable" <?php if($ePantTailorObj['osizeStyle']=="Comfortable"){?> checked<?php }?> ><span class="cr"><i class="cr-icon"></i></span>Signature Standard Fit</label></div></li>
                                                            <li><div class="radio"><label><input type="radio" name="fitstyle" id="fitstyle" value="Slim" <?php if($ePantTailorObj['osizeStyle']=="Slim"){?> checked<?php }?> ><span class="cr"><i class="cr-icon"></i></span>Euro Slim Fit</label></div></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="et-block et-form-btn">
                                                	<a href="#" onClick="javascript:showPantMeasureSect('main');" class="et-blk-brn blue">Back To Design</a>
                                                    <input type="hidden" name="setarr" id="setarr" value="">
                                                    <input type="hidden" name="frntviewfinal" id="frntviewfinal">
                                                    <input type="hidden" name="bkviewfinal" id="bkviewfinal">
                                                    <input type="hidden" name="mpattern" value="Body">
                                                    <input type="hidden" name="selbodyqty" value="1">
                                                    <button type="sumbit" id="pant_body_cart_btn" class="et-cart-brn">Add To Cart</button>
                                                    <div class="et-btn-group">
                                                    	<h4 style="color:#f00; font-weight:bold;" class="vwprice">1 Pant: ${{$ePantTailorObj['ofabricPrice']}} </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="et-checkout-box">
                                    	@include('threepiece.shopping')
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
