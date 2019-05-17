<?php

namespace App\Exports;

use App\Attendees;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class AttendeesExport implements WithHeadings, WithMapping, FromCollection, WithColumnFormatting
{
    public function headings(): array
    {
        return [
            'ID', 'Name', 'Email', 'Date'
        ];
        // TODO: Implement headings() method.
    }

    /**
     * @var Attendees $attendee
     * @return array
     */
    public function map($attendee): array
    {
        return [
            $attendee->id,
            $attendee->data->name,
            $attendee->data->email,
            Date::dateTimeToExcel($attendee->updated_at)
        ];
        // TODO: Implement map() method.
    }

    public function collection()
    {
        return Attendees::all();
        // TODO: Implement collection() method.
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_DATE_DATETIME
        ];
        // TODO: Implement columnFormats() method.
    }
}
