         <div class="employee-details">
             <div class="row">
                 <div class="col-md-4">
                     <label for="department">Department</label>
                     <input type="text" class="form-control" id="department" name="department"
                         placeholder="Enter Department/Section" value="{{ $evaluation->employee->department->name }}"
                         readonly>
                 </div>

                 <div class="col-md-4">
                     <label for="employee_id">Employee ID</label>
                     <input type="text" class="form-control" id="employee_id" name="employee_id"
                         placeholder="Enter Employee ID" value="{{ $evaluation->employee->employee_id }}" readonly>
                 </div>

                 <div class="col-md-4">
                     <label for="first_name">Employee Name</label>
                     <input type="text" class="form-control" id="first_name" name="first_name"
                         placeholder="Enter Employee Name"
                         value="{{ $evaluation->employee->first_name . ' ' . $evaluation->employee->last_name }}"
                         readonly>
                 </div>
             </div>

             <div class="row">
                 <div class="col-md-4">
                     <label for="position">Position</label>
                     <input type="text" class="form-control" id="position" name="position"
                         placeholder="Enter Position" value="{{ $evaluation->employee->position }}" readonly>
                 </div>

                 <div class="col-md-4">
                     <div class="form-group">
                         <label for="covered_period_start">Join Date</label>
                         <input class="form-control" type="date" id="covered_period_start"
                             name="covered_period_start" value="{{ $evaluation->employee->date_hired }}" required
                             readonly>
                     </div>
                 </div>

                 <div class="col-md-4">
                     <div class="form-group">
                         <label for="created_at">Date of Evaluation</label>
                         <input class="form-control" type="text" id="created_at" name="created_at"
                             value="{{ $evaluation->created_at }}" required readonly>
                     </div>
                 </div>
             </div>
         </div>
