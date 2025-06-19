<?php require 'header.php'; ?>

      <h1><?php echo $lang['form_main_title']; ?></h1>
      
      <p><?php echo $lang['form_main_subtitle']; ?></p>

      <form action="generate_resume.php" method="post" enctype="multipart/form-data">
        
        <fieldset>
            <legend><?php echo $lang['options']; ?></legend>
            <div class="form-group">
                <label for="template_choice"><?php echo $lang['template_selection']; ?>:</label>
                <select name="template_choice" id="template_choice" style="width: 100%; padding: 8px;">
                    <option value="modern"><?php echo $lang['template_modern']; ?></option>
                    <option value="classic"><?php echo $lang['template_classic']; ?></option>
                </select>
            </div>
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
          <div class="form-group"><label for="profile_photo"><?php echo $lang['profile_photo']; ?>:</label><input type="file" id="profile_photo" name="profile_photo" accept="image/png, image/jpeg, image/jpg"/></div>
          
          <div class="form-group"><label for="full_name_en"><?php echo $lang['full_name']; ?> (EN):</label><input type="text" id="full_name_en" name="full_name_en" required/></div>
          <div class="form-group dual-lang-field" style="display:none;"><label for="full_name_ms"><?php echo $lang['full_name']; ?> (BM):</label><input type="text" id="full_name_ms" name="full_name_ms"/></div>
          
          <div class="form-group"><label for="tagline_en"><?php echo $lang['professional_tagline']; ?> (EN):</label><input type="text" id="tagline_en" name="tagline_en" placeholder="<?php echo $lang['placeholder_tagline']; ?>"/></div>
          <div class="form-group dual-lang-field" style="display:none;"><label for="tagline_ms"><?php echo $lang['professional_tagline']; ?> (BM):</label><input type="text" id="tagline_ms" name="tagline_ms"/></div>

          <div id="email-container">
            <div class="form-group"><label for="email_0">Email 1:</label><input type="email" id="email_0" name="emails[]" required/></div>
          </div>
          <button type="button" class="add-btn" onclick="addEntry('email')"><?php echo $lang['add_email']; ?></button>

          <div class="form-group" style="margin-top:15px;"><label for="phone"><?php echo $lang['phone']; ?>:</label><input type="tel" id="phone" name="phone"/></div>
          <div class="form-group"><label for="address"><?php echo $lang['physical_address']; ?>:</label><textarea id="address" name="address" rows="3"></textarea></div>
          <div class="form-group"><label for="github"><?php echo $lang['github_profile']; ?>:</label><input type="url" id="github" name="github"/></div>
        </fieldset>
        
        <fieldset>
            <legend><?php echo $lang['career_objective']; ?></legend>
            <div class="form-group"><label for="objective_en"><?php echo $lang['career_objective']; ?> (EN):</label><textarea id="objective_en" name="objective_en" rows="3" placeholder="<?php echo $lang['placeholder_objective']; ?>"></textarea></div>
            <div class="form-group dual-lang-field" style="display:none;"><label for="objective_ms"><?php echo $lang['career_objective']; ?> (BM):</label><textarea id="objective_ms" name="objective_ms"></textarea></div>
        </fieldset>
        <fieldset>
          <legend><?php echo $lang['professional_summary']; ?></legend>
          <div class="form-group"><label for="summary_en"><?php echo $lang['professional_summary']; ?> (EN):</label><textarea id="summary_en" name="summary_en" rows="4"></textarea></div>
          <div class="form-group dual-lang-field" style="display:none;"><label for="summary_ms"><?php echo $lang['professional_summary']; ?> (BM):</label><textarea id="summary_ms" name="summary_ms"></textarea></div>
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
            <div class="form-group"><label for="school_name_en"><?php echo $lang['school_name']; ?> (EN):</label><input type="text" id="school_name_en" name="secondary_education[school_name_en]" placeholder="<?php echo $lang['placeholder_school_name']; ?>"/></div>
            <div class="form-group dual-lang-field" style="display:none;"><label for="school_name_ms"><?php echo $lang['school_name']; ?> (BM):</label><input type="text" id="school_name_ms" name="secondary_education[school_name_ms]"/></div>
            <div class="form-group"><label for="sec_grad_year"><?php echo $lang['graduation_year']; ?>:</label><input type="text" id="sec_grad_year" name="secondary_education[year]" placeholder="<?php echo $lang['placeholder_graduation_year']; ?>"/></div>
            <div class="form-group"><label for="sec_achievements_en"><?php echo $lang['key_achievements_grades']; ?> (EN):</label><textarea id="sec_achievements_en" name="secondary_education[achievements_en]" rows="3" placeholder="<?php echo $lang['placeholder_key_achievements']; ?>"></textarea></div>
            <div class="form-group dual-lang-field" style="display:none;"><label for="sec_achievements_ms"><?php echo $lang['key_achievements_grades']; ?> (BM):</label><textarea id="sec_achievements_ms" name="secondary_education[achievements_ms]"></textarea></div>
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

    <template id="email-template">
        <div class="form-group"><div style="display:flex;"><input type="email" name="emails[]" placeholder="e.g., secondary.email@example.com"/><button type="button" class="remove-btn" onclick="removeEntry(this)" style="margin-left:10px;">×</button></div></div>
    </template>
    <template id="experience-template">
      <div class="entry">
        <div class="entry-content">
          <div class="form-group"><label><?php echo $lang['job_type']; ?>:</label><select name="experience[][type]"><option value="Full-time"><?php echo $lang['job_type_full_time']; ?></option><option value="Part-time"><?php echo $lang['job_type_part_time']; ?></option><option value="Contract"><?php echo $lang['job_type_contract']; ?></option><option value="Internship" selected><?php echo $lang['job_type_internship']; ?></option><option value="Freelance"><?php echo $lang['job_type_freelance']; ?></option></select></div>
          <hr>
          <strong class="dual-lang-label"><?php echo $lang['english_section']; ?></strong>
          <div class="form-group"><label><?php echo $lang['job_title']; ?>:</label><input type="text" name="experience[][job_title_en]"/></div>
          <div class="form-group"><label><?php echo $lang['job_grade']; ?>:</label><input type="text" name="experience[][job_grade_en]" placeholder="<?php echo $lang['placeholder_job_grade']; ?>"/></div>
          <div class="form-group"><label><?php echo $lang['company']; ?>:</label><input type="text" name="experience[][company_en]"/></div>
          <div class="form-group"><label><?php echo $lang['description']; ?>:</label><textarea name="experience[][description_en]" rows="3"></textarea></div>
          <div class="dual-lang-field" style="display:none;"><hr><strong class="dual-lang-label"><?php echo $lang['malay_section']; ?></strong>
            <div class="form-group"><label><?php echo $lang['job_title']; ?>:</label><input type="text" name="experience[][job_title_ms]"/></div>
            <div class="form-group"><label><?php echo $lang['job_grade']; ?>:</label><input type="text" name="experience[][job_grade_ms]"/></div>
            <div class="form-group"><label><?php echo $lang['company']; ?>:</label><input type="text" name="experience[][company_ms]"/></div>
            <div class="form-group"><label><?php echo $lang['description']; ?>:</label><textarea name="experience[][description_ms]" rows="3"></textarea></div>
          </div>
          <hr>
          <div class="form-group"><label><?php echo $lang['location']; ?>:</label><input type="text" name="experience[][location]"/></div>
          <div class="form-group"><label><?php echo $lang['years']; ?>:</label><input type="text" name="experience[][years]"/></div>
        </div>
        <div class="entry-controls"><button type="button" class="remove-btn" onclick="removeEntry(this)">×</button></div>
      </div>
    </template>
    <template id="project-template">
      <div class="entry">
        <div class="entry-content">
          <strong class="dual-lang-label"><?php echo $lang['english_section']; ?></strong>
          <div class="form-group"><label><?php echo $lang['project_title']; ?>:</label><input type="text" name="projects[][title_en]"/></div>
          <div class="form-group"><label><?php echo $lang['description']; ?>:</label><textarea name="projects[][description_en]" rows="3"></textarea></div>
           <div class="dual-lang-field" style="display:none;"><hr><strong class="dual-lang-label"><?php echo $lang['malay_section']; ?></strong>
            <div class="form-group"><label><?php echo $lang['project_title']; ?>:</label><input type="text" name="projects[][title_ms]"/></div>
            <div class="form-group"><label><?php echo $lang['description']; ?>:</label><textarea name="projects[][description_ms]" rows="3"></textarea></div>
          </div>
          <hr>
          <div class="form-group"><label><?php echo $lang['project_year']; ?>:</label><input type="text" name="projects[][year]"/></div>
        </div>
        <div class="entry-controls"><button type="button" class="remove-btn" onclick="removeEntry(this)">×</button></div>
      </div>
    </template>
    <template id="education-template">
      <div class="entry">
        <div class="entry-content">
          <strong class="dual-lang-label"><?php echo $lang['english_section']; ?></strong>
          <div class="form-group"><label><?php echo $lang['degree_certificate']; ?>:</label><input type="text" name="education[][degree_en]"/></div>
          <div class="form-group"><label><?php echo $lang['institution']; ?>:</label><input type="text" name="education[][institution_en]"/></div>
          <div class="form-group"><label><?php echo $lang['education_description']; ?>:</label><textarea name="education[][description_en]" rows="3"></textarea></div>
          <div class="dual-lang-field" style="display:none;"><hr><strong class="dual-lang-label"><?php echo $lang['malay_section']; ?></strong>
            <div class="form-group"><label><?php echo $lang['degree_certificate']; ?>:</label><input type="text" name="education[][degree_ms]"/></div>
            <div class="form-group"><label><?php echo $lang['institution']; ?>:</label><input type="text" name="education[][institution_ms]"/></div>
            <div class="form-group"><label><?php echo $lang['education_description']; ?>:</label><textarea name="education[][description_ms]" rows="3"></textarea></div>
          </div>
          <hr>
          <div class="form-group"><label><?php echo $lang['location']; ?>:</label><input type="text" name="education[][location]"/></div>
          <div class="form-group"><label><?php echo $lang['years']; ?>:</label><input type="text" name="education[][years]"/></div>
          <div class="form-group"><label><?php echo $lang['cgpa']; ?>:</label><input type="text" name="education[][cgpa]"/></div>
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
          <div class="form-group"><label><?php echo $lang['reference_full_name']; ?>:</label><input type="text" name="references[][name]"/></div>
          <div class="form-group"><label><?php echo $lang['reference_relation_title']; ?>:</label><input type="text" name="references[][relation]"/></div>
          <div class="form-group"><label><?php echo $lang['reference_contact']; ?>:</label><input type="text" name="references[][contact]"/></div>
        </div>
        <div class="entry-controls"><button type="button" class="remove-btn" onclick="removeEntry(this)">×</button></div>
      </div>
    </template>

<?php require 'footer.php'; ?>