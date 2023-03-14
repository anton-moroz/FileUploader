// Import Bootstrap and the custom styles
import 'bootstrap';
import './styles.scss';

$(document).ready(function() {
  // Select the necessary elements from the DOM
  const fileInput = $('#file_input');
  const statusText = $('#status_text');
  const modalUpload = $('#modal_upload');
  const modalSuccess = $('#modal_success');
  const fileInputAddonLabel = $('#file_input__addon_label');

  // Map the status messages to the corresponding CSS classes
  const statusMapping = {
    'error': 'text-danger',
    'success': 'text-success',
  };

  // Show the modal when the upload button is clicked
  $('#start_upload').on('click', () => modalUpload.modal('show'));

  // Update the label and clear the status when a file is selected
  fileInput.on('change', function() {
    fileInputAddonLabel.text(this.files[0].name);
    statusText.text('').removeAttr('class');
  });

  // Submit the file form via AJAX
  $('#file_form').on('submit', function(event) {
    event.preventDefault();

    // Get the selected file
    const file = fileInput[0].files[0];

    // Return if no file is selected
    if (!file) {
      return false;
    }

    // Create a new form data object and append the file to it
    const form = new FormData();
    form.set('file', file);

    // Send the form data via AJAX
    $.ajax({
      url: 'upload.php',
      type: 'POST',
      data: form,
      contentType: false,
      processData: false,
      enctype: 'multipart/form-data',

      // Set the status message before sending the request
      beforeSend: function() {
        statusText.text('Uploading...');
      },

      // Handle the success response
      success: function(res) {
        // Update the text in the modal with the response ID
        $('#text_id').text('ID: ' + res);

        // Clear the status and hide the upload modal
        statusText.text('').removeAttr('class');
        modalUpload.modal('hide');

        // Reset the file input and show the success modal
        fileInputAddonLabel.text('Browse');
        fileInput.val('');
        modalSuccess.modal('show');
      },

      // Handle the error response
      error: function(xhr) {
        // Set the status message to the error message
        setStatus(xhr.responseJSON ?? 'Oops! Something went wrong!');
      },
    });
  });

  // Update the status text with the given message and class
  function setStatus(text, status = 'error') {
    statusText.text(text);
    statusText.addClass(statusMapping[status]);
  }
});
