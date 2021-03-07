<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-vIrmZrLCN2pC-Dmg"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link rel="stylesheet" href="<?= base_url('asset/css/styles.css') ?>">
</head>

<body>
    <div class="container mt-4">
        <h1>Bayar membayar</h1>
        <form id="payment-form" method="post" action="<?= site_url() ?>/snap/finish">
            <label for="">No. Kamar</label>
            <div class="form-group">
                <select name="kamar" class="form-select" id="kamar">
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
            </div>
            <label for="">Bulan</label>
            <select name="bulan" class="form-select" id="bulan">
                <?php foreach ($bulan as $bl) : ?>
                    <option value="<?php echo $bl['id_bulan'] ?>"><?php echo $bl['bulan'] ?></option>
                <?php endforeach; ?>
            </select>
            <label for="">Harga</label>
            <div class="form-group">
                <input type="number" class="form-control" name="harga" id="harga">
            </div>
            <input type="hidden" name="result_type" id="result-type" value="">
            <input type="hidden" name="result_data" id="result-data" value="">
            <br>
            <button class="btn btn-primary" id="pay-button">Bayar</button>
        </form>
        <br>
        <div class="card">
            <table class="table table-striped table-hover">
                <thead>
                    <th>ID Transaksi</th>
                    <th>Tagihan</th>
                    <th>Tanggal</th>
                    <th>Pay Type</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    <?php foreach ($tagihankost as $tagih) :
                        $id = $tagih['id_transkost'];
                    ?>
                        <tr>
                            <td><?= $id; ?></td>
                            <td><?= number_format($tagih['harga'], '0', '', '.')  ?></td>
                            <td><?= $tagih['tgl_trankost']; ?></td>
                            <td><?= $tagih['pay_type']; ?></td>
                            <td>
                                <?php if ($tagih['status'] == 200) : ?><span class="badge bg-success">Lunas</span>
                                <?php else : ?><span class="badge bg-warning" style="color:#000">Pending</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= $tagih['pdf']; ?>" class="btn btn-primary">Download</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
    <script type="text/javascript">
        $('#pay-button').click(function(event) {
            event.preventDefault();
            $(this).attr("disabled", "disabled");
            var bulan = document.getElementById("bulan").value;
            var harga = $("#harga").val();
            $.ajax({
                type: 'POST',
                url: '<?= site_url() ?>/snap/token',
                data: {
                    bulan: bulan,
                    harga: harga
                },
                cache: false,

                success: function(data) {
                    //location = data;

                    console.log('token = ' + data);

                    var resultType = document.getElementById('result-type');
                    var resultData = document.getElementById('result-data');

                    function changeResult(type, data) {
                        $("#result-type").val(type);
                        $("#result-data").val(JSON.stringify(data));
                        //resultType.innerHTML = type;
                        //resultData.innerHTML = JSON.stringify(data);
                    }

                    snap.pay(data, {

                        onSuccess: function(result) {
                            changeResult('success', result);
                            console.log(result.status_message);
                            console.log(result);
                            $("#payment-form").submit();
                        },
                        onPending: function(result) {
                            changeResult('pending', result);
                            console.log(result.status_message);
                            $("#payment-form").submit();
                        },
                        onError: function(result) {
                            changeResult('error', result);
                            console.log(result.status_message);
                            $("#payment-form").submit();
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>