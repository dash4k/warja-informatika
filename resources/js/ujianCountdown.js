document.addEventListener('DOMContentLoaded', function () {
    const countdownEl = document.getElementById('countdown');
    const startTime = new Date(countdownEl.dataset.start).getTime();

    function updateCountdown() {
        const now = new Date().getTime();
        const distance = startTime - now;

        if (distance <= 0) {
            countdownEl.innerText = "Ujian sudah dimulai!";
            return;
        }

        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        countdownEl.innerText = `${hours.toString().padStart(2, '0')} : ${minutes.toString().padStart(2, '0')} : ${seconds.toString().padStart(2, '0')}`;
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);
});