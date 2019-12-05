<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nota Transaksi</title>

    <style>
        @page { margin: 3mm; }
        body { margin: 3mm; }
    </style>

</head>
<body>

    <script type="text/php">
        if(isset($pdf)){
            $y        = $pdf->get_height() - 20;
            $pageText = "{PAGE_NUM} of {PAGE_COUNT} page";
            $font     = $fontMetrics->get_font('helvetica');
            $size     = 8;
            $x        = $pdf->get_width() - $fontMetrics->get_text_width('0 of 0', $font, $size) - 31;

            $pdf->page_text($x, $y, $pageText, $font, $size, array(.16, .16, .16)); // Grey
        }
    </script>

    <table border="0" style="width:100%">
        <tr>
            <td style="text-align:center" colspan="6">
                <p>NOTA PENJUALAN</p>
                <p>Program Penjualan Alpha 1.0</p>
                <p>Alamat</p>
            </td>
        </tr>
        <tr>
            <td colspan="6">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="6">
                Invoice : {{ $data['header']->kode_transaksi }}
            </td>
        </tr>
        <tr>
            <td colspan="6">
                Tanggal : {{ date('d-m-Y', strtotime($data['header']->tgl_transaksi)) }}
            </td>
        </tr>
        <tr>
            <td colspan="6">Kasir : {{ $data['header']->user_id }}</td>
        </tr>
        <tr>
            <td colspan="6">&nbsp;</td>
        </tr>
        <tr>
            <td>No.</td>
            <td>Kode</td>
            <td>Nama Barang</td>
            <td>Harga</td>
            <td>Qty</td>
            <td>Sub. Total</td>
        </tr>
        <tr>
            <td colspan="6"><hr></td>
        </tr>
        @foreach ($data['detail'] as $item)
        <tr>
            <td>{{ $loop->iteration }}.</td>
            <td>{{ $item->kode_barang }}</td>
            <td>{{ $item->nama_barang }}</td>
            <td>{{ number_format($item->harga, 0, ',', '.') }}</td>
            <td>{{ $item->qty }}</td>
            <td>{{ number_format($item->sub_total, 0, ',', '.') }}</td>
        </tr>
        @endforeach
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Sub. Total</td>
            <td>{{ $data['header']->sub_total <= 0 ? '-' : number_format($data['header']->sub_total, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Pajak / RP</td>
            <td>{{ $data['header']->pajak <= 0 ? '-' : number_format($data['header']->pajak, 0, ',', '.')." / ".number_format($data['header']->pajak_rp, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>DLL</td>
            <td>{{ $data['header']->dll <= 0 ? '-' : number_format($data['header']->dll, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Grand Total</td>
            <td>{{ $data['header']->grand_total <= 0 ? '-' : number_format($data['header']->grand_total, 0, ',', '.') }}</td>
        </tr>
    </table>

</body>
</html>
