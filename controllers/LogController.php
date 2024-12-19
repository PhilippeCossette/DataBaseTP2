<?php
namespace App\Controllers;

use App\Models\Log;
use App\Providers\View;
use App\Providers\Auth;

class LogController {
    public static function logVisit($page){
        $log = new Log();

        $logData = [
            "ip_address" => $_SERVER["REMOTE_ADDR"],
            "username" => $_SESSION['user_name'] ?? 'Visiteur', // Username is set to Visiteur if user_name is set and not null
            "visited_page" => $page,
            "visit_date" => date("Y-m-d H:i:s"),
        ];
        $log->createLog($logData);
    }

    public function index(){
        if (!isset($_SESSION['privilege_id']) || $_SESSION['privilege_id'] != 1) {
            header("Location: " . BASE . "/clients");
            exit;
        }
        $logModel = new Log();
        $logs = $logModel->getAll(); // Retrieve all logs from the database
 
        return View::render('logs/index', ['logs' => $logs]); 
    }
}
