<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Leads;
use App\Contacts;
use Exception;

class ContactsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $contacts = Contacts::orderBy('created_at', 'desc')->get();
        return view('contacts', compact('contacts'));
    }

    public function viewContact(Request $request) {
        $contact = Contacts::getContact($request->id);
        $contact_leads = Leads::getLeadsByContactId($contact->crm_id);
        $contact != false ? $item_exists = true : $item_exists = false;
        return view('view_contact', compact('contact', 'item_exists', 'contact_leads'));
    }

    public function editContact(Request $request) {
        $contact = Contacts::getContact($request->id);
        $contact != false ? $item_exists = true : $item_exists = false;
        $leads = Leads::orderBy('created_at', 'desc')->get();
        return view('edit_contact', compact('contact', 'item_exists', 'leads'));
    }
    public function create() {
        $leads = Leads::orderBy('created_at', 'desc')->get();
        return view('create_contact', compact('leads'));
    }

    public function deleteContact(Request $request) {
        $data = $request->validate([
            'crm_id'    => 'required|string',
        ]);

        $deleted_item = Contacts::deleteContact($data);
        return redirect()->to('admin/contacts')->with('message', 'Contact deleted!');
    }

    public function updateContact(Request $request) {
        $data = $request->validate([
            'id'        => 'required|string',
            'crm_id'    => 'required|string',
            'name'      => 'required|string',
            'email'     => 'string',
            'phone'     => 'string',
            'address'   => 'string',
            'position'  => 'string',
        ]);

        if ($request->input('leads_id')) {
            $data['leads_id'] = $request->input('leads_id');
        } else {
            $data['leads_id'] = NULL;
        }

        $data['updated_at'] = date('Y-m-d H:i:s');
        $now = time();

        $updated_item = Contacts::updateContact($data);

        $contacts['update'] = array(
            array(
                'id' => $data['crm_id'],
                'name' => $data['name'],
                'updated_at' => $now,
                'company_id' => NULL,
                'custom_fields' => array(
                    array(
                        'id' => 498029,
                        'name' => "Телефон",
                        'code' => "PHONE",
                        'values' => array(
                            array(
                                'value' => $data['phone'],
                                'enum' => "WORK",
                            ),
                            array(
                                'value' => NULL,
                                'enum' => "WORKDD",
                            ),
                            array(
                                'value' => NULL,
                                'enum' => "MOB",
                            ),
                        ),
                        'is_system' => 1,
                    ),
                    array(
                        'id' => 498031,
                        'name' => 'Email',
                        'code' => 'EMAIL',
                        'values' => array(
                            array(
                                'value' => $data['email'],
                                'enum' => "WORK",
                            ),
                        ),
                        'is_system' => 1,
                    ),
                    array(
                        'id' => 498027,
                        'name' => "Должность",
                        'values' => array(
                            array(
                                'value' => $data['position'],
                            ),
                        ),
                    ),
                    array(
                        'id' => 498201,
                        'name' => "Адрес",
                        'values' => array(
                            array(
                                'value' => $data['address'],
                            ),
                        ),
                    ),
                ),
            ),
        );

        $contacts_ids = AmoCrmController::createContact($contacts);
        return redirect()->to('admin/contacts/view/'.$data['id'])->with('message', 'Contact updated!');
    }

    public function import() {
        $contacts = AmoCrmController::getAllContacts();
        $inserted_rows_count = 0;

        foreach($contacts as $contact_item) {
            $contact = array();
            $contact['crm_id'] = NULL;
            $contact['name'] = NULL;
            $contact['email'] = NULL;
            $contact['phone'] = NULL;
            $contact['address'] = NULL;
            $contact['position'] = NULL;
            $contact['leads'] = NULL;
            $contact['company_id'] = NULL;
            $contact['company_name'] = NULL;
            $contact['created_at'] = NULL;
            $contact['updated_at'] = NULL;

            $contact['name'] = $contact_item['name'];
            $contact['crm_id'] = $contact_item['id'];

            $contact['created_at'] = date('Y-m-d H:i:s', $contact_item['created_at']);
            $contact['updated_at'] = date('Y-m-d H:i:s', $contact_item['updated_at']);

            if (isset($contact_item['leads']['id'])) {
                $contact['leads'] = json_encode($contact_item['leads']['id']);
            }

            if (isset($contact_item['company']['id'])) {
                $contact['company_id'] = $contact_item['company']['id'];
                $contact['company_name'] = $contact_item['company']['name'];
            }

            foreach ($contact_item['custom_fields'] as $field) {
                if ($field['id'] == '498029') {
                    foreach($field['values'] as $value) {
                        if ($value['enum'] == '697347') {
                            $contact['phone'] = $value['value'];
                        }
                    }
                } else if ($field['id'] == '498031') {
                    foreach($field['values'] as $value) {
                        if ($value['enum'] == '697359') {
                            $contact['email'] = $value['value'];
                        }
                    }
                } else if ($field['id'] == '498201') {
                    $contact['address'] = $field['values'][0]['value'];
                } else if ($field['id'] == '498027') {
                    $contact['position'] = $field['values'][0]['value'];
                }
            }

            $contact_id = Contacts::createContact($contact);
            if ($contact_id != false) {
                echo '<pre>';
                print_r('Database insertion success!');
                print_r('Insert ID: '.$contact_id);
                echo '</pre>';
                $inserted_rows_count++;
            } else {
                echo '<pre>';
                print_r('Database insertion filed, contact already exist!');
                echo '</pre>';
            }
        }

        if ($inserted_rows_count != 0) {
            return redirect()->back()->with('message', 'Database updated! '.$inserted_rows_count.' contacts saved.');
        } else {
            return redirect()->back()->with('message', 'New contacts not found!');
        }
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name'      => 'required|string',
            'email'     => 'string',
            'phone'     => 'string',
            'address'   => 'string',
            'position'  => 'string',
        ]);

        if ($request->input('leads_id')) {
            $data['leads_id'] = $request->input('leads_id');
        } else {
            $data['leads_id'] = NULL;
        }

        $now = time();

        $contacts['add'] = array(
            array(
                'name' => $data['name'],
                'responsible_user_id' => 3623926,
                'created_by' => 3623926,
                'created_at' => $now,
                'leads_id' => $data['leads_id'],
                'company_id' => NULL,
                'custom_fields' => array(
                    array(
                        'id' => 498029,
                        'name' => "Телефон",
                        'code' => "PHONE",
                        'values' => array(
                            array(
                                'value' => $data['phone'],
                                'enum' => "WORK",
                            ),
                            array(
                                'value' => NULL,
                                'enum' => "WORKDD",
                            ),
                            array(
                                'value' => NULL,
                                'enum' => "MOB",
                            ),
                        ),
                        'is_system' => 1,
                    ),
                    array(
                        'id' => 498031,
                        'name' => 'Email',
                        'code' => 'EMAIL',
                        'values' => array(
                            array(
                                'value' => $data['email'],
                                'enum' => "WORK",
                            ),
                        ),
                        'is_system' => 1,
                    ),
                    array(
                        'id' => 498027,
                        'name' => "Должность",
                        'values' => array(
                            array(
                                'value' => $data['position'],
                            ),
                        ),
                    ),
                    array(
                        'id' => 498201,
                        'name' => "Адрес",
                        'values' => array(
                            array(
                                'value' => $data['address'],
                            ),
                        ),
                    ),
                ),
            ),
        );

        $contacts_ids = AmoCrmController::createContact($contacts);
        $this->import();
        return redirect()->to('admin/contacts')->with('message', 'Database updated!');
    }
}
