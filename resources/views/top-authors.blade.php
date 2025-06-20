<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Authors</title>
    <style>
        body {
            padding: 0%;
            margin: 0%;
            width: 100%;
            display: flex;
            justify-content: center;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }
        span {
            padding: 10px;
            display: flex;
            width: 100%;
        }
        label {
            width: 100px;
        }
        button {
            margin-left: 110px;
            background-color: rgb(67, 133, 245);
            padding: 5px;
            border: 1px solid black;
            color: white;
            cursor: pointer;
        }
        input, select, button {
            width: 100px;
        }
        #main-container {
            width: 80%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        #formable {
            padding: 10px;
        }
        table {
            padding: 20px;
            width: 30%;
            border-collapse: collapse;
        }
        table tr {
            width: 10px;
        }
        table tr td {
            padding: 10px;
        }
    </style>
</head>
<body>
    <div id="main-container">
        <h2>Top 10 Most Famous Author</h2>
        <table border="1">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Author</td>
                    <td>Voter</td>
                </tr>
            </thead>
            <tbody id="result">
                {{-- Data will be filled by AJAX --}}
            </tbody>
        </table>
    </div>

    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(function() {
            $.ajax({
                url: `http://127.0.0.1:8000/author/femous?limit=10`,
                type: 'GET',
                dataType: "json",
                success: function(response) {
                    const authors = response.data;
                    $('#result').empty();
                    console.log(response)
                    $.each(authors, function(i, author){
                        $('#result').append(`
                            <tr>
                                <td>${i+=1}</td>
                                <td>${author.name}</td>
                                <td>${author.total_voter}</td>
                            </tr>
                        `);
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
