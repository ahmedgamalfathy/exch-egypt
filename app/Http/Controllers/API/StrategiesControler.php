<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Stok;
use Illuminate\Http\Request;

class StrategiesControler extends Controller
{
    //حجم التداول اليومي
    // تقوم تحليل البيانات اليومية الاسعار يهدف فتح اغلاق الصفقة  في نفس اليوم يعتمد على حجم الاغلاق اليومي
     public function daily()
    {
        $daily=Stok::where('trading_volume', '>',100000)
        ->select('id','code','stock_name','annual_growth_rate','closing_price_year','closing_price_today')
        ->get()->unique('code')->map(function ($stok) {
            return $this->addPriceSuggestions($stok);
        });
        return response()->json([
            "status"=>200,
            "data"=>$daily,
        ],200);
    }

// استراتيجية السكالبينج(خلال فترة زمنية قصيرة )
//استخراج  الاسهم التي لديها نسبة سيولة عالية
    public function scalping()
    {
      $scalping= Stok::where('annual_growth_rate','>',2)
      ->select('id','code','stock_name','annual_growth_rate','closing_price_year','closing_price_today')
      ->get()->unique('code')->map(function ($stok) {
          return $this->addPriceSuggestions($stok);
      });
      return response()->json([
          "status"=>200,
          "data"=>$scalping
      ],200);
    }
//(فترة متوسطة) ستراتجية التداول المتارجح
//تهدف هذه الاستراتجية  الى الاستفادة من تقلبات الاسعار على مدى فتره متوسطة استخراج الاسهم التى لديها معدل سنوى مرتفع
    public function swing()
    {
         // استخراج الأسهم مع معدل نمو سنوي مرتفع
        $swing = Stok::where('annual_growth_rate', '>', 5)
        ->select('id','code','stock_name','annual_growth_rate','closing_price_year','closing_price_today')
        ->get()->unique('code')->map(function ($stok) {
            return $this->addPriceSuggestions($stok);
        });
        return response()->json([
            "status"=>200,
            "data"=>$swing
        ],200);
    }

    //استراتيجية تداول المراكز
    //الاستمثار في الاسهم لفترة طويلة (التركيز على الشركات التى تظهر استقرار او امكانيات نمو على المدى البعيد)

    public function positions(){
        // استخراج الأسهم مع صافي سويلة  مرتفعة
        $positions = Stok::where('net_liquidity', '>', 100000)
        ->select('id','code','stock_name','annual_growth_rate','closing_price_year','closing_price_today')
        ->get()->unique('code')->map(function ($stok) {
            return $this->addPriceSuggestions($stok);
        });
        return response()->json([
            "status"=>200,
            "data"=>$positions
        ],200);
    }
    private function addPriceSuggestions($stok)
    {
    $trend = 'ثابت'; // القيمة الافتراضية
    if ($stok->closing_price_today > $stok->closing_price_year) {
        $trend = 'صاعد';
    } elseif ($stok->closing_price_today < $stok->closing_price_year) {
        $trend = 'هابط';
    }

    $buy_price = floatval($stok->buy_price);
    $closing_price_today = floatval($stok->closing_price_today);
    $profit_percentage = 0;
    $loss_percentage = 0;
    if ($buy_price > 0) {
        $profit_percentage = (($closing_price_today - $buy_price) / $buy_price) * 100;
        if ($closing_price_today < $buy_price) {
            $loss_percentage = (($buy_price - $closing_price_today) / $buy_price) * 100;
        }
    }

        // نعيد إضافة أسعار الشراء والبيع الديناميكية
        return [
            'id' => $stok->id,
            'code' => $stok->code,
            'stock_name' => $stok->stock_name,
            // "closing_price_year"=>$stok->closing_price_year,
            // 'closing_price_today' => $stok->closing_price_today,
            'annual_growth_rate' => $stok->annual_growth_rate,
            // "internal_liquidity_volume"=>$stok->internal_liquidity_volume,
            // "internal_liquidity_value"=>$stok->internal_liquidity_value,
            // "external_liquidity_volume"=>$stok->external_liquidity_volume,
            // "external_liquidity_value"=>$stok->external_liquidity_value,
            // 'net_liquidity' => $stok->net_liquidity,
            // "liquidity_ratio"=> $stok->liquidity_ratio,
            // 'trading_volume' => $stok->trading_volume,
            "trend" => $trend, // إضافة الاتجاه
            'buy_price' => $stok->buy_price,
            'sell_price' => $stok->sell_price,
            'profit_percentage' =>number_format($profit_percentage,2), // نسبة الربح
            'loss_percentage' => $loss_percentage, // نسبة الخسارة
            // "created_at"=> $stok->created_at,
            // "updated_at"=> $stok->updated_at
        ];
    }


}
