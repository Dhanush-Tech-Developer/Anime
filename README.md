# Anime Database & Tracker

A full-stack PHP web application for browsing anime, managing genres, 
and tracking user profiles, with user authentication and a personal dashboard.

## Features
- User registration, login, and logout (session-based authentication)
- Personal dashboard after login
- Anime listing by genre
- News section for anime updates
- User profile management
- Edit functionality for content/profile data

## Tech Stack
- **Backend:** PHP
- **Frontend:** HTML, CSS, JavaScript
- **Database:** MySQL

## File Structure
- `index.html` — Landing page
- `login.php` / `register.php` / `logout.php` — Authentication
- `dashboard.php` — User dashboard after login
- `animelist.php` — Anime listing
- `genre.html` — Browse by genre
- `news.php` — Anime news section
- `profile.php` — User profile page
- `edit.php` — Edit profile/content
- `connect.php` — Database connection

## How to Run Locally
1. Clone this repo
```bash
   git clone https://github.com/Dhanush-Tech-Developer/Anime.git
```
2. Set up a local server (XAMPP/WAMP) and place the project in `htdocs`
3. Create a MySQL database and import the schema (add `database.sql` if you have one)
4. Update credentials in `connect.php`
5. Open `http://localhost/Anime` in your browser

## What I Learned
- Implementing session-based user authentication in PHP
- Structuring a multi-page app with login-gated content (dashboard, profile)
- Organizing content by category (genre-based listing)

## Author
Dhanush S — [LinkedIn](https://linkedin.com/in/dhanush-s-636356305)
