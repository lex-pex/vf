<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = ['page', 'user', 'amount', 'timestamps'];

    public static function amount($urn) {
        $visit = Visit::all()->where('page', $urn)->first();
        if($visit)
            return $visit->amount;
        return 0;
    }
}
