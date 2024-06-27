<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// -------------------
use App\Models\Member;
use App\Http\Requests\Member\MemberFormRequest;
use App\Http\Services\Member\MemberService;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Register;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class MemberController extends Controller
{
    protected $memberService;

    public function __construct(MemberService $memberService)
    {
        $this->memberService = $memberService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::allows('view')) {
            return view('admin.members.list', [
            'title' => 'Danh sách hội viên',
            'members' => $this->memberService->getAll()
        ]);

        } else {
            abort(403, 'Bạn không có quyền truy cập vào danh sách hội viên.');
        }
        
    }

    public function register_index(){
        // Lấy danh sách email từ bảng members
        $emails = Member::pluck('email')->toArray();

        // Tạo người dùng từ mỗi email
        foreach ($emails as $email) {
            // Kiểm tra xem người dùng có tồn tại không
            $existingUser = User::where('email', $email)->first();
            if (!$existingUser) {
                // Tạo người dùng mới nếu chưa tồn tại
                $user = new User();
                $user->email = $email;
                $user->password = Hash::make('123'); // Mã hóa mật khẩu
                $user->role = 'user'; // Gán vai trò là 'user'
                $user->save();
            }
        }
        return view('admin.users.register', ['title' => 'Đăng ký hội viên']);
    }
    

    public function register(Register $request, User $user)
    {
        $data = $request->safe()->except('confirm_pass');
        $data['password'] = Hash::make($request->input('password'));

        $user->insert($data);

        return redirect()->back()->with('message', "Đăng ký thành công");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.members.add', [
            'title' => 'Thêm Thông Tin'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(MemberFormRequest $request)
    {
        // dd($request->safe());
        $data = $request->validated();

        // $this->memberService->update($request, $member);
        
        $member = Member::where('id', $data['id'])->first(); 

        if (!$member) {
            abort(404, 'Không tìm thấy thành viên');
        }
        $member->fill($data);
        $member->save();
        
        return redirect()->back()->with("success", "Cập nhật thành công");
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        return view('admin.members.edit', [
            'title' => 'Chỉnh Sửa Thông Tin',
            'member' => $member
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        $result = $this->memberService->update($request, $member);
        if ($result) {
            return redirect('/admin/members/list');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Request $request)
    {
        $result = $this->memberService->delete($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công sản phẩm'
            ]);
        }

        return response()->json([ 'error' => true ]);
    }
}