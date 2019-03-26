<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
//       dd($this->resource);
        $attendances=[];
        foreach($this->resource as $attendance)
        {
//            dd($attendance->session->name);
            $items =  [

                'session_name' => $attendance->session->name,
                'geym_name' => $attendance->session->gym->name,
                'attendance_date' => $attendance->attendance_date,
                'attendance_time' => $attendance->attendance_time,

            ];

            $attendances[] = $items;
        }
        $data['data'] =$attendances;
        $data['status'] = 200;

        return $data;
    }
}
