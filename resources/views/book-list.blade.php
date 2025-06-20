<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List</title>
    <style>
        body {
            padding: 0%;
            margin: 0%;
            width: 100%;
            display: flex;
            justify-content: center;
            font-family: 'Lucida Sans', sans-serif;
        }
        #main-container {
            width: 50%;
            display: flex;
            flex-direction: column;
        }
        span {
            padding: 10px;
            display: flex;
            width: 100%;
        }
        label {
            width: 100px;
        }
        #submit {
            margin-left: 110px;
            background-color: rgb(67, 133, 245);
            padding: 5px;
            border: 1px solid black;
            color: white;
            cursor: pointer;
        }
        input, select, #submit {
            width: 100px;
        }
        #formable {
            padding: 10px;
        }
        table {
            padding: 20px;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table tr td {
            padding: 10px;
        }
    </style>
</head>
<body>
    <div id="main-container">
        <form id="formable">
            <span>
                <label for="paginationinput">List Shown</label>
                <select name="paginationinput" id="paginationinput">
                </select>
            </span>
            <span>
                <label for="search">Search</label>
                <input type="search" id="search">
            </span>
            <input id="submit" type="submit">
        </form>

        <table border="1">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Book Name</td>
                    <td>Category Name</td>
                    <td>Average Rating</td>
                    <td>Voter</td>
                </tr>
            </thead>
            <tbody id="result"></tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#formable').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: `http://127.0.0.1:8000/book?title=${$('#search').val()}&limit=${$('#paginationinput').val()}`,
                type: 'GET',
                dataType: "json",
                success: function(response) {
                    const books = response.data;
                    console.log(response.data);
                    $('#result').empty();
                    $.each(books, function(i, book){
                        $('#result').append(`
                            <tr>
                                <td>${i + 1}</td>
                                <td>${book.title}</td>
                                <td>${book.category}</td>
                                <td>${book.average_rating}</td>
                                <td>${book.total_voter}</td>
                            </tr>
                        `);
                    });
                },
                error: function(xhr, status, error) {
                    alert('Gagal: ' + error);
                }
            });
        });

         $(function() {
            for (let index = 10; index <= 100; index+=10) {
                $('#paginationinput').append(`<option value="${index}">${index}</option>`)
            }
            $.ajax({
                url: `http://127.0.0.1:8000/book?title=${$('#search').val()}&limit=${$('#paginationinput').val()}`,
                type: 'GET',
                dataType: "json",
                success: function(response) {
                    const books = response.data;
                    console.log(response.data);
                    $('#result').empty();
                    $.each(books, function(i, book){
                        $('#result').append(`
                            <tr>
                                <td>${i + 1}</td>
                                <td>${book.title}</td>
                                <td>${book.category}</td>
                                <td>${book.average_rating}</td>
                                <td>${book.total_voter}</td>
                            </tr>
                        `);
                    });
                },
                error: function(xhr, status, error) {
                    alert('Gagal: ' + error);
                }
            });
         })
    </script>
</body>
</html>
