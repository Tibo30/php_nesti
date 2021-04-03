<?php
class UserDAO extends ModelDAO
{
    public function addUser($userAdd)
    {
        $req = self::$_bdd->prepare('INSERT INTO users (lastname,firstname,username,email,password,state,creation_date,address1,address2,postcode,id_city) VALUES (:lastname, :firstname, :username, :email, :password, :state, CURRENT_TIMESTAMP, :address1, :address2, :postcode, :id_city) ');
        $req->execute(array("lastname" => $userAdd->getLastname(), "firstname" => $userAdd->getFirstname(), "username" => $userAdd->getUsername(), "email" => $userAdd->getEmail(), "password" => password_hash($userAdd->getPassword(), PASSWORD_BCRYPT), "state" => $userAdd->getState(), "address1" => $userAdd->getAddress1(), "address2" => $userAdd->getAddress2(), "postcode" => $userAdd->getPostCode(), "id_city" => $userAdd->getIdCity()));
        $last_id = self::$_bdd->lastInsertId();
        $req->closeCursor(); // release the server connection so it's possible to do other query
        return $last_id;
    }

    public function getUsers()
    {
        $var = [];
        $req = self::$_bdd->prepare('SELECT u.id_users, u.lastname, u.firstname, u.username, u.email, u.password, u.state, u.creation_date, u.address1, u.address2, u.postcode,u.id_city FROM users u');
        $req->execute();
        if ($data = $req->fetchAll(PDO::FETCH_ASSOC)) {
            foreach ($data as $row) {
                // know the role
                $roles = $this->getRole($row['id_users']);
                $user = new User();
                $row['roles'] = $roles;
                $var[] = $user->hydration($row);
            }
        }

        $req->closeCursor(); // release the server connection so it's possible to do other query
        return $var;
    }

    public function getLog($idUser)
    {
        $req = self::$_bdd->prepare('SELECT id_users, id_user_logs, connection_date FROM user_logs WHERE id_users=:id ORDER BY connection_date DESC LIMIT 1');
        $req->execute(array("id" => $idUser));
        $userLog = new UserLog();
        if ($data = $req->fetch()) {
            $userLog->hydration($data);
        }
        $req->closeCursor(); // release the server connection so it's possible to do other query
        return $userLog;
    }

    public function getRole($idUser)
    {
        $role = [];
        $reqChief = self::$_bdd->prepare('SELECT id_users FROM chief WHERE id_users=:id');
        $reqAdmin = self::$_bdd->prepare('SELECT id_users FROM admin WHERE id_users=:id');
        $reqModerator = self::$_bdd->prepare('SELECT id_users FROM moderator WHERE id_users=:id');
        $reqChief->execute(array("id" => $idUser));
        $reqAdmin->execute(array("id" => $idUser));
        $reqModerator->execute(array("id" => $idUser));
        if ($reqChief->rowcount() == 1) {
            $role[] = "chief";
        }
        if ($reqAdmin->rowcount() == 1) {
            $role[] = "admin";
        }
        if ($reqModerator->rowcount() == 1) {
            $role[] = "moderator";
        }

        $role[] = "user";

        return $role;
    }

    public function getOneUser($valueId)
    {

        $req = self::$_bdd->prepare('SELECT * FROM users WHERE id_users =:id ');
        $req->execute(array("id" => $valueId));
        $user = new User();
        if ($data = $req->fetch()) {
            $roles = $this->getRole($data['id_users']);
            $data['roles'] = $roles;
            $use = $user->hydration($data);
        }
        $req->closeCursor(); // release the server connection so it's possible to do other query
        return $use;
    }

    public function isEmailOrUsernameTaken($value)
    {
        $exist = false;
        $req = self::$_bdd->prepare('SELECT * FROM users WHERE email =:value OR username=:value ');
        $req->execute(array("value" => $value));
        if ($req->rowcount() == 1) {
            $exist = true;
        }
        $req->closeCursor(); // release the server connection so it's possible to do other query
        return $exist;
    }

    public function getChief($idChief)
    {
        $req = self::$_bdd->prepare('SELECT u.id_users, u.lastname, u.firstname, u.username, u.email, u.password, u.state, u.creation_date, u.address1, u.address2, u.postcode, u.id_city FROM users u JOIN chief ch ON u.id_users = ch.id_users WHERE ch.id_users=:id');
        $req->execute(array("id" => $idChief));
        $chiefUser = new User();
        if ($chief =  $req->fetch()) {
            $chief['roles'] = "Chief";
            $chiefUser->hydration($chief);
        }
        $req->closeCursor(); // release the server connection so it's possible to do other query
        return $chiefUser;
    }

    public function getCity($idCity)
    {
        $req = self::$_bdd->prepare('SELECT id_city, city_name FROM city WHERE id_city=:id');
        $req->execute(array("id" => $idCity));
        $city = new City();
        if ($data = $req->fetch()) {
            $city->hydration($data);
        }
        $req->closeCursor(); // release the server connection so it's possible to do other query
        return $city;
    }
}
