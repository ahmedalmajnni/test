<?php

namespace App\Http\Controllers\Invoices;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Section;
use Illuminate\Http\Request;

class InvoiceCustomerReportController extends Controller
{
    public function index()
    {

        $sections = Section::all();
        return view('reports.customers_report', compact('sections'));
    }
    public function search(Request $request)
    {
        $start_at = $request->start_at;
        $end_at = $request->end_at;
        // if the time is empty
        if ($request->Section && $request->product && $request->start_at == '' && $request->end_at == '') {
            $sections = Section::all();
            $invoices = Invoice::select('*')->where('section_id', $request->Section)->where('product', $request->product)->get();
            return view('reports.customers_report', compact('sections', 'invoices'));
        } // if the section && product is empty
        elseif ($request->start_at  && $request->end_at) {
            $sections = Section::all();
            $invoices = Invoice::select('*')->whereBetween('invoice_Date', [$start_at, $end_at])->get();
            // dd( $invoices );
            return view('reports.customers_report', compact('sections', 'invoices'));
        } // nothing is empty
        else {
            $sections = Section::all();
            $invoices = Invoice::select('*')->whereBetween('invoice_Date', [$start_at, $end_at])->where('section_id', $request->Section)->where('product', $request->product)->get();

            return view('reports.customers_report', compact('sections', 'invoices'));
        }
    }
}
