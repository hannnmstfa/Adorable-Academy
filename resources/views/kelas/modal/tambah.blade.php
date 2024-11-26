<!-- Modal Tambah Kelas -->
<div class="modal fade" id="tambahKelasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kelas Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('kelas.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="namaKelas" class="form-label">Nama Kelas</label>
                        <input type="text" class="form-control" id="namaKelas" name="nama" placeholder="Masukkan nama kelas" required>
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select name="kategori" id="kategori" class="form-select">
                            <option value="" selected>Silahkan pilih Kategori</option>
                            <option value="Bussiness">Bussiness</option>
                            <option value="Art">Art</option>
                            <option value="Entertainment">Entertainment</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsiKelas" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsiKelas" name="deskripsi" rows="3" placeholder="Masukkan deskripsi kelas" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="fotoKelas" class="form-label">Foto Kelas</label>
                        <input type="file" class="form-control" id="fotoKelas" name="foto" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" name="harga" id="harga" class="form-control" placeholder="Masukkan Harga tanpa tanda pemisah. Cth 15000" required>
                    </div>
                    <div class="mb-3">
                        <label for="fakeharga" class="form-label">Harga Fake</label>
                        <input type="text" name="fakeharga" id="fakeharga" class="form-control" placeholder="Masukkan Harga tanpa tanda pemisah. Cth 15000">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>