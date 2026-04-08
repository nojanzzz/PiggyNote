<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Outcome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Sum total income and expense
        $totalIncome = Income::where('user_id', $user->id)->sum('amount');
        $totalExpense = Outcome::where('user_id', $user->id)->sum('amount');
        $totalBalance = $totalIncome - $totalExpense;

        // Recent Transactions
        $incomes = Income::where('user_id', $user->id)->orderBy('date', 'desc')->take(5)->get()->map(function($item) {
            $item->type_label = 'income';
            return $item;
        });
        
        $outcomes = Outcome::where('user_id', $user->id)->orderBy('date', 'desc')->take(5)->get()->map(function($item) {
            $item->type_label = 'outcome';
            return $item;
        });

        $recentTransactions = $incomes->concat($outcomes)->sortByDesc('date')->take(10);

        $stats = [
            'total_balance' => $totalBalance,
            'total_income' => $totalIncome,
            'total_expense' => $totalExpense,
        ];

        return view('dashboard', compact('stats', 'recentTransactions'));
    }

    public function analytics()
    {
        $user = Auth::user();

        // Data for Category Pie Chart (Expenses)
        $categoryData = Outcome::where('user_id', $user->id)
            ->select('type', DB::raw('sum(amount) as total'))
            ->groupBy('type')
            ->get();

        // Data for Monthly Trends (Last 6 Months)
        // For simplicity in this demo, we'll group by month name
        $monthlyIncome = Income::where('user_id', $user->id)
            ->select(DB::raw("strftime('%m', date) as month"), DB::raw('sum(amount) as total'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $monthlyExpense = Outcome::where('user_id', $user->id)
            ->select(DB::raw("strftime('%m', date) as month"), DB::raw('sum(amount) as total'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('analytics', compact('categoryData', 'monthlyIncome', 'monthlyExpense'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_label' => 'required|in:income,outcome',
            'amount' => 'required|numeric|min:1',
            'description' => 'required|string|max:255',
            'category' => 'required|string',
            'date' => 'required|date',
        ]);

        $data = [
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'description' => $request->description,
            'type' => $request->category, // Using 'type' column for category name
            'date' => $request->date,
        ];

        if ($request->type_label === 'income') {
            Income::create($data);
        } else {
            Outcome::create($data);
        }

        return redirect()->back()->with('success', 'Transaction added successfully!');
    }
}
