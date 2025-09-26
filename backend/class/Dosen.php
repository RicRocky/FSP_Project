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
}