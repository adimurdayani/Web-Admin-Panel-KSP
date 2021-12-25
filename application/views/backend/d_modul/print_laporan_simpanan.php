<!DOCTYPE html>
<html lang="en"><head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Print Data Simpanan</title>
</head><body>
  <center>
    <b><h2>LAPORAN TRANSAKSI LAPORAN SIMPANAN DANA</h2></b>
  </center>
  <hr>
  <br>
  <br>
  <table width="100%" border="1">
    <tr>
      <th>NO. SIMPANAN</th>
      <th>ID MEMBER</th>
      <th>TANGGAL TRANSAKSI</th>
      <th>JUMLAH</th>
      <th>JENIS SIMPANAN</th>
    </tr>
    <?php foreach($get_simpanan as $data):?>
    <tr >
      <td style="text-align: center;"><?= $data['no_simpanan']?></td>
      <td style="text-align: center;"><?= $data['member_id']?></td>
      <td style="text-align: center;"><?= $data['created_at']?></td>
      <td style="text-align: right;">Rp. <?= number_format($data['jumlah'], 0,',',',')?></td>
      <td style="text-align: center;"><?= $data['j_simpanan']?></td>
    </tr>
    <?php endforeach;?>
  </table>
</body></html>