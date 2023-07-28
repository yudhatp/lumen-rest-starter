<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $total_order = Order::count();
        $total_category = Category::count();
        $total_income = Order::sum('total_price');
        $recent_order = Order::orderBy('order_number')->limit(5)->get();
        return response()->json([
            'message'       =>'ok',
            'total_order'   => $total_order,
            'total_category'=> $total_category,
            'total_income'  => $total_income,
            'recent_order'  => $recent_order
        ], 200);
    }
}