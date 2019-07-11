<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contacts extends Model {

    public function leads() {
        return $this->hasMany('App\Leads');
    }

    public static function getContact($id) {
        $contact = DB::table('contacts')->where('id', '=', $id)->first();
        if (isset($contact->id)) {
            return $contact;
        } else {
            return false;
        }
    }

    public static function getContactByCrmId($id) {
        $contact = DB::table('contacts')->where('crm_id', '=', $id)->first();
        if (isset($contact->id)) {
            return $contact;
        } else {
            return false;
        }
    }

    public static function createContact($data) {
        $found_contact = DB::table('contacts')->where('crm_id', '=', $data['crm_id'])->exists();
        if (!$found_contact) {
            $contact_id = DB::table('contacts')->insertGetId(
                [
                    'crm_id' => $data['crm_id'],
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'address' => $data['address'],
                    'position' => $data['position'],
                    'leads' => $data['leads'],
                    'company_id' => $data['company_id'],
                    'company_name' => $data['company_name'],
                    'created_at' => $data['created_at'],
                    'updated_at' => $data['updated_at']
                ]
            );
    
            return $contact_id;
        } else {
            return false;
        }
    }

    public static function updateContact($data) {
        $found_contact = DB::table('contacts')->where('crm_id', '=', $data['crm_id'])->exists();
        if ($found_contact) {
            $updated_item = DB::table('contacts')->where('crm_id', $data['crm_id'])->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'position' => $data['position'],
                'updated_at' => $data['updated_at']
            ]);

            return $updated_item;
        } else {
            return false;
        }
    }

    public static function deleteContact($data) {
        $found_contact = DB::table('contacts')->where('crm_id', '=', $data['crm_id'])->exists();
        if ($found_contact) {
            $deleted_item = DB::table('contacts')->where('crm_id', '=', $data['crm_id'])->delete();
            return $deleted_item;
        } else {
            return false;
        }
    }
}
