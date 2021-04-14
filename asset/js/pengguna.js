$(document).on('click', '.invenwifi', function() {
    var classname = $(this).attr('class').split(' ');
    if (classname[3] == 'noactive' && $(this).hasClass(classname[2])) {
        $(this).removeClass('noactive').addClass('active');
        $('.invenlis').removeClass('active').addClass('noactive');
        $('.tablistrik').hide();
        $('.tabwifi').show();

    }
})
$(document).on('click', '.invenlis', function() {
    var classname = $(this).attr('class').split(' ');
    if (classname[3] == 'noactive' && $(this).hasClass(classname[2])) {
        $(this).removeClass('noactive').addClass('active');
        $('.invenwifi').removeClass('active').addClass('noactive');
        $('.tabwifi').hide();
        $('.tablistrik').show();
    }
})
var table_invenwifi;
$(document).ready(function() {
    //datatables
    table_invenwifi = $('#table_inven_wifi').DataTable({
        "language": {
            "emptyTable": "Tidak Ada Inventaris",
            "processing": "Memuat Data",
            "zeroRecords": "Data Tidak Ditemukan"
        },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [],
        ajax: {
            url: "pengguna/getInvenWifi",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [5],
            "className": "text-center",
            "orderable": false
        }]

    });

});
var table_invenlistrik;
$(document).ready(function() {
    // $('#tablis').wrap('<div id="hide" style="display:none"/>');
    //datatables
    table_invenlistrik = $('#table_inven_listrik').DataTable({
        "language": {
            "emptyTable": "Tidak Ada Tagihan",
            "processing": "Memuat Data",
            "zeroRecords": "Data Tidak Ditemukan"
        },
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [],
        ajax: {
            url: "pengguna/getInvenListrik",
            type: "POST"
        },
        "columnDefs": [{
            "targets": [5],
            "className": "text-center",
            "orderable": false
        }]

    });
});
// ----- On render -----
$(function() {
    $('#profile').addClass('dragging').removeClass('dragging');
});

$('#profile').on('dragover', function() {
    $('#profile').addClass('dragging')
}).on('dragleave', function() {
    $('#profile').removeClass('dragging')
}).on('drop', function(e) {
    $('#profile').removeClass('dragging hasImage');

    if (e.originalEvent) {
        var file = e.originalEvent.dataTransfer.files[0];
        console.log(file);

        var reader = new FileReader();

        //attach event handlers here...

        reader.readAsDataURL(file);
        reader.onload = function(e) {
            console.log(reader.result);
            $('#profile').css('background-image', 'url(' + reader.result + ')').addClass('hasImage');

        }

    }
})
$('#profile').on('click', function(e) {
    $('#myfile').click();
});
window.addEventListener("dragover", function(e) {
    e = e || event;
    e.preventDefault();
}, false);
window.addEventListener("drop", function(e) {
    e = e || event;
    e.preventDefault();
}, false);
$('#myfile').change(function(e) {

    var input = e.target;
    if (input.files && input.files[0]) {
        var file = input.files[0];
        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.onload = function(e) {
            $('#profile').css('background-image', 'url(' + reader.result + ')').addClass('hasImage').addClass(file.name);
        }
    }
})