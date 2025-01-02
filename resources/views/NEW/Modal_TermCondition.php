<!DOCTYPE html>
<html lang="en">
<head>
<!--Ayusin Mo Nalang Yung Name Ginanyan ko Lang Para Mahanap Agad-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--Need to Para sa Design Ni Coleen (Edit mo Base sA Gusto Mo)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Modal</title>
</head>
<body>
<!--Need to Para Pag Tig Click yung Button Magpapakita yung Modal (Edit mo Base sA Gusto Mo)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<!--Ito Yung Button na Nag Tritrigger ng Modal for Private Policy--->
<!--Button Start-->
    <div class="col-md-12 mt-3">
        <button type="button" class="btn btn-danger" onclick="window.history.back()">Back</button>
        <button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#termsModal" id="submitBtn">Submit</button>
    </div>
<!--Button End-->

<!---Terms and Agreement Modal Start (Yung may Binabasa and need icheck)-->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">Terms and Agreement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6><b>Data Privacy Act</b></h6>
                    <p>By using this service, you acknowledge that your personal information will be collected, processed, and stored in compliance with the Data Privacy Act of 2012. This includes your civil registry data for certification purposes.</p>
                    <h6><b>Terms and Agreement</b></h6>
                    <p>Please read the terms and conditions carefully before proceeding. Your submission signifies your agreement to abide by the rules and policies of the Manito Civil Registry Online Services.</p>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="agreeCheckbox">
                        <label class="form-check-label" for="agreeCheckbox">I agree to the Terms and Agreement and Data Privacy Act</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success" id="submitButton" disabled>Submit</button>
                </div>
            </div>
        </div>
    </div>
<!---Terms and Agreement Modal End-->

<!--Confirm Submission Modal Start (Yung Need Mag Yes)--->
    <div class="modal fade" id="submitInfoModal" tabindex="-1" aria-labelledby="submitInfoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="submitInfoModalLabel">Confirm Submission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to submit this information?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel and Edit</button>
                    <button type="button" class="btn btn-success" id="confirmSubmit">Yes, I am Sure</button>
                </div>
            </div>
        </div>
    </div>
<!---Confirm Submission Modal End-->


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const agreeCheckbox = document.getElementById("agreeCheckbox");
            const submitButton = document.getElementById("submitButton");

            // Habang hindi chinecheck yung textbox hindi clickable yung "Submit Button", and pag na check na clickable na.
            agreeCheckbox.addEventListener("change", function () {
                submitButton.disabled = !agreeCheckbox.checked;
            });

            // Transition lang to between Term and Condition Modal to Submit Modal
            document.getElementById('submitButton').addEventListener('click', function() {
                let termsModal = bootstrap.Modal.getInstance(document.getElementById('termsModal'));
                termsModal.hide();

                let submitInfoModal = new bootstrap.Modal(document.getElementById('submitInfoModal'));
                submitInfoModal.show();
            });
        });
    </script>
</body>
</html>