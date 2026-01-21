# Blinky – Delivery App Promo Landing Page

Blinky is a promotional landing page for a groceries delivery application, conceptually similar to platforms like Toters.
The project presents the app, its features, and partnership opportunities through a modern, responsive UI.

Currently, Blinky works **exclusively with food merchants**, with plans to expand into other categories such as groceries and additional services.

---

## 🌐 Live Concept & Inspiration

* [https://www.totersapp.com/](https://www.totersapp.com/)
* Base template: [https://themazine.com](https://themazine.com)

---

## 🛠 Tech Stack

### Frontend

* HTML5
* CSS3
* Bootstrap
* Vanilla JavaScript

### Backend

* PHP
* PHPMailer (for email handling)

### Build Tools

* None (no bundlers, no package managers)

---

## 📦 Repository

GitHub repository:
👉 [https://github.com/KawtharSafa/blinky](https://github.com/KawtharSafa/blinky)

---

## 📁 Project Structure (Simplified)

```
/
├── css/                 # Stylesheets
├── js/                  # Custom JavaScript
├── vendor/              # Third-party libraries (gitignored)
├── inc/
│   ├── phpconfig.php    # Local PHP config (gitignored)
│   └── .env.local       # Environment variables (gitignored)
├── index.html           # Main landing page
├── contact.html         # Contact page
└── README.md
```

---

## 🔒 Environment & Security

Sensitive and local-only files are excluded from version control:

* `/inc/.env.local`
* `/inc/config.php`
* `/vendor/`
* Local documents (e.g. `blinky.docx`)

See `.gitignore` for full details.

---

## 🚀 Getting Started

### 1️⃣ Clone the Repository

```bash
git clone https://github.com/KawtharSafa/blinky.git
cd blinky
```

---

### 2️⃣ Environment Setup

Create the following files locally (they are **not committed**):

#### `/inc/.env.local`

```env
MAIL_HOST=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_PORT=
MAIL_FROM=
MAIL_TO=
```

#### `/inc/phpconfig.php`

Configure PHP constants or settings required by your mail logic.

---

### 3️⃣ Vendor Libraries

* Ensure **PHPMailer** exists inside the `/vendor/` directory.
* Vendor files are ignored by Git and must be present locally or on the server.

---

### 4️⃣ Run the Project (Local)

You can run the project using **any PHP-capable server**.

#### Option A: PHP built-in server

```bash
php -S localhost:8000
```

Then open:

```
http://localhost:8000
```

#### Option B: Local server stack

* XAMPP
* WAMP
* MAMP
* Apache / Nginx

Place the project in the server root and access it via browser.

---

## 🧪 Build Process

There is **no build step**.

* No npm / yarn
* No bundlers
* No compilation

All assets are served directly.

---

## 📧 Email Functionality

* Contact forms use **PHP + PHPMailer**
* Credentials and mail configuration are stored securely in `.env.local`
* Designed for production deployment with server-side email handling

---

## 🌍 Browser & Device Support

* Fully responsive
* Works on desktop, tablet, and mobile
* Compatible with all modern browsers
* OS-agnostic (Windows, macOS, Linux)

---

## 🧑‍💻 Development

* IDE: **VS Code**
* Clean separation of structure, style, and scripts
* Optimized for marketing landing performance and clarity

---

## 🔮 Future Enhancements

* Additional merchant categories (groceries, services)
* UI/UX refinements
* Performance optimization
* SEO and analytics integration

---

## 📄 License

This project is proprietary and intended for promotional and business use for the **Blinky** platform.

---

