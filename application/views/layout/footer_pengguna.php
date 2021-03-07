</div>

<script src="<?= base_url('asset/js/jquery-3.5.1.min.js') ?>"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="<?= base_url('asset/js/scripts.js') ?>"></script>
<script src="<?= base_url('asset/js/fontawesome/js/all.min.js') ?>"></script>
<script src="<?= base_url('asset/datatables/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('asset/bootstrap/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('asset/datatables/js/dataTables.bootstrap4.min.js') ?>"></script>
<script type="text/javascript">
    $(document).on('click', '#pay-kost', function(e) {
        event.preventDefault();
        $(this).attr("disabled", false);
        var idbayar = $(this).data('id');
        var pilih = $(this).attr('id');
        document.getElementById("idbayar").value = idbayar;
        document.getElementById("pilih").value = pilih;
        var btnpilih = $('#pilih').val();
        let tr = $(this).closest('tr');
        var bulan = tr.find('td:eq(1) input').val();
        var harga = tr.find('td:eq(2) input').val();
        // alert('Table 1: ' + bulan + ' ' + harga);
        $.ajax({
            type: 'POST',
            url: '<?= site_url('/snap/token/') . $user['id_pengguna']; ?>',
            async: true,
            data: {
                btnpilih: btnpilih,
                bulan: bulan,
                harga: harga,
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
<script type="text/javascript">
    $(document).on('click', '#pay-listrik', function(e) {
        event.preventDefault();
        $(this).attr("disabled", false);
        var idbayar = $(this).data('id');
        var pilih = $(this).attr('id');
        document.getElementById("idbayar").value = idbayar;
        document.getElementById("pilih").value = pilih;
        var btnpilih = $('#pilih').val();
        let tr = $(this).closest('tr');
        var bulan = tr.find('td:eq(1) input').val();
        var harga = tr.find('td:eq(2) input').val();
        // alert('Table 1: ' + bulan + ' ' + harga);
        $.ajax({
            type: 'POST',
            url: '<?= site_url('snap/token/') . $user['id_pengguna']; ?>',
            async: true,
            data: {
                btnpilih: btnpilih,
                bulan: bulan,
                harga: harga,
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
<script type="text/javascript">
    $(document).on('click', '#pay-wifi', function(e) {
        event.preventDefault();
        $(this).attr("disabled", false);
        var idbayar = $(this).data('id');
        var pilih = $(this).attr('id');
        document.getElementById("idbayar").value = idbayar;
        document.getElementById("pilih").value = pilih;
        var btnpilih = $('#pilih').val();
        let tr = $(this).closest('tr');
        var bulan = tr.find('td:eq(1) input').val();
        var harga = tr.find('td:eq(2) input').val();
        // alert('Table 1: ' + bulan + ' ' + harga);
        $.ajax({
            type: 'POST',
            url: '<?= site_url('snap/token/') . $user['id_pengguna']; ?>',
            async: true,
            data: {
                btnpilih: btnpilih,
                bulan: bulan,
                harga: harga,
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

<script>
    var table;
    $(document).ready(function() {

        //datatables
        table = $('#tablekost').DataTable({
            "language": {
                "emptyTable": "Tidak Ada Tagihan",
                "processing": "Memuat Data",
                "zeroRecords": "Data Tidak Ditemukan"
            },
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [],
            ajax: {
                url: "<?php echo site_url('pengguna/tagihankost') ?>",
                type: "POST"
            },
            "columnDefs": [{
                "targets": [4],
                "className": "text-center",
                "orderable": false
            }]

        });

    });
</script>
<script>
    var table;
    $(document).ready(function() {

        //datatables
        table = $('#tablelistrik').DataTable({
            "language": {
                "emptyTable": "Tidak Ada Tagihan",
                "processing": "Memuat Data",
                "zeroRecords": "Data Tidak Ditemukan"
            },
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [],
            ajax: {
                url: "<?php echo site_url('pengguna/tagihanlistrik') ?>",
                type: "POST"
            },
            "columnDefs": [{
                "targets": [4],
                "className": "text-center",
                "orderable": false
            }]

        });

    });
</script>
<script>
    var table;
    $(document).ready(function() {

        //datatables
        table = $('#tablewifi').DataTable({
            "language": {
                "emptyTable": "Tidak Ada Tagihan",
                "processing": "Memuat Data",
                "zeroRecords": "Data Tidak Ditemukan"
            },
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [],
            ajax: {
                url: "<?php echo site_url('pengguna/tagihanwifi') ?>",
                type: "POST"
            },
            "columnDefs": [{
                "targets": [4],
                "className": "text-center",
                "orderable": false
            }]

        });

    });
</script>

</body>

</html>