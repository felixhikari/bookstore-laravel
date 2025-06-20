<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate Book</title>
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
            align-items: center;
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
        }
        table tr td {
            padding: 10px;
        }
    </style>
</head>
<body>
    <div id="main-container">
        <form id="formable">
            @csrf
            <span>
                <label for="authorinput">Book Author</label>
                <select name="authorinput" id="authorinput"></select>
            </span>
            <span>
                <label for="bookinput">Book Name</label>
                <select name="bookinput" id="bookinput"></select>
            </span>
            <span>
                <label for="rating">Rating</label>
                <select name="rating" id="rating">
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </span>
            <input id="submit" type="submit">
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#formable').submit(function(e) {
            e.preventDefault();
            if($('#bookinput').val() === ''){
                alert("Mohon masukan pilihan buku yang valid")
                return
            }
            $.ajax({
                url: `http://127.0.0.1:8000/book/${$('#bookinput').val()}/rating`,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // penting!
                    rating: $('#rating').val(),
                },
                dataType: "json",
                success: function(response) {
                    alert("success");
                    window.location.href = 'http://127.0.0.1:8000/book-list'
                },
                error: function(xhr, status, error) {
                    alert('Gagal: ' + error);
                }
            });
        });

        $('#authorinput').on('change', function(e) {
            e.preventDefault();
            $.ajax({
                url: `http://127.0.0.1:8000/author/${$('#authorinput').val()}/books`,
                type: 'GET',
                dataType:'json',
                success: function(response) {
                    const books = response.data;
                    $('#bookinput').empty();
                    if(books.length === 0){
                        alert('Belum Tersedia');
                        $('#bookinput').append(`<option value="">Tidak Tersedia</option>`);
                    } else {
                        $.each(books, function(i, book){
                            $('#bookinput').append(`<option value="${book.id}">${book.title}</option>`);
                        });
                    }
                },
                error: function(xhr, status, error) {
                    alert('Gagal: ' + error);
                }
            });
        });
        
        $('#bookinput').on('change', function(e) {
            e.preventDefault();
            $.ajax({
                url: `http://127.0.0.1:8000/book/${$('#bookinput').val()}/author`,
                type: 'GET',
                dataType:'json',
                success: function(response) {
                    const author = response.data;
                    $('#authorinput').val(author.id);
                },
                error: function(xhr, status, error) {
                    alert('Gagal: ' + error);
                }
            });
        });

        $(function() {
            $.ajax({
                url: `http://127.0.0.1:8000/authors`,
                type: 'GET',
                dataType: "json",
                success: function(response) {
                    const authors = response.data;
                    $('#authorinput').empty();
                    $.each(authors, function(i, author){
                        $('#authorinput').append(`<option value="${author.id}">${author.name}</option>`);
                    });
                },
                error: function(xhr, status, error) {
                    alert('Gagal: ' + error);
                }
            });
            $.ajax({
                url: `http://127.0.0.1:8000/books`,
                type: 'GET',
                dataType: "json",
                success: function(response) {
                    const books = response.data;
                    $('#bookinput').empty();
                    $.each(books, function(i, book){
                        $('#bookinput').append(`<option value="${book.id}">${book.title}</option>`);
                    });
                },
                error: function(xhr, status, error) {
                    alert('Gagal: ' + error);
                }
            });
        });
    </script>
</body>
</html>
