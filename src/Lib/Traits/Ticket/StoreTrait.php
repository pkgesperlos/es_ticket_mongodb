<?php

namespace Esperlos98\EsTicket\Lib\Traits\Ticket;

use Illuminate\Http\Request;
use Esperlos98\EsTicket\Http\Controllers\ImageController;
use Esperlos98\EsTicket\Repository\Validate\ValidateRequest;
use Esperlos98\EsTicket\Lib\Config\ValidateOptions;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

trait StoreTrait {
	
	public $massage = "create ticket successfully";
	
	public function store(Request $request,ValidateOptions $validate){
		
		$validate = resolve(ValidateRequest::class)->validate(
			$request,
			$validate::VALIDATE["TICKET_STORE"],
			$validate::VALIDATE["MASSAGES"]
		);

		if($validate){return $validate;}

		$request->request->add(["status" => true]);
		$ticket = User::find(Auth::user()->id)->tickets()->create(
			$request->only(["title","description","status"])
		);

		if($request->file("image")){
			$imageUrl = ImageController::store($request->file("image"));
			$ticket->image()->create(["url"=>$imageUrl]);
		}

		return response()->json($this->massage,200);
	}
}

?>

