<?php

namespace App\Exports;

use App\Models\Orders;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrdersExport implements FromCollection
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
        $query = Orders::orderBy('id', 'desc')->with('Custmers' , 'Workers.Categories');
        if (!empty($this->request->custmer)){
            // $query->where('status' , $custmer);
            $cus_name = $this->request->custmer;
            $query->whereHas('custmers', function ($query) use($cus_name) {
                $query->where('first_name' , '=' , $cus_name);
            });
        }
        if (!empty($this->request->worker)){
            $worker_name = $this->request->worker;
            $query->whereHas('custmers', function ($query) use($worker_name) {
                $query->where('first_name' , '=' , $worker_name);
            });
        }
       if (!empty($this->request->phone)){
            $phone_cusm = $this->request->phone;
            $query->whereHas('custmers', function ($query) use($phone_cusm) {
            $query->where('mobile_number' , '=' , $phone_cusm);
        });
        }
        $query = $query->get();
        $data= [];
        foreach ($query as $key => $value){
            $data[$key]['id'] = $value->id;
            $data[$key]['custm_name'] = $value->custmers->first_name . " " . $value->custmers->last_name ?? "";
            $data[$key]['custm_mobile'] = $value->custmers->mobile_number ?? "لا يوجد رقم هاتف";
            $data[$key]['worker_name'] = $value->workers->first_name . " " . $value->workers->last_name ?? "";
            $data[$key]['worker_mobile'] = $value->workers->mobile_number ?? "لا يوجد رقم هاتف";
            $data[$key]['worker_cat'] = $value->workers->categories->title_ar ?? "";
            $data[$key]['status'] = $value->status ?? "لا يوجد حالة";
        }
        array_unshift($data ,[
            'id'=> 'رقم الطلب',
            'custm_name'=> 'إسم الزبون كامل',
            'custm_mobile'=> 'رقم جوال الزبون',
            'worker_name'=> 'إسم العامل كامل',
            'worker_mobile' => 'رقم جوال العامل',
            'worker_cat' => 'فئة العامل',
            'status' => 'الحالة',
        ]);
        $data = collect($data);
        return $data;
    }
}
