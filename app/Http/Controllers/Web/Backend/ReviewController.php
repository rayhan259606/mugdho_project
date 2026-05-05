<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Review::with(['product', 'user'])->orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('product', function ($data) {
                    return $data->product->title ?? 'N/A';
                })
                ->addColumn('user', function ($data) {
                    return $data->user->name ?? 'Guest';
                })
                ->addColumn('status', function ($data) {
                    $checked = $data->status == 'active' ? 'checked' : '';
                    return '<div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" onchange="toggleStatus(' . $data->id . ')" ' . $checked . '>
                            </div>';
                })
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group btn-group-sm">
                                <button onclick="showDeleteConfirm(' . $data->id . ')" class="btn btn-danger fs-14 text-white">
                                    <i class="fe fe-trash"></i>
                                </button>
                            </div>';
                })
                ->rawColumns(['status', 'action'])
                ->make();
        }
        return view('backend.layouts.review.index');
    }

    public function status($id)
    {
        $review = Review::findOrFail($id);
        $review->status = $review->status == 'active' ? 'inactive' : 'active';
        $review->save();
        return response()->json(['status' => 't-success', 'message' => 'Status updated successfully!']);
    }

    public function destroy($id)
    {
        try {
            Review::findOrFail($id)->delete();
            return response()->json(['status' => 't-success', 'message' => 'Review deleted successfully!']);
        } catch (\Exception $e) {
            return response()->json(['status' => 't-error', 'message' => $e->getMessage()]);
        }
    }
}
