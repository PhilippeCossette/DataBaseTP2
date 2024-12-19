<?php
namespace App\Models;

use App\Models\CRUD;

class User extends CRUD {
    protected $table = "user"; // Table name
    protected $primaryKey = "id"; // Primary key
    protected $fillable = ['name', 'username', 'password', 'email', 'privilege_id']; // Fillable fields

    // Hashes the password using bcrypt
    public function hashPassword($password, $cost = 10){
        $options = ["cost" => $cost];
        return password_hash($password, PASSWORD_BCRYPT, $options);
    }

    // Checks if the provided username and password match a user
    public function checkuser($username, $password){
        $user = $this->unique('username', $username); // Find user by username
        if($user){
            if(password_verify($password, $user['password'])){ // Verify password
                session_regenerate_id(); // Regenerate session ID
                // Store user data in session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['privilege_id'] = $user['privilege_id'];
                $_SESSION['finger_print'] = md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);
                return true;
            } else {
                return false; // Invalid password
            }
        } else {
            return false; // User not found
        }
    }
}
?>
