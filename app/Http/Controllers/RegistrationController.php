<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\User;
use App\Track;

class RegistrationController extends Controller
{
    public function register() {
        return view('auth.register');
    }

    public function create(Request $request) {
        $users_name = Input::get('name');
        $users_email = Input::get('email');
        $users_phone = Input::get('username');
        $password = Input::get('password');
        $re_password = Input::get('re_password');

        /*
         * Checking if user already exists or not
         */
        $checkExistsEmail = User::where('email', Input::get('email'))->exists();
        $checkExistsName = User::where('username', Input::get('username'))->exists();
        if ($checkExistsEmail) {
            return redirect()->back()->withInput()->with('error', 'An user already exists using provided Email Address');
        } else if($checkExistsName) {
        	return redirect()->back()->withInput()->with('error', 'An user already exists using provided Username');
        } else {
            $errors = array();
            /*
             * Checking user name is empty or not
             */

            if (empty($users_name) || $users_name == '') {
                $errors[] = "Full name required";
            }
            /*
             * Check if email address is valid format or not
             */

            if (!filter_var($users_email, FILTER_VALIDATE_EMAIL) === true) {
                $errors[] = "Invalid email address format";
            }

            /*
             * Checking user phone is empty or not
             */
            if (empty($users_phone) || $users_phone == '') {
                $errors[] = "Phone number required. ";
            }

            /*
             * Check password is empty or not
             */
            if (empty($password) || $password == '') {
                $errors[] = "Password required";
            }
            /*
             * Check retype password is empty or not
             */
            if (empty($re_password) || $re_password == '') {
                $errors[] = "Retype your password";
            }


            /*
             * Check if password and confirm password matched or not
             */
            if ($password != $re_password) {
                $errors[] = "Password not matched";
            }

            /*
             * Check password length
             */

            if (strlen($password) > 15) {
                $errors[] = "Password length must be less than 15 character";
            }

            if (count($errors) > 0) {
                return redirect()->back()->withInput()->withErrors($errors)->with('errorArray', 'Array Error Occured');
            } else {

                /*
                 * Store users information into database
                 */
                $randomNumber = new Track;
                $trackId = $randomNumber->randomNumber(5, 10) . "Jahid" . date('YmdHis');
                $obj = new User;
                $obj->name = $request->name;
                $obj->email = $request->email;
                $obj->username = $request->username;
                $obj->password = bcrypt($request->password);
                $obj->created_at = Carbon::now();
                $obj->users_track_id = $trackId;
                $obj->save();
                if($obj->save()) {
                	return redirect()->back()->with('success', 'Congratulation, your registration completed successfully');
                }
            }
        }
    }
}
