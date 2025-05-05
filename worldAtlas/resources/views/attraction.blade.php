<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attraction Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('food.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .foodCard-contianer {
        display: flex;
        gap: 20px;
        overflow-x: auto;
        padding: 20px;
        background-color: #f5f5f5;
        scroll-behavior: smooth;
        white-space: nowrap;
        }

        .foodItem-Card {
            flex: 0 0 auto;
            width: 300px;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .foodItem-Card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .foodItem-Card h2 {
            font-size: 18px;
            color: #333;
            text-align: center;
            padding: 10px 0;
            margin: 0;
            border-bottom: 1px solid #eee;
            background-color: #f9f9f9;
        }

        .foodItem-Card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }

        .foodItem-Card p {
            padding: 15px;
            color: #555;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }

        .foodItem-Card a {
            display: inline-block;
            margin: 10px 15px;
            text-decoration: none;
            font-weight: bold;
            color: #1a73e8;
            transition: color 0.3s ease;
        }

        .foodItem-Card a:hover {
            color: #0048a2;
        }
    </style>
</head>

<body>
    <h1>Hello, you have reached the Food page!</h1>
    <h2>Explore what the world has to offer your tastebuds!</h2>

    <div class="foodCard-contianer">
        <div class="foodItem-Card">
            <h2>Food item 1</h2>
            <img src="" alt="food img 1">
            <p>Food desc</p>
            <p> <a href="">Link to wkipedia or forms</a>  </p>
        </div>

        <div class="foodItem-Card">
            <h2>Food item 2</h2>
            <img src="" alt="food img 1">
            <p>Food desc</p>
            <p> <a href="">Link to wkipedia or forms</a>  </p>
        </div>

        <div class="foodItem-Card">
            <h2>Food item 2</h2>
            <img src="" alt="food img 1">
            <p>Food desc</p>
            <p> <a href="">Link to wkipedia or forms</a>  </p>
        </div>

        <div class="foodItem-Card">
            <h2>Food item 2</h2>
            <img src="" alt="food img 1">
            <p>Food desc</p>
            <p> <a href="">Link to wkipedia or forms</a>  </p>
        </div>

    </div>

    <section>
        <div>
            <div class="container">
                <h1>This is the food form. Use this form to add a food to our database!</h1>
                <h2>This is a Form you can use to add Foods to our website. </h2>
                <form id="foodForm" role="form" method="GET">
                    @csrf
                    <div class="form-group">
                        <label for="name">What's the name of the food?</label>
                        <input class="form-control" type="text" id="name" placeholder="Food Name">
                    </div>

                    <div class="form-group">
                        <label for="countryName">What Country?</label>
                        <input class="form-control" type="text" id="countryName" placeholder="Country Name">
                    </div>

                    <div class="form-group">
                        <label for="continentName">What Continent?</label>
                        <input class="form-control" type="text" id="continentName" placeholder="Continent Name">
                    </div>

                    <div class="form-group">
                        <label for="describer">Describe your Food!</label>
                        <textarea class="form-control" id="describer" rows="4" placeholder="Enter a Description for the food here."></textarea>
                    </div>

                    <div class="form-group">
                        <label for="foodImg">Please upload a photo of your food:</label>
                        <input class="form-control" type="file" id="foodImg" accept="image/*">
                    </div>

                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div>
    </section>
    
    <script>
    
    document.querySelector("foodForm").addEventListener("submit", function(handleFoodSubmission){
        handleFoodSubmission.preventDefault();
        const name = document.getElementById("name").value;
        const country = document.getElementById("countryName").value;
        const continent = document.getElementById("continentName").value;
        const desc = document.getElementById("describer").value;
        const imgInput = document.getElementById("foodImg").value;
        const imgFile = imgInput.files[0];

        if(!imgFile){
            alert("Don't forget to add a pic :)")
            return;
        }

        const imgURL = URL.createObjectURL(imgFile);
        const newCard = document.createElement("div");

        newCard.className = "foodItem-Card";
        newCard.innerHTML = 
        `<h2>${name}</h2>
        <img src="${imgURL}" alt="${name}">
        <p><strong>Country:</strong></p>
        <p><strong>Continent:</strong></p>
        <p>${description}</p>
        <p><a href="#">Learn More</a></p>`

        document.querySelector(".foodCard-contianer").appendChild(newCard);

        this.reset()

        });

        // window.onload = function(){
        //     const form = document.getElementById("foodForm");
        //     form.onsubmit = handleFoodSubmission;
        // }
    </script>
</body>
</html>