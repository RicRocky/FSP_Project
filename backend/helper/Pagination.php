<?php
function GeneratePageNumber($DATA_PER_PAGE, $TOTAL_DATA, $CARI = "", $HALAMAN_KE = 1)
{
    // 6. Cari tahu max page yang mungkin
    $MAX_PAGE = ceil($TOTAL_DATA / $DATA_PER_PAGE);

    // Cek posisi halaman sekarang

    $hasil = "";
    if(!(($HALAMAN_KE * $DATA_PER_PAGE) >= $TOTAL_DATA)){
        if ($HALAMAN_KE > 1){
            $hasil .= "<a href='?page=" . ($HALAMAN_KE - 1) . "&cari=" . $CARI . "'>Previous</a>";
            $hasil .= "&nbsp";
        }else{
            $hasil .= "<span href='?page=" . ($HALAMAN_KE - 1) . "&cari=" . $CARI . "'>Previous</span>";
            $hasil .= "&nbsp";
        }
        
        // 7. Menampilkan nomor halaman
        for ($i = 1; $i <= $MAX_PAGE; $i++) {
            if($HALAMAN_KE == $i){
                $hasil .= "<span href='?page=" . $i . "&cari=" . $CARI . "' >" . $i . "</span>";
                $hasil .= "&nbsp";
            }else{
                $hasil .= "<a href='?page=" . $i . "&cari=" . $CARI . "' >" . $i . "</a>";
                $hasil .= "&nbsp";
            }
        }
        
        if ($HALAMAN_KE < $MAX_PAGE){
            $hasil .= "<a href='?page=" . ($HALAMAN_KE + 1) . "&cari=" . $CARI . "'>Next</a>";
            $hasil .= "&nbsp";
        }else{
            $hasil .= "<span href='?page=" . ($HALAMAN_KE + 1) . "&cari=" . $CARI . "'>Next</span>";
            $hasil .= "&nbsp";
        }
    }

    return $hasil;
}