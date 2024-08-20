<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_dinamis');
	}

	public function index()
	{

		if ($this->session->userdata('sts_login') == true) {
			redirect('/Dashboard', 'refresh');
			return;
		}

		$this->load->view('login');
	}


	public function prs_login()
	{
		$username = clean($this->input->post('idpengguna'));
		$password = md5(clean($this->input->post('sandi')));

		$where = array(
			'idpengguna' => $username,
			'sandi' =>  $password
		);

		$cek = $this->M_dinamis->getById('ku_user', $where);

		if ($cek == null) {
			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible fade show text-center" style="font-size:15px;" role="alert">
            Username / Password Salah.!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
			redirect('/Login', 'refresh');
			return;
		}

		if ($cek->aktif == 0) {
			$this->session->set_flashdata('psn', '<div class="alert alert-danger alert-dismissible fade show text-center" style="font-size:15px;" role="alert">
            Akun anda belum diaktifkan.!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
			redirect('/Login', 'refresh');
			return;
		}

		// Set privilege
		$prive = '';
		$is_provinsi = '';

		if (substr($cek->uid, 0, 1) == 'K') {
			$prive = 'pemda';
		}
		if (substr($cek->uid, 0, 1) == 's') {
			$prive = 'sda';
		}
		if (substr($cek->uid, 0, 1) == 'z') {
			$prive = 'sda2';
		}
		if (substr($cek->uid, 0, 1) == 'B') {
			$prive = 'balai';
		}
		if (substr($cek->uid, 0, 1) == 'P' and substr($cek->idkelompok, 0, 9) == 'PROVINSI') {
			$is_provinsi = 'provinsi';
			$prive = 'pemda';
		}
		if ($cek->idpengguna == 'admin') {
			$prive = 'admin';
		}
		// End Set privilege

		// Tentukan thang berdasarkan prive
		$thang = '2024';
		$canAccessThang2025 = false;
		if (in_array($prive, ['admin', 'sda', 'balai', 'kotakabid']) || in_array($cek->kotakabid, [
			'1111',
			'1103',
			'1100',
			'1111',
			'1108',
			'1107',
			'1103',
			'1110',
			'1109',
			'1116',
			'1114',
			'1115',
			'1101',
			'1100',
			'1106',
			'1117',
			'1113',
			'5102',
			'5108',
			'5104',
			'5100',
			'5105',
			'5103',
			'5101',
			'5106',
			'1900',
			'1904',
			'1901',
			'1905',
			'3602',
			'3600',
			'3601',
			'3604',
			'1707',
			'1704',
			'1700',
			'1701',
			'1705',
			'7505',
			'7500',
			'1500',
			'1503',
			'1572',
			'1505',
			'3206',
			'3203',
			'3213',
			'3210',
			'3208',
			'3205',
			'3207',
			'3209',
			'3214',
			'3212',
			'3200',
			'3202',
			'3211',
			'3217',
			'3278',
			'3322',
			'3310',
			'3312',
			'3329',
			'3302',
			'3301',
			'3318',
			'3303',
			'3313',
			'3325',
			'3323',
			'3315',
			'3316',
			'3314',
			'3304',
			'3328',
			'3324',
			'3326',
			'3309',
			'3306',
			'3327',
			'3305',
			'3311',
			'3300',
			'3506',
			'3509',
			'3508',
			'3505',
			'3514',
			'3523',
			'3502',
			'3518',
			'3519',
			'3517',
			'3525',
			'3512',
			'3524',
			'3504',
			'3503',
			'3501',
			'3529',
			'3526',
			'3500',
			'3527',
			'3507',
			'3510',
			'3511',
			'3516',
			'3520',
			'3521',
			'3513',
			'6101',
			'6112',
			'6111',
			'6102',
			'6100',
			'6108',
			'6109',
			'6110',
			'6303',
			'6304',
			'6301',
			'6309',
			'6306',
			'6305',
			'6311',
			'6300',
			'6307',
			'6302',
			'6308',
			'6310',
			'6211',
			'6203',
			'6210',
			'6205',
			'6200',
			'6202',
			'6206',
			'6212',
			'6400',
			'6502',
			'6500',
			'1808',
			'1809',
			'1803',
			'1801',
			'1813',
			'1804',
			'1800',
			'1811',
			'8100',
			'8103',
			'8106',
			'8104',
			'8204',
			'8200',
			'8205',
			'5207',
			'5206',
			'5203',
			'5204',
			'5202',
			'5200',
			'5208',
			'5201',
			'5315',
			'5313',
			'5314',
			'5302',
			'5306',
			'5305',
			'5321',
			'5304',
			'5307',
			'5310',
			'5311',
			'5300',
			'5318',
			'5317',
			'5301',
			'9103',
			'9100',
			'9200',
			'9417',
			'9401',
			'9500',
			'9404',
			'9300',
			'1405',
			'1400',
			'1404',
			'1406',
			'7602',
			'7604',
			'7600',
			'7605',
			'7311',
			'7306',
			'7302',
			'7313',
			'7303',
			'7318',
			'7309',
			'7314',
			'7310',
			'7322',
			'7315',
			'7325',
			'7300',
			'7305',
			'7308',
			'7326',
			'7317',
			'7312',
			'7316',
			'7200',
			'7204',
			'7208',
			'7210',
			'7212',
			'7203',
			'7205',
			'7206',
			'7207',
			'7405',
			'7403',
			'7406',
			'7402',
			'7400',
			'7404',
			'7411',
			'7408',
			'7410',
			'7409',
			'7105',
			'7110',
			'7100',
			'7102',
			'1303',
			'1307',
			'1306',
			'1302',
			'1309',
			'1312',
			'1304',
			'1371',
			'1300',
			'1376',
			'1305',
			'1308',
			'1310',
			'1605',
			'1608',
			'1600',
			'1607',
			'1611',
			'1212',
			'1202',
			'1204',
			'1218',
			'1213',
			'1219',
			'1208',
			'1200',
			'1217',
			'1209',
			'1215',
			'1210',
			'1211',
			'1206',
			'1207',
			'1201',
			'1216',
			'1221',
			'3404',
			'3402',
			'3403',
			'3400',
			'3401'
		])) {
			$thang = '2025';
			$canAccessThang2025 = true;
		}

		$dataSession = array(
			'uid' => $cek->uid,
			'idpengguna' => $cek->idpengguna,
			'balaiid' => $cek->balaiid,
			'provid' => $cek->provid,
			'kotakabid' => $cek->kotakabid,
			'kdKewenangan' => $cek->kdKewenangan,
			'nama' => $cek->nama,
			'aktif' => $cek->aktif,
			'gambar' => $cek->gambar,
			'idkelompok' => $cek->idkelompok,
			'aksi' => $cek->aksi,
			'in_user' => $cek->in_user,
			'sts_login' => true,
			'prive' => $prive,
			'is_provinsi' => $is_provinsi,
			'thang' => $thang,
			'canAccessThang2025' => $canAccessThang2025
		);

		$this->session->set_userdata($dataSession);
		redirect('/Dashboard', 'refresh');
	}


	public function Logout()
	{
		$this->session->sess_destroy();
		redirect('/Login', 'refresh');
	}


	public function downloadUserManual()
	{
		force_download('././assets/panduan/USER MANUAL - SIISD - REV-1.pdf', NULL);
	}
}
