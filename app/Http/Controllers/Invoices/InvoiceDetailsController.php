<?php

namespace App\Http\Controllers\Invoices;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceAttachment;
use App\Models\Invoices_attachments;
use App\Models\invoices_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceDetailsController extends Controller
{

    function __construct()
    {

        $this->middleware(['permission:Add Attachment'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:Delete Attachment'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Add attachments in the details
        $file = $request->file('file_name');
        $file_name = $file->getClientOriginalName();
        $invoice_number = $request->invoice_number;

        $attachments = new InvoiceAttachment();
        $attachments->file_name = $file_name;
        $attachments->invoice_number = $invoice_number;
        $attachments->created_by = Auth::user()->name;
        $attachments->invoice_id = $request->invoice_id;
        $attachments->save();


        $imageName = $request->file_name->getClientOriginalName();
        $request->file_name->move(public_path('/Attachments' . $invoice_number), $imageName);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $invoice = Invoice::where("id", $id)->first();
        $details = invoices_details::where("invoice_id", $id)->get();
        $attachments = InvoiceAttachment::where("invoice_id", $id)->get();
        // click to read
        $unreadnotifications = Auth::user()->unreadnotifications;
        if ($unreadnotifications) {
            $unreadnotifications->MarkAsRead();
        }
        return view("invoices.invoices_details", compact('details', 'invoice', 'attachments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoices_details $invoices_details)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoices_details $invoices_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoices_details $invoices_details)
    {
        //
    }
}
