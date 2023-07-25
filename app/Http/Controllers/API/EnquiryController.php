<?php

namespace App\Http\Controllers\API;

use App\Models\Enquiry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EnquiryController extends Controller
{
    public function index()
    {
        return Enquiry::all();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191|min:3',
            'email' => 'required|string|email|max:191',
            'mobile_number' => 'required|string|min:10',
            'message' => 'required|string|min:10',
        ]);

        return Enquiry::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'mobile_number' => $request['mobile_number'],
            'message' => $request['message'],
            'property_id' => $request['property_id'],
            'owner_id' => $request['owner_id'],
        ]);
    }

    public function show($id)
    {

        $owner = Enquiry::where('id', $id)->select('owner_id')->first();
        if ($owner->owner_id == null) {
            $enquiry = Enquiry::where('id', $id)->select('message')->get();
            return $enquiry;
        } else {
            $enquiry = DB::table('enquiries')
                ->join('properties', 'properties.id', '=', 'enquiries.property_id')
                ->join('users', 'users.id', '=', 'enquiries.owner_id')
                ->where('enquiries.id', $id)
                ->select('properties.title', 'users.name as userName', 'users.email as userEmail', 'users.phone as userPhone', 'enquiries.*')
                ->get();

            return $enquiry;
        }

    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $enquiry = Enquiry::findOrFail($id);

        $enquiry->delete();

        return ['message' => 'Enquiry deleted successfully'];
    }

    public function allfrontenquiries($id)
    {
        return Enquiry::where('owner_id', $id)->get();

    }

    public function frontDetailEnquiry($id)
    {
        $enquiry = DB::table('enquiries')
            ->join('properties', 'properties.id', '=', 'enquiries.property_id')
            ->where('enquiries.id', $id)
            ->select('properties.title', 'properties.id', 'enquiries.message')
            ->get();
        return $enquiry;

    }

}
