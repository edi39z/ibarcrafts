

<h2>Data Pelanggan</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>No.Telepon</th>
            <th>Password</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $ambil = $koneksi->query("SELECT * FROM pelanggan");  ?>
            <?php $nomor=1; ?>
            <?php while($pecah = $ambil->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama_pelanggan']; ?></td>
            <td><?php echo $pecah['email_pelanggan']; ?></td>
            <td><?php echo $pecah['telepon_pelanggan']; ?></td>
            <td><?php echo $pecah['password_pelanggan']; ?></td>
            <td> 
                <img src="../foto_pelanggan/<?php echo $pecah['foto_pelanggan'];?>" width="100">

                </td>
            <td>
            <a href="index.php?halaman=hapuspelanggan&id=<?php echo $pecah['id_pelanggan']; ?>" class="btn-danger btn"><i class="glyphicon-trash"></i>hapus</a>
            </td>
        </tr>
        <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>

<a href="index.php?halaman=tambahpelanggan" class="btn btn-primary">Tambah Data</a>

