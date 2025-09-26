<?php
require_once __DIR__ . '/../db/Connection.php';

class Mahasiswa extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }

    public function GetMahasiswa($nrp = "")
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM mahasiswa WHERE nrp LIKE ?");

        $nrp = "%" . $nrp . "%";
        $stmt->bind_param("s", $nrp);

        $stmt->execute();
        $res = $stmt->get_result();

        $stmt->close();

        return $res;
    }
}