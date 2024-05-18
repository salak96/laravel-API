<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorial Laravel #20 : Eloquent Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Data Pegawai</h1>
        <a href="{{ route('karyawans.create') }}" class="btn btn-primary">Tambah</a>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Status</th>
                            <th>email</th>
                            <th>No_hp</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($karyawans as $karyawan)
                        <tr>
                            <td>{{ $karyawan->id }}</td>
                            <td>{{ $karyawan->nama }}</td>
                            <td>{{ $karyawan->jabatan }}</td>
                            <td>{{ $karyawan->status }}</td>
                            <td>{{ $karyawan->email }}</td>
                            <td>{{ $karyawan->no_hp }}</td>
                            <td>
                                <a href="{{ route('karyawans.edit', $karyawan->id) }}" class="btn btn-primary">Edit</a>
                                </td>
                                  <form onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="d-inline" action="/karyawans/{{ $karyawan->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <td>
                        <input type="submit" value="Delete" class="btn btn-danger">
                        </td>
                    </form>
                        </tr>
                                  
                        @endforeach
                        

                    </tbody>
                </table>
            </div>
        </div>
    </div>
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
