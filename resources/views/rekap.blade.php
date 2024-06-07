<x-layout>
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <div class="mb-3 mb-sm-0">
            <div class="row gx-3">
              <div class="col-12 col-md p-0 mb-3">
                <div class="input-group">
                  <label class="input-group-text rounded-0 rounded-start" for="kelasSelect">Kelas</label>
                  <select class="form-select rounded-0" id="kelasSelect">
                    <option selected>A1</option>
                    <option value="1">A2</option>
                    <option value="2">B1</option>
                    <option value="3">B2</option>
                  </select>
                </div>
              </div>
              <div class="col-12 col-md p-0 mb-3">
                <div class="input-group">
                  <label class="input-group-text rounded-0" for="pelajaranSelect">Pelajaran</label>
                  <select class="form-select rounded-0" id="pelajaranSelect">
                    <option selected>Fiqih</option>
                    <option value="1">Al-Quran</option>
                    <option value="2">Hadits</option>
                    <option value="3">Akhlaq</option>
                  </select>
                </div>
              </div>
              <div class="col-12 col-md p-0 mb-3">
                <div class="input-group">
                  <label class="input-group-text rounded-0" for="pelajaranSelect">Bulan</label>
                  <select class="form-select rounded-0 rounded-end" id="pelajaranSelect">
                    <option selected>Januari</option>
                    <option value="1">Februari</option>
                    <option value="2">Maret</option>
                    <option value="3">April</option>
                  </select>
                </div>
              </div>
            </div>
            <h5 class="card-title fw-semibold mt-3">Kelas A1</h5>
            <div class="row">
              <div class="col">
                <button class="btn btn-info text-white">Download Rekap</button>
              </div>
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th class="col-1 text-black" scope="col">#</th>
                      <th class="col-1 text-black" scope="col">NIS</th>
                      <th class="text-black" scope="col">Nama</th>
                      <th class="text-center text-black" scope="col">Kelas</th>
                      <th class="col-1 text-center text-black" scope="col">Hadir</th>
                      <th class="col-1 text-center text-black" scope="col">Sakit</th>
                      <th class="col-1 text-center text-black" scope="col">Izin</th>
                      <th class="col-1 text-center text-black" scope="col">Alpha</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($kehadirans as $kehadiran)
                    <tr>
                      <th class="text-black" scope="row">{{ $loop->iteration }}</th>
                      <td class="text-black">{{ $kehadiran->nis }}</td>
                      <td class="text-black">{{ $kehadiran->nama }}</td>
                      <td class="text-center text-black">{{ $kehadiran->nama_kelas }}</td>

                      <td class="text-center text-black">{{ $kehadiran->hadir }}</td>
                      @php
                      $sakitColor = ($kehadiran->sakit > 3) ? 'text-danger fw-bold' : 'text-black';
                      $izinColor = ($kehadiran->izin > 3) ? 'text-danger fw-bold' : 'text-black';
                      $alphaColor = ($kehadiran->alpha > 3) ? 'text-danger fw-bold' : 'text-black';
                      @endphp
                      <td class="text-center {{ $sakitColor }}">{{ $kehadiran->sakit }}</td>
                      <td class="text-center {{ $izinColor }}">{{ $kehadiran->izin }}</td>
                      <td class="text-center {{ $alphaColor }}">{{ $kehadiran->alpha }}</td>
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
</x-layout>