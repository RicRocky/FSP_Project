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
        if(!is_string($keyword_search) || 
            !is_numeric($limit) ||
            is_string($offset)
        ){
            header("Location: ../../ManageAccount.php");
        }
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

    public function InsertAkun($username, $password, $isadmin = 0, $nrp = 0, $npk = 0)
    {
        if ($nrp != 0) {
            $sqlAkun = "INSERT INTO akun (username, password, nrp_mahasiswa, isadmin) 
                    VALUES (?, ?, ?, ?)";
            $stmt = $this->mysqli->prepare($sqlAkun);
            $stmt->bind_param("sssi", $username, $password, $nrp, $isadmin);
        } else if ($npk != 0) {
            $sqlAkun = "INSERT INTO akun (username, password, npk_dosen, isadmin) 
                    VALUES (?, ?, ?, ?)";
            $stmt = $this->mysqli->prepare($sqlAkun);
            $stmt->bind_param("sssi", $username, $password, $npk, $isadmin);
        } else {
            return false;
        }
        $stmt->execute();
        $stmt->close();
        return true;
    }

    public function UpdateAkun($username, $password, $isadmin = 0, $nrp = 0, $npk = 0)
    {
        if ($nrp != 0) {
            $sqlAkun = "UPDATE akun SET password = ?, nrp_mahasiswa = ?, isadmin = ? 
            WHERE username = ?";
            $stmt = $this->mysqli->prepare($sqlAkun);
            $stmt->bind_param("ssis", $password, $nrp, $isadmin, $username);

        } else if ($npk != 0) {
            $sqlAkun = "UPDATE akun SET password = ?, npk_dosen = ?, isadmin = ? 
            WHERE username = ?";
            $stmt = $this->mysqli->prepare($sqlAkun);
            $stmt->bind_param("ssis", $password, $npk, $isadmin, $username);

        } else {
            return false;
        }
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    public function DeleteAkun($username)
    {
        $sqlAkun = "DELETE FROM akun WHERE username = ?";
        $stmt = $this->mysqli->prepare($sqlAkun);
        $stmt->bind_param("s", $username);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function CheckLogin($username, $password)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM akun WHERE username = ? AND password = ? LIMIT 1");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $res = $stmt->get_result();

        return $res;
    }

    public function GetPass($username)
    {
        $stmt = $this->mysqli->prepare("SELECT password FROM akun WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $res = $stmt->get_result();

        return $res;
    }

    public function ChangePass($username, $passBaru){
        $stmt2 = $this->mysqli->prepare("UPDATE akun SET password = ? WHERE username = ?");
        $stmt2->bind_param("ss", $passBaru, $username);
        $stmt2->execute();
        $res2 = $stmt2->get_result();
    }
}