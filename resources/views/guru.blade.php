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
                      <th class="col text-black" scope="col">NUPTK</th>
                      <th class="col text-black" scope="col">Nama Guru</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($gurus as $guru)
                    <tr class="table-row" data-nuptk="{{ $guru->nuptk }}" data-nama_guru="{{ $guru->nama_guru }}">
                      <th class="text-black" scope="row">{{ $loop->iteration }}</th>
                      <td class="text-black">{{ $guru->nuptk }}</td>
                      <td class="text-black">{{ $guru->nama_guru }}</td>
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
          <form action="{{ route('guru.store') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="nuptk" class="form-label">NUPTK</label>
              <input type="text" class="form-control" id="nuptk" name="nuptk">
            </div>
            <div class="mb-3">
              <label for="nama_guru" class="form-label">Nama Guru</label>
              <input type="text" class="form-control" id="nama_guru" name="nama_guru">
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
              <label for="edit-nuptk" class="form-label">NUPTK</label>
              <input type="text" class="form-control" id="edit-nuptk" name="nuptk">
            </div>
            <div class="mb-3">
              <label for="edit-nama_guru" class="form-label">Nama Guru</label>
              <input type="text" class="form-control" id="edit-nama_guru" name="nama_guru">
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
          var nuptk = this.getAttribute('data-nuptk');
          var nama_guru = this.getAttribute('data-nama_guru');
          var form = document.getElementById('editForm');
          var actionEdit = "{{ route('guru.update', 'nuptk_placeholder') }}".replace('nuptk_placeholder',
            nuptk);
          form.action = actionEdit;
          document.getElementById('edit-nuptk').value = nuptk;
          document.getElementById('edit-nama_guru').value = nama_guru;
          var hapusEdit = "{{ route('guru.destroy', 'nuptk') }}".replace('nuptk', nuptk);
          document.getElementById('hapusEdit').action = hapusEdit;
          var editModal = new bootstrap.Modal(document.getElementById('editModal'));
          editModal.show();
        });
      });
    });
  </script>
</x-layout>