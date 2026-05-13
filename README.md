# 🏛️ Barangay Management System

A modern, web-based management system designed to digitize Barangay operations, including resident records, financial ledgers, typhoon monitoring, and community event scheduling.

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Supabase](https://img.shields.io/badge/Supabase-3ECF8E?style=for-the-badge&logo=supabase&logoColor=white)

## 🌟 Key Features

- **📊 Financial Ledger:** Systematic recording of barangay funds and financial transactions.
- **📅 Community Calendar:** Professional event scheduling powered by FullCalendar v6.
- **🌪️ Real-time Typhoon Monitoring:** Live weather tracking using Leaflet maps and OpenWeather API.
- **📄 Document Requests:** Digital processing of Barangay Clearances, Certificates, and Permits.
- **👥 Resident & Household Management:** Organized digital records of all community members.
- **🌓 Dark Mode:** Fully responsive UI with seamless light and dark mode transitions.

## 🚀 Tech Stack

- **Backend:** PHP 8.2 (Laravel 11 framework)
- **Frontend:** Blade Templates, Tailwind CSS, Alpine.js
- **Database:** PostgreSQL (Hosted on Supabase)
- **External APIs:** OpenWeatherMap API (for typhoon tracking)
- **Tools:** FullCalendar (Scheduling), Leaflet.js (Mapping)

## 🛠️ Installation & Setup

Follow these steps to run the project locally:

1. **Clone the repository:**
   ```bash
   git clone [https://github.com/jayoun19/Barangay-Management-System.git](https://github.com/jayoun19/Barangay-Management-System.git)
   cd Barangay-Management-System

2. Install Backend Dependencies
composer install

3. Install Frontend Dependencies
npm install
npm run build

4. Setup Environment Variables
Copy .env.example to .env

Update DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, and DB_PASSWORD with your Supabase credentials.

Add your OPENWEATHER_API_KEY for the typhoon monitoring feature.

5. Generate Security Key & Migrate
php artisan key:generate
php artisan migrate

6. Run the Application
php artisan serve

Visit http://127.0.0.1:8000 in your browser.





