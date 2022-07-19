<?php

use Illuminate\Support\Facades\Route;
use Esperlos98\EsTicket\Http\Controllers\{TicketController,ReplieController};

Route::middleware(['api','auth:apiMongo','role:ticket'])->prefix("es/api/v1/ticket")->group(function () {

	Route::get("/tickets",[TicketController::class,"index"]);
	Route::post("/changeStatus/{ticket}/{status}",[TicketController::class,"changeStatus"]);
});

Route::middleware(['api','auth:apiMongo'])->prefix("es/api/v1/")->group(function(){

	Route::apiResource("/ticket",TicketController::class,[
		'only'=>['show','store']
	]);

	Route::post("ticket/replies/{ticket}",[ReplieController::class,"store"]);
	Route::get("userTickets",[TicketController::class,"userTickets"]);
});
