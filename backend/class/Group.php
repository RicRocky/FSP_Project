<?php
require_once __DIR__ . '/../db/Connection.php';

class Group extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }

    public function GetGroup($keyword_search = "", $limit = 10, $offset = null)
    {
        if (!is_string($keyword_search) || !is_numeric($limit) || is_string($offset)) {
            header("Location: ../../ManageGroup.php");
        }

        $sql = "SELECT * FROM grup";
        if ($keyword_search != "")
            $sql .= " WHERE nama LIKE ? OR idgrup LIKE ? OR deskripsi LIKE ? OR jenis LIKE ?";
        if (!is_null($offset))
            $sql .= " LIMIT ?, ?";

        $stmt = $this->mysqli->prepare($sql);
        if (!is_null($offset) && $keyword_search != "") {
            $keyword_search = "%" . $keyword_search . "%";
            $stmt->bind_param("ssssii", $keyword_search, $keyword_search, $keyword_search, $keyword_search, $offset, $limit);

        } else if (is_null($offset) && $keyword_search != "") {
            $keyword_search = "%" . $keyword_search . "%";
            $stmt->bind_param("ssss", $keyword_search, $keyword_search, $keyword_search, $keyword_search);

        } else if (!is_null($offset) && $keyword_search == "") {
            $stmt->bind_param("ii", $offset, $limit);
        }

        $stmt->execute();
        $res = $stmt->get_result();

        $stmt->close();

        return $res;
    }

    public function GetGroupPublik($userid = null, $limit = 10, $offset = null)
    {
        if (!is_numeric($limit) || is_string($offset)) {
            header("Location: ../../ManageGroup.php");
        }

        $sql = "SELECT * FROM grup g";
        if (!is_null($userid)) {
            $sql .= " LEFT JOIN member_grup mg ON g.idgrup = mg.idgrup";
        }

        $sql .= " WHERE g.jenis LIKE '%Publik%'";

        if (!is_null($userid)) {
            $sql .= " AND mg.username IS NULL";
        }

        if (!is_null($offset))
            $sql .= " LIMIT ?, ?";

        $stmt = $this->mysqli->prepare($sql);
        if (!is_null($offset)) {
            $stmt->bind_param("ii", $offset, $limit);
        }

        $stmt->execute();
        $res = $stmt->get_result();

        $stmt->close();

        return $res;
    }

    public function GetGroupMember($keyword_search = "", $limit = 10, $offset = null)
    {
        if (!is_string($keyword_search) || !is_numeric($limit) || is_string($offset)) {
            header("Location: ../../ManageGroupMahasiswa.php");
        }

        $sql = "SELECT * FROM grup g INNER JOIN member_grup mg ON g.idgrup = mg.idgrup INNER JOIN akun a ON a.username = mg.username";
        if ($keyword_search != "") {
            $sql .= " WHERE (g.nama LIKE ? OR g.idgrup LIKE ? OR g.deskripsi LIKE ? OR mg.username LIKE ?)";
        }

        if (!is_null($offset)) {
            $sql .= " LIMIT ?, ?";
        }

        $stmt = $this->mysqli->prepare($sql);

        if (!is_null($offset) && $keyword_search != "") {
            $keyword_search = "%" . $keyword_search . "%";
            $stmt->bind_param("ssssii", $keyword_search, $keyword_search, $keyword_search, $keyword_search, $offset, $limit);

        } else if (is_null($offset) && $keyword_search != "") {
            $keyword_search = "%" . $keyword_search . "%";
            $stmt->bind_param("ssss", $keyword_search, $keyword_search, $keyword_search, $keyword_search);

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
        $res = $this->GetGroup($keyword_search);
        return $res->num_rows;
    }

    public function InsertGroup($username, $nama, $deskripsi, $tgl, $jenis)
    {
        $sqlGroup = "INSERT INTO grup (username_pembuat, nama, deskripsi, tanggal_pembentukan, jenis) 
                    VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->mysqli->prepare($sqlGroup);
        $stmt->bind_param("sssss", $username, $nama, $deskripsi, $tgl, $jenis);
        $stmt->execute();
        $id = $this->mysqli->insert_id;
        $stmt->close();

        $kode = "G" . $id . rand(1000, 9999);
        $sqlKode = "UPDATE grup SET kode_pendaftaran = ? WHERE idgrup = ?";
        $stmt = $this->mysqli->prepare($sqlKode);
        $stmt->bind_param("si", $kode, $id);
        $stmt->execute();
        $stmt->close();

        return true;
    }

    public function EditGroup($id, $name, $type)
    {
        $sqlGroup = "UPDATE grup SET nama = ?, jenis = ? WHERE idgrup = ?";
        $stmt = $this->mysqli->prepare($sqlGroup);
        $stmt->bind_param("ssi", $name, $type, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    public function GetGroupById($id = 0)
    {
        $sql = "SELECT * FROM grup WHERE idgrup = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();

        $stmt->close();

        return $res->fetch_assoc();
    }

    public function GetMahasiswaDosenGroup($idgrup)
    {
        $sql = "SELECT m.nrp as NRP, m.nama as NamaMahasiswa, d.npk as NPK, d.nama as NamaDosen FROM grup g INNER JOIN member_grup mg ON g.idgrup = mg.idgrup";
        $sql .= " INNER JOIN akun a ON a.username = mg.username";
        $sql .= " LEFT JOIN mahasiswa m ON m.nrp = a.nrp_mahasiswa";
        $sql .= " LEFT JOIN dosen d ON d.npk = a.npk_dosen";
        $sql .= " WHERE g.idgrup = ?";

        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $idgrup);
        $stmt->execute();
        $res = $stmt->get_result();

        $hasil = [];
        while ($row = $res->fetch_assoc()) {
            $hasil[] = $row;
        }

        $sql = "SELECT 
            m.nrp AS NRP, 
            m.nama AS NamaMahasiswa, 
            d.npk AS NPK, 
            d.nama AS NamaDosen
        FROM grup g
        INNER JOIN akun a ON a.username = g.username_pembuat
        LEFT JOIN mahasiswa m ON m.nrp = a.nrp_mahasiswa
        LEFT JOIN dosen d ON d.npk = a.npk_dosen
        WHERE g.idgrup = ? ";

        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $idgrup);
        $stmt->execute();
        $res = $stmt->get_result();

        while ($row = $res->fetch_assoc()) {
            $hasil[] = $row;
        }

        return $hasil;
    }

    public function HapusGrup($idgrup)
    {
        $thread = new Thread();
        $thread->HapusAllThreadGroup($idgrup);

        $event = new Event();
        $event->DeleteEventGroup($idgrup);

        $memberGroup = new MemberGroup();
        $memberGroup->DeleteMemberGrupGroup($idgrup);

        $sql = "DELETE FROM grup WHERE idgrup = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $idgrup);
        $stmt->execute();
    }

    public function CheckUser($idgrup, $username){
        $sql = "SELECT * FROM grup g LEFT JOIN member_grup mg ON mg.idgrup = g.idgrup WHERE g.idgrup = ? AND (g.username_pembuat = ? OR mg.username = ? )";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("iss", $idgrup, $username, $username);
        $stmt->execute();
        $res = $stmt->get_result();
        if($res->num_rows > 0){
            return true;
        }else{
            return false;
        }
    }
}