<?php
$data = json_decode(file_get_contents("php://input"), true);

$token = "TOKEN_FONNTE_KAMU"; // WAJIB GANTI

$pesan =
"Pesanan Top Up\n\n".
"Game: {$data['game']}\n".
"ID: {$data['gameId']}\n".
($data['game']=="Roblox"
? "Display Name: {$data['displayName']}\n"
: "Server: {$data['server']}\n").
"Nominal: {$data['nominal']}\n".
"Harga: Rp ".number_format($data['harga'],0,",",".")."\n".
"Pembayaran: {$data['payment']}";

$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.fonnte.com/send",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => [
        "Authorization: $token"
    ],
    CURLOPT_POSTFIELDS => [
        "target" => "6283142808857", // NOMOR WA KAMU
        "message" => $pesan
    ]
]);

curl_exec($curl);
curl_close($curl);

echo json_encode(["message"=>"Pesanan berhasil dikirim ke WhatsApp"]);
