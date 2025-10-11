# 🌟 Laravel Application Form Project

This is a **Laravel 10** project built as part of a technical assessment for *The Lighthouse Centre*.  
It allows users to **register, log in**, and **submit an application form** via AJAX — including file uploads and email notifications with PDF attachments.

---

## 🚀 Features

✅ User registration and authentication  
✅ AJAX-based application form submission  
✅ Multiple file uploads (Images & PDFs only)  
✅ International phone input with country flags (using `intl-tel-input`)  
✅ Auto-generated PDF summary sent to the admin email  
✅ Responsive design using **Tailwind CSS**  
✅ Email includes uploaded files as attachments  

---

## 🛠️ Tech Stack

| Tool | Purpose |
|------|----------|
| **Laravel 10** | Backend framework |
| **Tailwind CSS** | Styling |
| **MySQL** | Database |
| **Axios / AJAX** | Asynchronous form submission |
| **intl-tel-input** | International phone input |
| **DomPDF** | PDF generation |
| **Mail Markdown** | Email templates |

---

## ⚙️ Installation & Setup Guide

Follow these steps to set up the project locally 👇

### 1️⃣ Clone the repository

```bash
git clone https://github.com/AhmedHelal909/application-form.git
cd laravel-application-form
```

### 2️⃣ Install dependencies

```bash
composer install
npm install
npm run build
```

### 3️⃣ Copy and configure environment file

```bash
cp .env.example .env
```

Then open the `.env` file and update your environment variables:

```env
APP_NAME="Lighthouse Form"
APP_URL=http://localhost:8000

DB_DATABASE=laravel_form
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

### 4️⃣ Generate the application key

```bash
php artisan key:generate
```

### 5️⃣ Run migrations

```bash
php artisan migrate
```

### 6️⃣ Serve the application

```bash
php artisan serve
```

Now open your browser at **http://localhost:8000** 🚀

---

## 📁 File Upload & Storage Setup

Make sure the storage is linked to the public folder:

```bash
php artisan storage:link
```

Uploaded files are stored in:  
`storage/app/public/uploads`

---

## 📧 Email Configuration

The application sends an email to the admin every time a new form is submitted.  
Each email includes:
- Applicant details
- Uploaded files as attachments
- Auto-generated PDF summary

---


## 🧩 Folder Structure

```
laravel-application-form/
├── app/
│   ├── Http/
│   ├── Mail/
│   ├── Models/
│   └── Pdf/
├── resources/
│   ├── views/
│   ├── css/
│   └── js/
├── public/
│   └── uploads/
└── routes/
    └── web.php
```

---

## 🧠 Troubleshooting

| Problem | Solution |
|----------|-----------|
| **500 error after clone** | Run `composer install && php artisan key:generate` |
| **Storage files not accessible** | Run `php artisan storage:link` |
| **Emails not sending** | Check SMTP credentials in `.env` |
| **PDF not generated** | Ensure `dompdf/dompdf` is installed via Composer |

---

## 🧑‍💻 Contributing

Contributions are welcome!  
Please fork the repository and submit a pull request.

---

## 💬 Contact

👤 **Developer:** Ahmed Helal  
📧 **Email:** your-email@example.com  
🌐 **GitHub:** [github.com/your-username](https://github.com/your-username)

---

⭐ If you found this project helpful, don't forget to **star** the repo!
