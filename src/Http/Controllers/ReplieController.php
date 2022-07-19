<?php

namespace Esperlos98\EsTicket\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Esperlos98\EsTicket\Models\Ticket;
use Illuminate\Http\Request;
use Esperlos98\EsTicket\Http\Controllers\ImageController;
use Esperlos98\EsTicket\Lib\Config\ValidateOptions;
use Esperlos98\EsTicket\Repository\Validate\ValidateRequest;
use Illuminate\Support\Facades\Auth;

class ReplieController extends Controller{
	
	const MASSAGE = "create replie successfully";
	const UNAUTHORIZED = "unauthorized";
	const UNAUTHORIZED_CODE = 403;
	const CLOSED = "ticket closed";
	const ROLE = "ticket";

	protected function store(Request $request,$ticketId,ValidateOptions $validate){
		
		$validate = resolve(ValidateRequest::class)->validate(
			$request,
			$validate::VALIDATE["REPLIE_STORE"],
			$validate::VALIDATE["MASSAGES"]
		);

		if($validate){return $validate;}

		$ticket = Ticket::find($ticketId);
		
		if(!self::checkAccess($ticket,Auth::user())){ 
			return response()->json(self::UNAUTHORIZED,self::UNAUTHORIZED_CODE);
		}
		
		if(!$this->checkStatus($ticket)){
			return response()->json(self::CLOSED,self::UNAUTHORIZED_CODE);
		}
		
		$request->request->add(["user_id"=>Auth::user()->id]);
		$replie = $ticket->replies()->create($request->only(["title","massage","user_id"]));
		
		if($request->file("image")){	
			$imageUrl = ImageController::store($request->file("image"));
			$replie->image()->create(["url"=>$imageUrl]);
		}

		return response()->json(self::MASSAGE);
	}

	public static function checkAccess($ticket,User $user){
	
		if($ticket->user_id == $user->id || $user->hasRole(self::ROLE)){ return true; }

		return false;
	}

	protected function checkStatus($ticket){
	
		if($ticket->status == true ){ return  true; }

		return false;
	}
}

?>

