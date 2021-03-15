<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calculator extends Model
{
    public function calculate(string $a): ?string
    {   
        return eval('return '.$a.';');

    }
}

