// Keep track of the index for each section to ensure unique names
const counters = {
  experience: 0,
  project: 0,
  education: 0,
  skill: 0, 
  language: 0,
  reference: 0,
  email: 1, 
};

/**
 * Clones an HTML template for a given section and appends it to the container.
 * @param {string} section - The name of the section (e.g., 'experience', 'education').
 */
function addEntry(section) {
  const template = document.getElementById(`${section}-template`).content.cloneNode(true);
  const container = document.getElementById(`${section}-container`);
  const index = counters[section];

  // Update name attributes with the correct index for repeatable sections
  template.querySelectorAll('[name*="[][]"]').forEach((input) => {
    input.name = input.name.replace('[]', `[${index}]`);
  });

  // Specific handling for email to update the label number
  if (section === 'email') {
      const newLabel = template.querySelector('label');
      if (newLabel) {
          newLabel.textContent = `Email ${index + 1}:`;
          newLabel.setAttribute('for', `email_${index}`);
      }
      const newInput = template.querySelector('input');
      if (newInput) {
          newInput.id = `email_${index}`;
      }
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
      document.querySelectorAll('.dual-lang-label').forEach((label) => {
        label.style.display = this.checked ? 'block' : 'none';
      });
    });
  }
};