<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File Upload Form</title>

    <script src="js/app.js"></script>
</head>
<body>
<div class="container vh-100">
    <div class="row align-items-center h-100 justify-content-center">
        <div class="col text-center">
            <button id="start_upload" type="button" class="btn btn-primary">Start Upload</button>
        </div>
    </div>

    <div class="modal" id="modal_upload" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form id="file_form" enctype="multipart/form-data" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">File upload</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="custom-file">
                        <input type="file" class="position-absolute custom-file-input" id="file_input">
                        <div id="text-field" class="input-group mb-3">
                            <span class="form-control" type="button">Select file</span>
                            <div class="input-group-append">
                                <span class="input-group-text w-16 overflow-auto text-center d-block cursor-pointer"
                                      type="button"
                                      id="file_input__addon_label"
                                >
                                    Browse
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 text-center">
                        <p>We support .pdf, .jpeg file formats and size up to 5MB.</p>
                    </div>

                    <div class="mt-3 text-center">
                        <p id="status_text"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="submit_file" type="submit" class="btn btn-primary m-auto">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal" id="modal_success" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mt-3 text-center">
                        <span class="font-weight-bold">File was uploaded successfully</span>
                    </div>
                    <div class="mt-3 text-center">
                        <p id="text_id"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="submit_file" data-dismiss="modal" type="button" class="btn btn-secondary m-auto">Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
