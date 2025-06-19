<?php
session_start();
$current_lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';
require_once 'lang_' . $current_lang . '.php';

// DUMMY DATA
$dummy_photo_path = 'placeholder.jpg';
$full_name = ($current_lang == 'en') ? 'Jane Doe' : 'Siti Suraya';
$tagline = $lang['placeholder_tagline'];
$email = 'jane.doe@example.com';
$phone = '123-456-7890';
$address = $lang['placeholder_address'];
$github = 'https://github.com/janedoe';
$summary = $lang['placeholder_summary'];
$experience = [
    ['job_title' => $lang['placeholder_job_title'], 'company' => 'Tech Solutions Inc.', 'location' => $lang['placeholder_location'], 'years' => '2020 - Present', 'description' => $lang['placeholder_description']],
];
$internships = [
    ['title' => $lang['placeholder_internship_title'], 'company' => 'Innovate Corp', 'location' => $lang['placeholder_location'], 'period' => 'Summer 2019', 'description' => $lang['placeholder_description']],
];
$projects = [
    ['title' => $lang['placeholder_project_title'], 'year' => '2023', 'description' => $lang['placeholder_description']],
];
$education = [
    ['degree' => $lang['placeholder_degree'], 'institution' => $lang['placeholder_institution'], 'location' => $lang['placeholder_location'], 'years' => '2016 - 2020', 'cgpa' => '3.88', 'description' => $lang['placeholder_education_description']],
];
$skills = explode(', ', $lang['placeholder_skills']);
$references = [
    ['name' => $lang['placeholder_ref_name'], 'relation' => $lang['placeholder_ref_relation'], 'contact' => $lang['placeholder_ref_contact']]
];

$css = file_get_contents('resume_template.css');

$photo_html = '';
if (file_exists($dummy_photo_path)) {
    $photo_html = '<img src="' . $dummy_photo_path . '" class="profile-photo">';
}

require 'lang_en.php';
$lang_en = $lang;
require 'lang_ms.php';
$lang_ms = $lang;

$html = '
    <!DOCTYPE html>
    <html lang="' . $current_lang . '"><head><meta charset="UTF-8"><title>Resume Preview</title><style>' . $css . '</style></head>
    <body style="padding: 25px;">
        <div class="header">
            <table class="pdf-header-table"><tr>
                <td class="pdf-header-photo-cell">' . $photo_html . '</td>
                <td class="pdf-header-info-cell">
                    <h1>' . htmlspecialchars($full_name) . '</h1>
                    <p class="tagline">' . htmlspecialchars($tagline) . '</p>
                    <div class="contact-info">
                        <span>' . htmlspecialchars($email) . '</span><span>' . htmlspecialchars($phone) . '</span>
                        <a href="' . htmlspecialchars($github) . '">' . htmlspecialchars($github) . '</a>
                        <p class="address">' . nl2br(htmlspecialchars($address)) . '</p>
                    </div>
                </td>
            </tr></table>
        </div>
        <table width="100%" cellpadding="0" cellspacing="0" border="0"><tr>
        <td width="68%" style="padding-right: 20px; vertical-align: top;">
        <div class="section"><h2>' . $lang_en['pdf_summary'] . ' / <span class="secondary-lang">' . $lang_ms['pdf_summary'] . '</span></h2><p>' . nl2br(htmlspecialchars($summary)) . '</p></div>';
if (!empty($experience)) {
    $html .= '<div class="section"><h2>' . $lang_en['pdf_work_experience'] . ' / <span class="secondary-lang">' . $lang_ms['pdf_work_experience'] . '</span></h2>';
    foreach ($experience as $job) {
        $html .= '<div class="entry"><div class="entry-header"><span class="title">' . htmlspecialchars($job['job_title']) . '</span><span class="period">' . htmlspecialchars($job['years']) . '</span></div><div class="entry-subheader"><span class="company">' . htmlspecialchars($job['company']) . '</span><span class="location">' . htmlspecialchars($job['location']) . '</span></div><div class="description">' . nl2br(htmlspecialchars($job['description'])) . '</div></div>';
    }
    $html .= '</div>';
}
if (!empty($internships)) {
    $html .= '<div class="section"><h2>' . $lang_en['pdf_internships'] . ' / <span class="secondary-lang">' . $lang_ms['pdf_internships'] . '</span></h2>';
    foreach ($internships as $intern) {
        $html .= '<div class="entry"><div class="entry-header"><span class="title">' . htmlspecialchars($intern['title']) . '</span><span class="period">' . htmlspecialchars($intern['period']) . '</span></div><div class="entry-subheader"><span class="company">' . htmlspecialchars($intern['company']) . '</span><span class="location">' . htmlspecialchars($intern['location']) . '</span></div><div class="description">' . nl2br(htmlspecialchars($intern['description'])) . '</div></div>';
    }
    $html .= '</div>';
}
if (!empty($projects)) {
    $html .= '<div class="section"><h2>' . $lang_en['pdf_projects'] . ' / <span class="secondary-lang">' . $lang_ms['pdf_projects'] . '</span></h2>';
    foreach ($projects as $project) {
        $html .= '<div class="entry"><div class="entry-header"><span class="title">' . htmlspecialchars($project['title']) . '</span><span class="period">' . htmlspecialchars($project['year']) . '</span></div><div class="description" style="margin-top: 5px;">' . nl2br(htmlspecialchars($project['description'])) . '</div></div>';
    }
    $html .= '</div>';
}
$html .= '</td><td width="32%" style="padding-left: 20px; padding-top: 25px; vertical-align: top; background-color: #f2f2f2;">';
if (!empty($education)) {
    $html .= '<div class="section"><h2>' . $lang_en['pdf_education'] . ' / <span class="secondary-lang">' . $lang_ms['pdf_education'] . '</span></h2>';
    foreach ($education as $edu) {
        $html .= '<div class="entry"><div class="entry-header"><span class="title">' . htmlspecialchars($edu['degree']) . '</span><span class="years">' . htmlspecialchars($edu['years']) . '</span></div><div class="entry-subheader"><span class="institution">' . htmlspecialchars($edu['institution']) . '</span><span class="location">' . htmlspecialchars($edu['location']) . '</span></div><div class="cgpa">' . $lang_en['cgpa'] . ': ' . htmlspecialchars($edu['cgpa']) . '</div><div class="description">' . nl2br(htmlspecialchars($edu['description'])) . '</div></div>';
    }
    $html .= '</div>';
}
if (!empty($skills)) {
    $html .= '<div class="section"><h2>' . $lang_en['skills'] . ' / <span class="secondary-lang">' . $lang_ms['skills'] . '</span></h2><ul class="skills-list">';
    foreach ($skills as $skill) {
        $html .= '<li>' . htmlspecialchars($skill) . '</li>';
    }
    $html .= '</ul></div>';
}
if (!empty($references)) {
    $html .= '<div class="section"><h2>' . $lang_en['references'] . ' / <span class="secondary-lang">' . $lang_ms['references'] . '</span></h2>';
    foreach ($references as $ref) {
        $html .= '<div class="entry reference"><div class="name">' . htmlspecialchars($ref['name']) . '</div><div class="relation">' . htmlspecialchars($ref['relation']) . '</div><div>' . htmlspecialchars($ref['contact']) . '</div></div>';
    }
    $html .= '</div>';
}
$html .= '</td></tr></table></body></html>';

echo $html;
