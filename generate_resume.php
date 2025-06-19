<?php
session_start();
// Load both language files to be ready for any scenario
require_once 'lang_en.php';
$lang_en = $lang;
require_once 'lang_ms.php';
$lang_ms = $lang;

// Determine the language for the UI messages (if any were needed)
$current_page_lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'en';
$lang = ($current_page_lang == 'en') ? $lang_en : $lang_ms;

// --- HELPER FUNCTIONS ---

/**
 * Translates text using a local LibreTranslate API.
 * Returns the original text if translation fails.
 */
function translate($text, $source, $target) {
    if (empty(trim($text))) {
        return '';
    }
    $url = 'http://localhost:5000/translate';
    $data = ['q' => $text, 'source' => $source, 'target' => $target, 'format' => 'text'];
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    $responseData = json_decode($response);
    return ($http_code == 200 && isset($responseData->translatedText)) ? $responseData->translatedText : $text;
}

/**
 * Reusable function to build the HTML for one language version of the resume.
 */
function buildResumeHtml($data, $lang_file, $photo_path) {
    $photo_html = !empty($photo_path) ? '<img src="' . $photo_path . '" class="profile-photo">' : '';
    
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
        foreach ($data['experience'] as $job) {
            if(!empty($job['job_title'])) $html .= '<div class="entry"><div class="entry-header"><span class="title">' . htmlspecialchars($job['job_title']) . '</span><span class="period">' . htmlspecialchars($job['years']) . '</span></div><div class="entry-subheader"><span class="company">' . htmlspecialchars($job['company']) . '</span><span class="location">' . htmlspecialchars($job['location']) . '</span></div><div class="description">' . nl2br(htmlspecialchars($job['description'])) . '</div></div>';
        }
        $html .= '</div>';
    }

    if (!empty($data['internships'][0]['title'])) {
        $html .= '<div class="section"><h2>' . $lang_file['pdf_internships'] . '</h2>';
        foreach ($data['internships'] as $intern) {
             if(!empty($intern['title'])) $html .= '<div class="entry"><div class="entry-header"><span class="title">' . htmlspecialchars($intern['title']) . '</span><span class="period">' . htmlspecialchars($intern['period']) . '</span></div><div class="entry-subheader"><span class="company">' . htmlspecialchars($intern['company']) . '</span><span class="location">' . htmlspecialchars($intern['location']) . '</span></div><div class="description">' . nl2br(htmlspecialchars($intern['description'])) . '</div></div>';
        }
        $html .= '</div>';
    }
    
    if (!empty($data['projects'][0]['title'])) {
        $html .= '<div class="section"><h2>' . $lang_file['pdf_projects'] . '</h2>';
        foreach ($data['projects'] as $project) {
            if(!empty($project['title'])) $html .= '<div class="entry"><div class="entry-header"><span class="title">' . htmlspecialchars($project['title']) . '</span><span class="period">' . htmlspecialchars($project['year']) . '</span></div><div class="description" style="margin-top: 5px;">' . nl2br(htmlspecialchars($project['description'])) . '</div></div>';
        }
        $html .= '</div>';
    }

    $html .= '</td><td width="32%" style="padding-left: 20px; padding-top: 25px; vertical-align: top; background-color: #f2f2f2;">';
    
    if (!empty($data['education'][0]['degree'])) {
        $html .= '<div class="section"><h2>' . $lang_file['pdf_education'] . '</h2>';
        foreach ($data['education'] as $edu) {
            if(!empty($edu['degree'])) $html .= '<div class="entry"><div class="entry-header"><span class="title">' . htmlspecialchars($edu['degree']) . '</span><span class="years">' . htmlspecialchars($edu['years']) . '</span></div><div class="entry-subheader"><span class="institution">' . htmlspecialchars($edu['institution']) . '</span><span class="location">' . htmlspecialchars($edu['location']) . '</span></div><div class="cgpa">' . $lang_file['cgpa'] . ': ' . htmlspecialchars($edu['cgpa']) . '</div><div class="description">' . nl2br(htmlspecialchars($edu['description'])) . '</div></div>';
        }
        $html .= '</div>';
    }
    
    if (!empty($data['skills_str'])) {
        $html .= '<div class="section"><h2>' . $lang_file['skills'] . '</h2><ul class="skills-list">';
        foreach ($data['skills'] as $skill) { $html .= '<li>' . htmlspecialchars($skill) . '</li>'; }
        $html .= '</ul></div>';
    }

    if (!empty($data['references'][0]['name'])) {
        $html .= '<div class="section"><h2>' . $lang_file['references'] . '</h2>';
        foreach ($data['references'] as $ref) {
            if(!empty($ref['name'])) $html .= '<div class="entry reference"><div class="name">' . htmlspecialchars($ref['name']) . '</div><div class="relation">' . htmlspecialchars($ref['relation']) . '</div><div>' . htmlspecialchars($ref['contact']) . '</div></div>';
        }
        $html .= '</div>';
    }

    $html .= '</td></tr></table>';
    return $html;
}

// --- MAIN SCRIPT LOGIC ---

if (isset($_POST['submit'])) {

    $auto_translate_enabled = isset($_POST['auto_translate']) && $_POST['auto_translate'] == '1';
    
    // Gather original data and sanitize it
    $original_data = [
        'full_name' => $_POST['full_name'] ?? '',
        'tagline' => $_POST['tagline'] ?? '',
        'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),
        'phone' => $_POST['phone'] ?? '',
        'address' => $_POST['address'] ?? '',
        'github' => filter_input(INPUT_POST, 'github', FILTER_SANITIZE_URL),
        'summary' => $_POST['summary'] ?? '',
        'experience' => $_POST['experience'] ?? [],
        'internships' => $_POST['internships'] ?? [],
        'projects' => $_POST['projects'] ?? [],
        'education' => $_POST['education'] ?? [],
        'skills_str' => $_POST['skills'] ?? '',
        'skills' => array_map('trim', explode(',', $_POST['skills'] ?? '')),
        'references' => $_POST['references'] ?? [],
    ];
    
    $photo_path = '';
    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] == 0) {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);
        $file_extension = pathinfo($_FILES['profile_photo']['name'], PATHINFO_EXTENSION);
        $unique_filename = uniqid('photo_', true) . '.' . $file_extension;
        $target_file = $upload_dir . $unique_filename;
        if (move_uploaded_file($_FILES['profile_photo']['tmp_name'], $target_file)) {
            $photo_path = $target_file;
        }
    }

    $css = file_get_contents('resume_template.css');
    $final_html = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Resume</title><style>' . $css . '</style></head><body>';

    if ($auto_translate_enabled) {
        $source_lang = $_POST['source_language'] ?? 'en';
        $target_lang = ($source_lang == 'en') ? 'ms' : 'en';

        $translated_data = $original_data; // Deep copy for translation

        // Translate all user-provided text fields
        $fields_to_translate_top_level = ['full_name', 'tagline', 'summary'];
        foreach ($fields_to_translate_top_level as $field) {
            $translated_data[$field] = translate($original_data[$field], $source_lang, $target_lang);
        }

        $dynamic_sections = [
            'experience' => ['job_title', 'company', 'location', 'description'],
            'internships' => ['title', 'company', 'location', 'description'],
            'projects' => ['title', 'description'],
            'education' => ['degree', 'institution', 'location', 'description'],
            'references' => ['name', 'relation']
        ];

        foreach($dynamic_sections as $section => $translatable_fields) {
            if(!empty($translated_data[$section])) {
                foreach($translated_data[$section] as $key => $entry) {
                    foreach($translatable_fields as $field_name) {
                        if(isset($entry[$field_name])) {
                             $translated_data[$section][$key][$field_name] = translate($entry[$field_name], $source_lang, $target_lang);
                        }
                    }
                }
            }
        }

        $first_data = ($source_lang == 'en') ? $original_data : $translated_data;
        $second_data = ($source_lang == 'en') ? $translated_data : $original_data;
        $first_lang_file = ($source_lang == 'en') ? $lang_en : $lang_ms;
        $second_lang_file = ($source_lang == 'en') ? $lang_ms : $lang_en;
        
        $final_html .= buildResumeHtml($first_data, $first_lang_file, $photo_path);
        $final_html .= '<div style="page-break-before: always;"></div>';
        $final_html .= buildResumeHtml($second_data, $second_lang_file, $photo_path);

    } else {
        $final_html .= buildResumeHtml($original_data, $lang, $photo_path);
    }
    
    $final_html .= '</body></html>';

    // GENERATE THE PDF
    require_once('tcpdf/tcpdf.php');
    $pdf = new TCPDF('P', 'pt', 'A4', true, 'UTF-8', false);
    $pdf->SetCreator('Auto Resume Creator');
    $pdf->SetAuthor($original_data['full_name']);
    $pdf->SetTitle('Resume - ' . $original_data['full_name']);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetMargins(25, 25, 25, true);
    $pdf->SetAutoPageBreak(TRUE, 25);
    $pdf->AddPage();
    $pdf->writeHTML($final_html, true, false, true, false, '');
    $pdf->Output('Resume_' . str_replace(' ', '_', $original_data['full_name']) . '.pdf', 'I');

    if (!empty($photo_path)) unlink($photo_path);

} else {
    header('Location: index.php');
    exit();
}
?>