<?php
require_once __DIR__ . '/../db/Connection.php';

class Akun extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }

    public function GetAccount($keyword_search = "", $limit = 10, $offset = null)
    {
        $sql = "SELECT * FROM akun a";
        if ($keyword_search != "") {
            $sql .= " WHERE nrp_mahasiswa LIKE ? OR npk_dosen LIKE ? OR username LIKE ? ";
        }

        if (!is_null($offset)) {
            $sql .= " LIMIT ?, ?";
        }

        $stmt = $this->mysqli->prepare($sql);

        if (!is_null($offset) && $keyword_search != "") {
            $keyword_search = "%" . $keyword_search . "%";
            $stmt->bind_param("sssii", $keyword_search, $keyword_search, $keyword_search, $offset, $limit);

        } else if (is_null($offset) && $keyword_search != "") {
            $keyword_search = "%" . $keyword_search . "%";
            $stmt->bind_param("sss", $keyword_search, $keyword_search, $keyword_search);
        
        } else if (!is_null($offset) && $keyword_search == "") {
            $stmt->bind_param("ii", $offset, $limit);
        }

        $stmt->execute();
        $res = $stmt->get_result();

        $stmt->close();

        return $res;
    }

    public function getTotalData($keyword_search)
    {
        $res = $this->GetAccount($keyword_search);
        return $res->num_rows;
    }
}