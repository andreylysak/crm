<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Leads extends Model
{
    protected $fillable = [
        'name', 'status', 'budget',
    ];

    public function contacts()
    {
        return $this->belongsTo('App\Contacts');
    }

    public static function getLead($id) {
        $lead = DB::table('leads')->where('id', '=', $id)->first();
        if (isset($lead->id)) {
            return $lead;
        } else {
            return false;
        }
    }

    public static function getLeadsByContactId($id) {
        $contact_leads = array();
        $leads = DB::table('leads')->orderBy('created_at', 'desc')->get();
        $index = 0;
        foreach ($leads as $item) {
            if (isset($item->contacts)) {
                $contacts = json_decode($item->contacts);
                if(in_array($id, $contacts)) {
                    $contact_leads[$index]['id'] = $item->id;
                    $contact_leads[$index]['crm_id'] = $item->crm_id;
                    $contact_leads[$index]['name'] = $item->name;
                    $index++;
                }
            }
        }
        return $contact_leads;
    }

    public static function createLead($data) {
        $found_lead = DB::table('leads')->where('crm_id', '=', $data['crm_id'])->exists();
        if (!$found_lead) {
            switch ($data['status']) {
                case '28810621':
                    $status_name = 'Первичный контакт';
                    break;
                case '28810624':
                    $status_name = 'Переговоры';
                    break;
                case '28810627':
                    $status_name = 'Принимают решение';
                    break;
                case '28810630':
                    $status_name = 'Согласование договора';
                    break; 
                case '142':
                    $status_name = 'Успешно реализовано';
                    break; 
                case '143':
                    $status_name = 'Закрыто и не реализовано';
                    break;
                default:
                    $status_name = 'Первичный контакт';
            }

            $lead_id = DB::table('leads')->insertGetId(
                [
                    'crm_id' => $data['crm_id'],
                    'name' => $data['name'],
                    'status' => $data['status'],
                    'status_name' => $status_name,
                    'budget' => $data['budget'],
                    'contact_id' => NULL,
                    'main_contact' => $data['main_contact'],
                    'contacts' => $data['contacts'],
                    'created_at' => $data['created_at'],
                    'updated_at' => $data['updated_at']
                ]
            );
    
            return $lead_id;
        } else {
            return false;
        }
    }

    public static function updateLead($data) {
        $found_lead = DB::table('leads')->where('crm_id', '=', $data['crm_id'])->exists();
        if ($found_lead) {
            switch ($data['status']) {
                case '28810621':
                    $status_name = 'Первичный контакт';
                    break;
                case '28810624':
                    $status_name = 'Переговоры';
                    break;
                case '28810627':
                    $status_name = 'Принимают решение';
                    break;
                case '28810630':
                    $status_name = 'Согласование договора';
                    break; 
                case '142':
                    $status_name = 'Успешно реализовано';
                    break; 
                case '143':
                    $status_name = 'Закрыто и не реализовано';
                    break;
                default:
                    $status_name = 'Первичный контакт';
            }
            $updated_item = DB::table('leads')->where('crm_id', $data['crm_id'])->update([
                'name' => $data['name'],
                'status' => $data['status'],
                'status_name' => $status_name,
                'budget' => $data['budget'],
                'contact_id' => NULL,
                'updated_at' => $data['updated_at']
            ]);

            return $updated_item;
        } else {
            return false;
        }
    }

    public static function deleteLead($data) {
        $found_lead = DB::table('leads')->where('crm_id', '=', $data['crm_id'])->exists();
        if ($found_lead) {
            $deleted_item = DB::table('leads')->where('crm_id', '=', $data['crm_id'])->delete();
            return $deleted_item;
        } else {
            return false;
        }
    }
}
