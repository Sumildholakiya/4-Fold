# 🏨 4Fold - Hotel Management & Booking System

A modern, feature-rich hotel management and booking system built with **PHP**, **Bootstrap**, and **MySQL**. This application enables seamless room reservations, gallery management, and customer relationship management with a dedicated admin dashboard.

👤 Developer
Sumil Dholakiya

This project demonstrates practical data science skills including exploratory data analysis, data visualization, statistical analysis, and insights generation from real-world datasets.
---

## 📋 Table of Contents

- [Features](#features)
- [Tech Stack](#tech-stack)
- [Installation](#installation)
- [Database Setup](#database-setup)
- [Project Structure](#project-structure)
- [Usage](#usage)
- [Admin Credentials](#admin-credentials)
- [Key Functionalities](#key-functionalities)
- [Developer](#developer)

---

## ✨ Features

### 🎯 Core Features
- **User Registration & Authentication** - Secure login and registration system for customers
- **Room Booking System** - Browse and book available rooms with date selection
- **Admin Dashboard** - Comprehensive management panel for hotel operations
- **Gallery Management** - Upload and manage hotel images
- **Room Management** - Add, update, and manage room details
- **Booking Management** - View and track all customer bookings
- **User Management** - Manage customer accounts and profiles
- **Contact Form** - Customer inquiry system
- **Newsletter Subscription** - Email subscription feature

### 🛡️ Security Features
- Session-based authentication
- User role-based access control
- Protected admin panel
- Database prepared statements

### 📱 User Interface
- Responsive Bootstrap design
- Mobile-friendly layout
- Interactive carousel banners
- Clean and intuitive navigation
- Professional styling

---

## 🛠️ Tech Stack

| Technology | Purpose |
|------------|---------|
| **PHP 8.2+** | Backend server logic |
| **MySQL/MariaDB** | Database management |
| **Bootstrap 5** | Frontend framework |
| **jQuery** | JavaScript interactions |
| **HTML5 & CSS3** | Markup and styling |
| **Chart.js** | Analytics visualization |
| **Owl Carousel** | Image carousel |

---

## 📥 Installation

### Prerequisites
- PHP 8.2 or higher
- MySQL/MariaDB 5.7 or higher
- Apache/Nginx web server
- Composer (optional, for dependency management)

### Step 1: Clone/Download the Project
```bash
# Clone the repository
git clone <repository-url>
cd php4fold

# Or extract the provided ZIP file
unzip php4fold.zip
cd php4fold
```

### Step 2: Configure Web Server
1. Copy the project folder to your web server directory:
   - **Apache**: `C:\xampp\htdocs\` or `/var/www/html/`
   - **Nginx**: `/var/www/html/`

2. Ensure proper permissions:
   ```bash
   chmod -R 755 php4fold
   chmod -R 777 admin/uploads/
   ```

### Step 3: Import Database
1. Open **phpMyAdmin** or your database management tool
2. Create a new database: `4folddb`
3. Import the database file:
   ```bash
   # Via command line
   mysql -u root -p 4folddb < 4folddb.sql
   ```
   Or import via phpMyAdmin GUI

### Step 4: Configure Database Connection
Edit database configuration files:

**File: `user/db.php`**
```php
<?php
$servername = "localhost";
$username = "root";
$password = ""; // Your MySQL password
$database = "4folddb";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
```

**File: `admin/db.php`** - Same configuration as above

### Step 5: Access the Application
- **User Portal**: `http://localhost/php4fold/user/index.php`
- **Login Page**: `http://localhost/php4fold/login.php`
- **Admin Panel**: `http://localhost/php4fold/admin/index.php`

---

## 🗄️ Database Setup

### Database Tables Overview

#### 1. **tbl_user**
Stores customer information and credentials
```
- user_id (Primary Key)
- user_name
- user_email (Unique)
- user_pass
- user_contact
- created_at
```

#### 2. **rooms**
Hotel room details
```
- id (Primary Key)
- room_number
- room_name
- description
- rent (nightly rate)
- status (Available/Booked)
- facilities
- image
- created_at
```

#### 3. **bookings**
Customer room reservations
```
- id (Primary Key)
- room_id (Foreign Key)
- room_number
- customer_name
- phone
- guests
- checkin_date
- checkout_date
- created_at
```

#### 4. **gallery**
Hotel gallery images
```
- id (Primary Key)
- image (filename)
- caption
- created_at
```

#### 5. **tbl_contactus**
Customer inquiry messages
```
- contact_id (Primary Key)
- user_name
- user_email
- user_contact
- message
```

#### 6. **tbl_newsettler**
Newsletter subscribers
```
- settler_id (Primary Key)
- settler_email (Unique)
- created_at
```

---

## 📁 Project Structure

```
php4fold/
├── 4folddb.sql                 # Database dump file
├── login.php                   # Login page
│
├── user/                       # User portal (Customer side)
│   ├── index.php              # Home/Dashboard
│   ├── about.php              # About page
│   ├── room.php               # Browse available rooms
│   ├── booking.php            # Booking management
│   ├── gallery.php            # Gallery view
│   ├── contact.php            # Contact form
│   ├── register.php           # User registration
│   ├── logout.php             # Logout
│   ├── header.php             # Navigation header
│   ├── footer.php             # Footer component
│   ├── db.php                 # Database connection
│   ├── contactform.php        # Form submission handler
│   ├── css/                   # User portal stylesheets
│   ├── js/                    # JavaScript files
│   ├── fonts/                 # Font files
│   └── images/                # Static images
│
├── admin/                      # Admin panel
│   ├── index.php              # Admin dashboard
│   ├── users.php              # User management
│   ├── booking.php            # Booking management
│   ├── roominsert.php         # Add new room
│   ├── roomupdate.php         # Edit room details
│   ├── galleryinsert.php      # Upload gallery images
│   ├── galleryupdate.php      # Edit gallery
│   ├── newUser.php            # Create new user
│   ├── header.php             # Admin header
│   ├── footer.php             # Admin footer
│   ├── query.php              # Database queries
│   ├── db.php                 # Database connection
│   ├── css/                   # Admin stylesheets
│   ├── js/                    # Admin JavaScript
│   ├── lib/                   # Third-party libraries (Charts, Carousels)
│   ├── uploads/               # Uploaded room & gallery images
│   └── img/                   # Admin panel images
│
└── README.md                   # Project documentation
```

---

## 🚀 Usage

### For Customers (User Portal)

1. **Register Account**
   - Visit login page
   - Click "Register" link
   - Fill in required details
   - Create account

2. **Browse Rooms**
   - Go to Room section
   - View available rooms
   - Check room details and facilities

3. **Make a Booking**
   - Select a room
   - Choose check-in and check-out dates
   - Enter number of guests
   - Confirm booking

4. **View Gallery**
   - Browse hotel images
   - View property highlights

5. **Contact Hotel**
   - Fill contact form with inquiries
   - Message will be saved in database

### For Admin Users

1. **Login to Admin Panel**
   - Use admin credentials (see below)
   - Access admin dashboard

2. **Manage Rooms**
   - Add new rooms
   - Update room details
   - Upload room images
   - Set room rates and availability

3. **Manage Bookings**
   - View all customer bookings
   - Track check-in/check-out dates
   - Manage reservations

4. **Manage Gallery**
   - Upload new images
   - Add captions
   - Update existing images

5. **Manage Users**
   - View registered customers
   - Create new user accounts
   - Manage user profiles

6. **View Dashboard**
   - Analytics and statistics
   - Booking trends
   - Revenue insights

---

## 🔐 Admin Credentials

**Default Admin Account:**
- **Email**: `admin@4fold.com`
- **Password**: `4fold`

⚠️ **Security Note**: Change these credentials after first login!

---

## 🎯 Key Functionalities

### Room Availability System
- Real-time room status tracking
- Date-based availability checking
- Automatic status updates on booking

### Booking Management
- Customer booking history
- Booking details tracking
- Guest count management
- Check-in/checkout scheduling

### Image Management
- Room image uploads
- Gallery image management
- Image organization
- Professional presentation

### User Management
- Customer profile management
- Account creation and deletion
- Contact information storage
- Newsletter subscription tracking

### Dashboard Analytics
- Total bookings count
- Revenue analytics
- Room occupancy rates
- Chart visualizations

---

## 📧 Email Configuration (Optional)

For contact form notifications, configure SMTP settings in your mail handler:

```php
// In contactform.php or similar
$mail = new PHPMailer();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->Username = 'your-email@gmail.com';
$mail->Password = 'your-app-password';
```

---

## 🔧 Common Issues & Solutions

### Issue: "Connection failed" error
**Solution**: Check database credentials in `db.php` files

### Issue: Images not uploading
**Solution**: Ensure `admin/uploads/` directory has write permissions (chmod 777)

### Issue: Session not working
**Solution**: Verify PHP session.save_path is writable

### Issue: Page not found (404)
**Solution**: Check .htaccess or URL rewriting settings

---

## 📸 Screenshots

### User Portal Features
- Beautiful home page with carousel
- Room browsing and details
- Booking management interface
- Gallery showcase
- Contact form

### Admin Dashboard
- Overview statistics
- Booking management grid
- Room management interface
- Gallery upload system
- User management panel

---

## 🔒 Security Recommendations

1. **Change Default Admin Credentials** - Update email and password immediately
2. **Use HTTPS** - Deploy on secure connection
3. **Input Validation** - Validate all user inputs
4. **SQL Injection Prevention** - Use prepared statements (already implemented)
5. **File Upload Security** - Validate file types and sizes
6. **Session Management** - Set proper session timeouts
7. **Password Hashing** - Implement bcrypt or similar for passwords

---

## 🚀 Future Enhancements

- [ ] Payment gateway integration (Stripe/PayPal)
- [ ] Email confirmations for bookings
- [ ] SMS notifications
- [ ] Discount and promotional codes
- [ ] User reviews and ratings
- [ ] Multi-language support
- [ ] Advanced search filters
- [ ] Booking cancellation system
- [ ] Invoice generation
- [ ] API for mobile apps

---

## 📝 License

This project is created for educational and commercial purposes. Feel free to customize and deploy as needed.

---

## 👤 Developer

**Sumil Dholakiya**

For questions, feedback, or support regarding this hotel management system, please feel free to reach out.

---

## 📞 Support

For technical assistance or feature requests:
- Check the project documentation
- Review database structure in `4folddb.sql`
- Examine code comments in key files
- Test with provided sample data

---

## 🎉 Thank You!

Thank you for using the 4Fold Hotel Management System. We hope it helps streamline your hotel operations and provides an excellent experience for both customers and administrators.

**Last Updated**: August 2025  
**Version**: 1.0  
**Created by**: Sumil Dholakiya

---

*For the best experience, keep the system updated and maintain regular database backups.*
