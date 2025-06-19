// Keep track of the index for each section to ensure unique names
const counters = {
  email: 1,
  experience: 0,
  project: 0,
  education: 0,
  language: 0,
  skill: 0,
  reference: 0,
};

/**
 * Clones an HTML template for a given section and appends it to the container.
 * @param {string} section - The name of the section (e.g., 'experience', 'education').
 */
function addEntry(section) {
  const template = document.getElementById(`${section}-template`).content.cloneNode(true);
  const container = document.getElementById(`${section}-container`);
  const index = counters[section];

  template.querySelectorAll('[name*="[][]"]').forEach((input) => {
    input.name = input.name.replace('[]', `[${index}]`);
  });
  
  if (section === 'email') {
      const newLabel = template.querySelector('label');
      if (newLabel) {
          newLabel.textContent = `Email ${index + 1}:`;
      }
  }

  // If dual language is already checked, make sure new fields are visible
  if(document.getElementById('dual_language').checked) {
      template.querySelectorAll('.dual-lang-field').forEach((field) => {
        field.style.display = 'block';
      });
  }

  container.appendChild(template);
  counters[section]++;
}

/**
 * Removes the parent '.entry' or '.form-group' element of the clicked button.
 * @param {HTMLElement} button - The 'remove' button element that was clicked.
 */
function removeEntry(button) {
  button.closest('.entry, .form-group').remove();
}

/**
 * Reads a selected image file and displays it in an <img> tag for preview.
 */
function previewPhoto() {
  const fileInput = document.getElementById('profile_photo');
  const preview = document.getElementById('photo-preview');
  const file = fileInput.files[0];
  const reader = new FileReader();

  reader.onloadend = function () {
    preview.src = reader.result;
    preview.classList.add('visible');
  }

  if (file) {
    reader.readAsDataURL(file);
  } else {
    preview.src = "";
    preview.classList.remove('visible');
  }
}

/**
 * This function runs when the page has finished loading.
 */
window.onload = () => {
  // Add one entry for key sections by default
  addEntry('experience');
  addEntry('education');
  addEntry('skill');
  addEntry('language');

  // Add event listener for the dual-language checkbox
  const dualLangCheckbox = document.getElementById('dual_language');
  if (dualLangCheckbox) {
    dualLangCheckbox.addEventListener('change', function () {
      document.querySelectorAll('.dual-lang-field').forEach((field) => {
        field.style.display = this.checked ? 'block' : 'none';
      });
    });
  }
};