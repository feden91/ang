<?php 

include "clases/Personas.php";
// $_GET['accion'];
if(isset($_GET['accion']))
{
	$accion=$_GET['accion'];
	if($accion=="traer")
	{
		$respuesta= array();
		//$respuesta['listado']=Persona::TraerPersonasTest();
		$respuesta['listado']=Persona::TraerTodasLasPersonas();
		//var_dump(Persona::TraerTodasLasPersonas());
		$arrayJson = json_encode($respuesta);
		echo  $arrayJson;
	}


	

}
else{
//var_dump($_REQUEST);


	/*esto es para cuando se configura el headers: {'Content-Type': 'application/x-www-form-urlencoded'}
	POR EJEMPLO 
	$http.post("PHP/nexo.php",{accion :"borrar",persona:persona},{headers: {'Content-Type': 'application/x-www-form-urlencoded'}})
 .then(function(respuesta) {       
         //aca se ejetuca si retorno sin errores        
         console.log(respuesta.data);

    },function errorCallback(response) {        
        //aca se ejecuta cuando hay errores
        console.log( response);           
    });
	*/

	// echo "<br> datos pasados por post";
	// var_dump($_POST);





	
	/*
	esto es para cuando se pasan los datos por json
	por ejemplo
	$http.post('PHP/nexo.php', { datos: {accion :"insertar",persona:$scope.persona}})
 	  .then(function(respuesta) {     	
 		     //aca se ejetuca si retorno sin errores      	
      	 console.log(respuesta.data);

    },function errorCallback(response) {     		
     		//aca se ejecuta cuando hay errores
     		console.log( response);     			
 	  });*/

	$DatosPorPost = file_get_contents("php://input");
	$respuesta = json_decode($DatosPorPost);
	var_dump($respuesta);

	switch ($respuesta->datos->accion) {
		case 'borrar':
			echo"Voy a borrar";
			Persona::BorrarPersona($respuesta->datos->persona);
			break;
		case 'modificar':
			echo"Voy a modificar";
			Persona::ModificarPersona($respuesta->datos->persona);
			break;
		
		case 'insertar':
			echo"Voy a guardar";
			Persona::InsertarPersona($respuesta->datos->persona);
			break;

		default:
			# code...
			break;
	}


	//echo $respuesta->datos->persona->nombre;




}



 ?>