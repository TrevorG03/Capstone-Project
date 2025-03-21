<!DOCTYPE html>
<html>
    <head>
        <link href="/css/app.css" rel="stylesheet">
        <style>
            body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            }

            header {
                background-color: #333;
                color: white;
                padding: 20px 0;
                text-align: center;
            }

            main {
                padding: 20px;
            }

            .reviewBox {
                background-color: white;
                border: 1px solid #ccc;
                margin: 20px 0;
                padding: 20px;
                border-radius: 5px;
            }

            .reviewBox h2 {
                margin-top: 4%;
                margin-left: 2%;
            }

            .reviewBox hr {
                border-width: 5px;
                border-style: solid;
            }

            .review-text {
                font-size: 16px;
                line-height: 1.5;
            }

            .review-creator {
                display: block;
                margin-top: 10px;
                font-style: italic;
                color: #777;
            }

            .base-button {
                padding: 10px;
                margin-top: 10px;
                font-style: bold;
                font-size: 14px;
                background-color: darkseagreen;
                border-style: solid;
                border-radius: 10px;
            }

            .base-button:focus {
                outline-color: transparent;
                outline-style:solid;
                box-shadow: 0 0 0 4px rgb(198, 232, 172);
                transition: 0.7s;
            }

            .base-button:hover {
                background-color: rgb(210, 228, 196);
            }

            .imageBox {
                border-style: solid;
                border-color: black;
                margin: 10px;
            }

            .book-box {
                margin: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .book-image {
                max-width: 35%;
                border: 1px solid black;
            }
            
        </style>
    </head>
    <body>
        <header>
            <h1>{{ $book[0]->name }}</h1>
        </header>
        <main>
            <!-- <img src="{{ asset('image/sALt.jpg') }}" alt="Book image" class="book-image"> -->
            @if (isset(request()->bookID))
                <p></p>
            @else
                <p>BookID is NOT set</p>
            @endif
            <section class="reviewBox">
                <div class="book-box">
                    <img src="{{ $book[0]->imgURL }}" alt="Book image" class="book-image">
                </div>
                <hr>
                <h2>{{ $book[0]->name }}</h2>
                <p class="book-text">{{ $book[0]->describer }}</p>
                <span class="book-author">- {{ $book[0]->publisher }}</span>
                <!-- <form action="auth.books" method="post">
                    @csrf
                    <button type="submit" class="base-button">View more posts by this person [WIP]</button>
                </form> -->
            </section>
        </main>
    </body>
</html>