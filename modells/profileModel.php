<?php

class ProfileModel{

    public function  __construct()
    {
        $db = new DB_connection();
        $this->conn = $db->conn;
    }

    public function getAgent(){
        $data = null;
        $query = "SELECT `id`, `name`, `image`, `color`, `agent_id` FROM `agent`";
        
        if($sql = $this->conn->query($query)){
            
            while($row =  mysqli_fetch_assoc($sql)){
                $data[] = $row;
            }
        }

        return $data;
    }

    public function getAgentNumber(){
        $data = null;
        $query = "SELECT `name`, `agent_id`, `color` FROM `agent` ORDER BY agent_id";
        if($sql = $this->conn->query($query)){
            
            while($row =  mysqli_fetch_assoc($sql)){
                $data[] = $row;
            }
        }

        return $data;

    }
    public function insert(){
        if(isset($_POST['submit_agent'])){
            $agentName = htmlspecialchars( $_POST['agentNmae']);
            $agentId = htmlspecialchars( $_POST['agentId']);
            $agentColor = htmlspecialchars($_POST['color']);
            $fileName = $_FILES['image']['name'];
            $fileTmpName = $_FILES['image']['tmp_name'];
            $fileSize = $_FILES['image']['size'];
            $fileError = $_FILES['image']['error'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png');

            if(in_array($fileActualExt, $allowed)){
                if($fileError === 0){
                    if($fileSize < 12500000){
                        $fileNameNew = uniqid('', true).".".$fileActualExt;
                        $fileDestination = 'uploads/'.$fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
                        $image_db  = $fileNameNew;
                        $query = "INSERT INTO `agent`( `name`, `image`, `color`, `agent_id`) VALUES (?, ?, ?, ?)";

                        $stmt = mysqli_prepare($this->conn, $query);
                        if(!$stmt)
                        {
                            echo "sql statment feiled";
                        }
                        else
                        {
                            mysqli_stmt_bind_param($stmt, "sssi", $agentName, $image_db, $agentColor, $agentId);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);

                        }
                        if($stmt == true){
                            echo "<script>alert('You add agent successfuly!');</script>";
                            echo "<script> window.location.href = 'profile.php' </script>";

                        }else{
                            echo "<script>alert('Add agent failed!');</script>";
                            echo "<script> window.location.href = 'addNewAgent.php' </script>";
                        }
                       

                        
                    }else{
                        echo "Error! to big file";
                    }
                }else{
                    echo "Error uploading you file";
                }
            }
            else{
                echo "You cen't allow to upload this file";
            }


            return $result;
        }
    }

    public function update($data){
        $this->fileName = $_FILES['image']['name'];
        $this->fileTmpName = $_FILES['image']['tmp_name'];
        $fileSize = $_FILES['image']['size'];
        $fileError = $_FILES['image']['error'];

        $fileExt = explode('.', $this->fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');

        if(in_array($fileActualExt, $allowed)){
            if($fileError === 0){
                if($fileSize < 12500000){
                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                    $fileDestination = 'uploads/'.$fileNameNew;
                    
                    $image_db  = $fileNameNew;

                }else{
                    echo "Error! to big file";
                }
            }else{
                echo "Error uploading you file";
            }
        }
        else{
            echo "You cen't allow to upload this file";
        }

        $getImageQuery = "SELECT `image` FROM `agent` WHERE `id` = $data[id]";
        $getImgRun = $this->conn->query($getImageQuery);
        foreach($getImgRun as $img){
           
                if($image_db == null)
                {
                    $image_data = $img['image'];
                }
                else{
                    if($img_path = "uploads/".$img['image'])
                    {
                          unlink($img_path);
                        $image_data = $image_db;
                    }
                    
                }
            
        }
        $query = "UPDATE `agent` SET `name`= ?, `image`= ? , `color`= ? WHERE id= ?";
        $stmt = mysqli_prepare($this->conn, $query);
        if(!$stmt)
        {
            echo "sql statment feiled";
        }
        else
        {
            mysqli_stmt_bind_param($stmt, "sssi", $data['name'], $image_data, $data['color'], $data['id']);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_fetch($stmt);

        }
        if($stmt == true){
            if($image_db == null){
                return true;
            }
            else{
                move_uploaded_file($this->fileTmpName, $fileDestination);
                return true;
            }

        }else{
            return false;
        }
    }


    public function editAgent($id){
        $data = null;
        $query = "SELECT `id`, `name`, `image`, `color` FROM `agent` WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();

        while($row = $res->fetch_assoc()){
            $data = $row;
        }

         return $data;
    }

    public function deleteAgent($id){
        $query = "DELETE FROM `agent` WHERE id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
         
        $bind = $stmt->bind_param('i', $id);
         
        // Check if bind_param() failed.
        // bind_param() can fail because the number of parameter doesn't match the placeholders
        // in the statement, or there's a type conflict, or ....
         
        if ( false === $bind ) {
            error_log('bind_param() failed:');
            error_log( print_r( htmlspecialchars($stmt->error), true ) );
            exit();
        }
         
        // Execute the query
         
        $exec = $stmt->execute();
         
        // Check if execute() failed. 
        // execute() can fail for various reasons. And may it be as stupid as someone tripping over the network cable
         
        if ( false === $exec ) {
            error_log('mysqli execute() failed: ');
            error_log( print_r( htmlspecialchars($stmt->error), true ) );
        }
        else{
            echo "delete successfuly";
            header("Location: profile.php");
        }
        // if ($sql = $this->conn->query($query)) {
        //     return true;
        // }else{
        //     return false;
        // }
    }
}
?>