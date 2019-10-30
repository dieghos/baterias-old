<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  
        if ($request->has('type')) {
            $type = $request->input('type');
        }
        else{
            $type = 'entrega';
        }
        $orders = Order::where('type',$type)->get();
        return view('order.index',["orders"=>$orders]);
    }

    public function getYears()
    {
        return DB::table('order_detail')
            ->select(DB::raw('YEAR(order_detail.created_at) as year'))
            ->distinct()
            ->orderByRaw('year DESC')
            ->groupBy('created_at')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {

        return view('order.show',['order'=>$order]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }


    //functions

    private function getOrderData(string $type){
        $order_table = DB::table('order_detail')->select('order_id','quantity','orders.dependence_id','products.name as pname','orders.created_at')
        ->join('products', 'products.id', '=', 'order_detail.product_id')
        ->join('orders', 'orders.id', '=', 'order_detail.order_id')
        ->where('orders.type',$type);
        
        $order_merged_table = DB::table('dependences')->select('*')
            ->joinSub($order_table, 'order_detail', function ($join) {
                $join->on('dependences.id', '=', 'order_detail.dependence_id');
            })
            ->orderBy('order_id', 'desc')
            ->get();

        return $order_merged_table;
    }

    private function formatOrders($order_merged_table){
        $orders = [];
        $last_order = count($order_merged_table)>0 ? $order_merged_table[0]: null;
        $order_id = 0;
        $products = [];
        foreach ($order_merged_table as $order) {
            if($order->order_id == $last_order->order_id){
                array_push($products,$this->extractProductInfo($order));
            }else{
                array_push($orders,$this->getOrderInfo($last_order,$products));
                $products = [];
                array_push($products,$this->extractProductInfo($order));
            }
            $last_order = $order;
        }
        if(count($products)>0)
        {
            array_push($orders,$this->getOrderInfo($last_order,$products));
        }
        return $orders;
    }

    private function extractProductInfo(Object $order)
    {
        return [
            'product_name' => $order->pname, 
            'product_quantity' => $order->quantity
        ];
    }

    private function getOrderInfo(Object $order, Array $products)
    {
        return [
            'order_id' => $order->order_id,
            'dependence_code' => $order->code,
            'dependence_name' => $order->name,
            'products' => $products,
            'created_at' => $order->created_at,
        ];
    }
}
