<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Book Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('book.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .bookCard-container {
        display: flex;
        gap: 20px;
        overflow-x: auto;
        padding: 20px;
        background-color: #f5f5f5;
        scroll-behavior: smooth;
        white-space: nowrap;
        }

        .bookItem-Card {
            flex: 0 0 auto;
            width: 300px;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .bookItem-Card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .bookItem-Card h2 {
            font-size: 18px;
            color: #333;
            text-align: center;
            padding: 10px 0;
            margin: 0;
            border-bottom: 1px solid #eee;
            background-color: #f9f9f9;
        }

        .bookItem-Card img {
            width: 100%;
            height: 300px; /* Made taller for book covers */
            object-fit: cover;
            display: block;
        }

        .bookItem-Card p {
            padding: 15px;
            color: #555;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }

        .bookItem-Card a {
            display: inline-block;
            margin: 10px 15px;
            text-decoration: none;
            font-weight: bold;
            color: #1a73e8;
            transition: color 0.3s ease;
        }

        .bookItem-Card a:hover {
            color: #0048a2;
        }
        .pageTitle{
            font-family: "Georgia";
            text-align: center;
        }
        .pageSubTitle{
            font-family: "Times New Roman";
            text-align: center;
        }
        .formHeader{
            font-family: "Georgia";
            text-align: center;
        }
        .formSubHead{
            font-family: "Times New Roman";
            text-align: center;
        }
    </style>
</head>

<body>
    <h1 class="pageTitle">Welcome to the Book Library!</h1>
    <h2 class="pageSubTitle">Discover your next favorite read</h2>

    <div class="bookCard-container">
    </div>

    <section>
        <div>
            <div class="container">
                <h1 class="formHeader">Add a New Book</h1>
                <h2 class="formSubHead">Share your favorite books with our community</h2>
                <form id="bookForm" role="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Book Title</label>
                        <input class="form-control" type="text" id="name" placeholder="Enter book title">
                    </div>

                    <div class="form-group">
                        <label for="author">Author</label>
                        <input class="form-control" type="text" id="author" placeholder="Enter author name">
                    </div>

                    <div class="form-group">
                        <label for="genre">Genre</label>
                        <input class="form-control" type="text" id="genre" placeholder="Enter book genre">
                    </div>

                    <div class="form-group">
                        <label for="describer">Book Description</label>
                        <textarea class="form-control" id="describer" rows="4" placeholder="Enter a brief description of the book"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="bookImg">Upload Book Cover</label>
                        <input class="form-control-file" type="file" id="bookImg" accept="image/*">
                    </div>

                    <button type="submit" class="btn btn-primary">Add Book</button>
                </form>
            </div>
        </div>
    </section>
    
    <script>
    document.getElementById("bookForm").addEventListener("submit", function(event) {
        event.preventDefault();
        
        const title = document.getElementById("name").value;
        const author = document.getElementById("author").value;
        const genre = document.getElementById("genre").value;
        const description = document.getElementById("describer").value;
        const imgInput = document.getElementById("bookImg");
        
        if (!imgInput.files || !imgInput.files[0]) {
            alert("Please upload a book cover image");
            return;
        }

        const imgFile = imgInput.files[0];
        const imgURL = URL.createObjectURL(imgFile);
        const newCard = document.createElement("div");

        newCard.className = "bookItem-Card";
        newCard.innerHTML = `
            <h2>${title}</h2>
            <img src="${imgURL}" alt="${title} cover">
            <p><strong>Author:</strong> ${author}</p>
            <p><strong>Genre:</strong> ${genre}</p>
            <p>${description}</p>
            <p><a href="#">Read More</a></p>
        `;

        document.querySelector(".bookCard-container").appendChild(newCard);

        this.reset();
    });
    </script>

</body>
</html>
