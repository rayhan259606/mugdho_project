<?php

namespace App\Http\Controllers\Web\Backend;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;

class ServiceController extends Controller
{
    public function __construct()
    {
        View::share('crud', 'service');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Service::query()->orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($data) {
                    $url = asset($data->image && file_exists(public_path($data->image)) ? $data->image : 'default/logo.svg');
                    return '<img src="' . $url . '" alt="image" style="width: 50px; max-height: 100px; margin-left: 20px;">';
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
                ->rawColumns(['image', 'status', 'action'])
                ->make();
        }
        return view("backend.layouts.service.index");
    }

    public function create()
    {
        return view('backend.layouts.service.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = $validator->validated();
            if ($request->hasFile('image')) {
                $data['image'] = Helper::fileUpload($request->file('image'), 'service', time() . '_' . $request->file('image')->getClientOriginalName());
            }

            Service::create($data);
            return redirect()->route('admin.service.index')->with('t-success', 'Service created successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('backend.layouts.service.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $service = Service::findOrFail($id);
            $data = $validator->validated();

            if ($request->hasFile('image')) {
                if ($service->image && file_exists(public_path($service->image))) {
                    Helper::fileDelete(public_path($service->image));
                }
                $data['image'] = Helper::fileUpload($request->file('image'), 'service', time() . '_' . $request->file('image')->getClientOriginalName());
            }

            $service->update($data);
            return redirect()->route('admin.service.index')->with('t-success', 'Service updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $service = Service::findOrFail($id);
            if ($service->image && file_exists(public_path($service->image))) {
                Helper::fileDelete(public_path($service->image));
            }
            $service->delete();
            return response()->json([
                'status' => 't-success',
                'message' => 'Service deleted successfully!'
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
        $data = Service::findOrFail($id);
        $data->status = $data->status === 'active' ? 'inactive' : 'active';
        $data->save();
        return response()->json([
            'status' => 't-success',
            'message' => 'Status changed successfully!',
        ]);
    }
}
