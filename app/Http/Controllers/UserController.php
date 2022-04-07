<?php

namespace App\Http\Controllers;

use App\Imports\OrphanImport;
use App\Imports\SponsorImport;
use App\Jobs\sendMessage;
use App\OrphanSponsor;
use App\Post;
use App\Setting;
use App\User;
use App\UserColumnVisibility;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index()
    {

        if(\auth()->user()->role == 'admin'){
            $has_orphans = User::whereHas('orphans')->count();
            $has_sponsors = User::whereHas('sponsors')->count();
            $count_sponsors = User::where('role','sponsor')->count();
            $count_orphans = User::where('role','orphan')->count();

            $users = User::query();
            $users = $users->where(DB::raw('DATEDIFF(sponsor_pay_end,"'.Carbon::today()->format('Y-m-d').'")'),'<=',0);
            $users = $users->with('orphans');
            $users = $users->where('role', 'sponsor')->get();
            return view('home',compact('users','has_orphans','has_sponsors','count_orphans','count_sponsors'));
        }else if(\auth()->user()->role == 'sponsor'){
            $visibility = UserColumnVisibility::first();
            $setting = Setting::first();
            $users = User::query();
            $users = $users->where('id', '=', \auth()->user()->id);
            $users = $users->with('orphans');
            $users = $users->where('role', 'sponsor')->get();
            $posts = Post::wherein('status',[1,2,3])->where((function($query){
                $query->wherenull('sponsor_id')->orwhere('sponsor_id',\auth()->user()->id);
            }))->get();
            return view('home_sponsor',compact('users','visibility','setting','posts'));
        }else if(\auth()->user()->role == 'orphan'){
            $item = User::find(\auth()->user()->id);
            return view('home_orphan',compact('item'));
        }
    }

    public function orphan_manage()
    {
        $users = User::query();

        if (request()->get('name') != '') {
            $users = $users->where('name', 'like', '%' . request()->get('name') . '%');
        }
        if (request()->get('gender') != '') {
            $users = $users->where('gender', 'like', '%' . request()->get('gender') . '%');
        }
        if (request()->get('orphan_file_no') != '') {
            $users = $users->where('orphan_file_no', 'like', '%' . request()->get('orphan_file_no') . '%');
        }
        if (request()->get('mother_name') != '') {
            $users = $users->where('mother_name', request()->get('mother_name'));
        }

        $users = $users->where('role', 'orphan')->paginate(50)->appends(request()->query());
        return view('orphan.manage', compact('users'));
    }




    public function orphan_add()
    {
        return view('orphan.add');
    }


    public function orphan_import(Request $request)
    {
        if ($request->file != '') {
            $file_path = $request->file->store('orphan');
            $x = Excel::import(new OrphanImport(), $file_path);
        }
        return response(['result' => 'success']);
    }
    public function sponsor_import(Request $request)
    {
        if ($request->file != '') {
            $file_path = $request->file->store('sponsor');
            $x = Excel::import(new SponsorImport(), $file_path);
        }
        return response(['result' => 'success']);
    }

    public function orphan_store(Request $request)
    {


        $years = 0;
        if ($request->orphan_birth_date != '') {
            $dateOfBirth = Carbon::createFromFormat('Y-m-d', $request->orphan_birth_date)->format('Y-m-d');
            $years = Carbon::parse($dateOfBirth)->age;
        }

        $user = new User();
        $user->orphan_file_no = $request->orphan_file_no;
        $user->name = $request->name;
        $user->email = Hash::make(Str::random(5));
        $user->password = Hash::make(12345678);
        $user->orphan_birth_date = $request->orphan_birth_date;
        $user->orphan_old_year = $years;
        $user->gender = $request->gender;
        $user->orphan_country = $request->orphan_country;
        $user->orphan_identity = $request->orphan_identity;
        $user->orphan_study_range = $request->orphan_study_range;
        $user->orphan_school_name = $request->orphan_school_name;
        $user->orphan_study_year = $request->orphan_study_year;
        $user->orphan_health_state = $request->orphan_health_state;
        $user->orphan_disease_name = $request->orphan_disease_name;
        $user->orphan_disease_type = $request->orphan_disease_type;
        $user->mother_file_no = $request->mother_file_no;
        $user->mother_name = $request->mother_name;
        $user->mother_phone = $request->mother_phone;
        $user->phone = $request->mother_phone;
        $user->mother_identity = $request->mother_identity;
        $user->mother_iban = $request->mother_iban;
        $user->mother_salary = $request->mother_salary;
        $user->bank_name = $request->bank_name;
        $user->save();

        return response(['result' => 'success']);
    }

    public function orphan_update(Request $request)
    {
        $years = 0;
        if ($request->orphan_birth_date != '') {
            $dateOfBirth = Carbon::createFromFormat('Y-m-d', $request->orphan_birth_date)->format('Y-m-d');
            $years = Carbon::parse($dateOfBirth)->age;
        }

        $user = User::find($request->user_id);
        $user->orphan_file_no = $request->orphan_file_no;
        $user->name = $request->name;
        $user->orphan_birth_date = $request->orphan_birth_date;
        $user->orphan_old_year = $years;
        $user->gender = $request->gender;
        $user->orphan_country = $request->orphan_country;
        $user->orphan_identity = $request->orphan_identity;
        $user->orphan_study_range = $request->orphan_study_range;
        $user->orphan_school_name = $request->orphan_school_name;
        $user->orphan_study_year = $request->orphan_study_year;
        $user->orphan_health_state = $request->orphan_health_state;
        $user->orphan_disease_name = $request->orphan_disease_name;
        $user->orphan_disease_type = $request->orphan_disease_type;
        $user->mother_file_no = $request->mother_file_no;
        $user->mother_name = $request->mother_name;
        $user->mother_phone = $request->mother_phone;
        $user->phone = $request->mother_phone;
        $user->mother_identity = $request->mother_identity;
        $user->mother_iban = $request->mother_iban;
        $user->mother_salary = $request->mother_salary;
        $user->bank_name = $request->bank_name;
        $user->role = 'orphan';
        $user->save();

        return response(['result' => 'success', 'orphan' => $user]);
    }

    public function orphan_destroy($id)
    {
        $user = User::destroy($id);
        return response(['result' => 'success', 'orphan' => $user]);
    }

    public function orphan_report()
    {
        $users = User::query();

        if (request()->get('name') != '') {
            $users = $users->where('name', 'like', '%' . request()->get('name') . '%');
        }
        if (request()->get('gender') != '') {
            $users = $users->where('gender', 'like', '%' . request()->get('gender') . '%');
        }
        if (request()->get('orphan_file_no') != '') {
            $users = $users->where('orphan_file_no', 'like', '%' . request()->get('orphan_file_no') . '%');
        }
        if (request()->get('mother_name') != '') {
            $users = $users->where('mother_name', request()->get('mother_name'));
        }
        if (request()->get('month_date') != '') {
            $month_date = Carbon::createFromFormat('Y-m-d',  request()->get('month_date'))->format('Y-m-d');
//            $users = $users->where(DB::raw('DATEDIFF(sponsor_pay_end,"' . $month_date . '")'), '>=', 1);
//            dd($month_date);
            $users = $users->whereDate('sponsor_pay_end','>=',$month_date);
            $users = $users->whereDate('sponsor_pay_start','<=',$month_date);
            $users = $users->with('orphans');

            $users = $users->where('role', 'sponsor')->get();

        }else{
            $users = $users->with('sponsors');

            $users = $users->where('role', 'orphan')->get();
        }


        $usersFiltered = [];
        if (request()->get('month_date') == '') {
            foreach ($users as $user) {
                if (request()->get('ensure_state') == 'has_sponsor' && count($user->sponsors) > 0) {
                    array_push($usersFiltered, $user);
                } else if (request()->get('ensure_state') == 'has_not_sponsor' && count($user->sponsors) == 0) {
                    array_push($usersFiltered, $user);
                } else if (request()->get('ensure_state') == 1 && count($user->sponsors) == 1) {
                    array_push($usersFiltered, $user);
                } else if (request()->get('ensure_state') == 2 && count($user->sponsors) == 2) {
                    array_push($usersFiltered, $user);
                } else if (request()->get('ensure_state') == 3 && count($user->sponsors) == 3) {
                    array_push($usersFiltered, $user);
                } else if (request()->get('ensure_state') == 'more_than_3' && count($user->sponsors) > 3) {
                    array_push($usersFiltered, $user);
                }
                if (request()->get('ensure_state') == '') {
                    array_push($usersFiltered, $user);
                }
            }
            $users = $usersFiltered;
        }
        if (request()->get('month_date') == '') {
            return view('orphan.report', compact('users'));
        }else{
            return view('orphan.report_recieved_pay', compact('users'));
        }
    }

    public function sponsor_report()
    {
        $users = User::query();

        if (request()->get('name') != '') {
            $users = $users->where('name', 'like', '%' . request()->get('name') . '%');
        }
        if (request()->get('phone') != '') {
            $users = $users->where('phone', 'like', '%' . request()->get('phone') . '%');
        }
        if (request()->get('sponsor_file_no') != '') {
            $users = $users->where('sponsor_file_no', 'like', '%' . request()->get('sponsor_file_no') . '%');
        }
        if (request()->get('ensure_type') != '') {
            $users = $users->where('ensure_type', request()->get('ensure_type'));
        }
        if (request()->get('sponsor_not_pay') != '') {
            $users = $users->where(DB::raw('DATEDIFF(sponsor_pay_end,"'.Carbon::today()->format('Y-m-d').'")'),'<=',-request()->get('sponsor_not_pay'));

        }
        $users = $users->with('orphans');

        $users = $users->where('role', 'sponsor')->get();
        $usersFiltered = [];
        foreach ($users as $user) {

            if (request()->get('ensure_state') == 'has_orphan' && count($user->orphans) > 0) {
                array_push($usersFiltered, $user);
            } else if (request()->get('ensure_state') == 'has_not_orphan' && count($user->orphans) == 0) {
                array_push($usersFiltered, $user);
            } else if (request()->get('ensure_state') == 1 && count($user->orphans) == 1) {
                array_push($usersFiltered, $user);
            } else if (request()->get('ensure_state') == 2 && count($user->orphans) == 2) {
                array_push($usersFiltered, $user);
            } else if (request()->get('ensure_state') == 3 && count($user->orphans) == 3) {
                array_push($usersFiltered, $user);
            } else if (request()->get('ensure_state') == 'more_than_3' && count($user->orphans) > 3) {
                array_push($usersFiltered, $user);
            }
            if (request()->get('ensure_state') == '') {
                array_push($usersFiltered, $user);
            }
        }
        $users = $usersFiltered;
        return view('sponsor.report', compact('users'));
    }


    public function sponsor_manage()
    {
        $users = User::query();

        if (request()->get('name') != '') {
            $users = $users->where('name', 'like', '%' . request()->get('name') . '%');
        }
        if (request()->get('phone') != '') {
            $users = $users->where('phone', 'like', '%' . request()->get('phone') . '%');
        }
        if (request()->get('sponsor_file_no') != '') {
            $users = $users->where('sponsor_file_no', 'like', '%' . request()->get('sponsor_file_no') . '%');
        }
        if (request()->get('ensure_type') != '') {
            $users = $users->where('ensure_type', request()->get('ensure_type'));
        }

        $users = $users->with('orphans')->where('role', 'sponsor')->paginate(50)->appends(request()->query());
        return view('sponsor.manage', compact('users'));
    }

    public function sponsor_add()
    {
        return view('sponsor.add');
    }

    public function sponsor_store(Request $request)
    {
        $messages = [
            'phone.unique' => 'رقم الجوال مسجل مسبقاً',

        ];
        $validator = Validator::make($request->all(), [
            'phone' => 'unique:users,phone',
        ],$messages);

        if ($validator->fails()) {
            return response()->json(['errors' => Arr::flatten( $validator->errors()->all()),'status'=>false], 422);
        }
        $user = new User();
        $count = User::where('role','sponsor')->count();
        $user->sponsor_file_no = '7000'.($count+1);
        $user->phone = $request->phone;
        $user->name = $request->name;
        $user->email = Hash::make(Str::random(5));
        $user->password = Hash::make($request->phone);
        $user->ensure_type = $request->ensure_type;
        $user->ensure_type_text = $request->ensure_type;
        $user->orphans_count = $request->orphans_count;
        $user->role = 'sponsor';
        $user->save();

        return response(['result' => 'success']);
    }

    public function sponsor_update(Request $request)
    {

        $user = User::find($request->user_id);
        $user->phone = $request->phone;
        $user->name = $request->name;
        $user->password = $request->password != '' ? $request->password : $user->password;
        $user->ensure_type = $request->ensure_type;
        $user->ensure_type_text = $request->ensure_type;
        $user->orphans_count = $request->orphans_count;
        $this->saveUserPay($user,$request);

        $user->save();
        $user->sponsor_pay_end = Carbon::parse($user->sponsor_pay_end)->format('Y-m-d');
        return response(['result' => 'success', 'sponsor' => $user]);
    }


    public function sponsor_destroy($id)
    {
        $user = User::destroy($id);
        return response(['result' => 'success', 'sponsor' => $user]);
    }
    public function sponsor_orphan_destroy($sponsor,$orphan)
    {
        $user = OrphanSponsor::where('sponsor_id',$sponsor)->where('orphan_id',$orphan)->delete();
        return response(['result' => 'success', 'sponsor' => $user]);
    }
    public function sponsor_destroy_multi(Request $request)
    {

        $user = User::destroy($request->items);
        return response(['result' => 'success', 'sponsor' => $user]);
    }

    public function sponsor_orphan()
    {
        $sponsors = User::where('role', 'sponsor')->get();
        $orphans = User::where('role', 'orphan')->get();
        return view('orphan_sponsor.add', compact('sponsors', 'orphans'));
    }

    public function sponsor_orphan_store(Request $request)
    {
        $sponsor = $request->sponsor_id;
        $orphans = OrphanSponsor::where('sponsor_id', $sponsor)->get('orphan_id')->pluck('orphan_id');
        $orphansArray = $orphans->toArray();
        $orphans = [];
        $flag = false;
        foreach ($request->orphan_id as $item_new) {
            foreach ($orphansArray as $item_old) {
                if ($item_old == $item_new) {
                    $flag = true;
                    break;
                }
            }
            if (!$flag) {
                array_push($orphans, $item_new);
            }
            $flag = false;
        }
        foreach ($orphans as $item) {
            $join = new OrphanSponsor();
            $join->sponsor_id = $sponsor;
            $join->orphan_id = $item;
            $join->save();
        }
        return response(['result' => 'success']);
    }

    public function sponsor_pay()
    {
        $sponsors = User::where('role', 'sponsor')->get();
        return view('sponsor.pay', compact('sponsors'));
    }

    public function sponsor_pay_store(Request $request)
    {

        $user = User::find($request->user_id);
        $this->saveUserPay($user,$request);


        return response(['result' => 'success']);
    }

    private function saveUserPay($user,$request)
    {
        $sponsor_pay_start = Carbon::today();
        $sponsor_pay_end = Carbon::today();
        if ($request->sponsor_pay_start != '') {
            $sponsor_pay_start = Carbon::createFromFormat('Y-m-d', $request->sponsor_pay_start)->format('Y-m-d');
        }
        if($request->has('ensure_type') and $request->ensure_type != ''){
            $user->ensure_type = $request->ensure_type;
            $user->ensure_type_text = $request->ensure_type;
        }else{
            $user->ensure_type = 1;
            $user->ensure_type_text = 1;
        }


        $user->save();
        $sponsor_pay_end = $this->getPayEndDate($user, $sponsor_pay_start);

        $user->sponsor_pay_start = $sponsor_pay_start;
        $user->sponsor_pay_end = $sponsor_pay_end;
        $user->sponsor_pay_value = $request->sponsor_pay_value;
        $user->save();
    }
    public function profile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function update_profile(Request $request)
    {
        $user = Auth::user();
        $user = User::find($user->id);
        $user->name = $request->name ?? $user->name;
        $user->email = $request->email ?? $user->email;
        if ($request->password != '') {
            $user->password = Hash::make($request->password);

        }
        $user->save();
        return response(['message' => 'success']);
    }

    protected function getPayEndDate($user, $startDate)
    {

        if ($user->ensure_type == 1) {
            return Carbon::parse($startDate)->addMonths(1);
        } else if ($user->ensure_type == 2) {
            return Carbon::parse($startDate)->addYears(1);
        }else if ($user->ensure_type == 15) {
            return Carbon::parse($startDate)->addYears(2);
        }else if ($user->ensure_type == 16) {
            return Carbon::parse($startDate)->addYears(3);
        } else if ($user->ensure_type == 3) {
            return Carbon::parse($startDate)->addMonths(1);
        } else if ($user->ensure_type == 4) {
            return Carbon::parse($startDate)->addMonths(2);
        } else if ($user->ensure_type == 5) {
            return Carbon::parse($startDate)->addMonths(3);
        } else if ($user->ensure_type == 6) {
            return Carbon::parse($startDate)->addMonths(4);
        } else if ($user->ensure_type == 7) {
            return Carbon::parse($startDate)->addMonths(5);
        } else if ($user->ensure_type == 8) {
            return Carbon::parse($startDate)->addMonths(6);
        } else if ($user->ensure_type == 9) {
            return Carbon::parse($startDate)->addMonths(7);
        } else if ($user->ensure_type == 10) {
            return Carbon::parse($startDate)->addMonths(8);
        } else if ($user->ensure_type == 11) {
            return Carbon::parse($startDate)->addMonths(9);
        } else if ($user->ensure_type == 12) {
            return Carbon::parse($startDate)->addMonths(10);
        } else if ($user->ensure_type == 13) {
            return Carbon::parse($startDate)->addMonths(11);
        } else if ($user->ensure_type == 14) {
            return Carbon::parse($startDate)->addMonths(12);
        } else {
            return null;
        }
    }

    public function send_message_manually()
    {
        $this->dispatch(new sendMessage());
        return response(['message' => 'success','flag'=>true]);
    }

    protected function sendSMS($oursmsusername, $oursmspassword, $messageContent, $mobileNumber, $senderName)
    {
        $user = $oursmsusername;
        $password = $oursmspassword;
        $sendername = $senderName;
        $text = urlencode($messageContent);
        $to = $mobileNumber;

        $url = "http://www.4jawaly.net/api/sendsms.php?username=$user&password=$password&numbers=$to&message=$text&sender=$sendername&unicode=E&return=json";
        $ret = file_get_contents($url);
        return nl2br($ret);
    }
}
