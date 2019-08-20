<?php
/**
 * Include classes here
 */

require 'PersonData.php';
require 'Sko.php';
class dbConn
{
    private $mysqli;

    public function __construct()
    {
        //$this->mysqli = new mysqli("localhost","xlol24.skp-dp","pkk2z5qq","xlol24_skp_dp_sde_dk");
        $this->mysqli = new mysqli("localhost","root","","hyppighed");
        $this->mysqli->set_charset('utf8');

    }
    public function sendPersonligToDB(PersonData $personData){

        $query = "INSERT INTO `personligdata`( `navn`, `email`, `alder`, `str`) VALUES (?,?,?,?)";
       $stmt = $this->mysqli->prepare($query);
       $stmt->bind_param("ssii",$personData->getNavn(),$personData->getEmail(),$personData->getAlder(),$personData->getStr());
       $stmt->execute();
    }
    public function getPersonData(){
        /*
         *
         * */
        $query = "SELECT `navn`,`alder` FROM `personligdata`";

        $stmt = $this->mysqli->query($query);
        $html1 = '';
        $count = 1;
        while ($result = $stmt->fetch_assoc()){
            $html1 .= '  <tr>
                           <th scope="row">'.$count.'</th>
                           <td>'.$result['navn'].'</td>'.
                            '<td>'.$result['alder'].'</td>'.
                        '</tr>'
            ;
            $count++;

        }

        return $html1;


    }
    public function getStrAndTotal(){
        $query = "SELECT str ,COUNT(str) as total FROM `personligdata` as pd GROUP BY str";

      $stmt =  $this->mysqli->query($query);
      $array = array();
      while ($result = $stmt->fetch_object()){
            $sko = new Sko($result->str,$result->total);
            $array[] = $sko;
      }

      return $array;
    }


}