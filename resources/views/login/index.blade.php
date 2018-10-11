@extends("layout.main")
@section("title")
    登录页面
@endsection

@section("content")

    <form class="form-signin" method="POST" action="/login">
        {{csrf_field()}}
        <h2 class="zh">请登录</h2>
        <div class="content-wrap">
            <div>
                <span class="zh">邮箱</span>
                <input type="email" name="email" id="inputEmail" class="input" placeholder="Email address" required autofocus>
            </div>
            <div>
                <span class="zh">密码</span>
                <input type="password" name="password" id="inputPassword" class="input" placeholder="Password" required>
            </div>

            @include('layout.error')
            <button class="box box1 zh" type="submit">登录</button>
            <a href="/register" class="box box1 zh" type="submit">去注册</a>
        </div>

    </form>

@endsection