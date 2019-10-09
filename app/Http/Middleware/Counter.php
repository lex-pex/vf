<?php

namespace App\Http\Middleware;

use App\Models\DailyVisit;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Visit;

class Counter
{
    public function handle(Request $request, Closure $next)
    {
        if($user = Auth::user()) {
            if(!$this->isAdmin($user)) {
                $this->record($request, $user);
            }
        } else {
            $this->record($request, null);
        }
        return $next($request);
    }

    public function record(Request $r, $user) {
        $urnArray = $r->segments();
        if($user) {
            $userId = $user->id;
        } else {
            $userId = 0;
        }
        $urn = count($urnArray) ? implode('/', $urnArray) : '/';
        if($visit = Visit::where('page', $urn)->first()) {
            $visit->increment('amount');
        } else {
            $visit = new Visit();
            $visit->page = $urn;
            $visit->user = $userId;
            $visit->amount = 1;
            $visit->save();
        }
        $d = date('Y/m/d');
        if($dv = DailyVisit::where('date', $d)->first()) {
            $dv->increment('amount');
        } else {
            $visit = new DailyVisit();
            $visit->date = $d;
            $visit->amount = 1;
            $visit->save();
        }
    }

    public function isAdmin($user) {
        if($user->role === 'admin') return true;
        return false;
    }
}
