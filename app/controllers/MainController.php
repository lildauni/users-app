<?php
class MainController
{
    public $status = true;
    public $error = null;
    public $user = array();

    public function getUsers()
    {
        $data = new User();
        $this->user = $data->getUsers();
        if (empty($this->user)) {
            $this->status = false;
            $this->error = [
                "code" => 100,
                "message" => "No users found"
            ];
            echo json_encode(['status' => $this->status, 'error' => $this->error]);
            return null;
        }
        echo json_encode(['status' => $this->status, 'error' => $this->error, 'user' => $this->user]);
    }

    public function createUser()
    {
        foreach ($_POST as $item) {
            if (empty($item)) {
                $this->status = false;
                $this->error = [
                    "code" => 300,
                    "message" => "Fill empty fields"
                ];
                echo json_encode(['status'=>$this->status, 'error' => $this->error]);
                return null;
            }
        }
        $data = new User();
        $data->createUser();
        echo json_encode(['status' => $this->status, 'error' => $this->error, 'user' => $this->user]);
    }

    public function deleteUser()
    {
        $data = new User();
        $data->deleteUser();
        echo json_encode(['status' => $this->status, 'error' => $this->error, 'user' => $this->user]);
    }

    public function getUserById()
    {
        $data = new User();
        $this->user = $data->getUserById();
        echo json_encode(['status' => $this->status, 'error' => $this->error, 'user' => $this->user]);
    }

    public function editUser()
    {
        foreach ($_POST as $item) {
            if (empty($item)) {
                $this->status = false;
                $this->error = [
                    "code" => 300,
                    "message" => "Fill empty fields"
                ];
                echo json_encode(['status'=>$this->status, 'error' => $this->error]);
                return null;
            }
        }
        $data = new User();
        $data->editUser();
        echo json_encode(['status' => $this->status, 'error' => $this->error, 'user' => $this->user]);
    }

    public function activeUsers()
    {
        $data = new User();
        $data->activeUsers();
        echo json_encode(['status' => $this->status, 'error' => $this->error, 'user' => $this->user]);
    }

    public function unactiveUsers()
    {
        $data = new User();
        $data->unactiveUsers();
        echo json_encode(['status' => $this->status, 'error' => $this->error, 'user' => $this->user]);
    }

    public function deleteUsers()
    {
        $data = new User();
        $data->deleteUsers();
        echo json_encode(['status' => $this->status, 'error' => $this->error, 'user' => $this->user]);
    }
}
