<?php  $segment = Request::segment(2); ?>
@if($segment == '')
<section class="et-content account-my-profile et-account-content">
@elseif($segment == 'edit')
<section class="et-content account-edit-profile et-account-content">
@elseif($segment == 'orderlists')
<section class="et-content account-order-list et-account-content">
@elseif($segment == 'wishlists')
<section class="et-content account-wishlist et-account-content">
@elseif($segment == 'passwordchange')
<section class="et-content account-password-change et-account-content">
@elseif($segment == 'refertofriend')
<section class="et-content account-refer-friend et-account-content">
@else
<section class="et-content et-account-content">
@endif