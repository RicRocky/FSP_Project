<?php
require_once __DIR__ . '/../db/Connection.php';

class Mahasiswa extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }

    public function GetMahasiswa($limit = 10, $offset = null, $nrp = "")
    {
        $sql = "SELECT * FROM akun a INNER JOIN mahasiswa m ON a.nrp_mahasiswa = m.nrp";
        if ($nrp != "") {
            $sql .= " WHERE m.nrp LIKE ? OR a.username LIKE ? OR m.nama LIKE ? ";
        }

        if (!is_null($offset)) {
            $sql .= " LIMIT ?, ?";
        }

        $stmt = $this->mysqli->prepare($sql);

        if (!is_null($offset) && $nrp != "") {
            $nrp = "%" . $nrp . "%";
            $stmt->bind_param("sssii", $nrp, $nrp, $nrp, $offset, $limit);

        } else if (is_null($offset) && $nrp != "") {
            $nrp = "%" . $nrp . "%";
            $stmt->bind_param("sss", $nrp, $nrp, $nrp);

        } else if (!is_null($offset) && $nrp == "") {
            $stmt->bind_param("ii", $offset, $limit);
        }

        $stmt->execute();
        $res = $stmt->get_result();

        $stmt->close();

        return $res;
    }

    public function getTotalData($limit, $offset, $keyword_search)
    {
        $res = $this->GetMahasiswa($limit, $offset, $keyword_search);
        return $res->num_rows;
    }

    public function InsertMahasiswa($nrp, $nama, $gender, $tanggal_lahir, $angkatan, $foto_extention)
    {
        $sqlMahasiswa = "INSERT INTO mahasiswa (nrp, nama, gender, tanggal_lahir, angkatan,
    foto_extention) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->mysqli->prepare($sqlMahasiswa);
        $stmt->bind_param(
            "ssssss",
            $nrp,
            $nama,
            $gender,
            $tanggal_lahir,
            $angkatan,
            $foto_extention
        );
        $stmt->execute();
        $stmt->close();

        return true;
    }
    public function UpdateMahasiswa($nrp, $nama, $gender, $tanggal_lahir, $angkatan, $foto_extention)
    {
        $sqlMahasiswa = "UPDATE mahasiswa SET nama = ?, gender = ?, tanggal_lahir = ?, 
    angkatan = ?, foto_extention = ? WHERE nrp = ?";
        $stmt = $this->mysqli->prepare($sqlMahasiswa);
        $stmt->bind_param("ssssss", $nama, $gender, $tanggal_lahir, $angkatan, $foto_extention, $nrp);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }
    public function DeleteMahasiswa($nrp)
    {
        $sqlMahasiswa = "DELETE FROM mahasiswa WHERE nrp = ?";
        $stmt = $this->mysqli->prepare($sqlMahasiswa);
        $stmt->bind_param("s", $nrp);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }



}