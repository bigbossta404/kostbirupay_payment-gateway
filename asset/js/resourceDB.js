$(document).ready(function() {
    $('#tableid').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{route('pengguna.index')}}",
            type: 'GET'
        },
        columns: [
            { data: 'id_bulan', name: 'id_bulan' },
            { data: 'upeti', name: 'upeti' },
            { data: 'tanggal', name: 'tanggal' },
            { data: 'status', name: 'status' },
            { data: 'keterangan', name: 'keterangan' },
        ],
        order: [
            [0, 'asc']
        ],
        'rowCallback': function(row, data, index) {
            if (data.bulan == 1) {
                $(row).find('td:eq(0)').text('Januari');
            } else {
                $(row).find('td:eq(0)').text('Non-Aktif');
            }
        }
    });
});