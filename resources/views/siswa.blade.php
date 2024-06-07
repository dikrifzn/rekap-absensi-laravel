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
              <div class="col-3">
                <!-- Search -->
                <div class="input-group mb-3">
                  <div class="input-group-text">
                    <iconify-icon icon="material-symbols:search" width="1.5rem" height="1.5rem"  style="color: black"></iconify-icon>
                  </div>
                  <input type="text" placeholder="cari" class="form-control" aria-label="Text input with checkbox">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="table-responsive">
                <table class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th class="col-1 text-black" scope="col">#</th>
                      <th class="col-1 text-black" scope="col">NIS</th>
                      <th class="text-black" scope="col">Nama</th>
                      <th class="text-center text-black" scope="col">Gender</th>
                      <th class="text-center text-black" scope="col">Kelas</th>
                      <th class="col-1 text-center text-black" scope="col">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($siswas as $siswa)
                    <tr class="table-row" data-nis="{{ $siswa->nis }}" data-nama="{{ $siswa->nama }}"
                      data-jk="{{ $siswa->jk }}" data-id_kelas="{{ $siswa->id }}" data-status="{{ $siswa->status }}">
                      <th class="text-black" scope="row">{{ $loop->iteration }}</th>
                      <td class="text-black">{{ $siswa->nis }}</td>
                      <td class="text-black">{{ $siswa->nama }}</td>
                      <td class="text-center text-black">{{ $siswa->jk }}</td>
                      <td class="text-center text-black">{{ $siswa->nama_kelas }}</td>
                      <td class="text-center text-white">
                        @if($siswa->status == 'Aktif')
                        <span class="bg-success rounded-pill d-block w-100 py-1 px-4">{{ $siswa->status }}</span>
                        @else
                        <span class="bg-danger rounded-pill d-block w-100 py-1 px-4">{{ $siswa->status }}</span>
                        @endif
                      </td>
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
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Siswa</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('siswa.store') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="nis" class="form-label">NIS</label>
              <input type="text" class="form-control" id="nis" name="nis">
            </div>
            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama">
            </div>
            <div class="input-group mb-3">
              <label class="input-group-text" for="jk">Jenis Kelamin</label>
              <select class="form-select" id="jk" name="jk">
                <option value="L" selected>Laki-laki</option>
                <option value="P">Perempuan</option>
              </select>
            </div>
            <div class="input-group mb-3">
              <label class="input-group-text" for="kelas">Kelas</label>
              <select class="form-select" id="kelas" name="id_kelas">
                @foreach ($kelases as $kelas)
                <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                @endforeach
              </select>
            </div>
            <div class="input-group mb-3">
              <label class="input-group-text" for="status">Status</label>
              <select class="form-select" id="status" name="status">
                <option value="Aktif" selected>Aktif</option>
                <option value="Nonaktif">Nonaktif</option>
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
          <h1 class="modal-title fs-5" id="editModalLabel">Edit Siswa</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="editForm" action="" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
              <label for="edit-nis" class="form-label">NIS</label>
              <input type="text" class="form-control" id="edit-nis" name="nis">
            </div>
            <div class="mb-3">
              <label for="edit-nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="edit-nama" name="nama">
            </div>
            <div class="input-group mb-3">
              <label class="input-group-text" for="edit-jk">Jenis Kelamin</label>
              <select class="form-select" id="edit-jk" name="jk">
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
              </select>
            </div>
            <div class="input-group mb-3">
              <label class="input-group-text" for="edit-kelas">Kelas</label>
              <select class="form-select" id="edit-kelas" name="id_kelas">
                @foreach ($kelases as $kelas)
                <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                @endforeach
              </select>
              </select>
            </div>
            <div class="input-group mb-3">
              <label class="input-group-text" for="edit-status">Status</label>
              <select class="form-select" id="edit-status" name="status">
                <option value="Aktif">Aktif</option>
                <option value="Nonaktif">Nonaktif</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          </form>
          <form id="hapusEdit" class="position-absolute" style="top: 86.8%; left: 36%;" action="" method="POST">
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
          var nis = this.getAttribute('data-nis');
          var nama = this.getAttribute('data-nama');
          var jk = this.getAttribute('data-jk');
          var idKelas = this.getAttribute('data-id_kelas');
          var status = this.getAttribute('data-status');
          var form = document.getElementById('editForm');
          var actionEdit = "{{ route('siswa.update', 'nis_placeholder') }}".replace('nis_placeholder',nis);
          form.action = actionEdit;
          document.getElementById('edit-nis').value = nis;
          document.getElementById('edit-nama').value = nama;
          document.getElementById('edit-jk').value = jk;
          document.getElementById('edit-kelas').value = idKelas;
          document.getElementById('edit-status').value = status;
          var hapusEdit = "{{ route('siswa.destroy', 'nis') }}".replace('nis', nis);
          document.getElementById('hapusEdit').action = hapusEdit;
          var editModal = new bootstrap.Modal(document.getElementById('editModal'));
          editModal.show();
        });
      });
    });
  </script>
</x-layout>