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
                background-color: white;
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
                font-size: 16px;
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
        </style>
    </head>
    <body>
        <header>
            <h1>Product Reviews</h1>
        </header>
        <main>
            @if (count($attractions) == 0 || !isset($attractions)) <!-- If the set is empty --> 
                <section class="reviewBox">
                <h3>ERROR: Attractions has nothing in it!</h3>
                </section>
            @else <!-- Otherwise... -->
                @foreach ($attractions as $attraction)
                    <section class="reviewBox">
                        <h2>{{ $attraction->title }}</h2>
                        <p class="review-text">{{ $attraction->text }}</p>
                        @foreach ($users as $user)
                            @if ($attraction->userID == $user->id)
                                <span class="review-creator">- {{ $user->name }}</span>
                            @endif
                        @endforeach
                        <form action="review" method="post">
                            @csrf
                            <button type="submit" class="base-button">View more posts by this person [WIP]</button>
                        </form>
                    </section>
                @endforeach
            @endif

            @if (count($books) == 0 || !isset($books)) <!-- If the set is empty -->
                <section class="reviewBox">
                    <h3>ERROR: Books has nothing in it!</h3>
                </section>
            @else <!-- Otherwise... -->
                @foreach ($books as $book)
                    <section class="reviewBox">
                        <h2>{{ $book->title }}</h2>
                        <p class="review-text">{{ $book->text }}</p>
                        @foreach ($users as $user)
                            @if ($book->userID == $user->id)
                                <span class="review-creator">- {{ $user->name }}</span>
                            @endif
                        @endforeach
                        <form action="review" method="post">
                            @csrf
                            <button type="submit" class="base-button">View more posts by this person [WIP]</button>
                        </form>
                    </section>
                @endforeach
            @endif

            @if (count($foods) == 0 || !isset($foods)) <!-- If the set is empty -->
                <section class="reviewBox">
                    <h3>ERROR: Foods has nothing in it!</h3>
                </section>
            @else <!-- Otherwise... -->
                @foreach ($foods as $food)
                    <section class="reviewBox">
                        <h2>{{ $food->title }}</h2>
                        <p class="review-text">{{ $food->text }}</p>
                        @foreach ($users as $user)
                            @if ($food->userID == $user->id)
                                <span class="review-creator">- {{ $user->name }}</span>
                            @endif
                        @endforeach
                        <form action="review" method="post">
                            @csrf
                            <button type="submit" class="base-button">View more posts by this person [WIP]</button>
                        </form>
                    </section>
                @endforeach
            @endif
        </main>
    </body>
</html>