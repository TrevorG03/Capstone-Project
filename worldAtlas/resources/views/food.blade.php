<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Food Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('food.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .foodCard-container {
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
        .pageTitle{
            font-family: "Papyrus";
            text-align: center;
        }
        .pageSubTitle{
            font-family: "Garamond";
            text-align: center;
        }
        .formHeader{
            font-family: "Papyrus";
            text-align: center;
        }
        .formSubHead{
            font-family: "Garamond";
            text-align: center:
        }
    </style>
</head>

<body>
    <h1 class="pageTitle">Hello, you have reached the Food page!</h1>
    <h2 class="pageSubTitle">Explore what the world has to offer your tastebuds!</h2>

    <div class="foodCard-container">

    </div>

    <section>
        <div>
            <div class="container">
                <h1 class="formHeader">This is the food form. Use this form to add a food to our database!</h1>
                <h2 class="formSubHead">This is a Form you can use to add Foods to our website. </h2>
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
                        <input class="form-control-file" type="file" id="foodImg" accept="image/*">
                    </div>

                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div>
    </section>
    
    <script>
    // Use getElementById instead of querySelector for getting the form by ID
    document.getElementById("foodForm").addEventListener("submit", function(event) {
        // Changed parameter name to 'event' for clarity
        event.preventDefault();
        
        const name = document.getElementById("name").value;
        const country = document.getElementById("countryName").value;
        const continent = document.getElementById("continentName").value;
        const description = document.getElementById("describer").value; // Changed 'desc' to 'description' to match usage below
        const imgInput = document.getElementById("foodImg"); // Removed .value here
        
        // Check if files exist before accessing first element
        if (!imgInput.files || !imgInput.files[0]) {
            alert("Don't forget to add a pic :)");
            return;
        }

        const imgFile = imgInput.files[0];
        const imgURL = URL.createObjectURL(imgFile);
        const newCard = document.createElement("div");

        newCard.className = "foodItem-Card";
        newCard.innerHTML = `
            <h2>${name}</h2>
            <img src="${imgURL}" alt="${name}">
            <p><strong>Country:</strong> ${country}</p>
            <p><strong>Continent:</strong> ${continent}</p>
            <p>${description}</p>
            <p><a href="#">Learn More</a></p>
        `;

        // Make sure this class name matches exactly what's in your HTML
        document.querySelector(".foodCard-container").appendChild(newCard); // Fixed typo in 'container'

        this.reset();
    });
</script>

</body>
</html>