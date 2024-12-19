<?php
namespace App\Controllers;

use App\Models\Client;
use App\Models\City;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

class ClientController {

    public function __construct(){
        Auth::session();
    }

    // List all clients with city information
    public function index(){

        LogController::logVisit("Clients List");
        

        $client = new Client;
        $clients = $client->joinSelection('city', 'id', 'city_id', 'name', 'ASC', 'city_name');
        return $clients ? View::render('client/index', ['clients'=>$clients]) : View::render('error', ['message' => 'No clients found']);
    }

    // Show client details with city
    public function show($data = []){
        LogController::logVisit("Client Details");

        if(isset($data['id'])){
            $client = new Client;
            $selectId = $client->selectId($data['id']);
            if($selectId){
                $city = new City;
                $cityData = $city->selectId($selectId['city_id']);
                return View::render('client/show', ['client' => $selectId, 'city' => $cityData]);
            }
        }
        return View::render('error');
    }

    // Display form to create a new client
    public function create(){

        LogController::logVisit("Create Client");

        if (!isset($_SESSION['privilege_id']) || $_SESSION['privilege_id'] != 1) {
            header("Location: " . BASE . "/clients");
            exit;
        }
        $city = new City;
        $cities = $city->select('name');
        return View::render('client/create', ['cities' => $cities]);
    }

    // Store new client after validation
    public function store($data){
        $validator = new Validator;
        // Validate data fields
        $validator->field('name', $data['name'])->min(2)->max(20);
        $validator->field('address', $data['address'])->required();
        $validator->field('phone', $data['phone'])->required()->number()->max(10)->min(8);
        $validator->field('zipcode', $data['zipcode'])->required();
        $validator->field('email', $data['email'])->required();
        $validator->field('city_id', $data['city_id'])->required()->number();

        if($validator->isSuccess()){
            $client = new Client;
            $insert = $client->insert($data); // Insert client
            return $insert ? View::redirect('clients') : View::render('error');
        } else {
            $errors = $validator->getErrors();
            $city = new City;
            $cities = $city->select('name');
            return View::render('client/create', ['errors'=>$errors, 'inputs'=>$data, 'cities'=>$cities]);
        }
    }

    // Display form to edit client data
    public function edit($data = []){

        LogController::logVisit("Client Edit");

        if(isset($data['id'])){
            $client = new Client;
            $selectId = $client->selectId($data['id']);
            if($selectId){
                $city = new City;
                $cities = $city->select('name');
                return View::render('client/edit', ['cities'=>$cities, 'inputs'=>$selectId]);
            }
        }
        return View::render('error');
    }

    // Update client data after validation
    public function update($data = [], $get = []){
        if(isset($get['id'])){
            $validator = new Validator;
            // Validate fields
            $validator->field('name', $data['name'])->min(2)->max(20);
            $validator->field('address', $data['address'])->required();
            $validator->field('phone', $data['phone'])->required()->number()->max(10)->min(8);
            $validator->field('zipcode', $data['zipcode'])->required();
            $validator->field('email', $data['email'])->required();
            $validator->field('city_id', $data['city_id'])->required()->number();

            if($validator->isSuccess()){
                $client = new Client;
                $update = $client->update($data, $get['id']);
                return $update ? View::redirect('client/show?id='.$get['id']) : View::render('error');
            } else {
                $errors = $validator->getErrors();
                $city = new City;
                $cities = $city->select('name');
                return View::render('client/edit', ['errors'=>$errors, 'inputs'=>$data, 'cities'=>$cities]);
            }
        }
        return View::render('error');
    }

    // Delete client
    public function delete($data){
        $client = new Client;
        $delete = $client->delete($data['id']);
        return $delete ? View::redirect('clients') : View::render('error');
    }
}
?>
