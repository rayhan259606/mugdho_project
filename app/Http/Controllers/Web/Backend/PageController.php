<?php

namespace App\Http\Controllers\Web\Backend;

use App\Helpers\Helper;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

class PageController extends Controller
{
    public function __construct()
    {
        View::share('crud', 'page');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Page::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($data) {
                    $backgroundColor = $data->status == "active" ? '#4CAF50' : '#ccc';
                    $sliderTranslateX = $data->status == "active" ? '26px' : '2px';
                    $sliderStyles = "position: absolute; top: 2px; left: 2px; width: 20px; height: 20px; background-color: white; border-radius: 50%; transition: transform 0.3s ease; transform: translateX($sliderTranslateX);";

                    $status = '<div class="form-check form-switch" style="margin-left:40px; position: relative; width: 50px; height: 24px; background-color: ' . $backgroundColor . '; border-radius: 12px; transition: background-color 0.3s ease; cursor: pointer;">';
                    $status .= '<input onclick="showStatusChangeAlert(' . $data->id . ')" type="checkbox" class="form-check-input" id="customSwitch' . $data->id . '" getAreaid="' . $data->id . '" name="status" style="position: absolute; width: 100%; height: 100%; opacity: 0; z-index: 2; cursor: pointer;">';
                    $status .= '<span style="' . $sliderStyles . '"></span>';
                    $status .= '<label for="customSwitch' . $data->id . '" class="form-check-label" style="margin-left: 10px;"></label>';
                    $status .= '</div>';

                    return $status;
                })
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">

                                <a href="#" type="button" onclick="goToEdit(' . $data->id . ')" class="btn btn-primary fs-14 text-white delete-icn" title="Delete">
                                    <i class="fe fe-edit"></i>
                                </a>

                                <a href="#" type="button" onclick="showDeleteConfirm(' . $data->id . ')" class="btn btn-danger fs-14 text-white delete-icn" title="Delete">
                                    <i class="fe fe-trash"></i>
                                </a>
                            </div>';
                })
                ->rawColumns(['status', 'action'])
                ->make();
        }
        return view("backend.layouts.page.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.layouts.page.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|unique:pages,name',
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'icon'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'meta_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        try {
            $data = $request->all();
            $data['slug'] = Helper::makeSlug(Page::class, $request->name);

            if ($request->hasFile('icon')) {
                $data['icon'] = Helper::fileUpload($request->file('icon'), 'pages', 'icon-' . time());
            }

            if ($request->hasFile('meta_image')) {
                $data['meta_image'] = Helper::fileUpload($request->file('meta_image'), 'pages', 'meta-' . time());
            }

            Page::create($data);
            return redirect()->route('admin.page.index')->with('t-success', 'Page created successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page, $id)
    {
        $page = Page::findOrFail($id);
        return view('backend.layouts.page.edit', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page, $id)
    {
        $page = Page::findOrFail($id);
        return view('backend.layouts.page.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'    => 'required|unique:pages,name,' . $id,
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'icon'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'meta_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        try {
            $page = Page::findOrFail($id);
            $data = $request->all();

            if ($request->hasFile('icon')) {
                if ($page->icon) {
                    Helper::fileDelete($page->icon);
                }
                $data['icon'] = Helper::fileUpload($request->file('icon'), 'pages', 'icon-' . time());
            }

            if ($request->hasFile('meta_image')) {
                if ($page->meta_image) {
                    Helper::fileDelete($page->meta_image);
                }
                $data['meta_image'] = Helper::fileUpload($request->file('meta_image'), 'pages', 'meta-' . time());
            }

            $page->update($data);
            return redirect()->route('admin.page.index')->with('t-success', 'Page updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = Page::findOrFail($id);
            $data->delete();
            return response()->json([
                'status' => 't-success',
                'message' => 'Your action was successful!'
            ]);
            
        } catch (Exception $e) {
            return response()->json([
                'status' => 't-error',
                'message' => 'Your action was successful!'
            ]);
        }
    }

    public function status(int $id): JsonResponse
    {
        $data = Page::findOrFail($id);
        if (!$data) {
            return response()->json([
                'status' => 't-error',
                'message' => 'Item not found.',
            ]);
        }
        $data->status = $data->status === 'active' ? 'inactive' : 'active';
        $data->save();
        return response()->json([
            'status' => 't-success',
            'message' => 'Your action was successful!',
        ]);
    }

}
