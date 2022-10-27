<?php

namespace App\Exports;

use App\Models\PackageOrder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class PackageOrderExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    protected $request;
    public function __construct($request)
    {
        $this->request = $request;
    }
    public function collection()
    {
        $query = PackageOrder::orderBy('id', 'desc')->with('Workers.Categories' , 'Packages');

        if (!empty($this->request->worker)){
            // $query->where('status' , $custmer);
            $worker_name = $this->request->worker;
            $query->whereHas('workers', function ($query) use($worker_name) {
                $query->where('first_name' , '=' , $worker_name);
            });
        }
        if (!empty($this->request->package)){
            $package = $this->request->package;
            $query->whereHas('Packages', function ($query) use($package) {
                $query->where('title_ar' , '=' , $package);
            });
        }
        if (!empty($this->request->phone)){
                $phone_cusm = $this->request->phone;
                $query->whereHas('workers', function ($query) use($phone_cusm) {
                $query->where('mobile_number' , '=' , $phone_cusm);
            });
        }
        if (!empty($this->request->cat_id)){
            $cat_id = $this->request->cat_id;
            $query->whereHas('workers', function ($query) use($cat_id) {
            $query->where('cat_id' , '=' , $cat_id);
        });
        }
        $query = $query->get();
        $data= [];
        foreach ($query as $key => $value){
            $data[$key]['id'] = $value->id;
            $data[$key]['pac_name'] = $value->Packages->title_ar;
            $data[$key]['worker_name'] = $value->workers->first_name . " " . $value->workers->last_name ?? "";
            $data[$key]['worker_mobile'] = $value->workers->mobile_number ?? "لا يوجد رقم هاتف";
            $data[$key]['worker_cat'] = $value->workers->categories->title_ar ?? "";
            if($value->status == '1'){
                $data[$key]['payment_status'] = "تم الدفع";
            }else{
                $data[$key]['payment_status'] = "غير مدفوع";
            }
            if($value->status == '1'){
                $data[$key]['status'] = "فعال";
            }else{
                $data[$key]['status'] = "غير فعال";
            }
        }
        array_unshift($data ,[
            'id'=> 'رقم الطلب',
            'pac_name'=> 'أسم الباقة',
            'worker_name'=> 'إسم العامل كامل',
            'worker_mobile' => 'رقم جوال العامل',
            'worker_cat' => 'فئة العامل',
            'payment_status' => 'حالة الدفع',
            'status' => 'الحالة',
        ]);
        $data = collect($data);
        return $data;
    }
}