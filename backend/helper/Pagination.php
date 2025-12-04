<?php

function GeneratePageNumberMahasiswa(
    $DATA_PER_PAGE,
    $TOTAL_DATA_MAHASISWA,
    $TOTAL_DATA_DOSEN,
    $CARI,
    $HALAMAN_KE_MAHASISWA,
    $CARI_DOSEN,
    $HALAMAN_KE_DOSEN,
    $idgrup = null
) {
    if (
        (
            !is_numeric($DATA_PER_PAGE) ||
            !is_numeric($TOTAL_DATA_MAHASISWA) ||
            !is_numeric($TOTAL_DATA_DOSEN) ||
            !is_numeric($HALAMAN_KE_MAHASISWA) ||
            !is_numeric($HALAMAN_KE_DOSEN)
        ) && $_SESSION["isadmin"] == 1
    ) {
    } else if (
        (
            !is_numeric($DATA_PER_PAGE) ||
            !is_numeric($TOTAL_DATA_MAHASISWA) ||
            !is_numeric($TOTAL_DATA_DOSEN) ||
            !is_numeric($HALAMAN_KE_MAHASISWA) ||
            !is_numeric($HALAMAN_KE_DOSEN)
        ) && $_SESSION["role"] == "dosen"
    ) {
        header("Location: ../../ManageMemberGrup.php");
    }

    $MAX_PAGE_MAHASISWA = ceil($TOTAL_DATA_MAHASISWA / $DATA_PER_PAGE);

    // Cek posisi halaman sekarang
    $hasil = "";
    if ($MAX_PAGE_MAHASISWA > 1) {
        if ($HALAMAN_KE_MAHASISWA > 1) {
            if (is_null($idgrup)) {
                $hasil .= "<a href='?pageMahasiswa=" . ($HALAMAN_KE_MAHASISWA - 1) .
                    "&cariMahasiswa=" . $CARI .
                    "&cariDosen=" . $CARI_DOSEN .
                    "&pageDosen=" . $HALAMAN_KE_DOSEN .
                    "' class='c-nopage'>Previous</a>";
                $hasil .= "&nbsp";
            } else {
                $hasil .= "<a href='?pageMahasiswa=" . ($HALAMAN_KE_MAHASISWA - 1) .
                    "&cariMahasiswa=" . $CARI .
                    "&cariDosen=" . $CARI_DOSEN .
                    "&pageDosen=" . $HALAMAN_KE_DOSEN .
                    "&idgrup=$idgrup' class='c-nopage'>Previous</a>";
                $hasil .= "&nbsp";
            }
        }

        for ($i = 1; $i <= $MAX_PAGE_MAHASISWA; $i++) {
            if ($HALAMAN_KE_MAHASISWA == $i) {
                $hasil .= "<span class='c-nopage' style='background-color: red;'>" . $i . "</span>";
                $hasil .= "&nbsp";
            } else {
                if (is_null($idgrup)) {
                    $hasil .= "<a href='?pageMahasiswa=" . $i .
                        "&cariMahasiswa=" . $CARI .
                        "&cariDosen=" . $CARI_DOSEN .
                        "&pageDosen=" . $HALAMAN_KE_DOSEN .
                        "' class='c-nopage' >" . $i . "</a>";
                    $hasil .= "&nbsp";
                } else {
                    $hasil .= "<a href='?pageMahasiswa=" . $i .
                        "&cariMahasiswa=" . $CARI .
                        "&cariDosen=" . $CARI_DOSEN .
                        "&pageDosen=" . $HALAMAN_KE_DOSEN .
                        "&idgrup=$idgrup' class='c-nopage' >" . $i . "</a>";
                    $hasil .= "&nbsp";
                }
            }
        }

        if ($HALAMAN_KE_MAHASISWA < $MAX_PAGE_MAHASISWA) {
            if (is_null($idgrup)) {
                $hasil .= "<a href='?pageMahasiswa=" . ($HALAMAN_KE_MAHASISWA + 1) .
                    "&cariMahasiswa=" . $CARI .
                    "&cariDosen=" . $CARI_DOSEN .
                    "&pageDosen=" . $HALAMAN_KE_DOSEN .
                    "' class='c-nopage'>Next</a>";
                $hasil .= "&nbsp";
            } else {
                $hasil .= "<a href='?pageMahasiswa=" . ($HALAMAN_KE_MAHASISWA + 1) .
                    "&cariMahasiswa=" . $CARI .
                    "&cariDosen=" . $CARI_DOSEN .
                    "&pageDosen=" . $HALAMAN_KE_DOSEN .
                    "&idgrup=$idgrup' class='c-nopage'>Next</a>";
                $hasil .= "&nbsp";
            }
        }
    }


    return $hasil;
}


function GeneratePageNumberDosen(
    $DATA_PER_PAGE,
    $TOTAL_DATA_MAHASISWA,
    $TOTAL_DATA_DOSEN,
    $CARI = "",
    $HALAMAN_KE_MAHASISWA = 1,
    $CARI_DOSEN,
    $HALAMAN_KE_DOSEN,
    $idgrup = ""
) {
    if (
        (
            !is_numeric($DATA_PER_PAGE) ||
            !is_numeric($TOTAL_DATA_MAHASISWA) ||
            !is_numeric($TOTAL_DATA_DOSEN) ||
            !is_numeric($HALAMAN_KE_MAHASISWA) ||
            !is_numeric($HALAMAN_KE_DOSEN)
        ) && $_SESSION["isadmin"] == 1
    ) {
    } else if (
        (
            !is_numeric($DATA_PER_PAGE) ||
            !is_numeric($TOTAL_DATA_MAHASISWA) ||
            !is_numeric($TOTAL_DATA_DOSEN) ||
            !is_numeric($HALAMAN_KE_MAHASISWA) ||
            !is_numeric($HALAMAN_KE_DOSEN)
        ) && $_SESSION["role"] == "dosen"
    ) {
        header("Location: ../../ManageMemberGrup.php");
    }

    $MAX_PAGE_DOSEN = ceil($TOTAL_DATA_DOSEN / $DATA_PER_PAGE);

    $hasil = "";
    if ($MAX_PAGE_DOSEN > 1) {
        if ($HALAMAN_KE_DOSEN > 1) {
            if (is_null($idgrup)) {
                $hasil .= "<a href='?pageMahasiswa=" . $HALAMAN_KE_MAHASISWA .
                    "&cariMahasiswa=" . $CARI .
                    "&cariDosen=" . $CARI_DOSEN .
                    "&pageDosen=" . ($HALAMAN_KE_DOSEN - 1) .
                    "' class='c-nopage'>Previous</a>";
                $hasil .= "&nbsp";
            } else {
                $hasil .= "<a href='?pageMahasiswa=" . $HALAMAN_KE_MAHASISWA .
                    "&cariMahasiswa=" . $CARI .
                    "&cariDosen=" . $CARI_DOSEN .
                    "&pageDosen=" . ($HALAMAN_KE_DOSEN - 1) .
                    "&idgrup=$idgrup' class='c-nopage'>Previous</a>";
                $hasil .= "&nbsp";
            }
        }

        for ($i = 1; $i <= $MAX_PAGE_DOSEN; $i++) {
            if ($HALAMAN_KE_DOSEN == $i) {
                $hasil .= "<span class='c-nopage' style='background-color: red;'>" . $i . "</span>";
                $hasil .= "&nbsp";
            } else {
                if (is_null($idgrup)) {
                    $hasil .= "<a href='?pageMahasiswa=" . $HALAMAN_KE_MAHASISWA .
                        "&cariMahasiswa=" . $CARI .
                        "&cariDosen=" . $CARI_DOSEN .
                        "&pageDosen=" . $i .
                        "' class='c-nopage'>" . $i . "</a>";
                    $hasil .= "&nbsp";
                } else {
                    $hasil .= "<a href='?pageMahasiswa=" . $HALAMAN_KE_MAHASISWA .
                        "&cariMahasiswa=" . $CARI .
                        "&cariDosen=" . $CARI_DOSEN .
                        "&pageDosen=" . $i .
                        "&idgrup=$idgrup' class='c-nopage'>" . $i . "</a>";
                    $hasil .= "&nbsp";
                }
            }
        }

        if ($HALAMAN_KE_DOSEN < $MAX_PAGE_DOSEN) {
            if (is_null($idgrup)) {
                $hasil .= "<a href='?pageMahasiswa=" . $HALAMAN_KE_MAHASISWA .
                    "&cariMahasiswa=" . $CARI .
                    "&cariDosen=" . $CARI_DOSEN .
                    "&pageDosen=" . ($HALAMAN_KE_DOSEN + 1) .
                    "' class='c-nopage'>Next</a>";
                $hasil .= "&nbsp";
            }else{
                $hasil .= "<a href='?pageMahasiswa=" . $HALAMAN_KE_MAHASISWA .
                    "&cariMahasiswa=" . $CARI .
                    "&cariDosen=" . $CARI_DOSEN .
                    "&pageDosen=" . ($HALAMAN_KE_DOSEN + 1) .
                    "&idgrup=$idgrup' class='c-nopage'>Next</a>";
                $hasil .= "&nbsp";
            }
        }
    }

    return $hasil;
}