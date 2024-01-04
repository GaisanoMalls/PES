<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<style>
    .form-control {
        color: #333;
        font-size: 5px;
        height: 85px;
        resize: none;

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
    <h2 class="mt-4 mb-4">Recommended Employees</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Employee ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Department</th>
                <th>Position</th>
                <th>Recommendation Count</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employeesWithRecommendations as $employee)
                <tr>
                    <td>{{ $employee->employee_id }}</td>
                    <td>{{ $employee->first_name . ' ' . $employee->last_name }}</td>
                    <td>{{ $employee->last_name }}</td>
                    <td>{{ $employee->department->name }}</td>
                    <td>{{ $employee->position }}</td>
                    <td>{{ $employee->recommendations->count() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
