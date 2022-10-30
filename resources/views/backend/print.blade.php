<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">	
    {{-- <meta http-equiv="X-UA-Compatible" content="ie=edge"><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" --}}
     {{-- integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> --}}
     <style>
        @page { margin: 0px; }
     </style>
    <title>Print_Receipt</title>
</head>
<body>
    <div>
        <div style="width: 100%">
                <div style="font-size: 15px; font-weight: bold" class="text-center">Tb. EDEN JAYA</div>
                <div style="font-size: 15px; font-weight: bold" class="text-center">(021)-5326391</div>
                <div style="font-size: 10px; font-weight: bold" class="text-center"> Jl. Pejuangan Raya No. 14D </div>
                <div style="font-size: 10px;"><?php echo date('d-m-Y', strtotime($hisTime->created_at)); ?></div>
                <div style="font-size: 10px;">No ID : {{ $id }}</div>
        </div>
        <div style="border: solid black 1px; margin-top: 5px;"></div>
        <div>
            <?php $total = 0 ?>
            @foreach ($history as $cart) 
                <div>
                    <?php $total = $total + $cart->harga * $cart->jumlah?>
                <div style="font-size: 10px;"> {{ $cart->nama_produk }}</div>
                    {{-- <div style="font-size: 10px;" class="text-right" > --}}
                        <div style="font-size: 10px;"> {{ $cart->jumlah }} X <?php echo number_format( $cart->harga, 0,',','.') ?></div>
                        <div style="font-size: 10px;text-align: right" class="font-weight-bold"><?php echo number_format( $cart->harga*$cart->jumlah , 0,',','.') ?></div> 
                    {{-- </div> --}}
                </div>
            @endforeach
            <div style="border: solid black 1px; margin-top: 5px;"></div>
            Total: <?php echo number_format( $total , 0,',','.') ?>
        </div>
    </div>
</body>
</html>