<?php

namespace App\Http\Controllers\Web\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\HomeMedia;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

class HomeMediaController extends Controller
{
    public function __construct()
    {
        View::share('crud', 'home_media');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = HomeMedia::query()->orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('file_path', function ($data) {
                    if ($data->type === 'poster') {
                        $url = asset($data->file_path && file_exists(public_path($data->file_path)) ? $data->file_path : 'default/logo.svg');
                        return '<img src="' . $url . '" alt="image" style="width: 100px; max-height: 100px; margin-left: 20px; object-fit: cover;">';
                    } else {
                        $url = asset($data->file_path && file_exists(public_path($data->file_path)) ? $data->file_path : '');
                        return '<video width="120" height="80" controls style="margin-left: 20px;">
                                    <source src="' . $url . '" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>';
                    }
                })
                ->addColumn('type', function ($data) {
                    $badgeClass = $data->type === 'poster' ? 'bg-info' : 'bg-success';
                    return '<span class="badge ' . $badgeClass . ' text-white text-uppercase">' . $data->type . '</span>';
                })
                ->addColumn('status', function ($data) {
                    $backgroundColor = $data->status == "active" ? '#4CAF50' : '#ccc';
                    $sliderTranslateX = $data->status == "active" ? '26px' : '2px';
                    $sliderStyles = "position: absolute; top: 2px; left: 2px; width: 20px; height: 20px; background-color: white; border-radius: 50%; transition: transform 0.3s ease; transform: translateX($sliderTranslateX);";

                    $status = '<div class="form-check form-switch" style="margin-left:40px; position: relative; width: 50px; height: 24px; background-color: ' . $backgroundColor . '; border-radius: 12px; transition: background-color 0.3s ease; cursor: pointer;">';
                    $status .= '<input onclick="showStatusChangeAlert(' . $data->id . ')" type="checkbox" class="form-check-input" id="customSwitch' . $data->id . '" name="status" style="position: absolute; width: 100%; height: 100%; opacity: 0; z-index: 2; cursor: pointer;">';
                    $status .= '<span style="' . $sliderStyles . '"></span>';
                    $status .= '<label for="customSwitch' . $data->id . '" class="form-check-label" style="margin-left: 10px;"></label>';
                    $status .= '</div>';

                    return $status;
                })
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group btn-group-sm" role="group">
                                <a href="#" onclick="goToEdit(' . $data->id . ')" class="btn btn-primary fs-14 text-white" title="Edit">
                                    <i class="fe fe-edit"></i>
                                </a>
                                <a href="#" onclick="showDeleteConfirm(' . $data->id . ')" class="btn btn-danger fs-14 text-white" title="Delete">
                                    <i class="fe fe-trash"></i>
                                </a>
                            </div>';
                })
                ->rawColumns(['file_path', 'type', 'status', 'action'])
                ->make();
        }
        return view("backend.layouts.home_media.index");
    }

    public function create()
    {
        return view('backend.layouts.home_media.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:poster,video',
            'title' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
            'file' => $request->type === 'poster' 
                ? 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240'
                : 'required|file|mimes:mp4,mov,ogg,qt,webm|max:51200',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = $validator->validated();
            if ($request->hasFile('file')) {
                $data['file_path'] = Helper::fileUpload($request->file('file'), 'home_media', time() . '_' . $request->file('file')->getClientOriginalName());
            }

            HomeMedia::create($data);
            return redirect()->route('admin.home_media.index')->with('t-success', 'Media added successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $media = HomeMedia::findOrFail($id);
        return view('backend.layouts.home_media.edit', compact('media'));
    }

    public function update(Request $request, $id)
    {
        $media = HomeMedia::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:poster,video',
            'title' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
            'file' => $request->hasFile('file') 
                ? ($request->type === 'poster' 
                    ? 'image|mimes:jpeg,png,jpg,gif,svg|max:10240' 
                    : 'file|mimes:mp4,mov,ogg,qt,webm|max:51200')
                : 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = $validator->validated();

            if ($request->hasFile('file')) {
                if ($media->file_path && file_exists(public_path($media->file_path))) {
                    Helper::fileDelete(public_path($media->file_path));
                }
                $data['file_path'] = Helper::fileUpload($request->file('file'), 'home_media', time() . '_' . $request->file('file')->getClientOriginalName());
            }

            $media->update($data);
            return redirect()->route('admin.home_media.index')->with('t-success', 'Media updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $media = HomeMedia::findOrFail($id);
            if ($media->file_path && file_exists(public_path($media->file_path))) {
                Helper::fileDelete(public_path($media->file_path));
            }
            $media->delete();
            return response()->json([
                'status' => 't-success',
                'message' => 'Media deleted successfully!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 't-error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function status($id): JsonResponse
    {
        $data = HomeMedia::findOrFail($id);
        $data->status = $data->status === 'active' ? 'inactive' : 'active';
        $data->save();
        return response()->json([
            'status' => 't-success',
            'message' => 'Status changed successfully!',
        ]);
    }
}
