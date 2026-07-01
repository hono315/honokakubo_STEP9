document.addEventListener('DOMContentLoaded', function () {
    const executeBtn = document.getElementById('executePurchaseBtn');
    const purchaseForm = document.getElementById('purchaseForm');
    if (executeBtn && purchaseForm) {
        executeBtn.addEventListener('click', function () {
            purchaseForm.submit();
        });
    }
});