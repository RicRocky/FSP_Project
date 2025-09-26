<?php
require_once __DIR__ . '/../db/Connection.php';

class Dosen extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }

    public function GetDosen($npk = "")
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM dosen WHERE npk LIKE ?");

        $npk = "%" . $npk . "%";
        $stmt->bind_param("s", $npk);

        $stmt->execute();
        $res = $stmt->get_result();

        $stmt->close();

        return $res;
    }
}