<?php

namespace App\Http\Controllers;

use App\Models\date_select;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\View\View;

class clientController extends Controller
{
    public function index()
    {
        return view('clients');
    }

    public function addSlot(Request $req)
    {
        $date = $req->input('date');
        $remaining = $req->input('slots');

        if (DB::table('date_selects')->where('date', '=', $date)->exists()) {
            DB::table('date_selects')
                ->where('date', '=', $date)
                ->update(['remaining' => $remaining]);

            return redirect()->back()->with('message', "Updated slot on $date to $remaining.");
        } else {
            $data = array('date' => $date, 'remaining' => $remaining, 'slots' => $remaining, 'created_at' => Carbon::now());
            DB::table('date_selects')->insert($data);
            return redirect()->back()->with('message', "Creating slot successfully.");

        }

    }

    public function appointmentChecker()
    {
        return view('checkAppointment');
    }

    public function searchAppointment(Request $req)
    {
        $date = $req->input('date');
        $control_id = $req->input('control_id');
        if (DB::table('clients')
            ->where('control_id', '=', $control_id)
            ->where('date', '=', $date)
            ->exists()) {
            $fullname = "";
            
            $queingNumber = 0;

            $data = DB::table('clients')
            ->where('control_id', '=', $control_id)
            ->where('date', '=', $date)
            ->get();
            foreach ($data as $item) {
                $fullname = $item->fullname;
                $date = $item->date;
                $control_id = $item->control_id;
                $queingNumber = $item->queingNumber;
            }

            return redirect()->back()->with("message", "
    Control ID : $control_id <br>
    Full Name : $fullname <br>
    Appointment Date : $date <br>
    Unique Appointment Number : $queingNumber <br>

    ");
        } else {
            return redirect()->back()->with("message", "No Appointment found with the given data.");
        }

    }

    public function appointments()
    {
        $appointment = DB::table('clients')
            ->orderBy('date')
            ->get();

        return view('appointments')->with('appointment', $appointment);
    }

    public function home()
    {
        return view('home');
    }

    public function showdate()
    {
        $date_select = date_select::get(['remaining as title', 'date as start', 'remaining']);
        return json_encode($date_select);

    }

    public function delete($id)
    {
        $temp = DB::table('clients')->where('id', '=', $id)->get('date');

        $date = "";
        foreach ($temp as $exactdate) {
            $date = $exactdate->date;
        }

        $temp2 = DB::table('date_selects')->where('date', '=', $date)->get();

        $remaining = 0;
        foreach ($temp2 as $item) {
            $remaining = $item->remaining;
        }
        $updateSlot = $remaining + 1;

        DB::table('clients')->where('id', '=', $id)->delete();
        DB::table('date_selects')
            ->where('date', '=', $date)
            ->update(['remaining' => $updateSlot]);

        return redirect()->back()->with('message', "Appointment Deleted.");
    }

    public function addAppointment(Request $req)
    {

        $date = $req->input('date');
        $control_id = $req->input('control_id');
        $fullname = $req->input('fullname');
        $queingNumber = random_int(100000, 999999);
        $req->validate([
            'fullname' => 'required',
            'control_id' => 'required',
            'queingNumber' => 'required|unique:clients',
        ]);

        $slots = DB::table('date_selects')->select('remaining')
            ->where('date', '=', $date)
            ->get();

        $remaining = 0;

        foreach ($slots as $slot) {
            $remaining = $slot->remaining;
        }

        if (
            DB::table('clients')
            ->where('date', '=', $date)
            ->Where('fullname', '=', $fullname)
            ->Where('control_id', '=', $control_id)->exists()

        ) {
            return redirect()->back()->with('message', "Double Data Entry");

        } else {

            if ($remaining !== 0) {

                $remaining = $remaining - 1;

                $data = array('date' => $date, 'control_id' => $control_id, 'fullname' => $fullname, 'queingNumber' => $queingNumber, 'created_at'=>carbon::now());
                DB::table('clients')->insert($data);
                $remaining_slots = DB::table('date_selects')
                    ->where('date', '=', $date)
                    ->update(array('remaining' => $remaining));

                return redirect()->back()->with('message', "Your Unique Transaction Number is $queingNumber! <br><br>
        <b>Control ID: $control_id</b> <br><br>
        <b>Fullname: $fullname</b> <br><br>
        <b>Date of Appointment: $date</b> <br><br>

        <i> <b> Note: </b> Please take a note or take a screenshot and present this to the Admission Officer for the Verification of your appointment. </i>");
            } else {
                return redirect()->back()->with('message', "No slots Available on $date. Kindly pick another date or wait for the schedule to be updated. Thank you!");
            }

        }
    }
}
