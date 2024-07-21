function generateQRCode(id) {
    if (id) {
        QRCode.toDataURL(id, function (err, url) {
            if (err) {
                console.error(err);
                return;
            }
            let qrCodeContainer = document.getElementById("qr-code");
            qrCodeContainer.innerHTML = "";
            let img = document.createElement("img");
            img.style = "width: 500px;";
            img.src = url;
            qrCodeContainer.appendChild(img);
        });
    } else {
        alert("Por favor agregue una id.");
    }
}

generateQRCode("12345");