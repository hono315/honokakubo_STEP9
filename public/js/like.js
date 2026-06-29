console.log('like.js loaded');

document.addEventListener('DOMContentLoaded', function () {
    const likeBtn = document.getElementById('like-button');

    if (likeBtn) {
        likeBtn.addEventListener('click', function () {
            // ★ここをチェック！ data-item-id から正しく 'itemId' を作ります
            const itemId = this.getAttribute('data-item-id');
            
            if (!itemId) {
                console.error('エラー: data-item-id がボタンに設定されていません');
                return;
            }

            // ★ itemId を使って、Laravelのルート（/products/ID/like）に繋ぎます
            const url = `/products/${itemId}/like`;
            
            // 現在のハートの色（style.color）を見てPOSTかDELETEかを判定
            const method = this.querySelector('i').style.color === 'red' ? 'DELETE' : 'POST';

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
                const heartIcon = this.querySelector('i');
                heartIcon.style.color = method === 'POST' ? 'red' : 'black';
            })
            .catch(error => console.error('エラー発生:', error));
        });
    }
});