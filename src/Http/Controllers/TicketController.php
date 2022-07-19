<?php

namespace Esperlos98\EsTicket\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Esperlos98\EsTicket\Models\Ticket;
use Esperlos98\EsTicket\Lib\Traits\Ticket\{StoreTrait,UpdateTrait};

class TicketController extends Controller{
	
	use StoreTrait,UpdateTrait;

	protected function index(){
		return Ticket::with('image')->orderBy('created_at', 'desc')->lazy()->chunk(10);	
	}

	protected function show($id){
		if(!$this->checkAccessShow($id)){ return response()
		   ->json(ReplieController::UNAUTHORIZED,ReplieController::UNAUTHORIZED_CODE);};
		
		return Ticket::with(['user','image','replies'])->find($id);
	}

	protected function changeStatus($id,$status){
		Ticket::find($id)->update(["status"=>$status]);				
	}

	protected function userTickets(){
		return User::find(Auth::user()->id)->tickets()->orderBy('created_at', 'desc')->lazy()->chunk(10);
	}

	public function checkAccessShow($ticket_id){
		$user = Auth::user();
		$ticket = Ticket::find($ticket_id);
		
		$resulte = ReplieController::checkAccess($ticket,$user);

		return $resulte;
	}
}
?>
