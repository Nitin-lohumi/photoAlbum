
# Photo Album Web Application
This is a simple photo album web application built using **PHP**,
 **HTML**, **CSS**, and **JavaScript**.
  It allows users to upload images and view them in a paginated gallery with 6 images per page — 3 on the left and 3 on the right.
---
## Features
- Upload images in real-time.
- Images are displayed in a 2-column layout.
- Pagination to navigate through multiple pages.
- Supports `.jpg`, `.jpeg`, and `.png` formats.
- Automatically maintains image orientation.
- Clean, responsive layout for both desktop and mobile.
- Shows newly uploaded images at the end of the album (not the first page).
- Prevents uploading unsupported file types or files over 4MB.
- Centers the full image in the container without cropping.

---

##  Project Structure

photo_album/
 index.php           # Main PHP file
 style.css           # CSS for styling layout and responsiveness
 script.js           # JavaScript file
 images/             # Folder to store uploaded images
 README.txt          # Project instructions


##  Requirements

To run this project locally, you need:
- A local server environment like:
  - **XAMPP** (Windows)
  - **MAMP** (Mac)
  - **LAMP** (Linux)
- PHP 7.x or above

##  How to Run Locally
1. **Download or clone the project folder.**
2. **Move the folder into your local server directory:**
   - For XAMPP: `htdocs/`
   - For MAMP: `htdocs/`
   - For LAMP: `/var/www/html/`

3. **Start your local server (Apache).**

4. **Access the project in your browser:**
   http://localhost/yourProjectName/index.php

## Uploading Images

- Use the upload form to select and submit an image.
- Uploaded images will appear at the **end of the album** (last page).
- Allowed formats: `.jpg`, `.jpeg`, `.png`
- Maximum file size: **4 MB**


##  Image Handling & Validation

- Files are renamed with unique IDs for safe storage.
- Uploaded images are validated for type and size before saving.
- Pagination ensures consistent layout with 6 images per page.


## 📬 Author

This project was created as a basic photo gallery system using PHP. You can modify or enhance it for personal or educational use.

Enjoy building!
