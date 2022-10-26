<?php

namespace App\Http\Controllers;

use App\Models\PackageOrder;
use App\Models\Packages;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $events=Packages::count();
        $orders_count=PackageOrder::count();

        $date=[];
        $products=[];
        $orders=[];
        for ($i = 0; $i < 7; $i++){
            $range = \Carbon\Carbon::now()->subDays($i)->format('20y-m-d');
            $product=Packages::whereDate('created_at', $range)->get();
            $order=PackageOrder::whereDate('created_at', $range)->orderBy('id', 'DESC')->get();
            $date[]=$range;
            $products[]=$product->count();
            $orders[]=$order->count();
        }
        return view('index',compact('events','orders_count','date','products','orders'));
    }
}
