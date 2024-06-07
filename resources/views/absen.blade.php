<x-layout>
  <!--  Row 1 -->
  <div class="row">
    <div class="col-lg-8 d-flex align-items-strech">
      <div class="card w-100">
        <div class="card-body">
          <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
            <div class="mb-3 mb-sm-0">
              <h5 class="card-title fw-semibold">Kelas</h5>
              <div class="row">
                @foreach ($kelases as $kls)
                <div class="col mt-4 d-flex justify-content-center">
                  <article class="card__kelas rounded">
                    <a href="{{ 'absen/' . $kls->nama_kelas }}" class="card__link">
                      <!-- Media -->
                      <div class="card__media">
                        <img src="../assets/images/blog/blog-img1.jpg">
                      </div>
                      <!-- Header -->
                      <div class="card__header">
                        <h3 class="card__header-title">Kelas {{ $kls->nama_kelas }}</h3>
                        <p class="card__header-meta">{{ $kls->nama_guru }}</p>
                        <div class="card__header-icon">
                          <svg viewbox="0 0 28 25">
                            <path fill="#00000"
                              d="M13.145 2.13l1.94-1.867 12.178 12-12.178 12-1.94-1.867 8.931-8.8H.737V10.93h21.339z" />
                          </svg>
                        </div>
                      </div>
                    </a>
                  </article>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 d-flex align-items-stretch">
      <div class="card w-100">
          <div class="card-body p-4">
              <div class="mb-4">
                  <h5 class="card-title fw-semibold">Jadwal Mengajar</h5>
              </div>
              <ul class="timeline-widget mb-0 position-relative mb-n5">
                @foreach($jadwalMengajars as $jadwal)
                <li class="timeline-item d-flex position-relative overflow-hidden" data-time="{{ $jadwal->waktu }}">
                    <div class="timeline-time mt-n1 text-muted flex-shrink-0 text-end">
                        {{ \Carbon\Carbon::createFromFormat('H:i:s', $jadwal->waktu)->format('H:i') }}
                    </div>
                    <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                        <span class="timeline-badge flex-shrink-0 mt-2"></span>
                        <span class="timeline-badge-border d-block flex-shrink-0"></span>
                    </div>
                    <div class="timeline-desc fs-3 text-dark mt-n1 fw-semibold">
                        <a href="{{ 'absen/' . $jadwal->nama_kelas }}">{{ $jadwal->deskripsi }} di {{ $jadwal->nama_kelas }}</a>
                    </div>
                </li>
            @endforeach            
              </ul>
          </div>
      </div>
  </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        const items = document.querySelectorAll('.timeline-item');
        items.forEach(item => {
            const dbTime = item.getAttribute('data-time'); // Ambil waktu dari atribut data-time
            
            // Buat objek Date dari waktu database
            const dbDate = new Date();
            const [hours, minutes, seconds] = dbTime.split(':').map(Number);
            dbDate.setHours(hours, minutes, seconds, 0);

            // Dapatkan waktu saat ini
            const now = new Date();

            // Hitung selisih waktu dalam menit
            const diffInMinutes = (dbDate - now) / 1000 / 60;

            // Ambil elemen untuk mengubah warna
            const badge = item.querySelector('.timeline-badge');
            const badgeBorder = item.querySelector('.timeline-badge-border');

            // Ubah warna berdasarkan kondisi selisih waktu
            if (diffInMinutes <= 30) {
              console.log(diffInMinutes);
                badge.style.backgroundColor = 'red';
                badgeBorder.style.borderColor = 'red';
            } else if (diffInMinutes <= 60) {
                badge.style.backgroundColor = 'yellow';
                badgeBorder.style.borderColor = 'yellow';
            } else if (diffInMinutes <= 90) {
                badge.style.backgroundColor = 'lightblue';
                badgeBorder.style.borderColor = 'lightblue';
            } else{
                badge.style.backgroundColor = 'blue';
                badgeBorder.style.borderColor = 'blue';
            }
        });
    });
</script>

</x-layout>