<?php

namespace Esperlos98\EsTicket\Http\Controllers;

use App\Http\Controllers\Controller;

class ImageController extends Controller{

	const PERFIX_STORAGE_URL = "storage/";

	public static function store($imageFile,$patch="images/tickets/",$storage = "public"):string{
	
		$imagePatch = $patch.date("Ym");
		$fileName = date("YmdHis.").$imageFile->getClientOriginalExtension();		
		$url = $imageFile->storeAs($imagePatch,$fileName,$storage);
		
		$patchFull = self::PERFIX_STORAGE_URL.$url;
		
		return $patchFull;
	}
}
?>

