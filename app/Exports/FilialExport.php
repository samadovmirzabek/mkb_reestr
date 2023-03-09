<?php

namespace App\Exports;

use App\Models\Filial;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FilialExport implements FromCollection, WithHeadings
{

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function headings():array{
        return [
            'Texnika',
            'Filial',
            'Departament',
            "Bo'lim",
            "F.I.Sh",
            "Invertar nomeri",
            "Model",
            "Prosessor",
            "Operativ_xotira",
            "Sistema_Turi",
            "Printer_Nomi",
            "Chiqarigan_Yili",
            "Storage",
            "Printer_Turi",
            "Monitor_Nomi",
            "Monitor_O'lchami",
            "Ip manzili",
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect($this->data);
    }
}
