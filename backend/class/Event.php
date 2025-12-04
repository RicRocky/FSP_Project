<?php
require_once __DIR__ . "/Group.php";

class Event extends Group
{
    function GetEventGrup($idgrup)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM event WHERE idgrup=?");
        $stmt->bind_param("i", $idgrup);
        $stmt->execute();
        $res = $stmt->get_result();

        $data = [];
        while ($row = $res->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }
    
    function GetEvent($idevent)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM event WHERE idevent=?");
        $stmt->bind_param("i", $idevent);
        $stmt->execute();
        $res = $stmt->get_result();

        $data = "";
        if ($row = $res->fetch_assoc()) {
            $data = $row;
        }

        return $data;
    }

    

    public function DeleteEventGroup($idgrup)
    {
        $sql = "DELETE FROM event WHERE idgrup = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $idgrup);
        $stmt->execute();
    }

    public function DeleteEvent($idevent)
    {
        $sql = "DELETE FROM event WHERE idevent = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $idevent);
        $stmt->execute();
    }

    public function CreateEvent($idgrup, $username, $judul, $judulSlug, $tanggal, $keterangan, $jenis, $posterExtension)
    {
        if ($this->CheckUser($idgrup, $username)) {
            $sql = "INSERT INTO event(idgrup, judul, `judul-slug`, tanggal, keterangan, jenis, poster_extension) VALUES (?,?,?,?,?,?,?) ";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param("issssss", $idgrup, $judul, $judulSlug, $tanggal, $keterangan, $jenis, $posterExtension);
            $stmt->execute();

            $eventId= $stmt->insert_id;
            
            $stmt->close();            
            return $eventId ;
        } else {
            return -1;
        }
    }
    
    public function UpdateEvent($idevent, $idgrup, $username, $judul, $judulSlug, $tanggal, $keterangan, $jenis, $posterExtension)
    {
        if ($this->CheckUser($idgrup, $username)) {
            $sql = "UPDATE event SET judul = ?, `judul-slug`=?, tanggal = ?, keterangan =?, jenis = ?, poster_extension = ? WHERE idevent = ? ";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param("ssssssi", $judul, $judulSlug, $tanggal, $keterangan, $jenis, $posterExtension, $idevent);
            $stmt->execute();

            $eventId= $stmt->insert_id;
            
            $stmt->close();            
            return $eventId ;
        } else {
            return -1;
        }
    }
}