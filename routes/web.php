<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\Refund;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::group(['prefix' => 'admin'], function () {
//     Voyager::routes();
// });




Route::get('comingsoon', function () {
    return view('comingsoon');
});

// Woman Suit Start
Route::get('/designsuits' ,['as' => 'designsuits' , 'uses' => 'SuitController@index']);
Route::get('/mail' ,function(){
    Mail::to('hell@hell.com')->send(new Refund(5));
    return 'ok' ;
});

// Woman Suit End



Route::get('/', ['as' => 'welcome', 'uses' => 'HomeController@index']);
Route::get('pages/{slug?}', 'HomeController@pages');
Route::post('/contact', ['as' => 'contact-us', 'uses' => 'HomeController@inquirypost']);
Route::post('/referto', ['as' => 'referto', 'uses' => 'HomeController@refertofriend']);


Route::get('/designshirts' ,['as' => 'designshirts' , 'uses' => 'DemoController@index']);
Route::post('/designshirts',['as' => 'designshirts' , 'uses' => 'DemoController@index']);
Route::post('/getshirtfabrics',['as' => 'getshirtfabrics' , 'uses' => 'DemoController@getfabdetails']);
Route::post('/getshirtstyle',['as' => 'getshirtstyle' , 'uses' => 'DemoController@getstyledetails']);
Route::post('/getshirtcontrasts',['as' => 'getshirtcontrasts' , 'uses' => 'DemoController@getcontrastdetails']);
Route::post('/getshirtbutton',['as' => 'getshirtbutton' , 'uses' => 'DemoController@getbuttondetails']);
Route::post('/getshirtthreads',['as' => 'getshirtthreads' , 'uses' => 'DemoController@getthreaddetails']);
Route::post('/getshirtthrdstyle',['as' => 'getshirtthrdstyle' , 'uses' => 'DemoController@getthreadstyledetails']);
Route::post('/getshirtmonogrm',['as' => 'getshirtmonogrm' , 'uses' => 'DemoController@getmonogramdetails']);
Route::post('/getshirtmonotxt',['as' => 'getshirtmonotxt' , 'uses' => 'DemoController@getmonotextdetails']);
Route::post('/getshirtmonocolr',['as' => 'getshirtmonocolr' , 'uses' => 'DemoController@getmonotextcolrdetails']);
Route::post('/getsetshirtoptions',['as' => 'getsetshirtoptions' , 'uses' => 'DemoController@getshirtoptiondetails']);
Route::post('/designshirts/postcart',['as' => 'designshirts.postcart' , 'uses' => 'DemoController@get_item']);
Route::get('/designshirts/edit/{data?}' ,['as' => 'designshirts/edit' , 'uses' => 'DemoController@editcartshirt']);
/*Singal product edit*/
Route::get('/designshirts/sedit/{data?}' ,['as' => 'designshirts/edit' , 'uses' => 'DemoController@editcustomshirt']);
/*Singal product edit end*/

/*Jacket*/
Route::get('/designjackets' ,['as' => 'designjackets' , 'uses' => 'JacketController@index']);
Route::post('/designjackets',['as' => 'designjackets' , 'uses' => 'JacketController@index']);
Route::post('/getjktfabrics',['as' => 'getjktfabrics' , 'uses' => 'JacketController@getfabdetails']);
Route::post('/getjktstyle',['as' => 'getjktstyle' , 'uses' => 'JacketController@getstyledetails']);
Route::post('/getjktcontrasts',['as' => 'getjktcontrasts' , 'uses' => 'JacketController@getcontrastdetails']);
Route::post('/getjktlinings',['as' => 'getjktlinings' , 'uses' => 'JacketController@getliningdetails']);
Route::post('/getjktpipings',['as' => 'getjktpipings' , 'uses' => 'JacketController@getpipingdetails']);
Route::post('/getjktbckcollar',['as' => 'getjktbckcollar' , 'uses' => 'JacketController@getbackcollardetails']);
Route::post('/getjktbutton',['as' => 'getjktbutton' , 'uses' => 'JacketController@getbuttondetails']);
Route::post('/getjktthreads',['as' => 'getjktthreads' , 'uses' => 'JacketController@getthreaddetails']);
Route::post('/getjktmonogrm',['as' => 'getjktmonogrm' , 'uses' => 'JacketController@getmonogramdetails']);
Route::post('/getjktmonocolr',['as' => 'getjktmonocolr' , 'uses' => 'JacketController@getmonotextcolrdetails']);
Route::post('/getjktmonotxt',['as' => 'getjktmonotxt' , 'uses' => 'JacketController@getmonotextdetails']);
Route::post('/getsetjktoptions',['as' => 'getsetjktoptions' , 'uses' => 'JacketController@getjktoptiondetails']);
Route::post('/designjackets/postcart',['as' => 'designjackets.postcart' , 'uses' => 'JacketController@get_item']);
Route::get('/designjackets/edit/{data?}' ,['as' => 'designshirts/edit' , 'uses' => 'DemoController@editcartshirt']);
/*Singal product edit*/
Route::get('/designjackets/sedit/{data?}' ,['as' => 'designshirts/edit' , 'uses' => 'DemoController@editcustomshirt']);
/*Singal product edit end*/

Route::post('/measurjackets',['as' => 'measurjackets' , 'uses' => 'JacketController@measurestd']);
Route::post('/measurjacketdtls',['as' => 'measurjacketdtls' , 'uses' => 'JacketController@measurestddetls']);
/*Jacket End*/

/*Vests*/

Route::get('/designvests' ,['as' => 'designvests' , 'uses' => 'VestController@index']);
Route::post('/designvests',['as' => 'designvests' , 'uses' => 'VestController@index']);
Route::post('/getfabrics',['as' => 'getfabrics' , 'uses' => 'VestController@getfabdetails']);
Route::post('/getstyle',['as' => 'getstyle' , 'uses' => 'VestController@getstyledetails']);
Route::post('/getcontrasts',['as' => 'getcontrasts' , 'uses' => 'VestController@getcontrastdetails']);
Route::post('/getlinings',['as' => 'getlinings' , 'uses' => 'VestController@getliningdetails']);
Route::post('/getpipings',['as' => 'getpipings' , 'uses' => 'VestController@getpipingdetails']);
Route::post('/getbutton',['as' => 'getbutton' , 'uses' => 'VestController@getbuttondetails']);
Route::post('/getthreads',['as' => 'getthreads' , 'uses' => 'VestController@getthreaddetails']);
Route::post('/getsetoptions',['as' => 'getsetoptions' , 'uses' => 'VestController@getsetoptiondetails']);
Route::post('/designvests/postcart',['as' => 'designvests.postcart' , 'uses' => 'VestController@get_item']);
Route::get('/designvests/edit/{data?}' ,['as' => 'designshirts/edit' , 'uses' => 'DemoController@editcartshirt']);
/*Singal product edit*/
Route::get('/designvests/sedit/{data?}' ,['as' => 'designshirts/edit' , 'uses' => 'DemoController@editcustomshirt']);
/*Singal product edit end*/
Route::post('/measurvests',['as' => 'measurvests' , 'uses' => 'VestController@measurestd']);
Route::post('/measurvestdtls',['as' => 'measurvestdtls' , 'uses' => 'VestController@measurestddetls']);
/*Vests End*/

/*Pants*/

Route::get('/designpants' ,['as' => 'designpants' , 'uses' => 'PantController@index']);
Route::post('/designpants',['as' => 'designpants' , 'uses' => 'PantController@index']);
Route::post('/getpantfabrics',['as' => 'getpantfabrics' , 'uses' => 'PantController@getfabdetails']);
Route::post('/getpantstyle',['as' => 'getpantstyle' , 'uses' => 'PantController@getstyledetails']);
Route::post('/getpantcontrasts',['as' => 'getpantcontrasts' , 'uses' => 'PantController@getcontrastdetails']);
Route::post('/getpantbutton',['as' => 'getpantbutton' , 'uses' => 'PantController@getbuttondetails']);
Route::post('/getpantthreads',['as' => 'getpantthreads' , 'uses' => 'PantController@getthreaddetails']);
Route::post('/getsetpantoptions',['as' => 'getsetpantoptions' , 'uses' => 'PantController@getsetoptiondetails']);
Route::post('/designpants/postcart',['as' => 'designpants.postcart' , 'uses' => 'PantController@get_item']);
Route::get('/designpants/edit/{data?}' ,['as' => 'designpants/edit' , 'uses' => 'DemoController@editcartshirt']);
/*Singal product edit*/
Route::get('/designpants/sedit/{data?}' ,['as' => 'designshirts/edit' , 'uses' => 'DemoController@editcustomshirt']);
/*Singal product edit end*/
Route::post('/measurpants',['as' => 'measurpants' , 'uses' => 'PantController@measurestd']);
Route::post('/measurpantsdtls',['as' => 'measurpantsdtls' , 'uses' => 'PantController@measurestddetls']);
/*Pants End*/

/* =================== 3Piece Suits =======================*/
Route::get('/design3pcsuits' ,['as' => 'design3pcsuits' , 'uses' => 'ThreePieceController@index']);
Route::post('/design3pcsuits',['as' => 'design3pcsuits' , 'uses' => 'ThreePieceController@index']);

Route::post('/getfabricsjacket',['as' => 'getfabricsjacket' , 'uses' => 'ThreePieceController@getfabjacketdetails']);
Route::post('/getstylejacket',['as' => 'getstylejacket' , 'uses' => 'ThreePieceController@getstylejacketdetails']);
Route::post('/getcontrastsjacket',['as' => 'getcontrastsjacket' , 'uses' => 'ThreePieceController@getcontrastjacketdetails']);
Route::post('/getbuttonjacket',['as' => 'getbuttonjacket' , 'uses' => 'ThreePieceController@getbuttonjacketdetails']);
Route::post('/getthreadsjacket',['as' => 'getthreadsjacket' , 'uses' => 'ThreePieceController@getthreadjacketdetails']);
Route::post('/getmonogrmjacket',['as' => 'getmonogrmjacket' , 'uses' => 'ThreePieceController@getmonogramjacketdetails']);
Route::post('/getsetoptionsjacket',['as' => 'getsetoptionsjacket' , 'uses' => 'ThreePieceController@getoptionjacketdetails']);
Route::post('/measurjacketthree',['as' => 'measurjacketthree' , 'uses' => 'ThreePieceController@measurestdjacket']);
Route::post('/measurjacketdtlsthree',['as' => 'measurjacketdtlsthree' , 'uses' => 'ThreePieceController@measurestddetlsjacket']);
Route::post('/getjktbckcollarthree',['as' => 'getjktbckcollarthree' , 'uses' => 'ThreePieceController@getbackcollardetails']);

Route::post('/getfabricspant',['as' => 'getfabricspant' , 'uses' => 'ThreePieceController@getfabpantdetails']);
Route::post('/getstylepant',['as' => 'getstylepant' , 'uses' => 'ThreePieceController@getstylepantdetails']);
Route::post('/getsetoptionspant',['as' => 'getsetoptionspant' , 'uses' => 'ThreePieceController@getsetoptionpantdetails']);
Route::post('/measurpantsthree',['as' => 'measurpantsthree' , 'uses' => 'ThreePieceController@measurestdpant']);
Route::post('/measurpantsdtlsthree',['as' => 'measurpantsdtlsthree' , 'uses' => 'ThreePieceController@measurestddetlspant']);
Route::post('/measurpantidthree',['as' => 'measurpantidthree' , 'uses' => 'ThreePieceController@getPantBodyMeasurmentIdByJacket']);
Route::post('/measurvestidthree',['as' => 'measurvestidthree' , 'uses' => 'ThreePieceController@getVestBodyMeasurmentIdByJacket']);

Route::post('/designthreepiece/postcart',['as' => 'designthreepiece.postcart' , 'uses' => 'ThreePieceController@get_item']);
Route::get('/cart/threepiecedetails/{id?}',['as' => 'cart.threepiecedetails' , 'uses' => 'CartController@detailcart']);
/* =================== 3Piece Suits End ===================*/

/* =================== 2Piece Suits =======================*/
Route::get('/design2pcsuits' ,['as' => 'design2pcsuits' , 'uses' => 'TwoPieceController@index']);
Route::post('/design2pcsuits',['as' => 'design2pcsuits' , 'uses' => 'TwoPieceController@index']);

Route::post('/getfabricsjacket2',['as' => 'getfabricsjacket2' , 'uses' => 'TwoPieceController@getfabjacketdetails']);
Route::post('/getstylejacket2',['as' => 'getstylejacket2' , 'uses' => 'TwoPieceController@getstylejacketdetails']);
Route::post('/getcontrastsjacket2',['as' => 'getcontrastsjacket2' , 'uses' => 'TwoPieceController@getcontrastjacketdetails']);
Route::post('/getbuttonjacket2',['as' => 'getbuttonjacket2' , 'uses' => 'TwoPieceController@getbuttonjacketdetails']);
Route::post('/getthreadsjacket2',['as' => 'getthreadsjacket2' , 'uses' => 'TwoPieceController@getthreadjacketdetails']);
Route::post('/getmonogrmjacket2',['as' => 'getmonogrmjacket2' , 'uses' => 'TwoPieceController@getmonogramjacketdetails']);
Route::post('/getsetoptionsjacket2',['as' => 'getsetoptionsjacket2' , 'uses' => 'TwoPieceController@getoptionjacketdetails']);
Route::post('/measurjacket2',['as' => 'measurjacket2' , 'uses' => 'TwoPieceController@measurestdjacket']);
Route::post('/measurjacketdtls2',['as' => 'measurjacketdtls2' , 'uses' => 'TwoPieceController@measurestddetlsjacket']);

Route::post('/getfabricspant2',['as' => 'getfabricspant2' , 'uses' => 'TwoPieceController@getfabpantdetails']);
Route::post('/getstylepant2',['as' => 'getstylepant2' , 'uses' => 'TwoPieceController@getstylepantdetails']);
Route::post('/getsetoptionspant2',['as' => 'getsetoptionspant2' , 'uses' => 'TwoPieceController@getsetoptionpantdetails']);
Route::post('/measurpants2',['as' => 'measurpants2' , 'uses' => 'TwoPieceController@measurestdpant']);
Route::post('/measurpantsdtls2',['as' => 'measurpantsdtls2' , 'uses' => 'TwoPieceController@measurestddetlspant']);
Route::post('/measurpantid2',['as' => 'measurpantid2' , 'uses' => 'TwoPieceController@getPantBodyMeasurmentIdByJacket']);

Route::post('/designtwopiece/postcart',['as' => 'designtwopiece.postcart' , 'uses' => 'TwoPieceController@get_item']);
Route::get('/cart/twopiecedetails/{id?}',['as' => 'cart.twopiecedetails' , 'uses' => 'CartController@detailcart']);
/* =================== 2Piece Suits End ===================*/

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes(['verify' => true]);
Route::get('/cart',['as' => 'cart' , 'uses' => 'CartController@cart']);
Route::get('/cart/details/{id?}',['as' => 'detailcart' , 'uses' => 'CartController@detailcart']);
Route::get('/cart/jacketdetails/{id?}',['as' => 'cart.jacketdetails' , 'uses' => 'CartController@detailcart']);
Route::get('/cart/vestsdetails/{id?}',['as' => 'cart.vestsdetails' , 'uses' => 'CartController@detailcart']);
Route::get('/cart/paintdetails/{id?}',['as' => 'cart.paintdetails' , 'uses' => 'CartController@detailcart']);
/*single product detail*/

Route::get('/cart/productdetails/{id?}',['as' => 'cart.productdetails' , 'uses' => 'CartController@detailcart']);
/*single product detail*/

Route::post('/cart/coupan/{id?}',['as' => 'cart.coupan' , 'uses' => 'CartController@check_coupan']);
Route::delete('/cart/delete/{id?}',['as' => 'cart.delete' , 'uses' => 'CartController@del_cart_item']);
Route::get('/cartitems',['as' => 'cartitems' , 'uses' => 'CartController@cartitems']);
Route::delete('/cartitems/delete/{id?}',['as' => 'cartitems.delete' , 'uses' => 'CartController@del_cartitem']);
Route::get('/cartchk',['as' => 'cartchk' , 'uses' => 'CartController@cartchk']);
Route::get('/shipping-address', ['as' => 'shipping-address', 'uses' => 'ShippingAddress@shipping_address']);
Route::post('/shipping-address', ['as' => 'shipping-address', 'uses' => 'ShippingAddress@add_shipping_address']);
Route::get('/shipping-address/edit/{id?}', ['as' => 'shipping-address.edit', 'uses' => 'ShippingAddress@edit_shipping_address']);
Route::post('/shipping-address/edit/{id?}', ['as' => 'shipping-address.edit', 'uses' => 'ShippingAddress@update_shipping_address']);
Route::get('shipping-address/getstate/{sid?}', ['as' => 'shipping-address.getstate', 'uses' => 'ShippingAddress@get_statesName']);
Route::get('cartitems/coupanterm/{id?}', ['as' => 'cartitems.coupanterm', 'uses' => 'CartController@get_term_and_polices']);
Route::get('/home', 'HomeController@index')->middleware('verified');
/*order process*/

Route::any('/order',['as' => 'order' , 'uses' => 'OrderController@order']);
Route::get('/thankyou/{id?}',['as' => 'thankyou' , 'uses' => 'OrderController@thankyou']);
/*Profile Section*/
Route::group(['middleware' => 'auth'], function() {


        Route::get('/myaccount', ['as' => 'myaccount', 'uses' => 'MyAccount@myProfile']);
        Route::get('/myaccount/edit/', ['as' => 'myaccount.edit', 'uses' => 'MyAccount@myeditProfile']);
        Route::post('/myaccount/edit/', ['as' => 'myaccount.edit', 'uses' => 'MyAccount@myupdateProfile']);
        Route::get('/myaccount/orderlists/', ['as' => 'myaccount.orderlists', 'uses' => 'MyAccount@myOrderlistsProfile']);
        Route::get('/myaccount/orderdetails/{id?}', ['as' => 'myaccount.orderdetails', 'uses' => 'MyAccount@myOrderdetails']);
        Route::get('/myaccount/itemdetail/{id?}', ['as' => 'myaccount.itemdetail', 'uses' => 'MyAccount@itemdetail']);
        Route::get('/myaccount/jitemdetail/{id?}', ['as' => 'myaccount.itemdetail', 'uses' => 'MyAccount@itemdetail']);
        Route::get('/myaccount/vitemdetail/{id?}', ['as' => 'myaccount.itemdetail', 'uses' => 'MyAccount@itemdetail']);
        Route::get('/myaccount/pitemdetail/{id?}', ['as' => 'myaccount.itemdetail', 'uses' => 'MyAccount@itemdetail']);
        Route::get('myaccount/getstate/{sid?}', ['as' => 'myaccount.getstate', 'uses' => 'ShippingAddress@get_statesName']);
        Route::get('/myaccount/threepcitemdetail/{id?}', ['as' => 'myaccount.itemdetail', 'uses' => 'MyAccount@itemdetail']);
        Route::get('/myaccount/twopcitemdetail/{id?}', ['as' => 'myaccount.itemdetail', 'uses' => 'MyAccount@itemdetail']);
        /*single product detail*/

        Route::get('/myaccount/productdetail/{id?}', ['as' => 'myaccount.productdetail', 'uses' => 'MyAccount@itemdetail']);
        /*single product end detail*/

        Route::get('/myaccount/passwordchange/', ['as' => 'myaccount.passwordchange', 'uses' => 'MyAccount@passwordchange']);
        Route::post('/myaccount/passwordchange/', ['as' => 'myaccount.passwordchange', 'uses' => 'MyAccount@changepassword']);
        Route::get('/myaccount/refertofriend/', ['as' => 'myaccount.refertofriend', 'uses' => 'MyAccount@refer_friend']);
        Route::post('/myaccount/refertofriend/', ['as' => 'myaccount.refertofriend', 'uses' => 'MyAccount@referfriend']);
        Route::post('/myaccount/ordercancel/', ['as' => 'myaccount.ordercancel', 'uses' => 'MyAccount@orderCancels']);
        Route::post('/myaccount/orderitemcancel/', ['as' => 'myaccount.orderitemcancel', 'uses' => 'MyAccount@orderCancelsItem']);
        Route::post('/register/check_emails/{ids}', ['as' => 'register.check_emails', 'uses' => 'HomeController@check_email']);
        Route::get('/myaccount/invoice/{ids}', ['as' => 'invoice', 'uses' => 'MyAccount@OrderInvoice']);
        Route::get('/myaccount/wishlists/', ['as' => 'myaccount.wishlists', 'uses' => 'MyAccount@wish_userList']);
        Route::delete('/myaccount/wishlists/del/{id?}', ['as' => 'myaccount.wishlists.del', 'uses' => 'MyAccount@wish_userListdel']);
        /*END*/

});


Route::post('subscribe',['as'=>'subscribe','uses'=>'MailChimpController@subscribe']);
Route::group(['middleware' => 'verified'], function() {

        Route::get('paywithpaypal', array('as' => 'addmoney.paywithpaypal','uses' => 'AddMoneyController@payWithPaypal',));
        Route::post('paypal', array('as' => 'addmoney.paypal','uses' => 'AddMoneyController@postPaymentWithpaypal',));

        Route::get('paypal', array('as' => 'payment.status','uses' => 'AddMoneyController@getPaymentStatus'));
});
/*Review*/

Route::get('review', array('as' => 'review.review','uses' => 'ReviewController@review'));
Route::get('review/add/{id?}', array('as' => 'review.addreview','uses' => 'ReviewController@addreview'));
Route::post('review/add/{id?}', array('as' => 'review.submitreview','uses' => 'ReviewController@submitreview'));
/*Front Product */

Route::get('/ecollection/{id?}', ['as' => 'ecollection', 'uses' => 'ProductController@product_Lits']);
Route::get('/ecollection/{id?}/{c?}', ['as' => 'ecollection', 'uses' => 'ProductController@product_Filter']);
Route::get('/productdetails/{id?}', ['as' => 'productdetails', 'uses' => 'ProductController@productDetails']);
Route::get('/ecollection/{id?}/{c?}/{s?}', ['as' => 'ecollection', 'uses' => 'ProductController@product_Search']);
Route::post('/productdetails/{id?}', ['as' => 'productdetails', 'uses' => 'ProductController@productget']);

Route::post('/wishtocart/{id?}', ['as' => 'wishtocart', 'uses' => 'ProductController@wishtocart']);

Route::post('/sendlink/', ['as' => 'sendlink', 'uses' => 'ProductController@get_product_frientlink']);
Route::get('/wishlistproduct/{id?}', ['as' => 'wishlistproduct', 'uses' => 'ProductController@save_wishlist']);
/*Singal custom product*/
Route::get('shirtdetail/{id?}',['as' => 'shirtdetail' , 'uses' => 'ProductController@cusprodetail']);
Route::get('jacketdetails/{id?}',['as' => 'jacketdetails' , 'uses' => 'ProductController@cusprodetail']);
Route::get('vestsdetails/{id?}',['as' => 'vestsdetails' , 'uses' => 'ProductController@cusprodetail']);
Route::get('paintdetails/{id?}',['as' => 'paintdetails' , 'uses' => 'ProductController@cusprodetail']);
/*Singal custom product end*/
/*End Product*/

/*All Notification*/
Route::get('wishlistnotify',['as' => 'wishlistnotify' , 'uses' => 'NotifyController@wishlistnotify']);

/* NEW Advance 3D*/
Route::get('/advance3D' ,['as' => 'advance3D' , 'uses' => 'ThreeDController@index']);
Route::post('/get3Dfabrics',['as' => 'get3Dfabrics' , 'uses' => 'ThreeDController@getfabdetails']);
Route::post('/get3Dallfabrics',['as' => 'get3Dallfabrics' , 'uses' => 'ThreeDController@getallfabricsdetails']);
Route::post('/get3Dcollars',['as' => 'get3Dcollars' , 'uses' => 'ThreeDController@getcollardetails']);
Route::post('/get3Dsleeves',['as' => 'get3Dsleeves' , 'uses' => 'ThreeDController@getsleevedetails']);
Route::post('/get3Dfronts',['as' => 'get3Dfronts' , 'uses' => 'ThreeDController@getfrontdetails']);
Route::post('/get3Dcuffs',['as' => 'get3Dcuffs' , 'uses' => 'ThreeDController@getcuffdetails']);
Route::post('/get3Dbottoms',['as' => 'get3Dbottoms' , 'uses' => 'ThreeDController@getbottomdetails']);
Route::post('/get3Dbacks',['as' => 'get3Dbacks' , 'uses' => 'ThreeDController@getbackdetails']);
Route::post('/get3Dpockets',['as' => 'get3Dpockets' , 'uses' => 'ThreeDController@getpocketdetails']);
Route::post('/get3Dbuttons',['as' => 'get3Dbuttons' , 'uses' => 'ThreeDController@getbuttonsdetails']);
Route::post('/get3Dcontrast',['as' => 'get3Dcontrast' , 'uses' => 'ThreeDController@getcontrastdetails']);
Route::post('/get3Dcolrcontrast',['as' => 'get3Dcolrcontrast' , 'uses' => 'ThreeDController@getcolrcuffdetails']);
Route::post('/get3Depaulette',['as' => 'get3Depaulette' , 'uses' => 'ThreeDController@getepaulettedetails']);
Route::post('/get3Dfrontcontrast',['as' => 'get3Dfrontcontrast' , 'uses' => 'ThreeDController@getfrontcontrastdtls']);
Route::post('/get3Dbackcontrast',['as' => 'get3Dbackcontrast' , 'uses' => 'ThreeDController@getbackcontrastdtls']);
Route::post('/get3Dnumpockets',['as' => 'get3Dnumpockets' , 'uses' => 'ThreeDController@getnumpocketdtls']);
Route::post('/get3Dmgrmplace',['as' => 'get3Dmgrmplace' , 'uses' => 'ThreeDController@getmonoplacedtls']);
Route::post('/get3Dmgrmstyle',['as' => 'get3Dmgrmstyle' , 'uses' => 'ThreeDController@getmonostyledtls']);
Route::post('/get3Dmgrmtext',['as' => 'get3Dmgrmtext' , 'uses' => 'ThreeDController@getmonotextdtls']);
Route::post('/get3Dmgrmtextcolr',['as' => 'get3Dmgrmtextcolr' , 'uses' => 'ThreeDController@getmonotextcolordtls']);
Route::post('/advance3D/postcart',['as' => 'advance3D.postcart' , 'uses' => 'ThreeDController@get_item']);

Route::post('/advance3D/postfdataurl',['as' => 'advance3D.postfdataurl' , 'uses' => 'ThreeDController@postfdataurl']);
Route::post('/advance3D/postbdataurl',['as' => 'advance3D.postbdataurl' , 'uses' => 'ThreeDController@postbdataurl']);
/*END*/

/*Create dataurl to image in cart page*/

Route::post('/cart/dataurl',['as' => 'cart.dataurl' , 'uses' => 'CartController@dataurlimg']);
Route::post('/designshirts/postfdataurl',['as' => 'designshirts.postfdataurl' , 'uses' => 'DemoController@postfdataurl']);
Route::post('/designshirts/postbdataurl',['as' => 'designshirts.postbdataurl' , 'uses' => 'DemoController@postbdataurl']);

Route::post('/designjackets/postfdataurl',['as' => 'designjackets.postfdataurl' , 'uses' => 'JacketController@postfdataurl']);
Route::post('/designjackets/postbdataurl',['as' => 'designjackets.postbdataurl' , 'uses' => 'JacketController@postbdataurl']);

/*PayeezeGateway*/
Route::group(['middleware' => 'verified'], function() {
        Route::get('paywithpayeezy', array('as' => 'addpmoney.paywithpayeezy','uses' => 'PayeezyGatewayController@paywithpayeezy'));
        Route::get('renderingprocess/{id?}', array('as' => 'mymail','uses' => 'HomeController@renderingprocess'));
        Route::get('renderingprocesscont/{id?}', array('as' => 'mymail','uses' => 'HomeController@renderingprocesscont'));
});
Route::get('address/getstate/{sid?}', function($id){
        $states = App\State::where('country_id' , '=' ,$id)->get();
        return response()->json($states);
})->name('address.getstate');

