<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Snap extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
	{
		parent::__construct();
		$params = array('server_key' => 'SB-Mid-server-SUgyYd_evM9QK4Jdx9QiacG5', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');
		$this->load->model('tagihan');
		$this->load->model('akun');
	}

	public function index()
	{
		$this->load->view('checkout_snap');
	}
	public function token($id_pengguna)
	{
		$listakun = $this->akun->getakunByID($id_pengguna);
		$varbulan = $this->input->post('bulan');
		$varharga = $this->input->post('harga');
		$xharga = str_replace('.', '', $varharga);
		$pilih = $this->input->post('btnpilih');
		$var = ($pilih == 'pay-kost') ? "Kost" : (($pilih == 'pay-listrik') ? "Listrik" : "Wifi");


		if ($var == 'Kost') {
			$transaction_details = array(
				'order_id' => 'KOST-' . rand(),
				'gross_amount' =>  $xharga, // no decimal allowed for creditcard
			);
		} elseif ($var == 'Listrik') {
			$transaction_details = array(
				'order_id' => 'LIS-' . rand(),
				'gross_amount' =>  $xharga, // no decimal allowed for creditcard
			);
		} elseif ($var == 'Wifi') {
			$transaction_details = array(
				'order_id' => 'WIFI-' . rand(),
				'gross_amount' =>  $xharga, // no decimal allowed for creditcard
			);
		}

		// Optional
		$item1_details = array(
			'id' => 'a1',
			'price' =>  $xharga,
			'quantity' => 1,
			'name' => $var . " Bulan " . $varbulan
		);

		// Optional
		$item_details = array($item1_details);

		// Optional
		$billing_address = array(
			'first_name'    => "Andri",
			'last_name'     => "Litani",
			'address'       => "Mangga 20",
			'city'          => "Jakarta",
			'postal_code'   => "16602",
			'phone'         => "081122334455",
			'country_code'  => 'IDN'
		);

		// Optional
		$customer_details = array(
			'first_name'    => $listakun['nama'],
			'email'         => $listakun['email'],
			'phone'         => $listakun['notelp'],
			'billing_address'  => $billing_address
		);

		// Data yang akan dikirim untuk request redirect_url.
		$credit_card['secure'] = true;
		//ser save_card true to enable oneclick or 2click
		//$credit_card['save_card'] = true;

		$time = time();
		$custom_expiry = array(
			'start_time' => date("Y-m-d H:i:s O", $time),
			'unit' => 'minute',
			'duration'  => 2
		);

		$transaction_data = array(
			'transaction_details' => $transaction_details,
			'item_details'       => $item_details,
			'customer_details'   => $customer_details,
			'credit_card'        => $credit_card,
			'expiry'             => $custom_expiry
		);

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
	}

	public function finish($id_pengguna)
	{
		$idbayar = $this->input->post('idbayar');
		$pilih = $this->input->post('pilih');
		if ($pilih == 'pay-kost') {
			$result = json_decode($this->input->post('result_data'), true);
			$data = [
				'id_transaksi' => $result['order_id'],
				'id_pengguna' => $id_pengguna,
				'id_bayar' => $idbayar,
				'tgl_invoice' => $result['transaction_time'],
				'harga' => $result['gross_amount'],
				'pay_type' => $result['payment_type'],
				'bank' => $result['va_numbers'][0]['bank'],
				'va_num' => $result['va_numbers'][0]['va_number'],
				'pdf_url' => $result['pdf_url'],
				'status' => $result['status_code']
			];
			$simpan = $this->db->insert('transaksi', $data);

			if ($simpan) {
				redirect('kost');
			} else {
				echo "Gagal simpan";
			}
		} elseif ($pilih == 'pay-listrik') {
			$result = json_decode($this->input->post('result_data'), true);

			$data = [
				'id_transaksi' => $result['order_id'],
				'id_pengguna' => $id_pengguna,
				'id_bayar' => $idbayar,
				'tgl_invoice' => $result['transaction_time'],
				'harga' => $result['gross_amount'],
				'pay_type' => $result['payment_type'],
				'bank' => $result['va_numbers'][0]['bank'],
				'va_num' => $result['va_numbers'][0]['va_number'],
				'pdf_url' => $result['pdf_url'],
				'status' => $result['status_code']
			];
			$simpan = $this->db->insert('transaksi', $data);

			if ($simpan) {
				redirect('listrik');
			} else {
				echo "Gagal simpan";
			}
		} elseif ($pilih == 'pay-wifi') {
			$result = json_decode($this->input->post('result_data'), true);

			$data = [
				'id_transaksi' => $result['order_id'],
				'id_pengguna' => $id_pengguna,
				'id_bayar' => $idbayar,
				'tgl_invoice' => $result['transaction_time'],
				'harga' => $result['gross_amount'],
				'pay_type' => $result['payment_type'],
				'bank' => $result['va_numbers'][0]['bank'],
				'va_num' => $result['va_numbers'][0]['va_number'],
				'pdf_url' => $result['pdf_url'],
				'status' => $result['status_code']
			];
			$simpan = $this->db->insert('transaksi', $data);

			if ($simpan) {
				redirect('wifi');
			} else {
				echo "Gagal simpan";
			}
		}
	}
}
