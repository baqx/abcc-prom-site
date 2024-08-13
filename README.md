# Prom Website

This is a Prom Website designed to offer a fun and engaging experience for students. The site includes features like image galleries, anonymous messaging, voting, and more. It's fully responsive, and optimized for both mobile and desktop devices.

## Table of Contents
- [Features](#features)
- [Technologies Used](#technologies-used)
- [Installation](#installation)
- [Usage](#usage)
- [Developer Information](#developer-information)

## Features

### 1. **Voting System**
   - Users can vote for nominees under various categories.
   - Categories are displayed with student names and placeholder images.
   - AJAX is used to prevent page reloading when voting.
   - Buttons are disabled after voting, showing a "voted" status.
   - Feedback is provided via a toast message.

### 2. **Anonymous Messaging**
   - Users can send anonymous messages publicly.
   - The form is AJAXified to show success or error toast messages without page reload.
   - A flood regulator prevents multiple submissions within 5 seconds.

### 3. **Image Upload**
   - Users can upload multiple images at once.
   - Images can be dragged and dropped onto the page.
   - PHP handles renaming files to avoid duplicates and restricts uploads to image files only.
   - Uploaded images are stored in a MySQL database along with captions.
   - A loading animation is shown during the upload process.
   - Users receive a push notification upon successful or failed uploads.

### 4. **Image Gallery**
   - Displays all uploaded images in a responsive grid format.
   - Clicking on an image opens a full-screen popup with the image, caption, and upload date.
   - Infinite scrolling is implemented with a shimmer effect while loading more images.
   - A floating action button allows quick access to the image upload form.

## Technologies Used
- **HTML5/CSS3**: For structuring and styling the web pages.
- **JavaScript (ES6+)**: For front-end functionality and AJAX.
- **PHP**: For server-side processing, file handling, and database interactions.
- **MySQL**: For storing images, captions, and voting data.
- **Font Awesome**: For icons.
## Installation
1. **Clone the repository**:
    ```bash
    git clone https://github.com/baqx/abcc-prom-site.git
    ```
2. **Navigate to the project directory**:
    ```bash
    cd abcc-prom-site
    ```
3. **Set up the database**:
   - Create a MySQL database and import the `abcc.sql` in the inc directory to create the required tables.

4. **Run the project**:
   - Place the project in your web server's root directory (e.g., `htdocs` for XAMPP).
   - Start your web server and access the site via `http://localhost/abcc-prom-site`.

## Usage
- **Voting**: Visit the voting page, select a category, and vote for your preferred nominee.
- **Anonymous Messaging**: Navigate to the messaging page, compose your message, and submit it anonymously.
- **Upload Images**: Go to the image upload page, drag and drop your images, add captions, and upload them.
- **View Gallery**: Browse the image gallery, click on any image to view it in full screen, and enjoy the animations.

## Developer Information
- **Name**: Adegbola AbdulBaqee
- **LinkedIn**: [linkedin.com/abdulbaqee](https://linkedin.com/abdulbaqee)
- **GitHub**: [github.com/baqx](https://github.com/baqx)
- **TikTok**: [tiktok.com/@iambaqx](https://tiktok.com/@iambaqx)

## License
This project is open-source and available under the [MIT License](LICENSE).

---

Happy Prom! 🎉
