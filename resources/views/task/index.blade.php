@extends('layouts.app')

@section('title', 'Daftar Tugas')

@section('content')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <a href="{{ route('tasks.create') }}" class="btn btn-success mb-3">Tambah</a>
        <form method="GET" action="{{ route('tasks.index') }}" class="mb-3">
            <div class="input-group mb-3">
                <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Cari berdasarkan nama">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </div>
        </form>
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Nama Tugas</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->description }}</td>
                    <td>
                        <span class="badge badge-success">{{ $task->status }}</span>
                    </td>
                    <td>
                        <form id="complete-form-{{ $task->id }}" action="{{ route('tasks.complete', ['id' => $task->id]) }}" method="POST">
                            @csrf
                            <button class="btn btn-primary mark-complete" data-task-id="{{ $task->id}}" {{ $task->status === 'completed' ? 'disabled' : '' }}>
                                Tandai Selesai
                            </button>
                        </form>
                    </td>                    
                </tr>
                @endforeach
            </tbody>
        </table>
        <ul class="pagination">
            <li class="page-item {{ $tasks->currentPage() == 1 ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $tasks->previousPageUrl() }}">Sebelumnya</a>
            </li>
            @for ($i = 1; $i <= $tasks->lastPage(); $i++)
                <li class="page-item {{ $tasks->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $tasks->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
            <li class="page-item {{ $tasks->currentPage() == $tasks->lastPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $tasks->nextPageUrl() }}">Selanjutnya</a>
            </li>
        </ul>
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".mark-complete").click(function() {
                var button = $(this);
                var taskId = button.data("task-id");
                var token = $('meta[name="csrf-token"]').attr('content');
    
                $.ajax({
                    type: "POST",
                    url: "/tasks/" + taskId + "/complete",
                    data: {
                        _token: token
                    },
                    success: function(response) {
                        if (response.status === "success") {
                            button.closest("tr").find(".badge-success").text("completed");
                        }
                    }
                });
            });
        });
    </script>    
</body>
@endsection