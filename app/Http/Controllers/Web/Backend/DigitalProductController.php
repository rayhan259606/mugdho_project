<?php

namespace App\Http\Controllers\Web\Backend;

use App\Models\DigitalProduct;
use App\Models\CMS;
use App\Enums\CacheEnum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use App\Helpers\Helper;

class DigitalProductController extends Controller
{
    public $part;
    public $route;
    public $view;

    public function __construct()
    {
        $this->part = 'digital_product';
        $this->route = 'admin.' . $this->part;
        $this->view = 'backend.layouts.' . $this->part;
        View::share('crud', 'digital_product');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DigitalProduct::orderBy('position', 'asc')->orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('title', function ($data) {
                    return Str::limit($data->title, 20);
                })
                ->addColumn('thumbnail', function ($data) {
                    $url = asset($data->thumbnail && file_exists(public_path($data->thumbnail)) ? $data->thumbnail : 'default/logo.svg');
                    return '<img src="' . $url . '" alt="image" style="width: 50px; max-height: 100px; margin-left: 20px;">';
                })
                ->addColumn('status', function ($data) {
                    $backgroundColor = $data->status == "active" ? '#4CAF50' : '#ccc';
                    $sliderTranslateX = $data->status == "active" ? '26px' : '2px';

                    $status = '<div class="d-flex justify-content-center align-items-center">';
                    $status .= '<div class="form-check form-switch" style="position: relative; width: 50px; height: 24px; background-color: ' . $backgroundColor . '; border-radius: 12px; transition: background-color 0.3s ease; cursor: pointer;">';
                    $status .= '<input onclick="showStatusChangeAlert(' . $data->id . ')" type="checkbox" class="form-check-input" id="customSwitch' . $data->id . '" getAreaid="' . $data->id . '" name="status" style="position: absolute; width: 100%; height: 100%; opacity: 0; z-index: 2; cursor: pointer;">';
                    $status .= '<span style="position: absolute; top: 2px; left: 2px; width: 20px; height: 20px; background-color: white; border-radius: 50%; transition: transform 0.3s ease; transform: translateX(' . $sliderTranslateX . ');"></span>';
                    $status .= '<label for="customSwitch' . $data->id . '" class="form-check-label" style="margin-left: 10px;"></label>';
                    $status .= '</div>';
                    $status .= '</div>';

                    return $status;
                })
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group btn-group-sm" role="group">
                                <a href="#" type="button" onclick="goToEdit(' . $data->id . ')" class="btn btn-primary fs-14 text-white" title="Edit">
                                    <i class="fe fe-edit"></i>
                                </a>
                                <a href="#" type="button" onclick="showDeleteConfirm(' . $data->id . ')" class="btn btn-danger fs-14 text-white" title="Delete">
                                    <i class="fe fe-trash"></i>
                                </a>
                            </div>';
                })
                ->rawColumns(['title', 'thumbnail', 'status', 'action'])
                ->make();
        }

        $cms = CMS::where('page', 'digital_products')->where('section', 'hero')->first();

        return view($this->view . ".index", [
            'part' => $this->part,
            'route' => $this->route,
            'cms' => $cms
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view($this->view . ".create", [
            'part' => $this->part,
            'route' => $this->route
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'       => 'required|max:250',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'discount'    => 'nullable|numeric|min:0',
            'position'    => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = $validator->validated();

            $item = new DigitalProduct();
            $item->title = $data['title'];
            $item->slug = Helper::makeSlug(DigitalProduct::class, $data['title']);
            $item->description = $data['description'];
            $item->price = $data['price'];
            $item->discount = $request->discount ?? 0;
            $item->position = $request->position ?? 0;
            
            if ($request->hasFile('image')) {
                $item->thumbnail = Helper::fileUpload($request->file('image'), 'digital_product', time() . '_' . getFileName($request->file('image')));
            }
            
            $item->save();

            session()->put('t-success', 'Created Successfully');
        } catch (Exception $e) {
            session()->put('t-error', $e->getMessage());
        }

        return redirect()->route($this->route . '.index')->with('t-success', 'Created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = DigitalProduct::findOrFail($id);
        return view($this->view . ".edit", [
            'part' => $this->part,
            'route' => $this->route,
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'       => 'required|max:250',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'discount'    => 'nullable|numeric|min:0',
            'position'    => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = $validator->validated();

            $item = DigitalProduct::findOrFail($id);
            $item->title = $data['title'];
            $item->description = $data['description'];
            $item->price = $data['price'];
            $item->discount = $request->discount ?? 0;
            $item->position = $request->position ?? 0;

            if ($request->hasFile('image')) {
                if ($item->thumbnail && file_exists(public_path($item->thumbnail))) {
                    Helper::fileDelete(public_path($item->thumbnail));
                }
                $item->thumbnail = Helper::fileUpload($request->file('image'), 'digital_product', time() . '_' . getFileName($request->file('image')));
            }

            $item->save();

            session()->put('t-success', 'Updated Successfully');
        } catch (Exception $e) {
            session()->put('t-error', $e->getMessage());
        }

        return redirect()->route($this->route . '.index')->with('t-success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = DigitalProduct::findOrFail($id);
            if ($data->thumbnail && file_exists(public_path($data->thumbnail))) {
                Helper::fileDelete(public_path($data->thumbnail));
            }
            $data->delete();
            return response()->json([
                'status' => 't-success',
                'message' => 'Deleted successfully!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 't-error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function status(int $id): JsonResponse
    {
        $data = DigitalProduct::findOrFail($id);
        $data->status = $data->status === 'active' ? 'inactive' : 'active';
        $data->save();
        return response()->json([
            'status' => 't-success',
            'message' => 'Status updated successfully!',
        ]);
    }

    /**
     * Update CMS Settings for the page.
     */
    public function updateCms(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'           => 'nullable|string|max:255',
            'description'     => 'nullable|string',
            'image'           => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'feature_1_title' => 'nullable|string|max:255',
            'feature_2_title' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $section = CMS::where('page', 'digital_products')->where('section', 'hero')->first();

            $data = [
                'page'      => 'digital_products',
                'section'   => 'hero',
                'title'     => $request->title,
                'description' => $request->description,
                'status'    => 'active',
            ];

            $metadata = $section ? ($section->metadata ?? []) : [];
            $metadata['feature_1_title'] = $request->feature_1_title;
            $metadata['feature_2_title'] = $request->feature_2_title;
            $data['metadata'] = $metadata;

            if ($request->hasFile('image')) {
                if ($section && $section->image && file_exists(public_path($section->image))) {
                    Helper::fileDelete(public_path($section->image));
                }
                $data['image'] = Helper::fileUpload($request->file('image'), 'digital_products', time() . '_' . getFileName($request->file('image')));
            }

            if ($section) {
                $section->update($data);
            } else {
                do {
                    $data['slug'] = 'slug_'.Str::random(8);
                } while (CMS::where('slug', $data['slug'])->exists());
                CMS::create($data);
            }

            // Forget cache
            Cache::forget(CacheEnum::CMS_DATA);

            return redirect()->back()->with('t-success', 'Page content updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', $e->getMessage());
        }
    }
}
