<?php

namespace App\Controllers;

use App\Models\AnggotaModel;
use App\Models\BantuanModel;
use App\Models\KelompokModel;
use App\Models\UserModel;

class Home extends BaseController
{
	public function index()
	{
		$model1 = new AnggotaModel();
		$row1 = $model1->getAnggota();
		$model2 = new KelompokModel();
		$row2 = $model2->getKelompok();
		$model3 = new UserModel();
		$row3 = $model3->getUser();
		$model4 = new BantuanModel();
		$row4 = $model4->getBantuan();

		$data = [
			'anggota' => count($row1->getResult()),
			'kelompok' => count($row2->getResult()),
			'user' => count($row3->getResult()),
			'bantuan' => count($row4->getResult()),
		];
		return view('view_home', $data);
	}
}
