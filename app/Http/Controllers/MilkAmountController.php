<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cow;
use App\Models\MilkAmount;
use Carbon\Carbon;
use Illuminate\Http\Request;


class MilkAmountController extends Controller
{
    public function index(Cow $cow)
    {
        $productionall=MilkAmount::where('cow_id',$cow->id)->get();
        return response()->json(['All Amount of Milking'=>$productionall]);
    }

    public function AmountPerWeek(Cow $cow)
    {
        $productionWeekly=MilkAmount::where('cow_id',$cow->id)
           ->where('updated_at','<=',Carbon::now()->format('Y-m-d H:i:s'))
            ->where('updated_at',
                '>=',
                (new \Carbon\Carbon)->subWeeks(1)->format('Y-m-d H:i:s'))
            ->get();

        return response()->json(['Production Per Week'=>$productionWeekly]);
    }

    public function AmountPerMonth(Cow $cow)
    {
        $productionMonthly=MilkAmount::where('cow_id',$cow->id)
            ->where('updated_at','<=',Carbon::now()->format('Y-m-d H:i:s'))
            ->where('updated_at',
                '>=',
                (new \Carbon\Carbon)->subMonths(1)->format('Y-m-d H:i:s'))
            ->get();

        return response()->json(['Production Per Monthly'=>$productionMonthly]);
    }
}
