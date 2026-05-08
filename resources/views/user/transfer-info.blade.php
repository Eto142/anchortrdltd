<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transfer Information | anchortrdltd</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fa;
        }

        .option-container {
            max-width: 700px;
            margin: 80px auto;
        }

        .option-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 2.5rem;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .option-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: rgba(42, 91, 215, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 2rem;
            color: #2a5bd7;
        }

        .option-card h4 {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .option-card p {
            font-size: 0.95rem;
            color: #64748b;
        }
    </style>
</head>
<body>

@include('user.header')

<main class="main-content">
    <div class="option-container">

        <div class="text-center mb-5">
            <h2 class="fw-bold">Transfer Information</h2>
            <p class="text-muted">Please review the required document before proceeding</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="option-card">

                    <div class="option-icon">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>

                    <h4>Required Transfer Document</h4>
                    <p class="mb-4">
                        Download and review the official transfer information document.
                        This step is mandatory to continue with your transfer request.
                    </p>

                    <!-- PDF Download -->
                    <a href="transfer-procedure.pdf"
                       download
                       id="downloadBtn"
                       class="btn btn-primary w-100 mb-3">
                        <i class="bi bi-download me-2"></i>
                        Download Transfer PDF
                    </a>

                    <!-- Continue Button -->
                    <button id="continueBtn"
                            class="btn btn-outline-primary w-100"
                            disabled
                            data-bs-toggle="modal"
                            data-bs-target="#supportModal">
                        Continue
                    </button>

                    <small class="text-muted d-block mt-3">
                        Downloading the document is required to continue.
                    </small>

                </div>
            </div>
        </div>

    </div>
</main>

<!-- Support Modal -->
<div class="modal fade" id="supportModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header">
                <h5 class="modal-title">Contact Support</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center">
                <p class="text-muted mb-4">
                    To proceed with this transfer, please contact our support team for verification.
                </p>

                <a href="mailto:support@fundclaimbnk.org"
                   class="btn btn-primary w-100">
                    Email Support
                </a>
            </div>
        </div>
    </div>
</div>

@include('user.bottom-navbar')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.getElementById('downloadBtn').addEventListener('click', function () {
        setTimeout(() => {
            document.getElementById('continueBtn').disabled = false;
        }, 1000);
    });
</script>

</body>
</html>

 @include('user.footer')
