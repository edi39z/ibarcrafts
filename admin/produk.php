<h1>Produk</h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>no</th>
            <th>nama</th>
            <th>harga</th>
            <th>files</th>
            <th>foto</th>
            <th>deskripsi</th> <!-- Added column for description -->
            <th>Kategori</th>
            
            <th>aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor=1; ?>
        <?php $ambil=$koneksi->query("SELECT * FROM produk");?>
        <?php while($pecah =$ambil->fetch_assoc()){ ?>
            <tr>
                <td> <?php echo $nomor;?> </td>
                <td> <?php echo $pecah['nama_produk'];?> </td>
                <td> <?php echo $pecah['harga_produk'];?> </td>
               
                <td> <?php echo $pecah['Download_File'];?> </td>    
                <td> 
                    <img src="../foto_produk/<?php echo $pecah['foto_produk'];?>" width="100">
                </td>
                <td> <?php echo $pecah['deskripsi_produk'];?> </td> <!-- Display description -->
                <td> <?php echo $pecah['kategori'];?> </td> 
                
               
                <td>
                    <a href="index.php?halaman=hapusproduk&id=<?php echo $pecah['id_produk']; ?>" class="btn-danger btn"><i class="glyphicon-trash"></i>hapus</a>
                    <a href="index.php?halaman=ubahproduk&id=<?php echo $pecah['id_produk']; ?>" class="btn btn-warning"><i class="glyphicon-edit"></i>Ubah</a>
                    <a href="index.php?halaman=detailproduk&id=<?php echo $pecah['id_produk']; ?>" class="btn btn-info"><i class="glyphicon-eye"></i>Detail</a>
                </td>


            </tr>
            <?php $nomor++ ?>
        <?php } ?>
    </tbody>
</table>

<a href="index.php?halaman=tambahproduk" class="btn btn-primary">Tambah Data</a>
