<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHU Mental Health Screening</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <style>
        
    </style>
</head>
<body>

    <div class="dashboard-container">

        <div class="dashboard-header">
            <h1>Health & Wellness Clinic</h1>
            <h2>Public Health Unit</h2>
            <p>Mental Health Screening Forms</p>
        </div>

        <div class="card-grid">

            <!-- GAD-7 -->
            <div class="dashboard-card">
                <h2>GAD-7 Assessment</h2>
                <p>
                    Generalized Anxiety Disorder screening tool used to assess
                    the severity of anxiety symptoms.
                </p>
                <a href="./public/GAD_7.php">Open GAD-7 Form</a>
            </div>

            <!-- PHQ-9 -->
            <div class="dashboard-card card-secondary">
                <h2>PHQ-9 Assessment</h2>
                <p>
                    Patient Health Questionnaire used to screen, diagnose,
                    and monitor depression severity.
                </p>
                <a href="./public/PHQ_9.php">Open PHQ-9 Form</a>
            </div>

            <!-- Fagerström Test for Nicotine Dependence -->
            <div class="dashboard-card">
                <h2>Fagerström Test (FTND)</h2>
                <p>
                    The Fagerström Test for Nicotine Dependence is a standardized screening
                    tool used to assess the level of physical dependence on nicotine among
                    tobacco users.
                </p>
                <a href="./public/FTND.php">Open Fagerström Test</a>
            </div>

            <!-- Pittsburgh Sleep Quality Index (PSQI) -->
            <div class="dashboard-card">
                <h2>Pittsburgh Sleep Quality Index (PSQI)</h2>
                <p>
                    The Pittsburgh Sleep Quality Index (PSQI) is a standardized assessment
                    tool used to measure sleep quality and disturbances over a one-month
                    period. It helps identify individuals with poor sleep quality who may
                    require further evaluation or intervention.
                </p>
                <a href="./public/sqa.php">Open PSQI Assessment</a>
            </div>



            <!-- Future Module -->
            <div class="dashboard-card">
                <h2>Reports & Dashboard</h2>
                <p>
                    View statistics, trends, and summarized results
                    for PHU monitoring.
                </p>
                <a href="./public/dashboard.php">View</a>
            </div>

        </div>

    </div>

</body>
</html>
