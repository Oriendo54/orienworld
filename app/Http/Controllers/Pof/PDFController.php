<?php

namespace app\Http\Controllers\Pof;

use PDF;
use Carbon\Carbon;
use App\Models\Pof\PofTva;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Pof\PofFacture;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PDFController extends Controller {
    
    public function testpdf(Request $request) {
        
        $pdf = PDF::loadHTML("Mon contenu HTML ici");
        
        return $pdf->download(\Str::slug("PROUT").".pdf");
    }
    
    public function PDFFacture($id_facture) {
        
        $facture = PofFacture::find($id_facture);
        $tvas = PofTva::all();
        $pdf = PDF::loadView('pony.pdf.pdf_facture',compact('facture','tvas'));
        
        return $pdf->download("POF_facture_$id_facture.pdf");
    }
    
    public function PDFFactureHtml($id_facture) {
        
        $facture = PofFacture::find($id_facture);
        $tvas = PofTva::all();
        return view('pony.pdf.pdf_facture',compact('facture','tvas'));
    }
}