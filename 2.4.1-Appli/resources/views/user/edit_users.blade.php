@extends ('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <h2> Chỉnh sửa người dùng </h2>
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{ route('updateUser', $user->id) }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <br>
                                <label for="exampleInputEmail1">Tên:</label>
                                <input type="name" value="{{ $user->name }}" name="name" class="form-control"
                                    id="exampleInputEmail1" placeholder="Nhập tên">
                                <br>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email:</label>
                                <input type="email" value="{{ $user->email }}" name="email" class="form-control"
                                    id="exampleInputEmail1" placeholder="Nhập email">
                                <br>
                            </div>
                            <button type="submit" class="btn btn-info">Hủy</button>
                            <button type="submit" name="addUsers" class="btn btn-info">Lưu</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    @endsection
