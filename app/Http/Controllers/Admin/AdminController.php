<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    
    public function index() {
        
        return view("admin.main");
    }
    
    public function member(Member $members) {
        $all_members = $members::all();
        
        if(Gate::allows('view')){
            return view("admin.member", compact('all_members'));
        }
        else {
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }
    }

    public function getMemberById($id) {
        $member = Member::select('*')->where('user_id', $id)->first();
        
            if(!empty($member)){
               if(Gate::allows('view') || (Auth::check() && Auth::user()->id == $id && $member->status !== "blocked")){
                return view('admin.profile', compact('member'));
               }
              else {
                    abort(403, 'Bạn không có quyền truy cập trang này.');
                }
            }
            else {
                abort(403, 'Hội viên không tồn tại');
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

    public function transaction() {
        $transactions = Transaction::all();
        $members = Member::all();
        return view('admin.transaction', compact('transactions','members'));
    }
    public function query(Request $request) {

        $userId = $request->input('userId');

        $user = User::find($userId);

        $mem = Member::where('user_id', $user->id)->first();
        

        if ($user) {

            $newTransaction = new Transaction();
            $transactionCode = 'TXN_' . $user->id . '_' . time();
            $newTransaction->user_name = $user->name;
            $newTransaction->user_id = $mem->id;
            $newTransaction->code = $transactionCode;
            $newTransaction->status = 'pending';
            $newTransaction->save();

            return response()->json([
                'success' => true,
                'message' => 'Transaction created successfully for user ID ' . $mem->id,
                'transaction' => $newTransaction 
            ]);
        } else {
            return response()->json(['success' => false, 'message' => 'User not found id' . $mem->id]);
        }
    }

    public function query_in_profile(Request $request) {

        $userId = $request->input('userId');

        $user = Member::find($userId);

        if ($user) {

            $newTransaction = new Transaction();
            $transactionCode = 'TXN_' . $user->id . '_' . time();
            $newTransaction->user_name = $user->name;
            $newTransaction->user_id = $user->id;
            $newTransaction->code = $transactionCode;
            $newTransaction->status = 'pending';
            $newTransaction->save();

            return response()->json([
                'success' => true,
                'message' => 'successfully',
                'transaction' => $newTransaction 
            ]);
        } else {
            return response()->json(['success' => false, 'message' => 'User not found id' . $userId]);
        }
    }

    public function processAccept(Request $request) {

        $itemId = $request->itemId;

        $item = Transaction::find($itemId);

        

        if ($item) {

            if($item->status === "pending") {
                if($request->status === 'success'){
                    $member = Member::where('id', $item->user_id)->first();
                    $item->status = "success";
                    $member->start = now();
                    $member->end = $member->start->copy()->addYear();
                    $member->save();
                }
                else {
                    $item->status = "fail";
                }
            }

            $item->save();

            return response()->json([
                'success' => true,
                'message' => "Thành công",
            ]);
        } else {
            return response()->json(['success' => false, 'message' => 'Thất bại']);
        }
    }
 }