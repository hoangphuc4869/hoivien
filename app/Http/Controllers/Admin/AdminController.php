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
        
        $members = Member::orderBy('id', 'desc')
                                ->take(4)
                                ->get();
        $membersCount = Member::count();
        $totalActiveMembers = Member::where('status', 'active')->count();
        $totalInactiveMembers = Member::where('status', 'inactive')->count();
        $totalBLockedMembers = Member::where('status', 'blocked')->count();
        $totalAboutMembers = Member::where('about_to_date', 1)->count();
        $re = User::where('status', 'pending')->count();
        return view("admin.main", compact('membersCount','members', 'totalActiveMembers', 'totalBLockedMembers', 'totalAboutMembers', 'totalInactiveMembers', 're'));
    }
    
    public function member(Member $members) {
        $all_members = $members->orderBy('id', 'desc')->get();

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

    public function register_list() {
        
        $all_members = User::where("status", "pending")
                      ->orderBy('id', 'desc')
                      ->get();


        if(Gate::allows('view')){
            return view("admin.register", compact('all_members'));
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

    public function transaction() {
        $transactions = Transaction::paginate(15);
        $members = Member::all();
        if(Gate::allows('view')){
           return view('admin.transaction', compact('transactions','members'));
        }
        else {
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }
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

    public function user_confirm(Request $request) {

        $itemId = $request->itemId;

        $item = User::find($itemId);

        if ($item) {

            if($item->status === "pending") {
                if($request->status === 'success'){

                    $item->status = "verified";
            
                    $newMember = new Member();
                    $newMember->name = $item['name'];
                    $newMember->email = $item['email'];
                    $newMember->status = "active";
                    $newMember->start = now();
                    $newMember->end = $newMember->start->copy()->addYear();
                    $newMember->user_id = $item->id; 
                    $newMember->save();
                    $item->save();
                }
                else {
                    $item->delete();
                }
            }

            

            return response()->json([
                'success' => true,
                'message' => "Thành công",
            ]);
        } else {
            return response()->json(['success' => false, 'message' => 'Thất bại']);
        }
    }

    // public function get_user_transactions($id){
    //     $transactions = Transaction::paginate(15);
    //     $members = Member::all();
    //     return view('admin.transaction', compact('transactions','members'));
    // }

    public function delete(Request $request) {
        $userId = $request->input('userId');

        $member = Member::find($userId);
        $user = User::find($member->user_id);
        if ($user && $member) {

            $member->delete();  
            $user->delete();

            return response()->json(['success' => true, 'message' => 'Xóa thành công']);
        } else {
            return response()->json(['success' => false, 'message' => 'Xóa thất bại']);
        }
    }

    public function search(Request $request) {
        $searchInput = $request->input('searchInput');
        $query = Member::query();
        
        if ($searchInput) {
            $ids = $query->where('name', 'LIKE', "%{$searchInput}%")
                ->orWhere('email', 'LIKE', "%{$searchInput}%")
                ->orderBy('id', 'desc')
                ->pluck('id'); 

            return response()->json([
                'success' => true, 
                'message' => 'Tìm thấy ' . $ids->count() . ' kết quả', 
                'member' => $ids
            ]);
        } else {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy']);
        }
    }

    public function search_transaction(Request $request) {
        $searchInput = $request->input('searchInput');
        $query = Transaction::query();
        
        if ($searchInput) {
            $ids = $query->where('user_name', 'LIKE', "%{$searchInput}%")
                ->orderBy('id', 'desc')
                ->get(['id', 'user_id']);
              

            return response()->json([
                'success' => true, 
                'message' => 'Tìm thấy ' . $ids->count() . ' kết quả', 
                'member' => $ids,
                
            ]);
        } else {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy']);
        }
    }
 }