# Sumba Tour Guide Portal

A comprehensive Laravel-based tour guide portal for Sumba, Indonesia, built with Filament for admin management and featuring mobile-first responsive design.

## Features

### For Tour Guides
- **Location Management**: Add and manage tourist locations with detailed information
- **Image Upload**: Upload and manage multiple images for each location
- **Edit Requests**: Suggest edits to existing locations with approval workflow
- **Dashboard**: Personal dashboard showing all submitted locations and their approval status

### For Administrators
- **Approval Workflow**: Review and approve location submissions, images, and edit requests
- **User Management**: Manage tour guide and admin accounts
- **Comprehensive Admin Panel**: Filament-powered interface for complete control

### For Clients/Visitors
- **Browse Locations**: Discover amazing places in Sumba with rich details
- **Interactive Map**: Explore locations on an interactive map with GPS coordinates
- **Mobile-First Design**: Fully responsive design optimized for mobile devices
- **Detailed Information**: View entry prices, best visiting times, suitable vehicles, and more

## Location Features

Each location includes:
- **GPS Coordinates**: Latitude and longitude for precise mapping
- **Descriptions**: Short (for listings) and long (detailed) descriptions
- **Entry Price**: Optional pricing information with currency
- **Best Time to Visit**: Recommended season/months of the year
- **Best Hours**: Optimal time of day to visit
- **Best Tide Level**: For coastal locations (low/high tide recommendations)
- **Suitable Vehicles**: Multiple options including bike, motorcycle, car, SUV, off-roader, bus, or walking
- **Multiple Images**: Photo gallery with approval system
- **Tour Guide Attribution**: Shows who recommended each location

## Technology Stack

- **Backend**: Laravel 12.x
- **Admin Panel**: Filament 4.x
- **Frontend**: Blade Templates with Tailwind CSS
- **Maps**: Leaflet.js (OpenStreetMap)
- **Database**: SQLite (easily configurable for MySQL/PostgreSQL)

## Installation

### Prerequisites
- PHP 8.3 or higher
- Composer
- Node.js & NPM

### Setup Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/hanidani1985/guideportal.git
   cd guideportal
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database setup**
   ```bash
   php artisan migrate --seed
   ```

5. **Build frontend assets**
   ```bash
   npm run build
   ```

6. **Create an admin user**
   ```bash
   php artisan make:filament-user
   ```

7. **Start the server**
   ```bash
   php artisan serve
   ```

8. **Access the application**
   - Public site: http://localhost:8000
   - Admin panel: http://localhost:8000/admin
   - Tour guide dashboard: http://localhost:8000/tourguide

## Usage

### Admin Panel
- Navigate to `/admin` and login
- Manage locations, images, and edit requests
- Approve or reject submissions

### Tour Guide Interface
- Login and access `/tourguide`
- Add new locations with detailed information
- Upload images for locations
- View approval status

### Client View
- Browse locations at home page
- View detailed location information
- Explore interactive map at `/map`

## License

MIT License
