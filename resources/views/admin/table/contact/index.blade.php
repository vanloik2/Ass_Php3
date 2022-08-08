@extends('admin.layout.index')
@section('content')
<div>
    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
</div>
    <div class="card">
        <div class="card-header">
            <form action="" method="get">
                <div class="row row-cols-auto">
                    <div class="col input-group">
                        <input type="text" value="" class="form-control" name="txt_search">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-success">Refresh</button>
                    </div>
                    <div class="col">
                        {{-- <a href="" class="btn btn-primary">Add</a> --}}
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-hover table-stripped table-bcontacted text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên người dùng</th>
                        <th>Email</th>
                        <th>Chủ đề</th>
                        <th>Nội dung</th>
                        <th>Xử lí</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $index => $contact)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->subject }}</td>
                            <td>{{ $contact->message }}</td>
                            <td>
                                {{-- <a href="{{ route('contact.edit', $contact->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-gear"></i></a> --}}
                                <form action="{{ route('contact.destroy', $contact->id) }}" method="post"
                                    style="display: inline-block" onsubmit="return confirm('Xác nhận xóa!!!')">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash3"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <div>{{ $contacts->links() }}</div>
        </div>
    </div>
@endsection
