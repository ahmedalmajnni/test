<?php

namespace App\Http\Controllers\Invoices;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceAttachment;
use App\Models\invoices_details;
use App\Models\Section;
use App\Models\User;
use App\Notifications\AddInvoiceNotification;
use App\Notifications\InvoiceNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{

    public function index()
    {
        $invoices = Invoice::all();
        return view('invoices.invoices', compact('invoices'));
    }


    public function create()
    {
        $sections = Section::all();
        return view('invoices.add_invoice', compact('sections'));
    }


    public function store(Request $request)
    {
        $validate = $request->validate([
            'invoice_number' => 'required',
            'invoice_Date' => 'required',
            'Due_date' => 'required',
            'product' => 'required',
            'Section' => 'required',
            'Amount_collection' => 'required',
            'Amount_Commission' => 'required',
            //      'Discount' =>,
            //     'Value_VAT' =>,
            //    'Rate_VAT' =>,
            //    'Total' =>,
            //    'Status' =>,
            //    'Value_Status' =>,
            //    'note' =>,


        ]);

        $data=Invoice::create([
            'id' => $request->id,
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'Status' => 'unpaid',
            'Value_Status' => 0,
            'note' => $request->note,
        ]);

        $invoice_id = Invoice::latest()->first()->id;
        invoices_details::create([
            'invoice_id' => $invoice_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'Section' => $request->Section,
            'Status' => 'unpaid',
            'Value_Status' => 0,
            'note' => $request->note,
            'user' => (Auth::user()->name),
        ]);

        // save file
        if ($request->hasFile('pic')) {

            $invoice_id = Invoice::latest()->first()->id;
            $file = $request->file('pic');
            $file_name = $file->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            $attachment = new InvoiceAttachment();
            $attachment->file_name = $file_name;
            $attachment->invoice_number = $invoice_number;
            $attachment->Created_by = Auth::user()->name;
            $attachment->invoice_id = $invoice_id;
            $attachment->save();

            $request->pic->move(public_path('/Attachments' . $invoice_number), $file_name);
        }



        $users = User::first();
        // just notification
        $users->notify(new AddInvoiceNotification($invoice_id));
        // mail
        // $users->notify(new InvoiceNotification($invoice_id));

        return redirect('/invoices')->with('success', 'Invoice Added successfully');
    }


    public function show($id)
    {
        // show update status
        $invoices = Invoice::where('id', $id)->first();
        return view('invoices.status_update', compact('invoices'));
    }


    public function edit(Request $request)
    {
        $id = $request->id;
        $invoices = Invoice::where('id', $id)->first();
        $sections = Section::all();
        return view('invoices.edit_invoice', compact('invoices', 'sections'))
            ->with('success', 'Invoice edited successfully');
    }


    public function update(Request $request)
    {

        $invoices = Invoice::find($request->id);
        $invoices->update([

            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'note' => $request->note,
        ]);
        return redirect('/invoices')
            ->with('success', 'Invoice updated successfully');
    }


    public function destroy(Request $request, InvoiceAttachment $attachment)
    {
        $id = $request->invoice_id;


        $invoices = Invoice::where('id', $id)->first();
        $attachment = InvoiceAttachment::where('invoice_id', $id)->get();
        $id_page = $request->id_page;
        if (!$id_page == 2) {
            if (!empty($attachment->invoice_number)) {
                Storage::disk('public')->deleteDirectory($invoices->invoice_number);
            };

            $invoices->forceDelete();
            return redirect('/invoices')->with('success1', 'Invoice deleted successfully');
        } else {
            $invoices->delete();
        }
        return redirect('/invoices')->with('success', 'Invoice archived successfully');
    }

    public function get_product($id)
    {
        $products = DB::table('products')->where('section_id', $id)->pluck('product_name', 'id');
        return json_encode($products);
    }
    public function status_update($id, Request $request)
    {

        $invoice = Invoice::findOrFail($id);
        if ($request->Status === 'Paid') {

            $invoice->update([
                'Status' => $request->Status,
                'Value_Status' => 1,
                'Payment_Date' => $request->Payment_Date
            ]);

            invoices_details::create([
                'invoice_id' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $request->Section,
                'Status' => $request->Status,
                'Value_Status' => 1,
                'note' => $request->note,
                'user' => (Auth::user()->name),
            ]);
        } else {
            $invoice->update([
                'Status' =>  $request->Status,
                'Value_Status' => 2,
                'Payment_Date' => $request->Payment_Date
            ]);
            invoices_details::where([
                'invoice_id' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $request->Section,
                'Status' =>  $request->Status,
                'Value_Status' => 2,
                'note' => $request->note,
                'user' => (Auth::user()->name),
            ]);
        }
        return redirect('/invoices');
    }
    public function paid_invoices()
    {

        $invoices = Invoice::where('Value_Status', 1)->get();

        return view('invoices.invoices_paid', compact('invoices'));
    }
    public function unpaid_invoices()
    {

        $invoices = Invoice::where('Value_Status', 0)->get();
        return view('invoices.invoices_unpaid', compact('invoices'));
    }
    public function partly_paid_invoices()
    {

        $invoices = Invoice::where('Value_Status', 2)->get();
        return view('invoices.invoices_Partial', compact('invoices'));
    }
    public function Print_invoice($id)
    {
        $invoices = Invoice::where('id', $id)->first();
        return view('invoices.Print_invoice', compact('invoices'));
    }

    public function MarkAsRead()
    {

        $unreadNotifications = Auth::user()->unreadNotifications;
        if ($unreadNotifications) {
            $unreadNotifications->MarkAsRead();
            return back();
        }
    }
}
