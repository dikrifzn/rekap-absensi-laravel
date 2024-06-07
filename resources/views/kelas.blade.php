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
                        <th class="col text-black" scope="col">Kelas</th>
                        <th class="col text-black" scope="col">Guru Pengampu</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($kelases as $kelas)
                      <tr class="table-row" data-id="{{ $kelas->id }}" data-nama_kelas="{{ $kelas->nama_kelas }}" data-nuptk="{{ $kelas->nuptk }}">
                        <th class="text-black" scope="row">{{ $loop->iteration }}</th>
                        <td class="text-black">{{ $kelas->nama_kelas }}</td>
                        <td class="text-black">{{ $kelas->nama_guru }}</td>
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
            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kelas</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{ route('kelas.store') }}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="nama_kelas" class="form-label">Kelas</label>
                <input type="text" class="form-control" id="nama_kelas" name="nama_kelas">
              </div>
              <div class="mb-3">
                <label for="guru" class="form-label">Guru Pengampu</label>
                <select class="form-select" id="guru" name="id_guru">
                  @foreach ($gurus as $guru)
                  <option value="{{ $guru->nuptk }}">{{ $guru->nama_guru }}</option>
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
                <label for="edit-nama_kelas" class="form-label">Kelas</label>
                <input type="text" class="form-control" id="edit-nama_kelas" name="nama_kelas">
              </div>
              <div class="mb-3">
                <label for="edit-guru" class="form-label">Guru Pengampu</label>
                <select class="form-select" id="edit-nuptk" name="id_guru">
                  @foreach ($gurus as $guru)
                  <option value="{{ $guru->nuptk }}">{{ $guru->nama_guru }}</option>
                  @endforeach
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
            <form id="hapusEdit" class="position-absolute" style="top: 83%; left: 36%;" action="" method="POST">
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
            var nama_kelas = this.getAttribute('data-nama_kelas');
            var nuptk = this.getAttribute('data-nuptk');
            var form = document.getElementById('editForm');
            var actionEdit = "{{ route('kelas.update', 'id_placeholder') }}".replace('id_placeholder', id);
            form.action = actionEdit;

            document.getElementById('edit-id').value = id;
            document.getElementById('edit-nama_kelas').value = nama_kelas;
            document.getElementById('edit-nuptk').value = nuptk;
            var hapusEdit = "{{ route('kelas.destroy', 'id') }}".replace('id', id);
            document.getElementById('hapusEdit').action = hapusEdit;
            var editModal = new bootstrap.Modal(document.getElementById('editModal'));
            editModal.show();
          });
        });
      });
    </script>
  </x-layout>