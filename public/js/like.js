console.log('like.js loaded');

document.addEventListener('DOMContentLoaded', function () {
    const likeBtn = document.getElementById('like-button');

    if (likeBtn) {
        likeBtn.addEventListener('click', function () {
            const itemId = this.getAttribute('data-item-id');
            
            if (!itemId) {
                console.error('エラー: data-item-id がボタンに設定されていません');
                return;
            }

            const url = `/products/${itemId}/like`;
            const heartIcon = this.querySelector('i');
            
            const isLiked = heartIcon.classList.contains('text-danger');
            const method = isLiked ? 'DELETE' : 'POST';

            fetch(url, {
                method: method,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('ネットワークレスポンスが正常ではありませんでした');
                }
                return response.json();
            })
            .then(data => {
                if (method === 'POST') {
                    heartIcon.classList.remove('fa-regular', 'text-secondary');
                    heartIcon.classList.add('fa-solid', 'text-danger');
                } else {
                    heartIcon.classList.remove('fa-solid', 'text-danger');
                    heartIcon.classList.add('fa-regular', 'text-secondary');
                }
            })
            .catch(error => console.error('エラー発生:', error));
        });
    }
});