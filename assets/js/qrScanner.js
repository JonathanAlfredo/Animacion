function docReady(fn) {
    if (document.readyState === "complete" || document.readyState === "interactive") {
        setTimeout(fn, 1);
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
}

docReady(function () {
    var resultContainer = document.getElementById('qr-reader-results');
    var lastResult, countResults = 0;
    var form = document.getElementById('reporte');

    function onScanSuccess(decodedText, decodedResult) {
        if (decodedText !== lastResult) {

            ++countResults;
            lastResult = decodedText;

            console.log(`Scan result ${decodedText}`, decodedResult);
            
            window.location.href = `reporte.php?person=${decodedText}`;
            
        }
    }

    var html5QrcodeScanner = new Html5QrcodeScanner(
        "qr-reader", { fps: 10, qrbox: 250 });
    html5QrcodeScanner.render(onScanSuccess);
});



