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



    function onScanSuccess(decodedText, decodedResult) {
        document.getElementById("qr-reader-results").innerText = `Scanned result: ${decodedText}`;
    }

    function onScanFailure(error) {
        console.warn(`Code scan error = ${error}`);
    }

    let html5QrCode = new Html5Qrcode("qr-reader");
    html5QrCode.start(
        { facingMode: "environment" }, 
        {
            fps: 10, 
            qrbox: 250 
        },
        onScanSuccess,
        onScanFailure
    ).catch(err => {
        console.error(`Unable to start scanning, error: ${err}`);
    });