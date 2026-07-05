<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pre-Employment Medical Results - {{ $examination->name }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 12px;
            line-height: 1.5;
            color: #2d3748;
            margin: 0;
            padding: 20px;
            background: #f8fafc;
        }
        .header {
            text-align: center;
            background: #000000;
            color: white;
            padding: 30px 20px;
            margin: -20px -20px 30px -20px;
            border-radius: 0 0 15px 15px;
        }
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: white;
            margin-bottom: 10px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }
        .company-info {
            font-size: 16px;
            color: rgba(255,255,255,0.9);
            font-weight: 500;
        }
        .patient-info {
            background: white;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-left: 4px solid #3b82f6;
        }
        .section {
            background: white;
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            page-break-inside: avoid;
        }
        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #2d3748;
            border-bottom: 2px solid #3b82f6;
            padding-bottom: 8px;
            margin: -20px -20px 20px -20px;
            padding-left: 20px;
            padding-right: 20px;
            background: #f7fafc;
            margin-top: -20px;
            border-radius: 12px 12px 0 0;
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
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .findings-table th,
        .findings-table td {
            border: 1px solid #e2e8f0;
            padding: 12px 15px;
            text-align: left;
        }
        .findings-table th {
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
        }
        .findings-table tr:nth-child(even) {
            background: #f8fafc;
        }
        .findings-table tr:hover {
            background: #edf2f7;
        }
        .normal {
            color: #16a34a;
            font-weight: 600;
            background: #f0fdf4;
            padding: 4px 8px;
            border-radius: 4px;
            border: 1px solid #bbf7d0;
        }
        .abnormal {
            color: #dc2626;
            font-weight: 600;
            background: #fef2f2;
            padding: 4px 8px;
            border-radius: 4px;
            border: 1px solid #fecaca;
        }
        .drug-test-highlight {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            border: 2px solid #f59e0b;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .drug-test-title {
            color: #92400e;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 15px;
            text-align: center;
        }
        .footer {
            margin-top: 40px;
            padding: 25px 20px;
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
            color: white;
            text-align: center;
            font-size: 11px;
            border-radius: 12px;
            margin-left: -20px;
            margin-right: -20px;
        }
        .footer p {
            margin: 5px 0;
        }
        .footer strong {
            font-size: 13px;
        }
        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="logo">RSS Citi Health Services</div>
        <div class="company-info">
            <strong>Pre-Employment Medical Examination Report</strong><br>
            <div style="margin-top: 8px; font-size: 14px; opacity: 0.8;">
                Generated on {{ now()->format('F d, Y \a\t h:i A') }}
            </div>
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
                <div class="info-label">Company:</div>
                <div class="info-value">{{ $examination->company_name }}</div>
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
                            <div class="info-label">
                                @if(is_numeric($condition))
                                    Condition:
                                @else
                                    {{ ucfirst(str_replace('_', ' ', $condition)) }}:
                                @endif
                            </div>
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
        // Get drug test results from multiple sources
        $drugTestResults = [];
        $drugTestInfo = null;
        
        // First, check the drugTestResults relationship (most reliable source)
        if ($examination->drugTestResults && $examination->drugTestResults->count() > 0) {
            $drugTestRecord = $examination->drugTestResults->first();
            $drugTestInfo = $drugTestRecord;
            
            if (!empty($drugTestRecord->methamphetamine_result)) {
                $drugTestResults['Methamphetamine'] = [
                    'result' => $drugTestRecord->methamphetamine_result,
                    'remarks' => $drugTestRecord->methamphetamine_remarks
                ];
            }
            if (!empty($drugTestRecord->marijuana_result)) {
                $drugTestResults['Marijuana'] = [
                    'result' => $drugTestRecord->marijuana_result,
                    'remarks' => $drugTestRecord->marijuana_remarks
                ];
            }
        }
        
        // Fallback: Check lab_report field
        if (empty($drugTestResults) && is_array($labReport)) {
            if (isset($labReport['methamphetamine_result']) && !empty($labReport['methamphetamine_result'])) {
                $drugTestResults['Methamphetamine'] = ['result' => $labReport['methamphetamine_result'], 'remarks' => ''];
            }
            if (isset($labReport['marijuana_result']) && !empty($labReport['marijuana_result'])) {
                $drugTestResults['Marijuana'] = ['result' => $labReport['marijuana_result'], 'remarks' => ''];
            }
        }
        
        // Final fallback: Check drug_test field
        if (empty($drugTestResults)) {
            $drugTest = is_array($examination->drug_test) ? $examination->drug_test : json_decode($examination->drug_test, true);
            if (is_array($drugTest)) {
                if (isset($drugTest['methamphetamine_result']) && !empty($drugTest['methamphetamine_result'])) {
                    $drugTestResults['Methamphetamine'] = ['result' => $drugTest['methamphetamine_result'], 'remarks' => ''];
                }
                if (isset($drugTest['marijuana_result']) && !empty($drugTest['marijuana_result'])) {
                    $drugTestResults['Marijuana'] = ['result' => $drugTest['marijuana_result'], 'remarks' => ''];
                }
            }
        }
    @endphp
    
    @if(!empty($drugTestResults))
    <div class="drug-test-highlight">
        <div class="drug-test-title">Drug Test Results</div>
        
        @if($drugTestInfo)
        <div style="background: white; padding: 15px; border-radius: 8px; margin-bottom: 15px; border: 1px solid #d69e2e;">
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-label">Test Date:</div>
                    <div class="info-value">{{ $drugTestInfo->examination_datetime ? \Carbon\Carbon::parse($drugTestInfo->examination_datetime)->format('F d, Y \\a\\t h:i A') : 'N/A' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Test Method:</div>
                    <div class="info-value">{{ $drugTestInfo->test_method ?? 'N/A' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Conducted By:</div>
                    <div class="info-value">{{ $drugTestInfo->test_conducted_by ?? 'N/A' }}</div>
                </div>
            </div>
        </div>
        @endif
        
        <table class="findings-table">
            <thead>
                <tr>
                    <th>Substance Tested</th>
                    <th>Result</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                @foreach($drugTestResults as $substance => $data)
                    <tr>
                        <td style="font-weight: 600;">{{ $substance }}</td>
                        <td class="{{ strtolower($data['result']) === 'negative' ? 'normal' : 'abnormal' }}">
                            {{ $data['result'] }}
                        </td>
                        <td>{{ $data['remarks'] ?: '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        @php
            $hasPositive = collect($drugTestResults)->pluck('result')->contains(function($result) {
                return strtolower($result) === 'positive';
            });
        @endphp
        
        <div style="text-align: center; margin-top: 15px; padding: 10px; background: {{ $hasPositive ? '#fef2f2' : '#f0fdf4' }}; border-radius: 6px; border: 1px solid {{ $hasPositive ? '#fecaca' : '#bbf7d0' }};">
            <strong style="color: {{ $hasPositive ? '#dc2626' : '#16a34a' }};">
                Overall Result: {{ $hasPositive ? 'POSITIVE - Further evaluation required' : 'NEGATIVE - No substances detected' }}
            </strong>
        </div>
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
        <p style="margin: 10px 0; opacity: 0.9;">Professional Medical Examination Services</p>
        <p style="font-size: 10px; opacity: 0.8;">This is a computer-generated report. No signature is required.</p>
        <p style="font-size: 10px; opacity: 0.8;">Report generated on {{ now()->format('F d, Y \a\t h:i A') }}</p>
        <p style="margin-top: 10px; font-size: 10px; opacity: 0.7;"> {{ now()->year }} RSS Citi Health Services. All rights reserved.</p>
    </div>
</body>
</html>
