# <div style="text-align: center;"> Esticket is package for easy ticket with mongodb </div>

# install 
```
composer require esperlos98/esticket
```
### you adding to User model relation
```
public function tickets(){
	return $this->hasMany(Ticket::class,"user_id");
}
``` 

# Note 
> you need to createing to role with a ticket name and assign user to these role  for ticket management  


# Routing

## createing a ticket
```
Method : POST
URl: your_url/es/api/v1/ticket
Parameters: title,description,image 
Note: image not mandatory
``` 
## replie to a ticket
```
Method : POST
URl: your_url/es/api/v1/ticket/{you must to add ticket id here} 
Example: your_url/es/api/v1/ticket/replies/62d3dce7384875c0fd0462ef
Parameters: title,message,image 
Note: image not mandatory
``` 
## you get ticket with its replys  
```
Method : GET
URl: your_url/es/api/v1/ticket/{you must to add ticket id here} 
Example: your_url/es/api/v1/ticket/62d3dce7384875c0fd0462ef
Access: adminstrtor and owner ticket
``` 
## you can close ticket 
```
Method : POST
URl: your_url/es/api/v1/ticket/changeStatus/{you must to add ticket id here}/{false or 0}
Example: your_url/es/api/v1/ticket/changeStatus/62d3dce7384875c0fd0462ef/false
Access: adminstrtor
``` 
## user can to get to tickes belonging to the itself
```
Method : GET
URl: your_url/es/api/v1/userTickets
``` 

## you can get lists of tickets

```
Method : GET
URl: your_url/es/api/v1/ticket/tickets
Access: adminstrtor
``` 
