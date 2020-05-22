<?php
class GuestBook{
    private $connect;
    function __construct(){
        $this->connect = new mysqli("localhost", "root", "", "guestbook");
        if ($this->connect->connect_errno) {
            echo "Failed to connect to MySQL: (" . $this->connect->connect_errno . ") " . $mysqli->connect_error;
        }
        $this->connect->set_charset("utf8");
    }
    function Save($name, $text){
        if($name != "" || $text != ""){
            $prepare = $this->connect->prepare("INSERT INTO guestbook(`name`, `message`)VALUES(?,?)");
          
            $prepare->bind_param('ss',$name, $text);
            $prepare->execute();
            return true;
        }
        return false;
    }

    function List(){
        $query = "SELECT `name`, `message`, `time` FROM `guestbook` ORDER BY `time` DESC";
        $query = $this->connect->query($query);
        $return = "";
        while($row = $query->fetch_assoc()){
           // print_r($row);
            $return .= '<div class="message">
            <div class="row header">
                <div class="name">'.$row['name'].'</div><div class="time">'.$row['time'].'</div>
            </div>
            <div class="row message-body">
                '.$row['message'].'
            </div>
            </div>';
        }
        echo $return;
    }
}
?>