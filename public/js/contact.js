            window.history.pushState(null, null, window.location.href);
            window.onpopstate = function(event) {
                window.history.go(1);
            };


            // 詳細情報を表示する関数
            // ボタンが押された際に、モーダルにデータを表示する関数
            window.showDetail = function showDetail(button) {

                var rowCount = $('tbody tr').length;

                // 検索結果が0件の場合はモーダルを表示しない
                if (rowCount === 0) {
                    console.log("検索結果が0件のため、モーダルは表示されません。");
                    return;
                }

                // button要素のdata-*属性からデータを取得
                var name = $(button).data('name');
                var gender = $(button).data('gender');
                var email = $(button).data('email');
                var tell = $(button).data('tell');
                var address = $(button).data('address');
                var building = $(button).data('building');
                var detail = $(button).data('detail'); // お問い合わせの内容を取り出す
                var category = $(button).data('category');
                var contactId = $(button).data('id'); // contact_idを取得

                // モーダル内の要素に取得したデータを設定
                $('#modal-contact-name').text(name);
                $('#modal-contact-gender').text(gender);
                $('#modal-contact-email').text(email);
                $('#modal-contact-tell').text(tell);
                $('#modal-contact-address').text(address);
                $('#modal-contact-building').text(building);
                $('#modal-contact-detail').text(detail);
                $('#modal-contact-category').text(category);

                // 削除ボタンにcontactIdをセット
                $('#deleteButton').data('id', contactId);

                // モーダルを表示
                $('#detailModal').modal('show');

                // 削除ボタンが押されたときの処理
                $('#deleteButton').on('click', function() {
                    var contactId = $(this).data('id'); // 削除対象のIDを取得
                    var row = $('button[data-id="' + contactId + '"]').closest('tr'); // 削除対象の行を特定

                    if (confirm('本当に削除しますか？')) {
                        $.ajax({
                            url: '/contact/' + contactId, // 削除のURL
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRFトークンを送信
                            },
                            success: function(response) {
                                alert(response.success); // 削除成功メッセージを表示
                                row.remove(); // テーブルから該当の行を削除
                                $('#detailModal').modal('hide'); // モーダルを閉じる
                            },
                            error: function(xhr) {
                                alert('削除に失敗しました: ' + xhr.responseText);
                            }
                        });
                    }
                });
            }


            document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('exportBtn').addEventListener('click', function(e) {
        e.preventDefault();

        let keyword = document.querySelector('input[name="keyword"]').value;
        let gender = document.querySelector('select[name="gender"]').value;
        let category_id = document.querySelector('select[name="category_id"]').value;
        let contact_date = document.querySelector('input[name="contact_date"]').value;

        // デフォルト選択肢の場合は空の値にする
        gender = (gender === "性別") ? "" : gender;
        category_id = (category_id === "お問い合わせの種類") ? "" : category_id;

        $.ajax({
            url: exportUrl,
            type: 'GET',
            data: {
                keyword: keyword,
                gender: gender,
                category_id: category_id,
                contact_date: contact_date
            },
            xhrFields: {
                responseType: 'blob'
            },
            success: function(response, status, xhr) {
                let filename = "";
                let disposition = xhr.getResponseHeader('Content-Disposition');
                if (disposition && disposition.indexOf('attachment') !== -1) {
                    let filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                    let matches = filenameRegex.exec(disposition);
                    if (matches != null && matches[1]) filename = matches[1].replace(/['"]/g, '');
                }

                let blob = new Blob([response], { type: 'text/csv' });
                let link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = filename ? filename : 'export.csv';
                link.click();
            },
            error: function() {
                alert('CSVエクスポートに失敗しました。');
            }
        });
    });
});
