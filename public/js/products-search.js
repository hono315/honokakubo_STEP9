document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('search-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(form);
            const params = new URLSearchParams(formData).toString();

            fetch(`/products/index?${params}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                const itemsArea = document.getElementById('items-area');
                if (itemsArea) {
                    itemsArea.innerHTML = data.html;
                }
            });
        });
    }
});