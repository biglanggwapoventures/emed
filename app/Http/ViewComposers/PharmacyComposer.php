<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Pharmacy;

class PharmacyComposer
{
    public function __construct()
    {
        
    }

    public function compose(View $view)
    {
        $view->with('pharmacies', Pharmacy::orderBy('pharmacy_branches')->get());
    }
}