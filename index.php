<?php require 'header.php'; ?>

      <h1><?php echo $lang['form_main_title']; ?></h1>
      
      <p><?php echo $lang['form_main_subtitle']; ?></p>

      <form action="generate_resume.php" method="post" enctype="multipart/form-data">
        
        <?php
          $primary_lang_code = $current_lang;
          $secondary_lang_code = ($current_lang == 'en') ? 'ms' : 'en';
          $primary_lang_label = ($current_lang == 'en') ? $lang['english_section'] : $lang['malay_section'];
          $secondary_lang_label = ($current_lang == 'en') ? $lang['malay_section'] : $lang['english_section'];
        ?>

        <fieldset>
            <legend><?php echo $lang['options']; ?></legend>
            <div class="form-group">
                <label><?php echo $lang['template_selection']; ?>:</label>
                <div class="template-selector">
                    <div class="template-option">
                        <input type="radio" id="template_modern" name="template_choice" value="modern" checked>
                        <label for="template_modern" class="template-option-label">
                            <img src="template_modern_preview.png" alt="Modern Two-Column Layout">
                            <span><?php echo $lang['template_modern']; ?></span>
                        </label>
                    </div>
                    <div class="template-option">
                        <input type="radio" id="template_classic" name="template_choice" value="classic">
                        <label for="template_classic" class="template-option-label">
                            <img src="template_classic_preview.png" alt="Classic Single-Column Layout">
                            <span><?php echo $lang['template_classic']; ?></span>
                        </label>
                    </div>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label for="dual_language">
                    <input type="checkbox" id="dual_language" name="dual_language" value="1" style="width: auto; margin-right: 10px;">
                    <?php echo $lang['dual_language_label']; ?>
                </label>
                <p style="font-size: 12px; color: #666;"><?php echo $lang['dual_language_helper']; ?></p>
            </div>
        </fieldset>

        <fieldset>
          <legend><?php echo $lang['personal_details']; ?></legend>
          <div class="form-group">
            <label><?php echo $lang['profile_photo']; ?>:</label>
            <div class="photo-upload-area"><input type="file" id="profile_photo" name="profile_photo" accept="image/png, image/jpeg, image/jpg" onchange="previewPhoto()"/><img id="photo-preview" src="#" alt="Photo Preview"/></div>
          </div>
          
          <div class="form-group"><label for="full_name_<?php echo $primary_lang_code; ?>"><?php echo $lang['full_name']; ?>:</label><input type="text" id="full_name_<?php echo $primary_lang_code; ?>" name="full_name_<?php echo $primary_lang_code; ?>" placeholder="<?php echo $lang['placeholder_full_name']; ?>" required/></div>
          <div class="form-group dual-lang-field" style="display:none;"><label for="full_name_<?php echo $secondary_lang_code; ?>"><?php echo $lang['full_name']; ?> (<?php echo $secondary_lang_label; ?>):</label><input type="text" id="full_name_<?php echo $secondary_lang_code; ?>" name="full_name_<?php echo $secondary_lang_code; ?>" placeholder="<?php echo $lang['placeholder_full_name']; ?>"/></div>
          
          <div class="form-group"><label for="tagline_<?php echo $primary_lang_code; ?>"><?php echo $lang['professional_tagline']; ?>:</label><input type="text" id="tagline_<?php echo $primary_lang_code; ?>" name="tagline_<?php echo $primary_lang_code; ?>" placeholder="<?php echo $lang['placeholder_tagline']; ?>"/></div>
          <div class="form-group dual-lang-field" style="display:none;"><label for="tagline_<?php echo $secondary_lang_code; ?>"><?php echo $lang['professional_tagline']; ?> (<?php echo $secondary_lang_label; ?>):</label><input type="text" id="tagline_<?php echo $secondary_lang_code; ?>" name="tagline_<?php echo $secondary_lang_code; ?>" placeholder="<?php echo $lang['placeholder_tagline']; ?>"/></div>

          <div id="email-container"><div class="form-group"><label for="email_0">Email 1:</label><input type="email" id="email_0" name="emails[]" placeholder="<?php echo $lang['placeholder_email']; ?>" required/></div></div>
          <button type="button" class="add-btn" onclick="addEntry('email')"><?php echo $lang['add_email']; ?></button>
          
          <div class="form-group" style="margin-top:15px;"><label for="phone"><?php echo $lang['phone']; ?>:</label><input type="tel" id="phone" name="phone" placeholder="<?php echo $lang['placeholder_phone']; ?>"/></div>
          <div class="form-group"><label for="address"><?php echo $lang['physical_address']; ?>:</label><textarea id="address" name="address" rows="3" placeholder="<?php echo $lang['placeholder_address']; ?>"></textarea></div>
          <div class="form-group"><label for="github"><?php echo $lang['github_profile']; ?>:</label><input type="url" id="github" name="github" placeholder="<?php echo $lang['placeholder_github']; ?>"/></div>
        </fieldset>
        
        <fieldset>
            <legend><?php echo $lang['career_objective']; ?></legend>
            <div class="form-group"><label for="objective_<?php echo $primary_lang_code; ?>"><?php echo $lang['career_objective']; ?>:</label><textarea id="objective_<?php echo $primary_lang_code; ?>" name="objective_<?php echo $primary_lang_code; ?>" rows="3" placeholder="<?php echo $lang['placeholder_objective']; ?>"></textarea></div>
            <div class="form-group dual-lang-field" style="display:none;"><label for="objective_<?php echo $secondary_lang_code; ?>"><?php echo $lang['career_objective']; ?> (<?php echo $secondary_lang_label; ?>):</label><textarea id="objective_<?php echo $secondary_lang_code; ?>" name="objective_<?php echo $secondary_lang_code; ?>" placeholder="<?php echo $lang['placeholder_objective']; ?>"></textarea></div>
        </fieldset>
        <fieldset>
          <legend><?php echo $lang['professional_summary']; ?></legend>
          <div class="form-group"><label for="summary_<?php echo $primary_lang_code; ?>"><?php echo $lang['professional_summary']; ?>:</label><textarea id="summary_<?php echo $primary_lang_code; ?>" name="summary_<?php echo $primary_lang_code; ?>" rows="4" placeholder="<?php echo $lang['placeholder_summary']; ?>"></textarea></div>
          <div class="form-group dual-lang-field" style="display:none;"><label for="summary_<?php echo $secondary_lang_code; ?>"><?php echo $lang['professional_summary']; ?> (<?php echo $secondary_lang_label; ?>):</label><textarea id="summary_<?php echo $secondary_lang_code; ?>" name="summary_<?php echo $secondary_lang_code; ?>" placeholder="<?php echo $lang['placeholder_summary']; ?>"></textarea></div>
        </fieldset>

        <fieldset>
          <legend class="section-legend"><span><?php echo $lang['employment_history']; ?></span><button type="button" class="add-btn" onclick="addEntry('experience')"><?php echo $lang['add_button']; ?></button></legend>
          <div id="experience-container"></div>
        </fieldset>

        <fieldset>
          <legend class="section-legend"><span><?php echo $lang['projects']; ?></span><button type="button" class="add-btn" onclick="addEntry('project')"><?php echo $lang['add_button']; ?></button></legend>
          <div id="project-container"></div>
        </fieldset>

        <fieldset>
          <legend class="section-legend"><span><?php echo $lang['education']; ?></span><button type="button" class="add-btn" onclick="addEntry('education')"><?php echo $lang['add_button']; ?></button></legend>
          <div id="education-container"></div>
        </fieldset>

        <fieldset>
            <legend><?php echo $lang['secondary_education']; ?></legend>
            <div class="form-group"><label for="school_name_<?php echo $primary_lang_code; ?>"><?php echo $lang['school_name']; ?>:</label><input type="text" id="school_name_<?php echo $primary_lang_code; ?>" name="secondary_education[school_name_<?php echo $primary_lang_code; ?>]" placeholder="<?php echo $lang['placeholder_school_name']; ?>"/></div>
            <div class="form-group dual-lang-field" style="display:none;"><label for="school_name_<?php echo $secondary_lang_code; ?>"><?php echo $lang['school_name']; ?> (<?php echo $secondary_lang_label; ?>):</label><input type="text" id="school_name_<?php echo $secondary_lang_code; ?>" name="secondary_education[school_name_<?php echo $secondary_lang_code; ?>]" placeholder="<?php echo $lang['placeholder_school_name']; ?>"/></div>
            <div class="form-group"><label><?php echo $lang['graduation_year']; ?>:</label><input type="text" name="secondary_education[year]" placeholder="<?php echo $lang['placeholder_graduation_year']; ?>"/></div>
            <div class="form-group"><label for="sec_achievements_<?php echo $primary_lang_code; ?>"><?php echo $lang['key_achievements_grades']; ?>:</label><textarea id="sec_achievements_<?php echo $primary_lang_code; ?>" name="secondary_education[achievements_<?php echo $primary_lang_code; ?>]" rows="3" placeholder="<?php echo $lang['placeholder_key_achievements']; ?>"></textarea></div>
            <div class="form-group dual-lang-field" style="display:none;"><label for="sec_achievements_<?php echo $secondary_lang_code; ?>"><?php echo $lang['key_achievements_grades']; ?> (<?php echo $secondary_lang_label; ?>):</label><textarea id="sec_achievements_<?php echo $secondary_lang_code; ?>" name="secondary_education[achievements_<?php echo $secondary_lang_code; ?>]" placeholder="<?php echo $lang['placeholder_key_achievements']; ?>"></textarea></div>
        </fieldset>
        
        <fieldset>
          <legend class="section-legend"><span><?php echo $lang['languages']; ?></span><button type="button" class="add-btn" onclick="addEntry('language')"><?php echo $lang['add_button']; ?></button></legend>
          <div id="language-container"></div>
        </fieldset>

        <fieldset>
          <legend class="section-legend"><span><?php echo $lang['skills']; ?></span><button type="button" class="add-btn" onclick="addEntry('skill')"><?php echo $lang['add_button']; ?></button></legend>
          <div id="skill-container"></div>
        </fieldset>

        <fieldset>
          <legend class="section-legend"><span><?php echo $lang['references']; ?></span><button type="button" class="add-btn" onclick="addEntry('reference')"><?php echo $lang['add_button']; ?></button></legend>
          <div id="reference-container"></div>
        </fieldset>

        <button type="submit" name="submit"><?php echo $lang['generate_button']; ?></button>
      </form>

    <template id="email-template"><div class="form-group"><div style="display:flex;"><input type="email" name="emails[]" placeholder="<?php echo $lang['placeholder_email']; ?>"/><button type="button" class="remove-btn" onclick="removeEntry(this)" style="margin-left:10px;">×</button></div></div></template>
    <template id="experience-template">
      <div class="entry">
        <div class="entry-content">
          <div class="form-group"><label><?php echo $lang['job_type']; ?>:</label><select name="experience[][type]"><option value="Full-time"><?php echo $lang['job_type_full_time']; ?></option><option value="Part-time"><?php echo $lang['job_type_part_time']; ?></option><option value="Contract"><?php echo $lang['job_type_contract']; ?></option><option value="Internship" selected><?php echo $lang['job_type_internship']; ?></option><option value="Freelance"><?php echo $lang['job_type_freelance']; ?></option></select></div><hr>
          <strong class="dual-lang-label"><?php echo $primary_lang_label; ?></strong>
          <div class="form-group"><label><?php echo $lang['job_title']; ?>:</label><input type="text" name="experience[][job_title_<?php echo $primary_lang_code; ?>]" placeholder="<?php echo $lang['placeholder_job_title']; ?>"/></div>
          <div class="form-group"><label><?php echo $lang['job_grade']; ?>:</label><input type="text" name="experience[][job_grade_<?php echo $primary_lang_code; ?>]" placeholder="<?php echo $lang['placeholder_job_grade']; ?>"/></div>
          <div class="form-group"><label><?php echo $lang['company']; ?>:</label><input type="text" name="experience[][company_<?php echo $primary_lang_code; ?>]" placeholder="<?php echo $lang['placeholder_company']; ?>"/></div>
          <div class="form-group"><label><?php echo $lang['description']; ?>:</label><textarea name="experience[][description_<?php echo $primary_lang_code; ?>]" rows="3" placeholder="<?php echo $lang['placeholder_description']; ?>"></textarea></div>
          <div class="dual-lang-field" style="display:none;"><hr><strong class="dual-lang-label"><?php echo $secondary_lang_label; ?></strong>
            <div class="form-group"><label><?php echo $lang['job_title']; ?>:</label><input type="text" name="experience[][job_title_<?php echo $secondary_lang_code; ?>]" placeholder="<?php echo $lang['placeholder_job_title']; ?>"/></div>
            <div class="form-group"><label><?php echo $lang['job_grade']; ?>:</label><input type="text" name="experience[][job_grade_<?php echo $secondary_lang_code; ?>]" placeholder="<?php echo $lang['placeholder_job_grade']; ?>"/></div>
            <div class="form-group"><label><?php echo $lang['company']; ?>:</label><input type="text" name="experience[][company_<?php echo $secondary_lang_code; ?>]" placeholder="<?php echo $lang['placeholder_company']; ?>"/></div>
            <div class="form-group"><label><?php echo $lang['description']; ?>:</label><textarea name="experience[][description_<?php echo $secondary_lang_code; ?>]" rows="3" placeholder="<?php echo $lang['placeholder_description']; ?>"></textarea></div>
          </div><hr>
          <div class="form-group"><label><?php echo $lang['location']; ?>:</label><input type="text" name="experience[][location]" placeholder="<?php echo $lang['placeholder_location']; ?>"/></div>
          <div class="form-group"><label><?php echo $lang['years']; ?>:</label><input type="text" name="experience[][years]" placeholder="<?php echo $lang['placeholder_years']; ?>"/></div>
        </div>
        <div class="entry-controls"><button type="button" class="remove-btn" onclick="removeEntry(this)">×</button></div>
      </div>
    </template>
    <template id="project-template">
      <div class="entry">
        <div class="entry-content">
          <strong class="dual-lang-label"><?php echo $primary_lang_label; ?></strong>
          <div class="form-group"><label><?php echo $lang['project_title']; ?>:</label><input type="text" name="projects[][title_<?php echo $primary_lang_code; ?>]" placeholder="<?php echo $lang['placeholder_project_title']; ?>"/></div>
          <div class="form-group"><label><?php echo $lang['description']; ?>:</label><textarea name="projects[][description_<?php echo $primary_lang_code; ?>]" rows="3" placeholder="<?php echo $lang['placeholder_description']; ?>"></textarea></div>
           <div class="dual-lang-field" style="display:none;"><hr><strong class="dual-lang-label"><?php echo $secondary_lang_label; ?></strong>
            <div class="form-group"><label><?php echo $lang['project_title']; ?>:</label><input type="text" name="projects[][title_<?php echo $secondary_lang_code; ?>]" placeholder="<?php echo $lang['placeholder_project_title']; ?>"/></div>
            <div class="form-group"><label><?php echo $lang['description']; ?>:</label><textarea name="projects[][description_<?php echo $secondary_lang_code; ?>]" rows="3" placeholder="<?php echo $lang['placeholder_description']; ?>"></textarea></div>
          </div><hr>
          <div class="form-group"><label><?php echo $lang['project_year']; ?>:</label><input type="text" name="projects[][year]" placeholder="<?php echo $lang['placeholder_project_year']; ?>"/></div>
        </div>
        <div class="entry-controls"><button type="button" class="remove-btn" onclick="removeEntry(this)">×</button></div>
      </div>
    </template>
    <template id="education-template">
      <div class="entry">
        <div class="entry-content">
          <strong class="dual-lang-label"><?php echo $primary_lang_label; ?></strong>
          <div class="form-group"><label><?php echo $lang['degree_certificate']; ?>:</label><input type="text" name="education[][degree_<?php echo $primary_lang_code; ?>]" placeholder="<?php echo $lang['placeholder_degree']; ?>"/></div>
          <div class="form-group"><label><?php echo $lang['institution']; ?>:</label><input type="text" name="education[][institution_<?php echo $primary_lang_code; ?>]" placeholder="<?php echo $lang['placeholder_institution']; ?>"/></div>
          <div class="form-group"><label><?php echo $lang['education_description']; ?>:</label><textarea name="education[][description_<?php echo $primary_lang_code; ?>]" rows="3" placeholder="<?php echo $lang['placeholder_education_description']; ?>"></textarea></div>
          <div class="dual-lang-field" style="display:none;"><hr><strong class="dual-lang-label"><?php echo $secondary_lang_label; ?></strong>
            <div class="form-group"><label><?php echo $lang['degree_certificate']; ?>:</label><input type="text" name="education[][degree_<?php echo $secondary_lang_code; ?>]" placeholder="<?php echo $lang['placeholder_degree']; ?>"/></div>
            <div class="form-group"><label><?php echo $lang['institution']; ?>:</label><input type="text" name="education[][institution_<?php echo $secondary_lang_code; ?>]" placeholder="<?php echo $lang['placeholder_institution']; ?>"/></div>
            <div class="form-group"><label><?php echo $lang['education_description']; ?>:</label><textarea name="education[][description_<?php echo $secondary_lang_code; ?>]" rows="3" placeholder="<?php echo $lang['placeholder_education_description']; ?>"></textarea></div>
          </div><hr>
          <div class="form-group"><label><?php echo $lang['location']; ?>:</label><input type="text" name="education[][location]" placeholder="<?php echo $lang['placeholder_location']; ?>"/></div>
          <div class="form-group"><label><?php echo $lang['years']; ?>:</label><input type="text" name="education[][years]" placeholder="<?php echo $lang['placeholder_education_years']; ?>"/></div>
          <div class="form-group"><label><?php echo $lang['cgpa']; ?>:</label><input type="text" name="education[][cgpa]" placeholder="<?php echo $lang['placeholder_cgpa']; ?>"/></div>
        </div>
        <div class="entry-controls"><button type="button" class="remove-btn" onclick="removeEntry(this)">×</button></div>
      </div>
    </template>
    <template id="language-template">
      <div class="entry">
        <div class="entry-content">
            <div class="form-group"><label><?php echo $lang['language_name']; ?>:</label><input type="text" name="languages[][name]" placeholder="<?php echo $lang['placeholder_language_name']; ?>"/></div>
            <div class="form-group"><label><?php echo $lang['language_proficiency']; ?>:</label><input type="text" name="languages[][proficiency]" placeholder="<?php echo $lang['placeholder_language_proficiency']; ?>"/></div>
        </div>
        <div class="entry-controls"><button type="button" class="remove-btn" onclick="removeEntry(this)">×</button></div>
      </div>
    </template>
    <template id="skill-template">
      <div class="entry">
        <div class="entry-content">
            <div class="form-group"><label><?php echo $lang['skill_name']; ?>:</label><input type="text" name="skills[][name]" placeholder="<?php echo $lang['placeholder_skill_name']; ?>"/></div>
            <div class="form-group">
                <label><?php echo $lang['proficiency_level']; ?>:</label>
                <select name="skills[][level]" style="width: 100%; padding: 8px;">
                    <option value="Novice"><?php echo $lang['level_novice']; ?></option>
                    <option value="Intermediate" selected><?php echo $lang['level_intermediate']; ?></option>
                    <option value="Advanced"><?php echo $lang['level_advanced']; ?></option>
                    <option value="Expert"><?php echo $lang['level_expert']; ?></option>
                </select>
            </div>
        </div>
        <div class="entry-controls"><button type="button" class="remove-btn" onclick="removeEntry(this)">×</button></div>
      </div>
    </template>
    <template id="reference-template">
      <div class="entry">
        <div class="entry-content">
          <div class="form-group"><label><?php echo $lang['reference_full_name']; ?>:</label><input type="text" name="references[][name]" placeholder="<?php echo $lang['placeholder_ref_name']; ?>"/></div>
          <div class="form-group"><label><?php echo $lang['reference_relation_title']; ?>:</label><input type="text" name="references[][relation]" placeholder="<?php echo $lang['placeholder_ref_relation']; ?>"/></div>
          <div class="form-group"><label><?php echo $lang['reference_contact']; ?>:</label><input type="text" name="references[][contact]" placeholder="<?php echo $lang['placeholder_ref_contact']; ?>"/></div>
        </div>
        <div class="entry-controls"><button type="button" class="remove-btn" onclick="removeEntry(this)">×</button></div>
      </div>
    </template>

<?php require 'footer.php'; ?>