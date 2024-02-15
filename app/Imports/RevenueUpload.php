<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\Revenue\RevenueLine;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\ToModel;

class RevenueUpload implements ToModel, SkipsEmptyRows, WithHeadingRow, WithStrictNullComparison
{
    /**
    * @param Collection $collection
    */

    public function model(array $row)
    {
        // dd($row);


        if(!array_filter($row)) {
            return null;
         }

        return new RevenueLine([
            'economic_code' => $row['economic_code'],
            'description' => $row['description'],
            'type' => $row['code'],
        ]);
    }

    // public function collection(Collection $rows)
    // {
    //     $arr = [];
    //     foreach ($rows as $row) {
    //         $arr[] = [
    //                 'economic_code' => $row[0],
    //                 'description' => $row[1],
    //                 'type' => $row[2],
    //         ];
    //     dd($row);
    //     }
    //     return  $arr;
    // }
}
