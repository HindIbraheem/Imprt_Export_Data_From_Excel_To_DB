<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function import(Request $request){
        $file = $request->file('excel_file');
        $ExcelData = Excel::toArray([],$file);
        $counter = 0; //$counter is used to ignore the header row from the excel sheet
        //reads the row one by one form the excel sheet
        foreach ($ExcelData as $row){
            //reads the columns from each row of excel sheet each column's data can be accessed using index starting from 0
            //column1 -> $data[0]; and so on.
            foreach ($row as $data){
                if($counter != 0) {
                    // $user = new User;
                    // $user->first_name = $data[0];
                    // $user->user_name = $data[1];
                    // $user->password = Hash::make($data[3]);
                    // $user->save();

                    $contacts = new Contact;

                    $contacts->order_id = $data[0];
                    $contacts->user = $data[2];
                    $contacts->total = $data[4];
                    $contacts->app_total = $data[3];
                    $contacts->currency = $data[5];

                    $contacts->save();
                }
                else{
                    $counter++;
                }
            }
        }
        return "Success : Your Excel Sheet Data Is Uploaded Successfully In The Database";
    }
}
