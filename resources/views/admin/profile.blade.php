<x-main>
   <form action="" method="POST">
    <input type="hidden" name="id" value="{{ $member->id }}" id="member_id">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <div class="form-group">
                        <label for="thumb">Ảnh chân dung 3x4</label>
                        <input type="file"  class="form-control" id="upload">
                        <div id="image_show">
                            <a href="{{ $member->thumb }}">
                                <img src="{{ $member->thumb }}">
                            </a>
                        </div>
                        <input type="hidden" name="thumb" value="{{ $member->thumb }}" id="thumb">
                    </div>
                </div>

                <div class="col-lg-8 col-12">
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="name">Họ tên:</label>
                            <input type="text" name="name" value="{{ $member->name }}" class="form-control"  placeholder="Họ tên">
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="gender">Giới Tính</label>
                            <select class="form-control" name="gender">
                                <option {{$member->gender === "Name" ? "selected" : ""}}>Nam</option>
                                <option {{$member->gender === "Nữ" ? "selected" : ""}}>Nữ</option>
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="birthday">Ngày/tháng/năm sinh:</label>
                            <input type="text" name="birthday" value="{{ $member->birthday }}" class="form-control"  placeholder="dd/mm/yyyy">
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="birth_place">Nơi sinh:</label>
                            <input type="text" name="birth_place" value="{{ $member->birth_place }}" class="form-control"  placeholder="Nơi sinh">
                        </div>

                         <div class="form-group col-lg-6">
                            <label for="birth_place">Email:</label>
                            <input type="text" name="email" value="{{ $member->email }}" class="form-control"  placeholder="Email">
                        </div>

                         <div class="form-group col-lg-6">
                            <label for="birth_place">Số điện thoại:</label>
                            <input type="text" name="phone" value="{{ $member->phone }}" class="form-control"  placeholder="Số điện thoại">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <h4 class="card-title">- Học vị: </h4>

                <div class="col-lg-4 col-12">
                    <div class="form-group">
                        <label for="degree">Trung cấp - Cao đẳng - Đại học:</label>
                        <select class="form-control" name="degree">
                            <option {{$member->degree === "Bác sĩ" ? "selected" : ""}}>Bác sĩ</option>
                            <option {{$member->degree === "Điều dưỡng" ? "selected" : ""}}>Điều dưỡng</option>
                            <option {{$member->degree === "Kỹ thuật viên" ? "selected" : ""}}>Kỹ thuật viên</option>
                            <option {{$member->degree === "Kỹ sư" ? "selected" : ""}}>Kỹ sư</option>
                            <option {{$member->degree === "Cử nhân" ? "selected" : ""}}>Cử nhân</option>
                            <option {{$member->degree === "Khác" ? "selected" : ""}}>Khác</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-4 col-12">
                    <div class="form-group">
                        <label for="degree_2">Sau đại học:</label>
                        <select class="form-control" name="degree_2" >
                            <option {{$member->degree_2 === "Bác sĩ chuyên khoa I" ? "selected" : ""}}>Bác sĩ chuyên khoa I</option>
                            <option {{$member->degree_2 === "Bác sĩ chuyên khoa II" ? "selected" : ""}}>Bác sĩ chuyên khoa II</option>
                            <option {{$member->degree_2 === "Thạc sĩ" ? "selected" : ""}}>Thạc sĩ</option>
                            <option {{$member->degree_2 === "Tiến sĩ" ? "selected" : ""}}>Tiến sĩ</option>
                            <option {{$member->degree_2 === "Khác" ? "selected" : ""}}>Khác</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-4 col-12">
                    <div class="form-group">
                        <label for="function">Học hàm:</label>
                        <select class="form-control" name="function" >
                            <option {{$member->function === "Phó giáo sư" ? "selected" : ""}}>Phó giáo sư</option>
                            <option {{$member->function === "Giáo sư" ? "selected" : ""}}>Giáo sư</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-4 col-12">
                    <div class="form-group">
                        <label for="specialized">Chuyên ngành:</label>
                        <input type="text" name="specialized" value="{{ $member->specialized }}" class="form-control"  placeholder="Chuyên ngành">
                    </div>
                </div>

                <div class="col-lg-4 col-12">
                    <div class="form-group">
                        <label for="year">Năm tốt nghiệp chuyên ngành:</label>
                        <input type="text" name="year" value="{{ $member->year }}" class="form-control"  placeholder="Năm tốt nghiệp">
                    </div>
                </div>

                <div class="col-lg-4 col-12">
                    <div class="form-group">
                        <label for="name_school">Tên trường tốt nghiệp chuyên ngành:</label>
                        <input type="text" name="name_school" value="{{ $member->name_school }}" class="form-control"  placeholder="Tên trường tốt nghiệp">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-12">
                    <div class="form-group">
                        <label for="thumb_2">Ảnh bằng tốt nghiệp chuyên ngành</label>
                        <input type="file"  class="form-control" id="upload_2">
                        <div id="image_show_2">
                            <a href="{{ $member->thumb_2 }}">
                                <img src="{{ $member->thumb_2 }}">
                            </a>
                        </div>
                        <input type="hidden" name="thumb_2" value="{{ $member->thumb_2 }}" id="thumb_2">
                    </div>
                </div>


                <div class="col-lg-8 col-12">
                    <div class="form-group">
                        <label for="name_company">Tên cơ quan công tác (không viết tắt):</label>
                        <input type="text" name="name_company" value="{{ $member->name_company }}" class="form-control"  placeholder="Tên cơ quan công tác">
                    </div>

                    <div class="form-group">
                        <label for="office">Chức vụ tại nơi công tác:</label>
                        <input type="text" name="office" value="{{ $member->office }}" class="form-control"  placeholder="Chức vụ tại nơi công tác">
                    </div>

                    <div class="form-group">
                        <label for="address">Địa chỉ liên lạc và nhận thư/bưu phẩm:</label>
                        <input type="text" name="address" value="{{ $member->address }}" class="form-control"  placeholder="Địa chỉ liên lạc">
                    </div>

                    <div class="form-group">
                        <label for="date">Ngày vào Đảng (nếu có):</label>
                        <input type="text" name="date" value="{{ $member->date }}" class="form-control"  placeholder="Ngày vào Đảng">
                    </div>


                    <!-- nộp phí -->

                    <!-- Button trigger modal -->
                    
                    <div class="payment">
                        <button type="button" class="dongphi {{ $member->status === "inactive" ? "enabled" : "" }} btn btn btn-warning btn-rounded btn-fw" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Đóng Phí Thường Niên
                        </button>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Đóng Phí Thường Niên</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="text-pay">Phí Thường Niên: <b>500.000 VND</b></p>

                                    <img class="img-qr" src="/template/admin/images/faces/face9.jpg" alt="Profile image">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <button type="submit" class="btn btn-primary">Cập Nhật Thông Tin</button>

        @csrf
    </form>
</x-main>

<style>
    .dongphi {
        pointer-events: none;
        opacity: 0.2;
    }
    .dongphi.enabled {
        pointer-events: all;
        opacity: 1;
    }
</style>


<script>
    var btn = document.querySelector(".dongphi");
    if(btn){
        btn.addEventListener("click", () => {
            var userId = document.querySelector("#member_id").value;
            var token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json'
                },
                url: "{{route('query_in_profile')}}", 
                data: JSON.stringify({ userId: userId }), 
                success: function(response) {
                    console.log(response.transaction);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        })
    }
</script>