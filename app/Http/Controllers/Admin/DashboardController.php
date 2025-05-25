<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function todays()
    {
        $today = Carbon::today(); // আজকের তারিখের শুরু
        $endOfToday = Carbon::today()->endOfDay(); // আজকের শেষ সময়

        $orders = Order::whereBetween('created_at', [$today, $endOfToday])
            ->orderBy('created_at', 'desc')
            ->get();

        $totalAmount = $orders->sum('total_price');

        return view('admin.layouts.pages.daywise-data-filter.today', compact('orders', 'totalAmount'));
    }

    public function sevenday()
    {
        $now = Carbon::now();

        $startDate = $now->copy()->startOfMonth()->startOfDay();
        $endDate = $now->copy()->startOfMonth()->addDays(6)->endOfDay(); // ১ থেকে ৭ তারিখ (০ থেকে ৬ দিন যোগ)

        $orders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->get();

        // $ordersByDate = $orders
        //     ->groupBy(function ($order) {
        //         return $order->created_at->format('d M Y');
        //     })
        //     ->map(function ($dateOrders, $date) {
        //         return [
        //             'date' => $date,
        //             'orders' => $dateOrders,
        //         ];
        //     })
        //     ->values();
        return view('admin.layouts.pages.daywise-data-filter.sevenday', compact('orders'));
    }

    public function fiftinday()
    {
        $now = Carbon::now();

        // চলতি মাসের প্রথম দিন
        $startDate = $now->copy()->startOfMonth()->startOfDay();

        // চলতি মাসের ১৫ তারিখের শেষ সময় (১৫ তারিখ 23:59:59)
        $endDate = $now->copy()->startOfMonth()->addDays(14)->endOfDay();

        // এই রেঞ্জের মধ্যে অর্ডারগুলো নাও
        $orders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->get();

        // প্রয়োজন হলে গ্রুপিং (দিন বা মাস অনুযায়ী)
        // $ordersByDate = $orders
        //     ->groupBy(function ($order) {
        //         return $order->created_at->format('d M Y');
        //     })
        //     ->map(function ($dateOrders, $date) {
        //         return [
        //             'date' => $date,
        //             'orders' => $dateOrders,
        //         ];
        //     })
        //     ->values();

        return view('admin.layouts.pages.daywise-data-filter.fifteenday', compact('orders'));
    }

    public function thirtyday()
    {
        $ordersByMonth = Order::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month')
            ->groupBy('year', 'month')
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->get()
            ->map(function ($group) {
                $monthName = Carbon::createFromDate($group->year, $group->month, 1)->format('F Y');

                $orders = Order::whereYear('created_at', $group->year)->whereMonth('created_at', $group->month)->get();

                return [
                    'month' => $monthName,
                    'orders' => $orders,
                ];
            });

        return view('admin.layouts.pages.daywise-data-filter.thirtyday', compact('ordersByMonth'));
    }

    // public function currentMonthOrders()
    // {
    //     $currentMonth = Carbon::now()->month;
    //     $currentYear = Carbon::now()->year;

    //     $orders = Order::whereMonth('created_at', $currentMonth)
    //                 ->whereYear('created_at', $currentYear)
    //                 ->latest()
    //                 ->get();

    //     return view('admin.orders.current_month', compact('orders'));
    // }
}
