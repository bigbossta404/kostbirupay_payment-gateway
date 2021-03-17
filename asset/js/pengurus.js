$(document).ready(function() {
    $("#btn_tambah").click(function(e) {
        e.preventDefault();
        var nama = $('#nama').val();
        var email = $('#email').val();

        var telp = $('#telp').val();
        var kamar = $('#kamar').val();
        var username = $('#username').val();
        var password = $('#password').val();
        var repassword = $('#repassword').val();
        $.ajax({
            url: "buatakun",
            type: 'POST',
            data: {
                nama: nama,
                email: email,
                telp: telp,
                kamar: kamar,
                username: username,
                password: password,
                repassword: repassword
            },
            dataType: "json",
            beforeSend: function() {
                $('#btn_tambah').attr('disabled', 'disabled');
            },
            success: function(data) {
                if (data.error) {
                    if (data.nama_error != '') {
                        $('#nama_error').html(data.nama_error);
                    } else {
                        $('#nama_error').html('');
                    }
                    if (data.email_error != '') {
                        $('#email_error').html(data.email_error);
                    } else {
                        $('#email_error').html('');
                    }
                    if (data.telp_error != '') {
                        $('#telp_error').html(data.telp_error);
                    } else {
                        $('#telp_error').html('');
                    }
                    if (data.kamar_error != '') {
                        $('#kamar_error').html(data.kamar_error);
                    } else {
                        $('#kamar_error').html('');
                    }
                    if (data.username_error != '') {
                        $('#username_error').html(data.username_error);
                    } else {
                        $('#username_error').html('');
                    }
                    if (data.password_error != '') {
                        $('#password_error').html(data.password_error);
                    } else {
                        $('#password_error').html('');
                    }
                    if (data.repassword_error != '') {
                        $('#repassword_error').html(data.repassword_error);
                    } else {
                        $('#repassword_error').html('');
                    }
                }
                if (data.success) {
                    $('#modaladd').modal('hide')
                    $('#alert-msg').html(data.success);
                    tableuser.draw();
                    $('#nama_error').html('');
                    $('#email_error').html('');
                    $('#telp_error').html('');
                    $('#kamar_error').html('');
                    $('#username_error').html('');
                    $('#password_error').html('');
                    $('#repassword_error').html('');
                }
                $('#btn_tambah').attr('disabled', false);
            }
        })
    });
});

//================= OPEN MODAL AKTIVASI BY ID

$(document).on('click', '.btn_active', function(e) {
    var id = $(this).attr('id');
    $.ajax({
        url: "pengurus/getactivedata/" + id,
        type: "GET",
        dataType: "JSON",
        success: function($data) {
            $('#active option[value="' + $data.active + '"]').prop('selected', true);
            $('.btn_active').attr('id', id);
            $('#modalactive').modal('show')
        }
    });
});

//================= Btn Update Aktivasi

$(document).ready(function() {
    $('.btn_active').click(function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        var active = $('#active').val();
        // alert(idactive);
        $.ajax({
            url: "pengurus/updateactive",
            type: "POST",
            dataType: "JSON",
            data: {
                id: id,
                active: active
            },
            success: function(data) {
                if (data.error) {
                    if (data.active_error != '') {
                        $('#active_error').html(data.active_error);
                    } else {
                        $('#active_error').html('');
                    }
                }
                if (data.success) {
                    $('.close').click();
                    $('#alert-msg').html(data.success);
                    $('#modalactive').modal('hide');
                    tableuser.draw();
                }
            }
        });
    });
});
//================= HAPUS USERS FROM ID


$(document).on('click', '.btn_hapusakun', function(e) {
    e.preventDefault();
    var id = $(this).attr('id');
    let tr = $(this).closest('tr');
    var user = tr.find('td:eq(2)').text();
    Swal.fire({
        title: 'Yakin hapus akun ' + user + ' ?',
        text: "Data tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Batal',
        confirmButtonText: 'Hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "pengurus/hapusakun/" + id,
                type: "POST",
                success: function(response) {
                    // alert(data.success);
                    Swal.fire(
                        'Terhapus!',
                        'Akun berhasil dihapus.',
                        'success'
                    );
                    tableuser.draw();
                    $('.close').click();
                }
            });

        }
    });
});

//================= DATA TABLE USERS

$(document).on('click', '.btn_up_users', function() {
    var nama = $('#nama').val();
    var id = $('#keyhold').val();
    var email = $('#email').val();
    var telp = $('#telp').val();
    var alamat = $('#alamat').val();
    var user = $('#username').val();
    var newpass = $('#newpassword').val();
    var pass = $('#password').val();
    var kamar = $('#kamar').val();
    var tagihanwifi = $('#tagihanwifi').val();

    $.ajax({
        url: user + "/update",
        type: "POST",
        data: {
            id: id,
            nama: nama,
            email: email,
            telp: telp,
            alamat: alamat,
            user: user,
            newpass: newpass,
            pass: pass,
            kamar: kamar,
            tagihanwifi: tagihanwifi,

        },
        dataType: "JSON",
        success: function(data) {

            if (data.error) {
                if (data.nama_error != '') {
                    $('#nama_error').html(data.nama_error);
                } else {
                    $('#nama_error').html('');
                }
                if (data.email_error != '') {
                    $('#email_error').html(data.email_error);
                } else {
                    $('#email_error').html('');
                }
                if (data.telp_error != '') {
                    $('#telp_error').html(data.telp_error);
                } else {
                    $('#telp_error').html('');
                }
                if (data.kamar_error != '') {
                    $('#kamar_error').html(data.kamar_error);
                } else {
                    $('#kamar_error').html('');
                }
                if (data.username_error != '') {
                    $('#username_error').html(data.username_error);
                } else {
                    $('#username_error').html('');
                }
                if (data.newpassword_error != '') {
                    $('#newpassword_error').html(data.newpassword_error);
                } else {
                    $('#newpassword_error').html('');
                }
                if (data.tagihanwifi_error != '') {
                    $('#tagihanwifi_error').html(data.tagihanwifi_error);
                } else {
                    $('#tagihanwifi_error').html('');
                }
            }
            if (data.success) {
                // alert(data.success);
                $('#nama_error').html('');
                $('#email_error').html('');
                $('#telp_error').html('');
                $('#kamar_error').html('');
                $('#username_error').html('');
                $('#password_error').html('');
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil disimpan',
                    showConfirmButton: false,
                    timer: 1500,
                });
                window.history.replaceState("object or string", "Title", data.userslah);
            }
            if (data.gagal) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal update',
                    showConfirmButton: false,
                    timer: 1500,
                });
            }
            $('.btn_up_users').attr('disabled', false);
        }
    });
});

$(document).on('click', '#btntagihanwifi', function() {
    var idbulan = $('#pickbulanwifi').val();
    $.ajax({
        url: "pengurus/create_tagihanwifi",
        type: "POST",
        data: {
            idbulan: idbulan
        },
        dataType: "JSON",
        success: function(data) {
            if (data.success) {
                tablewifi.draw();
                Swal.fire(
                    'Tagihan Baru!',
                    'Berhasil menambahkan tagihan baru.',
                    'success'
                );
                $('.close').click();
            }
            if (data.error) {
                $('#alert-msg').html(data.alert);
            }

        }
    });
});


//================= DATA TABLE USERS

var tablekeuangan;
$(document).ready(function() {

    //datatables
    tablekeuangan = $('#table_keuangan').DataTable({
        responsive: true,
        scrollX: true,
        scrollCollapse: true,
        "createdRow": function(row, data, index) {
            if (data[2] != 'Rp. 0') {
                $(row).find('td:eq(1),td:eq(2)').css({ 'background-color': '#b00000', 'color': 'white' });
            }
            if (data[2] == 'Rp. 0') {
                $(row).find('td:eq(1),td:eq(2)').css({ 'background-color': 'rgb(6 176 0)', 'color': 'white' });
            }
        },
        "language": {
            "emptyTable": "Tidak Ada Tagihan",
            "processing": "Memuat Data",
            "zeroRecords": "Data Tidak Ditemukan"
        },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [],
        ajax: {
            url: "pengurus/getKeuangan",
            type: "POST"
        },

        "columnDefs": [{
            "targets": [0, 4],
            "className": "text-center",
            "orderable": false
        }]

    });
});
var tableuser;
$(document).ready(function() {

    //datatables
    tableuser = $('#tableuser').DataTable({
        "language": {
            "emptyTable": "Tidak Ada Tagihan",
            "processing": "Memuat Data",
            "zeroRecords": "Data Tidak Ditemukan"
        },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [],
        ajax: {
            url: "pengurus/akunuser",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [4, 5],
            "className": "text-center",
            "orderable": false
        }]

    });
});

var tablewifi;
$(document).ready(function() {

    //datatables
    tablewifi = $('#tabletagihanwifi_peng').DataTable({

        "language": {
            "emptyTable": "Tidak Ada Tagihan",
            "processing": "Memuat Data",
            "zeroRecords": "Data Tidak Ditemukan"
        },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [],
        ajax: {
            url: "pengurus/readtagihanwifi",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [3],
            "className": "text-center",
            "orderable": false
        }],
    });

});


$(document).ready(function() {
    $(this).on('click', '.bulanwifi', function(e) {
        var idMY = $(this).attr('id').split(" ");
        var idbulan = idMY[0];
        // var tahun = idMY[1];

        $.ajax({
            url: "../pengurus/getTransaksi_wifi_bulan",
            data: {
                idbulan: idbulan,
                // tahun: tahun
            },
            type: "POST",
            success: function(result) {
                alert('mantap');
            }
        })

    });
});
$(document).ready(function() {
    $('#tabletransaksiwifi_peng').DataTable({
        responsive: true,
        "language": {
            "emptyTable": "Tidak Ada Tagihan",
            "processing": "Memuat Data",
            "zeroRecords": "Data Tidak Ditemukan"
        },
        "columnDefs": [{
            "targets": [4],
            "className": "text-center",
            "orderable": false
        }],
    });
});


$(document).ready(function() {
    $("#tooltip").tooltip({
        delay: { show: 0, hide: 2000 } // show tooltip after 500 milliseconds
    });
});
$(document).ready(function() {
    $("select.nokamarwifi").change(function() {
        var idkamar = $(this).children("option:selected").val();
        $.ajax({
            url: "../pengurus/getDetKamar_Wifi/" + idkamar,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                if (data == null) {
                    $("input.nama").val("Kosong");
                    $("input.jum").val("0,00");
                } else {
                    $("input.nama").val(data.nama);
                    $("input.jum").val(data.wifi);
                }
            }
        })
    });
});

$(document).ready(function() {
    $(document).on('click', '#tambahtagihan', function() {
        if ($(".boxtagihanbaru").is(':visible')) {
            $(".boxtagihanbaru").css({ 'visibility': 'hidden', 'display': 'none', 'opacity': '1.0' }).animate({ opacity: 0.0 }, 400);
            $(this).addClass('btn-primary').removeClass('btn-danger').html('Tagihan <i class="fas fa-plus-circle"></i>');
        } else {
            $(".boxtagihanbaru").css({ 'visibility': 'unset', 'display': 'inherit', 'opacity': '0.0' }).animate({ opacity: 1.0 }, 200);
            $(this).addClass('btn-danger').removeClass('btn-primary').html('Tutup <i class="fas fa-times-circle"></i>');
        }

    });
});

$(document).ready(function() {
    $(document).on('click', '.newtagihanwifi', function() {
        var idbulan = $(this).attr('id');
        var idkamar = $('select.nokamarwifi').val();
        $.ajax({
            url: "../pengurus/newTagihan_Wifi",
            type: "POST",
            data: {
                idkamar: idkamar,
                idbulan: idbulan,
            },
            dataType: "JSON",
            success: function(data) {
                if (data.error) {
                    $("#alert-msg").html(data.alert);
                }
                if (data.success) {
                    Swal.fire(
                        'Tagihan Baru!',
                        'Berhasil menambahkan tagihan baru.',
                        'success'
                    ).then((result) => {
                        // Reload the Page
                        location.reload();
                    });
                    $('.close').click();
                    // location.reload(true)
                }
            }
        });
    });
})

$(document).ready(function() {
    $(document).on('click', '#btncashin', function() {
        if ($(".boxcashin").is(':visible')) {
            $(".boxcashin").css({ 'visibility': 'hidden', 'display': 'none', 'opacity': '1.0' }).animate({ opacity: 0.0 }, 400);
            $(this).addClass('btn-success').removeClass('btn-secondary').html('Cash In <i class="fas fa-plus-circle"></i>');
        } else if ($(".boxcashout").is(':visible')) {
            $(".boxcashout").css({ 'visibility': 'hidden', 'display': 'none', 'opacity': '1.0' }).animate({ opacity: 0.0 }, 400);
            $("#btncashout").addClass('btn-danger').removeClass('btn-secondary').html('Cash Out <i class="fas fa-minus-circle"></i>');
            $(".boxcashin").css({ 'visibility': 'unset', 'display': 'inherit', 'opacity': '0.0' }).animate({ opacity: 1.0 }, 200);
            $(this).addClass('btn-secondary').removeClass('btn-success').html('Tutup <i class="fas fa-times-circle"></i>');
        } else {
            $(".boxcashin").css({ 'visibility': 'unset', 'display': 'inherit', 'opacity': '0.0' }).animate({ opacity: 1.0 }, 200);
            $(this).addClass('btn-secondary').removeClass('btn-success').html('Tutup <i class="fas fa-times-circle"></i>');
        }

    });
});
$(document).ready(function() {
    $(document).on('click', '#btncashout', function() {
        if ($(".boxcashout").is(':visible')) {
            $(".boxcashout").css({ 'visibility': 'hidden', 'display': 'none', 'opacity': '1.0' }).animate({ opacity: 0.0 }, 400);
            $(this).addClass('btn-danger').removeClass('btn-secondary').html('Cash Out <i class="fas fa-minus-circle"></i>');
        } else if ($(".boxcashin").is(":visible")) {
            $(".boxcashin").css({ 'visibility': 'hidden', 'display': 'none', 'opacity': '1.0' }).animate({ opacity: 0.0 }, 400);
            $("#btncashin").addClass('btn-success').removeClass('btn-secondary').html('Cash In <i class="fas fa-plus-circle"></i>');
            $(".boxcashout").css({ 'visibility': 'unset', 'display': 'inherit', 'opacity': '0.0' }).animate({ opacity: 1.0 }, 200);
            $(this).addClass('btn-secondary').removeClass('btn-danger').html('Tutup <i class="fas fa-times-circle"></i>');
        } else {
            $(".boxcashout").css({ 'visibility': 'unset', 'display': 'inherit', 'opacity': '0.0' }).animate({ opacity: 1.0 }, 200);
            $(this).addClass('btn-secondary').removeClass('btn-danger').html('Tutup <i class="fas fa-times-circle"></i>');
        }

    });
});
$(document).ready(function() {
    $(document).on('click', '.cashin', function() {
        var jumIn = $("input[name=jumIn]").val();
        var ketIn = $("input[name=ketIn]").val();

        $.ajax({
            url: 'pengurus/CashIn',
            type: 'POST',
            data: {
                jumIn: jumIn,
                ketIn: ketIn
            },
            dataType: "JSON",
            success: function(data) {
                if (data.success) {
                    $("#saldo").html(data.recent_saldo);
                    tablekeuangan.draw();
                }
            }
        });
    });
});

//============== Animate GSAP

gsap.from('.box-tags', { opacity: 0, duration: 1, y: -50, ease: "power3.out" })