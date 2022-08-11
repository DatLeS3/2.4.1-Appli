@extends ('layout')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <h2> Thêm người dùng </h2>
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{ route('postAddUser') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <br>
                            <label for="exampleInputEmail1">Tên:</label>
                            <input type="name" name="name" class="form-control" id="exampleInputEmail1"
                                placeholder="Nhập tên">
                            @error('name')
                            <div class="text-danger">- {{ $message }}</div>
                            @enderror
                            <br>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email:</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                placeholder="Nhập email">
                            @error('email')
                            <div class="text-danger">- {{ $message }}</div>
                            @enderror
                            <br>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password:</label>
                            <input type="password" name="password" class="form-control" id="exampleInputEmail1"
                                placeholder="Nhập email">
                            @error('password')
                            <div class="text-danger">- {{ $message }}</div>
                            @enderror
                            <br>
                        </div>

                        <a onclick="return confirm('Bạn muốn về trang quản lí users?')"
                            href="{{ route('listUsers') }}" class="btn btn-info">Hủy</a>
                        <button type="submit" name="addUsers" class="btn btn-info">Lưu</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection