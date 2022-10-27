<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class WorkersExport implements FromCollection
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
        $query = User::select(
            'id' , 'first_name' , 'last_name' , 'mobile_number'  , 'status' , 'regino_id'
        )->with(['regino' , 'Categories']);
        if (!empty($this->request->phone)){
            $query->where('mobile_number' , $this->request->phone);
        }

        if (!empty($this->request->worker)){
            $query->where('first_name' , $this->request->worker);
        }

        if (!empty($this->request->payment_status)){
            $query->where('status' , $this->request->payment_status);
        }

        if (!empty($this->request->cat_id)){
            $query->where('cat_id' , $this->request->cat_id);
        }
        $query = $query->where('type' , '3')->get();
        $data= [];
        foreach ($query as $key => $value){
            $data[$key]['id'] = $value->id;
            $data[$key]['worker_name'] = $value->first_name . " " . $value->last_name ?? "";
            $data[$key]['worker_mobile'] = $value->mobile_number ?? "لا يوجد رقم هاتف";
            $data[$key]['location'] = $value->regino->title_ar ?? "";
            $data[$key]['cat'] = $value->categories->title_ar ?? "";
            $data[$key]['status'] = $value->status ?? "لا يوجد حالة";
        }
        array_unshift($data ,[
            'id'=> '#',
            'worker_name'=> 'الأسم',
            'worker_mobile'=> 'رقم الجوال',
            'location' => 'العنوان',
            'cat' => 'الفئة',
            'status' => 'الحالة',
        ]);
        $data = collect($data);
        return $data;
    }
}
