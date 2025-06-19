ResumeForge: The Auto Resume Creator

ResumeForge is a dynamic, multi-language web application designed to help users quickly create professional, well-formatted resumes. Users can input their personal details, work history, education, and more through a user-friendly form and generate a print-ready PDF on the fly.

The application features a clean, two-column resume template, supports both English and Bahasa Melayu, and includes an experimental, self-hosted automatic translation feature powered by LibreTranslate.
Features

    Dynamic Form Inputs: Easily add or remove multiple entries for work experience, internships, projects, education, and references.
    Multi-Language Support: Full user interface and final PDF output available in both English and Bahasa Melayu, controlled by a simple language switcher.
    Professional PDF Generation: Creates a clean, modern, two-column resume in PDF format using the powerful TCPDF library.
    Live Design Preview: A dedicated test page (test_resume.php) allows for instant visual review of the resume template with dummy data, separate from the main form.
    Comprehensive Data Entry: Supports a wide range of fields identified from professional resume samples, including:
        Profile Photo Upload
        Professional Tagline
        Physical Address & Contact Info
        Links to GitHub
        Work, Internship, and Project sections with locations and descriptions.
        Education section with CGPA, location, and detailed notes (e.g., for Final Year Projects).
    Experimental Auto-Translation: An optional feature to automatically translate user input between English and Bahasa Melayu using a self-hosted LibreTranslate instance, ensuring privacy and control. The final PDF can be generated with both languages displayed sequentially.
    Modular Codebase: Organized with separate files for header, footer, CSS, and JavaScript, following modern web development best practices.

Technology Stack

    Backend: PHP
    Frontend: HTML5, CSS3, JavaScript
    PDF Generation: TCPDF Library
    Translation Engine: LibreTranslate (Self-hosted via Docker)
    Local Server Environment: XAMPP (Apache)
    Containerization: Docker

Prerequisites

Before you begin, ensure you have the following software installed on your system:

    XAMPP (or any other local server environment with Apache and PHP)
    Docker Desktop

Local Setup and Installation

Follow these steps to get the application running on your local machine.

1. Clone the Repository
   Open your terminal or command prompt and clone the project repository.
   Bash

git clone <your-repository-url> resume-creator

2.  Place in htdocs
    Move the entire resume-creator folder into your XAMPP htdocs directory.

        On Windows, this is typically C:/xampp/htdocs/.
        On macOS, this is typically /Applications/XAMPP/htdocs/.

3.  Create the uploads Directory
    Inside the resume-creator folder, create a new folder named uploads. This is required for the profile photo upload feature to work.

4.  Start the LibreTranslate Server
    Make sure Docker Desktop is running. Then, in your terminal, run the following command to start the translation server. This optimized command only loads the languages we need.
    Bash

docker run -ti -p 5000:5000 libretranslate/libretranslate --load-only en,ms

Keep this terminal window open. To verify it's working, open a web browser and navigate to http://localhost:5000.

5. Start XAMPP
   Open the XAMPP Control Panel and start the Apache server.

6. Access the Application
   Open your web browser and navigate to:

http://localhost/resume-creator/

You should now see the ResumeForge web application interface.
How to Use

    Select Language: Use the EN | BM links in the header to switch the language of the user interface.
    Fill Out the Form: Enter your resume details. Use the + Add buttons to add multiple entries for experience, projects, etc.
    Preview the Design: Click the "Preview Design" link to see how the final resume template looks, populated with sample data in your selected language.
    (Optional) Use Auto-Translate:
        Check the "Automatically generate resume in dual-language" box.
        A dropdown will appear. Select the language that you have used to fill out the form (e.g., "English").
    Generate PDF: Click the "Generate Resume" button. The system will produce a professional PDF. If auto-translate was enabled, the PDF will contain the full resume in your source language, followed by the translated version.

Project Structure

/resume-creator
|
|-- 📁 /uploads/ # For temporary photo uploads
|-- 📁 /tcpdf/ # TCPDF library files
|
|-- 📄 index.php # Main form page (UI)
|-- 📄 header.php # Header content for the UI
|-- 📄 footer.php # Footer content for the UI
|
|-- 📄 generate_resume.php # Core script for PDF generation & translation
|-- 📄 test_resume.php # Page for previewing the resume template
|
|-- 📄 style.css # Styles for index.php (the form)
|-- 📄 script.js # JavaScript for dynamic form elements
|-- 📄 resume_template.css # Styles for the final PDF output
|
|-- 📄 lang_en.php # English language text
|-- 📄 lang_ms.php # Bahasa Melayu language text
|
|-- 📄 README.md # This file

Contributing

Contributions are welcome! If you have ideas for new features or improvements, please feel free to open an issue or submit a pull request.
License

This project is licensed under the MIT License.
