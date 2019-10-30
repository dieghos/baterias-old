<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Order;
use Carbon\Carbon;

class ReportController extends Controller
{
    private $JAN = 'SUM(IF(MONTH(order_detail.created_at)=1,quantity,0)) as total_jan';
    private $FEB = 'SUM(IF(MONTH(order_detail.created_at)=2,quantity,0)) as total_feb';
    private $MAR = 'SUM(IF(MONTH(order_detail.created_at)=3,quantity,0)) as total_mar';
    private $APR = 'SUM(IF(MONTH(order_detail.created_at)=4,quantity,0)) as total_apr';
    private $MAY = 'SUM(IF(MONTH(order_detail.created_at)=5,quantity,0)) as total_may';
    private $JUN = 'SUM(IF(MONTH(order_detail.created_at)=6,quantity,0)) as total_jun';
    private $JUL = 'SUM(IF(MONTH(order_detail.created_at)=7,quantity,0)) as total_jul';
    private $AUG = 'SUM(IF(MONTH(order_detail.created_at)=8,quantity,0)) as total_aug';
    private $SEP = 'SUM(IF(MONTH(order_detail.created_at)=9,quantity,0)) as total_sep';
    private $OCT = 'SUM(IF(MONTH(order_detail.created_at)=10,quantity,0)) as total_oct';
    private $NOV = 'SUM(IF(MONTH(order_detail.created_at)=11,quantity,0)) as total_nov';
    private $DEC = 'SUM(IF(MONTH(order_detail.created_at)=12,quantity,0)) as total_dec';
    
    public function index(Request $request)
    {
        $products = [];
        $tipo = $request->has('deliver')? $request->deliver : 'Entrega';
        if($request->has('type')){
            switch ($request->type) {
                case 'year':
                    $products = $this->getByYear($tipo);
                    $products->type = 'yearly';
                    break;
                case 'month':
                    $year = $request->has('year') ? $request->year: date("Y");
                    $products = $this->getByMonth($tipo,$year);
                    $products->type = 'monthly';
                    break;
                case 'model':
                    $products = $this->getByModel($tipo);
                    $products->type = 'model';
                    break;
                default:
                    $products = $this->getByYear($tipo);
                    $products->type = 'yearly';
                    break;
            }
        }
        return view('reports.index',['products'=>$products]);
    }
    /**
     * Devuelve la cuenta de las transacciones hechas discriminadas por año y tipo.-
     * $type - String "Entrega o Devolución"
     */
    private function getByYear($type){
        return DB::table('order_detail')
                     ->select('products.name','orders.type', DB::raw('SUM(quantity) as total_products, YEAR(order_detail.created_at) as year'))
                     ->join('products', 'products.id', '=', 'order_detail.product_id')
                     ->join('orders', 'orders.id', '=', 'order_detail.order_id')
                     //->where('orders.type',$type)
                     ->groupBy(DB::raw('YEAR(order_detail.created_at)'),'products.name','orders.type')
                     ->get();
    }
                    

    private function getByMonth($type,$year){
        return DB::table('order_detail')
                    ->select('products.name',
                        DB::raw($this->JAN),
                        DB::raw($this->FEB),
                        DB::raw($this->MAR),
                        DB::raw($this->APR),
                        DB::raw($this->MAY),
                        DB::raw($this->JUN),
                        DB::raw($this->JUL),
                        DB::raw($this->AUG),
                        DB::raw($this->SEP),
                        DB::raw($this->OCT),
                        DB::raw($this->NOV),
                        DB::raw($this->DEC)
                    )
                    ->join('products', 'products.id', '=', 'order_detail.product_id')
                    ->join('orders', 'orders.id', '=', 'order_detail.order_id')
                    ->where(DB::raw('YEAR(order_detail.created_at)'),$year)
                    ->where('orders.type',$type)
                    ->groupBy('products.name')
                    ->get();
    }

    private function getByModel($type){
        return DB::table('order_detail')
                ->select('products.name','orders.type',DB::raw('SUM(quantity) as total_products'))
                ->join('products', 'products.id', '=', 'order_detail.product_id')
                ->join('orders', 'orders.id', '=', 'order_detail.order_id')
                //->where('orders.type',$type)
                ->groupBy('products.name','orders.type')
                ->get();
    }

}

// $products = DB::table('order_detail')
//              ->select('products.name','product_id', DB::raw('SUM(quantity) as total_products,YEAR(order_detail.created_at) as year,MONTH(order_detail.created_at) as month'))
//              ->join('products', 'products.id', '=', 'order_detail.product_id')
//              ->groupBy('product_id',DB::raw('YEAR(order_detail.created_at),MONTH(order_detail.created_at)'))
//              ->get();