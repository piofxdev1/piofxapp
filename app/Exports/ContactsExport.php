<?php

namespace App\Exports;

use App\Models\Core\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;

class ContactsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $client_id = request()->get('client.id');
        $contacts = Contact::select(['id','name','email','phone','message','comment','created_at','updated_at'])->where('client_id',$client_id)->get();
        return $contacts;
    }
}
