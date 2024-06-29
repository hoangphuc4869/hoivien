<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Đăng nhập</title>
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <link
            href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet"
        />

        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        />

        <link rel="stylesheet" href="/login-form-20/css/style.css" />
    </head>
    <body
        class="img js-fullheight"
        style="background-image: url('/login-form-20/images/a.jpg');overflow:hidden"
    >
        <section class="ftco-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="login-wrap p-0">
                            <h3 class="mb-4 text-center">Đăng ký hội viên</h3>
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger">{{ $error }}</div>
                                @endforeach
                            @endif

                            @if (Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif
                            
                            
                            <form
                                action="{{ route('regis') }}"
                                class="signin-form"
                                method="POST"
                            >
                                @csrf
                                <div class="form-group">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Họ tên"
                                        name="name"
                                        value="{{ old('name') }}"
                                        autocomplete="name"
                                        required
                                    />
                                </div>

                                <div class="form-group">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        autocomplete="email"
                                        required
                                    />
                                </div>
                              
                                <div class="form-group">
                                    <input
                                        id="password-field"
                                        type="password"
                                        class="form-control"
                                        placeholder="Mật khẩu"
                                        name="password"
                                        required
                                        autocomplete="current-password"
                                    />
                                    <span
                                        toggle="#password-field"
                                        class="fa fa-fw fa-eye field-icon toggle-password"
                                    ></span>
                                </div>

                                <div class="form-group">
                                    <input
                                        id="password-field-confirm"
                                        type="password"
                                        class="form-control"
                                        placeholder="Xác nhận Mật khẩu"
                                        name="confirm_pass"
                                        required
                                        autocomplete="current-password"
                                    />
                                    <span
                                        toggle="#password-field"
                                        class="fa fa-fw fa-eye field-icon toggle-password"
                                    ></span>
                                </div>
                            
                                <div class="form-group">
                                    <button
                                        type="submit"
                                        class="form-control btn btn-primary submit px-3"
                                    >
                                        Đăng ký
                                    </button>
                                </div>
                                <div class="form-group d-md-flex justify-content-center">
                                    
                                    
                                    <div class="w-50 text-center" style="font-size: 13px">
                                        <a href="/login" class="checkbox-primary"
                                            >Đăng nhập</a
                                        >
                                    </div>
                                   
                                </div>
                            </form>
                            {{-- <p class="w-100 text-center">
                                &mdash; Or Sign In With &mdash;
                            </p>
                            <div class="social d-flex text-center">
                                <a href="#" class="px-2 py-2 mr-md-1 rounded"
                                    ><span
                                        class="ion-logo-facebook mr-2"
                                    ></span>
                                    Facebook</a
                                >
                                <a href="#" class="px-2 py-2 ml-md-1 rounded"
                                    ><span class="ion-logo-twitter mr-2"></span>
                                    Twitter</a
                                >
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script src="/login-form-20/js/jquery.min.js"></script>
        <script src="/login-form-20/js/popper.js"></script>
        <script src="/login-form-20/js/bootstrap.min.js"></script>
        <script src="/login-form-20/js/main.js"></script>
    </body>
</html>


