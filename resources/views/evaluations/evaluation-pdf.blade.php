<!DOCTYPE html>
<html>

<head>
    <style>
        /* Add CSS styles for the PDF here */
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 8px;
        }
    </style>
</head>

<body>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Evaluation Report for {{ $evaluation->employee->name }}</title>
    </head>

    <body>
        <h1>Evaluation Report for {{ $evaluation->employee->name }}</h1>

        <h2>General Information</h2>
        <p>
            <strong>ID:</strong> {{ $evaluation->id }}<br>
            <strong>Employee ID:</strong> {{ $evaluation->employee_id }}<br>
            <strong>Employee Name:</strong> {{ $evaluation->employee->name }}<br>
            <strong>Supervisor ID:</strong> {{ $evaluation->evaluator_id }}<br>
            <strong>Covered Period Start:</strong>
            {{ \Carbon\Carbon::parse($evaluation->covered_period_start)->format('F d, Y') }}<br>
            <strong>Covered Period
                End:</strong>{{ \Carbon\Carbon::parse($evaluation->covered_period_end)->format('F d, Y') }}<br>
            <strong>Date of
                Evaluation:</strong>{{ \Carbon\Carbon::parse($evaluation->date_of_evaluation)->format('F d, Y') }}<br>
        </p>

        <h2>Part 1</h2>
        <p>
            <strong>Excellence Rate:</strong> {{ $evaluation->part1_excellence_rate }}<br>
            <strong>Excellence Comment:</strong> {{ $evaluation->part1_excellence_comment }}<br>
            <strong>Responsibility Rate:</strong> {{ $evaluation->part1_responsibility_rate }}<br>
            <strong>Responsibility Comment:</strong> {{ $evaluation->part1_responsibility_comment }}<br>
            <strong>Synergy Rate:</strong> {{ $evaluation->part1_synergy_rate }}<br>
            <strong>Synergy Comment:</strong> {{ $evaluation->part1_synergy_comment }}<br>
            <strong>Integrity Rate:</strong> {{ $evaluation->part1_integrity_rate }}<br>
            <strong>Integrity Comment:</strong> {{ $evaluation->part1_integrity_comment }}<br>
            <strong>Total Rate:</strong> {{ $evaluation->part1_total_rate }}<br>
        </p>

        <h2>Part 2</h2>
        <p>
            <strong>Dependability Rate:</strong> {{ $evaluation->part2_dependability_rate }}<br>
            <strong>Dependability Comment:</strong> {{ $evaluation->part2_dependability_comment }}<br>
            <strong>Punctuality Rate:</strong> {{ $evaluation->part2_punctuality_rate }}<br>
            <strong>Punctuality Comment:</strong> {{ $evaluation->part2_punctuality_comment }}<br>
            <strong>Interpersonal Rate:</strong> {{ $evaluation->part2_interpersonal_rate }}<br>
            <strong>Interpersonal Comment:</strong> {{ $evaluation->part2_interpersonal_comment }}<br>
            <strong>Creativity Rate:</strong> {{ $evaluation->part2_creativity_rate }}<br>
            <strong>Creativity Comment:</strong> {{ $evaluation->part2_creativity_comment }}<br>
            <strong>Learning Rate:</strong> {{ $evaluation->part2_learning_rate }}<br>
            <strong>Learning Comment:</strong> {{ $evaluation->part2_learning_comment }}<br>
            <strong>Total Rate:</strong> {{ $evaluation->part2_total_rate }}<br>
        </p>

        <h2>Part 3</h2>
        <p>
            <strong>Respect Rate:</strong> {{ $evaluation->part3_respect_rate }}<br>
            <strong>Respect Comment:</strong> {{ $evaluation->part3_respect_comment }}<br>
            <strong>Responsibility Rate:</strong> {{ $evaluation->part3_responsibility_rate }}<br>
            <strong>Responsibility Comment:</strong> {{ $evaluation->part3_responsibility_comment }}<br>
            <strong>Integrity Rate:</strong> {{ $evaluation->part3_integrity_rate }}<br>
            <strong>Integrity Comment:</strong> {{ $evaluation->part3_integrity_comment }}<br>
            <strong>Teamwork Rate:</strong> {{ $evaluation->part3_teamwork_rate }}<br>
            <strong>Teamwork Comment:</strong> {{ $evaluation->part3_teamwork_comment }}<br>
            <strong>Excellence Rate:</strong> {{ $evaluation->part3_excellence_rate }}<br>
            <strong>Excellence Comment:</strong> {{ $evaluation->part3_excellence_comment }}<br>
            <strong>Total Rate:</strong> {{ $evaluation->part3_total_rate }}<br>
        </p>

        <h2>Summary</h2>
        <p>
            <strong>Total Rate:</strong> {{ $evaluation->total_rate }}<br>
            <strong>Passing Rate:</strong> {{ $evaluation->passing_rate }}<br>
            <strong>Ratee Performance Level:</strong> {{ $evaluation->ratee_performance_level }}<br>
            <strong>Remarks:</strong> {{ $evaluation->remarks }}<br>
            <strong>Evaluator Name:</strong> {{ $evaluation->evaluator_name }}<br>
            <strong>Reviewer Name:</strong> {{ $evaluation->reviewer_name }}<br>
            <strong>Recommendations:</strong> {{ $evaluation->recommendations }}<br>
            <strong>Ratee Comments:</strong> {{ $evaluation->ratee_comments }}<br>
        </p>
    </body>

    </html>


</body>

</html>
