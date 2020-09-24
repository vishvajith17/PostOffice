<?php


require_once APPROOT .'/models/Chat.php'; 
require_once APPROOT .'/models/User.php'; 

class ChatBoxController extends Controller{
    private $chatModel;
    private $userModel;

    public function __construct(){
        $this->chatModel = new Chat();
        $this->userModel = new User();
    }

    public function loadChats(){
        session_start();
        $username = $_SESSION['username'];
        echo json_encode($this->chatModel->getChats($username));

    }

    public function getChatMessages(){
        session_start();
        $username = $_SESSION['username'];
        $receiver = $_POST['receiver'];
        $data = $this->chatModel->getReceivedMessages($username, $receiver);
        echo json_encode($data);
    }

    public function sendReply(){
        session_start();
        $sender = $_SESSION['username'];
        $content = $_POST['content'];
        $receiver = $_POST['receiver'];
        if($sender == $receiver){
            echo "Message Not Sent...";
            return;
        }else{
            $this->chatModel->sendMessage($sender,$receiver, $content);
            echo "Message Sent Successfully...";
        }
    }   
       

    public function getUsers(){
        $username = $_POST['name'];
        $list = $this->userModel->getUsersList($username);
        echo json_encode($list);


    }

    public function checkUserExist(){
        $username = $_POST['name'];
        if(!isset($username)){
            echo false;
            return;
        }
        $exists = $this->userModel->userExists($username);
        echo $exists;
    }










}