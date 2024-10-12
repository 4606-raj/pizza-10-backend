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
        return User::with('addresses')->get()->map(function ($user) {
            // Format phone number
            $user->phone_number = "0" . (string) $user->phone_number;

            // Collect addresses into a single string
            $user->addresses = $user->addresses->implode(function ($address) {
                return "$address->house_no, $address->street_landmark, $address->sector_village, $address->city, $address->state, $address->details";
            }, ', ');

            return [
                $user->name,
                $user->email,
                $user->phone_number,
                $user->addresses,
            ];
        });

    }

    public function headings(): array {
        return [
            'Name',
            'Email',
            'Phone Number',
            'Addresses'
        ];
    }
}
