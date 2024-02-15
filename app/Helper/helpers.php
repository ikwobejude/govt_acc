<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\HttpException;
// this function returns the service id of a user
function serviceId()
{
	return auth()->user()->service_id ?? auth('sanctum')->user()->service_id;
}

function Role() {
    return auth()->user()->group_id ?? auth('sanctum')->user()->group_id;
}

function permission() {
    return  explode(',', auth()->user()->permissions ?? auth('sanctum')->user()->permissions);
}

// this function returns the service code of a user
function serviceCode()
{
	return  auth()->user()->service_code ?? auth('sanctum')->user()->service_code;
}

function userCode()
{
	return  auth()->user()->user_code ?? auth('sanctum')->user()->user_code;
}

function user()
{
	return auth()->user() ?? auth('sanctum')->user();
}
// this function returns the full name of a user
function username()
{
	return  auth()->user()->username ?? auth('sanctum')->user()->username;
}


// this function returns name
function name()
{
	return  auth()->user()->name ?? auth('sanctum')->user()->name;
}


// this function returns the surname of a user
function inactive()
{
	return  auth()->user()->inactive ?? auth('sanctum')->user()->inactive;
}


// this function returns the first name of a user
function firstName()
{
	return  auth()->user()->firstname ?? auth('sanctum')->user()->firstname;
}

// this function returns the email of a user
function emailaddress()
{
	return  auth()->user()->email ?? auth('sanctum')->user()->email;
}

//this function returns tax office
function taxOffice()
{
	return auth()->user()->tax_office_id ?? auth('sanctum')->user()->tax_office_id;
}

// this function returns the middle name of a user
function middleName()
{
	return  auth()->user()->middlename ?? auth('sanctum')->user()->middlename;
}


// this fuction returns the userid
function userId()
{
	return  auth()->user()->id ?? auth('sanctum')->user()->id;
}


// this function returns the groupid
function groupId()
{
	return auth()->user()->group_id ?? auth('sanctum')->user()->group_id;
}

// returns if the user is to login for the first time
function first_use()
{
	return auth()->user()->first_use ?? auth('sanctum')->user()->first_use;
}


// returns if the user is to login for the first time
function employee_no()
{
	return auth()->user()->user_code ?? auth('sanctum')->user()->user_code;
}


function setPasswordExpiryDate($days){
	$now = Carbon::now();
	return $now->addDays($days);
}

function employeeAcronyms($names) {
    preg_match_all("/\b\w/", $names, $matches); // match the first letter of each word
    $acronym = implode("", $matches[0]); // join the matches into a string
    return $acronym; // output the string of first letters
}

// function sendEmailNotification($data){
// 	try {
// 		if($data['EmailType'] == "WelcomeEmail" ){
// 			Mail::to($data['Email'])->send(new \App\Mail\WelcomeEmail($data));
// 			return 1;
// 		}
// 		if($data['EmailType'] == "StaffWelcomeEmail" ){
// 			Mail::to($data['Email'])->send(new \App\Mail\StaffWelcomeEmail($data));
// 			return 1;
// 		}
// 		if($data['EmailType'] == "login" ){
// 			Mail::to($data['Email'])->send(new \App\Mail\loginNotification($data));
// 			return 1;
// 		}

// 		if($data['EmailType'] == "forgot" ){
// 			Mail::to($data['Email'])->send(new \App\Mail\forgetPasswordEmail($data));
// 			return 1;
// 		}

// 		if($data['EmailType'] == "reset_password" ){
// 			Mail::to($data['Email'])->send(new \App\Mail\ResetPassword($data));
// 			return 1;
// 		}

// 		if($data['EmailType'] == "verify_email_address"){
// 			Mail::to($data['Email'])->send(new \App\Mail\ConfirmEmail($data));
// 			return 1;
// 		}
// 		if($data['EmailType'] == "employee_absent"){
// 			Mail::to($data['Email'])->send(new \App\Mail\EmployeeAbsentEmail($data));
// 			return 1;
// 		}



//         if($data['EmailType'] == "salary_approval_notification"){
//             // dd($data['EmailType'], $data['Email']);
//                 Mail::to($data['Email'])->send(new \App\Mail\PaymentNotificationEmail($data));
//                 return 1;
// 		}

//         // generated email notification to admin board
//         if($data['EmailType'] == "salary_generated_salary_notification_to_admin"){
//             // dd($data['EmailType'], $data['Email']);
//                 Mail::to($data['Email'])->send(new \App\Mail\PaymentGeneratedNotification($data));
//                 return 1;
// 		}

//         // Approval email notification to HR for authorization
//         if($data['EmailType'] == "admin_salary_approval_notification_to_hr"){
//             // dd($data['EmailType'], $data['Email']);
//                 Mail::to($data['Email'])->send(new \App\Mail\PaymentApprovalNotification($data));
//                 return 1;
// 		}
// 	} catch (Exception $th) {
// 		throw $th;
// 		return 0;
// 	}
// }
