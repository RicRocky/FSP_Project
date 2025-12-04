<?php

require_once "Group.php";

class Thread extends Group {
    function HapusAllThreadGroup($idgrup){
        $res = $this->GetThread($idgrup);
        foreach($res as $row){
            $sql = "DELETE FROM chat WHERE idthread = ?";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param("i", $row["idthread"]);
            $stmt->execute();

            $sql = "DELETE FROM thread WHERE idthread = ?";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param("i", $row["idthread"]);
            $stmt->execute();
        }
    }

    function GetThread($idgrup = null){
        $sql = "SELECT * FROM thread";

        if(!is_null($idgrup)){
            $sql .= " WHERE idgrup = ?";
        }
        
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $idgrup);
        $stmt->execute();
        $res = $stmt->get_result();

        $hasil = [];
        while($row = $res->fetch_assoc()){
            $hasil[] = $row;
        }

        return $hasil;
    }
}