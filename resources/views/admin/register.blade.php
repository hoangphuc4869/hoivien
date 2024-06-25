<x-main>
    @section('title', "Đăng ký hội viên")
   
    <div class="member-title-wrap d-flex align-items-center gap-2">
        <i class="mdi mdi-format-list-bulleted d-flex align-items-center"></i> 
        <div class="member-title">
            Đăng ký hội viên
        </div>
    </div>
    
    <div class="wrap-f card-body mt-3">
        <form class="forms-sample" method="POST" action="{{route('regis')}}">
        @csrf
        <div class="form-group">
            <label for="exampleInputUsername1">Họ tên</label>
            <input
                type="text"
                name = "name"
                class="form-control"
                id="exampleInputUsername1"
                placeholder="Họ tên"
            />
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input
                type="email"
                class="form-control"
                id="exampleInputEmail1"
                name ="email"
                placeholder="Email"
            />
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Mật khẩu</label>
            <input
                type="password"
                class="form-control"
                name ="password"
                id="exampleInputPassword1"
                placeholder="Mật khẩu"
            />
        </div>
        <div class="form-group">
            <label for="exampleInputConfirmPassword1"
                >Xác nhận mật khẩu</label
            >
            <input
                type="password"
                class="form-control"
                name ="confirm_pass"
                id="exampleInputConfirmPassword1"
                placeholder="Xác nhận mật khẩu"
            />
        </div>
        <div class="form-check">
            <label for="optionsRadios2" class="form-check-label">
            <input type="radio" class="form-check-input" name="role" id="optionsRadios2" value="admin">
            Admin
            <i class="input-helper"></i></label>
        </div>

         <div class="form-check">
            <label for="optionsRadios" class="form-check-label">
            <input type="radio" class="form-check-input" name="role" id="optionsRadios" value="user" checked>
            User
            <i class="input-helper"></i></label>
        </div>
        <button type="submit" class="mt-3 btn btn-primary me-2">Đăng ký</button>
        {{-- <button class="btn btn-light mt-3">Cancel</button> --}}
    </form>
    </div>
        
    
  
</x-main>
    
