@extends('layout')
@section('content')
    <h2>Xây dựng quản lí users</h2>
    <br>
    <!-- Filter  -->
    <form id="frm_filter" action="{{ route('search') }}" method="GET">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-3">
                <label for="validationCustom01" class="form-label">Tên</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="validationCustom01" class="form-label">Email</label>
                <input type="text" name="email" class="form-control">
            </div>
        </div>
    </form>
    <br>
    <!-- Actions  -->
    <div>
        <a href="{{ route('addUser') }}">
            <button type="button" style="width:150px" class="btn btn-primary">Thêm mới</button>
        </a>
        <button type="submit" form="frm_filter" class="btn btn-primary mb-3 pull-right">Tìm kiếm</button>
    </div>
    <br>
    <br>
    <br>

    <div class="col-6">
        <h5>Danh sách người dùng</h5>
    </div>
    <!-- User Table-->
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Họ tên</th>
                    <th scope="col">Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allUsers as $users)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $users->name }}</td>
                        <td>{{ $users->email }}</td>
                        <td>
                            <a href="{{ route('editUser', $users->id) }}" class="active" ui-toggle-class="">
                                <i class="fa fa-edit blue-color"></i></a>
                            <form id="frm_filter" action="{{ route('deleteUser', $users->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="active"><i class="fa fa-trash"></i></button>
                                <form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Pagination-->
        <div class="text-center">
            <ul class="pagination justify-content-center">
                {{ $allUsers->links() }}
            </ul>
        </div>
    </div>
@endsection
