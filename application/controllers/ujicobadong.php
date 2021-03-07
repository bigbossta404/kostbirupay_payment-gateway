$data = array();
foreach ($list as $tagih) {
$row = array();
$format = number_format($tagih->harga, '0', '', '.');
$row[] = "<form id='payment-form' method='post' action='<?php site_url() ?>/snap/finish; ?>'> <input type='text' value='$tagih->bulan' class='rowtagihan' readonly>";
    $row[] = "<input type='number' value='$format' class='rowtagihan' readonly>";
    if ($tagih->status == 200) {
    $row[] = "<span class='badge bg-success' style='color:white'>Lunas</span>";
    } elseif ($tagih->status == 201) {
    $row[] = "<span class='badge bg-warning' style='color:black'>Pending</span>";
    } else {
    $row[] = "<span class='badge bg-danger' style='color:white'>Belum Bayar</span>";
    };
    $row[] = '<button class="btn btn-primary" stype="submit" id="pay-button">Bayar</button></form>';

$data[] = $row;
}

$output = array(
"draw" => $_POST['draw'],
"recordsTotal" => $this->tagihan->count_all(),
"recordsFiltered" => $this->tagihan->count_filtered(),
"data" => $data,
);

echo json_encode($output);