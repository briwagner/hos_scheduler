// Add event listener to textarea, to update character count.
// Get form.
let schedulerForm = document.getElementById('hos-scheduler-config-form');

if (schedulerForm) {
  // Get form field.
  let schedulerInput = document.getElementById('edit-message-text');
  // Add listener.
  schedulerInput.addEventListener('keyup', schedulerUpdateCount);
}

// Update text value upon change.
function schedulerUpdateCount() {
  let count = this.value.length;
  // Get text element.
  let counter = document.getElementById('activeCharCount');
  counter.innerHTML = count;
}