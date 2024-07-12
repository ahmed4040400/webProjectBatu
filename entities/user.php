<?php
session_start();

abstract class User
{
    const SEEKER = 'seeker';
    const RECRUITER = 'recruiter';

    public $id;
    public $username;
    public $email;

    public $phone;
    public $profileImg;
    public $role;
    protected $password;
    public $createdAt;
    public $updatedAt;

    public function __construct(string $id, string $username, string $email, string $phone, string $profileImg, string $password, $created_at, $updatedAt)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->phone = $phone;
        $this->profileImg = $profileImg;
        $this->password = $password;
        $this->createdAt = $created_at;
        $this->updatedAt = $updatedAt;
    }

    public static function login($email, $password)
    {
        $user = null;
        $qry = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
        require_once ("config.php");
        $db_connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_USER_PASSWORD, DB_NAME);
        $result = mysqli_query($db_connection, $qry);

        if ($data = mysqli_fetch_assoc($result)) {

            if ($data['role'] == User::RECRUITER) {
                $user = new Recruiter($data['id'], $data['username'], $data['email'], $data['phone'], $data['img_path'], $data['password'], $data['created_at'], $data['updated_at']);

            } elseif ($data['role'] == User::SEEKER) {
                $user = new Seeker($data['id'], $data['username'], $data['email'], $data['phone'], $data['img_path'], $data['password'], $data['created_at'], $data['updated_at']);

            }
        }
        mysqli_close($db_connection);

        return $user;



    }

    public function postAPost($content, $imagePath)
    {
        $qry = "INSERT INTO posts (user_id, content, img_path) VALUES ('$this->id', '$content', '$imagePath')";
        require_once ("../../config.php");
        $db_connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_USER_PASSWORD, DB_NAME);
        $result = mysqli_query($db_connection, $qry);
        mysqli_close($db_connection);
        return $result;
    }

    public function getAllPosts()
    {
        $qry = "SELECT posts.*, user.username, user.img_path as userImg  FROM posts INNER JOIN user ON posts.user_id = user.id ORDER BY posts.created_at DESC";
        require_once ("../../config.php");
        $db_connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_USER_PASSWORD, DB_NAME);
        $result = mysqli_query($db_connection, $qry);

        $allData = mysqli_fetch_all($result, MYSQLI_ASSOC);

        mysqli_close($db_connection);

        return $allData;
    }

    public function commentAPost($PostId, $content)
    {
        $qry = "INSERT INTO comment (post_id, user_id, content) VALUES ('$PostId', '$this->id', '$content')";
        require_once ("../../config.php");
        $db_connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_USER_PASSWORD, DB_NAME);
        $result = mysqli_query($db_connection, $qry);
        mysqli_close($db_connection);
        return $result;
    }

    public function getAllComments($PostId)
    {
        $qry = "SELECT comment.*, user.username , user.img_path as userImg FROM comment INNER JOIN user ON comment.user_id = user.id WHERE post_id = '$PostId'";
        require_once ("../../config.php");
        $db_connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_USER_PASSWORD, DB_NAME);
        $result = mysqli_query($db_connection, $qry);

        $allData = mysqli_fetch_all($result, MYSQLI_ASSOC);

        mysqli_close($db_connection);

        return $allData;
    }

    public function editProfileImg($imgPath)
    {

        $qry = "UPDATE user SET img_path = '$imgPath' WHERE id = '$this->id'";
        require_once ("../../config.php");
        $db_connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_USER_PASSWORD, DB_NAME);
        $result = mysqli_query($db_connection, $qry);
        mysqli_close($db_connection);

        $this->profileImg = $imgPath;
        $_SESSION['user'] = serialize($this);


        return $result;
    }
}






// create a class that inherits from user that is called recruiter that has a role of recruiter 
class Recruiter extends User
{

    public $role = User::RECRUITER;


    public static function register($email, $password, $username, $phone)
    {
        $qry = "INSERT INTO user (email, password, username, phone, role) VALUES ('$email', '$password', '$username', '$phone', '" . User::RECRUITER . "')";
        require_once ("config.php");
        $db_connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_USER_PASSWORD, DB_NAME);
        $result = mysqli_query($db_connection, $qry);
        mysqli_close($db_connection);

        return $result;
    }

    public function postAJob($title, $content, $location)
    {
        $userid = $this->id;
        $qry = "INSERT INTO job_post (user_id,title, content, location) VALUES ('$userid','$title', '$content', '$location')";
        require_once ("../../config.php");
        $db_connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_USER_PASSWORD, DB_NAME);
        $result = mysqli_query($db_connection, $qry);
        mysqli_close($db_connection);
        return $result;
    }


    public function getAppliedApplications()
    {
        $qry = 'SELECT ja.*, u.username, jp.title AS jopTitle FROM job_application ja 
                    INNER JOIN user u ON ja.user_id = u.id 
                    INNER JOIN job_post jp ON ja.job_id = jp.id 
                    WHERE ja.job_id IN (SELECT id FROM job_post WHERE user_id = ' . $this->id . ')
                    AND ja.status <> "rejected"';

        require_once ("../../config.php");
        $db_connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_USER_PASSWORD, DB_NAME);
        $result = mysqli_query($db_connection, $qry);

        $allData = mysqli_fetch_all($result, MYSQLI_ASSOC);

        mysqli_close($db_connection);

        return $allData;
    }

    public function approveApplication($applicationId)
    {
        $qry = "UPDATE job_application SET status = 'accepted' WHERE id = $applicationId";
        require_once ("../../config.php");
        $db_connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_USER_PASSWORD, DB_NAME);
        $result = mysqli_query($db_connection, $qry);
        mysqli_close($db_connection);
        return $result;
    }

    public function refuseApplication($applicationId)
    {
        $qry = "UPDATE job_application SET status = 'rejected' WHERE id = $applicationId";
        require_once ("../../config.php");
        $db_connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_USER_PASSWORD, DB_NAME);
        $result = mysqli_query($db_connection, $qry);
        mysqli_close($db_connection);
        return $result;

    }


}

class Seeker extends User
{
    public $role = User::SEEKER;

    public static function register($email, $password, $username, $phone)
    {
        $qry = "INSERT INTO user (email, password, username, phone, role) VALUES ('$email', '$password', '$username', '$phone', '" . User::SEEKER . "')";
        require_once ("config.php");
        $db_connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_USER_PASSWORD, DB_NAME);
        var_dump($db_connection);
        $result = mysqli_query($db_connection, $qry);
        mysqli_close($db_connection);
        return $result;
    }


    public function getAllJobPosts()
    {
        $qry = "SELECT jp.*, u.username,u.img_path as userImg FROM job_post jp INNER JOIN user u ON jp.user_id = u.id";

        require_once ("../../config.php");
        $db_connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_USER_PASSWORD, DB_NAME);
        $result = mysqli_query($db_connection, $qry);

        $allData = mysqli_fetch_all($result, MYSQLI_ASSOC);

        mysqli_close($db_connection);

        // Return the array of all data instead of the $result resource
        return $allData;
    }
    public function sendApplication($jobId, $title, $content)
    {
        $qry = "INSERT INTO job_application (user_id, job_id, title, content) VALUES ('$this->id', '$jobId', '$title', '$content')";
        require_once ("../../config.php");
        $db_connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_USER_PASSWORD, DB_NAME);
        $result = mysqli_query($db_connection, $qry);
        mysqli_close($db_connection);
        return $result;


    }
    public function getMyApplications()
    {
        $qry = 'SELECT ja.*, u.username, j.title AS jopTitle FROM job_application ja 
                    INNER JOIN user u ON ja.user_id = u.id 
                    INNER JOIN job_post j ON ja.job_id = j.id 
                    WHERE ja.user_id = ' . $this->id;

        require_once ("../../config.php");
        $db_connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_USER_PASSWORD, DB_NAME);
        $result = mysqli_query($db_connection, $qry);
        $allData = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_close($db_connection);
        return $allData;

    }

}