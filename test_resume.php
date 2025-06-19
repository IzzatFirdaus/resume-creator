<?php
session_start();
require_once 'lang_en.php';
$lang_en = $lang;
require_once 'lang_ms.php';
$lang_ms = $lang;
$current_lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';
$lang = ($current_lang == 'en') ? $lang_en : $lang_ms;

// --- DUMMY DATA ---
$dummy_photo_path = 'placeholder.jpg';
$data = [
    'full_name' => ($current_lang == 'en') ? 'Jane Doe' : 'Siti Suraya',
    'tagline' => $lang['placeholder_tagline'],
    'email' => 'jane.doe@example.com',
    'phone' => '123-456-7890',
    'address' => $lang['placeholder_address'],
    'github' => 'https://github.com/janedoe',
    'summary' => $lang['placeholder_summary'],
    'experience' => [
        ['job_title' => $lang['placeholder_job_title'], 'company' => 'Tech Solutions Inc.', 'location' => $lang['placeholder_location'], 'years' => '2020 - Present', 'description' => $lang['placeholder_description']],
    ],
    'internships' => [
        ['title' => $lang['placeholder_internship_title'], 'company' => 'Innovate Corp', 'location' => $lang['placeholder_location'], 'period' => 'Summer 2019', 'description' => $lang['placeholder_description']],
    ],
    'projects' => [
        ['title' => $lang['placeholder_project_title'], 'year' => '2023', 'description' => $lang['placeholder_description']],
    ],
    'education' => [
        ['degree' => $lang['placeholder_degree'], 'institution' => $lang['placeholder_institution'], 'location' => $lang['placeholder_location'], 'years' => '2016 - 2020', 'cgpa' => '3.88', 'description' => $lang['placeholder_education_description']],
    ],
    'skills_str' => $lang['placeholder_skills'],
    'skills' => explode(', ', $lang['placeholder_skills']),
    'references' => [
        ['name' => $lang['placeholder_ref_name'], 'relation' => $lang['placeholder_ref_relation'], 'contact' => $lang['placeholder_ref_contact']]
    ]
];

// Reusable function to build the HTML for the test page.
// This should exactly mirror the structure in generate_resume.php's buildResumeHtml function.
function buildTestHtml($data, $lang_file, $photo_path) {
    $photo_html = !empty($photo_path) && file_exists($photo_path) ? '<img src="' . $photo_path . '" class="profile-photo">' : '';
    $html = '<div class="header">
            <table class="pdf-header-table"><tr>
                <td class="pdf-header-photo-cell">' . $photo_html . '</td>
                <td class="pdf-header-info-cell">
                    <h1>' . htmlspecialchars($data['full_name']) . '</h1>
                    <p class="tagline">' . htmlspecialchars($data['tagline']) . '</p>
                    <div class="contact-info">
                        <span>' . htmlspecialchars($data['email']) . '</span><span>' . htmlspecialchars($data['phone']) . '</span>
                        <a href="' . htmlspecialchars($data['github']) . '">' . htmlspecialchars($data['github']) . '</a>
                        <p class="address">' . nl2br(htmlspecialchars($data['address'])) . '</p>
                    </div>
                </td>
            </tr></table>
        </div>
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr><td width="68%" style="padding-right: 20px; vertical-align: top;">
                <div class="section"><h2>' . $lang_file['pdf_summary'] . '</h2><p>' . nl2br(htmlspecialchars($data['summary'])) . '</p></div>';

    if (!empty($data['experience'][0]['job_title'])) {
        $html .= '<div class="section"><h2>' . $lang_file['pdf_work_experience'] . '</h2>';
        foreach ($data['experience'] as $job) {$html .= '<div class="entry"><div class="entry-header"><span class="title">' . htmlspecialchars($job['job_title']) . '</span><span class="period">' . htmlspecialchars($job['years']) . '</span></div><div class="entry-subheader"><span class="company">' . htmlspecialchars($job['company']) . '</span><span class="location">' . htmlspecialchars($job['location']) . '</span></div><div class="description">' . nl2br(htmlspecialchars($job['description'])) . '</div></div>';}
        $html .= '</div>';
    }
    if (!empty($data['internships'][0]['title'])) {
        $html .= '<div class="section"><h2>' . $lang_file['pdf_internships'] . '</h2>';
        foreach ($data['internships'] as $intern) {$html .= '<div class="entry"><div class="entry-header"><span class="title">' . htmlspecialchars($intern['title']) . '</span><span class="period">' . htmlspecialchars($intern['period']) . '</span></div><div class="entry-subheader"><span class="company">' . htmlspecialchars($intern['company']) . '</span><span class="location">' . htmlspecialchars($intern['location']) . '</span></div><div class="description">' . nl2br(htmlspecialchars($intern['description'])) . '</div></div>';}
        $html .= '</div>';
    }
    if (!empty($data['projects'][0]['title'])) {
        $html .= '<div class="section"><h2>' . $lang_file['pdf_projects'] . '</h2>';
        foreach ($data['projects'] as $project) {$html .= '<div class="entry"><div class="entry-header"><span class="title">' . htmlspecialchars($project['title']) . '</span><span class="period">' . htmlspecialchars($project['year']) . '</span></div><div class="description" style="margin-top: 5px;">' . nl2br(htmlspecialchars($project['description'])) . '</div></div>';}
        $html .= '</div>';
    }
    $html .= '</td><td width="32%" style="padding-left: 20px; padding-top: 25px; vertical-align: top; background-color: #f2f2f2;">';
    if (!empty($data['education'][0]['degree'])) {
        $html .= '<div class="section"><h2>' . $lang_file['pdf_education'] . '</h2>';
        foreach ($data['education'] as $edu) {$html .= '<div class="entry"><div class="entry-header"><span class="title">' . htmlspecialchars($edu['degree']) . '</span><span class="years">' . htmlspecialchars($edu['years']) . '</span></div><div class="entry-subheader"><span class="institution">' . htmlspecialchars($edu['institution']) . '</span><span class="location">' . htmlspecialchars($edu['location']) . '</span></div><div class="cgpa">' . $lang_file['cgpa'] . ': ' . htmlspecialchars($edu['cgpa']) . '</div><div class="description">' . nl2br(htmlspecialchars($edu['description'])) . '</div></div>';}
        $html .= '</div>';
    }
    if (!empty($data['skills_str'])) {
        $html .= '<div class="section"><h2>' . $lang_file['skills'] . '</h2><ul class="skills-list">';
        foreach ($data['skills'] as $skill) { $html .= '<li>' . htmlspecialchars($skill) . '</li>'; }
        $html .= '</ul></div>';
    }
    if (!empty($data['references'][0]['name'])) {
        $html .= '<div class="section"><h2>' . $lang_file['references'] . '</h2>';
        foreach ($data['references'] as $ref) {$html .= '<div class="entry reference"><div class="name">' . htmlspecialchars($ref['name']) . '</div><div class="relation">' . htmlspecialchars($ref['relation']) . '</div><div>' . htmlspecialchars($ref['contact']) . '</div></div>';}
        $html .= '</div>';
    }
    $html .= '</td></tr></table>';
    return $html;
}

$css = file_get_contents('resume_template.css');
$final_html = '<!DOCTYPE html><html lang="' . $current_lang . '"><head><meta charset="UTF-8"><title>Resume Preview</title><style>' . $css . '</style></head><body style="padding:25px">';
$final_html .= buildTestHtml($data, $lang, $dummy_photo_path);
$final_html .= '</body></html>';

echo $final_html;
?>