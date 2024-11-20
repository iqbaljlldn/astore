<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\SaleItems;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function sales() {
        $dailySales = Sales::whereDate('created_at', Carbon::today())->sum('total_price');
        $monthlyRevenue = Sales::whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->sum('total_price');
        $yearlyRevenue = Sales::whereYear('created_at', Carbon::now()->year)->sum('total_price');
        $monthlySales = Sales::select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(total_price) as total_price'))
                            ->whereYear('created_at', Carbon::now()->year)
                            ->groupBy(DB::raw('MONTH(created_at)'))
                            ->orderBy(DB::raw('MONTH(created_at)'))
                            ->get();
        $yearlySales = Sales::select(DB::raw('YEAR(created_at) as year'), DB::raw('SUM(total_price) as total_price'))
                            ->groupBy(DB::raw('YEAR(created_at)'))
                            ->orderBy(DB::raw('YEAR(created_at)'))
                            ->get();

        $previousMonth = Sales::whereMonth('created_at', Carbon::now()->submonth()->month)->sum('total_price');

        if ($previousMonth === 0) {
            $percentage = $monthlyRevenue > 0 ? 100.0 : 0.0;
        } else {
            $percentage = (($monthlyRevenue - $previousMonth) / $previousMonth) * 100;
        }


        return response()->json([
            'status' => true,
            'data' => [
                'sales' => [
                    'dailySales' => $dailySales,
                    'monthlyRevenue' => $monthlyRevenue,
                    'yearlyRevenue' => $yearlyRevenue,
                    'monthlySales' => $monthlySales,
                    'yearlySales' => $yearlySales,
                ],
                'growth' => $percentage,
            ],
        ]);
    }

    public function topSeller() {
        $topFrequents = SaleItems::with('product')
                                ->select('product_id')
                                ->selectRaw('count(*) as count')
                                ->whereMonth('created_at', Carbon::now()->month)
                                ->whereYear('created_at', Carbon::now()->year)
                                ->groupBy('product_id')
                                ->orderByDesc('count')
                                ->take(5)
                                ->get();

        return response()->json([
            'status' => true,
            'data' => $topFrequents
        ]);
    }
}
