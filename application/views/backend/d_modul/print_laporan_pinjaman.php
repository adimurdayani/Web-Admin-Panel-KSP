<!DOCTYPE html>
<html lang="en"><head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Print Data Pinjaman</title>
</head><body>
  <center>
    <b>
      <h2>LAPORAN TRANSAKSI LAPORAN PINJAMAN DANA</h2>
    </b>
  </center>
  <hr>
  <br>
  <br>
  <table width="100%" border="1">
    <tr>
      <th>NO. PINJAMAN</th>
      <th>ID MEMBER</th>
      <th>TANGGAL TRANSAKSI</th>
      <th>JUMLAH PINJAMAN</th>
      <th>TENOR</th>
      <th>BUNGA</th>
      <th>ANGSURAN</th>
    </tr>
    <?php foreach($get_pinjaman as $data):
      $besar_cicilan = $data['jumlah'] / $data['tenor'];
      $bunga = ($data['bunga'] * $data['jumlah']) / $data['tenor'];
      ?>
    <tr>
      <td style="text-align: center;"><?= $data['no_pinjaman']?></td>
      <td style="text-align: center;"><?= $data['member_id']?></td>
      <td style="text-align: center;"><?= $data['created_at']?></td>
      <td style="text-align: right;">Rp. <?= number_format($data['jumlah'], 0,',',',')?></td>
      <td style="text-align: center;"><?= $data['tenor']?> Bulan</td>
      <td style="text-align: center;"><?= $data['bunga']?>%</td>
      <td style="text-align: right;">Rp. <?= number_format($besar_cicilan+$bunga, 0,',',',')?></td>
    </tr>
    <?php endforeach;?>
  </table>
</body></html>