<!-- Modal Edit --->
<div class="modal fade" id="edit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Edit Kelas</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="formedit" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Kelas</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama kelas" required>
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select name="kategori" id="datakategori" class="form-select">
                            <option value="" selected>Silahkan pilih Kategori</option>
                            <option value="Bussiness">Bussiness</option>
                            <option value="Art">Art</option>
                            <option value="Entertainment">Entertainment</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsiKelas" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsikelas" name="deskripsi" rows="3" placeholder="Masukkan deskripsi kelas" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="fotoKelas" class="form-label">Foto Kelas</label>
                        <input type="file" class="form-control" id="fotokelas" name="foto">
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" name="harga" id="dataharga" class="form-control" placeholder="Masukkan Harga tanpa tanda pemisah. Cth 15000" required>
                    </div>
                    <div class="mb-3">
                        <label for="fakeharga" class="form-label">Harga Fake</label>
                        <input type="text" name="fakeharga" id="fake" class="form-control" placeholder="Masukkan Harga tanpa tanda pemisah. Cth 15000">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle edit button click
        document.querySelectorAll('.edit-button').forEach(button => {
            button.addEventListener('click', function() {
                const nama = this.getAttribute('nama');
                const harga = this.getAttribute('harga');
                const kategori = this.getAttribute('kategori');
                const deskripsi = this.getAttribute('deskripsi');
                const fake = this.getAttribute('fakeharga');
                const url = this.getAttribute('data-route');

                document.getElementById('formedit').action = url;
                document.getElementById('nama').value = nama;
                document.getElementById('dataharga').value = harga;
                document.getElementById('deskripsikelas').value = deskripsi;
                document.getElementById('fake').value = fake;

                // Set dropdown kategori
                const kategoriDropdown = document.getElementById('datakategori');
                Array.from(kategoriDropdown.options).forEach(option => {
                    option.selected = option.value === kategori;
                });
            });
        });
    });
</script>