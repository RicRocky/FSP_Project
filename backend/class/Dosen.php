<?php
require_once __DIR__ . '/../db/Connection.php';

class Dosen extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }

    public function GetDosen($limit = 10, $offset = null, $npk = "")
    {
        $sql = "SELECT * FROM akun a INNER JOIN dosen d ON a.npk_dosen = d.npk";
        if ($npk != "") {
            $sql .= " WHERE d.npk LIKE ? OR a.username LIKE ? ";
        }

        $sql .= " ORDER BY npk DESC";

        if (!is_null($offset)) {
            $sql .= " LIMIT ?, ?";
        }

        $stmt = $this->mysqli->prepare($sql);

        if (!is_null($offset) && $npk != "") {
            $npk = "%" . $npk . "%";
            $stmt->bind_param("ssii", $npk, $npk, $offset, $limit);

        } else if (is_null($offset) && $npk != "") {
            $npk = "%" . $npk . "%";
            $stmt->bind_param("ss", $npk, $npk);

        } else if (!is_null($offset) && $npk == "") {
            $stmt->bind_param("ii", $offset, $limit);
        }

        $stmt->execute();
        $res = $stmt->get_result();

        $stmt->close();

        return $res;
    }

    public function getTotalData($limit, $offset, $keyword_search)
    {
        $res = $this->GetDosen($limit, $offset, $keyword_search);
        return $res->num_rows;
    }

    public function InsertDosen($npk, $nama, $foto_extension)
    {
        $sqlDosen = "INSERT INTO dosen (npk, nama, foto_extension) VALUES (?, ?, ?)";
        $stmt = $this->mysqli->prepare($sqlDosen);
        $stmt->bind_param("sss", $npk, $nama, $foto_extension);
        $stmt->execute();
        $insert_id = $stmt->insert_id;
        $stmt->close();

        return $insert_id;
    }
    public function UpdateDosen($npk, $nama, $foto_extension)
    {
        $sqlDosen = "UPDATE dosen SET nama = ?, foto_extension = ? WHERE npk = ?";
        $stmt = $this->mysqli->prepare($sqlDosen);
        $stmt->bind_param("sss", $nama, $foto_extension, $npk);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function DeleteDosen($npk)
    {
        $sqlDosen = "DELETE FROM dosen WHERE npk = ?";
        $stmt = $this->mysqli->prepare($sqlDosen);
        $stmt->bind_param("s", $npk);
        $result = $stmt->execute();
        $stmt->close();

        return $result; 
    }


}