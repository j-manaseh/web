
CREATE TABLE booked_classes (
  class_booking_id INT NOT NULL AUTO_INCREMENT,
  fname VARCHAR(255) NOT NULL,
  lname VARCHAR(255) NOT NULL,
  id INT NOT NULL,
  class_name VARCHAR(255) NOT NULL,
  date DATE NOT NULL,
  time TIME NOT NULL,
  PRIMARY KEY (class_booking_id),
  FOREIGN KEY (id) REFERENCES members(id)
);






CREATE TABLE active AS
SELECT *
FROM members
WHERE status = 1;







CREATE TRIGGER update_active
AFTER INSERT ON members
FOR EACH ROW
BEGIN
  IF NEW.status = 1 THEN
    INSERT INTO active
    VALUES (NEW.id, NEW.fname, NEW.lname, NEW.email, NEW.gender, NEW.password, NEW.phone, NEW.status, NOW());
  END IF;
END;





CREATE TABLE plans (
    plan_id INT NOT NULL AUTO_INCREMENT,
    plan_name VARCHAR(255) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    duration INT NOT NULL,
    PRIMARY KEY (plan_id)
  );
  






  CREATE TABLE subscriptions (
    sub_id INT NOT NULL AUTO_INCREMENT,
    id INT NOT NULL,
    plan_name VARCHAR(255) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    PRIMARY KEY (sub_id),
    FOREIGN KEY (id) REFERENCES members(id)
  );
  
  INSERT INTO subscriptions (id, plan_name, start_date, end_date)
  SELECT m.id, p.plan_name, CURDATE(), DATE_ADD(CURDATE(), INTERVAL p.duration DAY)
  FROM active AS a
  JOIN members AS m ON a.id = m.id
  JOIN plans AS p ON a.plan_name = p.plan_name;
  







  CREATE TABLE expiring_subscriptions AS
  SELECT *
  FROM subscriptions
  WHERE end_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 2 WEEK);
  
  CREATE TABLE expired_subscriptions AS
  SELECT *
  FROM subscriptions
  WHERE end_date < CURDATE();
  








  
  CREATE TABLE invoices (
    invoice_id INT NOT NULL AUTO_INCREMENT,
    sub_id INT NOT NULL,
    id INT NOT NULL,
    plan_name VARCHAR(255) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    fname VARCHAR(255) NOT NULL,
    lname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    PRIMARY KEY (invoice_id),
    FOREIGN KEY (sub_id) REFERENCES subscriptions(sub_id),
    FOREIGN KEY (id) REFERENCES members(id)
  );
  








  CREATE TABLE payments (
    payment_id INT NOT NULL AUTO_INCREMENT,
    sub_id INT NOT NULL,
    amount_paid DECIMAL(10,2) NOT NULL,
    payment_date DATE NOT NULL,
    PRIMARY KEY (payment_id),
    FOREIGN KEY (sub_id) REFERENCES subscriptions(sub_id)
  );
  






  To add a new column to the invoices table indicating whether the invoice has been paid or not, you can use the following SQL code:

ALTER TABLE invoices ADD COLUMN paid TINYINT(1) NOT NULL DEFAULT 0;

This will add a new column named "paid" to the invoices table with a default value of 0 (not paid). The column is defined as TINYINT(1), which allows values from -128 to 127 and occupies 1 byte of storage.

To update the invoices table every time a new record is added to the payments table, you can create a trigger that updates the "paid" column of the corresponding invoice based on the payment record. The trigger can be defined as follows:

CREATE TRIGGER update_invoice_paid
AFTER INSERT ON payments
FOR EACH ROW
BEGIN
UPDATE invoices
SET paid = 1
WHERE sub_id = NEW.sub_id;
END;

This trigger will execute after each insert on the payments table and will update the "paid" column of the invoices table for the corresponding subscription ID (sub_id) with a value of 1 (paid). Note that the trigger assumes that the subscription ID in the payments table corresponds to the subscription ID in the invoices table.

With this trigger in place, every time a new payment is recorded in the payments table, the corresponding invoice in the invoices table will be marked as paid.










To create two new tables named "paid_invoices" and "unpaid_invoices" based on the updated invoices table, you can use the following SQL code:

-- create "paid_invoices" table
CREATE TABLE paid_invoices AS
SELECT *
FROM invoices
WHERE paid = 1;

-- create "unpaid_invoices" table
CREATE TABLE unpaid_invoices AS
SELECT *
FROM invoices
WHERE paid = 0;

These SQL statements create two new tables based on the invoices table, one for paid invoices and one for unpaid invoices. The "paid_invoices" table contains all records in the invoices table where the "paid" column value is 1, and the "unpaid_invoices" table contains all records where the "paid" column value is 0.

To keep these tables updated every time there's a new entry or change made to the invoices table, you can use triggers similar to the one used to update the "paid" column of the invoices table. The triggers can be defined as follows:

-- update "paid_invoices" table
CREATE TRIGGER update_paid_invoices
AFTER INSERT ON invoices
FOR EACH ROW
BEGIN
IF NEW.paid = 1 THEN
INSERT INTO paid_invoices
VALUES (NEW.invoice_id, NEW.sub_id, NEW.id, NEW.plan_name, NEW.start_date, NEW.end_date, NEW.amount, NEW.fname, NEW.lname, NEW.email, NEW.paid);
END IF;
END;

CREATE TRIGGER update_paid_invoices_after_update
AFTER UPDATE ON invoices
FOR EACH ROW
BEGIN
IF NEW.paid = 1 THEN
UPDATE paid_invoices
SET sub_id = NEW.sub_id,
id = NEW.id,
plan_name = NEW.plan_name,
start_date = NEW.start_date,
end_date = NEW.end_date,
amount = NEW.amount,
fname = NEW.fname,
lname = NEW.lname,
email = NEW.email,
paid = NEW.paid
WHERE invoice_id = NEW.invoice_id;
ELSE
DELETE FROM paid_invoices
WHERE invoice_id = NEW.invoice_id;
END IF;
END;

-- update "unpaid_invoices" table
CREATE TRIGGER update_unpaid_invoices
AFTER INSERT ON invoices
FOR EACH ROW
BEGIN
IF NEW.paid = 0 THEN
INSERT INTO unpaid_invoices
VALUES (NEW.invoice_id, NEW.sub_id, NEW.id, NEW.plan_name, NEW.start_date, NEW.end_date, NEW.amount, NEW.fname, NEW.lname, NEW.email, NEW.paid);
END IF;
END;

CREATE TRIGGER update_unpaid_invoices_after_update
AFTER UPDATE ON invoices
FOR EACH ROW
BEGIN
IF NEW.paid = 0 THEN
UPDATE unpaid_invoices
SET sub_id = NEW.sub_id,
id = NEW.id,
plan_name = NEW.plan_name,
start_date = NEW.start_date,
end_date = NEW.end_date,
amount = NEW.amount,
fname = NEW.fname,
lname = NEW.lname,
email = NEW.email,
paid = NEW.paid
WHERE invoice_id = NEW.invoice_id;
ELSE
DELETE FROM unpaid_invoices
WHERE invoice_id = NEW.invoice_id;
END IF;
END;

These triggers will insert new records into the "paid_invoices" and "unpaid_invoices" tables whenever a new record is added to the invoices table, and update the corresponding record when a record in the invoices table is updated. The triggers will also delete records from the "paid_invoices" and "unpaid_invoices" tables when the corresponding record in the invoices table is updated to have






With these tables, we can create the following reports:

Report on members who have an active subscription and their subscription details:
vbnet
Copy code
SELECT m.fname, m.lname, p.plan_name, s.start_date, s.end_date
FROM members AS m
JOIN active AS a ON m.id = a.id
JOIN subscriptions AS s ON m.id = s.id
JOIN plans AS p ON s.plan_name = p.plan_name;
Report on members who have an active subscription but have not yet made payment for their invoice:
vbnet
Copy code
SELECT m.fname, m.lname, i.invoice_id, i.amount, i.start_date, i.end_date
FROM members AS m
JOIN active AS a ON m.id = a.id
JOIN subscriptions AS s ON m.id = s.id
JOIN invoices AS i ON s.sub_id = i.sub_id
WHERE i.paid = 0;
Report on members who have an expired subscription and have not yet made payment for their invoice:
vbnet
Copy code
SELECT m.fname, m.lname, i.invoice_id, i.amount, i.start_date, i.end_date
FROM members AS m
JOIN subscriptions AS s ON m.id = s.id
JOIN invoices AS i ON s.sub_id = i.sub_id
WHERE i.paid = 0 AND i.end_date < CURDATE();
Report on members with expired subscriptions who have made payment for their invoice:
vbnet
Copy code
SELECT m.fname, m.lname, i.invoice_id, i.amount, p.amount_paid, p.payment_date
FROM members AS m
JOIN subscriptions AS s ON m.id = s.id
JOIN invoices AS i ON s.sub_id = i.sub_id
JOIN payments AS p ON s.sub_id = p.sub_id
WHERE i.paid = 1 AND i.end_date < CURDATE();
Report on equipment usage per day:
vbnet
Copy code
SELECT e.equipment_name, a.date, COUNT(DISTINCT a.member_id) AS number_of_users
FROM equipment AS e
JOIN attendance AS a ON e.equipment_id = a.equipment_id
GROUP BY e.equipment_name, a.date;
Report on total number of members who visited the gym for a particular day:
sql
Copy code
SELECT COUNT(DISTINCT member_id) AS total_members
FROM attendance
WHERE date = '2023-03-16';
Report on total number of members who visited the gym within a particular time frame:
sql
Copy code
SELECT COUNT(DISTINCT member_id) AS total_members
FROM attendance
WHERE date BETWEEN '2023-03-01' AND '2023-03-16';
Report on attendance trend over a period of time:
sql
Copy code
SELECT date, COUNT(DISTINCT member_id) AS total_members
FROM attendance
WHERE date BETWEEN '2023-03-01' AND '2023-03-16'
GROUP BY date;
Report on popular gym hours based on attendance:
sql
Copy code
SELECT HOUR(time) AS hour, COUNT(DISTINCT member_id) AS total_members
FROM attendance
WHERE date = '2023-03-16'
GROUP BY HOUR(time)
ORDER BY COUNT(DISTINCT member_id) DESC;











Joshua Manasseh
create a classes_schedule table for a gym management system using SQL
Sure, here's an example of a classes_schedule table for a gym management system using SQL:

sql
Copy code
CREATE TABLE classes_schedule (
    id INT PRIMARY KEY,
    class_name VARCHAR(50),
    instructor_name VARCHAR(50),
    start_time TIME,
    end_time TIME,
    day_of_week VARCHAR(10),
    room_number INT
);
In this table, each row represents a single class scheduled at the gym. Here's a breakdown of the columns:

id: A unique identifier for each class schedule row.
class_name: The name of the class being scheduled (e.g. "Yoga", "Spin", "Zumba", etc.).
instructor_name: The name of the instructor leading the class.
start_time and end_time: The start and end times for the class (in the format of TIME data type).
day_of_week: The day of the week the class is scheduled for (e.g. "Monday", "Tuesday", etc.).
room_number: The number of the room where the class will be held.
You can add more columns to the table as per your requirements. This is just a basic example to get you started.




Joshua Manasseh
Now create an equipments table for that same gym management system   
Sure! Here's an example of an equipments table for the gym management system using SQL:

sql
Copy code
CREATE TABLE equipments (
    id INT PRIMARY KEY,
    equipment_name VARCHAR(50),
    brand VARCHAR(50),
    model VARCHAR(50),
    purchase_date DATE,
    purchase_price DECIMAL(10, 2),
    condition VARCHAR(50),
    available BOOLEAN
);
In this table, each row represents a single piece of equipment owned by the gym. Here's a breakdown of the columns:

id: A unique identifier for each equipment row.
equipment_name: The name of the equipment (e.g. "Treadmill", "Dumbbell", "Elliptical", etc.).
brand: The brand of the equipment.
model: The model number of the equipment.
purchase_date: The date the equipment was purchased (in the format of DATE data type).
purchase_price: The price the gym paid for the equipment (in decimal format with a scale of 2).
condition: The condition of the equipment (e.g. "Excellent", "Good", "Fair", "Poor").
available: A boolean value indicating whether the equipment is currently available for use by gym members.
You can add more columns to the table as per your requirements. This is just a basic example to get you started.




Joshua Manasseh
how can this table be used with other tables in the system to produce reports?
The equipments table can be used in conjunction with other tables in the gym management system to produce reports on equipment usage, maintenance, and inventory. Here are some examples:

Equipment availability report: This report can be generated by joining the equipments table with a table that tracks gym membership and usage. By comparing the total number of gym members to the number of available equipment units, the report can identify times when equipment shortages may be causing member dissatisfaction.

Maintenance report: The equipments table can be joined with a table that tracks equipment maintenance and repairs. By comparing the dates and costs of maintenance activities with the purchase date and price of the equipment, the report can identify equipment that is in need of additional maintenance or may need to be replaced.

Inventory report: The equipments table can be used to produce an inventory report that provides a comprehensive list of all equipment owned by the gym, along with its purchase date, purchase price, and current availability. This report can be used to track equipment usage and identify areas where additional equipment may be needed.

These are just a few examples of how the equipments table can be used in conjunction with other tables to produce reports. The actual reports and their formats will depend on the specific needs of the gym management system and the business goals of the gym.




Joshua Manasseh
show me examples of SQL code for each of the examples listed above
Certainly! Here are some examples of SQL code for the reports mentioned earlier:

Equipment availability report:
sql
Copy code
SELECT 
    COUNT(*) as total_members,
    COUNT(CASE WHEN available = true THEN 1 END) as available_equipment,
    COUNT(CASE WHEN available = false THEN 1 END) as unavailable_equipment,
    (COUNT(CASE WHEN available = true THEN 1 END) * 100 / COUNT(*)) as availability_percentage
FROM equipments e
JOIN gym_membership m ON m.equipment_id = e.id;
In this example, we join the equipments table with a gym_membership table, which contains information about gym members and their equipment usage. We count the total number of gym members, the number of available equipment units, and the number of unavailable equipment units. We also calculate the percentage of available equipment units by dividing the number of available units by the total number of units and multiplying by 100.

Maintenance report:
vbnet
Copy code
SELECT 
    e.equipment_name, 
    e.purchase_date, 
    e.purchase_price,
    MAX(m.maintenance_date) as last_maintenance_date,
    COUNT(m.id) as total_maintenance_events,
    SUM(m.maintenance_cost) as total_maintenance_cost
FROM equipments e
LEFT JOIN equipment_maintenance m ON m.equipment_id = e.id
GROUP BY e.id;
In this example, we join the equipments table with an equipment_maintenance table, which contains information about equipment maintenance and repairs. We group the results by equipment and calculate the last maintenance date, the total number of maintenance events, and the total cost of maintenance for each piece of equipment.

Inventory report:
vbnet
Copy code
SELECT 
    equipment_name, 
    brand, 
    model, 
    purchase_date, 
    purchase_price, 
    COUNT(*) as total_units,
    COUNT(CASE WHEN available = true THEN 1 END) as available_units,
    COUNT(CASE WHEN available = false THEN 1 END) as unavailable_units
FROM equipments
GROUP BY equipment_name, brand, model, purchase_date, purchase_price;
In this example, we group the equipments table by equipment name, brand, model, purchase date, and purchase price. We count the total number of units, the number of available units, and the number of unavailable units for each piece of equipment. This provides a comprehensive inventory report that can be used to track equipment usage and availability.




Joshua Manasseh
create an equipment_maintenance table
Sure, here's an example of an equipment_maintenance table for the gym management system using SQL:

sql
Copy code
CREATE TABLE equipment_maintenance (
    id INT PRIMARY KEY,
    equipment_id INT,
    maintenance_date DATE,
    maintenance_cost DECIMAL(10, 2),
    maintenance_description VARCHAR(255),
    FOREIGN KEY (equipment_id) REFERENCES equipments(id)
);
In this table, each row represents a single maintenance event performed on a piece of equipment. Here's a breakdown of the columns:

id: A unique identifier for each maintenance event row.
equipment_id: The ID of the equipment that the maintenance event pertains to. This is a foreign key that references the equipments table.
maintenance_date: The date that the maintenance event was performed (in the format of DATE data type).
maintenance_cost: The cost of the maintenance event (in decimal format with a scale of 2).
maintenance_description: A brief description of the maintenance event.
You can add more columns to the table as per your requirements. This is just a basic example to get you started.




Joshua Manasseh
how is maintenance date gotten here?
In the equipment_maintenance table definition that I provided, the maintenance_date column is defined as a DATE data type. When a new maintenance event is added to the table, the maintenance_date column would be populated with the date that the maintenance event occurred.

The exact method for entering the maintenance date into the table would depend on the implementation of the gym management system. It could be entered manually by an employee responsible for recording maintenance events, or it could be automatically populated by a system that tracks maintenance events using sensors or other monitoring devices.




Joshua Manasseh
what about in the available column in the equipment table? does it have to be manually entered also?
Yes, the available column in the equipments table would need to be manually updated to reflect the current availability status of each piece of equipment.

This could be done by an employee responsible for managing the gym's inventory and equipment usage, or it could be updated automatically by a system that tracks equipment usage using sensors or other monitoring devices.

For example, if a gym member checks out a piece of equipment, an employee could update the available column for that piece of equipment to false to indicate that it is currently in use. When the equipment is returned, the available column would be updated back to true.

Alternatively, if the gym has sensors installed on the equipment that can detect when it is being used, the available column could be automatically updated by the system to reflect whether the equipment is currently in use or not.




Joshua Manasseh
what are the most important details about a gym that a user needs to see first after logging in when accessing their user dashboard in a gym management system?
The most important details that a user might want to see after logging in to their dashboard in a gym management system would depend on the specific needs of the user and the features offered by the gym management system. However, here are some common details that might be useful to display:

Membership status: Users may want to see if their membership is current, and if there are any upcoming renewals or payments due.

Upcoming classes: Users may want to see a list of upcoming classes that they are registered for, along with the date, time, and location of each class.

Personal fitness data: Users may want to see a summary of their personal fitness data, such as their weight, body fat percentage, and workout history.

Account information: Users may want to see their account information, such as their contact details, billing information, and any account settings they have configured.

Rewards and loyalty points: Users may want to see their rewards points and any other loyalty program information that they are enrolled in.

News and updates: Users may want to see any gym news, updates, or announcements that are relevant to them.

By presenting this information in a clear and concise way, users can quickly get an overview of their gym membership and stay up-to-date with the latest gym news and events.




Joshua Manasseh
likewise, what are the most important things to see first for the admin accessing the dashboard for the first time?
When an admin accesses the dashboard for the first time, they would likely want to see an overview of the gym's current status and performance. Here are some important things that an admin might want to see:

Membership statistics: An overview of the number of current members, new sign-ups, renewals, and cancellations. This information can help admins understand how the gym is performing and identify trends over time.

Equipment usage: A breakdown of which pieces of equipment are being used most frequently, and which ones are being used less often. This information can help admins make informed decisions about equipment maintenance, repair, and replacement.

Revenue and expenses: An overview of the gym's revenue and expenses, broken down by category. This information can help admins understand the financial health of the gym and identify areas where costs can be reduced or revenue can be increased.

Employee performance: An overview of employee performance metrics, such as attendance, customer satisfaction ratings, and sales figures. This information can help admins identify high-performing employees and areas where additional training may be needed.

Customer feedback: An overview of customer feedback, such as reviews and ratings, complaints, and suggestions. This information can help admins understand how customers perceive the gym and identify areas where improvements can be made.

Tasks and to-dos: A list of tasks and to-dos for the admin to complete, such as scheduling employee training sessions, conducting equipment maintenance, or following up on customer complaints.

By presenting this information in a clear and concise way, admins can quickly get an overview of the gym's current status and identify areas where improvements can be made. This can help the gym run more efficiently and provide a better experience for customers.




Joshua Manasseh
What must a gym management system be able to do to be considered perfect?
There is no single "perfect" gym management system, as the needs and requirements of gyms and fitness centers can vary widely depending on factors such as size, location, target audience, and services offered. However, here are some key features and capabilities that a high-quality gym management system might include:

Membership management: The ability to manage and track memberships, including registration, renewals, and cancellations.

Class and schedule management: The ability to manage and schedule fitness classes, including registration, attendance tracking, and instructor management.

Equipment management: The ability to manage and track gym equipment, including maintenance schedules, usage tracking, and inventory management.

Payment processing: The ability to process payments for memberships, classes, and other services.

Reporting and analytics: The ability to generate reports and analytics on membership trends, revenue, expenses, and other key metrics.

Mobile access: The ability to access the gym management system from mobile devices, allowing for on-the-go management and communication with customers.

Marketing and customer engagement: The ability to engage with customers through email and social media marketing campaigns, customer feedback, and loyalty programs.

Integration with other systems: The ability to integrate with other systems and platforms, such as accounting software, CRM systems, and payment gateways.

Overall, a high-quality gym management system should be able to streamline operations, improve the customer experience, and help gym owners and managers make informed decisions based on data and analytics.




Joshua Manasseh
how can a gym management system track attendance?
A gym management system can track attendance in several ways, including:

Barcode or RFID scanning: Members can scan a barcode or RFID tag at the gym entrance or at the entrance of a specific class to track their attendance. This method is fast and efficient, and allows the gym management system to automatically track attendance data in real time.

Manual check-in: Gym staff can manually check in members as they arrive at the gym or at a specific class. This method requires more time and effort from staff, but can be useful in situations where barcode or RFID scanning is not possible.

Mobile check-in: Members can use their mobile devices to check in to the gym or a specific class using a mobile app. This method is convenient for members and can also provide additional marketing opportunities for the gym.

Biometric scanning: Members can scan their fingerprints or other biometric data to check in to the gym or a specific class. This method is secure and can prevent fraud or unauthorized use of memberships, but may require additional hardware or software.

Once attendance data is collected, the gym management system can use it to generate reports and analytics on member attendance trends, class popularity, and other key metrics. This information can help gym owners and managers make informed decisions about class scheduling, staffing, and other aspects of gym operations.










<?php
// Include database configuration
include('config.php');

// Define error array
$error = [];

// Check if form is submitted
if(isset($_POST['submit'])) {

    // Sanitize and validate user inputs
    $fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
    $lname = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $cpassword = filter_input(INPUT_POST, 'cpassword', FILTER_SANITIZE_STRING);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $plan_name = filter_input(INPUT_POST, 'plan', FILTER_SANITIZE_STRING);

    // Validate profile picture upload
    if(isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == UPLOAD_ERR_OK) {
        $profile_pic = file_get_contents($_FILES['profile_pic']['tmp_name']);
    } else {
        $error[] = "Please select a profile picture.";
    }

    // Validate password and confirm password match
    if($password !== $cpassword) {
        $error[] = "Passwords do not match.";
    }

	// Hash the password before storing it in the database
	$password_hashed = password_hash($password, PASSWORD_ARGON2ID);

	// Check for errors before inserting data into database
	if(empty($error)) {
		$query = "INSERT INTO registration (fname,lname,email,gender,password_hashed ,phone ,plan, status, profile_pic) VALUES (?, ?, ?, ?, ?, ?, ?, 1, ?)";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("sssssssb", $fname,$lname,$email,$gender,$password_hashed ,$phone ,$plan_name,$profile_pic);

		if(!$stmt->execute()) {
			$error[]="Error in executing query.";
			echo implode("<br>",$error); 
			exit();
		} else {
			header("Location: signin.php");
			exit();
		}
		
   }
}
?>







