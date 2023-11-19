success: function(response) {
                    document.getElementById('textDataInput').value = '';
                    console.log(response);
                    if (response.success) {
                        var tableHtml = '<table>';
                        tableHtml += '<thead><tr><th>Hidden Data</th><th>Text Data</th></tr></thead>';
                        tableHtml += '<tbody><tr><td>' + response.hiddenData + '</td><td>' + response.textData + '</td></tr></tbody>';
                        tableHtml += '</table>';
                        $('#resultDiv').html(tableHtml);
                    } else {
                        // Xatolik haqida xabar berish
                        $('#resultDiv').html('Xatolik yuz berdi. Iltimos, qaytadan urinib ko\'ring.');
                    }
                },
                error: function(xhr, status, error) {
                    var errorMessage = 'Server bilan bog\'lanishda xatolik yuz berdi:\n';
                    errorMessage += 'Status: ' + status + '\n';
                    errorMessage += 'Error: ' + error + '\n';
                    errorMessage += 'Serverdan kelgan ma\'lumot:\n' + xhr.responseText;

                    $('#error-message').text(errorMessage);
                    }







                    if (response.success) {
                    document.getElementById('textDataInput').value = '';
                    console.log(response);

                    var barcodesTable = $('#barcodesTable');
                    barcodesTable.empty(); // Eski ma'lumotlarni tozalash

                    for ( i = 0; i < response.barcodes.length; i++) {
                        var barcode = response.barcodes[i];
                        var id = barcode.id;
                        var code = barcode.barcode;
                        var count = barcode.count;
                        var shopId = barcode.shop_id;
                        var userId = barcode.user_id;

                        // Qaytgan ma'lumotlarni HTMLga qo'shish
                        var row = '<tr>' +
                            '<td>' + id + '</td>' +
                            '<td>' + code + '</td>' +
                            '<td>' + count + '</td>' +
                            '<td>' + shopId + '</td>' +
                            '<td>' + userId + '</td>' +
                            '</tr>';
                        barcodesTable.append(row);
                    }
                }