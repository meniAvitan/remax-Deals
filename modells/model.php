<?php

class Model{
    public function  __construct()
    {
        $db = new DB_connection();
        $this->conn = $db->conn;
    }

    

    public function getDeals(){
        $data = null;
        $query = "SELECT d.id as deal_id, d.address, d.type, d.price, a.id as a_id, a.name, a.image, a.color, a.agent_id 
        FROM deals d LEFT JOIN agent_deal ad ON d.id = ad.deal_id 
        LEFT JOIN agent a ON a.agent_id = ad.agent_id GROUP BY d.id;";
        
        if($sql = $this->conn->query($query)){
            
            while($row =  mysqli_fetch_assoc($sql)){
                $data[] = $row;
            }
        }
        return $data;
    }

    public function editDeal($id){
        $data = null;
        $query = "SELECT d.id , d.address, d.type, d.price, a.name 
        FROM deals d LEFT JOIN agent_deal ad ON d.id = ad.deal_id 
        LEFT JOIN agent a ON a.agent_id = ad.agent_id WHERE d.id = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        
        while($row = $res->fetch_assoc()){
            $data = $row;
        }
        return $data;
    }

    public function updateDeal($data){

        $query = "UPDATE deals d LEFT JOIN agent_deal ad ON d.id = ad.deal_id LEFT JOIN agent a ON a.agent_id = ad.agent_id SET d.address = '$data[address]' , d.type = '$data[typeDeal]' , d.price = '$data[price]' , ad.agent_id = '$data[agent_id]' WHERE d.id = '$data[id]'";
        if ($sql = $this->conn->query($query)) {
            return true;
        }else{
            return false;
        }
        // $stmt = mysqli_prepare($this->conn, $query);
        // if(!$stmt)
        // {
        //     echo "sql statment feiled";
        // }
        // else
        // {
        //     mysqli_stmt_bind_param($stmt, "ssiii", $data['address'], $data['typeDeal'], $data['price'], $data['agent_id'], $data['id'] );
        //     mysqli_stmt_execute($stmt);
        //     mysqli_stmt_fetch($stmt);

        // }
        // if($stmt == true){
        //     var_dump($stmt);
        //         print_r($stmt);
            
         

        // }else{
        //     var_dump($stmt);
        //     print_r($stmt);
        // }
    }

    public function insertGroup(){
        if(isset($_POST['submit'])){
            $group = htmlspecialchars($_POST['cardsGroup']);


            $query1 = "INSERT INTO `deals`( `address`, `type`, `price`, `agent_id`, `card_group_id`) VALUES ('','','', '','$group')";
            
            $result = $this->conn->query($query1);
           
            if($result){
                $lst = $this->conn->insert_id;
                $query2 = "INSERT INTO `agent_deal`(`agent_id`, `deal_id`) VALUES ('99','$lst')";
                $result2 = $this->conn->query($query2);
                if($result2){
                    echo "<script>alert('You add group successfuly!');</script>";
                    echo "<script> window.location.href = 'index.php' </script>";
                }else{
                    echo "<script>alert('Add group failed!');</script>";
                    echo "<script> window.location.href = 'addCards.php' </script>";
                }

            }else{
                echo "<script>alert('Add group failed!');</script>";
                echo "<script> window.location.href = 'addCards.php' </script>";

            }
            return $result;
        }
    }

    public function insert(){
        if(isset($_POST['submit_deal'])){
            $agentNameId = htmlspecialchars( $_POST['agentName']);
            $address = htmlspecialchars( $_POST['address']);
            $typeDeal = htmlspecialchars( $_POST['typeDeal']);
            $price = htmlspecialchars( $_POST['price']);


            $query1 = "INSERT INTO `deals`( `address`, `type`, `price`, `agent_id`) VALUES ('$address','$typeDeal','$price', '$agentNameId')";
            
            $result = $this->conn->query($query1);
           
            if($result){
                $lst = $this->conn->insert_id;
                $query2 = "INSERT INTO `agent_deal`(`agent_id`, `deal_id`) VALUES ('$agentNameId','$lst')";
                $result2 = $this->conn->query($query2);
                if($result2){
                    echo "<script>alert('You add deal successfuly!');</script>";
                    echo "<script> window.location.href = 'index.php' </script>";
                }else{
                    echo "<script>alert('Add deal failed!');</script>";
                    echo "<script> window.location.href = 'addNewDeal.php' </script>";
                }

            }else{
                echo "<script>alert('Add deal failed!');</script>";
                echo "<script> window.location.href = 'addNewDeal.php' </script>";

            }
            return $result;
        }
    }
}
?>