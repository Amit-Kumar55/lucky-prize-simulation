Prerequisites
Before getting started, make sure you have the following installed on your system:

PHP (version 8.x or higher)
Composer (for PHP dependency management)
Laravel 10
MySQL or another relational database
Node.js and npm (for compiling frontend assets, optional)
Installation Steps
Follow these steps to set up the project on your local machine.

1. Clone the Repository
First, clone the repository to your local machine:

git clone https://github.com/your-repo/lucky-prize-simulation.git
cd lucky-prize-simulation

2. Install Dependencies
Install the PHP dependencies using Composer:
composer install
npm install

3. Set Up Environment File
Copy the .env.example file to create a new .env file:
cp .env.example .env

Edit the .env file to configure the database connection and other environment settings.

Example for MySQL:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lucky_prize
DB_USERNAME=root
DB_PASSWORD=

4. Generate the Application Key
Run the following command to generate a unique application key:
php artisan key:generate

5. Migrate the Database
Run the database migrations to set up the tables:
php artisan migrate

6. Run the Application
To start the application locally, run the Laravel development server:
php artisan serve
This will serve the application at http://127.0.0.1:8000.

7. Access the Application
Now you can access the application in your browser at:
http://127.0.0.1:8000

8. Create Prizes and Simulate the Draw
Add Prizes: You can add prizes with a name and probability using the "Add Prize" form.
Simulate Prizes: Enter the number of prizes to simulate and click "Simulate Prizes". The simulation will distribute prizes according to their probabilities, and you will see the actual rewards on the table.

9. Charts and Reports
The application provides two charts:

Probability vs Actual Rewards Chart: Displays the probabilities vs. actual rewards awarded for each prize.

Application Structure
Controllers: SimulationController handles prize simulation logic.
Models: Prize model defines the prize structure and database interactions.
Views: Blade files for rendering the user interface:
simulate.blade.php - Main view for adding prizes and simulating rewards.
edit.blade.php - Edit page for modifying prize details.
Database: The prizes table stores the prize details with columns such as name, probability, and awarded.

Additional Features
Add/Edit/Delete Prizes: Admins can add, edit, and delete prizes.
Prize Simulation: Prizes are awarded based on their configured probabilities.
Prize Reporting: View the actual rewards awarded and see how it compares to the configured probabilities using charts.

Troubleshooting
If you encounter any issues, try the following:

Database Connection: Make sure your .env file is correctly configured for the database connection.
Permissions: Ensure that your storage and bootstrap/cache directories have the proper permissions.
