<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\Privilege;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

class UserController {

    public function __construct(){
        Auth::session(); // Ensure the user session is active
        Auth::privilege(1); // Restrict access to users with privilege level 1
    }

    public function create(){
        LogController::logVisit("User Create"); // Log visit to the user creation page

        $privilege = new Privilege;
        $privileges = $privilege->select(); // Fetch all privileges
        return View::render('user/create', ['privileges' => $privileges]); // Render the create view with privileges
    }

    public function store($data){
        $validator = new Validator;
        // Validate user inputs
        $validator->field('name', $data['name'])->min(2)->max(50);
        $validator->field('username', $data['username'])->min(2)->max(50)->unique('User');
        $validator->field('password', $data['password'])->min(6)->max(20);
        $validator->field('privilege_id', $data['privilege_id'], "Privilege")->required()->number();

        if($validator->isSuccess()){
            $user = new User;
            $data['email'] = $data['username']; // Set email as username
            $data['password'] = $user->hashPassword($data['password']); // Hash the password
            $insert = $user->insert($data); // Insert user data into the database
            if($insert){
                return View::redirect('login'); // Redirect to login on success
            }else{
                return View::render('error'); // Render error page on failure
            }
        }else{
            $errors = $validator->getErrors(); // Get validation errors
            $privilege = new Privilege;
            $privileges = $privilege->select(); // Fetch privileges for re-rendering
            return View::render('user/create', ['errors'=>$errors, 'inputs'=>$data, 'privileges' => $privileges]); // Re-render form with errors and inputs
        }
    }

}
?>
