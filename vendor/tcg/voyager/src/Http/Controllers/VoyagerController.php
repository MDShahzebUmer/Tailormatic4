<?php

namespace TCG\Voyager\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use League\Flysystem\Util;
use TCG\Voyager\Facades\Voyager;
use App\Contrast;

use TCG\Voyager\Models\Category;
use TCG\Voyager\Models\Permission;
use DB;
use App\MainAttribute;
use App\OptionTabel;
use App\Etfabric;
use App\OptionContrastImglist;
use App\ContrastCollar;
use Redirect;

class VoyagerController extends Controller
{
    public function index()
    {
        return Voyager::view('voyager::index');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('voyager.login');
    }

    public function upload(Request $request)
    {
        $fullFilename = null;
        $resizeWidth = 1800;
        $resizeHeight = null;
        $slug = $request->input('type_slug');
        $file = $request->file('image');

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->firstOrFail();

        if ($this->userCannotUploadImageIn($dataType, 'add') && $this->userCannotUploadImageIn($dataType, 'edit')) {
            abort(403);
        }

        $path = $slug . '/' . date('F') . date('Y') . '/';

        $filename = basename($file->getClientOriginalName(), '.' . $file->getClientOriginalExtension());
        $filename_counter = 1;

        // Make sure the filename does not exist, if it does make sure to add a number to the end 1, 2, 3, etc...
        while (Storage::disk(config('voyager.storage.disk'))->exists($path . $filename . '.' . $file->getClientOriginalExtension())) {
            $filename = basename($file->getClientOriginalName(), '.' . $file->getClientOriginalExtension()) . (string) ($filename_counter++);
        }

        $fullPath = $path . $filename . '.' . $file->getClientOriginalExtension();

        $ext = $file->guessClientExtension();

        if (in_array($ext, ['jpeg', 'jpg', 'png', 'gif'])) {
            $image = Image::make($file)
                ->resize($resizeWidth, $resizeHeight, function (Constraint $constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            if ($ext !== 'gif') {
                $image->orientate();
            }
            $image->encode($file->getClientOriginalExtension(), 75);

            // move uploaded file from temp to uploads directory
            if (Storage::disk(config('voyager.storage.disk'))->put($fullPath, (string) $image, 'public')) {
                $status = __('voyager::media.success_uploading');
                $fullFilename = $fullPath;
            } else {
                $status = __('voyager::media.error_uploading');
            }
        } else {
            $status = __('voyager::media.uploading_wrong_type');
        }

        // echo out script that TinyMCE can handle and update the image in the editor
        return "<script> parent.helpers.setImageValue('" . Voyager::image($fullFilename) . "'); </script>";
    }

    public function assets(Request $request)
    {
        try {
            $path = dirname(__DIR__, 3) . '/publishable/assets/' . Util::normalizeRelativePath(urldecode($request->path));
        } catch (\LogicException $e) {
            abort(404);
        }

        if (File::exists($path)) {
            $mime = '';
            if (Str::endsWith($path, '.js')) {
                $mime = 'text/javascript';
            } elseif (Str::endsWith($path, '.css')) {
                $mime = 'text/css';
            } else {
                $mime = File::mimeType($path);
            }
            $response = response(File::get($path), 200, ['Content-Type' => $mime]);
            $response->setSharedMaxAge(31536000);
            $response->setMaxAge(31536000);
            $response->setExpires(new \DateTime('+1 year'));

            return $response;
        }

        return response('', 404);
    }

    protected function userCannotUploadImageIn($dataType, $action)
    {
        return auth()->user()->cannot($action, app($dataType->model_name))
            || $dataType->{$action . 'Rows'}->where('type', 'rich_text_box')->count() === 0;
    }
    //    CUSTOM CODE START FROM HERE  //
    public function contrasts()
    {
        $contrast = Contrast::select('*')->get();
        return view('voyager::design/contrasts')->with(compact('contrast'));
    }


    //  --------NEW ADDED---------  //

    public function getcreate()
    {
        $type = '';
        $cat = Category::select('id', 'name')->get();
        return view('voyager::design/edit-add-contrasts')->with(compact('cat', 'type'));
    }
    public function getedit($id = 0)
    {
        if ($id != '') {
            $type = 'edit';
            $conts = Contrast::select('*')->where('id', '=', $id)->get();

            return view('voyager::design/edit-add-contrasts')->with(compact('conts', 'type'));
        } else {
            return $this->contrasts();
        }
    }
    public function save_img($file = null, $slug_type = null, $size = '', $id = null)
    {
        if ($file != '' && $slug_type != '') {
            $fullFilename = null;
            $resizeWidth = $size;
            $resizeHeight = null;
            $filename = $id;
            $fullPath = $slug_type . '/' . $filename . '.' . $file->getClientOriginalExtension();
            $ext = $file->guessClientExtension();
            if (in_array($ext, ['jpeg', 'jpg', 'png', 'gif'])) {
                $image = Image::make($file)
                    ->resize($resizeWidth, $resizeHeight, function (Constraint $constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->encode($file->getClientOriginalExtension(), 75);
                if (Storage::put(config('voyager.storage.subfolder') . $fullPath, (string) $image, 'public')) {
                    return $fullPath;
                } else {
                    $status = 'Upload Fail: Unknown error occurred!';
                }
            } else {
                $status = 'Upload Fail: Unknown error occurred!';
            }
        } else {
            $status = 'Upload Fail: Unknown error occurred!';
        }
    }
    public function lists_img($file = null, $slug_type = null, $size = '', $id = null)
    {
        if ($file != '' && $slug_type != '') {
            $fullFilename = null;
            $resizeWidth = $size;
            $resizeHeight = 567;
            $filename = $id;
            $fullPath = $slug_type . '/' . $filename . '.' . $file->getClientOriginalExtension();
            $ext = $file->guessClientExtension();
            if (in_array($ext, ['jpeg', 'jpg', 'png', 'gif'])) {
                $image = Image::make($file)
                    ->resize($resizeWidth, $resizeHeight, function (Constraint $constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->encode($file->getClientOriginalExtension(), 75);
                if (Storage::put(config('voyager.storage.subfolder') . $fullPath, (string) $image, 'public')) {
                    return $fullPath;
                } else {
                    $status = 'Upload Fail: Unknown error occurred!';
                }
            } else {
                $status = 'Upload Fail: Unknown error occurred!';
            }
        } else {
            $status = 'Upload Fail: Unknown error occurred!';
        }
    }
    public function postdata(Request $request)
    {
        $catval = $request->input('cat_id');
        foreach ($catval as $catID) {

            $catname = $this->sluget('categories', $catID, 'name');
            $slug_type = $catname . '/FabricContrasts';
            $dataSet = [
                'cat_id'      => $catID,
                'contrsfab_name' =>  $request->input(['contrsfab_name']),
                'qty' =>  $request->input(['qty']),
                'min_qty' =>  $request->input(['min_qty']),
                'status' => '1',
                'cont_status' => '1',
                'created_at' => date('y-m-d H:i:s'),
                'updated_at' => date('y-m-d H:i:s'),
            ];

            $ids = DB::table('contrasts')->insert($dataSet);
            $ids = DB::getPdo()->lastInsertId();
            $this->save_img($request->file('contrsfab_img'), $slug_type . '/' . 'S', 130, $ids);
            $this->lists_img($request->file('contrsfab_img'), $slug_type . '/' . 'LL', 467, $ids);

            $dataimg = [
                'contrsfab_img' => $this->save_img($request->file('contrsfab_img'), $slug_type . '/' . 'L', 500, $ids),
                'show_img' => $this->save_img($request->file('show_img'), $slug_type . '/' . 'View', 500, $ids)
            ];
            $data =  DB::table('contrasts')
                ->where('id', $ids)
                ->update($dataimg);
        }
        return Redirect::to('/admin/contrastsdesign/');
        // return redirect()->back();


    }
    public function editpostdata(Request $request)
    {
        $file = $request->file('contrsfab_img');


        $cont   = new Contrast;
        $cont = Contrast::findOrFail($request->input('id'));
        $cont->cat_id  = $request->input('cat_id');
        $cont->contrsfab_name  = $request->input('contrsfab_name');
        $cont->qty  = $request->input('qty');
        $cont->min_qty  = $request->input('min_qty');
        $catname = $this->sluget('categories', $cont->cat_id, 'name');
        $slug_type = $catname . '/FabricContrasts';

        $oldimgL = $cont->contrsfab_img;
        $oldimgS = str_replace('/L/', '/S/', $cont->contrsfab_img);
        $oldcatid = $request->input('catId');
        $newcatid = $request->input('cat_id');
        if ($request->file('show_img')) {
            $cont->show_img = $this->save_img($request->file('show_img'), $slug_type . '/' . 'View', 500, $request->input('id'));
        }

        if ($file != '') {
            $this->save_img($request->file('contrsfab_img'), $slug_type . '/' . 'S', 130, $request->input('id'));
            $this->lists_img($request->file('contrsfab_img'), $slug_type . '/' . 'LL', 467, $request->input('id'));
            $cont->contrsfab_img = $this->save_img($request->file('contrsfab_img'), $slug_type . '/' . 'L', 500, $request->input('id'));
        } elseif ($newcatid != $oldcatid) {

            $this->imgRename($oldimgS, 'S', $slug_type);
            $cont->contrsfab_img = $this->imgRename($oldimgL, 'L', $slug_type);
        }

        $data = $cont->save()
            ? [
                'message'    => "Successfully Update Records",
                'alert-type' => 'success',
            ]
            : [
                'message'    => 'Sorry it appears there was a problem removing this',
                'alert-type' => 'danger',
            ];
        // return redirect()->back()->with('data');
        return Redirect::to('/admin/contrastsdesign/');
    }
    public function deleteBread($id)
    {
        Voyager::can('browse_database');

        /** @var \TCG\Voyager\Models\DataType $dataType */
        $cont   = new Contrast;
        $cont = Contrast::find($id);
        $data = Contrast::destroy($id)
            ? [
                'message'    => "Successfully removed Contrasts  from {$cont->contrsfab_name}",
                'alert-type' => 'success',
            ]
            : [
                'message'    => 'Sorry it appears there was a problem removing this bread',
                'alert-type' => 'danger',
            ];

        if (!is_null($cont)) {
            Permission::removeFrom($cont->contrsfab_name);
        }

        return redirect()->back()->with($data);
        // return redirect()->route('voyager.contrastsdesign')->with($data);
    }

    /*Contrast design start here*/
    public function contrasts_create($id = null)
    {

        if ($id != '') {
            $ex =  explode('-', $id);
            if (count($ex) > 1) {
                $id =   $ex[0];
                $second = $ex[1];
            } else {
                $id =   $id;
                $second = '';
            }

            $data = Contrast::select('cat_id', 'contrsfab_name', 'id')->where('id', '=', $id)->findOrFail($id);
            $cont_id  =   $data->cat_id;
            $cat_data  =   Category::findOrFail($cont_id);
            $main_id   =   MainAttribute::select('id', 'attribute_name')->where('cat_id', '=', $cat_data->id)->where('parent_id', '=', 0)->take(1)->skip(1)->get();
            foreach ($main_id as $m) {
            }
            $attridata = MainAttribute::select('id', 'attribute_name')->where('parent_id', '=', $m->id)->first();
            if ($second == '') {
                $attid = $attridata->id;
                $optdata = OptionTabel::select('id')->where('attri_id', '=', $attid)->first();
                $optdata = $optdata->id;
            } else {
                $optdata = $second;
            }


            $maindata  = OptionContrastImglist::select('*')->where('opt_id', '=', $optdata)->where('contrast_id', '=', $id)->get();

            return view('voyager::design/contrastsdesign')->with(compact('cat_data', 'attridata', 'm', 'data', 'optdata', 'maindata'));
        } else {
            return redirect()->back();
        }
    }
    public function contrasts_otion_create($id = Null, $ids = Null)
    {
        if ($id != '' && $ids) {
            $type = '';
            return view('voyager::design/edit-add-contrastsdesign')->with(compact('type', 'ids', 'id'));
        } else {
            return redirect()->back();
        }
    }
    public function contrasts_otion_add(Request $request, $id, $ids)
    {
        if ($id != '' && $ids != '') {

            $data = new OptionContrastImglist;
            $data->contrast_type_id = $request->input('contrast_type_id');
            $data->contrast_id = $request->input('contrast_id');
            $contrsid = $request->input('contrast_id');
            $optid = $request->input('opt_id');
            $data->opt_id = $request->input('opt_id');
            $attri_id = OptionTabel::select('attri_id')->where('id', '=',  $data->opt_id)->find($data->opt_id);
            $data->attri_id = $attri_id->attri_id;
            $cat_id = $this->sluget('contrasts', $id, 'cat_id');
            $catname = $this->sluget('categories', $cat_id, 'name');
            $type_name = trim(str_replace(' ', '', $this->sluget('contrast_option_img_type', $request->input('contrast_type_id'), 'type_name')));
            $slug_type = $catname . '/FabricContrasts/' . 'Mix/' . $type_name;
            $data->main_img = $this->save_img($request->file('main_img'), $slug_type, 500, $data->contrast_id);
            $data = $data->save()
                ? [
                    'message'    => "Successfully  Contrasts Option Save ",
                    'alert-type' => 'success',
                ]
                : [
                    'message'    => 'Sorry it appears there was a problem removing this bread',
                    'alert-type' => 'danger',
                ];
            return Redirect::to('/admin/contrastsdesign/fabric/' . $contrsid . '-' . $optid);
            // return redirect()->back()->with($data);


        } else {
            return redirect()->back();
        }
    }

    public function contrasts_otion_edit($id = null)
    {

        if ($id != '') {

            $type = 'edit';
            $maindata  = OptionContrastImglist::select('*')->where('id', '=', $id)->get();
            return view('voyager::design/edit-add-contrastsdesign')->with(compact('type', 'maindata'));
        } else {
            return Redirect()->to('/admin/contrastsdesign/');
        }
    }
    public function contrasts_otion_post(Request $request)
    {
        $data = new OptionContrastImglist;
        $data = OptionContrastImglist::findOrFail($request->input('id'));
        $data->id = $request->input('id');
        $data->contrast_type_id = $request->input('contrast_type_id');


        $data->contrast_id = $request->input('contrast_id');
        $contrsid = $request->input('contrast_id');

        $data->opt_id = $request->input('opt_id');
        $optid = $request->input('opt_id');

        $cat_id = $this->sluget('contrasts', $data->contrast_id, 'cat_id');

        $catname = $this->sluget('categories', $cat_id, 'name');

        $type_name = trim(str_replace(' ', '', $this->sluget('contrast_option_img_type', $request->input('contrast_type_id'), 'type_name')));

        $slug_type = $catname . '/FabricContrasts/' . 'Mix/' . $type_name;

        $file = $request->file('main_img');
        if ($file != '') {
            $data->main_img = $this->save_img($request->file('main_img'), $slug_type, 500, $data->contrast_id);
        }
        //exit();
        $data = $data->save()

            ? [
                'message'    => "Successfully  Contrasts Option Save ",
                'alert-type' => 'success',
            ]
            : [
                'message'    => 'Sorry it appears there was a problem removing this bread',
                'alert-type' => 'danger',
            ];
        return Redirect::to('/admin/contrastsdesign/fabric/' . $contrsid . '-' . $optid);
        //return redirect()->back()->with($data);

    }
    public function contrasts_otion_del($id)
    {
        $cont   = new OptionContrastImglist;
        $cont = OptionContrastImglist::find($id);
        $data = OptionContrastImglist::destroy($id)
            ? [
                'message'    => "Successfully removed Option Contrast Imglist  from ID {$cont->id}",
                'alert-type' => 'success',
            ]
            : [
                'message'    => 'Sorry it appears there was a problem removing this bread',
                'alert-type' => 'danger',
            ];

        if (!is_null($cont)) {
            Permission::removeFrom($cont->id);
        }

        return redirect()->back()->with($data);
    }

    public function sluget($table, $id, $fieldname)
    {

        $slugname = DB::table($table)->where('id', '=', $id)->value($fieldname);
        return $slugname;
    }


    public function collar_create($id = null)
    {

        if ($id != '') {
            $ex =  explode('-', $id);
            if (count($ex) > 1) {
                $id =   $ex[0];
                $second = $ex[1];
            } else {
                $id =   $id;
                $second = '';
            }

            $data = Contrast::select('cat_id', 'contrsfab_name', 'id')->where('id', '=', $id)->findOrFail($id);
            $cont_id  =   $data->cat_id;
            $cat_data  =   Category::findOrFail($cont_id);
            $main_id   =   MainAttribute::select('id', 'attribute_name')->where('cat_id', '=', $cat_data->id)->where('parent_id', '=', 0)->take(1)->skip(1)->get();
            foreach ($main_id as $m) {
            }
            $attridata = MainAttribute::select('id', 'attribute_name')->where('parent_id', '=', $m->id)->first();
            if ($second == '') {
                $attid = $attridata->id;
                $optdata = OptionTabel::select('id')->where('attri_id', '=', $attid)->take(1)->skip(1)->first();

                $optdata = $optdata->id;
            } else {
                $optdata = $second;
            }


            $maindata  = ContrastCollar::select('*')->where('opt_id', '=', $optdata)->where('contrast_id', '=', $id)->get();

            return view('voyager::design/contrastscollar')->with(compact('cat_data', 'attridata', 'm', 'data', 'optdata', 'maindata'));
        } else {
            return redirect()->back();
        }
    }

    public function contrasts_collar_create($id = Null, $ids = Null)
    {
        if ($id != '' && $ids) {
            $type = '';
            return view('voyager::design/edit-add-contrasts-collar')->with(compact('type', 'ids', 'id'));
        } else {
            return redirect()->back();
        }
    }


    public function contrasts_collar_add(Request $request, $id, $ids)
    {
        if ($id != '' && $ids != '') {

            $data = new ContrastCollar;
            $data->style_id = $request->input('style_id');
            $data->contrast_id = $request->input('contrast_id');
            $contrsid = $request->input('contrast_id');
            $optid = $request->input('opt_id');
            $data->opt_id = $request->input('opt_id');


            $cat_id = $this->sluget('contrasts', $id, 'cat_id');
            $catname = $this->sluget('categories', $cat_id, 'name');

            $collartype = $this->sluget('attribute_styles', $request->input('style_id'), 'style_name');

            $type_name = trim(str_replace(' ', '', $collartype));

            $slug_type = $catname . '/FabricContrasts/' . 'Mix/Collar/' . $type_name;

            if ($request->file('left_collar')) {
                $data->left_collar = $this->save_img($request->file('left_collar'), $slug_type . '/left', 500, $data->contrast_id);
            }
            if ($request->file('main_collar_view')) {
                $data->main_collar_view = $this->save_img($request->file('main_collar_view'), $slug_type . '/mainView', 500, $data->contrast_id);
            }
            if ($request->file('main_collar_round')) {
                $data->main_collar_round = $this->save_img($request->file('main_collar_round'), $slug_type . '/mainRound', 500, $data->contrast_id);
            }


            $data = $data->save()
                ? [
                    'message'    => "Successfully  Contrasts Option Save ",
                    'alert-type' => 'success',
                ]
                : [
                    'message'    => 'Sorry it appears there was a problem removing this bread',
                    'alert-type' => 'danger',
                ];
            return Redirect::to('/admin/contrastsdesign/collar/' . $contrsid . '-' . $optid);
            // return redirect()->back()->with($data);


        } else {
            return redirect()->back();
        }
    }

    public function contrasts_collar_edit($id = null)
    {

        if ($id != '') {

            $type = 'edit';
            $maindata  = ContrastCollar::select('*')->where('id', '=', $id)->get();
            return view('voyager::design/edit-add-contrasts-collar')->with(compact('type', 'maindata'));
        } else {
            return redirect()->back();
        }
    }

    public function contrasts_collar_post(Request $request)
    {
        $data = new ContrastCollar;
        $data = ContrastCollar::findOrFail($request->input('id'));
        $data->style_id = $request->input('style_id');
        $data->contrast_id = $request->input('contrast_id');
        $contrsid = $request->input('contrast_id');
        $optid = $request->input('opt_id');
        $data->opt_id = $request->input('opt_id');


        $cat_id = $this->sluget('contrasts', $contrsid, 'cat_id');
        $catname = $this->sluget('categories', $cat_id, 'name');

        $collartype = $this->sluget('attribute_styles', $request->input('style_id'), 'style_name');

        $type_name = trim(str_replace(' ', '', $collartype));

        $slug_type = $catname . '/FabricContrasts/' . 'Mix/Collar/' . $type_name;

        if ($request->file('left_collar')) {
            $data->left_collar = $this->save_img($request->file('left_collar'), $slug_type . '/left', 500, $data->contrast_id);
        }
        if ($request->file('main_collar_view')) {
            $data->main_collar_view = $this->save_img($request->file('main_collar_view'), $slug_type . '/mainView', 500, $data->contrast_id);
        }
        if ($request->file('main_collar_round')) {
            $data->main_collar_round = $this->save_img($request->file('main_collar_round'), $slug_type . '/mainRound', 500, $data->contrast_id);
        }
        //exit();
        $data = $data->save()

            ? [
                'message'    => "Successfully  Contrasts Option Save ",
                'alert-type' => 'success',
            ]
            : [
                'message'    => 'Sorry it appears there was a problem removing this bread',
                'alert-type' => 'danger',
            ];
        return Redirect::to('/admin/contrastsdesign/collar/' . $contrsid . '-' . $optid);
        //return redirect()->back()->with($data);
    }

    public function contrasts_collar_del($id)
    {


        $cont   = new ContrastCollar;
        $cont = ContrastCollar::find($id);
        $data = ContrastCollar::destroy($id)
            ? [
                'message'    => "Successfully removed Option Contrast Imglist  from ID {$cont->id}",
                'alert-type' => 'success',
            ]
            : [
                'message'    => 'Sorry it appears there was a problem removing this bread',
                'alert-type' => 'danger',
            ];

        if (!is_null($cont)) {
            Permission::removeFrom($cont->id);
        }

        return redirect()->back()->with($data);
    }

    public function imgRename($oldfront, $slug, $slug_type)
    {
        $imgg = explode('/', $oldfront);
        $tt = count($imgg) - 1;
        $newpath = $slug_type . '/' . $slug . '/' . $imgg[$tt];
        rename(base_path() . '/public/storage/' . $oldfront, base_path() . '/public/storage/' . $newpath);

        return $newpath;
    }
}
