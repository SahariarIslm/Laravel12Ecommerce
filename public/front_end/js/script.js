let qtyInput = document.getElementById("quantity");

function increaseQty() {
    let qty = parseInt(qtyInput.value);
    qtyInput.value = qty + 1;
}

function decreaseQty() {
    let qty = parseInt(qtyInput.value);
    if (qty > 1) {
        qtyInput.value = qty - 1;
    }
}
