<?php
function GeneratePageNumber($DATA_PER_PAGE, $TOTAL_DATA_MAHASISWA, $TOTAL_DATA_DOSEN, $CARI = "", $HALAMAN_KE_MAHASISWA = 1, $CARI_DOSEN, $HALAMAN_KE_DOSEN)
{
    // 6. Cari tahu max page yang mungkin
    $MAX_PAGE_MAHASISWA = ceil($TOTAL_DATA_MAHASISWA / $DATA_PER_PAGE);
    $MAX_PAGE_DOSEN = ceil($TOTAL_DATA_DOSEN / $DATA_PER_PAGE);

    // Cek posisi halaman sekarang

    $hasil = "";
    if ($HALAMAN_KE_MAHASISWA > 1) {
        $hasil .= "<a href='?pageMahasiswa=" . ($HALAMAN_KE_MAHASISWA - 1) .
            "&cariMahasiswa=" . $CARI .
            "&cariDosen=" . $CARI_DOSEN .
            "&pageDosen=" . ($HALAMAN_KE_DOSEN) .
            "'>Previous</a>";
        $hasil .= "&nbsp";
    } else if ($HALAMAN_KE_DOSEN > 1) {
        $hasil .= "<a href='?pageMahasiswa=" . ($HALAMAN_KE_MAHASISWA) .
            "&cariMahasiswa=" . $CARI .
            "&cariDosen=" . $CARI_DOSEN .
            "&pageDosen=" . ($HALAMAN_KE_DOSEN - 1) .
            "'>Previous</a>";
        $hasil .= "&nbsp";
    } else {
        $hasil .= "<span>Previous</span>";
        $hasil .= "&nbsp";
    }

    for ($i = 1; $i <= $MAX_PAGE_MAHASISWA; $i++) {
        if ($HALAMAN_KE_MAHASISWA == $i || $HALAMAN_KE_DOSEN == $i) {
            $hasil .= "<span>" . $i . "</span>";
            $hasil .= "&nbsp";
        } else {
            $hasil .= "<a href='?pageMahasiswa=" . $i .
                "&cariMahasiswa=" . $CARI .
                "&cariDosen=" . $CARI_DOSEN .
                "&pageDosen=" . $HALAMAN_KE_DOSEN .
                "' >" . $i . "</a>";
            $hasil .= "&nbsp";
        }
    }

    for ($i = 1; $i <= $MAX_PAGE_DOSEN; $i++) {
        if ($HALAMAN_KE_MAHASISWA == $i || $HALAMAN_KE_DOSEN == $i) {
            $hasil .= "<span>" . $i . "</span>";
            $hasil .= "&nbsp";
        } else {
            $hasil .= "<a href='?pageMahasiswa=" . $i .
                "&cariMahasiswa=" . $CARI .
                "&cariDosen=" . $CARI_DOSEN .
                "&pageDosen=" . $HALAMAN_KE_DOSEN .
                "' >" . $i . "</a>";
            $hasil .= "&nbsp";
        }
    }

    if ($HALAMAN_KE_MAHASISWA < $MAX_PAGE_MAHASISWA) {
        $hasil .= "<a href='?pageMahasiswa=" . ($HALAMAN_KE_MAHASISWA + 1) .
            "&cariMahasiswa=" . $CARI .
            "&cariDosen=" . $CARI_DOSEN .
            "&pageDosen=" . ($HALAMAN_KE_DOSEN + 1) .
            "'>Next</a>";
        $hasil .= "&nbsp";
    }
    else if ($HALAMAN_KE_MAHASISWA < $MAX_PAGE_MAHASISWA) {
        $hasil .= "<a href='?pageMahasiswa=" . ($HALAMAN_KE_MAHASISWA + 1) .
            "&cariMahasiswa=" . $CARI .
            "&cariDosen=" . $CARI_DOSEN .
            "&pageDosen=" . ($HALAMAN_KE_DOSEN + 1) .
            "'>Next</a>";
        $hasil .= "&nbsp";
    } else {
        $hasil .= "<span'>Next</span>";
        $hasil .= "&nbsp";
    }

    return $hasil;
}