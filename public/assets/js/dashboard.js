(function () {
    const pageLoadTime = moment();

    function updateTimes() {
        console.log('hhhhhh');

        $('.updatedText').each(function (key, item) {
            $(item).text(`Updated ${pageLoadTime.fromNow()}`);
        })
        // document.getElementById('updated-time-2').textContent = `Updated ${pageLoadTime.fromNow()}`;
        // document.getElementById('updated-time-3').textContent = `Updated ${pageLoadTime.fromNow()}`;
    }

    // Update the time every minute
    window.setTimeout(function () {
        updateTimes()
    }, 6000);
    updateTimes(); // Initial call to set time on page load
})()
