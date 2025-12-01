# Online Bookstore — PHP (Portfolio Project)

A compact, self-contained PHP web app to add and list books in a simple UI. Ideal for demonstrating back-end form handling, server-side input sanitization, file logging, and basic front-end styling.

Key features
- Add books with a minimal form (title, author, genre, price).
- Automatically applies a 10% discount to Science Fiction books.
- Appends a readable, timestamped entry to `bookstore_log.txt` for each submission (includes timestamp, title, IP, user agent).
- Lightweight, single-file PHP project suitable for learning.

Tech stack
- PHP (plain, single-file example)
- Simple CSS for layout
- No database required (uses an in-memory array + server-side log)

Prerequisites
- Local web server with PHP support (AMPPS, XAMPP, WAMP, etc.)
- Write access to the project directory so PHP can create/append `bookstore_log.txt`.

Install & run (quick)
1. Copy the project folder into your local web server document root:
   - AMPPS (Windows): C:\Program Files\Ampps\www\online-bookstore-php
   - XAMPP (Windows): C:\xampp\htdocs\online-bookstore-php
2. Start your local server (Apache / PHP).
3. Open in browser:
   - http://localhost/online-bookstore-php/main.php

What to open
- main.php — primary application file. Submitting the form will append a log entry to `bookstore_log.txt` in the same directory.

Log file details
- File created/updated: bookstore_log.txt
- Example log line:
  [2025-11-19 19:32:10] IP: 192.168.0.10 | UA: Mozilla/5.0 | Added book: "Dune" (Science Fiction, 29.99)

Author / Contact
- Matheus Paternez, GitHub:https://github.com/MatheusPaternez.