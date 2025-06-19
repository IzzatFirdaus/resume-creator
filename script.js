// Keep track of the index for each section to ensure unique names
const counters = {
  experience: 0,
  internship: 0,
  projects: 0, // NEW
  education: 0,
  reference: 0,
};

/**
 * Clones an HTML template for a given section and appends it to the container.
 * @param {string} section - The name of the section (e.g., 'experience', 'education').
 */
function addEntry(section) {
  // Find the template element for the specified section
  const template = document
    .getElementById(`${section}-template`)
    .content.cloneNode(true);
  const entryDiv = template.querySelector('.entry');

  // Get the current unique index for this section
  const index = counters[section];

  // Update the name attributes of all form elements within the new entry
  entryDiv.querySelectorAll('[name]').forEach((input) => {
    // This regex replaces the empty [] with a unique index like [0], [1], etc.
    input.name = input.name.replace(/\[\]/, `[${index}]`);
  });

  // Append the newly created and indexed entry to its container
  document.getElementById(`${section}-container`).appendChild(template);

  // Increment the counter for the next entry in this section
  counters[section]++;
}

/**
 * Removes the parent '.entry' element of the clicked button.
 * @param {HTMLElement} button - The 'remove' button element that was clicked.
 */
function removeEntry(button) {
  // Find the closest ancestor with the class '.entry' and remove it
  button.closest('.entry').remove();
}

/**
 * This function runs when the page has finished loading.
 * It adds one entry for key sections by default for a better user experience.
 */
window.onload = () => {
  addEntry('experience');
  addEntry('education');
};
