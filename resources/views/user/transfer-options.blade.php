<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transfer Options | anchortrdltd</title>
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
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .option-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border-color: #2a5bd7;
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
            font-size: 0.9rem;
            color: #64748b;
        }
    </style>
</head>
<body>

@include('user.header')

<main class="main-content">
    <div class="option-container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Choose Transfer Type</h2>
            <p class="text-muted">Select how you want to send your funds</p>
        </div>

        <div class="row g-4">
            <!-- Domestic Transfer -->
            <div class="col-md-6">
                <a href="#" class="text-decoration-none">
                    <div class="option-card">
                        <div class="option-icon">
                            <i class="bi bi-bank"></i>
                        </div>
                        <h4>Domestic Transfer</h4>
                        <p>Send money within the same country</p>
                    </div>
                </a>
            </div>

            <!-- International Transfer -->
            <div class="col-md-6">
                <a href="#" class="text-decoration-none">
                    <div class="option-card">
                        <div class="option-icon">
                            <i class="bi bi-globe"></i>
                        </div>
                        <h4>International Transfer</h4>
                        <p>Send money to banks abroad</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</main>

@include('user.bottom-navbar')
 @include('user.footer')
</body>
</html>
