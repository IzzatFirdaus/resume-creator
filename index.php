<?php require 'header.php'; ?>

      <h1><?php echo $lang['form_main_title']; ?></h1>
      
      <p><?php echo $lang['form_main_subtitle']; ?></p>

      <form action="generate_resume.php" method="post" enctype="multipart/form-data">
        
        <fieldset>
          <legend><?php echo $lang['personal_details']; ?></legend>
          <div class="form-group"><label for="profile_photo"><?php echo $lang['profile_photo']; ?>:</label><input type="file" id="profile_photo" name="profile_photo" accept="image/png, image/jpeg, image/jpg"/></div>
          <div class="form-group"><label for="full_name"><?php echo $lang['full_name']; ?>:</label><input type="text" id="full_name" name="full_name" placeholder="<?php echo $lang['placeholder_full_name']; ?>" required/></div>
          <div class="form-group"><label for="tagline"><?php echo $lang['professional_tagline']; ?>:</label><input type="text" id="tagline" name="tagline" placeholder="<?php echo $lang['placeholder_tagline']; ?>"/></div>
          <div class="form-group"><label for="email"><?php echo $lang['email']; ?>:</label><input type="email" id="email" name="email" placeholder="<?php echo $lang['placeholder_email']; ?>" required/></div>
          <div class="form-group"><label for="phone"><?php echo $lang['phone']; ?>:</label><input type="tel" id="phone" name="phone" placeholder="<?php echo $lang['placeholder_phone']; ?>"/></div>
          <div class="form-group"><label for="address"><?php echo $lang['physical_address']; ?>:</label><textarea id="address" name="address" rows="3" placeholder="<?php echo $lang['placeholder_address']; ?>"></textarea></div>
          <div class="form-group"><label for="github"><?php echo $lang['github_profile']; ?>:</label><input type="url" id="github" name="github" placeholder="<?php echo $lang['placeholder_github']; ?>"/></div>
        </fieldset>

        <fieldset>
          <legend><?php echo $lang['professional_summary']; ?></legend>
          <div class="form-group"><label for="summary"><?php echo $lang['professional_summary']; ?>:</label><textarea id="summary" name="summary" rows="4" placeholder="<?php echo $lang['placeholder_summary']; ?>"></textarea></div>
        </fieldset>

        <fieldset>
          <legend class="section-legend"><span><?php echo $lang['employment_history']; ?></span><button type="button" class="add-btn" onclick="addEntry('experience')"><?php echo $lang['add_button']; ?></button></legend>
          <div id="experience-container"></div>
        </fieldset>

        <fieldset>
          <legend class="section-legend"><span><?php echo $lang['internships']; ?></span><button type="button" class="add-btn" onclick="addEntry('internship')"><?php echo $lang['add_button']; ?></button></legend>
          <div id="internship-container"></div>
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
          <legend><?php echo $lang['skills']; ?></legend>
          <div class="form-group"><label for="skills"><?php echo $lang['skills_comma_separated']; ?>:</label><input type="text" id="skills" name="skills" placeholder="<?php echo $lang['placeholder_skills']; ?>"/></div>
        </fieldset>

        <fieldset>
          <legend class="section-legend"><span><?php echo $lang['references']; ?></span><button type="button" class="add-btn" onclick="addEntry('reference')"><?php echo $lang['add_button']; ?></button></legend>
          <div id="reference-container"></div>
        </fieldset>

        <div class="form-group" style="border-top: 1px solid #ddd; padding-top: 20px; margin-top:20px;">
          <label for="auto_translate">
            <input type="checkbox" id="auto_translate" name="auto_translate" value="1" style="width: auto; margin-right: 10px;">
            <?php echo $lang['auto_translate_label']; ?>
          </label>
          <div id="source_language_div" style="margin-top: 15px; display: none;">
            <label for="source_language"><?php echo $lang['input_language_label']; ?></label>
            <select name="source_language" id="source_language">
                <option value="en"><?php echo $lang['english']; ?></option>
                <option value="ms"><?php echo $lang['bahasa_malayu']; ?></option>
            </select>
          </div>
          <p style="font-size: 12px; color: #666;">Note: For best results, provide your own translations. This feature uses machine translation.</p>
        </div>

        <button type="submit" name="submit"><?php echo $lang['generate_button']; ?></button>
      </form>

    <template id="experience-template">
      <div class="entry">
        <div class="entry-content">
          <div class="form-group"><label><?php echo $lang['job_title']; ?>:</label><input type="text" name="experience[][job_title]" placeholder="<?php echo $lang['placeholder_job_title']; ?>"/></div>
          <div class="form-group"><label><?php echo $lang['company']; ?>:</label><input type="text" name="experience[][company]" placeholder="<?php echo $lang['placeholder_company']; ?>"/></div>
          <div class="form-group"><label><?php echo $lang['location']; ?>:</label><input type="text" name="experience[][location]" placeholder="<?php echo $lang['placeholder_location']; ?>"/></div>
          <div class="form-group"><label><?php echo $lang['years']; ?>:</label><input type="text" name="experience[][years]" placeholder="<?php echo $lang['placeholder_years']; ?>"/></div>
          <div class="form-group"><label><?php echo $lang['description']; ?>:</label><textarea name="experience[][description]" rows="3" placeholder="<?php echo $lang['placeholder_description']; ?>"></textarea></div>
        </div>
        <div class="entry-controls"><button type="button" class="remove-btn" onclick="removeEntry(this)"><?php echo $lang['remove_button']; ?></button></div>
      </div>
    </template>
    <template id="internship-template">
      <div class="entry">
        <div class="entry-content">
            <div class="form-group"><label><?php echo $lang['internship_title']; ?>:</label><input type="text" name="internships[][title]" placeholder="<?php echo $lang['placeholder_internship_title']; ?>"/></div>
            <div class="form-group"><label><?php echo $lang['company']; ?>:</label><input type="text" name="internships[][company]" placeholder="<?php echo $lang['placeholder_company']; ?>"/></div>
            <div class="form-group"><label><?php echo $lang['location']; ?>:</label><input type="text" name="internships[][location]" placeholder="<?php echo $lang['placeholder_location']; ?>"/></div>
            <div class="form-group"><label><?php echo $lang['period']; ?>:</label><input type="text" name="internships[][period]" placeholder="<?php echo $lang['placeholder_internship_period']; ?>"/></div>
            <div class="form-group"><label><?php echo $lang['description']; ?>:</label><textarea name="internships[][description]" rows="3" placeholder="<?php echo $lang['placeholder_description']; ?>"></textarea></div>
        </div>
        <div class="entry-controls"><button type="button" class="remove-btn" onclick="removeEntry(this)"><?php echo $lang['remove_button']; ?></button></div>
      </div>
    </template>
    <template id="project-template">
      <div class="entry">
        <div class="entry-content">
          <div class="form-group"><label><?php echo $lang['project_title']; ?>:</label><input type="text" name="projects[][title]" placeholder="<?php echo $lang['placeholder_project_title']; ?>"/></div>
          <div class="form-group"><label><?php echo $lang['project_year']; ?>:</label><input type="text" name="projects[][year]" placeholder="<?php echo $lang['placeholder_project_year']; ?>"/></div>
          <div class="form-group"><label><?php echo $lang['description']; ?>:</label><textarea name="projects[][description]" rows="3" placeholder="<?php echo $lang['placeholder_description']; ?>"></textarea></div>
        </div>
        <div class="entry-controls"><button type="button" class="remove-btn" onclick="removeEntry(this)"><?php echo $lang['remove_button']; ?></button></div>
      </div>
    </template>
    <template id="education-template">
      <div class="entry">
        <div class="entry-content">
          <div class="form-group"><label><?php echo $lang['degree_certificate']; ?>:</label><input type="text" name="education[][degree]" placeholder="<?php echo $lang['placeholder_degree']; ?>"/></div>
          <div class="form-group"><label><?php echo $lang['institution']; ?>:</label><input type="text" name="education[][institution]" placeholder="<?php echo $lang['placeholder_institution']; ?>"/></div>
          <div class="form-group"><label><?php echo $lang['location']; ?>:</label><input type="text" name="education[][location]" placeholder="<?php echo $lang['placeholder_location']; ?>"/></div>
          <div class="form-group"><label><?php echo $lang['years']; ?>:</label><input type="text" name="education[][years]" placeholder="<?php echo $lang['placeholder_education_years']; ?>"/></div>
          <div class="form-group"><label><?php echo $lang['cgpa']; ?>:</label><input type="text" name="education[][cgpa]" placeholder="<?php echo $lang['placeholder_cgpa']; ?>"/></div>
          <div class="form-group"><label><?php echo $lang['education_description']; ?>:</label><textarea name="education[][description]" rows="3" placeholder="<?php echo $lang['placeholder_education_description']; ?>"></textarea></div>
        </div>
        <div class="entry-controls"><button type="button" class="remove-btn" onclick="removeEntry(this)"><?php echo $lang['remove_button']; ?></button></div>
      </div>
    </template>
    <template id="reference-template">
      <div class="entry">
        <div class="entry-content">
          <div class="form-group"><label><?php echo $lang['reference_full_name']; ?>:</label><input type="text" name="references[][name]" placeholder="<?php echo $lang['placeholder_ref_name']; ?>"/></div>
          <div class="form-group"><label><?php echo $lang['reference_relation_title']; ?>:</label><input type="text" name="references[][relation]" placeholder="<?php echo $lang['placeholder_ref_relation']; ?>"/></div>
          <div class="form-group"><label><?php echo $lang['reference_contact']; ?>:</label><input type="text" name="references[][contact]" placeholder="<?php echo $lang['placeholder_ref_contact']; ?>"/></div>
        </div>
        <div class="entry-controls"><button type="button" class="remove-btn" onclick="removeEntry(this)"><?php echo $lang['remove_button']; ?></button></div>
      </div>
    </template>

    <script>
        document.getElementById('auto_translate').addEventListener('change', function() {
            var sourceLangDiv = document.getElementById('source_language_div');
            if (this.checked) {
                sourceLangDiv.style.display = 'block';
            } else {
                sourceLangDiv.style.display = 'none';
            }
        });
    </script>
    
<?php require 'footer.php'; ?>