<!DOCTYPE html>
<html lang="en">
<head>
    <title>PRICEWIZ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../top_nav.css">
    <style>
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }
  body {
    font-family: 'Inter', sans-serif;
  }
  .formbold-mb-3 {
    margin-bottom: 15px;
  }
  .formbold-relative {
    position: relative;
  }
  .formbold-opacity-0 {
    opacity: 0;
  }
  .formbold-stroke-current {
    stroke: currentColor;
  }
  #supportCheckbox:checked ~ div span {
    opacity: 1;
  }

  .formbold-main-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 48px;
  }

  .formbold-form-wrapper {
    margin: 0 auto;
    max-width: 570px;
    width: 100%;
    background: white;
    padding: 40px;
  }

  .formbold-img {
    margin-bottom: 45px;
  }

  .formbold-form-title {
    margin-bottom: 30px;
  }
  .formbold-form-title h2 {
    font-weight: 600;
    font-size: 28px;
    line-height: 34px;
    color: #07074d;
  }
  .formbold-form-title p {
    font-size: 16px;
    line-height: 24px;
    color: #536387;
    margin-top: 12px;
  }

  .formbold-input-flex {
    display: flex;
    gap: 20px;
    margin-bottom: 15px;
  }
  .formbold-input-flex > div {
    width: 50%;
  }
  .formbold-form-input {
    text-align: center;
    width: 100%;
    padding: 13px 22px;
    border-radius: 5px;
    border: 1px solid #dde3ec;
    background: #ffffff;
    font-weight: 500;
    font-size: 16px;
    color: #536387;
    outline: none;
    resize: none;
  }
  .formbold-form-input:focus {
    border-color: #6a64f1;
    box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
  }
  .formbold-form-label {
    color: #536387;
    font-size: 14px;
    line-height: 24px;
    display: block;
    margin-bottom: 10px;
  }

  .formbold-checkbox-label {
    display: flex;
    cursor: pointer;
    user-select: none;
    font-size: 16px;
    line-height: 24px;
    color: #536387;
  }
  .formbold-checkbox-label a {
    margin-left: 5px;
    color: #6a64f1;
  }
  .formbold-input-checkbox {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border-width: 0;
  }
  .formbold-checkbox-inner {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 20px;
    height: 20px;
    margin-right: 16px;
    margin-top: 2px;
    border: 0.7px solid #dde3ec;
    border-radius: 3px;
  }
  .button-container{
    align-item: center;
  }
  .formbold-btn {
    font-size: 16px;
    border-radius: 5px;
    padding: 14px 25px;
    border: none;
    font-weight: 500;
    background-color: #258f2d;
    color: white;
    cursor: pointer;
    margin-top: 25px;
    align-item: center;
  }
  .formbold-btn:hover {
    box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
  }
</style></head>
<body>
<header>
        <section>
            <?php include '../top_nav.html';?>
    </section>

    </header>

<?php
$cpi_id = $_POST["cpi_id"];

$host = "localhost";
$user = "root";
$password = "";
$db = "PRICEWIZ";


$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Connection Error: " . $conn->connect_error);
} else {
    $queryGet = "select * from CPI_CORE where cpi_id='".$cpi_id."'";
    $resultGet = $conn->query($queryGet);

    if($resultGet->num_rows > 0) {
        while ($row = $resultGet->fetch_assoc()) {
?>

    <div class="formbold-main-wrapper">
        <div class="formbold-form-wrapper">
          

            <form name="update_item.php" action="save_updated_data.php" method="POST" enctype="multipart/form-data">
                <div class="formbold-form-title">
                    <h2 class="">UPDATE DATA DETAILS</h2>
                    <p>
                        Insert details of new data you want to update
                    </p>
                </div>
                <input type="hidden" name="cpi_id" value="<?php echo $row['cpi_id']; ?>">

                <div class="formbold-mb-3">
                    <div>
                        <label for="price_date" class="formbold-form-label">
                            Data date:
                        </label>
                        <input
                            value="<?php echo $row["price_date"];?>"
                            type="date"
                            name="price_date"
                            id="price_date"
                            class="formbold-form-input"
                        />
                    </div>
                </div>

                <div class="formbold-input-flex">
                    <div>
                        <label for="overall" class="formbold-form-label"> Overall </label>
                        <input
                            value="<?php echo $row["overall"];?>"
                            type="decimal"
                            name="overall"
                            id="overall"
                            class="formbold-form-input"
                        />
                    </div>
                    <div>
                        <label for="food_beverage" class="formbold-form-label"> Food & Beverage </label>
                        <input
                            value="<?php echo $row["food_beverage"];?>"
                            type="decimal"
                            name="food_beverage"
                            id="food_beverage"
                            class="formbold-form-input"
                        />
                    </div>
                    <div>
                        <label for="housing_utilities" class="formbold-form-label"> Clothing </label>
                        <input
                            value="<?php echo $row["housing_utilities"];?>"
                            type="decimal"
                            name="housing_utilities"
                            id="housing_utilities"
                            class="formbold-form-input"
                        />
                    </div>
                </div>

                <div class="formbold-input-flex">
                    <div>
                        <label for="clothing_footwear" class="formbold-form-label"> Household </label>
                        <input
                            value="<?php echo $row["clothing_footwear"];?>"
                            type="decimal"
                            name="clothing_footwear"
                            id="clothing_footwear"
                            class="formbold-form-input"
                        />
                    </div>
                    <div>
                        <label for="furnishings" class="formbold-form-label"> Furnishings </label>
                        <input
                            value="<?php echo $row["furnishings"];?>"
                            type="decimal"
                            name="furnishings"
                            id="furnishings"
                            class="formbold-form-input"
                        />
                    </div>
                    <div>
                        <label for="health" class="formbold-form-label"> Health </label>
                        <input
                            value="<?php echo $row["health"];?>"
                            type="decimal"
                            name="health"
                            id="health"
                            class="formbold-form-input"
                        />
                    </div>
                </div>
                <div class="formbold-checkbox-wrapper">
                    <label for="supportCheckbox" class="formbold-checkbox-label">
                        <div class="formbold-relative">
                            <input
                                type="checkbox"
                                id="supportCheckbox"
                                class="formbold-input-checkbox"
                                required
                            />
                            <div class="formbold-checkbox-inner">
                                <span class="formbold-opacity-0">
                                    <svg
                                        width="11"
                                        height="8"
                                        viewBox="0 0 11 8"
                                        fill="none"
                                        class="formbold-stroke-current"                                    >
                                        <path
                                            d="M10.0915 0.951972L10.0867 0.946075L10.0813 0.940568C9.90076 0.753564 9.61034 0.753146 9.42927 0.939309L4.16201 6.22962L1.58507 3.63469C1.40401 3.44841 1.11351 3.44879 0.932892 3.63584C0.755703 3.81933 0.755703 4.10875 0.932892 4.29224L0.932878 4.29225L0.934851 4.29424L3.58046 6.95832C3.73676 7.11955 3.94983 7.2 4.1473 7.2C4.36196 7.2 4.55963 7.11773 4.71406 6.9584L10.0468 1.60234C10.2436 1.4199 10.2421 1.1339 10.0915 0.951972ZM4.2327 6.30081L4.2317 6.2998C4.23206 6.30015 4.23237 6.30049 4.23269 6.30082L4.2327 6.30081Z"
                                            stroke-width="0.4"
                                        ></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                        I confirm all the details insert above are correct
                    </label>
                </div>

                <div class="button-container">
                    
                    <input class="formbold-btn" type="reset" value="Clear Data">
                    <input class="formbold-btn" type="submit" value="Update Data">
                </div>
            </form>
        </div>
    </div>

<?php
        }
    }
}
?>

</body>
</html>
