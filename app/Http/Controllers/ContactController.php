<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * List of Customers
     */
    public function index()
    {
        $customers = Contact::all();
        return view('customers', compact('customers'));
    }

    /**
     * Store Customer Detail
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^[0-9\-\(\)\/\+\s]*$/',
            'budget'=>'required|numeric',
            'message' => 'required'
        ]);

        $data = $request->all();
        $data['wp_account'] = 0;

        $result = Contact::create($data);

        if ($result) {
            return back()->with('success', 'Successfully registered');
        } else {
            return back()->with('error', 'Failed register');
        }
    }

    /**
     * View account
     */
    public function view($id)
    {
        $customer = Contact::find($id);
        return view('profile', compact('customer'));
    }

    /**
     * Create WP account
     */
    public function createAccount(Request $request)
    {
        $customerId = $request->id;
        $customer = Contact::find($customerId);

        // Send request to wordpress account create
        $url = 'http://testwp.localhost/wp-content/plugins/mycrmconnector/mycrmconnector.php';
        $fields = [
            'action' => 'create_user',
            'apiKey' => '6cb28f4d-ccce-45bd-95e3-2290845934f9',
            'email'  => $customer->email,
            'name'   => $customer->name,
            'crmId'  => $customerId
        ];
        $fields_string = http_build_query($fields);

        //open connection
        $cURL = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($cURL, CURLOPT_URL, $url);
        curl_setopt($cURL, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($cURL, CURLOPT_HEADER,false);
        curl_setopt($cURL, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($cURL, CURLOPT_POST, true);
        curl_setopt($cURL, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($cURL, CURLOPT_CONNECTTIMEOUT, 10);

        //execute post
        $response = curl_exec($cURL);
        $err = curl_error($cURL);

        //close connection
        curl_close($cURL);

        if ($err) {

            return response()->json([
                'success' => false,
                'message' => 'cURL Error #:' . $err
            ]);

        } else {
            $customer->wp_account = 1;
            $customer->save();

            return response()->json([
                'success' => true
            ]);
        }
    }
}
