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

    function BacaChatThread($idThread, $username){
        $owner = false;
        $sql = "SELECT 1 FROM thread t WHERE t.username_pembuat = ? AND t.idthread = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("si", $username, $idThread);
        $stmt->execute();
        $res = $stmt->get_result();
        if($res->fetch_assoc()){
            $owner = true;
        }
        
        if(!$owner){
            $sql = "SELECT 1 FROM thread t
                        INNER JOIN grup g ON t.idgrup = g.idgrup
                        INNER JOIN member_grup mg ON mg.idgrup = g.idgrup
                        WHERE mg.username = ? AND t.idthread = ?";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param("si", $username, $idThread);
            $stmt->execute();
            $res = $stmt->get_result();
            if(!$res->fetch_assoc()){
                return 0;
            }
        }

        $sql = "SELECT c.*, d.nama AS namaDosen, m.nama AS namaMahasiswa, a.username FROM chat c
                    INNER JOIN akun a ON c.username_pembuat = a.username
                    LEFT JOIN dosen d ON d.npk=a.npk_dosen
                    LEFT JOIN mahasiswa m ON m.nrp = a.nrp_mahasiswa
                    WHERE c.idthread = ?
                    ORDER BY c.tanggal_pembuatan";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $idThread);
        $stmt->execute();
        $res = $stmt->get_result();
        
        $data = [];
        while($row = $res->fetch_assoc()){
            $data[] = $row;
        }

        return $data;
    }

    function KirimPesan($idThread, $username, $pesan){
        $owner = false;
        $sql = "SELECT 1 FROM thread t WHERE t.username_pembuat = ? AND t.idthread = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("si", $username, $idThread);
        $stmt->execute();
        $res = $stmt->get_result();
        if($res->fetch_assoc()){
            $owner = true;
        }
        
        if(!$owner){
            $sql = "SELECT 1 FROM thread t
                        INNER JOIN grup g ON t.idgrup = g.idgrup
                        INNER JOIN member_grup mg ON mg.idgrup = g.idgrup
                        WHERE mg.username = ? AND t.idthread = ?";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param("si", $username, $idThread);
            $stmt->execute();
            $res = $stmt->get_result();
            if(!$res->fetch_assoc()){
                return 0;
            }
        }

        $sql = "INSERT INTO chat(idthread, username_pembuat, isi, tanggal_pembuatan) VALUES (?, ?, ?, NOW())";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("iss", $idThread, $username, $pesan);
        $stmt->execute();
        return 1;
    }
}