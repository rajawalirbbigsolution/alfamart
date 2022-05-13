<?php

date_default_timezone_set('Asia/Jakarta');
class PDF_BASTGUDANG extends TCPDF {

    //Page header
    // Page footer
    public function Footer() {
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Hal '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}


$pdf = new PDF_BASTGUDANG('P', PDF_UNIT, 'A4', true, 'UTF-8', false);

$pdf->setPrintFooter(TRUE);
$pdf->setPrintHeader(false);
$pdf->SetTitle('BAST GUDANG PER TANGGAL ' .$date.'_'.$warehouse);
$pdf->SetAutoPageBreak(true, 10);
$img = file_get_contents('assets/image/bulok/logobast_1.png');
$logo = '@' . base64_encode($img);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// $pdf->AddPage();

// $html = '<style>
//     .border, .border tr td {
//         border: 0.5px solid black;
//         font-size: 8px;
//         align : center;
//     }</style>
//     <table>
//         <tr>
//             <td align="center"><h1><u>BERITA ACARA SERAH TERIMA</u></h1></td>
//         </tr>
//         <tr>
//             <td align="center"><center><h2>PAKET BANTUAN SOSIAL</h2></center></td>
//         </tr>
//         <tr>
//             <td align="center"><center><h3>NOMOR : ' . $warehouse . '.' . $tahun . '.' . $month . '.' . $tanggal . '/' . sprintf("%03d", $number) . '</h3></center></td>
//         </tr>
//     </table><br>
//     <p>Pada Hari ini <b>' . $dayList[$day] . '</b> tanggal <b>' . ucwords(terbilang($tanggal)) . '</b> bulan <b>' . $bulan[$month] . '</b> tahun <b>' . ucwords(terbilang($tahun)) . ' (' . $tanggal . '/' . $month . '/' . $tahun . ')</b> kami yang bertanda tangan di bawah ini :</p>
//     <p>Nama &nbsp;&nbsp;&nbsp;&nbsp;: Aditya Gusendi S.E.</p>
//     <p>Jabatan &nbsp;: Head shift</p>
//     <p style="line-height:20px">Dalam hal ini bertindak sebagai <b>' . $company . '</b>, yang selanjutnya PIHAK PERTAMA
//     </p>
//     <p>Nama &nbsp;&nbsp;&nbsp;&nbsp;:</p>
//     <p>Jabatan &nbsp;: PIC Transporter Bansos DKI Tahap VII</p>
//      <p align="justify">Dalam hal ini bertindak untuk atas nama <b>PT Dosni Roha Logistik</b>, yang selanjutnya PIHAK KEDUA
//     </p>
//     <p align="justify">Dengan berdasarkan SPPBJ No 907/BS.01.03/Dit.PSKBS/7/2020 Tanggal 16 Juli 2020 Kementerian Sosial Republik Indonesia, dengan ini menyatakan.</p>

//     <table style="text-align:center">
//             <tr nobr="true">
//                 <td style="width:2%"></td>
//                 <td style="width:3%;">1.</td>
//                 <td style="width:95%;"><p style="line-height:20px" align="justify">PIHAK PERTAMA telah menyerahkan Kepada PIHAK KEDUA paket Bantuan Sosial TAHAP VII tanggal <b>' . $tanggal . ' ' . $bulan[$month] . ' ' . $tahun . '</b> sebanyak ' . number_format($totalqty->qty) . ' (' . ucwords(terbilang($totalqty->qty)) . ') paket di lokasi gudang  PT. Asricitra Pratama Jalan Agung Timur 8 Blok O no. 19, Kelapa Gading Barat, Kecamatan Kelapa Gading, Jakarta Utara, Daerah Khusus Ibukota Jakarta 14240</p></td>
//             </tr>
//             <tr nobr="true">
//                 <td style="width:2%"></td>
//                 <td style="width:3%;">2.</td>
//                 <td style="width:95%;"><p align="justify">PIHAK KEDUA telah menerima ' . number_format($totalqty->qty) . ' (' . ucwords(terbilang($totalqty->qty)) . ') Bantuan Sosial tersebut dalam keadaan BAIK, dan telah dibawa menggunakan kendaraan angkut dalam data pengangkutan dan pengiriman pada Lampiran 1.</p></td>
//             </tr>
//         </table>
//     <p align="justify">Berita Acara Serah Terima Paket ini ditanda tangani oleh kedua belah pihak dan mempunyai kekuatan hukum yang sama untuk dipergunakan sebagaimana mestinya.</p>
//     <br><br>';
// $html .= '<table style="text-align:center">
//             <tr nobr="true">
//                 <td style="width:10%"></td>
//                 <td style="border:1px solid #000;width:40%;">PIHAK PERTAMA<br><br><br><br><br><br><br><u><b>Aditya Gusendi S.E.</u></b><br><b>Head shift</b></td>
//                 <td style="border:1px solid #000;width:40%;">PIHAK KEDUA<br><br><br><br><br><br><br><u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><br><b>PIC PT Dosni Roha Logistik</b></td>
//                 <td style="width:10%"></td>
//             </tr>
//         </table>';
// $pdf->writeHTML($html);

$pdf->AddPage();
$html = '<style>
    .border, .border tr td {
        border: 0.5px solid black;
        font-size: 7px;
        align : center;
    }</style>
    <table width="100%">
        <tr>
            <td  width="100%"><img src="' . $logo . '"/></td>
        </tr>
        <tr>
            <td width="100%" align="center"><h1>SUMMARY BAST DRIVER PER TANGGAL ' . $date . '</h1></td>
        </tr>
         <tr>
            <td width="100%" align="center"><h3>PROVINSI '.$provinsi.' - '.$warehouse.' </h3></td>
        </tr>

    </table> <br>
    
    <table>
    </table><br><br>';
$html .= '<table cellpadding="2">
    <thead width="100%">
        <tr style="background-color: #D3D3D3;">
            <th width="4%" align="center" class="border">No</th>
            <th width="17%" align="center" class="border">Bast No</th>
            <th width="20%" align="center" class="border">Kabupaten</th>
            <th width="19%" align="center" class="border">Kecamatan</th>
            <th width="19%" align="center" class="border">Kelurahan</th>
            <th width="13%" align="center" class="border">Antrian</th>
            <th width="8%" align="center" class="border">Qty</th>
        </tr>
    </thead>
    <tbody>';
if ($countlist == 0) {
    $html .= '<tr width="100%">
                <td width="100%" class="border" align="center" colspan = "7"> Data Kosong</td>
              </tr>';
} else {
    $no = 0;
    for ($i = 0; $i < sizeof($list); $i++) {
        $no++;

        $html .= '<tr width="100%">
                <td width="4%" class="border" align="center"> ' . $no . '</td>

                <td width="17%" class="border" align="center"> ' . $list[$i]->code_bast . '</td>
                
                <td width="20%" class="border" align="center"> ' . $list[$i]->kabupaten . '</td>
                
                <td width="19%" class="border" align="center"> ' . $list[$i]->kecamatan . '</td>
                
                <td width="19%" class="border" align="center"> ' . $list[$i]->kelurahan . '</td>
                
                <td width="13%" class="border" align="center"> ' . $list[$i]->queue_no . '</td>

                <td width="8%" class="border" align="center"> ' . $list[$i]->qty . '</td>
              </tr>
              ';
    }
}
$html .= '<tr width="100%">
    <td width="92%" colspan="6" class="border" align="right"> Total </td>
    <td width="8%" class="border" align="center"> ' . number_format($totalqty->qty) . '</td>
    </tr>';
$html .= '</tbody></table><br><br>';
$html .= '<table style="text-align:center">
            <tr nobr="true">
                <td style="width:10%"></td>
                <td style="border:1px solid #000;width:40%;">PIHAK PERTAMA<br><br><br><br><u><b></u></b><br><b>Head shift</b></td>
                <td style="border:1px solid #000;width:40%;">PIHAK KEDUA<br><br><br><br><u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><br><b>PIC PT Dosni Roha Logistik</b></td>
                <td style="width:10%"></td>
            </tr>
        </table>';
$pdf->writeHTML($html);

$pdf->Output('PDF_BAST_GUDANG_PER_TANGGAL_' . $date .'_'.$warehouse. '.pdf', 'I');
