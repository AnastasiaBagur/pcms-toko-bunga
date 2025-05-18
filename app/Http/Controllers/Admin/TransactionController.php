<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('details.product')->get();
        return view('admin.transactions.index', compact('transactions'));
    }
}
