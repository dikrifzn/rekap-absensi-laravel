<x-layout>
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <div class="mb-3 mb-sm-0">
            <div class="row">
              <div class="col">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Tambah Data +
                </button>
              </div>
            </div>
            <div class="row">
              <div class="table-responsive">
                <table class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th class="col-1 text-black" scope="col">#</th>
                      <th class="col text-black" scope="col">Waktu</th>
                      <th class="col text-black" scope="col">Deskripsi</th>
                      <th class="col text-black" scope="col">Kelas</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($jadwalMengajars as $jadwalMengajar)
                    <tr class="table-row" data-id="{{ $jadwalMengajar->id }}" data-waktu="{{ $jadwalMengajar->waktu }}"
                      data-deskripsi="{{ $jadwalMengajar->deskripsi }}" data-id_kelas="{{ $jadwalMengajar->id_kelas }}"
                      data-nama_kelas="{{ $jadwalMengajar->nama_kelas }}">
                      <th class="text-black" scope="row">{{ $loop->iteration }}</th>
                      <td class="text-black">
                        {{ \Carbon\Carbon::createFromFormat('H:i:s', $jadwalMengajar->waktu)->format('H:i') }}</td>
                      <td class="text-black">{{ $jadwalMengajar->deskripsi }}</td>
                      <td class="text-black">{{ $jadwalMengajar->nama_kelas }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Guru</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('jadwal.store') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="waktu" class="form-label">Waktu</label>
              <input type="time" class="form-control" id="waktu" name="waktu">
            </div>
            <div class="mb-3">
              <label for="deskripsi" class="form-label">Deskripsi</label>
              <input type="text" class="form-control" id="deskripsi" name="deskripsi">
            </div>
            <div class="input-group mb-3">
              <label class="input-group-text" for="kelas">Kelas</label>
              <select class="form-select" id="kelas" name="id_kelas">
                @foreach ($kelases as $kelas)
                <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                @endforeach
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editModalLabel">Edit Kelas</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="editForm" action="" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
              <div class="mb-3">
                <label for="edit-waktu" class="form-label">Waktu</label>
                <input type="time" class="form-control" id="edit-waktu" name="waktu">
              </div>
              <div class="mb-3">
                <label for="edit-deskripsi" class="form-label">Deskripsi</label>
                <input type="text" class="form-control" id="edit-deskripsi" name="deskripsi">
              </div>
              <div class="input-group mb-3">
                <label class="input-group-text" for="edit-kelas">Kelas</label>
                <select class="form-select" id="edit-kelas" name="id_kelas">
                  @foreach ($kelases as $kelas)
                  <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                  @endforeach
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          </form>
          <form id="hapusEdit" class="position-absolute" style="top: 77%; left: 36%;" action="" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Hapus</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var tableRows = document.querySelectorAll('.table-row');
      tableRows.forEach(function(row) {
        row.addEventListener('click', function() {
          var id = this.getAttribute('data-id');
          var waktu = this.getAttribute('data-waktu');
          var deskripsi = this.getAttribute('data-deskripsi');
          var id_kelas = this.getAttribute('data-id_kelas');
          var nama_kelas = this.getAttribute('data-nama_kelas');
          var form = document.getElementById('editForm');
          var actionEdit = "{{ route('jadwal.update', 'id') }}".replace('id', id);
          form.action = actionEdit;
          document.getElementById('edit-waktu').value = waktu;
          document.getElementById('edit-deskripsi').value = deskripsi;
          document.getElementById('edit-kelas').value = id_kelas;
          var hapusEdit = "{{ route('jadwal.destroy', 'id') }}".replace('id', id);
          document.getElementById('hapusEdit').action = hapusEdit;
          var editModal = new bootstrap.Modal(document.getElementById('editModal'));
          editModal.show();
        });
      });
    });
  </script>
</x-layout>