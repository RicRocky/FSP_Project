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
            $sql .= " WHERE m.nrp LIKE ? OR a.username LIKE ? ";
        }

        if (!is_null($offset)) {
            $sql .= " LIMIT ?, ?";
        }

        $stmt = $this->mysqli->prepare($sql);

        if (!is_null($offset) && $nrp != "") {
            $nrp = "%" . $nrp . "%";
            $stmt->bind_param("ssii", $nrp, $nrp, $offset, $limit);

        } else if (is_null($offset) && $nrp != "") {
            $nrp = "%" . $nrp . "%";
            $stmt->bind_param("ss", $nrp, $nrp);

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
}