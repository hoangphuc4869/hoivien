<?php


namespace App\Http\Services\Member;


use App\Models\Member;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class MemberService
{
    // phân trang

    public function getAll()
    {
        return Member::orderbyDesc('id')->paginate(20);
    }

    // insert dữ vào bảng

    public function insert($request)
    {

        try {
            $request->except('_token');
            Member::create($request->all());
            Session::flash('success', 'Thêm thông tin thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Thêm thông tin lỗi');
            Log::info($err->getMessage());
            return  false;
        }

        return  true;
    }

    // update phần sửa

    public function update($request, $member)
    {
        try {
            $member->fill($request->input());
            $member->save();
            Session::flash('success', 'Cập nhật thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Có lỗi vui lòng thử lại');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    // xóa thông tin

    public function delete($request)
    {
        $Member = Member::where('id', $request->input('id'))->first();
        if ($Member) {
            $Member->delete();
            return true;
        }

        return false;
    }
}