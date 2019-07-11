<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Contacts;
use App\Leads;
use App\User;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $count_contacts = Contacts::count();
        $count_leads = Leads::count();
        $count_users = User::count();
        return view('admin', compact('count_contacts', 'count_leads', 'count_users'));
    }

    public function getAccountCRM() {
        $account = AmoCrmController::getAccount();
        if (isset($account['auth'])) {
            $auth_status['status'] = true;
            $auth_status['message'] = 'Авторизация прошла успешно';
        } else {
            $auth_status['status'] = false;
            $auth_status['message'] = 'Авторизация не удалась';
        }
        return view('account_crm', compact('account', 'auth_status'));
    }
}
