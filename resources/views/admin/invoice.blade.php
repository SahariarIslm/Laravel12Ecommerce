<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <center>
        Customer Name    : {{$data->user->name}} <br><br><br>
        Customer Address : {{$data->receiver_address}} <br><br><br>
        Phone Number     : {{$data->receiver_phone_number}} <br><br><br>
        Product          : {{$data->product->product_title}} <br><br><br>
        Product Price    : {{$data->product->product_price}} <br><br><br>
    </center>
</body>
</html>