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

    function CloseAllThreadGroup($idgrup){
        $res = $this->GetThread($idgrup);
        foreach($res as $row){
            $sql = "DELETE FROM chat WHERE idthread = ?";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param("i", $row["idthread"]);
            $stmt->execute();

            $sql = "UPDATE thread SET status = 'Close' WHERE idthread = ?";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param("i", $row["idthread"]);
            $stmt->execute();
        }
    }
    function CloseThread($id){
          $sql = "UPDATE thread SET status = 'Close' WHERE idthread = ?";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
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

    function CreateThread($pembuat, $group){
        $sql = "INSERT INTO thread (username_pembuat, idgrup, tanggal_pembuatan, status) VALUES (?, ?, NOW(), 'Open')";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("si", $pembuat, $group);
        $stmt->execute();
        $stmt->close();
    }

    function GetThreadById($id): array{
        $sql = "SELECT * FROM thread WHERE idthread = ?";
        
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();

        return $res->fetch_assoc();
    }

    function GetGroupId($id): array{
        $sql = "SELECT idgrup FROM thread WHERE idthread = ?";
        
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();

        return $res->fetch_assoc();
    }
}