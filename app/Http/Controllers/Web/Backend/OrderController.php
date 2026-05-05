<?php

namespace App\Http\Controllers\Web\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;


class OrderController extends Controller
{
    public function __construct()
    {
        View::share('crud', 'order');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Order::with(['product'])->orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('product', function ($data) {
                    $title = $data->product->title ? Str::limit($data->product->title, 30) : 'N/A';
                    return $title;
                })
                ->addColumn('customer', function ($data) {
                    return $data->name . '<br><small>' . $data->phone . '</small>';
                })
                ->addColumn('address', function ($data) {
                    return Str::limit($data->address, 30);
                })
                ->addColumn('total', function ($data) {
                    return '$' . $data->total_amount;
                })
                ->addColumn('status', function ($data) {
                    $badgeClass = $data->status == "accept" ? 'bg-success' : ($data->status == 'pending' ? 'bg-warning' : 'bg-danger');
                    return '<span class="badge ' . $badgeClass . '">' . ucfirst($data->status) . '</span>';
                })
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group btn-group-sm" role="group">
                                <a href="#" onclick="showStatusChangeAlert(' . $data->id . ')" class="btn btn-primary fs-14 text-white" title="Change Status">
                                    <i class="fe fe-refresh-cw"></i>
                                </a>
                                <a href="#" onclick="showDeleteConfirm(' . $data->id . ')" class="btn btn-danger fs-14 text-white" title="Delete">
                                    <i class="fe fe-trash"></i>
                                </a>
                            </div>';
                })
                ->rawColumns(['customer', 'status', 'action'])
                ->make();
        }
        return view("backend.layouts.order.index");
    }
    public function show(int $id)
    {
        $order = Order::with(['product', 'user'])->where('id', $id)->first();
        return view('backend.layouts.order.show', compact('order'));
    }

    public function status(int $id): JsonResponse
    {
        $data = Order::findOrFail($id);
        if (!$data) {
            return response()->json([
                'status' => 't-error',
                'message' => 'Item not found.',
            ]);
        }
        $data->status = $data->status === 'accept' ? 'reject' : 'accept';
        $data->save();
        return response()->json([
            'status' => 't-success',
            'message' => 'Your action was successful!',
        ]);
    }
}
