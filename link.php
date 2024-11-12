<?php
// Database connection variables
$servername = "localhost";
$username = "root";
$password = ""; // default password for XAMPP
$dbname = "restaurant_db"; // the name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $full_name = $_POST['name of client'];
    $phone_number = $_POST['website'];
    $food_drinks = $_POST['tax_status_abn'];
    $email_address= $_POST['taxable'];
    $number_of_guest = $_POST['occupation'];
    $payment_information= $_POST['hours_of_operation'];
    $date_and_time= $_POST['years_in_operation'];
    $special_request = $_POST['insurance_start'];
    $prerered_contact_method = $_POST['insurance_end'];

    // Checkbox values for yes/no questions
    $insurance_declined = isset($_POST['insurance_declined']) ? 1 : 0;
    $insurer_refused = isset($_POST['insurer_refused']) ? 1 : 0;
    $special_conditions = isset($_POST['special_conditions']) ? 1 : 0;
    $special_excess = isset($_POST['special_excess']) ? 1 : 0;
    $claim_rejected = isset($_POST['claim_rejected']) ? 1 : 0;
    $bankruptcy = isset($_POST['bankruptcy']) ? 1 : 0;
    $criminal_offence = isset($_POST['criminal_offence']) ? 1 : 0;
    $other_disclosures = isset($_POST['other_disclosures']) ? 1 : 0;

    // Claims history data (you can customize this as needed)
    $claims_history = json_encode($_POST['claims_history']);

    // SQL query to insert the form data into the database
    $sql = "INSERT INTO applications (
                named_insured, trading_as, website, tax_status_abn, taxable, 
                occupation, hours_of_operation, years_in_operation, insurance_start, insurance_end,
                insurance_declined, insurer_refused, special_conditions, special_excess, claim_rejected, 
                bankruptcy, criminal_offence, other_disclosures, claims_history
            ) VALUES (
                '$named_insured', '$trading_as', '$website', '$tax_status_abn', '$taxable',
                '$occupation', '$hours_of_operation', '$years_in_operation', '$insurance_start', '$insurance_end',
                '$insurance_declined', '$insurer_refused', '$special_conditions', '$special_excess', '$claim_rejected',
                '$bankruptcy', '$criminal_offence', '$other_disclosures', '$claims_history'
            )";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>

<!-- HTML form submission code (this should be on your form page) -->
<form action="submit.php" method="post">
    Named Insured: <input type="text" name="named_insured"><br>
    Trading As: <input type="text" name="trading_as"><br>
    Website: <input type="text" name="website"><br>
    Tax Status ABN: <input type="text" name="tax_status_abn"> Taxable: <input type="text" name="taxable"><br>
    Occupation: <input type="text" name="occupation"><br>
    Hours of Operation: <input type="text" name="hours_of_operation"><br>
    Years in Operation: <input type="text" name="years_in_operation"><br>
    Insurance Period: From <input type="date" name="insurance_start"> To <input type="date" name="insurance_end"><br>
    
    <p>Have you or any director/partner/manager of the business ever:</p>
    Insurance declined? <input type="checkbox" name="insurance_declined"><br>
    Insurer refused? <input type="checkbox" name="insurer_refused"><br>
    Special conditions imposed? <input type="checkbox" name="special_conditions"><br>
    Special excess imposed? <input type="checkbox" name="special_excess"><br>
    Claim rejected? <input type="checkbox" name="claim_rejected"><br>
    Bankruptcy? <input type="checkbox" name="bankruptcy"><br>
    Criminal offence? <input type="checkbox" name="criminal_offence"><br>
    Any other disclosures? <input type="checkbox" name="other_disclosures"><br>

    <h4>Claims History</h4>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Insurer</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="date" name="claims_history[0][date]"></td>
                <td><input type="text" name="claims_history[0][insurer]"></td>
                <td><input type="text" name="claims_history[0][details]"></td>
            </tr>
        </tbody>
    </table>

    <input type="submit" value="Submit">
</form>
