<!DOCTYPE html>
<html>
    <head>
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
                background-color: rgb(231 235 241);
                border: 1px solid #ccc;
                margin: 20px 0;
                padding: 20px;
                border-radius: 5px;
            }

            .reviewBox h2 {
                margin-top: 0;
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

            .top-star {
                font-size: 50px;
            }

            .fa-star {
                color: orange;
            }

            .top-star-text {
                font-size: 30px;
            }

            .scroller {
                overflow: scroll;
                padding: 5px;
                height: 650px;
            }

            .return-btn {
                background-color: red;
                color: white;
                padding: 10px 20px;
                border-radius: 8px;
                border: none;
                cursor: pointer;
                text-decoration: none;
            }

            .return-btn:hover {
                background-color: darkred;
            }
            
        </style>
    </head>
    <body>
        <header>
            <h1>Reviews on {{ $itemName[0] }}</h1>
            @if ($avgStars > 0.9)
            <span><i class="fa fa-star top-star">★</i></span>
            @else
            <span><i class="fa fa-star top-star">☆</i></span>
            @endif
            @if ($avgStars > 1.9)
            <span><i class="fa fa-star top-star">★</i></span>
            @else
            <span><i class="fa fa-star top-star">☆</i></span>
            @endif
            @if ($avgStars > 2.9)
            <span><i class="fa fa-star top-star">★</i></span>
            @else
            <span><i class="fa fa-star top-star">☆</i></span>
            @endif
            @if ($avgStars > 3.9)
            <span><i class="fa fa-star top-star">★</i></span>
            @else
            <span><i class="fa fa-star top-star">☆</i></span>
            @endif
            @if ($avgStars > 4.9)
            <span><i class="fa fa-star top-star">★</i></span>
            @else
            <span><i class="fa fa-star top-star">☆</i></span>
            @endif
            <p><i class="fa fa-star top-star-text">{{ $avgStars }} Stars</i></p>
        </header>
        <main class="scroller">
        @if (!count($attractions) == 0 || isset($attractions)) <!-- If the set is not empty -->
                @foreach ($attractions as $attraction)
                    <section class="reviewBox">
                        <h2>{{ $attraction->title }}</h2>
                        <p class="review-text">{{ $attraction->text }}</p>
                        @foreach ($users as $user)
                            @if ($attraction->userID == $user->id)
                                <span class="review-creator">- {{ $user->name }}</span>
                                <p>
                                <span><i class="fa fa-text">{{ $attraction->stars }} Stars</i></span>
                                @if ($attraction->stars > 0)
                                <span><i class="fa fa-star">★</i></span>
                                @else
                                <span><i class="fa fa-star">☆</i></span>
                                @endif
                                @if ($attraction->stars > 1)
                                <span><i class="fa fa-star">★</i></span>
                                @else
                                <span><i class="fa fa-star">☆</i></span>
                                @endif
                                @if ($attraction->stars > 2)
                                <span><i class="fa fa-star">★</i></span>
                                @else
                                <span><i class="fa fa-star">☆</i></span>
                                @endif
                                @if ($attraction->stars > 3)
                                <span><i class="fa fa-star">★</i></span>
                                @else
                                <span><i class="fa fa-star">☆</i></span>
                                @endif
                                @if ($attraction->stars > 4)
                                <span><i class="fa fa-star">★</i></span>
                                @else
                                <span><i class="fa fa-star">☆</i></span>
                                @endif
                                </p>
                            @endif
                        @endforeach
                    </section>
                @endforeach
            @endif

            @if (!count($books) == 0 || isset($books)) <!-- If the set is not empty -->
                @foreach ($books as $book)
                    <section class="reviewBox">
                        <h2>{{ $book->title }}</h2>
                        <p class="review-text">{{ $book->text }}</p>
                        @foreach ($users as $user)
                            @if ($book->userID == $user->id)
                                <span class="review-creator">- {{ $user->name }}</span>
                                <p>
                                <span><i class="fa fa-text">{{ $book->stars }} Stars</i></span>
                                @if ($book->stars > 0)
                                <span><i class="fa fa-star">★</i></span>
                                @else
                                <span><i class="fa fa-star">☆</i></span>
                                @endif
                                @if ($book->stars > 1)
                                <span><i class="fa fa-star">★</i></span>
                                @else
                                <span><i class="fa fa-star">☆</i></span>
                                @endif
                                @if ($book->stars > 2)
                                <span><i class="fa fa-star">★</i></span>
                                @else
                                <span><i class="fa fa-star">☆</i></span>
                                @endif
                                @if ($book->stars > 3)
                                <span><i class="fa fa-star">★</i></span>
                                @else
                                <span><i class="fa fa-star">☆</i></span>
                                @endif
                                @if ($book->stars > 4)
                                <span><i class="fa fa-star">★</i></span>
                                @else
                                <span><i class="fa fa-star">☆</i></span>
                                @endif
                                </p>
                            @endif
                        @endforeach
                    </section>
                @endforeach
            @endif

            @if (!count($foods) == 0 || isset($foods)) <!-- If the set is not empty -->
                @foreach ($foods as $food)
                    <section class="reviewBox">
                        <h2>{{ $food->title }}</h2>
                        <p class="review-text">{{ $food->text }}</p>
                        @foreach ($users as $user)
                            @if ($food->userID == $user->id)
                                <span class="review-creator">- {{ $user->name }}</span>
                                <p>
                                <span><i class="fa fa-text">{{ $food->stars }} Stars</i></span>
                                @if ($food->stars > 0)
                                <span><i class="fa fa-star">★</i></span>
                                @else
                                <span><i class="fa fa-star">☆</i></span>
                                @endif
                                @if ($food->stars > 1)
                                <span><i class="fa fa-star">★</i></span>
                                @else
                                <span><i class="fa fa-star">☆</i></span>
                                @endif
                                @if ($food->stars > 2)
                                <span><i class="fa fa-star">★</i></span>
                                @else
                                <span><i class="fa fa-star">☆</i></span>
                                @endif
                                @if ($food->stars > 3)
                                <span><i class="fa fa-star">★</i></span>
                                @else
                                <span><i class="fa fa-star">☆</i></span>
                                @endif
                                @if ($food->stars > 4)
                                <span><i class="fa fa-star">★</i></span>
                                @else
                                <span><i class="fa fa-star">☆</i></span>
                                @endif
                                </p>
                            @endif
                        @endforeach
                    </section>
                @endforeach
            @endif
        </main>
        <header>
            @if (count($books) >= 1)
                <a href="/book/{{ $books[0]->id }}" class="btn return-btn">Go back</a>
            @endif
            @if (count($foods) >= 1)
                <a href="/food/{{ $foods[0]->id }}" class="btn return-btn">Go back</a>
            @endif
            @if (count($attractions) >= 1)
                <a href="/attraction/{{ $attractions[0]->id }}" class="btn return-btn">Go back</a>
            @endif
        </header>
    </body>
</html>