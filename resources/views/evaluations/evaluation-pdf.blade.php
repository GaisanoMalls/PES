<head>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/feathericon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/morris/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>

<body>
    <div>
        <h4 class="text-center">DSG Sons Group Inc.</h4>
        <span class="text-center">J.P Laurel Ave., Davao City</span>
        <h1 class="text-center">{{ $evaluation->evaluationTemplate->name }}</h1>


        <span>Name of Employee: <strong><u>
                    {{ $evaluation->employee->first_name . ' ' . $evaluation->employee->last_name }}</u></span></strong><br>
        <span>Department/Section: <u> {{ $evaluation->employee->department->name }}</u></span><br>
        <span>Position: <u> {{ $evaluation->employee->position }}</u></span><br>
        <span>Date Hired: <u>{{ $evaluation->employee->date_hired }}</u></span><br>
        <span>Date of Evaluation: <u>{{ $evaluation->created_at }}</u> </span><br>

    </div>



</body>

</html>
