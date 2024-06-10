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
                      <th class="col text-black" scope="col">Nama Pelajaran</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($pelajarans as $pelajaran)
                    <tr class="table-row" data-id="{{ $pelajaran->id }}" data-nama="{{ $pelajaran->nama_pelajaran }}">
                      <th class="text-black" scope="row">{{ $loop->iteration }}</th>
                      <td class="text-black">{{ $pelajaran->nama_pelajaran }}</td>
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
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pelajaran</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('pelajaran.store') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="nama_pelajaran" class="form-label">Nama Pelajaran</label>
              <input type="text" class="form-control" id="nama_pelajaran" name="nama_pelajaran">
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
          <h1 class="modal-title fs-5" id="editModalLabel">Edit Pelajaran</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="editForm" action="" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
              <div class="mb-3">
                <label for="edit-nama_pelajaran" class="form-label">Nama Pelajaran</label>
                <input type="time" class="form-control" id="edit-nama_pelajaran" name="nama_pelajaran">
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
          var nama_pelajaran = this.getAttribute('data-nama_pelajaran');
          var form = document.getElementById('editForm');
          var actionEdit = "{{ route('pelajaran.update', 'id') }}".replace('id', id);
          form.action = actionEdit;
          document.getElementById('edit-nama_pelajaran').value = nama_pelajaran;
          var hapusEdit = "{{ route('pelajaran.destroy', 'id') }}".replace('id', id);
          document.getElementById('hapusEdit').action = hapusEdit;
          var editModal = new bootstrap.Modal(document.getElementById('editModal'));
          editModal.show();
        });
      });
    });
  </script>
</x-layout>