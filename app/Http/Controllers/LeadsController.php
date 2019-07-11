<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Leads;
use App\Contacts;
use Exception;

class LeadsController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $leads = Leads::orderBy('created_at', 'desc')->get();
        return view('leads', compact('leads'));
    }

    public function viewLead(Request $request) {
        $lead = Leads::getLead($request->id);
        $lead != false ? $item_exists = true : $item_exists = false;
        $main_contact = Contacts::getContactByCrmId($lead->main_contact);
        $contacts = array();
        if (isset($lead->contacts)) {
            foreach(json_decode($lead->contacts) as $item) {
                $contacts[] = Contacts::getContactByCrmId($item);
            }
        }
        return view('view_lead', compact('lead', 'item_exists', 'main_contact', 'contacts'));
    }

    public function editLead(Request $request) {
        $lead = Leads::getLead($request->id);
        $lead != false ? $item_exists = true : $item_exists = false;
        $main_contact = Contacts::getContactByCrmId($lead->main_contact);
        $contacts = array();
        if (isset($lead->contacts)) {
            foreach(json_decode($lead->contacts) as $item) {
                $contacts[] = Contacts::getContactByCrmId($item);
            }
        }
        return view('edit_lead', compact('lead', 'item_exists', 'main_contact', 'contacts'));
    }
    public function createLead() {
        $contacts = Contacts::orderBy('created_at', 'desc')->get();
        return view('create_lead', compact('contacts'));
    }

    public function deleteLead(Request $request) {
        $data = $request->validate([
            'crm_id'    => 'required|string',
        ]);

        $deleted_item = Leads::deleteLead($data);
        return redirect()->to('admin/leads')->with('message', 'Lead deleted!');
    }

    public function updateLead(Request $request) {
        $data = $request->validate([
            'id'        => 'required|string',
            'crm_id'    => 'required|string',
            'name'      => 'required|string',
            'status'    => 'string',
            'budget'    => 'string',
        ]);

        $data['updated_at'] = date('Y-m-d H:i:s');
        $now = time();

        $updated_item = Leads::updateLead($data);

        $leads['update'] = array(
            array(
                'id' => $data['crm_id'],
                'name' => $data['name'],
                'status_id' => $data['status'],
                'sale' => $data['budget'],
                'updated_at' => $now,
            ),
        );

        $leads_ids = AmoCrmController::createLead($leads);
        return redirect()->to('admin/leads/view/'.$data['id'])->with('message', 'Lead updated!');
    }

    public function import() {
        $leads = AmoCrmController::getAllLeads();
        
        $inserted_rows_count = 0;

        foreach($leads as $lead_item) {
            $lead = array();
            $lead['crm_id'] = NULL;
            $lead['name'] = NULL;
            $lead['status'] = NULL;
            $lead['budget'] = NULL;
            $lead['main_contact'] = NULL;
            $lead['contacts'] = NULL;
            $lead['created_at'] = NULL;
            $lead['updated_at'] = NULL;

            $lead['name'] = $lead_item['name'];
            $lead['crm_id'] = $lead_item['id'];
            $lead['budget'] = $lead_item['sale'];
            $lead['status'] = $lead_item['status_id'];

            $lead['created_at'] = date('Y-m-d H:i:s', $lead_item['created_at']);
            $lead['updated_at'] = date('Y-m-d H:i:s', $lead_item['updated_at']);

            if (isset($lead_item['main_contact']['id'])) {
                $lead['main_contact'] = $lead_item['main_contact']['id'];
            }

            if (isset($lead_item['contacts']['id'])) {
                $lead['contacts'] = json_encode($lead_item['contacts']['id']);
            }

            $lead_id = Leads::createLead($lead);
            if ($lead_id != false) {
                echo '<pre>';
                print_r('Database insertion success!');
                print_r('Insert ID: '.$lead_id);
                echo '</pre>';
                $inserted_rows_count++;
            } else {
                echo '<pre>';
                print_r('Database insertion filed, lead already exist!');
                echo '</pre>';
            }
        }

        if ($inserted_rows_count != 0) {
            return redirect()->back()->with('message', 'Database updated! '.$inserted_rows_count.' leads saved.');
        } else {
            return redirect()->back()->with('message', 'New leads not found!');
        }        
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name'      => 'required|string',
            'status'    => 'string',
            'budget'    => 'string',
            'contact'   => 'string',
        ]);

        $data['created_at'] = date('Y-m-d H:i:s');
        $now = time();

        //Lead statuses ids
        //первичный контакт - 28810621
        //переговоры - 28810624
        //принимают решение - 28810627
        //согласование договора - 28810630
        //успешно реализовано - 142
        //закрыто и не реализовано - 143

        $leads['add'] = array(
            array(
                'name' => $data['name'],
                'created_at' => $now,
                'status_id' => $data['status'],
                'sale' => $data['budget'],
                'responsible_user_id' => 3623926,
            ),
        );

        $lead_id = AmoCrmController::createLead($leads);

        $contact_leads = AmoCrmController::getContactLeads($data['contact']);
        $contact_leads[] = $lead_id[0];

        $contacts['update'] = array(
            array(
                'id' => $data['contact'],
                'updated_at' => $now,
                'linked_leads_id' => $contact_leads,
            ),
        );

        $updated_contact_id = AmoCrmController::createContact($contacts);

        //api/v2/contacts?id=16191471
        
        $this->import();
        return redirect()->to('admin/leads')->with('message', 'Database updated!');
    }
}
