<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Category;
use Illuminate\Http\Request;

class BidController extends Controller
{

    public function category()
    {
        $categories = Category::all();
        return view('submitbid', compact('categories'));
    }

    public function index()
    {
        $bids = Bid::with('category')->get();
        return view('bid', compact('bids'));
    }

    public function store(Request $request)
    {
        //dd($request->all());

        $validated = $request->validate([
            'tender_title' => 'required|string',
            'buyer_name' => 'required|string',
            'tender_id' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'quantity' => 'required|integer|min:0',
            'unit_price' => 'required|integer|min:0',
            //'amount' => 'required|integer|min:0',
            'delivery_location' => 'nullable|string',
            'delivery_date' => 'nullable|string',
            'note' => 'nullable|string',
            'document' => 'nullable|array',
            'document.*' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg',
            // 'status' => 'nullable|in:Under Review,Accepted,Rejected',
        ]);


        $validated['amount'] = $validated['quantity'] * $validated['unit_price'];

        $documentPaths = [];
        if ($request->hasFile('document')) {
            foreach ($request->file('document') as $file) {
                $path = $file->store('documents', 'public');
                $documentPaths[] = $path;
            }
        }

        $validated['document'] = $documentPaths;

        $bid = Bid::create($validated);

        return response()->json([
            'message' => 'Bid created successfully',
            'data' => $bid
        ], 201);
    }
}
