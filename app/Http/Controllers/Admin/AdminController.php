<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AdminController extends Controller
{
    public function index() {
        return view("admin.main");
    }
    
    public function member(Member $members) {
        
        
        if(Gate::allows('view')){
            $all_members = $members::all();

            foreach($all_members as $member){
                $before_end_1_month = Carbon::parse($member->end)->submonth();

                $about_to_date = now()->diffInMonths($before_end_1_month) <= 0 && now()->diffInMonths($before_end_1_month) >= -1   ? "1" : "0" ;
                $member->about_to_date = $about_to_date;
                
                if(now() > $member->end){
                    $member->status = "inactive";   
                }
                elseif(now() <= $member->end && $member->status === "blocked"){
                    $member->status = "blocked";   
                }
                else {
                    $member->status = "active";   
                }
                $member->save();
            }

            $all_members = $members::all();
            
            return view("admin.member", compact('all_members'));
        }
        else {
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }
    }

    public function getMemberById($id) {
        $member = Member::select('*')->where('id', $id)->first();
        if(Gate::allows('view')){
            if(!empty($member)){
                return view('admin.profile', compact('member'));
            }
            else {
                abort(403, 'Hội viên không tồn tại');
            }
        }
        else {
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }
    }
    
    public function changeStatus(Request $request)
    {
        $userId = $request->input('userId');

        $user = Member::find($userId);
        if ($user) {

            $user->status = $user->status === "active" ? "blocked" : "active";
            $user->save();

            return response()->json(['success' => true, 'message' => 'Thay đổi trạng thái thành công ']);
        } else {
            return response()->json(['success' => false, 'message' => 'Người dùng không tồn tại']);
        }
    }
 }