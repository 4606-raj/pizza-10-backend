<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all([
            'name', 'email', 'phone_number'
        ])->map(function ($user) {
            $user->phone_number = "0" . (string) $user->phone_number;
            return $user;
        });;
    }

    public function headings(): array {
        return [
            'Name',
            'Email',
            'Phone Number'
        ];
    }
}
