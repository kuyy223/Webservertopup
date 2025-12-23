const express = require("express");
const fetch = require("node-fetch");
const cors = require("cors");

const app = express();
app.use(cors());
app.use(express.json());

app.post("/send", async (req, res) => {
    const {
        game,
        gameId,
        server,
        displayName,
        nominal,
        harga,
        payment
    } = req.body;

    const message =
`TOP UP BARU 🔔

Game: ${game}
ID: ${gameId}
${game === "Roblox" ? "Display Name: " + displayName : "Server: " + server}

Nominal: ${nominal}
Harga: Rp ${harga}
Pembayaran: ${payment}
`;

    try {
        const response = await fetch("https://api.fonnte.com/send", {
            method: "POST",
            headers: {
                "Authorization": process.env.FONNTE_TOKEN
            },
            body: new URLSearchParams({
                target: "628XXXXXXXXX", // GANTI NOMOR KAMU
                message
            })
        });

        res.json({ success: true, message: "Pesanan berhasil dikirim!" });
    } catch (err) {
        res.status(500).json({ success: false, message: "Gagal kirim WA" });
    }
});

app.listen(process.env.PORT || 3000, () => {
    console.log("Server jalan");
});
