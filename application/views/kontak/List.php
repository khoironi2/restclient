<?php echo $this->session->flashdata('hasil'); ?>
<table>
    <tr><th>NIM</th><th>NAMA</th><th>ID JURUSAN</th><th>ALAMAT</th><th></th></tr>
    <?php
    foreach ($mahasiswa as $m){
        echo "<tr>
              <td>$m->id</td>
              <td>$m->nama_lengkap</td>
              
              <td>".anchor('mahasiswa/edit/'.$m->id,'Edit')."
                  ".anchor('mahasiswa/delete/'.$m->id,'Delete')."</td>
              </tr>";
    }
    ?>
</table>