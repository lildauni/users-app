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
        $this->link = new mysqli($connectData['dbserver'], $connectData['dbuser'], $connectData['dbpass'], $connectData['dbname']);
    }

    public function getUsers()
    {
        $sql = 'SELECT * FROM users ORDER BY id ASC';
        $result = $this->link->query($sql);
        while ($row = $result->fetch_assoc())
            $users[] = $row;
        return $users;
    }

    public function createUser()
    {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $role = $_POST['role'];
        $status = $_POST['status'];
        $sql = "INSERT INTO `users`(`first_name`, `last_name`, `role`, `status`) VALUES ('$first_name', '$last_name', '$role', '$status')";
        $this->link->query($sql);
        return $this->link->insert_id;
    }

    public function editUser()
    {
        $id = $_POST['id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $role = $_POST['role'];
        $status = $_POST['status'];
        $sql = "UPDATE `users` SET `first_name`='$first_name',`last_name`='$last_name',`role`='$role',`status`='$status' WHERE users.id='$id'";
        $this->link->query($sql);
    }

    public function deleteUser()
    {
        $id = $_POST['id'];
        $sql = "DELETE FROM users WHERE users.id=" . $id;
        $this->link->query($sql);
        return $id;
    }

    public function getUserById($id)
    {
        $sql = "SELECT * FROM users WHERE users.id=" . $id;
        $result = $this->link->query($sql);
        while ($row = $result->fetch_assoc())
            $user = $row;
        return $user;
    }

    public function activeUsers($id)
    {
        $sql = "UPDATE `users` SET `status`='true' WHERE users.id IN ($id)";
        $this->link->query($sql);
    }

    public function unactiveUsers($id)
    {
        $sql = "UPDATE `users` SET `status`='false' WHERE users.id IN ($id)";
        $this->link->query($sql);
    }

    public function deleteUsers($id)
    {
        $sql = "DELETE FROM `users` WHERE users.id IN ($id)";
        $this->link->query($sql);
    }
}
