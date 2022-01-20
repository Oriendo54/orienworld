<?php

namespace app\Http\Controllers\Pof;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class IndexController extends Controller {
    
    public function index2(Request $request) {
        
        return response()->json([
            'view' => view('pony.index.index2')->render()
        ]);
    }
}