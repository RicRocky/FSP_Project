<?php
require_once "Group.php";

class MemberGroup extends Group
{
    public function AddMemberGroup($username, $idgrup)
    {
        $sql = "SELECT * FROM member_grup WHERE idgrup = ? AND username = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ss", $idgrup, $username);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows == 1) {
            return false;
        }

        // Menambahkan user kedalam grup
        $sql = "INSERT INTO member_grup (idgrup, username) VALUES (?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ss", $idgrup, $username);
        $stmt->execute();

        $stmt->close();
        return true;
    }

    public function JoinGroup($username, $idgrup)
    {
        // Cek apakah grup tersebut ada
        $sql = "SELECT * FROM grup WHERE kode_pendaftaran = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $idgrup);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows == 0) {
            return 0;
        }

        if ($row = $res->fetch_assoc()) {
            $idgrup = $row["idgrup"];
        }

        // Cek apakah user sudah bergabung ke grup tersebut
        $sql = "SELECT * FROM member_grup WHERE idgrup = ? AND username = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ss", $idgrup, $username);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows == 1) {
            return 1;
        }

        // Menambahkan user kedalam grup
        $sql = "INSERT INTO member_grup (idgrup, username) VALUES (?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ss", $idgrup, $username);
        $stmt->execute();

        $stmt->close();
        return 2;
    }

    public function KeluarGroup($username, $idgrup)
    {
        $sql = "DELETE FROM member_grup WHERE username = ? AND idgrup = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ss", $username, $idgrup);
        $stmt->execute();
        return true;
    }

    function DeleteMemberGrupGroup($idgrup)
    {
        $sql = "DELETE FROM member_grup WHERE idgrup = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $idgrup);
        $stmt->execute();
    }

    public function KickMember($nrpOrNpk, $idgrup)
    {
        $sql = "SELECT username FROM akun WHERE nrp_mahasiswa = ? OR npk_dosen = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ss", $nrpOrNpk, $nrpOrNpk);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($row = $res->fetch_assoc()) {
            $sql = "SELECT * FROM grup WHERE idgrup = ? AND username_pembuat = ?";
            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param("is", $idgrup, $row["username"]);
            $stmt->execute();
            $res = $stmt->get_result();

            if ($row = $res->fetch_assoc()) {
                return false;
            }

            $username = $row["username"];

            $sql = "DELETE FROM member_grup 
                WHERE username = ? AND idgrup = ?";

            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param("si", $username, $idgrup);
            $stmt->execute();

            return true;
            die();
        } else {
            return false;
        }
    }
}