document.documentElement.style.overflow = 'visible';
document.body.style.overflow = 'visible';
document.documentElement.style.height = 'auto';
document.body.style.height = 'auto';

document.addEventListener('DOMContentLoaded', function () {
    const printBtn = document.getElementById('print-btn');

    if (printBtn) {
        printBtn.addEventListener('click', function () {
            window.print();
        });
    }
});