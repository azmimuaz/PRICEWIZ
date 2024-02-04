<DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <link rel="stylesheet" href="./index.css">
            <link rel="stylesheet" href="">
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.0/TweenMax.min.js"></script>


            <title>PRICEWIZ</title>
        </head>
        
        <body onload = "onloadHomePage()">
            <header>
                <section>
                    <?php include 'top_nav.html';?>
                </section>

            </header>
            <main>
                <div class="welcome_div">
                    <div>
                        <div>
                          <img src="projectImage\logo_pricewiz (1).png" alt="Your Logo" width="120" height="">
                        </div>
                    </div>

                    <div class="welcome_messages">
                      <p class="welcome_div_first">
                        Deals from your favourites supermarket
                      </p>
                      <p class="welcome_div_second">
                        Try searching for a specfic item and goods, or even category!
                      </p>
                    </div>
                </div>
                  
                  <div class = "functional_div">
                    <div>
                        <div class = "complex_div">
                            <div class = "part1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                class="pointer-events-none max-h-full max-w-full">
                                    <path d="M10 3a7 7 0 1 0 7 7 7 7 0 0 0-7-7zm11 18-6-6" vector-effect="non-scaling-stroke" fill="none"
                                    stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" color="grey" />
                                </svg>
                                <input type="text" placeholder="Enter Item here ..." class="search searchQuerry" />

                                <button class="clearInput">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                      class="pointer-events-none max-h-full max-w-full x_inSearch">
                                        <path vector-effect="non-scaling-stroke" d="m7 7 10 10m0-10L7 17" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" color="grey" />
                                    </svg>
                                </button>
                            </div>`

                            <div class="part2">
                                <button class="part2_submit">Search</button>
                              </div>
                            </div>
                            <div class="imageOfCompanies">
                                <p style="
                                      font-size: 16px;
                                      font-family: Proxima Vara, Arial, Helvetica, Sans, Sans-Serif;
                                      font-weight: 700;
                                    ">We compare multiple supermarkets at once
                                </p>
                                <div class="screenShotImg">
                                  <img data-testid="advertiser-image"
                                    src="https://vectorlogo4u.com/wp-content/uploads/2021/08/lotuss-logo-vector-01.png" alt="Lotus"
                                    class="flex-grow-0 flex-shrink-0 AdvertiserImage_image__bArcZ" style="height: 150px; width: 300px" />
                                  <img data-testid="advertiser-image"
                                    src="projectImage/mydin-logo.png" alt="Mydin"
                                    class="flex-grow-0 flex-shrink-0 AdvertiserImage_image__bArcZ" style="height: 150px; width: 300px" />
                                  <img data-testid="advertiser-image"
                                    src="projectImage/PasarRaya-CS-logo.png" alt="PasarRaya CS"
                                    class="flex-grow-0 flex-shrink-0 AdvertiserImage_image__bArcZ" style="height: 100px; width: 200px" />
                                
                                </div>
                              </div>
                        </div>
                    </div>
                    
                    <div class = "category">
                        <div>
                            <div class = "category_title">
                                <h4>Category</h4>
                            </div>
                            <div>
                                <div>
                                    <hr class="topCityDestination_hr" />
                                    <div class="containerForCategory">
                                        <div id="baby">
                                            <a href="Category/baby_product_page.php" class="category-link">
                                                <div class="category-container">
                                                    <img src="projectImage\category_baby_product.jpg" alt="baby product img" style="width: 220; height: 130; border-radius: 10;" />
                                                    <p class="titleOfEachCategory">Baby Product</p>
                                                </div>
                                            </a>
                                        </div>
                                    
                                        <div id="beverage">
                                            <a href="Category/beverage_page.php" class="category-link">
                                                <div class="category-container">
                                                    <img src="projectImage\category_beverage.jpg" alt="beverage img" style="width: 220; height: 130; border-radius: 10;" />
                                                    <p class="titleOfEachCategory">Beverage</p>
                                                </div>
                                            </a>
                                        </div>
                                    
                                        <div id="chilled">
                                            <a href="Category/chilled_frozen_page.php" class="category-link">
                                                <div class="category-container">
                                                    <img src="projectImage\category_frozen.jpg" alt="chilled img" style="width: 220; height: 130; border-radius: 10;" />
                                                    <p class="titleOfEachCategory">Chilled & Frozen</p>
                                                </div>
                                            </a>
                                        </div>
                                    
                                        <div id="fresh" class="category-link">
                                            <a href="Category/fresh_page.php">
                                                <div class="category-container">
                                                    <img src="projectImage\category_fresh_product.jpeg" alt="fresh img" style="width: 220; height: 130; border-radius: 10;" />
                                                    <p class="titleOfEachCategory">Fresh Product</p>
                                                </div>
                                            </a>
                                        </div>
                                    
                                        <div id="grocery" class="category-link">
                                            <a href="Category/grocery_page.php">
                                                <div class="category-container">
                                                    <img src="projectImage\category_grocery-removebg-preview.png" alt="grocery img" style="width: 220; height: 130; border-radius: 10;" />
                                                    <p class="titleOfEachCategory">Grocery</p>
                                                </div>
                                            </a>
                                        </div>
                                    
                                        <div id="health" class="category-link">
                                            <a href="Category/health_page.php">
                                                <div class="category-container">
                                                    <img src="projectImage\category_health.jpg" alt="health img" style="width: 220; height: 130; border-radius: 10;" />
                                                    <p class="titleOfEachCategory">Health & Beauty</p>
                                                </div>
                                            </a>
                                        </div>
                                    
                                        <div id="household" class="category-link">
                                            <a href="Category/household_page.php">
                                                <div class="category-container">
                                                    <img src="projectImage\category_household.webp" alt="household img" style="width: 220; height: 130; border-radius: 10;" />
                                                    <p class="titleOfEachCategory">Household</p>
                                                </div>
                                            </a>
                                        </div>
                                    
                                        <div id="meat" class="category-link">
                                            <a href="Category/meat_page.php">
                                                <div class="category-container">
                                                    <img src="projectImage\category_meat_poultry.jpg" alt="meat img" style="width: 220; height: 130; border-radius: 10;" />
                                                    <p class="titleOfEachCategory">Meat & Poultry</p>
                                                </div>
                                            </a>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>

                        </div>
                    </div>
                  
                  </div>
                
            </main>

        </body>
    </html>
</DOCTYPE>
