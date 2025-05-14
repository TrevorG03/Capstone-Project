<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Attractions Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('attractions.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .attractionCard-container {
        display: flex;
        gap: 20px;
        overflow-x: auto;
        padding: 20px;
        background-color: #f5f5f5;
        scroll-behavior: smooth;
        white-space: nowrap;
        }

        .attractionItem-Card {
            flex: 0 0 auto;
            width: 350px; /* Slightly wider for attraction details */
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .attractionItem-Card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .attractionItem-Card h2 {
            font-size: 20px;
            color: #333;
            text-align: center;
            padding: 12px 0;
            margin: 0;
            border-bottom: 1px solid #eee;
            background-color: #f9f9f9;
        }

        .attractionItem-Card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            display: block;
        }

        .attractionItem-Card p {
            padding: 15px;
            color: #555;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }

        .attractionItem-Card a {
            display: inline-block;
            margin: 10px 15px;
            text-decoration: none;
            font-weight: bold;
            color: #2ecc71;
            transition: color 0.3s ease;
        }

        .attractionItem-Card a:hover {
            color: #27ae60;
        }
        .pageTitle{
            font-family: "Helvetica Neue";
            text-align: center;
            color: #2c3e50;
        }
        .pageSubTitle{
            font-family: "Arial";
            text-align: center;
            color: #34495e;
        }
        .formHeader{
            font-family: "Helvetica Neue";
            text-align: center;
        }
        .formSubHead{
            font-family: "Arial";
            text-align: center;
        }
    </style>
</head>

<body>
    <h1 class="pageTitle">Discover Amazing Places!</h1>
    <h2 class="pageSubTitle">Explore the world's most fascinating destinations</h2>

    <div class="attractionCard-container">
    </div>

    <section>
        <div>
            <div class="container">
                <h1 class="formHeader">Share a Tourist Attraction</h1>
                <h2 class="formSubHead">Help others discover amazing places to visit</h2>
                <form id="attractionForm" role="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Attraction Name</label>
                        <input class="form-control" type="text" id="name" placeholder="Enter attraction name">
                    </div>

                    <div class="form-group">
                        <label for="location">Location</label>
                        <input class="form-control" type="text" id="location" placeholder="City, Country">
                    </div>

                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category">
                            <option value="">Select a category</option>
                            <option value="Historical Site">Historical Site</option>
                            <option value="Natural Wonder">Natural Wonder</option>
                            <option value="Museum">Museum</option>
                            <option value="Park">Park</option>
                            <option value="Architecture">Architecture</option>
                            <option value="Entertainment">Entertainment</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="describer">Description</label>
                        <textarea class="form-control" id="describer" rows="4" 
                                placeholder="Describe what makes this place special, best time to visit, etc."></textarea>
                    </div>

                    <div class="form-group">
                        <label for="ticketPrice">Ticket Price (Optional)</label>
                        <input class="form-control" type="text" id="ticketPrice" 
                               placeholder="Enter ticket price or 'Free' if no admission fee">
                    </div>

                    <div class="form-group">
                        <label for="attractionImg">Upload Image</label>
                        <input class="form-control-file" type="file" id="attractionImg" accept="image/*">
                    </div>

                    <button type="submit" class="btn btn-success">Add Attraction</button>
                </form>
            </div>
        </div>
    </section>
    
    <script>
    document.getElementById("attractionForm").addEventListener("submit", function(event) {
        event.preventDefault();
        
        const name = document.getElementById("name").value;
        const location = document.getElementById("location").value;
        const category = document.getElementById("category").value;
        const description = document.getElementById("describer").value;
        const ticketPrice = document.getElementById("ticketPrice").value;
        const imgInput = document.getElementById("attractionImg");
        
        if (!imgInput.files || !imgInput.files[0]) {
            alert("Please upload an image of the attraction");
            return;
        }

        const imgFile = imgInput.files[0];
        const imgURL = URL.createObjectURL(imgFile);
        const newCard = document.createElement("div");

        newCard.className = "attractionItem-Card";
        newCard.innerHTML = `
            <h2>${name}</h2>
            <img src="${imgURL}" alt="${name}">
            <p><strong>Location:</strong> ${location}</p>
            <p><strong>Category:</strong> ${category}</p>
            ${ticketPrice ? `<p><strong>Ticket Price:</strong> ${ticketPrice}</p>` : ''}
            <p>${description}</p>
            <p><a href="#">View Details</a></p>
        `;

        document.querySelector(".attractionCard-container").appendChild(newCard);

        this.reset();
    });
    </script>

</body>
</html>
