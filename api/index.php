<?php
session_start();
// Vis PHP fejl i browseren
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

//Ingen visning af PHP fejl i browseren
error_reporting(0);
// Inkluder klassen dbConn
include_once 'class/dbConn.php';
// Instantier et objekt af klassen dbConn
$conn = new dbConn();

// Hent HTTP request method (header)
$method = $_SERVER['REQUEST_METHOD'];
// Hent Uri til ressourcen
$uri = $_SERVER['REQUEST_URI'];

// Formater URI, slet unødig sti info
$tempUri = explode('/', $uri);
foreach ($tempUri AS $key => $val) {
    unset($tempUri[$key]);
    if ($val === 'api') {
        break;
    }
}
// Gem uri ressourcer i $uri som array
$uri = array_values($tempUri);

$headers = apache_request_headers();
$accept = str_replace(' ', '', $headers['Accept']);
$accept = explode(',', $accept);

switch ($method){
    case 'GET':
        // Alle get requests her
        // api/router/input_form
        if($uri[0] === "router" && $uri[1] === "input_form"){

            // output reponse in JSON
            if(in_array('application/json', $accept)){
                header("Content-Type: application/json; charset=utf-8");
                $html  = "                
                    <form>   
                    <input id='inputNavn' type='text' placeholder='navn'>
                    <input id='inputEmail' type='text' placeholder='email'>
                    <input id='inputAlder' type='number' placeholder='alder'>
                    <input id='inputSko' type='number' placeholder='sko str'>
                    <input id='inputSubmit' type='button' value='Send'>
                    </form>
                ";
                echo $html;
            }
            else {
                http_response_code(404);
                echo '412 - Wrong Accept type. Only JSON supported!';
            }

        }
        elseif ($uri[0] === "router" && $uri[1] === "person_data"){

            if(in_array('application/json', $accept)) {
                header("Content-Type: application/json; charset=utf-8");

                $data = $conn->getPersonData();
                $html = '    <div style="width: 600px;text-align: center;">
                           <table class="table table-dark table-striped ">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Navn</th>
                              <th scope="col">Alder</th>
                            </tr>
                          </thead>
                          <tbody>' .
                    $data
                    . '
                          </tbody>
                        </table>
            </div>
            ';
                echo $html;
            }
        }
        // api/person_data/str
        elseif ($uri[0] === 'person_data' && $uri[1] === 'str')
        {
            if(in_array('application/json', $accept)) {
                header("Content-Type: application/json; charset=utf-8");

                $data = $conn->getStrAndTotal();
                echo json_encode($data);
            }

        }
        else {
            http_response_code(404);
            echo '404 - Not found!';
        }

        break;
    case 'POST':

        // Alle POST requests her
        // api/send/person/data
        if ($uri[0] === 'send' && $uri[1] === 'person' && $uri[2] === 'data'){
                if ($headers['Content-Type'] === 'application/json') {
                    $result = json_decode(file_get_contents('php://input'));
                    $personData = new PersonData($result->navn,$result->email,$result->alder,$result->str);
                    $conn->sendPersonligToDB($personData);
                }

        }
        else {
            http_response_code(404);
            echo '404 - Not founds!';
            die();
        }


        break;

    default:
        // Forkert HTTP method!
        http_response_code(405);
        echo '405 - Bad request method!';
        die();
}

