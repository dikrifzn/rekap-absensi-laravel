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
              @foreach ($kelases as $index => $kelas)
              @php
              $gambarIndex = $index % 3 + 1;
              @endphp
              <div id="card" class="col mt-4 d-flex justify-content-center" data-id="{{ $kelas->id }}"
                data-nama_kelas="{{ $kelas->nama_kelas }}" data-nuptk="{{ $kelas->nuptk }}">
                <article class="card__kelas rounded">
                  <div class="card__media">
                    <img src="{{ $kelas->gambar ?? '../assets/images/blog/blog-img'. $gambarIndex .'.jpg' }}"
                      alt="Gambar Kelas">
                  </div>
                  <div class="card__header">
                    <h3 class="card__header-title">Kelas {{ $kelas->nama_kelas }}</h3>
                    <p class="card__header-meta">{{ $kelas->nama_guru }}</p>
                    <div class="card__header-icon">
                      <svg viewbox="0 0 28 25">
                        <path fill="#00000"
                          d="M13.145 2.13l1.94-1.867 12.178 12-12.178 12-1.94-1.867 8.931-8.8H.737V10.93h21.339z" />
                      </svg>
                    </div>
                  </div>
                </article>
              </div>
              @endforeach
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
            <form action="{{ route('kelas.store') }}" method="POST" enctype="multipart/form-data">
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
              <div class="mb-3">
                <label for="gambar" class="form-label">Gambar *opsional</label>
                <input type="file" class="form-control" id="gambar" name="gambar">
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
            <form id="editForm" action="" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="mb-3">
                <label for="edit-nama_kelas" class="form-label">Kelas</label>
                <input type="text" class="form-control" id="edit-nama_kelas" name="nama_kelas">
              </div>
              <div class="mb-3">
                <label for="edit-nuptk" class="form-label">Guru Pengampu</label>
                <select class="form-select" id="edit-nuptk" name="nuptk">
                  @foreach ($gurus as $guru)
                  <option value="{{ $guru->nuptk }}">{{ $guru->nama_guru }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-3">
                <label for="edit-gambar" class="form-label">Gambar *opsional</label>
                <input type="file" class="form-control" id="edit-gambar" name="gambar">
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
        var cards = document.querySelectorAll('#card');
        cards.forEach(function(card) {
          card.addEventListener('click', function() {
            var data_id = this.getAttribute('data-id');
            var nama_kelas = this.getAttribute('data-nama_kelas');
            var nuptk = this.getAttribute('data-nuptk');
            var form = document.getElementById('editForm');
            var actionEdit = "{{ route('kelas.update', 'id') }}".replace('id', data_id);
            form.action = actionEdit;
            document.getElementById('edit-nama_kelas').value = nama_kelas;
            document.getElementById('edit-nuptk').value = nuptk;
            var hapusEdit = "{{ route('kelas.destroy', 'id') }}".replace('id', data_id);
            document.getElementById('hapusEdit').action = hapusEdit;
            var editModal = new bootstrap.Modal(document.getElementById('editModal'));
            editModal.show();
          });
        });
      });
    </script>
</x-layout>