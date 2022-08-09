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
        $required = [
            'first_name' => 'First name',
            'last_name' => 'Last Name'
        ];
        foreach ($required as $field => $value) {
            if (empty($_POST[$field])) {
                $this->status = false;
                $this->error = [
                    "code" => 300,
                    "message" => "Fill the \"$value\" field"
                ];
                echo json_encode(['status' => $this->status, 'error' => $this->error]);
                return null;
            }
        }
        $data = new User();
        $user_id = $data->createUser();
        echo json_encode([
            'status' => $this->status,
            'error' => $this->error,
            'user' => [
                'id' => $user_id[0],
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'role' => $_POST['role'],
                'status' => $_POST['status']
            ]
        ]);
    }


    public function getUserById()
    {
        $data = new User();
        $this->user = $data->getUserById($_POST['id']);
        if (empty($this->user)) {
            $this->status = false;
            $this->error = [
                "code" => 100,
                "message" => "User does not exist"
            ];
            echo json_encode(['status' => $this->status, 'error' => $this->error, 'id' => $_POST['id']]);
            return null;
        }
        echo json_encode([
            'status' => $this->status,
            'error' => $this->error, 
            'user' => [
                'id' => $this->user[0]['id'],
                'first_name' => $this->user[0]['first_name'],
                'last_name' => $this->user[0]['last_name'],
                'role' => $this->user[0]['role'],
                'status' => $this->user[0]['status']
            ]]);
    }

    public function editUser()
    {
        $required = [
            'first_name' => 'First name',
            'last_name' => 'Last Name'
        ];
        foreach ($required as $field => $value) {
            if (empty($_POST[$field])) {
                $this->status = false;
                $this->error = [
                    "code" => 300,
                    "message" => "Fill the \"$value\" field"
                ];
                echo json_encode(['status' => $this->status, 'error' => $this->error]);
                return null;
            }
        }
        $data = new User();
        $data->editUser();
        echo json_encode([
            'status' => $this->status,
            'error' => $this->error,
            'user' => [
                'id' => $_POST['id'],
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'role' => $_POST['role'],
                'status' => $_POST['status']
            ]
        ]);
    }
    public function deleteUser()
    {
        $data = new User();
        $id = $data->deleteUser();
        echo json_encode([
            'status' => $this->status,
            'error' => $this->error,
            'id' => $id
        ]);
    }

    public function activeUsers()
    {
        $data = new User();
        $str=rtrim($_POST['id'], ",");
        $id=explode(",", $str);
        foreach($id as $item){
            $this->user = $data->getUserById($item);
            if (empty($this->user)) {
                $this->status = false;
                $this->error = [
                    "code" => 100,
                    "message" => "User does not exist"
                ];
                echo json_encode(['status' => $this->status, 'error' => $this->error, 'id' => $item]);
                return null;
            }
        }
        $id = $data->activeUsers();
        echo json_encode([
            'status' => $this->status,
            'error' => $this->error,
            'id' => $id
        ]);
    }

    public function unactiveUsers()
    {
        $data = new User();
        $str=rtrim($_POST['id'], ",");
        $id=explode(",", $str);
        foreach($id as $item){
            $this->user = $data->getUserById($item);
            if (empty($this->user)) {
                $this->status = false;
                $this->error = [
                    "code" => 100,
                    "message" => "User does not exist"
                ];
                echo json_encode(['status' => $this->status, 'error' => $this->error, 'id' => $item]);
                return null;
            }
        }
        $id = $data->unactiveUsers();
        echo json_encode([
            'status' => $this->status,
            'error' => $this->error,
            'id' => $id
        ]);
    }

    public function deleteUsers()
    {
        $data = new User();
        $id = $data->deleteUsers();
        echo json_encode([
            'status' => $this->status,
            'error' => $this->error,
            'id' => $id
        ]);
    }
}
