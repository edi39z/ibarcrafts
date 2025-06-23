<h1>Berita</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>no</th>
            <th>Judul</th>
            <th>Link</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $nomor = 1;
        $ambil = $koneksi->query("SELECT * FROM berita");

        while ($pecah = $ambil->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $nomor; ?></td>
                <td><?php echo $pecah['judul_berita']; ?></td>
                <td><?php echo $pecah['link_berita']; ?></td>
                <td>
                    <img src="../<?php echo $pecah['foto_berita']; ?>" width="100">
                </td>
                <td>
                    <a href="index.php?halaman=hapusberita&id=<?php echo $pecah['id_berita']; ?>" class="btn btn-danger"><i class="glyphicon-trash"></i>Hapus</a>
                    <a href="index.php?halaman=ubahberita&id=<?php echo $pecah['id_berita']; ?>" class="btn btn-warning"><i class="glyphicon-edit"></i>Ubah</a>
                </td>
            </tr>
            <?php
            $nomor++;
        }
        ?>
    </tbody>
</table>

<a href="index.php?halaman=tambahberita" class="btn btn-primary">Tambah berita</a>
