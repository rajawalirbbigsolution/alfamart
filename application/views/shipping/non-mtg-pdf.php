<?php
$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->setPrintFooter(false);
$pdf->setPrintHeader(false);
$pdf->SetAutoPageBreak(true, 30);
$pdf->AddPage();
$html = '<style>
    .border, .border tr td {
        border: 1px solid black;
    }
    .absorbing-column {
        width: 100%;
    }</style>
    <table>
        <tr>
            <td rowspan="2"><img src="assets/image/bulok/logo_SSI.jpg" width="100px"/></td>
            <td>BERITA ACARA SERAH TERIMA</td>
        </tr>
        <tr>
            <td>PENERIMAAN BANSOS BANPRES</td>
        </tr>
    </table><br><br>
    <table class="border">
        <tr>
            <td>BAST GUDANG</td>
            <td rowspan="2">KOTA / KAB<br>' . $dt_object->kabupaten . '</td>
            <td>KEC.' . $dt_object->kecamatan . '</td>
        </tr>
        <tr>
            <td>' . $dt_object->code_shipping . '</td>
            <td>KEL.' . $dt_object->kelurahan . '</td>
        </tr>
    </table><br><br>
    <table class="border">
        <tr>
            <td>Load Number</td>
            <td>BANPRES-' . $load_number . '</td>
        </tr>
        <tr>
            <td>Prepared By</td>
            <td>' . $user . '</td>
        </tr>
        <tr>
            <td>Loaded Date Time</td>
            <td>' . $dt_object->created_date . '</td>
        </tr>
        <tr>
            <td>Warehouse</td>
            <td>' . $dt_warehouse->name_warehouse . '</td>
        </tr>
        <tr>
            <td>Truck Company Name</td>
            <td>' . $dt_truck->merk_truck . '</td>
        </tr>
        <tr>
            <td>Truck No</td>
            <td>' . $dt_truck->no_police . '</td>
        </tr>
        <tr>
            <td>Driver Name</td>
            <td>' . $dt_driver->name_driver . '</td>
        </tr>
        <tr>
            <td>Driver NIK</td>
            <td>' . $dt_driver->image . '</td>
        </tr>
        <tr>
            <td>Quantity</td>
            <td>' . $dt_object->qty . '</td>
        </tr>
    </table>
    <br><br>
    <table style="width:80%;margin-left:10%;margin-right:10%;text-align:center;">
        <tr>
            <td>Catatan:</td>
            <td style="width:60%;border:1px solid #000;"><br><br><br><br></td>
        </tr>
    </table>
    <br><br>
    <div>
        Jakarta, .............. 2020,
    </div>
    <div>
        <table style="text-align:center">
            <tr>
                <td style="width:20%;"></td>
                <td style="width:30%;border:1px solid #000;"><br><br><br><br><br><br><br><br><br>Driver</td>
                <td style="width:30%;border:1px solid #000;"><br><br><br><br><br><br><br><br><br>Admin</td>
                <td style="width:20%;"></td>
            </tr>
        </table>
    </div>
    <table>
        <tr>
            <td style="width:5%"></td>
            <td style="width:10%">Note:</td>
            <td style="text-align:justify;width:80%">Pengemudi/pembawa truck paket kiriman bertanggung jawab penuh atas keutuhan barang kiriman, sebelum diterima oleh penerima yang sah.
            </td>
        </tr>
    </table>';
$pdf->writeHTML($html);

// $img = file_get_contents('assets/image/bulok/dnr-logo.png'); 

// // Encode the image string data into base64 
// $logo = '@'.base64_encode($img); 

// foreach($dt_detail as $detail){
//     $pdf->AddPage();
//     $html = '<style>
//     .border, .border tr td {
//         border: 1px solid black;
//     }</style>
//     <div><table>
//         <tr>
//             <td rowspan="2"><img src="'.$logo.'" width="100px"/></td>
//             <td>BERITA ACARA SERAH TERIMA</td>
//         </tr>
//         <tr>
//             <td>PENERIMAAN BANSOS BANPRES</td>
//         </tr>
//     </table></div>
//     <div><table class="border">
//         <tr>
//             <td rowspan="3">BAST BANSOS<br>'.$dt_object->code_shipping.'</td>
//             <td rowspan="3">KOTA / KAB<br>'.$dt_object->kabupaten.'</td>
//             <td colspan="2">KEC.'.$dt_object->kecamatan.'</td>
//         </tr>
//         <tr>
//             <td colspan="2">KEL.'.$dt_object->kelurahan.'</td>
//         </tr>
//         <tr>
//             <td>RW.'.$detail['no_rw'].'</td>
//             <td>RT.'.$detail['no_rt'].'</td>
//         </tr>
//     </table></div>
//     <div><table class="border">
//         <tr>
//             <td>Load Number</td>
//             <td>Load Number</td>
//         </tr>
//         <tr>
//             <td>Prepared By</td>
//             <td>Prepared By</td>
//         </tr>
//         <tr>
//             <td>Loaded Date Time</td>
//             <td>'.$date.'</td>
//         </tr>
//         <tr>
//             <td>Warehouse</td>
//             <td>'.$dt_warehouse->name_warehouse.'</td>
//         </tr>
//         <tr>
//             <td>Truck Company Name</td>
//             <td>'.$dt_truck->merk_truck.'</td>
//         </tr>
//         <tr>
//             <td>Truck No</td>
//             <td>'.$dt_truck->no_police.'</td>
//         </tr>
//         <tr>
//             <td>Driver Name</td>
//             <td>'.$dt_driver->name_driver.'</td>
//         </tr>
//         <tr>
//             <td>Total Quantity Loaded</td>
//             <td>'.$detail['total'].'</td>
//         </tr>
//     </table></div>
//     <div><table>';

//     $index = 0;
//     foreach($dt_bansos as $bansos){
//         if($detail['no_rw']==$bansos['no_rw'] && $detail['no_rt']==$bansos['no_rt']){
//             $index++;
//             $html .= '<tr nobr="true">
//                 <td class="border" style="width:5%;">'.$index.'</td>
//                 <td class="border" style="width:45%;">Nama Penerima:<br>'.$bansos['nama_kep_kel'].'<br>'.$bansos['alamat'].'</td>
//                 <td class="border">KTP.'.$bansos['nik_ktp'].'</td>
//                 <td class="border">Tanda Tangan Penerima</td>
//             </tr>';
//         }
//     }

//     $html .= '</table></div>
//     <div style="text-align:center;"><table style="width:80%;margin-left:10%;margin-right:10%;">
//         <tr nobr="true">
//             <td>Catatan:</td>
//             <td style="width:60%;border:1px solid #000;"><br><br><br><br></td>
//         </tr>
//     </table></div>
//     <div>
//         Jakarta, 01 Juni 2020,
//     </div>
//     <div>
//         <table style="text-align:center">
//             <tr nobr="true">
//                 <td style="width:10%"></td>
//                 <td style="width:40%;border:1px solid #000;"><br><br><br><br><br><br><br><br><br>Koordinator Lapangan</td>
//                 <td style="width:40%;border:1px solid #000;"><br><br><br><br><br><br><br><br><br>Ketua/Pengurus RT/RW</td>
//                 <td style="width:10%"></td>
//             </tr>
//         </table>
//     </div>';
//     $pdf->writeHTML($html);
// }
$pdf->Output($dt_object->code_shipping . '.pdf', 'I');
