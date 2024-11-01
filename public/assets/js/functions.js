function showSuccess(message, target) {
    iziToast.success({
        title: "OK",
        message: message,
        position: "center",
        timeout: 7000,
        target: target,
    });
}

function showError(message, target) {
    iziToast.error({
        title: "Error",
        message: message,
        position: "center",
        timeout: 7000,
        target: target,
    });
}

function showSpiner(target) {
    $(target).html(
        '<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>'
    );
}

function removeSpiner(target) {
    $(target).children().remove();
}
