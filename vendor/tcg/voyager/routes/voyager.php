<?php

use Illuminate\Support\Str;
use TCG\Voyager\Events\Routing;
use TCG\Voyager\Events\RoutingAdmin;
use TCG\Voyager\Events\RoutingAdminAfter;
use TCG\Voyager\Events\RoutingAfter;
use TCG\Voyager\Facades\Voyager;

/*
|--------------------------------------------------------------------------
| Voyager Routes
|--------------------------------------------------------------------------
|
| This file is where you may override any of the routes that are included
| with Voyager.
|
*/

Route::group(['as' => 'voyager.'], function () {
    event(new Routing());

    $namespacePrefix = '\\'.config('voyager.controllers.namespace').'\\';

    Route::get('login', ['uses' => $namespacePrefix.'VoyagerAuthController@login',     'as' => 'login']);
    Route::post('login', ['uses' => $namespacePrefix.'VoyagerAuthController@postLogin', 'as' => 'postlogin']);

    Route::group(['middleware' => 'admin.user'], function () use ($namespacePrefix) {
        event(new RoutingAdmin());

        // Main Admin and Logout Route
        Route::get('/', ['uses' => $namespacePrefix.'VoyagerController@index',   'as' => 'dashboard']);
        Route::post('logout', ['uses' => $namespacePrefix.'VoyagerController@logout',  'as' => 'logout']);
        Route::post('upload', ['uses' => $namespacePrefix.'VoyagerController@upload',  'as' => 'upload']);

        Route::get('profile', ['uses' => $namespacePrefix.'VoyagerUserController@profile', 'as' => 'profile']);

        try {
            foreach (Voyager::model('DataType')::all() as $dataType) {
                $breadController = $dataType->controller
                                 ? Str::start($dataType->controller, '\\')
                                 : $namespacePrefix.'VoyagerBaseController';

                Route::get($dataType->slug.'/order', $breadController.'@order')->name($dataType->slug.'.order');
                Route::post($dataType->slug.'/action', $breadController.'@action')->name($dataType->slug.'.action');
                Route::post($dataType->slug.'/order', $breadController.'@update_order')->name($dataType->slug.'.update_order');
                Route::get($dataType->slug.'/{id}/restore', $breadController.'@restore')->name($dataType->slug.'.restore');
                Route::get($dataType->slug.'/relation', $breadController.'@relation')->name($dataType->slug.'.relation');
                Route::post($dataType->slug.'/remove', $breadController.'@remove_media')->name($dataType->slug.'.media.remove');
                Route::resource($dataType->slug, $breadController, ['parameters' => [$dataType->slug => 'id']]);
            }
        } catch (\InvalidArgumentException $e) {
            throw new \InvalidArgumentException("Custom routes hasn't been configured because: ".$e->getMessage(), 1);
        } catch (\Exception $e) {
            // do nothing, might just be because table not yet migrated.
        }

        // Menu Routes
        Route::group([
            'as'     => 'menus.',
            'prefix' => 'menus/{menu}',
        ], function () use ($namespacePrefix) {
            Route::get('builder', ['uses' => $namespacePrefix.'VoyagerMenuController@builder',    'as' => 'builder']);
            Route::post('order', ['uses' => $namespacePrefix.'VoyagerMenuController@order_item', 'as' => 'order_item']);

            Route::group([
                'as'     => 'item.',
                'prefix' => 'item',
            ], function () use ($namespacePrefix) {
                Route::delete('{id}', ['uses' => $namespacePrefix.'VoyagerMenuController@delete_menu', 'as' => 'destroy']);
                Route::post('/', ['uses' => $namespacePrefix.'VoyagerMenuController@add_item',    'as' => 'add']);
                Route::put('/', ['uses' => $namespacePrefix.'VoyagerMenuController@update_item', 'as' => 'update']);
            });
        });

        // Settings
        Route::group([
            'as'     => 'settings.',
            'prefix' => 'settings',
        ], function () use ($namespacePrefix) {
            Route::get('/', ['uses' => $namespacePrefix.'VoyagerSettingsController@index',        'as' => 'index']);
            Route::post('/', ['uses' => $namespacePrefix.'VoyagerSettingsController@store',        'as' => 'store']);
            Route::put('/', ['uses' => $namespacePrefix.'VoyagerSettingsController@update',       'as' => 'update']);
            Route::delete('{id}', ['uses' => $namespacePrefix.'VoyagerSettingsController@delete',       'as' => 'delete']);
            Route::get('{id}/move_up', ['uses' => $namespacePrefix.'VoyagerSettingsController@move_up',      'as' => 'move_up']);
            Route::get('{id}/move_down', ['uses' => $namespacePrefix.'VoyagerSettingsController@move_down',    'as' => 'move_down']);
            Route::put('{id}/delete_value', ['uses' => $namespacePrefix.'VoyagerSettingsController@delete_value', 'as' => 'delete_value']);
        });

        // Admin Media
        Route::group([
            'as'     => 'media.',
            'prefix' => 'media',
        ], function () use ($namespacePrefix) {
            Route::get('/', ['uses' => $namespacePrefix.'VoyagerMediaController@index',              'as' => 'index']);
            Route::post('files', ['uses' => $namespacePrefix.'VoyagerMediaController@files',              'as' => 'files']);
            Route::post('new_folder', ['uses' => $namespacePrefix.'VoyagerMediaController@new_folder',         'as' => 'new_folder']);
            Route::post('delete_file_folder', ['uses' => $namespacePrefix.'VoyagerMediaController@delete', 'as' => 'delete']);
            Route::post('move_file', ['uses' => $namespacePrefix.'VoyagerMediaController@move',          'as' => 'move']);
            Route::post('rename_file', ['uses' => $namespacePrefix.'VoyagerMediaController@rename',        'as' => 'rename']);
            Route::post('upload', ['uses' => $namespacePrefix.'VoyagerMediaController@upload',             'as' => 'upload']);
            Route::post('crop', ['uses' => $namespacePrefix.'VoyagerMediaController@crop',             'as' => 'crop']);
        });

        // BREAD Routes
        Route::group([
            'as'     => 'bread.',
            'prefix' => 'bread',
        ], function () use ($namespacePrefix) {
            Route::get('/', ['uses' => $namespacePrefix.'VoyagerBreadController@index',              'as' => 'index']);
            Route::get('{table}/create', ['uses' => $namespacePrefix.'VoyagerBreadController@create',     'as' => 'create']);
            Route::post('/', ['uses' => $namespacePrefix.'VoyagerBreadController@store',   'as' => 'store']);
            Route::get('{table}/edit', ['uses' => $namespacePrefix.'VoyagerBreadController@edit', 'as' => 'edit']);
            Route::put('{id}', ['uses' => $namespacePrefix.'VoyagerBreadController@update',  'as' => 'update']);
            Route::delete('{id}', ['uses' => $namespacePrefix.'VoyagerBreadController@destroy',  'as' => 'delete']);
            Route::post('relationship', ['uses' => $namespacePrefix.'VoyagerBreadController@addRelationship',  'as' => 'relationship']);
            Route::get('delete_relationship/{id}', ['uses' => $namespacePrefix.'VoyagerBreadController@deleteRelationship',  'as' => 'delete_relationship']);
        });

        // Database Routes
        Route::resource('database', $namespacePrefix.'VoyagerDatabaseController');

        // Compass Routes
        Route::group([
            'as'     => 'compass.',
            'prefix' => 'compass',
        ], function () use ($namespacePrefix) {
            Route::get('/', ['uses' => $namespacePrefix.'VoyagerCompassController@index',  'as' => 'index']);
            Route::post('/', ['uses' => $namespacePrefix.'VoyagerCompassController@index',  'as' => 'post']);
        });

        event(new RoutingAdminAfter());
    });

    //Asset Routes
    Route::get('voyager-assets', ['uses' => $namespacePrefix.'VoyagerController@assets', 'as' => 'voyager_assets']);

    event(new RoutingAfter());






/// CUSTOME MADE START FROM HERE//



  /*contrasts*/
  Route::get('contrastsdesign', ['uses' => $namespacePrefix.'VoyagerController@contrasts', 'as' => 'contrasts']);
  Route::get('contrastsdesign/create', ['uses' => $namespacePrefix.'VoyagerController@getcreate', 'as' => 'contrastsdesign.create']);
  Route::get('contrastsdesign/edit/{id?}', ['uses' => $namespacePrefix.'VoyagerController@getedit', 'as' => 'contrastsdesign.edit']);
  Route::post('contrastsdesign/edit/{id?}', ['uses' => $namespacePrefix.'VoyagerController@editpostdata', 'as' => 'contrastsdesign.edit']);
  Route::delete('contrastsdesign/delete/{id?}', ['uses' => $namespacePrefix.'VoyagerController@deleteBread', 'as' => 'contrastsdesign.delete']);
  Route::post('contrastsdesign/create', ['uses' => $namespacePrefix.'VoyagerController@postdata', 'as' => 'contrastsdesign.create']);
  Route::get('contrastsdesign/fabric/{id?}', ['uses' => $namespacePrefix.'VoyagerController@contrasts_create', 'as' => 'contrastsdesign.fabric']);
  Route::get('contrastsdesign/option/{id?}/{tt?}', ['uses' => $namespacePrefix.'VoyagerController@contrasts_otion_create', 'as' => 'contrastsdesign.option']);
  Route::post('contrastsdesign/option/{id?}/{tt?}', ['uses' => $namespacePrefix.'VoyagerController@contrasts_otion_add', 'as' => 'contrastsdesign.option']);
  Route::get('contrastsdesign/edit/option/{id?}', ['uses' => $namespacePrefix.'VoyagerController@contrasts_otion_edit', 'as' => 'contrastsdesign.edit.option']);
  Route::post('contrastsdesign/edit/option/{id?}', ['uses' => $namespacePrefix.'VoyagerController@contrasts_otion_post', 'as' => 'contrastsdesign.edit.option']);
  Route::delete('contrastsdesign/del/option/{id?}', ['uses' => $namespacePrefix.'VoyagerController@contrasts_otion_del', 'as' => 'contrastsdesign.del.option']);



  /*Fabric*/
  Route::get('fabric', ['uses' => $namespacePrefix.'FabricDesignController@index', 'as' => 'fabric']);
  Route::get('fabric/create', ['uses' => $namespacePrefix.'FabricDesignController@fabric_create', 'as' => 'fabric.create']);
  Route::post('fabric/create', ['uses' => $namespacePrefix.'FabricDesignController@fabric_post_data', 'as' => 'fabric.create']);
  Route::get('fabric/edit/{id?}', ['uses' => $namespacePrefix.'FabricDesignController@fabric_edit', 'as' => 'fabric.edit']);
  Route::post('fabric/edit/{id?}', ['uses' => $namespacePrefix.'FabricDesignController@fabric_post', 'as' => 'fabric.post']);






        /*Continue Shopping*/    
        Route::get('continueshopping', ['uses' => $namespacePrefix.'CommonDesignController@get_continueshopping', 'as' => 'continueshopping']);
        Route::post('continueshopping', ['uses' => $namespacePrefix.'CommonDesignController@save_continueshopping', 'as' => 'continueshopping']);
        


        /*Piping*/
        Route::get('piping/styleimg' ,function() { return Redirect::to('/admin/piping/');});
        Route::get('fabricdesigncreate' ,function() {return Redirect::to('/admin/fabric/');}); 
        Route::get('fabricdesign' ,function() { return Redirect::to('/admin/fabric/'); });
        Route::get('fabricdesignoptionedit' ,function() { return Redirect::to('/admin/fabric/');});

        /*user status*/
        Route::get('users/status/{id?}/{status?}', ['uses' => $namespacePrefix.'CommonDesignController@status_userblock', 'as' => 'users.status']);
        /*End*/
        Route::get('piping' ,['uses' => $namespacePrefix.'CommonDesignController@get_piping' , 'as' => 'piping']);
        Route::get('piping/create' ,['uses' => $namespacePrefix.'CommonDesignController@get_piping_create' , 'as' => 'piping.create']);
        Route::post('piping/create' ,['uses' => $namespacePrefix.'CommonDesignController@post_piping_create' , 'as' => 'piping.create']);
        Route::get('piping/edit/{id?}' ,['uses' => $namespacePrefix.'CommonDesignController@edit_piping' , 'as' => 'piping.edit']);
        Route::post('piping/edit/{id?}' ,['uses' => $namespacePrefix.'CommonDesignController@edit_update_piping' , 'as' => 'piping.edit']);
        Route::delete('piping/del/{id?}', ['uses' => $namespacePrefix.'CommonDesignController@piping_del', 'as' => 'piping.del']);


        /*Coller Color*/
        Route::get('colorcoller' ,['uses' => $namespacePrefix.'CommonDesignController@get_colorcoller' , 'as' => 'colorcoller']);
        Route::get('colorcoller/create' ,['uses' => $namespacePrefix.'CommonDesignController@add_colorcoller' , 'as' => 'colorcoller.create']);
        Route::post('colorcoller/create' ,['uses' => $namespacePrefix.'CommonDesignController@save_colorcoller' , 'as' => 'colorcoller.create']);
        Route::get('colorcoller/edit/{id?}' ,['uses' => $namespacePrefix.'CommonDesignController@edit_colorcoller' , 'as' => 'colorcoller.edit']);
        Route::post('colorcoller/edit/{id?}' ,['uses' => $namespacePrefix.'CommonDesignController@update_edit_colorcoller' , 'as' => 'colorcoller.edit']);
        Route::delete('colorcoller/del/{id?}', ['uses' => $namespacePrefix.'CommonDesignController@colorcoller_del', 'as' => 'colorcoller.del']);



        /*Piping Style*/
        Route::get('piping/styleimg/{id}/{cat_id?}' ,['uses' => $namespacePrefix.'CommonDesignController@add_styleimg_piping' , 'as' => 'piping.styleimg']);
        Route::post('piping/styleimg/{id}/{cat_id?}' ,['uses' => $namespacePrefix.'CommonDesignController@save_styleimg_piping' , 'as' => 'piping.styleimg']);
        Route::get('piping/styleimg/edit/{id}/{cat_id?}' ,['uses' => $namespacePrefix.'CommonDesignController@edit_styleimg_piping' , 'as' => 'piping.styleimg.edit']);
        Route::post('piping/styleimg/edit/{id}/{cat_id?}' ,['uses' => $namespacePrefix.'CommonDesignController@edit_update_styleimg_piping' , 'as' => 'piping.styleimg.edit']);


        /*Lining Fabric Jacket And Vests*/
        Route::get('linings'  ,['uses' => $namespacePrefix.'CommonDesignController@get_lining' , 'as' => 'linings']);
        Route::get('linings.create'  ,['uses' => $namespacePrefix.'CommonDesignController@add_lining' , 'as' => 'linings.create']);
        Route::post('linings.create'  ,['uses' => $namespacePrefix.'CommonDesignController@save_lining_fabric' , 'as' => 'linings.create']);
        Route::get('linings/{id}/edit'  ,['uses' => $namespacePrefix.'CommonDesignController@edit_lining_fabric' , 'as' => 'linings.edit']);
        Route::post('linings/{id}/edit'  ,['uses' => $namespacePrefix.'CommonDesignController@update_lining_fabric' , 'as' => 'linings.edit']);
        Route::get('linings/{id}/desgin'  ,['uses' => $namespacePrefix.'CommonDesignController@getdesging_lining_fabric' , 'as' => 'linings.desgin']);
        Route::get('linings/{id?}/desgin.add/{ids?}'  ,['uses' => $namespacePrefix.'CommonDesignController@add_desging_lining_fabric' , 'as' => 'linings.desgin.add']);
        Route::post('linings/{id?}/desgin.add/{ids?}'  ,['uses' => $namespacePrefix.'CommonDesignController@save_desging_lining_fabric' , 'as' => 'linings.desgin.add']);
        Route::get('linings/{id}/fabricdesgine.edit/'  ,['uses' => $namespacePrefix.'CommonDesignController@edit_fabdesging_lining' , 'as' => 'linings.fabricdesgine.edit']);
        Route::post('linings/{id}/fabricdesgine.edit/'  ,['uses' => $namespacePrefix.'CommonDesignController@update_fabdesging_lining' , 'as' => 'linings.fabricdesgine.edit']);
        Route::delete('linings/fabricdesgine/del/{id}'  ,['uses' => $namespacePrefix.'CommonDesignController@delete_fabdesging_lining' , 'as' => 'linings.fabricdesgine.del']);
        Route::delete('linings/desgin/del/{id}'  ,['uses' => $namespacePrefix.'CommonDesignController@delete_fabric_lining' , 'as' => 'linings.desgin.del']);



        /*Contrast Collor*/
        Route::get('contrastsdesign/collar/{id?}', ['uses' => $namespacePrefix.'VoyagerController@collar_create', 'as' => 'contrastsdesign.collar']);
        Route::get('contrastsdesign/collar/add/{id?}/{tt?}', ['uses' => $namespacePrefix.'VoyagerController@contrasts_collar_create', 'as' => 'contrastsdesign.collar.create']);
        Route::post('contrastsdesign/collar/add/{id?}/{tt?}', ['uses' => $namespacePrefix.'VoyagerController@contrasts_collar_add', 'as' => 'contrastsdesign.collar.create']);
        Route::get('contrastsdesign/collar/edit/{id?}/{tt?}', ['uses' => $namespacePrefix.'VoyagerController@contrasts_collar_edit', 'as' => 'contrastsdesign.collar.edit']);
        Route::post('contrastsdesign/collar/edit/{id?}/{tt?}', ['uses' => $namespacePrefix.'VoyagerController@contrasts_collar_post', 'as' => 'contrastsdesign.collar.edit']);
        Route::delete('contrastsdesign/collar/del/{id?}', ['uses' => $namespacePrefix.'VoyagerController@contrasts_collar_del', 'as' => 'contrastsdesign.collar.del']);



        /*Button*/
        Route::get('button', ['uses' => $namespacePrefix.'VoyagerButtonController@buttons', 'as' => 'buttons']);
        Route::get('button/create', ['uses' => $namespacePrefix.'VoyagerButtonController@getcreate', 'as' => 'button.create']);
        Route::post('button/create', ['uses' => $namespacePrefix.'VoyagerButtonController@postdata', 'as' => 'button.create']);
        Route::get('button/edit/{id?}', ['uses' => $namespacePrefix.'VoyagerButtonController@getedit', 'as' => 'button.edit']);
        Route::post('button/edit/{id?}', ['uses' => $namespacePrefix.'VoyagerButtonController@editpostdata', 'as' => 'button.edit']);
        Route::delete('button/delete/{id?}', ['uses' => $namespacePrefix.'VoyagerButtonController@deleteButton', 'as' => 'button.delete']);
        Route::get('button/style/{id?}', ['uses' => $namespacePrefix.'VoyagerButtonController@buttstyle_view', 'as' => 'button.style']);
        Route::get('button/style/create/{id?}/{tt?}', ['uses' => $namespacePrefix.'VoyagerButtonController@buttstyle_create', 'as' => 'button.style.create']);
        Route::post('button/style/create/{id?}/{tt?}', ['uses' => $namespacePrefix.'VoyagerButtonController@buttstyle_create_add', 'as' => 'button.style.create']);
        Route::get('button/style/edit/{id?}/{tt?}', ['uses' => $namespacePrefix.'VoyagerButtonController@buttstyle_edit', 'as' => 'button.style.edit']);
        Route::post('button/style/edit/{id?}/{tt?}', ['uses' => $namespacePrefix.'VoyagerButtonController@buttstyle_create_edit', 'as' => 'button.style.edit']);
        Route::delete('button/style/delete/{id?}', ['uses' => $namespacePrefix.'VoyagerButtonController@buttstyle_deleteButton', 'as' => 'button.style.delete']);

        /*TH*/
        Route::get('thread' ,['uses' => $namespacePrefix.'ThreadDesignController@threads' , 'as' => 'thread']);
        Route::get('thread/create', ['uses' => $namespacePrefix.'ThreadDesignController@getcreate', 'as' => 'thread.create']);
        Route::post('thread/create', ['uses' => $namespacePrefix.'ThreadDesignController@postdata', 'as' => 'thread.create']);
        Route::get('thread/edit/{id?}', ['uses' => $namespacePrefix.'ThreadDesignController@getedit', 'as' => 'thread.edit']);
        Route::post('thread/edit/{id?}', ['uses' => $namespacePrefix.'ThreadDesignController@editpostdata', 'as' => 'thread.edit']);
        Route::delete('thread/delete/{id?}', ['uses' => $namespacePrefix.'ThreadDesignController@deletethread', 'as' => 'thread.delete']);
        Route::get('thread/style/{id?}', ['uses' => $namespacePrefix.'ThreadDesignController@thread_style_view', 'as' => 'thread.style']);
        Route::get('thread/style/create/{id?}/{tt?}', ['uses' => $namespacePrefix.'ThreadDesignController@thread_style_create', 'as' => 'thread.style.create']);
        Route::post('thread/style/create/{id?}/{tt?}', ['uses' => $namespacePrefix.'ThreadDesignController@thread_style_create_add', 'as' => 'thread.style.create']);
        Route::get('thread/style/edit/{id?}/{tt?}', ['uses' => $namespacePrefix.'ThreadDesignController@thread_style_edit', 'as' => 'thread.style.edit']);
        Route::post('thread/style/edit/{id?}/{tt?}', ['uses' => $namespacePrefix.'ThreadDesignController@thread_style_create_edit', 'as' => 'thread.style.edit']);
        Route::delete('thread/style/delete/{id?}', ['uses' => $namespacePrefix.'ThreadDesignController@thread_style_deleteButton', 'as' => 'thread.style.delete']);



    /*Body size*/
    Route::get('bodymeasurments', ['uses' => $namespacePrefix.'CommonDesignController@get_bodymeasurments', 'as' => 'bodymeasurments']);
    Route::get('bodymeasurments/shirts', ['uses' => $namespacePrefix.'CommonDesignController@get_bodymeasurmentsshirt', 'as' => 'bodymeasurmentsshirt']);
    Route::get('bodymeasurments/jackets', ['uses' => $namespacePrefix.'CommonDesignController@get_bodymeasurmentsjackets', 'as' => 'bodymeasurmentsjackets']);
    Route::get('bodymeasurments/vests', ['uses' => $namespacePrefix.'CommonDesignController@get_bodymeasurmentsvests', 'as' => 'bodymeasurmentsvests']);
    Route::get('bodymeasurments/pants', ['uses' => $namespacePrefix.'CommonDesignController@get_bodymeasurmentspants', 'as' => 'bodymeasurmentspants']);
    
    Route::get('bodymeasurments/create', ['uses' => $namespacePrefix.'CommonDesignController@add_bodymeasurments', 'as' => 'bodymeasurments.create']);
    Route::post('bodymeasurments/create', ['uses' => $namespacePrefix.'CommonDesignController@save_bodymeasurments', 'as' => 'bodymeasurments.create']);
    Route::get('bodymeasurments/edit/{id?}', ['uses' => $namespacePrefix.'CommonDesignController@edit_bodymeasurments', 'as' => 'bodymeasurments.edit']);
    Route::post('bodymeasurments/edit/{id?}', ['uses' => $namespacePrefix.'CommonDesignController@editsave_bodymeasurments', 'as' => 'bodymeasurments.edit']);
    Route::delete('bodymeasurments/del/{id?}', ['uses' => $namespacePrefix.'CommonDesignController@del_bodymeasurments', 'as' => 'bodymeasurments.del']);


    /*Fabric deduct management*/    
    Route::get('fabricmeasurments', ['uses' => $namespacePrefix.'CommonDesignController@get_fabricmeasurments', 'as' => 'fabricmeasurments']);
    Route::post('fabricmeasurments', ['uses' => $namespacePrefix.'CommonDesignController@save_fabricmeasurments', 'as' => 'fabricmeasurments']);


    /*SMS Bulk*/
    Route::get('smspromotion', ['uses' => $namespacePrefix.'CatalogManagementController@get_smspromotion', 'as' => 'smspromotion']);
    Route::post('smspromotion', ['uses' => $namespacePrefix.'CatalogManagementController@send_smspromotion', 'as' => 'smspromotion']);
    Route::delete('smspromotion/delete/{id?}', ['uses' => $namespacePrefix.'CatalogManagementController@del_smspromotion', 'as' => 'smspromotion.delete']);

            

        /*Campaign Manager*/
        Route::get('campaign', ['uses' => $namespacePrefix.'CampaignController@get_camaign_list', 'as' => 'campaign']);
        Route::get('campaign/create', ['uses' => $namespacePrefix.'CampaignController@add_camaign_list', 'as' => 'campaign.create']);
        Route::post('campaign/create', ['uses' => $namespacePrefix.'CampaignController@add_camaign_post', 'as' => 'campaign.create']);
        Route::get('campaign/edit/{id?}', ['uses' => $namespacePrefix.'CampaignController@edit_camaign_data', 'as' => 'campaign.edit']);
        Route::post('campaign/edit/{id?}', ['uses' => $namespacePrefix.'CampaignController@update_camaign_data', 'as' => 'campaign.edit']);
        Route::delete('campaign/del/{id?}', ['uses' => $namespacePrefix.'CampaignController@campaign_del', 'as' => 'campaign.del']);
        Route::get('campaign/getstate/{country_id?}',['uses' => $namespacePrefix.'CampaignController@getStateList', 'as' => 'campaign.getstate']);

    

        /*Fabric Managment*/
        Route::get('fabricrecords', ['uses' => $namespacePrefix.'CatalogManagementController@get_fabricmgm', 'as' => 'fabricrecords']);        
        Route::get('contrastrecords', ['uses' => $namespacePrefix.'CatalogManagementController@get_contastmgm', 'as' => 'contrastrecords']);        
        Route::get('orderrecords', ['uses' => $namespacePrefix.'CatalogManagementController@get_ordersmgm', 'as' => 'orderrecords']); 
        Route::get('orderinvoice/{id?}', ['uses' => $namespacePrefix.'CatalogManagementController@get_orderinvoice', 'as' => 'orderinvoice']); 
        Route::get('orderitems/{id?}', ['uses' => $namespacePrefix.'CatalogManagementController@get_orderlist', 'as' => 'orderitems']); 
        Route::get('shirtdetail/{id?}', ['uses' => $namespacePrefix.'CatalogManagementController@get_orderitemview', 'as' => 'shirtdetail']); 
        Route::get('jacketdetail/{id?}', ['uses' => $namespacePrefix.'CatalogManagementController@get_orderitemview', 'as' => 'jacketdetail']);
        Route::get('threepiecedetail/{id?}', ['uses' => $namespacePrefix.'CatalogManagementController@get_orderitemview', 'as' => 'threepiecedetail']);
        Route::get('twopiecedetail/{id?}', ['uses' => $namespacePrefix.'CatalogManagementController@get_orderitemview', 'as' => 'twopiecedetail']); 
        Route::get('vestsdetail/{id?}', ['uses' => $namespacePrefix.'CatalogManagementController@get_orderitemview', 'as' => 'vestsdetail']); 
        
        /*product detaol*/
        Route::get('productdetail/{id?}', ['uses' => $namespacePrefix.'CatalogManagementController@get_orderitemview', 'as' => 'productdetail']); 
        /*end product detail*/
        Route::get('pantsdetail/{id?}', ['uses' => $namespacePrefix.'CatalogManagementController@get_orderitemview', 'as' => 'pantsdetail']);  
        //// unknow
        Route::post('orderrecords/cancelrequest/', ['uses' => $namespacePrefix.'CatalogManagementController@cancel_Changestatus', 'as' => 'orderrecords.cancelrequest']); 
        Route::post('orderrecords/cancelitemrequest/', ['uses' => $namespacePrefix.'CatalogManagementController@cancel_Change_itemstatus', 'as' => 'orderrecords.cancelitemrequest']); 
        Route::post('orderrecords/changestatus/', ['uses' => $namespacePrefix.'CatalogManagementController@get_changestatus', 'as' => 'orderrecords.changestatus']);
        Route::post('orderrecords/ordersms/', ['uses' => $namespacePrefix.'CatalogManagementController@snd_ordersms', 'as' => 'orderrecords.ordersms']);
        Route::get('cancelrequest', ['uses' => $namespacePrefix.'CatalogManagementController@get_cancelprocess', 'as' => 'cancelrequest']);  
        Route::get('cancelrequest/{id?}', ['uses' => $namespacePrefix.'CatalogManagementController@get_cancelprocess_item', 'as' => 'cancelrequest']);  

        Route::get('orderrecords/getexcel/{type?}', ['uses' => $namespacePrefix.'CatalogManagementController@get_excel_file_data', 'as' => 'orderrecords.getexcel']);  
        /*ENd*/

        
        /*Custom product*/
        Route::get('productslists/customedit/{id?}', ['uses' => $namespacePrefix.'ProductsController@customproduct_editid', 'as' => 'customproduct.edit']);
        Route::post('productslists/customedit/{id?}', ['uses' => $namespacePrefix.'ProductsController@customproduct_saveid', 'as' => 'customproduct.edit']);
        Route::get('productslists/customprodetail/{id?}', ['uses' => $namespacePrefix.'ProductsController@get_custommview', 'as' => 'customprodetail']);
        /*Custom product end*/

        /*Shiping Rate*/
        Route::get('shippingrates', ['uses' => $namespacePrefix.'CommonDesignController@get_shipingrate', 'as' => 'shippingrates']);
        Route::get('shippingrates/create', ['uses' => $namespacePrefix.'CommonDesignController@add_shipingrate', 'as' => 'shippingrates.create']);
        Route::post('shippingrates/create', ['uses' => $namespacePrefix.'CommonDesignController@add_shipingrate_post', 'as' => 'shippingrates.create']);
        Route::get('shippingrates/edit/{id?}', ['uses' => $namespacePrefix.'CommonDesignController@edit_shipingrate_data', 'as' => 'shippingrates.edit']);
        Route::post('shippingrates/edit/{id?}', ['uses' => $namespacePrefix.'CommonDesignController@update_shipingrate_data', 'as' => 'shippingrates.edit']);
        Route::get('shippingrates/status/{id?}/{status?}', ['uses' => $namespacePrefix.'CommonDesignController@status_shipingrate_data', 'as' => 'shippingrates.status']);
        Route::delete('shippingrates/del/{id?}', ['uses' => $namespacePrefix.'CommonDesignController@shipingrate_del', 'as' => 'shippingrates.del']);

        

       // Route::get('fabricdesign/{$id}', $namespacePrefix.'VoyagerFabricDesignController@fabricgroup');
       Route::get('fabricdesign/{id?}', ['uses' => $namespacePrefix.'VoyagerFabricDesignController@fabricGroup', 'as' => 'fabricdesign']);
       Route::get('fabricdesigncreate/{id}/{fb?}', ['uses' => $namespacePrefix.'VoyagerFabricDesignController@createdata', 'as' => 'createdata']);
       Route::post('fabricdesigncreate/{id}/{fb?}', ['uses' => $namespacePrefix.'VoyagerFabricDesignController@addfabimglist', 'as' => 'addfabimglist']);
       Route::get('fabricdesignedit/{id?}', ['uses' => $namespacePrefix.'VoyagerFabricDesignController@editdata', 'as' => 'editdata']);
       Route::post('fabricdesignedit/{id?}', ['uses' => $namespacePrefix.'VoyagerFabricDesignController@editfabimglist', 'as' => 'editfabimglist']);
       Route::delete('fabricdesigndelete/{id?}', ['uses' => $namespacePrefix.'VoyagerFabricDesignController@deletedata', 'as' => 'deletedata']);

        // fabric auto create
        Route::get('fabricdesignautocreate/{id}/{fb?}', ['uses' => $namespacePrefix.'VoyagerFabricDesignController@autocreatedata', 'as' => 'autocreatedata']);
        Route::post('fabricdesignautocreate/{id}/{fb?}', ['uses' => $namespacePrefix.'VoyagerFabricDesignController@autoaddfabimglist', 'as' => 'autoaddfabimglist']);
       
              //option image of fabric
       Route::get('fabricdesignoption/{id?}/{fb?}', ['uses' => $namespacePrefix.'VoyagerFabricDesignController@createoption', 'as' => 'createoption']);
       Route::post('fabricdesignoption/{id}/{fb?}', ['uses' => $namespacePrefix.'VoyagerFabricDesignController@addfaboption', 'as' => 'addfaboption']);
       Route::get('fabricdesignoptionedit/{id?}', ['uses' => $namespacePrefix.'VoyagerFabricDesignController@editoption', 'as' => 'editoption']);
       Route::post('fabricdesignoptionedit/{id?}', ['uses' => $namespacePrefix.'VoyagerFabricDesignController@editoptionlist', 'as' => 'editoptionlist']);
               //Jacket fabric design  
       Route::get('jacketdesign/{id?}', ['uses' => $namespacePrefix.'JacketController@jacketGroup', 'as' => 'jacketdesign']);
       Route::get('jacketdesign/add/{id}/{fb?}', ['uses' => $namespacePrefix.'JacketController@adddata', 'as' => 'jacketdesign']);
       Route::post('jacketdesign/add/{id}/{fb?}', ['uses' => $namespacePrefix.'JacketController@addjacketlist', 'as' => 'addjacketlist']);
       Route::get('jacketdesign/edit/{id}/{fb?}', ['uses' => $namespacePrefix.'JacketController@editdata', 'as' => 'editdata']);
       Route::post('jacketdesign/edit/{id}/{fb?}', ['uses' => $namespacePrefix.'JacketController@editjacketlist', 'as' => 'editjacketlist']);
       Route::delete('jacketdesign/delete/{id}/{fb?}', ['uses' => $namespacePrefix.'JacketController@deletedata', 'as' => 'deletedata']);
               //Jacket Collar
       Route::get('jacketcollar/{id?}', ['uses' => $namespacePrefix.'JacketController@jacketCollar', 'as' => 'jacketcollar']);
       Route::get('jacketcollar/add/{id?}', ['uses' => $namespacePrefix.'JacketController@addcollardata', 'as' => 'addcollardata']);
       Route::post('jacketcollar/add/{id?}', ['uses' => $namespacePrefix.'JacketController@addjacketcollarlist', 'as' => 'addjacketcollarlist']);
       Route::get('jacketcollar/edit/{id?}', ['uses' => $namespacePrefix.'JacketController@editcollardata', 'as' => 'editcollardata']);
       Route::post('jacketcollar/edit/{id?}', ['uses' => $namespacePrefix.'JacketController@editjacketcollarlist', 'as' => 'editjacketcollarlist']);
       Route::delete('jacketcollar/delete/{id?}', ['uses' => $namespacePrefix.'JacketController@deletejacketcollarlist', 'as' => 'deletejacketcollarlist']);

       //JV Contrast Collar
       Route::get('contrast/{cid?}/{id?}', ['uses' => $namespacePrefix.'JVContrastController@jvContrast', 'as' => 'jvContrast']);
       Route::get('contrast/add/{cid?}/{id?}', ['uses' => $namespacePrefix.'JVContrastController@addContrast', 'as' => 'contrast.add']);
       Route::post('contrast/add/{cid?}/{id?}', ['uses' => $namespacePrefix.'JVContrastController@addcontrastdata', 'as' => 'contrastdata.add']);
       Route::get('editcontrast/edit/{cid?}/{id?}', ['uses' => $namespacePrefix.'JVContrastController@editContrast', 'as' => 'editcontrast.edit']);
       Route::post('editcontrast/edit/{cid?}/{id?}', ['uses' => $namespacePrefix.'JVContrastController@editcontrastdata', 'as' => 'editcontrast.edit']);
       Route::delete('contrastsdel/delete/{id?}', ['uses' => $namespacePrefix.'JVContrastController@contrastsdel', 'as' => 'contrastsdel.del']);
               //Jacket option image of fabric
       Route::get('jacketfaboption/add/{id?}/{fb?}', ['uses' => $namespacePrefix.'JacketController@jvcreateoption', 'as' => 'jvcreateoption.add']);
       Route::post('jacketfaboption/add/{id?}/{fb?}', ['uses' => $namespacePrefix.'JacketController@jvaddfaboption', 'as' => 'jvaddfaboption.add']);
       Route::get('jacketfaboption/edit/{id?}', ['uses' => $namespacePrefix.'JacketController@jveditfaboption', 'as' => 'jveditfaboption.edit']);
       Route::post('jacketfaboption/edit/{id?}', ['uses' => $namespacePrefix.'JacketController@jveditoptionlist', 'as' => 'jveditoptionlist.edit']);
               //Vest Collar Controlar
       Route::get('vestcollar/{id?}', ['uses' => $namespacePrefix.'VestController@vestCollar', 'as' => 'vestcollar']);
       Route::get('vestcollar/add/{id?}', ['uses' => $namespacePrefix.'VestController@addvestcollardata', 'as' => 'addvestcollardata']);
       Route::post('vestcollar/add/{id?}', ['uses' => $namespacePrefix.'VestController@addvestcollarlist', 'as' => 'addvestcollarlist']);
       Route::get('vestcollar/edit/{id?}', ['uses' => $namespacePrefix.'VestController@editvestcollardata', 'as' => 'editvestcollardata']);
       Route::post('vestcollar/edit/{id?}', ['uses' => $namespacePrefix.'VestController@editjacketcollarlist', 'as' => 'editjacketcollarlist']);
       Route::delete('vestcollar/delete/{id?}', ['uses' => $namespacePrefix.'VestController@deletevestcollarlist', 'as' => 'deletevestcollarlist']);
                //Measurment Video
       Route::get('measurmentvideo', ['uses' => $namespacePrefix.'MeasurmentController@measurment', 'as' => 'measurmentvideo']);
       Route::get('measurmentvideo/create', ['uses' => $namespacePrefix.'MeasurmentController@addmeasurmentvideo', 'as' => 'measurmentvideo.create']);
       Route::post('measurmentvideo/create', ['uses' => $namespacePrefix.'MeasurmentController@addvideodata', 'as' => 'measurmentvideo.create']);
       Route::get('measurmentvideo/edit/{id?}', ['uses' => $namespacePrefix.'MeasurmentController@editvideodata', 'as' => 'measurmentvideo.edit']);
       Route::post('measurmentvideo/edit/{id?}', ['uses' => $namespacePrefix.'MeasurmentController@editvideodata', 'as' => 'measurmentvideo.edit']);
       /*GROUP*/
       Route::get('fabricgroups', ['uses' => $namespacePrefix.'VoyagerFabricDesignController@get_fabricGP', 'as' => 'fabricgroups']);
       Route::get('fabricgroups/create', ['uses' => $namespacePrefix.'VoyagerFabricDesignController@add_fabricGP', 'as' => 'fabricgroups.create']);
       Route::post('fabricgroups/create', ['uses' => $namespacePrefix.'VoyagerFabricDesignController@save_fabricGP', 'as' => 'fabricgroups.create']);
       Route::get('fabricgroups/edit/{id?}', ['uses' => $namespacePrefix.'VoyagerFabricDesignController@edit_fabricGP', 'as' => 'fabricgroups.edit']);
       Route::post('fabricgroups/edit/{id?}', ['uses' => $namespacePrefix.'VoyagerFabricDesignController@update_fabricGP', 'as' => 'fabricgroups.edit']);
       
       Route::delete('fabricgroups/delete/{id?}', ['uses' => $namespacePrefix.'VoyagerFabricDesignController@del_fabricGP', 'as' => 'fabricgroups.delete']);
       
       /*Review*/
       Route::get('review', ['uses' => $namespacePrefix.'ReviewController@review', 'as' => 'review']);
       Route::get('review/create', ['uses' => $namespacePrefix.'ReviewController@reviewcreate', 'as' => 'review.create']);
       Route::post('review/create', ['uses' => $namespacePrefix.'ReviewController@reviewadd', 'as' => 'review.create']);
       Route::get('review/edit/{id?}', ['uses' => $namespacePrefix.'ReviewController@reviewedit', 'as' => 'review.edit']);
       Route::post('review/edit/{id?}', ['uses' => $namespacePrefix.'ReviewController@revieweditsubmit', 'as' => 'review.edit']);
       Route::delete('review/delete/{id?}', ['uses' => $namespacePrefix.'ReviewController@deleteButton', 'as' => 'review.delete']);
       
       Route::get('b2b', ['uses' => $namespacePrefix.'OthersPagesController@get_b2b_data', 'as' => 'b2b']);
       Route::delete('b2b/delete/{id?}', ['uses' => $namespacePrefix.'OthersPagesController@del_b2b_data', 'as' => 'b2b.delete']);
       Route::get('b2b/view/{id?}', ['uses' => $namespacePrefix.'OthersPagesController@get_b2b_view', 'as' => 'b2b.view']);
       Route::get('webcontact', ['uses' => $namespacePrefix.'OthersPagesController@get_webcontact_data', 'as' => 'webcontact']);
       Route::delete('webcontact/delete/{id?}', ['uses' => $namespacePrefix.'OthersPagesController@del_webcontact_data', 'as' => 'webcontact.delete']);
       Route::get('webcontact/view/{id?}', ['uses' => $namespacePrefix.'OthersPagesController@get_webcontact_view', 'as' => 'webcontact.view']);
       /*Tax deduct management*/    
       Route::get('tax', ['uses' => $namespacePrefix.'TaxController@get_tax', 'as' => 'tax']);
       Route::post('tax', ['uses' => $namespacePrefix.'TaxController@save_tax', 'as' => 'tax']);
       Route::get('promotion_img', ['uses' => $namespacePrefix.'CommonDesignController@get_promotionImg', 'as' => 'promotion_img']);
       Route::post('promotion_img', ['uses' => $namespacePrefix.'CommonDesignController@save_promotionImg', 'as' => 'promotion_img']);
       
       Route::get('shirtjobcart/{id?}', ['uses' => $namespacePrefix.'CatalogManagementController@shirtjobcart', 'as' => 'shirtjobcart']);
       Route::get('jacketjobcart/{id?}', ['uses' => $namespacePrefix.'CatalogManagementController@jacketjobcart', 'as' => 'jacketjobcart']);
       
       Route::get('users/useradd/{id?}', ['uses' => $namespacePrefix.'UserAdminController@useradd', 'as' => 'users.useradd']);
       Route::post('users/useradd/{id?}', ['uses' => $namespacePrefix.'UserAdminController@editadd', 'as' => 'users.editadd']);
       Route::get('users/useredit/{id?}', ['uses' => $namespacePrefix.'UserAdminController@useredit', 'as' => 'users.useredit']);
       Route::post('users/useredit/{id?}', ['uses' => $namespacePrefix.'UserAdminController@usereditdata', 'as' => 'users.usereditdata']);
       /*Shirts CSV ROUTE*/
       Route::get('etailor_fabriccsv/{id?}', ['uses' => $namespacePrefix.'RenderingController@get_impost_etailor_fabric', 'as' => 'etailor_fabriccsv']);
       Route::get('etailor_fabriccsvjc/{id?}', ['uses' => $namespacePrefix.'RenderingController@get_impost_etailor_fabric', 'as' => 'etailor_fabriccsv']);          
       Route::get('fabriccsvfile/{id?}', ['uses' => $namespacePrefix.'RenderingController@get_fabric_CSV_file', 'as' => 'fabriccsvfile']);
       Route::get('contrastcsvfile/{id?}', ['uses' => $namespacePrefix.'RenderingController@get_contrast_CSV_file', 'as' => 'contrastcsvfile']);
       Route::post('fabriccsvfile/{id?}', ['uses' => $namespacePrefix.'RenderingController@upload_styleImgs', 'as' => 'imposrtcsvfile']);
       Route::post('contrastcsvfile/{id?}', ['uses' => $namespacePrefix.'RenderingController@upload_styleImgs', 'as' => 'contrastcsvfile']);
       /*Jacket CSV FILE*/
       Route::get('fabriccsvjacket/{id?}', ['uses' => $namespacePrefix.'RenderingController@get_fabric_CSV_JK', 'as' => 'fabriccsvjacket']);
       Route::post('fabriccsvjacket/{id?}', ['uses' => $namespacePrefix.'RenderingController@get_fabric_cfvf_JK', 'as' => 'fabriccsvjacket']);
       Route::get('contrastcsvjc/{id?}', ['uses' => $namespacePrefix.'RenderingController@get_contrast_CSV_jc', 'as' => 'contrastcsvjc']);
       Route::post('contrastcsvjc/{id?}', ['uses' => $namespacePrefix.'RenderingController@get_fabric_cfvf_JK', 'as' => 'contrastcsvjc']);
       Route::get('etailor_liningcsv/{id?}', ['uses' => $namespacePrefix.'RenderingController@get_lining_CSV_JK', 'as' => 'etailor_liningcsv']);
       Route::get('etailor_liningrend/{id?}', ['uses' => $namespacePrefix.'RenderingController@lining_desgin_faj', 'as' => 'etailor_liningrend']);
       Route::post('etailor_liningrend/{id?}', ['uses' => $namespacePrefix.'RenderingController@get_fabric_cfvf_JK', 'as' => 'etailor_liningrend']);
       
       Route::get('etailor_liningrendvest/{id?}', ['uses' => $namespacePrefix.'RenderingController@lining_desgin_vet', 'as' => 'etailor_liningrendvest']);
       Route::post('etailor_liningrendvest/{id?}', ['uses' => $namespacePrefix.'RenderingController@save_fabric_CSV_VT', 'as' => 'etailor_liningrendvest']);
       
       /*Vests CSV FILE*/
       Route::get('fabricvestscsv/{id?}', ['uses' => $namespacePrefix.'RenderingController@get_fabric_CSV_VT', 'as' => 'fabricvestscsv']);
       Route::post('fabricvestscsv/{id?}', ['uses' => $namespacePrefix.'RenderingController@save_fabric_CSV_VT', 'as' => 'fabricvestscsv']);
       Route::get('contrastcsvvt/{id?}', ['uses' => $namespacePrefix.'RenderingController@get_fabric_CSV_CVT', 'as' => 'contrastcsvvt']);
       Route::post('contrastcsvvt/{id?}', ['uses' => $namespacePrefix.'RenderingController@save_fabric_CSV_VT', 'as' => 'contrastcsvvt']);
       /*Pants CSV FILE*/
       Route::get('fabricpantscsv/{id?}', ['uses' => $namespacePrefix.'RenderingController@get_fabric_CSV_PT', 'as' => 'fabricpantscsv']);
       Route::post('fabricpantscsv/{id?}', ['uses' => $namespacePrefix.'RenderingController@save_fabric_CSV_PT', 'as' => 'fabricpantscsv']);
       Route::get('contrastcsvpt/{id?}', ['uses' => $namespacePrefix.'RenderingController@get_fabric_CSV_CPT', 'as' => 'contrastcsvpt']);
       Route::post('contrastcsvpt/{id?}', ['uses' => $namespacePrefix.'RenderingController@save_fabric_CSV_PT', 'as' => 'contrastcsvpt']);
       Route::get('rendering/{id?}', ['uses' => $namespacePrefix.'RenderingController@get_fabricdata', 'as' => 'fabricdata']);
       Route::post('rendering/{id?}', ['uses' => $namespacePrefix.'RenderingController@process_fabricdata', 'as' => 'process']);
       Route::get('fabric/status/{id?}', ['uses' => $namespacePrefix.'VoyagerFabricDesignController@efabric_status', 'as' => 'status']);



//// Font Side


        /*--Front Product--*/
        Route::get('productslists', ['uses' => $namespacePrefix.'ProductsController@index', 'as' => 'productslists']);
        Route::get('productslists/catg', ['uses' => $namespacePrefix.'ProductsController@product_catg', 'as' => 'productslists.catg']);
        Route::post('productslists/catg', ['uses' => $namespacePrefix.'ProductsController@product_postcatg', 'as' => 'productslists.catg']);
        Route::post('productslists/save', ['uses' => $namespacePrefix.'ProductsController@save_product_data', 'as' => 'productslists.save']);
        Route::get('productslists/subcat/{id?}', ['uses' => $namespacePrefix.'ProductsController@getSubCateg', 'as' => 'productslists.subcat']);
        Route::get('productslists/status/{id?}/{sta?}', ['uses' => $namespacePrefix.'ProductsController@single_custom_status', 'as' => 'productslists.status']);
        Route::get('shirtjobcard/{id?}', ['uses' => $namespacePrefix.'CatalogManagementController@get_jobCard_Pdf_Shirt', 'as' => 'shirtjobcard']); 
        Route::get('productslists/edit/{id?}', ['uses' => $namespacePrefix.'ProductsController@product_editid', 'as' => 'productslists.edit']);
        Route::post('productslists/edit/{id?}', ['uses' => $namespacePrefix.'ProductsController@product_editidpost', 'as' => 'productslists.edit']);
        Route::post('productslists/savepost/{id?}', ['uses' => $namespacePrefix.'ProductsController@product_saveeditpost', 'as' => 'productslists.savepost']); 
        /*End Front Product*/
        //  fabrictypes
        Route::get('fabrictypes', ['uses' => $namespacePrefix.'ProductsController@get_Fabrictype', 'as' => 'fabrictypes']);
        Route::get('fabrictypes/add', ['uses' => $namespacePrefix.'ProductsController@add_Fabrictype', 'as' => 'fabrictypes.add']);
        Route::post('fabrictypes/add', ['uses' => $namespacePrefix.'ProductsController@save_Fabrictype', 'as' => 'fabrictypes.add']);
        Route::get('fabrictypes/edit/{id?}', ['uses' => $namespacePrefix.'ProductsController@edit_Fabrictype', 'as' => 'fabrictypes.edit']);
        Route::post('fabrictypes/edit/{id?}', ['uses' => $namespacePrefix.'ProductsController@update_Fabrictype', 'as' => 'fabrictypes.edit']);
        Route::delete('fabrictypes/delete/{id?}', ['uses' => $namespacePrefix.'ProductsController@del_Fabrictype', 'as' => 'fabrictypes.delete']);
        /*--END--*/







});
