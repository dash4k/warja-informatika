document.addEventListener("DOMContentLoaded", function () {
    const timerDiv = document.getElementById('exam-timer');
    const endTimeString = timerDiv?.dataset.end;

    if (!endTimeString) return;

    const endTime = new Date(endTimeString).getTime();
    const countdownElement = document.getElementById('countdown');

    function updateTimer() {
        const now = new Date().getTime();
        const distance = endTime - now;

        if (distance <= 0) {
            countdownElement.innerHTML = "00:00:00";
            alert("Waktu ujian telah habis! Jawaban akan disubmit.");
            document.querySelector('form')?.submit();
            return;
        }

        const hours = Math.floor((distance / (1000 * 60 * 60)) % 24);
        const minutes = Math.floor((distance / (1000 * 60)) % 60);
        const seconds = Math.floor((distance / 1000) % 60);

        countdownElement.innerHTML =
            String(hours).padStart(2, '0') + ":" +
            String(minutes).padStart(2, '0') + ":" +
            String(seconds).padStart(2, '0');
    }

    updateTimer();
    setInterval(updateTimer, 1000);
});