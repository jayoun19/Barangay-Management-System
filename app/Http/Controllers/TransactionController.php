<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $transactions = Transaction::when($search, function ($query, $search) {
            return $query->where('description', 'like', "%{$search}%")
                ->orWhere('type', 'like', "%{$search}%");
        })->orderBy('transaction_date', 'desc')->paginate(12)->withQueryString();

        return view('transactions.index', compact('transactions', 'search'));
    }

    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        // Inayos ang validation para tanggapin ang iyong bagong Barangay Categories
        $data = $request->validate([
            'type' => 'required|string|max:255', 
            'description' => 'required|string|max:500',
            'amount' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
        ]);

        Transaction::create($data);

        return redirect()->route('transactions.index')->with('success', 'Transaction recorded successfully.');
    }

    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        // DITO ANG ERROR DATI: In-update natin para maging pareho sa store method
        $data = $request->validate([
            'type' => 'required|string|max:255', 
            'description' => 'required|string|max:500',
            'amount' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
        ]);

        $transaction->update($data);

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}