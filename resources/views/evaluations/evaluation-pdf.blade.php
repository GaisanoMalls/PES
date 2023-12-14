<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<style>
    .form-control {
        color: #333;
        font-size: 5px;
        height: 85px;
        resize: none;
        /* Prevent resizing of the textarea */
    }








    .input-group .form-control {
        height: 65px
    }



    .material-icons {
        font-family: material icons;
        font-weight: 400;
        font-style: normal;
        font-size: 24px;
        display: inline-block;
        line-height: 1;
        text-transform: none;
        letter-spacing: normal;
        word-wrap: normal;
        white-space: nowrap;
        direction: ltr;
        -webkit-font-smoothing: antialiased;
        text-rendering: optimizeLegibility;
        -moz-osx-font-smoothing: grayscale;
        font-feature-settings: 'liga'
    }

    .font-weight-600 {
        font-weight: 600
    }





    div.c {
        text-align: right;
    }

    .left {
        text-align: left;
    }


    .p-20 {
        padding: 20px !important
    }

    .p-t-0 {
        padding-top: 0 !important
    }

    .m-0 {
        margin: 0 !important
    }

    .m-r-5 {
        margin-right: 5px !important
    }

    .m-r-10 {
        margin-right: 10px !important
    }

    .m-r-15 {
        margin-right: 10px !important
    }

    .m-l-5 {
        margin-left: 5px !important
    }

    .m-l-15 {
        margin-left: 15px !important
    }

    .m-l-90 {
        margin-left: 180px !important
    }

    .m-l-100 {
        margin-left: 100px !important
    }

    .m-t-3 {
        margin-top: 3px !important
    }

    .m-t-5 {
        margin-top: 5px !important
    }

    .m-t-0 {
        margin-top: 0 !important
    }

    .m-t-10 {
        margin-top: 10px !important
    }

    .m-t-15 {
        margin-top: 15px !important
    }

    .m-t-20 {
        margin-top: 20px !important
    }

    .m-t-30 {
        margin-top: 30px !important
    }

    .m-t-50 {
        margin-top: 50px !important
    }

    .m-b-5 {
        margin-bottom: 5px !important
    }

    .m-b-10 {
        margin-bottom: 10px !important
    }

    .m-b-15 {
        margin-bottom: 15px !important
    }

    .m-b-20 {
        margin-bottom: 20px !important
    }

    .m-b-30 {
        margin-bottom: 30px !important
    }



    .bg-white {
        background-color: #fff;
        padding-top: 20px;
        padding-right: 70px;
    }

    .bg-white2 {
        background-color: #fff;
        padding-top: 30px;
        padding-right: 70px;
    }



    .bg-info-light {
        background-color: #1363ad(2, 182, 179, .12) !important;
        color: #1A8DF8 !important
    }

    .bg-warning-pending {
        background-color: rgba(255, 152, 0, .12) !important;
        color: #228AA6 !important
    }

    .bg-primary-light {
        background-color: rgba(17, 148, 247, .12) !important;
        color: #2196f3 !important
    }

    .bg-danger-light {
        background-color: rgba(242, 17, 54, .12) !important;
        color: #e63c3c !important
    }

    .bg-warning-light {
        background-color: rgba(255, 152, 0, .12) !important;
        color: #f39c12 !important
    }

    .bg-success-light {
        background-color: rgba(15, 183, 107, .12) !important;
        color: #26af48 !important
    }

    .bg-purple-light {
        background-color: rgba(197, 128, 255, .12) !important;
        color: #c580ff !important
    }

    .bg-default-light {
        background-color: rgba(40, 52, 71, .12) !important;
        color: #283447 !important
    }






    .rating-scale {
        margin: 20px 0;
        border-bottom: 2px solid #ddd;
        /* Add a bottom border with color #ddd */

    }

    .rating-scale-item {
        margin-bottom: 10px;
    }

    .rating-scale-label {
        font-weight: bold;
    }

    .rating-scale-description {
        margin-left: 5px;
    }

    .radio-inline {
        display: inline-block;
        text-align: center;
        width: 12%;
        margin-right: 5px;
        border: 1px solid transparent;
        /* Add a border to all labels */
    }

    .points-rate-label {
        width: 12%;
    }

    .box {
        border: 1px solid #6c757d;
        /* Use Bootstrap's gray color (border-secondary) */
        padding: 5px;
        display: inline-block;
        width: 40px;
        /* Set a fixed width for the box */
        height: 40px;
        /* Set a fixed height for the box */
        text-align: center;
        line-height: 25px;
        vertical-align: middle;
        /* Center text vertically */
        border-radius: 5px;
    }


    .comment {
        margin-top: -25px;
    }

    .row {
        margin-top: 2rem;
    }

    .custom-checkbox {
        width: 20px;
        /* Set the width as per your requirements */
        height: 20px;
        /* Set the height as per your requirements */
    }

    .swal2-actions {
        display: flex;
        justify-content: space-between;
    }

    .swal2-actions button {
        margin-right: 10px;
    }





    .percentage {
        display: block;
    }


    .text-black {
        color: #000;
    }



    .containerflex {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        /* You can adjust this value based on your layout requirements */
    }

    textarea {

        width: 70%;
        /* Ensures the textarea takes the full width within the container */
    }

    .form-group {
        margin-bottom: 1rem;
    }

    /* Bootstrap-like styling for textarea */
    .form-control {
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1;
        border-color: #6c757d;

    }

    .center-text {
        text-align: center;
    }

    .text-center {
        text-align: center;
    }

    .page-break {
        page-break-before: always;
    }

    .container22 {
        display: flex;
        justify-content: flex-end;
        align-items: flex-end;
        /* Align items to the right side */
    }

    .border-side {
        border: 2px solid #383838;
        padding: 15px;
        border-style: double;
    }
</style>
<div class="m-t-30">
    <div>

        <div class="container22 text-right">
            @if ($evaluation->status === 2)
                <a href="#" class="btn btn-lg bg-success-light mb-2" style="cursor: default;">Approved
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                        class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                        <polyline points="22 4 12 14.01 9 11.01" />
                    </svg>

                </a>
            @elseif ($evaluation->status === 3)
                <a href="#" class="btn btn-lg bg-danger-light mb-2" style="cursor: default;">Disapproved
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                        class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="15" x2="9" y1="9" y2="15" />
                        <line x1="9" x2="15" y1="9" y2="15" />
                    </svg>

                </a>
            @elseif ($evaluation->status === 4)
                <a href="#" class="btn btn-lg bg-warning-light mb-2" style="cursor: default;">Clarifcations
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                        class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" x2="12" y1="8" y2="12" />
                        <line x1="12" x2="12.01" y1="16" y2="16" />
                    </svg>
                </a>
            @elseif ($evaluation->status === 1)
                <a href="#" class="btn btn-lg bg-warning-pending  mb-2" style="cursor: default;">Pending
                    <!-- https://feathericons.dev/?search=clock&iconset=feather -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                        class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 16 14" />
                    </svg>

                </a>
            @else
            @endif
        </div>
        <div class="bg-white2sdsd">
            <h3 class="text-center"><strong>DSG Sons Group Inc.</strong></h4>
                <h5 class="text-center">J.P Laurel Ave., Davao City</h5>
                <h2 class="text-center"><strong>{{ $evaluation->evaluationTemplate->name }}</strong></h2>
                <div class="employee-details">

                    <div class="row">
                        <div class="col-4">
                            <label for="department">Department</label>
                            <input type="text" class="form-control" id="department" name="department"
                                placeholder="Enter Department/Section"
                                value="{{ $evaluation->employee->department->name }}" style="height: 45px !important;">
                        </div>
                        <div class="col-4">
                            <label for="employee_id">Employee ID</label>
                            <input type="text" class="form-control" id="employee_id" name="employee_id"
                                placeholder="Enter Employee ID" value="{{ $evaluation->employee->employee_id }}"
                                style="height: 45px !important;">
                        </div>
                        <div class="col-4">
                            <label for="first_name">Employee Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                placeholder="Enter Employee Name"
                                value="{{ $evaluation->employee->first_name . ' ' . $evaluation->employee->last_name }}"
                                style="height: 45px !important;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="position">Position</label>
                            <input type="text" class="form-control" id="position" name="position"
                                placeholder="Enter Position" value="{{ $evaluation->employee->position }}"
                                style="height: 45px !important;">
                        </div>
                        <div class="col-4">
                            <label for="covered_period_start">Join Date</label>
                            <input class="form-control" type="date" id="covered_period_start"
                                name="covered_period_start" value="{{ $evaluation->employee->date_hired }}"
                                style="height: 45px !important;">
                        </div>
                        <div class="col-4">
                            <label for="created_at">Date of Evaluation</label>
                            <input class="form-control" type="text" id="created_at" name="created_at"
                                value="{{ $evaluation->created_at }}" style="height: 45px !important;">
                        </div>
                    </div>
                </div>
        </div>


        <div class="rating-scale"></div>

        <span>Direction: Rate the following factors by checking the appropriate box which
            indicates the most accurate appraisal of the ratee’s performance on the job.
            The rating scale are outlined below:
        </span>

        @foreach ($ratingScales as $scale)
            <div class="rating-scale-item">

                <strong> <span class="rating-scale-acronym">{{ $scale->acronym }}=</span>
                    <span class="rating-scale-name"> {{ $scale->name }}:</span></strong>
                <span class="rating-scale-description">{{ $scale->description }}</span>
            </div>
        @endforeach

        @foreach ($partsWithFactors as $index => $partWithFactors)
            <div class="rating-scale"></div>
            <h4 class="text-center">{{ $partWithFactors['part']->name }}</h4>

            @php $factorCount = 0; @endphp

            @foreach ($partWithFactors['factors'] as $factorData)
                {{-- Only display 2 factors on the first loop --}}
                @if ($loop->parent->first && $factorCount < 2)
                    <li style="list-style: none;">
                        <div class="row">
                            {{-- FACTOR RIGHT SIDE --}}
                            <div class="col-6 text-left">
                                @if ($loop->first)
                                    <h5 class="m-l-90 m-b-30">
                                        Factors</h5>
                                @endif
                                <h5>{{ $factorData['factor']->name }}</h5>
                                <p>{{ $factorData['factor']->description }}</p>
                            </div>
                            {{-- FACTOR LEFT SIDE --}}
                            <div class="col-6 text-center">
                                <label class="radio-inline">
                                    @if ($loop->first)
                                        <span>Allotted<br><br></span>
                                    @endif
                                    <span
                                        class="box">{{ $factorData['rating_scales']->max('equivalent_points') }}%</span>
                                </label>
                                {{-- DISPLAY THE FACTOR RATING SCALES --}}
                                @foreach ($factorData['rating_scales'] as $key => $ratingScale)
                                    <label class="radio-inline">
                                        {{ $ratingScale->acronym }}<br>
                                        {{ $ratingScale->equivalent_points }}

                                        <br>
                                        <input disabled class="custom-radio" type="radio"
                                            name="rating_{{ $ratingScale->factor_id }}"
                                            value="{{ $ratingScale->equivalent_points }}"
                                            @if ($key === $factorData['ratingScaleId'] - 1) checked @endif>
                                    </label>
                                @endforeach
                                <label class="radio-inline">
                                    @if ($loop->parent->first && $loop->first)
                                        <span>POINTS<br><br>
                                    @endif
                                    <span id="points-{{ $factorData['factor']->id }}" class="box">
                                        {{ $factorData['points'] }}
                                    </span>
                                </label>
                                {{-- DISPLAY THE COMMENT OF FACTOR --}}
                                <div class="comment m-t-3">
                                    <div class="form-group">
                                        <label for="">Specific situations/incidents to support rating:</label>
                                        <textarea class="form-control" style="overflow: hidden;">{{ $factorData['note'] }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @php $factorCount++; @endphp
                @endif
            @endforeach

            {{-- Add page-break after displaying 2 factors on the first loop --}}
            @if ($loop->first)
                <div class="page-break"></div>
            @endif

            {{-- Continue with the remaining factors --}}
            @foreach ($partWithFactors['factors'] as $factorData)
                {{-- Skip the factors already displayed --}}
                @if ($loop->parent->first && $factorCount > 0)
                    @php
                        $factorCount--;
                        continue;
                    @endphp
                @endif
                {{-- Skip the second factor on the second page --}}
                @if (!$loop->parent->first && $factorCount === 1)
                    @php
                        $factorCount--;
                        continue;
                    @endphp
                @endif
                {{-- Display the remaining factors --}}
                <li style="list-style: none;">
                    <div class="row">
                        {{-- FACTOR RIGHT SIDE --}}
                        <div class="col-6 text-left">
                            @if ($loop->first)
                                <h5 class="m-l-90 m-b-30">
                                    Factors</h5>
                            @endif
                            <h5>{{ $factorData['factor']->name }}</h5>
                            <p>{{ $factorData['factor']->description }}</p>
                        </div>

                        {{-- FACTOR LEFT SIDE --}}
                        <div class="col-6 text-center">
                            <label class="radio-inline">
                                @if ($loop->first)
                                    <span>Allotted<br><br></span>
                                @endif
                                <span
                                    class="box">{{ $factorData['rating_scales']->max('equivalent_points') }}%</span>
                            </label>
                            {{-- DISPLAY THE FACTOR RATING SCALES --}}
                            @foreach ($factorData['rating_scales'] as $key => $ratingScale)
                                <label class="radio-inline">
                                    {{ $ratingScale->acronym }}<br>
                                    {{ $ratingScale->equivalent_points }}

                                    <br>
                                    <input disabled class="custom-radio" type="radio"
                                        name="rating_{{ $ratingScale->factor_id }}"
                                        value="{{ $ratingScale->equivalent_points }}"
                                        @if ($key === $factorData['ratingScaleId'] - 1) checked @endif>
                                </label>
                            @endforeach
                            <label class="radio-inline">
                                @if ($loop->parent->first && $loop->first)
                                    <span>POINTS<br><br>
                                @endif
                                <span id="points-{{ $factorData['factor']->id }}" class="box">
                                    {{ $factorData['points'] }}
                                </span>
                            </label>
                            {{-- DISPLAY THE COMMENT OF FACTOR --}}
                            <div class="comment m-t-3">
                                <div class="form-group">
                                    <label for="">Specific situations/incidents to support rating:</label>
                                    <textarea class="form-control" style="overflow: hidden;">{{ $factorData['note'] }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach

            <div class="c m-t-20 m-r-15">
                <strong>
                    <span>Total Actual Points/Rate = <span
                            class="box">{{ $partWithFactors['totalRate'] }}</span></span>
                </strong>
            </div>

            <div class="page-break"></div>
        @endforeach


        <div class="page-break"></div>


        {{-- START OF RATING SUMMARY TABLE --}}
        <div class="text-center">
            <h3>RATING SUMMARY</h3>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Performance Measurement</th>
                    <th>Criteria</th>
                    <th>Total Actual Points/Rate</th>
                    <th>Passing Points/Rate</th>
                    <th>Ratee's Performance Level</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($partsWithFactors as $index => $partWithFactors)
                    <tr>
                        <td>{{ $partWithFactors['part']->name }}</td>
                        <td>{{ $partWithFactors['part']->criteria_allocation }}%</td>
                        <td class="text-center">{{ $partWithFactors['totalRate'] }}</td>
                        @if ($loop->first)
                            <td style="text-align: center; vertical-align: middle" rowspan="4">80%</td>
                            <td rowspan="5">

                                @foreach ($ratingScales as $scale)
                                    @if ($scale['name'] == 'Outstanding')
                                        @if ($totalRateForAllParts >= 95)
                                            <strong> 95-100% {{ $scale['name'] }}</strong>
                                        @else
                                            95-100% {{ $scale['name'] }}
                                        @endif
                                        <br>
                                    @elseif ($scale['name'] == 'High Average')
                                        @if ($totalRateForAllParts >= 90 && $totalRateForAllParts <= 94)
                                            <strong>90-94% {{ $scale['name'] }}</strong>
                                        @else
                                            90-94% {{ $scale['name'] }}
                                        @endif
                                        <br>
                                    @elseif ($scale['name'] == 'Average')
                                        @if ($totalRateForAllParts >= 80 && $totalRateForAllParts <= 89)
                                            <strong>80-89% {{ $scale['name'] }}</strong>
                                        @else
                                            80-89% {{ $scale['name'] }}
                                        @endif
                                        <br>
                                    @elseif ($scale['name'] == 'Satisfactory')
                                        @if ($totalRateForAllParts >= 70 && $totalRateForAllParts <= 79)
                                            <strong>70-79% {{ $scale['name'] }}</strong>
                                        @else
                                            70-79% {{ $scale['name'] }}
                                        @endif
                                        <br>
                                    @elseif ($scale['name'] == 'Poor')
                                        @if ($totalRateForAllParts <= 69)
                                            <strong> 69% & below {{ $scale['name'] }}</strong>
                                        @else
                                            69% & below {{ $scale['name'] }}
                                        @endif
                                    @endif
                                @endforeach

                            </td>
                        @endif
                        <td>
                            @if ($loop->iteration == 1)
                                @if ($totalRateForAllParts >= 80)
                                    <a class="btn btn-sm bg-success-light mr-2"><strong>Passed</strong></a>
                                @else
                                    Passed
                                @endif
                            @elseif ($loop->iteration == 2)
                                @if ($totalRateForAllParts < 80)
                                    <a class="btn btn-sm bg-danger-light mr-2"><strong>Failed</strong></a>
                                @else
                                    Failed
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td>Total</td>
                    <td>100%</td>
                    <td class="text-center"><strong>{{ $totalRateForAllParts }}</strong></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        {{-- END OF RATING SUMMARY TABLE --}}

        {{-- EVALUATORS OR APPROVERS INPUTS --}}
        <div class="bg-white22">
            <div class="row">
                <div class="col-md-6">
                    <label class="col-lg-2">RATED BY: </label>
                    <a href="#" class="btn btn-m bg-success-light mb-2 strong-text"
                        style="cursor: default; width: 300px;">{{ $evaluation->evaluatorEmployee->first_name . ' ' . $evaluation->evaluatorEmployee->last_name }}
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                            class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                            <polyline points="22 4 12 14.01 9 11.01" />
                        </svg>
                    </a>
                    <p class="m-l-15">
                        {{ $evaluation->evaluatorEmployee->department->name . ' - ' . $evaluation->evaluatorEmployee->position }}
                    </p>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <label class="col-lg-2">REVIEWED BY: </label>
                    @if ($evaluation->approver_id)
                        <a href="#"
                            @if ($evaluation->status == 2) class="btn btn-m bg-success-light mb-2 strong-text"
                                   @elseif ($evaluation->status == 3)
                                   class="btn btn-lg bg-danger-light mb-2 strong-text"   @else class="btn btn-lg bg-warning-light mb-2 strong-text" @endif
                            style="cursor: default; width: 300px;">{{ $evaluation->approverEmployee->first_name . ' ' . $evaluation->approverEmployee->last_name }}
                            @if ($evaluation->status == 2)
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                    height="24" class="main-grid-item-icon" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                    <polyline points="22 4 12 14.01 9 11.01" />
                                </svg>
                            @elseif ($evaluation->status == 3)
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                    height="24" class="main-grid-item-icon" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                    <circle cx="12" cy="12" r="10" />
                                    <line x1="15" x2="9" y1="9" y2="15" />
                                    <line x1="9" x2="15" y1="9" y2="15" />
                                </svg>
                            @elseif ($evaluation->status == 4)
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                    height="24" class="main-grid-item-icon" fill="none" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                    <circle cx="12" cy="12" r="10" />
                                    <line x1="12" x2="12" y1="8" y2="12" />
                                    <line x1="12" x2="12.01" y1="16" y2="16" />
                                </svg>
                            @endif
                        </a>
                    @else
                        <a href="#" class="btn btn-m bg-warning-pending mb-2 text-center strong-text"
                            style="cursor: default; width: 300px;">PENDING REVIEW
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                height="24" class="main-grid-item-icon" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                        </a>
                    @endif
                    <p class="m-l-15">
                        @if ($evaluation->approver_id)
                            {{ $evaluation->approverEmployee->department->name . ' - ' . $evaluation->approverEmployee->position }}
                        @else
                            APPROVER
                        @endif
                    </p>
                </div>

            </div>
        </div>
        <div class="m-t-50">
            <div class="comment">
                <div class="form-group">
                    <label for="recommendations">RECOMMENDATION:</label>
                    <textarea name="recommendations" id="recommendations" class="form-control" style="height: 150px; overflow: hidden;">{{ $evaluation->recommendation_note }}</textarea>
                </div>
            </div>
        </div>
        {{-- END EVALUATORS OR APPROVERS INPUTS --}}

        {{-- EMPLOYEE INPUTS --}}
        <div class="bg-white22">
            <div class="row">
                <div class="col-md-6">
                    <label class="col-lg-2">READ: </label>
                    @if ($evaluation->ratees_comment == null)
                        <a class="btn btn-m bg-warning-pending mb-2 strong-text"
                            style="cursor: default;  width: 300px;">{{ $evaluation->employee->first_name . ' ' . $evaluation->employee->last_name }}
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                height="24" class="main-grid-item-icon" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg>
                        </a>
                        <p class="m-l-15">
                            NAME OF EMPLOYEE
                        </p>
                    @else
                        <a href="#" class="btn btn-lg bg-success-light mb-2 text-center strong-text"
                            style="cursor: default;">{{ $evaluation->employee->first_name . ' ' . $evaluation->employee->last_name }}
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                height="24" class="main-grid-item-icon" fill="none" stroke="currentColor"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                <polyline points="22 4 12 14.01 9 11.01" />
                            </svg>
                        </a>
                        <p class="m-l-15">
                            {{ $evaluation->employee->department->name . ' - ' . $evaluation->employee->position }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
        <div class="m-t-50">
            <div class="comment">
                <div class="form-group">
                    <label for="ratee_comments">RATEES COMMENTS:</label>
                    <textarea name="ratee_comments" id="ratee_comments" class="form-control" style="height: 150px; overflow: hidden;">{{ $evaluation->ratees_comment }}</textarea>
                </div>
            </div>
        </div>
        {{-- END OF EMPLOYEE INPUTS --}}


        @if ($evaluation->recommendation)
            <div class="page-break"></div>
            <div class="m-t-10">
                <h4 class="text-center">Recommendation</h4>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="current_salary">Current Salary:</label>
                            <input type="number" class="form-control" wire:model="currentSalary"
                                value="{{ $evaluation->recommendation->current_salary }}"
                                style="height: 45px !important;">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="recommended_position">Recommended Position:</label>
                            <input type="text" class="form-control" wire:model="recommendedPosition"
                                value="{{ $evaluation->recommendation->recommended_position }}"
                                style="height: 45px !important;">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="level">Level:</label>
                            <input type="text" class="form-control" wire:model="level"
                                value="{{ $evaluation->recommendation->level }}" style="height: 45px !important;">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="recommended_salary">Recommended Salary:</label>
                            <input type="number" class="form-control" wire:model="recommendedSalary"
                                value="{{ $evaluation->recommendation->recommended_salary }}"
                                style="height: 45px !important;">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="recommended_salary">Percentage Increase:</label>
                            <input type="number" class="form-control" wire:model="recommendedSalary"
                                value="{{ $evaluation->recommendation->percentage_increase }}"
                                style="height: 45px !important;">
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group">
                            <label for="effectivity_timestamp">Effectivity Timestamp:</label>
                            <input type="datetime-local" class="form-control" wire:model="effectivityTimestamp"
                                value="{{ $evaluation->recommendation->effectivity }}"
                                style="height: 45px !important;">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="remarks">Remarks:</label>
                            <textarea name="remarks" id="remarks" class="form-control" wire:model="remarks"
                                style="height: 150px; overflow: hidden;">{{ $evaluation->recommendation->remarks }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
