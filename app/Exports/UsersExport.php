<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
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
        )->with('regino');
        if (!empty($this->request->phone)){
            $query->where('mobile_number' , $this->request->phone);
        }

        if (!empty($this->request->custmer)){
            $query->where('first_name' , $this->request->custmer);
        }

        if (!empty($this->request->payment_status)){
            $query->where('status' , $this->request->payment_status);
        }
        $query = $query->where('type' , '2')->get();
        $data= [];
        foreach ($query as $key => $value){
            $data[$key]['id'] = $value->id;
            $data[$key]['custm_name'] = $value->first_name . " " . $value->last_name ?? "";
            $data[$key]['custm_mobile'] = $value->mobile_number ?? "لا يوجد رقم هاتف";
            $data[$key]['location'] = $value->regino->title_ar ?? "";
            $data[$key]['status'] = $value->status ?? "لا يوجد حالة";
        }
        array_unshift($data ,[
            'id'=> '#',
            'custm_name'=> 'الأسم',
            'custm_mobile'=> 'رقم الجوال',
            'location' => 'العنوان',
            'status' => 'الحالة',
        ]);
        $data = collect($data);
        return $data;
    }
}
