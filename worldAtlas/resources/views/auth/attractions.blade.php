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
                max-width: 25%;
                border: 1px solid black;
            }

            .book-info {
                border: 3px dashed black;
                border-radius: 2px;
                margin: 10px;
                padding-left: 5%;
                padding-bottom: 3%;
                align-items: center;
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

            .button-container {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 10px;
            }
            
        </style>
    </head>
    <body>
        <header>
            <h1>{{ $attraction[0]->name }}</h1>
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
            <p><i class="fa top-star-text">{{ $avgStars }} Stars</i></p>
        </header>
        <main>
            @if (isset(request()->attractionID))
                <p></p>
            @else
                <p>attractionID is NOT set</p>
            @endif
            <section class="reviewBox">
                <div class="book-box">
                    <img src="{{ $attraction[0]->imgURL }}" alt="Book image" class="book-image">
                </div>
                <hr>
                <div class="book-info">
                    <h2>{{ $attraction[0]->name }}</h2>
                    <p class="book-text">{{ $attraction[0]->describer }}</p>
                </div>
                <p></p>
                <span class="book-author">Publisher: <p class="review-creator">{{ $attraction[0]->publisher }}</p></span>
                <div class="button-container">
                    <form action="/review/attraction/{{ $attraction[0]->id }}" method="post">
                        @csrf
                        <button type="submit" class="base-button">View more reviews about this item</button>
                    </form>
                    <form action="/purchase/attraction/{{ $attraction[0]->id }}" method="post">
                        @csrf
                        <button type="submit" class="base-button" style="color: white; background-color: #87CEFA; font-size: 20px;">Book now!</button>
                    </form>
                </div>
            </section>
            @if (count($attractions) == 0 || !isset($attractions)) <!-- If the set is empty -->
                <section class="reviewBox">
                    <h3>ERROR: Attractions has nothing in it!</h3>
                </section>
            @else <!-- Otherwise... -->
                <section class="reviewBox">
                    <h2>{{ $reviewOne->title }}</h2>
                    <p class="review-text">{{ $reviewOne->text }}</p>
                    @foreach ($users as $user)
                        @if ($reviewOne->userID == $user->id)
                            <span class="review-creator">- {{ $user->name }}</span>
                            <p>
                            <span><i class="fa fa-text">{{ $reviewOne->stars }} Stars</i></span>
                            @if ($reviewOne->stars > 0)
                            <span><i class="fa fa-star">★</i></span>
                            @else
                            <span><i class="fa fa-star">☆</i></span>
                            @endif
                            @if ($reviewOne->stars > 1)
                            <span><i class="fa fa-star">★</i></span>
                            @else
                            <span><i class="fa fa-star">☆</i></span>
                            @endif
                            @if ($reviewOne->stars > 2)
                            <span><i class="fa fa-star">★</i></span>
                            @else
                            <span><i class="fa fa-star">☆</i></span>
                            @endif
                            @if ($reviewOne->stars > 3)
                            <span><i class="fa fa-star">★</i></span>
                            @else
                            <span><i class="fa fa-star">☆</i></span>
                            @endif
                            @if ($reviewOne->stars > 4)
                            <span><i class="fa fa-star">★</i></span>
                            @else
                            <span><i class="fa fa-star">☆</i></span>
                            @endif
                            </p>
                        @endif
                    @endforeach
                </section>
                <section class="reviewBox">
                    <h2>{{ $reviewTwo->title }}</h2>
                    <p class="review-text">{{ $reviewTwo->text }}</p>
                    @foreach ($users as $user)
                        @if ($reviewTwo->userID == $user->id)
                            <span class="review-creator">- {{ $user->name }}</span>
                            <p>
                            <span><i class="fa fa-text">{{ $reviewTwo->stars }} Stars</i></span>
                            @if ($reviewTwo->stars > 0)
                            <span><i class="fa fa-star">★</i></span>
                            @else
                            <span><i class="fa fa-star">☆</i></span>
                            @endif
                            @if ($reviewTwo->stars > 1)
                            <span><i class="fa fa-star">★</i></span>
                            @else
                            <span><i class="fa fa-star">☆</i></span>
                            @endif
                            @if ($reviewTwo->stars > 2)
                            <span><i class="fa fa-star">★</i></span>
                            @else
                            <span><i class="fa fa-star">☆</i></span>
                            @endif
                            @if ($reviewTwo->stars > 3)
                            <span><i class="fa fa-star">★</i></span>
                            @else
                            <span><i class="fa fa-star">☆</i></span>
                            @endif
                            @if ($reviewTwo->stars > 4)
                            <span><i class="fa fa-star">★</i></span>
                            @else
                            <span><i class="fa fa-star">☆</i></span>
                            @endif
                            </p>
                        @endif
                    @endforeach
                </section>
                <section class="reviewBox">
                    <h2>{{ $reviewThree->title }}</h2>
                    <p class="review-text">{{ $reviewThree->text }}</p>
                    @foreach ($users as $user)
                        @if ($reviewThree->userID == $user->id)
                            <span class="review-creator">- {{ $user->name }}</span>
                            <p>
                            <span><i class="fa fa-text">{{ $reviewThree->stars }} Stars</i></span>
                            @if ($reviewThree->stars > 0)
                            <span><i class="fa fa-star">★</i></span>
                            @else
                            <span><i class="fa fa-star">☆</i></span>
                            @endif
                            @if ($reviewThree->stars > 1)
                            <span><i class="fa fa-star">★</i></span>
                            @else
                            <span><i class="fa fa-star">☆</i></span>
                            @endif
                            @if ($reviewThree->stars > 2)
                            <span><i class="fa fa-star">★</i></span>
                            @else
                            <span><i class="fa fa-star">☆</i></span>
                            @endif
                            @if ($reviewThree->stars > 3)
                            <span><i class="fa fa-star">★</i></span>
                            @else
                            <span><i class="fa fa-star">☆</i></span>
                            @endif
                            @if ($reviewThree->stars > 4)
                            <span><i class="fa fa-star">★</i></span>
                            @else
                            <span><i class="fa fa-star">☆</i></span>
                            @endif
                            </p>
                        @endif
                    @endforeach
                </section>
            @endif
            <header>
                <h1>New review</h1>
                <form action="/attraction/createReview/{{ $attraction[0]->id }}" id="reviewForm" method="POST">
                    @csrf
                    <label for="title">Title:</label><br>
                    <input type="text" id="title" name="title" required><br><br>

                    <label for="text">Text:</label><br>
                    <textarea id="text" name="text" rows="4" cols="50" required></textarea><br><br>

                    <label for="stars">Rate (1 to 5):</label><br>
                    <select id="stars" name="stars" required>
                        <option value="1">1 Star</option>
                        <option value="2">2 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="5">5 Stars</option>
                    </select><br><br>

                    <button type="submit">Submit</button>
                </form>
            </header>
        </main>

        <script>
            document.getElementById("reviewForm").onsubmit = function(event) {
                const title = document.getElementById("title").value;
                const text = document.getElementById("text").value;
                const stars = document.getElementById("stars").value;
                const attractions = @json($attractions); 
                const sessionUserID = "{{ session('userID') }}";

                for (let i = 0; i < attractions.length; i++) {
                    if (attractions[i].userID === sessionUserID) {
                        alert('You cannot submit two reviews for the same item.');
                        event.preventDefault();
                        break;
                    }
                }

                if (!title || !text || !stars) {
                    alert("Please fill out all fields!");
                    event.preventDefault();
                }
            };
        </script>
    </body>
</html>