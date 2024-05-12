<?php

namespace App\Http\Controllers\Invoices;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceReport extends Controller
{
    public function index()
    {
        return view('reports.invoices_report');
    }
    public function search(Request $request)
    {
        $start_at = date($request->start_at);
        $end_at = date($request->end_at);
        $type = $request->type;
        $rdio = $request->rdio;
        if ($rdio == 1) {
            // if the time is empty
            if ($request->type  && $request->start_at == '' && $request->end_at == '') {
                $invoices = Invoice::select('*')->where('Status', '=', $type)->get();

                return view('reports.invoices_report', compact('type', 'invoices'));
            }
            // if the type is empty
            elseif ($request->start_at  && $request->end_at) {

                $invoices = Invoice::whereBetween('invoice_Date', [$start_at, $end_at])->get();

                return view('reports.invoices_report', compact('invoices', 'start_at', 'end_at'));
            } //nothing is empty
            else {
                $invoices = Invoice::whereBetween('invoice_Date', [$start_at, $end_at])->where('Status', '=', $type)->get();
                return view('reports.invoices_report', compact('type', 'invoices', 'start_at', 'end_at'));
            }
        } //search by the invoice number
        else {

            $invoices = Invoice::where('invoice_number', '=', $request->invoice_number)->get();
            return view('reports.invoices_report', compact('invoices'));
        }
    }
}
