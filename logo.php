<?php
    //KONEKSI DB
    include "koneksi.php";
	
    $sql = $conn->query("SELECT * from tb_perusahaan");
    while ($data= $sql->fetch_assoc()) {
    
    $nama_perusahaan=$data['nama_perusahaan'];
    }
  ?>
<a href="index.php?hal=profil_perusahaan" class="brand-link">
      <img src="dist/img/logo.png" alt="Logo DEA COMPANY" class="brand-image" >
      <span class="brand-text font-weight-light"><?php echo $nama_perusahaan; ?></span>
    </a>