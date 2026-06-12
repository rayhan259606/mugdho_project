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
            $data = Order::with(['product', 'antiqueProduct', 'digitalProduct', 'gadget'])->orderBy('id', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('product', function ($data) {
                    if ($data->product_id) {
                        return $data->product->title ?? 'Product Deleted';
                    } elseif ($data->antique_product_id) {
                        return ($data->antiqueProduct->title ?? 'Antique Product Deleted') . ' (Antique)';
                    } elseif ($data->digital_product_id) {
                        return ($data->digitalProduct->title ?? 'Digital Product Deleted') . ' (Digital)';
                    } elseif ($data->gadget_id) {
                        return ($data->gadget->title ?? 'Gadget Deleted') . ' (Gadget)';
                    }
                    return 'N/A';
                })
                ->addColumn('customer', function ($data) {
                    return $data->name . '<br><small>' . $data->phone . '</small>';
                })
                ->addColumn('address', function ($data) {
                    return Str::limit($data->address, 30);
                })
                ->addColumn('total', function ($data) {
                    return '৳' . ($data->price + ($data->shipping_charge ?? 0));
                })
                ->addColumn('status', function ($data) {
                    $backgroundColor = $data->status == "accepted" ? '#4CAF50' : ($data->status == "pending" ? '#ffc107' : '#ccc');
                    $sliderTranslateX = $data->status == "accepted" ? '26px' : '2px';
                    
                    $status = '<div class="d-flex justify-content-center align-items-center">';
                    $status .= '<div class="form-check form-switch" style="position: relative; width: 50px; height: 24px; background-color: ' . $backgroundColor . '; border-radius: 12px; transition: background-color 0.3s ease; cursor: pointer;">';
                    $status .= '<input onclick="showStatusChangeAlert(' . $data->id . ')" type="checkbox" class="form-check-input" id="customSwitch' . $data->id . '" getAreaid="' . $data->id . '" name="status" style="position: absolute; width: 100%; height: 100%; opacity: 0; z-index: 2; cursor: pointer;">';
                    $status .= '<span style="position: absolute; top: 2px; left: 2px; width: 20px; height: 20px; background-color: white; border-radius: 50%; transition: transform 0.3s ease; transform: translateX('.$sliderTranslateX.');"></span>';
                    $status .= '<label for="customSwitch' . $data->id . '" class="form-check-label" style="margin-left: 10px;"></label>';
                    $status .= '</div>';
                    $status .= '<span class="ms-2 small text-muted">'.ucfirst($data->status).'</span>';
                    $status .= '</div>';
                
                    return $status;
                })
                ->addColumn('payment', function ($data) {
                    if (!$data->payment_method) return '<span class="badge bg-secondary">COD</span>';
                    $label = strtoupper($data->payment_method);
                    $badge = $data->payment_method === 'bkash' ? 'bg-danger' : 'bg-warning text-dark';
                    $paidTo = $data->paid_to ? '<br><small class="text-muted">' . $data->paid_to . '</small>' : '';
                    return '<span class="badge ' . $badge . '">' . $label . '</span>' . $paidTo;
                })
                ->addColumn('trx_id', function ($data) {
                    if (!$data->transaction_id) return '<span class="text-muted">—</span>';
                    return '<code class="small">' . $data->transaction_id . '</code>';
                })
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group btn-group-sm" role="group">
                                <a href="' . route('admin.order.show', $data->id) . '" class="btn btn-info fs-14 text-white" title="View">
                                    <i class="fe fe-eye"></i>
                                </a>
                                <a href="#" onclick="showDeleteConfirm(' . $data->id . ')" class="btn btn-danger fs-14 text-white" title="Delete">
                                    <i class="fe fe-trash"></i>
                                </a>
                            </div>';
                })
                ->rawColumns(['customer', 'payment', 'trx_id', 'status', 'action'])
                ->make();
        }
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $completedOrders = Order::where('status', 'accepted')->count();
        $totalRevenue = Order::where('status', 'accepted')->get()->sum(function($order) {
            return $order->price + ($order->shipping_charge ?? 0);
        });

        return view("backend.layouts.order.index", compact('totalOrders', 'pendingOrders', 'completedOrders', 'totalRevenue'));
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $order = Order::findOrFail($id);
            $order->delete();
            return response()->json([
                'status' => 't-success',
                'message' => 'Order deleted successfully!',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 't-error',
                'message' => $e->getMessage(),
            ]);
        }
    }
    public function show(int $id)
    {
        $order = Order::with(['product', 'antiqueProduct', 'digitalProduct', 'gadget'])->findOrFail($id);
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
        $data->status = $data->status === 'accepted' ? 'pending' : 'accepted';
        $data->save();
        return response()->json([
            'status' => 't-success',
            'message' => 'Your action was successful!',
        ]);
    }
}
