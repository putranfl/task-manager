@extends('layouts.app')

@section('title', 'Tambah Tugas Baru')

@section('content')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="text-primary">Tambah Tugas Baru</h2>
        <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Nama Tugas:</label>
                <input type="text" name="name" class="form-control" required>
                @error('name')
                    <p class="text-danger">Wajib Diisi</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Deskripsi:</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="image">Gambar:</label>
                <input type="file" name="image" class="form-control-file">
                @error('image')
                    <p class="text-danger">Harus berupa file gambar (JPG, PNG, atau GIF)</p>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
        
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Tugas</a> <!-- Tombol Kembali -->
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
@endsection
