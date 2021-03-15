<?php

namespace App\Http\Controllers;
use App\Models\Calculator;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class CalculatorController extends Controller
{
     public function index(Calculator $calculator): View
    {
        return view('calculator');
        
    }
    public function calculate(Calculator $calculator)
    { 
        $this->validate(request(), [
        'a' => ['required', 'string'],
        ]);
        $a = request()->input('a');
        $result = $calculator->calculate($a);

        return response()->json(['a' => $a,'result' => $result]);
    }

}

