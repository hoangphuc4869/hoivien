<x-main>
    <form action="" method="POST">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <div class="form-group">
                        <label for="thumb">Ảnh chân dung 3x4</label>
                        <input type="file"  class="form-control" id="upload">
                        <div id="image_show">

                        </div>
                        <input type="hidden" name="thumb" id="thumb">
                    </div>
                </div>

                <div class="col-lg-8 col-12">

                    <div class="form-group">
                        <label for="name">Họ tên:</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control"  placeholder="Họ tên">
                    </div>

                    <div class="form-group">
                        <label for="gender">Giới Tính</label>
                        <select class="form-control" name="gender">
                            <option>Nam</option>
                            <option>Nữ</option>
                        </select>
                    </div> 

                    <div class="form-group">
                        <label for="birthday">Ngày/tháng/năm sinh:</label>
                        <input type="text" name="birthday" value="{{ old('birthday') }}" class="form-control"  placeholder="dd/mm/yyyy">
                    </div>

                    <div class="form-group">
                        <label for="birth_place">Nơi sinh:</label>
                        <input type="text" name="birth_place" value="{{ old('birth_place') }}" class="form-control"  placeholder="Nơi sinh">
                    </div>

                </div>
            </div>


            <div class="row">

                <h4 class="card-title">- Học vị: </h4>

                <div class="col-lg-4 col-12">
                    <div class="form-group">
                        <label for="degree">Trung cấp - Cao đẳng - Đại học:</label>
                        <select class="form-control" name="degree">
                            <option>Bác sĩ</option>
                            <option>Điều dưỡng</option>
                            <option>Kỹ thuật viên</option>
                            <option>Kỹ sư</option>
                            <option>Cử nhân</option>
                            <option>Khác</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-4 col-12">
                    <div class="form-group">
                        <label for="degree_2">Sau đại học:</label>
                        <select class="form-control" name="degree_2">
                            <option>Bác sĩ chuyên khoa I</option>
                            <option>Bác sĩ chuyên khoa II</option>
                            <option>Thạc sĩ</option>
                            <option>Tiến sĩ</option>
                            <option>Khác</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-4 col-12">
                    <div class="form-group">
                        <label for="function">Học hàm:</label>
                        <select class="form-control" name="function">
                            <option>Phó giáo sư</option>
                            <option>Giáo sư</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-4 col-12">
                    <div class="form-group">
                        <label for="specialized">Chuyên ngành:</label>
                        <input type="text" name="specialized" value="{{ old('specialized') }}" class="form-control"  placeholder="Chuyên ngành">
                    </div>
                </div>

                <div class="col-lg-4 col-12">
                    <div class="form-group">
                        <label for="year">Năm tốt nghiệp chuyên ngành:</label>
                        <input type="text" name="year" value="{{ old('year') }}" class="form-control"  placeholder="Năm tốt nghiệp">
                    </div>
                </div>

                <div class="col-lg-4 col-12">
                    <div class="form-group">
                        <label for="name_school">Tên trường tốt nghiệp chuyên ngành:</label>
                        <input type="text" name="name_school" value="{{ old('name_school') }}" class="form-control"  placeholder="Tên trường tốt nghiệp">
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-4 col-12">
                    <div class="form-group">
                        <label for="thumb_2">Ảnh bằng tốt nghiệp chuyên ngành</label>
                        <input type="file"  class="form-control" id="upload_2">
                        <div id="image_show_2">

                        </div>
                        <input type="hidden" name="thumb_2" id="thumb_2">
                    </div>
                </div>

                <div class="col-lg-8 col-12">

                    <div class="form-group">
                        <label for="name_company">Tên cơ quan công tác (không viết tắt):</label>
                        <input type="text" name="name_company" value="{{ old('name_company') }}" class="form-control"  placeholder="Tên cơ quan công tác">
                    </div>

                    <div class="form-group">
                        <label for="office">Chức vụ tại nơi công tác:</label>
                        <input type="text" name="office" value="{{ old('office') }}" class="form-control"  placeholder="Chức vụ tại nơi công tác">
                    </div>

                    <div class="form-group">
                        <label for="address">Địa chỉ liên lạc và nhận thư/bưu phẩm:</label>
                        <input type="text" name="address" value="{{ old('address') }}" class="form-control"  placeholder="Địa chỉ liên lạc">
                    </div>

                    <div class="form-group">
                        <label for="date">Ngày vào Đảng (nếu có):</label>
                        <input type="text" name="date" value="{{ old('date') }}" class="form-control"  placeholder="Ngày vào Đảng">
                    </div>


                    <!-- nộp phí -->

                    <!-- Button trigger modal -->
                    
                    <div class="payment">
                        <button type="button" class="btn btn-warning btn-rounded btn-fw" data-bs-toggle="modal" data-bs-target="#exampleModal">
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

                                    <img class="img-qr" src="" alt="Profile image">
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