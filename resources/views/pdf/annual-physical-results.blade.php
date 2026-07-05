<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Annual Physical Medical Results - {{ $examination->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #059669;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #059669;
            margin-bottom: 10px;
        }
        .company-info {
            font-size: 14px;
            color: #666;
        }
        .patient-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #059669;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }
        .fitness-assessment {
            background: #f0f9ff;
            border: 2px solid #0ea5e9;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            margin-bottom: 25px;
        }
        .fitness-assessment.fit {
            background: #f0fdf4;
            border-color: #22c55e;
        }
        .fitness-assessment.unfit {
            background: #fef2f2;
            border-color: #ef4444;
        }
        .fitness-result {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .fitness-result.fit {
            color: #16a34a;
        }
        .fitness-result.unfit {
            color: #dc2626;
        }
        .fitness-result.evaluation {
            color: #ea580c;
        }
        .info-grid {
            display: table;
            width: 100%;
            margin-bottom: 15px;
        }
        .info-row {
            display: table-row;
        }
        .info-label {
            display: table-cell;
            font-weight: bold;
            width: 30%;
            padding: 5px 10px 5px 0;
            vertical-align: top;
        }
        .info-value {
            display: table-cell;
            padding: 5px 0;
            vertical-align: top;
        }
        .findings-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        .findings-table th,
        .findings-table td {
            border: 1px solid #d1d5db;
            padding: 8px;
            text-align: left;
        }
        .findings-table th {
            background: #f3f4f6;
            font-weight: bold;
        }
        .normal {
            color: #16a34a;
            font-weight: bold;
        }
        .abnormal {
            color: #dc2626;
            font-weight: bold;
        }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="logo">🏥 RSS Citi Health Services</div>
        <div class="company-info">
            <strong>Annual Physical Examination Report</strong><br>
            Generated on {{ now()->format('F d, Y \a\t h:i A') }}
        </div>
    </div>

    <!-- Patient Information -->
    <div class="patient-info">
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Patient Name:</div>
                <div class="info-value">{{ $examination->name }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Examination ID:</div>
                <div class="info-value">#{{ $examination->id }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Examination Date:</div>
                <div class="info-value">{{ $examination->date ? \Carbon\Carbon::parse($examination->date)->format('F d, Y') : 'N/A' }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Report Generated:</div>
                <div class="info-value">{{ now()->format('F d, Y \a\t h:i A') }}</div>
            </div>
            @if($examination->patient && $examination->patient->appointment && $examination->patient->appointment->creator)
                <div class="info-row">
                    <div class="info-label">Company:</div>
                    <div class="info-value">{{ $examination->patient->appointment->creator->company ?? 'N/A' }}</div>
                </div>
            @endif
        </div>
    </div>

    <!-- Fitness Assessment -->
    @if($examination->fitness_assessment)
    <div class="fitness-assessment {{ $examination->fitness_assessment === 'Fit to Work' ? 'fit' : ($examination->fitness_assessment === 'Not Fit to Work' ? 'unfit' : '') }}">
        <div class="fitness-result {{ $examination->fitness_assessment === 'Fit to Work' ? 'fit' : ($examination->fitness_assessment === 'Not Fit to Work' ? 'unfit' : 'evaluation') }}">
            {{ $examination->fitness_assessment }}
        </div>
        @if($examination->assessment_details)
            @php
                $details = is_string($examination->assessment_details) ? json_decode($examination->assessment_details, true) : $examination->assessment_details;
            @endphp
            @if(is_array($details))
                <div style="font-size: 12px; margin-top: 10px;">
                    @if(isset($details['abnormal_tests']) && count($details['abnormal_tests']) > 0)
                        <strong>Abnormal Findings:</strong><br>
                        @foreach($details['abnormal_tests'] as $test)
                            • {{ $test }}<br>
                        @endforeach
                    @endif
                </div>
            @endif
        @endif
    </div>
    @endif

    <!-- Medical History -->
    @if($examination->illness_history || $examination->accidents_operations || $examination->past_medical_history)
    <div class="section">
        <div class="section-title">Medical History</div>
        @if($examination->illness_history)
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-label">Illness History:</div>
                    <div class="info-value">{{ $examination->illness_history }}</div>
                </div>
            </div>
        @endif
        @if($examination->accidents_operations)
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-label">Accidents/Operations:</div>
                    <div class="info-value">{{ $examination->accidents_operations }}</div>
                </div>
            </div>
        @endif
        @if($examination->past_medical_history)
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-label">Past Medical History:</div>
                    <div class="info-value">{{ $examination->past_medical_history }}</div>
                </div>
            </div>
        @endif
    </div>
    @endif

    <!-- Family History -->
    @if($examination->family_history)
    <div class="section">
        <div class="section-title">Family History</div>
        @php
            $familyHistory = is_array($examination->family_history) ? $examination->family_history : json_decode($examination->family_history, true);
        @endphp
        @if(is_array($familyHistory))
            <div class="info-grid">
                @foreach($familyHistory as $condition => $value)
                    @if($value && $value !== 'none')
                        <div class="info-row">
                            <div class="info-label">{{ ucfirst(str_replace('_', ' ', $condition)) }}:</div>
                            <div class="info-value">{{ is_string($value) ? $value : 'Yes' }}</div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
    @endif

    <!-- Physical Examination -->
    @if($examination->physical_findings)
    <div class="section">
        <div class="section-title">Physical Examination</div>
        @php
            $physicalFindings = is_array($examination->physical_findings) ? $examination->physical_findings : json_decode($examination->physical_findings, true);
        @endphp
        @if(is_array($physicalFindings))
            <table class="findings-table">
                <thead>
                    <tr>
                        <th>Examination</th>
                        <th>Result</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($physicalFindings as $exam => $data)
                        @if(is_array($data))
                            <tr>
                                <td>{{ ucfirst(str_replace('_', ' ', $exam)) }}</td>
                                <td class="{{ isset($data['result']) && strtolower($data['result']) === 'normal' ? 'normal' : 'abnormal' }}">
                                    {{ $data['result'] ?? 'N/A' }}
                                </td>
                                <td>{{ $data['remarks'] ?? '-' }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    @endif

    <!-- Laboratory Results -->
    @php
        // Get lab results from lab_report field (where pathologist stores results)
        $labReport = is_array($examination->lab_report) ? $examination->lab_report : json_decode($examination->lab_report, true);
        $labFindings = is_array($examination->lab_findings) ? $examination->lab_findings : json_decode($examination->lab_findings, true);
        
        // Define all possible lab tests (generalized approach)
        $allLabTests = [];
        
        // Collect from lab_report (pathologist results)
        if (is_array($labReport)) {
            foreach ($labReport as $key => $value) {
                if (!empty($value) && $value !== 'N/A') {
                    // Skip drug test fields (they have their own section)
                    if (!in_array($key, ['methamphetamine_result', 'marijuana_result', 'drug_test'])) {
                        $testName = ucfirst(str_replace(['_result', '_'], [' ', ' '], $key));
                        $allLabTests[$testName] = [
                            'result' => $value,
                            'source' => 'pathologist'
                        ];
                    }
                }
            }
        }
        
        // Collect from lab_findings (doctor/radiologist results)
        if (is_array($labFindings)) {
            foreach ($labFindings as $key => $data) {
                if (is_array($data) && isset($data['result']) && !empty($data['result'])) {
                    $testName = ucfirst(str_replace('_', ' ', $key));
                    $allLabTests[$testName] = [
                        'result' => $data['result'],
                        'findings' => $data['findings'] ?? '',
                        'source' => 'doctor'
                    ];
                }
            }
        }
    @endphp
    
    @if(!empty($allLabTests))
    <div class="section">
        <div class="section-title">Laboratory Results</div>
        <table class="findings-table">
            <thead>
                <tr>
                    <th>Test</th>
                    <th>Result</th>
                    <th>Findings/Notes</th>
                </tr>
            </thead>
            <tbody>
                @foreach($allLabTests as $testName => $testData)
                    <tr>
                        <td>{{ $testName }}</td>
                        <td class="{{ in_array(strtolower($testData['result']), ['normal', 'negative']) ? 'normal' : 'abnormal' }}">
                            {{ $testData['result'] }}
                        </td>
                        <td>{{ $testData['findings'] ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <!-- Drug Test Results -->
    @php
        // Get drug test results from lab_report field (where medtech/nurse stores results)
        $drugTestResults = [];
        
        if (is_array($labReport)) {
            // Check for drug test results in lab_report
            if (isset($labReport['methamphetamine_result']) && !empty($labReport['methamphetamine_result'])) {
                $drugTestResults['Methamphetamine'] = $labReport['methamphetamine_result'];
            }
            if (isset($labReport['marijuana_result']) && !empty($labReport['marijuana_result'])) {
                $drugTestResults['Marijuana'] = $labReport['marijuana_result'];
            }
        }
        
        // Also check the drug_test field as fallback
        $drugTest = is_array($examination->drug_test) ? $examination->drug_test : json_decode($examination->drug_test, true);
        if (is_array($drugTest)) {
            if (isset($drugTest['methamphetamine_result']) && !empty($drugTest['methamphetamine_result'])) {
                $drugTestResults['Methamphetamine'] = $drugTest['methamphetamine_result'];
            }
            if (isset($drugTest['marijuana_result']) && !empty($drugTest['marijuana_result'])) {
                $drugTestResults['Marijuana'] = $drugTest['marijuana_result'];
            }
        }
    @endphp
    
    @if(!empty($drugTestResults))
    <div class="section">
        <div class="section-title">Drug Test Results</div>
        <table class="findings-table">
            <thead>
                <tr>
                    <th>Substance</th>
                    <th>Result</th>
                </tr>
            </thead>
            <tbody>
                @foreach($drugTestResults as $substance => $result)
                    <tr>
                        <td>{{ $substance }}</td>
                        <td class="{{ strtolower($result) === 'negative' ? 'normal' : 'abnormal' }}">
                            {{ $result }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <!-- Visual Acuity -->
    @if($examination->visual)
    <div class="section">
        <div class="section-title">Visual Acuity</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Visual Acuity:</div>
                <div class="info-value">{{ $examination->visual }}</div>
            </div>
        </div>
    </div>
    @endif

    <!-- Ishihara Test -->
    @if($examination->ishihara_test)
    <div class="section">
        <div class="section-title">Color Vision Test</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Ishihara Test:</div>
                <div class="info-value">{{ $examination->ishihara_test }}</div>
            </div>
        </div>
    </div>
    @endif

    <!-- ECG Results -->
    @if($examination->ecg)
    <div class="section">
        <div class="section-title">Electrocardiogram (ECG)</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">ECG Result:</div>
                <div class="info-value">{{ $examination->ecg }}</div>
            </div>
            @if($examination->ecg_date)
                <div class="info-row">
                    <div class="info-label">ECG Date:</div>
                    <div class="info-value">{{ \Carbon\Carbon::parse($examination->ecg_date)->format('F d, Y') }}</div>
                </div>
            @endif
            @if($examination->ecg_technician)
                <div class="info-row">
                    <div class="info-label">Technician:</div>
                    <div class="info-value">{{ $examination->ecg_technician }}</div>
                </div>
            @endif
        </div>
    </div>
    @endif

    <!-- Additional Findings -->
    @if($examination->findings)
    <div class="section">
        <div class="section-title">Additional Findings</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Findings:</div>
                <div class="info-value">{{ $examination->findings }}</div>
            </div>
        </div>
    </div>
    @endif

    <!-- Footer -->
    <div class="footer">
        <p><strong>RSS Citi Health Services</strong></p>
        <p>This is a computer-generated report. No signature is required.</p>
        <p>Report generated on {{ now()->format('F d, Y \a\t h:i A') }}</p>
    </div>
</body>
</html>
