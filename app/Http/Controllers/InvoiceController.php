<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Invoice;

use App\Item;

use PDF;


class InvoiceController extends Controller
{
	public function index()
    {
        $invoice = Invoice::all();

        $invoice = DB::table('invoices')->paginate(5);

        return view('index', ['invoice'=> $invoice]);
    }

    public function add()
    {
        return view('add');
    }

    public function create(Request $request)
    {

        $this->validate($request, [
            'inv_name'      =>   'required',
            'sub_total'     =>   'required',
            'tax'           =>   'required',
            'tax_total'     =>   'required',

        ]);
	
		$arr = $request->get('name');

		$count = count($arr);

    	$invoice = new Invoice;

    	$invoice->inv_name  = $request->get('inv_name');
    	$invoice->inv_item  = $count;
        $invoice->sub_total = $request->get('sub_total');
        $invoice->tax       = $request->get('tax');
    	$invoice->total 	= $request->get('tax_total');

    	$invoice->save();

    	$item = new Item;

        $item = array();

    	for( $i = 0; $i < count($arr); $i++) {

    		$item[$i]['item_name']   = $request->get('name')[$i];
    		$item[$i]['no_item']     = $request->get('item')[$i];
    		$item[$i]['price']       = $request->get('price')[$i];
    		$item[$i]['invoice_id']  = $invoice->id;    
    	}

    	Item::insert($item);

    	 return redirect('/');
    	
    }

    public function edit($id)
    {
        $invoice = Invoice::where('id',$id)->get();

        $item   = Item::where('invoice_id', $id)->get();

        return view('edit', ['invoice' => $invoice, 'item' => $item]);
    }

    public function update(Request $request, $id)
    {

        // $data_id = $request->get('invoice_id');

        $invoice  = Invoice::find($id);

        // dd($inv_id);

        $arr = $request->get('name');

        $count = count($arr);

        $invoice->inv_name  = $request->get('inv_name');
        $invoice->inv_item  = $count;
        $invoice->sub_total = $request->get('sub_total');
        $invoice->tax       = $request->get('tax');
        $invoice->total     = $request->get('tax_total');

        $invoice->save();

        $item = new Item;

        $id = $invoice->id;

        Item::where('invoice_id', $id)->delete();

        $item = array();

        for( $i = 0; $i < count($arr); $i++) {

            $item[$i]['item_name']   = $request->get('name')[$i];
            $item[$i]['no_item']     = $request->get('item')[$i];
            $item[$i]['price']       = $request->get('price')[$i];
            $item[$i]['invoice_id']  = $id;    
        }

        Item::insert($item);

         return redirect('/');

    }

    public function remove($id)
    {
        Item::where('invoice_id', $id)->delete();

        Invoice::where('id', $id)->delete();

        return back();
    }

    public function search(Request $request)
    {
        $search = $request->get('inv_search');

        $result = Invoice::where('inv_name', 'LIKE', '%'.$search.'%')->get();

        return view('search', compact('result'));
   
    }

    public function delsearch($id)
    {
        Item::where('invoice_id', $id)->delete();

        Invoice::where('id', $id)->delete();

        return redirect('/');
    }

    public function pdfview($id)
    {
        $invoice = Invoice::find($id);

        view()->share('invoice', $invoice);

        $pdf = PDF::loadView('pdfview');
        return $pdf->download('pdfview.pdf');       
    }
}       
