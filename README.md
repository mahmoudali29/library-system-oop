# 📚 Library Management System

A simple **Library Management System** built with **PHP (OOP), MySQL, and Bootstrap**. This system allows **admins** to manage books and **members** to borrow books.

---

## **🚀 Features**
✅ User authentication (Admin & Member)  
✅ Admin can **add books**  
✅ Members can **borrow books**  
✅ Tracks borrowed books  
✅ Uses **Bootstrap** for a responsive UI  
✅ Secure database handling with **PDO & Transactions**  

---

## **🛠 Installation**
### **1️⃣ Clone the Repository**
```sh
git clone https://github.com/mahmoudali29/library-system-oop.git
cd library-system



2️⃣ Setup Database
CREATE DATABASE library_db;

3️⃣ Configure Database Connection
$host = "localhost";
$dbname = "library_db";
$username = "root";  // Change if needed
$password = "";      // Change if needed

4️⃣ Start Local Server
php -S localhost:8000

📜 Usage
🔹 Admin
Register as an Admin via register.php
Login and go to Admin Dashboard
Add books to the system
View the book list
🔹 Member
Register as a Member via register.php
Login and go to Member Dashboard
Borrow books from the available list
📂 Folder Structure
library-system/
│── actions/            # Backend processing (register, login, borrow)
│── classes/            # OOP classes (User, Admin, Library)
│── templates/          # Common UI templates (header, footer)
│── config.php          # Database connection
│── index.php           # Home page (book list)
│── register.php        # User registration
│── login.php           # User login
│── admin_dashboard.php # Admin panel
│── member_dashboard.php# Member panel
│── styles.css          # Custom styling
│── README.md           # Documentation
🛠 Technologies Used
🔹 PHP (OOP) - Backend logic
🔹 MySQL & PDO - Database management
🔹 Bootstrap 5 - Responsive UI
🔹 JavaScript (optional) - Form enhancements

🔗 Contributions
Contributions are welcome! Feel free to fork this repo, create a feature branch, and submit a pull request.
 
 
git checkout -b feature-new
git commit -m "Added new feature"
git push origin feature-new
📧 Contact
For any issues or questions, feel free to reach out.
🔗 GitHub: https://github.com/mahmoudali29

📌 Happy Coding! 🚀

 

---

### **🚀 Next Steps**
1. **Replace `YOUR_GITHUB_USERNAME`** with your actual GitHub username.  
2. **Add the `README.md` to your repo and push changes**:
   ```sh
   git add README.md
   git commit -m "Added README"
   git push origin main