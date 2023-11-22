<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    html {
        height: 100%
    }

    body {
        color: #2a2a2a;
        font-size: 1rem;
        height: 100%;
        line-height: 1.5;
        overflow-x: hidden
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: rubik, sans-serif;
        margin-top: 0
    }

    a:hover,
    a:active,
    a:focus {
        outline: none;
        text-decoration: none
    }

    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus {
        -webkit-box-shadow: 0 0 0 1000px #fff inset !important
    }

    .form-control {
        color: #333;
        font-size: 15px;
        height: 40px
    }

    .form-control:focus {
        border-color: #6675e9;
        box-shadow: none;
        outline: 0
    }

    .form-control.form-control-sm {
        height: calc(1.5em + .5rem + 2px)
    }

    .form-control.form-control-lg {
        height: calc(1.5em + 1rem + 2px)
    }

    a {
        color: #009ce7
    }

    input,
    button,
    a {
        transition: all .4s ease;
        -moz-transition: all .4s ease;
        -o-transition: all .4s ease;
        -ms-transition: all .4s ease;
        -webkit-transition: all .4s ease
    }

    input,
    input:focus,
    button,
    button:focus {
        outline: none
    }

    input[type=file] {
        height: auto;
        min-height: calc(1.5em + .75rem + 2px)
    }

    input[type=text],
    input[type=password] {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none
    }

    textarea.form-control {
        resize: vertical
    }

    .navbar-nav>li {
        float: left
    }

    .form-group {
        margin-bottom: 10px;
    }

    .input-group .form-control {
        height: 40px
    }

    .nav .open>a,
    .nav .open>a:focus,
    .nav .open>a:hover {
        background-color: rgba(0, 0, 0, .1);
        border-color: rgba(0, 0, 0, .1)
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

    .table {
        color: #555;
        max-width: 100%;
        margin-bottom: 0;
        width: 100%;
        font-size: 15px
    }

    .table-striped>tbody>tr:nth-of-type(2n+1) {
        background-color: #f8f9fa
    }

    .table.no-border>tbody>tr>td,
    .table>tbody>tr>th,
    .table.no-border>tfoot>tr>td,
    .table.no-border>tfoot>tr>th,
    .table.no-border>thead>tr>td,
    .table.no-border>thead>tr>th {
        border-top: 0;
        padding: 10px 8px
    }

    .table-nowrap td,
    .table-nowrap th {
        white-space: nowrap
    }

    .table.dataTable {
        border-collapse: collapse !important
    }

    table.table td h2 {
        display: inline-block;
        font-size: inherit;
        font-weight: 400;
        margin: 0;
        padding: 0;
        vertical-align: middle
    }

    table.table td h2.table-avatar {
        align-items: center;
        display: inline-flex;
        font-size: inherit;
        font-weight: 400;
        margin: 0;
        padding: 0;
        vertical-align: middle;
        white-space: nowrap
    }

    table.table td h2 a {
        color: #333
    }

    table.table td h2 a:hover {
        color: #2962ff
    }

    table.table td h2 span {
        color: #888;
        display: block;
        font-size: 12px;
        margin-top: 3px
    }

    .table thead {
        background-color: #f9fbfd;
        border-bottom: 1px solid rgba(0, 0, 0, .03)
    }

    .table thead tr th {
        font-weight: 700;
        border: 0
    }

    .table tbody tr {
        border-bottom: 1px solid rgba(0, 0, 0, .05)
    }

    .table tbody tr:last-child {
        border-color: transparent
    }

    .table.table-center td,
    .table.table-center th {
        vertical-align: middle
    }

    .table-hover tbody tr:hover {
        background-color: #f7f7f7
    }

    .table-hover tbody tr:hover td {
        color: #474648
    }

    .table-striped thead tr {
        border-color: transparent
    }

    .table-striped tbody tr {
        border-color: transparent
    }

    .table-striped tbody tr:nth-of-type(even) {
        background-color: rgba(255, 255, 255, .3)
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(235, 235, 235, .4)
    }

    .table-bordered {
        border: 1px solid rgba(0, 0, 0, .05) !important
    }

    .table-bordered th,
    .table-bordered td {
        border-color: rgba(0, 0, 0, .05)
    }

    .card-table .card-body {
        padding: 0
    }

    .card-table .card-body .table>thead>tr>th {
        border-top: 0
    }

    .card-table .card-body .table tr td:first-child,
    .card-table .card-body .table tr th:first-child {
        padding-left: 1.5rem
    }

    .card-table .card-body .table tr td:last-child,
    .card-table .card-body .table tr th:last-child {
        padding-right: 1.5rem
    }

    .card-table .table td,
    .card-table .table th {
        border-top: 1px solid #e2e5e8;
        padding: 1rem .75rem;
        white-space: nowrap
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

    .block {
        display: block !important
    }

    .cal-icon {
        position: relative;
        width: 100%
    }

    .cal-icon:after {
        color: #979797;
        content: "\f073";
        display: block;
        font-family: "font awesome 5 free";
        font-weight: 900;
        font-size: 15px;
        margin: auto;
        position: absolute;
        right: 15px;
        top: 10px
    }

    .btn.focus,
    .btn:focus {
        box-shadow: unset
    }

    .btn-white {
        background-color: #fff;
        border: 1px solid #ccc;
        color: #333
    }

    .btn.btn-rounded {
        border-radius: 50px
    }

    .bg-primary,
    .badge-primary {
        background-color: #2962ff !important
    }

    a.bg-primary:focus,
    a.bg-primary:hover,
    button.bg-primary:focus,
    button.bg-primary:hover {
        background-color: #04f !important
    }

    .bg-success,
    .badge-success {
        background-color: #6376e9 !important
    }

    a.bg-success:focus,
    a.bg-success:hover,
    button.bg-success:focus,
    button.bg-success:hover {
        background-color: #167cdb !important
    }

    .bg-info,
    .badge-info {
        background-color: #009efb !important
    }

    a.bg-info:focus,
    a.bg-info:hover,
    button.bg-info:focus,
    button.bg-info:hover {
        background-color: #167cdb !important
    }

    .bg-warning,
    .badge-warning {
        background-color: #ffbc34 !important
    }

    a.bg-warning:focus,
    a.bg-warning:hover,
    button.bg-warning:focus,
    button.bg-warning:hover {
        background-color: #e9ab2e !important
    }

    .bg-danger,
    .badge-danger {
        background-color: #e84646 !important
    }

    a.bg-danger:focus,
    a.bg-danger:hover,
    button.bg-danger:focus,
    button.bg-danger:hover {
        background-color: #e63333 !important
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

    .bg-purple,
    .badge-purple {
        background-color: #9368e9 !important
    }

    .text-primary,
    .dropdown-menu>li>a.text-primary {
        color: #2962ff !important
    }

    .text-success,
    .dropdown-menu>li>a.text-success {
        color: #699834 !important
    }

    .text-danger,
    .dropdown-menu>li>a.text-danger {
        color: #e84646 !important
    }

    .text-info,
    .dropdown-menu>li>a.text-info {
        color: #009efb !important
    }

    .text-warning,
    .dropdown-menu>li>a.text-warning {
        color: #ffbc34 !important
    }

    .text-purple,
    .dropdown-menu>li>a.text-purple {
        color: #7460ee !important
    }

    .text-muted {
        color: #333 !important;
        line-height: .5;
        font-weight: 200;
        font-size: .875rem
    }

    .card_widget_header {
        font-size: 1.875rem
    }

    .btn-primary {
        background-color: #1A8DF8;
        border: 1px solid #1A8DF8
    }

    .btn-primary:hover,
    .btn-primary:focus,
    .btn-primary.active,
    .btn-primary:active,
    .open>.dropdown-toggle.btn-primary {
        background: #1A8DF8;
        border-color: #1A8DF8
    }

    .btn-primary.active.focus,
    .btn-primary.active:focus,
    .btn-primary.active:hover,
    .btn-primary.focus:active,
    .btn-primary:active:focus,
    .btn-primary:active:hover,
    .open>.dropdown-toggle.btn-primary.focus,
    .open>.dropdown-toggle.btn-primary:focus,
    .open>.dropdown-toggle.btn-primary:hover {
        background-color: #04f;
        border: 1px solid #04f
    }

    .btn-primary.active:not(:disabled):not(.disabled),
    .btn-primary:active:not(:disabled):not(.disabled),
    .show>.btn-primary.dropdown-toggle {
        background: #eccd8e;
        border-color: #eccd8e;
        color: #fff
    }

    .btn-primary.active:focus:not(:disabled):not(.disabled),
    .btn-primary:active:focus:not(:disabled):not(.disabled),
    .show>.btn-primary.dropdown-toggle:focus {
        box-shadow: unset
    }

    .btn-primary.disabled,
    .btn-primary:disabled {
        background-color: #2962ff;
        border-color: #2962ff;
        color: #fff
    }

    .btn-secondary.active:focus:not(:disabled):not(.disabled),
    .btn-secondary:active:focus:not(:disabled):not(.disabled),
    .show>.btn-secondary.dropdown-toggle:focus {
        box-shadow: unset
    }

    .btn-success {
        background-color: #1A8DF8;
        border-color: #1A8DF8
    }

    .btn-success:hover,
    .btn-success:focus,
    .btn-success.active,
    .btn-success:active,
    .open>.dropdown-toggle.btn-success {
        background-color: #167cdb;
        border: 1px solid #167cdb;
        color: #fff
    }

    .btn-success.active.focus,
    .btn-success.active:focus,
    .btn-success.active:hover,
    .btn-success.focus:active,
    .btn-success:active:focus,
    .btn-success:active:hover,
    .open>.dropdown-toggle.btn-success.focus,
    .open>.dropdown-toggle.btn-success:focus,
    .open>.dropdown-toggle.btn-success:hover {
        background-color: #167cdb;
        border: 1px solid #167cdb
    }

    .btn-success.active:not(:disabled):not(.disabled),
    .btn-success:active:not(:disabled):not(.disabled),
    .show>.btn-success.dropdown-toggle {
        background-color: #1A8DF8;
        border-color: #1A8DF8;
        color: #fff;
        background: #eccd8e;
        border-color: #eccd8e
    }

    .btn-success.active:focus:not(:disabled):not(.disabled),
    .btn-success:active:focus:not(:disabled):not(.disabled),
    .show>.btn-success.dropdown-toggle:focus {
        box-shadow: unset
    }

    .btn-success.disabled,
    .btn-success:disabled {
        background-color: #1A8DF8;
        border-color: #1A8DF8;
        color: #fff
    }

    .btn-info {
        background: #1A8DF8;
        border-color: #1A8DF8
    }

    .btn-right {
        float: right;

    }

    .btn-left {
        float: left;
        margin-top: 1rem;
        width: 8rem;
    }

    .btn-summary {
        float: right;
        margin-top: 1rem;
        width: 8rem;
        padding-bottom: 20px;
    }



    .btn-info:hover,
    .btn-info:focus,
    .btn-info.active,
    .btn-info:active,
    .open>.dropdown-toggle.btn-info {
        background-color: #167cdb;
        border: 1px solid #167cdb
    }

    .btn-info.active.focus,
    .btn-info.active:focus,
    .btn-info.active:hover,
    .btn-info.focus:active,
    .btn-info:active:focus,
    .btn-info:active:hover,
    .open>.dropdown-toggle.btn-info.focus,
    .open>.dropdown-toggle.btn-info:focus,
    .open>.dropdown-toggle.btn-info:hover {
        background-color: #167cdb;
        border: 1px solid #167cdb
    }

    .btn-info.active:not(:disabled):not(.disabled),
    .btn-info:active:not(:disabled):not(.disabled),
    .show>.btn-info.dropdown-toggle {
        background-color: #167cdb;
        border-color: #167cdb;
        color: #fff
    }

    .btn-info.active:focus:not(:disabled):not(.disabled),
    .btn-info:active:focus:not(:disabled):not(.disabled),
    .show>.btn-info.dropdown-toggle:focus {
        box-shadow: unset
    }

    .btn-info.disabled,
    .btn-info:disabled {
        background-color: #009efb;
        border-color: #009efb;
        color: #fff
    }

    .btn-warning {
        background-color: #ffbc34;
        border: 1px solid #ffbc34
    }

    .btn-warning:hover,
    .btn-warning:focus,
    .btn-warning.active,
    .btn-warning:active,
    .open>.dropdown-toggle.btn-warning {
        background-color: #e9ab2e;
        border: 1px solid #e9ab2e
    }

    .btn-warning.active.focus,
    .btn-warning.active:focus,
    .btn-warning.active:hover,
    .btn-warning.focus:active,
    .btn-warning:active:focus,
    .btn-warning:active:hover,
    .open>.dropdown-toggle.btn-warning.focus,
    .open>.dropdown-toggle.btn-warning:focus,
    .open>.dropdown-toggle.btn-warning:hover {
        background-color: #e9ab2e;
        border: 1px solid #e9ab2e
    }

    .btn-warning.active:not(:disabled):not(.disabled),
    .btn-warning:active:not(:disabled):not(.disabled),
    .show>.btn-danger.dropdown-toggle {
        background-color: #e9ab2e;
        border-color: #e9ab2e;
        color: #fff
    }

    .btn-warning.active:focus:not(:disabled):not(.disabled),
    .btn-warning:active:focus:not(:disabled):not(.disabled),
    .show>.btn-warning.dropdown-toggle:focus {
        box-shadow: unset
    }

    .btn-warning.disabled,
    .btn-warning:disabled {
        background-color: #ffbc34;
        border-color: #ffbc34;
        color: #fff
    }

    .btn-danger {
        background-color: #e84646;
        border: 1px solid #e84646
    }

    .btn-danger:hover,
    .btn-danger:focus,
    .btn-danger.active,
    .btn-danger:active,
    .open>.dropdown-toggle.btn-danger {
        background-color: #e63333;
        border: 1px solid #e63333
    }

    .btn-danger.active.focus,
    .btn-danger.active:focus,
    .btn-danger.active:hover,
    .btn-danger.focus:active,
    .btn-danger:active:focus,
    .btn-danger:active:hover,
    .open>.dropdown-toggle.btn-danger.focus,
    .open>.dropdown-toggle.btn-danger:focus,
    .open>.dropdown-toggle.btn-danger:hover {
        background-color: #e63333;
        border: 1px solid #e63333
    }

    .btn-danger.active:not(:disabled):not(.disabled),
    .btn-danger:active:not(:disabled):not(.disabled),
    .show>.btn-danger.dropdown-toggle {
        background-color: #e63333;
        border-color: #e63333;
        color: #fff
    }

    .btn-danger.active:focus:not(:disabled):not(.disabled),
    .btn-danger:active:focus:not(:disabled):not(.disabled),
    .show>.btn-danger.dropdown-toggle:focus {
        box-shadow: unset
    }

    .btn-danger.disabled,
    .btn-danger:disabled {
        background-color: #f62d51;
        border-color: #f62d51;
        color: #fff
    }

    .btn-light.active:focus:not(:disabled):not(.disabled),
    .btn-light:active:focus:not(:disabled):not(.disabled),
    .show>.btn-light.dropdown-toggle:focus {
        box-shadow: unset
    }

    .btn-dark.active:focus:not(:disabled):not(.disabled),
    .btn-dark:active:focus:not(:disabled):not(.disabled),
    .show>.btn-dark.dropdown-toggle:focus {
        box-shadow: unset
    }

    .btn-outline-primary {
        color: #2962ff;
        border-color: #2962ff
    }

    .btn-outline-primary:hover {
        background-color: #2962ff;
        border-color: #2962ff
    }

    .btn-outline-primary:focus,
    .btn-outline-primary.focus {
        box-shadow: none
    }

    .btn-outline-primary.disabled,
    .btn-outline-primary:disabled {
        color: #2962ff;
        background-color: transparent
    }

    .btn-outline-primary:not(:disabled):not(.disabled):active,
    .btn-outline-primary:not(:disabled):not(.disabled).active,
    .show>.btn-outline-primary.dropdown-toggle {
        background-color: #2962ff;
        border-color: #2962ff
    }

    .btn-outline-primary:not(:disabled):not(.disabled):active:focus,
    .btn-outline-primary:not(:disabled):not(.disabled).active:focus,
    .show>.btn-outline-primary.dropdown-toggle:focus {
        box-shadow: none
    }

    .btn-outline-success {
        color: #1A8DF8;
        border-color: #1A8DF8
    }

    .btn-outline-success:hover {
        background-color: #1A8DF8;
        border-color: #1A8DF8
    }

    .btn-outline-success:focus,
    .btn-outline-success.focus {
        box-shadow: none
    }

    .btn-outline-success.disabled,
    .btn-outline-success:disabled {
        color: #7bb13c;
        background-color: transparent
    }

    .btn-outline-success:not(:disabled):not(.disabled):active,
    .btn-outline-success:not(:disabled):not(.disabled).active,
    .show>.btn-outline-success.dropdown-toggle {
        background-color: #7bb13c;
        border-color: #7bb13c
    }

    .btn-outline-success:not(:disabled):not(.disabled):active:focus,
    .btn-outline-success:not(:disabled):not(.disabled).active:focus,
    .show>.btn-outline-success.dropdown-toggle:focus {
        box-shadow: none
    }

    .btn-outline-info {
        color: #009efb;
        border-color: #009efb
    }

    .btn-outline-info:hover {
        color: #fff;
        background-color: #009efb;
        border-color: #009efb
    }

    .btn-outline-info:focus,
    .btn-outline-info.focus {
        box-shadow: none
    }

    .btn-outline-info.disabled,
    .btn-outline-info:disabled {
        background-color: transparent;
        color: #009efb
    }

    .btn-outline-info:not(:disabled):not(.disabled):active,
    .btn-outline-info:not(:disabled):not(.disabled).active,
    .show>.btn-outline-info.dropdown-toggle {
        background-color: #009efb;
        border-color: #009efb
    }

    .btn-outline-info:not(:disabled):not(.disabled):active:focus,
    .btn-outline-info:not(:disabled):not(.disabled).active:focus,
    .show>.btn-outline-info.dropdown-toggle:focus {
        box-shadow: none
    }

    .btn-outline-warning {
        color: #ffbc34;
        border-color: #ffbc34
    }

    .btn-outline-warning:hover {
        color: #212529;
        background-color: #ffbc34;
        border-color: #ffbc34
    }

    .btn-outline-warning:focus,
    .btn-outline-warning.focus {
        box-shadow: none
    }

    .btn-outline-warning.disabled,
    .btn-outline-warning:disabled {
        background-color: transparent;
        color: #ffbc34
    }

    .btn-outline-warning:not(:disabled):not(.disabled):active,
    .btn-outline-warning:not(:disabled):not(.disabled).active,
    .show>.btn-outline-warning.dropdown-toggle {
        color: #212529;
        background-color: #ffbc34;
        border-color: #ffbc34
    }

    .btn-outline-warning:not(:disabled):not(.disabled):active:focus,
    .btn-outline-warning:not(:disabled):not(.disabled).active:focus,
    .show>.btn-outline-warning.dropdown-toggle:focus {
        box-shadow: none
    }

    .btn-outline-danger {
        color: #e84646;
        border-color: #e84646
    }

    .btn-outline-danger:hover {
        color: #fff;
        background-color: #e84646;
        border-color: #e84646
    }

    .btn-outline-danger:focus,
    .btn-outline-danger.focus {
        box-shadow: none
    }

    .btn-outline-danger.disabled,
    .btn-outline-danger:disabled {
        background-color: transparent;
        color: #e84646
    }

    .btn-outline-danger:not(:disabled):not(.disabled):active,
    .btn-outline-danger:not(:disabled):not(.disabled).active,
    .show>.btn-outline-danger.dropdown-toggle {
        background-color: #e84646;
        border-color: #e84646
    }

    .btn-outline-danger:not(:disabled):not(.disabled):active:focus,
    .btn-outline-danger:not(:disabled):not(.disabled).active:focus,
    .show>.btn-outline-danger.dropdown-toggle:focus {
        box-shadow: none
    }

    .btn-outline-light {
        color: #ababab;
        border-color: #e6e6e6
    }

    .btn-outline-light.disabled,
    .btn-outline-light:disabled {
        color: #ababab
    }

    .pagination>.active>a,
    .pagination>.active>a:focus,
    .pagination>.active>a:hover,
    .pagination>.active>span,
    .pagination>.active>span:focus,
    .pagination>.active>span:hover {
        background-color: #2962ff;
        border-color: #2962ff
    }

    .pagination>li>a,
    .pagination>li>span {
        color: #2962ff
    }

    .page-link:hover {
        color: #2962ff
    }

    .page-link:focus {
        box-shadow: unset
    }

    .page-item.active .page-link {
        background-color: #1A8DF8;
        border-color: #1A8DF8
    }

    .dropdown-menu {
        border: 1px solid rgba(0, 0, 0, .1);
        border-radius: 3px;
        transform-origin: left top 0;
        box-shadow: inherit;
        background-color: #fff
    }

    .dropdown-item.active,
    .dropdown-item:active {
        background-color: #2962ff
    }

    .navbar-nav .open .dropdown-menu {
        border: 0;
        box-shadow: 0 0 10px rgba(0, 0, 0, .1);
        background-color: #fff
    }

    .dropdown-menu {
        font-size: 14px
    }

    .card {
        border: 0;
        border-radius: 0;
        margin-bottom: 1.875rem
    }

    .first_widget {
        padding: 14px
    }

    .card.board1.fill {
        -webkit-text-fill-color: #1A8DF8
    }

    .card-body {
        padding: 1.5rem
    }

    .card-header {
        border-bottom: 1px solid #e6e6e6;
        padding: 1rem 1.5rem
    }

    .card-footer {
        background-color: #fff;
        border-top: 1px solid #e6e6e6;
        padding: 1rem 1.5rem
    }

    .card .card-header {
        background-color: #fff;
        border-bottom: 1px solid #eaeaea
    }

    .card .card-header .card-title {
        margin-bottom: 0;
        font-size: 18px
    }

    .modal-footer.text-left {
        text-align: left
    }

    .modal-footer.text-center {
        text-align: center
    }

    .btn-light {
        border-color: #1A8DF8;
        color: #fff;
        background-color: #1A8DF8
    }

    .bootstrap-datetimepicker-widget table td.active,
    .bootstrap-datetimepicker-widget table td.active:hover {
        background-color: #2962ff;
        text-shadow: unset
    }

    .bootstrap-datetimepicker-widget table td.today:before {
        border-bottom-color: #2962ff
    }

    .bg-info-light {
        background-color: #1363ad(2, 182, 179, .12) !important;
        color: #1A8DF8 !important
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

    .select2-container .select2-selection--single {
        border: 1px solid #ddd;
        height: 40px
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 38px;
        right: 7px
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow b {
        border-color: #ddd transparent transparent;
        border-style: solid;
        border-width: 6px 6px 0;
        height: 0;
        left: 50%;
        margin-left: -10px;
        margin-top: -2px;
        position: absolute;
        top: 50%;
        width: 0
    }

    .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
        border-color: transparent transparent #ddd;
        border-width: 0 6px 6px
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        padding-right: 30px;
        padding-left: 15px
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #333;
        font-size: 15px;
        font-weight: 400;
        line-height: 38px
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #2962ff
    }

    .select2-container--default .select2-selection--multiple {
        border: 1px solid #ddd;
        min-height: 40px
    }

    .nav-tabs {
        border-bottom: 1px solid #e6e6e6
    }

    .card-header-tabs {
        border-bottom: 0
    }

    .nav-tabs>li>a {
        margin-right: 0;
        color: #888;
        border-radius: 0
    }

    .nav-tabs>li>a:hover,
    .nav-tabs>li>a:focus {
        border-color: transparent;
        color: #333
    }

    .nav-tabs.nav-tabs-solid>li>a {
        color: #333
    }

    .nav-tabs.nav-tabs-solid>.active>a,
    .nav-tabs.nav-tabs-solid>.active>a:hover,
    .nav-tabs.nav-tabs-solid>.active>a:focus {
        background-color: #2962ff;
        border-color: #2962ff;
        color: #fff
    }

    .tab-content {
        padding-top: 20px
    }

    .nav-tabs .nav-link {
        border-radius: 0
    }

    .nav-tabs .nav-link:focus,
    .nav-tabs .nav-link:hover {
        background-color: #eee;
        border-color: transparent;
        color: #333
    }

    .nav-tabs.nav-justified>li>a {
        border-radius: 0;
        margin-bottom: 0
    }

    .nav-tabs.nav-justified>li>a:hover,
    .nav-tabs.nav-justified>li>a:focus {
        border-bottom-color: #ddd
    }

    .nav-tabs.nav-justified.nav-tabs-solid>li>a {
        border-color: transparent
    }

    .nav-tabs.nav-tabs-solid>li>a {
        color: #333
    }

    .nav-tabs.nav-tabs-solid>li>a.active,
    .nav-tabs.nav-tabs-solid>li>a.active:hover,
    .nav-tabs.nav-tabs-solid>li>a.active:focus {
        background-color: #1A8DF8;
        border-color: #1A8DF8;
        color: #fff
    }

    .nav-tabs.nav-tabs-solid.nav-tabs-rounded {
        border-radius: 50px
    }

    .nav-tabs.nav-tabs-solid.nav-tabs-rounded>li>a {
        border-radius: 50px
    }

    .nav-tabs.nav-tabs-solid.nav-tabs-rounded>li>a.active,
    .nav-tabs.nav-tabs-solid.nav-tabs-rounded>li>a.active:hover,
    .nav-tabs.nav-tabs-solid.nav-tabs-rounded>li>a.active:focus {
        border-radius: 50px
    }

    .nav-tabs-justified>li>a {
        border-radius: 0;
        margin-bottom: 0
    }

    .nav-tabs-justified>li>a:hover,
    .nav-tabs-justified>li>a:focus {
        border-bottom-color: #ddd
    }

    .nav-tabs-justified.nav-tabs-solid>li>a {
        border-color: transparent
    }

    .nav-tabs.nav-justified.nav-tabs-top {
        border-bottom: 1px solid #ddd
    }

    .nav-tabs.nav-justified.nav-tabs-top>li>a,
    .nav-tabs.nav-justified.nav-tabs-top>li>a:hover,
    .nav-tabs.nav-justified.nav-tabs-top>li>a:focus {
        border-width: 2px 0 0
    }

    .nav-tabs.nav-tabs-top>li {
        margin-bottom: 0
    }

    .nav-tabs.nav-tabs-top>li>a,
    .nav-tabs.nav-tabs-top>li>a:hover,
    .nav-tabs.nav-tabs-top>li>a:focus {
        border-width: 2px 0 0
    }

    .nav-tabs.nav-tabs-top>li.open>a,
    .nav-tabs.nav-tabs-top>li>a:hover,
    .nav-tabs.nav-tabs-top>li>a:focus {
        border-top-color: #ddd
    }

    .nav-tabs.nav-tabs-top>li+li>a {
        margin-left: 1px
    }

    .nav-tabs.nav-tabs-top>li>a.active,
    .nav-tabs.nav-tabs-top>li>a.active:hover,
    .nav-tabs.nav-tabs-top>li>a.active:focus {
        border-top-color: #2962ff
    }

    .nav-tabs.nav-tabs-bottom>li {
        margin-bottom: -1px
    }

    .nav-tabs.nav-tabs-bottom>li>a.active,
    .nav-tabs.nav-tabs-bottom>li>a.active:hover,
    .nav-tabs.nav-tabs-bottom>li>a.active:focus {
        border-bottom-width: 2px;
        border-color: transparent;
        border-bottom-color: #2962ff;
        background-color: transparent;
        transition: none 0s ease 0s;
        -moz-transition: none 0s ease 0s;
        -o-transition: none 0s ease 0s;
        -ms-transition: none 0s ease 0s;
        -webkit-transition: none 0s ease 0s
    }

    .nav-tabs.nav-tabs-solid {
        background-color: #fafafa;
        border: 0
    }

    .nav-tabs.nav-tabs-solid>li {
        margin-bottom: 0
    }

    .nav-tabs.nav-tabs-solid>li>a {
        border-color: transparent
    }

    .nav-tabs.nav-tabs-solid>li>a:hover,
    .nav-tabs.nav-tabs-solid>li>a:focus {
        background-color: #f5f5f5
    }

    .nav-tabs.nav-tabs-solid>.open:not(.active)>a {
        background-color: #f5f5f5;
        border-color: transparent
    }

    .nav-tabs-justified.nav-tabs-top {
        border-bottom: 1px solid #ddd
    }

    .nav-tabs-justified.nav-tabs-top>li>a,
    .nav-tabs-justified.nav-tabs-top>li>a:hover,
    .nav-tabs-justified.nav-tabs-top>li>a:focus {
        border-width: 2px 0 0
    }

    .section-header {
        margin-bottom: 1.875rem
    }

    .section-header .section-title {
        color: #333
    }

    .line {
        background-color: #2962ff;
        height: 2px;
        margin: 0;
        width: 60px
    }

    .comp-buttons .btn {
        margin-bottom: 5px
    }

    .pagination-box .pagination {
        margin-top: 0
    }

    .comp-dropdowns .btn-group {
        margin-bottom: 5px
    }

    .progress-example .progress {
        margin-bottom: 1.5rem
    }

    .progress-xs {
        height: 4px
    }

    .progress-sm {
        height: 15px
    }

    .progress.progress-sm {
        height: 6px
    }

    .progress.progress-md {
        height: 8px
    }

    .progress.progress-lg {
        height: 18px
    }

    .row.row-sm {
        margin-left: -3px;
        margin-right: -3px
    }

    .row.row-sm>div {
        padding-left: 3px;
        padding-right: 3px
    }

    .avatar {
        position: relative;
        display: inline-block;
        width: 3rem;
        height: 3rem
    }

    .avatar>img {
        width: 100%;
        height: 100%;
        -o-object-fit: cover;
        object-fit: cover
    }

    .avatar-title {
        width: 100%;
        height: 100%;
        background-color: #2962ff;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center
    }

    .avatar-away:before,
    .avatar-offline:before,
    .avatar-online:before {
        position: absolute;
        right: 0;
        bottom: 0;
        width: 25%;
        height: 25%;
        border-radius: 50%;
        content: '';
        border: 2px solid #fff
    }

    .avatar-online:before {
        background-color: #7bb13c
    }

    .avatar-offline:before {
        background-color: #e84646
    }

    .avatar-away:before {
        background-color: #ffbc34
    }

    .avatar .border {
        border-width: 3px !important
    }

    .avatar .rounded {
        border-radius: 6px !important
    }

    .avatar .avatar-title {
        font-size: 18px
    }

    .avatar-xs {
        width: 1.65rem;
        height: 1.65rem
    }

    .avatar-xs .border {
        border-width: 2px !important
    }

    .avatar-xs .rounded {
        border-radius: 4px !important
    }

    .avatar-xs .avatar-title {
        font-size: 12px
    }

    .avatar-xs.avatar-away:before,
    .avatar-xs.avatar-offline:before,
    .avatar-xs.avatar-online:before {
        border-width: 1px
    }

    .avatar-sm {
        width: 2.5rem;
        height: 2.5rem
    }

    .avatar-sm .border {
        border-width: 3px !important
    }

    .avatar-sm .rounded {
        border-radius: 4px !important
    }

    .avatar-sm .avatar-title {
        font-size: 15px
    }

    .avatar-sm.avatar-away:before,
    .avatar-sm.avatar-offline:before,
    .avatar-sm.avatar-online:before {
        border-width: 2px
    }

    .avatar-lg {
        width: 3.75rem;
        height: 3.75rem
    }

    .avatar-lg .border {
        border-width: 3px !important
    }

    .avatar-lg .rounded {
        border-radius: 8px !important
    }

    .avatar-lg .avatar-title {
        font-size: 24px
    }

    .avatar-lg.avatar-away:before,
    .avatar-lg.avatar-offline:before,
    .avatar-lg.avatar-online:before {
        border-width: 3px
    }

    .avatar-xl {
        width: 5rem;
        height: 5rem
    }

    .avatar-xl .border {
        border-width: 4px !important
    }

    .avatar-xl .rounded {
        border-radius: 8px !important
    }

    .avatar-xl .avatar-title {
        font-size: 28px
    }

    .avatar-xl.avatar-away:before,
    .avatar-xl.avatar-offline:before,
    .avatar-xl.avatar-online:before {
        border-width: 4px
    }

    .avatar-xxl {
        width: 5.125rem;
        height: 5.125rem
    }

    .avatar-xxl .border {
        border-width: 6px !important
    }

    .avatar-xxl .rounded {
        border-radius: 8px !important
    }

    .avatar-xxl .avatar-title {
        font-size: 30px
    }

    .avatar-xxl.avatar-away:before,
    .avatar-xxl.avatar-offline:before,
    .avatar-xxl.avatar-online:before {
        border-width: 4px
    }

    .avatar-group {
        display: inline-flex
    }

    .avatar-group .avatar+.avatar {
        margin-left: -.75rem
    }

    .avatar-group .avatar-xs+.avatar-xs {
        margin-left: -.40625rem
    }

    .avatar-group .avatar-sm+.avatar-sm {
        margin-left: -.625rem
    }

    .avatar-group .avatar-lg+.avatar-lg {
        margin-left: -1rem
    }

    .avatar-group .avatar-xl+.avatar-xl {
        margin-left: -1.28125rem
    }

    .avatar-group .avatar:hover {
        z-index: 1
    }

    .roles_class {
        margin-top: 10px
    }

    .roles-menu {
        margin-top: 20px
    }

    .roles-menu>ul {
        background-color: #fff;
        border: 1px solid #eaeaea;
        border-radius: 4px;
        list-style: none;
        margin: 0;
        padding: 0
    }

    .roles-menu>ul>li>a {
        border-left: 3px solid transparent;
        color: #333;
        display: block;
        padding: 10px 15px;
        position: relative
    }

    .roles-menu>ul>li.active>a {
        border-color: #1A8DF8;
        color: #1A8DF8
    }

    .header {
        left: 0;
        position: fixed;
        right: 0;
        top: 0;
        z-index: 1001;
        height: 80px;
        background-color: #f9fbfd;
        padding: 0 10px 0 0;
        border-bottom: 1px solid #edf2f9
    }

    .header .header-left {
        float: left;
        height: 80px;
        padding: 0 20px;
        position: relative;
        text-align: center;
        width: 260px;
        background-color: #fff
    }

    .header .header-left .logo {
        display: inline-block;
        line-height: 75px
    }

    .header .header-left .logo img {
        max-height: 50px;
        width: auto;
        margin-top: -8px
    }

    .header-left .logo.logo-small {
        display: none
    }

    .header .dropdown-menu>li>a {
        position: relative
    }

    .header .dropdown-toggle:after {
        display: none
    }

    .header .has-arrow .dropdown-toggle:after {
        border-top: 0;
        border-left: 0;
        border-bottom: 2px solid #000;
        border-right: 2px solid #000;
        content: '';
        height: 8px;
        display: inline-block;
        pointer-events: none;
        -webkit-transform-origin: 66% 66%;
        -ms-transform-origin: 66% 66%;
        transform-origin: 66% 66%;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
        -webkit-transition: all .15s ease-in-out;
        transition: all .15s ease-in-out;
        width: 8px;
        vertical-align: 2px
    }

    .header .has-arrow .dropdown-toggle[aria-expanded=true]:after {
        -webkit-transform: rotate(-135deg);
        -ms-transform: rotate(-135deg);
        transform: rotate(-135deg)
    }

    .user-menu {
        float: right;
        margin: 10px;
        position: relative;
        z-index: 99
    }

    .user-menu.nav>li>a {
        color: #000;
        font-size: 14px;
        line-height: 58px;
        padding: 0 15px;
        height: 60px
    }

    .user-menu.nav>li>a:hover,
    .user-menu.nav>li>a:focus {}

    .user-menu.nav>li>a:hover i,
    .user-menu.nav>li>a:focus i {
        color: #000
    }

    .user-img {
        display: inline-block;
        margin-right: 3px;
        position: relative
    }

    .user-menu.nav>li>a.mobile_btn {
        border: 0;
        position: relative;
        padding: 0;
        margin: 0;
        cursor: pointer
    }

    .breadcrumb-item.active {
        color: #333
    }

    .user-menu .dropdown-menu {
        min-width: 200px;
        padding: 0
    }

    .user-menu .dropdown-menu .dropdown-item {
        padding: 7px 15px
    }

    .user-menu .dropdown-menu .dropdown-item {
        display: flex;
        align-items: center;
        border-top: 1px solid #e3e3e3;
        padding: 10px 15px
    }

    .user-menu .dropdown-menu .dropdown-item:hover {
        color: #1A8DF8
    }

    .header .dropdown-menu>li>a:focus,
    .header .dropdown-menu>li>a:hover {
        background-color: #1A8DF8;
        color: #fff
    }

    .header .dropdown-menu>li>a:focus i,
    .header .dropdown-menu>li>a:hover i {
        color: #fff
    }

    .header .dropdown-menu>li>a {
        padding: 10px 18px
    }

    .header .dropdown-menu>li>a i {
        color: #1A8DF8;
        margin-right: 10px;
        text-align: center;
        width: 18px
    }

    .header .user-menu .dropdown-menu>li>a i {
        color: #1A8DF8;
        font-size: 16px;
        margin-right: 10px;
        min-width: 18px;
        text-align: center
    }

    .header .user-menu .dropdown-menu>li>a:focus i,
    .header .user-menu .dropdown-menu>li>a:hover i {
        color: #fff
    }

    .mobile_btn {
        display: none;
        float: left
    }

    .slide-nav .sidebar {
        margin-left: 0
    }

    .app-dropdown .dropdown-menu {
        padding: 0;
        width: 300px
    }

    .app-dropdown-menu .app-list {
        padding: 15px
    }

    .app-dropdown-menu .app-item {
        border: 1px solid transparent;
        border-radius: 3px;
        color: #737373;
        display: block;
        padding: 10px 0;
        text-align: center
    }

    .app-dropdown-menu .app-item i {
        font-size: 20px;
        height: 24px
    }

    .app-dropdown-menu .app-item span {
        display: block;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap
    }

    .app-dropdown-menu .app-item:hover,
    .app-dropdown-menu .app-item:focus,
    .app-dropdown-menu .app-item:active,
    .app-dropdown-menu .app-item.active {
        background-color: #f9f9f9;
        border-color: #e3e3e3
    }

    .app-list>div+div {
        margin-top: 5px
    }

    .app-list>.row {
        margin-left: -5px;
        margin-right: -5px
    }

    .app-list>.row>.col {
        padding-left: 5px;
        padding-right: 5px
    }

    .user-header {
        background-color: #f9f9f9;
        display: flex;
        padding: 10px 15px
    }

    .user-header .user-text {
        margin-left: 10px
    }

    .user-header .user-text h6 {
        margin-bottom: 2px
    }

    .menu-title {
        color: #a3a3a3;
        display: block;
        font-size: 14px;
        margin-bottom: 5px;
        padding: 0 25px
    }

    .sidebar-overlay {
        background-color: rgba(0, 0, 0, .6);
        display: none;
        height: 100%;
        left: 0;
        position: fixed;
        top: 60px;
        width: 100%;
        z-index: 1000
    }

    .sidebar-overlay.opened {
        display: block
    }

    html.menu-opened {
        overflow: hidden
    }

    html.menu-opened body {
        overflow: hidden
    }

    .top-nav-search {
        float: right;
        margin-left: 15px;
        margin-top: 10px
    }

    .top-nav-search form {
        margin-top: 10px;
        position: relative;
        width: 230px
    }

    .top-nav-search .form-control {
        background-color: #1A8DF8;
        border-color: #1A8DF8;
        border-radius: 50px;
        color: #fff;
        height: 40px;
        padding: 10px 50px 10px 15px
    }

    .top-nav-search .btn {
        background-color: transparent;
        border-color: transparent;
        color: #fff;
        min-height: 40px;
        padding: 7px 15px;
        position: absolute;
        right: 0;
        top: 0
    }

    .top-nav-search .form-control::-webkit-input-placeholder {
        color: #fff
    }

    .top-nav-search .form-control::-moz-placeholder {
        color: #fff
    }

    .top-nav-search .form-control:-ms-input-placeholder {
        color: #fff
    }

    .top-nav-search .form-control::-ms-input-placeholder {
        color: #fff
    }

    .top-nav-search .form-control::placeholder {
        color: #fff
    }

    .top-nav-search.active form {
        display: block;
        left: 0;
        position: absolute
    }

    .sidebar {
        background-color: #fff;
        bottom: 0;
        left: 0;
        margin-top: 0;
        position: fixed;
        top: 80px;
        transition: all .2s ease-in-out 0s;
        width: 260px;
        z-index: 1001
    }

    .sidebar.opened {
        -webkit-transition: all .4s ease;
        -moz-transition: all .4s ease;
        transition: all .4s ease
    }

    .sidebar-inner {
        height: 100%;
        min-height: 100%;
        transition: all .2s ease-in-out 0s
    }

    .sidebar-menu {
        padding: 30px 0 0 15px
    }

    .list-divider {
        border-bottom: 1px solid #edf2f9;
        height: 13px
    }

    .submenu_class {
        border-left: 1px solid #dfdfdf;
        position: relative;
        margin-left: 38px
    }

    .sidebar-menu ul {
        font-size: 15px;
        list-style-type: none;
        padding: 0;
        position: relative;
        margin-right: 15px
    }

    .sidebar-menu li a {
        color: #333;
        display: block;
        font-size: 16px;
        height: auto;
        padding: 0 20px
    }

    .sidebar-menu li a:hover {
        color: #1A8DF8
    }

    .sidebar-menu>ul>li>a:hover {
        color: #fff !important;
        background-color: #1A8DF8
    }

    .sidebar-menu>ul>li.active>a:hover {
        border-color: #1A8DF8;
        color: #fff
    }

    .sidebar-menu li.active a {
        border-radius: 8px;
        color: #fff !important;
        box-shadow: 0 7px 12px 0 rgba(95, 118, 232, .21);
        opacity: 1;
        background: #1A8DF8
    }

    .menu-title {
        color: #000;
        display: flex;
        font-size: 14px;
        opacity: 1;
        padding: 5px 15px;
        white-space: nowrap;
        font-weight: 600
    }

    .menu-title>i {
        float: right;
        line-height: 40px
    }

    .sidebar-menu li.menu-title a {
        color: #ff9b44;
        display: inline-block;
        margin-left: auto;
        padding: 0
    }

    .sidebar-menu li.menu-title a.btn {
        color: #fff;
        display: block;
        float: none;
        font-size: 15px;
        margin-bottom: 15px;
        padding: 10px 15px
    }

    .sidebar-menu ul ul a {
        font-size: 14px;
        position: relative
    }

    .sidebar-menu ul ul a.active {
        color: #1A8DF8;
        text-decoration: none
    }

    .sidebar-menu ul ul a:before {
        content: "";
        position: absolute;
        left: -5px;
        top: 13px;
        background-color: #fff;
        width: 10px;
        height: 10px;
        display: inline-block;
        border: 2px solid #000;
        border-radius: 50px
    }

    .sidebar-menu ul ul a.active:before {
        border-color: #1A8DF8
    }

    .mobile_btn {
        display: none;
        float: left
    }

    .sidebar .sidebar-menu>ul>li>a span {
        transition: all .2s ease-in-out 0s;
        display: inline-block;
        margin-left: 10px;
        white-space: nowrap
    }

    .sidebar .sidebar-menu>ul>li>a span.chat-user {
        margin-left: 0;
        overflow: hidden;
        text-overflow: ellipsis
    }

    .sidebar .sidebar-menu>ul>li>a span.badge {
        margin-left: auto
    }

    .sidebar-menu ul ul a {
        display: block;
        font-size: 14px;
        padding: 7px 0 10px 17px;
        position: relative
    }

    .sidebar-menu ul ul {
        display: none
    }

    .sidebar-menu ul ul ul a {
        padding-left: 25px
    }

    .sidebar-menu ul ul ul ul a {
        padding-left: 85px
    }

    .sidebar-menu>ul>li {
        margin-bottom: 3px;
        position: relative
    }

    .sidebar-menu>ul>li:last-child {
        margin-bottom: 0
    }

    .sidebar-menu .menu-arrow {
        -webkit-transition: -webkit-transform .15s;
        -o-transition: -o-transform .15s;
        transition: transform .15s;
        position: absolute;
        right: 15px;
        display: inline-block;
        font-family: 'font awesome 5 free';
        font-weight: 600;
        text-rendering: auto;
        line-height: 40px;
        font-size: 16px;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        -webkit-transform: translate(0, 0);
        -ms-transform: translate(0, 0);
        -o-transform: translate(0, 0);
        transform: translate(0, 0);
        line-height: 18px;
        top: 16px
    }

    .sidebar-menu .menu-arrow:before {
        content: "\f105"
    }

    .sidebar-menu li a.subdrop .menu-arrow {
        -ms-transform: rotate(90deg);
        -webkit-transform: rotate(90deg);
        -o-transform: rotate(90deg);
        transform: rotate(90deg)
    }

    .sidebar-menu ul ul a .menu-arrow {
        top: 10px
    }

    .sidebar-menu>ul>li>a {
        align-items: center;
        border-radius: 8px;
        display: flex;
        justify-content: flex-start;
        padding: 12px 18px;
        position: relative;
        transition: all .2s ease-in-out 0s
    }

    .sidebar-menu ul li a i {
        display: inline-block;
        font-size: 19px;
        line-height: 24px;
        text-align: left;
        vertical-align: middle;
        width: 20px;
        transition: all .2s ease-in-out 0s
    }

    .sidebar-menu ul li.menu-title a i {
        font-size: 16px !important;
        margin-right: 0;
        text-align: right;
        width: auto
    }

    .sidebar-menu li a>.badge {
        color: #fff
    }

    .main-wrapper {
        width: 100%;
        height: 100vh;
        min-height: 100vh
    }

    .page-wrapper {
        margin-left: 265px;
        padding-top: 32px;
        position: relative;
        transition: all .4s ease;
        background-color: #f2f5fa
    }

    .page-wrapper>.content {
        padding: 1.875rem 1.875rem 0
    }

    .page-header {
        margin-bottom: 1.875rem
    }

    .page-header .breadcrumb {
        background-color: transparent;
        color: #6c757d;
        font-size: 1rem;
        font-weight: 500;
        margin-bottom: 0;
        padding: 0
    }

    .page-header .breadcrumb a {
        color: #333
    }

    .page-title {
        color: #333;
        margin-bottom: 5px;
        font-size: 28px
    }

    .author-widget {
        margin-bottom: 30px;
        background-color: #fff;
        padding: 20px;
        border: 1px solid #e7e7e7
    }

    .login-body {
        display: table;
        height: 100vh;
        min-height: 100vh
    }

    .login-wrapper {
        width: 100%;
        height: 100%;
        display: table-cell;
        vertical-align: middle
    }

    .login_class {
        margin-top: 40px
    }

    .login-wrapper .loginbox {
        background-color: #fff;
        border-radius: 6px;
        box-shadow: 0 0 10px rgba(0, 0, 0, .1);
        display: flex;
        margin: 1.875rem auto;
        max-width: 800px;
        min-height: 500px;
        width: 100%
    }

    .login_pswd {
        max-width: 385px !important;
        max-height: 460px !important
    }

    .delete_class {
        font-size: 16px;
        font-weight: 700;
        margin: 15px 0 0
    }

    .booking_card {
        padding: 1.75rem !important
    }

    .title_menu {
        font-weight: 700;
        font-size: 18px
    }

    .inform_css {
        box-shadow: 0 .5em 1em -.125em rgba(10, 10, 10, .1), 0 0 0 1px rgba(10, 10, 10, .02);
        background-color: #fff;
        padding: 10px
    }

    .ellipse_color {
        color: #1A8DF8
    }

    .login-wrapper .loginbox .login-left {
        align-items: center;
        background: #1A8DF8;
        background: -moz-linear-gradient(-45deg, rgba(0, 150, 136, 1) 0%, rgba(6, 198, 180, 1) 52%, rgba(0, 150, 136, 1) 100%, rgba(6, 198, 180, 1) 100%);
        background: -webkit-linear-gradient(-45deg, rgba(0, 150, 136, 1) 0%, rgba(6, 198, 180, 1) 52%, rgba(0, 150, 136, 1) 100%, rgba(6, 198, 180, 1) 100%);
        background: linear-gradient(135deg, rgba(0, 150, 136, 1) 0%, rgba(6, 198, 180, 1) 52%, rgba(0, 150, 136, 1) 100%, rgba(6, 198, 180, 1) 100%);
        border-radius: 6px 0 0 6px;
        flex-direction: column;
        justify-content: center;
        padding: 80px;
        width: 400px;
        display: flex
    }

    .login-wrapper .loginbox .login-right {
        align-items: center;
        display: flex;
        justify-content: center;
        padding: 40px;
        width: 400px
    }

    .login-wrapper .loginbox .login-right .login-right-wrap {
        max-width: 100%;
        flex: 0 0 100%
    }

    .login-wrapper .loginbox .login-right h1 {
        font-size: 26px;
        font-weight: 500;
        margin-bottom: 5px;
        text-align: center
    }

    .account-subtitle {
        color: #4c4c4c;
        font-size: 15px;
        margin-bottom: 1.875rem;
        text-align: center
    }

    .login-wrapper .loginbox .login-right .forgotpass a {
        color: #a0a0a0
    }

    .login-wrapper .loginbox .login-right .forgotpass a:hover {
        color: #333;
        text-decoration: underline
    }

    .login-wrapper .loginbox .login-right .dont-have {
        color: #a0a0a0;
        margin-top: 1.875rem
    }

    .login-wrapper .loginbox .login-right .dont-have a {
        color: #333
    }

    .login-wrapper .loginbox .login-right .dont-have a:hover {
        text-decoration: underline
    }

    .social-login {
        text-align: center
    }

    .social-login>span {
        color: #a0a0a0;
        margin-right: 8px
    }

    .social-login>a {
        background-color: #ccc;
        border-radius: 4px;
        color: #fff;
        display: inline-block;
        font-size: 18px;
        height: 32px;
        line-height: 32px;
        margin-right: 6px;
        text-align: center;
        width: 32px
    }

    .social-login>a:last-child {
        margin-right: 0
    }

    .social-login>a.facebook {
        background-color: #4b75bd
    }

    .social-login>a.google {
        background-color: #fe5240
    }

    .login-or {
        color: #a0a0a0;
        margin-bottom: 20px;
        margin-top: 20px;
        padding-bottom: 10px;
        padding-top: 10px;
        position: relative
    }

    .or-line {
        background-color: #e5e5e5;
        height: 1px;
        margin-bottom: 0;
        margin-top: 0;
        display: block
    }

    .span-or {
        background-color: #fff;
        display: block;
        left: 50%;
        margin-left: -20px;
        position: absolute;
        text-align: center;
        text-transform: uppercase;
        top: 0;
        width: 42px
    }

    .logoclass {
        color: #1A8DF8;
        font-size: 23px;
        font-weight: 600;
        margin-left: 4px
    }

    .lock-user {
        margin-bottom: 20px;
        text-align: center
    }

    .lock-user img {
        margin-bottom: 15px;
        width: 100px
    }

    .notifications {
        padding: 0
    }

    .notifications .notification-time {
        font-size: 12px;
        line-height: 1.35;
        color: #bdbdbd
    }

    .notifications .media {
        margin-top: 0;
        border-bottom: 1px solid #f5f5f5
    }

    .notifications .media:last-child {
        border-bottom: none
    }

    .notifications .media a {
        display: block;
        padding: 10px 15px;
        border-radius: 2px
    }

    .notifications .media a:hover {
        background-color: #fafafa
    }

    .notifications .media>.avatar {
        margin-right: 10px
    }

    .notifications .media-list .media-left {
        padding-right: 8px
    }

    .topnav-dropdown-header {
        border-bottom: 1px solid #eee;
        text-align: center
    }

    .topnav-dropdown-header,
    .topnav-dropdown-footer {
        font-size: 14px;
        height: 40px;
        line-height: 40px;
        padding-left: 15px;
        padding-right: 15px
    }

    .topnav-dropdown-footer {
        border-top: 1px solid #eee
    }

    .topnav-dropdown-footer a {
        display: block;
        text-align: center;
        color: #333
    }

    .user-menu.nav>li>a .badge {
        background-color: #1A8DF8;
        display: block;
        font-size: 10px;
        font-weight: 700;
        min-height: 15px;
        min-width: 15px;
        position: absolute;
        right: 3px;
        top: 6px;
        color: #fff
    }

    .user-menu.nav>li>a>i {
        font-size: 1.5rem;
        line-height: 60px
    }

    .noti-details {
        color: #989c9e;
        margin-bottom: 0
    }

    .noti-title {
        color: #333
    }

    .notifications .noti-content {
        height: 290px;
        width: 350px;
        overflow-y: auto;
        position: relative
    }

    .notification-list {
        list-style: none;
        padding: 0;
        margin: 0
    }

    .notifications ul.notification-list>li {
        margin-top: 0;
        border-bottom: 1px solid #f5f5f5
    }

    .notifications ul.notification-list>li:last-child {
        border-bottom: none
    }

    .notifications ul.notification-list>li a {
        display: block;
        padding: 10px 15px;
        border-radius: 2px
    }

    .notifications ul.notification-list>li a:hover {
        background-color: #fafafa
    }

    .notifications ul.notification-list>li .list-item {
        border: 0;
        padding: 0;
        position: relative
    }

    .topnav-dropdown-header .notification-title {
        color: #333;
        display: block;
        float: left;
        font-size: 14px
    }

    .topnav-dropdown-header .clear-noti {
        color: #f83f37;
        float: right;
        font-size: 12px;
        text-transform: uppercase
    }

    .noti-time {
        margin: 0
    }

    .user-menu.nav>li>a>i.fe.fe-bell {
        -webkit-animation-duration: 1.5s;
        animation-duration: 1.5s;
        -webkit-animation-fill-mode: both;
        animation-fill-mode: both;
        -webkit-animation-iteration-count: infinite;
        animation-iteration-count: infinite;
        -webkit-animation-name: tada;
        animation-name: tada
    }

    @-webkit-keyframes tada {
        0% {
            -webkit-transform: scale3d(1, 1, 1);
            transform: scale3d(1, 1, 1)
        }

        10%,
        20% {
            -webkit-transform: scale3d(.9, .9, .9) rotate3d(0, 0, 1, -3deg);
            transform: scale3d(.9, .9, .9) rotate3d(0, 0, 1, -3deg)
        }

        30%,
        50%,
        70%,
        90% {
            -webkit-transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg);
            transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg)
        }

        40%,
        60%,
        80% {
            -webkit-transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg);
            transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg)
        }

        100% {
            -webkit-transform: scale3d(1, 1, 1);
            transform: scale3d(1, 1, 1)
        }
    }

    @keyframes tada {
        0% {
            -webkit-transform: scale3d(1, 1, 1);
            -ms-transform: scale3d(1, 1, 1);
            transform: scale3d(1, 1, 1)
        }

        10%,
        20% {
            -webkit-transform: scale3d(.9, .9, .9) rotate3d(0, 0, 1, -3deg);
            -ms-transform: scale3d(.9, .9, .9) rotate3d(0, 0, 1, -3deg);
            transform: scale3d(.9, .9, .9) rotate3d(0, 0, 1, -3deg)
        }

        30%,
        50%,
        70%,
        90% {
            -webkit-transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg);
            -ms-transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg);
            transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg)
        }

        40%,
        60%,
        80% {
            -webkit-transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg);
            -ms-transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg);
            transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg)
        }

        100% {
            -webkit-transform: scale3d(1, 1, 1);
            -ms-transform: scale3d(1, 1, 1);
            transform: scale3d(1, 1, 1)
        }
    }

    .dash-widget-icon {
        align-items: center;
        border-radius: 4px;
        color: #fff;
        display: inline-flex;
        font-size: 1.875rem;
        height: 50px;
        justify-content: center;
        line-height: 48px;
        text-align: center;
        width: 50px
    }

    .dash-count {
        font-size: 18px;
        margin-left: auto
    }

    .dash-widget-info h3 {
        margin-bottom: 10px
    }

    .dash-widget-header {
        align-items: center;
        display: flex;
        margin-bottom: 5px
    }

    .card-chart .card-body {
        padding: 8px
    }

    #morrisArea>svg,
    #morrisLine>svg {
        width: 100%
    }

    .activity-feed {
        list-style: none;
        margin-bottom: 0;
        margin-left: 5px;
        padding: 0
    }

    .activity-feed .feed-item {
        border-left: 2px solid #e4e8eb;
        padding-bottom: 19px;
        padding-left: 20px;
        position: relative
    }

    .activity-feed .feed-item:last-child {
        border-color: transparent;
        padding-bottom: 0
    }

    .activity-feed .feed-item:after {
        content: "";
        display: block;
        position: absolute;
        top: 0;
        left: -7px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: #177dff
    }

    .activity-feed .feed-item .feed-date {
        display: block;
        position: relative;
        color: #777;
        text-transform: uppercase;
        font-size: 13px
    }

    .activity-feed .feed-item .feed-text {
        color: #777;
        position: relative
    }

    .activity-feed .feed-item .feed-text a {
        color: #333;
        font-weight: 600
    }

    .add-btn {
        border: 1px solid transparent;
        border-radius: 20px;
        color: #666;
        display: inline-block;
        padding: .375rem .75rem
    }

    .add-btn:hover,
    .add-btn:active,
    .add-btn:focus {
        background-color: #fff;
        border-color: #ddd;
        color: #666
    }

    .add-btn span {
        align-items: center;
        background-color: #ffc107;
        border-radius: 50%;
        color: #fff;
        display: inline-flex;
        font-size: 14px;
        height: 22px;
        justify-content: center;
        margin-right: 3px;
        width: 22px
    }

    .invoice-details h4 {
        color: #666;
        font-size: 16px;
        font-weight: 400;
        margin-bottom: 1.875rem;
        text-transform: uppercase
    }

    .inv-badge {
        color: #fff;
        display: inline-flex;
        font-size: 11px;
        justify-content: center;
        min-width: 70px;
        min-height: 28px;
        line-height: 2;
        background-color: #009688 !important
    }

    .inv-logo {
        max-height: 80px
    }

    .invoice-container {
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, .1);
        margin: 0 auto 1.875rem;
        max-width: 900px;
        padding: 1.5rem
    }

    .invoice-details,
    .invoice-payment-details>li span {
        float: right;
        text-align: right
    }

    .inv-logo {
        height: auto;
        max-height: 100px;
        width: auto
    }

    .calendar-events {
        border: 1px solid transparent;
        cursor: move;
        padding: 10px 15px
    }

    .calendar-events:hover {
        border-color: #e9e9e9;
        background-color: #fff
    }

    .calendar-events i {
        margin-right: 8px
    }

    .calendar {
        float: left;
        margin-bottom: 0
    }

    .fc-toolbar.fc-header-toolbar {
        margin-bottom: 1.5rem
    }

    .none-border .modal-footer {
        border-top: none
    }

    .fc-toolbar h2 {
        font-size: 18px;
        font-weight: 600;
        font-family: roboto, sans-serif;
        line-height: 30px;
        text-transform: uppercase
    }

    .fc-day-grid-event .fc-time {
        font-family: roboto, sans-serif
    }

    .fc-day {
        background: #fff
    }

    .fc-toolbar .fc-state-active,
    .fc-toolbar .ui-state-active,
    .fc-toolbar button:focus,
    .fc-toolbar button:hover,
    .fc-toolbar .ui-state-hover {
        z-index: 0
    }

    .fc th.fc-widget-header {
        background: #eee;
        font-size: 14px;
        line-height: 20px;
        padding: 10px 0;
        text-transform: uppercase
    }

    .fc-unthemed th,
    .fc-unthemed td,
    .fc-unthemed thead,
    .fc-unthemed tbody,
    .fc-unthemed .fc-divider,
    .fc-unthemed .fc-row,
    .fc-unthemed .fc-popover {
        border-color: #f3f3f3
    }

    .fc-basic-view .fc-day-number,
    .fc-basic-view .fc-week-number {
        padding: 2px 5px
    }

    .fc-button {
        background: #f1f1f1;
        border: none;
        color: #797979;
        text-transform: capitalize;
        box-shadow: none !important;
        border-radius: 3px !important;
        margin: 0 3px !important;
        padding: 6px 12px !important;
        height: auto !important
    }

    .fc-text-arrow {
        font-family: inherit;
        font-size: 16px
    }

    .fc-state-hover {
        background: #f3f3f3
    }

    .fc-state-highlight {
        background: #f0f0f0
    }

    .fc-state-down,
    .fc-state-active,
    .fc-state-disabled {
        background-color: #2962ff !important;
        color: #fff !important;
        text-shadow: none !important
    }

    .fc-cell-overlay {
        background: #f0f0f0
    }

    .fc-unthemed .fc-today {
        background: #fff
    }

    .fc-event {
        border-radius: 2px;
        border: none;
        color: #fff !important;
        cursor: move;
        font-size: 13px;
        margin: 1px 7px;
        padding: 5px;
        text-align: center
    }

    .fc-basic-view td.fc-week-number span {
        padding-right: 8px;
        font-weight: 700;
        font-family: roboto, sans-serif
    }

    .fc-basic-view td.fc-day-number {
        padding-right: 8px;
        font-weight: 700;
        font-family: roboto, sans-serif
    }

    .event-form .input-group .form-control {
        height: 40px
    }

    .submit-section {
        text-align: center;
        margin-top: 40px
    }

    .submit-btn {
        border-radius: 50px;
        font-size: 18px;
        font-weight: 600;
        min-width: 200px;
        padding: 10px 20px
    }

    .dropdown-action {
        margin-bottom: 5px
    }

    .dropdown-action .dropdown-toggle:after {
        display: none
    }

    .table-inbox input[type=radio],
    .table-inbox input[type=checkbox] {
        cursor: pointer
    }

    .mail-list {
        list-style: none;
        padding: 0
    }

    .mail-list>li>a {
        color: #333;
        display: block;
        padding: 10px
    }

    .mail-list>li.active>a {
        color: #2962ff;
        font-weight: 700
    }

    .unread .name,
    .unread .subject,
    .unread .mail-date {
        color: #000;
        font-weight: 600
    }

    .table-inbox .fa-star {
        color: #ffd200
    }

    .table-inbox .starred.fa-star {
        color: #ffd200
    }

    .table.table-inbox>tbody>tr>td,
    .table.table-inbox>tbody>tr>th,
    .table.table-inbox>tfoot>tr>td,
    .table.table-inbox>tfoot>tr>th,
    .table.table-inbox>thead>tr>td,
    .table.table-inbox>thead>tr>th {
        border-bottom: 1px solid #f2f2f2;
        border-top: 0
    }

    .table-inbox {
        font-size: 15px;
        margin-bottom: 0
    }

    .table.table-inbox thead {
        background-color: #fff
    }

    .note-editor.note-frame {
        border: 1px solid #ddd;
        box-shadow: inherit
    }

    .note-editor.note-frame .note-statusbar {
        background-color: #fff
    }

    .note-editor.note-frame.fullscreen {
        top: 60px
    }

    .note-editor.note-frame .btn-light {
        background-color: #f9f9f9;
        box-shadow: unset;
        color: #333
    }

    .mail-title {
        font-weight: 700;
        text-transform: uppercase
    }

    .form-control.search-message {
        border-color: #ccc;
        border-radius: 4px;
        height: 38px;
        width: 180px
    }

    .table-inbox tr {
        cursor: pointer
    }

    table.table-inbox tbody tr.checked {
        background-color: #ffc
    }

    .mail-label {
        font-size: 16px !important;
        margin-right: 5px
    }

    .attachments {
        list-style: none;
        margin: 0;
        padding: 0
    }

    .attachments li {
        border: 1px solid #eee;
        float: left;
        margin-bottom: 10px;
        margin-right: 10px;
        width: 180px
    }

    .attach-info {
        background-color: #f4f4f4;
        padding: 10px
    }

    .attach-file {
        color: #777;
        font-size: 70px;
        padding: 10px;
        min-height: 138px;
        display: flex;
        align-items: center;
        justify-content: center
    }

    .attach-file img {
        height: auto;
        max-width: 100%
    }

    .mailview-header {
        border-bottom: 1px solid #ddd;
        margin-bottom: 20px;
        padding-bottom: 15px
    }

    .mailview-footer {
        border-top: 1px solid #ddd;
        margin-top: 20px;
        padding-top: 15px
    }

    .mailview-footer .btn-white {
        margin-top: 10px;
        min-width: 102px
    }

    .sender-img {
        float: left;
        margin-right: 10px;
        width: 40px
    }

    .sender-name {
        display: block
    }

    .receiver-name {
        color: #777
    }

    .right-action {
        text-align: right
    }

    .mail-view-title {
        font-weight: 500;
        font-size: 24px;
        margin: 0
    }

    .mail-view-action {
        float: right
    }

    .mail-sent-time {
        float: right
    }

    .inbox-menu {
        display: inline-block;
        margin: 0 0 1.875rem;
        padding: 0;
        width: 100%
    }

    .inbox-menu li {
        display: inline-block;
        width: 100%
    }

    .inbox-menu li+li {
        margin-top: 2px
    }

    .inbox-menu li a {
        color: #333;
        display: inline-block;
        padding: 10px 15px;
        width: 100%;
        text-transform: capitalize;
        -webkit-transition: .3s ease;
        -moz-transition: .3s ease;
        transition: .3s ease
    }

    .inbox-menu li a i {
        font-size: 16px;
        padding-right: 10px;
        color: #878787
    }

    .inbox-menu li a:hover,
    .inbox-menu li.active a,
    .inbox-menu li a:focus {
        background: rgba(33, 33, 33, .05)
    }

    .compose-btn {
        margin-bottom: 1.875rem
    }

    .compose-btn a {
        font-weight: 600;
        padding: 8px 15px
    }

    .error-page {
        align-items: center;
        color: #1f1f1f;
        display: flex
    }

    .error-page .main-wrapper {
        display: flex;
        flex-wrap: wrap;
        height: auto;
        justify-content: center;
        width: 100%;
        min-height: unset
    }

    .error-box {
        margin: 0 auto;
        max-width: 480px;
        padding: 1.875rem 0;
        text-align: center;
        width: 100%
    }

    .error-box h1 {
        color: #009688;
        font-size: 10em
    }

    .error-box p {
        margin-bottom: 1.875rem
    }

    .error-box .btn {
        border-radius: 50px;
        font-size: 18px;
        font-weight: 600;
        min-width: 200px;
        padding: 10px 20px;
        background-color: #009688
    }

    .chat-window {
        border: 1px solid #e0e3e4;
        display: flex;
        flex-wrap: wrap;
        position: relative;
        margin-bottom: 1.875rem;
        box-shadow: 0 .5em 1em -.125em rgba(10, 10, 10, .1), 0 0 0 1px rgba(10, 10, 10, .02)
    }

    .chat-window .chat-cont-left {
        border-right: 1px solid #e0e3e4;
        flex: 0 0 35%;
        left: 0;
        max-width: 35%;
        position: relative;
        z-index: 4;
        float: left
    }

    .chat-window .chat-cont-left .chat-header {
        align-items: center;
        background-color: #fff;
        border-bottom: 1px solid #e0e3e4;
        color: #324148;
        display: flex;
        height: 72px;
        justify-content: space-between;
        padding: 0 15px
    }

    .chat-window .chat-cont-left .chat-header span {
        font-size: 20px;
        font-weight: 600;
        text-transform: capitalize
    }

    .chat-window .chat-cont-left .chat-header .chat-compose {
        color: #8a8a8a;
        display: inline-flex
    }

    .chat-window .chat-cont-left .chat-search {
        background-color: #f5f5f6;
        border-bottom: 1px solid #e5e5e5;
        padding: 10px 15px;
        width: 100%
    }

    .chat-window .chat-cont-left .chat-search .input-group {
        width: 100%
    }

    .chat-window .chat-cont-left .chat-search .input-group .form-control {
        background-color: #fff;
        border-radius: 50px;
        padding-left: 36px
    }

    .chat-window .chat-cont-left .chat-search .input-group .form-control:focus {
        border-color: #ccc;
        box-shadow: none
    }

    .chat-window .chat-cont-left .chat-search .input-group .input-group-prepend {
        align-items: center;
        bottom: 0;
        color: #666;
        display: flex;
        left: 15px;
        pointer-events: none;
        position: absolute;
        top: 0;
        z-index: 4
    }

    .chat-window .chat-scroll {
        max-height: calc(100vh - 255px);
        overflow-y: auto
    }

    .chat-window .chat-cont-left .chat-users-list {
        background-color: #fff
    }

    .chat-window .chat-cont-left .chat-users-list a.media {
        border-bottom: 1px solid #e5e5e5;
        padding: 10px 15px;
        transition: all .2s ease 0s
    }

    .chat-window .chat-cont-left .chat-users-list a.media:last-child {
        border-bottom: 0
    }

    .chat-window .chat-cont-left .chat-users-list a.media .media-img-wrap {
        margin-right: 15px;
        position: relative
    }

    .chat-window .chat-cont-left .chat-users-list a.media .media-img-wrap .avatar {
        height: 45px;
        width: 45px
    }

    .chat-window .chat-cont-left .chat-users-list a.media .media-img-wrap .status {
        bottom: 7px;
        height: 10px;
        right: 4px;
        position: absolute;
        width: 10px;
        border: 2px solid #fff
    }

    .chat-window .chat-cont-left .chat-users-list a.media .media-body {
        display: flex;
        justify-content: space-between
    }

    .chat-window .chat-cont-left .chat-users-list a.media .media-body>div:first-child .user-name,
    .chat-window .chat-cont-left .chat-users-list a.media .media-body>div:first-child .user-last-chat {
        max-width: 250px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap
    }

    .chat-window .chat-cont-left .chat-users-list a.media .media-body>div:first-child .user-name {
        color: #333;
        text-transform: capitalize
    }

    .chat-window .chat-cont-left .chat-users-list a.media .media-body>div:first-child .user-last-chat {
        color: #8a8a8a;
        font-size: 14px;
        line-height: 24px
    }

    .chat-window .chat-cont-left .chat-users-list a.media .media-body>div:last-child {
        text-align: right
    }

    .chat-window .chat-cont-left .chat-users-list a.media .media-body>div:last-child .last-chat-time {
        color: #8a8a8a;
        font-size: 13px
    }

    .chat-window .chat-cont-left .chat-users-list a.media:hover {
        background: #d5d5d5
    }

    .chat-window .chat-cont-left .chat-users-list a.media.read-chat .media-body>div:last-child .last-chat-time {
        color: #8a8a8a
    }

    .chat-window .chat-cont-left .chat-users-list a.media.active {
        background-color: #d5d5d5
    }

    .chat-window .chat-cont-right {
        flex: 0 0 65%;
        max-width: 65%;
        float: left
    }

    .chat-window .chat-cont-right .chat-header {
        align-items: center;
        background-color: #fff;
        border-bottom: 1px solid #e0e3e4;
        display: flex;
        height: 72px;
        justify-content: space-between;
        padding: 0 15px
    }

    .chat-window .chat-cont-right .chat-header .back-user-list {
        display: none;
        margin-right: 5px;
        margin-left: -7px
    }

    .chat-window .chat-cont-right .chat-header .media {
        align-items: center
    }

    .chat-window .chat-cont-right .chat-header .media .media-img-wrap {
        position: relative;
        display: flex;
        align-items: center;
        margin-right: 15px
    }

    .chat-window .chat-cont-right .chat-header .media .media-img-wrap .avatar {
        height: 50px;
        width: 50px
    }

    .chat-window .chat-cont-right .chat-header .media .media-img-wrap .status {
        border: 2px solid #fff;
        bottom: 0;
        height: 10px;
        position: absolute;
        right: 3px;
        width: 10px
    }

    .chat-window .chat-cont-right .chat-header .media .media-body .user-name {
        color: #333;
        font-size: 16px;
        font-weight: 600;
        text-transform: capitalize
    }

    .chat-window .chat-cont-right .chat-header .media .media-body .user-status {
        color: #666;
        font-size: 14px
    }

    .chat-window .chat-cont-right .chat-header .chat-options {
        display: flex
    }

    .chat-window .chat-cont-right .chat-header .chat-options>a {
        align-items: center;
        border-radius: 50%;
        color: #8a8a8a;
        display: inline-flex;
        height: 30px;
        justify-content: center;
        margin-left: 10px;
        width: 30px
    }

    .chat-window .chat-cont-right .chat-body {
        background-color: #f5f5f6
    }

    .chat-window .chat-cont-right .chat-body ul.list-unstyled {
        margin: 0 auto;
        padding: 15px;
        width: 100%
    }

    .chat-window .chat-cont-right .chat-body .media .avatar {
        height: 30px;
        width: 30px
    }

    .chat-window .chat-cont-right .chat-body .media .media-body {
        margin-left: 20px
    }

    .chat-window .chat-cont-right .chat-body .media .media-body .msg-box>div {
        padding: 10px 15px;
        border-radius: .25rem;
        display: inline-block;
        position: relative
    }

    .chat-window .chat-cont-right .chat-body .media .media-body .msg-box>div p {
        color: #333;
        margin-bottom: 0
    }

    .chat-window .chat-cont-right .chat-body .media .media-body .msg-box+.msg-box {
        margin-top: 5px
    }

    .chat-window .chat-cont-right .chat-body .media.received {
        margin-bottom: 20px
    }

    .chat-window .chat-cont-right .chat-body .media:last-child {
        margin-bottom: 0
    }

    .chat-window .chat-cont-right .chat-body .media.received .media-body .msg-box>div {
        background-color: #fff
    }

    .chat-window .chat-cont-right .chat-body .media.sent {
        margin-bottom: 20px
    }

    .chat-window .chat-cont-right .chat-body .media.sent .media-body {
        align-items: flex-end;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        margin-left: 0
    }

    .chat-window .chat-cont-right .chat-body .media.sent .media-body .msg-box>div {
        background-color: #e3e3e3
    }

    .chat-window .chat-cont-right .chat-body .media.sent .media-body .msg-box>div p {
        color: #333
    }

    .chat-window .chat-cont-right .chat-body .chat-date {
        font-size: 14px;
        margin: 1.875rem 0;
        overflow: hidden;
        position: relative;
        text-align: center;
        text-transform: capitalize
    }

    .chat-window .chat-cont-right .chat-body .chat-date:before {
        background-color: #e0e3e4;
        content: "";
        height: 1px;
        margin-right: 28px;
        position: absolute;
        right: 50%;
        top: 50%;
        width: 100%
    }

    .chat-window .chat-cont-right .chat-body .chat-date:after {
        background-color: #e0e3e4;
        content: "";
        height: 1px;
        left: 50%;
        margin-left: 28px;
        position: absolute;
        top: 50%;
        width: 100%
    }

    .chat-window .chat-cont-right .chat-footer {
        background-color: #fff;
        border-top: 1px solid #e0e3e4;
        padding: 10px 15px;
        position: relative
    }

    .chat-window .chat-cont-right .chat-footer .input-group {
        width: 100%
    }

    .chat-window .chat-cont-right .chat-footer .input-group .form-control {
        background-color: #f5f5f6;
        border: none;
        border-radius: 50px
    }

    .chat-window .chat-cont-right .chat-footer .input-group .form-control:focus {
        background-color: #f5f5f6;
        border: none;
        box-shadow: none
    }

    .chat-window .chat-cont-right .chat-footer .input-group .input-group-prepend .btn,
    .chat-window .chat-cont-right .chat-footer .input-group .input-group-append .btn {
        background-color: transparent;
        border: none;
        color: #9f9f9f
    }

    .chat-window .chat-cont-right .chat-footer .input-group .input-group-append .btn.msg-send-btn {
        background: linear-gradient(to right, #8971ea, #7f72ea, #7574ea, #6a75e9, #5f76e8);
        background: -webkit-linear-gradient(to right, #8971ea, #7f72ea, #7574ea, #6a75e9, #5f76e8);
        border-color: #2962ff;
        border-radius: 50%;
        color: #fff;
        margin-left: 10px
    }

    .msg-typing {
        width: auto;
        height: 24px;
        padding-top: 8px
    }

    .msg-typing span {
        height: 8px;
        width: 8px;
        float: left;
        margin: 0 1px;
        background-color: #a0a0a0;
        display: block;
        border-radius: 50%;
        opacity: .4
    }

    .msg-typing span:nth-of-type(1) {
        animation: 1s blink infinite .33333s
    }

    .msg-typing span:nth-of-type(2) {
        animation: 1s blink infinite .66666s
    }

    .msg-typing span:nth-of-type(3) {
        animation: 1s blink infinite .99999s
    }

    .chat-window .chat-cont-right .chat-body .media.received .media-body .msg-box {
        position: relative
    }

    .chat-window .chat-cont-right .chat-body .media.received .media-body .msg-box:first-child:before {
        border-bottom: 6px solid transparent;
        border-right: 6px solid #fff;
        border-top: 6px solid transparent;
        content: "";
        height: 0;
        left: -6px;
        position: absolute;
        right: auto;
        top: 8px;
        width: 0
    }

    .chat-window .chat-cont-right .chat-body .media.sent .media-body .msg-box {
        padding-left: 50px;
        position: relative
    }

    .chat-window .chat-cont-right .chat-body .media.sent .media-body .msg-box:first-child:before {
        border-bottom: 6px solid transparent;
        border-left: 6px solid #e3e3e3;
        border-top: 6px solid transparent;
        content: "";
        height: 0;
        left: auto;
        position: absolute;
        right: -6px;
        top: 8px;
        width: 0
    }

    .chat-msg-info {
        align-items: center;
        display: flex;
        clear: both;
        flex-wrap: wrap;
        list-style: none;
        padding: 0;
        margin: 5px 0 0
    }

    .chat-msg-info li {
        font-size: 13px;
        padding-right: 16px;
        position: relative
    }

    .chat-msg-info li:not(:last-child):after {
        position: absolute;
        right: 8px;
        top: 50%;
        content: '';
        height: 4px;
        width: 4px;
        background: #d2dde9;
        border-radius: 50%;
        transform: translate(50%, -50%)
    }

    .chat-window .chat-cont-right .chat-body .media.sent .media-body .msg-box .chat-msg-info li:not(:last-child)::after {
        right: auto;
        left: 8px;
        transform: translate(-50%, -50%);
        background: #aaa
    }

    .chat-window .chat-cont-right .chat-body .media.received .media-body .msg-box>div .chat-time {
        color: rgba(50, 65, 72, .4)
    }

    .chat-window .chat-cont-right .chat-body .media.sent .media-body .msg-box>div .chat-time {
        color: rgba(50, 65, 72, .4)
    }

    .chat-msg-info li a {
        color: #777
    }

    .chat-msg-info li a:hover {
        color: #2c80ff
    }

    .chat-seen i {
        color: #00d285;
        font-size: 16px
    }

    .chat-msg-attachments {
        padding: 4px 0;
        display: flex;
        width: 100%;
        margin: 0 -1px
    }

    .chat-msg-attachments>div {
        margin: 0 1px
    }

    .chat-window .chat-cont-right .chat-body .media.sent .media-body .msg-box>div .chat-msg-info {
        flex-direction: row-reverse
    }

    .chat-window .chat-cont-right .chat-body .media.sent .media-body .msg-box>div .chat-msg-attachments {
        flex-direction: row-reverse
    }

    .chat-window .chat-cont-right .chat-body .media.sent .media-body .msg-box>div .chat-msg-info li {
        padding-left: 16px;
        padding-right: 0;
        position: relative
    }

    .chat-attachment img {
        max-width: 100%
    }

    .chat-attachment {
        position: relative;
        max-width: 130px;
        overflow: hidden
    }

    .chat-attachment {
        border-radius: .25rem
    }

    .chat-attachment:before {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: #000;
        content: "";
        opacity: .4;
        transition: all .4s
    }

    .chat-attachment:hover:before {
        opacity: .6
    }

    .chat-attach-caption {
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        color: #fff;
        padding: 7px 15px;
        font-size: 13px;
        opacity: 1;
        transition: all .4s
    }

    .chat-attach-download {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        opacity: 0;
        transition: all .4s;
        color: #fff;
        width: 32px;
        line-height: 32px;
        background: rgba(255, 255, 255, .2);
        text-align: center
    }

    .chat-attach-download:hover {
        color: #495463;
        background: #fff
    }

    .chat-attachment:hover .chat-attach-caption {
        opacity: 0
    }

    .chat-attachment:hover .chat-attach-download {
        opacity: 1
    }

    .chat-attachment-list {
        display: flex;
        margin: -5px
    }

    .chat-attachment-list li {
        width: 33.33%;
        padding: 5px
    }

    .chat-attachment-item {
        border: 5px solid rgba(230, 239, 251, .5);
        height: 100%;
        min-height: 60px;
        text-align: center;
        font-size: 30px;
        display: flex;
        align-items: center;
        justify-content: center
    }

    .chat-window .chat-cont-right .chat-body .media.sent .media-body .msg-box>div:hover .chat-msg-actions {
        opacity: 1
    }

    .chat-msg-actions {
        position: absolute;
        left: -30px;
        top: 50%;
        transform: translateY(-50%);
        opacity: 0;
        transition: all .4s;
        z-index: 2
    }

    .chat-msg-actions>a {
        padding: 0 10px;
        color: #495463;
        font-size: 24px
    }

    .chat-msg-actions>a:hover {
        color: #2c80ff
    }

    @keyframes blink {
        50% {
            opacity: 1
        }
    }

    .btn-file {
        align-items: center;
        display: inline-flex;
        font-size: 20px;
        justify-content: center;
        overflow: hidden;
        padding: 0 .75rem;
        position: relative;
        vertical-align: middle
    }

    .btn-file input {
        cursor: pointer;
        filter: alpha(opacity=0);
        font-size: 23px;
        height: 100%;
        margin: 0;
        opacity: 0;
        position: absolute;
        right: 0;
        top: 0;
        width: 100%
    }

    .product {
        -moz-transition: all .5s;
        -webkit-transition: all .5s;
        -o-transition: all .5s;
        border: 1px solid #e7e7e7;
        border-radius: 5px;
        padding: 10px;
        background-color: #fff;
        margin-bottom: 1.875rem
    }

    .product-inner {
        overflow: hidden;
        position: relative;
        width: 100%
    }

    .product-inner img {
        width: 100%;
        height: auto
    }

    .product-inner .cart-btns {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, .5);
        opacity: 0;
        transition: all .5s;
        -moz-transition: all .5s;
        -webkit-transition: all .5s;
        -o-transition: all .5s;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center
    }

    .cart-btns .btn {
        width: 120px;
        display: block;
        transition: all .5s;
        -moz-transition: all .5s;
        -webkit-transition: all .5s;
        -o-transition: all .5s
    }

    .cart-btns .btn+.btn {
        margin-top: 10px
    }

    .product .pro-desc {
        margin-top: 10px
    }

    .pro-desc .price {
        font-size: 18px;
        line-height: 20px;
        color: #333;
        font-weight: 700
    }

    .product:hover .cart-btns {
        opacity: 1
    }

    .pro-desc h5 {
        font-size: 1rem
    }

    .pro-desc h5 a {
        color: #333
    }

    .product-det {
        position: relative;
        display: block;
        float: left;
        width: 100%;
        min-height: 40px
    }

    .product-desc {
        padding: 0 0 0 70px
    }

    .product-det>img {
        top: 0;
        width: 60px;
        position: absolute;
        left: 0
    }

    .product-desc span,
    .product-desc a {
        width: 100%;
        margin: 0;
        padding: 0;
        display: block
    }

    .product-content {
        position: relative
    }

    .product-content p {
        color: #333;
        margin: 0 0 20px
    }

    .product-content p:last-child {
        margin-bottom: 0
    }

    .proimage-thumb {
        float: left;
        list-style: none;
        padding: 0
    }

    .proimage-thumb li {
        float: left;
        height: 60px;
        width: 80px;
        text-align: center;
        margin: 13px 12px 0 0
    }

    .proimage-thumb li img {
        display: block;
        height: 62px;
        width: 81px;
        border-radius: 3px;
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;
        position: relative
    }

    .rated {
        color: #fc0
    }

    .product_price {
        font-size: 30px;
        font-weight: 700
    }

    .review-list {
        list-style: none;
        margin: 0;
        padding: 0
    }

    .review-list li {
        clear: both;
        padding-left: 80px
    }

    .review-list li .review {
        margin-bottom: 1.875rem
    }

    .review-list li .review-author {
        margin-left: -80px;
        position: absolute
    }

    .review-list li img.avatar {
        height: 58px;
        width: 58px;
        border-radius: 58px
    }

    .review-by {
        display: block;
        font-size: 14px;
        line-height: 21px;
        margin: 0 0 10px
    }

    .review-list .review-block p {
        line-height: 20px;
        margin: 0;
        text-align: justify
    }

    .new-review label {
        font-size: 14px;
        font-weight: 500
    }

    .new-review input.form-control {
        border: 1px solid #e5e5e5;
        border-radius: 0;
        box-shadow: inherit;
        height: 40px
    }

    .new-review textarea.form-control {
        border: 1px solid #e5e5e5;
        border-radius: 0;
        box-shadow: inherit
    }

    .new-review .form-group {
        margin-bottom: 20px
    }

    .review-submit .btn {
        background-color: #00bf6f;
        border-color: #00bf6f;
        border-radius: 0;
        font-size: 18px;
        padding: 8px 26px;
        color: #fff
    }

    .review-date {
        color: #999
    }

    .review-author-name {
        font-size: 18px;
        margin-bottom: .5rem;
        display: inline-block
    }

    .product-reviews {
        margin-bottom: 1.875rem
    }

    .rating {
        display: flex
    }

    .rating i+i {
        margin-left: 2px
    }

    .thumb {
        margin-bottom: 15px
    }

    .thumb:last-child {
        margin-bottom: 0
    }

    .thumb figure img {
        -webkit-filter: grayscale(100%);
        filter: grayscale(100%);
        -webkit-transition: .3s ease-in-out;
        transition: .3s ease-in-out
    }

    .thumb figure:hover img {
        -webkit-filter: grayscale(0);
        filter: grayscale(0)
    }

    .image_title {
        font-size: 30px;
        font-weight: 400
    }

    .Status_title {
        font-size: 15px
    }

    card-title {
        font-size: 1.125rem
    }

    .booking-menu {
        margin-left: 20px !important
    }

    .formtype {
        padding: 5px
    }

    .buttonedit {
        float: right;
        border-color: #1A8DF8;
        height: 45px;
        background: #1A8DF8
    }

    .buttonedit1 {
        float: right;
        border-color: transparent;
        height: 45px;
        background: #1A8DF8;
        border-color: #1A8DF8
    }

    .veiwbutton {
        font-size: .9rem;
        background: #1A8DF8;
        border-color: #1A8DF8
    }

    .search_button {
        background: #1A8DF8;
        border-color: #1A8DF8
    }

    section.pricing {
        background: #1A8DF8;
        height: 150px;
        border-radius: 15px
    }

    .pricing .card {
        border: none;
        border-radius: 1rem;
        transition: all .2s;
        box-shadow: 0 .5rem 1rem 0 rgba(0, 0, 0, .1)
    }

    .pricing hr {
        margin: 1.5rem 0
    }

    .pricing .card-title {
        margin: .5rem 0;
        font-size: .9rem;
        letter-spacing: .1rem;
        font-weight: 700
    }

    .pricing .card-price {
        margin: 0;
        font-size: 27px
    }

    .pricing .card-price .period {
        font-size: .8rem
    }

    .pricing ul li {
        margin-bottom: 1rem
    }

    .pricing .text-muted {
        opacity: .7;
        color: #009587 !important;
        font-size: 16px
    }

    .pricing .btn {
        font-size: 80%;
        border-radius: 5rem;
        letter-spacing: .1rem;
        font-weight: 700;
        padding: 1rem;
        transition: all .2s;
        background: #009688;
        border-color: #009688
    }

    @media(min-width:992px) {
        .pricing .card:hover {
            margin-top: -.25rem;
            margin-bottom: .25rem;
            box-shadow: 0 .5rem 1rem 0 rgba(0, 0, 0, .3)
        }

        .pricing .card:hover .btn {
            opacity: 1
        }
    }

    .blank_title {
        font-size: 25px;
        font-weight: 400
    }

    .emp-profile {
        padding: 3%;
        margin-top: 3%;
        margin-bottom: 3%;
        border-radius: .5rem;
        background: #fff
    }

    .profile-img {
        text-align: center
    }

    .profile-img img {
        width: 70%;
        height: 100%
    }

    .profile-img .file {
        position: relative;
        overflow: hidden;
        margin-top: -20%;
        width: 70%;
        border: none;
        border-radius: 0;
        font-size: 15px;
        background: #212529b8
    }

    .profile-img .file input {
        position: absolute;
        opacity: 0;
        right: 0;
        top: 0
    }

    .profile-head h5 {
        color: #333
    }

    .profile-head h6 {
        color: #0062cc
    }

    .profile-edit-btn {
        border: none;
        border-radius: 1.5rem;
        width: 70%;
        padding: 2%;
        font-weight: 600;
        color: #6c757d;
        cursor: pointer
    }

    .proile-rating {
        font-size: 12px;
        color: #818182;
        margin-top: 5%
    }

    .proile-rating span {
        color: #495057;
        font-size: 15px;
        font-weight: 600
    }

    .profile-head .nav-tabs {
        margin-bottom: 5%
    }

    .profile-head .nav-tabs .nav-link {
        font-weight: 600;
        border: none
    }

    .profile-head .nav-tabs .nav-link.active {
        border: none;
        border-bottom: 2px solid #0062cc
    }

    .profile-work {
        padding: 14%;
        margin-top: -15%
    }

    .profile-work p {
        font-size: 12px;
        color: #818182;
        font-weight: 600;
        margin-top: 10%
    }

    .profile-work a {
        text-decoration: none;
        color: #495057;
        font-weight: 600;
        font-size: 14px
    }

    .profile-work ul {
        list-style: none
    }

    .profile-tab label {
        font-weight: 600
    }

    .profile-tab p {
        font-weight: 600;
        color: #0062cc
    }

    .activites_details {
        width: 50px;
        height: 50px;
        margin-left: 30px
    }

    h3.page-sub-title {
        font-size: 20px
    }

    .activity-list {
        list-style: none;
        margin: 0;
        padding: 0;
        position: relative
    }

    .activity-list_li {
        background-color: #fff;
        margin-bottom: 10px;
        padding: 10px;
        position: relative;
        display: flex;
        box-shadow: 0 .5em 1em -.125em rgba(10, 10, 10, .1), 0 0 0 1px rgba(10, 10, 10, .02)
    }

    .activity-content {
        background-color: #fff;
        margin: 0 0 0 15px;
        padding: 0;
        position: relative
    }

    .time {
        color: #bdbdbd;
        display: block;
        font-size: 14px
    }

    .timeline-content {
        background-color: #fff;
        padding: 0;
        position: relative
    }

    .blog-view .blog-title {
        font-size: 28px;
        color: #009688
    }

    .blog-view .blog-info {
        border: 0;
        margin-bottom: 20px;
        padding: 0
    }

    .social-share {
        float: left;
        list-style: none;
        margin: 5px 0 0;
        padding: 0
    }

    .social-share>li {
        display: inline-block;
        float: left;
        margin-left: 10px;
        text-align: center
    }

    .social-share>li:first-child {
        margin-left: 0
    }

    .social-share>li>a {
        border: 1px solid #dfdfdf;
        color: #6576e9;
        display: inline-block;
        font-size: 22px;
        height: 40px;
        line-height: 40px;
        width: 40px
    }

    .social-share>li>a:hover {
        background-color: #6375e8;
        color: #fff;
        border-color: #6e75ea
    }

    .widget h3 {
        color: #656565;
        font-size: 21px;
        margin: 0 0 20px
    }

    .blog-reply>a {
        color: #6176e8;
        font-size: 12px;
        font-weight: 500
    }

    .blog-date {
        color: #999;
        font-size: 12px
    }

    .comments-list {
        list-style: none;
        margin: 0;
        padding: 0
    }

    .comments-list li {
        clear: both;
        padding: 10px 0 0 88px
    }

    .comments-list li .comment {
        margin-bottom: 30px
    }

    .comments-list li .comment-author {
        margin-left: -88px;
        position: absolute
    }

    .comments-list li img.avatar {
        height: 58px;
        width: 58px;
        border-radius: 58px
    }

    .blog-author-name {
        color: #009ce7;
        font-size: 18px;
        font-weight: 500
    }

    .span-left {
        text-align: right;
        font-size: 15px;
        margin-left: 10px;
    }

    .span-ED {
        font-size: 13px;

    }

    .text-red {
        color: red
    }

    .new-comment label {
        font-size: 14px;
        font-weight: 500
    }

    .container22 {
        display: flex;
        justify-content: flex-end;
    }

    .new-comment input.form-control {
        border: 1px solid #e5e5e5;
        border-radius: 0;
        box-shadow: inherit;
        height: 40px
    }

    .new-comment textarea.form-control {
        border: 1px solid #e5e5e5;
        border-radius: 0;
        box-shadow: inherit
    }

    .new-comment .form-group {
        margin-bottom: 20px
    }

    .comment-submit .btn {
        background-color: #6776e9;
        border-color: #6d75e9;
        border-radius: 0;
        font-size: 18px;
        padding: 8px 26px;
        color: #fff
    }

    .about-author-img {
        background-color: #fff;
        height: auto;
        overflow: hidden;
        position: absolute;
        width: 120px
    }

    .author-details {
        margin-top: 15px;
        margin-left: 5px
    }

    .about-author {
        min-height: auto
    }

    .author-details .blog-author-name {
        display: inline-block;
        margin-bottom: 10px
    }

    .blog-navigation {
        text-align: right
    }

    .blog-single-post {
        position: relative;
        margin: 0 0 50px;
        background-color: #fff;
        border: 1px solid #e7e7e7;
        border-radius: 4px;
        padding: 20px
    }

    .card-img {
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0
    }

    .card-title {
        margin-bottom: .3rem
    }

    .cat {
        display: inline-block;
        margin-bottom: 1rem
    }

    .fa-users {
        margin-left: 1rem
    }

    .card-footer {
        font-size: .8rem
    }

    .profile-header {
        background: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%);
        border: 1px solid #efefef;
        padding: 1.5rem
    }

    .profile-menu {
        background-color: #fff;
        box-shadow: 0 2px 2px rgba(0, 0, 0, .1);
        padding: .9375rem 1.5rem
    }

    .profile-menu .nav-tabs.nav-tabs-solid {
        background-color: transparent
    }

    .profile-header img {
        height: auto;
        max-width: 120px;
        width: 120px
    }

    .profile-tab-cont {
        padding-top: 1.875rem
    }

    .about-text {
        max-width: 500px
    }

    .skill-tags span {
        background-color: #f4f4f5;
        border-radius: 4px;
        color: #66676b;
        display: inline-block;
        font-size: 15px;
        line-height: 22px;
        margin: 2px 0;
        padding: 5px 10px
    }

    .edit-link {
        color: #66676b;
        font-size: 16px;
        margin-top: 4px
    }

    .cal-icon {
        position: relative;
        width: 100%
    }

    .cal-icon:after {
        color: #555;
        content: "\f073";
        display: block;
        font-family: "font awesome 5 free";
        font-weight: 600;
        font-size: 15px;
        margin: auto;
        position: absolute;
        right: 15px;
        top: 10px
    }

    .form-title {
        width: 100%;
        max-width: 100%;
        padding: 0;
        font-size: 1.25rem;
        font-weight: 500;
        line-height: inherit;
        color: #333;
        white-space: normal;
        position: relative;
        display: block;
        margin-bottom: 20px
    }

    .form-title:before {
        content: "";
        position: absolute;
        left: 0;
        right: 0;
        height: 1px;
        top: 50%;
        background-color: rgba(0, 0, 0, .1)
    }

    .form-title span {
        padding: 0 .5rem 0 0;
        background-color: #fff;
        display: inline-block;
        z-index: 2;
        position: relative
    }

    .skin-settings {
        z-index: 999;
        position: fixed;
        top: 50%;
        width: 190px;
        border: 0;
        box-shadow: none;
        padding: 0;
        border-bottom-left-radius: 2px;
        right: -190px;
        background: #fff;
        transition: all .4s ease
    }

    .skin-settings.active {
        right: 0;
        transition: all .4s ease
    }

    .skin-settings .skin-sett-icon {
        background-color: #fff;
        border-bottom-left-radius: 2px;
        border-color: #e0e0e0;
        border-style: solid;
        border-top-left-radius: 2px;
        border-width: 1px 0 1px 1px;
        color: #666;
        cursor: pointer;
        display: inline-block;
        font-size: 20px;
        height: 48px;
        left: -47px;
        line-height: 48px;
        position: absolute;
        text-align: center;
        top: 0;
        width: 48px
    }

    .skin-settings .skin-sett-body {
        background-color: #fff;
        border-bottom: 1px solid #e0e0e0;
        border-left: 1px solid #e0e0e0;
        border-top: 1px solid #e0e0e0;
        color: #616161;
        padding: 14px 10px
    }

    .skin-sett-body h4 {
        color: #666;
        font-size: 1.125rem
    }

    .skin-settings .skin-colors {
        font-size: 0;
        list-style: none;
        margin: 0;
        padding: 0;
        text-align: left
    }

    .skin-settings .skin-colors>li {
        display: inline-block
    }

    .skin-settings .skin-colors li a {
        border-radius: 2px;
        cursor: pointer;
        display: block;
        height: 36px;
        margin: 0 3px;
        position: relative;
        width: 36px
    }

    .skin-settings .skin-colors .skin-red {
        background-color: #c12942
    }

    .skin-settings .skin-colors .skin-orange {
        background-color: #ff7000
    }

    .skin-settings .skin-colors .skin-teal {
        background: linear-gradient(to right, #00a0b0 0%, #00d2e6 100%)
    }

    .skin-settings .skin-colors .skin-purple {
        background-color: #2962ff
    }

    .skin-settings .skin-colors li a.active:after {
        color: #fff;
        content: "\f00c";
        display: block;
        font-family: fontawesome;
        font-size: 15px;
        left: 50%;
        margin: auto;
        position: absolute;
        top: 50%;
        transform: translate(-50%, -50%)
    }

    .donut-chart {
        font-size: 12px
    }

    .voice-call-avatar {
        flex-direction: column;
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 2
    }

    .voice-call-avatar .call-avatar {
        margin: 15px;
        width: 150px;
        height: 150px;
        border-radius: 100%;
        border: 1px solid rgba(0, 0, 0, .1);
        padding: 3px;
        background-color: #fff
    }

    .call-duration {
        display: inline-block;
        font-size: 30px;
        margin-top: 4px;
        position: absolute;
        left: 0
    }

    .voice-call-avatar .call-timing-count {
        padding: 5px
    }

    .voice-call-avatar .username {
        font-size: 18px;
        text-transform: uppercase
    }

    .call-icons {
        text-align: center;
        position: relative
    }

    .call-icons .call-items {
        border-radius: 5px;
        padding: 0;
        margin: 0;
        list-style: none;
        display: inline-block
    }

    .call-icons .call-items .call-item {
        display: inline-block;
        text-align: center;
        margin-right: 5px
    }

    .call-icons .call-items .call-item:last-child {
        margin-right: 0
    }

    .call-icons .call-items .call-item a {
        color: #777;
        border: 1px solid #ddd;
        width: 50px;
        height: 50px;
        line-height: 50px;
        border-radius: 50px;
        display: inline-block;
        font-size: 20px
    }

    .call-icons .call-items .call-item a i {
        width: 18px;
        height: 18px
    }

    .user-video {
        bottom: 0;
        left: 0;
        overflow: auto;
        position: absolute;
        right: 0;
        top: 0;
        z-index: 10
    }

    .user-video img {
        width: auto;
        max-width: 100%;
        height: auto;
        max-height: 100%;
        display: block;
        margin: 0 auto
    }

    .user-video video {
        width: auto;
        max-width: 100%;
        height: auto;
        max-height: 100%;
        display: block;
        margin: 0 auto
    }

    .my-video {
        position: absolute;
        z-index: 99;
        bottom: 20px;
        right: 20px
    }

    .my-video ul {
        margin: 0;
        padding: 0;
        list-style: none
    }

    .my-video ul li {
        float: left;
        width: 120px;
        margin-right: 10px
    }

    .my-video ul li img {
        border: 3px solid #fff;
        border-radius: 6px
    }

    .end-call {
        position: absolute;
        top: 7px;
        right: 0
    }

    .end-call a {
        background-color: #f06060;
        border-radius: 50px;
        color: #fff;
        display: inline-block;
        line-height: 10px;
        padding: 8px 25px;
        text-transform: uppercase
    }

    .call-users {
        position: absolute;
        z-index: 99;
        bottom: 20px;
        right: 20px
    }

    .call-users ul {
        margin: 0;
        padding: 0;
        list-style: none
    }

    .call-users ul li {
        float: left;
        width: 80px;
        margin-left: 10px
    }

    .call-users ul li img {
        border-radius: 6px;
        padding: 2px;
        background-color: #fff;
        border: 1px solid rgba(0, 0, 0, .1)
    }

    .call-mute {
        width: 80px;
        height: 80px;
        background-color: rgba(0, 0, 0, .5);
        position: absolute;
        display: inline-block;
        text-align: center;
        line-height: 80px;
        border-radius: 6px;
        font-size: 30px;
        color: #fff;
        display: none;
        top: 0;
        border: 3px solid transparent
    }

    .call-users ul li a:hover .call-mute {
        display: block
    }

    .call-details {
        margin: 10px 0 0;
        display: flex
    }

    .call-info {
        margin-left: 10px;
        width: 100%
    }

    .call-user-details,
    .call-timing {
        display: block;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap
    }

    .call-description {
        white-space: nowrap;
        vertical-align: bottom
    }

    .call-timing {
        color: #727272;
        display: flex;
        font-size: 14px;
        margin-top: 1px;
        overflow: hidden;
        white-space: pre
    }

    .chat-avatar-sm {
        display: inline-block;
        float: left;
        margin-left: 0 !important;
        margin-right: 10px;
        position: relative;
        width: 24px
    }

    .chat-avatar-sm img {
        width: 24px
    }

    .chat-avatar-sm.user-img .status {
        bottom: 0;
        right: -3px
    }

    .chat-main-row {
        bottom: 0;
        left: 0;
        overflow: auto;
        padding-bottom: inherit;
        padding-top: inherit;
        position: absolute;
        right: 0;
        top: 0
    }

    .chat-main-wrapper {
        display: table;
        height: 100%;
        table-layout: fixed;
        width: 100%
    }

    .message-view {
        display: table-cell;
        height: 100%;
        float: none;
        padding: 0;
        position: static;
        vertical-align: top;
        width: 75%
    }

    .chat-window {
        display: table;
        height: 100%;
        table-layout: fixed;
        width: 100%;
        background-color: #f7f7f7
    }

    .fixed-header {
        background-color: #fff;
        border-bottom: 1px solid #eaeaea;
        padding: 10px 15px
    }

    .fixed-header .navbar {
        border: 0;
        margin: 0;
        min-height: auto;
        padding: 0
    }

    .fixed-header .user-info a {
        color: #555;
        text-transform: uppercase
    }

    .typing-text {
        color: #00c5fb;
        font-size: 12px;
        text-transform: lowercase
    }

    .last-seen {
        color: #888;
        display: block;
        font-size: 12px
    }

    .custom-menu {
        margin-top: 6px
    }

    .fixed-header .custom-menu {
        margin: 0 0 1px
    }

    .custom-menu.nav>li>a {
        color: #bbb;
        font-size: 26px;
        line-height: 32px;
        margin-left: 15px;
        padding: 0
    }

    .custom-menu.navbar-nav>li>a:hover,
    .custom-menu.navbar-nav>li>a:focus {
        background-color: transparent
    }

    .custom-menu .dropdown-menu {
        left: auto;
        right: 0
    }

    .search-box {
        margin-top: 5px
    }

    .search-box .input-group {
        background-color: #f7f7f7;
        border: 1px solid #e3e3e3;
        border-radius: 50px
    }

    .search-box .input-group .form-control {
        background: 0 0;
        border: none
    }

    .search-box .btn {
        background-color: transparent
    }

    .search-input {
        border-radius: 5px
    }

    .chat-contents {
        display: table-row;
        height: 100%
    }

    .chat-content-wrap {
        height: 100%;
        position: relative;
        width: 100%
    }

    .chat-wrap-inner {
        bottom: 0;
        left: 0;
        overflow: auto;
        position: absolute;
        right: 0;
        top: 0
    }

    .chats {
        padding: 30px 15px
    }

    .chat-body {
        display: block;
        margin: 10px 0 0;
        overflow: hidden
    }

    .chat-body:first-child {
        margin-top: 0
    }

    .chat-right .chat-content {
        background-color: #f2f2f2;
        border: 1px solid #e3e3e3;
        border-radius: 20px 2px 2px 20px;
        clear: both;
        color: #727272;
        display: block;
        float: right;
        margin: 0;
        max-width: 60%;
        padding: 8px 15px;
        position: relative
    }

    .chat-right .chat-body {
        padding-left: 48px;
        padding-right: 10px
    }

    .chat-bubble {
        display: block;
        width: 100%;
        float: left;
        margin-bottom: 10px
    }

    .chat-bubble:hover .chat-action-btns {
        display: block;
        float: left
    }

    .chat-right .chat-bubble:hover .chat-action-btns {
        float: right;
        display: block
    }

    .chat.chat-right .chat-bubble:last-child .chat-content {
        border-bottom-right-radius: 20px
    }

    .chat.chat-right .chat-bubble:first-child .chat-content {
        border-top-right-radius: 20px
    }

    .chat-content>p {
        margin-bottom: 0
    }

    .chat-time {
        color: rgba(0, 0, 0, .5);
        display: block;
        font-size: 12px
    }

    .chat-right .chat-time {
        text-align: right
    }

    .chat-bubble .chat-action-btns {
        display: none
    }

    .chat-action-btns {
        float: right
    }

    .chat-action-btns ul {
        list-style: none;
        padding: 0;
        margin: 15px 15px 0
    }

    .chat-action-btns ul>li {
        display: inline-block;
        margin-left: 5px;
        font-size: 18px
    }

    .chat-right .chat-action-btns {
        float: left
    }

    .chat-bubble .chat-action-btns a {
        color: #8c8c8c
    }

    .chat-line {
        border-bottom: 1px solid #eaeaea;
        height: 12px;
        margin: 7px 0 20px;
        position: relative;
        text-align: center
    }

    .chat-date {
        background-color: #f7f7f7;
        color: #727272;
        font-size: 12px;
        padding: 0 11px
    }

    .chat-avatar {
        float: right
    }

    .chat-avatar .avatar {
        line-height: 30px;
        height: 30px;
        width: 30px
    }

    .chat-left .chat-avatar {
        float: left
    }

    .chat-left .chat-body {
        margin-right: 0;
        margin-left: 30px;
        padding-right: 20px
    }

    .chat-left .chat-content {
        background-color: #fff;
        border: 1px solid #eaeaea;
        color: #888;
        float: left;
        position: relative;
        padding: 8px 15px;
        border-radius: 2px 20px 20px 2px;
        max-width: 60%
    }

    .avatar {
        background-color: #aaa;
        border-radius: 50%;
        color: #fff;
        display: inline-block;
        font-weight: 500;
        height: 38px;
        line-height: 38px;
        margin: 0 10px 0 0;
        text-align: center;
        text-decoration: none;
        text-transform: uppercase;
        vertical-align: middle;
        width: 38px;
        position: relative;
        white-space: nowrap
    }

    .avatar:hover {
        color: #fff
    }

    .avatar.avatar-xs {
        width: 24px;
        height: 24px
    }

    .avatar>img {
        border-radius: 50%;
        display: block;
        overflow: hidden;
        width: 100%
    }

    .chat.chat-left .chat-bubble:first-child .chat-content {
        border-top-left-radius: 20px;
        margin-top: 0
    }

    .chat.chat-left .chat-bubble:last-child .chat-content {
        border-bottom-left-radius: 20px
    }

    .chat-left .chat-time {
        color: #a9a9a9
    }

    .attach-list {
        color: #a3a3a3;
        padding: 5px 0 0;
        line-height: 24px;
        margin: 0;
        list-style: none
    }

    .attach-list i {
        margin-right: 3px;
        font-size: 16px
    }

    .chat-footer {
        background-color: #fff;
        border-top: 1px solid #eaeaea;
        padding: 15px
    }

    .message-bar {
        display: table;
        height: 44px;
        position: relative;
        width: 100%
    }

    .message-bar .message-inner {
        display: table-row;
        height: 100%;
        padding: 0 8px;
        width: 100%
    }

    .message-bar .link {
        color: #777;
        display: table-cell;
        font-size: 20px;
        padding: 0 10px;
        position: relative;
        vertical-align: middle;
        width: 30px
    }

    .message-bar .message-area {
        display: table-cell
    }

    .message-area .input-group .form-control {
        background-color: #fff;
        border: 1px solid #eaeaea;
        box-shadow: none;
        color: #555;
        display: block;
        font-size: 14px;
        height: 44px;
        margin: 0;
        padding: 6px 12px;
        resize: none
    }

    .message-area .btn {
        height: 44px;
        width: 50px
    }

    .profile-right {
        display: table-cell;
        height: 100%;
        float: none;
        padding: 0;
        position: static;
        vertical-align: top
    }

    .display-table {
        display: table;
        table-layout: fixed;
        border-spacing: 0;
        width: 100%;
        height: 100%
    }

    .table-row {
        display: table-row;
        height: 100%
    }

    .table-body {
        position: relative;
        height: 100%;
        width: 100%
    }

    .table-content {
        bottom: 0;
        left: 0;
        overflow: auto;
        position: absolute;
        right: 0;
        top: 0
    }

    .chat-profile-img {
        padding: 30px;
        position: relative;
        text-align: center
    }

    .edit-profile-img {
        height: 120px;
        margin: 0 auto;
        position: relative;
        width: 120px;
        cursor: pointer
    }

    .edit-profile-img img {
        border-radius: 50%;
        height: auto;
        margin: 0;
        width: 120px
    }

    .change-img {
        background-color: rgba(0, 0, 0, .3);
        border-radius: 50%;
        color: #fff;
        display: none;
        height: 100%;
        left: 0;
        line-height: 120px;
        position: absolute;
        top: 0;
        width: 100%
    }

    .edit-profile-img:hover .change-img {
        display: block
    }

    .edit-profile-img img {
        height: auto;
        margin: 0;
        width: 120px;
        border-radius: 50%
    }

    .user-name {
        color: #333
    }

    .edit-btn {
        border-radius: 40px;
        height: 36px;
        position: absolute;
        right: 15px;
        top: 15px;
        width: 36px
    }

    .chat-profile-info {
        padding: 15px
    }

    .user-det-list {
        list-style: none;
        padding: 0
    }

    .user-det-list>li {
        padding: 6px 15px
    }

    .user-det-list .text-muted {
        color: #888
    }

    .transfer-files .tab-content {
        padding-top: 0
    }

    .files-list {
        list-style: none;
        padding-left: 0
    }

    .files-list>li {
        border-bottom: 1px solid #eaeaea;
        border-radius: inherit;
        margin: 2px 0 0;
        padding: 10px
    }

    .files-cont {
        position: relative
    }

    .file-type {
        height: 48px;
        position: absolute;
        width: 48px
    }

    .files-icon {
        background-color: #f3f7f9;
        border: 1px solid #e4eaec;
        border-radius: 4px;
        display: inline-block;
        height: 38px;
        line-height: 38px;
        text-align: center;
        width: 38px
    }

    .files-icon i {
        color: #76838f;
        font-size: 20px
    }

    .files-info {
        padding: 0 30px 0 50px
    }

    .file-name a {
        color: #333
    }

    .files-action {
        display: none;
        height: 30px;
        list-style: none;
        padding-left: 0;
        position: absolute;
        right: 0;
        text-align: right;
        top: 10px;
        width: 30px
    }

    .files-list>li:hover .files-action {
        display: block
    }

    .file-date {
        color: #888;
        font-size: 12px
    }

    .file-author a {
        color: #00c5fb;
        font-size: 12px;
        text-decoration: underline
    }

    .files-action .dropdown-menu {
        left: auto;
        right: 0
    }

    .files-action>li>a {
        color: #777
    }

    .chat-img-attach {
        border-radius: 4px;
        margin-bottom: 12px;
        margin-left: 12px;
        position: relative;
        float: right
    }

    .chat-img-attach img {
        border-radius: 4px;
        display: inline-block;
        height: auto;
        max-width: 100%
    }

    .chat-placeholder {
        background: rgba(69, 81, 97, .6);
        border-radius: 4px;
        color: #fff;
        display: flex;
        flex-direction: column;
        height: 100%;
        justify-content: flex-end;
        left: 0;
        padding: 13px;
        position: absolute;
        top: 0;
        width: 100%
    }

    .chat-img-name {
        font-size: 12px;
        font-weight: 700;
        line-height: 16px
    }

    .chat-file-desc {
        font-size: 11px
    }

    .chat-right .chat-content.img-content {
        background-color: transparent;
        border: 0;
        color: #76838f;
        padding: 0;
        text-align: right
    }

    .chat-right .img-content .chat-time {
        color: #a3a3a3
    }

    .chat-left .chat-img-attach {
        float: left
    }

    .chat-left .chat-img-attach {
        float: left;
        margin-left: 0;
        margin-right: 12px
    }

    .input-group .form-control-lg.form-control {
        border-radius: 4px 0 0 4px;
        height: 46px
    }

    .chat-user-list {
        list-style: none;
        margin: 0;
        padding: 0
    }

    .chat-user-list .media {
        border-bottom: 1px solid #eaeaea;
        border-radius: inherit;
        padding: 10px;
        background-color: #fff
    }

    .chat-user-list .media:hover {
        background-color: #f7f7f7
    }

    .designation {
        color: #9e9e9e;
        font-size: 12px
    }

    .online-date {
        color: #9e9e9e;
        font-size: 12px
    }

    .drop-zone {
        width: 100%;
        height: 205px;
        border: 2px dashed #adb7be;
        text-align: center;
        padding: 25px 0 0;
        margin-bottom: 20px
    }

    .drop-zone .drop-zone-caption {
        font-weight: 600
    }

    .upload-list {
        padding: 0;
        list-style: none;
        margin: 0
    }

    .upload-list .file-list {
        background-color: #fff;
        border-top: 1px solid #e3e3e3;
        padding: 10px 0
    }

    .upload-list .file-list:first-child {
        border-top: none
    }

    .upload-list .upload-wrap {
        position: relative;
        padding: 0 20px 0 0;
        margin: 0 0 5px
    }

    .upload-list .file-name,
    .upload-list .file-size {
        display: inline-block;
        vertical-align: top;
        white-space: nowrap
    }

    .upload-list .file-name {
        padding-right: 15px;
        overflow: hidden;
        max-width: 100%;
        text-overflow: ellipsis
    }

    .upload-list .file-size {
        color: #888
    }

    .upload-list .file-close {
        border: none;
        background: 0 0;
        color: #ccc;
        position: absolute;
        right: 0;
        top: 2px
    }

    .upload-list .file-close:hover {
        color: #f62d51
    }

    .upload-list .upload-process {
        font-size: 10px;
        color: #888
    }

    .upload-list .progress {
        margin-bottom: 5px
    }

    .upload-list .file-name i {
        color: #888;
        margin: 0 5px 0 0;
        vertical-align: middle
    }

    .upload-drop-zone {
        background-color: #fff;
        border: 2px dashed #e3e3e3;
        color: #ccc;
        height: 200px;
        line-height: 200px;
        margin-bottom: 20px;
        text-align: center
    }

    .upload-drop-zone.drop {
        color: #222;
        border-color: #222
    }

    .upload-text {
        font-size: 24px;
        margin-left: 10px
    }

    .files-share-list {
        border: 1px solid #eaeaea;
        border-radius: 4px;
        margin-bottom: 20px;
        padding: 15px
    }

    .call-box {
        display: block;
        background: linear-gradient(to right, #3aaea3 0%, #95efe4 100%);
        position: sticky;
        top: 0;
        z-index: 99;
        overflow-y: auto;
        overflow-x: hidden
    }

    .call-box .call-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        height: calc(100vh - 60px);
        text-align: center
    }

    .call-box .call-wrapper .call-avatar {
        margin-bottom: 50px;
        cursor: pointer;
        animation: ripple 2s infinite
    }

    .call-box .call-wrapper .call-user {
        margin-bottom: 50px
    }

    .call-box .call-wrapper .call-user h4 {
        color: #fff
    }

    .call-box .call-wrapper .call-user span {
        display: block;
        color: #fff;
        font-weight: 500;
        text-align: center
    }

    .call-box .call-wrapper .call-items {
        display: flex;
        align-items: center;
        justify-content: center
    }

    .call-box .call-wrapper .call-items .call-item {
        background-color: rgba(255, 255, 255, .2);
        border: 1px solid transparent;
        border-radius: 100%;
        color: #fff;
        line-height: 0;
        margin: 0 5px;
        padding: 15px
    }

    .call-box .call-wrapper .call-items .call-item:hover {
        opacity: .9
    }

    .call-box .call-wrapper .call-items .call-item:first-child {
        margin-top: -30px
    }

    .call-box .call-wrapper .call-items .call-item:last-child {
        margin-top: -30px
    }

    .call-box .call-wrapper .call-items .call-item.call-end {
        padding: 20px;
        margin: 30px 20px 0;
        background: #f06060;
        border: 1px solid #f06060;
        color: #fff;
        line-height: 0;
        border-radius: 100%
    }

    .call-box .call-wrapper .call-items .call-item.call-start {
        padding: 20px;
        margin: 30px 20px 0;
        background: #55ce63;
        border: 1px solid #55ce63;
        color: #fff;
        line-height: 0;
        border-radius: 100%
    }

    .call-box.incoming-box .call-wrapper .call-items .call-item.call-start {
        margin: 0 10px
    }

    .call-box.incoming-box .call-wrapper .call-items .call-item.call-end {
        margin: 0 10px
    }

    .call-box .call-avatar {
        border-radius: 100%;
        height: 150px;
        max-width: 150px;
        min-width: 150px;
        position: relative;
        width: 100%
    }

    .call-box .btn {
        background: transparent;
        transition: all .3s ease 0s
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




    @-webkit-keyframes ripple {
        0% {
            -webkit-box-shadow: 0 0 0 0 rgba(0, 0, 0, .1)
        }

        100% {
            -webkit-box-shadow: 0 0 0 50px transparent
        }
    }

    @keyframes ripple {
        0% {
            -moz-box-shadow: 0 0 0 0 rgba(0, 0, 0, .1);
            box-shadow: 0 0 0 0 rgba(0, 0, 0, .1)
        }

        100% {
            -moz-box-shadow: 0 0 0 50px transparent;
            box-shadow: 0 0 0 50px transparent
        }
    }

    .incoming-btns {
        margin-top: 20px
    }

    .contacts-header {
        background-color: #fff;
        border-bottom: 1px solid #eaeaea;
        padding: 10px 15px
    }

    .contacts-header .navbar {
        border: 0;
        margin: 0;
        min-height: auto
    }

    .contacts-header .user-info a {
        color: #76838f;
        text-transform: uppercase
    }

    .contact-left {
        display: table-cell;
        height: 100%;
        float: none;
        padding: 0;
        position: static;
        vertical-align: top;
        -webkit-transition: all .4s ease;
        -moz-transition: all .4s ease;
        transition: all .4s ease;
        width: 100%
    }

    .contacts-list {
        position: relative;
        padding: 0 70px 0 20px
    }

    .contact-list {
        list-style: none;
        padding-left: 0;
        margin: 0
    }

    .contact-list>li {
        background-color: #fff;
        border-bottom: 1px solid #eaeaea;
        border-radius: inherit;
        padding: 10px
    }

    .contact-cont {
        position: relative
    }

    .contact-type {
        height: 48px;
        position: absolute;
        width: 48px
    }

    .contact-icon {
        background-color: #f3f7f9;
        border: 1px solid #e4eaec;
        border-radius: 4px;
        display: inline-block;
        height: 38px;
        line-height: 38px;
        text-align: center;
        width: 38px
    }

    .contact-icon i {
        color: #76838f;
        font-size: 20px
    }

    .contact-info {
        padding: 0 30px 0 50px
    }

    .contact-action {
        height: 30px;
        list-style: none;
        padding-left: 0;
        position: absolute;
        right: 0;
        text-align: right;
        top: 10px;
        width: 30px
    }

    .contact-date {
        color: #888;
        font-size: 12px
    }

    .contact-author a {
        color: #1d6ad2;
        font-size: 12px;
        text-decoration: underline
    }

    .contact-action .dropdown-menu {
        left: auto;
        right: 0
    }

    .contact-alphapets {
        background-color: #fff;
        border-left: 1px solid #ddd;
        bottom: 0;
        height: 100%;
        overflow: hidden;
        padding-bottom: 114px;
        position: fixed;
        right: 0;
        top: 114px;
        width: 50px
    }

    .contact-box {
        display: inline-table;
        height: 100%;
        padding: 30px 15px;
        position: relative;
        width: 100%
    }

    .alphapets-inner {
        height: 100%;
        overflow: auto
    }

    .alphapets-inner a {
        display: block;
        text-align: center;
        padding: 2px;
        color: #333
    }

    .percentage {
        display: block;
    }


    .text-black {
        color: #000;
    }

    @media only screen and (min-width:768px) {
        .avatar-xxl {
            width: 8rem;
            height: 8rem
        }

        .avatar-xxl .border {
            border-width: 4px !important
        }

        .avatar-xxl .rounded {
            border-radius: 12px !important
        }

        .avatar-xxl .avatar-title {
            font-size: 42px
        }

        .avatar-xxl.avatar-away:before,
        .avatar-xxl.avatar-offline:before,
        .avatar-xxl.avatar-online:before {
            border-width: 4px
        }
    }

    @media only screen and (min-width:992px) {
        #toggle_btn {
            align-items: center;
            color: #1A8DF8;
            display: inline-flex;
            float: left;
            font-size: 30px;
            height: 77px;
            justify-content: center;
            margin-left: 15px;
            padding: 0 15px
        }

        .mini-sidebar .header-left .logo img {
            height: auto;
            max-height: 40px;
            width: auto
        }

        .mini-sidebar .header .header-left .logo {
            display: none
        }

        .mini-sidebar .header-left .logo.logo-small {
            display: block
        }

        .mini-sidebar .header .header-left {
            padding: 0 5px;
            width: 78px
        }

        .mini-sidebar .sidebar {
            width: 78px
        }

        .mini-sidebar.expand-menu .sidebar {
            width: 240px
        }

        .mini-sidebar .menu-title {
            visibility: hidden;
            white-space: nowrap
        }

        .mini-sidebar.expand-menu .menu-title {
            visibility: visible
        }

        .mini-sidebar .menu-title a {
            visibility: hidden
        }

        .mini-sidebar.expand-menu .menu-title a {
            visibility: visible
        }

        .modal-open.mini-sidebar .sidebar {
            z-index: 1051
        }

        .mini-sidebar .sidebar .sidebar-menu ul>li>a span {
            display: none;
            transition: all .2s ease-in-out;
            opacity: 0
        }

        .mini-sidebar.expand-menu .sidebar .sidebar-menu ul>li>a span {
            display: inline;
            opacity: 1
        }

        .mini-sidebar.expand-menu .sidebar .sidebar-menu>ul>li>a i {
            font-size: 24px;
            width: 20px
        }

        .mini-sidebar .page-wrapper {
            margin-left: 78px
        }

        .mini-sidebar .sidebar-menu>ul>li>a {
            padding: 12px 14px
        }
    }

    @media only screen and (max-width:1400px) {

        .chat-window .chat-cont-left .chat-users-list a.media .media-body>div:first-child .user-name,
        .chat-window .chat-cont-left .chat-users-list a.media .media-body>div:first-child .user-last-chat {
            max-width: 180px
        }
    }

    @media only screen and (max-width:1199px) {

        .chat-window .chat-cont-left .chat-users-list a.media .media-body>div:first-child .user-name,
        .chat-window .chat-cont-left .chat-users-list a.media .media-body>div:first-child .user-last-chat {
            max-width: 150px
        }

        .chat-window .chat-cont-left {
            flex: 0 0 40%;
            max-width: 40%
        }

        .chat-window .chat-cont-right {
            flex: 0 0 60%;
            max-width: 60%
        }
    }

    @media only screen and (max-width:991.98px) {
        .header .header-left {
            position: absolute;
            width: 100%
        }

        .mobile_btn {
            color: #000 !important;
            cursor: pointer;
            display: block;
            font-size: 24px;
            height: 60px;
            left: 0;
            line-height: 60px;
            padding: 0 15px;
            position: absolute;
            text-align: center;
            top: 12px;
            z-index: 10
        }

        #toggle_btn {
            display: none
        }

        .top-nav-search {
            display: none
        }

        .login-wrapper .loginbox .login-left {
            padding: 80px 50px;
            width: 50%
        }

        .login-wrapper .loginbox .login-right {
            padding: 50px;
            width: 50%
        }

        .sidebar {
            margin-left: -225px;
            width: 225px;
            -webkit-transition: all .4s ease;
            -moz-transition: all .4s ease;
            transition: all .4s ease;
            z-index: 1041
        }

        .page-wrapper {
            margin-left: 0;
            padding-left: 0;
            padding-right: 0;
            -webkit-transition: all .4s ease;
            -moz-transition: all .4s ease;
            transition: all .4s ease
        }

        .chat-window .chat-scroll {
            max-height: calc(100vh - 255px)
        }

        .chat-window .chat-cont-left,
        .chat-window .chat-cont-right {
            flex: 0 0 100%;
            max-width: 100%;
            transition: left .3s ease-in-out 0s, right .3s ease-in-out 0s;
            width: 100%
        }

        .chat-window .chat-cont-left {
            border-right: 0
        }

        .chat-window .chat-cont-right {
            position: absolute;
            right: calc(-100% + -1.875rem);
            top: 0
        }

        .chat-window .chat-cont-right .chat-header {
            justify-content: start
        }

        .chat-window .chat-cont-right .chat-header .back-user-list {
            display: block
        }

        .chat-window .chat-cont-right .chat-header .chat-options {
            margin-left: auto
        }

        .chat-window.chat-slide .chat-cont-left {
            left: calc(-100% + -1.875rem)
        }

        .chat-window.chat-slide .chat-cont-right {
            right: 0
        }
    }

    @media only screen and (max-width:767.98px) {
        body {
            font-size: .9375rem
        }

        h1,
        .h1 {
            font-size: 2rem
        }

        h2,
        .h2 {
            font-size: 1.75rem
        }

        h3,
        .h3 {
            font-size: 1.5rem
        }

        h4,
        .h4 {
            font-size: 1.125rem
        }

        h5,
        .h5 {
            font-size: 1rem
        }

        h6,
        .h6 {
            font-size: .875rem
        }

        .header .has-arrow .dropdown-toggle:after {
            display: none
        }

        .user-menu.nav>li>a>span:not(.user-img) {
            display: none
        }

        .navbar-nav .open .dropdown-menu {
            float: left;
            position: absolute
        }

        .navbar-nav.user-menu .open .dropdown-menu {
            left: auto;
            right: 0
        }

        .header .header-left {
            padding: 0 15px
        }

        .header .header-left .logo {
            display: none
        }

        .header-left .logo.logo-small {
            display: inline-block
        }

        .login-wrapper .loginbox .login-left {
            display: none
        }

        .login-wrapper .loginbox {
            max-width: 450px;
            min-height: unset
        }

        .login-wrapper .loginbox .login-right {
            float: none;
            padding: 1.875rem;
            width: 100%
        }

        .invoice-container {
            padding: 20px
        }

        .left-action {
            text-align: center;
            margin-bottom: 15px
        }

        .right-action {
            text-align: center
        }

        .top-action-left .float-left {
            float: none !important
        }

        .top-action-left .btn-group {
            margin-bottom: 15px
        }

        .top-action-right {
            text-align: center
        }

        .top-action-right a.btn.btn-white {
            margin-bottom: 15px
        }

        .mail-sent-time {
            float: left;
            margin-top: 10px;
            width: 100%
        }

        .profile-btn {
            flex: 0 0 100%;
            margin-top: 20px
        }

        .chat-window .chat-cont-left .chat-users-list a.media .media-body>div:first-child .user-name,
        .chat-window .chat-cont-left .chat-users-list a.media .media-body>div:first-child .user-last-chat {
            max-width: 250px
        }

        .app-dropdown {
            display: none
        }

        .edit-link {
            font-size: .875rem;
            margin-top: 0
        }

        .product_price {
            font-size: 1.5rem
        }

        .login-wrapper .loginbox .login-right h1 {
            font-size: 22px
        }

        .error-box h1 {
            font-size: 6em
        }

        .error-box .btn {
            font-size: 15px;
            min-width: 150px;
            padding: 8px 20px
        }

        .dash-count {
            font-size: 16px
        }
    }

    @media only screen and (max-width:575.98px) {
        .card {
            margin-bottom: .9375rem
        }

        .page-wrapper>.content {
            padding: .9375rem .9375rem 0
        }

        .chat-window {
            margin-bottom: .9375rem
        }

        .card-body {
            padding: 1.25rem
        }

        .card-header {
            padding: .75rem 1.25rem
        }

        .card-footer {
            padding: .75rem 1.25rem
        }

        .card-chart .card-body {
            padding: 5px
        }

        .page-header {
            margin-bottom: .9375rem
        }

        .account-wrapper {
            padding: .9375rem
        }

        .pagination-lg .page-link {
            font-size: 1.2rem;
            padding: .5rem .625rem
        }

        .profile-image {
            flex: 0 0 100%;
            margin-bottom: 20px;
            text-align: center
        }

        .profile-user-info {
            text-align: center
        }

        .profile-btn {
            text-align: center
        }

        .invoice-details,
        .invoice-payment-details>li span {
            float: left;
            text-align: left
        }

        .fc-toolbar .fc-right {
            display: inline-block;
            float: none;
            margin: 10px auto 0;
            width: 200px;
            clear: both
        }

        .fc-toolbar .fc-left {
            float: none;
            margin: 0 auto;
            width: 200px
        }

        .fc-toolbar .fc-center {
            display: inline-block;
            width: 100%;
            text-align: center
        }

        .fc-toolbar .fc-center h2 {
            width: 100%
        }

        .profile-tab-cont {
            padding-top: 1.25rem
        }

        .chat-window .chat-cont-right .chat-header .media .media-body {
            display: none
        }
    }

    @media only screen and (max-width:479px) {
        .add-btn {
            font-size: 14px;
            padding: 6px 7px
        }

        .chat-window .chat-cont-left .chat-users-list a.media .media-body>div:first-child .user-name,
        .chat-window .chat-cont-left .chat-users-list a.media .media-body>div:first-child .user-last-chat {
            max-width: 160px
        }

        .page-header .breadcrumb {
            display: none
        }
    }

    .row-equivalent {
        display: flex;
        flex-wrap: wrap;
        /* Allow items to wrap to the next line if the container is not wide enough */
        margin-right: -15px;
        /* Counteract the default margin of the last item in the row */
        margin-left: -15px;
        /* Counteract the default margin of the first item in the row */
    }

    /* Define the columns */
    .col-equivalent {
        flex: 0 0 100%;
        /* Take up 100% of the width initially */
        max-width: 100%;
        /* Don't grow beyond 100% */
        box-sizing: border-box;
        /* Include padding and border in the element's total width and height */
    }

    /* Define a responsive layout for smaller screens */
    @media (min-width: 576px) {
        .col-equivalent {
            flex: 0 0 50%;
            /* Take up 50% of the width on screens 576px and wider */
        }
    }

    .containerflex {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        /* You can adjust this value based on your layout requirements */
    }

    textarea {

        width: 100%;
        /* Ensures the textarea takes the full width within the container */
    }

    .form-group {
        margin-bottom: 1rem;
    }

    /* Bootstrap-like styling for textarea */
    .form-control {


        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;


        border-radius: 0.25rem;

    }
</style>
<div class="m-t-30">
    <div class="container">
        <div>
            <div class="bg-white2">
                <h3 class="text-center">DSG Sons Group Inc.</h4>
                    <h4 class="text-center">J.P Laurel Ave., Davao City</h5>
                        <h1 class="text-center">{{ $template->name }}</h1>

                        <div class="employee-details">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="department">Department</label>
                                    <input type="text" class="form-control" id="department" name="department"
                                        readonly>
                                </div>

                                <div class="col-md-4">
                                    <label for="employee_id">Employee ID</label>
                                    <input type="text" class="form-control" id="employee_id" name="employee_id"
                                        readonly>
                                </div>

                                <div class="col-md-4">
                                    <label for="first_name">Employee Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                        readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="position">Position</label>
                                    <input type="text" class="form-control" id="position" name="position" readonly>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="covered_period_start">Join Date</label>
                                        <input class="form-control" type="date" id="covered_period_start"
                                            name="covered_period_start" readonly>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="created_at">Date of Evaluation</label>
                                        <input class="form-control" type="text" id="created_at" name="created_at"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>

            <div class="bg-white2">
                <div>
                    <ul style="list-style: none;">
                        @foreach ($partsWithFactors as $partWithFactors)
                            <div class="rating-scale"></div>
                            <h4 class="text-center">{{ $partWithFactors['part']->name }}</h4>

                            @foreach ($partWithFactors['factors'] as $factorData)
                                <div class="row">
                                    <div class="col-12 text-left">
                                        <h5>{{ $factorData['factor']->name }}</h5>
                                        <p>{{ $factorData['factor']->description }}</p>
                                    </div>

                                    <div class="col-12 text-center">

                                        <label class="radio-inline">
                                            @if ($loop->first)
                                                <span>Allotted%<br><br></span>
                                            @endif
                                            <span
                                                class="box">{{ $factorData['rating_scales']->max('equivalent_points') }}%</span>
                                        </label>
                                        @foreach ($factorData['rating_scales'] as $ratingScale)
                                            <label class="radio-inline">
                                                {{ $ratingScale->acronym }}<br>
                                                {{ $ratingScale->equivalent_points }}<br>
                                                <input disabled class="custom-radio" type="radio"
                                                    name="rating_{{ $ratingScale->factor_id }}"
                                                    value="{{ $ratingScale->equivalent_points }}">
                                            </label>
                                        @endforeach
                                        <label class="radio-inline">
                                            @if ($loop->parent->first && $loop->first)
                                                <span>POINTS<br><br>
                                            @endif
                                            <span id="points-{{ $factorData['factor']->id }}" class="box">

                                            </span>

                                        </label>

                                        <div class="comment m-t-10">
                                            <div class="form-group">
                                                <label for="">Specific
                                                    situations/incidents to support
                                                    rating:</label>
                                                <textarea class="form-control" readonly></textarea> {{-- Display the factor note --}}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="m-t-30"></div>
                                @if ($loop->last)
                                    <div class="c m-t-20 m-r-15">
                                        <strong>
                                            <span>Total Actual Points/Rate =
                                                {{-- {{ $partWithFactors['part']->name }} - Total Rate: --}}
                                                <span class="box">
                                                </span>
                                            </span>
                                        </strong>
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                    </ul>
                </div>

                <table class="table">
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
                                <td> </td>
                                @if ($loop->first)
                                    <td style="text-align: center; vertical-align: middle" rowspan="4">80%</td>
                                    <td rowspan="5">
                                        <ul>
                                            @foreach ($ratingScales as $scale)
                                                @if ($scale['name'] == 'Outstanding')
                                                    95-100% {{ $scale['name'] }}

                                                    <br>
                                                @elseif ($scale['name'] == 'High Average')
                                                    90-94% {{ $scale['name'] }}

                                                    <br>
                                                @elseif ($scale['name'] == 'Average')
                                                    80-89% {{ $scale['name'] }}

                                                    <br>
                                                @elseif ($scale['name'] == 'Satisfactory')
                                                    70-79% {{ $scale['name'] }}

                                                    <br>
                                                @elseif ($scale['name'] == 'Poor')
                                                    69% & below {{ $scale['name'] }}

                                        </ul>
                                @endif
                        @endforeach
                        </ul>
                        </td>
                        @endif
                        <td>
                            @if ($loop->iteration == 1)
                                Passed
                            @elseif ($loop->iteration == 2)
                                Failed
                            @endif
                        </td>
                        </tr>
                        @endforeach


                        </tr>

                        <tr>
                            <td>Total</td>
                            <td>100%</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <div class="m-t-50">
                    <div class="comment">
                        <div class="form-group">
                            <label for="recommendations">RECOMMENDATION:</label>
                            <textarea name="recommendations" id="recommendations" class="form-control" readonly></textarea>
                        </div>
                    </div>

                    <div class="comment m-t-10">
                        <div class="form-group">
                            <label for="ratee_comments">RATEE’S COMMENTS:</label>
                            <textarea name="ratee_comments" id="ratee_comments" class="form-control" readonly></textarea>
                        </div>
                    </div>


                </div>
                <div class="m-t-30">
                    <h4 class="text-center">Recommendation</h4>
                    <div class="form-group">
                        <label for="current_salary">Current Salary:</label>
                        <input type="number" class="form-control" wire:model="currentSalary" readonly </div>
                        <div class="form-group">
                            <label for="recommended_position">Recommended Position:</label>
                            <input type="text" class="form-control" wire:model="recommendedPosition" readonly>
                        </div>
                        <div class="form-group">
                            <label for="level">Level:</label>
                            <input type="text" class="form-control" wire:model="level" readonly>
                        </div>
                        <div class="form-group">
                            <label for="recommended_salary">Recommended Salary:</label>
                            <input type="number" class="form-control" wire:model="recommendedSalary" readonly>
                        </div>

                        <div class="form-group">
                            <label for="remarks">Remarks:</label>
                            <textarea name="remarks" id="remarks" class="form-control" wire:model="remarks" readonly></textarea>
                        </div>
                        <div class="form-group">
                            <label for="effectivity_timestamp">Effectivity Timestamp:</label>
                            <input type="datetime-local" class="form-control" wire:model="effectivityTimestamp"
                                readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
