<?php
session_start();
// Load both language files to be ready for any scenario
require_once 'lang_en.php';
$lang_en = $lang;
require_once 'lang_ms.php';
$lang_ms = $lang;

/**
 * Reusable function to build the HTML for one language version of the resume.
 * This is the core engine for creating the visual resume content.
 */
function buildResumeHtml($data, $lang_file, $photo_path, $template_choice) {
    $photo_html = !empty($photo_path) ? '<img src="' . $photo_path . '" class="profile-photo">' : '';
    
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
        $html .= '<h1>' . htmlspecialchars($data['full_name']) . '</h1>
                  <p class="tagline">' . htmlspecialchars($data['tagline']) . '</p>
                  <div class="contact-info">
                      <span>' . implode(' | ', array_map('htmlspecialchars', $data['emails'])) . '</span> | 
                      <span>' . htmlspecialchars($data['phone']) . '</span> | 
                      <a href="' . htmlspecialchars($data['github']) . '">' . htmlspecialchars($data['github']) . '</a>
                      <p class="address">' . nl2br(htmlspecialchars($data['address'])) . '</p>
                  </div>';
    }
    $html .= '</div>';

    // --- Main Content Generation ---
    $main_content = '';
    $sidebar_content = '';

    if(!empty($data['objective'])) $main_content .= '<div class="section"><h2>'.$lang_file['pdf_objective'].'</h2><p>'.nl2br(htmlspecialchars($data['objective'])).'</p></div>';
    if(!empty($data['summary'])) $main_content .= '<div class="section"><h2>'.$lang_file['pdf_summary'].'</h2><p>'.nl2br(htmlspecialchars($data['summary'])).'</p></div>';

    if (!empty($data['experience'])) {
        $main_content .= '<div class="section"><h2>' . $lang_file['pdf_work_experience'] . '</h2>';
        foreach ($data['experience'] as $job) {
            if(!empty($job['job_title'])) {
                 $main_content .= '<div class="entry">
                            <div class="entry-header">
                                <span class="title">' . htmlspecialchars($job['job_title']) . '&nbsp;<em>(' . htmlspecialchars($job['type']) . ')</em></span>
                                <span class="period">' . htmlspecialchars($job['years']) . '</span>
                            </div>
                            <div class="entry-subheader">
                                <span class="company">' . htmlspecialchars($job['company']) . '</span>
                                <span class="location">' . htmlspecialchars($job['location']) . '</span>
                            </div>';
                if(!empty($job['job_grade'])) $main_content .= '<div class="job-grade">' . htmlspecialchars($job['job_grade']) . '</div>';
                $main_content .= '<div class="description">' . nl2br(htmlspecialchars($job['description'])) . '</div></div>';
            }
        }
        $main_content .= '</div>';
    }
    if (!empty($data['projects'])) {
        $main_content .= '<div class="section"><h2>' . $lang_file['pdf_projects'] . '</h2>';
        foreach ($data['projects'] as $project) {
            if(!empty($project['title'])) $main_content .= '<div class="entry"><div class="entry-header"><span class="title">' . htmlspecialchars($project['title']) . '</span><span class="period">' . htmlspecialchars($project['year']) . '</span></div><div class="description" style="margin-top: 5px;">' . nl2br(htmlspecialchars($project['description'])) . '</div></div>';
        }
        $main_content .= '</div>';
    }
    
    // Sidebar Content
    if (!empty($data['education'])) {
        $sidebar_content .= '<div class="section"><h2>' . $lang_file['pdf_education'] . '</h2>';
        foreach ($data['education'] as $edu) {
            if(!empty($edu['degree'])) $sidebar_content .= '<div class="entry"><div class="entry-header"><span class="title">' . htmlspecialchars($edu['degree']) . '</span><span class="years">' . htmlspecialchars($edu['years']) . '</span></div><div class="entry-subheader"><span class="institution">' . htmlspecialchars($edu['institution']) . '</span><span class="location">' . htmlspecialchars($edu['location']) . '</span></div><div class="cgpa">' . $lang_file['cgpa'] . ': ' . htmlspecialchars($edu['cgpa']) . '</div><div class="description">' . nl2br(htmlspecialchars($edu['description'])) . '</div></div>';
        }
        $sidebar_content .= '</div>';
    }
    if (!empty($data['secondary_education']['school_name'])) {
        $sec = $data['secondary_education'];
        $sidebar_content .= '<div class="section"><h2>' . $lang_file['pdf_secondary_education'] . '</h2>';
        $sidebar_content .= '<div class="entry"><div class="entry-header"><span class="title">' . htmlspecialchars($sec['school_name']) . '</span><span class="period">' . htmlspecialchars($sec['year']) . '</span></div><div class="description">' . nl2br(htmlspecialchars($sec['achievements'])) . '</div></div>';
        $sidebar_content .= '</div>';
    }
     if (!empty($data['languages'])) {
        $sidebar_content .= '<div class="section"><h2>' . $lang_file['pdf_languages'] . '</h2><ul class="languages-list">';
        foreach ($data['languages'] as $lang_item) {
             if(!empty($lang_item['name'])) $sidebar_content .= '<li class="lang-entry"><span class="lang-name">' . htmlspecialchars($lang_item['name']) . ':</span> ' . htmlspecialchars($lang_item['proficiency']) . '</li>';
        }
        $sidebar_content .= '</ul></div>';
    }
    if (!empty($data['skills'])) {
        $sidebar_content .= '<div class="section"><h2>' . $lang_file['pdf_skills'] . '</h2><ul class="skills-list">';
        foreach ($data['skills'] as $skill) {
             if(!empty($skill['name'])) $sidebar_content .= '<li class="skill-entry"><span class="skill-name">' . htmlspecialchars($skill['name']) . '</span> <span class="skill-level">(' . htmlspecialchars($skill['level']) . ')</span></li>';
        }
        $sidebar_content .= '</ul></div>';
    }
    if (!empty($data['references'])) {
        $sidebar_content .= '<div class="section"><h2>' . $lang_file['pdf_references'] . '</h2>';
        foreach ($data['references'] as $ref) {
            if(!empty($ref['name'])) $sidebar_content .= '<div class="entry reference"><div class="name">' . htmlspecialchars($ref['name']) . '</div><div class="relation">' . htmlspecialchars($ref['relation']) . '</div><div>' . htmlspecialchars($ref['contact']) . '</div></div>';
        }
        $sidebar_content .= '</div>';
    }
    
    // Assemble final layout based on template
    if ($template_choice === 'modern') {
        $html .= '<div class="content-wrapper"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr>
                    <td class="main-content-cell">' . $main_content . '</td>
                    <td class="sidebar-cell">' . $sidebar_content . '</td>
                  </tr></table></div>';
    } else { // Classic Template
        $html .= '<div class="content-wrapper">' . $main_content . $sidebar_content . '</div>';
    }
    
    return $html;
}

// --- MAIN SCRIPT LOGIC ---
if (isset($_POST['submit'])) {

    $dual_language_enabled = isset($_POST['dual_language']) && $_POST['dual_language'] == '1';
    $template_choice = $_POST['template_choice'] ?? 'modern';
    $data_en = [];
    $data_ms = [];
    
    // --- Data Structuring for EN and MS ---
    $shared_data_keys = ['emails', 'phone', 'address', 'github', 'languages', 'skills', 'references'];
    foreach ($shared_data_keys as $key) {
        $data_en[$key] = $data_ms[$key] = $_POST[$key] ?? [];
    }

    $translatable_keys = ['full_name', 'tagline', 'objective', 'summary'];
    foreach($translatable_keys as $key){
        $data_en[$key] = $_POST[$key.'_en'] ?? '';
        $data_ms[$key] = $_POST[$key.'_ms'] ?? '';
    }
    
    $dynamic_sections = ['experience', 'projects', 'education'];
    foreach ($dynamic_sections as $section) {
        if(isset($_POST[$section])) {
            foreach ($_POST[$section] as $index => $entry) {
                foreach($entry as $key => $value) {
                    if (substr($key, -3) === '_en') {
                        $data_en[$section][$index][substr($key, 0, -3)] = $value;
                    } elseif (substr($key, -3) === '_ms') {
                        $data_ms[$section][$index][substr($key, 0, -3)] = $value;
                    } else {
                        $data_en[$section][$index][$key] = $value;
                        $data_ms[$section][$index][$key] = $value;
                    }
                }
            }
        }
    }
    $data_en['secondary_education']['school_name'] = $_POST['secondary_education']['school_name_en'] ?? '';
    $data_ms['secondary_education']['school_name'] = $_POST['secondary_education']['school_name_ms'] ?? '';
    $data_en['secondary_education']['year'] = $data_ms['secondary_education']['year'] = $_POST['secondary_education']['year'] ?? '';
    $data_en['secondary_education']['achievements'] = $_POST['secondary_education']['achievements_en'] ?? '';
    $data_ms['secondary_education']['achievements'] = $_POST['secondary_education']['achievements_ms'] ?? '';

    // --- File Upload ---
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

    // --- HTML & PDF Generation ---
    $template_css_path = 'resume_template_' . $template_choice . '.css';
    if (!file_exists($template_css_path)) $template_css_path = 'resume_template_modern.css';
    $css = file_get_contents($template_css_path);
    
    $final_html = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Resume</title><style>' . $css . '</style></head><body>';

    if ($dual_language_enabled) {
        $final_html .= buildResumeHtml($data_en, $lang_en, $photo_path, $template_choice);
        $final_html .= '<div style="page-break-before: always;"></div>';
        $final_html .= buildResumeHtml($data_ms, $lang_ms, $photo_path, $template_choice);
    } else {
        $ui_lang_data = $_SESSION['lang'] === 'ms' ? $data_ms : $data_en;
        $ui_lang_file = $_SESSION['lang'] === 'ms' ? $lang_ms : $lang_en;
        $final_html .= buildResumeHtml($ui_lang_data, $ui_lang_file, $photo_path, $template_choice);
    }
    
    $final_html .= '</body></html>';

    // TCPDF Generation
    require_once('tcpdf/tcpdf.php');
    $pdf = new TCPDF('P', 'pt', 'A4', true, 'UTF-8', false);
    $pdf->SetCreator('Auto Resume Creator');
    $pdf->SetAuthor($data_en['full_name']);
    $pdf->SetTitle('Resume - ' . $data_en['full_name']);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetMargins(25, 25, 25, true);
    $pdf->SetAutoPageBreak(TRUE, 25);
    $pdf->AddPage();
    $pdf->writeHTML($final_html, true, false, true, false, '');
    $pdf->Output('Resume_' . str_replace(' ', '_', $data_en['full_name']) . '.pdf', 'I');

    if (!empty($photo_path)) unlink($photo_path);
    exit();
}
?>