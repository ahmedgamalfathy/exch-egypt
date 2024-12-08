<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Stok;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class FilterController extends Controller
{
    public function filterReports(Request $request,$slug)
    {
            $period = $request->input('period'); // يمكن أن تكون "annual" أو "semiannual" أو "monthly" أو "weekly"

            // تعيين تاريخ البداية والنهاية بناءً على نوع التقرير
            $startDate = Carbon::today();
            $endDate = Carbon::today();

            switch ($period) {
                case 'annual':
                    $startDate = Carbon::now()->subYear();
                    break;
                case 'semiannual':
                    $startDate = Carbon::now()->subMonths(6);
                    break;
                case 'monthly':
                    $startDate = Carbon::now()->subMonth();
                    break;
                case 'weekly':
                    $startDate = Carbon::now()->subWeek();
                    break;
                default:
                    return response()->json(['error' => 'Invalid period'], 400);
            }
            // $stokId=Stok::findOrFail($id);
            try {
                $stockHistory = QueryBuilder::for(Stok::class)
                    ->AllowedFilters('id','code','stock_name','closing_price_year',
                    'closing_price_today','annual_growth_rate','internal_liquidity_volume','internal_liquidity_value','external_liquidity_value','net_liquidity','liquidity_ratio','trading_volume')
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->where('code','LIKE','%'.$slug.'%')
                    ->orderBy('created_at', 'asc')
                    ->get();

                    return response()->json([
                        "status"=>200,
                        "data"=>$stockHistory
                    ]);
            } catch (ModelNotFoundException $e) {
                    return response()->json([
                        "status"=>404,
                        "msg"=>"هذا السجل لم يعد موجودا"
                    ]);
            }

        }

}
