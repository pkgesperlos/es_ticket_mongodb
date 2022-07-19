<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;

class TickettTest extends TestCase{

	use WithFaker;

	const ROLE = "ticket";

	/**  @test */
	public function index(){

		$user = self::user();
		$user->assignRole(self::ROLE);	

		$this->be($user);
		
		$response = $this->json("GET","es/api/v1/ticket/tickets");

		return $response->assertOk();
	}	
	
	/**  @test */
	public function show(){
		
		$user = $this->user();
		$user->assignRole(self::ROLE);	
		$ticket = $this->ticket($user);
			
		$this->be($user);

		$response = $this->json("GET","es/api/v1/ticket/".$ticket->id);

		return $response->assertOk();
	}
	
	/**  @test */
	public function store(){
		
		$user = self::user();
		
		$this->be($user);
		
		$response = $this->json("POST","/es/api/v1/ticket",[
			"title"=> $this->faker->title,
			"description"=> $this->faker->text	
		]);

		return $response->assertOk();
	}


	/**  @test */
	public function changeStatus(){
		
		$user = $this->user();
		$user->assignRole(self::ROLE);	
		$ticket = $this->ticket($user);
		
		$this->be($user);

		$response = $this->json("POST","/es/api/v1/ticket/changeStatus/".$ticket->id."/false");

		return $response->assertOk();
	}
	
	protected function user(){
	
		$user = User::create([
			"username" => $this->faker->userName,
			"phone"=> $this->faker->phoneNumber,
			"email" => $this->faker->email,
		]);

		return $user;
	}

	protected function ticket($user){
	
		$ticket = User::find($user->id)->tickets()->
			create([
				"title"=>$this->faker->title,
				"description"=>$this->faker->text,
				"status" => true
			]);
		
		return $ticket;
	}


}

?>

