<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\Dependence;

class TransactionController extends Controller
{
    public function deliver()
    {
        return view('transaction.deliver');
    }

    public function return(){
        return view('transaction.return');
    }

    public function returnStorage(Request $request){
        $validator = Validator::make($request->all(), [
            'dependence.id' => 'required|Integer',
            'products.*.id' => 'required|Integer',
            'products.*.quantity' => 'Integer',
            ]);
            
            if ($validator->fails()) {
                return response()->json(['errores'=>$validator->errors()]);
            }
            DB::transaction(function() use($request) {
                $dependence = $request['dependence.id'];
                $orderId = DB::table('orders')->insertGetId(['dependence_id' => $dependence, 'type' => 'Devolución']);
                $order = Order::find($orderId);
                $order_detail = $this->requestToArray($request,$order,1);
                DB::table('order_detail')->insert($order_detail);
            });
            return response()->json(['data'=> 'Success']);
    }

    public function deliverStorage(Request $request){
        $validator = Validator::make($request->all(), [
            'dependence.id' => 'required|Integer',
            'products.*.id' => 'required|Integer',
            'products.*.quantity' => 'Integer',
            ]);
            
            if ($validator->fails()) {
                return response()->json(['errores'=>$validator->errors()]);
            }
            DB::transaction(function() use($request) {
                $dependence = $request['dependence.id'];
                $orderId = DB::table('orders')->insertGetId(['dependence_id' => $dependence, 'type' =>'Entrega']);
                $order = Order::find($orderId);
                $order_detail = $this->requestToArray($request,$order,0);
                DB::table('order_detail')->insert($order_detail);
            });
            return ['redirect' => route('orders.home')];
    }
/**
 * @type "0" => deliver ** "1" => return 
 * 
 */
    private function requestToArray(Request $request, Order $order,int $type){
        try
        {
            $batteries = $request->input('batteries');
            $orders = array();
            foreach ($batteries as $battery) {
                array_push($orders,
                    [
                        'battery_id' => $battery['id'], 
                        'order_id' => $order['id'],
                        'quantity' => (int)$battery['quantity']
                    ]
                );
                $p = Battery::find($battery['id']);
                if($type == 0){
                    $p->stock -= (int)$battery['quantity'];
                }elseif($type == 1){
                    $p->stock += (int)$battery['quantity'];
                }
                $p->save();
            }
            return $orders;
        }
        catch(Exception $ex){
            abort(500,'Excepcion en Request To Array');
        }
    }
}
