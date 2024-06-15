<x-layout>
  <div class="row">
    <div class="card">
      <div class="card-body">
        <div class="mb-3 mb-sm-0">
          <h5 class="card-title fw-semibold">Kelas</h5>
          <div class="table-responsive">
            <form action="/absenAdd" method="POST">
              <table class="table table-striped table-hover">
                @csrf
                <div class="d-flex justify-content-center">
                  <div class="row w-100 justify-content-between">
                    <div class="col-12 col-md p-0">
                      <div class="input-group mb-3">
                        <span class="input-group-text rounded-start" id="inputGroup-sizing-default">Tanggal</span>
                        <input type="date" class="form-control rounded-0" name="tanggal"
                          aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                      </div>
                    </div>
                    <div class="col-12 col-md p-0">
                      <div class="input-group">
                        <label class="input-group-text rounded-0" for="pelajaranSelect">Pelajaran</label>
                        <select class="form-select rounded-0 rounded-end" id="pelajaranSelect" name="matapelajaran">
                          @foreach ($pelajarans as $pelajaran)
                          <option value="{{ $pelajaran->id }}">{{ $pelajaran->nama_pelajaran }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <thead>
                  <tr>
                    <th class="col-1 text-center text-black" scope="col">#</th>
                    <th class="text-black" scope="col">NIS</th>
                    <th class="text-black" scope="col">Nama</th>
                    <th class="col-1 text-center text-black" scope="col">Hadir</th>
                    <th class="col-1 text-center text-black" scope="col">Sakit</th>
                    <th class="col-1 text-center text-black" scope="col">Izin</th>
                    <th class="col-1 text-center text-black" scope="col">Alpha</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($rekapSiswas as $rekapSiswa)
                  <tr>
                    <th class="col-1 text-center text-black" scope="row">{{ $loop->iteration }}</th>
                    <td class="col-2 text-black">{{ $rekapSiswa->nis }}</td>
                    <td class="col-5 text-black">{{ $rekapSiswa->nama }}</td>
                    <input type="hidden" value="{{ $rekapSiswa->nis }}" name="nis[]" checked>
                    <td class="col-1 text-center">
                      <input class="form-check-input" type="radio" value="Hadir" name="{{ $rekapSiswa->nis }}_status"
                        checked>
                    </td>
                    <td class="col-1 text-center">
                      <input class="form-check-input" type="radio" value="Sakit" name="{{ $rekapSiswa->nis }}_status">
                    </td>
                    <td class="col-1 text-center">
                      <input class="form-check-input" type="radio" value="Izin" name="{{ $rekapSiswa->nis }}_status">
                    </td>
                    <td class="col-1 text-center">
                      <input class="form-check-input" type="radio" value="Alpha" name="{{ $rekapSiswa->nis }}_status">
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="d-grid gap-2">
                <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    function getToday() {
      const today = new Date();
      const year = today.getFullYear();
      const month = String(today.getMonth() + 1).padStart(2, '0');
      const day = String(today.getDate()).padStart(2, '0');
      return `${year}-${month}-${day}`;
    }
    var inputtgl = document.getElementsByName('tanggal');
    inputtgl.forEach(function(i, j) {
      i.value = getToday();
    });
  </script>
</x-layout>