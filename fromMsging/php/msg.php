<?php
 
class Msg
{
  private $_id;
  private $_nom;
  private $_email;
  private $_msg;
  private $_copie;

   function __construct($nom,$email,$msg,$copie) {
	   
			$this->_id= 2;
			$this->_nom=$nom;
			$this->_email =$email;
			$this->_msg=$msg;
			$this->_copie=$copie;
			 
			
		
    }
	 function add(){
		 
		require_once("connectDB.php");
		$sql = $conn->prepare("INSERT INTO msg (nom,msg,email,copie) VALUES (?, ?, ?, ?)"); 
		
		$sql->bind_param("sssi",$this->_nom,$this->_msg,$this->_email,$this->_copie);
		
		if($sql->execute()) {
			$success_message = "Added Successfully";
			echo $success_message ;
		} else {
			$error_message = "Problem in Adding New Record";
			echo $error_message ;
		}
		$sql->close();   
		$conn->close();
	 }
	 
	 function display(){
		 
		require_once("connectDB.php");
		
			 $stmt = $conn->prepare("SELECT nom FROM msg WHERE email =?") ;

				/* Lecture des marqueurs */
				$stmt->bind_param("s", $this->_email);
				$stmt->execute();

				do{
					$stmt->bind_result($id);
					echo $id;
					
				}while($stmt->fetch());
				
				$stmt->close();
				$conn->close();
	 }
	 
	 

 
	 function update(){
		 
		require_once("connectDB.php");
		 
			  $stmt = $conn->prepare("UPDATE msg SET nom = ?, 
									   msg= ?, 
									   email = ?,  
									   copie=? where 
									   id = ?") ;

				/* Lecture des marqueurs */
				$stmt->bind_param("sssii",$this->_nom,$this->_msg,$this->_email,$this->_copie,$this->_id);
				if($stmt->execute()) {
					$success_message = "Updated Successfully";
					echo $success_message ;
				} else {
					$error_message = "Problem in updating New Record";
					echo $error_message ;
				}
				$stmt->close();   
				$conn->close();
	 }
	 
	 
	 
	 function deletee(){
			require_once("connectDB.php");
			$stmt = $conn->prepare("DELETE FROM msg WHERE id= ?");
			$stmt->bind_param('i', $this->_id);
				if($stmt->execute()) {
					$success_message = "deleted Successfully";
					echo $success_message ;
				} else {
					$error_message = "Problem in deleteing";
					echo $error_message ;
				}
			$stmt->close();   
			$conn->close();
		 
	 }
}