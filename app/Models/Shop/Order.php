<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Order extends Model
{
    protected $table = 'sh_orders';

    protected $fillable = ['name', 'phone', 'comment', 'order', 'sort', 'status'];

    public static function orderStore(Order $order, Request $request)
    {
        $data = $request->except('amounts', 'deletes', 'comment', '_token', 'hidden');
        if($c =$request->comment){
            $order->comment = $c;
        }
        $order->fill($data);
        $amounts = $request->amounts;
        if($deletes = $request->deletes) {
            $keys = array_keys($deletes);
            foreach ($keys as $key)
                unset($amounts[$key]);
        }
        $products = json_encode($amounts);
        $order->order = $products;
        $order->save();
        return $order;
    }


    public function getStatus() {
        return $this->getStatusName($this->status);
    }

    public function getStatuses() {
        return [
            0 =>'Новый',
            1 => 'Принят',
            2 => 'Сдан'
        ];
    }

    private function getStatusName($num) {
        switch ($num) {
            case '0': return 'Новый';
                break;
            case '1': return 'Принят';
                break;
            case '2': return 'Сдан';
            default:
                return 'Нет статуса';
        }
    }
}
