<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\CourseEnrollment;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LeadController extends Controller
{
    public function enrollments(Request $request)
    {
        if ($request->ajax()) {
            $data = CourseEnrollment::with('course')->orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('course', function ($data) {
                    return $data->course->title;
                })
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group btn-group-sm" role="group">
                                <a href="#" onclick="showDeleteConfirm(' . $data->id . ', \'enrollment\')" class="btn btn-danger fs-14 text-white" title="Delete">
                                    <i class="fe fe-trash"></i>
                                </a>
                            </div>';
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view("backend.layouts.lead.enrollments");
    }

    public function serviceRequests(Request $request)
    {
        if ($request->ajax()) {
            $data = ServiceRequest::with('service')->orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('service', function ($data) {
                    return $data->service->title;
                })
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group btn-group-sm" role="group">
                                <a href="#" onclick="showDeleteConfirm(' . $data->id . ', \'service-request\')" class="btn btn-danger fs-14 text-white" title="Delete">
                                    <i class="fe fe-trash"></i>
                                </a>
                            </div>';
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view("backend.layouts.lead.service_requests");
    }

    public function destroyEnrollment($id)
    {
        try {
            CourseEnrollment::findOrFail($id)->delete();
            return response()->json(['status' => 't-success', 'message' => 'Enrollment deleted successfully!']);
        } catch (\Exception $e) {
            return response()->json(['status' => 't-error', 'message' => $e->getMessage()]);
        }
    }

    public function destroyServiceRequest($id)
    {
        try {
            ServiceRequest::findOrFail($id)->delete();
            return response()->json(['status' => 't-success', 'message' => 'Service request deleted successfully!']);
        } catch (\Exception $e) {
            return response()->json(['status' => 't-error', 'message' => $e->getMessage()]);
        }
    }
}
