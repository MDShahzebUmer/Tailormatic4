
<div id="container_jackets" class="row tab-container">
    <?php $myArray=$eJacketTailorObj;?>
    <input type="hidden" name="tabJacketActiveId" id="tabJacketActiveId" value="<?php echo $activeTab = isset($mytabjacket) ? $mytabjacket : 'etfabricjacket'; ?>">
    <input type="hidden" name="tabJacketSActiveId" id="tabJacketSActiveId" value="<?php echo $activeSubTab = isset($myjacketsubtab) ? $myjacketsubtab : 'fabric6'; ?>">
    <input type="hidden" name="harrJacket" id="harrJacket" value="<?php echo htmlspecialchars(json_encode($myArray)); ?>">

    <div class="pt-tab">
        <div class="card">
            <ul class="nav nav-tabs" role="tablist" style="display:none;">
                <li role="presentation" class="<?php echo (isset($mytabjacket)&& $mytabjacket == 'etfabricjacket') ? 'active' : '' ?>" ><a href="#etfabricjacket" aria-controls="fabric" role="tab" data-toggle="tab" onClick="javascript:getTabJacketSect('etfabricjacket');">1. FABRIC</a></li>
                <li role="presentation" class="<?php echo (isset($mytabjacket)&& $mytabjacket == 'etstylejacket') ? 'active' : '' ?>"><a href="#etstylejacket" aria-controls="style" role="tab" data-toggle="tab" onClick="javascript:getTabJacketSect('etstylejacket');"> 2. STYLE</a></li>
                <li role="presentation" class="<?php echo (isset($mytabjacket) && $mytabjacket == 'etcontrastjacket') ? 'active' : '' ?>"><a href="#etcontrastjacket" aria-controls="contrast" role="tab" data-toggle="tab" onClick="javascript:getTabJacketSect('etcontrastjacket');">3. COLOR CONTRAST</a></li>
                <li role="presentation" class="<?php echo (isset($mytabjacket) && $mytabjacket == 'etmeasurementjacket') ? 'active' : '' ?>"><a href="#etmeasurementjacket" aria-controls="settings" role="tab" data-toggle="tab" onClick="javascript:getTabJacketSect('etmeasurementjacket');">4. MEASUREMENTS</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <!-- ======= Fabric Start Here ========= -->
                <div role="tabpanel" class="tab-pane" id="etfabricjacket">
                    <div class="pt-variation-main">
                        <div class="pt-variation">
                        @foreach($fabric_ary as $gr)
                                @if(!empty($gr['jacket']))
                                    <div id="menu-fabric{{$gr['jacket']->id}}" 
                                        class="pt-box-square <?php if($gr['jacket']->id == $eJacketTailorObj['ofabricType']) {?>active<?php } ?>" 
                                        onClick="openPgContent('menu-fabric{{$gr['jacket']->id}}','etfabricjacket','{{$gr['jacket']->id}}','menu-fabric','fabric');">
                                        <p class="sub-fabric-name">{{$gr['jacket']->fbgrp_name}}</p>
                                        @php
                                            $frate = 0;
                                            if($gr['jacket']->fabric_offer_price > 0 && $gr['jacket']->fabric_offer_price != '') {
                                                if(!empty($gr['jacket']->fabric_offer_price)){
                                                    $frate += $gr['jacket']->fabric_offer_price;
                                                }
                                            }else{
                                                if(!empty($gr['jacket']->fabric_rate)){
                                                    $frate += $gr['jacket']->fabric_rate;
                                                }
                                            }
                                            if($gr['pant']->fabric_offer_price > 0 && $gr['pant']->fabric_offer_price != ''){
                                                if(!empty($gr['pant']->fabric_offer_price)){
                                                    $frate += $gr['pant']->fabric_offer_price;
                                                }
                                            }else{
                                                if(!empty($gr['pant']->fabric_rate))
                                                    $frate += $gr['pant']->fabric_rate;
                                            }
                                        @endphp
                                        <p class="sub-fabric-price">${{number_format($frate,2)}}</P>
                                    </div>
                                @endif
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
                                        <span id="menuopttitle-etfabricjacket">Choose Your Fabric : </span>
                                    </div>
                                    <!-- Fabric of the Week -->
                                    <!-- <div class="carousel-container"> -->
                                        @foreach($group_jacket_record as $gr)
                                        <div class="et-carousel" id="menu-opt-fabric{{$gr->id}}"  <?php if($gr->id == $eJacketTailorObj['ofabricType']) {?>style="display:block;"<?php } else {?>style="display:none;"<?php } ?> >
                                            <div id="et-carousel-item-fabric{{$gr->id}}" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false">
                                                <div class="carousel-inner" role="listbox">
                                                    <div class="item active">
                                                        <ul class="et-item-list">
                                                            <?php $fabriclst = App\Etfabric::select('*')->where('fbgrp_id','=',$gr->id)->where('fabric_status','=','1')->whereRaw('fabric_qty > fabric_min_qty')->get();?>
                                                            @foreach($fabriclst as $fablst)
                                                            <li class="et-item" id="optionlist-fabric{{$gr->id}}-{{$fablst->id}}" 
                                                                title="{{ $fablst->fabric_name }}" 
                                                                data-title="{{ $fablst->fabric_name }}" 
                                                                onClick="javascript:getjacketfab({{$fablst->id}},'etfabricjacket');"
                                                                style="background:url('/storage/{{$fablst->fabric_img_l}}');">
                                                                <figure class="et-item-img">
                                                                    <!-- <img src="{{asset('/storage/'.$fablst->fabric_img_s)}}" alt="{{ $fablst->fabric_name }}"> -->
                                                                </figure>
                                                                @if($fablst->id==$eJacketTailorObj['ofabric'])<div class="icon-check"></div>@endif
                                                                <div class="m-et-fab-box">
                                                                    <p class="m-i-f-desc">{{$fablst['fabric_desc']}}</p>
                                                                    <span class="m-i-f-name">{{$fablst['fabric_name']}}</span>
                                                                    <?php
                                                                    if($gr->fabric_offer_price != 0 && $gr->fabric_offer_price != '') {
                                                                        $rec_frate = $gr->fabric_offer_price;
                                                                    }else{
                                                                        $rec_frate =    $gr->fabric_rate;
                                                                    }
                                                                    ?>
                                                                    <p class="m-i-f-price">${{number_format($rec_frate,2)}}</p> 
                                                                </div>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    <!-- </div> -->
                                </div>
                            </div>
                            <!-- End Right Option Section -->
                        </div>
                    </div>
                </div>
                <!-- ======= Fabric End Here ========= -->
                <!-- ======= Style Start Here ========= -->
                <div role="tabpanel" class="tab-pane" id="etstylejacket">
                    <div class="pt-variation-main">
                        <div class="pt-variation">
                            <?php $smi=1;?>
                            @foreach($mainattr_jacket_record as $mattr)
                            <div id="menu-{{$mattr->id}}" class="pt-box-square <?php if($mattr->id=='19'){?>active<?php } ?>" onClick="javascript:getPgJacketOption(this.id,'etstylejacket','{{$mattr->id}}','{{$mattr->attribute_name}}');" >
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
                                        <span id="menuopttitle-etstylejacket">Choose Your Buttons : </span>
                                    </div>
                                    <div id="fullstyle">
                                    <!-- Menu Sleeves -->
                                    <div class="carousel-container">
                                        @foreach($mainattr_jacket_record as $mattr)
                                        <div class="et-carousel" id="menu-opt-{{$mattr->id}}">
                                            <div id="et-style-item-{{$mattr->id}}" class="carousel slide  gp_products_carousel_wrapper" data-ride="carousel" data-interval="false">
                                                <div class="carousel-inner" role="listbox">
                                                    <div class="item active">
                                                        <ul class="et-item-list">
                                                            @if($mattr->id==21)
                                                            <?php $stylci=1; $stylelst = App\AttributeStyle::select('*')->where('attri_id','=',$mattr->id)->get();?>
                                                            @foreach($stylelst as $styllst)
                                                            <?php if($stylci==7){?></ul></div><div class="item"><ul class="et-item-list"><?php  $stylci=1;}?>
                                                            @if(($eJacketTailorObj['ostyle']==54 || $eJacketTailorObj['ostyle']==55 || $eJacketTailorObj['ostyle']==56 || $eJacketTailorObj['ostyle']==57 || $eJacketTailorObj['ostyle']==58) && ($styllst->id==130))
                                                            <li class="et-item" id="optionlist-{{$mattr->id}}-{{$styllst->id}}" data-title="{{$styllst->style_name}}" title="{{$styllst->style_name}}" onClick="javascript:getjackstyles({{$styllst->id}},'{{$mattr->id}}','etstylejacket');">
                                                                <?php $styleimglst = App\Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $eJacketTailorObj['ofabric'])->get();?>
                                                                    @foreach($styleimglst as $ls)
                                                                    <figure class="et-item-img">
                                                                    <img class="et-main-list-img" src="{{asset('/storage/'.$ls->list_img)}}" alt="{{$alt_name}}" >
                                                                    <?php $buttimglst = App\ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$styllst->id)->where('attri_id' , '=' , $styllst->attri_id)->where('but_id' , '=' , $eJacketTailorObj['obutton'])->get();?>
                                                                    @foreach($buttimglst as $buttls)
                                                                    <img src="{{asset('/storage/'.$buttls->button_list_img)}}" alt="{{$alt_name}}" >
                                                                    @endforeach
                                                                    </figure>
                                                                    @if($mattr->id==21)
                                                                        @if($styllst->id == $eJacketTailorObj['obottom'])<div class="icon-check"></div>@endif
                                                                    @endif
                                                                    @endforeach
                                                            </li>
                                                            @elseif(($eJacketTailorObj['ostyle']==50 || $eJacketTailorObj['ostyle']==51 || $eJacketTailorObj['ostyle']==52 || $eJacketTailorObj['ostyle']==53) && ($styllst->id==63 || $styllst->id==64 || $styllst->id==65))
                                                            <li class="et-item" id="optionlist-{{$mattr->id}}-{{$styllst->id}}" data-title="{{$styllst->style_name}}" title="{{$styllst->style_name}}" onClick="javascript:getjackstyles({{$styllst->id}},'{{$mattr->id}}','etstylejacket');">
                                                                <?php $styleimglst = App\Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $eJacketTailorObj['ofabric'])->get();?>
                                                                    @foreach($styleimglst as $ls)
                                                                    <figure class="et-item-img">
                                                                    <img class="et-main-list-img" src="{{asset('/storage/'.$ls->list_img)}}" alt="{{$alt_name}}" >
                                                                    <?php $buttimglst = App\ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$styllst->id)->where('attri_id' , '=' , $styllst->attri_id)->where('but_id' , '=' , $eJacketTailorObj['obutton'])->get();?>
                                                                    @foreach($buttimglst as $buttls)
                                                                    <img src="{{asset('/storage/'.$buttls->button_list_img)}}" alt="{{$alt_name}}" >
                                                                    @endforeach
                                                                    </figure>
                                                                    @if($mattr->id==21)
                                                                        @if($styllst->id == $eJacketTailorObj['obottom'])<div class="icon-check"></div>@endif
                                                                    @endif
                                                                    @endforeach
                                                            </li>
                                                            @endif
                                                            <?php $stylci++;?>
                                                            @endforeach
                                                            @else
                                                            <?php $stylci=1; $stylelst = App\AttributeStyle::select('*')->where('attri_id','=',$mattr->id)->get();?>
                                                            @foreach($stylelst as $styllst)
                                                            <?php if($stylci==7){?></ul></div><div class="item"><ul class="et-item-list"><?php  $stylci=1;}?>
                                                            <li class="et-item" id="optionlist-{{$mattr->id}}-{{$styllst->id}}" data-title="{{$styllst->style_name}}" title="{{$styllst->style_name}}" onClick="javascript:getjackstyles({{$styllst->id}},'{{$mattr->id}}','etstylejacket');">
                                                                <?php $styleimglst = App\Stylefabimglist::select('*')->where('style_id' ,'=' ,$styllst->id)->where('fab_id' , '=' , $eJacketTailorObj['ofabric'])->get();?>
                                                                    @foreach($styleimglst as $ls)
                                                                    <figure class="et-item-img">
                                                                    <img class="et-main-list-img" src="{{asset('/storage/'.$ls->list_img)}}" alt="{{$alt_name}}" >
                                                                    <?php $buttimglst = App\ButtonStyleImage::select('*')->where('attri_sty_id' ,'=' ,$styllst->id)->where('attri_id' , '=' , $styllst->attri_id)->where('but_id' , '=' , $eJacketTailorObj['obutton'])->get();?>
                                                                    @foreach($buttimglst as $buttls)
                                                                    <img src="{{asset('/storage/'.$buttls->button_list_img)}}" alt="{{$alt_name}}" >
                                                                    @endforeach
                                                                    </figure>
                                                                    @if($mattr->id==19)
                                                                        @if($styllst->id == $eJacketTailorObj['ostyle'])<div class="icon-check"></div>@endif
                                                                    @elseif($mattr->id==20)
                                                                        @if($styllst->id == $eJacketTailorObj['olapel'])<div class="icon-check"></div>@endif
                                                                    @elseif($mattr->id==22)
                                                                        @if($styllst->id == $eJacketTailorObj['opacket'])<div class="icon-check"></div>@endif
                                                                    @elseif($mattr->id==23)
                                                                        @if($styllst->id == $eJacketTailorObj['osleeveButn'])<div class="icon-check"></div>@endif
                                                                    @elseif($mattr->id==24)
                                                                        @if($styllst->id == $eJacketTailorObj['ovent'])<div class="icon-check"></div>@endif
                                                                    @endif
                                                                    @endforeach
                                                            </li>
                                                            <?php $stylci++;?>
                                                            @endforeach
                                                            @endif
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
                                        <div class="et-content-fab " id="miniview-etstylejacket-19">
                                            <figure class="et-selected-img et-selected-full"><img src="{{asset('demo/img/product/blank.png')}}" alt=""></figure>
                                            <div class="et-style-select">
                                                <h2>{{$eJacketTailorObj['ostyleName']}}</h2><p>Classic,All Time,Business</p>
                                            </div>
                                        </div>
                                        <div class="et-content-fab jacket-lapel-bg" id="miniview-etstylejacket-20" style="display:none;background-image: url({{asset('demo/img/product/blank.png')}});">
                                            <div class="et-style-select">
                                                <h2>{{$eJacketTailorObj['olapelName']}}</h2><p>Classic,All Time,Business</p>
                                                @if($eJacketTailorObj['olapel']!="62")
                                                <span>Button Hole on Lapel</span>
                                                <div class="radio">
                                                    <label><input type="radio" name="lapelholetxt" id="lapelholetxt1" value="false" <?php if($eJacketTailorObj['olapelHole']=="false"){?>checked<?php } ?> onClick="javascript:getjacketseloptions({{$eJacketTailorObj['olapelHole']}},'LapelHole','20','etstylejacket');"><span class="cr"><i class="cr-icon"></i></span>No Button Hole</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="lapelholetxt" id="lapelholetxt2" value="true" <?php if($eJacketTailorObj['olapelHole']=="true"){?>checked<?php } ?> onClick="javascript:getjacketseloptions({{$eJacketTailorObj['olapelHole']}},'LapelHole','20','etstylejacket');"><span class="cr"><i class="cr-icon"></i></span>With Lapel Buttonhole</label>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="et-content-fab jacket-bottom-bg" id="miniview-etstylejacket-21" style="display:none;background-image: url({{asset('demo/img/product/blank.png')}});">
                                            <div class="et-style-select"><h2>{{$eJacketTailorObj['obottomName']}}</h2></div>
                                        </div>
                                        <div class="et-content-fab jacket-pocket-bg" id="miniview-etstylejacket-22" style="display:none;background-image: url({{asset('demo/img/product/blank.png')}});">
                                            <div class="et-style-select">
                                                <h2>{{$eJacketTailorObj['opacketName']}}</h2>
                                                <div class="checkbox">
                                                    <label><input type="checkbox" name="breastpackt" id="breastpackt" value="true" <?php if($eJacketTailorObj['obreastPacket']=="false"){?> checked<?php }?> onClick="javascript:getjacketseloptions({{$eJacketTailorObj['obreastPacket']}},'BreastPocket','22','etstylejacket');"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>No Breast Pocket</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="et-content-fab" id="miniview-etstylejacket-23" style="display:none;">
                                            <figure class="et-sleevebuttonds">
                                                <img class="et-main-sleeve" src="{{asset('/storage/Jacket/Fabric/ImageIn/'.$eJacketTailorObj['ofabric'].'.png')}}">
                                                @if($eJacketTailorObj['osleeveButn']=="73")
                                                <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/3StandardButtons/Button/ShowImg/'.$eJacketTailorObj['obutton'].'.png')}}">
                                                <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/3StandardButtons/Thread/JCross/'.$eJacketTailorObj['obuttonHole'].'.png')}}">
                                                @elseif($eJacketTailorObj['osleeveButn']=="74")
                                                <img class="et-sleeve-b1" src="{{asset('/storage/Jacket/Style/SleeveButton/3WorkingButtons/Thread/ShowImg/'.$eJacketTailorObj['obuttonHole'].'.png')}}">
                                                <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/3WorkingButtons/Button/ShowImg/'.$eJacketTailorObj['obutton'].'.png')}}">
                                                <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/3WorkingButtons/Thread/JCross/'.$eJacketTailorObj['obuttonHole'].'.png')}}">
                                                @elseif($eJacketTailorObj['osleeveButn']=="75")
                                                <img class="et-sleeve-b1" src="{{asset('/storage/Jacket/Style/SleeveButton/3KissingButtons/Thread/ShowImg/'.$eJacketTailorObj['obuttonHole'].'.png')}}">
                                                <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/3KissingButtons/Button/ShowImg/'.$eJacketTailorObj['obutton'].'.png')}}">
                                                <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/3KissingButtons/Thread/JCross/'.$eJacketTailorObj['obuttonHole'].'.png')}}">
                                                @elseif($eJacketTailorObj['osleeveButn']=="76")
                                                <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/4StandardButtons/Button/ShowImg/'.$eJacketTailorObj['obutton'].'.png')}}">
                                                <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/4StandardButtons/Thread/JCross/'.$eJacketTailorObj['obuttonHole'].'.png')}}">
                                                @elseif($eJacketTailorObj['osleeveButn']=="77")
                                                <img class="et-sleeve-b1" src="{{asset('/storage/Jacket/Style/SleeveButton/4WorkingButtons/Thread/ShowImg/'.$eJacketTailorObj['obuttonHole'].'.png')}}">
                                                <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/4WorkingButtons/Button/ShowImg/'.$eJacketTailorObj['obutton'].'.png')}}">
                                                <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/4WorkingButtons/Thread/JCross/'.$eJacketTailorObj['obuttonHole'].'.png')}}">
                                                @elseif($eJacketTailorObj['osleeveButn']=="78")
                                                <img class="et-sleeve-b1" src="{{asset('/storage/Jacket/Style/SleeveButton/4KissingButtons/Thread/ShowImg/'.$eJacketTailorObj['obuttonHole'].'.png')}}">
                                                <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/4KissingButtons/Button/ShowImg/'.$eJacketTailorObj['obutton'].'.png')}}">
                                                <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/4KissingButtons/Thread/JCross/'.$eJacketTailorObj['obuttonHole'].'.png')}}">
                                                @elseif($eJacketTailorObj['osleeveButn']=="79")
                                                <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/5StandardButtons/Button/ShowImg/'.$eJacketTailorObj['obutton'].'.png')}}">
                                                <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/5StandardButtons/Thread/JCross/'.$eJacketTailorObj['obuttonHole'].'.png')}}">
                                                @elseif($eJacketTailorObj['osleeveButn']=="80")
                                                <img class="et-sleeve-b1" src="{{asset('/storage/Jacket/Style/SleeveButton/5WorkingButtons/Thread/ShowImg/'.$eJacketTailorObj['obuttonHole'].'.png')}}">
                                                <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/5WorkingButtons/Button/ShowImg/'.$eJacketTailorObj['obutton'].'.png')}}">
                                                <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/5WorkingButtons/Thread/JCross/'.$eJacketTailorObj['obuttonHole'].'.png')}}">
                                                @elseif($eJacketTailorObj['osleeveButn']=="81")
                                                <img class="et-sleeve-b1" src="{{asset('/storage/Jacket/Style/SleeveButton/5KissingButtons/Thread/ShowImg/'.$eJacketTailorObj['obuttonHole'].'.png')}}">
                                                <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/5KissingButtons/Button/ShowImg/'.$eJacketTailorObj['obutton'].'.png')}}">
                                                <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/5KissingButtons/Thread/JCross/'.$eJacketTailorObj['obuttonHole'].'.png')}}">
                                                @endif
                                            </figure>
                                            <div class="et-style-select">
                                                <h2>{{$eJacketTailorObj['osleeveButnStyle']}}</h2><p>Classic,All Time,Business</p>
                                            </div>
                                        </div>
                                        <div class="et-content-fab jacket-vent-bg" id="miniview-etstylejacket-24" style="display:none; background-image: url({{asset('demo/img/product/blank.png')}});">
                                            <div class="et-style-select">
                                                <h2>{{$eJacketTailorObj['oventName']}}</h2><p>Classic,All Time,Business</p>
                                            </div>
                                        </div>
                                        <div class="et-next-back">
                                            <ul><li class="et-prev"><a href="#" onClick="javascript:navigatejacketback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatejacketnext();">Next</a></li></ul>
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
                <div role="tabpanel" class="tab-pane contrast-content" id="etcontrastjacket">
                    <div class="pt-variation-main">
                        <div class="pt-variation">
                            <?php $cmi=1;?>
                            @foreach($contrast_jacker_record as $contlst)
                                <div id="menu-{{$contlst->id}}" class="pt-box-square <?php if($contlst->id=='25'){?>active<?php } ?>" 
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
                                        <span id="menuopttitle-etcontrastjacket">Choose Your Contrast Fabric : </span>
                                    </div>
                                    <div id="fullcontrast">
                                    <!-- Menu Contrast -->
                                    <div class="carousel-container">
                                        @foreach($contrast_jacker_record as $contlst)
                                        @if($contlst->id == '25')
                                        <div class="et-sm-carousel" id="menu-opt-{{$contlst->id}}" style="display:none">
                                            <div class="et-contrast-list">
                                                <ul class="et-item-list">
                                                    <?php $contfablst = App\Contrast::select('*')->where('cat_id','=',2)->get(); ?>
                                                    @foreach($contfablst as $cfablst)
                                                    <li class="et-item" id="optionlist-{{$contlst->id}}-{{$cfablst->id}}" data-title="{{$cfablst->contrsfab_name}}" title="{{$cfablst->contrsfab_name}}" onClick="javascript:getjackcontrast({{$cfablst->id}},'etcontrastjacket');">
                                                        <figure class="et-item-img"><img src="{{asset('/storage/'.$cfablst->contrsfab_img)}}" alt="{{$alt_name}}" ></figure>
                                                        @if($cfablst->id==$eJacketTailorObj['ocontrast'])<div class="icon-check"></div>@endif
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        @elseif($contlst->id == '26')
                                        <div class="et-sm-carousel" id="menu-opt-{{$contlst->id}}" style="display:none">
                                            <div class="et-contrast-list">
                                                <ul class="et-item-list">
                                                    <?php $liningfablst = App\JvLiningFabric::select('*')->where('cat_id','=',2)->get(); ?>
                                                    @foreach($liningfablst as $lngfablst)
                                                    <li class="et-item" id="optionlist-{{$contlst->id}}-{{$lngfablst->id}}" data-title="{{$lngfablst->fabric_name}}" title="{{$lngfablst->fabric_name}}" onClick="javascript:getjacketlining({{$lngfablst->id}},'etcontrastjacket')">
                                                        <figure class="et-item-img"><img src="{{asset('/storage/'.$lngfablst->lining_img)}}" alt="{{$alt_name}}" ></figure>
                                                        @if($lngfablst->id==$eJacketTailorObj['olining'])<div class="icon-check"></div>@endif
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        @elseif($contlst->id == '27')
                                        <div class="et-sm-carousel" id="menu-opt-{{$contlst->id}}" style="display:none">
                                            <div class="et-contrast-list">
                                                <ul class="et-item-list">
                                                    <?php $bckcollrfablst = App\Colorcoller::select('*')->get(); ?>
                                                    @foreach($bckcollrfablst as $bkcfablst)
                                                    <li class="et-item" id="optionlist-{{$contlst->id}}-{{$bkcfablst->id}}" data-title="{{$bkcfablst->name}}" title="{{$bkcfablst->name}}" onClick="javascript:getjacketbackcollar({{$bkcfablst->id}},'etcontrastjacket')">
                                                        <figure class="et-item-img"><img src="{{asset('/storage/'.$bkcfablst->color_img)}}" alt="{{$alt_name}}" ></figure>
                                                        @if($bkcfablst->id==$eJacketTailorObj['obackCollar'])<div class="icon-check"></div>@endif
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        @elseif($contlst->id == '28')
                                        <div class="et-sm-carousel" id="menu-opt-{{$contlst->id}}" style="display:none">
                                            <div class="et-contrast-list">
                                                <ul class="et-item-list">
                                                    <?php $buttonlst = App\Button::select('*')->where('cat_id','=',2)->get(); ?>
                                                    @foreach($buttonlst as $bttnlst)
                                                    <li class="et-item" id="optionlist-{{$contlst->id}}-{{$bttnlst->id}}" data-title="{{$bttnlst->button_name}}" title="{{$bttnlst->button_name}}" onClick="javascript:getjacketbuttons({{$bttnlst->id}},'etcontrastjacket')">
                                                        <figure class="et-item-img"><img src="{{asset('/storage/'.$bttnlst->button_img)}}" alt="{{$alt_name}}" ></figure>
                                                        @if($bttnlst->id==$eJacketTailorObj['obutton'])<div class="icon-check"></div>@endif
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
                                                    <?php $contthrdlst = App\Thread::select('*')->where('cat_id','=',2)->get(); ?>
                                                    @foreach($contthrdlst as $cthreadlst)
                                                    <li class="et-item" id="optionlist-thrd-{{$cthreadlst->id}}" data-title="{{$cthreadlst->thrd_name}}" title="{{$cthreadlst->thrd_name}}" onClick="javascript:getjacketthread({{$cthreadlst->id}},'etcontrastjacket');">
                                                        <figure class="et-item-img"><img src="{{asset('/storage/'.$cthreadlst->thrd_img)}}" alt="{{$alt_name}}" ></figure>
                                                        @if($cthreadlst->id==$eJacketTailorObj['obuttonHole'])<div class="icon-check"></div>@endif
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        @elseif($contlst->id == '29')
                                        <div class="et-sm-carousel" id="menu-opt-{{$contlst->id}}" style="display:none">
                                            <div class="et-radio-block">
                                                <div class="radio">
                                                    <label><input type="radio" name="chkmonotxt" id="chkmonotxt1" value="true" <?php if($eJacketTailorObj['omonogram']=="false"){?>checked<?php }?> onClick="javascript:getjacketmonogram('false','etcontrastjacket');"><span class="cr"><i class="cr-icon"></i></span>No Monogram</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="chkmonotxt" id="chkmonotxt2" value="true" <?php if($eJacketTailorObj['omonogram']=="true"){?>checked<?php }?> onClick="javascript:getjacketmonogram('true','etcontrastjacket');"><span class="cr"><i class="cr-icon"></i></span>Inside Jacket</label>
                                                </div>
                                            </div>
                                            @if($eJacketTailorObj['omonogram']=="true")
                                            <div class="pt-pagination no-pad-left"><span>B. Choose Your Monogram color</span></div>
                                            <div class="et-contrast-list">
                                                <ul class="et-item-list pad-left-20">
                                                    <?php $monothrdlst = App\Thread::select('*')->where('cat_id','=',2)->get(); ?>
                                                    @foreach($monothrdlst as $monothrdlst)
                                                    <li class="et-item" id="optionlist-{{$contlst->id}}-{{$monothrdlst->id}}" data-title="{{$monothrdlst->thrd_name}}({{$monothrdlst->thread_code}})" onClick="javascript:getjacketmonotxtcolor({{$monothrdlst->id}},'etcontrastjacket');">
                                                        <figure class="et-item-img"><img src="{{asset('/storage/'.$monothrdlst->thrd_img)}}" alt="{{$alt_name}}" ></figure>
                                                        @if($monothrdlst->id==$eJacketTailorObj['omonogramColor'])<div class="icon-check"></div>@endif
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <div class="pt-pagination no-pad-left"><span>C. Enter Desired Monogram/Initials</span></div>
                                            <div class="et-contrast-list">
                                                <div class="checkbox">
                                                    <label><input type="checkbox" name="specialttxt" id="specialttxt" value="{{$eJacketTailorObj['omonogramSpecial']}}" <?php if($eJacketTailorObj['omonogramSpecial']=="true"){?>checked<?php } ?> onClick="javascript:getjacketseloptions('{{$eJacketTailorObj['omonogramSpecial']}}','Special','29','etcontrastjacket');"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Specially Tailored For </label><input type="text" name="monotext" id="monotext" maxlength="20" value="{{$eJacketTailorObj['omonogramText']}}" style="color:#8c7676;" onBlur="javascript:getjacketmonotext(this.value,'etcontrastjacket');">
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                    <!--  Mini Preview Section -->
                                    <div class="et-progress-des et-style-bg">
                                        <div class="et-content-fab" id="miniview-etcontrastjacket-25" >
                                            <figure class="et-selected-img et-selected-full"><img src="{{asset('demo/img/product/blank.png')}}" alt=""></figure>
                                            <div class="et-style-select">
                                                <h2>Contrast Fabric</h2>
                                                <div class="et-check-box">
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="lapeluppertxt" id="lapeluppertxt" value="true" <?php if($eJacketTailorObj['olapelupper']=="true"){?>checked<?php } ?> onClick="javascript:getjacketseloptions({{$eJacketTailorObj['olapelupper']}},'LapelUpper','25','etcontrastjacket');"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Lapel Upper</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="lapellowertxt" id="lapellowertxt" value="true" <?php if($eJacketTailorObj['olapellower']=="true"){?>checked<?php } ?> onClick="javascript:getjacketseloptions({{$eJacketTailorObj['olapellower']}},'LapelLower','25','etcontrastjacket');"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Lapel Lower</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="pocktstxt" id="pocktstxt" value="true" <?php if($eJacketTailorObj['ocontpockets']=="true"){?>checked<?php } ?> onClick="javascript:getjacketseloptions({{$eJacketTailorObj['ocontpockets']}},'Pockets','25','etcontrastjacket');"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Pockets</label>
                                                    </div>
                                                    @if($eJacketTailorObj['obreastPacket']=="true")
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="chestpockttxt" id="chestpockttxt" value="true" <?php if($eJacketTailorObj['ocontchestpocket']=="true"){?>checked<?php } ?> onClick="javascript:getjacketseloptions({{$eJacketTailorObj['ocontchestpocket']}},'ChestPocket','25','etcontrastjacket');"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Chest Pocket</label>
                                                    </div>
                                                    @endif
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="elbowmixtxt" id="elbowmixtxt" value="true" <?php if($eJacketTailorObj['ocontelbowmix']=="true"){?>checked<?php } ?> onClick="javascript:getjacketseloptions({{$eJacketTailorObj['ocontelbowmix']}},'ElbowMix','25','etcontrastjacket');"><span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>Elbow Mix</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="et-content-fab" id="miniview-etcontrastjacket-26" >
                                            <div class="et-style-select et-jacket-piping">
                                                <h5>Piping</h5>
                                                <ul class="et-item-list">
                                                    <?php $pipngfablst = App\Piping::select('*')->get(); ?>
                                                    @foreach($pipngfablst as $pipfablst)
                                                    <li class="et-item" id="optionlist-pip-{{$pipfablst->id}}" data-title="{{$pipfablst->name}}" title="{{$pipfablst->name}}" onClick="javascript:getjacketpiping({{$pipfablst->id}},'etcontrastjacket')">
                                                        <figure class="et-item-img"><img src="{{asset('/storage/'.$pipfablst->piping_img)}}" alt="{{$alt_name}}" ></figure>
                                                        @if($pipfablst->id==$eJacketTailorObj['opiping'])<div class="icon-check"></div>@endif
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="et-content-fab jacket-backcollr-bg" id="miniview-etcontrastjacket-27" style="display:none; background-image: url({{asset('demo/img/product/blank.png')}});" >
                                            <figure><img src="{{asset('/storage/Jacket/BackColler/'.$eJacketTailorObj['obackCollar'].'.png')}}" style="position: absolute;top: -2px;left: 138px;width: 80%;"></figure>
                                            <div class="et-style-select"><h2>Back Collar</h2></div>
                                        </div>
                                        <div class="et-content-fab" id="miniview-etcontrastjacket-28" style="display:none;">
                                            <figure class="et-sleevebuttonds">
                                                <img class="et-main-sleeve" src="{{asset('/storage/Jacket/Fabric/ImageIn/'.$eJacketTailorObj['ofabric'].'.png')}}">
                                                @if($eJacketTailorObj['osleeveButn']=="73")
                                                <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/3StandardButtons/Button/ShowImg/'.$eJacketTailorObj['obutton'].'.png')}}">
                                                <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/3StandardButtons/Thread/JCross/'.$eJacketTailorObj['obuttonHole'].'.png')}}">
                                                @elseif($eJacketTailorObj['osleeveButn']=="74")
                                                <img class="et-sleeve-b1" src="{{asset('/storage/Jacket/Style/SleeveButton/3WorkingButtons/Thread/ShowImg/'.$eJacketTailorObj['obuttonHole'].'.png')}}">
                                                <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/3WorkingButtons/Button/ShowImg/'.$eJacketTailorObj['obutton'].'.png')}}">
                                                <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/3WorkingButtons/Thread/JCross/'.$eJacketTailorObj['obuttonHole'].'.png')}}">
                                                @elseif($eJacketTailorObj['osleeveButn']=="75")
                                                <img class="et-sleeve-b1" src="{{asset('/storage/Jacket/Style/SleeveButton/3KissingButtons/Thread/ShowImg/'.$eJacketTailorObj['obuttonHole'].'.png')}}">
                                                <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/3KissingButtons/Button/ShowImg/'.$eJacketTailorObj['obutton'].'.png')}}">
                                                <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/3KissingButtons/Thread/JCross/'.$eJacketTailorObj['obuttonHole'].'.png')}}">
                                                @elseif($eJacketTailorObj['osleeveButn']=="76")
                                                <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/4StandardButtons/Button/ShowImg/'.$eJacketTailorObj['obutton'].'.png')}}">
                                                <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/4StandardButtons/Thread/JCross/'.$eJacketTailorObj['obuttonHole'].'.png')}}">
                                                @elseif($eJacketTailorObj['osleeveButn']=="77")
                                                <img class="et-sleeve-b1" src="{{asset('/storage/Jacket/Style/SleeveButton/4WorkingButtons/Thread/ShowImg/'.$eJacketTailorObj['obuttonHole'].'.png')}}">
                                                <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/4WorkingButtons/Button/ShowImg/'.$eJacketTailorObj['obutton'].'.png')}}">
                                                <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/4WorkingButtons/Thread/JCross/'.$eJacketTailorObj['obuttonHole'].'.png')}}">
                                                @elseif($eJacketTailorObj['osleeveButn']=="78")
                                                <img class="et-sleeve-b1" src="{{asset('/storage/Jacket/Style/SleeveButton/4KissingButtons/Thread/ShowImg/'.$eJacketTailorObj['obuttonHole'].'.png')}}">
                                                <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/4KissingButtons/Button/ShowImg/'.$eJacketTailorObj['obutton'].'.png')}}">
                                                <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/4KissingButtons/Thread/JCross/'.$eJacketTailorObj['obuttonHole'].'.png')}}">
                                                @elseif($eJacketTailorObj['osleeveButn']=="79")
                                                <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/5StandardButtons/Button/ShowImg/'.$eJacketTailorObj['obutton'].'.png')}}">
                                                <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/5StandardButtons/Thread/JCross/'.$eJacketTailorObj['obuttonHole'].'.png')}}">
                                                @elseif($eJacketTailorObj['osleeveButn']=="80")
                                                <img class="et-sleeve-b1" src="{{asset('/storage/Jacket/Style/SleeveButton/5WorkingButtons/Thread/ShowImg/'.$eJacketTailorObj['obuttonHole'].'.png')}}">
                                                <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/5WorkingButtons/Button/ShowImg/'.$eJacketTailorObj['obutton'].'.png')}}">
                                                <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/5WorkingButtons/Thread/JCross/'.$eJacketTailorObj['obuttonHole'].'.png')}}">
                                                @elseif($eJacketTailorObj['osleeveButn']=="81")
                                                <img class="et-sleeve-b1" src="{{asset('/storage/Jacket/Style/SleeveButton/5KissingButtons/Thread/ShowImg/'.$eJacketTailorObj['obuttonHole'].'.png')}}">
                                                <img class="et-sleeve-b2" src="{{asset('/storage/Jacket/Style/SleeveButton/5KissingButtons/Button/ShowImg/'.$eJacketTailorObj['obutton'].'.png')}}">
                                                <img class="et-sleeve-b3" src="{{asset('/storage/Jacket/Style/SleeveButton/5KissingButtons/Thread/JCross/'.$eJacketTailorObj['obuttonHole'].'.png')}}">
                                                @endif
                                            </figure>
                                            <div class="et-style-select">
                                                <h2>Jacket Button</h2><p>{{$eJacketTailorObj['obuttonName']}}</p>
                                            </div>
                                        </div>
                                        <div class="et-content-fab jacket-monogram-bg" id="miniview-etcontrastjacket-29" style="display:none; background-image:url({{asset('demo/img/product/blank.png')}});">
                                            <div class="et-style-select">
                                                <h2>Inside View of Jacket</h2>
                                                @if($eJacketTailorObj['omonogram']=="true")
                                                <p>Monogram Color: {{$eJacketTailorObj['omonogramHoleName']}}</p>
                                                @endif
                                            </div>
                                            @if($eJacketTailorObj['omonogram']=="true")
                                            <div class="et-addtttext" style="color:{{$eJacketTailorObj['omonogramtextColor']}}">
                                                @if($eJacketTailorObj['omonogramSpecial']=="true")
                                                <p>Specially Tailored For</p>
                                                @endif
                                                <p>{{$eJacketTailorObj['omonogramText']}}</p>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="et-next-back">
                                            <ul><li class="et-prev"><a href="#" onClick="javascript:navigatejacketback();">Back</a></li><li class="et-next"><a href="#" onClick="javascript:navigatejacketnext();">Next</a></li></ul>
                                        </div>
                                    </div>
                                    <!--  End Mini Preview Section -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ======= Contrast End Here ========= -->
                <!-- ======= Measurement Start Here ========= -->
                <div role="tabpanel" class="tab-pane" id="etmeasurementjacket">
                    <div class="pt-variation-main">
                        <div class="pt-variation">
                            <div id="menu-jacket-bodysize" class="pt-box-square" onClick="showJacketMeasureSect2('bodysize');">
                                <p>Body Size</p>
                            </div>
                            <div id="menu-jacket-standardsize" class="pt-box-square" onClick="showJacketMeasureSect2('standardsize');">
                                <p>Standard Sizes</p>
                            </div>
                        </div>
                    </div>
                    <div class="pt-customize">
                        <div class="pt-men">
                            <div id="menu-mesure-jacket-main" style="display:block;">
                                <!-- Right Option Section -->
                                <div class="pt-choose-right et-measure-right">
                                    <div class="pt-thumb-slider">
                                        <div class="et-des-title"><h2>Great Choice!</h2><h4>Please Select Your Measurement Option</h4></div>
                                        <div class="et-ment-option">
                                            <div class="et-body-size light-bg" onClick="showJacketMeasureSect2('bodysize');">
                                                <h2 class="un-bg">BODY SIZE</h2>
                                                <p>Part of the tailor-made experience is getting yourself measured up. With the assistance of our easy-to-follow video measuring guide, get yourself measured up in no time!</p>
                                                <span><a href="javascript:void(0);" onClick="showJacketMeasureSect2('bodysize');"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></a></span>
                                                <figure class="et-img"><img src="{{asset('demo/img/Measurement.png')}}" alt=""></figure>
                                            </div>
                                            <div class="et-standard-size light-bg" onClick="showJacketMeasureSect2('standardsize');">
                                                <h2 class="un-bg">Standard SIZES</h2>
                                                <p>Standard sizes provide an equally amazing fit. Select from an array of sizes from our standard size chart. Enjoy your Tailor-made product with the perfect combination of the right size and your creative style choices!</p>
                                                <span><a href="javascript:void(0);" onClick="showJacketMeasureSect2('standardsize');"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i></a></span>
                                                <figure class="et-img"><img src="{{asset('demo/img/SML.png')}}" alt=""></figure>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Right Option Section -->
                            </div>
                            <!-- STANDARD SIZES -->
                            <div class="pt-choose-right et-main-body-size" id="menu-mesure-jacket-standardsize" style="display:none;">
                                <div class="pt-thumb-slider">
                                    <div class="et-des-title"><h2>STANDARD SIZES</h2></div>
                                    <div class="et-main-measurement">
                                        <form class="et-shirt-measure" role="form" method="POST">
                                            {{ csrf_field() }}
                                        <div class="et-block et-vests-size">
                                            <label>2Piece Size :</label>
                                            <div class="et-btn-select">
                                                <select class="selectpicker btn-primary" id="cntrysize" name="cntrysize" onChange="javascript:changeJacketCntrySize(this.value);"><option value="1" selected>European Size</option><option value="2">UK/American Size</option></select>
                                            </div>
                                            <div class="et-btn-select" id="divsizefit">
                                                <select class="selectpicker btn-primary" id="sizefit" name="sizefit" onChange="javascript:changeJacketSizeDetails();">
                                                    <?php $measureeurolst = App\BodyMeasurment::select('*')->where('cat_id','=',2)->where('country_id','=',1)->orderBy('standardsize_id', 'asc')->get();?>
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
                                                <figure><img src="{{asset('/storage/Measurment/Shirts/length/length.jpg')}}" alt=""></figure>
                                            </div>
                                            <div class="et-measure-video"><video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="{{asset('/storage/Measurment/Shirts/length/length.ogv')}}" type="video/ogg"><source src="{{asset('/storage/Measurment/Shirts/length/length.mp4')}}" type="video/mp4"><object data="{{asset('/storage/Measurment/Shirts/length/length.swf')}}" type="application/x-shockwave-flash" width="300" height="220"></object><source src="{{asset('/storage/Measurment/Shirts/length/length.webm')}}" type="video/webm"></video></div>
                                        </div>
                                        <div class="et-block et-common-lr">
                                            <label class="pull-left">Jacket</label>
                                            <div class="et-radio-check pull-right">
                                                <div class="radio">
                                                    <label><input type="radio" name="sizetyp" id="sizetyp" value="cm" <?php if($eJacketTailorObj['osizeType']=="cm"){?>checked<?php } ?> onClick="javascript:changeJacketSizeDetails();"><span class="cr"><i class="cr-icon"></i></span>Cm</label>
                                                </div>
                                                <div class="radio">
                                                    <label><input type="radio" name="sizetyp" id="sizetyp" value="inch" <?php if($eJacketTailorObj['osizeType']=="inch"){?>checked<?php } ?> onClick="javascript:changeJacketSizeDetails();"><span class="cr"><i class="cr-icon"></i></span>Inch</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="et-common-size et-block">
                                            <div class="et-type-Input">
                                                <div class="et-input">
                                                    <span>CHEST</span><p class="et-blue" id="vchest"></p><p class="et-tsize">Inch</p><input type="hidden" name="sizeChest" id="sizechest" value="">
                                                </div>
                                                <div class="et-input">
                                                    <span>WAIST</span><p class="et-blue" id="vwaist"></p><p class="et-tsize">Inch</p><input type="hidden" name="sizeWaist" id="sizewaist" value="">
                                                </div>
                                                <div class="et-input">
                                                    <span>HIP</span><p class="et-blue" id="vhip"></p><p class="et-tsize">Inch</p><input type="hidden" name="sizeHip" id="sizehip" value="">
                                                </div>
                                                <div class="et-input">
                                                    <span>SHOULDER</span><p class="et-blue" id="vshoulder"></p><p class="et-tsize">Inch</p><input type="hidden" name="sizeShoulder" id="sizeshoulder" value="">
                                                </div>
                                                <div class="et-input">
                                                    <span>SLEEVE</span><input type="text" name="sizeSleeve" id="sizesleeve" value=""><p class="et-tsize">Inch</p>
                                                </div>
                                                <div class="et-input">
                                                    <span>LENGTH</span><input type="text" name="sizeLength" id="sizelength" value=""><p class="et-tsize">Inch</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ========================== start for pant ========================== -->
                                        <div class="et-block et-common-lr">
                                            <label class="pull-left">Pant</label>
                                        </div>
                                        <div class="et-common-size et-block">
                                            <div class="et-type-Input">
                                                <div class="et-input">
                                                    <span>WAIST</span>
                                                    <p class="et-blue" id="temp_vwaist"></p>
                                                    <p class="et-tsize">Inch</p>
                                                    <input type="hidden" name="temp_sizeWaist" id="temp_sizewaist" value="">
                                                </div>
                                                <div class="et-input">
                                                    <span>HIP</span>
                                                    <p class="et-blue" id="temp_vhip"></p>
                                                    <p class="et-tsize">Inch</p>
                                                    <input type="hidden" name="temp_sizeHip" id="temp_sizehip" value="">
                                                </div>
                                                <div class="et-input">
                                                    <span>CROTCH</span>
                                                    <p class="et-blue" id="temp_vcrotch"></p>
                                                    <p class="et-tsize">Inch</p>
                                                    <input type="hidden" name="temp_sizeCrotch" id="temp_sizecrotch" value="">
                                                </div>
                                                <div class="et-input">
                                                    <span>THIGH</span>
                                                    <p class="et-blue" id="temp_vthigh"></p>
                                                    <p class="et-tsize">Inch</p>
                                                    <input type="hidden" name="temp_sizeThigh" id="temp_sizethigh" value="">
                                                </div>
                                                <div class="et-input">
                                                    <span>LENGTH</span>
                                                    <input type="text" name="temp_sizeLength" id="temp_sizelength" value="">
                                                    <p class="et-tsize">Inch</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ========================== end for pant ============================ -->

                                        <div class="et-block et-form-btn">
                                            <a href="#" onClick="showJacketMeasureSect2('main');" class="et-blk-brn blue">Back To Design</a>
                                            <input type="hidden" name="setarr" id="setarr" value="">
                                            <input type="hidden" name="frntviewfinal" id="frntviewfinal">
                                            <input type="hidden" name="bkviewfinal" id="bkviewfinal">
                                            <input type="hidden" name="mpattern" value="Standard" id="mpattern">
                                            <input type="hidden" name="selstdqty" value="1" id="selstdqty">
                                            <input type="hidden" name="hsizefit" id="hsizefit">
                                            <input type="hidden" name="rndvalue" id="rndvalue" value="<?php echo rand(100000, 999999);?>">
                                            <div id="et-smallr"  class="et-cart-brn" style="display:none; width:80px">
                                                <img src="{{URL::asset('asset/img/page-loader.gif')}}">
                                            </div>
                                            <button type="sumbit" class="et-cart-brn" id="stand">Add To Cart</button>
                                            <div class="et-btn-group">
                                                <h4 style="color:#f00; font-weight:bold;" class="vwprice">2Piece Suit ( 1 Jacket, 1 Pant ) : $ {{$first_price}} </h4>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- STANDARD SIZES END -->
                            <!-- BODY SIZES -->
                            <div class="pt-choose-right et-main-body-size" id="menu-mesure-jacket-bodysize" style="display:none;">
                                <div class="pt-thumb-slider">
                                    <div class="et-des-title"><h2>YOUR BODY SIZES</h2></div>
                                    <div class="et-main-measurement">
                                        <form class="et-shirt-measure" role="form" method="POST" onSubmit="javascript:return validatejacketbodyform();" enctype="multipart/form-data">
                                         {{ csrf_field() }}
                                            <div class="et-block">
                                                <div class="et-measure-image">
                                                    <figure><img src="{{asset('/storage/Measurment/Shirts/chest/chest.jpg')}}" alt=""></figure>
                                                </div>
                                                <div class="et-measure-video">
                                                    <video width="100%" loop preload="metadata" autoplay controls class="__web-inspector-hide-shortcut__"><source src="{{asset('/storage/Measurment/Shirts/chest/chest.ogv')}}" type="video/ogg"><source src="{{asset('/storage/Measurment/Shirts/chest/chest.mp4')}}" type="video/mp4"><object data="{{asset('/storage/Measurment/Shirts/chest/chest.swf')}}" type="application/x-shockwave-flash" width="300" height="220"></object><source src="{{asset('/storage/Measurment/Shirts/chest/chest.webm')}}" type="video/webm"></video>
                                                </div>
                                            </div>
                                            <div class="et-block no-pad">
                                                <div class="et-block">
                                                    <div class="et-setect-fit">
                                                        <ul>
                                                            <li style="width:180px;"><span class="longarrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span><span>Enter Your Measurement :</span></li>
                                                            <li style="width:75px;">
                                                                <div class="radio">
                                                                    <label>
                                                                        <input type="radio" name="bsizetyp" id="bsizetyp" value="cm" <?php if($eJacketTailorObj['osizeType']=="cm"){?>checked<?php } ?>>
                                                                        <span class="cr"><i class="cr-icon"></i></span>Cm
                                                                    </label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="radio">
                                                                    <label><input type="radio" name="bsizetyp" id="bsizetyp" value="inch" <?php if($eJacketTailorObj['osizeType']=="inch"){?>checked<?php } ?> ><span class="cr"><i class="cr-icon"></i></span>Inch</label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="et-subhead">
                                                    <span class="longarrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>
                                                    <span>Jacket <span id="fldtitle">Chest</span> generally range from <b><span id="rngfrom">28</span></b> to <b><span id="rngto">75</span></b> <span id="mtyp">inch</span></span>
                                                </div>
                                                <div class="et-type-Input">
                                                    <div class="et-input">
                                                        <span>CHEST</span>
                                                        <?php $measurechestlst = App\MeasurmentVideo::select('*')->where('cat_id','=',2)->where('id','=',9)->get();?>
                                                        @foreach($measurechestlst as $mchestlst)
                                                        <input type="text" data-title="{{$mchestlst->from_range}}-{{$mchestlst->to_range}}" name="bsizeChest" id="bsizeChest" onFocus="javascript:showJacketRanges('{{$mchestlst->bodysize_type}}',{{$mchestlst->from_range}},{{$mchestlst->to_range}},'chest');" onBlur="javascript:validateJacketField(this.id,{{$mchestlst->from_range}},{{$mchestlst->to_range}});" value="<?php echo $eJacketTailorObj['osizeChest'];?>" style="border-color:#f00;">
                                                        @endforeach
                                                    </div>
                                                    <div class="et-input">
                                                        <span>WAIST</span>
                                                        <?php $measurewaistlst = App\MeasurmentVideo::select('*')->where('cat_id','=',2)->where('id','=',10)->get();?>
                                                        @foreach($measurewaistlst as $mwaistlst)
                                                        <input type="text" data-title="{{$mwaistlst->from_range}}-{{$mwaistlst->to_range}}" name="bsizeWaist" id="bsizeWaist" onFocus="javascript:showJacketRanges('{{$mwaistlst->bodysize_type}}',{{$mwaistlst->from_range}},{{$mwaistlst->to_range}},'waist');" onBlur="javascript:validateJacketField(this.id,{{$mwaistlst->from_range}},{{$mwaistlst->to_range}});" value="<?php echo $eJacketTailorObj['osizeWaist'];?>" >
                                                        @endforeach
                                                    </div>
                                                    <div class="et-input">
                                                        <span>HIP</span>
                                                        <?php $measurehiplst = App\MeasurmentVideo::select('*')->where('cat_id','=',2)->where('id','=',11)->get();?>
                                                        @foreach($measurehiplst as $mhiplst)
                                                        <input type="text" data-title="{{$mhiplst->from_range}}-{{$mhiplst->to_range}}" name="bsizeHip" id="bsizeHip" onFocus="javascript:showJacketRanges('{{$mhiplst->bodysize_type}}',{{$mhiplst->from_range}},{{$mhiplst->to_range}},'hip');" onBlur="javascript:validateJacketField(this.id,{{$mhiplst->from_range}},{{$mhiplst->to_range}});" value="<?php echo $eJacketTailorObj['osizeHip'];?>" >
                                                        @endforeach
                                                    </div>
                                                    <div class="et-input">
                                                        <span>SHOULDER</span>
                                                        <?php $measureshoulderlst = App\MeasurmentVideo::select('*')->where('cat_id','=',2)->where('id','=',12)->get();?>
                                                        @foreach($measureshoulderlst as $mshoulderlst)
                                                        <input type="text" data-title="{{$mshoulderlst->from_range}}-{{$mshoulderlst->to_range}}" name="bsizeShoulder" id="bsizeShoulder" onFocus="javascript:showJacketRanges('{{$mshoulderlst->bodysize_type}}',{{$mshoulderlst->from_range}},{{$mshoulderlst->to_range}},'shoulder');" onBlur="javascript:validateJacketField(this.id,{{$mshoulderlst->from_range}},{{$mshoulderlst->to_range}});" value="<?php echo $eJacketTailorObj['osizeShoulder'];?>" >
                                                        @endforeach
                                                    </div>
                                                    <div class="et-input">
                                                        <span>SLEEVE</span>
                                                        <?php $measuresleevelst = App\MeasurmentVideo::select('*')->where('cat_id','=',2)->where('id','=',13)->get();?>
                                                        @foreach($measuresleevelst as $msleevlst)
                                                        <input type="text" data-title="{{$msleevlst->from_range}}-{{$msleevlst->to_range}}" name="bsizeSleeve" id="bsizeSleeve" onFocus="javascript:showJacketRanges('{{$msleevlst->bodysize_type}}',{{$msleevlst->from_range}},{{$msleevlst->to_range}},'sleeve');" onBlur="javascript:validateJacketField(this.id,{{$msleevlst->from_range}},{{$msleevlst->to_range}});" value="<?php echo $eJacketTailorObj['osizeSleeve'];?>" >
                                                        @endforeach
                                                    </div>
                                                    <div class="et-input">
                                                        <span>LENGTH</span>
                                                        <?php $measurelengthlst = App\MeasurmentVideo::select('*')->where('cat_id','=',2)->where('id','=',14)->get();?>
                                                        @foreach($measurelengthlst as $mlengthlst)
                                                        <input type="text" data-title="{{$mlengthlst->from_range}}-{{$mlengthlst->to_range}}" name="bsizeLength" id="bsizeLength" onFocus="javascript:showJacketRanges('{{$mlengthlst->bodysize_type}}',{{$mlengthlst->from_range}},{{$mlengthlst->to_range}},'length');" onBlur="javascript:validateJacketField(this.id,{{$mlengthlst->from_range}},{{$mlengthlst->to_range}});" value="<?php echo $eJacketTailorObj['osizeLength'];?>" >
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <!-- =============================== for pant ============================= -->
                                                <div class="et-subhead">
                                                    <span class="longarrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>
                                                    <span>Pant <span id="pant_fldtitle">Waist</span> generally range from <b><span id="pant_rngfrom">28</span></b> to <b><span id="pant_rngto">75</span></b> <span id="pant_mtyp">inch</span></span>
                                                </div>
                                                <div class="et-type-Input">
                                                    <div class="et-input">
                                                        <span>WAIST</span>
                                                        <?php $measurewaistlst = App\MeasurmentVideo::select('*')->where('cat_id','=',4)->where('id','=',20)->get();?>
                                                        @foreach($measurewaistlst as $mwaistlst)
                                                        <input type="text" data-title="{{$mwaistlst->from_range}}-{{$mwaistlst->to_range}}" name="temp_pant_bsizeWaist" id="temp_pant_bsizeWaist" onFocus="javascript:showPantRangesTemp('{{$mwaistlst->bodysize_type}}',{{$mwaistlst->from_range}},{{$mwaistlst->to_range}},'waist');" onBlur="javascript:validatePantFieldTemp(this.id,{{$mwaistlst->from_range}},{{$mwaistlst->to_range}});" value="<?php echo $ePantTailorObj['osizeWaist'];?>" >
                                                        @endforeach
                                                    </div>
                                                    <div class="et-input">
                                                        <span>HIP</span>
                                                        <?php $measurehiplst = App\MeasurmentVideo::select('*')->where('cat_id','=',4)->where('id','=',21)->get();?>
                                                        @foreach($measurehiplst as $mhiplst)
                                                        <input type="text" data-title="{{$mhiplst->from_range}}-{{$mhiplst->to_range}}" name="temp_pant_bsizeHip" id="temp_pant_bsizeHip" onFocus="javascript:showPantRangesTemp('{{$mhiplst->bodysize_type}}',{{$mhiplst->from_range}},{{$mhiplst->to_range}},'hip');" onBlur="javascript:validatePantFieldTemp(this.id,{{$mhiplst->from_range}},{{$mhiplst->to_range}});" value="<?php echo $ePantTailorObj['osizeHip'];?>" >
                                                        @endforeach
                                                    </div>
                                                    <div class="et-input">
                                                        <span>CROTCH</span>
                                                        <?php $measurecrotchlst = App\MeasurmentVideo::select('*')->where('cat_id','=',4)->where('id','=',22)->get();?>
                                                        @foreach($measurecrotchlst as $mcrotchlst)
                                                        <input type="text" data-title="{{$mcrotchlst->from_range}}-{{$mcrotchlst->to_range}}" name="temp_pant_bsizeCrotch" id="temp_pant_bsizeCrotch" onFocus="javascript:showPantRangesTemp('{{$mcrotchlst->bodysize_type}}',{{$mcrotchlst->from_range}},{{$mcrotchlst->to_range}},'croch');" onBlur="javascript:validatePantFieldTemp(this.id,{{$mcrotchlst->from_range}},{{$mcrotchlst->to_range}});" value="<?php echo $ePantTailorObj['osizeCrotch'];?>" >
                                                        @endforeach
                                                    </div>
                                                    <div class="et-input">
                                                        <span>THIGH</span>
                                                        <?php $measurethighlst = App\MeasurmentVideo::select('*')->where('cat_id','=',4)->where('id','=',23)->get();?>
                                                        @foreach($measurethighlst as $mthighlst)
                                                        <input type="text" data-title="{{$mthighlst->from_range}}-{{$mthighlst->to_range}}" name="temp_pant_bsizeThigh" id="temp_pant_bsizeThigh" onFocus="javascript:showPantRangesTemp('{{$mthighlst->bodysize_type}}',{{$mthighlst->from_range}},{{$mthighlst->to_range}},'thigh');" onBlur="javascript:validatePantFieldTemp(this.id,{{$mthighlst->from_range}},{{$mthighlst->to_range}});" value="<?php echo $ePantTailorObj['osizeThigh'];?>" >
                                                        @endforeach
                                                    </div>
                                                    <div class="et-input">
                                                        <span>LENGTH</span>
                                                        <?php $measurelengthlst = App\MeasurmentVideo::select('*')->where('cat_id','=',4)->where('id','=',24)->get();?>
                                                        @foreach($measurelengthlst as $mlengthlst)
                                                        <input type="text" data-title="{{$mlengthlst->from_range}}-{{$mlengthlst->to_range}}" name="temp_pant_bsizeLength" id="temp_pant_bsizeLength" onFocus="javascript:showPantRangesTemp('{{$mlengthlst->bodysize_type}}',{{$mlengthlst->from_range}},{{$mlengthlst->to_range}},'length');" onBlur="javascript:validatePantFieldTemp(this.id,{{$mlengthlst->from_range}},{{$mlengthlst->to_range}});" value="<?php echo $ePantTailorObj['osizeLength'];?>" >
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <!-- ====================================================================== -->
                                                <div class="et-block">
                                                    <div class="et-setect-fit">
                                                        <ul>
                                                            <li><span class="longarrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span><span>Select Your Size :</span></li>
                                                            <li><div class="radio"><label><input type="radio" name="fitstyle" id="fitstyle" value="Comfortable" <?php if($eJacketTailorObj['osizeStyle']=="Comfortable"){?> checked<?php }?> ><span class="cr"><i class="cr-icon"></i></span>Signature Standard Fit</label></div></li>
                                                            <li><div class="radio"><label><input type="radio" name="fitstyle" id="fitstyle" value="Slim" <?php if($eJacketTailorObj['osizeStyle']=="Slim"){?> checked<?php }?> ><span class="cr"><i class="cr-icon"></i></span>Euro Slim Fit</label></div></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="et-block et-form-btn">
                                                    <a href="#" onClick="showJacketMeasureSect2('main');" class="et-blk-brn blue">Back To Design</a>
                                                <input type="hidden" name="setarr" id="setarr" class="bsetarr" value="">
                                                <input type="hidden" name="frntviewfinal" id="frntviewfinal" class="bfrntviewfinal">
                                                <input type="hidden" name="bkviewfinal" id="bkviewfinal" class="bbkviewfinal">
                                                <input type="hidden" name="mpattern" value="Body" id="bmpattern">
                                                <input type="hidden" name="selbodyqty" value="1" id="bselbodyqty">
                                                <input type="hidden" name="tocken" id="tocken" value="{{csrf_token() }}">
                                                <input type="hidden" name="rndvalue" id="brndvalue" value="<?php echo rand(100000, 999999);?>">
                                                <div id="et-body"  class="et-cart-brn" style="display:none; width:80px"><img src="{{URL::asset('asset/img/page-loader.gif')}}"></div>
                                                    <!-- <button type="sumbit" class="et-cart-brn" id="jacket_body_cart_btn" style="display:none;">Add To Cart</button> -->
                                                    <button class="et-cart-brn" id="temp_body_btn">Add To Cart</button>
                                                    <div class="et-btn-group">
                                                        <h4 style="color:#f00; font-weight:bold;" class="vwprice">2Piece Suit ( 1 Jacket, 1 Pant ) : ${{$first_price}} </h4>
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
