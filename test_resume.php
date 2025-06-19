<?php
session_start();
require_once 'lang_en.php';
$lang_en = $lang;
require_once 'lang_ms.php';
$lang_ms = $lang;

// DUMMY DATA FOR ALL FEATURES
$dummy_photo_path = 'placeholder.jpg';
$data_en = [
    'full_name' => 'Jane Doe',
    'tagline' => 'Results-Oriented Software Engineer',
    'emails' => ['jane.doe@example.com', 'j.doe@work.com'],
    'phone' => '123-456-7890',
    'address' => '123 Main St, 50000 Kuala Lumpur, Malaysia',
    'github' => 'https://github.com/janedoe',
    'objective' => 'Seeking a challenging and rewarding role in a dynamic company where I can apply my skills in software development and contribute to innovative projects.',
    'summary' => 'A highly motivated software engineer with 5+ years of experience in full-stack web development, specializing in PHP and JavaScript frameworks. Proven ability to lead projects from concept to completion.',
    'experience' => [
        ['type' => 'Full-time', 'job_title' => 'Senior Developer', 'job_grade' => 'P4', 'company' => 'Tech Solutions Inc.', 'location' => 'Kuala Lumpur', 'years' => '2020 - Present', 'description' => 'Led development of key projects, mentored junior developers, and improved system performance by 20%.'],
        ['type' => 'Internship', 'job_title' => 'Developer Intern', 'job_grade' => '', 'company' => 'Innovate Corp', 'location' => 'Penang', 'years' => 'Summer 2019', 'description' => 'Assisted with software testing and bug fixing for a major client application.'],
    ],
    'projects' => [
        ['title' => 'Smart Waste Management System', 'year' => '2023', 'description' => 'Developed an IoT system using Arduino and a web dashboard to monitor waste levels in real-time.']
    ],
    'education' => [
        ['degree' => 'B.S. in Computer Science', 'institution' => 'University of Technology', 'location' => 'Kuala Lumpur', 'years' => '2016-2020', 'cgpa' => '3.88', 'description' => 'Final Year Project: Developed an AI-powered chatbot for customer service applications.']
    ],
    'secondary_education' => ['school_name' => 'National High School', 'year' => '2015', 'achievements' => '8A in SPM (including A+ in English and Modern Mathematics)'],
    'languages' => [
        ['name' => 'English', 'proficiency' => 'Native Speaker'],
        ['name' => 'Bahasa Melayu', 'proficiency' => 'Professional Working Proficiency'],
    ],
    'skills' => [
        ['name' => 'PHP / Laravel', 'level' => 'Expert'],
        ['name' => 'JavaScript / Vue.js', 'level' => 'Advanced'],
    ],
    'references' => [
        ['name' => 'Dr. Jane Smith', 'relation' => 'Academic Advisor, University of Technology', 'contact' => 'jane.smith@example.com']
    ]
];

// Reusable function to build the HTML for the test page.
function buildTestHtml($data, $lang_file, $photo_path, $template_choice)
{
    $photo_html = !empty($photo_path) && file_exists($photo_path) ? '<img src="' . $photo_path . '" class="profile-photo">' : '';

    // --- Header Generation ---
    $html = '<div class="header">';
    if ($template_choice === 'modern') {
        $html .= '<table class="pdf-header-table"><tr>
                    <td class="pdf-header-photo-cell">' . $photo_html . '</td>
                    <td class="pdf-header-info-cell">
                        <h1>' . htmlspecialchars($data['full_name']) . '</h1>
                        <p class="tagline">' . htmlspecialchars($data['tagline']) . '</p>
                    </td>
                </tr></table>
                 <div class="contact-info">
                    <span>' . implode(' | ', array_map('htmlspecialchars', $data['emails'])) . '</span><br>
                    <span>' . htmlspecialchars($data['phone']) . '</span> | <a href="' . htmlspecialchars($data['github']) . '">' . htmlspecialchars($data['github']) . '</a>
                    <p class="address">' . nl2br(htmlspecialchars($data['address'])) . '</p>
                </div>';
    } else { // Classic Template
        $html .= $photo_html ? '<div class="photo-wrapper">' . $photo_html . '</div>' : '';
        $html .= '<h1>' . htmlspecialchars($data['full_name']) . '</h1><p class="tagline">' . htmlspecialchars($data['tagline']) . '</p><div class="contact-info"><span>' . implode(' | ', array_map('htmlspecialchars', $data['emails'])) . '</span> | <span>' . htmlspecialchars($data['phone']) . '</span> | <a href="' . htmlspecialchars($data['github']) . '">' . htmlspecialchars($data['github']) . '</a><p class="address">' . nl2br(htmlspecialchars($data['address'])) . '</p></div>';
    }
    $html .= '</div>';

    // --- Main Content Generation ---
    $main_content = '';
    $sidebar_content = '';

    if (!empty($data['objective'])) $main_content .= '<div class="section"><h2>' . $lang_file['pdf_objective'] . '</h2><p>' . nl2br(htmlspecialchars($data['objective'])) . '</p></div>';
    if (!empty($data['summary'])) $main_content .= '<div class="section"><h2>' . $lang_file['pdf_summary'] . '</h2><p>' . nl2br(htmlspecialchars($data['summary'])) . '</p></div>';

    if (!empty($data['experience'])) {
        $main_content .= '<div class="section"><h2>' . $lang_file['pdf_work_experience'] . '</h2>';
        foreach ($data['experience'] as $job) {
            $main_content .= '<div class="entry"><div class="entry-header"><span class="title">' . htmlspecialchars($job['job_title']) . '&nbsp;<em>(' . htmlspecialchars($job['type']) . ')</em></span><span class="period">' . htmlspecialchars($job['years']) . '</span></div><div class="entry-subheader"><span class="company">' . htmlspecialchars($job['company']) . '</span><span class="location">' . htmlspecialchars($job['location']) . '</span></div>';
            if (!empty($job['job_grade'])) $main_content .= '<div class="job-grade">' . htmlspecialchars($job['job_grade']) . '</div>';
            $main_content .= '<div class="description">' . nl2br(htmlspecialchars($job['description'])) . '</div></div>';
        }
        $main_content .= '</div>';
    }
    if (!empty($data['projects'])) {
        $main_content .= '<div class="section"><h2>' . $lang_file['pdf_projects'] . '</h2>';
        foreach ($data['projects'] as $project) {
            $main_content .= '<div class="entry"><div class="entry-header"><span class="title">' . htmlspecialchars($project['title']) . '</span><span class="period">' . htmlspecialchars($project['year']) . '</span></div><div class="description" style="margin-top: 5px;">' . nl2br(htmlspecialchars($project['description'])) . '</div></div>';
        }
        $main_content .= '</div>';
    }

    $sidebar_content .= '<div class="section"><h2>' . $lang_file['pdf_education'] . '</h2>';
    foreach ($data['education'] as $edu) {
        $sidebar_content .= '<div class="entry"><div class="entry-header"><span class="title">' . htmlspecialchars($edu['degree']) . '</span><span class="years">' . htmlspecialchars($edu['years']) . '</span></div><div class="entry-subheader"><span class="institution">' . htmlspecialchars($edu['institution']) . '</span><span class="location">' . htmlspecialchars($edu['location']) . '</span></div><div class="cgpa">' . $lang_file['cgpa'] . ': ' . htmlspecialchars($edu['cgpa']) . '</div><div class="description">' . nl2br(htmlspecialchars($edu['description'])) . '</div></div>';
    }
    $sidebar_content .= '</div>';
    if (!empty($data['secondary_education']['school_name'])) {
        $sec = $data['secondary_education'];
        $sidebar_content .= '<div class="section"><h2>' . $lang_file['pdf_secondary_education'] . '</h2>';
        $sidebar_content .= '<div class="entry"><div class="entry-header"><span class="title">' . htmlspecialchars($sec['school_name']) . '</span><span class="period">' . htmlspecialchars($sec['year']) . '</span></div><div class="description">' . nl2br(htmlspecialchars($sec['achievements'])) . '</div></div>';
        $sidebar_content .= '</div>';
    }
    if (!empty($data['languages'])) {
        $sidebar_content .= '<div class="section"><h2>' . $lang_file['pdf_languages'] . '</h2><ul class="languages-list">';
        foreach ($data['languages'] as $lang_item) {
            $sidebar_content .= '<li class="lang-entry"><span class="lang-name">' . htmlspecialchars($lang_item['name']) . ':</span> ' . htmlspecialchars($lang_item['proficiency']) . '</li>';
        }
        $sidebar_content .= '</ul></div>';
    }
    if (!empty($data['skills'])) {
        $sidebar_content .= '<div class="section"><h2>' . $lang_file['pdf_skills'] . '</h2><ul class="skills-list">';
        foreach ($data['skills'] as $skill) {
            $sidebar_content .= '<li class="skill-entry"><span class="skill-name">' . htmlspecialchars($skill['name']) . '</span> <span class="skill-level">(' . htmlspecialchars($skill['level']) . ')</span></li>';
        }
        $sidebar_content .= '</ul></div>';
    }
    if (!empty($data['references'])) {
        $sidebar_content .= '<div class="section"><h2>' . $lang_file['pdf_references'] . '</h2>';
        foreach ($data['references'] as $ref) {
            $sidebar_content .= '<div class="entry reference"><div class="name">' . htmlspecialchars($ref['name']) . '</div><div class="relation">' . htmlspecialchars($ref['relation']) . '</div><div>' . htmlspecialchars($ref['contact']) . '</div></div>';
        }
        $sidebar_content .= '</div>';
    }

    // Assemble final layout based on template
    if ($template_choice === 'modern') {
        $html .= '<table width="100%" cellpadding="0" cellspacing="0" border="0"><tr>
                    <td width="68%" style="padding-right: 20px; vertical-align: top;">' . $main_content . '</td>
                    <td width="32%" style="padding-left: 20px; vertical-align: top; background-color: #f2f2f2;">' . $sidebar_content . '</td>
                  </tr></table>';
    } else { // Classic Template
        $html .= '<div class="main-content">' . $main_content . '</div><div class="sidebar">' . $sidebar_content . '</div>';
    }

    return $html;
}

// --- Page Generation ---
$template_choice = $_GET['template'] ?? 'modern';
$template_css_path = 'resume_template_' . $template_choice . '.css';

if (!file_exists($template_css_path)) {
    $template_css_path = 'resume_template_modern.css';
}
$css = file_get_contents($template_css_path);

// UPDATED: Added class="resume-body" to the body tag
$final_html = '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title>Resume Preview</title><style>' . $css . '</style></head><body class="resume-body">';
$final_html .= buildTestHtml($data_en, $lang_en, $dummy_photo_path, $template_choice); // Always preview in English
$final_html .= '</body></html>';

echo $final_html;
