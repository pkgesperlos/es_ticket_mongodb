<?php

use Tests\TestCase;
use Esperlos98\EsTicket\Http\Controllers\ImageController;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageTest extends TestCase{
	
	/**  @test */
	public function store(){
		
		$storge = Storage::fake("public");
		$imageFake = UploadedFile::fake()->create("imageFake.jpg");
		
		$url = ImageController::store($imageFake);
		$urlWithOutWordStorage = str_replace("storage/",'',$url);	

		return $this->assertTrue($storge->exists($urlWithOutWordStorage));
	
	}
}	

?>

