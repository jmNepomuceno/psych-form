<?php 
    include('../assets/connection/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHU Digital Assessment Forms System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/home.css">
    <link rel="stylesheet" href="../assets/css/header.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="dashboard-container">

        <!-- HEADER WITH LOGOS -->
        <div class="dashboard-header">
            <div class="logo-row">
                <img src="../source/tcp_DOH_2.png" alt="DOH Logo">
                <img src="../source/tcp_BGHMC_2.png" alt="BGHMC Logo">
            </div>

            <div class="title-div">
                <h1>Health & Wellness Clinic</h1>
                <h2>Public Health Unit</h2>
                <p>Digital Assessment Forms System</p>
            </div>

            <div class="logo-row">
                <img src="../source/phu_bg.jpg" alt="PHU Logo">
                <img src="../source/tcp_BP_2.png" alt="Bagong Pilipinas Logo">
            </div>
        </div>

        <!-- DASHBOARD CARDS SECTION -->
        <div class="card-grid">
            <!-- GAD-7 -->
            <div class="dashboard-card">
                <h2>GAD-7 Assessment</h2>
                <p>
                    Generalized Anxiety Disorder screening tool used to assess
                    the severity of anxiety symptoms.
                </p>
                <div class="function-div">
                    <button class="prev-assess-btns">Previous Assessments</button>
                    <a href="../public/GAD_7.php">Open GAD-7 Form</a>
                </div>
            </div>

            <!-- PHQ-9 -->
            <div class="dashboard-card">
                <h2>PHQ-9 Assessment</h2>
                <p>
                    Patient Health Questionnaire used to screen, diagnose,
                    and monitor depression severity.
                </p>
                <button class="prev-assess-btns">Previous Assessments</button>
                <div class="function-div">
                    <button class="prev-assess-btns">Previous Assessments</button>
                    <a href="../public/PHQ_9.php">Open PHQ-9 Form</a>
                </div>
            </div>

            <!-- Fagerström Test for Nicotine Dependence -->
            <div class="dashboard-card">
                <h2>Fagerström Test (FTND)</h2>
                <p>
                    The Fagerström Test for Nicotine Dependence is a standardized screening
                    tool used to assess the level of physical dependence on nicotine among
                    tobacco users.
                </p>
                <button class="prev-assess-btns">Previous Assessments</button>
                <div class="function-div">
                    <button class="prev-assess-btns">Previous Assessments</button>
                    <a href="../public/FTND.php">Open Fagerström Test</a>
                </div>
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
                <button class="prev-assess-btns">Previous Assessments</button>
                <div class="function-div">
                    <button class="prev-assess-btns">Previous Assessments</button>
                    <a href="../public/sqa.php">Open PSQI Assessment</a>
                </div>
            </div>

            <!-- Perceived Stress Scale (PSS-10) -->
            <div class="dashboard-card">
                <h2>Perceived Stress Scale (PSS-10)</h2>
                <p>
                    The Perceived Stress Scale (PSS-10) is a widely used psychological tool
                    for measuring the perception of stress over the past month. It helps identify
                    individuals experiencing high levels of stress who may benefit from stress
                    management guidance or interventions.
                </p>
                <button class="prev-assess-btns">Previous Assessments</button>
                <a href="../public/psc.php">Open PSS-10 Assessment</a>
            </div>

            <!-- AUDIT Alcohol Screening Tool -->
            <div class="dashboard-card">
                <h2>AUDIT Alcohol Screening Tool</h2>
                <p>
                    The Alcohol Use Disorders Identification Test (AUDIT) is a screening tool
                    used to assess alcohol consumption, drinking behaviors, and alcohol-related
                    problems over the past 12 months. It helps detect risky drinking and alcohol
                    use disorders for appropriate intervention.
                </p>
                <button class="prev-assess-btns">Previous Assessments</button>
                <div class="function-div">
                    <button class="prev-assess-btns">Previous Assessments</button>
                   <a href="../public/aas.php">Open AUDIT Assessment</a>
                </div>
            </div>

            <div class="dashboard-card">
                <h2>PAR-Q+ Physical Activity Readiness Questionnaire</h2>
                <p>
                    The Physical Activity Readiness Questionnaire for Everyone (PAR-Q+)
                    is a screening tool used to determine whether it is safe for an
                    individual to engage in physical activity. It helps identify
                    medical conditions or symptoms that may require medical clearance
                    before starting or increasing physical activity.
                </p>
                <button class="prev-assess-btns">Previous Assessments</button>
                <div class="function-div">
                    <button class="prev-assess-btns">Previous Assessments</button>
                    <a href="../public/parq.php">Open PAR-Q+ Assessment</a>
                </div>
            </div>

            <!-- Reports -->
            <?php if($_SESSION['user'] == 2078 || $_SESSION['user'] == 3858){ ?>
                <div class="dashboard-card card-secondary">
                    <h2>Reports & Dashboard</h2>
                    <p>
                        View statistics, trends, and summarized results
                        for PHU monitoring.
                    </p>
                    <a href="../public/dashboard.php">View</a>
                </div>
            <?php } ?>
        </div>
    </div>


</body>
</html>
