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
                            <h3 class="mb-4 text-center">Xin chào</h3>
                            @if ($errors->any())
                                <div class="alert alert-danger">{{ $errors->first() }}</div>
                            @endif
                            
                            
                            <form
                                action="{{ route('login.submit') }}"
                                class="signin-form"
                                method="POST"
                            >
                                @csrf
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
                                    <button
                                        type="submit"
                                        class="form-control btn btn-primary submit px-3"
                                    >
                                        Đăng nhập
                                    </button>
                                </div>
                                <div class="form-group d-md-flex">
                                    <div class="w-50">
                                        <label
                                            class="checkbox-wrap checkbox-primary"
                                            >Ghi nhớ
                                            <input type="checkbox" checked name="remember_token "/>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    
                                    <div class="w-50 text-md-right">
                                        <a href="{{route('register_index')}}" class="checkbox-primary"
                                            >Đăng ký hội viên</a
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


