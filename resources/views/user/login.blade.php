@extends('user_layout')
@section('title')
    LexeShop - Đăng nhập
@endsection
@section('content')
    <section id="form">
        <!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form">
                        <!--login form-->
                        <h2>Đăng nhập tài khoản của bạn</h2>
                        <form action="#">
                            <input type="text" placeholder="Tên tài khoản" />
                            <input type="password" placeholder="Mật khẩu" />
                            <button type="submit" class="btn btn-default">Đăng Nhập</button>
                        </form>
                    </div>
                    <!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">hoặc</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form">
                        <!--sign up form-->
                        <h2>Đăng ký tài khoản!</h2>
                        <form action="#">
                            <input type="text" placeholder="Họ và tên" />
                            <input type="email" placeholder="Email của bạn" />
                            <input type="password" placeholder="Mật khẩu" />
                            <button type="submit" class="btn btn-default">Đăng Ký</button>
                        </form>
                    </div>
                    <!--/sign up form-->
                </div>
            </div>
        </div>
    </section>
    <!--/form-->
@endsection
