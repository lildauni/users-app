<?php
class User
{
    private $link;

    public function __construct()
    {
        $connectData = array(
            'dbserver' => 'localhost',
            'dbuser' => 'root',
            'dbname' => 'users_db',
            'dbpass' => 'root',
        );
        $this->link = mysqli_connect($connectData['dbserver'], $connectData['dbuser'], $connectData['dbpass'], $connectData['dbname']);
        if (mysqli_connect_errno()) {
            echo "Unable to connect " . mysqli_connect_error();
        }
    }

    public function getUsers()
    {
        $sql = 'SELECT * FROM users';
        $result = mysqli_query($this->link, $sql);
        while ($arRes = mysqli_fetch_assoc($result))
            $userData[] = $arRes;
        return $userData;
    }

    public function createUser()
    {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $role = $_POST['role'];
        $status = $_POST['status'];
        $sql = "INSERT INTO `users`(`first_name`, `last_name`, `role`, `status`) VALUES ('$first_name', '$last_name', '$role', '$status')";
        mysqli_query($this->link, $sql);
    }

    public function editUser()
    {
        $id = $_POST['id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $role = $_POST['role'];
        $status = $_POST['status'];
        $sql = "UPDATE `users` SET `first_name`='$first_name',`last_name`='$last_name',`role`='$role',`status`='$status' WHERE users.id='$id'";
        mysqli_query($this->link, $sql);
    }

    public function deleteUser()
    {
        $id = $_POST['id'];
        $sql = "DELETE FROM users WHERE users.id='$id'";
        mysqli_query($this->link, $sql);
    }

    public function getUserById()
    {
        $id = $_POST['id'];
        $sql = "SELECT * FROM users WHERE users.id='$id'";
        $result = mysqli_query($this->link, $sql);
        //return $result;
        while ($arRes = mysqli_fetch_assoc($result))
            $userData[] = $arRes;
        return $userData;
    }

    public function activeUsers()
    {
        foreach ($_POST['id'] as $item) {
            $sql="UPDATE `users` SET `status`='active' WHERE users.id='$item'";
            mysqli_query($this->link, $sql);
        }
    }
    
    public function unactiveUsers()
    {
        foreach ($_POST['id'] as $item) {
            $sql="UPDATE `users` SET `status`='not-active' WHERE users.id='$item'";
            mysqli_query($this->link, $sql);
        }
    }

    public function deleteUsers()
    {
        foreach ($_POST['id'] as $item) {
            $sql="DELETE FROM `users` WHERE users.id='$item'";
            mysqli_query($this->link, $sql);
        }
    }
}
