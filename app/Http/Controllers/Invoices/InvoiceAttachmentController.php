<?php

namespace App\Http\Controllers\Invoices;

use App\Http\Controllers\Controller;
use App\Models\InvoiceAttachment;
use Faker\Provider\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoiceAttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return back();
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($invoice_number, $file_name)
    {
        $file_path = $invoice_number . '/' . $file_name;
       return response()->download($file_path);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InvoiceAttachment $invoiceAttachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InvoiceAttachment $invoiceAttachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $invoice = InvoiceAttachment::findOrFail($request->id_file);
        Storage::disk('public')->delete($request->invoice_number . '/' . $request->file_name);
        session()->flash('delete', 'deleted successful');
        return redirect('/invoice');
    }
}
